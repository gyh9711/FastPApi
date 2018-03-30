<?php
return [
	//think-orm 扩展数据库连接配置 
    'think'=> [
        'mysql'=>[
            'type'        => 'mysql',
            // 服务器地址
            'hostname'    => '127.0.0.1',
            // 数据库名
            'database'    => 'fastpapi',
            // 数据库用户名
            'username'    => 'root',
            // 数据库密码
            'password'    => 'admin678^&*',
            // 数据库编码默认采用utf8
            'charset'     => 'utf8',
            // 数据库表前缀
            'prefix'      => 'fapi_',
        ],
/*         'sqlite'=>[
            'type' => 'sqlite',
            'dsn' => 'sqlite:\data\test_sqlite3.db',
            'charset' => 'utf8',
            'prefix' => 'yl_',
        ], */
    ],
];