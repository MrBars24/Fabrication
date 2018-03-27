<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Overview extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('job_model');
		$this->load->model('review_model');
		$this->load->model('user_model');
		$this->template->set_template("default");
	}
	public function index()
	{

	}
    public function submitReviews(){
        $message_review = $this->input->post('message_review');
        $rating = $this->input->post('rating');
        $id = $this->input->post('review_id');
        $data = array(
            'message_review' => $message_review,
            'rating' => $rating,
            'user_id' => auth()->id,
            'review_id' => $id
        );
        $result_data = $this->review_model->createReview($data);
		$user_details = $this->user_model->getUserDetails(auth()->id);
		if($result_data){
            echo json_encode(array(
                'success'=>true,
                'data'=>$result_data,
				'user_details'=>$user_details
            ));
            exit;
        }else{
            echo json_encode(array(
                'success'=>false
            ));
            exit;
        }
    }
	public function removeReviews($id){
		header("Content-Type:application/json");
		$removeDelete = $this->review_model->removeDelete($id);
		if($removeDelete){
			echo json_encode(array(
				'success' => TRUE
			));
		}else{
			echo json_encode(array(
				'succes' => FALSE
			));
		}
	}
	public function getReviews($id){
		header("Content-Type:application/json");
		$review = $this->review_model->getReview($id);
		//dd($review);
		if($review){
			echo json_encode($review);
		}
	}
	public function updateReview($id){
		header("Content-Type:application/json");
		$message_review = $this->input->post('message_review');
        $rating = $this->input->post('rating');
		$data = array(
            'message_review' => $message_review,
            'rating' => $rating,
        );
		$updateReview = $this->review_model->updateReview($id, $data);
		if($updateReview){
			echo json_encode(array(
				'success' => TRUE,
				'data' => $updateReview
			));
			exit;
		}else{
			echo json_encode(array(
				'success' => FALSE
			));
			exit;
		}
	}
}
