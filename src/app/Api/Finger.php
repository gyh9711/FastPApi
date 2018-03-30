<?php
namespace App\Api;

use PhalApi\Api;
use PhalApi\Exception\BadRequestException;

use App\Model\Finger as FingerM;
/**
 * 在线fingertext代码库
 *
 * @desc 这是一个代码表接口
 * @author: 岩路 <63453409@qq.com> 2018-03-30
 */
class Finger extends Api {

	/*
	* 定义接口帮助文档信息
	*/
    public function getRules() {
        return [
            'finger' => [
                'finger_key' => ['name' => 'key','type'=>'string','require'=>true,'desc'=>'获取key名称','source'=>'post'],
                'finger_type' => ['name' => 'type', 'type' => 'enum', 'range' => ['php','python'], 'default' => 'php', 'desc' => '分类标签，按语言区分，默认php'],
            ],
            'add' => [
                'finger_key' => ['name' => 'key','type'=>'string','require'=>true,'desc'=>'获取key名称','source'=>'post'],
                'finger_title' => ['name' => 'key','type'=>'string','desc'=>'简要说明','source'=>'post'],
                'finger_type' => ['name' => 'type', 'type' => 'enum', 'range' => ['php','python'], 'default' => 'php', 'desc' => '分类标签，按语言区分，默认php'],
                'finger_code' => ['name' => 'code', 'type' => 'string','require'=>true, 'default' => '', 'desc' => '详细代码段'],
                'finger_insert' => ['name' => 'insert', 'type' => 'enum','range' => ['y','n'], 'require'=>true, 'default' => 'y', 'desc' => '如果存在，是否直接更新!默认是的 '],
            ],
        ];
    }
	
    /**
     * 根据key查找对应代码段
     * @desc 根据key查找对应代码段
	 * @return json 返回数据
     */
    public function finger() {
		
		if ($this->finger_key == '*') {
			
			return FingerM::limit(100)->field('key,type,title')->select();
		}
		$find = FingerM::where('key',$this->finger_key)->where('type',$this->finger_type)->find();
        if ($find) {
			return $find->toArray();
		} else {
			throw new BadRequestException('key数据不存在');
		}
    }
    
    /**
     * 增加新代码
     * @desc 根据key查找对应代码段
	 * @return json 返回数据
     */
    public function add() {
		
		$find = FingerM::where('key',$this->finger_key)->where('type',$this->finger_type)->find();
        if ($find) {
			if ($this->finger_insert == 'y') {
				$find->code = $this->finger_code;
				$find->save();
				return '更新成功!';
			};
			return '代码段已存在!';
			
		} else {
			
			if ( (new FingerM())->allowField(true)->save($_POST)) {
				return '添加成功!';
			} else {
				return '添加不成功!';
			}
			
		}
    }
    
}