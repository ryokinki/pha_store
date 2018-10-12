<?php
// +------------------------------------------------------------------
// | File: jobs/BaseJob.php
// +------------------------------------------------------------------
// | Author: jinhui - <ryokinki@163.com>
// +------------------------------------------------------------------
// | Create: 2018-10-12 15:48:43
// +------------------------------------------------------------------

// +------------------------------------------------------------------
// | File: TestJob.php
// +------------------------------------------------------------------
// | Author: jinhui - <ryokinki@163.com>
// +------------------------------------------------------------------
// | Create: 2018-10-11 15:56:39
// +------------------------------------------------------------------

namespace Job;
class BaseJob {

	public function callJob($queue, $job, $data, $method) {
		//new \Job\Exception\JobExceptionRetry(1);
		try {
			$this->{$method}($data);
			$job->delete();
		} catch (\Exception $e) {
			if ($e instanceof \Job\Exception\JobExceptionRetry) {
				$job->release(['delay' => $e->delay()]);
			} else {
				$job->release(['delay' => 10]);
			}
			//需要处理重试次数多次仍然失败问题
			$msg = msge($e);
			//写入日志
			var_dump($msg);
		}
	}
}
