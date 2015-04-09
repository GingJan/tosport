-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2015 年 04 月 09 日 21:10
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
-- 表的结构 `spt_date_exercise`
--

CREATE TABLE IF NOT EXISTS `spt_date_exercise` (
  `de_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增长id',
  `creator_id` int(10) unsigned NOT NULL COMMENT '发布人u_id',
  `sport_type` varchar(32) NOT NULL COMMENT '运动类型',
  `sport_place` varchar(32) NOT NULL COMMENT '运动地点',
  `sport_time` int(10) unsigned NOT NULL COMMENT '运动时间',
  `content` text COMMENT '附加内容',
  `people_amount` int(10) unsigned NOT NULL COMMENT '人数上限',
  `booked_amount` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '已预约人数',
  `picture` varchar(64) DEFAULT NULL COMMENT '图片',
  `creator_region` varchar(32) NOT NULL COMMENT '发布人的地区',
  `create_time` int(10) unsigned NOT NULL COMMENT '发布时间',
  PRIMARY KEY (`de_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='约运动表' AUTO_INCREMENT=18 ;

--
-- 转存表中的数据 `spt_date_exercise`
--

INSERT INTO `spt_date_exercise` (`de_id`, `creator_id`, `sport_type`, `sport_place`, `sport_time`, `content`, `people_amount`, `booked_amount`, `picture`, `creator_region`, `create_time`) VALUES
(1, 1, '网球', '五邑大学1号网球场', 1422875858, '网球王子，来打网球吧', 2, 2, 'Public/img/Exercise/5523f02d3ca5b.png', '江门', 1422874342),
(2, 2, '篮球', '五邑大学风雨篮球场', 1422876010, '大家来打篮球', 10, 1, 'Public/img/Exercise/5523f05b134a1.png', '江门', 1422874449),
(3, 3, '羽毛球', '广州体育馆', 1422876100, '打羽毛球咯', 2, 0, 'Public/img/Exercise/5523f07ca37b4.png', '广州', 1422874493),
(4, 3, '羽毛球', '深圳体育馆', 1422876157, '大家来打羽毛球咯', 5, 0, 'Public/img/Exercise/5524e8b0f2d56.png', '深圳', 1422874534),
(5, 4, '乒乓球', '深圳体育馆', 1422876157, '大家来打乒乓球咯', 3, 1, 'Public/img/Exercise/5524e86e623a4.png', '深圳', 1422874577),
(6, 5, '足球', '天河体育馆', 1422876257, '大家来踢足球', 13, 1, 'Public/img/Exercise/5524e973073df.png', '广州', 1422874630),
(7, 6, '跳舞', '五邑大学舞蹈室', 1422876257, '跳舞咯', 5, 0, 'Public/img/Exercise/5524e96416973.png', '江门', 1422874751),
(8, 8, '跑步', '东湖公园', 1422876363, '跑步', 3, 0, 'Public/img/Exercise/552480af08191.png', '江门', 1422874815),
(10, 2, '羽毛球', '羽毛球馆', 1428499000, '大家来打羽毛器咯', 5, 0, 'Public/img/Exercise/5524807de92de.png', '江门', 1428418788),
(11, 2, '羽毛球', '羽毛球馆', 1428499000, '大家来打羽毛器咯', 5, 0, 'Public/img/Exercise/20150409203931.png', '江门', 1428454993),
(12, 2, '羽毛球', '羽毛球馆', 1428499010, '大家来打羽毛器咯', 2, 0, 'Public/img/Exercise/20150409203942.png', '江门', 1428455027),
(13, 2, '羽毛球', '羽毛球馆', 1428499010, '大家来打羽毛器咯', 2, 0, 'Public/img/Exercise/20150409203955.png', '江门', 1428455492),
(14, 2, '羽毛球', '羽毛球馆', 1428499010, '', 2, 0, 'Public/img/Exercise/20150409204007.png', '江门', 1428455548);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
