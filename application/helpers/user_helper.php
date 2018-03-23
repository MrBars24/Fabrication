<?php
function check_login(){
	if(!isset($_SESSION['user'])){
		redirect('/login-register');
	}

	return $_SESSION['user'];
}

function check_user($userType){
	$sess = check_login();
	if($sess->user_type != $userType){
		redirect('/login-register');
	}
}

function auth(){
	if(isset($_SESSION['user'])){
		return $_SESSION['user'];
	}

	return [];
}
