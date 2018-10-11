<?php
// +------------------------------------------------------------------
// | File: Queue.php
// +------------------------------------------------------------------
// | Author: jinhui - <ryokinki@163.com>
// +------------------------------------------------------------------
// | Create: 2018-10-10 18:18:14
// +------------------------------------------------------------------

namespace Queue;

//队列策略类
class Queue {

	private $defaultDriver = '';
	private $curDriver = '';
	private $config = [];

	public function __construct($config) {
		$driver = $config['default'];
		$this->config = $config[$driver];
		$this->defaultDriver = $driver;
		$this->curDriver = $driver;
	}

	public function setDriver($driver) {
		$this->curDriver = $driver;
	}

	public function setSyncDriver() {
		$this->curDriver = 'sync';
	}

	public function restoreDriver() {
		$this->curDriver = $this->defaultDriver;
	}

	/*
	 *获取队列实例
	 */
	public function getQueue() {
		static $cache = [];
		$name = $this->curDriver;
		if (isset($cache[$name])) {
			return $cache[$name];
		} else {
			$queueName =  'Queue\\'.Ucfirst($name).'Queue';
			$queue = new $queueName($this->config);
			$cache[$name] = $queue;
			return $queue;
		}
	}

	/*
	 * 推入任务
	 */
	public function push($data) {
		$this->getQueue()->push($data);
	}
}
