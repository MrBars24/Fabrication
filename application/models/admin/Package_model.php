<?php

class Package_model extends MX_Model{

    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    function all(){
        $limit = 0;
        $offset = 0;
        if(isset($_GET['limit'])){
            $limit = $_GET['limit'];
        }

        if(isset($_GET['page'])){
            $offset = $_GET['page'];
        }

        $where = array("is_deleted"=>0);
        $q = $this->getIndexDataCount("package_settings",$limit,$offset,'package_price','ASC',$where);

        return $q;
    }


    function save($data){
        $res = $this->db->insert("package_settings",$data);

        if($res){
            $data = $this->findBy("package_settings",$this->db->insert_id());
            return $data;
        }else{
            return FALSE;
        }
    }

    function update($id,$data){
        $this->db->where("id",$id);
        $res = $this->db->update("package_settings",$data);

        if($res){
            $data = $this->findBy("package_settings",$id);
            return $data;
        }else{
            return FALSE;
        }
    }
    function defaultpackage($id,$data){
        $defaultZero = array("is_default" => 0); 
        $query1 = $this->db->update("package_settings", $defaultZero);

        $this->db->where("id",$id);
        $res = $this->db->update("package_settings",$data);

        if($res){
            $data = $this->findBy("package_settings",$id);
            return $data;
        }else{
            return FALSE;
        }
    }

    function destroy($id){
        $this->db->where("id",$id);
        $this->db->set("is_deleted",1);
        $this->db->set("deleted_at",'NOW()',false);
        return $this->db->update("package_settings");
    }



}
