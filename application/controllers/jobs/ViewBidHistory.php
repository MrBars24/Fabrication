<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ViewBidHistory extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->template->set_template("default");
	}

	public function index(){
        $css = array(
			"https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css",
			"assets/default/custom/css/jobs.css"
        );
        $js = array(
					"/assets/admin/custom/js/bars-datatable.js",
					"/assets/default/custom/js/bid-history.js",
          "/assets/plugins/select2/js/select2.min.js",
          "/assets/plugins/moment/moment.js",
          "/assets/default/custom/js/bid-history.js"
        );
        $this->template->append_css($css);
        $this->template->append_js($js);
        $this->template->load('frontend/jobs/view_bid_history');
	}


	public function bidHistoryList(){
		header("Content-Type:application/json");
		$this->load->model('proposal_model');
		$bidHistory = $this->proposal_model->getBidHistory();

		if($bidHistory){
			echo json_encode($bidHistory);
		}
	}

    public function show($id){
        $css = array(
			"https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css",
			"assets/default/css/custom/global.css",
			"assets/default/custom/css/jobs.css"
        );
        $js = array(
            "assets/plugins/select2/js/select2.min.js",
            "assets/default/custom/js/jobs.js",
        );
        $this->template->append_css($css);
        $this->template->append_js($js);
        $this->template->load('frontend/jobs/view_bid');
	}



}
