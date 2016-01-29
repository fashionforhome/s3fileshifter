<?php

require_once(__DIR__ . '/../vendor/autoload.php');

use Aws\S3\S3Client;


$config = file_get_contents(__DIR__ . '/../resources/config.json');

if ($config === false) {
	die('Could not load config.json');
}

$config = json_decode($config, true);

//register the S3 stream wrapper
$s3Client = new S3Client($config);

$streamWrapper = new \Aws\S3\StreamWrapper();
$streamWrapper->register($s3Client);
//$s3Client->registerStreamWrapper();