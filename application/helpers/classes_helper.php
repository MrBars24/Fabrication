<?php

class Ptransaction{
	private $amount;
	private $currency;
	private $desc;
	private $item = array();

	function __construct(){

	}

	public function setAmount($amount){
		$this->amount = $amount;
	}

	public function setCurrency($currency){
		$this->currency = $currency;
	}

	public function setDescription($desc){
		$this->desc = $desc;
	}

	public function addItem($item){
		$this->item[] = $item;
	}

	public function toArray(){
		/*{"name": "handbag","description": "Black handbag.","quantity": "1","price": "15","tax": "0.02","sku": "product34","currency": "USD"}*/
		
		return array(
			"amount" => array(
				"total" => $this->amount,
				"currency" => $this->currency
			),
			"description" => $this->desc,
			"item_list" => array(
				"items" => $this->item
			)
		);

	}
}