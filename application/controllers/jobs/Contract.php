<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contract extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->template->set_template("default");
	}

	public function show($contract_id){
        $css = array(
       		"https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css",
       		"/assets/default/css/custom/global.css",
			"/assets/default/css/custom/sections.css"
        );
        $js = array(
            "assets/plugins/select2/js/select2.min.js",
            "assets/default/custom/js/jobs.js",
        );
        $this->template->append_css($css);
        $this->template->append_js($js);
        $this->template->load('frontend/jobs/view_my_job');
	}

}
