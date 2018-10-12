<?php
/*
 * Modified: prepend directory path of current file, because of this file own different ENV under between Apache and command line.
 * NOTE: please remove this comment.
 */
defined('BASE_PATH') || define('BASE_PATH', getenv('BASE_PATH') ?: realpath(dirname(__FILE__) . '/../..'));
defined('APP_PATH') || define('APP_PATH', BASE_PATH . '/app');
$env = 'local';
$envDir = APP_PATH.'/config/'.$env.'/';

$baseConfig = [];

$envConfig = include APP_PATH.'/config/'.$env.'/config.php';
foreach($envConfig as $k => $v) {
	$baseConfig[$k] = $v;
}

/*
$list = scandir($envDir);
foreach ($list as $key => $fileName) {
	if ($fileName == '.' || $fileName == '..') {
		continue;
	}
	$envConfig = include APP_PATH.'/config/'.$env.'/'.$fileName;
	foreach($envConfig as $k => $v) {
		$baseConfig[$k] = $v;
	}
}
*/

if (isset($_SERVER['ENV'])) {
	$env = $_SERVER['ENV'];
}

if (empty($env)) {
	$env = 'local';
}
defined('ENV') || define('ENV', $env);

if ($env != 'local') {
	/*
	$envDir = APP_PATH.'/config/'.$env.'/';
	$list = scandir($envDir);
	foreach ($list as $key => $fileName) {
		if ($fileName == '.' || $fileName == '..') {
			continue;
		}
		$envConfig = include APP_PATH.'/config/'.$env.'/'.$fileName;
		foreach($envConfig as $k => $v) {
			$baseConfig[$k] = $v;
		}
	}
	*/

	$envConfig = include APP_PATH.'/config/'.$env.'/config.php';
	foreach($envConfig as $k => $v) {
		$baseConfig[$k] = $v;
	}
}

$baseConfig['application'] = [
	'appDir'         => APP_PATH . '/',
	'controllersDir' => APP_PATH . '/controllers/',
	'modelsDir'      => APP_PATH . '/models/',
	'migrationsDir'  => APP_PATH . '/migrations/',
	'viewsDir'       => APP_PATH . '/views/',
	'pluginsDir'     => APP_PATH . '/plugins/',
	'libraryDir'     => APP_PATH . '/library/',
	'vendorDir'     => APP_PATH . '/vendor/',
	'utilsDir'     => APP_PATH . '/utils/',
	'cacheDir'       => BASE_PATH . '/cache/',
	'baseUri'        => '/index.php',
];
return new \Phalcon\Config($baseConfig);
