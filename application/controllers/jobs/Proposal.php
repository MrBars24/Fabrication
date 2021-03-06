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
	function finish($id){
		header("Content-Type:application/json");
		$finish = $this->job_model->finishJob($id);
		echo json_encode(array(
			'success' => True
		));
	}
	function submit(){
		header("Content-Type:application/json");
		$amount = $this->input->post('budget');
		$job_id = $this->input->post('id');
		$getJob = $this->job_model->getJobForBid($job_id);
		if($getJob->budget_max < $amount){
			echo json_encode(array(
				'success' => false,
				'error' => 'budget'
			));
			exit;
		}elseif($getJob->budget_min > $amount){
			echo json_encode(array(
				'success' => false,
				'error' => 'budget'
			));
			exit;
		}

		$summary = $this->job_model->getSummary();
		if($summary->my_bids >= $summary->max_bid){
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
			'amount' => $this->input->post('budget'),
			'membership_hash' => auth()->membership_hash
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
					'id' => $result,
					'job' => $getJob
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

			$this->load->library('Notification');
			$this->notification->use('new_bid')->send($this->job_model->getJob($this->input->post('id'))->fabricator_id, $this->input->post('id'));

			return json(array(
				'success' => TRUE,
				'status' => "created",
				'data' => $data,
				'id'=> $submitproposal,
				'job' => $getJob
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

	function decline($id){
		$data = array(
			'declined_at'=> date("Y-m-d h:i:sa")
		);

		$result = $this->proposal_model->declineBid($id, $data);

		if($result) {
			$this->load->library('Notification');
			$this->notification->use('bid_denied')->send($id, array(
					'job_id' => 1
				)
			);
			return json(array(
				'success' => TRUE
			));
		}
		return json(array(
			'success' => FALSE
		));
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
	function accept($id, $job_id){
		$data = array(
			'status' => "1",
			'accepted_at' => date("Y-m-d H:i:sa"),
		);
		$data_job = array(
			"status" => "awarded",
			"awarded_at" => date("Y-m-d H:i:sa"),
		);

		$result = $this->proposal_model->acceptBid($id,$data);
		$job_result = $this->job_model->UpdateJob($job_id, $data_job);
		$proposal = $this->proposal_model->getById($id);
		// $user = $this->user_model->
		$this->load->library('Notification');
		$this->notification->use('bid_accepted')->send($proposal->expert_id, $job_id);
		redirect("jobs/$job_id");
		// if($result){
		// 	echo json_encode(array(
		// 		"success" => true
		// 	));
		// 	exit;
		// }
		// echo json_encode(array(
		// 	"success" => false
		// ));
		// exit;
	}

}
