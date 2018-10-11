<?php
// +------------------------------------------------------------------
// | File: BaseTask.php
// +------------------------------------------------------------------
// | Author: jinhui - <ryokinki@163.com>
// +------------------------------------------------------------------
// | Create: 2018-10-11 17:41:08
// +------------------------------------------------------------------
namespace App\Task;
use Queue\Worker;

class QueueTask extends BaseTask
{
	public function work($params) {
		$di = $this->getDI();
		$deamon = $this->getOption('deamon', false);
		$name = $this->getOption('queue', false);
		if (empty($name)) {
			echo "无队列名请填写 --queue=\n";
			die;
		}
		$options = ['tube' => $name];
		$work = new Worker($di, $options);
		$work->daemon = $deamon;
		$work->run();
	}
}
