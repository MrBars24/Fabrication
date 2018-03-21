<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Portfolio extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->template->set_template("default");
        $this->load->model('portfolio_model');
        $this->load->model('industry_model');
	}

      
	public function index()
	{	$js = array(
            "assets/plugins/dropzone-master/dist/dropzone.js",
            "assets/admin/custom/js/bars-datatable.js",
            "assets/plugins/moment/moment.js",
			"assets/plugins/toastr/toastr.js",
            "assets/global.js",
			"assets/default/custom/js/settings/portfolio-settings.js"
		);
		$css = array(
            "assets/plugins/dropzone-master/dist/dropzone.css",
			"assets/plugins/toast-master/css/jquery.toast.css" 
		);

		$this->template->append_js($js);
		$this->template->append_css($css);
		//$data = $this->portfolio_model->getAllPortfolio();
		$industry = $this->industry_model->getIndustries();
		//$this->template->load_sub('portfolios', $data);
		$this->template->load_sub('industries', $industry);
		$this->template->load('frontend/settings/portfolio-settings');
		
		
	}
	public function fetch(){
		header("Content-Type:application/json");
		$portfolioList = $this->portfolio_model->all();
		echo json_encode($portfolioList);
	}

	function store(){
		 header("Content-Type:application/json");
            $this->form_validation->set_rules('title', 'Title', 'required');
            $this->form_validation->set_rules('description', 'Description', 'required');
        if($this->form_validation->run() == FALSE){
                $error = $this->form_validation->error_array(); 
                echo json_encode( array(
                    'success' => FALSE,
                    'errors' => $error
                ));
            }else{
        $storeFolder = 'attached';
		$files = array();

			if(is_array($_FILES['myFile'])){
		      	$files = $_FILES['myFile'];

		     	for($i=0; $i<count($files['name']); $i++){
			        $tempFile = $_FILES['myFile']['tmp_name'][$i];
			        $file = time() . $_FILES['myFile']['name'][$i];
			        $targetPath = $storeFolder .DIRECTORY_SEPARATOR;  //4
			        $targetFile =  $targetPath. $file;

			        if(move_uploaded_file($tempFile,$targetFile)){
			          	array_push($files,array("file"=>"/".$targetFile));
			        }
		      	}
			}
            $data = array(
                "project_name" => $this->input->post('title'),
                "description" => $this->input->post('description'),
                "category" => $this->input->post('category'),
                );
                $res = $this->portfolio_model->save($data);
                $a = $this->portfolio_model->createAttached($files, $res->id);
                if($res and $a){
                    echo json_encode(array("success" => TRUE,"data" => $res));
                    exit;
                }else{
                    echo json_encode(array("success" => FALSE));
                    exit;
                }
    }}

	function update($id){
		header("Content-Type:application/json");
            $this->form_validation->set_rules('title', 'Title', 'required');
            $this->form_validation->set_rules('description', 'Description', 'required');

            if($this->form_validation->run() == FALSE){
                $error = $this->form_validation->error_array(); 
                echo json_encode( array(
                    'success' => FALSE,
                    'errors' => $error
                ));
            }
        else{
		$data = array(
                "project_name" => $this->input->post('title'),
                "description" => $this->input->post('description'),
                "category" => $this->input->post('category')
            );

		if($res = $this->portfolio_model->update($id,$data)){
			echo json_encode(array("success" => TRUE, "data" => $res));
		}else{
			echo json_encode(array("success" => FALSE));
		}
	}
}

	function destroy($id){
		header("Content-Type:application/json");
		if($this->portfolio_model->destroy($id)){
			echo json_encode(array("success" => TRUE));
		}else{
			echo json_encode(array("success" => FALSE));
		}
	}



}
