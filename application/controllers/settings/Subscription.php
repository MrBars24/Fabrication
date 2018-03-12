<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subscription extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->template->set_template("default");
		
		$js = array(
			"assets/default/custom/js/settings/settings-training.js"
		);
		$this->template->set_additional_js($js);
	}
      
	public function index()
	{	
		$this->template->load('frontend/settings/subscription');
		
	}



}
