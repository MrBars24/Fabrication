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
            "assets/plugins/select2/js/select2.min.js",
            "assets/default/custom/js/jobs.js",
			"assets/admin/custom/js/bars-datatable.js"
        );
        $this->template->append_css($css);
		$this->template->append_js($js);

		$this->load->model('Industry_model');
		$industries = $this->Industry_model->getIndustries();
		$this->template->load_sub('industries', $industries);
		$this->template->load('frontend/jobs/browse');
	}

	public function getAllJobsPagination(){
		header("Content-Type:application/json");
		$this->load->model('job_model');
		$this->load->model('user_model');
		$jobsPagination = $this->job_model->all();
		for($i=0; $i<count($jobsPagination['data']); $i++){
			$jobsPagination['data'][$i]->user_details = $this->user_model->getMemberInfo($jobsPagination['data'][$i]->fabricator_id);
		}
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

	public function postedJob() {
		$css = array(
			"https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css",
			"assets/default/css/custom/global.css",
			"assets/default/custom/css/jobs.css"
		);
		$js = array(
			"assets/plugins/select2/js/select2.min.js",
			"assets/default/custom/js/myjobs.js",
			"assets/admin/custom/js/bars-datatable.js"
		);
		$this->template->append_css($css);
		$this->template->append_js($js);
		$this->load->model('job_model');
		$myjob = $this->job_model->getMyJobs();
		$this->template->load_sub('jobs', $myjob);

		$this->template->load('frontend/jobs/posted_jobs');
	}

	public function postedJobView($id) {
        $css = array(
			"assets/default/css/custom/global.css",
			"assets/default/custom/css/jobs.css",
			"assets/admin/colors/blue.css",
			"assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css"
        );
        $js = array(
			"assets/plugins/moment/moment.js",
            "assets/default/custom/js/jobs.js",
            "assets/admin/custom/js/bars-datatable.js",
            "assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js",
            "assets/admin/js/mask.js"
        );
        $this->template->append_css($css);
		$this->template->append_js($js);
		$this->load->model('job_model');
		$this->load->model('proposal_model');
		$job = $this->job_model->getAllJobInfo($id);
		$bid = $this->proposal_model->getBidsByJobId($id);
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
            "assets/plugins/select2/js/select2.min.js",
            "assets/default/custom/js/jobs.js",
        );
        $this->template->append_css($css);
		$this->template->append_js($js);

		$this->template->load('frontend/jobs/view_hired');
	}

}
