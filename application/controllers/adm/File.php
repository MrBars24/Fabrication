<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH."controllers/Admin.php"); 
class File extends Admin {

	public function __construct(){
		parent::__construct();
		$this->load->model("admin/cms_model");
	}

	public function index()
	{
		$this->template->append_js(
			array(
				"/assets/plugins/cropper/cropper.min.js",
				"/assets/admin/custom/js/bars-datatable.js",
				"/assets/admin/custom/js/image-upload.js"
			)
		);

		$this->template->append_css(array(
			"assets/plugins/cropper/cropper.min.css"
		));

		$this->template->load('frontend/admin/image-assets');
	}

	function getImageAsssets(){
		header("Content-Type:application/json");
		$assets = $this->cms_model->getAssetList();
		echo json_encode($assets);
	}

	function uploadImage(){
		header("Content-Type:application/json");
		$src = $this->input->post('src');
		$name = $this->input->post('filename');
		$type = $this->input->post('filetype');
		$n = time().$name;
		
		$src = str_replace('data:image/jpg;base64,', '', $src);
		$src = str_replace('data:image/jpeg;base64,', '', $src);
		$src = str_replace('data:image/png;base64,', '', $src);
		$src = str_replace(' ', '+', $src);
		$data = base64_decode($src);
		file_put_contents("photo/assets/".$n, $data);

		$res = $this->cms_model->insertImageAsset(array(
			"path"=>"photo/assets/".$n,
			"filename"=>$name,
			"filetype"=>$type,
			"type"=>"image"
		));

		if($res){
			echo json_encode(array(
				"success" => TRUE,
				"data" => $res
			));
		}else{
			echo json_encode(array(
				"success" => FALSE
			));
			unlink("photo/assets/".$n);
		}
	}

}
