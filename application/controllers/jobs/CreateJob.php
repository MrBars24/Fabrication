	<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CreateJob extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->template->set_template("default");
		$css = array(
			"assets/plugins/bootstrap/css/bootstrap.min.css",
			"assets/default/css/style.css",
			"assets/default/css/colors/blue.css",
			"assets/plugins/bootstrap-select/bootstrap-select.min.css"
		);

		$js = array(
			"assets/plugins/jquery/jquery.min.js",
			"assets/plugins/bootstrap/js/popper.min.js",
			"assets/plugins/bootstrap/js/bootstrap.min.js",
			"assets/default/js/jquery.slimscroll.js",
			"assets/default/js/waves.js",
			"assets/default/js/sidebarmenu.js",
			"assets/plugins/sticky-kit-master/dist/sticky-kit.min.js",
			"assets/plugins/sparkline/jquery.sparkline.min.js",
			"assets/default/js/custom.min.js",
			"assets/plugins/styleswitcher/jQuery.style.switcher.js",
			"assets/admin/js/submit-contact-us.js",
			"assets/plugins/select2/dist/js/select2.full.min.js",
			"assets/plugins/bootstrap-select/bootstrap-select.min.js"
		);
		$this->template->set_additional_css($css);
		$this->template->set_additional_js($js);
	}

	public function index(){
        $css = array(
            "assets/images/favicon.png",
            "assets/plugins/timepicker/bootstrap-timepicker.min.css",
            "assets/plugins/bootstrap-daterangepicker/daterangepicker.css",
			"assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.css",
			"assets/plugins/dropify/dist/css/dropify.min.css",
			"assets/plugins/dropzone-master/dist/dropzone.css"

        );
        $js = array(
            "assets/plugins/moment/moment.js",
            "assets/plugins/timepicker/bootstrap-timepicker.min.js",
            "assets/plugins/bootstrap-daterangepicker/daterangepicker.js",
            "assets/admin/js/post-job.js",
			"assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js",
			"assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js",
			"assets/plugins/multiselect/js/jquery.multi-select.js",
			"assets/plugins/switchery/dist/switchery.min.js",
			"assets/plugins/select2/dist/js/select2.full.min.js",
			"assets/plugins/bootstrap-select/bootstrap-select.min.js",
			"assets/plugins/styleswitcher/jQuery.style.switcher.js",
			"assets/plugins/dropify/dist/js/dropify.min.js",
			"assets/plugins/dropzone-master/dist/dropzone.js",
			"assets/default/custom/js/create-job.js"
        );
        $this->template->append_css($css);
		$this->template->append_js($js);

		$this->load->model('Industry_model');

		$industries = $this->Industry_model->getIndustries();
		$this->template->load_sub('industries', $industries);
        $this->template->load('frontend/jobs/create_job');
	}

	public function createJob(){
		$fabricator_id = $_SESSION['user']->id;
        $title = $this->input->post('title');
        $description = $this->input->post('description');
        $slug = $this->slug($title);
        $budget_min = $this->input->post('budget_min');
        $budget_max = $this->input->post('budget_max');
        $project_start = date("Y-m-d h:i:s", strtotime(substr($this->input->post('project'), 0,10)));
        $project_end = date("Y-m-d h:i:s", strtotime(substr($this->input->post('project'), -10)));
        $bidding_start = date("Y-m-d ",strtotime(substr($this->input->post('bidding'), 0,10)));
        $bidding_end = date("Y-m-d ",strtotime(substr($this->input->post('bidding'), -10)));

        $data = array(
            'fabricator_id' => $fabricator_id,
            'title' => $title,
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
				$r = $this->job_model->createJob($data);
				$a = $this->job_model->createAttached($files,$r);

				if($r && $a){
					echo json_encode( array(
						'success' => 201
					));
				}
			}
		}
		// $this->load->library('upload', $config);
        // $config['upload_path']          = './uploads/attached/';
        // $config['allowed_types']        = '*';
        // $config['max_size']             = 100;
	    // $config['max_width']            = 1024;
	    // $config['max_height']           = 768;
		// if(!$this->upload->do_upload('userfile')){
		// 	echo json_encode(array(
		// 		'success' => false,
		// 		'error' => $this->upload->display_errors()
		// 	));
		// }
		// else{
		// }
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
