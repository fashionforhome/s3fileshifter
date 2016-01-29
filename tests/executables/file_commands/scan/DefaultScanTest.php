<?php

use Executables\FileCommands\Scan\DefaultScan;
use org\bovigo\vfs\vfsStream;
use \org\bovigo\vfs\vfsStreamDirectory;

class DefaultScanTest extends PHPUnit_Framework_TestCase
{
	/** @var  vfsStreamDirectory */
	private $root;

	public function setUp()
	{
		$structure = array(
			'testDir1' => array(
				'testfile11' => '',
				'testfile12' => '',
			),
			'testDir2' => array(),
			'testDir3' => array(
				'testfile31' => '',
				'testfile32' => '',
				'testDir31' => array(
					'testfile311' => '',
					'testfile312' => ''
				)
			)
		);
		$this->root = vfsStream::setup('root', null, $structure);
	}

	public function testShouldListAllFilesInAFlatStructure()
	{
		$localScan = new DefaultScan($this->root->url() . '/testDir1');
		$expected = array(
			'testfile11',
			'testfile12'
		);

		$result = $localScan->execute();

		$this->assertSame($expected, $result);
	}

	public function testShouldListAllFilesInANestedStructure()
	{
		$localScan = new DefaultScan($this->root->url() . '/testDir3');
		$expected = array(
			'testfile31',
			'testfile32',
			'testDir31' . DIRECTORY_SEPARATOR . 'testfile311',
			'testDir31' . DIRECTORY_SEPARATOR . 'testfile312'
		);

		$result = $localScan->execute();

		$this->assertSame($expected, $result);
	}

	public function testShouldBeAbleToListASingleFile()
	{
		$localScan = new DefaultScan($this->root->url() . '/testDir1/testfile11');
		$expected = array(
			'testfile11'
		);

		$result = $localScan->execute();

		$this->assertSame($expected, $result);
	}

	public function testShouldGiveEmptyArrayForEmptyDir()
	{
		$localScan = new DefaultScan($this->root->url() . '/testDir2');
		$expected = array();

		$result = $localScan->execute();

		$this->assertSame($expected, $result);
	}

	/**
	 * @expectedException RuntimeException
	 */
	public function testShouldThrowExceptionIfDirNotExists()
	{
		$localScan = new DefaultScan($this->root->url() . '/NonExistingDir');

		$localScan->execute();
	}

	/**
	 * @depends testShouldListAllFilesInAFlatStructure
	 * @depends testShouldGiveEmptyArrayForEmptyDir
	 * @depends testShouldThrowExceptionIfDirNotExists
	 * @expectedException RuntimeException
	 */
	public function testShouldThrowExceptionWhenPermissionsAreMissingForInitialDir()
	{
		$this->root->getChild('testDir1')->chmod(0333);
		$localScan = new DefaultScan($this->root->url() . '/testDir1');

		$localScan->execute();
	}
}