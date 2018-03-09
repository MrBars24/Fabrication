<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Industry extends MX_Controller {

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
        
        $this->load->model('Industry_model');
	}

	public function index(){
        $industries = $this->Industry_model->getIndustries();

        if (!$industries) {
            return json(array(
                'success' => false,
                'message' => 'Something went wrong'
            ), 500);
        }
        return json(array(
            'data' => $industries
        ));
    }
}