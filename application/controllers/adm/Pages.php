<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH."controllers/Admin.php"); 
class Pages extends Admin {

	public function __construct(){
		parent::__construct();
		$this->load->model("admin/cms_model");
	}

	public function index()
	{
		$this->template->append_js(
			array(
				"assets/admin/custom/js/pages-create.js"
			)
		);
		$pages = $this->cms_model->getPageList();
		$this->template->load_sub("pages",$pages);
		$this->template->load("frontend/admin/pages");
	}

	public function pageCreation(){
		$this->template->append_js(
			array(
				"assets/plugins/tinymce/tinymce.js",
				"assets/admin/custom/js/pages-create.js"
			)
		);
		$this->template->load("frontend/admin/pages-create");	
	}

	public function pageUpdate($id){
		$this->template->append_js(
			array(
				"assets/plugins/tinymce/tinymce.min.js",
				"assets/admin/custom/js/pages-create.js"
			)
		);
		$page = $this->cms_model->getPageById($id);
		$this->template->load_sub("info",$page);
		$this->template->load("frontend/admin/pages-edit");
	}

	public function submitPage(){
		header("Content-Type:application/json");
		$data = array(
			"name"=>$this->input->post("page_name"),
			"page_url"=>$this->input->post("page_url"),
			"custom_css"=>$this->input->post("custom_css"),
			"custom_js"=>$this->input->post("custom_js"),
			"content"=>$this->input->post("page_content"),
		);

		if($this->cms_model->createPage($data)){
			$this->session->set_flashdata("page_msg",'<div class="alert alert-success">
	            <span class="content">Page successfully created.</span> 
	            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	                <span aria-hidden="true">×</span> 
	            </button>
	        </div>');

			echo json_encode(array(
				"success" => TRUE
			));
		}else{
			echo json_encode(array(
				"success" => FALSE
			));
		}
	}

	public function submitPageUpdate($id){
		header("Content-Type:application/json");
		$data = array(
			"name"=>$this->input->post("page_name"),
			"page_url"=>$this->input->post("page_url"),
			"custom_css"=>$this->input->post("custom_css"),
			"custom_js"=>$this->input->post("custom_js"),
			"content"=>$this->input->post("page_content"),
		);

		if($this->cms_model->updatePage($id,$data)){
			$this->session->set_flashdata("page_msg",'<div class="alert alert-success">
	            <span class="content">Page successfully updated.</span> 
	            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	                <span aria-hidden="true">×</span> 
	            </button>
	        </div>');

			echo json_encode(array(
				"success" => TRUE
			));
		}else{
			echo json_encode(array(
				"success" => FALSE
			));
		}
	}

	public function submitPageDelete($id){
		header("Content-Type:application/json");
		if($this->cms_model->deletePage($id)){
			echo json_encode(array(
				"success" => TRUE
			));
		}else{
			echo json_encode(array(
				"success" => FALSE
			));
		}
	}

}
