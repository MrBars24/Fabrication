<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Notification_model extends CI_model {
    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function create($data) {
        $query = $this->db->insert('notifications', $data);
        $id = $this->db->insert_id();
        return $id;
    }

    public function get($id = NULL, $memberId = NULL, $withHidden = FALSE) {
        $query = $this->db->select('*')
            ->from('notifications');

        // If looking only for a specific row
        if (NULL != $id) {
            $query = $query->where('id', $id);
            return $query->get()->row();
        }

        if (NULL != $memberId) {
            $query = $query->where('user_id', $memberId);
        }


        // Include hidden
        if ( !$withHidden ) {
            $query = $query->where('hidden_at IS NULL', NULL, FALSE);
        }

        $query = $query->order_by('created_at', 'DESC');

        return $query->get()->result();
    }
    public function readAll($userId) {
        $this->db->where('user_id', $userId);
        return $this->db->update('notifications', array('read_at' => date("Y-m-d H:i:s")));
    }
    public function update($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('notifications', $data);
    }
    public function delete() {
        $this->db->where('id', $id);
        return $this->db->update('notifications', array('is_deleted' => 1));
    }
    public function getData($notificationId) {
        $query = $this->db->select('*')
            ->from('notification_datas')
            ->where_in('notification_id', $notificationId)
            ->get();
        return $query->result_array();
    }
    public function getNewCount($userId) {
        $query = $this->db->select('COUNT(*) as count')
        ->from('notifications')
        ->where('read_at', NULL)
        ->where('hidden_at', NULL)
        ->where('user_id', $userId)
        ->get();

        return $query->row()->count;
    }
}
