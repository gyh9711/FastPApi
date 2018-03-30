<?php
/**
 * DI依赖注入配置文件
 * 
 * @license     http://www.phalapi.net/license GPL 协议
 * @link        http://www.phalapi.net/
 * @author      dogstar <chanzonghuang@gmail.com> 2017-07-13
 */

use PhalApi\Loader;
use PhalApi\Config\FileConfig;
use PhalApi\Logger;
use PhalApi\Logger\FileLogger;
use PhalApi\Database\NotORMDatabase;
//引入think模块
use think\Db;

/** ---------------- 基本注册 必要服务组件 ---------------- **/

$di = \PhalApi\DI();

// 配置
$di->config = new FileConfig(API_ROOT . '/config');

// 调试模式，$_GET['__debug__']可自行改名
$di->debug = !empty($_GET['__debug__']) ? true : $di->config->get('sys.debug');

// 日记纪录
$di->logger = new FileLogger(API_ROOT . '/runtime', Logger::LOG_LEVEL_DEBUG | Logger::LOG_LEVEL_INFO | Logger::LOG_LEVEL_ERROR);

// 数据操作 - 基于NotORM
//$di->notorm = new NotORMDatabase($di->config->get('dbs'), $di->debug);

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
// 支持JsonP的返回
// if (!empty($_GET['callback'])) {
//     $di->response = new \PhalApi\Response\JsonpResponse($_GET['callback']);
// }

//主录访问者ip 
(new \App\Model\Log())->recordIp();