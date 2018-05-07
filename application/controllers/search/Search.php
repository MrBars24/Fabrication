<?php

class Search extends MX_Controller {
  public function __construct() {
    parent::__construct();
		$this->template->set_template("default");
  }

  public function searchAll() {
    // Search Query
    $search = $this->input->get('q');

    $js = array(
			"/assets/admin/custom/js/bs-modal-loader.js",
			"/assets/admin/custom/js/bars-dtable.js",
			"/assets/default/custom/js/search-page.js",
			"/assets/plugins/jstz/dist/jstz.min.js",
		);

    $this->template->append_js($js);

    $this->load->model('Industry_model');
    $this->load->model('Country_model');

    $industries = $this->Industry_model->getIndustries();
		$countries = $this->Country_model->all();


    $this->template->load_sub('industries', $industries);
		$this->template->load_sub('countries', $countries);
    $this->template->load('frontend/member/search_result');
  }
}
