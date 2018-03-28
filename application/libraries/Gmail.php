<?php defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH . 'third_party/vendor/autoload.php');

class Gmail{
	public $CI;
	protected $client;
	public $request;
	public $redirect;
	private $user;
	
	function __construct(){
		$this->CI =& get_instance();
		$this->init_api();
		$this->redirect = 'https://' . $_SERVER['HTTP_HOST'] . '/oauth2callback';
		$this->getUser();
	}
	
	function set_redirect($redirect){
		$this->redirect = $redirect;
	}
	
	function init_api(){
		$this->client = new Google_Client();
		$this->client->setApplicationName("devEFAB");
		$this->client->setAuthConfig(APPPATH . 'third_party/client_id.json');
		$this->client->setAccessType("offline");        // offline access
		$this->client->setIncludeGrantedScopes(true);   // incremental auth
		
		$scope = array(
			Google_Service_Drive::DRIVE_METADATA_READONLY,
			Google_Service_Plus::PLUS_ME,
			"https://mail.google.com/",
			"https://www.googleapis.com/auth/gmail.labels",
			"https://www.googleapis.com/auth/gmail.compose",
			"https://www.googleapis.com/auth/gmail.readonly",
			"https://www.googleapis.com/auth/gmail.modify",
			"https://www.googleapis.com/auth/userinfo.email",
			"https://www.googleapis.com/auth/userinfo.profile"
		);
		
		$this->client->setScopes($scope);
	}
	
	function getUser() {
		if ($this->isAuthorized()) {
			$this->client->setAccessToken($_SESSION['id_token_token']);      
			$objGMail = new Google_Service_Gmail($this->client);
		
			$this->user = $objGMail->users->getProfile($_SESSION['mail_id']);
			print_r($this->user);
		}
	}

	function authenticate(){
		$this->client->setRedirectUri($this->redirect);
		
		$auth_url = $this->create_auth_url();
		header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));
	}

	function authorizeUser(){
		$client = new Google_Client(['client_id' => $CLIENT_ID]);  // Specify the CLIENT_ID of the app that accesses the backend
		$payload = $client->verifyIdToken($id_token);
		if ($payload) {
		  $userid = $payload['sub'];
		  // If request specified a G Suite domain:
		  //$domain = $payload['hd'];
		} else {
		  // Invalid ID token
		}
	}
	/**
	
	*
	
	* TODO: Make the To and From Dynamic
		
	*
	
	*/
	function sendDraft($msgId,$recepient,$subject,$content){
		if ($this->isAuthorized()) {
			$this->client->setAccessToken($_SESSION['id_token_token']);      
			$objGMail = new Google_Service_Gmail($this->client);
		 
			$strSubject = $subject;
			$strRawMessage = "From: Human Test <$this->user['emailAddress']>\r\n";
			$strRawMessage .= "To: $recepient\r\n";
			$strRawMessage .= 'Subject: =?utf-8?B?' . base64_encode($strSubject) . "?=\r\n";
			$strRawMessage .= "MIME-Version: 1.0\r\n";
			$strRawMessage .= "Content-Type: text/html; charset=utf-8\r\n";
			$strRawMessage .= 'Content-Transfer-Encoding: base64' . "\r\n\r\n";
			$strRawMessage .= $content."\r\n";
		 
		 
			try {
				$mime = $this->urlsafe_b64encode($strRawMessage);
				$msg = new Google_Service_Gmail_Message();
				$msg->setRaw($mime);
				
				$draft = new Google_Service_Gmail_Draft();
				$draft->setId($msgId);
				$draft->setMessage($msg);
				
				$objSentMsg = $objGMail->users_drafts->send($_SESSION['mail_id'], $draft);
		 
				print('Message sent object');
				print($objSentMsg);
		 
			} catch (Exception $e) {
				print($e->getMessage());
			}
		}else{
			
		}
	}
	
	function sendEmail($recepient,$subject,$content){
		if ($this->isAuthorized()) {
			$this->client->setAccessToken($_SESSION['id_token_token']);      
			$objGMail = new Google_Service_Gmail($this->client);
		 
			$strSubject = $subject;
			$strRawMessage .= "From: Human Test <$this->user['emailAddress']>\r\n";
			$strRawMessage .= "To: Barry Allen <$recepient>\r\n";
			$strRawMessage .= 'Subject: =?utf-8?B?' . base64_encode($strSubject) . "?=\r\n";
			$strRawMessage .= "MIME-Version: 1.0\r\n";
			$strRawMessage .= "Content-Type: text/html; charset=utf-8\r\n";
			$strRawMessage .= 'Content-Transfer-Encoding: base64' . "\r\n\r\n";
			$strRawMessage .= $content."\r\n";
		 
		 
			try {
				$mime = $this->urlsafe_b64encode($strRawMessage);
				$msg = new Google_Service_Gmail_Message();
				$msg->setRaw($mime);
		 
				$objSentMsg = $objGMail->users_messages->send($_SESSION['mail_id'], $msg);
		 
				print('Message sent object');
				print($objSentMsg);
		 
			} catch (Exception $e) {
				print($e->getMessage());
			}
		}else{
			
		}
	}
	
	
	/**
	
	*
	
	* TODO: Make the To and From Dynamic
		
	*
	
	*/
	function forwardEmail($recepient,$subject,$content) {
		if ($this->isAuthorized()) {
			$this->client->setAccessToken($_SESSION['id_token_token']);      
			$objGMail = new Google_Service_Gmail($this->client);
		 
			$strSubject = $subject;
			$strRawMessage .= "From: Human Test <$this->user['emailAddress']>\r\n";
			$strRawMessage .= "To: Barry Allen <$recepient>\r\n";
			$strRawMessage .= 'Subject: =?utf-8?B?' . base64_encode($strSubject) . "?=\r\n";
			$strRawMessage .= "MIME-Version: 1.0\r\n";
			$strRawMessage .= "Content-Type: text/html; charset=utf-8\r\n";
			$strRawMessage .= 'Content-Transfer-Encoding: base64' . "\r\n\r\n";
			$strRawMessage .= "---------- Forwarded message ----------\r\n";
			$strRawMessage .= $content."\r\n";
		 
			try {
				$mime = $this->urlsafe_b64encode($strRawMessage);
				$msg = new Google_Service_Gmail_Message();
				$msg->setRaw($mime);
		 
				$objSentMsg = $objGMail->users_messages->send($_SESSION['mail_id'], $msg);
		 
				print('Message sent object');
				print_r($objSentMsg);
		 
			
			} catch (Exception $e) {
				print($e->getMessage());
			}
		}
		else {
			
		}
	}
	function deleteMessage($id){
		if ($this->isAuthorized()) { 
			$this->client->setAccessToken($_SESSION['id_token_token']);      
			$objGMail = new Google_Service_Gmail($this->client);
			
			try {
				$objSentMsg = $objGMail->users_messages->delete($_SESSION['mail_id'], $id);
				return $objSentMsg;
		 
			} catch (Exception $e) {
				return $e->getMessage();
			}
		}else{
			
		}
		
		return [];
	}
	
	function deleteThread($id){
		if ($this->isAuthorized()) { 
			$this->client->setAccessToken($_SESSION['id_token_token']);      
			$objGMail = new Google_Service_Gmail($this->client);
			//Users.messages->send - Requires -> Prepare the message in message/rfc822
			try {
				$objSentMsg = $objGMail->users_threads->delete($_SESSION['mail_id'], $id);
		 
				print_r($objSentMsg);
		 
			} catch (Exception $e) {
				print($e->getMessage());
			}
		}else{
			
		}
	}
	
	function star_mail($id){
		return $this->mark($id,"STARRED","ADD");
	}
	
	function unstar_mail($id){
		return $this->mark($id,"STARRED","REMOVE");
	}
	
	function setRead($id){
		return $this->mark($id,"UNREAD","REMOVE");
	}
	
	function setUnread($id){
		return $this->mark($id,"UNREAD","ADD");
	}
	
	function mark($id,$label,$method){
		if ($this->isAuthorized()) { 
			$this->client->setAccessToken($_SESSION['id_token_token']);      
			$objGMail = new Google_Service_Gmail($this->client);
			//Users.messages->send - Requires -> Prepare the message in message/rfc822
			try {
				$mods = new Google_Service_Gmail_ModifyMessageRequest();
				if($method=="REMOVE"){
					$mods->setRemoveLabelIds(array($label));
				}else{
					$mods->setAddLabelIds(array($label));
				}
				$objSentMsg = $objGMail->users_messages->modify($_SESSION['mail_id'], $id, $mods);
		 
				//return $objSentMsg;
				return true;
		 
			} catch (Exception $e) {
				//return $e->getMessage();
				return false;
			}
		}else{
			return false;
		}
	}
	
	function reply($recepient,$thread,$subject,$content){
		if ($this->isAuthorized()) { 
			$this->client->setAccessToken($_SESSION['id_token_token']);      
			$objGMail = new Google_Service_Gmail($this->client);
		 
			$strSubject = $subject;
			//$strSubject = 'Test mail using GMail API' . date('M d, Y h:i:s A');
			//---------- Forwarded message ----------
			$strRawMessage = "From: Human Test <$this->user['emailAddress']>\r\n";
			$strRawMessage .= "To: $recepient\r\n";
			$strRawMessage .= 'Subject: =?utf-8?B?' . base64_encode($strSubject) . "?=\r\n";
			$strRawMessage .= "MIME-Version: 1.0\r\n";
			$strRawMessage .= "Content-Type: text/html; charset=utf-8\r\n";
			$strRawMessage .= 'Content-Transfer-Encoding: base64' . "\r\n\r\n";
			$strRawMessage .= $content."\r\n";
			
			//Users.messages->send - Requires -> Prepare the message in message/rfc822
			try {
				// The message needs to be encoded in Base64URL

				$mime = rtrim(strtr(base64_encode($strRawMessage), '+/', '-_'), '=');
				//$mime = $this->urlsafe_b64encode($strRawMessage);
				$msg = new Google_Service_Gmail_Message();
				$msg->setThreadId($thread);
				$msg->setRaw($mime);
		 
				//The special value **me** can be used to indicate the authenticated user.
				$objSentMsg = $objGMail->users_messages->send($_SESSION['mail_id'], $msg);
		 
				print('Message sent object');
				print($objSentMsg);
		 
			} catch (Exception $e) {
				print($e->getMessage());
			}
		}else{
			
		}
	}

	function urlsafe_b64encode($string) {
		$data = base64_encode($string);
		//$data = base64_encode(urlencode($string));
		$data = str_replace(array('+','/','='),array('-','_',''),$data);
		return $data;
	}
	
	function authorized_mail($code){
		$token = $this->get_token($code);
		$this->client->setAccessToken($token);
		
		// store in the session also
		$_SESSION['id_token_token'] = $token;
		$id = $this->get_user_id();
		$_SESSION['mail_id'] = $id;
}
	
	function get_token($code){
		$this->client->authenticate($_GET['code']);
		$access_token = $this->client->getAccessToken();
		
		return $access_token;
	}
	
	function create_auth_url(){
		return $this->client->createAuthUrl();
	}
	
	function isTokenExpired(){
		if(isset($_SESSION['id_token_token'])){
			$this->client->setAccessToken($_SESSION['id_token_token']);
		}
		
		return $this->client->isAccessTokenExpired();
	}
	
	function getAccessToken(){
		return $this->client->getAccessToken();
	}
	
	function isAuthorized(){
		return (
		  !empty($_SESSION['id_token_token'])
		  && isset($_SESSION['id_token_token']['id_token']) && !$this->isTokenExpired()
		);
	}
	
	function isRegenerated(){
		return (
			!empty($_SESSION['id_token_token'])
		  && isset($_SESSION['id_token_token']['id_token']) && $this->isTokenExpired()
		);
	}
	
	function get_mail(){
		$this->client->setAccessToken($_SESSION['id_token_token']);
		$service = new Google_Service_Gmail($this->client);
		//$messages = $service->users_messages->listUsersMessages('me');
		//$m = $messages->getMessages();
		
		return $this->listMessages($service,$_SESSION['mail_id']);
	}
	function get_thread($filter="INBOX") {
		$this->client->setAccessToken($_SESSION['id_token_token']);
		$service = new Google_Service_Gmail($this->client);
		
		return $this->listThreads($service,$_SESSION['mail_id'],$filter);
	}
	
	function get_draft() {
		$this->client->setAccessToken($_SESSION['id_token_token']);
		$service = new Google_Service_Gmail($this->client);
		
		return $this->listDrafts($service,$_SESSION['mail_id']);
	}
	
	function get_label_list(){ 
		$service = new Google_Service_Gmail($this->client);
		$userId = $_SESSION['mail_id'];
		$labels = array();

		try {
			$labelsResponse = $service->users_labels->listUsersLabels($userId);
			/* echo "<pre>";
			echo $_SESSION['mail_id'];	
			print_r(get_class_methods($service->users_labels));
			exit; */
			if ($labelsResponse->getLabels()) {
			  $labels = array_merge($labels, $labelsResponse->getLabels());
			}

		} catch (Excetion $e) {
			print 'An error occurred: ' . $e->getMessage();
		}

		return $labels;

	}
	
	function addNewLabel($name,$sub=""){
		$service = new Google_Service_Gmail($this->client);
		$userId = $_SESSION['mail_id'];
		
		$label = new Google_Service_Gmail_Label();
		if(!empty($sub)){
			$label->setName($sub . "/" . $name);
		}else{
			$label->setName($name);
		}
		
		try {
			$lab = $service->users_labels->create($userId, $label);
			print 'Label with ID: ' . $label->getId() . ' created.';
		} catch (Exception $e) {
			print 'An error occurred: ' . $e->getMessage();
			return FALSE;
		}
		return $label;
	}
	
	function get_thread_messages($threadId) {
		$this->client->setAccessToken($_SESSION['id_token_token']);
		$service = new Google_Service_Gmail($this->client);
		
		$opts_param = array();
		$opts_param['format'] = 'full'; 
		
		$thread = $this->getThread($service, $_SESSION['mail_id'], $threadId);
		// $thread = $service->users_threads->get($_SESSION['mail_id'], $threadId, $opts_param);
		return $thread;
	}
	
	function get_single_mail($threadId) {
		$this->client->setAccessToken($_SESSION['id_token_token']);
		$service = new Google_Service_Gmail($this->client);
		
		$opts_param = array();
		$opts_param['format'] = 'full'; 
		// return $this->getMessage(service, $_SESSION['mail_id']);
		
		
		$thread = $service->users_threads->get($_SESSION['mail_id'], $threadId, $opts_param);
		return $thread;
	}
	
	function listThreads($service, $userId, $filter) {
		$threads = array();
		$pageToken = NULL;
		$opt_param = array();
		$opt_param['maxResults'] = '20';
		$opt_param['labelIds'] = array($filter);

		$threadsResponse = $service->users_threads->listUsersThreads($userId, $opt_param);
		
		if ($threadsResponse->getThreads()) {
			$threads = array_merge($threads, $threadsResponse->getThreads());
			$pageToken = $threadsResponse->getNextPageToken();
		}
		
		$data = array();
		foreach ($threads as $thread) {
			//$data[] = $this->getThreadCurl($userId, $thread->getId());
			$data[] = $this->getThread($service, $userId, $thread->getId());

			// $data[] = $service->users_threads->getThread($service,$userId,$message->getId());
		}
		
		$result['json_thread'] = json_encode($data);
		$result['threads'] = $data;
		$result['token'] = $pageToken;
		
		return $result;
	}
	
	function listDrafts($service, $userId) {
		$drafts = array();
		$pageToken = NULL;
		$opt_param = array();
		$opt_param['maxResults'] = '10';

		$draftResponse = $service->users_drafts->listUsersDrafts($userId, $opt_param);

		if ($draftResponse->getDrafts()) {
			$drafts = array_merge($drafts, $draftResponse->getDrafts());
			$pageToken = $draftResponse->getNextPageToken();
		}
		
		$data = array();
		foreach ($drafts as $draft) {
			$id = $draft['message']->threadId;
			//$data[] = $this->getDrafts($service, $userId, $draft->getId());
			$thread = $this->getThread($service,$userId,$id);
			$thread->draft_id = $draft->getId();
			$data[] = $thread;
		}
		$result['json_thread'] = json_encode($data);
		$result['threads'] = $data;
		$result['token'] = $pageToken;
		
		return $result;
	}
	
	function listMessages($service, $userId) {
		$pageToken = NULL;
		$messages = array();
		$opt_param = array();
		/*do {
			try {
				if ($pageToken) {
					$opt_param['pageToken'] = $pageToken;
				}
				
				$opt_param['maxResults'] = '10';
				$messagesResponse = $service->users_messages->listUsersMessages($userId, $opt_param);
				if ($messagesResponse->getMessages()) {
					$messages = array_merge($messages, $messagesResponse->getMessages());
					$pageToken = $messagesResponse->getNextPageToken();
				}
			} catch (Exception $e) {
			  print 'An error occurred: ' . $e->getMessage();
			}
		} while ($pageToken);*/
		$opt_param['maxResults'] = '10';
		$opt_param['labelIds'] = array('INBOX');
		$messagesResponse = $service->users_messages->listUsersMessages($userId, $opt_param);
		if ($messagesResponse->getMessages()) {
			$messages = array_merge($messages, $messagesResponse->getMessages());
			$pageToken = $messagesResponse->getNextPageToken();
		}

		foreach ($messages as $message) {
			//echo "message id " . $message->getId();
			$data[] = $this->getMessage($service,$userId,$message->getId());
			//print 'Message with ID: ' . $message->getId() . '<br/>';
		}
		
		$result['messages'] = $data;
		$result['next_token']  = $pageToken;

		return $result;
	}
	
	function get_user_id(){
		$oauth2 = new Google_Service_Oauth2($this->client);
		$user = $oauth2->userinfo->get();
		return $user->id;
	}
	
	function getMessage($service, $userId, $messageId) {
		try {
			return $message = $service->users_messages->get($userId, $messageId);
			//print_r($message);
			//print 'Message with ID: ' . $message->getId() . ' retrieved.';
			return $message;
		} catch (Exception $e) {
			print 'An error occurred: ' . $e->getMessage();
		}
	}
	
	function getThreadCurl($userId, $threadId){
		//print_r($_SESSION['id_token_token']);
		//exit;
		$url = "https://www.googleapis.com/gmail/v1/users/$userId/threads/$threadId?key=AIzaSyC3gUBjpq43UMBkb9PP2lCI5anj72GSmK8";

		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		'Authorization: Bearer ' . $_SESSION['id_token_token']['access_token']
		));

		$response = curl_exec($ch);
		$success = json_decode($response);
		print_r($success);
	}
	
	function getThread($service, $userId, $threadId) {
		try {
			$thread = $service->users_threads->get($userId, $threadId);
			$thread_m = $thread->getMessages();
			$pay = $thread_m[0]->getPayload();
			
			$mil = $thread_m[0]->internalDate;
			$seconds = $mil / 1000;
			
			if(isset($_COOKIE['tz'])){
				date_default_timezone_set($_COOKIE['tz']);
			}
			
			$today = date("d/m/Y");
			$comp = date("d/m/Y", $seconds);
			
			if($comp==$today){
				$date = date("h:i a", $seconds);
			}else{
				$date = date("M j", $seconds);
			}
			
			$parts = $pay->getParts();
			/*$p = $parts[1]->getBody();
			$body = $p->getData();
			$FOUND_BODY = $this->decodeBody($body);*/
			/*foreach ($parts  as $part) {
				if($part['body']) {
					$FOUND_BODY = $this->decodeBody($part['body']->data);
					break;
				}
				// Last try: if we didn't find the body in the first parts, 
				// let's loop into the parts of the parts (as @Tholle suggested).
				if($part['parts'] && !$FOUND_BODY) {
					foreach ($part['parts'] as $p) {
						// replace 'text/html' by 'text/plain' if you prefer
						if($p['mimeType'] === 'text/html' && $p['body']) {
							$FOUND_BODY = $this->decodeBody($p['body']->data);
							break;
						}
					}
				}
				if($FOUND_BODY) {
					break;
				}
			}
			if(!isset($FOUND_BODY)){
				$FOUND_BODY = "";
			}
			
			$thread->msgbody = $FOUND_BODY;*/
			$thread->latest = $date;
			return $thread;
		} catch (Exception $e) {
			echo "aww";
			print 'An error occurred: ' . $e->getMessage();
		}
	}
	
	function getDrafts($service, $userId, $draftId) {
		try {
			$draft = $service->users_drafts->get($userId, $draftId);
			$draft_m = $draft->getMessage();
			$pay = $draft_m->getPayload();
			
			$mil = $draft_m->internalDate;
			$seconds = $mil / 1000;
			
			if(isset($_COOKIE['tz'])){
				date_default_timezone_set($_COOKIE['tz']);
			}
			
			$today = date("d/m/Y");
			$comp = date("d/m/Y", $seconds);
			
			if($comp==$today){
				$date = date("h:i a", $seconds);
			}else{
				$date = date("M j", $seconds);
			}
			
			$parts = $pay->getParts();
			
			$draft->latest = $date;
			return $draft;
		} catch (Exception $e) {
			print 'An error occurred: ' . $e->getMessage();
		}
	}
	
	function getThreadBody($threadId){
		try {
			$userId = $_SESSION['mail_id'];
			$this->client->setAccessToken($_SESSION['id_token_token']);
			$service = new Google_Service_Gmail($this->client);
			$thread = $service->users_threads->get($userId, $threadId);
			$thread_m = $thread->getMessages();
			$pay = $thread_m[0]->getPayload();
			$parts = $pay->getParts();
			foreach ($parts  as $part) {
				if($part['body']) {
					$FOUND_BODY = $this->decodeBody($part['body']->data);
					break;
				}
				// Last try: if we didn't find the body in the first parts, 
				// let's loop into the parts of the parts (as @Tholle suggested).
				if($part['parts'] && !$FOUND_BODY) {
					foreach ($part['parts'] as $p) {
						// replace 'text/html' by 'text/plain' if you prefer
						if($p['mimeType'] === 'text/html' && $p['body']) {
							$FOUND_BODY = $this->decodeBody($p['body']->data);
							break;
						}
					}
				}
				if($FOUND_BODY) {
					break;
				}
			}
			if(!isset($FOUND_BODY)){
				$FOUND_BODY = "";
			}
			
			$thread["body"] = $FOUND_BODY;
			return $thread;
		} catch (Exception $e) {
			print 'An error occurred: ' . $e->getMessage();
		}
	}
	
	function get_more_thread($filter="INBOX") {
		$this->client->setAccessToken($_SESSION['id_token_token']);
		$service = new Google_Service_Gmail($this->client);
		
		$pageToken = NULL;
		$threads = array();
		$opt_param = array();
		
		$opt_param['maxResults'] = '10';
		$opt_param['labelIds'] = array($filter);
		$opt_param['pageToken'] = $_POST['token'];
		
		$threadsResponse = $service->users_threads->listUsersThreads($_SESSION['mail_id'], $opt_param);
		if ($threadsResponse->getThreads()) {
			$threads = array_merge($threads, $threadsResponse->getThreads());
			$pageToken = $threadsResponse->getNextPageToken();
		}

		foreach ($threads as $message) {
			$data[] = $this->getThread($service,$_SESSION['mail_id'],$message->getId());
		}
		
		$result['threads'] = $data;
		$result['next_token']  = $pageToken;


		return $result;
	}
	function get_more_mail(){
		$this->client->setAccessToken($_SESSION['id_token_token']);
		$service = new Google_Service_Gmail($this->client);
		
		$pageToken = NULL;
		$messages = array();
		$opt_param = array();
		
		$opt_param['maxResults'] = '10';
		$opt_param['labelIds'] = array('INBOX');
		$opt_param['pageToken'] = $_POST['token'];
		$messagesResponse = $service->users_messages->listUsersMessages($_SESSION['mail_id'], $opt_param);
		if ($messagesResponse->getMessages()) {
			$messages = array_merge($messages, $messagesResponse->getMessages());
			$pageToken = $messagesResponse->getNextPageToken();
		}

		foreach ($messages as $message) {
			$data[] = $this->getMessage($service,$_SESSION['mail_id'],$message->getId());
		}
		
		$result['messages'] = $data;
		$result['next_token']  = $pageToken;

		return $result;
	}
	
	function decodeBody($body) {
		$rawData = $body;
		$sanitizedData = strtr($rawData,'-_', '+/');
		$decodedMessage = base64_decode($sanitizedData);
		if(!$decodedMessage){
			$decodedMessage = FALSE;
		}
		
		return $decodedMessage;
	}
}


