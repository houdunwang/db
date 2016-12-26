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

use houdunwang\arr\Arr;
use houdunwang\config\Config;

/**
 * Class Db
 * @package houdunwang\db
 */
class Db {
	//连接
	protected $link = null;
	protected $config;

	public function __construct() {
		$this->config( Config::get( 'database' ) );
	}

	//设置配置项
	public function config( $config, $value = null ) {
		if ( is_array( $config ) ) {
			//格式配置项
			if ( empty( $config['write'] ) ) {
				$config['write'][] = Arr::getExtName( $config, [ 'read', 'write' ] );
			}
			if ( empty( $config['read'] ) ) {
				$config['read'][] = Arr::getExtName( $config, [ 'read', 'write' ] );
			}
			$this->config = $config;

			return $this;
		} else if ( is_null( $value ) ) {
			return Arr::get( $this->config, $config );
		} else {
			$this->config = Arr::set( $this->config, $config, $value );

			return $this;
		}
	}

	//更改缓存驱动
	protected function driver() {
		$this->link = new Query( $this );

		return $this;
	}

	public function __call( $method, $params ) {
		if ( is_null( $this->link ) ) {
			$this->driver();
		}

		return call_user_func_array( [ $this->link, $method ], $params );
	}

	public static function __callStatic( $name, $arguments ) {
		return call_user_func_array( [ new static(), $name ], $arguments );
	}
}