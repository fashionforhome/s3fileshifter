<?php

class S3FileShifterValidatorTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider successfulValidationProvider
	 * @param $source
	 * @param $destiny
	 */
	public function testSuccessfulValidation($source, $destiny)
	{
		$validator = new S3FileShifterArgumentsValidator($source, $destiny);

		$this->assertTrue($validator->validate());
	}

	/**
	 * @return array
	 */
	public function successfulValidationProvider()
	{
		return array(
			array('s3://testBucket', '/home'),
			array('S3://testBucket', '/temp'),
			array('/temp', 's3://testBucket'),
			array('/home', 'S3://testBucket')
		);
	}

	/**
	 *
	 */
	public function testFailedValidationBothS3()
	{
		$source = 's3://superAwesomeTestBucket';
		$destiny = 'S3://NotSoAwesomeTestBucket';

		$validator = new S3FileShifterArgumentsValidator($source, $destiny);

		$this->assertFalse($validator->validate());
	}

	/**
	 *
	 */
	public function testFailedValidationBothLocal()
	{
		$source = '/home';
		$destiny = '/temp';

		$validator = new S3FileShifterArgumentsValidator($source, $destiny);

		$this->assertFalse($validator->validate());
	}

}