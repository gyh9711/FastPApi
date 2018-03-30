# FastPapi

`项目采用Phalapi，一个专注api开发PHP框架，开发效率令人印象深刻; `


> 特色： 
>>  1.框架集成api文档自动生成，且集成在简单实用的在线测试操作介面
>>  2.框架设计小巧，易学易用。
>>  3.扩展能力强 

> 本项目代码是在phalapi原有实例基础上进行简要集成，目的是作为官方辅助文档资料


``` 
 在应用过程中，发现社区相对弱小，文档资料不多。
 因些产生将应用过程中一些经验进行分享，往后初步更新文档。
 期望对你有帮助
```

## 安装说明

1. 下载代码
2. 建数据库， 

> 1. 先手工建立fastpapi数据库
> 2. 将data/fastpapi.sql导入到fastpai数据库
> 3. 修改config\dbs.php中数据库配置信息，如 帐号，密码

```
补充：默认表中添加sign为 test  访问api时，默认配置需要用到。
```
4. 代码copy到www虚拟主机上
5. 测试功能 http://127.0.0.1/FashPapi/public/docs.php

> 这是接口帮助文档入口地址
> *重要提示*，系统已经开发包括php,python,Go等常用语言client访问sdk,具体详见sdk目录

6. 开发，增加新业务接口方法 

> 进入src\app\Api，参考现有接口类，则可快速写出自己的业务处理接口
> finger 接口，是直接对finger表进行读、写操作的实例
> sysinfo接口，则是调用function.php自定义函数，获取系统信息的实例
> common\LoginFiler.php 使用数据库user表，对访问进行验证的实例。
> app\Model目录，则是think-orm模型实例，应用方法详见thinkphp文档,有详细介绍
> app\Model\Log 记录ip访问日志，同一ip,每小时记录一次


`后期介绍文档再更新上`


# 实例功能

1. 获取系统状态信息，
2. 通过think-orm操作mysql数据库，或 sqlite
3. 简要访问认证，sign

# 系统第三方库集成

## 集成think-orm模型库 
    
> composer require topthink/think-orm

## 集成到phalapi

1.  config/dbs.php 添加数据库配置信息

```
return [
	//think-orm 扩展数据库连接配置 
    'think'=[
        'mysql'=>[
            'type'        ='mysql',
            // 服务器地址
            'hostname'    ='127.0.0.1',
            // 数据库名
            'database'    ='dolphin',
            // 数据库用户名
            'username'    ='root',
            // 数据库密码
            'password'    ='xxx*',
            // 数据库编码默认采用utf8
            'charset'     ='utf8',
            // 数据库表前缀
            'prefix'      ='yl_',
        ],
        'sqlite'=>[
            'type' ='sqlite',
            'dsn' ='sqlite:x:\data\test_sqlite3.db',
            'charset' ='utf8',
            'prefix' ='yl_',
        ],
    ],
];
```

2. /config/di.php初始化think-orm

> 添加如下信息

```
//think db model初始化
$di->thinkDbInit = function(){
	Db::setConfig(\PhalApi\DI()->config->get('dbs.think.mysql'));
};
//并直接初始化
$di->thinkDbInit;

/** ---------------- 定制注册 可选服务组件 ---------------- **/

// 签名验证服务
$di->filter = new \App\Common\LoginFilter();

// 缓存 - Memcache/Memcached
$di->cache = new PhalApi\Cache\FileCache(array('path' => API_ROOT . '/runtime', 'prefix' => 'ylfw_'));

```
3.应用详见实例 


# TODO

## 项目功能：
	
1. [X]集成think\Model模块;
2. [X]简易数据库操作api
3. [X]集成获取系统信息api,[实例】
4. []web代理功能




# 参考

1. [PhalApi2.X文档](http://docs.phalapi.net/#/v2.0/)
2. [Thinkphp5.1文档](https://www.kancloud.cn/manual/thinkphp5_1)
3. [think-orm](https://packagist.org/packages/topthink/think-orm)