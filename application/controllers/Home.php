<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->template->set_template("default");
		$this->load->model("user_model");

		// $css = array(
		// 	"/assets/plugins/bootstrap/css/bootstrap.min.css",
		// 	"/assets/default/css/style.css",
		// 	"/assets/default/css/colors/blue.css",
		// );
		//
		// $this->template->set_additional_css($css);
	}

	public function index()
	{
		$css = array(
			"/assets/default/css/custom/sections.css"
		);
		$js = array(
			"/assets/default/custom/js/home.js",
			"/assets/admin/custom/js/bars-datatable.js",
			"/assets/admin/custom/js/bs-modal-loader.js",
        );
		$this->template->append_css($css);
		$this->template->append_js($js);

		if(isset($_SESSION['fabricators'])){
			unset($_SESSION['fabricators']);
		}
		if(isset($_SESSION['url_redirect'])){
			$this->session->unset_userdata('url_redirect');
		}
		$this->load->model('Industry_model');
		$this->load->model('portfolio_model');
		$this->load->model('review_model');
		$this->load->model('admin/Dashboard_model');

		// Get Industries / Categories
		$top_industries = $this->Industry_model->getTopIndustries();
		// Get all Industries
		$industries = $this->Industry_model->getIndustries();
		// Get Summary
		$summary = $this->Dashboard_model->getDashboardSummary();
		// Get Last  3 Acitve members
		$client = $this->user_model->getLatestActive();

		$clients = array_map(function($e){
			$e->portpolio_count = $this->portfolio_model->portpolioCount($e->id);
			$review = $this->review_model->getReview($e->id);
			$e->star = star_review($review);
			return $e;
		}, $client);
		$this->template->load_sub('top_industries', $top_industries);
		$this->template->load_sub('top_members', $clients);
		$this->template->load_sub('industries', $industries);
		$this->template->load_sub('summary', $summary);

		$this->template->load("home");
	}
	public function memberVerification(){
		// dd($_SESSION);
		if(isset($_SESSION['email']) && isset($_SESSION['id'])){
			$this->load->library('encryption');
			$msg = $this->load->view('email_templates/reg_confirmation',NULL,TRUE);
			$subject = 'EFAB EMAIL CONFIRMATION';
			$id = $_SESSION['id'];
			$email = $_SESSION['email'];
			$text = $id.':'.$email;
			$ciphertext = $this->encryption->encrypt($text);
			$url = base_url() . 'email/confirmation?q=' . rawurlencode($ciphertext);
			$msg = str_replace("[link]", $url, $msg );
			$res = send_mail($subject,$email,$msg);
			if($res){
				session_destroy();
				redirect('register/verify');
			}else{
				redirect('404_override');
			}
		}else{
			redirect('404_override');
		}
	}
	public function memberVerify(){
		$this->template->load("register_activition");
	}
	public function indexFabricators(){
		$css = array(
			"/assets/default/css/custom/global.css",
			"/assets/default/css/custom/sections.css"
		);
		$this->template->append_css($css);
		$this->session->set_userdata('fabricators', 'fabricators');
		$this->template->load("home_fabricators");
	}
	public function login(){
		$js = array(

		);
		$this->template->append_js($js);
		$this->load->helper('form');
		$this->template->load_sub('bodyClass', 'login-dedicated');
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

	function loginFB(){
		header("Content-Type:application/json");
		$this->load->model('User_model');

		$username = $this->input->post('id');
		$checkEmail = $this->User_model->checkEmail($username);
		if($checkEmail == FALSE){
			return json(array(
				"success"=> false,
				"error" => array(array('name' => "username", 'message' => "Username does not exist"))
			), 401);
			exit;
		}
		else{
			$user = $this->User_model->checkSocialLogin('facebook');
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

	function signupFB(){
		$this->load->model('admin/package_model');
		$package = $this->package_model->getDefault();
		$firstname = $this->input->post("first_name");
		$lastname = $this->input->post("last_name");

		$dataSubmitMember = array(
			"account_type" => $package->id,
			"fullname" => "$firstname" . " " . "$lastname",
			"avatar" => $this->input->post("picture")['data']['url']
		);

		$id = $this->user_model->submitMember($dataSubmitMember);

		if($id){
			$pwd = hash_hmac("sha1", $this->input->post('id'), KEYCODE);
			$dataSubmitUser = array(
				"user_type" => "member",
				"firstname" => $this->input->post("first_name"),
				"lastname" => $this->input->post("last_name"),
				"username" => $this->input->post("id"),
				"email" => $this->input->post("id"),
				"user_id" => $id,
				"password" => $pwd,
				"is_active" => 1,
				"login_type" => 'facebook'
			);

			if($this->user_model->submitUser($dataSubmitUser)){
				$row = $this->user_model->getUserInfo($id);
				$row->user_details = $this->user_model->getMemberInfo($id);

				$this->session->set_userdata(array('user' => $row));
				$this->session->set_userdata(array('dashboard' => 'work'));

				echo json_encode(array(
					"success" => TRUE
				));
				exit;
			}
		}
	}

	public function facebookAuth(){
		$params['app_id'] = "200691950529636";
		$params['app_secret'] = "dddd53ce04119627a1c86dc3e2c2c6e7";
		$this->load->library('facebook',$params);

		redirect($this->facebook->generateLoginUrl());
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
						$activate = $this->User_model->checkActivate($user->email);

						if($activate){
							$this->user_model->setLoginStamp($user->id);
							$this->session->set_userdata(array("user"=>$user, 'dashboard'=>'work'));
							return json(array(
								"success" => 200,
								"data" => $user
							), 200);
							exit;
						}else{
							return json(array(
								"success" => false,
								"error" => array(array("name" => "activate"))
							), 401);
							exit;
						}
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
		$this->load->library('encryption');
		$this->form_validation->set_rules('firstname', 'Firstname', 'required');
		$this->form_validation->set_rules('lastname', 'Lastname', 'required');
		$this->form_validation->set_rules('username', 'Username', 'required|min_length[8]|is_unique[users.username]', array(
			'required'      => 'You have not provided %s.',
		    'is_unique'     => 'User is already taken.'
		));
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]', array(
		    'is_unique'     => 'Email is already taken.',
		));
		$this->form_validation->set_rules('pwd', 'Password', 'required|min_length[8]');
		$this->form_validation->set_rules('terms', 'Terms and Conditions', 'required', array(
			'required' => 'You must agree to our Terms and Conditions'
		));
		$this->form_validation->set_rules('rpwd', 'Password Confirmation', 'required|matches[pwd]');

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
				$pwd = hash_hmac("sha1", $this->input->post('pwd'), KEYCODE);
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

					//$this->session->set_userdata(array('user' => $row));
					$sendEmail = array();
					$sendEmail['email'] = $this->input->post('email');
					$sendEmail['id'] = $id;
					$sendEmail['fullname'] = "$firstname" . " " . "$lastname";

					$this->session->set_userdata($sendEmail);
					//echo $email;

					//var_dump($res);
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

	function googleAuth(){
		$this->load->library('gmail');
		$this->gmail->authenticate();
	}

	function googleAuthCallback(){
		$code = $_GET['code'];
		$this->gmail->authorized_mail($code);
	}

	function googleAuthSignin(){
		$email = $this->input->post('email');
		if($this->user_model->checkAccountExists($email)){
			//do signin
			$this->googleSignIn();
		}else{
			//do sign up
			$this->googleSignUp();
		}
	}

	function googleSignIn(){
		header("Content-Type:application/json");

		$username = $this->input->post('id');
		$checkEmail = $this->user_model->checkEmail($username);
		if($checkEmail == FALSE){
			return json(array(
				"success"=> false,
				"error" => array(array('name' => "username", 'message' => "Username does not exist"))
			), 401);
			exit;
		}
		else{
			$user = $this->user_model->checkSocialLogin('google');
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
					"data" => $user,
					"type" => 'signin'
				));
				exit;
			}
		}
	}

	function googleSignUp(){
		header("Content-Type:application/json");
		$this->load->model('admin/package_model');
		$package = $this->package_model->getDefault();
		$firstname = $this->input->post("firstname");
		$lastname = $this->input->post("lastname");

		$dataSubmitMember = array(
			"account_type" => $package->id,
			"fullname" => $this->input->post('fullname'),
			"avatar" => $this->input->post("img")
		);

		$id = $this->user_model->submitMember($dataSubmitMember);

		if($id){
			$pwd = hash_hmac("sha1", $this->input->post('id'), KEYCODE);
			$dataSubmitUser = array(
				"user_type" => "member",
				"firstname" => $this->input->post("firstname"),
				"lastname" => $this->input->post("lastname"),
				"username" => $this->input->post("id"),
				"email" => $this->input->post("email"),
				"user_id" => $id,
				"password" => $pwd,
				"is_active" => 1,
				"login_type" => 'google'
			);

			if($this->user_model->submitUser($dataSubmitUser)){
				$row = $this->user_model->getUserInfo($id);
				$row->user_details = $this->user_model->getMemberInfo($id);

				$this->session->set_userdata(array('user' => $row));
				$this->session->set_userdata(array('dashboard' => 'work'));

				echo json_encode(array(
					"success" => TRUE,
					"type" => 'signup'
				));
				exit;
			}
		}
	}

	function forgot(){
		$this->template->append_js(array(
			"/assets/default/custom/js/forgot.js"
		));
		$this->template->load("forgot-password");
	}

	function forgotActivate(){
		//$this->load->library('encryption');
		$this->template->append_js(array(
			"/assets/default/custom/js/forgot.js"
		));

		if(!isset($_GET['q'])){
			redirect('404_override');
		}

		//$q = $_GET['q'];
		//echo $this->encryption->decrypt($q);
		//list($id,$email) = explode(':',$this->encryption->decrypt($q));
		//echo $email;
		//exit;
		$this->template->load("reset-password");
	}

	function forgotSend(){
		$this->load->library('encryption');
		$email = $this->input->post('email');
		$exist = $this->user_model->getUser($email);

		if(!empty($exist)){
			$template = $this->load->view('email_templates/reset_pass',NULL,TRUE);

			$txt = $exist->id.':'.$this->input->post("email");

			$ciphertext = $this->encryption->encrypt($txt);


			$url = base_url() . 'forgot-password/activate?q=' . $ciphertext;
			$template = str_replace("[link]",$url,$template);
			send_mail("RESET PASSWORD",$email,$template);

			$this->user_model->addResetToken($exist->id,$ciphertext);

			json(array(
				"success" => TRUE
			));
		}else{
			json(array(
				"success" => FALSE
			));
		}
	}

	function forgotConfirm(){
		$this->load->library('encryption');
		$q = $_POST['q'];
		//echo $q;
		$temp = $this->encryption->decrypt($q);
		list($id,$email) = explode(':',$temp);
		$count = $this->user_model->resetPassword($id,$q);
		if($count >= 1){
			json(array(
				"success" => TRUE
			));
		}else{
			json(array(
				"success" => FALSE
			));
		}
	}

	function confirmation(){
		if(!isset($_GET['q'])){
		  exit;
		}
		$cred = rawurldecode($_GET['q']);
		$this->load->library('encryption');
		$tmp = $this->encryption->decrypt($cred);

		list($id,$email) = explode(":", $tmp);

		$update = $this->user_model->setActive($id,$email);
		if($update){
		  $info = $this->user_model->checkLoginConfirmation($id,$email);
		  $this->user_model->setLoginStamp($info->id);
		  $this->session->set_userdata(array("user"=>$info, 'dashboard'=>'work'));
		  // echo $info->url_redirect;
		  session_destroy();
		  redirect('/login-register');
		}
	  }


}
