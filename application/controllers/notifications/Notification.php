<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->template->set_template("default");
	}

	public function index(){

        $css = array(
			"assets/default/custom/css/jobs.css",
		);
		$js = array(
			"assets/admin/custom/js/bars-datatable.js"
		);
		
        $this->template->append_css($css);
        $this->template->append_js($js);
		$this->template->load_sub('additional_data', array('bodyClass' => 'page-notification'));
        $this->template->load('frontend/notifications/view_all');
	}



}
