-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2015 年 01 月 04 日 14:59
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
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增长ID',
  `account` varchar(32) NOT NULL COMMENT '用户账号',
  `nickname` varchar(32) NOT NULL COMMENT '昵称',
  `sex` char(8) DEFAULT NULL COMMENT '性别',
  `phone` varchar(16) DEFAULT NULL COMMENT '电话',
  `email` varchar(64) DEFAULT NULL COMMENT '邮箱',
  `avatar` varchar(256) DEFAULT NULL COMMENT '头像',
  `intro` text COMMENT '个性签名',
  `birth` int(10) DEFAULT NULL COMMENT '生日',
  `spt_favor` text COMMENT '运动爱好',
  `ctime` int(10) NOT NULL COMMENT '注册日期',
  `cIP` varchar(15) NOT NULL COMMENT '注册IP',
  `last_time` int(10) NOT NULL COMMENT '上次登录时间',
  `last_IP` varchar(15) NOT NULL COMMENT '上次登录IP',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='用户表' AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `spt_user_info`
--

INSERT INTO `spt_user_info` (`id`, `account`, `nickname`, `sex`, `phone`, `email`, `avatar`, `intro`, `birth`, `spt_favor`, `ctime`, `cIP`, `last_time`, `last_IP`) VALUES
(1, 'zjien', 'zjien', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1419301531, '127.0.0.1', 1420344501, '2130706433'),
(2, 'zjien1', 'zjien1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1420343855, '127.0.0.1', 1420344477, '2130706433'),
(3, 'zjien3', 'zjien3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1420344943, '127.0.0.1', 1420344943, '127.0.0.1');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
