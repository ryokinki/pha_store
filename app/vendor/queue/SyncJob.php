<?php
// +------------------------------------------------------------------
// | File: BeanlstalkJob.php
// +------------------------------------------------------------------
// | Author: jinhui - <ryokinki@163.com>
// +------------------------------------------------------------------
// | Create: 2018-10-10 18:18:14
// +------------------------------------------------------------------

namespace Queue;

class SyncJob {

	public $instance = null;
	public $job = false;

	public function __construct($instance) {
		$this->instance = $instance;
	}

	/*
	 * 获取
	 */
	public function pop($opt = []) {
	}

	/*
	 * 延迟
	 */
	public function release($opt = []) {
	}

	/*
	 * 删除
	 */
	public function delete() {
	}
}
