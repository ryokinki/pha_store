<?php
// +------------------------------------------------------------------
// | File: Queue.php
// +------------------------------------------------------------------
// | Author: jinhui - <ryokinki@163.com>
// +------------------------------------------------------------------
// | Create: 2018-10-10 18:18:14
// +------------------------------------------------------------------

namespace Queue;

use Pheanstalk\Pheanstalk;
use Pheanstalk\PheanstalkInterface;

class BeanstalkQueue {

	public $instance = null;
	public $system = '';
	public $config = [];
	public $name = 'beanstalk';

	public function __construct($config) {
		$this->config = $config;
		$system = $config['system'];
		$this->instance = new Pheanstalk($config['host'], $config['port']);
		$this->instance->useTube($system);
		$this->instance->watchOnly($system);
	}

	//beanstalk的延迟只需要options,参数delay
	public function push($data, $options = []) {

        $priority = PheanstalkInterface::DEFAULT_PRIORITY;
        $delay = PheanstalkInterface::DEFAULT_DELAY;
        $ttr = PheanstalkInterface::DEFAULT_TTR;
		if (isset($options['priority'])) {
			$priority = $options['priority'];
		}
		if (isset($options['delay'])) {
			$delay = $options['delay'];
		}
		if (isset($options['ttr'])) {
			$ttr = $options['ttr'];
		}
		$data = json_encode($data);
		$this->instance->put($data, $priority, $delay, $ttr);
	}

	/*
	 * 获取
	 */
	public function pop($options = []) {
		$timeout = 3;
		$tube = 'default';
		if (isset($options['timeout'])) {
			$timeout = $options['timeout'];
		}
		if (isset($options['tube'])) {
			$tube = $options['tube'];
		}
		$job = $this->instance->reserve($timeout);
		if ($job === false) {
			return -1;
		}
		return new BeanstalkJob($this->instance, $job);
	}
}
