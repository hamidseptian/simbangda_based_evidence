<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('get_csrf_token')) {
    function get_csrf_token() {
        $CI =& get_instance();
        echo json_encode([
            'csrf_token' => $CI->security->get_csrf_hash()
        ]);
    }
}