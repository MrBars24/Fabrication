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
            "assets/plugins/select2/js/select2.min.js",
			"assets/admin/custom/js/bars-datatable.js",
            "/assets/plugins/moment/moment.js",
            "assets/default/custom/js/invite.js"
        );
        $this->template->append_css($css);
        $this->template->append_js($js);
        $this->template->load('frontend/jobs/invitation');
	}
	public function inviteMember($id){
        header("Content-Type:application/json");
        $data = array(
            'message' => $this->input->post('message'),
            'job_id' => $this->input->post('job_id'),
            'user_id' => $id
        );
        $result = $this->invite_model->invite($id, $data);
        if($result){
            echo json_encode(array(
                'success' => TRUE
            ));
            exit;
        }else{
            echo json_encode(array(
                'success' => FALSE
            ));
            exit;
        }
    }

	public function getAllInvites(){
		header("Content-Type:application/json");
		//$fetchInvites = $this->invite_model->fetchInvites($id);
		$fetchInvites = $this->invite_model->fetchInvites();
        //$fetchData = $fetchInvites['data'];
        //$categoryInvites = $this->invite_model->getCategory($fetchData[0]->project_category_id);
		echo json_encode($fetchInvites);
	}
}
