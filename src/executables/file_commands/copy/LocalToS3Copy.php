<?php

namespace Executables\FileCommands\Copy;

class LocalToS3Copy extends CopyAbstract implements \FromArrayInterface
{

	public function __construct($source, $destination)
	{
		parent::__construct($source, $destination);
	}

	public function execute()
	{
		// TODO: Implement execute() method.
	}

	/**
	 * @param $array
	 * @return mixed
	 */
	public function fromArray($array)
	{
		// TODO: Implement fromArray() method.
	}
}