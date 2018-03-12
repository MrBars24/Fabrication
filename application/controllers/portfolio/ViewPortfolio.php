<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ViewPortfolio extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->template->set_template("default");
		$this->load->model('job_model');
	}

	public function showPortfolio($id){	
		$data = $this->portfolio_model->getPortfolio($id);
	}
    
}    