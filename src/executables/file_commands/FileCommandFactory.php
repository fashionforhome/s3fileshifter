<?php

namespace Executables\FileCommands;

use Executables\FileCommands\Copy\DefaultCopy;

use Executables\FileCommands\Scan\DefaultScan;

use Executables\FileCommands\Delete\DefaultDelete;

use Executables\ExecutableInterface;
use Executables\FileCommands\Shift\DefaultShift;

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
			case 'DefaultCopy' :
				return new DefaultCopy($arguments['src'], $arguments['dest']);

			case 'DefaultScan' :
				return new DefaultScan($arguments['path']);

			case 'DefaultDelete' :
				return new DefaultDelete($arguments['path']);

			case 'DefaultShift' :
				return new DefaultShift($arguments['src'], $arguments['dest']);

			default :
				throw new \InvalidArgumentException('Command ' . $commandName . ' not found.');
		}
	}

}


