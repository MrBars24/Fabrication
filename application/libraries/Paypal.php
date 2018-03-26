<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paypal {
	private $headers = array("Content-Type: application/json");
	private $ch;
	private $info;
	private $intent = 'sale';
	private $transaction = [];

    function __construct($token = ""){
    	if($token != ""){
    		$this->headers[] = "Authorization: Bearer $token";
    	}

    	$this->ch = curl_init();
    }


    /**
    * Create Payment
    * $data = array()
    */
    public function createPayment(){
    	$this->pushTransaction();

    	$this->info['intent'] = $this->intent;

    	$fields_string = http_build_query($this->info);
		curl_setopt($this->ch, CURLOPT_URL, "https://api.sandbox.paypal.com/v1/payments/payment");
		curl_setopt($this->ch,CURLOPT_POSTFIELDS, json_encode($this->info));
		curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($this->ch, CURLOPT_POST, 1);
		curl_setopt($this->ch, CURLOPT_HTTPHEADER, $this->headers);

		$result = curl_exec($this->ch);

		if (curl_errno($this->ch)) {
		    echo 'Error:' . curl_error($this->ch);
		}

		curl_close ($this->ch);

		return $result;
    }

    public function setToken($id,$secret){
    	$token = $this->getAccessToken($id,$secret);
    	$token = json_decode($token);
    	$token = $token->access_token;

        $CI =& get_instance();
        $CI->session->set_tempdata('btoken', $token, 180);

    	$this->headers[] = "Authorization: Bearer $token";
    }

    public function setPayer($payer){
    	$this->info['payer'] = array('payment_method'=>$payer);
    }

    public function setRedirectUrls($urls){
    	$this->info['redirect_urls'] = array(
    		'return_url' => $urls['return_url'],
    		'cancel_url' => $urls['cancel_url']
    	);
    }

    public function setIntent($intent){
    	$this->intent = $intent;
    }

    public function setTransaction($trans){
    	array_push($this->transaction, $trans);
    }

    public function executePayment(){
        $CI =& get_instance();
        $payment_id = $CI->input->post('paymentID');
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "https://api.sandbox.paypal.com/v1/payments/payment/$payment_id/execute/");


        if(isset($_SESSION['btoken'])){
            $token = $_SESSION['btoken'];
        }else{
            echo "Invalid Token.";
            exit;
        }

        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            "Content-Type:application/json",
            "Authorization: Bearer $token"
        ));

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl,CURLOPT_POSTFIELDS, json_encode(array("payer_id" => $CI->input->post('payerID'))));


        $result = curl_exec($curl);
        if (curl_errno($curl)) {
            echo 'Errors:' . curl_error($curl);
        }

        return $result;
    }

    private function getAccessToken($id,$secret){
    	$curl = curl_init();

    	curl_setopt($curl, CURLOPT_URL, "https://api.sandbox.paypal.com/v1/oauth2/token");
    	curl_setopt($curl, CURLOPT_HTTPHEADER, array(
    		"Accept: application/json",
    		"Accept-Language: en_US",
    		"Authorization: Basic " . base64_encode($id.':'.$secret)
    	));
    	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    	curl_setopt($curl, CURLOPT_POST, 1);
    	curl_setopt($curl,CURLOPT_POSTFIELDS, http_build_query(array("grant_type" => "client_credentials")));

    	$result = curl_exec($curl);
    	if (curl_errno($curl)) {
		    echo 'Errors:' . curl_error($curl);
		}

    	return $result;

    }

    private function pushTransaction(){
    	$data = array();
    	foreach($this->transaction as $t){
    		$data[] = $t->toArray();
    	}

    	$this->info['transactions'] = $data;
    }
}
