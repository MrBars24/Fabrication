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

    function fetchInvites(){
        $limit = 5;
        $offset = 0;
        $search = "";
        $id = auth()->id;
        $search_sql = array(
            'job_invitations.user_id'=> $id,
        );
        $q = $this->getIndexDataCount("job_details",$limit,$offset,'job_invitations.created_at','DESC', $search_sql, '', 'job_invitations', 'job_details.id = job_invitations.job_id');
        return $q;

    }
}
