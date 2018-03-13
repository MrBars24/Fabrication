<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UpdateJob extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->template->set_template("default");
	}


    public function updateJob($id){
        $this->load->model('job_model');
        $data = array(
            'title' => $this->input->post('title'),
            'description' => $this->input->post('desc'),
            'slug' => $this->slug($this->input->post('title')),
            'project_start' => $this->input->post('pstart'),
            'project_end' => $this->input->post('pend'),
            'bidding_start_at' => $this->input->post('bstart'),
            'bidding_expire_at' => $this->input->post('bend'),
            'budget_max' => $this->input->post('max_budget'),
            'budget_min' => $this->input->post('min_budget'),
        );
        $result = $this->job_model->UpdateJob($id, $data);
        if($result){
            return json(array(
                'success' => TRUE,
                'data' => $data
            ),201);
        }
        return json(array(
            'success'=> FALSE
        ), 400);
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
