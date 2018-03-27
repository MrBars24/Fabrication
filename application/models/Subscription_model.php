<?php

class Subscription_model extends MX_Model{

    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    function getMemberSubscription($id) {
        $query = $this->db->select('*')
            ->from('member')
            ->where('id', $id)
            ->get();
        
        if($query->num_rows() < 1) {
            return array();
        }
        return $query->row();
    }

    function getPackage($account){
        $id = $account->account_type;
        $query = $this->db->select('*')
            ->from('package_settings')
            ->where('id',$id)
            ->get();

        if($query->num_rows() < 1){
            return array();
        }
        return $query->row();
    }


}
