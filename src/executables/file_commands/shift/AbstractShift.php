<?php

namespace Executables\FileCommands\Shift;

use Executables\ExecutableInterface;

abstract class AbstractShift implements ExecutableInterface
{
	/** @var string $source */
	private $source;

	/** @var string $source */
	private $destination;

	/**
	 * DeleteAbstract constructor.
	 * @param $source
	 * @param $destination
	 */
	public function __construct($source, $destination)
	{
		$this->source      = $source;
		$this->destination = $destination;
	}

	/**
	 * @param mixed $source
	 * @return AbstractShift
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
	 * @return AbstractShift
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