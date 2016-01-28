<?php

use org\bovigo\vfs\vfsStream;
use \org\bovigo\vfs\vfsStreamDirectory;
use org\bovigo\vfs\vfsStreamFile;
use Executables\FileCommands\Copy\DefaultCopy;

class DefaultCopyTest extends PHPUnit_Framework_TestCase
{
	/** @var  vfsStreamDirectory */
	private $root;

	public function setUp()
	{
		$structure = array('testfile1' => 'TestContent');
		$this->root = vfsStream::setup('root', null, $structure);
	}

	public function testShouldBeAbleToCopyFile()
	{
		$this->root->addChild(vfsStream::newFile('testfile1copy')->setContent('TestContent'));

		$copy = new DefaultCopy($this->root->url() . '/testfile1', $this->root->url() . '/testfile1copy');
		$copy->execute();

		/** @var vfsStreamFile $copiedFile */
		$copiedFile = $this->root->getChild('testfile1copy');

		$this->assertEquals('testfile1copy', $copiedFile->getName());
		$this->assertEquals('TestContent', $copiedFile->getContent());
	}

	/**
	 * @expectedException RuntimeException
	 */
	public function testShouldThrowExceptionWhenFileNotFound()
	{
		$copy = new DefaultCopy($this->root->url() . '/nonexistentfile', $this->root->url() . '/nonexistentfilecopy');
		$copy->execute();
	}

	/**
	 * @depends testShouldBeAbleToCopyFile
	 * @depends testShouldThrowExceptionWhenFileNotFound
	 * @expectedException RuntimeException
	 */
	public function testShouldThrowExceptionWhenWritingNotPermitted()
	{
		$this->root->chmod(0333);
		$copy = new DefaultCopy($this->root->url() . '/testfile1', $this->root->url() . '/testfile1copy');
		$copy->execute();
	}

}