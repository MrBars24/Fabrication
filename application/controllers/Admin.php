<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->template->set_template("admin");
		$this->load->model("admin/cms_model");
		$this->load->model("admin/dashboard_model");
		
		$this->template->set_additional_js(array(
			'assets/plugins/pusher/pusher.min.js'
		));
	}

	public function index()
	{
		check_user('admin');

		$sum = $this->dashboard_model->getDashboardSummary();
		$rjobs = $this->dashboard_model->getRecentJobs();
		$ruser = $this->dashboard_model->getRecentLoggedIn();
		
		$this->template->load_sub('summary',$sum);
		$this->template->load_sub('recent_jobs',$rjobs);
		$this->template->load_sub('recent_logged',$ruser);
		$this->template->load("frontend/admin/dashboard");
	}

	public function siteSettings(){
		check_user('admin');
		$config = $this->cms_model->getSettings();

		$this->template->append_js(array(
			'assets/admin/custom/js/site-settings.js'
		));

		$this->template->load_sub("config",$config);
		$this->template->load("frontend/admin/site-settings");
	}

}
