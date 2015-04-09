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
-- 表的结构 `spt_like`
--

CREATE TABLE IF NOT EXISTS `spt_like` (
  `lk_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增长id',
  `tl_id` int(10) unsigned NOT NULL COMMENT '动态id',
  `sender_id` int(10) unsigned NOT NULL COMMENT '点赞人id',
  `receiver_id` int(10) unsigned NOT NULL COMMENT '动态发布人id',
  `send_time` int(10) unsigned NOT NULL COMMENT '点赞时间',
  PRIMARY KEY (`lk_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='点赞表' AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `spt_like`
--

INSERT INTO `spt_like` (`lk_id`, `tl_id`, `sender_id`, `receiver_id`, `send_time`) VALUES
(1, 7, 1, 4, 1427637109),
(2, 7, 5, 4, 1427637192),
(4, 8, 5, 5, 1427637336);

--
-- 触发器 `spt_like`
--
DROP TRIGGER IF EXISTS `tg_timeline_like_up`;
DELIMITER //
CREATE TRIGGER `tg_timeline_like_up` AFTER INSERT ON `spt_like`
 FOR EACH ROW begin
update spt_timeline set like_amount=IFNULL(like_amount,0)+1 where tl_id=new.tl_id;
end
//
DELIMITER ;
DROP TRIGGER IF EXISTS `tg_timeline_like_down`;
DELIMITER //
CREATE TRIGGER `tg_timeline_like_down` AFTER DELETE ON `spt_like`
 FOR EACH ROW begin
update spt_timeline set like_amount=IF(like_amount-1,like_amount-1,NULL) where tl_id = old.tl_id;
end
//
DELIMITER ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
