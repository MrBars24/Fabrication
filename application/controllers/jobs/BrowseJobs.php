<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BrowseJobs extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->template->set_template("default");
	}

	public function index(){
        $css = array(
			"https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css",
			"assets/default/css/custom/global.css",
			"assets/default/custom/css/jobs.css"
        );
        $js = array(
            "/assets/plugins/select2/js/select2.min.js",
            "/assets/default/custom/js/jobs.js",
			"/assets/plugins/jquery-ellipse/jquery.ellipsis.min.js",
			"/assets/admin/custom/js/bars-dtable.js"
        );
        $this->template->append_css($css);
		$this->template->append_js($js);
		$this->load->model('Industry_model');
		$industries = $this->Industry_model->getIndustries();
		$budget_filters = $this->Industry_model->getBudgetfilters();
		$this->template->load_sub('industries', $industries);
		$this->template->load_sub('budget_filters', $budget_filters);
		$this->template->load('frontend/jobs/browse');
	}

	public function getAllJobsPagination(){
		header("Content-Type:application/json");
		$this->load->model('job_model');
		$this->load->model('user_model');
		$jobsPagination = $this->job_model->all();
		if($jobsPagination){
			echo json_encode($jobsPagination);
		}

	}

	public function getAllJobs(){
		header("Content-Type:application/json");
		$this->load->model('job_model');
		$jobs = $this->job_model->getAllJobs();
		return json(array(
			'data'=>$jobs
		),200);
	}

	public function postedJob($status = null) {
		$css = array(
			"https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css",
			"assets/default/css/custom/global.css",
			"assets/default/custom/css/jobs.css"
		);
		$js = array(
			"/assets/plugins/select2/js/select2.min.js",
			"/assets/default/custom/js/myjobs.js",
			"/assets/admin/custom/js/bars-datatable.js"
		);
		$this->template->append_css($css);
		$this->template->append_js($js);
		$this->load->model('job_model');
		if($status == 'active'){
			$myjob = $this->job_model->allOpen(TRUE);
		}else{
			$myjob = $this->job_model->getMyJobs();
		}
		$this->template->load_sub('jobs', $myjob);
		$this->template->load('frontend/jobs/posted_jobs');
	}

		public function postedJobView($id) {
        $css = array(
			"assets/default/css/custom/global.css",
			"assets/plugins/dropzone-master/dist/dropzone.css",
			"assets/default/custom/css/jobs.css",
			"assets/admin/colors/blue.css",
			"assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css",
			"assets/plugins/dropify/dist/css/dropify.min.css",
        );
        $js = array(
			"/assets/plugins/dropzone-master/dist/dropzone.js",
			"/assets/default/custom/js/update-job.js",
			"/assets/plugins/moment/moment.js",
            "/assets/admin/custom/js/bars-datatable.js",
            "/assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js",
            "/assets/admin/js/mask.js",
			"/assets/default/custom/js/proposal.js"
        );
        $this->template->append_css($css);
		$this->template->append_js($js);
		$this->load->model('job_model');
		$this->load->model('proposal_model');
		$this->load->model('user_model');
		$this->load->model('industry_model');
		$job = $this->job_model->getJob($id);
		$bid = $this->proposal_model->getBidsByJobId($id);
		$getAttachment = $this->proposal_model->getAttachment($job->id);
		$this->template->load_Sub('getAttachment', $getAttachment);
		if($job->status == "awarded"){
			$awardedUser = $this->user_model->getMemberInfo($job->accepted_bid);
			$awardedUser->bid = $this->proposal_model->getBidsByJobId($id);

			$this->template->load_sub('awardedUser', $awardedUser);
		}
		$industries = $this->industry_model->getIndustries();
		$this->template->load_Sub('job', $job);
		$this->template->load_Sub('bid', $bid);

		$this->template->load('frontend/jobs/posted_job_view');
	}

    public function hiredWorker() {
        $css = array(
			"https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css",
			"assets/default/css/custom/global.css",
			"assets/default/custom/css/jobs.css"
        );
        $js = array(
            "/assets/plugins/select2/js/select2.min.js",
            "/assets/default/custom/js/jobs.js",
        );
        $this->template->append_css($css);
		$this->template->append_js($js);

		$this->template->load('frontend/jobs/view_hired');
	}

	public function recentJobsByCategory() {
		$this->load->model('job_model');
		$jobsPagination = $this->job_model->all();
		return json($jobsPagination);
	}

}
