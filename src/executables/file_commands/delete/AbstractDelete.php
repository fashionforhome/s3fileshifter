<?php

namespace Executables\FileCommands\Delete;

use Executables\ExecutableInterface;

abstract class AbstractDelete implements ExecutableInterface
{

	private $path;

	/**
	 * DeleteAbstract constructor.
	 * @param $path
	 */
	public function __construct($path)
	{
		$this->path = $path;
	}

	/**
	 * @return mixed
	 */
	public function getPath()
	{
		return $this->path;
	}

	/**
	 * @param mixed $path
	 * @return AbstractDelete
	 */
	public function setPath($path)
	{
		$this->path = $path;
		return $this;
	}

}