-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- 主机： 127.0.0.1
-- 生成日期： 2019-12-20 11:07:17
-- 服务器版本： 10.3.16-MariaDB
-- PHP 版本： 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `travel_data`
--

-- --------------------------------------------------------

--
-- 表的结构 `cd_routes`
--

CREATE TABLE `cd_routes` (
  `id` int(11) NOT NULL,
  `title` varchar(45) NOT NULL,
  `des` varchar(200) NOT NULL COMMENT '描述',
  `ps` varchar(100) NOT NULL COMMENT '标签',
  `day` varchar(45) NOT NULL COMMENT '天数',
  `distence` varchar(45) NOT NULL COMMENT '全程距离',
  `num` varchar(45) NOT NULL COMMENT '景点个数',
  `img` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `cd_routes`
--

INSERT INTO `cd_routes` (`id`, `title`, `des`, `ps`, `day`, `distence`, `num`, `img`) VALUES
(1, '﻿公园与博物馆，成都漫步1日游', '秀外慧中的成都，有众多的公园与博物馆。热闹喧嚣的景点不再想去，那就去逛逛这里吧。', '城市观光 祈福 逛公园 踏青 游览园林 城市', '1天', '3公里', '8个', 'static/routes/wenhua.jpg'),
(2, '撷取成都精华景点，仿古迹尝小吃，经典1日游', '一天的时间游玩成都，有点小遗憾~但依然可以很精彩！那就体验当地最经典与原汁原味的风情吧！', '经典 人文 城市观光 城镇漫步 秋游 黄金周', '1天', '10公里', '6个', 'static/routes/dupu.jpg'),
(3, '青城山、都江堰经典1日游', '成都及周边旅游资源极其丰富，人文和自然景点众多，如果逛完了市区的景点还有额外的时间，不妨抽一天去一下世界文化遗产：都江堰—青城山吧，来一次“拜水、问道”的旅程。', '经典 人文 户外 访古 祈福 亲水 逛公园 踏青 游山/爬山 暑假 宗教文化游', '1天', '17公里', '8个', 'static/routes/anlan.jpg'),
(4, '看国宝卖萌，爬西岭雪山，成都魅力2日游', '来成都，大熊猫必看。成都小吃更是不可错过的！再去郊县的西岭雪山，呼吸清新的山间空气，成都两日让你瞬间满血复活。', '美食 人文 户外 逛特色街 看动物 看云海 游山/爬山 春游 秋游 寒假 暑假 缆车观光', '2天', '112公里', '3个', 'static/routes/panda.jpg'),
(5, '随性的游荡，平乐古镇2日游', '抽2天的时间，来到这座距离成都市区约3小时的古镇，在古镇的小街巷内，随意逛逛，在古桥上看夕阳西下。第二天去古镇郊外的芦沟竹海，竹海内翠竹掩映，让人神清气爽。', '人文 古镇古村游 民俗体验 错峰 摄影 历史 自然', '2天', '5公里', '2个', 'static/routes/pingle.jpg'),
(6, '慢节奏的都市，成都3日闲适游', '武侯祠访古、锦里赏民俗、春熙路打望美女、宽窄巷子装小资~去成都耍三天！', '经典 人文 参观博物馆 访古 逛特色街 逛夜市 看动物 泡吧 品茶/喝茶 祈福', '3天', '49公里', '12个', 'static/routes/dacisi.jpg'),
(7, '驰骋在川北大草原上，体验官寨文化5日游', '这条线路适合夏季包车出行，每年七八月份，川北的若尔盖大草原上鲜花盛开，所有的风光都以最美的姿态等着游客们的到来，而散布在草原上的石林、湖泊和寺院更是风光中的明珠，等着你一一前去探寻。', '情侣 人文 地貌奇观 暑假', '5天', '1143公里', '13个', 'static/routes/hongyuan.jpg'),
(8, '一路向北，川甘青风光人文7日游', '这条路线从成都出发，一路向北直达西宁，路上大部分景点都可以通过班车到达，个别地方需要在当地打车或是短期包车。夏天时走这条路线，草原上绿草千里，牛羊徜徉，湖泊旁边鲜花竟放，寺院里经幡飘扬，这美妙的旅途一定让你终生难忘。', '人文 访古 暑假 宗教文化游', '7天', '936公里', '15个', 'static/routes/ruoergai.jpg');

--
-- 转储表的索引
--

--
-- 表的索引 `cd_routes`
--
ALTER TABLE `cd_routes`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `cd_routes`
--
ALTER TABLE `cd_routes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
