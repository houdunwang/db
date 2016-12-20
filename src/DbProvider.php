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

use hdphp\kernel\ServiceProvider;

/**
 * Class DbProvider
 * @package hdphp\db
 */
class DbProvider extends ServiceProvider {
	//延迟加载
	public $defer = true;

	public function boot() {
		//加载.env配置
		if ( is_file( '.env' ) ) {
			$config = [ ];
			foreach ( file( '.env' ) as $file ) {
				$data = explode( '=', $file );
				if ( count( $data ) == 2 ) {
					$config[ trim( $data[0] ) ] = trim( $data[1] );
				}
			}
			c( 'database.host', $config['DB_HOST'] );
			c( 'database.user', $config['DB_USER'] );
			c( 'database.password', $config['DB_PASSWORD'] );
			c( 'database.database', $config['DB_DATABASE'] );
		}
		//将公共数据库配置合并到 write 与 read 中
		$config = \Config::getExtName( 'database', [ 'write', 'read' ] );
		if ( empty( $config['write'] ) ) {
			$config['write'][] = \Config::getExtName( 'database', [
				'write',
				'read'
			] );
		}
		if ( empty( $config['read'] ) ) {
			$config['read'][] = \Config::getExtName( 'database', [
				'write',
				'read'
			] );
		}
		c( 'database', $config );
	}

	public function register() {
		$this->app->single( 'Db', function ( $app ) {
			return new Db();
		} );
	}
}