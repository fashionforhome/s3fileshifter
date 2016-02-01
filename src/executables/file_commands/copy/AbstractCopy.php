<?php

namespace Executables\FileCommands\Copy;

use Executables\ExecutableInterface;

abstract class AbstractCopy implements ExecutableInterface
{

	private $source;
	private $destination;

	/**
	 * CopyAbstract constructor.
	 * @param $source
	 * @param $destination
	 */
	public function __construct($source, $destination)
	{
		$this->source      = $source;
		$this->destination = $destination;
	}


	/**
	 * @return mixed
	 */
	public function getSource()
	{
		return $this->source;
	}

	/**
	 * @param mixed $source
	 * @return AbstractCopy
	 */
	public function setSource($source)
	{
		$this->source = $source;

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getDestination()
	{
		return $this->destination;
	}

	/**
	 * @param mixed $destination
	 * @return AbstractCopy
	 */
	public function setDestination($destination)
	{
		$this->destination = $destination;

		return $this;
	}

}