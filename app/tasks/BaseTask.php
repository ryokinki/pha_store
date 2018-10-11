<?php
// +------------------------------------------------------------------
// | File: BaseTask.php
// +------------------------------------------------------------------
// | Author: jinhui - <ryokinki@163.com>
// +------------------------------------------------------------------
// | Create: 2018-10-11 17:41:08
// +------------------------------------------------------------------
namespace App\Task;
class BaseTask extends \Phalcon\CLI\Task
{
	public function getOption($name, $default = '') {
		 $di = $this->di;
		 $dispatcher = $di->get('dispatcher');
		 return $dispatcher->getOption($name, null, $default);
	}
}
