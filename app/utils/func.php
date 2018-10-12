<?php
// +------------------------------------------------------------------
// | File: func.php
// +------------------------------------------------------------------
// | Author: jinhui - <ryokinki@163.com>
// +------------------------------------------------------------------
// | Create: 2018-10-09 23:50:32
// +------------------------------------------------------------------

//打印多个参数调试
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
//快速打印exception
if (!function_exists('msge')) {
    function msge($e) {
        $msg = 'file: '.$e->getFile().' line: '.$e->getLine().' msg: '.$e->getMessage();
        return $msg;
    }
}

//获取全局Ioc注入器
function getDI() {
	return \Phalcon\Di::getDefault();
}

//获取cli App
function getConsole() {
	return new \Phalcon\CLI\Console();
}

//task互相调用
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
