<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hire extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->template->set_template("default");
	}
	public function index()
	{
        $css = array(
			"/assets/default/css/custom/sections.css",
			"/assets/default/custom/css/dashboard.css"
		);

		$js = array(
			"/assets/default/custom/js/hire.js"
		);

        $this->template->append_css($css);
        $this->template->append_js($js);

		$_SESSION['dashboard'] = 'work';
        $this->template->load('frontend/member/hire');
	}
}