<?php

namespace Executables\FileCommands\Delete;

class LocalDelete extends DeleteAbstract
{

	public function __construct($path)
	{
		parent::__construct($path);
	}

	public function execute()
	{
		$fileExists = file_exists($this->getPath());

		if ($fileExists) {
			if (unlink($this->getPath()) == false) {
				throw new \RuntimeException('Could not delete file ' . $this->getPath());
			}
		} else {
			throw new \RuntimeException('Could not delete file ' . $this->getPath());
		}
	}

}