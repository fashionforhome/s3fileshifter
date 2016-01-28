<?php

use Executables\FileCommands\Scan\DefaultShift;
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
		$localScan = new DefaultShift($this->root->url() . '/testDir1');
		$expected = array(
			$this->root->url() . '/testDir1' . DIRECTORY_SEPARATOR . 'testfile11',
			$this->root->url() . '/testDir1' . DIRECTORY_SEPARATOR . 'testfile12'
		);

		$result = $localScan->execute();

		$this->assertSame($expected, $result);
	}

	public function testShouldListAllFilesInANestedStructure()
	{
		$localScan = new DefaultShift($this->root->url() . '/testDir3');
		$expected = array(
			$this->root->url() . '/testDir3' . DIRECTORY_SEPARATOR . 'testfile31',
			$this->root->url() . '/testDir3' . DIRECTORY_SEPARATOR . 'testfile32',
			$this->root->url() . '/testDir3' . DIRECTORY_SEPARATOR . 'testDir31' . DIRECTORY_SEPARATOR . 'testfile311',
			$this->root->url() . '/testDir3' . DIRECTORY_SEPARATOR . 'testDir31' . DIRECTORY_SEPARATOR . 'testfile312'
		);

		$result = $localScan->execute();

		$this->assertSame($expected, $result);
	}

	public function testShouldGiveEmptyArrayForEmptyDir()
	{
		$localScan = new DefaultShift($this->root->url() . '/testDir2');
		$expected = array();

		$result = $localScan->execute();

		$this->assertSame($expected, $result);
	}

	/**
	 * @expectedException RuntimeException
	 */
	public function testShouldThrowExceptionIfDirNotExists()
	{
		$localScan = new DefaultShift($this->root->url() . '/NonExistingDir');

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
		$localScan = new DefaultShift($this->root->url() . '/testDir1');

		$localScan->execute();
	}
}