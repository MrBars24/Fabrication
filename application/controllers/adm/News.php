<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH."controllers/Admin.php"); 
class News extends Admin {

	public function __construct(){
		parent::__construct();
		$this->load->model("admin/cms_model");
		//$this->load->model('industry_model');
		$this->load->model("admin/news_model");
	}

	public function index()
	{
		$this->template->append_css(array(
			"assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css"
		));

		$this->template->append_js(
			array(
				"assets/plugins/tinymce/tinymce.min.js",
				"assets/admin/js/mask.js",
				"assets/plugins/moment/moment.js",
				"assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js",
				"assets/admin/custom/js/bars-datatable.js",
				"assets/admin/custom/js/news-articles.js"
			)
		);

		//$industries = $this->industry_model->getIndustries();
		//$this->template->load_sub("industries",$industries);
		$this->template->load("frontend/admin/news-articles");
	}

	public function fetch(){
		header("Content-Type:application/json");
		$news = $this->news_model->all();
		echo json_encode($news);
	}

	function store(){
		header("Content-Type:application/json");
		$data = array(
			"title" => $this->input->post('title'),
			"slug" => $this->input->post('slug'),
			"description" => $this->input->post('desc'),
			"author" => $this->session->user->username,
		);

		if($res = $this->news_model->save($data)){
			echo json_encode(array("success" => TRUE,"data" => $res));
		}else{
			echo json_encode(array("success" => FALSE));
		}
	}

	function update($id){
		header("Content-Type:application/json");
		$data = array(
			"title" => $this->input->post('title'),
			"slug" => $this->input->post('slug'),
			"description" => $this->input->post('desc'),
			"author" => $this->session->user->username,
		);

		if($res = $this->news_model->update($id,$data)){
			echo json_encode(array("success" => TRUE, "data" => $res));
		}else{
			echo json_encode(array("success" => FALSE));
		}
	}

	function destroy($id){
		header("Content-Type:application/json");
		if($this->news_model->destroy($id)){
			echo json_encode(array("success" => TRUE));
		}else{
			echo json_encode(array("success" => FALSE));
		}
	}

}
