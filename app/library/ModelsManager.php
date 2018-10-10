<?php
// +------------------------------------------------------------------
// | File: ModelsManager.php
// +------------------------------------------------------------------
// | Author: jinhui - <ryokinki@163.com>
// +------------------------------------------------------------------
// | Create: 2018-10-09 16:07:27
// +------------------------------------------------------------------
namespace App\Library;
use Phalcon\Mvc\Model\Manager;

class ModelsManager extends Manager
{
    /**
     * 主从管理器
     */
	public function getMasterSlave() {
		static $msManager = null;
		if ($msManager == null) {
			$msManager = new MasterSlaveManager();
		}
		return $msManager;
	}

    /**
     * 读操作 返回slave
     *
     * @param \Phalcon\Mvc\ModelInterface $model
     *
     * @return \Phalcon\Db\Adapter\Pdo\Mysql
     */
    public function getReadConnection(\Phalcon\Mvc\ModelInterface $model)
    {
		return $this->getMasterSlave()->getConnection(false);
    }


    /**
     * 写操作 返回master
     *
     * @param \Phalcon\Mvc\ModelInterface $model
     *
     * @return \Phalcon\Db\Adapter\Pdo\Mysql
     */
    public function getWriteConnection(\Phalcon\Mvc\ModelInterface $model)
    {
		return $this->getMasterSlave()->getConnection(true);
    }
}
