<?php

class BidAcceptedNotification extends Efab_Notification {
    
    private $job_id;

    public function __construct($job_id) {
        parent::__construct();
        $this->job_id = $job_id;
    }

    public function via() {
        return ['database'];
    }

    public function toMail() {
        return 1;
    }

    public function toDatabase() {
        return array(
            'name' => 'Leo',
            'job_id' => $this->job_id
        );
    }
}