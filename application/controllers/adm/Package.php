<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH."controllers/Admin.php"); 
class Package extends Admin {

	public function __construct(){
		parent::__construct();
		$this->load->model("admin/cms_model");
		$this->load->model("admin/package_model");
	}

	public function index()
	{
		$this->template->append_css(array(
			"assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css"
		));

		$this->template->append_js(
			array(
				"assets/admin/js/mask.js",
				"assets/plugins/moment/moment.js",
				"assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js",
				"assets/admin/custom/js/bars-datatable.js",
				"assets/plugins/toastr/toastr.js",
				"assets/global.js",
				"assets/admin/custom/js/package-settings.js"
			)
		);

		$this->template->load("frontend/admin/package-settings");
	}

	public function fetch(){
		header("Content-Type:application/json");
		$packageSettings = $this->package_model->all();
		echo json_encode($packageSettings);
	}

	public function defaultpackage($id){
		header("Content-Type:application/json");
		$data = array(
			"is_default" => "1"
		);

		if($res = $this->package_model->defaultpackage($id,$data)){
			echo json_encode(array("success" => TRUE, "data" => $res));
		}else{
			echo json_encode(array("success" => FALSE));
		}
	}

	function store(){
		header("Content-Type:application/json");
		$this->form_validation->set_rules('package_name', 'Package Name', 'required');
		$this->form_validation->set_rules('package_include', 'Feature', 'required');
		$this->form_validation->set_rules('package_desc', 'Description', 'required');
		$this->form_validation->set_rules('package_price', 'Price', 'required');
		$this->form_validation->set_rules('bid_number', 'Bid Count', 'required');
		$this->form_validation->set_rules('post_number', 'Post Count', 'required');

		if($this->form_validation->run() == FALSE){
			$error = $this->form_validation->error_array(); 
			echo json_encode( array(
				'success' => FALSE,
				'errors' => $error
			));
		}
		else{
			$data = array(
				"package_name" => $this->input->post('package_name'),
				"package_include" => $this->input->post('package_include'),
				"package_price" => $this->input->post('package_price'),
				"package_desc" => $this->input->post('package_desc'),
				"bid_number" => $this->input->post('bid_number'),
				"post_number" => $this->input->post('post_number')
			);

			if($res = $this->package_model->save($data)){
				echo json_encode(array("success" => TRUE,"data" => $res));
			}else{
				echo json_encode(array("success" => FALSE));
			}
		}
	}

	function update($id){
		header("Content-Type:application/json");
		$this->form_validation->set_rules('package_name', 'Package Name', 'required');
		$this->form_validation->set_rules('package_include', 'Feature', 'required');
		$this->form_validation->set_rules('package_desc', 'Description', 'required');
		$this->form_validation->set_rules('package_price', 'Price', 'required');
		$this->form_validation->set_rules('bid_number', 'Bid Count', 'required');
		$this->form_validation->set_rules('post_number', 'Post Count', 'required');

		if($this->form_validation->run() == FALSE){
			$error = $this->form_validation->error_array(); 
			echo json_encode( array(
				'success' => FALSE,
				'errors' => $error
			));
		}
		else{
		$data = array(
			"package_name" => $this->input->post('package_name'),
			"package_include" => $this->input->post('package_include'),
			"package_price" => $this->input->post('package_price'),
			"package_desc" => $this->input->post('package_desc'),
			"bid_number" => $this->input->post('bid_number'),
			"post_number" => $this->input->post('post_number')
		);

		if($res = $this->package_model->update($id,$data)){
			echo json_encode(array("success" => TRUE, "data" => $res));
		}else{
			echo json_encode(array("success" => FALSE));
		}
	}
}

	function destroy($id){
		header("Content-Type:application/json");
		if($this->package_model->destroy($id)){
			echo json_encode(array("success" => TRUE));
		}else{
			echo json_encode(array("success" => FALSE));
		}
	}

}
