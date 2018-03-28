<?php
function check_login(){
	if(!isset($_SESSION['user'])){
		redirect('/login-register');
	}

	return $_SESSION['user'];
}

function check_user($userType,$redirect = '/login-register'){
	$sess = check_login();
	if($sess->user_type != $userType){
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
