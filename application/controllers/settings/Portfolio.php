<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Portfolio extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->template->set_template("default");
				
		$js = array(
			"assets/default/custom/js/settings/settings-training.js"
		);
		$this->template->set_additional_js($js);
	}

      
	public function index()
	{	$js = array(
			"assets/default/custom/js/settings/settings-portfolio.js",
			"assets/default/js/toastr.js",
			"assets/plugins/toast-master/js/jquery.toast.js"
		);
		$css = array(
			"assets/plugins/toast-master/css/jquery.toast.css" 
		);

		$this->template->append_js($js);
		$this->template->append_css($css);
		$this->load->model('portfolio_model');
		$data = $this->portfolio_model->getAllPortfolio();
		$this->template->load_sub('portfolios', $data);
		$this->template->load('frontend/settings/portfolio');
		
		
	}
	public function showPortfolio($id){	
			$this->load->model('portfolio_model');
			$data = $this->portfolio_model->getPortfolio($id);
			if($data){
				return json(
					array(
						'success' => 200,
						'data' => $data
				),200);
			}
			else{
				return json(
					array(
						'success' => FALSE
					),500);
			}
		}



}
