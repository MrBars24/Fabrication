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

    function getDetails($id){
        $query = $this->db->select('*')
            ->from('package_settings')
            ->where('id',$id)
            ->get();

        if($query->num_rows() > 0){
            return $query->row();
        }
        return [];
    }

    function savePayment($package,$payment,$transaction){
        $this->db->trans_start(); # Starting Transaction

        $this->db->insert('paypal_payments', $payment);
        $this->db->insert('paypal_transactions', $transaction);
        $this->db->where("id",auth()->user_id);

        $this->db->set("account_type_due",'NOW() + INTERVAL 1 MONTH', false);
        $this->db->set("account_type",$package->id);
        $this->db->update('member');

        $this->db->trans_complete(); # Completing transaction

        if ($this->db->trans_status() === FALSE) {
            # Something went wrong.
            $this->db->trans_rollback();
            return FALSE;
        } 
        else {
            $this->db->trans_commit();
            return TRUE;
        }
    }


}
