<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UpdatePortfolio extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->template->set_template("default");
    }

	public function updatePort($id){
		$this->load->model('portfolio_model');
		$r = $this->portfolio_model->updatePort($id);
		if($r){
			echo json_encode( array(
				'success' => 201
			));
		}
		// $this->load->library('upload', $config);
        // $config['upload_path']          = './uploads/attached/';
        // $config['allowed_types']        = '*';
        // $config['max_size']             = 100;
	    // $config['max_width']            = 1024;
	    // $config['max_height']           = 768;
		// if(!$this->upload->do_upload('userfile')){
		// 	echo json_encode(array(
		// 		'success' => false,
		// 		'error' => $this->upload->display_errors()
		// 	));
		// }
		// else{
		// }
	}


}
