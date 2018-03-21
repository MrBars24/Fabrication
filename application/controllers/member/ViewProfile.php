<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ViewProfile extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->template->set_template("default");
		$this->load->model('user_model');
		$this->load->model('job_model');
		$this->load->model('public_model');
	}
	public function show($id){
		$css = array(
			"/assets/default/css/custom/sections.css"
		);
		$js = array(
			"/assets/default/custom/js/invite.js"
		);

		$this->template->append_css($css);
		$this->template->append_js($js);
		$getUserDetails = $this->user_model->getUserDetails($id);
		$getMyJob = $this->job_model->getAllJobsInfo($id);
		$getWinJob = $this->job_model->getWinJob($id);
		$getJobAvailable = $this->job_model->getJobAvailable($id);
		$getJobInfo = $this->job_model->getAllJobInfo($id);
		$skills = $this->public_model->getMySkills($id);
		$this->template->load_sub('skills', $skills);
		$this->template->load_sub('jobAvailable', $getJobAvailable);
		$this->template->load_sub('myJob', $getMyJob);
		$this->template->load_sub('winJob', $getWinJob);
		$this->template->load_sub('user', $getUserDetails);
        $this->template->load('frontend/member/view_profile');
	}
	public function test($id){
		$css = array(
			"/assets/default/css/custom/sections.css"
		);
		$this->template->append_css($css);
		$getUserDetails = $this->user_model->getUserDetails($id);
		// echo '<pre>';
		// var_dump($getUserDetails);
		// echo '</pre>';
		// exit;
		$this->template->load_sub('user', $getUserDetails);
		$this->template->load('frontend/member/view_profile_v1');
	}
}
