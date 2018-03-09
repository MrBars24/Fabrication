<?php

class Portfolio_model extends MX_Model{

    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    function createPort(){

        $title = $this->input->post('title');
        $description = $this->input->post('description');
        //$attached = $this->input->file ??

        $data = array(
            'project_name' => $title,
            'description' => $description
        );

        $query = $this->db->insert('portfolios', $data);
        return $this->db->insert_id();
    }

    /**
     *
     *
     * @params $category
     */


    function getAllPortfolio(){

        $query = $this->db->select('*')
        ->from('portfolios')
        ->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }
        else {
            return false;
        }
    }

    function getPortfolio($id){

        $query = $this->db->select('*')
        ->from('portfolios')
        ->where('id',$id)
        ->get();
        if($query->num_rows() > 0){
            return $query->row();
        }
        else {
            return false;
        }
    }

    function updatePort($id){
        $project_name = $this->input->post('projectname');
        $description = $this->input->post('description');

        $data = array(
            'project_name' => $project_name,
            'description' =>  $description
        );
        $this->db->where('id', $id);
        return $this->db->update('portfolios',$data );
    }

    function deletePort($id){
    $this->db->delete('portfolios', array('id' => $id));
    $this->db->where('id', $id);
    return $this->db->delete('portfolios');
    }

    

}
