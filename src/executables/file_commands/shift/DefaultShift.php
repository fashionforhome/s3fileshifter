<?php

namespace Executables\FileCommands\Shift;

use Executables\FileCommands\Copy\DefaultCopy;
use Executables\FileCommands\Delete\DefaultDelete;

class DefaultShift extends AbstractShift
{

	public function __construct($source, $destination)
	{
		parent::__construct($source, $destination);
	}

	public function execute()
	{
		$delete = new DefaultDelete($this->getSource());
		$copy   = new DefaultCopy($this->getSource(), $this->getDestination());

		$copy->execute();
		$delete->execute();
	}

}