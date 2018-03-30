<?php
namespace App;

 /*
 * 获取系统cpu信息
  *@desc 获取系统cpu信息
 * @return string 
 */
function getCpu()
{
	return ['cpu'=>'100%'];
}


 /*
 * 返回系统路由表信息
  *@desc 返回系统路由表信息
 * @return string 
 */
function getRoute()
{
	$output = shell_exec('netstat -rn');
	//\Phalapi\DI()->logger->info('route',$outpu);
	$output = empty($output)?'调用不了系统命令':$output;
	return $output;
}
// print_r(getRoute());
 /*
 * 获取访问ip地址
  *@desc 获取访问ip地址
 * @return string 
 */
function getRealIp()
{
    $ip=false;
    if(!empty($_SERVER["HTTP_CLIENT_IP"])){
        $ip = $_SERVER["HTTP_CLIENT_IP"];
    }
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ips = explode (", ", $_SERVER['HTTP_X_FORWARDED_FOR']);
        if ($ip) { array_unshift($ips, $ip); $ip = FALSE; }
        for ($i = 0; $i < count($ips); $i++) {
            if (!eregi ("^(10│172.16│192.168).", $ips[$i])) {
                $ip = $ips[$i];
                break;
            }
        }
    }
    return ($ip ? $ip : $_SERVER['REMOTE_ADDR']);
}