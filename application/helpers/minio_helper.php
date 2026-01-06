<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('minio_signed_url')) {

    function minio_signed_url($objectPath, $expire = '+5 minutes')
    {
        $CI =& get_instance();
        $CI->load->library('Minio');

        return $CI->minio->presignedUrl($objectPath, $expire);
    }
}
