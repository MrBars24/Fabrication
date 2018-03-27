<?php defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH."third_party/vendor/autoload.php"); 

class Facebook{

	private $fb;
	private $helper;
	private $accessToken;
	private $oAuth2Client;

	function __construct($config){
		$this->fb = new \Facebook\Facebook([
		  'app_id' => $config['app_id'],
		  'app_secret' => $config['app_secret'],
		  'default_graph_version' => 'v2.12',
		  //'default_access_token' => '{access-token}', // optional
		]);

		$this->helper = $this->fb->getRedirectLoginHelper();
	}

	function generateLoginUrl(){
		$permissions = ['email'];
		return $loginUrl = $this->helper->getLoginUrl('https://dev.efab/auth/fb', $permissions);
	}

	function init(){
		try {
			$this->accessToken = $this->helper->getAccessToken();
		} catch(Facebook\Exceptions\FacebookResponseException $e) {
			// When Graph returns an error
			echo 'Graph returned an error: ' . $e->getMessage();
			exit;
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
			// When validation fails or other local issues
			echo 'Facebook SDK returned an error: ' . $e->getMessage();
			exit;
		}

		if($this->checkAccessToken()){
			$this->oAuth2Client = $this->fb->getOAuth2Client();
			$tokenMetadata = $this->oAuth2Client->debugToken($this->accessToken);

			if (! $this->accessToken->isLongLived()) {
			  // Exchanges a short-lived access token for a long-lived one
			  try {
			    $this->accessToken = $this->oAuth2Client->getLongLivedAccessToken($this->accessToken);
			  } catch (Facebook\Exceptions\FacebookSDKException $e) {
			    echo "<p>Error getting long-lived access token: " . $e->getMessage() . "</p>\n\n";
			    exit;
			  }
			}

			$_SESSION['fb_access_token'] = (string) $this->accessToken;
		}
	}

	function checkAccessToken(){
		if (!isset($this->accessToken)) {
			return FALSE;
		}

		return TRUE;
	}

	function getAccessToken(){
		if($this->checkAccessToken()){
			return $this->accessToken->getValue();
		}
	}




}