<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Data{
	public $CI;
	function __construct(){
		$this->CI =& get_instance();
		$this->CI->load->library('pagination');
	}
	
	public function pageSetting($base_url, $total_row, $result_per_page, $num_link, $uri_segment = ''){
        if(!$uri_segment){
            $uri_segment = 3;
        }
        $config = array();
        $suffix_url = '';
        $config["base_url"] = $base_url;
        $config["total_rows"] = $total_row;
        $config["per_page"] = $result_per_page;
        $config['use_page_numbers'] = TRUE;
        $config['page_query_string'] = FALSE;
        $config['reuse_query_string'] = FALSE;
        if(count($_GET) > 0){
            $suffix_url = '?'.http_build_query($_GET, '', "&");
            $config['suffix'] = $suffix_url;
        }
        $config['first_url'] = $config['base_url'].$suffix_url;
        $config['num_links'] = $num_link;
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = '&laquo; First';
        $config['first_tag_open'] = '<li class="prev page">';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = 'Last &raquo;';
        $config['last_tag_open'] = '<li class="next page">';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = 'Next &rarr;';
        $config['next_tag_open'] = '<li class="next page">';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '&larr; Previous';
        $config['prev_tag_open'] = '<li class="prev page">';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page">';
        $config['num_tag_close'] = '</li>';
        $config["uri_segment"] = $uri_segment;
        $this->CI->pagination->initialize($config);
    }
}
?>