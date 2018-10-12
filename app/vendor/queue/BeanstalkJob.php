<?php
// +------------------------------------------------------------------
// | File: BeanlstalkJob.php
// +------------------------------------------------------------------
// | Author: jinhui - <ryokinki@163.com>
// +------------------------------------------------------------------
// | Create: 2018-10-10 18:18:14
// +------------------------------------------------------------------

namespace Queue;
use Pheanstalk\PheanstalkInterface;

class BeanstalkJob {

	public $instance = null;
	public $job = false;

	public function __construct($instance, $job) {
		$this->instance = $instance;
		$this->job = $job;
	}

	public function getData() {
		if (is_object($this->job)) {
			return json_decode($this->job->getData(), true);
		}
		return false;
	}

	/*
	 * 延迟
	 */
	public function release($opt = []) {
		$job = $this->job;
		if ($job !== false) {
			$priority = PheanstalkInterface::DEFAULT_PRIORITY;
			$delay = PheanstalkInterface::DEFAULT_DELAY;
			if (isset($opt['priority'])) {
				$priority = $opt['priority'];
			}
			if (isset($opt['delay'])) {
				$delay = $opt['delay'];
			}
			$this->instance->release($job, $priority, $delay);
		}
	}

	/*
	 * 删除
	 */
	public function delete() {
		$job = $this->job;
		if ($job !== false) {
			$this->instance->delete($job);
		}
	}
}
