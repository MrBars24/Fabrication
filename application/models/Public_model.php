<?php
class Public_model extends MX_Model{

    public $table = "users";

    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    function getPublicProf($id){
         $this->db->select('*');
         $this->db->where('id', $id);
         $query = $this->db->get('member');
         if($query->num_rows() > 0){
            return $query->row();
        }
        return array();

    }

    function updatePubProf($id){
    $title = $this->input->post('public-title');
    $keyword = $this->input->post('public-keywords');
    $overview = $this->input->post('public-overview');
    $service = $this->input->post('public-service');

    $data = array(
        'title' => $title,
        'keywords' =>  $keyword,
        'overview' => $overview,
        'service_description' => $service
        );
    $this->db->where('id', $id);
    return $this->db->update('member',$data );
    }

    function updatePublicIndustry($id){
        $industries = $this->input->post('industry[]');
        $data = array(
            'industry' => $industries
        );
        $this->db->where('id', $id);
        return $this->db->update('member' , $data);

    }

    function getSkills(){
        $id = auth()->id;
        $query = $this->db->query("SELECT * FROM skills WHERE id NOT IN (SELECT skills_id FROM skills_member WHERE user_id = $id AND is_deleted = 0)");
        if($query){
            return $query->result();
        }
        return [];
    }

    function getMySkills($id){
        $query = $this->db->select('skills_member.id as smid, skills.id as sid, skills_member.user_id, skills_member.skills_id,skills.title, skills_member.created_at, skills_member.is_deleted')
                 ->from('skills_member')
                 ->where('skills_member.user_id', $id)
                 ->where('skills_member.is_deleted', 0)
                 ->order_by('skills_member.created_at', 'DESC')
                 ->join('skills', 'skills_member.skills_id = skills.id')
                 ->get();
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return array();
        }
    }
    function getUserDetails(){

    }
    function checkSkills($skills){
        $query = $this->db->select('*')
                 ->where('id', $skills)
                 ->get('skills');
        if($query->num_rows() > 0){
            return $query->row();
        }else{
            return [];
        }
    }

    function createSkills($skills){
            $data = array('title'=>$skills);
            $query = $this->db->insert('skills',$data);
            if(!$this->db->insert_id()){
                $error = $this->db->error();
                $error['success'] = FALSE;
                echo json_encode($error);
                exit;
            }
            return $this->db->insert_id();
    }

    function createSkillsInMember($data , $id = ""){

        $query = $this->db->where('id', $id)
                ->insert('skills_member',$data);

        return $this->db->insert_id();
    }
    
    function deleteSkills($id){
        $query = $this->db->where('id', $id)
                 ->set('is_deleted', 1)
                 ->update('skills_member');
        return $query;
    }
}
