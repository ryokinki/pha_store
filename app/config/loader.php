<?php
$loader = new \Phalcon\Loader();
/**
 * We're a registering a set of directories taken from the configuration file
 */
$loader->registerFiles([
	$config->application->utilsDir.'/func.php',
])
->registerDirs([
	$config->application->controllersDir,
	$config->application->modelsDir,
])
->registerNamespaces([
	'App\Library' => $config->application->libraryDir,
	'Pheanstalk' => $config->application->vendorDir.'/pheanstalk/',
])
->register();
