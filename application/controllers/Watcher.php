<?php
class Watcher extends MX_Controller{
	
	function __construct(){
		parent::__construct();
		$this->load->helper('file');
		$this->load->model('watch_model');
	}
	
	function watchJobs(){
		echo "WRITE";
		write_file('test.txt','ITS 12 AM --- ' . date('Y-m-d'));
		
		$this->watch_model->closeJobsToday();
		$this->watch_model->closeSubscriptionToday();
	}
}