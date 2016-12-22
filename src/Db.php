<?php
/** .-------------------------------------------------------------------
 * |  Software: [HDCMS framework]
 * |      Site: www.hdcms.com
 * |-------------------------------------------------------------------
 * |    Author: 向军 <2300071698@qq.com>
 * |    WeChat: aihoudun
 * | Copyright (c) 2012-2019, www.houdunwang.com. All Rights Reserved.
 * '-------------------------------------------------------------------*/
namespace houdunwang\db;

use houdunwang\config\Config;

/**
 * Class Db
 * @package houdunwang\db
 */
class Db {
	//构造函数
	public function __construct() {
	}

	/**
	 * 获取数据驱动
	 * @return Query
	 */
	public static function connect() {
		//格式配置项
		$config = Config::get( 'database' );
		if ( empty( $config['write'] ) ) {
			$config['write'][] = Config::getExtName( 'database', [ 'read', 'write' ] );
		}
		if ( empty( $config['read'] ) ) {
			$config['read'][] = Config::getExtName( 'database', [ 'read', 'write' ] );
		}
		Config::set( 'database', $config );

		//实例
		return new Query();
	}

	/**
	 * @param string $method 方法
	 * @param array $params 参数
	 *
	 * @return mixed
	 */
	public static function __callStatic( $method, $params ) {
		return call_user_func_array( [ self::connect(), $method ], $params );
	}

	public function __call( $name, $arguments ) {
		return self::__callStatic( $name, $arguments );
	}
}