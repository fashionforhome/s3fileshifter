<?php

namespace Executables\FileCommands\Scan;


class DefaultShift extends ShiftAbstract
{
	/**
	 * DeleteAbstract constructor.
	 * @param $path
	 */
	public function __construct($path)
	{
		parent::__construct($path);
	}

	public function execute()
	{
		/** @var \RecursiveIteratorIterator $it */
		$it = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($this->getPath()));
		$result = array();

		$it->rewind();

		while ($it->valid()) {
			if (!$it->isDot()) {
				$result[] = $it->key();
			}

			$it->next();
		}

		return $result;
	}

}