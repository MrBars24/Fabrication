<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BrowseJobs extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->template->set_template("default");
		$css = array(
			"/assets/plugins/bootstrap/css/bootstrap.min.css",
			"/assets/default/css/style.css",
			"/assets/default/css/colors/blue.css"
		);

		$js = array(
			"assets/plugins/jquery/jquery.min.js",
			"assets/plugins/bootstrap/js/popper.min.js",
			"assets/plugins/bootstrap/js/bootstrap.min.js",
			"assets/default/js/jquery.slimscroll.js",
			"assets/default/js/waves.js",
			"assets/default/js/sidebarmenu.js",
			"assets/plugins/sticky-kit-master/dist/sticky-kit.min.js",
			"assets/plugins/sparkline/jquery.sparkline.min.js",
			"assets/default/js/custom.min.js",
			"assets/plugins/styleswitcher/jQuery.style.switcher.js"
		);
		$this->template->set_additional_css($css);
		$this->template->set_additional_js($js);
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
		// echo json_encode(array(
		// 	'jobs' => $jobs,
		// 	'industries' => $industries
		// ));
		// exit;

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
		$this->template->load('frontend/jobs/posted_jobs');
	}

	public function postedJobView() {
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
