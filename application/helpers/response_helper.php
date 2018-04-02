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
        echo '<pre>';
        echo var_dump($data);
        echo '</pre>';
       exit;
    }
}

if ( !function_exists('is_ajax') ) {
    function is_ajax() {
       return get_instance()->input->is_ajax_request();
    }
}
