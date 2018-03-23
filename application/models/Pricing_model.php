<?php

class Pricing_model extends MX_Model{

    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    function getDefaultPrice() {
        $query = $this->db->select('*')
            ->from('package_settings')
            ->where('is_deleted', 0)
            ->order_by('package_price', 'ASC')
            ->get();
        
        if($query->num_rows() < 1) {
            return array();
        }
        return $query->result_array();
    }

}
