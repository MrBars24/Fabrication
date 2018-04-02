<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ViewJob extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->template->set_template("default");
		$this->load->model('job_model');
        $this->load->model('proposal_model');
	}

	public function show($id){
		$css = array(
			"/assets/default/css/custom/sections.css"
		);
		$js = array(
            "/assets/admin/custom/js/bars-datatable.js",
            "/assets/plugins/moment/moment.js",
			"/assets/default/custom/js/proposal.js",

		);
		$this->template->append_js($js);
		$this->template->append_css($css);
		if(!auth()){
			$this->session->set_userdata('url_redirect', "jobs/$id");
			redirect('login-register', 'refresh');
		}
		$this->load->model('proposal_model');
		$this->load->model('user_model');
		$this->load->model('bid_model');
		$getJob = $this->job_model->getJob($id);

		$fabricatorDetails = $this->user_model->getMemberInfo($getJob->fabricator_id);
		$getBids = $this->proposal_model->getBidsByJobId($getJob->id);
		$getAttachment = $this->proposal_model->getAttachment($getJob->id);
		if($getJob->status == "close"){
			$awardedUser = $this->user_model->getMemberInfo($getJob->accepted_bid);
			$this->template->load_sub('awardedUser', $awardedUser);
		}
		$this->template->load_sub('bids', $getBids);
		$this->template->load_sub('jobdata', $getJob);
		$this->template->load_sub('getAttachment', $getAttachment);
		$this->template->load_sub('fabricatordata', $fabricatorDetails);

		// echo '<pre>';
		// var_dump($awardedUser);
		// echo '</pre>';
		// echo '<pre>';
		// var_dump($getBids[0]->expert_id);
		// echo '</pre>';
		// echo "awdawd";
		// echo '<pre>';
		// var_dump($fabricatorDetails);
		// echo '</pre>';
		// exit;
        $this->template->load('frontend/jobs/view');
	}

    public function proposal($id)
	{
		$css = array(
			"/assets/default/css/custom/global.css",
			"/assets/default/css/custom/sections.css",
            "/assets/default/custom/css/proposal.css",
            "/assets/plugins/dropzone-master/dist/dropzone.css"
		);
		 $js = array(
            "/assets/plugins/select2/js/select2.min.js",
            "/assets/default/custom/js/jobs.js",
             "/assets/plugins/dropzone-master/dist/dropzone.js"
        );
        $this->template->append_css($css);
        $this->template->append_js($js);

        $this->template->load('frontend/jobs/proposal');
	}

    public function bidderfetch($id){

        header("Content-Type:application/json");
        $getJob = $this->job_model->getJob($id);
		$bidderFetch = $this->proposal_model->getBidsById($getJob->id);

        echo json_encode($bidderFetch);
	}

    public function bidderfetchsort($id, $id2){

        header("Content-Type:application/json");
        $getJob = $this->job_model->getJob($id);
		$bidderFetch = $this->proposal_model->getBidsByIdsort($getJob->id, $id2);

        echo json_encode($bidderFetch);
	}

}
