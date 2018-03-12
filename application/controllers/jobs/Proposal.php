<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proposal extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->template->set_template("default");
		$this->load->model('job_model');
    }
    function submit(){
		header("Content-Type:application/json");
		$this->load->model('proposal_model');
        $data = array(
            'job_id' => $this->input->post('id'),
            'expert_id' => $_SESSION['user']->id,
            'cover_letter' => $this->input->post('cover_letter'),
            'amount' => $this->input->post('budget')
        );
        $submitproposal = $this->proposal_model->submitProposal($data);
		$data['user_details'] = $_SESSION['user'];
        if($submitproposal){
            return json(array(
                'success' => TRUE,
				'data' => $data
            ),200);
        }
        return json(array(
            'success' => FALSE
        ), 400);
    }
}
