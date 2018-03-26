<?php

class Country{

private $CI;

public function __construct(){
    $this->CI = &get_instance();
    $this->CI->load->database();

}

public function get() {
    $query = $this->CI->db->get('countries');
    return $query->result();
}




}
?>
