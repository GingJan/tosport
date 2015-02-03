-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2015 年 02 月 03 日 21:45
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
-- 视图结构 `spt_view_all_timeline`
--

CREATE ALGORITHM=MERGE DEFINER=``@`` SQL SECURITY INVOKER VIEW `spt_view_all_timeline` AS select `spt_user_info`.`u_id` AS `u_id`,`spt_user_info`.`nickname` AS `nickname`,`spt_user_info`.`avatar` AS `avatar`,`spt_timeline`.`tl_id` AS `tl_id`,`spt_timeline`.`sender_id` AS `sender_id`,`spt_timeline`.`content` AS `content`,`spt_timeline`.`c_amount` AS `c_amount`,`spt_timeline`.`create_time` AS `create_time` from (`spt_user_info` join `spt_timeline`) where (`spt_user_info`.`u_id` = `spt_timeline`.`sender_id`) order by `spt_timeline`.`create_time` desc;

--
-- VIEW  `spt_view_all_timeline`
-- 数据: 无
--


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
