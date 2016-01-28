<?php

use Executables\FileCommands\DefaultShift;
use org\bovigo\vfs\vfsStream;
use \org\bovigo\vfs\vfsStreamDirectory;
use org\bovigo\vfs\vfsStreamFile;

class DefaultShiftTest extends PHPUnit_Framework_TestCase
{
	/** @var  vfsStreamDirectory */
	private $root;

	public function setUp()
	{
		$structure = array('testfile1' => 'TestContent', 'testfile2' => 'TestContent2');
		$this->root = vfsStream::setup('root', null, $structure);
	}

	public function testFileIsNotOnSourceAfterShift()
	{
		$copy = new DefaultShift($this->root->url() . '/testfile1', $this->root->url() . '/testfile1Shifted');
		$copy->execute();

		$this->assertEquals(2, count($this->root->getChildren()));
		$this->assertEquals('testfile1Shifted', $this->root->getChildren()[1]->getName());
	}

	public function testFileIsOnDestinationAfterShift()
	{
		$this->root->addChild(vfsStream::newFile('testfile1Shifted')->setContent('TestContent'));

		$copy = new DefaultShift($this->root->url() . '/testfile1', $this->root->url() . '/testfile1Shifted');
		$copy->execute();

		/** @var vfsStreamFile $copiedFile */
		$copiedFile = $this->root->getChild('testfile1copy');

		$this->assertEquals('testfile1copy', $copiedFile->getName());
		$this->assertEquals('TestContent', $copiedFile->getContent());
	}

	public function testShouldThrowExceptionIfReadIsNotPermitted()
	{
		
	}

	public function testShouldThrowExceptionIfWriteIsNotPermitted()
	{
		
	}

	public function testShouldThrowExceptionIfSourceFileNotFound()
	{
	}

	public function testShouldThrowExceptionIfDestinationPathNotFound()
	{
	}
}