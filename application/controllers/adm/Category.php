<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH."controllers/Admin.php"); 
class Category  extends Admin {

	public function __construct(){
		parent::__construct();
		$this->load->model("admin/cms_model");
		$this->load->model('industry_model');
		$this->load->model("admin/Category_model");
	}

	public function index()
	{
		$this->template->append_css(array());

		$this->template->append_js(
			array(
				"/assets/admin/js/mask.js",
				"/assets/plugins/moment/moment.js",
				"/assets/admin/custom/js/bars-datatable.js",
				"/assets/admin/custom/js/jobs-category.js"
			)
		);

		$industries = $this->industry_model->getIndustries();
		$this->template->load_sub("industries",$industries);
		$this->template->load("frontend/admin/jobs-category");
	}

	public function fetch(){
		header("Content-Type:application/json");
		$jobs = $this->Category_model->all();
		echo json_encode($jobs);
	}

	function store(){
		header("Content-Type:application/json");
		$data = array(
			"display_name" => $this->input->post('title'),
			"description" => $this->input->post('desc')
		);

		if($res = $this->Category_model->save($data)){
			echo json_encode(array("success" => TRUE,"data" => $res));
		}else{
			echo json_encode(array("success" => FALSE));
		}
	}

	function update($id){
		header("Content-Type:application/json");
		$data = array(
			"display_name" => $this->input->post('title'),
			"description" => $this->input->post('desc')
		);

		if($res = $this->Category_model->update($id,$data)){
			echo json_encode(array("success" => TRUE, "data" => $res));
		}else{
			echo json_encode(array("success" => FALSE));
		}
	}

	function destroy($id){
		header("Content-Type:application/json");
		if($this->Category_model->destroy($id)){
			echo json_encode(array("success" => TRUE));
		}else{
			echo json_encode(array("success" => FALSE));
		}
	}

}
