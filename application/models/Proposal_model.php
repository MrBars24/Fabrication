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
                 ->where('is_deleted', 0)
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
        $query = $this->db->select('bids.*, member.fullname, member.avatar_thumbnail')
            ->join('bids', 'bids.expert_id = member.id')
            ->where('bids.is_deleted', 0)
            ->where('bids.job_id', $job_id)
            ->get('member');

        if ($query->num_rows() < 1) {
            return array();
        }
        return $query->result();
    }

    public function getBidsById($job_id){
        $limit = 5;
         $offset = 0;
         $search = "";
         if(isset(auth()->id)){
         $search_sql = array(
                 'bids.is_deleted' => 0,
                 'bids.job_id' => $job_id
             );

         $q = $this->getIndexDataCount("member",$limit,$offset,'bids.created_at','DESC', $search_sql, '', 'bids', "bids.expert_id = member.id", '', 'bids.*, member.fullname, member.avatar');

         return $q;
    }
}
    public function getBidsByIdsort($job_id, $id2){
        $limit = 5;
         $offset = 0;
         $search = "";

         if(isset($id2) AND $id2 == '1'){
             $orderby = 'bids.created_at';
             $sort = 'DESC';
         }
        if(isset($id2) AND $id2 == '2'){
             $orderby = 'bids.amount';
             $sort = 'ASC';
         }
        if(isset($id2) AND $id2 == '3'){
             $orderby = 'bids.amount';
             $sort = 'DESC';
         }

         if(isset(auth()->id)){
         $search_sql = array(
                 'bids.is_deleted' => 0,
                 'bids.job_id' => $job_id
             );
         }
         $q = $this->getIndexDataCount("member",$limit,$offset,$orderby,$sort, $search_sql, '', 'bids', "bids.expert_id = member.id", '', 'bids.*, member.fullname, member.avatar');

         return $q;
    }


     function getBidAll($id){
         $limit = 5;
         $offset = 0;
         $search = "";
         if(isset(auth()->id)){
             $search_sql = array(
                 'expert_id' => auth()->id
             );
         }
         $q = $this->getIndexDataCount("bids",$limit,$offset,'bids.created_at','DESC', $search_sql, '', 'jobs', "bids.job_id =  $id");
         return $q;
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

    public function activeBids(){
        $q = $this->db->select("*")
            ->from('bids')
            ->join('jobs','bids.job_id=jobs.id')
            ->where('expert_id',auth()->user_id)
            ->order_by('created_at','DESC')
            ->get();

        if($q->num_rows() > 0){
            return $q->result();
        }

        return [];
    }

    public function activeBidsCount(){
        $q = $this->db->select("*")
            ->from('bids')
            ->join('jobs','bids.job_id=jobs.id')
            ->where('expert_id',auth()->user_id)
            ->get();

        return $q->num_rows();
    }

	function getById($id) {
		$res =  $this->db->select('*')
			->where('id', $id)
			->where('is_deleted', 0)
			->get('bids');

		return $res->row();
	}
}
