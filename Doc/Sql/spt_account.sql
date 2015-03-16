-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2015 年 02 月 06 日 16:00
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
-- 表的结构 `spt_account`
--

CREATE TABLE IF NOT EXISTS `spt_account` (
  `a_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增长id',
  `account` varchar(32) NOT NULL COMMENT '账号_关联字段',
  `password` varchar(32) NOT NULL COMMENT '密码',
  PRIMARY KEY (`a_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='账号密码表' AUTO_INCREMENT=32 ;

--
-- 转存表中的数据 `spt_account`
--

INSERT INTO `spt_account` (`a_id`, `account`, `password`) VALUES
(1, 'zjien', '25d55ad283aa400af464c76d713c07ad'),
(2, 'zjien1', 'e10adc3949ba59abbe56e057f20f883e'),
(3, 'zjien3', 'e10adc3949ba59abbe56e057f20f883e'),
(4, 'xiaoming', 'e10adc3949ba59abbe56e057f20f883e'),
(5, 'xiaoli', 'e10adc3949ba59abbe56e057f20f883e'),
(6, 'xiaohong', 'e10adc3949ba59abbe56e057f20f883e'),
(7, 'xiaobao', 'e10adc3949ba59abbe56e057f20f883e'),
(8, 'xiaohua', 'e10adc3949ba59abbe56e057f20f883e'),
(9, 'xiaowang', 'e10adc3949ba59abbe56e057f20f883e'),
(31, 'tester', '25d55ad283aa400af464c76d713c07ad');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
