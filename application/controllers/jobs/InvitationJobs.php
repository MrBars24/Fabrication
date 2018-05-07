<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class InvitationJobs extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->template->set_template("default");
	    $this->load->model('invite_model');
	}

	public function index(){
        $css = array(
            "https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css",
            "assets/default/custom/css/jobs.css"
        );
        $js = array(
            "/assets/plugins/select2/js/select2.min.js",
						"/assets/admin/custom/js/bars-datatable.js",
            "/assets/plugins/moment/moment.js",
            "/assets/default/custom/js/invite.js",
            "/assets/admin/custom/js/bs-modal-loader.js"
        );

        $this->template->append_css($css);
        $this->template->append_js($js);
        $this->template->load('frontend/jobs/invitation');
	}
	public function inviteMember($id){

		check_user('member');
      	header("Content-Type:application/json");
		$job_id = $this->input->post('job_id');
		$message = $this->input->post('message');
      	$data = array(
          	'message' => $message,
      		'job_id' => $job_id,
      		'user_id' => $id
      	);
		$checkInvite = $this->invite_model->checkInvite($id, $job_id);
		if($checkInvite){
			echo json_encode(array(
				'success' => FALSE,
				'error' => "job"
			));
			exit;
		}else{
			$result = $this->invite_model->invite($id, $data);
			if($result){
			$this->load->library('Notification');
				$this->notification->use('new_job_invite')->send($id, array(
					'job_id' => $this->input->post('job_id')
				)
				);
				echo json_encode(array(
					'success' => TRUE
				));
				exit;
			}
			else{
				echo json_encode(array(
					'success' => FALSE,
					'error' => "create"
				));
				exit;
			}
		}
  	}

	public function getAllInvites(){
		check_user('member');
		$fetchInvites = $this->invite_model->fetchInvites();
		return json($fetchInvites);
	}

	public function sendEmailInvitation(){
		$emails = explode(',',$this->input->post('emails'));
		$template = $this->load->view('email_templates/job_invitation',NULL,TRUE);

		$template = str_replace('[url]',$this->input->post('url'),$template);
		$template = str_replace('[user]',auth()->user_details->fullname,$template);
		$template = str_replace('[message]',$this->input->post('message'),$template);

		foreach($emails as $e){
			send_mail('EFAB Job Invitation',$e,$template);
		}

		json(array(
			'success' => TRUE
		));
	}
}
