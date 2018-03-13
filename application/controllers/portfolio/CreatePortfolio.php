<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CreatePortfolio extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->template->set_template("default");
    }

    public function index(){
        $css = array(
            "assets/images/favicon.png",
            "assets/plugins/timepicker/bootstrap-timepicker.min.css",
            "assets/plugins/bootstrap-daterangepicker/daterangepicker.css",
			"assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.css",
			"assets/plugins/dropify/dist/css/dropify.min.css"
        );
        $js = array(
            "assets/plugins/moment/moment.js",
            "assets/plugins/timepicker/bootstrap-timepicker.min.js",
            "assets/plugins/bootstrap-daterangepicker/daterangepicker.js",
            "assets/admin/js/post-job.js",
			"assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js",
			"assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js",
			"assets/plugins/multiselect/js/jquery.multi-select.js",
			"assets/plugins/switchery/dist/switchery.min.js",
			"assets/plugins/select2/dist/js/select2.full.min.js",
			"assets/plugins/bootstrap-select/bootstrap-select.min.js",
			"assets/plugins/styleswitcher/jQuery.style.switcher.js",
			"assets/plugins/dropify/dist/js/dropify.min.js",
			"assets/default/custom/js/create-job.js"
        );
        $this->template->append_css($css);
		$this->template->append_js($js);

		$this->load->model('Industry_model');

		$industries = $this->Industry_model->getIndustries();

		$this->template->load_sub('industries', $industries);
        $this->template->load('frontend/jobs/create_job');
	}

	public function createPort(){
		header("Content-Type:application/json");
		$this->load->model('portfolio_model');

		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');

		if($this->form_validation->run() == FALSE){
			$errors = $this->form_validation->error_array();
			return json(array(
				"success" => FALSE,
				"errors" => $errors
				),401);
			exit;
		}

		$r = $this->portfolio_model->createPort();
		if($r){
			echo json_encode( array(
				'success' => 201,
				'id' => $r
			));
		}
		// $this->load->library('upload', $config);
        // $config['upload_path']          = './uploads/attached/';
        // $config['allowed_types']        = '*';
        // $config['max_size']             = 100;
	    // $config['max_width']            = 1024;
	    // $config['max_height']           = 768;
		// if(!$this->upload->do_upload('userfile')){
		// 	echo json_encode(array(
		// 		'success' => false,
		// 		'error' => $this->upload->display_errors()
		// 	));
		// }
		// else{
		// }
	}


}
