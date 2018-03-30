<?php
namespace App\Model;

use think\Model;
/**
 * finger字典模型
 *
 * @author: 岩路 <63453409@qq.com> 2018-03-30
 */
class Finger extends Model {
	
	protected $table = 'yl_sys_finger';
	
	protected $autoWriteTimestamp = 'create_time';
    
    
}
