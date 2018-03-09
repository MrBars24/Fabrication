<?php
function get_current_endpoint(){
	$tmp = parse_url($_SERVER['REQUEST_URI']);
	$url = substr($tmp['path'],1);
	return $url;
}

function get_nav($user=null){
	$CI =& get_instance();
	if(empty($user) || get_user_type()=="admin"){
		$file = "nav";	
	}else{
		$file = "nav_".$user;
	}
	$CI->load->view('navigation/'.$file);
}

function get_user_type(){
	if(!isset($_SESSION['user'])){
		return FALSE;
	}
	
	$user = $_SESSION['user'];
	return $user->user_type;
}