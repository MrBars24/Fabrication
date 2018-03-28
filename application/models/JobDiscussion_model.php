<?php

class JobDiscussion_model extends MX_Model{

    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    function create($id, $data){
        $this->db->insert('job_discussion', $data);
        $inserted_id = $this->db->insert_id();
        if($inserted_id){
            $this->db->select('*');
            $this->db->where('id', $inserted_id);
            $query = $this->db->get('job_discussion');
            if($query->num_rows() > 0){
                return $query->row();
            }
        }else{
            echo json_encode(array(
                'success' => FALSE,
                'message' => "something went wrong"
            ));
            exit;
        }
    }
    function getMessage($id){
        $limit = 0;
        $offset = 0;
        $search_sql = array(
            'job_id' => $id,
        );
        $q = $this->getIndexDataCount("job_discussion",$limit,$offset,'created_at','ASC', $search_sql);

        for($i=0; $i<count($q['data']); $i++){
            $q['data'][$i]->user_details = "";
            $q['data'][$i]->user_details = $this->getMemberDetails($q['data'][$i]->user_id);
        }
        return $q;
    }

    function getMemberDetails($id){
        $this->db->select('fullname,avatar_thumbnail');
        $this->db->where('user_id', $id);
        $query = $this->db->get('user_details');
        if($query->num_rows() > 0){
            return $query->row();
        }else{
            return array();
        }
    }
}
