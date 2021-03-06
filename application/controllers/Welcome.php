<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->template->set_template("default");
		$css = array(
			"assets/plugins/bootstrap-select/bootstrap-select.min.css"
		);

		$this->template->set_additional_css($css);
	}

	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function overview()
	{
		$this->template->load("overview");
	}
	public function aboutTheSite()
	{
		$this->template->load("about_the_site");
	}

	public function whyEfab()
	{
		$this->template->load("why_e_fab");
	}

	public function questionsEfab()
	{
		$this->template->load("questions_e_fab");
	}

	public function aboutUs()
	{
		$this->template->load("about_us");
	}

	public function viewShopDetailer()
	{
		$this->template->load("view_shop_detailers");
	}

	public function Pricing()
	{
		$this->template->load('pricing');
	}

	public function postJob() {
		$css = array(
    		"assets/images/favicon.png",
    		"assets/plugins/timepicker/bootstrap-timepicker.min.css",
    		"assets/plugins/bootstrap-daterangepicker/daterangepicker.css"
		);
		$js = array(
    		"assets/plugins/moment/moment.js",
    		"assets/plugins/timepicker/bootstrap-timepicker.min.js",
    		"assets/plugins/bootstrap-daterangepicker/daterangepicker.js",
			"assets/admin/js/post-job.js"
		);
		$this->template->append_css($css);
		$this->template->append_js($js);
		$this->template->load('post_job');
	}

	public function watchList() {
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
		$this->template->load("watch_list");
	}

	public function about() {
	    $this->template->load("about");
	}

	public function howFabricator() {
		$this->template->load("how_fabricator");
	}

	public function howExpert() {
		$this->template->load("how_expert");
	}
}
