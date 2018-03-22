<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH."third_party/vendor/autoload.php"); 
class Test extends MX_Controller {

	public function __construct(){
		parent::__construct();
	}

	public function showSession()
	{
		print_r($_SESSION);
	}

	public function pusher(){
		$this->load->library('pusher');
		$this->pusher->setMessage('message','test');
		$this->pusher->push('try');
		/*$options = array(
		    'cluster' => 'ap1',
		    'encrypted' => true
		);
		
		$pusher = new Pusher\Pusher(
		    'ba4265c88567e3fcd1cd',
		    '26caebdd4b6b34e7e740',
		    '492902',
			$options
		);

		$data['message'] = 'hello world';
		$pusher->trigger('my-channel', 'my-event', $data);*/
	}

}


    