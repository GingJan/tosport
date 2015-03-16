-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2015 年 02 月 06 日 16:03
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
-- 表的结构 `spt_manager`
--

CREATE TABLE IF NOT EXISTS `spt_manager` (
  `ma_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增长id',
  `account` varchar(32) NOT NULL COMMENT '账户',
  `password` varchar(32) NOT NULL COMMENT '密码',
  `nickname` varchar(32) DEFAULT NULL COMMENT '昵称',
  `email` varchar(64) DEFAULT NULL COMMENT '邮箱',
  `phone` varchar(16) DEFAULT NULL COMMENT '电话',
  `create_time` int(10) unsigned DEFAULT NULL COMMENT '注册时间',
  `create_IP` varchar(15) DEFAULT NULL COMMENT '注册IP',
  `last_time` int(10) unsigned DEFAULT NULL COMMENT '最近登录时间',
  `last_IP` varchar(15) DEFAULT NULL COMMENT '最近登录IP',
  PRIMARY KEY (`ma_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='管理员表' AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `spt_manager`
--

INSERT INTO `spt_manager` (`ma_id`, `account`, `password`, `nickname`, `email`, `phone`, `create_time`, `create_IP`, `last_time`, `last_IP`) VALUES
(1, 'super', 'e10adc3949ba59abbe56e057f20f883e', 'superM', NULL, NULL, 1423038560, '127.0.0.1', 1423194549, '127.0.0.1'),
(2, 'admin1', 'fcea920f7412b5da7be0cf42b8c93759', 'admin1', 'admin1@qq.com', '12345678901', 1423039536, '127.0.0.1', 1423151421, '127.0.0.1'),
(3, 'admin2', 'e10adc3949ba59abbe56e057f20f883e', 'admin2', NULL, NULL, 1423039605, '127.0.0.1', 1423039605, '127.0.0.1'),
(4, 'admin3', 'e10adc3949ba59abbe56e057f20f883e', 'admin3', NULL, NULL, 1423039610, '127.0.0.1', 1423039610, '127.0.0.1'),
(5, 'admin4', 'e10adc3949ba59abbe56e057f20f883e', 'admin4', NULL, NULL, 1423039612, '127.0.0.1', 1423039612, '127.0.0.1'),
(6, 'admin5', 'e10adc3949ba59abbe56e057f20f883e', 'admin5', NULL, NULL, 1423039615, '127.0.0.1', 1423039615, '127.0.0.1');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
