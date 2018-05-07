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

    function unsubscribe(){
        $this->db->set("end_subscription_at","NOW()",false);
        $this->db->where("history_hash",auth()->membership_hash);
        $this->db->update("membership_history");

        $this->db->set("account_type",0);
        $this->db->set("account_type_due","NULL",false);
        $this->db->set("membership_hash","NULL",false);
        $this->db->where("membership_hash",auth()->membership_hash);
        $this->db->update("member");

        $_SESSION['user']->account_type_due = "";
        $_SESSION['user']->membership_hash = "";
        $_SESSION['user']->user_details->account_type = 0;
        $_SESSION['user']->user_details->account_type_due = "";
        $_SESSION['user']->user_details->membership_hash = "";
    }

    function savePayment($package,$payment,$transaction){
        $history = null;
        $this->db->trans_start(); # Starting Transaction

        $this->db->insert('paypal_payments', $payment);
        $this->db->insert('paypal_transactions', $transaction);
        
		
		$this->db->set('member_id',auth()->id);
		$this->db->set('package_id',$package->id);
		$this->db->set('history_hash',md5(uniqid(auth()->id.$package_id.time(), true)));
		$this->db->set('end_subscription_at','NOW() + INTERVAL 1 MONTH',false);
		$this->db->insert('membership_history');
		
		$this->db->where('id',$this->db->insert_id());
		$history = $this->db->get('membership_history')->row(); 
		
		$this->db->where("id",auth()->user_id);
        $this->db->set("account_type_due",$history->end_subscription_at);
        $this->db->set("account_type",$package->id);
		$this->db->set("membership_hash",$history->history_hash);
        $this->db->update('member');
		

        $this->db->trans_complete(); # Completing transaction

        if ($this->db->trans_status() === FALSE) {
            # Something went wrong.
            $this->db->trans_rollback();
            return FALSE;
        } 
        else {
            auth()->membership_hash = $history->history_hash;
            auth()->user_details->membership_hash = $history->history_hash;
            $this->db->trans_commit();
            return TRUE;
        }
    }


}
