<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class InviteJobs extends MX_Controller {

    public function __construct(){
        parent::__construct();
        $this->template->set_template("default");
        $this->load->model('invite_model');
    }

    public function inviteMember($id){
        header("Content-Type:application/json");

        $data = array(
            'message' => $this->input->post('message'),
            'job_id' => $this->input->post('job_id'),
            'user_id' => $id
        );


        $result = $this->invite_model->invite($id, $data);

        if($result){
          $this->load->library('Notification');
          $this->notification->use('new_job_invite')->send($id, array(
              'job_id' => $this->input->post('job_id')
            )
          );

          echo json_encode(array(
              'success' => TRUE
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
