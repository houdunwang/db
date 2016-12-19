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
/**
 * Class Db
 * @package houdunwang\db
 */
class Db {

	//配置项
	protected $config = [ ];

	//构造函数
	public function __construct( $config ) {
		$this->config = $config;
	}

	/**
	 * 获取数据驱动
	 * @return Query
	 */
	public function connect() {
		return new Query( $this );
	}

	/**
	 * 获取配置
	 *
	 * @param $key
	 *
	 * @return array|void|null
	 */
	public function get( $key ) {
		$tmp    = $this->config;
		$config = explode( '.', $key );
		foreach ( (array) $config as $d ) {
			if ( isset( $tmp[ $d ] ) ) {
				$tmp = $tmp[ $d ];
			} else {
				return null;
			}
		}

		return $tmp;
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