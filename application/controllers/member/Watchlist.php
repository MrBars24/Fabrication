<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Watchlist extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->template->set_template("default");
		$this->load->model('job_model');
	}

	public function index()
	{
		check_user('member');
        $css = array(
			"https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css",
			"assets/default/custom/css/jobs.css"
        );

        $js = array(
        	"/assets/admin/custom/js/bars-datatable.js",
            "/assets/default/custom/js/watchlist.js",
            "/assets/plugins/select2/js/select2.min.js"
        );

        $this->template->append_css($css);
        $this->template->append_js($js);
		$this->template->load("watch_list"); 
	}
}