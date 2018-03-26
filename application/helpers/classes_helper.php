<?php

class Ptransaction{
	private $amount;
	private $currency;

	function __construct(){

	}

	public function setAmount($amount){
		$this->amount = $amount;
	}

	public function setCurrency($currency){
		$this->currency = $currency;
	}

	public function toArray(){

		return array(
			"amount" => array(
				"total" => $this->amount,
				"currency" => $this->currency
			)		
		);

	}
}