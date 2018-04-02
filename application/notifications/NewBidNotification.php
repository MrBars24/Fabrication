<?php

class NewBidNotification extends Efab_Notification {
    public function __construct() {
        parent::__construct();
    }
    
    public function via() {
        return ['database'];
    }

    public function toMail() {

    }
}