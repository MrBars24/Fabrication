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

        for($i=0; $i < count($q['data']); $i++){
            $q['data'][$i]->category = $this->getCategory($q['data'][$i]->project_category_id);    
        }

        return $q;
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
