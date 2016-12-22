<?php
require 'vendor/autoload.php';
\houdunwang\config\Config::set( 'database', [
	//读库列表
	'read'     => [ ],
	//写库列表
	'write'    => [ ],
	//表字段缓存目录
	'cacheDir' => 'storage/field',
	//开启读写分离
	'proxy'    => false,
	//主机
	'host'     => 'localhost',
	//类型
	'driver'   => 'mysql',
	//帐号
	'user'     => 'root',
	//密码
	'password' => 'admin888',
	//数据库
	'database' => 'demo',
	//表前缀
	'prefix'   => ''
] );
$obj = new \houdunwang\db\Db();
$d   = $obj->query( 'select * from news' );
print_r( $d );
print_r( $obj->table( 'news' )->find( 1 ) );