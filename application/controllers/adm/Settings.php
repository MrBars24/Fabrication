<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH."controllers/Admin.php"); 
class Settings extends Admin {

	public function __construct(){
		parent::__construct();
	}

	public function saveSettings(){
		header("Content-Type:application/json");
		
		$post = $this->input->post();

		$data = array(
			"site_name"=>$post['site_name']
		);
		if ($_FILES['site_logo']['size'] > 0) {
			$this->uploadSiteImage($post);
			$data['site_logo'] = $post['site_logo'];
		}

		$res = $this->cms_model->updateSiteSettings($data);
		if($res){
			$this->load->driver('cache');
			$this->cache->file->save('sconfig', $res , 5000);

			echo json_encode(array(
				"success"=>TRUE
			));
		}else{
			echo json_encode(array(
				"success"=>FALSE
			));
		}
	}

	public function uploadSiteImage(&$data){
		$storeFolder = 'photo/';
		if(!is_dir("./".$storeFolder)){
			//Directory does not exist, so lets create it.
			mkdir("./".$storeFolder, 0755);
		}

		$pics = array();
		if (!empty($_FILES)) {
			$allowed =  array('gif','png' ,'jpg');

			$tempFile = $_FILES['site_logo']['tmp_name'];
			$path = $_FILES['site_logo']['name'];
			$ext = pathinfo($path, PATHINFO_EXTENSION);

			if(in_array($ext, $allowed)){
				$file = "logo.".$ext; 
				$targetPath = $storeFolder .DIRECTORY_SEPARATOR;
				$targetFile =  $targetPath. $file;

				$result = glob ("./photo/logo.*");
				if(count($result) > 0){
					foreach($result as $r){
						unlink($r);
					}
				}
				$data['site_logo'] = $targetFile;
				return move_uploaded_file($tempFile,$targetFile);
			}
		}

		return FALSE;
	}

}
