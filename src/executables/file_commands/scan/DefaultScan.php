<?php

namespace Executables\FileCommands\Scan;


class DefaultScan extends AbstractScan
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
		if (is_file($this->getPath())) {
			return array(basename($this->getPath()));
		}

		/** @var \RecursiveIteratorIterator $it */
		$it     = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($this->getPath()));
		$result = array();

		// iterate over the directory and its subdirectories
		$it->rewind();

		while ($it->valid()) {
			if (!$it->isDot()) {
				$result[] = $it->getSubPathName();
			}

			$it->next();
		}

		return $result;
	}

}