<?php
$loader = new \Phalcon\Loader();

$loader->registerFiles([
	$config->application->utilsDir.'/func.php',
	$config->application->utilsDir.'/Log.php',
])
->registerDirs([
	$config->application->controllersDir,
	$config->application->modelsDir,
])
->registerNamespaces([
	'App\Library' => $config->application->libraryDir,
	'Pheanstalk' => $config->application->vendorDir.'/pheanstalk/',
	'Queue' => $config->application->vendorDir.'/queue/',
	'Job' => $config->application->appDir.'/jobs/',
	'Job\Exception' => $config->application->appDir.'/jobs/exceptions/',
	'App\Task' => $config->application->appDir.'/tasks/',
])->register();
