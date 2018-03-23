<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pricing extends MX_Controller {
    public function __construct(){
        parent::__construct();
        $this->template->set_template("default");
        $this->load->model("pricing_model");
    }

    public function index(){
        $pricing = $this->pricing_model->getDefaultPrice();

        $this->template->load_sub('pricing', $pricing);
        $this->template->load("pricing");
    }
}
