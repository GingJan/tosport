-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2015 年 01 月 31 日 20:35
-- 服务器版本: 5.5.28
-- PHP 版本: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `tosport`
--

-- --------------------------------------------------------

--
-- 表的结构 `spt_user_info`
--

CREATE TABLE IF NOT EXISTS `spt_user_info` (
  `u_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增长ID',
  `account` varchar(32) NOT NULL COMMENT '用户账号',
  `nickname` varchar(32) NOT NULL COMMENT '昵称',
  `sex` char(8) DEFAULT NULL COMMENT '性别',
  `phone` varchar(16) DEFAULT NULL COMMENT '电话',
  `email` varchar(64) DEFAULT NULL COMMENT '邮箱',
  `avatar` varchar(256) DEFAULT NULL COMMENT '头像',
  `intro` text COMMENT '个性签名',
  `birth` int(10) unsigned DEFAULT NULL COMMENT '生日',
  `spt_favor` text COMMENT '运动爱好',
  `region` varchar(32) DEFAULT NULL COMMENT '地区',
  `ctime` int(10) unsigned NOT NULL COMMENT '注册日期',
  `cIP` varchar(15) NOT NULL COMMENT '注册IP',
  `last_time` int(10) unsigned NOT NULL COMMENT '上次登录时间',
  `last_IP` varchar(15) NOT NULL COMMENT '上次登录IP',
  PRIMARY KEY (`u_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='用户表' AUTO_INCREMENT=31 ;

--
-- 转存表中的数据 `spt_user_info`
--

INSERT INTO `spt_user_info` (`u_id`, `account`, `nickname`, `sex`, `phone`, `email`, `avatar`, `intro`, `birth`, `spt_favor`, `region`, `ctime`, `cIP`, `last_time`, `last_IP`) VALUES
(1, 'zjien', 'handsomeguy', '男', '12345678901', 'zjien@qq.com', NULL, 'good man', NULL, NULL, '深圳', 1422431594, '127.0.0.1', 1422692079, '127.0.0.1'),
(2, 'zjien1', 'zjien1', '男', NULL, 'zjien1@qq.com', NULL, NULL, NULL, NULL, '江门', 1422430617, '127.0.0.1', 1422691814, '127.0.0.1'),
(3, 'zjien3', 'zjien3', '男', NULL, 'zjien3@qq.com', NULL, NULL, NULL, NULL, '广州', 1422430669, '127.0.0.1', 1422691862, '127.0.0.1'),
(4, 'xiaoming', 'xiaoming', '男', '', 'xiaoming@qq.com', NULL, NULL, NULL, NULL, '江门', 1420437981, '127.0.0.1', 1422691902, '127.0.0.1'),
(5, 'xiaoli', 'xiaoli', '女', NULL, 'xiaoli@qq.com', NULL, NULL, NULL, NULL, '深圳', 1420437987, '127.0.0.1', 1422691935, '127.0.0.1'),
(6, 'xiaohong', 'xiaohong', '女', NULL, 'xiaohong@qq.com', NULL, NULL, NULL, NULL, '深圳', 1420437990, '127.0.0.1', 1422692016, '127.0.0.1'),
(7, 'xiaobao', 'xiaobao', '男', NULL, 'xiaobao@qq.com', NULL, NULL, NULL, NULL, '广州', 1420437994, '127.0.0.1', 1422691963, '127.0.0.1'),
(8, 'xiaohua', 'xiaohua', NULL, NULL, 'xiaohua@qq.com', NULL, NULL, NULL, NULL, '广州', 1420437997, '127.0.0.1', 1420437997, '127.0.0.1'),
(9, 'xiaowang', 'xiaowang', '男', NULL, 'xiaowang@qq.com', NULL, NULL, NULL, NULL, '珠海', 1420438001, '127.0.0.1', 1420438001, '127.0.0.1');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
