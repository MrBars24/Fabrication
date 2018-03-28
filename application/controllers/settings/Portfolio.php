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
	{	check_user('member');
        $js = array(
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
        /*$portfolioList = $this->portfolio_model->all();
        $id = array();
        foreach($portfolioList['data'] as $pid){
            $id[] = $pid->id;
        }
        $astig = array();
        $getAttachment = $this->portfolio_model->getAttachment($id);
        foreach($portfolioList['data'] as $pL){
            foreach($getAttachment as $gA){
                if($pL->id == $gA['portfolio_id']){
                    $astig += $gA;
                }
            }
        }
        var_dump($astig);
        exit;
        echo json_encode($portfolioList);*/
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
                    $data = array(
                        "project_name" => $this->input->post('title'),
                        "description" => $this->input->post('description'),
                        "category" => $this->input->post('category'),
                        "user_id" => $_SESSION['user']->id
                        );
                        if(isset($_FILES['myFile'])){
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
                            $res = $this->portfolio_model->save($data);
                            $id2=$res->id;
                            $a = $this->portfolio_model->createAttached($files, $id2);
                            $res->attachments = $this->portfolio_model->getAttachment($res->id);
                            if($res and $a){
                                echo json_encode(array("success" => TRUE,"data" => $res));
                                exit;
                            }else{
                                echo json_encode(array("success" => FALSE));
                                exit;
                            }
                        }else{
                            if($res = $this->portfolio_model->save($data)){
                                echo json_encode(array("success" => TRUE,"data" => $res));
                            }else{
                                echo json_encode(array("success" => FALSE));
                            }
            }
    }
}

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
            }else{
        $storeFolder = 'attached';
		$files = array();
        $data = array(
            "project_name" => $this->input->post('title'),
            "description" => $this->input->post('description'),
            "category" => $this->input->post('category'),
            "user_id" => $_SESSION['user']->id
            );
        $attachId = $this->input->post('attachments');
        if(isset($_FILES['myFile'])){
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
                $res = $this->portfolio_model->update($id,$data);
                $id2=$id;
                $a = $this->portfolio_model->createAttached($files, $id2);
                $b = $this->portfolio_model->deleteAttached($attachId);
                $res->attachments = $this->portfolio_model->getAttachment($res->id);
                if($res and $a){
                    echo json_encode(array("success" => TRUE,"data" => $res));
                    exit;
                }else{
                    echo json_encode(array("success" => FALSE));
                    exit;
                }
            }else{
                $b = $this->portfolio_model->deleteAttached($attachId);
                $res = $this->portfolio_model->update($id,$data);    
                if($res){
                    echo json_encode(array("success" => TRUE,"data" => $res));
                    exit;
                }else{
                    echo json_encode(array("success" => FALSE));
                    exit;
                }
            }   
    }
}

	function destroy($id){
		header("Content-Type:application/json");
        $this->portfolio_model->destroyAttachment($id);
		if($this->portfolio_model->destroy($id)){
			echo json_encode(array("success" => TRUE));
		}else{
			echo json_encode(array("success" => FALSE));
		}
	}



}
