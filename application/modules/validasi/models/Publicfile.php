<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Publicfile extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // $this->load->library(array('minio_client'));
    }

    public function view($encoded = null)
    {
        if (!$encoded) {
            show_404();
        }

        // Dekripsi object_key
        $decoded = base64_decode(urldecode($encoded));
        $object_key = $this->encryption->decrypt($decoded);
        $filename = basename($object_key); 
        $filename = preg_replace('/^[a-z0-9]{8,}_/', '', $filename);
        

        if (!$object_key) {
            show_404();
        }

        // Ambil URL dari MinIO
        $url = $this->minio_client->get_file_url($object_key);
        if (!$url) {
            show_404();
        }

        // Ambil konten file dari URL
        $imageContent = @file_get_contents($url);
        if ($imageContent === false) {
            show_404();
        }

        // Tentukan Content-Type (bisa juga pakai getimagesizefromstring)
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_buffer($finfo, $imageContent);
        finfo_close($finfo);

        // Kirim gambar ke browser
        header('Content-Type: ' . $mimeType);
        header("Content-Disposition: inline; filename=\"$filename\"");
        echo $imageContent;
    }
    public function store()
    {
        header('Content-Type: application/json');

        if (empty($_FILES['image']['name'])) {
            echo json_encode([
                'status' => false,
                'message' => 'No file uploaded',
                'csrf_hash' => $this->security->get_csrf_hash()
            ]);
            return;
        }
        $folder = date('Y/m');

        $upload = $this->minio_client->upload('images/'.$folder. '/',
                $_FILES['image']['tmp_name'],
                $_FILES['image']['name']); 
        
        if ($upload['success']) {
            $fileSize  = $_FILES['image']['size'];
            $object_key = 'images/'.$folder. '/'. $upload['filname'];
            $encryptedKey = urlencode(base64_encode($this->encryption->encrypt($object_key)));
            echo json_encode([
                'success' => true,
                'file' => ['url' => $upload['url'],'name' => $upload['filname'],'size' => $fileSize,'file_publik' => site_url('fitur/publicfile/view/' . $encryptedKey) ],
                'csrf_hash' => $this->security->get_csrf_hash()
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' =>  $upload['error'],
                'csrf_hash' => $this->security->get_csrf_hash()
            ]);
        }
    }

    public function storefile()
    {
        header('Content-Type: application/json');

        if (empty($_FILES['file']['name'])) {
            echo json_encode([
                'success' => false,
                'message' => 'No file uploaded',
                'csrf_hash' => $this->security->get_csrf_hash()
            ]);
            return;
        }
        $folder = date('Y/m');

        $upload = $this->minio_client->upload_file('images/'.$folder. '/',
                $_FILES['file']['tmp_name'],
                $_FILES['file']['name']); 
        
        if ($upload['success']) {
            $fileSize  = $_FILES['file']['size'];
            $object_key = 'images/'.$folder. '/'. $upload['filname'];
            $encryptedKey = urlencode(base64_encode($this->encryption->encrypt($object_key)));
            echo json_encode([
                'success' => true,
                'file' => ['url' => $upload['url'],'name' => $upload['filname'],'size' => $fileSize,'file_publik' => site_url('fitur/publicfile/view/' . $encryptedKey) ],
                'csrf_hash' => $this->security->get_csrf_hash()
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' =>  $upload['error'],
                'csrf_hash' => $this->security->get_csrf_hash()
            ]);
        }
    }

}