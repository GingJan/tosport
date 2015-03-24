-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2015 年 03 月 24 日 17:23
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
  `ma_id` int(10) unsigned DEFAULT NULL COMMENT '创建该场馆的管理员',
  `subscriber` int(10) unsigned NOT NULL COMMENT '预订人的u_id',
  `vi_id` int(10) unsigned NOT NULL COMMENT '场馆的vi_id',
  `date_time` int(10) unsigned NOT NULL COMMENT '预约时间',
  `order_time` int(10) unsigned NOT NULL COMMENT '下单时间',
  `done` int(10) unsigned DEFAULT NULL COMMENT '是否结单(1代表已结单)',
  PRIMARY KEY (`dv_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='场馆预约表' AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `spt_date_venue`
--

INSERT INTO `spt_date_venue` (`dv_id`, `ma_id`, `subscriber`, `vi_id`, `date_time`, `order_time`, `done`) VALUES
(1, 2, 1, 1, 1423159938, 1423151968, 1),
(2, 2, 1, 2, 1423146000, 1423145858, 1),
(3, 3, 2, 4, 1423159938, 1423151959, NULL),
(5, 1, 1, 3, 1423327220, 1423326232, NULL);

--
-- 触发器 `spt_date_venue`
--
DROP TRIGGER IF EXISTS `tg_venue_info_booked_up`;
DELIMITER //
CREATE TRIGGER `tg_venue_info_booked_up` AFTER INSERT ON `spt_date_venue`
 FOR EACH ROW begin
update spt_venue_info set booked=booked+1 where
vi_id=new.vi_id;
end
//
DELIMITER ;
DROP TRIGGER IF EXISTS `tg_venue_info_bought_up`;
DELIMITER //
CREATE TRIGGER `tg_venue_info_bought_up` AFTER UPDATE ON `spt_date_venue`
 FOR EACH ROW begin
update spt_venue_info set bought=bought+1 where
vi_id=new.vi_id;
end
//
DELIMITER ;
DROP TRIGGER IF EXISTS `tg_venue_info_booked_down`;
DELIMITER //
CREATE TRIGGER `tg_venue_info_booked_down` AFTER DELETE ON `spt_date_venue`
 FOR EACH ROW begin
update spt_venue_info set booked=booked-1 where vi_id=old.vi_id;
end
//
DELIMITER ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
