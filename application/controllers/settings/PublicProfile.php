<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PublicProfile extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->template->set_template("default");
		$js = array(
			"assets/default/custom/js/settings/settings-training.js"
		);
		$this->template->set_additional_js($js);
		$this->load->model('public_model');
		$this->load->model('industry_model');
	}


	public function index(){
		check_user('member');
		$css = array(
			"/assets/plugins/toast-master/css/jquery.toast.css",
			"assets/default/custom/css/public-profile.css",
			"assets/plugins/multiselect/css/multi-select.css",
			"assets/plugins/select2/dist/css/select2.min.css",
			"assets/plugins/bootstrap-select/bootstrap-select.min.css",
			"assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.css",
			"assets/plugins/cropper/cropper.min.css"
		);
		$js = array(
			"assets/default/custom/js/settings/settings.js",
			"assets/plugins/toast-master/js/jquery.toast.js",
			"assets/default/js/toastr.js",
			"assets/plugins/moment/moment.js",
			"assets/default/custom/js/bootstrap-tagsinput.min.js",
			"assets/admin/custom/js/bars-datatable.js",
			"assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js",
			"assets/plugins/bootstrap-select/bootstrap-select.min.js",
			"assets/plugins/select2/dist/js/select2.full.min.js",
			"assets/plugins/switchery/dist/switchery.min.js",
			"assets/plugins/multiselect/js/jquery.multi-select.js",
			"assets/default/custom/js/settings/settings-public.js",
			"assets/plugins/cropper/cropper.min.js"
		);
		$this->template->append_CSS($css);
		$this->template->append_js($js);
		$id = auth()->user_id;
		$industry = $this->industry_model->getIndustries();
		$data = $this->public_model->getPublicProf($id);
		$skills = $this->public_model->getMySkills($id);

		$this->template->load_sub('skills', $skills);
		$this->template->load_sub('industries', $industry);
		$this->template->load_sub('public_details', $data);
		$this->template->load('frontend/settings/public_profile');
	}

	public function updatePublicProfile(){
		$id = auth()->user_id;
		$r = $this->public_model->updatePubProf($id);
			if($r){
				echo json_encode( array(
					'success' => 201
				));
			}
	}
	public function updatePublicIndustry(){
		$id = auth()->user_id;
		$r = $this->public_model->updatePublicIndustry($id);
			if($r){
			echo json_encode( array(
				'success' => 201
			));
		}
	}

	public function avatar() {
		$this->load->model('User_model');
		$this->load->library('Fupload');
		$this->fupload->setFolder('uploads');
		$this->fupload->setAcceptedType(['image/jpeg', 'image/png']);
		$data = $this->fupload->processUpload('file', TRUE);

		$result = $this->User_model->updateAvatar(auth()->id, $data['path']);

		// Update the User Details in Session
		$userdata = $this->session->userdata('user');
		$userdata->user_details->avatar = $data['path'];
		$this->session->set_userdata('user', $userdata);

		if (!$result) {
			return json(array(
				'success' => false
			), 500);
		}

		return json(array(
			'success' => true,
			'data' => array(
				'image' => $data['path'],
				'thumbnail' => $data['thumbnail']
			)
		));
	}

	public function getSkills(){
		$r = $this->public_model->getSkills();
		echo json_encode(array('results'=>$r));
		exit;
		// if($r){
		// }
		// echo json_encode(array(
		// 	'success' => false
		// ));
		// exit;
	}
	public function createSkills(){
		$skills = $this->input->post('skills');
		$checkSkill = $this->public_model->checkSkills($skills);

		if($checkSkill){
			$data = array(
				'user_id' => auth()->id,
				'skills_id' => $checkSkill->id
			);
			$skillsInMember = $this->public_model->createSkillsInMember($data ,$checkSkill->id);
			echo json_encode(array('success'=>True, 'data'=>$checkSkill->title, 'id'=>$skillsInMember));
			exit;
		}else{
			$skill_id = $this->public_model->createSkills($skills);
			$data = array(
				'user_id' => auth()->id,
				'skills_id' => $skill_id
			);
			$skillsInMember = $this->public_model->createSkillsInMember($data, "");
			echo json_encode(array('success'=>True, 'data'=>$skills, 'id'=>$skillsInMember));
			exit;
		}

	}
	public function deleteSkills($id){
		$deleteSkills = $this->public_model->deleteSkills($id);
		if($deleteSkills){
			echo json_encode(array('success'=>true));
			exit;
		}else{
			echo json_encode(array('success'=>false));
			exit;
		}

	}
}
