<?php
function get_current_endpoint(){
	$tmp = parse_url($_SERVER['REQUEST_URI']);
	$url = substr($tmp['path'],1);
	return $url;
}

function get_referer_endpoint(){
	$tmp = parse_url($_SERVER['HTTP_REFERER']);
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

function get_redir_logreg(){
	if(isset($_SESSION['url_redirect'])){
		redirect($_SESSION["url_redirect"]);
	}
}

function date_new_format($date, $format="F j, Y"){
	$new_date = date($format, strtotime($date));
	return $new_date;
}

function time_new_format($date){
	$start_date = new DateTime($date);

	$since_start = $start_date->diff(new DateTime(date("Y-m-d h:i:s")));

	if($since_start->y != 0){
		return $since_start->y . " years" . $since_start->m . " months" . $since_start->d . " days " . $since_start->h . "hours and " . $since_start->i . "minutes ago";
	}
	elseif ($since_start->m != 0) {
		return $since_start->m . "months" . $since_start->d . " days " . $since_start->h . " hours and " . $since_start->i . " minutes ago ";
	}
	elseif ($since_start->d != 0) {
		return $since_start->d . " days " . $since_start->h . " hours and " . $since_start->i . " minutes ago ";
	}
	elseif ($since_start->h != 0) {
		return $since_start->h . " hours and " . $since_start->i . " minutes ago";
	}
	elseif ($since_start->i != 0) {
		return $since_start->i . " minutes ago ";
	}
	else{
		return $since_start->s . " seconds ago ";
	}
}
