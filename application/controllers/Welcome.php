<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->template->set_template("default");
		$css = array(
			"assets/plugins/bootstrap/css/bootstrap.min.css",
			"assets/default/css/style.css",
			"assets/default/css/colors/blue.css",
			"assets/plugins/bootstrap-select/bootstrap-select.min.css",
			"assets/default/css/custom/global.css"
			
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
			"assets/plugins/styleswitcher/jQuery.style.switcher.js",
			"assets/admin/js/submit-contact-us.js",
			"assets/plugins/select2/dist/js/select2.full.min.js",
			"assets/plugins/bootstrap-select/bootstrap-select.min.js"
		);
		$this->template->set_additional_css($css);
		$this->template->set_additional_js($js);
	}

	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function overview()
	{
		$this->template->load("overview");
	}
	public function aboutTheSite()
	{
		$this->template->load("about_the_site");
	}

	public function whyEfab()
	{
		$this->template->load("why_e_fab");
	}

	public function questionsEfab()
	{
		$this->template->load("questions_e_fab");
	}

	public function aboutUs()
	{
		$this->template->load("about_us");
	}

	public function viewShopDetailer()
	{
		$this->template->load("view_shop_detailers");
	}

	public function Pricing()
	{
		$this->template->load('pricing');
	}

	public function submitContactUs(){
		$emailSettings = array(
		  'protocol' => 'sendmail',
		  'smtp_host' => 'ssl://smtp.gmail.com',
		  'smtp_port' => 465,
		  'smtp_user' => 'efab@efab.ifltest08.tk',
		  'smtp_pass' => 'ktuN9?&Knkng',
		  'mailtype'  => 'html',
		  'charset'   => 'utf-8'
		);
		$cS = $this->input->post('contactSubject');
		$cM = $this->input->post('contactMessage');
		$cE = $this->input->post('contactEmail');

		$this->load->library('email',$emailSettings);

		// $this->email->initialize($emailSettings);
		$this->email->from($emailSettings['smtp_user'], 'efab');
		$this->email->to($cE);
		$this->email->cc('efab@efab.ifltest08.tk');
		$this->email->bcc($emailSettings['smtp_user']);
		$this->email->set_mailtype('html');
		$this->email->subject($cS);
		$this->email->message($cM);

		$sendReturn = $this->email->send();
		/* if($sendReturn){
		   //Success email Sent
		   echo json_encode($this->email->print_debugger());
		   exit;
		}else{
		   //Email Failed To Send
		   echo json_encode($this->email->print_debugger());
		   exit;
		} */
		echo json_encode($sendReturn);
		exit;
	}
	public function postJob() {
		$css = array(
    		"assets/images/favicon.png",
    		"assets/plugins/timepicker/bootstrap-timepicker.min.css",
    		"assets/plugins/bootstrap-daterangepicker/daterangepicker.css"
		);
		$js = array(
    		"assets/plugins/moment/moment.js",
    		"assets/plugins/timepicker/bootstrap-timepicker.min.js",
    		"assets/plugins/bootstrap-daterangepicker/daterangepicker.js",
			"assets/admin/js/post-job.js"
		);
		$this->template->append_css($css);
		$this->template->append_js($js);
		$this->template->load('post_job');
	}

	public function watchList() { 
        $css = array(
			"https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css",
			"assets/default/css/custom/global.css",
			"assets/default/custom/css/jobs.css"
        );
        $js = array(
            "assets/plugins/select2/js/select2.min.js",
            "assets/default/custom/js/jobs.js",
        );
        $this->template->append_css($css);
        $this->template->append_js($js);
		$this->template->load("watch_list"); 
	} 
	 
	public function about() { 
	    $this->template->load("about"); 
	}

	public function howFabricator() {
		$this->template->load("how_fabricator");
	}
	 
	public function howExpert() {
		$this->template->load("how_expert");
	}
}
