<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proposal extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->template->set_template("default");
		$this->load->model('job_model');
    }
    function submit(){
        $this->load->model('proposal_model');
        $data = array(
            'job_id' => $this->input->post('id'),
            'expert_id' => $_SESSION['user']->id,
            'cover_letter' => $this->input->post('cover_letter'),
            'amount' => $this->input->post('budget')
        );
        $submitproposal = $this->proposal_model->submitProposal($data);
        if($submitproposal){
            return json(array(
                'success' => TRUE,
            ),200);
        }
        return json(array(
            'success' => FALSE
        ), 400);
    }
}
