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
function avatar($avatar = ''){
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
function star_review($review){
	$star['overAll'] = 0;
	$star['countOverAll'] = 0;
	$star['oneStar'] = 0;
	$star['twoStar'] = 0;
	$star['threeStar'] = 0;
	$star['fourStar'] = 0;
	$star['fiveStar'] = 0;
	$star['percentageRating'] = 0;
	foreach($review['data'] as $rating){
		$star['overAll'] += $rating->rating;
		$star['countOverAll']++;
		if($rating->rating == 1){
			$star['oneStar'] += 1;
		}
		elseif($rating->rating == 2){
			$star['twoStar'] += 1;
		}
		elseif($rating->rating == 3){
			$star['threeStar'] += 1;
		}
		elseif($rating->rating == 4){
			$star['fourStar'] += 1;
		}
		elseif($rating->rating == 5){
			$star['fiveStar'] += 1;
		}
	}
	if($star['countOverAll'] > 0){
		$star['avarageRating'] = $star['overAll'] / $star['countOverAll'];
		$star['percentageRating'] =  (($star['overAll'] / ($star['countOverAll'] * 5)) * 100 );
	}else{
		$star['avarageRating'] = 0;
		$star['percentageRating'] = 0;
	}

	return $star;
}
function print_image($img){
	if(!empty($img)){
		return $img;
	}
	return base_url() . 'assets/images/icon_profile.jpg';
}
