<?php
// +------------------------------------------------------------------
// | File: Log.php
// +------------------------------------------------------------------
// | Author: jinhui - <ryokinki@163.com>
// +------------------------------------------------------------------
// | Create: 2018-10-09 23:50:32
// +------------------------------------------------------------------
namespace App\Util;

Class Log
{
    public static function writeErr($content, $name)
    {
        self::write($content, 'err', $name);
    }

    public static function writeLog($content, $name)
    {
        self::write($content, 'app', $name);
    }

    public static function writeTmp($content, $name)
    {
        self::write($content, 'tmp', $name);
    }

    private static function write($content, $type, $name)
    {
		static $path = '';
		if (empty($path)) {
			$di = getDI();
			$path = $di->getConfig()->log_path;
		}
		$isConsole = defined('CONSOLE');
		$isEnv = defined('ENV');
		$env = 'no_env';
		if ($isEnv) {
			$env = ENV;
		}
		$logPath = $path.'/app/'.$name.'.log';
        if ($content) {
            $microsecond = str_pad(floor(microtime() * 1000), 3, 0, STR_PAD_LEFT);
            $content = date('Y-m-d H:i:s ', time()).$microsecond."\n".$content;
            error_log($content."\n\x03\n", 3, $logPath);
        }
    }
}
