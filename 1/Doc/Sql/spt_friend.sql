-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2015 年 01 月 31 日 20:34
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
-- 表的结构 `spt_friend`
--

CREATE TABLE IF NOT EXISTS `spt_friend` (
  `f_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增长id',
  `me_id` int(10) unsigned NOT NULL COMMENT '本人的u_id',
  `friend_id` int(10) unsigned NOT NULL COMMENT '好友的u_id',
  `add_time` int(10) unsigned NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`f_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='朋友关系表' AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `spt_friend`
--

INSERT INTO `spt_friend` (`f_id`, `me_id`, `friend_id`, `add_time`) VALUES
(1, 1, 2, 1422684773),
(2, 1, 3, 1422684777),
(3, 2, 4, 1422685184);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
