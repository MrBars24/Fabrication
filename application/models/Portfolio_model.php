<?php

class Portfolio_model extends MX_Model{

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
        //$q = $this->getIndexDataCount("portfolios",$limit,$offset,'created_at','DESC',$where);
        $q = $this->getIndexDataCount("portpolio_details",$limit,$offset,'created_at','DESC', $where);
        return $q;
    }


    function save($data){
        $res = $this->db->insert("portfolios",$data);

        if($res){
            $data = $this->findBy("portfolios",$this->db->insert_id());
            return $data;
        }else{
            return FALSE;
        }
    }

    function update($id,$data){
        $this->db->where("id",$id);
        $res = $this->db->update("portfolios",$data);

        if($res){
            $data = $this->findBy("portfolios",$id);
            return $data;
        }else{
            return FALSE;
        }
    }

    function destroy($id){
        $this->db->where("id",$id);
        $this->db->set("is_deleted",1);
        $this->db->set("deleted_at",'NOW()',false);
        return $this->db->update("portfolios");
    }
    
    function createAttached($files){
        for($i=0; $i<count($files['name']); $i++){
            $data = array(
                'filename' => $files['name'][$i],
                'path' => $files[$i]['file'],
                'user_id' => $_SESSION['user']->id
            );
            $query = $this->db->insert('attachments', $data);
        }
        return $query;
    }



}
