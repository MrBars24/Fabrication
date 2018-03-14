<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Industry extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->template->set_template("default");
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