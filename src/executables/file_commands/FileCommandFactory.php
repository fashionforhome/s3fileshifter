<?php

namespace Executables\FileCommands;

use Executables\FileCommands\Copy\LocalToS3Copy;
use Executables\FileCommands\Copy\S3ToLocalCopy;

use Executables\FileCommands\Scan\LocalScan;
use Executables\FileCommands\Scan\S3Scan;

use Executables\FileCommands\Delete\LocalDelete;
use Executables\FileCommands\Delete\S3Delete;

use Executables\ExecutableInterface;

class FileCommandFactory
{

	/**
	 * Factory for commands
	 *
	 * @param $commandName
	 * @param $arguments
	 * @return ExecutableInterface
	 * @throws \InvalidArgumentException
	 */
	public static function getCommand($commandName, $arguments)
	{
		switch ($commandName) {
			case 'LocalToS3Copy' :
				return new LocalToS3Copy($arguments['src'], $arguments['dest']);
			case 'S3ToLocalCopy' :
				return new S3ToLocalCopy($arguments['src'], $arguments['dest']);

			case 'LocalScan' :
				return new LocalScan($arguments['path']);
			case 'S3Scan' :
				return new S3Scan($arguments['path']);

			case 'LocalDelete' :
				return new LocalDelete($arguments['path']);
			case 'S3Delete' :
				return new S3Delete($arguments['path']);

			case 'Shift' :
				return new Shift($arguments['copy'], $arguments['delete']);

			default :
				throw new \InvalidArgumentException('Command ' . $commandName . ' not found.');
		}

	}

}


