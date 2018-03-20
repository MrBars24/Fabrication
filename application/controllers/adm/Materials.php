<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH."controllers/Admin.php"); 
class Materials extends Admin {

	public function __construct(){
		parent::__construct();
		$this->load->model("admin/cms_model");
		$this->load->model("admin/materials_model");
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
				"assets/admin/custom/js/materials-list.js"

			)
		);
		$this->template->load("frontend/admin/materials-list");
	}

	public function fetch(){
		header("Content-Type:application/json");
		$materialsList = $this->materials_model->all();
		echo json_encode($materialsList);
	}

	function store(){
		header("Content-Type:application/json");
            $this->form_validation->set_rules('material_name', 'Material Name', 'required');

            if($this->form_validation->run() == FALSE){
                $error = $this->form_validation->error_array(); 
                echo json_encode( array(
                    'success' => FALSE,
                    'errors' => $error
                ));
            }
            else{
		$data = array(
			"material_name" => $this->input->post('material_name'),
			"added_by" => $this->session->user->username
		);

		if($res = $this->materials_model->save($data)){
			echo json_encode(array("success" => TRUE,"data" => $res));
		}else{
			echo json_encode(array("success" => FALSE));
		}
	}
}

	function update($id){
		header("Content-Type:application/json");
            $this->form_validation->set_rules('material_name', 'Material Name', 'required');

            if($this->form_validation->run() == FALSE){
                $error = $this->form_validation->error_array(); 
                echo json_encode( array(
                    'success' => FALSE,
                    'errors' => $error
                ));
            }
            else{
		$data = array(
			"material_name" => $this->input->post('material_name'),
			"added_by" => $this->session->user->username
		);

		if($res = $this->materials_model->update($id,$data)){
			echo json_encode(array("success" => TRUE, "data" => $res));
		}else{
			echo json_encode(array("success" => FALSE));
		}
	}
}

	function destroy($id){
		header("Content-Type:application/json");
		if($this->materials_model->destroy($id)){
			echo json_encode(array("success" => TRUE));
		}else{
			echo json_encode(array("success" => FALSE));
		}
	}

}
