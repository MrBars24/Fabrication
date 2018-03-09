<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PublicProfile extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->template->set_template("default");
		
		$js = array(
			"assets/default/custom/js/settings/settings-training.js"
		);
		$this->template->set_additional_js($js);
	}


	public function index(){
		$css = array(
			"/assets/plugins/toast-master/css/jquery.toast.css",
		);
		$js = array(
			"assets/default/custom/js/settings/settings.js",
			"assets/default/custom/js/settings/settings-public.js",
			"assets/plugins/toast-master/js/jquery.toast.js",
			"assets/default/js/toastr.js"
		);
		$this->template->append_CSS($css);
		$this->template->append_js($js);
		$this->template->load('frontend/settings/public_profile');
	}



}
