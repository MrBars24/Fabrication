<?php
class User_model extends MX_Model{

    public $table = "users";

    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    function update($id,$data){
        $this->db->where("id",$id);
        return $this->db->update("users",$data);
    }

    function destroy($id){
        $this->db->where("id",$id);
        $this->db->set("is_deleted",1);
        $this->db->set("deleted_at",'NOW()',false);
        return $this->db->update("users");
    }

    function save($data){
        return $this->db->insert("users",$data);
    }

}
