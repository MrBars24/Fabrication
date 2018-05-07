<?php
class Watch_model extends MX_Model{
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	public function closeJobsToday(){
		$this->db->where('bidding_expire_at <= CURDATE()');
		$this->db->update('jobs',array(
			'status' => 'close'
		));
	}
	
	public function closeSubscriptionToday(){
		$this->db->where('account_type_due <= CURDATE()');
		$this->db->set('account_type',0);
		$this->db->set('account_type_due','NULL',false);
		$this->db->set('membership_hash','');
		$this->db->update('member');
	}
}
