<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CloseJobs extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->template->set_template("default");
		$this->load->model('job_model');
	}
	
	
	public function closeJob($id){
		$data = array(
			'status'=>'close'
		);
		$closeBid = $this->job_model->closeBid($id, $data);
		if($closeBid){
			echo json_encode(array(
				'success'=>true,
				'data'=>array('date'=>$closeBid,'formatted_date'=>date("F j, Y",strtotime($closeBid)))
			));
			exit;
		}else{
			echo json_encode(array(
				'success'=>false
			));
			exit;
		}
	}
	
	
}