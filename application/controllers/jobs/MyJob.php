<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MyJob extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->template->set_template("default");
	}

	public function index(){
        check_user('member');
        $js = array(
            "/assets/plugins/select2/js/select2.min.js",
						"/assets/default/custom/js/jobs-won-active.js",
						"/assets/admin/custom/js/bars-datatable.js"
        );
        $this->template->append_js($js);
        $this->template->load('frontend/jobs/my_job');
	}

	public function viewMyJob(){
        check_user('member');
        $css = array(
        "https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css",
        );
        $js = array(
            "/assets/plugins/select2/js/select2.min.js",
            "/assets/default/custom/js/jobs.js",
        );
        $this->template->append_css($css);
        $this->template->append_js($js);
        $this->template->load('frontend/jobs/view_my_job');
	}
	public function wonJobs(){
		header("Content-Type:application/json");
		$this->load->model('job_model');

		$jobsPagination = $this->job_model->jobsWonActivePaginate(auth()->id);

		return json($jobsPagination);
	}
	public function myJobsPagination(){
		header("Content-Type:application/json");
		$this->load->model('job_model');

		$jobsPagination = $this->job_model->myAllJobs();

		return json($jobsPagination);
	}

}
