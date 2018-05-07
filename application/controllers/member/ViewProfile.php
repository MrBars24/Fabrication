<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ViewProfile extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->template->set_template("default");
		$this->load->model('user_model');
		$this->load->model('job_model');
		$this->load->model('review_model');
		$this->load->model('public_model');
		$this->load->model('portfolio_model');
		$this->load->model('proposal_model');
		$this->load->model('training_model');
	}
	public function show($id){
		check_user('member');

		$css = array(
			"/assets/default/css/custom/sections.css"
		);
		$js = array(
			"/assets/admin/custom/js/bars-datatable.js",
			"/assets/admin/custom/js/bs-modal-loader.js",
			"/assets/default/custom/js/review.js",
			"/assets/default/custom/js/invite.js",
		);
		$this->template->append_css($css);
		$this->template->append_js($js);
		$getUserDetails = $this->user_model->getUserDetails($id);
		$getMyJob = $this->job_model->getAllJobsInfo($id);
		$getWinJob = $this->job_model->getWinJob($id);
		$getJobAvailable = $this->job_model->getJobAvailable(auth()->id);

		$getJobInfo = $this->job_model->getAllJobInfo($id);
		$skills = $this->public_model->getMySkills($id);
		$review = $this->review_model->getReview($id);
		$getPortfolio = $this->portfolio_model->getPortfolio($id);
		$getPortfolios = $this->portfolio_model->getPortfolios($id);
		$trainingList = $this->training_model->all();
		$getPrevious = $this->job_model->previousJobsPaginate($id);

		if(!empty($review['data'])){
			$star = star_review($review);
			$this->template->load_sub('star', $star);
		}

		$myGetReview = $this->review_model->myGetReview(auth()->id, $id);
		if($myGetReview){
			$this->template->load_sub('myGetReview', $myGetReview);
		}
		$this->template->load_sub('skills', $skills);
		$this->template->load_sub('trainings', $trainingList);
		$this->template->load_sub('portfolio', $getPortfolio);
		$this->template->load_sub('getPortfolios', $getPortfolios);
		$this->template->load_sub('review', $review);
		$this->template->load_sub('jobAvailable', $getJobAvailable);
		$this->template->load_sub('myJob', $getMyJob);
		$this->template->load_sub('winJob', $getWinJob);
		$this->template->load_sub('previousJobs', $getPrevious);
		$this->template->load_sub('user', $getUserDetails);

        $this->template->load('frontend/member/view_profile');
	}
	public function expert($id){
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
        $this->template->load('frontend/member/view_profile_expert');

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
