-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2015 年 02 月 03 日 21:46
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
-- 视图结构 `spt_view_receive_comment`
--

CREATE ALGORITHM=UNDEFINED DEFINER=``@`` SQL SECURITY INVOKER VIEW `spt_view_receive_comment` AS select `spt_comment`.`c_id` AS `c_id`,`spt_user_info`.`u_id` AS `u_id`,`spt_comment`.`tl_id` AS `tl_id`,`spt_user_info`.`nickname` AS `nickname`,`spt_user_info`.`avatar` AS `avatar`,`spt_comment`.`sender_id` AS `c_sender_id`,`spt_comment`.`receiver_id` AS `c_receiver_id`,`spt_comment`.`content` AS `content`,`spt_comment`.`like` AS `like`,`spt_comment`.`send_time` AS `send_time`,`spt_timeline`.`sender_id` AS `tl_sender_id` from ((`spt_user_info` join `spt_comment`) join `spt_timeline`) where ((`spt_timeline`.`tl_id` = `spt_comment`.`tl_id`) and (`spt_user_info`.`u_id` = `spt_comment`.`sender_id`)) order by `spt_comment`.`send_time` desc;

--
-- VIEW  `spt_view_receive_comment`
-- 数据: 无
--


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
