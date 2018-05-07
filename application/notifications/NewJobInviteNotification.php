<?php

class NewJobInviteNotification extends Efab_Notification {

    private $data;

    public function __construct($data) {
        parent::__construct();
        $this->data = $data;
    }

    public function via() {
        return ['database', 'socket'];
    }

    public function toMail() {
        return 1;
    }

    public function toDatabase() {
        return $this->data;
    }

    public function toArray() {
      $this->data['notification'] = $this->notification_row;
      return $this->data;
    }
}
