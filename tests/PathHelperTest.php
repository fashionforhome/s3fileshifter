<?php

use org\bovigo\vfs\vfsStream;
use \org\bovigo\vfs\vfsStreamDirectory;

class PathHelperTest extends PHPUnit_Framework_TestCase
{
	/** @var  vfsStreamDirectory */
	private $root;

	public function setUp()
	{
		$structure = array('testfile1' => '');
		$this->root = vfsStream::setup('root', null, $structure);
	}

	/**
	 * @dataProvider buildS3PathProvider
	 * @param $sourceDirPath
	 * @param $relativeFilePath
	 * @param $expected
	 */
	public function testBuildS3Path($sourceDirPath, $relativeFilePath, $expected)
	{
		$result = PathHelper::buildPath($sourceDirPath, $relativeFilePath);

		$this->assertEquals($expected, $result);
	}

	/**
	 * @dataProvider buildS3PathProvider
	 * @param $sourceDirPath
	 * @param $relativeFilePath
	 * @param $expected
	 */
	public function testBuildNonS3Path($sourceDirPath, $relativeFilePath, $expected)
	{
		$result = PathHelper::buildPath($sourceDirPath, $relativeFilePath);

		$this->assertEquals($expected, $result);
	}

	/**
	 * @dataProvider isS3PathProvider
	 * @param $expected
	 * @param $path
	 */
	public function testIsS3Path($expected, $path)
	{
		$this->assertEquals($expected, PathHelper::isS3Path($path));

	}

	/**
	 * @return array
	 */
	public function buildS3PathProvider()
	{
		return array(
			array('s3://testBucket', 'TestFile', 's3://testBucket/TestFile'),
			array('s3://testBucket', 'TestDir/NestedTestFile', 's3://testBucket/TestDir/NestedTestFile'),
			array('s3://testBucket', 'TestDir\NestedTestFile', 's3://testBucket/TestDir/NestedTestFile'),
		);
	}

	/**
	 * @return array
	 */
	public function buildNonS3PathProvider()
	{
		return array(
			array('/home/testUser/test', 'TestFile', '/home/testUser/test/TestFile'),
			array('/home/testUser/test', 'TestDir/NestedTestFile', '/home/testUser/test/TestDir/NestedTestFile'),
			array($this->root->path(), 'testfile1', $this->root->path() . DIRECTORY_SEPARATOR . 'testfile1'),
		);
	}

	/**
	 * @return array
	 */
	public function isS3PathProvider()
	{
		return array(
			array(true, 's3://testBucket'),
			array(false, '/home/testUser/test'),
		);
	}

}