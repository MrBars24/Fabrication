<?php
class Bid_model extends CI_Model{

    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function getBidsByJobId($job_id) {
        header("Content-Type:application/json");
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
