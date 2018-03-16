<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proposal extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->template->set_template("default");
		$this->load->model('job_model');
		$this->load->model('proposal_model');
		$this->load->model('user_model');
    }
    function submit(){
		header("Content-Type:application/json");

		if(auth()->my_bids >= auth()->max_bid){
			echo json_encode(array(
				'success' => FALSE,
				'error' => 'package'
			));
			exit;
		}
        $data = array(
            'job_id' => $this->input->post('id'),
            'expert_id' => auth()->id,
            'cover_letter' => $this->input->post('cover_letter'),
            'amount' => $this->input->post('budget')
        );

			$checkProposal = $this->proposal_model->checkProposal($this->input->post('id'), auth()->id);
			if($checkProposal){
				$dataUpdate = array(
					'is_deleted' => 0,
					'deleted_at' => "",
					'cover_letter' => $this->input->post('cover_letter'),
					'amount' => $this->input->post('budget')
				);
				$result = $this->proposal_model->updateBid($this->input->post('id'), auth()->id, $dataUpdate);
				$data['user_details'] = auth();
				$this->user_model->updateUserSession();
				if($result){
					echo json_encode(array(
						'success' => TRUE,
						'status' => "updated",
						'data' => $data,
						'id' => $result
					));
					exit;
				}
				echo json_encode(array(
					'success' => FALSE
				));
				exit;
			}

        $submitproposal = $this->proposal_model->submitProposal($data);
		$this->user_model->updateUserSession();
		$data['user_details'] = auth();
        if($submitproposal){
            return json(array(
                'success' => TRUE,
				'status' => "created",
				'data' => $data
            ),200);
        }
        return json(array(
            'success' => FALSE
        ), 400);
    }
	function cancel($id){
		header("Content-Type:application/json");
		$data = array(
			'is_deleted'=> 1,
			'deleted_at'=> date("Y-m-d h:i:sa")
		);
		$result = $this->proposal_model->cancelBid($id, $data);
		if($result){
			echo json_encode(array(
				'success' => TRUE,
				'id' => $id
			));
			exit;
		}
		echo json_encode(array(
			'success' => FALSE
		));
		exit;
	}
	function editProposal($id){
		header("Content-Type:application/json");
		$data = array(
			'cover_letter' => $this->input->post('cover_letter'),
			'amount' => $this->input->post('budget')
		);
		$result = $this->proposal_model->editProposal($id, $data);
		if($result){
			echo json_encode(array(
				'success' => TRUE,
				'data' => $data
			));
			exit;
		}
		echo json_encode(array(
			'success' => FALSE
		));
		exit;
	}
	function accept($id){
		$data = array(
			'status' => 1,
			'accepted_at' => date("Y-m-d h:i:sa")
		);
		$result = $this->proposal_model->acceptBid($id,$data);
		if($result){
			redirect("jobs/$result");
		}
	}
}
