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
			"assets/default/custom/css/public-profile.css"
		);
		$js = array(
			"assets/default/custom/js/settings/settings.js",
			"assets/default/custom/js/settings/settings-public.js",
			"assets/plugins/toast-master/js/jquery.toast.js",
			"assets/default/js/toastr.js",
			"assets/default/custom/js/bootstrap-tagsinput.min.js"
		);
		$this->template->append_CSS($css);
		$this->template->append_js($js);
		$this->load->model('public_model');
		$id = $_SESSION['user']->user_id;
		$data = $this->public_model->getPublicProf($id);
		$this->template->load_sub('public_details', $data);
		$this->template->load('frontend/settings/public_profile');
	}

	public function updatePublicProfile(){
	$this->load->model('public_model');
	$id = $_SESSION['user']->user_id;
	$r = $this->public_model->updatePubProf($id);
		if($r){
			echo json_encode( array(
				'success' => 201
			));
		}

	}

}
