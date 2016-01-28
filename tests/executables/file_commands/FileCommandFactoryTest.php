<?php

use Executables\FileCommands\FileCommandFactory;

class FileCommandFactoryTest extends PHPUnit_Framework_TestCase
{

	/**
	 * @expectedException InvalidArgumentException
	 */
	public function testGetCommandShouldThrowExceptionWhenUnknownCommandGiven()
	{
		FileCommandFactory::getCommand('Mysterious command', array());
	}

	public function testGetCommandReturnsObject()
	{
		$object = FileCommandFactory::getCommand('DefaultCopy', array('src' => '', 'dest' => ''));

		$this->assertInstanceOf('Executables\FileCommands\Copy\DefaultCopy', $object);
	}

}