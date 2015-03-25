-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2015 年 03 月 25 日 10:12
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
-- 表的结构 `spt_venue_info`
--

CREATE TABLE IF NOT EXISTS `spt_venue_info` (
  `vi_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增长id',
  `ma_id` int(10) unsigned NOT NULL COMMENT '创建该场馆的管理员的ma_id',
  `name` varchar(32) NOT NULL COMMENT '名称',
  `people` int(10) unsigned NOT NULL COMMENT '最大允许预约人数',
  `booked` int(10) unsigned NOT NULL COMMENT '已被预约人数',
  `picture` varchar(256) DEFAULT NULL COMMENT '照片',
  `type` varchar(64) NOT NULL COMMENT '所提供的运动类型',
  `price` varchar(8) NOT NULL COMMENT '价格',
  `bought` int(10) unsigned DEFAULT '0' COMMENT '被购买次数',
  `region` varchar(16) NOT NULL COMMENT '所在城市',
  `intro` text COMMENT '描述',
  `last_time` int(10) unsigned NOT NULL COMMENT '最后一次修改时间',
  `last_IP` varchar(15) NOT NULL COMMENT '最后一次修改IP',
  PRIMARY KEY (`vi_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='场馆信息表' AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `spt_venue_info`
--

INSERT INTO `spt_venue_info` (`vi_id`, `ma_id`, `name`, `people`, `booked`, `picture`, `type`, `price`, `bought`, `region`, `intro`, `last_time`, `last_IP`) VALUES
(1, 2, '市第一体育馆', 5, 0, 'http://pic.baike.soso.com/p/20131211/bki-20131211160211-514050414.jpg', '羽毛球 乒乓球', '25', 1, '江门', '提供场地，不提供球拍', 1423127800, '127.0.0.1'),
(2, 2, '超级体育馆', 7, 0, 'http://img.etu6.com/attr/20100330/Attr_201003301317465656_1.jpg', '篮球 羽毛球 足球', '25', 1, '深圳', '有第二体育馆升级来', 1423295964, '127.0.0.1'),
(3, 1, '市第三体育馆', 7, 1, 'http://img5.imgtn.bdimg.com/it/u=3825268339,1865925764&fm=21&gp=0.jpg', '足球', '35', 0, '江门', '提供足球和场地', 1423127835, '127.0.0.1'),
(4, 3, '省第一体育馆', 10, 0, 'http://img0.imgtn.bdimg.com/it/u=3069197522,1107101938&fm=23&gp=0.jpg', '排球', '20', 1, '广州', '提供球和场地', 1423127900, '127.0.0.1'),
(5, 2, '网球体育馆', 5, 0, 'http://img4.imgtn.bdimg.com/it/u=258632758,3833501514&fm=21&gp=0.jpg', '网球', '20', 0, '江门', '不提供球和拍', 1423127910, '127.0.0.1'),
(7, 2, '雀巢体育馆', 6, 0, 'http://img3.imgtn.bdimg.com/it/u=2334680517,8951550&fm=11&gp=0.jpg', '羽毛球 足球 篮球 网球 排球 高尔夫球 保龄球', '50', 0, '北京', '该体育馆按照鸟巢的形状设计，因此名为雀巢', 1423295275, '127.0.0.1');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
