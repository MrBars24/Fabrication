<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PreviousProject extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->template->set_template("default");
		$this->load->model('Job_model');
	}

	public function index(){
        $js = array(
            "/assets/default/custom/js/jobs-previous.js",
			"/assets/admin/custom/js/bars-datatable.js",
			"/assets/plugins/moment/moment.js"
        );
        $this->template->append_js($js);
        $this->template->load('frontend/jobs/previous_project');
	}

	public function previousProjectsPagination() {
		header("Content-Type:application/json");
		$this->load->model('Job_model');

		$previousProjects = $this->Job_model->previousJobsPaginate(auth()->id);
		return json($previousProjects);
	}

  public function show($id){
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
      $this->template->load('frontend/jobs/view_previous_project');
	}



}
