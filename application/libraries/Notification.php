<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Notification {
    private $CI;
    private $notification;
    private $notification_asdasdsa;

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
    public function getByUserId($userId) {
        $notifications = $this->CI->Notification_model->get(NULL, $userId);
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
    
        public function send($userId, $options = NULL) {
            // Handle here depending on notification settings
            $this->CI->load->config('notifications');
    
            $notificationFactory = new NotificationFactory;
            $notification = $notificationFactory->make($this->CI->config->item('notifications')[$this->notification_asdasdsa]['class']);
            $notification->setTemplate($this->notification_asdasdsa);
            return $notification->dispatch($userId);
        }
}


// Classes

interface Notificatable {
    function dispatch($receiver_id);
    function via();
}

abstract class Efab_Notification implements Notificatable {
    protected $templates;
    protected $via = ['database'];
    private $CI;

    public function __construct() {
        $this->CI = get_instance();
    }

    public function setTemplate($template) {
        $this->CI->load->config('notifications');
        $this->templates = $this->CI->config->item('notifications')[$template]['template'];
    }

    public function dispatch($receiver_id) {
        if ( in_array('database', $this->via())) {
            $this->CI->load->model('Notification_model');
            return $this->CI->Notification_model->create(array(
                'user_id' => $receiver_id,
                'template' => $this->templates,
                'message' => 'Another Notification'
            ));
        }
    }
    public function via() {
        return array();
    }
}

class NotificationFactory {
    public function make($class) {
        // dd($class);
        return new $class;
    }
} 


// Exceptions
class InvalidNotificationTemplateException extends Exception {

}


// 
//  Notifications
//  -class for each notification type


class BidAcceptedNotification extends Efab_Notification {
    public function via() {
        return ['database'];
    }

    public function toMail() {

    }
}

class NewBidNotification extends Efab_Notification {
    public function via() {
        return ['database'];
    }

    public function toMail() {

    }
}