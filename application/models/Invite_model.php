<?php
class Invite_model extends MX_Model{

    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    function invite($id,$data){
        $query = $this->db->insert('job_invitations', $data);
        return $query;
    }
    function checkInvite($id, $job_id){
        $this->db->select('*');
        $this->db->where('user_id', $id);
        $this->db->where('job_id', $job_id);
        $query = $this->db->get('job_invitations');
        if($query->num_rows() > 0){
            return $query->row();
        }
        return [];
    }
    function fetchInvites(){
        $limit = 5;
        $offset = 0;
        $search = "";
        $id = auth()->id;
        $search_sql = array(
            'job_invitations.user_id'=> $id,
        );
        $q = $this->getIndexDataCount("job_details",$limit,$offset,'job_invitations.created_at','DESC', $search_sql, '', 'job_invitations', 'job_details.id = job_invitations.job_id');

        for($i=0; $i < count($q['data']); $i++){
            $q['data'][$i]->category = $this->getCategory($q['data'][$i]->project_category_id);
        }

        return $q;
    }

    function getActive($user_id) {
        $query = $this->db->select('job_invitations.*, jobs.title')
            ->from('job_invitations')
            ->join('jobs', 'jobs.id = job_invitations.job_id')
            ->where('job_invitations.user_id', $user_id)
            ->where('job_invitations.is_deleted', 0)
            ->where('jobs.bidding_expire_at > CURDATE()', NULL, FALSE)
            ->where('jobs.accepted_bid', NULL)
            ->where('jobs.is_deleted', 0)
            ->get();

            if($query->num_rows() > 0){
                return $query->result();
            }
            return array();
    }

    function getCategory($id) {
        $query = $this->db->select('display_name')
            ->where('id', $id)
            ->where('is_deleted', 0)
            ->get('project_category');

        if($query->num_rows() > 0){
            return $query->result();
        }
        return array();
    }
}
