<?php 
class MX_Controller extends CI_Controller{

    function __construct(){
        parent::__construct();
        $this->_init_site();
    }

    function _init_site(){
        $this->template->set_additional_css(array());
		$this->template->set_additional_js(array());

        $this->load->driver('cache');
        $config = $this->cache->file->get('sconfig');
        $this->template->load_sub('config',$config);
    }

    function isloggedin(){
        if(!$this->session->userdata('id')){
            redirect('login');
        }
    }

    function checkValidReferer(){
        $ref = parse_url($_SERVER['HTTP_REFERER'],PHP_URL_HOST);
        if($ref != HOST){
            header("Content-Type:application/json");
            header("HTTP/1.1 401 Unauthorized");

            echo json_encode(array(
                "message"=>"Invalid Domain"
            ));
            exit();
        }
    }

}


?>