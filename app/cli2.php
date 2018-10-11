<?php
// +------------------------------------------------------------------
// | File: cli.php
// +------------------------------------------------------------------
// | Author: jinhui - <ryokinki@163.com>
// +------------------------------------------------------------------
// | Create: 2018-10-11 17:18:20
// +------------------------------------------------------------------

define('BASE_PATH', realpath(dirname(__FILE__).'/../'));
define('APP_PATH', BASE_PATH . '/app');

use Phalcon\DI\FactoryDefault\CLI as CliDI;
use Phalcon\CLI\Console as ConsoleApp;
define('VERSION', '1.0.0');

$di = new CliDI();
defined('APPLICATION_PATH') || define('APPLICATION_PATH', realpath(dirname(__FILE__)));

$loader = new \Phalcon\Loader();
$loader->registerDirs([APPLICATION_PATH . '/tasks']);
$loader->register();

if(is_readable(APPLICATION_PATH . '/config/config.php')) {
	 $config = include APPLICATION_PATH . '/config/config.php';
	 $di->set('config', $config);
}

$console = new ConsoleApp();
$console->setDI($di);

$arguments = array();
$params = array();

foreach($argv as $k => $arg) {
	 if($k == 1) {
		 $arguments['task'] = $arg;
	 } elseif($k == 2) {
		 $arguments['action'] = $arg;
	 } elseif($k >= 3) {
		$params[] = $arg;
	 }
}
if(count($params) > 0) {
	$arguments['params'] = $params;
}

//define global constants for the current task and action
//define('CURRENT_TASK', (isset($argv[1]) ? $argv[1] : null));
//define('CURRENT_ACTION', (isset($argv[2]) ? $argv[2] : null));

try {
	 $console->handle($arguments);
}
catch (\Phalcon\Exception $e) {
	 echo $e->getMessage();
	 exit(255);
}
