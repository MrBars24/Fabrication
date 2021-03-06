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
    function myGetReview($id, $review_id){
        $query = $this->db->select('*')
                 ->where('user_id', $id)
                 ->where('review_id',$review_id)
                 ->where('is_deleted', 0)
                 ->get('reviews');
        if($query->num_rows() > 0){
            return $query->row();
        }else{
            return array();
        }
    }
    function updateReview($id, $data){
        $query = $this->db->where('id', $id)
                 ->update('reviews', $data);

        $query1 = $this->db->select('*')
                 ->where('id', $id)
                 ->get('reviews');
        return $query1->row();
    }
    function getReview($id){

        $limit = 5;
        $offset = 0;
        $search = "";
            $search_sql = array(
                'review_id' => $id,
                'is_deleted' => 0,
             );
        $q = $this->getIndexDataCount("reviews",$limit,$offset,'created_at','DESC', $search_sql);

        $reviews = $q;
        for($i=0; $i<count($reviews['data']);$i++){
            $reviews['data'][$i]->user_review = "";
            $reviews['data'][$i]->user_details = "";
            if($reviews['data'][$i]->review_id == auth()->id){
                $reviews['data'][$i]->user_review = $this->checkMyReview($reviews['data'][$i]->user_id);
            }
            $reviews['data'][$i]->user_details = $this->getMemberInfo($reviews['data'][$i]->user_id);
        }
        return $reviews;

    }

    function checkMyReview($id){
        $query = $this->db->select('*')
                 ->where('user_id', $id)
                 ->where('review_id', auth()->id)
                 ->where('is_deleted', 0)
                 ->get('reviews');
        if($query->num_rows() > 0){
            return $query->row();
        }else{
            return array();
        }
    }
    function removeDelete($id){
        $query = $this->db->where('id', $id)
                 ->set('is_deleted', 1)
                 ->update('reviews');
        return $query;
    }
    function getMemberInfo($id){
        $query = $this->db->select('fullname,avatar_thumbnail')
                 ->where('user_id', $id)
                 ->get('user_details');

        if($query->num_rows() > 0){
            return $query->row();
        }else{
            return array();
        }
    }
}
