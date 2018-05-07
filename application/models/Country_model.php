<?php

class Country_model extends MX_Model {
    public function __construct() {
      parent::__construct();
      $this->load->database();
    }

    public function all() {
      $query = $this->db->get('countries');
      return $query->result();
    }
}
