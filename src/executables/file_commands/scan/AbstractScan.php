<?php

namespace Executables\FileCommands\Scan;

use Executables\ExecutableInterface;

abstract class AbstractScan implements ExecutableInterface
{
	
	/**
	 * DeleteAbstract constructor.
	 * @param $path
	 */
	public function __construct($path)
	{
		$this->path = $path;
	}

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
	 * @return AbstractScan
	 */
	public function setPath($path)
	{
		$this->path = $path;
		return $this;
	}

}