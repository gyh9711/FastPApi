<?php 
/**
 * 以下配置为系统级的配置，通常放置不同环境下的不同配置
 * 
 * @license     http://www.phalapi.net/license GPL 协议
 * @link        http://www.phalapi.net/
 * @author dogstar <chanzonghuang@gmail.com> 2017-07-13
 */

return array(
	/**
	 * 默认环境配置
	 */
	'debug' => false,

    /**
     * 加密
     */
    'crypt' => array(
        'mcrypt_iv' => 'szfw.xyz.2018',      //8位
    ),
);
