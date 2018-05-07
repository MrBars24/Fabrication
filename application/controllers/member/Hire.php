<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hire extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('job_model');
		$this->load->model('proposal_model');
		$this->load->model('user_model');
		$this->load->model('Industry_model');
		$this->template->set_template("default");
	}
	public function index()
	{
		check_user('member');
        $css = array(
		);

		$js = array(
			"/assets/admin/custom/js/bs-modal-loader.js",
			"/assets/default/custom/js/hire.js",
			"/assets/plugins/jstz/dist/jstz.min.js",
			"/assets/plugins/select2/js/select2.min.js",
			"/assets/admin/custom/js/bars-datatable.js",
		);

	  $this->template->append_css($css);
	  $this->template->append_js($js);

		$this->load->model('Country_model');
		$_SESSION['dashboard'] = 'hire';
		$getJobAvailable = $this->job_model->getJobAvailable(auth()->id);

		$industries = $this->Industry_model->getIndustries();
		$countries = $this->Country_model->all();

		$this->template->load_sub('industries', $industries);
		$this->template->load_sub('countries', $countries);
		$this->template->load_sub('jobAvailable', $getJobAvailable);
		$this->template->load_sub('summary', $this->job_model->getSummary());
		$this->template->load_sub("active_jobs",$this->job_model->allOpen(TRUE));

    $this->template->load('frontend/member/hire');
	}
	public function getAllMemberPagination(){
		header("Content-Type:application/json");
		$getMembers = $this->user_model->allMember();
		echo json_encode($getMembers);
		exit;
	}

}
