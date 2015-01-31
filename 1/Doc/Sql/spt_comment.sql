-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2015 年 01 月 31 日 20:33
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
-- 表的结构 `spt_comment`
--

CREATE TABLE IF NOT EXISTS `spt_comment` (
  `c_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增长id',
  `tl_id` int(10) unsigned NOT NULL COMMENT '主题帖的tl_id',
  `sender_id` int(10) unsigned NOT NULL COMMENT '评论人的u_id',
  `receiver_id` int(10) unsigned NOT NULL COMMENT '接收者u_id',
  `send_time` int(10) unsigned NOT NULL COMMENT '评论时间',
  `content` text COMMENT '评论内容',
  `like` int(10) DEFAULT NULL,
  PRIMARY KEY (`c_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='评论表' AUTO_INCREMENT=11 ;

--
-- 转存表中的数据 `spt_comment`
--

INSERT INTO `spt_comment` (`c_id`, `tl_id`, `sender_id`, `receiver_id`, `send_time`, `content`, `like`) VALUES
(1, 2, 2, 1, 1422693636, 'hello,nice to meet you ,I''m zjien1', NULL),
(2, 2, 2, 1, 1422693689, 'hello,nice to meet you ,I''m zjien1 whats up', NULL),
(3, 2, 1, 2, 1422694517, 'hi,glad to see you too', NULL),
(5, 2, 3, 1, 1422694592, 'hi,I am zjien3 ,I make a Comment', NULL),
(10, 2, 3, 1, 1422695089, NULL, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
