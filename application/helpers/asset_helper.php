<?php
function asset($path)
{
    return rtrim($_ENV['MINIO_ENDPOINT'], '/') . '/'
         . $_ENV['MINIO_BUCKET'] . '/assets/'
         . ltrim($path, '/');
}
