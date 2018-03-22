<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Overview extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('job_model');
		$this->load->model('review_model');
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
        if($result_data){
            echo json_encode(array(
                'success'=>true,
                'data'=>$result_data
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
