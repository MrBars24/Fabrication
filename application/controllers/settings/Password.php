<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Password extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->template->set_template("default");
		$this->load->model('user_model');
				
		$js = array(
			//"assets/default/custom/js/settings/settings-training.js"
		);
		$this->template->set_additional_js($js);
	}

      
	public function index()
	{	
		check_user('member');
		$this->template->append_js(array(
			'/assets/default/custom/js/settings/change-password.js'
		));
		$this->template->load('frontend/settings/password');
		
	}

	public function changePassword(){
		$pwd = $this->input->post('pwd');
		$confirm = $this->input->post('cpwd');
		$newpass = $this->input->post('npwd');

		if($newpass != $confirm){
			json(array(
				'status'=>FALSE,
				'message' => 'Password and password confirmation does not match'
                ),400);
        }else {
            $res = $this->user_model->changePassword();
            if ($res) {
                json(array(
                    'status' => TRUE,
                    'message' => 'Password successfully been changed'
                ));
            } else {
                json(array(
                    'status' => FALSE,
                    'message' => 'Password failed to be changed'
                ));
            }
        }

	}



}
