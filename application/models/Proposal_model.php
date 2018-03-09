<?php

class Proposal_model extends MX_Model{

    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    function submitProposal($data){
        $query = $this->db->insert('bids', $data);
        return $query;
    }

    function getProposal(){
        // $this->db->where('');
        // $this->db->get('bids');
    }
}
