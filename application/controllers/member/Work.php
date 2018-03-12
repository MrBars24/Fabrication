<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Work extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('job_model');
		$this->template->set_template("default");
	}
	public function index()
	{
        $css = array(
			"/assets/default/css/custom/sections.css",
			"/assets/default/custom/css/dashboard.css"
		);

        $js = array(
        	"assets/plugins/jstz/dist/jstz.min.js",
            "assets/plugins/moment/moment.js",
            "assets/plugins/select2/js/select2.min.js",
			"assets/admin/custom/js/bars-datatable.js",
            "assets/default/custom/js/work.js"
        );
		$var = get_redir_logreg();
		$this->template->append_css($css);
		$this->template->append_js($js);
        $_SESSION['dashboard'] = "hire";
        $this->template->load('frontend/member/work');
	}

	public function fetchWatchlist(){
		header("Content-Type:application/json");
		$jobsPagination = $this->job_model->allWatch();
		echo json_encode($jobsPagination);
	}

	public function addWishlist($id){
		$data = array(
			"job_id" => $id,
			"expert_id" => auth()->id
		);

		if($this->job_model->addWish($data)){
			json(array(
				'success' => TRUE
			));
		}else{
			json(array(
				'success' => FALSE
			));
		}

	}

	public function removeWishlist($id){
		$data = array(
			"job_id" => $id,
			"expert_id" => auth()->id
		);

		if($this->job_model->removeWish($data)){
			json(array(
				'success' => TRUE
			));
		}else{
			json(array(
				'success' => FALSE
			));
		}

	}

	public function getAllJobsPagination(){
		header("Content-Type:application/json");
		$jobsPagination = $this->job_model->all();
		echo json_encode($jobsPagination);
	}

	public function getAllJobs(){
		header("Content-Type:application/json");
		$jobs = $this->job_model->getAllJobs();
		return json(array(
			'data'=>$jobs
		),200);
	}
}
