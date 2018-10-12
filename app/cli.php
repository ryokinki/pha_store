<?php
// +------------------------------------------------------------------
// | File: cli.php
// +------------------------------------------------------------------
// | Author: jinhui - <ryokinki@163.com>
// +------------------------------------------------------------------
// | Create: 2018-10-11 17:18:20
// +------------------------------------------------------------------
use Phalcon\DI\FactoryDefault\CLI;
use Phalcon\CLI\Console;

define('CURRENT_TASK', (isset($argv[1]) ? $argv[1] : null));
define('CURRENT_ACTION', (isset($argv[2]) ? $argv[2] : null));
define('BASE_PATH', realpath(dirname(__FILE__).'/../'));
define('APP_PATH', BASE_PATH . '/app');
define('CONSOLE', true);

foreach($argv as $k => $arg) {
	 if($k >= 3) {
		 if (($pos = strpos($arg, 'env')) !== false) {
			 $env = substr($arg, strpos($arg, '=') + 1);
			 $env = trim($env);
		     $_SERVER['ENV'] = $env;
			 break;
		 }
	 }
}

$di = new Cli();
$console = new Console();
$console->setDI($di);

$di->setShared('config', function () {
    return include APP_PATH . "/config/config.php";
});
$dispatcher = $di->get('dispatcher');
$dispatcher->setActionSuffix('');
$dispatcher->setDefaultNamespace('\\App\\Task');

include APP_PATH . '/config/router.php';
$config = $di->getConfig();

include APP_PATH . '/config/loader.php';

include APP_PATH . '/config/services.php';
//优雅重启
pcntl_signal(SIGHUP, function($signo) {
	\App\Library\Status::reload();
});

try {
	$console->setArgument($argv);
	$console->handle();
}
catch (\Phalcon\Exception $e) {
	 echo $e->getMessage();
	 exit(255);
}
