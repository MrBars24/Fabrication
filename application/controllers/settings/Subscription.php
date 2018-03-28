<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subscription extends MX_Controller {
    public function __construct(){
        parent::__construct();
        $this->template->set_template("default");
        $this->load->model("pricing_model");
        $this->load->model("subscription_model");
		
		$js = array(
			//"assets/default/custom/js/settings/settings-training.js"
		);
		$this->template->set_additional_js($js);
    }

    public function index(){
        check_user('member');
		$pricing = $this->pricing_model->getDefaultPrice();
    	$user = $_SESSION['user']->id;
    	$memberPackage = $this->subscription_model->getMemberSubscription($user);
    	$getPackage = $this->subscription_model->getPackage($memberPackage);


        $this->template->append_js(array(
            'assets/default/custom/js/settings/subscription.js'
        ));
    	$this->template->load_sub('member',$memberPackage);
    	$this->template->load_sub('pricing', $pricing);
    	$this->template->load_sub('package', $getPackage);
        $this->template->load('frontend/settings/subscription');
    }

    public function subscribe($id = 10){
        $this->load->library('paypal');

        $this->paypal->setToken('AfnUbNlXkt2ecJAFcpWMGoo5EqBaOiJp9LTdwgVE-jTQC3Y3V2-8XKduDlXK6-ipB8zON3ZRY1TIva9Y','ECVVfISD1uGNhw3qt6uxiIevMSEUTqfKQ-k9ziUbye8Whg48Pz4MzwA3arV1i4e4Eo_g4_u_O9uAEvz-');
        
        $this->paypal->setPayer('paypal');
        $this->paypal->setRedirectUrls(array(
            'return_url' => 'https://example.com/your_redirect_url.html',
            'cancel_url' => 'https://example.com/your_cancel_url.html'
        ));

        $trans = new Ptransaction();
        $trans->setAmount('4.00');
        $trans->setCurrency('USD');

        $this->paypal->setTransaction($trans);
        $payment = $this->paypal->createPayment();
        echo $payment;
    }

    public function executePayment(){
        $this->load->library('paypal');
        $ex = $this->paypal->executePayment();
        echo $ex;
    }
}

