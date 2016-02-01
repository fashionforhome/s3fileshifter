<?php

use org\bovigo\vfs\vfsStream;
use Executables\FileCommands\Delete\DefaultDelete;
use \org\bovigo\vfs\vfsStreamDirectory;

class DefaultDeleteTest extends PHPUnit_Framework_TestCase
{
	/** @var  vfsStreamDirectory */
	private $root;

	public function setUp()
	{
		$structure  = array('testfile1' => '', 'testfile2' => '');
		$this->root = vfsStream::setup('root', null, $structure);
	}

	public function testShouldBeAbleToDeleteExistingFile()
	{
		$localDelete = new DefaultDelete($this->root->url() . '/testfile1');

		$localDelete->execute();

		$this->assertEquals(1, count($this->root->getChildren()));
		$this->assertEquals('testfile2', $this->root->getChildren()[0]->getName());
	}

	/**
	 * @expectedException RuntimeException
	 */
	public function testShouldThrowExceptionWhenFileNotFound()
	{
		$localDelete = new DefaultDelete($this->root->url() . '/testfile3');

		$localDelete->execute();
	}

	/**
	 * @expectedException RuntimeException
	 */
	public function testShouldThrowExceptionWhenDeletionNotPermitted()
	{
		$this->root->chmod(0555);
		$this->root->getChild('testfile2')->chmod(0555);

		$localDelete = new DefaultDelete($this->root->url() . '/testfile2');

		$localDelete->execute();
	}

}