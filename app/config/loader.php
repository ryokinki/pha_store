<?php
$loader = new \Phalcon\Loader();

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
	'Queue' => $config->application->vendorDir.'/queue/',
	'Job' => $config->application->appDir.'/job/',
	'App\Task' => $config->application->appDir.'/tasks/',
]);
if (defined('CONSOLE')) {
}
$loader->register();
