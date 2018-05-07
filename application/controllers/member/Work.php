<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Work extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Industry_model');
		$this->load->model('job_model');
		$this->load->model('proposal_model');
		$this->load->model('user_model');
		$this->load->model('Invite_model');
		$this->template->set_template("default");
	}
	public function index()
	{
		check_user('member');
        $css = array(
			"/assets/default/css/custom/sections.css",
			"/assets/default/custom/css/dashboard.css",
			"/assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.css"
		);

      $js = array(
			"/assets/plugins/jstz/dist/jstz.min.js",
			"/assets/plugins/moment/moment.js",
			"/assets/plugins/readmore.min.js",
			"/assets/plugins/jquery-ellipse/jquery.ellipsis.min.js",
			"/assets/plugins/select2/js/select2.min.js",
			"/assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js",
			"/assets/admin/custom/js/bars-dtable.js",
			"/assets/admin/custom/js/bs-modal-loader.js",
			"/assets/default/custom/js/work.js"
      );
		$var = get_redir_logreg();
		$this->template->append_css($css);
		$this->template->append_js($js);

		$industries = $this->Industry_model->getIndustries();
		$budget_filters = $this->Industry_model->getBudgetfilters();
		$active_invites = $this->Invite_model->getActive(auth()->id);
		// $active_post = $this->user_model->getActivePost();
		$active_won_jobs = $this->job_model->jobsWonActive(auth()->id);

		$this->template->load_sub('summary', $this->job_model->getSummary());
		$this->template->load_sub('industries', $industries);
		$this->template->load_sub('budget_filters', $budget_filters);
		$this->template->load_sub('active_bids', $this->proposal_model->activeBids());
		$this->template->load_sub('active_invites', $active_invites);
		$this->template->load_sub('active_won_jobs', $active_won_jobs);

    $_SESSION['dashboard'] = "work";
    $this->template->load('frontend/member/work');
	}

	public function fetchWatchlist(){
		header("Content-Type:application/json");
		$jobsPagination = $this->job_model->allWatch();
		echo json_encode($jobsPagination);
	}

	public function addWishlist($id){
		$data = array(
			"job_id" => $id,
			"expert_id" => auth()->id
		);

		if($this->job_model->addWish($data)){
			json(array(
				'success' => TRUE
			));
		}else{
			json(array(
				'success' => FALSE
			));
		}

	}

	public function removeWishlist($id){
		$data = array(
			"job_id" => $id,
			"expert_id" => auth()->id
		);

		if($this->job_model->removeWish($data)){
			json(array(
				'success' => TRUE
			));
		}else{
			json(array(
				'success' => FALSE
			));
		}

	}

	public function getAllJobsPagination(){
		header("Content-Type:application/json");
		$jobsPagination = $this->job_model->all();
		echo json_encode($jobsPagination);
	}

	public function getAllJobs(){
		header("Content-Type:application/json");
		$jobs = $this->job_model->getAllJobs();
		echo json_encode($jobs);
	}
}
