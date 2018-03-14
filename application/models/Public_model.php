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
}
