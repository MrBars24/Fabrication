<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Training extends MX_Controller {

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
			"assets/plugins/styleswitcher/jQuery.style.switcher.js",
			"assets/default/custom/js/settings/settings-training.js"
		);
		$this->template->set_additional_css($css);
		$this->template->set_additional_js($js);

	}

	public function index(){

		$this->template->append_js(
			array(
				"assets/admin/custom/js/training-updeleted.js"
			)
		);


		$this->load->model('training_model');
		$trainings = $this->training_model->getTrainings();
		$this->template->load_sub('trainings', $trainings);

		$this->template->load('frontend/settings/training');

	}

		public function show($id)
	{	
		$css = array(
			"/assets/default/css/custom/global.css",
			"/assets/default/css/custom/sections.css"
		);

		$this->template->append_css($css);
		$this->load->model('training_model');
		$viewtrainings = $this->training_model->getView($id);
		$viewtrainings = $this->training_model->getView($id);
		$this->template->load_sub('viewtrainings', $viewtrainings);

		$this->template->load('frontend/trainings/view');
	}
    
	public function del($id)
	{	

		$this->template->append_js(
			array(
				"assets/admin/custom/js/training-updeleted.js"
			)
		);
		$this->load->model('training_model');
		header("Content-Type:application/json");
		if($this->training_model->delData($id)){
			echo json_encode(array(
				"success" => TRUE
			));
		}else{
			echo json_encode(array(
				"success" => FALSE
			));
		}

	}

	public function createTraining(){
		$this->load->model('training_model');
		$r = $this->training_model->createTraining();

		if($r){
			echo json_encode(array(
				'success'=>TRUE,
				'data' => $r		
			));
		}else{
			echo json_encode(array(
				'success'=>FALSE		
			));
		}
		//$this->template->load('frontend/settings/training');

	}

	public function pageUpdate($id){
		$this->template->append_js(
			array(
				"assets/plugins/tinymce/tinymce.min.js",
				"assets/admin/custom/js/trainings-create.js"
			)
		);
		$page = $this->training_model->getPageById($id);
		$this->template->load_sub("info",$page);
		$this->template->load("frontend/admin/trainings-edit");
	}



	
}
