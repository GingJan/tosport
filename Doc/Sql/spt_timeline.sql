-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2015 年 03 月 29 日 22:15
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
-- 表的结构 `spt_timeline`
--

CREATE TABLE IF NOT EXISTS `spt_timeline` (
  `tl_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增长',
  `sender_id` int(10) unsigned NOT NULL COMMENT '发表人的u_id',
  `content` text NOT NULL COMMENT '内容',
  `picture` varchar(64) DEFAULT NULL COMMENT '图片',
  `create_time` int(10) unsigned NOT NULL COMMENT '发表时间',
  `now_region` varchar(32) DEFAULT NULL COMMENT '实时地区',
  `c_amount` int(10) unsigned DEFAULT NULL COMMENT '评论/赞数',
  `like_amount` int(10) unsigned DEFAULT NULL COMMENT '被赞数',
  PRIMARY KEY (`tl_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='好友动态表' AUTO_INCREMENT=13 ;

--
-- 转存表中的数据 `spt_timeline`
--

INSERT INTO `spt_timeline` (`tl_id`, `sender_id`, `content`, `picture`, `create_time`, `now_region`, `c_amount`, `like_amount`) VALUES
(2, 1, 'hello,I''m zjien.This is my second test', NULL, 1422691737, '深圳', NULL, NULL),
(3, 1, 'hello,I''m zjien.This is my third test', NULL, 1422691748, '深圳', NULL, NULL),
(4, 2, 'hello,I''m zjien1.my first test', NULL, 1422691844, '江门', NULL, NULL),
(5, 3, 'hello,I''m zjien3.my first test', NULL, 1422691870, '广州', NULL, NULL),
(6, 3, 'hello,I''m zjien3.my second test', NULL, 1422691883, '广州', 1, NULL),
(7, 4, 'hello,I''m xiaoming.my first test', NULL, 1422691919, '江门', 1, 2),
(8, 5, 'hello,I''m xiaoli.my second  test', NULL, 1422691928, '江门', NULL, 1),
(9, 5, 'hello,I''m xiaoli.my test', NULL, 1422691943, '深圳', NULL, NULL),
(10, 5, 'hello,I''m xiaoli.my test', NULL, 1422691956, '广州', NULL, NULL),
(11, 7, 'hello,I''m xiaobao .my test', NULL, 1422691970, '广州', NULL, NULL),
(12, 6, 'hello,I''m xiaohong .my test', NULL, 1422692023, '深圳', NULL, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
