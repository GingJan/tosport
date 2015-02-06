-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2015 年 02 月 06 日 16:17
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='评论表' AUTO_INCREMENT=12 ;

--
-- 转存表中的数据 `spt_comment`
--

INSERT INTO `spt_comment` (`c_id`, `tl_id`, `sender_id`, `receiver_id`, `send_time`, `content`, `like`) VALUES
(1, 2, 2, 1, 1422693636, 'hello,nice to meet you ,I''m zjien1', NULL),
(2, 2, 2, 1, 1422693689, 'hello,nice to meet you ,I''m zjien1 whats up', NULL),
(3, 2, 1, 2, 1422694517, 'hi,glad to see you too', NULL),
(5, 2, 3, 1, 1422694592, 'hi,I am zjien3 ,I make a Comment', NULL);

--
-- 触发器 `spt_comment`
--
DROP TRIGGER IF EXISTS `tg_timeline_c_amount_up`;
DELIMITER //
CREATE TRIGGER `tg_timeline_c_amount_up` AFTER INSERT ON `spt_comment`
 FOR EACH ROW begin
update spt_timeline set c_amount=IFNULL(c_amount,0)+1 where 
tl_id=new.tl_id;
end
//
DELIMITER ;
DROP TRIGGER IF EXISTS `tg_timeline_c_amount_down`;
DELIMITER //
CREATE TRIGGER `tg_timeline_c_amount_down` AFTER DELETE ON `spt_comment`
 FOR EACH ROW begin
update spt_timeline set c_amount=IF(c_amount-1,c_amount-1,NULL) where 
tl_id = old.tl_id;
end
//
DELIMITER ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
