<?php

namespace Executables\FileCommands;

use Executables\ExecutableInterface;

class Shift implements ExecutableInterface
{

	private $copy;

	private $delete;

	public function execute()
	{
		// TODO: Implement execute() method.
	}

	/**
	 * @return mixed
	 */
	public function getCopy()
	{
		return $this->copy;
	}

	/**
	 * @param mixed $copy
	 */
	public function setCopy($copy)
	{
		$this->copy = $copy;
	}

	/**
	 * @return mixed
	 */
	public function getDelete()
	{
		return $this->delete;
	}

	/**
	 * @param mixed $delete
	 */
	public function setDelete($delete)
	{
		$this->delete = $delete;
	}

}