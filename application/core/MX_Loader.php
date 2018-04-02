<?php


class MX_Loader extends CI_Loader {
    public function __construct() {
        parent::__construct();
    }

    public function notification($notification_class, $params = array()) {
        $CI =& get_instance();

        $class = APPPATH . 'notifications/' . $notification_class;
        if ( !class_exists($class))
		{
            require $class . '.php';
            return new $notification_class($params);
        }
        else {
            throw new Exception('Class not found');
        }

    }
}