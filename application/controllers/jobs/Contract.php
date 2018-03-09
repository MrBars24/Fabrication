<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contract extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->template->set_template("default");
		$css = array(
			"/assets/plugins/bootstrap/css/bootstrap.min.css",
			"/assets/default/css/style.css",
			"/assets/default/css/colors/blue.css"
		);

		$js = array(
			"assets/plugins/jquery/jquery.min.js",
			"assets/plugins/bootstrap/js/popper.min.js",
			"assets/plugins/bootstrap/js/bootstrap.min.js",
			"assets/default/js/jquery.slimscroll.js",
			"assets/default/js/waves.js",
			"assets/default/js/sidebarmenu.js",
			"assets/plugins/sticky-kit-master/dist/sticky-kit.min.js",
			"assets/plugins/sparkline/jquery.sparkline.min.js",
			"assets/default/js/custom.min.js",
			"assets/plugins/styleswitcher/jQuery.style.switcher.js"
		);
		$this->template->set_additional_css($css);
		$this->template->set_additional_js($js);
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
