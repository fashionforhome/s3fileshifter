<?php

class PathHelper
{
	CONST S3_REGEX = '/^[sS]3:\/\/.*/';
	CONST S3_DIRECTORY_SEPARATOR = '/';

	/**
	 * @param string $path
	 * @return bool
	 */
	public static function isS3Path($path)
	{
		return boolval(preg_match(self::S3_REGEX, $path));
	}

	/**
	 * @param $sourcePath
	 * @param $relativeFilePath
	 * @return string
	 */
	public static function buildPath($sourcePath, $relativeFilePath)
	{
		$separator = DIRECTORY_SEPARATOR;

		if (PathHelper::isS3Path($sourcePath)) {
			$separator = '/';
		}

		$result = PathHelper::replaceDirectorySeparatorInPath($relativeFilePath, $separator);

		if (is_file($sourcePath)) {
			return $sourcePath;
		}

		return $sourcePath . $separator . $result;
	}


	private static function replaceDirectorySeparatorInPath($path, $separator)
	{
		return str_replace(array('/', '\\'), $separator, $path);
	}
}