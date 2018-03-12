<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proposal extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->template->set_template("default");
		$this->load->model('job_model');
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
    function submit(){
		header("Content-Type:application/json");
		$this->load->model('proposal_model');
        $data = array(
            'job_id' => $this->input->post('id'),
            'expert_id' => $_SESSION['user']->id,
            'cover_letter' => $this->input->post('cover_letter'),
            'amount' => $this->input->post('budget')
        );
        $submitproposal = $this->proposal_model->submitProposal($data);
		$data['user_details'] = $_SESSION['user'];
        if($submitproposal){
            return json(array(
                'success' => TRUE,
				'data' => $data
            ),200);
        }
        return json(array(
            'success' => FALSE
        ), 400);
    }
}
