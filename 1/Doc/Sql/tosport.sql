-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2015 年 02 月 06 日 16:19
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
-- 表的结构 `spt_account`
--

CREATE TABLE IF NOT EXISTS `spt_account` (
  `a_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增长id',
  `account` varchar(32) NOT NULL COMMENT '账号_关联字段',
  `password` varchar(32) NOT NULL COMMENT '密码',
  PRIMARY KEY (`a_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='账号密码表' AUTO_INCREMENT=32 ;

--
-- 转存表中的数据 `spt_account`
--

INSERT INTO `spt_account` (`a_id`, `account`, `password`) VALUES
(1, 'zjien', '25d55ad283aa400af464c76d713c07ad'),
(2, 'zjien1', 'e10adc3949ba59abbe56e057f20f883e'),
(3, 'zjien3', 'e10adc3949ba59abbe56e057f20f883e'),
(4, 'xiaoming', 'e10adc3949ba59abbe56e057f20f883e'),
(5, 'xiaoli', 'e10adc3949ba59abbe56e057f20f883e'),
(6, 'xiaohong', 'e10adc3949ba59abbe56e057f20f883e'),
(7, 'xiaobao', 'e10adc3949ba59abbe56e057f20f883e'),
(8, 'xiaohua', 'e10adc3949ba59abbe56e057f20f883e'),
(9, 'xiaowang', 'e10adc3949ba59abbe56e057f20f883e'),
(31, 'tester', '25d55ad283aa400af464c76d713c07ad');

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
  `creator_region` varchar(32) NOT NULL COMMENT '发布人的地区',
  `create_time` int(10) unsigned NOT NULL COMMENT '发布时间',
  PRIMARY KEY (`de_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='约运动表' AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `spt_date_exercise`
--

INSERT INTO `spt_date_exercise` (`de_id`, `creator_id`, `sport_type`, `sport_place`, `sport_time`, `content`, `people_amount`, `booked_amount`, `creator_region`, `create_time`) VALUES
(1, 1, '网球', '五邑大学1号网球场', 1422875858, '网球王子，来打网球吧', 2, 2, '江门', 1422874342),
(2, 2, '篮球', '五邑大学风雨篮球场', 1422876010, '大家来打篮球', 10, 0, '江门', 1422874449),
(3, 3, '羽毛球', '广州体育馆', 1422876100, '打羽毛球咯', 2, 0, '广州', 1422874493),
(4, 3, '羽毛球', '深圳体育馆', 1422876157, '大家来打羽毛球咯', 5, 0, '深圳', 1422874534),
(5, 4, '乒乓球', '深圳体育馆', 1422876157, '大家来打乒乓球咯', 3, 1, '深圳', 1422874577),
(6, 5, '足球', '天河体育馆', 1422876257, '大家来踢足球', 13, 1, '广州', 1422874630),
(7, 6, '跳舞', '五邑大学舞蹈室', 1422876257, '跳舞咯', 5, 0, '江门', 1422874751),
(8, 8, '跑步', '东湖公园', 1422876363, '跑步', 3, 0, '江门', 1422874815);

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

-- --------------------------------------------------------

--
-- 表的结构 `spt_date_venue`
--

CREATE TABLE IF NOT EXISTS `spt_date_venue` (
  `dv_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增长id',
  `subscriber` int(10) unsigned NOT NULL COMMENT '预订人的u_id',
  `vi_id` int(10) unsigned NOT NULL COMMENT '场馆的vi_id',
  `date_time` int(10) unsigned NOT NULL COMMENT '预约时间',
  `order_time` int(10) unsigned NOT NULL COMMENT '下单时间',
  PRIMARY KEY (`dv_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='场馆预约表' AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `spt_date_venue`
--

INSERT INTO `spt_date_venue` (`dv_id`, `subscriber`, `vi_id`, `date_time`, `order_time`) VALUES
(4, 1, 1, 1423159938, 1423151968),
(2, 1, 2, 1423146000, 1423145858),
(3, 2, 4, 1423159938, 1423151959);

-- --------------------------------------------------------

--
-- 表的结构 `spt_friend`
--

CREATE TABLE IF NOT EXISTS `spt_friend` (
  `f_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增长id',
  `me_id` int(10) unsigned NOT NULL COMMENT '本人的u_id',
  `friend_id` int(10) unsigned NOT NULL COMMENT '好友的u_id',
  `add_time` int(10) unsigned NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`f_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='朋友关系表' AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `spt_friend`
--

INSERT INTO `spt_friend` (`f_id`, `me_id`, `friend_id`, `add_time`) VALUES
(1, 1, 2, 1422684773),
(2, 1, 3, 1422684777),
(3, 2, 4, 1422685184),
(4, 1, 7, 1422685200);

-- --------------------------------------------------------

--
-- 表的结构 `spt_letter`
--

CREATE TABLE IF NOT EXISTS `spt_letter` (
  `l_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增长id',
  `sender_id` int(10) unsigned NOT NULL COMMENT '发送者的u_id',
  `receiver_id` int(10) unsigned NOT NULL COMMENT '接受者的u_id',
  `content` text NOT NULL COMMENT '内容',
  `send_time` int(10) unsigned NOT NULL COMMENT '发送时间/收到时间',
  PRIMARY KEY (`l_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='私信表' AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `spt_letter`
--

INSERT INTO `spt_letter` (`l_id`, `sender_id`, `receiver_id`, `content`, `send_time`) VALUES
(1, 1, 2, 'I want to make friend with you', 1422757390),
(2, 1, 3, 'I want to make friend with you', 1422757405),
(3, 1, 1, 'I want to make friend with you', 1422757490),
(4, 1, 1, 'I want to make friend with you', 1422757567),
(5, 1, 4, 'I want to make friend with you', 1422757751),
(6, 1, 1, 'I want to make friend with you', 1422757754),
(7, 2, 1, 'test1', 1422757801),
(8, 2, 3, 'test2', 1422757810);

-- --------------------------------------------------------

--
-- 表的结构 `spt_manager`
--

CREATE TABLE IF NOT EXISTS `spt_manager` (
  `ma_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增长id',
  `account` varchar(32) NOT NULL COMMENT '账户',
  `password` varchar(32) NOT NULL COMMENT '密码',
  `nickname` varchar(32) DEFAULT NULL COMMENT '昵称',
  `email` varchar(64) DEFAULT NULL COMMENT '邮箱',
  `phone` varchar(16) DEFAULT NULL COMMENT '电话',
  `create_time` int(10) unsigned DEFAULT NULL COMMENT '注册时间',
  `create_IP` varchar(15) DEFAULT NULL COMMENT '注册IP',
  `last_time` int(10) unsigned DEFAULT NULL COMMENT '最近登录时间',
  `last_IP` varchar(15) DEFAULT NULL COMMENT '最近登录IP',
  PRIMARY KEY (`ma_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='管理员表' AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `spt_manager`
--

INSERT INTO `spt_manager` (`ma_id`, `account`, `password`, `nickname`, `email`, `phone`, `create_time`, `create_IP`, `last_time`, `last_IP`) VALUES
(1, 'super', 'e10adc3949ba59abbe56e057f20f883e', 'superM', NULL, NULL, 1423038560, '127.0.0.1', 1423194549, '127.0.0.1'),
(2, 'admin1', 'fcea920f7412b5da7be0cf42b8c93759', 'admin1', 'admin1@qq.com', '12345678901', 1423039536, '127.0.0.1', 1423151421, '127.0.0.1'),
(3, 'admin2', 'e10adc3949ba59abbe56e057f20f883e', 'admin2', NULL, NULL, 1423039605, '127.0.0.1', 1423039605, '127.0.0.1'),
(4, 'admin3', 'e10adc3949ba59abbe56e057f20f883e', 'admin3', NULL, NULL, 1423039610, '127.0.0.1', 1423039610, '127.0.0.1'),
(5, 'admin4', 'e10adc3949ba59abbe56e057f20f883e', 'admin4', NULL, NULL, 1423039612, '127.0.0.1', 1423039612, '127.0.0.1'),
(6, 'admin5', 'e10adc3949ba59abbe56e057f20f883e', 'admin5', NULL, NULL, 1423039615, '127.0.0.1', 1423039615, '127.0.0.1');

-- --------------------------------------------------------

--
-- 表的结构 `spt_timeline`
--

CREATE TABLE IF NOT EXISTS `spt_timeline` (
  `tl_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增长',
  `sender_id` int(10) unsigned NOT NULL COMMENT '发表人的u_id',
  `content` text NOT NULL COMMENT '内容',
  `create_time` int(10) unsigned NOT NULL COMMENT '发表时间',
  `region` varchar(32) DEFAULT NULL COMMENT '地区',
  `c_amount` int(10) unsigned DEFAULT NULL COMMENT '评论/赞数',
  PRIMARY KEY (`tl_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='好友动态表' AUTO_INCREMENT=13 ;

--
-- 转存表中的数据 `spt_timeline`
--

INSERT INTO `spt_timeline` (`tl_id`, `sender_id`, `content`, `create_time`, `region`, `c_amount`) VALUES
(2, 1, 'hello,I''m zjien.This is my second test', 1422691737, '深圳', NULL),
(3, 1, 'hello,I''m zjien.This is my third test', 1422691748, '深圳', NULL),
(4, 2, 'hello,I''m zjien1.my first test', 1422691844, '江门', NULL),
(5, 3, 'hello,I''m zjien3.my first test', 1422691870, '广州', NULL),
(6, 3, 'hello,I''m zjien3.my second test', 1422691883, '广州', NULL),
(7, 4, 'hello,I''m xiaoming.my first test', 1422691919, '江门', NULL),
(8, 4, 'hello,I''m xiaoming.my second  test', 1422691928, '江门', NULL),
(9, 5, 'hello,I''m xiaoli.my test', 1422691943, '深圳', NULL),
(10, 5, 'hello,I''m xiaoli.my test', 1422691956, '深圳', NULL),
(11, 7, 'hello,I''m xiaobao .my test', 1422691970, '广州', NULL),
(12, 6, 'hello,I''m xiaohong .my test', 1422692023, '深圳', NULL);

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
  `ctime` int(10) unsigned NOT NULL COMMENT '注册日期',
  `cIP` varchar(15) NOT NULL COMMENT '注册IP',
  `last_time` int(10) unsigned NOT NULL COMMENT '上次登录时间',
  `last_IP` varchar(15) NOT NULL COMMENT '上次登录IP',
  PRIMARY KEY (`u_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='用户表' AUTO_INCREMENT=32 ;

--
-- 转存表中的数据 `spt_user_info`
--

INSERT INTO `spt_user_info` (`u_id`, `account`, `nickname`, `sex`, `phone`, `email`, `avatar`, `intro`, `birth`, `spt_favor`, `region`, `ctime`, `cIP`, `last_time`, `last_IP`) VALUES
(1, 'zjien', 'handsomeguy', '男', '12345678901', 'zjien@qq.com', NULL, 'good man', NULL, NULL, '深圳', 1422431594, '127.0.0.1', 1423194522, '127.0.0.1'),
(2, 'zjien1', 'zjien1', '男', NULL, 'zjien1@qq.com', NULL, NULL, NULL, NULL, '江门', 1422430617, '127.0.0.1', 1422880985, '127.0.0.1'),
(3, 'zjien3', 'zjien3', '男', NULL, 'zjien3@qq.com', NULL, NULL, NULL, NULL, '广州', 1422430669, '127.0.0.1', 1422885365, '127.0.0.1'),
(4, 'xiaoming', 'xiaoming', '男', '', 'xiaoming@qq.com', NULL, NULL, NULL, NULL, '江门', 1420437981, '127.0.0.1', 1422874546, '127.0.0.1'),
(5, 'xiaoli', 'xiaoli', '女', NULL, 'xiaoli@qq.com', NULL, NULL, NULL, NULL, '深圳', 1420437987, '127.0.0.1', 1422874590, '127.0.0.1'),
(6, 'xiaohong', 'xiaohong', '女', NULL, 'xiaohong@qq.com', NULL, NULL, NULL, NULL, '深圳', 1420437990, '127.0.0.1', 1422874731, '127.0.0.1'),
(7, 'xiaobao', 'xiaobao', '男', NULL, 'xiaobao@qq.com', NULL, NULL, NULL, NULL, '广州', 1420437994, '127.0.0.1', 1422691963, '127.0.0.1'),
(8, 'xiaohua', 'xiaohua', NULL, NULL, 'xiaohua@qq.com', NULL, NULL, NULL, NULL, '广州', 1420437997, '127.0.0.1', 1422874761, '127.0.0.1'),
(9, 'xiaowang', 'xiaowang', '男', NULL, 'xiaowang@qq.com', NULL, NULL, NULL, NULL, '珠海', 1420438001, '127.0.0.1', 1420438001, '127.0.0.1'),
(31, 'tester', 'tester1', '男', '12345678900', 'tester@qq.com', NULL, NULL, NULL, NULL, '湛江', 1422953581, '127.0.0.1', 1422956024, '127.0.0.1');

-- --------------------------------------------------------

--
-- 表的结构 `spt_venue_info`
--

CREATE TABLE IF NOT EXISTS `spt_venue_info` (
  `vi_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增长id',
  `ma_id` int(10) unsigned NOT NULL COMMENT '创建该场馆的管理员的ma_id',
  `name` varchar(32) NOT NULL COMMENT '名称',
  `picture` varchar(128) DEFAULT NULL COMMENT '照片',
  `type` varchar(64) NOT NULL COMMENT '所提供的运动类型',
  `price` varchar(8) NOT NULL COMMENT '价格',
  `bought` int(10) unsigned DEFAULT '0' COMMENT '被购买次数',
  `region` varchar(16) NOT NULL COMMENT '所在城市',
  `intro` text COMMENT '描述',
  `last_time` int(10) unsigned NOT NULL COMMENT '最后一次修改时间',
  `last_IP` varchar(15) NOT NULL COMMENT '最后一次修改IP',
  PRIMARY KEY (`vi_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='场馆信息表' AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `spt_venue_info`
--

INSERT INTO `spt_venue_info` (`vi_id`, `ma_id`, `name`, `picture`, `type`, `price`, `bought`, `region`, `intro`, `last_time`, `last_IP`) VALUES
(1, 2, '市第一体育馆', NULL, '羽毛球 乒乓球', '25', 0, '江门', '提供场地，不提供球拍', 1423127800, '127.0.0.1'),
(2, 2, '市第二体育馆', NULL, '篮球', '30', 0, '深圳', '提供篮球', 1423127830, '127.0.0.1'),
(3, 1, '市第三体育馆', NULL, '足球', '35', 0, '江门', '提供足球和场地', 1423127835, '127.0.0.1'),
(4, 3, '省第一体育馆', NULL, '排球', '20', 0, '广州', '提供球和场地', 1423127900, '127.0.0.1'),
(5, 2, '网球体育馆', NULL, '网球', '20', 0, '江门', '不提供球和拍', 1423127910, '127.0.0.1');

-- --------------------------------------------------------

--
-- 替换视图以便查看 `spt_view_all_timeline`
--
CREATE TABLE IF NOT EXISTS `spt_view_all_timeline` (
`u_id` int(10) unsigned
,`nickname` varchar(32)
,`avatar` varchar(256)
,`tl_id` int(10) unsigned
,`sender_id` int(10) unsigned
,`content` text
,`c_amount` int(10) unsigned
,`create_time` int(10) unsigned
);
-- --------------------------------------------------------

--
-- 替换视图以便查看 `spt_view_city_timeline`
--
CREATE TABLE IF NOT EXISTS `spt_view_city_timeline` (
`u_id` int(10) unsigned
,`tl_id` int(10) unsigned
,`sender_id` int(10) unsigned
,`nickname` varchar(32)
,`sex` char(8)
,`avatar` varchar(256)
,`content` text
,`c_amount` int(10) unsigned
,`create_time` int(10) unsigned
,`region` varchar(32)
);
-- --------------------------------------------------------

--
-- 替换视图以便查看 `spt_view_receive_comment`
--
CREATE TABLE IF NOT EXISTS `spt_view_receive_comment` (
`c_id` int(10) unsigned
,`u_id` int(10) unsigned
,`tl_id` int(10) unsigned
,`nickname` varchar(32)
,`avatar` varchar(256)
,`c_sender_id` int(10) unsigned
,`c_receiver_id` int(10) unsigned
,`content` text
,`like` int(10)
,`send_time` int(10) unsigned
,`tl_sender_id` int(10) unsigned
);
-- --------------------------------------------------------

--
-- 视图结构 `spt_view_all_timeline`
--
DROP TABLE IF EXISTS `spt_view_all_timeline`;

CREATE ALGORITHM=MERGE DEFINER=``@`` SQL SECURITY INVOKER VIEW `spt_view_all_timeline` AS select `spt_user_info`.`u_id` AS `u_id`,`spt_user_info`.`nickname` AS `nickname`,`spt_user_info`.`avatar` AS `avatar`,`spt_timeline`.`tl_id` AS `tl_id`,`spt_timeline`.`sender_id` AS `sender_id`,`spt_timeline`.`content` AS `content`,`spt_timeline`.`c_amount` AS `c_amount`,`spt_timeline`.`create_time` AS `create_time` from (`spt_user_info` join `spt_timeline`) where (`spt_user_info`.`u_id` = `spt_timeline`.`sender_id`) order by `spt_timeline`.`create_time` desc;

-- --------------------------------------------------------

--
-- 视图结构 `spt_view_city_timeline`
--
DROP TABLE IF EXISTS `spt_view_city_timeline`;

CREATE ALGORITHM=UNDEFINED DEFINER=``@`` SQL SECURITY INVOKER VIEW `spt_view_city_timeline` AS select `spt_user_info`.`u_id` AS `u_id`,`spt_timeline`.`tl_id` AS `tl_id`,`spt_timeline`.`sender_id` AS `sender_id`,`spt_user_info`.`nickname` AS `nickname`,`spt_user_info`.`sex` AS `sex`,`spt_user_info`.`avatar` AS `avatar`,`spt_timeline`.`content` AS `content`,`spt_timeline`.`c_amount` AS `c_amount`,`spt_timeline`.`create_time` AS `create_time`,`spt_timeline`.`region` AS `region` from (`spt_user_info` join `spt_timeline`) where (`spt_user_info`.`u_id` = `spt_timeline`.`sender_id`) order by `spt_timeline`.`create_time` desc;

-- --------------------------------------------------------

--
-- 视图结构 `spt_view_receive_comment`
--
DROP TABLE IF EXISTS `spt_view_receive_comment`;

CREATE ALGORITHM=UNDEFINED DEFINER=``@`` SQL SECURITY INVOKER VIEW `spt_view_receive_comment` AS select `spt_comment`.`c_id` AS `c_id`,`spt_user_info`.`u_id` AS `u_id`,`spt_comment`.`tl_id` AS `tl_id`,`spt_user_info`.`nickname` AS `nickname`,`spt_user_info`.`avatar` AS `avatar`,`spt_comment`.`sender_id` AS `c_sender_id`,`spt_comment`.`receiver_id` AS `c_receiver_id`,`spt_comment`.`content` AS `content`,`spt_comment`.`like` AS `like`,`spt_comment`.`send_time` AS `send_time`,`spt_timeline`.`sender_id` AS `tl_sender_id` from ((`spt_user_info` join `spt_comment`) join `spt_timeline`) where ((`spt_timeline`.`tl_id` = `spt_comment`.`tl_id`) and (`spt_user_info`.`u_id` = `spt_comment`.`sender_id`)) order by `spt_comment`.`send_time` desc;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
