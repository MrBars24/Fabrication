<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->template->set_template("default");
		$this->load->model("user_model");

		$css = array(
			"assets/plugins/bootstrap/css/bootstrap.min.css",
			"assets/default/css/style.css",
			"assets/default/css/colors/blue.css",
		);

		$this->template->set_additional_css($css);
	}

	public function index()
	{
		$css = array(
			"assets/default/css/custom/global.css",
			"assets/default/css/custom/sections.css"
		);
		if(isset($_SESSION['fabricators'])){
			unset($_SESSION['fabricators']);
		}
		$this->template->append_css($css);
		$this->template->load("home");

		//$this->template->load("registrar/test");
		//$this->isLoggedIn();
	}
	public function indexFabricators(){
		$css = array(
			"assets/default/css/custom/global.css",
			"assets/default/css/custom/sections.css"
		);
		$this->template->append_css($css);
		$this->session->set_userdata('fabricators', 'fabricators');
		$this->template->load("home_fabricators");
	}
	public function login(){
		//$this->template->set_template("default","login");
		$js = array(

		);
		$this->template->append_js($js);
		$this->load->helper('form');
		$this->template->load("login");
	}
	public function register(){
		$this->template->load("register");
	}
	public function registerFabricator(){
		$this->template->load("register_fabricator");
	}
	public function registerDetailer(){
		$this->template->load("register_detailer");
	}
	function logout(){
		session_destroy();
		redirect('/');
	}

	function loginCheck(){
		header("Content-Type:application/json");
		$this->load->model('User_model');
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('pwd', 'Password', 'required');

		if($this->form_validation->run() == FALSE){
			$errors = $this->form_validation->error_array();
			echo json_encode(array(
				"success" => FALSE,
				"errors" => $errors
			));
			exit;
		}
		else{
			$username = $this->input->post('username');
			$checkEmail = $this->User_model->checkEmail($username);
				if($checkEmail == FALSE){
					return json(array(
						"success"=> false,
						"error" => array(array('name' => "username", 'message' => "Username does not exist"))
					), 401);
					exit;
				}
				else{
					$user = $this->User_model->checkLogin();
					if($user == FALSE){
						return json(array(
							"success"=> false,
							"error" => array(array('name' => "pwd", 'message' => "Password is not correct!"))
						), 401);
						exit;
					}
					else{
						$this->user_model->setLoginStamp($user->id);
						$this->session->set_userdata(array("user"=>$user, 'dashboard'=>'work'));
						return json(array(
							"success" => 200,
							"data" => $user
						));
						exit;
					}
				}
		}
	}

	function change_password(){
		header("Content-Type:application/json");
		$res = $this->user_model->change_pass();
		if($res){
			echo json_encode(array(
				"success"=>true
			));
			exit;
		}else{
			echo json_encode(array(
				"success"=>false
			));
			exit;
		}
	}

	function submitMember(){
		header("Content-Type:application/json");
		$this->load->model('User_model');
		$this->form_validation->set_rules('username', 'username', 'required|min_length[8]');
		$this->form_validation->set_rules('pwd', 'password', 'required|min_length[8]');

		if($this->form_validation->run() == FALSE){
			$errors = $this->form_validation->error_array();
			echo json_encode(array(
				"success" => FALSE,
				"errors" => $errors
			));
			exit;
		}
		else{
			$this->load->model('admin/package_model');
			$package = $this->package_model->getDefault();
			$firstname = $this->input->post("firstname");
			$lastname = $this->input->post("lastname");
			$dataSubmitMember = array(
				"account_type" => $package->id,
				"fullname" => "$firstname" . " " . "$lastname",
			);
			$id = $this->user_model->submitMember($dataSubmitMember);

			if($id){
				$pwd = hash_hmac("sha1", $this->input->post('pwd'), "e-fab");
				$dataSubmitUser = array(
					"user_type" => "member",
					"firstname" => $this->input->post("firstname"),
					"lastname" => $this->input->post("lastname"),
					"username" => $this->input->post("username"),
					"email" => $this->input->post("email"),
					"user_id" => $id,
					"password" => $pwd
				);

				if($this->user_model->submitUser($dataSubmitUser)){
					$row = $this->User_model->getUserInfo($id);
					$row->user_details = $this->User_model->getMemberInfo($id);

					$this->session->set_userdata(array('user' => $row));

					echo json_encode(array(
						"success" => TRUE
					));
					exit;
				}
			}

			echo json_encode(array(
				"success" => FALSE
			));
			exit;
		}
	}

	function pageNotFound(){
		$this->load->model('admin/cms_model');
    	$current_end = get_current_endpoint();
    	$page = $this->cms_model->getPageContent($current_end);
    	if(!empty($page) > 0){
	    	$this->template->load($page->content,TRUE);
	    }else{
	    	$this->template->load_sub("error",TRUE);
	    	$this->template->load('errors/html/error');
	    }
	}


}
