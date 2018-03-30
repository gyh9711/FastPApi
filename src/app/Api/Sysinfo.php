<?php
namespace App\Api;

use PhalApi\Api;
use PhalApi\Exception\BadRequestException;

use App\Model\Finger as FingerM;


/**
 * 获取系统状态信息
 *
 * @desc 这是一个代码表接口
 * @author: 岩路 <63453409@qq.com> 2018-03-30
 */
class Sysinfo extends Api {

	/*
	* 定义接口帮助文档信息
	*/
    public function getRules() {
        return [
            'info' => [
                'info_type' => ['name' => 'type', 'type' => 'enum', 'range' => ['cpu','route'], 'default' => 'route', 'desc' => '获取系统状态信息 cpu | route '],
            ],
        ];
    }
	
    /**
     * 返回系统信息
     * @desc 根据key查找对应代码段
	 * @return json 返回数据
     */
    public function info() {
		
		\Phalapi\DI()->logger->info('info',$_POST);
		
		switch($this->info_type){
			case 'cpu':
				return \App\getCpu();
				break;
			case 'route':
				return \App\getRoute();
				break;
			default:
				return '访问有误';
		}
	
    }
 
}