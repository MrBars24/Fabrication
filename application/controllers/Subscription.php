<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subscription extends MX_Controller {
    public function __construct(){
        parent::__construct();
        $this->template->set_template("default");
    }

    public function index(){
        $this->template->load('subscription');
    }
}
