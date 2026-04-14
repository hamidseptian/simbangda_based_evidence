<?php
use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

class Minio_client {
    protected $s3;
    protected $bucket;
    protected $max_size = 10 * 1024 * 1024; // 3MB
    protected $allowed_types = ['pdf'];
    protected $max_size_file = 80 * 1024 * 1024; // 80MB
    protected $allowed_types_file = ['pdf', 'docx','zip', 'rar', 'xlsx', 'doc', 'pptx', 'ppt','xls','csv','jpeg'];

    public function __construct()
    {
        $ci =& get_instance();
        $ci->load->config('minio');
        $config = $ci->config->item('minio');

        $this->bucket = $config['bucket'];

        $this->s3 = new S3Client([
            'version' => 'latest',
            'region'  => $config['region'],
            'endpoint' => $config['endpoint'],
            'use_path_style_endpoint' => $config['use_path_style_endpoint'],
            'credentials' => [
                'key'    => $config['key'],
                'secret' => $config['secret'],
            ]
        ]);
    }

    public function upload($folder,$file_path, $filename)
    {
        $file_ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        // $contentType = 'application/pdf';
        if (!in_array($file_ext, $this->allowed_types)) {
            return [
                'success' => false,
                'error' => 'Jenis file tidak diizinkan. Hanya: ' . implode(', ', $this->allowed_types),
            ];
        }

        $file_size = filesize($file_path);
        if ($file_size > $this->max_size) {
            return [
                'success' => false,
                'error' => 'Ukuran file melebihi<br>Maksimal file boleh diupload : ' . ($this->max_size / 1024 / 1024) . ' MB.',
            ];
        }

        try {
            $unique_name = uniqid() . '_' . $filename;
            $result = $this->s3->putObject([
                'Bucket' => $this->bucket,
                'Key'    => $folder.'/'.$unique_name,
                'SourceFile' => $file_path,
                // 'ContentType' => $contentType,
                // 'ACL'    => 'public-read',
            ]);

            return [
                'success' => true,
                'filname' => $unique_name,
                'url' => $result['ObjectURL'],
            ];
        } catch (S3Exception $e) {
            log_message('error', $e->getMessage());
            return [
                'success' => false,
                'error' => 'Gagal mengunggah ke MinIO: ' . $e,
            ];
        }
    }

    public function upload_spesifik($folder,$file_path, $filename, $spesifik)
    {
        $file_ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        // $contentType = 'application/pdf';
        if (!in_array($file_ext, $spesifik)) {
            return [
                'success' => false,
                'error' => 'Jenis file tidak diizinkan. Hanya: ' . implode(', ', $spesifik),
            ];
        }

        $file_size = filesize($file_path);
        if ($file_size > $this->max_size) {
            return [
                'success' => false,
                'error' => 'Ukuran file melebihi<br>Maksimal file boleh diupload : ' . ($this->max_size / 1024 / 1024) . ' MB.',
            ];
        }

        try {
            $unique_name = uniqid() . '_' . $filename;
            $result = $this->s3->putObject([
                'Bucket' => $this->bucket,
                'Key'    => $folder.'/'.$unique_name,
                'SourceFile' => $file_path,
                // 'ContentType' => $contentType,
                // 'ACL'    => 'public-read',
            ]);

            return [
                'success' => true,
                'filname' => $unique_name,
                'url' => $result['ObjectURL'],
            ];
        } catch (S3Exception $e) {
            log_message('error', $e->getMessage());
            return [
                'success' => false,
                'error' => 'Gagal mengunggah ke MinIO: ' . $e,
            ];
        }
    }

    public function get_file_url($object_key, $expires = '+10 minutes')
    {
        try {
            $cmd = $this->s3->getCommand('GetObject', [
                'Bucket' => $this->bucket,
                'Key'    => $object_key
            ]);

            $request = $this->s3->createPresignedRequest($cmd, $expires);
            $presignedUrl = (string) $request->getUri();

            return $presignedUrl;
        } catch (S3Exception $e) {
            log_message('error', $e->getMessage());
            return false;
        }
    }

    public function delete_file($object_key)
    {
        try {
            $this->s3->deleteObject([
                'Bucket' => $this->bucket,
                'Key'    => $object_key
            ]);
            return true;
        } catch (S3Exception $e) {
            log_message('error', 'MinIO Delete Error: ' . $e->getMessage());
            return false;
        }
    }

    public function upload_file($folder,$file_path, $filename)
    {
        $file_ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        if (!in_array($file_ext, $this->allowed_types_file)) {
            return [
                'success' => false,
                'error' => 'Jenis file tidak diizinkan. Hanya: ' . implode(', ', $this->allowed_types_file),
            ];
        }

        $file_size = filesize($file_path);
        if ($file_size > $this->max_size_file) {
            return [
                'success' => false,
                'error' => 'Ukuran file melebihi (' . ($this->max_size_file / 1024 / 1024) . ' MB).',
            ];
        }

        try {
            $unique_name = uniqid() . '_' . $filename;
            $result = $this->s3->putObject([
                'Bucket' => $this->bucket,
                'Key'    => $folder.$unique_name,
                'Body'   => fopen($file_path, 'r'),
                'SourceFile' => $file_path,
                'ACL'    => 'public-read',
            ]);

            return [
                'success' => true,
                'filname' => $unique_name,
                'url' => $result['ObjectURL'],
            ];
        } catch (S3Exception $e) {
            log_message('error', $e->getMessage());
            return [
                'success' => false,
                'error' => 'Gagal mengunggah ke MinIO: ' . $e->getAwsErrorMessage(),
            ];
        }
    }


    public function download($object_key, $filename = null, $expires = '+10 minutes')
    {
        try {
            // ambil nama file kalau tidak dikirim
            if ($filename === null) {
                $filename = basename($object_key);
            }

            // buat command dengan force download
            $cmd = $this->s3->getCommand('GetObject', [
                'Bucket' => $this->bucket,
                'Key'    => $object_key,
                'ResponseContentDisposition' => 'attachment; filename="'.$filename.'"'
            ]);

            // generate presigned URL
            $request = $this->s3->createPresignedRequest($cmd, $expires);
            $url = (string) $request->getUri();

            // redirect ke file (langsung download)
            header("Location: $url");
            exit;

        } catch (S3Exception $e) {
            log_message('error', 'MinIO Download Error: ' . $e->getMessage());
            show_error('Gagal download file dari server', 500);
        }
    }

}