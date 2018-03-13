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
				"assets/admin/custom/js/package-settings.js",
				"assets/plugins/x-editable/dist/bootstrap3-editable/js/bootstrap-editable.js"

			)
		);

		$this->template->load("frontend/admin/package-settings");
	}

	public function fetch(){
		header("Content-Type:application/json");
		$packageSettings = $this->package_model->all();
		echo json_encode($packageSettings);
	}

	function store(){
		header("Content-Type:application/json");

		$data = array(
			"package_name" => $this->input->post('package_name'),
			"package_include" => $this->input->post('package_include'),
			"package_price" => $this->input->post('package_price'),
			"package_desc" => $this->input->post('package_desc')
		);

		if($res = $this->package_model->save($data)){
			echo json_encode(array("success" => TRUE,"data" => $res));
		}else{
			echo json_encode(array("success" => FALSE));
		}
	}

	function update($id){
		header("Content-Type:application/json");
		$data = array(
			"package_name" => $this->input->post('package_name'),
			"package_include" => $this->input->post('package_include'),
			"package_price" => $this->input->post('package_price'),
			"package_desc" => $this->input->post('package_desc')
		);

		if($res = $this->package_model->update($id,$data)){
			echo json_encode(array("success" => TRUE, "data" => $res));
		}else{
			echo json_encode(array("success" => FALSE));
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
