<?php

use Executables\FileCommands\Shift\DefaultShift;
use org\bovigo\vfs\vfsStream;
use \org\bovigo\vfs\vfsStreamDirectory;
use org\bovigo\vfs\vfsStreamFile;

class DefaultShiftTest extends PHPUnit_Framework_TestCase
{
	/** @var  vfsStreamDirectory */
	private $root;

	public function setUp()
	{
		$structure  = array('testfile1' => 'TestContent', 'testfile2' => 'TestContent2');
		$this->root = vfsStream::setup('root', null, $structure);
	}

	public function testFileIsNotOnSourceAfterShift()
	{
		$copy = new DefaultShift($this->root->url() . '/testfile1', $this->root->url() . '/testfile1Shifted');
		$copy->execute();

		$this->assertEquals(2, count($this->root->getChildren()));
		$this->assertNull($this->root->getChild('testfile1'));
	}

	public function testFileIsOnDestinationAfterShift()
	{
		$shift = new DefaultShift($this->root->url() . '/testfile1', $this->root->url() . '/testfile1Shifted');
		$shift->execute();

		/** @var vfsStreamFile $shiftedFile */
		$shiftedFile = $this->root->getChild('testfile1Shifted');

		$this->assertNotNull($shiftedFile);
		$this->assertEquals('testfile1Shifted', $shiftedFile->getName());
		$this->assertEquals('TestContent', $shiftedFile->getContent());
	}

	/**
	 * @expectedException RuntimeException
	 */
	public function testShouldThrowExceptionIfSourceFileNotFound()
	{
		$shift = new DefaultShift($this->root->url() . '/nonexistentfile', $this->root->url() . '/testfile1Shifted');
		$shift->execute();
	}

}