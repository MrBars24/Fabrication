<?php
function check_login(){
	if(!isset($_SESSION['user'])){
		if (is_ajax()) {
			$CI = &get_instance();
	
			$CI->output->set_content_type('application/json')
				->set_status_header(401);

			echo json_encode(array(
				"message"=>"Access Forbidden"
			));
			exit;
		}
		redirect('/login-register');
	}

	return $_SESSION['user'];
}

function check_user($userType,$redirect = '/login-register'){
	$sess = check_login();
	if($sess->user_type != $userType){
		if (is_ajax()) {
			$CI = &get_instance();
	
			$CI->output->set_content_type('application/json')
				->set_status_header(401);

			echo json_encode(array(
				"message"=>"Access Forbidden"
			));
			exit;
		}
		redirect($redirect);
	}
}

function auth(){
	if(isset($_SESSION['user'])){
		return $_SESSION['user'];
	}

	return [];
}
function avatar(){
	if(auth()->user_details->avatar == ''){
		return base_url() . 'assets/images/icon_profile.jpg';
	}
	return auth()->user_details->avatar;
}
function newNotificationCount() {
	$CI = get_instance();
	$CI->load->model('Notification_model');
	return $CI->Notification_model->getNewCount(auth()->id);
}
