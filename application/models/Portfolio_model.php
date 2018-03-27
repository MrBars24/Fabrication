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

        $where = array("portfolios.is_deleted"=>0);
        //$q = $this->getIndexDataCount("portfolios",$limit,$offset,'created_at','DESC',$where);
        $q = $this->getIndexDataCount("project_category as pc",$limit,$offset,'portfolios.created_at','DESC', $where,'', 'portfolios', 'pc.id = portfolios.category','','pc.id as pid,pc.display_name,portfolios.*');

        for($i=0; $i < count($q['data']); $i++){
            $q['data'][$i]->attachments = $this->getAttachment($q['data'][$i]->id);
        }


        return $q;
    }



    function all2(){
        $limit = 0;
        $offset = 0;
        if(isset($_GET['limit'])){
            $limit = $_GET['limit'];
        }

        if(isset($_GET['page'])){
            $offset = $_GET['page'];
        }

        $where = array("is_deleted"=>0,"attachable_type"=>'job');
        $q = $this->getIndexDataCount("attachments",$limit,$offset,'created_at','DESC',$where);

        return $q;
    }


    function save($data){
        $res = $this->db->insert("portfolios",$data);

        if($res){
            $data = $this->findBy("portfolios",$this->db->insert_id());
            $data->attachments = $this->getAttachment($data->id);
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
            $data->attachments = $this->getAttachment($data->id);
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
    function destroyAttachment($id){
        $this->db->where("portfolio_id",$id);
        $this->db->set("is_deleted",1);
        $this->db->set("deleted_at",'NOW()',false);
        return $this->db->update("portfolio_attachments");
    }
    function deleteAttached($attachId){
        $id = explode(',',$attachId);
        $this->db->where_in("id",$id);
        $this->db->set("is_deleted",1);
        $this->db->set("deleted_at",'NOW()',false);
        return $this->db->update("portfolio_attachments");
    }

    function createAttached($files, $id2){
        for($i=0; $i<count($files['name']); $i++){

            $data = array(
                'filename' => $files['name'][$i],
                'path' => $files[$i]['file'],
                'portfolio_id' => $id2
            );
            $query = $this->db->insert('portfolio_attachments', $data);
        }
        return $query;
    }

    function getPortfolio($id){
        $this->db->select('*');
        $this->db->where('user_id', $id);
        $this->db->where('is_deleted', 0);
        $this->db->order_by('created_at', "desc");
        $this->db->limit(1);
        $query = $this->db->get('portfolios');
        if($query->num_rows() > 0){
            $portpolio = $query->row();
            $portpolio->attachments = "";
            $portpolio->attachments = $this->getAttachment($portpolio->id);
            return $portpolio;
        }else{
            return array();
        }
    }
    function getPortfolios($id){
        $this->db->select('*');
        $this->db->where('user_id', $id);
        $this->db->where('is_deleted', 0);
        $this->db->order_by('created_at', "desc");
        $query = $this->db->get('portfolios');
        if($query->num_rows() > 0){
            $portpolio = $query->result();
            foreach($portpolio as $pt){
                $pt->attachments = $this->getAttachment($pt->id);
            }
            return $portpolio;
        }else{
            return FALSE;
        }
    }
    function getAttachment($id){
        $this->db->select('filename, path, portfolio_id, id as imgid');
        $this->db->where('portfolio_id', $id);
        $this->db->where('is_deleted',0);
        $query = $this->db->get('portfolio_attachments');
        if($query->num_rows() > 0){
            return $query->result();
        }
        return array();
    }
    /*function getAttachment($id){
        $this->db->select('filename, path, portfolio_id');
        $this->db->where_in('portfolio_id', $id);
        $query = $this->db->get('portfolio_attachments');
        if($query->num_rows() > 0){
            return $query->result_array();
        }
        return array();
    }*/

}
