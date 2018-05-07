<?php

class Material_model extends MX_Model{

    function __construct(){
        parent::__construct();
        $this->load->database();
    }


    function all(){
        $query = $this->db->select('*')
                         ->get('materials_list');
                        
        return $query->result();

    }
}
