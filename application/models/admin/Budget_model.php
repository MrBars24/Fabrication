<?php

class Budget_model extends MX_Model{

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
        $q = $this->getIndexDataCount("budget_filter",$limit,$offset,'min_budget','ASC',$where);

        return $q;
    }


    function save($data){
        $res = $this->db->insert("budget_filter",$data);

        if($res){
            $data = $this->findBy("budget_filter",$this->db->insert_id());
            return $data;
        }else{
            return FALSE;
        }
    }

    function update($id,$data){
        $this->db->where("id",$id);
        $res = $this->db->update("budget_filter",$data);

        if($res){
            $data = $this->findBy("budget_filter",$id);
            return $data;
        }else{
            return FALSE;
        }
    }

    function destroy($id){
        $this->db->where("id",$id);
        $this->db->set("is_deleted",1);
        $this->db->set("deleted_at",'NOW()',false);
        return $this->db->update("budget_filter");
    }



}
