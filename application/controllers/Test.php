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
		$this->load->library('fupload');
		$this->fupload->setFolder('test');
		$this->fupload->setAcceptedType('image/jpeg');
		$data = $this->fupload->processUpload('up',TRUE);
		print_r($data);
		/*$this->load->library('pusher');
		$this->pusher->setMessage('message','test');
		$this->pusher->push('try');*/
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

	public function fb(){
		$params['app_id'] = "200691950529636";
		$params['app_secret'] = "dddd53ce04119627a1c86dc3e2c2c6e7";
		$this->load->library('facebook',$params);
		$this->facebook->init();

		?>
		<script>
		   function receiveMessage(event)
			{
			  // event.source is window.opener
			  // event.data is "hello there!"

			  // Assuming you've verified the origin of the received message (which
			  // you must do in any case), a convenient idiom for replying to a
			  // message is to call postMessage on event.source and provide
			  // event.origin as the targetOrigin.
			  event.source.postMessage("hi there yourself!  the secret response " +
			                           "is: rheeeeet!",
			                           event.origin);
			}

			window.addEventListener("message", receiveMessage, false);
		</script>
		<?php /*if(isset($_REQUEST['code'])){
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, "https://graph.facebook.com/v2.12/oauth/access_token?client_id=200691950529636&redirect_uri=https://dev.efab/auth/fb&client_secret=dddd53ce04119627a1c86dc3e2c2c6e7&code=".$_REQUEST['code']);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$response = curl_exec($ch);
			$res = json_decode($response);

			redirect('https://www.facebook.com/connect/login_success.html#access_token=' . $res->access_token);	
		}*/
	}

}


    