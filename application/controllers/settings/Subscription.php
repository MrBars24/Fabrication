<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subscription extends MX_Controller {
    public function __construct(){
        parent::__construct();
        $this->template->set_template("default");
        $this->load->model("pricing_model");
        $this->load->model("subscription_model");
		
		$js = array(
			"assets/default/custom/js/settings/settings-training.js"
		);
		$this->template->set_additional_js($js);
    }

    public function index(){
		$pricing = $this->pricing_model->getDefaultPrice();
    	$user = $_SESSION['user']->id;
    	$memberPackage = $this->subscription_model->getMemberSubscription($user);
    	//$getPackage = $this->subscription_model->getPackage($memberPackage);

    	$this->template->load_sub('member',$memberPackage);
    	$this->template->load_sub('pricing', $pricing);
    	//$this->template->load_sub('package', $getPackage);
        $this->template->load('frontend/settings/subscription');
    }
}

