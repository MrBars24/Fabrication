<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Browse extends MX_Controller {

	public function __construct(){
		parent::__construct();
        $this->load->model('Industry_model');
        $this->load->model('Country_model');
        $this->load->model('job_model');
		$this->template->set_template("default");
	}
	public function index()
	{
		check_user('member');
        $css = array(
			"/assets/default/custom/css/dashboard.css"
		);
        $js = array(
            "/assets/admin/custom/js/bs-modal-loader.js",
            "/assets/plugins/jstz/dist/jstz.min.js",
            "/assets/plugins/select2/js/select2.min.js",
            "/assets/admin/custom/js/bars-dtable.js",
			"/assets/default/custom/js/exp-reg.js",
            "/assets/plugins/sticky-kit-master/dist/sticky-kit.min.js",
			"/assets/default/custom/js/invite.js",
        );
        $this->template->append_css($css);
        $this->template->append_js($js);

        $industries = $this->Industry_model->getIndustries();
        $countries = $this->Country_model->all();
		$getJobAvailable = $this->job_model->getJobAvailable(auth()->id);
        $this->template->load_sub('jobAvailable', $getJobAvailable);
        $this->template->load_sub('industries', $industries);
        $this->template->load_sub('countries', $countries);
        $this->template->load('frontend/member/browse');
	}
}
