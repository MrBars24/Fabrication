<?php
class Dashboard_model extends MX_Model{

    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    function getDashboardSummary(){
    	$q = $this->db->get('summary');
    	if($q->num_rows() > 0){
    		return $q->row();
    	}

    	return [];
    }

    function getRecentJobs(){
    	$this->db->order_by("created_at","DESC");
    	$this->db->limit(10);
    	$q = $this->db->get('jobs');

    	if($q->num_rows() > 0){
    		return $q->result();
    	}

    	return [];	
    }

    function getRecentLoggedIn(){
    	$this->db->order_by("last_login","DESC");
    	$this->db->limit(10);
    	$q = $this->db->get('user_details');
		
    	if($q->num_rows() > 0){
    		return $q->result();
    	}

    	return [];	
    }
}
