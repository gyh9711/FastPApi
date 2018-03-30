/*
SQLyog  v12.4.1 (64 bit)
MySQL - 5.7.20 : Database - fastpapi
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`fastpapi` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `fastpapi`;

/*Table structure for table `fapi_finger` */

DROP TABLE IF EXISTS `fapi_finger`;

CREATE TABLE `fapi_finger` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID号',
  `type` enum('php','python','javascript','css','shell') NOT NULL DEFAULT 'php' COMMENT '客户登录名',
  `key` char(30) NOT NULL COMMENT 'key名称',
  `title` varchar(100) DEFAULT NULL COMMENT '说明',
  `code` text NOT NULL COMMENT '编码',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `status` tinyint(1) DEFAULT '1' COMMENT '是否可用',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

/*Data for the table `fapi_finger` */

insert  into `fapi_finger`(`id`,`type`,`key`,`title`,`code`,`create_time`,`status`) values 
(1,'php','f_info','函数说明','    /*\r\n	 * 执行系统命令\r\n     * @desc 认证服务接口\r\n	 * @return string username 标题\r\n	 * @return string password 密码\r\n    */',0,1),
(14,'php','f_info_i',NULL,'    /**      * 增加新代码      * @desc 根据key查找对应代码段 	 * @return json 返回数据      */     public function add() { 		 		 		if ($this->finger_insert == \'y\') 		$find = FingerM::where(\'key\',$this->finger_key)->where(\'type\',$this->finger_type)->find(); 		         if ($find) { 			 			if ($this->finger_insert == \'y\') { 				$find->code = $this->finger_code; 				$find->save(); 				return \'更新成功\'; 			}; 			throw new BadRequestException(\'代码段史称已经存在!\'); 		} else { 			return $find->toArray(); 		}     }',0,1),
(15,'php','f_info_2',NULL,'    /**      * 增加新代码      * @desc 根据key查找对应代码段 	 * @return json 返回数据      */     public function add() { 		 		 		if ($this->finger_insert == \'y\') 		$find = FingerM::where(\'key\',$this->finger_key)->where(\'type\',$this->finger_type)->find(); 		         if ($find) { 			 			if ($this->finger_insert == \'y\') { 				$find->code = $this->finger_code; 				$find->save(); 				return \'更新成功\'; 			}; 			throw new BadRequestException(\'代码段史称已经存在!\'); 		} else { 			return $find->toArray(); 		}     }',1522399284,1);

/*Table structure for table `fapi_log` */

DROP TABLE IF EXISTS `fapi_log`;

CREATE TABLE `fapi_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `action_id` int(11) unsigned DEFAULT '0' COMMENT '行为id',
  `user_id` int(11) unsigned DEFAULT '0' COMMENT '执行用户id',
  `action_ip` char(50) DEFAULT NULL COMMENT '执行行为者ip',
  `model` varchar(50) DEFAULT '' COMMENT '触发行为的表',
  `record_id` int(11) unsigned DEFAULT '0' COMMENT '触发行为的数据id',
  `remark` longtext COMMENT '日志备注',
  `status` tinyint(2) DEFAULT '1' COMMENT '状态',
  `create_time` int(11) unsigned DEFAULT '0' COMMENT '执行行为的时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

/*Data for the table `fapi_log` */

insert  into `fapi_log`(`id`,`action_id`,`user_id`,`action_ip`,`model`,`record_id`,`remark`,`status`,`create_time`) values 
(32,0,0,'127.0.0.1','',0,NULL,1,1522416963);

/*Table structure for table `fapi_user` */

DROP TABLE IF EXISTS `fapi_user`;

CREATE TABLE `fapi_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID号',
  `title` tinytext COMMENT '名称',
  `sign` char(60) NOT NULL COMMENT '客户加密sign',
  `login` char(60) DEFAULT NULL COMMENT '客户登录名',
  `user_ip` char(40) DEFAULT NULL COMMENT '客户ip地址',
  `user_domain` char(100) DEFAULT NULL COMMENT '客户域名',
  `update_time` int(11) DEFAULT NULL COMMENT '添加用户ID',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `status` tinyint(1) DEFAULT '1' COMMENT '是否可用',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `fapi_user` */

insert  into `fapi_user`(`id`,`title`,`sign`,`login`,`user_ip`,`user_domain`,`update_time`,`create_time`,`status`) values 
(1,NULL,'test',NULL,NULL,NULL,NULL,0,1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
