<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SearchFabricator extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->template->set_template("default");
	}
	public function index()
	{
		$css = array(
			"/assets/default/css/custom/global.css",
			"/assets/default/css/custom/sections.css"
		);
		$this->template->append_css($css);
        $this->template->load('frontend/fabricators/search');
	}

}
