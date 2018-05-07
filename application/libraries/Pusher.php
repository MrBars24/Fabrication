<?php defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH."third_party/vendor/autoload.php");
class Pusher{

	private $pusher;
	private $data;
	private $channel;

	function __construct($channel = 'efab-channel'){
		$this->channel = $channel;
		$this->pusher = new Pusher\Pusher(
		    'ba4265c88567e3fcd1cd',
		    '26caebdd4b6b34e7e740',
		    '492902',
			PUSHER_DETAILS
		);
	}

	function setMessage($key,$data){
		$this->data[$key] = $data;
	}

	// override constructor not working so I added this temporily hehehe
	function setChannel($channel){
		$this->channel = $channel;
	}

	function push($event){
		$this->pusher->trigger($this->channel, $event, $this->data);
	}



}
