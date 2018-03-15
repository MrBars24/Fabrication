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
    function getAttachment($id){
        $query = $this->db->select('*')
                 ->where('job_id', $id)
                 ->get('attachments');
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return FALSE;
        }
    }
    function getBidHistory(){

         $limit = 5;
         $offset = 0;
         $search = "";
         if(isset(auth()->id)){
             $search_sql = array(
                 'expert_id' => auth()->id
             );
         }
         $q = $this->getIndexDataCount("bids",$limit,$offset,'bids.created_at','DESC', $search_sql, '', 'jobs', 'bids.job_id = jobs.id');
         return $q;
    }

    public function getBidsByJobId($job_id){
        $query = $this->db->select('bids.*, member.fullname')
            ->join('bids', 'bids.expert_id = member.id')
            ->where('bids.is_deleted', 0)
            ->where('bids.job_id', $job_id)
            ->get('member');

        if ($query->num_rows() < 1) {
            return array();
        }
        return $query->result();
    }

    public function acceptBid($id,$data){
        $expert_id = $this->db->select('expert_id, job_id')->where('id', $id)->get('bids')->row();
        $this->db->where('id', $id)->update('bids', $data);
        $query = $this->db->set('accepted_bid', $expert_id->expert_id)->set('status','close')->where('id', $expert_id->job_id)->update('jobs');
        return $expert_id->job_id;
    }

    public function checkProposal($job_id, $id){
        $query = $this->db->select('*')
                 ->where('job_id', $job_id)
                 ->where('expert_id', $id)
                 ->get('bids');
        if($query->num_rows() > 0){
            return $query->row();
        }
        return FALSE;
    }

    public function updateBid($job_id, $id, $data){
        $query = $this->db->where('job_id', $job_id)
                 ->where('expert_id', $id)
                 ->update('bids', $data);
        if($query){
            $query1 = $this->db->select('id')
                      ->where('expert_id', $id)
                      ->where('job_id', $job_id)
                      ->get('bids');

                      return $query1->row();
        }
    }

    public function editProposal($id, $data){
        $query = $this->db->where('id', $id)
                ->update('bids', $data);
        return $query;
    }

    public function cancelBid($id, $data){
        $query = $this->db->where('id', $id)
                 ->update('bids', $data);
        return $query;
    }
}
