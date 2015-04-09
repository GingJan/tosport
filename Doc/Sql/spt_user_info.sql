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
-- 表的结构 `spt_user_info`
--

CREATE TABLE IF NOT EXISTS `spt_user_info` (
  `u_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增长ID',
  `account` varchar(32) NOT NULL COMMENT '用户账号',
  `nickname` varchar(32) NOT NULL COMMENT '昵称',
  `sex` char(8) DEFAULT NULL COMMENT '性别',
  `phone` varchar(16) DEFAULT NULL COMMENT '电话',
  `email` varchar(64) DEFAULT NULL COMMENT '邮箱',
  `avatar` varchar(256) DEFAULT NULL COMMENT '头像',
  `intro` text COMMENT '个性签名',
  `birth` int(10) unsigned DEFAULT NULL COMMENT '生日',
  `spt_favor` text COMMENT '运动爱好',
  `region` varchar(32) DEFAULT NULL COMMENT '地区',
  `location` varchar(32) CHARACTER SET utf8 COLLATE utf8_estonian_ci DEFAULT NULL COMMENT '实时位置',
  `ctime` int(10) unsigned NOT NULL COMMENT '注册日期',
  `cIP` varchar(15) NOT NULL COMMENT '注册IP',
  `last_time` int(10) unsigned NOT NULL COMMENT '上次登录时间',
  `last_IP` varchar(15) NOT NULL COMMENT '上次登录IP',
  PRIMARY KEY (`u_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='用户表' AUTO_INCREMENT=33 ;

--
-- 转存表中的数据 `spt_user_info`
--

INSERT INTO `spt_user_info` (`u_id`, `account`, `nickname`, `sex`, `phone`, `email`, `avatar`, `intro`, `birth`, `spt_favor`, `region`, `location`, `ctime`, `cIP`, `last_time`, `last_IP`) VALUES
(1, 'zjien', 'zjien', '男', '12345678919', '694396727@qq.com', 'Public/img/avatar/zjien.jpg', 'like machine learning', NULL, '球类', '广州', NULL, 1422431594, '127.0.0.1', 1428163311, '127.0.0.1'),
(2, 'zjien1', 'zjien1', '男', '15325468521', 'zjien1@qq.com', 'Public/img/avatar/zjien1.jpg', '我是zjien1', NULL, '羽毛球', '江门', NULL, 1422430617, '127.0.0.1', 1428225013, '127.0.0.1'),
(3, 'zjien3', 'zjien3', '男', '12545864512', 'zjien3@qq.com', 'Public/img/avatar/zjien3.jpg', 'HI', NULL, '网球', '广州', NULL, 1422430669, '127.0.0.1', 1426224566, '127.0.0.1'),
(4, 'xiaoming', 'xiaoming', '男', '12131546421', 'xiaoming@qq.com', 'Public/img/avatar/xiaoming.jpg', 'hELLO', NULL, '乒乓球', '江门', NULL, 1420437981, '127.0.0.1', 1427637387, '127.0.0.1'),
(5, 'xiaoli', 'xiaoli', '女', '12151521211', 'xiaoli@qq.com', 'Public/img/avatar/xiaoli.jpg', '你好', NULL, '篮球', '广州', NULL, 1420437987, '127.0.0.1', 1427637175, '127.0.0.1'),
(6, 'xiaohong', 'xiaohong', '女', '54984513213', 'xiaohong@qq.com', 'Public/img/avatar/xiaohong.jpg', '我是小红', NULL, '足球', '深圳', NULL, 1420437990, '127.0.0.1', 1426599689, '127.0.0.1'),
(7, 'xiaobao', 'xiaobao', '男', '65465416435', 'xiaobao@qq.com', 'Public/img/avatar/xiaobao.jpg', '我是小宝，很高兴认识你', NULL, '高尔夫球', '广州', NULL, 1420437994, '127.0.0.1', 1422691963, '127.0.0.1'),
(8, 'xiaohua', 'xiaohua', '女', '54631313512', 'xiaohua@qq.com', 'Public/img/avatar/xiaohua.jpg', '你好，我是小花', NULL, '帆船', '广州', NULL, 1420437997, '127.0.0.1', 1422874761, '127.0.0.1'),
(9, 'xiaowang', 'xiaowang', '男', '13513135121', 'xiaowang@qq.com', 'Public/img/avatar/xiaowang.jpg', 'hey', NULL, '桌球', '珠海', NULL, 1420438001, '127.0.0.1', 1420438001, '127.0.0.1'),
(31, 'tester', 'tester1', '男', '12345678900', 'tester@qq.com', NULL, '很高兴认识你', NULL, '保龄球', '湛江', NULL, 1422953581, '127.0.0.1', 1422956024, '127.0.0.1'),
(32, 'beeasy', 'easyman', '男', '12345678918', 'beconfidence@qq.com', NULL, NULL, NULL, '棒球', '广州', NULL, 1426509592, '127.0.0.1', 1426832016, '127.0.0.1');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
