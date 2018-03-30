<?php
namespace App\Common;

use PhalApi\Filter;
use PhalApi\Exception\BadRequestException;
use think\Db;

/**
 * 全局用户访问权限验证
 *
 * @author: 岩路 <63453409@qq.com> 2018-03-30
 */
class LoginFilter implements Filter
{
    public function check()
    {
        $signature = \PhalApi\DI()->request->get('sign');
		
		//缓存数据
		$users = \PhalApi\DI()->cache->get('users');
		if (empty($users)) {
			$users = array_values(Db::name('user')->where('status',1)->column('sign'));
			\PhalApi\DI()->cache->set('users', $users, 300); //缓存5分钟
		}
		if (!in_array($signature,$users)) {
			throw new BadRequestException('wrong sign', 1);
		}		
    }
}