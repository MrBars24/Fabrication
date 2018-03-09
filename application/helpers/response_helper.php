<?php

if ( !function_exists('json') ) {
    function json($data, $status = 200) {
        $CI = &get_instance();
        
        return $CI->output
            ->set_content_type('application/json')
            ->set_status_header($status)
            ->set_output(json_encode($data));
    }
}

if ( !function_exists('dd') ) {
    function dd($data) {
       echo var_dump($data);
       exit;
    }
}