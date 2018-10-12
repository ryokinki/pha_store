<?php
// +------------------------------------------------------------------
// | File: Worker.php
// +------------------------------------------------------------------
// | Author: jinhui - <ryokinki@163.com>
// +------------------------------------------------------------------
// | Create: 2018-10-10 18:18:14
// +------------------------------------------------------------------

namespace Queue;
use App\Library\Status;

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
		while (($job = $queue->pop($options)) !== false) {
			pcntl_signal_dispatch();
			if (Status::shouldStop()) {
				echo 'cli 优雅重启\n';
				break;
			}
			if (is_scalar($job) && $job == -1) {
				echo "no \n";
				usleep(200000);
				if ($deamon) {
					continue;
				} else {
					break;
				}
			}
			$data = $job->getData();

			$action = $data['action'];
			unset($data['action']);

			if (isset($cache[$action])) {
				$obj = $cache[$action][0];
				$method = $cache[$action][1];
				$obj->callJob($queue, $job, $data, $method);
			} else {
				$ex = explode('@', $action);
				$name = $ex[0];
				$needNameSpace = strpos($name, '\\') === false;
				if ($needNameSpace) {
					$cls = '\\Job\\'.$name;
				} else {
					$cls = $name;
				}
				$method = $ex[1];
				$obj = new $cls();
				$obj->callJob($queue, $job, $data, $method);
			}
			if (!$deamon) {
				break;
			}
		}
		exit(0);
	}
}
