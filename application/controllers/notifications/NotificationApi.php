<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class NotificationApi extends MX_Controller {

    public function __construct() {
        parent::__construct();
        check_user('member');
        $this->load->library('Notification');
    }

    public function index() {
        $notifications = $this->notification->getByUserId(auth()->id);
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
}
