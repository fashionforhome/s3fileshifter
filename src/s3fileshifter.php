<?php

require_once('../vendor/autoload.php');
use Symfony\Component\Console\Application;
use Executables\FileCommands;

use Executables\FileCommands\Copy;

// TODO implement

FileCommands\FileCommandFactory::getCommand('LocalToS3Copy', array('a', 'b'));

//$console = new Application();
//
//$console->run();