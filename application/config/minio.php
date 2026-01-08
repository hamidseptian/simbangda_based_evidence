<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['minio'] = [
    'key'    => $_ENV['MINIO_ACCESS_KEY'],
    'secret' => $_ENV['MINIO_SECRET_KEY'],
    'endpoint' => $_ENV['MINIO_ENDPOINT'],// . ':' . $_ENV['MINIO_PORT'],
    'region' => 'us-east-1',
    'bucket' => $_ENV['MINIO_BUCKET'],
    'use_path_style_endpoint' => true,
];
