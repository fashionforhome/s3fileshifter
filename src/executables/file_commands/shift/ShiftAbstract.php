<?php

namespace Executables\FileCommands\Scan;

use Executables\ExecutableInterface;

abstract class ShiftAbstract implements ExecutableInterface
{
	/**
	 * DeleteAbstract constructor.
	 * @param $source
	 * @param $destination
	 */
	public function __construct($source, $destination)
	{
		$this->source = $source;
		$this->destination = $destination;
	}

	private $source;
	private $destination;

	/**
	 * @param mixed $source
	 * @return ShiftAbstract
	 */
	public function setSource($source)
	{
		$this->source = $source;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getSource()
	{
		return $this->source;
	}

	/**
	 * @param mixed $destination
	 * @return ShiftAbstract
	 */
	public function setDestination($destination)
	{
		$this->destination = $destination;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getDestination()
	{
		return $this->destination;
	}


}