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
		$this->setConfig();
	}

	/**
	 * 设置配置项
	 */
	protected function setConfig() {
		$instance = new Config();
		$config   = $instance->get( 'database' );
		if ( empty( $config['write'] ) ) {
			$config['write'][] = $instance->getExtName( 'database', [ 'read', 'write' ] );
		}
		if ( empty( $config['read'] ) ) {
			$config['read'][] = $instance->getExtName( 'database', [ 'read', 'write' ] );
		}
		$instance->set( 'database', $config );
	}

	/**
	 * 获取数据驱动
	 * @return Query
	 */
	public function connect() {
		return new Query( $this );
	}

	/**
	 * @param $method
	 * @param $params
	 *
	 * @return mixed
	 */
	public function __call( $method, $params ) {
		return call_user_func_array( [ $this->connect(), $method ], $params );
	}
}