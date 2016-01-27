<?php

namespace Executables\FileCommands\Delete;

use Executables\ExecutableInterface;

abstract class DeleteAbstract implements ExecutableInterface
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
	 * @return DeleteAbstract
	 */
	public function setPath($path)
	{
		$this->path = $path;
		return $this;
	}

}