<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BidApi extends MX_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model('Bid_model');
	}

	public function getBidsByJobId($job_id){
        $bids = $this->Bid_model->getBidsByJobId($job_id);

        return json(array(
            'data' => $bids
        ));
    }
}