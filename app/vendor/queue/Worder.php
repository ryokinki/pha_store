<?php
// +------------------------------------------------------------------
// | File: Worker.php
// +------------------------------------------------------------------
// | Author: jinhui - <ryokinki@163.com>
// +------------------------------------------------------------------
// | Create: 2018-10-10 18:18:14
// +------------------------------------------------------------------

namespace Queue;

class Worker {

	public $queue = null;
	public function __construct() {
		$queue = $di->get('queue')->getQueue()->instance;
	}

	public function run() {
		$queue = $this->queue;
		while (($data = $queue->pop()) !== false) {
			$action = $data['action'];
			unset($data['action']);
			$ex = explode($action, '@');
			$cls = $ex[0];
			$method = $ex[1];
			$obj = new $cls();
			$obj->{$method}($queue);
		}
	}
}
