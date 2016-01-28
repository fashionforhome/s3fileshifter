<?php

namespace Executables\FileCommands;

use Executables\FileCommands\Copy\DefaultCopy;

use Executables\FileCommands\Scan\DefaultShift;

use Executables\FileCommands\Delete\DefaultDelete;

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
			case 'DefaultCopy' :
				return new DefaultCopy($arguments['src'], $arguments['dest']);

			case 'DefaultScan' :
				return new DefaultShift($arguments['path']);

			case 'DefaultDelete' :
				return new DefaultDelete($arguments['path']);

			case 'Shift' :
				return new DefaultShift($arguments['copy'], $arguments['delete']);

			default :
				throw new \InvalidArgumentException('Command ' . $commandName . ' not found.');
		}
	}

}


