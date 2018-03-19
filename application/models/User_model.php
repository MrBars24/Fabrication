<?php
class User_model extends MX_Model{

    public $table = "users";

    function __construct(){
        parent::__construct();
        $this->load->database();
    }

	function loginCheck(){
        $username = $this->input->post('username');
        $pass = $this->input->post('pwd');

        $this->db->select("id, username, user_id, user_type, firstname, lastname");
        $this->db->where("username",$username);
        $this->db->where("password",$pass);
        $q = $this->db->get("account");

        if($q->num_rows() > 0){
            $tmp =  $q->row();
            return $tmp;
        }

        return [];
    }

    function submitFabricator($data){
        if($this->db->insert("fabricators",$data)){
            return $this->db->insert_id();
        }else{
            return FALSE;
        }
    }

    function submitUpdateFabricator($data, $id){
        $this->db->where('id', $id);
        if($this->db->update('fabricators', $data)){
            return TRUE;
        }else{
            return FALSE;
        }

    }

    function submitMember($data){
        if($this->db->insert("member", $data)){
            return $this->db->insert_id();
        }else{
            return FALSE;
        }
    }

    function submitUser($data){
        if($this->db->insert("users",$data)){
            return $this->db->insert_id();
        }else{
            return FALSE;
        }
    }

    function submitUpdateUser($data, $id){
        $this->db->where('user_id', $id);
        if($this->db->update("users", $data)){
            return TRUE;
        }
        else{
            return FALSE;
        }
    }

    function checkEmail($username){
        $this->db->select('*');

        if(filter_var($username, FILTER_VALIDATE_EMAIL)){
            $this->db->where('email', $username);
        }
        else{
            $this->db->where('username', $username);
        }

        $query = $this->db->get('users');
        if($query->num_rows() > 0){
            return TRUE;
        }
        return FALSE;
    }

    function checkLogin(){
    	$pwd = hash_hmac("sha1", $this->input->post('pwd'), "e-fab");
        $username = $this->input->post('username');
        $password = $pwd;

        $this->db->select('id, email, username, user_type, user_id, firstname, lastname, max_bid, max_post, my_bids, my_posts');

        if(filter_var($username, FILTER_VALIDATE_EMAIL)){
            $this->db->where('email', $username);
        }
        else{
            $this->db->where('username', $username);
        }

        $this->db->where('password', $password);
        $query = $this->db->get('user_details');
        if($query->num_rows() > 0){
            $row = $query->row();
            $row->user_details = $this->getMemberInfo($row->user_id);
            if($row->user_type == "member"){
                $row->url_redirect = base_url() . 'work';
            }
            else{
                $row->url_redirect = base_url() . 'admin';
            }
            return $row;
        }
        return FALSE;
    }
    function getMemberInfo($id){
        $this->db->select('*');
        $this->db->where('id', $id);
        $query = $this->db->get('member');
        if($query->num_rows() > 0){
            return $query->row();
        }
        return array();
    }
    function getUserInfo($id){
        $this->db->select('id, email, username, user_type, user_id, firstname, lastname');
        $this->db->where('user_id', $id);
        $query = $this->db->get('users');
        if($query->num_rows() > 0){
            return $query->row();
        }
        return array();
    }
    function getUserDetails($id){
        $query = $this->db->select('*')
             ->where('user_id', $id)
             ->get('user_details');
        if($query->num_rows() > 0){
            return $query->row();
        }
        return array();

    }
    // function getFabricatorInfo($id){
    //     $this->db->select('*');
    //     $this->db->where('id', $id);
    //     $query = $this->db->get('fabricators');
    //     if($query->num_rows() > 0){
    //         return $query->row();
    //     }
    //     return array();
    // }
    function updateUserSession(){
        $this->db->select('id, email, username, user_type, user_id, firstname, lastname, max_bid, max_post, my_bids, my_posts');

        $this->db->where("id",auth()->id);
        $query = $this->db->get('user_details');

        if($query->num_rows() > 0){
            $row = $query->row();
            $row->user_details = $this->getMemberInfo($row->user_id);

            $_SESSION['user'] = $row;
        }
    }
}
