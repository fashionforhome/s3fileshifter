<?php

class S3FileShifterArgumentsValidator
{

	private $source;
	private $destination;

	CONST S3_REGEX = '/^[sS]3:\/\/.*/';

	/**
	 * S3FileShifterArgumentsValidator constructor.
	 * @param $destination
	 * @param $source
	 */
	public function __construct($destination, $source)
	{
		$this->destination = $destination;
		$this->source = $source;
	}

	/**
	 * Validates if source xor destiny are s3 paths. 
	 * @return bool
	 */
	public function validate()
	{
		if ($this->isS3Path($this->source) XOR $this->isS3Path($this->destination)) {
			return true;
		}

		return false;
	}

	/**
	 * @param string $path
	 * @return bool
	 */
	private function isS3Path($path)
	{
		return boolval(preg_match(self::S3_REGEX, $path));
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