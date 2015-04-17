-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2015 年 04 月 15 日 17:24
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='账号密码表' AUTO_INCREMENT=38 ;

--
-- 转存表中的数据 `spt_account`
--

INSERT INTO `spt_account` (`a_id`, `account`, `password`) VALUES
(1, 'zjien', 'e10adc3949ba59abbe56e057f20f883e'),
(2, 'zjien1', 'e10adc3949ba59abbe56e057f20f883e'),
(3, 'zjien3', 'e10adc3949ba59abbe56e057f20f883e'),
(4, 'xiaoming', 'e10adc3949ba59abbe56e057f20f883e'),
(5, 'xiaoli', 'e10adc3949ba59abbe56e057f20f883e'),
(6, 'xiaohong', 'e10adc3949ba59abbe56e057f20f883e'),
(7, 'xiaobao', 'e10adc3949ba59abbe56e057f20f883e'),
(8, 'xiaohua', 'e10adc3949ba59abbe56e057f20f883e'),
(9, 'xiaowang', 'e10adc3949ba59abbe56e057f20f883e'),
(31, 'tester', '25d55ad283aa400af464c76d713c07ad'),
(32, 'beeasy', '25d55ad283aa400af464c76d713c07ad'),
(33, 'theking', 'e10adc3949ba59abbe56e057f20f883e'),
(34, 'theking2', 'e10adc3949ba59abbe56e057f20f883e'),
(35, 'theking3', 'e10adc3949ba59abbe56e057f20f883e'),
(36, 'theking100', 'e10adc3949ba59abbe56e057f20f883e'),
(37, 'theking10', 'e10adc3949ba59abbe56e057f20f883e');

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
  PRIMARY KEY (`c_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='评论表' AUTO_INCREMENT=15 ;

--
-- 转存表中的数据 `spt_comment`
--

INSERT INTO `spt_comment` (`c_id`, `tl_id`, `sender_id`, `receiver_id`, `send_time`, `content`) VALUES
(1, 2, 2, 1, 1422693636, 'hello,nice to meet you ,I''m zjien1'),
(2, 2, 2, 1, 1422693689, 'hello,nice to meet you ,I''m zjien1 whats up'),
(3, 2, 1, 2, 1422694517, 'hi,glad to see you too'),
(5, 2, 3, 1, 1422694592, 'hi,I am zjien3 ,I make a Comment'),
(6, 6, 5, 3, 1422706000, 'hi,this is tl_id=6'),
(14, 7, 1, 4, 1427637150, 'hello');

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

-- --------------------------------------------------------

--
-- 表的结构 `spt_date_person`
--

CREATE TABLE IF NOT EXISTS `spt_date_person` (
  `dp_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'date表自增长id',
  `de_id` int(10) unsigned NOT NULL COMMENT '对应约运动表的de_id',
  `creator_id` int(10) unsigned NOT NULL COMMENT '对应约运动表的creator_id',
  `me_id` int(10) unsigned NOT NULL COMMENT '本人的u_id',
  `create_time` int(10) unsigned NOT NULL COMMENT '点约的时间',
  PRIMARY KEY (`dp_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='约ta表' AUTO_INCREMENT=17 ;

--
-- 转存表中的数据 `spt_date_person`
--

INSERT INTO `spt_date_person` (`dp_id`, `de_id`, `creator_id`, `me_id`, `create_time`) VALUES
(13, 1, 1, 2, 1422885327),
(8, 1, 1, 3, 1422882515),
(11, 5, 4, 2, 1422885160),
(12, 6, 5, 2, 1422885270),
(14, 2, 2, 32, 1426577459);

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
-- 表的结构 `spt_group_info`
--

CREATE TABLE IF NOT EXISTS `spt_group_info` (
  `gi_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增长id',
  `group_account` varchar(32) NOT NULL COMMENT '群组账号',
  `name` varchar(32) NOT NULL COMMENT '群组名字',
  `creator_id` int(10) unsigned NOT NULL COMMENT '创建人id',
  `people` int(10) unsigned NOT NULL COMMENT '容纳人数',
  `joined` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '已加入人数',
  `region` varchar(32) NOT NULL COMMENT '地区',
  `intro` text COMMENT '简介',
  `picture` varchar(64) DEFAULT NULL COMMENT '群组图片',
  `create_time` int(10) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`gi_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='群组信息表' AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `spt_group_info`
--

INSERT INTO `spt_group_info` (`gi_id`, `group_account`, `name`, `creator_id`, `people`, `joined`, `region`, `intro`, `picture`, `create_time`) VALUES
(1, 'Oscake1', 'Oscake', 1, 50, 0, '深圳', NULL, NULL, 1423623958),
(2, 'Oscake2', 'Oscake2', 1, 25, 0, '深圳', '这是Oscake1的分群组', NULL, 1423623997),
(3, 'Timky1', 'Timky1', 2, 30, 0, '江门', NULL, NULL, 1423624065);

-- --------------------------------------------------------

--
-- 表的结构 `spt_group_person`
--

CREATE TABLE IF NOT EXISTS `spt_group_person` (
  `gp_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增长id',
  `gi_id` int(10) unsigned NOT NULL COMMENT '群组id',
  `associator_id` int(10) unsigned NOT NULL COMMENT '成员的id',
  `power` int(10) unsigned NOT NULL COMMENT '成员权限',
  `join_time` int(10) unsigned NOT NULL COMMENT '加入时间',
  PRIMARY KEY (`gp_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='群组成员表' AUTO_INCREMENT=13 ;

--
-- 转存表中的数据 `spt_group_person`
--

INSERT INTO `spt_group_person` (`gp_id`, `gi_id`, `associator_id`, `power`, `join_time`) VALUES
(1, 1, 1, 2, 1423623958),
(2, 2, 1, 2, 1423623997),
(3, 3, 2, 2, 1423624065),
(9, 2, 2, 0, 1423624875);

--
-- 触发器 `spt_group_person`
--
DROP TRIGGER IF EXISTS `tg_group_info_joined_up`;
DELIMITER //
CREATE TRIGGER `tg_group_info_joined_up` AFTER INSERT ON `spt_group_person`
 FOR EACH ROW begin
update spt_group_info set joined=joined+1 where gi_id=new.gi_id;
end
//
DELIMITER ;
DROP TRIGGER IF EXISTS `tg_group_info_joined_down`;
DELIMITER //
CREATE TRIGGER `tg_group_info_joined_down` AFTER DELETE ON `spt_group_person`
 FOR EACH ROW begin
update spt_group_info set joined=joined-1 where gi_id=old.gi_id;
end
//
DELIMITER ;

-- --------------------------------------------------------

--
-- 表的结构 `spt_letter`
--

CREATE TABLE IF NOT EXISTS `spt_letter` (
  `l_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增长id',
  `sender_id` int(10) unsigned NOT NULL COMMENT '发送者的u_id',
  `receiver_id` int(10) unsigned NOT NULL COMMENT '接受者的u_id',
  `title` varchar(32) CHARACTER SET utf8 COLLATE utf8_estonian_ci DEFAULT NULL COMMENT '标题',
  `content` text NOT NULL COMMENT '内容',
  `send_time` int(10) unsigned NOT NULL COMMENT '发送时间/收到时间',
  `isread` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否已读',
  PRIMARY KEY (`l_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='私信表' AUTO_INCREMENT=19 ;

--
-- 转存表中的数据 `spt_letter`
--

INSERT INTO `spt_letter` (`l_id`, `sender_id`, `receiver_id`, `title`, `content`, `send_time`, `isread`) VALUES
(1, 1, 2, '1-2', 'I want to make friend with you', 1422757390, 0),
(2, 1, 3, '1-3', 'I want to make friend with you', 1422757405, 0),
(3, 2, 3, '2-3', 'I want to make friend with you', 1422757490, 0),
(4, 2, 1, '2-1', 'I want to make friend with you', 1422757567, 1),
(5, 1, 4, '1-4', 'I want to make friend with you', 1422757751, 0),
(6, 1, 2, '1-2', 'I want to make friend with you', 1422757754, 0),
(7, 3, 1, '3-1', 'test1', 1422757801, 1),
(8, 3, 2, '3-2', 'test2', 1422757810, 1),
(10, 3, 2, '3-1', 'test 2', 1422758010, 0),
(12, 1, 5, '1-5', 'hello,this is test1', 1427893602, 0),
(13, 1, 2, '1-2', 'hello,this is test1', 1427893605, 0),
(14, 1, 6, '1-6', 'hello,this is test6', 1427893624, 0),
(15, 1, 3, '1-3', 'hello,this is test3', 1427893694, 0),
(16, 1, 2, NULL, 'hello', 1428224960, 0),
(17, 1, 2, NULL, 'hello2', 1428225021, 0),
(18, 1, 2, NULL, 'hello again', 1428225026, 0);

-- --------------------------------------------------------

--
-- 表的结构 `spt_like`
--

CREATE TABLE IF NOT EXISTS `spt_like` (
  `lk_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增长id',
  `tl_id` int(10) unsigned NOT NULL COMMENT '动态id',
  `sender_id` int(10) unsigned NOT NULL COMMENT '点赞人id',
  `receiver_id` int(10) unsigned NOT NULL COMMENT '动态发布人id',
  `send_time` int(10) unsigned NOT NULL COMMENT '点赞时间',
  PRIMARY KEY (`lk_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='点赞表' AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `spt_like`
--

INSERT INTO `spt_like` (`lk_id`, `tl_id`, `sender_id`, `receiver_id`, `send_time`) VALUES
(1, 7, 1, 4, 1427637109),
(2, 7, 5, 4, 1427637192),
(4, 8, 5, 5, 1427637336);

--
-- 触发器 `spt_like`
--
DROP TRIGGER IF EXISTS `tg_timeline_like_up`;
DELIMITER //
CREATE TRIGGER `tg_timeline_like_up` AFTER INSERT ON `spt_like`
 FOR EACH ROW begin
update spt_timeline set like_amount=IFNULL(like_amount,0)+1 where tl_id=new.tl_id;
end
//
DELIMITER ;
DROP TRIGGER IF EXISTS `tg_timeline_like_down`;
DELIMITER //
CREATE TRIGGER `tg_timeline_like_down` AFTER DELETE ON `spt_like`
 FOR EACH ROW begin
update spt_timeline set like_amount=IF(like_amount-1,like_amount-1,NULL) where tl_id = old.tl_id;
end
//
DELIMITER ;

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
(2, 'admin1', 'fcea920f7412b5da7be0cf42b8c93759', 'admin1', 'admin1@qq.com', '12345678901', 1423039536, '127.0.0.1', 1423295084, '127.0.0.1'),
(3, 'admin2', 'e10adc3949ba59abbe56e057f20f883e', 'admin2', NULL, NULL, 1423039605, '127.0.0.1', 1423039605, '127.0.0.1'),
(4, 'admin3', 'e10adc3949ba59abbe56e057f20f883e', 'admin3', NULL, NULL, 1423039610, '127.0.0.1', 1423039610, '127.0.0.1'),
(5, 'admin4', 'e10adc3949ba59abbe56e057f20f883e', 'admin4', NULL, NULL, 1423039612, '127.0.0.1', 1423039612, '127.0.0.1'),
(6, 'admin5', 'e10adc3949ba59abbe56e057f20f883e', 'admin5', NULL, NULL, 1423039615, '127.0.0.1', 1423039615, '127.0.0.1');

-- --------------------------------------------------------

--
-- 表的结构 `spt_match`
--

CREATE TABLE IF NOT EXISTS `spt_match` (
  `mt_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增长id',
  `dm_id` int(10) unsigned NOT NULL COMMENT 'dateMatch表的dm_id',
  `creator_id` int(10) unsigned NOT NULL COMMENT 'dateMatch表的creator_id',
  `me_id` int(10) unsigned NOT NULL COMMENT '本人的u_id',
  `create_time` int(10) unsigned NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`mt_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='比赛关系表' AUTO_INCREMENT=10 ;

--
-- 转存表中的数据 `spt_match`
--

INSERT INTO `spt_match` (`mt_id`, `dm_id`, `creator_id`, `me_id`, `create_time`) VALUES
(5, 2, 2, 1, 1428500750),
(6, 2, 2, 3, 1428500850),
(7, 9, 2, 5, 1428500900),
(8, 1, 1, 2, 1428500910),
(9, 6, 6, 2, 1428500915);

--
-- 触发器 `spt_match`
--
DROP TRIGGER IF EXISTS `tg_date_match_booked_amount_up`;
DELIMITER //
CREATE TRIGGER `tg_date_match_booked_amount_up` AFTER INSERT ON `spt_match`
 FOR EACH ROW begin
update spt_date_match set booked_amount=booked_amount+1 where 
dm_id=new.dm_id;
end
//
DELIMITER ;
DROP TRIGGER IF EXISTS `tg_date_match_booked_amount_down`;
DELIMITER //
CREATE TRIGGER `tg_date_match_booked_amount_down` AFTER DELETE ON `spt_match`
 FOR EACH ROW begin
update spt_date_match set booked_amount=booked_amount-1 where 
dm_id=old.dm_id;
end
//
DELIMITER ;

-- --------------------------------------------------------

--
-- 表的结构 `spt_pin_code`
--

CREATE TABLE IF NOT EXISTS `spt_pin_code` (
  `PIN_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'PIN表自增长id',
  `u_id` int(10) unsigned NOT NULL COMMENT '用户u_id',
  `account` varchar(32) NOT NULL COMMENT '用户账号',
  `PIN_code` varchar(32) NOT NULL COMMENT 'PIN码',
  `create_time` int(10) unsigned NOT NULL COMMENT 'PIN码创建时间',
  `expiration` int(10) unsigned NOT NULL COMMENT '过期时间',
  PRIMARY KEY (`PIN_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='PIN码表' AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `spt_pin_code`
--

INSERT INTO `spt_pin_code` (`PIN_id`, `u_id`, `account`, `PIN_code`, `create_time`, `expiration`) VALUES
(1, 2, 'zjien1', '0IgdfLmB5s', 1425901615, 1425988015),
(2, 1, 'zjien', 'Fl5DCspb4i', 1425975198, 1426061598),
(3, 1, 'zjien', 'gzEs2wuAAU', 1425975284, 1426061684),
(4, 1, 'zjien', 'vVzfSENIC9', 1425975592, 1425975600),
(5, 1, 'zjien', 'pJWkIAElz6', 1425990464, 1425996000);

-- --------------------------------------------------------

--
-- 表的结构 `spt_timeline`
--

CREATE TABLE IF NOT EXISTS `spt_timeline` (
  `tl_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增长',
  `sender_id` int(10) unsigned NOT NULL COMMENT '发表人的u_id',
  `content` text NOT NULL COMMENT '内容',
  `picture` varchar(64) DEFAULT NULL COMMENT '图片',
  `create_time` int(10) unsigned NOT NULL COMMENT '发表时间',
  `now_region` varchar(32) DEFAULT NULL COMMENT '实时地区',
  `c_amount` int(10) unsigned DEFAULT NULL COMMENT '评论/赞数',
  `like_amount` int(10) unsigned DEFAULT NULL COMMENT '被赞数',
  PRIMARY KEY (`tl_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='好友动态表' AUTO_INCREMENT=16 ;

--
-- 转存表中的数据 `spt_timeline`
--

INSERT INTO `spt_timeline` (`tl_id`, `sender_id`, `content`, `picture`, `create_time`, `now_region`, `c_amount`, `like_amount`) VALUES
(2, 1, 'hello,I''m zjien.This is my second test', 'Public/img/timeline/20150409204611.png', 1422691737, '深圳', NULL, NULL),
(3, 1, 'hello,I''m zjien.This is my third test', 'Public/img/timeline/20150409204627.png', 1422691748, '深圳', NULL, NULL),
(4, 2, 'hello,I''m zjien1.my first test', 'Public/img/timeline/20150409204635.png', 1422691844, '江门', NULL, NULL),
(5, 3, 'hello,I''m zjien3.my first test', 'Public/img/timeline/20150409204641.png', 1422691870, '广州', NULL, NULL),
(6, 3, 'hello,I''m zjien3.my second test', 'Public/img/timeline/20150409204651.png', 1422691883, '广州', 1, NULL),
(7, 4, 'hello,I''m xiaoming.my first test', 'Public/img/timeline/20150409204723.png', 1422691919, '江门', 1, 2),
(8, 5, 'hello,I''m xiaoli.my second  test', 'Public/img/timeline/20150409204733.png', 1422691928, '江门', NULL, 1),
(9, 5, 'hello,I''m xiaoli.my test', 'Public/img/timeline/20150409204743.png', 1422691943, '深圳', NULL, NULL),
(10, 5, 'hello,I''m xiaoli.my test', 'Public/img/timeline/20150409204754.png', 1422691956, '广州', NULL, NULL),
(11, 7, 'hello,I''m xiaobao .my test', 'Public/img/timeline/20150409204807.png', 1422691970, '广州', NULL, NULL),
(12, 6, 'hello,I''m xiaohong .my test', 'Public/img/timeline/20150409205025.png', 1422692023, '深圳', NULL, NULL),
(15, 2, '这是文件上传', 'Public/img/timeline/20150409210705.png', 1428484647, '江门', NULL, NULL);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='用户表' AUTO_INCREMENT=38 ;

--
-- 转存表中的数据 `spt_user_info`
--

INSERT INTO `spt_user_info` (`u_id`, `account`, `nickname`, `sex`, `phone`, `email`, `avatar`, `intro`, `birth`, `spt_favor`, `region`, `location`, `ctime`, `cIP`, `last_time`, `last_IP`) VALUES
(1, 'zjien', 'zjien', '男', '12345678919', '694396727@qq.com', 'Public/img/avatar/zjien.jpg', 'like machine learning', NULL, '球类', '广州', NULL, 1422431594, '127.0.0.1', 1428674651, '10.10.64.100'),
(2, 'zjien1', 'zjien1', '男', '15325468521', 'zjien1@qq.com', 'Public/img/avatar/zjien1.jpg', '我是zjien1', NULL, '羽毛球', '江门', NULL, 1422430617, '127.0.0.1', 1428842466, '::1'),
(3, 'zjien3', 'zjien3', '男', '12545864512', 'zjien3@qq.com', 'Public/img/avatar/zjien3.jpg', 'HI', NULL, '网球', '广州', NULL, 1422430669, '127.0.0.1', 1426224566, '127.0.0.1'),
(4, 'xiaoming', 'xiaoming', '男', '12131546421', 'xiaoming@qq.com', 'Public/img/avatar/xiaoming.jpg', 'hELLO', NULL, '乒乓球', '江门', NULL, 1420437981, '127.0.0.1', 1427637387, '127.0.0.1'),
(5, 'xiaoli', 'xiaoli', '女', '12151521211', 'xiaoli@qq.com', 'Public/img/avatar/xiaoli.jpg', '你好', NULL, '篮球', '广州', NULL, 1420437987, '127.0.0.1', 1427637175, '127.0.0.1'),
(6, 'xiaohong', 'xiaohong', '女', '54984513213', 'xiaohong@qq.com', 'Public/img/avatar/xiaohong.jpg', '我是小红', NULL, '足球', '深圳', NULL, 1420437990, '127.0.0.1', 1426599689, '127.0.0.1'),
(7, 'xiaobao', 'xiaobao', '男', '65465416435', 'xiaobao@qq.com', 'Public/img/avatar/xiaobao.jpg', '我是小宝，很高兴认识你', NULL, '高尔夫球', '广州', NULL, 1420437994, '127.0.0.1', 1422691963, '127.0.0.1'),
(8, 'xiaohua', 'xiaohua', '女', '54631313512', 'xiaohua@qq.com', 'Public/img/avatar/xiaohua.jpg', '你好，我是小花', NULL, '帆船', '广州', NULL, 1420437997, '127.0.0.1', 1422874761, '127.0.0.1'),
(9, 'xiaowang', 'xiaowang', '男', '13513135121', 'xiaowang@qq.com', 'Public/img/avatar/xiaowang.jpg', 'hey', NULL, '桌球', '珠海', NULL, 1420438001, '127.0.0.1', 1420438001, '127.0.0.1'),
(31, 'tester', 'tester1', '男', '12345678900', 'tester@qq.com', NULL, '很高兴认识你', NULL, '保龄球', '湛江', NULL, 1422953581, '127.0.0.1', 1422956024, '127.0.0.1'),
(32, 'beeasy', 'easyman', '男', '12345678918', 'beconfidence@qq.com', NULL, NULL, NULL, '棒球', '广州', NULL, 1426509592, '127.0.0.1', 1426832016, '127.0.0.1'),
(33, 'theking', 'theking', NULL, NULL, '123456@qq.com', NULL, NULL, NULL, NULL, '江门', NULL, 1428912240, '127.0.0.1', 1428912240, '127.0.0.1'),
(34, 'theking2', 'theking2', NULL, NULL, '123456@qq.com', NULL, NULL, NULL, NULL, '江门', NULL, 1428912301, '127.0.0.1', 1428912301, '127.0.0.1'),
(35, 'theking3', 'theking3', NULL, NULL, '123456@qq.com', NULL, NULL, NULL, NULL, '江门', NULL, 1428912331, '127.0.0.1', 1428912331, '127.0.0.1'),
(36, 'theking100', 'theking100', NULL, NULL, '123456@qq.com', NULL, NULL, NULL, NULL, '江门', NULL, 1428912341, '127.0.0.1', 1428912341, '127.0.0.1'),
(37, 'theking10', 'theking10', NULL, NULL, '123456@qq.com', NULL, NULL, NULL, NULL, '江门', NULL, 1428912438, '127.0.0.1', 1428912438, '127.0.0.1');

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
