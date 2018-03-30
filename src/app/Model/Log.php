<?php
namespace App\Model;

use think\Model;

class Log extends Model
{
    // 设置当前模型对应的完整数据表名称
    protected $table = 'fapi_log';
    
    // 设置当前模型的数据库连接
    protected $autoWriteTimestamp = 'create_time';
    //自动完成字段
    protected $insert = ['action_ip'];
    
     // 定义时间戳字段名
    // protected $createTime = 'create_at';
    // protected $updateTime = 'update_at';
    public function setCreateTimeAttr($value)
    {
        return strtotime($value);
    }
	public function setActionIpAttr($value)
    {
        return \App\getRealIp();
    }
  
    /* 
        自动记录登录过ip
    */
    public function recordIp() 
    {
        //如一小时内登录过，则不记录
        if (!$this->where('action_ip', \App\getRealIp())->whereTime('create_time','-1 hours')->find()) {
            $this->create();
        }
    }
}
