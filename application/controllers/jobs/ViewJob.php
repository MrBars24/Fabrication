<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ViewJob extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->template->set_template("default");
		$this->load->model('job_model');
	}

	public function show($id){
		$css = array(
			"/assets/default/css/custom/sections.css"
		);
		$js = array(
			"/assets/default/custom/js/proposal.js"
		);
		$this->template->append_js($js);
		$this->template->append_css($css);

		$this->load->model('job_model');
		$this->load->model('user_model');
		$this->load->model('bid_model');
		$getJob = $this->job_model->getJob($id);
		$fabricatorDetails = $this->user_model->getMemberInfo($getJob->fabricator_id);
		$getBids = $this->bid_model->getBidsByJobId($getJob->id);
		$this->template->load_sub('bids', $getBids);
		$this->template->load_sub('jobdata', $getJob);
		$this->template->load_sub('fabricatordata', $fabricatorDetails);

		// echo '<pre>';
		// var_dump($getBids);
		// echo '</pre>';
		// echo '<pre>';
		// var_dump($getJob);
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



}
