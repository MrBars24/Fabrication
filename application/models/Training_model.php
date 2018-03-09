<?php
class Training_model extends MX_Model{

    function __construct(){
        parent::__construct();
    }

    function getTrainings() {
        $query = $this->db->select('*')
            ->from('trainings')
            ->where('is_deleted', 0)
            ->order_by('id', 'ASC')
            ->get();
        
        if($query->num_rows() < 1) {
            return array();
        }
        return $query->result_array();
    }
    
    function getView($id){
        $query = $this->db->select('*')
        ->from('trainings')
        ->where('is_deleted',0)
        ->where('id', $id)
        ->order_by('id','ASC')
        ->get();

        if($query->num_rows() > 0){
            return $query->row();
        } 

        return [];
    }

    function delData($id) {
        $this->db->set('is_deleted','1');
        $this->db->where('id', $id);
        return $this->db->update('trainings');

        /*$table = $this->config->item('trainings');
        $this->db->where("id",$id);
        return $this->db->delete($table);*/
    }

    function createTraining(){
        
        $title = $this->input->post('title');
        $description = $this->input->post('description');
        //$attached = $this->input->file ??

        $data = array(
            'training_name' => $title,
            'description' => $description
        );

        if($this->db->insert('trainings', $data)){
            return $this->getView($this->db->insert_id());
        }else{
            return FALSE;
        }
    }

    function getPageById($id){
        $table = $this->config->item('trainings');

        $this->db->where("id",$id);
        $q = $this->db->get($table);

        if($q->num_rows() > 0){
            return $q->row();
        }
        return [];
    }




}
