<?php

require_once('Bootstrap.php');

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\ArrayInput;
use Executables\FileCommands\FileCommandFactory;

$commandName = 's3fileshifter';

$commandDefinition = array(
	new InputArgument('source', InputArgument::REQUIRED, 'The file or directory to shift.'),
	new InputArgument('destination', InputArgument::REQUIRED, 'Where the file or directory should be shifted to.'),
);

$commandDescription = 'Shifts a file from S3 to the local or vice versa.';

$commandHelp = 'The <info>s3fileshifter</info> will shift a file or a whole directory from the local filesystem to S3 or vice versa.' . PHP_EOL .
	' Note that one of the input arguments must use the S3 protocol and the other one a valid path to a file or directory in the local filesystem.' . PHP_EOL .
	'<comment>Samples:</comment>' . PHP_EOL . 'To copy a directory from S3 to local:<info>php S3FileShifter.php s3fileshifter s3://bucket/directory /tmp/destination_directory</info>' . PHP_EOL .
	'To copy a file from local to S3<info>php S3FileShifter.php s3fileshifter /tmp/file.example s3://bucket/destination_directory</info>';

$commandLogic = function (InputInterface $input, OutputInterface $output) {

	$source = $input->getArgument('source');
	$destination = $input->getArgument('destination');
	$validator = new S3FileShifterArgumentsValidator($destination, $source);

	if ($validator->validate() === false) {
		$output->writeln('<error>One of the paths needs to have the "s3://" protocol</error>');

		return;
	}

	$scan = FileCommandFactory::getCommand('DefaultScan', array('path' => $source));
	$sourceFilePaths = $scan->execute();

	foreach ($sourceFilePaths as $currentRelativePath) {
		$shift = FileCommandFactory::getCommand('DefaultShift',
			array(
				'src' => PathHelper::buildPath($source, $currentRelativePath),
				'dest' => PathHelper::buildPath($destination, $currentRelativePath)
			)
		);
		$shift->execute();
	}
};

$console = new Application();

$console
	->register($commandName)
	->setDefinition($commandDefinition)
	->setDescription($commandDescription)
	->setHelp($commandHelp)
	->setCode($commandLogic);

$input = new ArrayInput(array(
	'command' => 's3fileshifter',
	$argv[1],
	$argv[2]
));

$console->run($input);