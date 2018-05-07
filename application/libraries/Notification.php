<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Notification {
    private $CI;
    private $notification;
    private $notification_asdasdsa;
    private $notification_data;

    public function __construct() {
        $this->CI = get_instance();
        $this->CI->load->model('Notification_model');
    }

    // Get Notification row by Id
    public function findById($id) {
        $notifications = $this->CI->Notification_model->get($id);
        return $notifications;
    }

    // Get notifications by User Id
    public function getByUserId($userId, $withHidden = FALSE) {
        $notifications = $this->CI->Notification_model->get(NULL, $userId, $withHidden);
        return $notifications;
    }

    // Mark as Hidden
    public function hide($id) {
        return $this->CI->Notification_model->update($id, array('hidden_at' => date("Y-m-d H:i:s")));
    }

    // Mark as Read
    public function read($id) {
        return $this->CI->Notification_model->update($id, array('read_at' => date("Y-m-d H:i:s")));
    }

    // Read All
    public function readAll($userId) {
        return $this->CI->Notification_model->readAll($userId);
    }

    public function use($notification_asdasdsa) {
        $this->notification_asdasdsa = $notification_asdasdsa;
        return $this;
    }

    public function send($userId, $params = NULL) {
        // Handle here depending on notification settings
        $this->CI->load->config('notifications');
        $className = $this->CI->config->item('notifications')[$this->notification_asdasdsa]['class'];
        $notification = $this->CI->load->notification($className, $params);
        $notification->setTemplate($this->notification_asdasdsa);
        return $notification->dispatch($userId);
    }

    public function format($template, $data) {
        $this->notification_data = $data;
        $this->CI->load->config('notifications');
        if (!array_key_exists ($template, $this->CI->config->item('notifications'))) {
            return null;
        }

        $template = $this->CI->config->item('notifications')[$template]['template'] ;

        $test = array(
            '::job_link::' => '<a href="/jobs/' . $this->getDataItem('job_id') .'">job</a>',
            '::contract_link::' => '<a href="/jobs/' . $this->getDataItem('contract_id') .'">job</a>'
        );
        return str_replace(
            array_keys($test),
            array_values($test),
            $template
        );

    }

    public function getDataItem($key) {
        if(isset($this->notification_data->{$key})) {
            return $this->notification_data->{$key};
        }
        return null;
    }
}


// Classes

interface Notificatable {
    function dispatch($receiver_id);
    function via();
    function toArray();
    function toDatabase();
}

abstract class Efab_Notification implements Notificatable {
    protected $template_key;
    protected $via = ['database'];
    private $CI;
    protected $notification_row;

    public function __construct() {
      $this->CI = get_instance();
    }

    public function setTemplate($template) {
        $this->CI->load->config('notifications');
        $this->template_key = $template;
    }

    public function dispatch($receiver_id) {
        if ( in_array('database', $this->via())) {
          $this->CI->load->model('Notification_model');

          $notification_id = $this->CI->Notification_model->create(array(
            'user_id' => $receiver_id,
            'template' => $this->template_key,
            'data' => json_encode($this->toDatabase())
          ));

          $this->notification_row = $this->CI->Notification_model->get($notification_id, NULL, TRUE);

          // dd($this->notification_row);
        }
        if ( in_array('socket', $this->via())) {
          $this->CI->load->library('pusher');
          $this->CI->pusher->setChannel("member_$receiver_id");
          //$this->format($e->template, json_decode($e->data));
            $this->CI->load->config('notifications');
            $template = $this->CI->config->item('notifications')[$this->template_key]['template'] ;

            $test = array(
                '::job_link::' => '<a href="/jobs/' . $this->toArray()->job_id .'">job</a>'
            );
            $tmp = str_replace(
                array_keys($test),
                array_values($test),
                $template
            );

            $d = $this->toArray()['notification'];
            $d->content = $tmp;

            $this->CI->pusher->setMessage('message',$d);
          $this->CI->pusher->push('new_notification');
        }
    }

    public function via() {
        return array();
    }

    public function toArray() {
        return array();
    }

    public function toDatabase() {
        return array();
    }
}


// Exceptions
class InvalidNotificationTemplateException extends Exception {

}
