<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends MX_Controller {

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
			"assets/plugins/styleswitcher/jQuery.style.switcher.js"
		);
		$this->template->set_additional_css($css);
		$this->template->set_additional_js($js);

	}

	public function index(){
		$css = array(
			"/assets/plugins/toast-master/css/jquery.toast.css",
		);
		$js = array(
			"assets/default/custom/js/settings/settings.js",
			"assets/default/custom/js/settings/settings-account.js",
			"assets/plugins/toast-master/js/jquery.toast.js",
			"assets/default/js/toastr.js"
		);
		$this->template->append_CSS($css);
		$this->template->append_js($js);
		$id = $_SESSION['user']->user_id;
		$this->load->model('User_model');

		$row = $this->User_model->getMemberInfo($id);

		$_SESSION['user']->user_details = $row;
		$this->template->load_sub('user_details', $row);
		$this->template->load('frontend/settings/account');

	}

	public function updateBasic(){
		$this->load->model('User_model');
		$id = $_SESSION['user']->user_id;
		$username = $this->input->post('username');
        $email = $this->input->post('email');
        $firstname = $this->input->post('firstname');
        $lastname = $this->input->post('lastname');
        $phone = $this->input->post('phone');
        $mobile = $this->input->post('mobile');
        $bday = $this->input->post('bday');
		$user = array(
			'username' => $username,
			'email' => $email
		);
		$fab = array(
			'firstname' => $firstname,
			'lastname' => $lastname,
			'phone' => $phone,
			'mobile' => $mobile,
			'bday' => $bday
		);

		$updateUser = $this->User_model->submitUpdateUser($user, $id);
		if($updateUser){
			$updateFabricator = $this->User_model->submitUpdateFabricator($fab, $id);
			if($updateFabricator){
				$row = $this->User_model->getUserInfo($id);
				$row->user_details = $this->User_model->getFabricatorInfo($id);
				$this->session->set_userdata(array('user' => $row));
				echo json_encode(array(
					"success" => 200,
				));
				exit;
			}
			echo json_encode(array(
				"error" => 500,
				"message" => "Error in updating fabricator"
			));
			exit;
		}
			echo json_encode(array(
				"error" => 500,
				"message" => "Error in updating user"
			));
			exit;
	}

	public function addIndustry(){
		$this->load->model('Industry_model');
        $industry = $this->input->post('industry');
        $data = array(
            'categoryable_id' => $id,
			'categoryable_type' => "fabricator",
			'category_id' => $industry
        );

        $r = $this->Industry_model->addIndustry($data);
        if($r){
            echo json_encode(array(
                'success' => 201
            ));
            exit;
        } else {
            echo json_encode(array(
                'error' => 500
            ));
        }
	}


	public function updateLocation(){
		$this->load->model('User_model');
		$id = $_SESSION['user']->user_id;
		$address = $this->input->post('address_id');
		$city = $this->input->post('city_id');
		$state = $this->input->post('state_id');
		$country = $this->input->post('country_id');
		$timezone = $this->input->post('timezone_id');
		$data = array(
			'address' => $address,
			'city' => $city,
			'state' => $state ,
			'country_id' => $country,
			'timezone_id' => $timezone
		);

		$r = $this->User_model->submitUpdateFabricator($data, $id);
		if($r){
			echo json_encode(array(
				'success' => 200,
			));
			exit;
		}
		else{
			echo json_encode(array(
				'error' => 500
			));
			exit;
		}
	}
}
