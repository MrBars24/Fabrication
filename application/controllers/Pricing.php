<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pricing extends MX_Controller {
    public function __construct(){
        parent::__construct();
        $this->template->set_template("default");
        $this->load->model("pricing_model");
    }

    public function index()
    {
        $this->template->append_css(array(
            "assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css",
                "assets/admin/custom/js/bars-datatable.css"
        ));

        $this->template->append_js(
            array(
                "assets/admin/js/mask.js",
                "assets/plugins/moment/moment.js",
                "assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js",
                "assets/admin/custom/js/bars-datatable.js",     
                "assets/default/custom/js/pricing.js"

            )
        );
        $pricing = $this->pricing_model->getDefaultPrice();

        $this->template->load_sub('pricing', $pricing);
        $this->template->load("pricing");
    }
}
