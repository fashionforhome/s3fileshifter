<?php

class S3FileShifterArgumentsValidator
{

	private $source;
	private $destination;

	/**
	 * S3FileShifterArgumentsValidator constructor.
	 * @param $destination
	 * @param $source
	 */
	public function __construct($destination, $source)
	{
		$this->destination = $destination;
		$this->source      = $source;
	}

	/**
	 * Validates if source xor destiny are s3 paths.
	 * @return bool
	 */
	public function validate()
	{
		if (PathHelper::isS3Path($this->source) XOR PathHelper::isS3Path($this->destination)) {
			return true;
		}

		return false;
	}

	/**
	 * @param mixed $source
	 * @return S3FileShifterArgumentsValidator
	 */
	public function setSource($source)
	{
		$this->source = $source;

		return $this;
	}

	/**
	 * @param mixed $destination
	 * @return S3FileShifterArgumentsValidator
	 */
	public function setDestination($destination)
	{
		$this->destination = $destination;

		return $this;
	}

}