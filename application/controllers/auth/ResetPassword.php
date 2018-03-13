<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ResetPassword extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->template->set_template("default");
	}
    
    /**
     *  Process Reset
     */
    public function reset()
	{	
		
		
    }
    
    public function validate() {
        
    }



}
