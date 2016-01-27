<?php

namespace Executables\FileCommands\Scan;

use Executables\ExecutableInterface;

abstract class ScanAbstract implements ExecutableInterface
{

	private $path;

	/**
	 * @return mixed
	 */
	public function getPath()
	{
		return $this->path;
	}

	/**
	 * @param mixed $path
	 * @return ScanAbstract
	 */
	public function setPath($path)
	{
		$this->path = $path;
		return $this;
	}

}