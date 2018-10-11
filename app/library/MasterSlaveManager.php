<?php
// +------------------------------------------------------------------
// | File: MasterSlaveManager.php
// +------------------------------------------------------------------
// | Author: jinhui - <ryokinki@163.com>
// +------------------------------------------------------------------
// | Create: 2018-10-09 17:38:28
// +------------------------------------------------------------------
namespace App\Library;

class MasterSlaveManager {

	public $_di = null;
	public function __construct($di) {
		$this->_di = $di;
	}

	public function getConnection($isMaster, $index = -1) {
		static $cache = [];
		$type = 'read';
		if ($isMaster) {
			$type = 'write';
		}
		$key = $type.'_'.$index;
		if (isset($cache[$key])) {
			return $cache[$key];
		} else {
			$config = $this->_di->getConfig()->database->{$type};
			if (!$isMaster) {
				$allReads = $config;
				if ($index == -1) {
					$index = array_rand($config->toArray());
				}
				$config = $allReads->$index;
			}
			
			$class = 'Phalcon\Db\Adapter\Pdo\\' . $config->adapter;
			$params = [
			    'host'     => $config->host,
			    'username' => $config->username,
			    'password' => $config->password,
			    'dbname'   => $config->dbname,
			    'charset'  => $config->charset
			];
			$connection = new $class($params);
			$di = $this->setShared($key, $connection);
			$cache[$key] = $connection;
			return $connection;
		}
	}
}
