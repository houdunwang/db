<?php
/** .-------------------------------------------------------------------
 * |  Software: [HDCMS framework]
 * |      Site: www.hdphp.com
 * |-------------------------------------------------------------------
 * |    Author: 向军 <2300071698@qq.com>
 * |    WeChat: aihoudun
 * | Copyright (c) 2012-2019, www.houdunwang.com. All Rights Reserved.
 * '-------------------------------------------------------------------*/

namespace houdunwang\db\connection;

class Mysql implements DbInterface
{
    use Connection;

    /**
     * PDO连接
     *
     * @return string
     */
    public function getDns()
    {
        return $dns = 'mysql:dbname='.$this->config['database'].';host='.$this->config['host'].';port='.$this->config['port'];
    }
}