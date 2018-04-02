<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH."controllers/Admin.php"); 
class User extends Admin {

	public function __construct(){
		parent::__construct();
		$this->load->model("admin/cms_model");
		$this->load->model("admin/user_model");
	}

	public function index()
	{
		$this->template->append_js(
			array(
				"/assets/admin/custom/js/bars-datatable.js",
				"/assets/admin/custom/js/users.js"
			)
		);

		$this->template->load("frontend/admin/users");
	}

	public function getUsers(){
		header("Content-Type:application/json");
		$users = $this->cms_model->getUserList();
		echo json_encode($users);
	}

	function edit($id){
		$data = $this->user_model->find($id);
		
		$this->template->append_js(
			array(
				"assets/admin/custom/js/bars-datatable.js",
				"assets/admin/custom/js/users.js"
			)
		);

		$this->template->load_sub("user",$data);
		$this->template->load("frontend/admin/users-edit");
	}

	function update($id){
		header("Content-Type:application/json");
		$data = array(
			"firstname" => $this->input->post('firstname'),
			"middlename" => $this->input->post('middlename'),
			"lastname" => $this->input->post('lastname'),
			"email" => $this->input->post('email'),
			"is_active" => isset($_POST['is_active']) ? 1 : 0
		);

		if(($_POST['pwd'] == $_POST['cpwd']) && !empty($_POST['pwd']) && !empty($_POST['pwd'])){
			$data['password'] = hash_hmac("sha1", $this->input->post('pwd'), "e-fab");
		}

		if($this->user_model->update($id,$data)){
			echo json_encode(array("success" => TRUE));
		}else{
			echo json_encode(array("success" => FALSE));
		}
	}

	function destroy($id){
		header("Content-Type:application/json");
		if($this->user_model->destroy($id)){
			echo json_encode(array("success" => TRUE));
		}else{
			echo json_encode(array("success" => FALSE));
		}
	}

	function create(){
		$this->template->append_js(
			array(
				"assets/admin/custom/js/bars-datatable.js",
				"assets/admin/custom/js/users.js"
			)
		);

		$this->template->load("frontend/admin/users-create");
	}

	function store(){
		header("Content-Type:application/json");
		$data = array(
			"firstname" => $this->input->post('firstname'),
			"middlename" => $this->input->post('middlename'),
			"lastname" => $this->input->post('lastname'),
			"email" => $this->input->post('email'),
			"is_active" => isset($_POST['is_active']) ? 1 : 0
		);

		if(($_POST['pwd'] == $_POST['cpwd']) && !empty($_POST['pwd']) && !empty($_POST['pwd'])){
			$data['password'] = hash_hmac("sha1", $this->input->post('pwd'), "e-fab"); 
		}else{
			echo json_encode(array("success" => FALSE));
			exit();
		}

		if($this->user_model->save($data)){
			echo json_encode(array("success" => TRUE));
		}else{
			echo json_encode(array("success" => FALSE));
		}
	}
}
