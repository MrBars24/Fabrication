<?php
class News_model extends MX_Model{
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
$q = $this->getIndexDataCount("news",$limit,$offset,'created_at','DESC',$where);
return $q;
}
function save($data){
$res = $this->db->insert("news",$data);
if($res){
$data = $this->findBy("news",$this->db->insert_id());
return $data;
}else{
return FALSE;
}
}
function update($id,$data){
$this->db->where("id",$id);
$res = $this->db->update("news",$data);
if($res){
$data = $this->findBy("news",$id);
return $data;
}else{
return FALSE;
}
}
function destroy($id){
$this->db->where("id",$id);
$this->db->set("is_deleted",1);
$this->db->set("deleted_at",'NOW()',false);
return $this->db->update("news");
}
}