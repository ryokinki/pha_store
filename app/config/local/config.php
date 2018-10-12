<?php
//本地环境

return [
	'database' => [ 
		'write' => [
			'adapter'     => 'Mysql',
			'host'        => '127.0.0.1',
			'username'    => 'root',
			'password'    => '123',
			'dbname'      => 'test',
			'charset'     => 'utf8',
		],
		'read' => [
			[
				'adapter'     => 'Mysql',
				'host'        => '127.0.0.1',
				'username'    => 'rootlocal',
				'password'    => '123',
				'dbname'      => 'test111',
				'charset'     => 'utf8',
			],
			[
				'adapter'     => 'Mysql',
				'host'        => '127.0.0.1',
				'username'    => 'root',
				'password'    => '123',
				'dbname'      => 'test222',
				'charset'     => 'utf8',
			],
		],
    ],
	'queue' => [
		'default' => 'beanstalk',
		'beanstalk' => [
			'system' => 'tmp',
			'host' => '127.0.0.1',
			'port' => '11300',
		],
	],
	'log_path' => '/home/work/log/applog',
];
