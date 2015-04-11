-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2015 年 04 月 09 日 21:11
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
-- 表的结构 `spt_date_match`
--

CREATE TABLE IF NOT EXISTS `spt_date_match` (
  `dm_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增长id',
  `creator_id` int(10) unsigned NOT NULL COMMENT '发布人u_id',
  `match_type` varchar(32) NOT NULL COMMENT '比赛类型',
  `match_place` varchar(32) NOT NULL COMMENT '比赛地点',
  `match_time` int(10) unsigned NOT NULL COMMENT '比赛时间',
  `content` text COMMENT '附加内容',
  `picture` varchar(64) DEFAULT NULL COMMENT '图片',
  `people_amount` int(10) unsigned NOT NULL COMMENT '人数上限',
  `booked_amount` int(10) unsigned NOT NULL COMMENT '已预约人数',
  `creator_region` varchar(32) NOT NULL COMMENT '发布人实时位置',
  `create_time` int(10) unsigned NOT NULL COMMENT '发布时间',
  PRIMARY KEY (`dm_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='约比赛表' AUTO_INCREMENT=11 ;

--
-- 转存表中的数据 `spt_date_match`
--

INSERT INTO `spt_date_match` (`dm_id`, `creator_id`, `match_type`, `match_place`, `match_time`, `content`, `picture`, `people_amount`, `booked_amount`, `creator_region`, `create_time`) VALUES
(1, 1, '足球', '市体育馆', 1436224391, '来一场足球比赛', 'Public/img/match/20150409210217.png', 30, 16, '深圳', 1426224457),
(2, 2, '篮球', '市体育馆2', 1435224391, '来一场篮球比赛', 'Public/img/match/20150409210233.png', 15, 12, '江门', 1426224536),
(3, 3, '网球', '网球场1', 1445224391, '来一场网球比赛', 'Public/img/match/20150409210242.png', 4, 2, '江门', 1426224597),
(4, 4, '乒乓球', '乒乓球场', 1446224391, '来一场乒乓球比赛', 'Public/img/match/20150409210249.png', 6, 3, '北京', 1426224643),
(5, 5, '乒乓球', '乒乓球场2', 1447224391, '乒乓球比赛，走起', 'Public/img/match/20150409210257.png', 7, 1, '北京', 1426224682),
(6, 6, '橄榄球', '橄榄球场', 1445224391, '男人之间的比赛，走起', 'Public/img/match/20150409210310.png', 30, 1, '广州', 1426224756),
(9, 2, '足球', '足球场', 1428510717, '来踢足球咯', 'Public/img/match/20150409210437.png', 25, 1, '江门', 1428500745),
(10, 2, '篮球', '风雨篮球场', 1428520717, '来打篮球', 'Public/img/match/20150409210447.png', 25, 0, '江门', 1428503472);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
