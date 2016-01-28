<?php

require_once('../vendor/autoload.php');

use Aws\S3\S3Client;

$config = file_get_contents('../resources/config.json');

if ($config === false) {
	die('Could not load config.json');
}

$config = json_decode($config, true);

//register the S3 stream wrapper
$s3Client = new S3Client($config);
$s3Client->registerStreamWrapper();