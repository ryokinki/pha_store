<?php
// +------------------------------------------------------------------
// | File: BeanlstalkJob.php
// +------------------------------------------------------------------
// | Author: jinhui - <ryokinki@163.com>
// +------------------------------------------------------------------
// | Create: 2018-10-10 18:18:14
// +------------------------------------------------------------------

namespace Queue;

class Job {

	public $instance = null;
	public $job = false;

	public function __construct($instance) {
		$this->instance = $instance;
		$name = $instance->name;
		$cls = ucfirst($name).'Job';
		$this->job = new $cls($instance);
	}

	/*
	 * 延迟
	 */
	public function release($options = []) {
		$this->job->release($options);
	}

	/*
	 * 删除
	 */
	public function delete() {
		$this->job->delete();
	}
}
