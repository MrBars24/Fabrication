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

    public function getBidsByJobId($job_id){
        $query = $this->db->select('bids.*, member.id, member.fullname')
            ->join('bids', 'bids.expert_id = member.id')
            ->where('bids.is_deleted', 0)
            ->where('bids.job_id', $job_id)
            ->get('member');

        if ($query->num_rows() < 1) {
            return array();
        }
        return $query->result();
    }


}
