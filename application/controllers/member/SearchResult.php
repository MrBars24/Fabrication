<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SearchResult extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->template->set_template("default");
	}
    
	public function search($search)
	{
		check_user('member');
        $css = array(
			"/assets/default/css/custom/sections.css",
			"/assets/default/custom/css/dashboard.css"
		);
        $js = array(
            "/assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"
        );
        $this->template->append_css($css);
        $this->template->append_js($js);
        
        $this->template->load('frontend/member/search_result');
	}
}