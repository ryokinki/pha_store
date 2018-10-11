<?php
// +------------------------------------------------------------------
// | File: func.php
// +------------------------------------------------------------------
// | Author: jinhui - <ryokinki@163.com>
// +------------------------------------------------------------------
// | Create: 2018-10-09 23:50:32
// +------------------------------------------------------------------

function dd() {
	foreach (func_get_args() as $params) {
		$console = defined('CONSOLE');
		$pre = '<pre>';
		$sub = '</pre>';
		$hc = '</br>';
		if ($console) {
			$pre = "";
			$sub = "\n";
			$hc = "\n";
		}
		echo $pre;
		if (is_array($params)) {
			var_dump($params);
		} else if (is_object($params)) {
			var_dump($params);
		} else if (is_scalar($params)) {
			echo '--- '.$params.' ---'.$hc;
		}
		echo $sub;
	}
	die;
}

function getDI() {
	return \Phalcon\Di::getDefault();
}

function getConsole() {
	return new \Phalcon\CLI\Console();
}

function callTask($task, $action, $params = [], $options = []) {
	$di = getDI();
	$dispatcher = $di->get('dispatcher');
	$dispatcher = $di->get('dispatcher');
	$dispatcher->setActionSuffix('');
	$dispatcher->setDefaultNamespace('\\App\\Task');
	$dispatcher->setTaskName($task);
	$dispatcher->setActionName($action);
	$dispatcher->setParams($params);
	$dispatcher->setOptions($options);
	return $dispatcher->dispatch();
}
