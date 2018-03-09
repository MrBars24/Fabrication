<?php
class Attachment_model extends CI_Model{

    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function getAttachmentById($attachment_id) {
        $query = $this->db->select('*')
            ->from('attachment')
            ->where('attachment.is_deleted', 0)
            ->where('attachment.id', $job_id)
            ->get();
        
        if ($query->num_rows() < 1) {
            return array();
        }
        return $query->row_array();
    }

    /**
     * Get Attachments by the Attachable Type 
     * 
     * @params $type string type
     *          where the attachment is related ['job', 'bid', 'portfolio', 'invite']
     * 
     * @params $id int id of the entity related
     */ 


    public function getAttachmentsByMorphedId($type, $id) {
        $query = $this->db->select('*')
            ->from('attachments')
            ->join('attachables', 'attachables.attachment_id = attachments.id')
            ->where('attachables.attachable_type', $type)
            ->where('attachables.attachment_id', $id)
            ->where('attachments.is_deleted', 0)
            ->get();
        
        if ($query->num_rows() < 1) {
            return array();
        }
        return $query->row_array();
    }



}
