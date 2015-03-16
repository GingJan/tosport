-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2015 年 02 月 06 日 16:18
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
-- 表的结构 `spt_date_person`
--

CREATE TABLE IF NOT EXISTS `spt_date_person` (
  `d_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'date表自增长id',
  `de_id` int(10) unsigned NOT NULL COMMENT '对应约运动表的de_id',
  `creator_id` int(10) unsigned NOT NULL COMMENT '对应约运动表的creator_id',
  `me_id` int(10) unsigned NOT NULL COMMENT '本人的u_id',
  `create_time` int(10) unsigned NOT NULL COMMENT '点约的时间',
  PRIMARY KEY (`d_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='约ta表' AUTO_INCREMENT=14 ;

--
-- 转存表中的数据 `spt_date_person`
--

INSERT INTO `spt_date_person` (`d_id`, `de_id`, `creator_id`, `me_id`, `create_time`) VALUES
(13, 1, 1, 2, 1422885327),
(8, 1, 1, 3, 1422882515),
(11, 5, 4, 2, 1422885160),
(12, 6, 5, 2, 1422885270);

--
-- 触发器 `spt_date_person`
--
DROP TRIGGER IF EXISTS `tg_date_exercise_booked_amount_up`;
DELIMITER //
CREATE TRIGGER `tg_date_exercise_booked_amount_up` AFTER INSERT ON `spt_date_person`
 FOR EACH ROW begin
update spt_date_exercise set booked_amount=booked_amount+1 where de_id=new.de_id;
end
//
DELIMITER ;
DROP TRIGGER IF EXISTS `tg_date_exercise_booked_amount_down`;
DELIMITER //
CREATE TRIGGER `tg_date_exercise_booked_amount_down` AFTER DELETE ON `spt_date_person`
 FOR EACH ROW begin
update spt_date_exercise set booked_amount=booked_amount-1 where de_id=old.de_id;
end
//
DELIMITER ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
