<?php

class Review_model extends MX_Model{

    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    function createReview($data){
        $query = $this->db->insert('reviews', $data);
        $id = $this->db->insert_id();
        if($query){
            $this->db->select('*');
            $this->db->where('id', $id);
            $query1 = $this->db->get('reviews');
            if($query1->num_rows() > 0){
                return $query1->row();
            }
            return array();
        }
    }

    function getReview($id){
        $query = $this->db->select('*')
                 ->where('review_id', $id)
                 ->where('is_deleted', 0)
                 ->order_by('created_at', 'DESC')
                 ->get('reviews');
        if($query->num_rows() > 0){
            return $query->result();
        }
        return array();

    }
}
