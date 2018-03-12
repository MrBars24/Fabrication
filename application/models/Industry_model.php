<?php
class Industry_model extends CI_Model{

    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    function getIndustries() {
        $query = $this->db->select('*')
            ->from('project_category')
            ->where('is_deleted', 0)
            ->order_by('display_name', 'ASC')
            ->get();
        
        if($query->num_rows() < 1) {
            return array();
        }
        return $query->result_array();
    }

    function getBudgetfilters() {
        $query = $this->db->select('*')
            ->from('budget_filter')
            ->where('is_deleted', 0)
            ->order_by('min_budget', 'ASC')
            ->get();
        
        if($query->num_rows() < 1) {
            return array();
        }
        return $query->result_array();
    }

    function getJobs() {
        $query = $this->db->select('*')
            ->from('jobs')
            ->where('is_deleted', 0)
            ->order_by('id', 'ASC')
            ->get();
        
        if($query->num_rows() < 1) {
            return array();
        }
        return $query->result_array();
    }

    function getJobs2($id) {
        $query = $this->db->select('*')
            ->from('jobs')
            ->where('is_deleted', 0)
            ->where('id', $id)
            ->order_by('id' , 'ASC')
            ->get();
        
        if($query->num_rows() < 1) {
            return array();
        }
        return $query->row();
    }

    function addIndustry($data){
        if($this->db->insert('categoryables', $data)){
            return TRUE;
        }
        else{
            return FALSE;
        }
    }

}
