<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UpdateJob extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->template->set_template("default");
		$this->load->model('job_model');
		$this->load->model('proposal_model');
	}

	public function index($id){
		check_login();
		$css = array(
			"assets/plugins/multiselect/css/multi-select.css",
			"assets/plugins/select2/dist/css/select2.min.css",
			"assets/plugins/bootstrap-select/bootstrap-select.min.css",
			"assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.css",
            "/assets/images/favicon.png",
            "/assets/plugins/bootstrap-select/bootstrap-select.min.css",
            "/assets/plugins/timepicker/bootstrap-timepicker.min.css",
            "/assets/plugins/bootstrap-daterangepicker/daterangepicker.css",
			"/assets/plugins/dropify/dist/css/dropify.min.css",
			"/assets/plugins/dropzone-master/dist/dropzone.css",
			"/assets/plugins/wizard/steps.css",
			"/assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css"
        );
        $js = array(
			"/assets/plugins/moment/moment.js",
			"/assets/default/custom/js/bootstrap-tagsinput.min.js",
			"/assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js",
			"/assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js",
			"/assets/plugins/bootstrap-select/bootstrap-select.min.js",
			"/assets/plugins/select2/dist/js/select2.full.min.js",
			"/assets/plugins/wizard/jquery.steps.min.js",
			"/assets/plugins/wizard/jquery.validate.min.js",
			"/assets/plugins/styleswitcher/jQuery.style.switcher.js",
			"/assets/plugins/switchery/dist/switchery.min.js",
			"/assets/plugins/multiselect/js/jquery.multi-select.js",
			"/assets/plugins/wizard/steps-update.js",
			"/assets/plugins/dropzone-master/dist/dropzone.js",
			"/assets/plugins/timepicker/bootstrap-timepicker.min.js",
			"/assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js",
			"/assets/plugins/bootstrap-daterangepicker/daterangepicker.js",
            "/assets/admin/js/post-job.js",
			"/assets/default/custom/js/update-job.js",
        );
        $this->template->append_css($css);
		$this->template->append_js($js);
		$this->load->model('industry_model');
		$this->load->model('country_model');
		$this->load->model('material_model');
		$getJob = $this->job_model->getJob($id);
		$industries = $this->industry_model->getIndustries();
		$countries = $this->country_model->all();
		$material = $this->material_model->all();
		$getAttachment = $this->proposal_model->getAttachment($getJob->id);
		if(auth() != null){
			$this->template->load_sub('summary', $this->job_model->getSummary());
		}
		$this->template->load_sub('job', $getJob);
		$this->template->load_sub('material', $material);
		$this->template->load_sub('industries', $industries);
		$this->template->load_sub('countries', $countries);
		$this->template->load_Sub('getAttachment', $getAttachment);
		$this->template->load('frontend/jobs/update_job');
	}

    public function updateJob($id){
		$dettached = explode(",", $this->input->post('removed_attach'));

        $title = $this->input->post('title');
        $description = $this->input->post('description');
        $slug = $this->slug($title);
        $budget_min = $this->input->post('budget_min');
        $budget_max = $this->input->post('budget_max');
        $project_start = $this->input->post('pstart');
        $project_end = $this->input->post('pend');
        $bidding_end = $this->input->post('bend');
		$approx_tonnes = $this->input->post('tonnes');
		$country = $this->input->post('country');
		$city = $this->input->post('city');
		$state = $this->input->post('state');
		$project_category = $this->input->post('industry');
		$material = $this->input->post('material');
        $data = array(
            'title' => $title,
            'project_category' => $project_category,
            'city' => $city,
            'state' => $state,
            'country' => $country,
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
				$this->load->model('job_model');
				//SKillss
				$ds = $this->job_model->removedSkills($id);
				$s = $this->job_model->createSkillsJob();
				$sk = $this->job_model->createSkillsToJob($s, $id);
				//attachements
				$deletedFiles = $this->job_model->deleteFiles($dettached);
				$a = $this->job_model->createAttached($files,$id);
				//Material Update
				$rm = $this->job_model->removedMaterial($id);
				$materials = array();
				if(is_array($material)){ $materials = $material; }else{ $materials = json_decode($material); }
				$m = $this->job_model->createMaterial($id, $materials);
				//Job Update
				$result = $this->job_model->UpdateJob($id, $data);
				echo json_encode( array(
					'success' => TRUE,
					'job_id' =>  $id
				));
				exit;
			}
		}else{
			if($dettached){
				//attachements
				$deletedFiles = $this->job_model->deleteFiles($dettached);
			}
			//SKillss
			$ds = $this->job_model->removedSkills($id);
			$s = $this->job_model->createSkillsJob();
			$sk = $this->job_model->createSkillsToJob($s, $id);
			//Material Update
			$rm = $this->job_model->removedMaterial($id);
			$materials = array();
			if(is_array($material)){ $materials = $material; }else{ $materials = json_decode($material); }
			$m = $this->job_model->createMaterial($id, $materials);
			//Job Update
			$result = $this->job_model->UpdateJob($id, $data);
			echo json_encode( array(
				'success' => TRUE,
				'job_id' =>  $id
			));
			exit;
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
