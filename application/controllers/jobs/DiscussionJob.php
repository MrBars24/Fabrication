<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DiscussionJob extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->template->set_template("default");
	    $this->load->model('jobdiscussion_model');
	    $this->load->model('user_model');
	    $this->load->model('job_model');
	}

	public function index($id){
		check_login();
		$css = array(
            "https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css",
			"assets/default/css/custom/global.css",
        );
        $js = array(
			"/assets/default/custom/js/job-discussion.js",
			"/assets/admin/custom/js/bars-datatable.js",
			"/assets/plugins/moment/moment.js",
        );
		$this->template->append_js($js);
		$this->template->append_css($css);

		$getJob = $this->job_model->getJob($id);
		$this->template->load_sub('job', $getJob); 
        $this->template->load('frontend/jobs/job_discussion');
	}
	public function getMessage($id){
        header("Content-Type:application/json");
		$getMessage = $this->jobdiscussion_model->getMessage($id);
		echo json_encode($getMessage);
	}
	public function submit($id){
		$data = array(
			'message' => $this->input->post('message'),
			'user_id' => auth()->id,
			'job_id' => $id,
		);
		$create = $this->jobdiscussion_model->create($id, $data);
		$create->user_details = auth();
		if($create){
			echo json_encode(array(
				'success' => TRUE,
				'data' => $create
			));
			exit;
		}else{
			echo json_encode(array(
				'success' => FALSE,
			));
			exit;
		}
	}
}
