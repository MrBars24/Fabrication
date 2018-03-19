<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CreateJob extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->template->set_template("default");
		$this->load->model('user_model');
		$this->load->model('job_model');
	}

	public function index(){
        $css = array(
            "assets/images/favicon.png",
            "assets/plugins/bootstrap-select/bootstrap-select.min.css",
            "assets/plugins/timepicker/bootstrap-timepicker.min.css",
            "assets/plugins/bootstrap-daterangepicker/daterangepicker.css",
			"assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.css",
			"assets/plugins/dropify/dist/css/dropify.min.css",
			"assets/plugins/dropzone-master/dist/dropzone.css"

        );
        $js = array(
			"assets/plugins/dropzone-master/dist/dropzone.js",
			"assets/default/custom/js/create-job.js",
            "assets/plugins/moment/moment.js",
            "assets/plugins/timepicker/bootstrap-timepicker.min.js",
            "assets/plugins/bootstrap-daterangepicker/daterangepicker.js",
			"assets/plugins/bootstrap-select/bootstrap-select.min.js",
            "assets/admin/js/post-job.js",
			"assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js",
			"assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js",
			"assets/plugins/multiselect/js/jquery.multi-select.js",
			"assets/plugins/switchery/dist/switchery.min.js",
			"assets/plugins/select2/dist/js/select2.full.min.js",
			"assets/plugins/styleswitcher/jQuery.style.switcher.js",
			"assets/plugins/dropify/dist/js/dropify.min.js",
        );
        $this->template->append_css($css);
		$this->template->append_js($js);

		$this->load->model('Industry_model');
		$this->load->model('User_model');

		$industries = $this->Industry_model->getIndustries();
		$this->template->load_sub('industries', $industries);
        $this->template->load('frontend/jobs/create_job');
	}

	public function createJob(){
		header("Content-Type:application/json");
		if(auth()->my_posts >= auth()->max_post){
			echo json_encode(array(
				'success' => FALSE,
				'error' => "account_type",
				'message' => "You've reach the maximum amount of post."
			));
			exit;
		}
		$fabricator_id = auth()->id;
        $title = $this->input->post('title');
        $description = $this->input->post('description');
        $slug = $this->slug($title);
        $budget_min = $this->input->post('budget_min');
        $budget_max = $this->input->post('budget_max');
        $project_start = date("Y-m-d h:i:s", strtotime(substr($this->input->post('project'), 0,10)));
        $project_end = date("Y-m-d h:i:s", strtotime(substr($this->input->post('project'), -10)));
        $bidding_start = date("Y-m-d ",strtotime(substr($this->input->post('bidding'), 0,10)));
        $bidding_end = date("Y-m-d ",strtotime(substr($this->input->post('bidding'), -10)));
		$approx_tonnes = $this->input->post('tonnes');
		$location = $this->input->post('location');
		$project_category = $this->input->post('industry');
        $data = array(
            'fabricator_id' => $fabricator_id,
            'title' => $title,
            'project_category' => $project_category,
            'location' => $location,
            'approx_tonnes' => $approx_tonnes,
            'description' => $description,
            'budget_min' => $budget_min,
            'budget_max' => $budget_max,
            'project_start' => $project_start,
            'project_end' => $project_end,
            'bidding_start_at' => $bidding_start,
            'bidding_expire_at' => $bidding_end,
            'slug' => $slug,
        );

		$storeFolder = 'attached';
		$files = array();
		if (!empty($_FILES)) {
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
				$r = $this->job_model->createJob($data);
				$a = $this->job_model->createAttached($files,$r);
				$this->user_model->updateUserSession();

				if($r && $a){
					echo json_encode( array(
						'success' => 201
					));
				}
			}
		}else{
			$r = $this->job_model->createJob($data);
			$this->user_model->updateUserSession();

			echo json_encode( array(
				'success' => 201
			));
		}


	}

	function slug($text){
		$trans = [
			'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'jo', 'ж' => 'zh', 'з' => 'z', 'и' => 'i', 'й' => 'jj',
			'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f',
			'х' => 'kh', 'ц' => 'c', 'ч' => 'ch', 'ш' => 'sh', 'щ' => 'shh', 'ъ' => '', 'ы' => 'y', 'ь' => '', 'э' => 'eh', 'ю' => 'ju', 'я' => 'ja',
		];
		$text  = mb_strtolower( $text, 'UTF-8' ); // lowercase cyrillic letters too
		$text  = strtr( $text, $trans ); // transliterate cyrillic letters
		$text  = preg_replace( '/[^A-Za-z0-9 _.]/', '', $text );
		$text  = preg_replace( '/[ _.]+/', '-', trim( $text ) );
		$text  = trim( $text, '-' );
		return $text;
	}
}
