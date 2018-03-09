<?php
class Cms_model extends MX_Model{

    function __construct(){
        parent::__construct();
    }

    function getPageList(){
        $table = $this->config->item('pages');
        $data = $this->getIndexData($table);
        return $data;
    }

    function getPageById($id){
    	$table = $this->config->item('pages');

    	$this->db->where("id",$id);
    	$q = $this->db->get($table);

    	if($q->num_rows() > 0){
    		return $q->row();
    	}
    	return [];
    }

    function getPageContent($url){
    	$table = $this->config->item('pages');
    	$this->db->where("page_url",$url);
    	$q = $this->db->get($table);

    	if($q->num_rows() > 0){
    		return $q->row();
    	}

    	return [];
    }

    function createPage($data){
    	$table = $this->config->item('pages');
    	return $this->db->insert($table,$data);	
    }

    function updatePage($id,$data){
    	$table = $this->config->item('pages');
    	$this->db->where("id",$id);
    	return $this->db->update($table,$data);	
    }

    function deletePage($id){
    	$table = $this->config->item('pages');
    	$this->db->where("id",$id);
    	return $this->db->delete($table);
    }

    public function getSettings(){
        $this->db->select("key_name,value");
        $q=$this->db->get("settings");
        if($q->num_rows() > 0){
            $data = array();
            foreach($q->result() as $res){
                $data[$res->key_name] = $res->value;
            }

            return (object)$data;
        }
        return [];
    }

    function updateSiteSettings($data){
        $tmp_str = "";
        $arr = [];
        foreach($data as $key=>$value){
            $val = addslashes($value);
            $tmp_str = "('$key','$val')";
            array_push($arr, $tmp_str);
        }

        $sql = "INSERT INTO settings (key_name,value) ";
        $sql .= "VALUES " . implode(",", $arr);
        $sql .= " ON DUPLICATE KEY UPDATE 
        key_name=values(key_name),
        value=values(value);";

        if($this->db->query($sql)){
            return $this->getSettings();
        }

        return FALSE;
    }


    function insertImageAsset($data){
        if($this->db->insert("assets",$data)){
            return $this->getAsset($this->db->insert_id());
        }else{
            return FALSE;
        }
    }

    function getAssetList(){
        $limit = 0;
        $offset = 0;
        if(isset($_GET['limit'])){
            $limit = $_GET['limit'];
        }

        if(isset($_GET['page'])){
            $offset = $_GET['page'];
        }

        $q = $this->getIndexDataCount("assets",$limit,$offset);
        return $q;
    }

    function getAsset($id){
        $this->db->where("id",$id);
        $q = $this->db->get("assets");

        if($q->num_rows() > 0){
            return $q->row();
        }

        return [];
    }

    function getUserList(){
        $limit = 0;
        $offset = 0;
        if(isset($_GET['limit'])){
            $limit = $_GET['limit'];
        }

        if(isset($_GET['page'])){
            $offset = $_GET['page'];
        }


        $where = array(
            "user_type!="=>'admin',
            "is_deleted" => 0
        );
        $q = $this->getIndexDataCount("users",$limit,$offset,'created_at','desc',$where);

        return $q;
    }

}
