<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Aws\S3\S3Client;

class Minio
{
    protected $s3;

    public function __construct()
    {
        $this->s3 = new S3Client([
            'version'     => 'latest',
            'region'      => $_ENV['MINIO_REGION'],
            'endpoint'    => $_ENV['MINIO_ENDPOINT'],
            'use_path_style_endpoint' => true,
            'credentials' => [
                'key'    => $_ENV['MINIO_ACCESS_KEY'],
                'secret' => $_ENV['MINIO_SECRET_KEY'],
            ],
            'http' => [
                'verify' => ($_ENV['MINIO_USE_SSL'] === 'true')
            ],
        ]);
    }

    public function upload($objectName, $filePath, $contentType = 'application/octet-stream')
    {
        return $this->s3->putObject([
            'Bucket' => $_ENV['MINIO_BUCKET'],
            'Key'    => $objectName,
            'SourceFile' => $filePath,
            'ContentType' => $contentType,
        ]);
    }

    public function delete($objectName)
    {
        return $this->s3->deleteObject([
            'Bucket' => $_ENV['MINIO_BUCKET'],
            'Key'    => $objectName,
        ]);
    }

    public function getUrl($objectName)
    {
        return $_ENV['MINIO_ENDPOINT'] . '/' . $_ENV['MINIO_BUCKET'] . '/' . $objectName;
    }

    public function presignedUrl($objectName, $expire = '+10 minutes')
  {
      $cmd = $this->s3->getCommand('GetObject', [
          'Bucket' => $_ENV['MINIO_BUCKET'],
          'Key'    => $objectName,
          'ResponseContentType' => 'application/pdf'
      ]);

      $request = $this->s3->createPresignedRequest($cmd, $expire);
      return (string) $request->getUri();
  }


}
