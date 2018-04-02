<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH."controllers/Admin.php"); 
class Jobs extends Admin {

	public function __construct(){
		parent::__construct();
		$this->load->model("admin/cms_model");
		$this->load->model('industry_model');
		$this->load->model("admin/jobs_model");
	}

	public function index()
	{
		$this->template->append_css(array(
			"assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css"
		));

		$this->template->append_js(
			array(
				"/assets/admin/js/mask.js",
				"/assets/plugins/moment/moment.js",
				"/assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js",
				"/assets/admin/custom/js/bars-datatable.js",
				"/assets/admin/custom/js/jobs.js"
			)
		);

		$industries = $this->industry_model->getIndustries();
		$this->template->load_sub("industries",$industries);
		$this->template->load("frontend/admin/jobs");
	}

	public function fetch(){
		header("Content-Type:application/json");
		$jobs = $this->jobs_model->all();
		echo json_encode($jobs);
	}

	function store(){
		header("Content-Type:application/json");
		$data = array(
			"title" => $this->input->post('title'),
			"fabricator_id" => 12,
			"bidding_type" => $this->input->post('industry'),
			"description" => $this->input->post('desc'),
			"project_start" => $this->input->post('pstart'),
			"project_end" => $this->input->post('pend'),
			"bidding_start_at" => $this->input->post('bstart'),
			"bidding_expire_at" => $this->input->post('bend'),
			"budget_min" => $this->input->post('min_budget'),
			"budget_max" => $this->input->post('max_budget'),
		);

		if($res = $this->jobs_model->save($data)){
			echo json_encode(array("success" => TRUE,"data" => $res));
		}else{
			echo json_encode(array("success" => FALSE));
		}
	}

	function update($id){
		header("Content-Type:application/json");
		$data = array(
			"title" => $this->input->post('title'),
			"fabricator_id" => 12,
			"bidding_type" => $this->input->post('industry'),
			"description" => $this->input->post('desc'),
			"project_start" => $this->input->post('pstart'),
			"project_end" => $this->input->post('pend'),
			"bidding_start_at" => $this->input->post('bstart'),
			"bidding_expire_at" => $this->input->post('bend'),
			"budget_min" => $this->input->post('min_budget'),
			"budget_max" => $this->input->post('max_budget'),
		);

		if($res = $this->jobs_model->update($id,$data)){
			echo json_encode(array("success" => TRUE, "data" => $res));
		}else{
			echo json_encode(array("success" => FALSE));
		}
	}

	function destroy($id){
		header("Content-Type:application/json");
		if($this->jobs_model->destroy($id)){
			echo json_encode(array("success" => TRUE));
		}else{
			echo json_encode(array("success" => FALSE));
		}
	}

}
