-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2015 年 02 月 06 日 16:02
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
-- 表的结构 `spt_date_venue`
--

CREATE TABLE IF NOT EXISTS `spt_date_venue` (
  `dv_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增长id',
  `subscriber` int(10) unsigned NOT NULL COMMENT '预订人的u_id',
  `vi_id` int(10) unsigned NOT NULL COMMENT '场馆的vi_id',
  `date_time` int(10) unsigned NOT NULL COMMENT '预约时间',
  `order_time` int(10) unsigned NOT NULL COMMENT '下单时间',
  PRIMARY KEY (`dv_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='场馆预约表' AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `spt_date_venue`
--

INSERT INTO `spt_date_venue` (`dv_id`, `subscriber`, `vi_id`, `date_time`, `order_time`) VALUES
(4, 1, 1, 1423159938, 1423151968),
(2, 1, 2, 1423146000, 1423145858),
(3, 2, 4, 1423159938, 1423151959);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
