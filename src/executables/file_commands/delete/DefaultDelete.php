<?php

namespace Executables\FileCommands\Delete;

class DefaultDelete extends DeleteAbstract
{

	public function __construct($path)
	{
		parent::__construct($path);
	}

	public function execute()
	{
		$fileExists = file_exists($this->getPath());

		if (!$fileExists) {
			throw new \RuntimeException('Could not delete file ' . $this->getPath());
		}

		if (unlink($this->getPath()) == false) {
			throw new \RuntimeException('Could not delete file ' . $this->getPath());
		}
	}

}