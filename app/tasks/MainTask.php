<?php
// +------------------------------------------------------------------
// | File: MainTask.php
// +------------------------------------------------------------------
// | Author: jinhui - <ryokinki@163.com>
// +------------------------------------------------------------------
// | Create: 2018-10-11 17:41:08
// +------------------------------------------------------------------
namespace App\Task;
class MainTask extends BaseTask
{
	public function main($params) {
	     echo "\n默认task默认Action \n";
		 dd($params, $this->getOptions());
	}
}
