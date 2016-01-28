<?php

namespace Executables\FileCommands\Copy;

class DefaultCopy extends CopyAbstract
{

	public function __construct($source, $destination)
	{
		parent::__construct($source, $destination);
	}

	public function execute()
	{
		$fileExists = file_exists($this->getSource());

		if ($fileExists === false) {
			throw new \RuntimeException('Could not copy file ' . $this->getSource());
		}

		$test = copy($this->getSource(), $this->getDestination());
		var_dump($test);

		if ($test === false) {
			var_dump($this->getSource());
			throw new \RuntimeException('Could not copy file ' . $this->getSource());
		}
	}

}