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
	public $options = [];
	public $deamon = false;
	public function __construct($di, $options = []) {
		$this->queue = $di->get('queue')->getQueue();
		$this->options = $options;
	}

	public function run() {
		$cache = [];
		$obj = null;
		$method = null;
		$queue = $this->queue;
		$options = $this->options;
		$cycle = false;
		$deamon = $this->daemon;
		while (($data = $queue->pop($options)) !== false) {
			if ($data == -1) {
				echo "no \n";
				usleep(200000);
				if ($deamon) {
					continue;
				} else {
					break;
				}
			}
			$data = json_encode($data, true);
			$action = $data['action'];
			unset($data['action']);

			if (isset($cache[$action])) {
				$obj = $cache[$action][0];
				$method = $cache[$action][1];
				$obj->{$method}($queue);
			} else {
				$ex = explode($action, '@');
				$name = $ex[0];
				$needNameSpace = strpos($name, '\\') === false;
				if ($needNameSpace) {
					$cls = '\\App\Job\\'.$name;
				} else {
					$cls = $name;
				}
				$method = $ex[1];
				$obj = new $cls();
				$obj->{$method}($queue);
			}
			if (!$deamon) {
				break;
			}
		}
	}
}
