<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subscription extends MX_Controller {
    public function __construct(){
        parent::__construct();
        $this->template->set_template("default");
        $this->load->model("pricing_model");
        $this->load->model("subscription_model");
        $this->load->library('encryption');
		
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
            '/assets/default/custom/js/settings/subscription.js'
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

        $hash = base64_decode($this->input->post('id'));
        $id = $this->encryption->decrypt(
            $hash,
            array(
                'cipher' => 'blowfish',
                'mode' => 'cbc',
                'key' => session_id(),
                'hmac_digest' => 'sha256',
                'hmac_key' => KEYCODE
            )
        );

        $details = $this->subscription_model->getDetails($id);

        $trans = new Ptransaction();
        $trans->addItem(
            array(
                "description" => $details->package_name,
                "quantity" => 1,
                "price" => $details->package_price,
                "currency" => "USD"
            )
        );
        $trans->setDescription("Package upgrade");
        $trans->setAmount($details->package_price);
        $trans->setCurrency('USD');

        $this->paypal->setTransaction($trans);
        $payment = $this->paypal->createPayment();
        echo $payment;
    }

    public function executePayment(){
        $this->load->library('paypal');

        $hash = base64_decode($this->input->post('id'));
        $id = $this->encryption->decrypt(
            $hash,
            array(
                'cipher' => 'blowfish',
                'mode' => 'cbc',
                'key' => session_id(),
                'hmac_digest' => 'sha256',
                'hmac_key' => KEYCODE
            )
        );

        $details = $this->subscription_model->getDetails($id);

        $ex = $this->paypal->executePayment();
        $res = json_decode($ex);
        if(isset($res->id)){
            $this->saveTransaction($details,$ex);
            json(array("success"=>TRUE));
        }else{
            json(array("success"=>FALSE));
        }
        //echo $ex;
    }

    public function saveTransaction($details,$ex){
        $res = json_decode($ex);

        $data = array(
            "user_id" => auth()->id,
            "paypal_payment_id" => $res->id,
            "intent" => $res->intent,
            "state" => $res->state,
            "payer_payment_method" => $res->payer->payment_method,
            "payer_status" => $res->payer->status,
            "payer_id" => $res->payer->payer_info->payer_id,
            "payer_info_email" => $res->payer->payer_info->email,
            "payer_info_firstname" => $res->payer->payer_info->first_name,
            "payer_info_lastname" => $res->payer->payer_info->last_name,
            "payer_country_code" => $res->payer->payer_info->country_code,
            "shipping_recipient_name" => $res->payer->payer_info->shipping_address->recipient_name,
            "shipping_address_line_1" => $res->payer->payer_info->shipping_address->line1,
            "shipping_address_city" => $res->payer->payer_info->shipping_address->city,
            "shipping_address_state" => $res->payer->payer_info->shipping_address->state,
            "shipping_address_postal_code" => $res->payer->payer_info->shipping_address->postal_code,
            "shipping_address_country_code" => $res->payer->payer_info->shipping_address->country_code,
            "shipping_address_line_1" => $res->payer->payer_info->shipping_address->line1,
            "paypal_create_time" => $res->create_time,
            "total_price" => $res->transactions[0]->amount->total
        );

        $trans = array(
            "paypal_payment_id" => $res->id,
            "amount_total" => $res->transactions[0]->amount->total,
            "amount_currency" => $res->transactions[0]->amount->currency,
            "status" => $res->transactions[0]->related_resources[0]->sale->state
        );

        $this->subscription_model->savePayment($details,$data,$trans);
    }
}

