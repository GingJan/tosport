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
-- 表的结构 `spt_account`
--

CREATE TABLE IF NOT EXISTS `spt_account` (
  `a_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增长id',
  `account` varchar(32) NOT NULL COMMENT '账号_关联字段',
  `email` varchar(64) NOT NULL COMMENT '用户邮箱',
  `password` varchar(32) NOT NULL COMMENT '密码',
  PRIMARY KEY (`a_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='账号密码表' AUTO_INCREMENT=31 ;

--
-- 转存表中的数据 `spt_account`
--

INSERT INTO `spt_account` (`a_id`, `account`, `email`, `password`) VALUES
(1, 'zjien', 'zjien@qq.com', 'e10adc3949ba59abbe56e057f20f883e'),
(2, 'zjien1', 'zjien1@qq.com', 'e10adc3949ba59abbe56e057f20f883e'),
(3, 'zjien3', 'zjien3@qq.com', 'e10adc3949ba59abbe56e057f20f883e'),
(4, 'xiaoming', 'xiaoming@qq.com', 'e10adc3949ba59abbe56e057f20f883e'),
(5, 'xiaoli', 'xiaoli@qq.com', 'e10adc3949ba59abbe56e057f20f883e'),
(6, 'xiaohong', 'xiaohong@qq.com', 'e10adc3949ba59abbe56e057f20f883e'),
(7, 'xiaobao', 'xiaobao@qq.com', 'e10adc3949ba59abbe56e057f20f883e'),
(8, 'xiaohua', 'xiaohua@qq.com', 'e10adc3949ba59abbe56e057f20f883e'),
(9, 'xiaowang', 'xiaowang@qq.com', 'e10adc3949ba59abbe56e057f20f883e');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
