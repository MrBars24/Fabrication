<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Training extends MX_Controller {
	public function __construct(){
		parent::__construct();
		$this->template->set_template("default");
        $this->load->model("training_model");
	}

	public function index()
	{
		check_user('member');
		$this->template->append_css(array(
			"assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css",
				"assets/admin/custom/js/bars-datatable.css"
		));

		$this->template->append_js(
			array(
				"assets/admin/js/mask.js",
				"assets/plugins/moment/moment.js",
				"assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js",
				"assets/admin/custom/js/bars-datatable.js",		"assets/default/custom/js/settings/settings-training.js"

			)
		);

		$this->template->load("frontend/settings/training");
	}

	public function fetch(){
		header("Content-Type:application/json");
		$trainingList = $this->training_model->all();
		echo json_encode($trainingList);
	}

	function store(){
		 header("Content-Type:application/json");
            $this->form_validation->set_rules('training_name', 'Training Title', 'required');
            $this->form_validation->set_rules('description', 'Description', 'required');
            $this->form_validation->set_rules('date_start', 'Date Start', 'required');
            $this->form_validation->set_rules('date_end', 'Date Finished', 'required');

            if($this->form_validation->run() == FALSE){
                $error = $this->form_validation->error_array(); 
                echo json_encode( array(
                    'success' => FALSE,
                    'errors' => $error
                ));
            }
        else{
            $data = array(
                "training_name" => $this->input->post('training_name'),
                "description" => $this->input->post('description'),
                "date_start" => $this->input->post('date_start'),
                "date_end" => $this->input->post('date_end')
            );

            if($res = $this->training_model->save($data)){
                echo json_encode(array("success" => TRUE,"data" => $res));
            }else{
                echo json_encode(array("success" => FALSE));
            }
	   }
    }

	function update($id){
		header("Content-Type:application/json");
            $this->form_validation->set_rules('training_name', 'Training Title', 'required');
            $this->form_validation->set_rules('description', 'Description', 'required');
            $this->form_validation->set_rules('date_start', 'Date Start', 'required');
            $this->form_validation->set_rules('date_end', 'Date Finished', 'required');

            if($this->form_validation->run() == FALSE){
                $error = $this->form_validation->error_array(); 
                echo json_encode( array(
                    'success' => FALSE,
                    'errors' => $error
                ));
            }
        else{
		$data = array(
                "training_name" => $this->input->post('training_name'),
                "description" => $this->input->post('description'),
                "date_start" => $this->input->post('date_start'),
                "date_end" => $this->input->post('date_end')
            );

		if($res = $this->training_model->update($id,$data)){
			echo json_encode(array("success" => TRUE, "data" => $res));
		}else{
			echo json_encode(array("success" => FALSE));
		}
	}
}

	function destroy($id){
		header("Content-Type:application/json");
		if($this->training_model->destroy($id)){
			echo json_encode(array("success" => TRUE));
		}else{
			echo json_encode(array("success" => FALSE));
		}
	}

}
