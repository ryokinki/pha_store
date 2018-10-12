<?php
// +------------------------------------------------------------------
// | File: Status.php
// +------------------------------------------------------------------
// | Author: jinhui - <ryokinki@163.com>
// +------------------------------------------------------------------
// | Create: 2018-10-09 16:07:27
// +------------------------------------------------------------------
namespace App\Library;

class Status
{
	static $state = 0;
	static function reload() {
		self::$state = -1;
	}

	static function shouldStop() {
		$stop = false;
		if (self::$state == -1) {
			$stop = true;
		}
		return $stop;
	}
}
