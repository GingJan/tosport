-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2015 年 04 月 05 日 17:18
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
-- 表的结构 `spt_letter`
--

CREATE TABLE IF NOT EXISTS `spt_letter` (
  `l_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增长id',
  `sender_id` int(10) unsigned NOT NULL COMMENT '发送者的u_id',
  `receiver_id` int(10) unsigned NOT NULL COMMENT '接受者的u_id',
  `title` varchar(32) CHARACTER SET utf8 COLLATE utf8_estonian_ci DEFAULT NULL COMMENT '标题',
  `content` text NOT NULL COMMENT '内容',
  `send_time` int(10) unsigned NOT NULL COMMENT '发送时间/收到时间',
  `isread` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否已读',
  PRIMARY KEY (`l_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='私信表' AUTO_INCREMENT=19 ;

--
-- 转存表中的数据 `spt_letter`
--

INSERT INTO `spt_letter` (`l_id`, `sender_id`, `receiver_id`, `title`, `content`, `send_time`, `isread`) VALUES
(1, 1, 2, '1-2', 'I want to make friend with you', 1422757390, 0),
(2, 1, 3, '1-3', 'I want to make friend with you', 1422757405, 0),
(3, 2, 3, '2-3', 'I want to make friend with you', 1422757490, 0),
(4, 2, 1, '2-1', 'I want to make friend with you', 1422757567, 0),
(5, 1, 4, '1-4', 'I want to make friend with you', 1422757751, 0),
(6, 1, 2, '1-2', 'I want to make friend with you', 1422757754, 0),
(7, 3, 1, '3-1', 'test1', 1422757801, 0),
(8, 3, 2, '3-2', 'test2', 1422757810, 0),
(10, 3, 1, '3-1', 'test 2', 1422758010, 0),
(12, 1, 5, '1-5', 'hello,this is test1', 1427893602, 0),
(13, 1, 2, '1-2', 'hello,this is test1', 1427893605, 0),
(14, 1, 6, '1-6', 'hello,this is test6', 1427893624, 0),
(15, 1, 3, '1-3', 'hello,this is test3', 1427893694, 0),
(16, 1, 2, NULL, 'hello', 1428224960, 0),
(17, 1, 2, NULL, 'hello2', 1428225021, 0),
(18, 1, 2, NULL, 'hello again', 1428225026, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
