<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class NotificationApi extends MX_Controller {

    public function __construct() {
        parent::__construct();
        check_user('member');
        $this->load->library('Notification');
        $this->load->model('Notification_model');
    }

    public function index() {
        $this->load->library('Notification');
        $notifications = $this->notification->getByUserId(auth()->id);

        $notifications = array_map(function($e) {
            $e->content = $this->notification->format($e->template, json_decode($e->data));
            return $e;
        }, $notifications);

        return json(
            array(
                'success' => true,
                'data' => array(
                    'notifications' => $notifications
                )
            )
        );
    }

    public function getAllPaginated() {

    }

    public function update($id) {
        $status = $this->input->post('status');

        $data = $this->formatData($status);
        $this->Notification_model->update($id, $data);

        return json(array(
            'success' => true,
            'data' => array(
              'unread_notifications' => newNotificationCount()
            )
        ));
    }

    public function readAll() {
        $result = $this->Notification_model->readAll(auth()->id);

        if ($result) {
          return json(array(
              'success' => true
          ));
        }

        return json(array(
            'success' => true
        ), 500);

    }

    public function formatData($status) {
        $data = array();
        if ( $status == 'read') {
            $data = array(
                'read_at' => date("Y-m-d H:i:s")
            );
        }
        else if ($status == 'unread') {
            $data = array(
                'read_at' => NULL
            );
        }
        else if ($status == 'hide') {
            $data = array(
                'hidden_at' => date("Y-m-d H:i:s")
            );
        }
        else if ($status == 'unhide') {
            $data = array(
                'hidden_at' => NULL
            );
        }
        else {
            return json(array(
                'error' => 'Invalid Request'
            ), 422);
        }
        return $data;
    }
}
