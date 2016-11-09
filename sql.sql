-- Adminer 3.6.1 MySQL dump

SET NAMES utf8;
SET foreign_key_checks = 0;
SET time_zone = 'SYSTEM';
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `tp_admin`;
CREATE TABLE `tp_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `login_ip` varchar(100) NOT NULL,
  `login_date` varchar(100) NOT NULL,
  `sum` varchar(10) NOT NULL,
  `free_time` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `tp_admin` (`id`, `username`, `password`, `login_ip`, `login_date`, `sum`, `free_time`) VALUES
(1,	'admin',	'21232f297a57a5a743894a0e4a801fc3',	'114.101.221.122',	'2015-12-09 15:08:55',	'12',	'30');

DROP TABLE IF EXISTS `tp_agent`;
CREATE TABLE `tp_agent` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `intro` varchar(800) NOT NULL DEFAULT '',
  `mp` varchar(11) NOT NULL DEFAULT '',
  `usercount` int(10) NOT NULL DEFAULT '0',
  `wxusercount` int(10) NOT NULL DEFAULT '0',
  `sitename` varchar(50) NOT NULL DEFAULT '',
  `sitelogo` varchar(200) NOT NULL DEFAULT '',
  `qrcode` varchar(100) NOT NULL DEFAULT '',
  `sitetitle` varchar(60) NOT NULL DEFAULT '',
  `siteurl` varchar(100) NOT NULL DEFAULT '',
  `robotname` varchar(40) NOT NULL DEFAULT '',
  `connectouttip` varchar(50) NOT NULL DEFAULT '',
  `needcheckuser` tinyint(1) NOT NULL DEFAULT '0',
  `regneedmp` tinyint(1) NOT NULL DEFAULT '1',
  `reggid` int(10) NOT NULL DEFAULT '0',
  `regvaliddays` mediumint(4) NOT NULL DEFAULT '30',
  `qq` varchar(12) NOT NULL DEFAULT '',
  `email` varchar(50) NOT NULL DEFAULT '',
  `metades` varchar(300) NOT NULL DEFAULT '',
  `metakeywords` varchar(200) NOT NULL DEFAULT '',
  `statisticcode` varchar(300) NOT NULL DEFAULT '',
  `copyright` varchar(100) NOT NULL DEFAULT '',
  `alipayaccount` varchar(50) NOT NULL DEFAULT '',
  `alipaypid` varchar(100) NOT NULL DEFAULT '',
  `alipaykey` varchar(100) NOT NULL DEFAULT '',
  `password` varchar(40) NOT NULL DEFAULT '',
  `salt` varchar(6) NOT NULL DEFAULT '',
  `money` int(10) NOT NULL DEFAULT '0',
  `moneybalance` int(10) NOT NULL DEFAULT '0',
  `time` int(10) NOT NULL DEFAULT '0',
  `endtime` int(11) NOT NULL DEFAULT '0',
  `lastloginip` varchar(26) NOT NULL DEFAULT '',
  `lastlogintime` int(11) NOT NULL DEFAULT '0',
  `wxacountprice` mediumint(4) NOT NULL DEFAULT '0',
  `monthprice` mediumint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `tp_areply`;
CREATE TABLE `tp_areply` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `keyword` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `content2` text,
  `uid` int(11) NOT NULL,
  `uname` varchar(90) NOT NULL,
  `createtime` varchar(13) NOT NULL,
  `updatetime` varchar(13) NOT NULL,
  `token` char(30) NOT NULL,
  `home` varchar(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `tp_areply` (`id`, `keyword`, `content`, `content2`, `uid`, `uname`, `createtime`, `updatetime`, `token`, `home`) VALUES
(1,	'',	'投票',	'直接点击菜单【参赛投票】或输入&quot;我要参加&quot; 即可参加报名或投票，并且直接输入选手编号即可为选手投票。',	1,	'',	'1449114973',	'1461313387',	'Eioa5C5oj3S32qhH',	'0');

DROP TABLE IF EXISTS `tp_catemenu`;
CREATE TABLE `tp_catemenu` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `fid` int(10) NOT NULL DEFAULT '0',
  `token` varchar(60) NOT NULL,
  `name` varchar(120) NOT NULL,
  `orderss` varchar(10) NOT NULL DEFAULT '0',
  `picurl` varchar(120) NOT NULL,
  `url` varchar(200) NOT NULL DEFAULT '0',
  `status` varchar(10) NOT NULL,
  `RadioGroup1` varchar(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `token` (`token`,`orderss`,`status`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `tp_company`;
CREATE TABLE `tp_company` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `amapid` varchar(50) NOT NULL DEFAULT '',
  `display` tinyint(1) NOT NULL DEFAULT '1',
  `token` varchar(50) NOT NULL DEFAULT '',
  `name` varchar(100) NOT NULL DEFAULT '',
  `username` varchar(60) NOT NULL,
  `password` varchar(32) NOT NULL,
  `shortname` varchar(50) NOT NULL DEFAULT '',
  `mp` varchar(11) NOT NULL DEFAULT '',
  `tel` varchar(20) NOT NULL DEFAULT '',
  `address` varchar(200) NOT NULL DEFAULT '',
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `intro` text NOT NULL,
  `catid` mediumint(3) NOT NULL DEFAULT '0',
  `taxis` int(10) NOT NULL DEFAULT '0',
  `isbranch` tinyint(1) NOT NULL DEFAULT '0',
  `logourl` varchar(180) NOT NULL DEFAULT '',
  `area_id` int(11) NOT NULL DEFAULT '0',
  `cate_id` int(11) NOT NULL DEFAULT '0',
  `market_id` int(11) NOT NULL DEFAULT '0',
  `mark_url` varchar(200) NOT NULL DEFAULT '',
  `add_time` char(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `token` (`token`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `tp_diymen_class`;
CREATE TABLE `tp_diymen_class` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(60) NOT NULL,
  `pid` int(11) NOT NULL,
  `title` varchar(30) NOT NULL,
  `keyword` varchar(255) NOT NULL,
  `is_show` tinyint(1) NOT NULL,
  `sort` tinyint(3) NOT NULL,
  `type` varchar(30) NOT NULL DEFAULT 'click',
  `url` varchar(255) DEFAULT NULL,
  `wxsys` char(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `tp_diymen_class` (`id`, `token`, `pid`, `title`, `keyword`, `is_show`, `sort`, `type`, `url`, `wxsys`) VALUES
(18,	'ugaCVZBmfnkG6cnr',	0,	'新闻视频',	'',	1,	0,	'click',	'',	''),
(19,	'ugaCVZBmfnkG6cnr',	0,	'便民启事',	'',	1,	0,	'click',	'',	''),
(20,	'ugaCVZBmfnkG6cnr',	0,	'微服务',	'',	1,	0,	'click',	'',	''),
(21,	'ugaCVZBmfnkG6cnr',	18,	'当日新闻',	'',	1,	0,	'click',	'http://wzan.ahtlcx.com/app/index.php?c=site&amp;a=site&amp;cid=14&amp;i=29&amp;u=81001&amp;wxref=mp.weixin.qq.com#wechat_redirect',	''),
(22,	'ugaCVZBmfnkG6cnr',	18,	'往期回顾',	'',	1,	0,	'click',	'http://wzan.ahtlcx.com/app/index.php?c=home&amp;i=29&amp;t=35&amp;u=81001',	''),
(23,	'ugaCVZBmfnkG6cnr',	19,	'失物发布',	'',	1,	0,	'click',	'http://wzan.ahtlcx.com/app/index.php?c=site&amp;a=site&amp;cid=106&amp;i=29&amp;u=81001',	''),
(24,	'ugaCVZBmfnkG6cnr',	19,	'招领启事',	'',	1,	0,	'click',	'http://wzan.ahtlcx.com/app/index.php?c=site&amp;a=site&amp;cid=19&amp;i=29',	''),
(25,	'ugaCVZBmfnkG6cnr',	20,	'互动话题',	'',	1,	0,	'click',	'http://wzan.ahtlcx.com/app/index.php?i=29&amp;c=entry&amp;id=110&amp;do=forum&amp;m=meepo_bbs',	''),
(26,	'ugaCVZBmfnkG6cnr',	20,	'线索征集',	'',	1,	0,	'click',	'http://wzan.ahtlcx.com/app/index.php?i=29&amp;c=entry&amp;do=index&amp;m=weisrc_feedback&amp;authkey=1&amp;code=001927bbcb13bddffd1a21ced7407728&amp;state=0',	''),
(27,	'ugaCVZBmfnkG6cnr',	20,	'最像亲子脸',	'投票',	1,	0,	'click',	'',	''),
(28,	'Eioa5C5oj3S32qhH',	0,	'投票模板A',	'',	1,	0,	'click',	'',	''),
(31,	'Eioa5C5oj3S32qhH',	28,	'深粉系列',	'深粉色',	1,	0,	'click',	'',	''),
(35,	'Eioa5C5oj3S32qhH',	28,	'草绿色',	'草绿色',	1,	12,	'click',	'',	''),
(36,	'Eioa5C5oj3S32qhH',	28,	'黄色',	'黄色',	1,	22,	'click',	'',	''),
(37,	'Eioa5C5oj3S32qhH',	28,	'土豪金',	'土豪金',	1,	22,	'click',	'',	''),
(38,	'Eioa5C5oj3S32qhH',	28,	'淡蓝',	'淡蓝',	1,	23,	'click',	'',	''),
(39,	'Eioa5C5oj3S32qhH',	0,	'投票模版B',	'粉色',	1,	23,	'click',	'',	''),
(40,	'Eioa5C5oj3S32qhH',	39,	'粉色',	'粉色',	1,	33,	'click',	'',	''),
(41,	'Eioa5C5oj3S32qhH',	39,	'清新系',	'清新系',	1,	44,	'click',	'',	'');

DROP TABLE IF EXISTS `tp_diymen_set`;
CREATE TABLE `tp_diymen_set` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(60) NOT NULL,
  `appid` varchar(18) NOT NULL,
  `appsecret` varchar(32) NOT NULL,
  `yappid` varchar(32) NOT NULL,
  `yappsecret` varchar(32) NOT NULL,
  `access_token` varchar(500) DEFAULT NULL,
  `expire_access` varchar(10) DEFAULT NULL,
  `jsapi_ticket` varchar(500) DEFAULT NULL,
  `expire_jsapi` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `tp_diymen_set` (`id`, `token`, `appid`, `appsecret`, `yappid`, `yappsecret`, `access_token`, `expire_access`, `jsapi_ticket`, `expire_jsapi`) VALUES
(3,	'Eioa5C5oj3S32qhH',	'wx784cb469f6844c',	'6f003f1a3b9b3f7ba2e351c606fdf233',	'',	'',	'EC13zoLsOBdri6MULOcEONZ_tSFstX6FvY6q0Au_m6JMQYJVoP4Sux_U4Q_ioOVDmb2HSjZA0bTTI1IGNEaZkx9sTgjkESZESFFDjdDOWNoWBNcAEAZEQ',	'1458217791',	'sM4AOVdWfPE4DxkXGEs8VCJ9H0Sps-p2cW05QI3LckvGysdAnSaghKkbtcDW2PKFdBUY6rBTKDL2pAbeLmtbDA',	'1458217791'),
(2,	'ugaCVZBmfnkG6cnr',	'wx37e2c8a56728483c',	'1461c68ea2bcf9a23f2daf0b4bc0d726',	'',	'',	'aqVHynTEUgpU2ehq-th2BNZijTb4tqljCUVSvvhww6Qwt8WnxiFgmqky0STJ8r1qGVYf9jFFLg76i2pVbFT3RSZN8A1NfvY1IGzSJBe0xckBKLbAIAVEF',	'1449652073',	'kgt8ON7yVITDhtdwci0qeUvXygng0uwVQqWcx36OzWl2NJWrasuF5stIKagLIrO9BO2IndzQH6he4prVqb3kng',	'1449652073');

DROP TABLE IF EXISTS `tp_files`;
CREATE TABLE `tp_files` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `token` varchar(30) NOT NULL DEFAULT '',
  `url` varchar(200) NOT NULL DEFAULT '',
  `size` int(10) NOT NULL DEFAULT '0',
  `type` varchar(20) NOT NULL DEFAULT '',
  `time` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `type` (`type`),
  KEY `token` (`token`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `tp_files` (`id`, `token`, `url`, `size`, `type`, `time`) VALUES
(1,	'Eioa5C5oj3S32qhH',	'http://hb.hailaizi.com/uploads/E/Eioa5C5oj3S32qhH/d/b/5/e/thumb_56989ff7eca55.jpg',	284606,	'jpg',	1452843000),
(2,	'Eioa5C5oj3S32qhH',	'http://hb.hailaizi.com/uploads/E/Eioa5C5oj3S32qhH/0/4/c/7/thumb_56990d3511e5e.jpg',	75314,	'jpg',	1452870965),
(3,	'Eioa5C5oj3S32qhH',	'http://hb.hailaizi.com/uploads/E/Eioa5C5oj3S32qhH/a/e/b/9/thumb_56990e17ee662.jpg',	514959,	'jpg',	1452871192),
(4,	'Eioa5C5oj3S32qhH',	'http://hb.hailaizi.com/uploads/E/Eioa5C5oj3S32qhH/d/2/4/2/thumb_569a4ebd7b4ee.jpg',	1214445,	'jpg',	1452953279),
(5,	'Eioa5C5oj3S32qhH',	'http://0.weiapp.cc/uploads/E/Eioa5C5oj3S32qhH/a/b/9/a/thumb_56e926d7795de.jpg',	411800,	'jpg',	1458120407),
(6,	'Eioa5C5oj3S32qhH',	'http://0.weiapp.cc/uploads/E/Eioa5C5oj3S32qhH/c/e/a/d/thumb_56e926f5e0c56.jpg',	360496,	'jpg',	1458120438),
(7,	'Eioa5C5oj3S32qhH',	'http://0.weiapp.cc/uploads/E/Eioa5C5oj3S32qhH/c/a/b/1/thumb_56e9271ca10ba.jpg',	411800,	'jpg',	1458120476),
(8,	'Eioa5C5oj3S32qhH',	'http://0.weiapp.cc/uploads/E/Eioa5C5oj3S32qhH/5/e/c/c/56e9273f5a964.jpg',	246955,	'jpg',	1458120511),
(9,	'Eioa5C5oj3S32qhH',	'http://0.weiapp.cc/uploads/E/Eioa5C5oj3S32qhH/4/2/b/2/56e92751af15f.jpg',	188484,	'jpg',	1458120529),
(10,	'Eioa5C5oj3S32qhH',	'http://0.weiapp.cc/uploads/E/Eioa5C5oj3S32qhH/8/3/7/5/56e9276707dd4.jpg',	47178,	'jpg',	1458120551),
(11,	'Eioa5C5oj3S32qhH',	'http://0.weiapp.cc/uploads/E/Eioa5C5oj3S32qhH/0/8/f/8/thumb_56ea536be4640.jpg',	127423,	'jpg',	1458197356),
(12,	'Eioa5C5oj3S32qhH',	'http://0.weiapp.cc/uploads/E/Eioa5C5oj3S32qhH/2/8/7/6/thumb_56ea55d728cc7.jpg',	82608,	'jpg',	1458197975),
(13,	'Eioa5C5oj3S32qhH',	'http://0.weiapp.cc/uploads/E/Eioa5C5oj3S32qhH/4/0/d/4/thumb_56ea55eda9e52.jpg',	75084,	'jpg',	1458197997),
(14,	'Eioa5C5oj3S32qhH',	'http://0.weiapp.cc/uploads/E/Eioa5C5oj3S32qhH/c/d/7/8/thumb_56ea55fc0e0f8.jpg',	55904,	'jpg',	1458198012),
(15,	'Eioa5C5oj3S32qhH',	'http://0.weiapp.cc/uploads/E/Eioa5C5oj3S32qhH/5/5/7/1/thumb_56ea560b62105.jpg',	58205,	'jpg',	1458198027),
(16,	'Eioa5C5oj3S32qhH',	'http://0.weiapp.cc/uploads/E/Eioa5C5oj3S32qhH/5/a/4/4/thumb_56ea561a36370.jpg',	85153,	'jpg',	1458198042),
(17,	'Eioa5C5oj3S32qhH',	'http://0.weiapp.cc/uploads/E/Eioa5C5oj3S32qhH/7/7/4/c/thumb_56ea56528ffa5.jpg',	23063,	'jpg',	1458198098);

DROP TABLE IF EXISTS `tp_function`;
CREATE TABLE `tp_function` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gid` tinyint(3) NOT NULL,
  `usenum` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `funname` varchar(100) NOT NULL,
  `info` varchar(100) NOT NULL,
  `isserve` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `gid` (`gid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `tp_function` (`id`, `gid`, `usenum`, `name`, `funname`, `info`, `isserve`, `status`) VALUES
(1,	1,	0,	'天气查询',	'tianqi',	'天气查询服务:例  城市名+天气',	1,	1),
(2,	1,	0,	'糗事',	'qiushi',	'糗事　直接发送糗事',	1,	1),
(3,	1,	0,	'计算器',	'jishuan',	'计算器使用方法　例：计算50-50　，计算100*100',	1,	1),
(4,	4,	0,	'朗读',	'langdu',	'朗读＋关键词　例：朗读pigcms多用户营销系统',	1,	1),
(5,	3,	0,	'健康指数查询',	'jiankang',	'健康指数查询　健康＋高，＋重　例：健康170,65',	1,	1),
(6,	1,	0,	'快递查询',	'kuaidi',	'快递＋快递名＋快递号　例：快递顺丰117215889174',	1,	1),
(7,	1,	0,	'笑话',	'xiaohua',	'笑话　直接发送笑话',	1,	1),
(8,	2,	0,	'藏头诗',	'changtoushi',	' 藏头诗+关键词　例：藏头诗我爱你',	1,	1),
(9,	1,	0,	'陪聊',	'peiliao',	'聊天　直接输入聊天关键词即可',	1,	1),
(10,	1,	0,	'聊天',	'liaotian',	'聊天　直接输入聊天关键词即可',	1,	1),
(11,	3,	0,	'周公解梦',	'mengjian',	'周公解梦　梦见+关键词　例如:梦见父母',	1,	1),
(12,	2,	0,	'语音翻译',	'yuyinfanyi',	'翻译＋关键词 例：翻译你好',	1,	1),
(13,	2,	0,	'火车查询',	'huoche',	'火车查询　火车＋城市＋目的地　例火车上海南京',	1,	1),
(14,	2,	0,	'公交查询',	'gongjiao',	'公交＋城市＋公交编号　例：上海公交774',	1,	1),
(15,	2,	0,	'身份证查询',	'shenfenzheng',	'身份证＋号码　　例：身份证342423198803015568',	1,	1),
(16,	1,	0,	'手机归属地查询',	'shouji',	'手机归属地查询(吉凶 运势) 手机＋手机号码　例：手机13856017160',	1,	1),
(17,	3,	0,	'音乐查询',	'yinle',	'音乐＋音乐名  例：音乐爱你一万年',	1,	1),
(18,	1,	0,	'附近周边信息查询',	'fujin',	'附近周边信息查询(ＬＢＳ） 回复:附近+关键词  例:附近酒店',	1,	1),
(19,	4,	0,	'公众小秘书',	'Paper',	'公众小秘书',	2,	1),
(20,	3,	0,	'淘宝店铺',	'taobao',	'输入淘宝＋关键词　即可访问淘宝3g手机店铺',	2,	1),
(21,	4,	0,	'会员资料管理',	'userinfo',	'会员资料管理　输入会员　即可参与',	2,	1),
(22,	1,	0,	'翻译',	'fanyi',	'翻译＋关键词 例：翻译你好',	1,	1),
(23,	4,	0,	'第三方接口',	'api',	'第三方接口整合模块，请在管理平台下载接口文件并配置接口信息，',	1,	1),
(24,	1,	0,	'姓名算命',	'suanming',	'姓名算命 算命＋关键词　例：算命李白',	1,	1),
(25,	3,	0,	'百度百科',	'baike',	'百度百科　使用方法：百科＋关键词　例：百科北京',	2,	1),
(26,	2,	0,	'彩票查询',	'caipiao',	'回复内容:彩票+彩种即可查询彩票中奖信息,例：彩票双色球',	1,	1),
(27,	4,	0,	'照片墙',	'Zhaopianwall',	'活动开启后，在聊天窗口中直接发送图片，即可图片上墙！',	2,	1),
(28,	4,	0,	'RippleOS',	'RippleOS',	'RippleOS路由器',	1,	1),
(29,	1,	0,	'3G首页',	'shouye',	'输入首页,访问微3g 网站',	1,	1),
(30,	1,	0,	'DIY宣传页',	'adma',	'DIY宣传页,用于创建二维码宣传页权限开启',	1,	1),
(31,	4,	0,	'会员卡',	'huiyuanka',	'尊贵享受vip会员卡,回复会员卡即可领取会员卡',	1,	1),
(32,	4,	0,	'微名片',	'Vcard',	'微名片',	2,	1),
(33,	4,	0,	'账号审核',	'usernameCheck',	'正确的审核帐号方式是：审核+帐号',	2,	1),
(34,	1,	0,	'歌词查询',	'geci',	'歌词查询 回复歌词＋歌名即可查询一首歌曲的歌词,例：歌词醉清风',	1,	1),
(35,	2,	0,	'域名whois查询',	'whois',	'域名whois查询　回复域名＋域名 可查询网站备案信息,域名whois注册时间等等\r\n 例：域名pigcms.com',	1,	1),
(36,	1,	0,	'通用预订系统',	'host_kev',	'通用预订系统 可用于酒店预订，ktv订房，旅游预订等。',	2,	1),
(37,	4,	0,	'自定义表单',	'diyform',	'自定义表单(用于报名，预约,留言)等',	1,	1),
(38,	2,	0,	'无线网络订餐',	'dx',	'无线网络订餐',	1,	1),
(39,	2,	0,	'在线商城',	'shop',	'在线商城,购买系统',	1,	1),
(40,	2,	0,	'在线团购系统',	'etuan',	'在线团购系统',	1,	1),
(41,	4,	0,	'自定义菜单',	'diymen_set',	'自定义菜单,一键生成轻app',	1,	1),
(42,	4,	0,	'幸运大转盘',	'choujiang',	'输入抽奖　即可参加幸运大转盘抽奖活动',	2,	1),
(43,	4,	0,	'抽奖',	'lottery',	'抽奖,输入抽奖即可参加幸运大转盘',	1,	1),
(44,	4,	0,	'刮刮卡',	'gua2',	'刮刮卡抽奖活动',	1,	1),
(45,	4,	0,	'全景',	'panorama',	'',	1,	1),
(46,	4,	0,	'婚庆喜帖',	'Wedding',	'',	2,	1),
(47,	4,	0,	'投票',	'Vote',	'',	2,	1),
(48,	4,	0,	'房产',	'estate',	'',	2,	1),
(49,	4,	0,	'3G相册',	'album',	'',	1,	1),
(50,	4,	0,	'砸金蛋',	'GoldenEgg',	'',	2,	1),
(51,	4,	0,	'水果机',	'LuckyFruit',	'',	2,	1),
(52,	4,	0,	'留言板',	'messageboard',	'',	2,	1),
(53,	4,	0,	'微汽车',	'car',	'',	2,	1),
(54,	4,	0,	'微信墙',	'wall',	'',	1,	1),
(55,	4,	0,	'摇一摇',	'shake',	'',	1,	1),
(56,	4,	0,	'微论坛',	'forum',	'',	1,	1),
(57,	4,	0,	'微医疗',	'medical',	'',	1,	1),
(58,	4,	0,	'群发消息',	'groupmessage',	'',	1,	1),
(59,	4,	0,	'分享统计',	'share',	'',	1,	1),
(60,	4,	0,	'酒店宾馆',	'hotel',	'',	1,	1),
(61,	4,	0,	'微教育',	'school',	'',	1,	1),
(62,	4,	0,	'微场景',	'Live',	'',	2,	1),
(63,	1,	0,	'微街景',	'Jiejing',	'',	1,	1),
(64,	1,	0,	'中秋吃月饼',	'Autumn',	'',	1,	1),
(65,	1,	0,	'摁死小情侣游戏',	'Lovers',	'回复 “小情侣” 即可参加',	1,	1),
(66,	1,	0,	'七夕走鹊桥',	'AppleGame',	'回复 “走鹊桥” 即可参与',	1,	1),
(67,	1,	0,	'微调研',	'Research',	'',	1,	1),
(68,	1,	0,	'一战到底',	'Problem',	'',	1,	1),
(69,	1,	0,	'微信签到',	'Signin',	'',	1,	1),
(70,	1,	0,	'现场活动',	'Scene',	'',	1,	1),
(71,	1,	0,	'微商圈',	'Market',	'',	1,	1),
(72,	1,	0,	'微预约',	'Custom',	'',	1,	1),
(73,	1,	0,	'祝福贺卡',	'Greeting_card',	'',	1,	1),
(74,	1,	0,	'微美容',	'beauty',	'',	1,	1),
(75,	1,	0,	'微健身',	'fitness',	'',	1,	1),
(76,	1,	0,	'微政务',	'gover',	'',	1,	1),
(77,	1,	0,	'微食品',	'food',	'',	1,	1),
(78,	1,	0,	'微旅游',	'travel',	'',	1,	1),
(79,	1,	0,	'微花店',	'flower',	'',	1,	1),
(80,	1,	0,	'微物业',	'property',	'',	1,	1),
(81,	1,	0,	'微KTV',	'ktv',	'',	1,	1),
(82,	1,	0,	'微酒吧',	'bar',	'',	1,	1),
(83,	1,	0,	'微装修',	'fitment',	'',	1,	1),
(84,	1,	0,	'微婚庆',	'buswedd',	'',	1,	1),
(85,	1,	0,	'微宠物',	'affections',	'',	1,	1),
(86,	1,	0,	'微家政',	'housekeeper',	'',	1,	1),
(87,	1,	0,	'微租赁',	'lease',	'',	1,	1),
(88,	1,	0,	'微游戏',	'Gamecenter',	'',	1,	1),
(89,	1,	0,	'百度直达号',	'Zhida',	'',	1,	1),
(90,	1,	0,	'微信红包',	'Red_packet',	'',	1,	1),
(91,	1,	0,	'惩罚台',	'Punish',	'',	1,	1),
(92,	1,	0,	'邀请函',	'Invite',	'',	1,	1),
(93,	1,	0,	'拆礼盒',	'Autumns',	'',	1,	1),
(94,	1,	0,	'高级模板',	'AdvanceTpl',	'',	1,	1),
(95,	1,	0,	'群发消息',	'Message',	'',	1,	1),
(96,	1,	0,	'分享助力',	'Helping',	'',	1,	1),
(97,	1,	0,	'人气冲榜',	'Popularity',	'',	1,	1),
(98,	1,	0,	'幸运九宫格',	'Jiugong',	'幸运九宫格',	1,	1),
(99,	1,	0,	'微招聘',	'Zhaopin',	'微招聘主要为求职者和企业搭建沟通桥梁',	1,	1),
(100,	1,	0,	'全民经纪人',	'MicroBroker',	'全民经纪人',	1,	1),
(101,	1,	0,	'一元夺宝',	'Unitary',	'只需一元就能拿走大奖',	1,	1),
(102,	1,	0,	'微众筹',	'Crowdfunding',	'实现梦想，一起奋斗',	1,	1),
(103,	1,	0,	'微砍价',	'Bargain',	'一起来砍价',	1,	1),
(104,	1,	0,	'微外卖',	'DishOut',	'新版外卖',	1,	1),
(105,	1,	0,	'手机站',	'Phone',	'手机独立网站',	1,	1);

DROP TABLE IF EXISTS `tp_fusers`;
CREATE TABLE `tp_fusers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nickname` varchar(1000) DEFAULT NULL,
  `sex` tinyint(1) DEFAULT NULL,
  `city` varchar(1000) DEFAULT NULL,
  `country` varchar(1000) DEFAULT NULL,
  `province` varchar(1000) DEFAULT NULL,
  `headimgurl` varchar(1000) DEFAULT NULL,
  `is_gz` tinyint(1) NOT NULL DEFAULT '1',
  `openid` varchar(1000) NOT NULL,
  `telphone` varchar(100) DEFAULT NULL,
  `gztime` int(11) NOT NULL,
  `jfnum` int(8) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `tp_fusers` (`id`, `nickname`, `sex`, `city`, `country`, `province`, `headimgurl`, `is_gz`, `openid`, `telphone`, `gztime`, `jfnum`) VALUES
(1,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	1,	'oUzB4uO1EegVRpWHasVGyyO6WALM',	NULL,	1452840080,	0),
(2,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	1,	'oUzB4uLqJnIKNTS1XaR5OXk21h9w',	NULL,	1452859689,	0),
(3,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	0,	'oUzB4uETSi0pV34Rk_X5JdGgz3-E',	NULL,	1452909905,	0),
(4,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	1,	'oUzB4uAxBjlTHtoCNiNYRYlxGH6E',	NULL,	1452913595,	0),
(5,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	1,	'oUzB4uLH-kME6mX7-FRqfV3HBUuU',	NULL,	1452914793,	0),
(6,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	0,	'oUzB4uDhv53tTavLWabRUwYV0iRg',	NULL,	1452933863,	0),
(7,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	0,	'oUzB4uPtTN33ZwSzsPkeC5hG3ihA',	NULL,	1452941434,	0),
(8,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	1,	'oUzB4uCKMgfdUzNcW7kI9NG4ANZU',	NULL,	1452942662,	0),
(9,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	1,	'oUzB4uAT9DHNSeMEZ4bmAaEo4qKs',	NULL,	1452944669,	0),
(10,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	1,	'oUzB4uB9AkWt722lfmIzvPe-IYBI',	NULL,	1452946653,	0),
(11,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	1,	'oUzB4uNFMO3KXCZGe7TCDHCY_7es',	NULL,	1452953098,	0),
(12,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	1,	'oUzB4uFE4i2JZGYA66xrdGnPzfkU',	NULL,	1453633798,	0),
(13,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	1,	'oZZt4wD90ULUrftItOFPNr5vguqI',	'13186442514',	1453640956,	0),
(14,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	1,	'oYKpzvymiiVgWmllEgy8hfxVSrSc',	NULL,	1453641770,	0),
(15,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	1,	'oUzB4uF4TV9h2ZDbZTLCaWE4gXmo',	NULL,	1453641812,	0),
(16,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	1,	'oqBbVs1nwAfQq_-FDzM8PV_ibtR4',	'15956325896',	1458119854,	5),
(17,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	0,	'oBNrss1rb6ZP4dl0d-2bmYhFtsq4',	NULL,	1458128036,	0),
(18,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	1,	'oBNrss_eWVJZCFqbirYvKkIS_BSo',	NULL,	1458135301,	0),
(19,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	1,	'oBNrss_foYUxIrmJe5Y6xSgQfhWk',	NULL,	1458174680,	0),
(20,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	1,	'oBNrss910-gDCAmIIDiBZ1D0zGm8',	NULL,	1458176914,	0),
(21,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	1,	'oBNrss-srenb-3Z9sss_m0JQVi-c',	NULL,	1458190106,	0),
(22,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	0,	'oBNrss1gHzLD_gv6jrbMU8Woc4dw',	NULL,	1458215677,	0),
(23,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	0,	'oBNrss7useNrg-WL7oY8Y9jaDTVY',	NULL,	1458220343,	0);

DROP TABLE IF EXISTS `tp_guanggao`;
CREATE TABLE `tp_guanggao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vid` int(11) NOT NULL,
  `ggurl` varchar(200) NOT NULL,
  `gginfo` varchar(260) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `tp_guanggao` (`id`, `vid`, `ggurl`, `gginfo`) VALUES
(10,	4,	'http://i8.tietuku.com/0d46bc70e3053d8b.jpg',	NULL),
(11,	4,	'http://i8.tietuku.com/0d46bc70e3053d8b.jpg',	NULL),
(12,	5,	'http://i1.tietuku.com/ec697112499b0a8b.jpg',	NULL),
(13,	5,	'http://i1.tietuku.com/ec697112499b0a8b.jpg',	NULL),
(14,	6,	'http://i3.tietuku.com/13be9e43316dac1d.png',	NULL),
(15,	6,	'http://i3.tietuku.com/13be9e43316dac1d.png',	NULL),
(16,	7,	'http://i1.tietuku.com/50f6a6bd43b27941.jpg',	NULL),
(17,	7,	'http://i1.tietuku.com/50f6a6bd43b27941.jpg',	NULL),
(18,	8,	'http://i1.tietuku.com/5ce57b38b4aeda96.jpg',	NULL),
(19,	8,	'http://i1.tietuku.com/5ce57b38b4aeda96.jpg',	NULL),
(20,	9,	'http://0.weiapp.cc/uploads/E/Eioa5C5oj3S32qhH/a/b/9/a/thumb_56e926d7795de.jpg',	NULL),
(21,	9,	'http://0.weiapp.cc/uploads/E/Eioa5C5oj3S32qhH/c/e/a/d/thumb_56e926f5e0c56.jpg',	NULL),
(22,	10,	'http://i13.tietuku.com/1c64002a7b1396c0.jpg',	NULL),
(23,	10,	'http://i11.tietuku.com/bf4c915d24459f80.jpg',	NULL),
(24,	11,	'http://ww2.sinaimg.cn/mw1024/8bd1db32gw1f0bpvflkdjj20hs0bdacy.jpg',	NULL),
(25,	12,	'http://ww4.sinaimg.cn/mw1024/8bd1db32gw1f0bpqgqnidj20hs0g4afo.jpg',	NULL),
(26,	13,	'http://ww3.sinaimg.cn/mw1024/8bd1db32gw1f0bpqibp4xj20hs0rd45n.jpg',	NULL),
(27,	14,	'http://0.weiapp.cc/uploads/E/Eioa5C5oj3S32qhH/0/8/f/8/thumb_56ea536be4640.jpg',	NULL),
(28,	15,	'http://ww3.sinaimg.cn/mw1024/8bd1db32gw1f0bpqibp4xj20hs0rd45n.jpg',	NULL),
(29,	16,	'http://ww2.sinaimg.cn/mw1024/8bd1db32gw1f0bpqfkk9yj20hs0e1gpc.jpg',	NULL);

DROP TABLE IF EXISTS `tp_home`;
CREATE TABLE `tp_home` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(60) NOT NULL,
  `title` varchar(30) NOT NULL,
  `picurl` varchar(120) NOT NULL,
  `apiurl` varchar(150) NOT NULL,
  `homeurl` varchar(120) NOT NULL,
  `info` varchar(120) NOT NULL,
  `musicurl` varchar(180) NOT NULL DEFAULT '',
  `plugmenucolor` varchar(10) NOT NULL DEFAULT '',
  `copyright` varchar(200) NOT NULL DEFAULT '',
  `logo` varchar(200) NOT NULL DEFAULT '',
  `radiogroup` mediumint(4) NOT NULL DEFAULT '0',
  `advancetpl` tinyint(1) NOT NULL DEFAULT '0',
  `gzhurl` char(255) DEFAULT NULL COMMENT '公众号链接地址',
  `start` int(11) NOT NULL COMMENT '开场动画',
  `stpic` varchar(200) NOT NULL COMMENT '开场动画图片',
  `switch` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `tp_keyword`;
CREATE TABLE `tp_keyword` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `keyword` char(255) NOT NULL,
  `pid` int(11) NOT NULL,
  `token` varchar(60) NOT NULL,
  `module` varchar(15) NOT NULL,
  `content` text,
  PRIMARY KEY (`id`),
  KEY `token` (`token`),
  KEY `pid` (`pid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `tp_keyword` (`id`, `keyword`, `pid`, `token`, `module`, `content`) VALUES
(3,	'投票',	3,	'ugaCVZBmfnkG6cnr',	'Vote',	NULL),
(4,	'大转盘',	1,	'ugaCVZBmfnkG6cnr',	'Lottery',	NULL),
(5,	'粉色',	4,	'Eioa5C5oj3S32qhH',	'Vote',	NULL),
(6,	'草绿色',	5,	'Eioa5C5oj3S32qhH',	'Vote',	NULL),
(7,	'黄色',	6,	'Eioa5C5oj3S32qhH',	'Vote',	NULL),
(8,	'土豪金',	7,	'Eioa5C5oj3S32qhH',	'Vote',	NULL),
(9,	'淡蓝',	8,	'Eioa5C5oj3S32qhH',	'Vote',	NULL),
(10,	'深粉色',	9,	'Eioa5C5oj3S32qhH',	'Vote',	NULL),
(11,	'清新色',	10,	'Eioa5C5oj3S32qhH',	'Vote',	NULL),
(12,	'草绿色',	11,	'Eioa5C5oj3S32qhH',	'Vote',	NULL),
(13,	'黄色',	12,	'Eioa5C5oj3S32qhH',	'Vote',	NULL),
(14,	'土豪金',	13,	'Eioa5C5oj3S32qhH',	'Vote',	NULL),
(15,	'淡蓝',	14,	'Eioa5C5oj3S32qhH',	'Vote',	NULL),
(16,	'粉色',	15,	'Eioa5C5oj3S32qhH',	'Vote',	NULL),
(17,	'投票',	16,	'Eioa5C5oj3S32qhH',	'Vote',	NULL);

DROP TABLE IF EXISTS `tp_lottery`;
CREATE TABLE `tp_lottery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `joinnum` int(11) NOT NULL COMMENT '参与人数',
  `click` int(11) NOT NULL,
  `token` varchar(30) NOT NULL,
  `keyword` varchar(10) NOT NULL,
  `starpicurl` varchar(100) NOT NULL COMMENT '填写活动开始图片网址',
  `title` varchar(60) NOT NULL COMMENT '活动名称',
  `txt` varchar(60) NOT NULL COMMENT '用户输入兑奖时候的显示信息',
  `sttxt` varchar(200) NOT NULL COMMENT '简介',
  `statdate` int(11) NOT NULL COMMENT '活动开始时间',
  `enddate` int(11) NOT NULL COMMENT '活动结束时间',
  `info` varchar(200) NOT NULL COMMENT '活动说明',
  `aginfo` varchar(200) NOT NULL COMMENT '重复抽奖回复',
  `ydgzurl` varchar(3000) DEFAULT NULL,
  `fxbt` text,
  `fxzy` text,
  `endtite` varchar(60) NOT NULL COMMENT '活动结束公告主题',
  `endpicurl` varchar(100) NOT NULL,
  `endinfo` varchar(60) NOT NULL,
  `fist` varchar(50) NOT NULL COMMENT '一等奖奖品设置',
  `fistnums` int(4) NOT NULL COMMENT '一等奖奖品数量',
  `fistlucknums` int(1) NOT NULL COMMENT '一等奖中奖号码',
  `second` varchar(50) NOT NULL COMMENT '二等奖奖品设置',
  `type` tinyint(1) NOT NULL,
  `secondnums` int(4) NOT NULL,
  `secondlucknums` int(1) NOT NULL,
  `third` varchar(50) NOT NULL,
  `thirdnums` int(4) NOT NULL,
  `thirdlucknums` int(1) NOT NULL,
  `allpeople` int(11) NOT NULL,
  `canrqnums` int(2) NOT NULL COMMENT '个人限制抽奖次数',
  `parssword` int(15) NOT NULL,
  `renamesn` varchar(50) NOT NULL DEFAULT '',
  `renametel` varchar(60) NOT NULL,
  `displayjpnums` int(1) NOT NULL,
  `createtime` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  `four` varchar(50) NOT NULL,
  `fournums` int(11) NOT NULL,
  `fourlucknums` int(11) NOT NULL,
  `five` varchar(50) NOT NULL,
  `fivenums` int(11) NOT NULL,
  `fivelucknums` int(11) NOT NULL,
  `six` varchar(50) NOT NULL COMMENT '六等奖',
  `sixnums` int(11) NOT NULL,
  `sixlucknums` int(11) NOT NULL,
  `zjpic` varchar(150) NOT NULL DEFAULT '',
  `daynums` mediumint(4) NOT NULL DEFAULT '0',
  `decjf` int(4) DEFAULT '1',
  `cyfs` int(1) DEFAULT '2',
  `maxgetprizenum` mediumint(4) NOT NULL DEFAULT '1',
  `needreg` tinyint(1) NOT NULL DEFAULT '0',
  `guanzhu` int(11) DEFAULT NULL COMMENT '是否关注',
  `fistpic` varchar(100) DEFAULT NULL,
  `secondpic` varchar(100) DEFAULT NULL,
  `thirdpic` varchar(100) DEFAULT NULL,
  `fourpic` varchar(100) DEFAULT NULL,
  `fivepic` varchar(100) DEFAULT NULL,
  `sixpic` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `token` (`token`),
  KEY `zjpic` (`zjpic`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `tp_lottery` (`id`, `joinnum`, `click`, `token`, `keyword`, `starpicurl`, `title`, `txt`, `sttxt`, `statdate`, `enddate`, `info`, `aginfo`, `ydgzurl`, `fxbt`, `fxzy`, `endtite`, `endpicurl`, `endinfo`, `fist`, `fistnums`, `fistlucknums`, `second`, `type`, `secondnums`, `secondlucknums`, `third`, `thirdnums`, `thirdlucknums`, `allpeople`, `canrqnums`, `parssword`, `renamesn`, `renametel`, `displayjpnums`, `createtime`, `status`, `four`, `fournums`, `fourlucknums`, `five`, `fivenums`, `fivelucknums`, `six`, `sixnums`, `sixlucknums`, `zjpic`, `daynums`, `decjf`, `cyfs`, `maxgetprizenum`, `needreg`, `guanzhu`, `fistpic`, `secondpic`, `thirdpic`, `fourpic`, `fivepic`, `sixpic`) VALUES
(1,	6,	0,	'ugaCVZBmfnkG6cnr',	'大转盘',	'http://c.bhcm88.com/tpl/static/guajiang/images/activity-lottery-start.jpg',	'幸运大转盘活动开始了',	'兑奖请联系我们，电话0554—6660101',	'恭喜你，中奖啦！',	1450108800,	1452096000,	'亲，请点击进入大转盘抽奖活动页面，祝您好运哦！',	'你已经玩过了，下次再来。',	'http://mp.weixin.qq.com/s?__biz=MzIxODA2NDkxNQ==&amp;mid=400866920&amp;idx=1&amp;sn=8a24db56d8f0c42f9f644e3c5e3e5e41#rd',	'《今晚800》寻找最像亲子脸评比活动',	' 我爱品质生活我爱刘香豆腐，刘香豆腐非转基因制作。《今晚800》“寻找最像亲子脸”评选活动正式启动啦！',	'幸运大转盘活动已经结束了',	'http://c.bhcm88.com/tpl/static/guajiang/images/activity-lottery-end.jpg',	'亲，活动已经结束，请继续关注我们的后续活动哦。',	'刘香豆干精品装',	30,	0,	'刘香喜干礼盒',	1,	60,	0,	'完颜牛肉汤桶装',	120,	0,	1000,	31,	0,	'',	'',	0,	0,	1,	'',	0,	0,	'',	0,	0,	'',	0,	0,	'',	1,	0,	1,	1,	0,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL);

DROP TABLE IF EXISTS `tp_lottery_cheat`;
CREATE TABLE `tp_lottery_cheat` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `lid` int(10) NOT NULL DEFAULT '0',
  `wecha_id` varchar(60) NOT NULL DEFAULT '',
  `mp` varchar(11) NOT NULL DEFAULT '',
  `prizetype` mediumint(4) NOT NULL DEFAULT '0',
  `intro` varchar(60) NOT NULL DEFAULT '',
  `code` varchar(20) NOT NULL DEFAULT '',
  `isok` int(1) DEFAULT '0',
  `isuse` int(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `lid` (`lid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `tp_lottery_record`;
CREATE TABLE `tp_lottery_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lid` int(11) NOT NULL,
  `usenums` tinyint(1) NOT NULL DEFAULT '0' COMMENT '用户使用次数',
  `wecha_id` varchar(60) NOT NULL COMMENT '微信唯一识别码',
  `token` varchar(30) NOT NULL,
  `islottery` int(1) NOT NULL COMMENT '是否中奖',
  `wecha_name` varchar(60) NOT NULL COMMENT '微信号',
  `phone` varchar(15) NOT NULL,
  `sn` varchar(13) NOT NULL COMMENT '中奖后序列号',
  `time` int(11) NOT NULL,
  `prize` varchar(50) NOT NULL DEFAULT '' COMMENT '已中奖项',
  `sendstutas` int(11) NOT NULL DEFAULT '0',
  `sendtime` int(11) NOT NULL,
  PRIMARY KEY (`id`,`lid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `tp_lottery_record` (`id`, `lid`, `usenums`, `wecha_id`, `token`, `islottery`, `wecha_name`, `phone`, `sn`, `time`, `prize`, `sendstutas`, `sendtime`) VALUES
(1,	1,	1,	'oE8bPvwr_pZA-8afsajwEqxD1UsM',	'ugaCVZBmfnkG6cnr',	0,	'',	'',	'',	1449483060,	'7',	0,	0),
(2,	1,	1,	'oE8bPvzR4s5eeX5X3WFdf1hB46V4',	'ugaCVZBmfnkG6cnr',	0,	'',	'',	'',	1449486174,	'7',	0,	0),
(3,	1,	1,	'oE8bPv5UaJWvjuhzXgs988BUmgNI',	'ugaCVZBmfnkG6cnr',	0,	'',	'',	'',	1449486343,	'7',	0,	0),
(4,	1,	1,	'oE8bPv7yXokwu6hVPRi3nJaHM9wA',	'ugaCVZBmfnkG6cnr',	0,	'',	'',	'',	1449528835,	'7',	0,	0),
(5,	1,	1,	'oE8bPv-y1EF9BDzZNcWDyaerK5xg',	'ugaCVZBmfnkG6cnr',	0,	'',	'',	'',	1449534556,	'7',	0,	0),
(6,	1,	1,	'o4ymZs4TtqfwTyMStIVGVjukBeHk',	'ugaCVZBmfnkG6cnr',	0,	'',	'',	'',	1449535135,	'7',	0,	0);

DROP TABLE IF EXISTS `tp_node`;
CREATE TABLE `tp_node` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL COMMENT 'èŠ‚ç‚¹åç§°',
  `title` varchar(50) NOT NULL COMMENT 'èœå•åç§°',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'æ˜¯å¦æ¿€æ´» 1ï¼šæ˜¯ 2ï¼šå¦',
  `remark` varchar(255) DEFAULT NULL COMMENT 'å¤‡æ³¨è¯´æ˜Ž',
  `pid` smallint(6) unsigned NOT NULL COMMENT 'çˆ¶ID',
  `level` tinyint(1) unsigned NOT NULL COMMENT 'èŠ‚ç‚¹ç­‰çº§',
  `data` varchar(255) DEFAULT NULL COMMENT 'é™„åŠ å‚æ•°',
  `sort` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT 'æŽ’åºæƒé‡',
  `display` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT 'èœå•æ˜¾ç¤ºç±»åž‹ 0:ä¸æ˜¾ç¤º 1:å¯¼èˆªèœå• 2:å·¦ä¾§èœå•',
  PRIMARY KEY (`id`),
  KEY `level` (`level`),
  KEY `pid` (`pid`),
  KEY `status` (`status`),
  KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `tp_node` (`id`, `name`, `title`, `status`, `remark`, `pid`, `level`, `data`, `sort`, `display`) VALUES
(1,	'cms',	'æ ¹èŠ‚ç‚¹',	1,	'',	0,	1,	NULL,	0,	0),
(2,	'Site',	'ç«™ç‚¹ç®¡ç†',	1,	'',	1,	0,	NULL,	0,	1),
(3,	'User',	'ç”¨æˆ·ç®¡ç†',	1,	'',	1,	0,	NULL,	0,	1),
(4,	'extent',	'æ‰©å±•ç®¡ç†',	1,	'',	1,	0,	NULL,	10,	1),
(5,	'article',	'å†…å®¹ç®¡ç†',	1,	'',	1,	0,	NULL,	0,	1),
(6,	'Site',	'ç«™ç‚¹è®¾ç½®',	1,	'',	2,	2,	NULL,	0,	2),
(7,	'index',	'åŸºæœ¬ä¿¡æ¯è®¾ç½®',	1,	'',	6,	3,	NULL,	0,	2),
(8,	'safe',	'å®‰å…¨è®¾ç½®',	1,	'',	6,	3,	NULL,	0,	2),
(9,	'email',	'é‚®ç®±è®¾ç½®',	1,	'',	6,	3,	NULL,	0,	2),
(10,	'upfile',	'é™„ä»¶è®¾ç½®',	1,	'',	6,	3,	NULL,	0,	2),
(11,	'Node',	'èŠ‚ç‚¹ç®¡ç†',	1,	NULL,	2,	2,	NULL,	0,	2),
(12,	'add',	'æ·»åŠ èŠ‚ç‚¹',	1,	'',	11,	3,	NULL,	0,	2),
(13,	'index',	'èŠ‚ç‚¹åˆ—è¡¨',	1,	'',	11,	3,	NULL,	0,	2),
(14,	'insert',	'å†™å…¥',	1,	'0',	11,	3,	NULL,	0,	0),
(15,	'edit',	'ç¼–è¾‘èŠ‚ç‚¹',	1,	'0',	11,	3,	NULL,	0,	0),
(16,	'update',	'æ›´æ–°èŠ‚ç‚¹',	1,	'0',	11,	3,	NULL,	0,	0),
(17,	'del',	'åˆ é™¤èŠ‚ç‚¹',	1,	'0',	11,	3,	NULL,	0,	0),
(18,	'User',	'ç”¨æˆ·ä¸­å¿ƒ',	1,	'0',	3,	2,	NULL,	0,	2),
(19,	'add',	'æ·»åŠ ç”¨æˆ·',	1,	'0',	18,	3,	NULL,	0,	2),
(20,	'index',	'ç”¨æˆ·åˆ—è¡¨',	1,	'0',	18,	3,	NULL,	0,	2),
(21,	'edit',	'ç¼–è¾‘ç”¨æˆ·',	1,	'0',	18,	3,	NULL,	0,	0),
(22,	'insert',	'å†™å…¥æ•°æ®åº“',	1,	'0',	18,	3,	NULL,	0,	0),
(23,	'update',	'æ›´æ–°ç”¨æˆ·',	1,	'0',	18,	3,	NULL,	0,	0),
(24,	'del',	'åˆ é™¤ç”¨æˆ·',	1,	'0',	18,	3,	NULL,	0,	0),
(25,	'Group',	'ç®¡ç†ç»„',	1,	'0',	3,	2,	NULL,	0,	2),
(26,	'add',	'åˆ›å»ºç”¨æˆ·ç»„',	1,	'0',	25,	3,	NULL,	0,	2),
(27,	'index',	'ç”¨æˆ·ç»„åˆ—è¡¨',	1,	'0',	25,	3,	NULL,	0,	2),
(28,	'edit',	'ç¼–è¾‘ç”¨æˆ·ç»„',	1,	'0',	25,	3,	NULL,	0,	0),
(29,	'del',	'åˆ é™¤ç”¨æˆ·ç»„',	1,	'0',	25,	3,	NULL,	0,	0),
(30,	'insert',	'å†™å…¥æ•°æ®åº“',	1,	'0',	25,	3,	NULL,	0,	0),
(31,	'update',	'æ›´æ–°ç”¨æˆ·ç»„',	1,	'0',	25,	3,	NULL,	0,	0),
(32,	'insert',	'ä¿å­˜æµ‹è¯•',	1,	'0',	6,	3,	NULL,	0,	0),
(35,	'System',	'é¦–é¡µ',	1,	'0',	2,	2,	NULL,	0,	0),
(36,	'menu',	'å·¦ä¾§æ ',	1,	'0',	35,	3,	NULL,	0,	0),
(37,	'main',	'å³ä¾§æ ç›®',	1,	'0',	35,	3,	NULL,	0,	0),
(38,	'Article',	'å¾®ä¿¡å›¾æ–‡',	1,	'0',	5,	2,	NULL,	0,	2),
(39,	'index',	'å›¾æ–‡åˆ—è¡¨',	1,	'0',	38,	3,	NULL,	0,	2),
(40,	'add',	'å›¾æ–‡æ·»åŠ ',	1,	'0',	38,	3,	NULL,	0,	2),
(41,	'edit',	'å¾®ä¿¡å›¾æ–‡ç¼–è¾‘',	1,	'0',	38,	3,	NULL,	0,	0),
(42,	'del',	'å¾®ä¿¡å›¾æ–‡åˆ é™¤',	1,	'0',	38,	3,	NULL,	0,	0),
(45,	'Function',	'åŠŸèƒ½æ¨¡å—',	1,	'0',	1,	0,	NULL,	0,	1),
(46,	'Function',	'åŠŸèƒ½æ¨¡å—',	1,	'0',	45,	2,	NULL,	0,	2),
(47,	'add',	'æ·»åŠ æ¨¡å—',	1,	'0',	46,	3,	NULL,	0,	2),
(48,	'User_group',	'ä¼šå‘˜ç»„',	1,	'0',	3,	2,	NULL,	0,	2),
(49,	'add',	'æ·»åŠ ä¼šå‘˜ç»„',	1,	'0',	48,	3,	NULL,	0,	2),
(50,	'Users',	'å‰å°ç”¨æˆ·',	1,	'0',	3,	2,	NULL,	0,	2),
(51,	'index',	'ç”¨æˆ·åˆ—è¡¨',	1,	'0',	50,	3,	NULL,	0,	0),
(52,	'add',	'æ·»åŠ ç”¨æˆ·',	1,	'0',	50,	3,	NULL,	0,	2),
(53,	'edit',	'ç¼–è¾‘ç”¨æˆ·',	1,	'0',	50,	3,	NULL,	0,	0),
(54,	'del',	'åˆ é™¤ç”¨æˆ·',	1,	'0',	50,	3,	NULL,	0,	0),
(55,	'insert',	'å†™å…¥æ•°æ®åº“',	1,	'0',	50,	3,	NULL,	0,	0),
(56,	'upsave',	'æ›´æ–°ç”¨æˆ·',	1,	'0',	50,	3,	NULL,	0,	0),
(57,	'Text',	'å¾®ä¿¡æ–‡æœ¬',	1,	'0',	5,	2,	NULL,	0,	2),
(58,	'index',	'æ–‡æœ¬åˆ—è¡¨',	1,	'0',	57,	3,	NULL,	0,	2),
(59,	'del',	'åˆ é™¤',	1,	'0',	57,	3,	NULL,	0,	0),
(60,	'Custom',	'è‡ªå®šä¹‰é¡µé¢',	1,	'0',	5,	2,	NULL,	0,	2),
(61,	'index',	'åˆ—è¡¨',	1,	'0',	60,	3,	NULL,	0,	2),
(62,	'edit',	'ç¼–è¾‘',	1,	'0',	60,	3,	NULL,	0,	0),
(63,	'del',	'åˆ é™¤',	1,	'0',	60,	3,	NULL,	0,	0),
(64,	'Records',	'å……å€¼è®°å½•',	1,	'0',	4,	2,	NULL,	0,	2),
(65,	'index',	'å……å€¼åˆ—è¡¨',	1,	'0',	64,	3,	NULL,	0,	2),
(66,	'Case',	'ç”¨æˆ·æ¡ˆä¾‹',	1,	'0',	4,	2,	NULL,	0,	2),
(67,	'index',	'æ¡ˆä¾‹åˆ—è¡¨',	1,	'0',	66,	3,	NULL,	0,	2),
(68,	'add',	'æ·»åŠ æ¡ˆä¾‹',	1,	'0',	66,	3,	NULL,	0,	2),
(69,	'edit',	'ç¼–è¾‘æ¡ˆä¾‹',	1,	'0',	66,	3,	NULL,	0,	0),
(70,	'del',	'åˆ é™¤æ¡ˆä¾‹',	1,	'0',	66,	3,	NULL,	0,	0),
(71,	'insert',	'å†™å…¥æ•°æ®åº“',	1,	'0',	66,	3,	NULL,	0,	0),
(72,	'upsave',	'æ›´æ–°æ•°æ®åº“',	1,	'0',	66,	3,	NULL,	0,	0),
(73,	'Links',	'å‹æƒ…é“¾æŽ¥',	1,	'0',	4,	2,	NULL,	0,	2),
(74,	'index',	'å‹æƒ…é“¾æŽ¥',	1,	'0',	73,	3,	NULL,	0,	2),
(75,	'add',	'æ·»åŠ é“¾æŽ¥',	1,	'0',	73,	3,	NULL,	0,	2),
(76,	'edit',	'ç¼–è¾‘é“¾æŽ¥',	1,	'0',	73,	3,	NULL,	0,	0),
(77,	'insert',	'æ’å…¥æ•°æ®åº“',	1,	'0',	73,	3,	NULL,	0,	0),
(78,	'upsave',	'æ›´æ–°æ•°æ®åº“',	1,	'0',	73,	3,	NULL,	0,	0),
(79,	'del',	'åˆ é™¤å‹æƒ…é“¾æŽ¥',	1,	'0',	73,	3,	NULL,	0,	0),
(80,	'token',	'å…¬ä¼—å·ç®¡ç†',	1,	'0',	1,	2,	NULL,	0,	1),
(81,	'Token',	'å…¬ä¼—å·ç®¡ç†',	1,	'0',	80,	2,	NULL,	0,	2),
(83,	'alipay',	'åœ¨çº¿æ”¯ä»˜æŽ¥å£',	1,	'0',	6,	3,	NULL,	0,	2),
(84,	'Agent',	'ä»£ç†å•†ç®¡ç†',	1,	'0',	1,	2,	NULL,	0,	1),
(85,	'Agent',	'ä»£ç†å•†ç®¡ç†',	1,	'0',	84,	2,	NULL,	0,	2),
(86,	'add',	'æ·»åŠ ',	1,	'0',	85,	3,	NULL,	0,	2),
(87,	'rippleos_key',	'å¾®WIFIè®¾ç½®',	1,	'0',	6,	3,	NULL,	0,	2),
(88,	'Seo',	'æ–‡ç« ç®¡ç†',	1,	'0',	4,	2,	NULL,	0,	2),
(89,	'index',	'æ–‡ç« åˆ—è¡¨',	1,	'0',	88,	3,	NULL,	0,	2),
(90,	'add',	'æ·»åŠ æ–‡ç« ',	1,	'0',	88,	3,	NULL,	0,	2),
(91,	'sms',	'çŸ­ä¿¡æŽ¥å£è®¾ç½®',	1,	'0',	6,	3,	NULL,	0,	2);

DROP TABLE IF EXISTS `tp_other`;
CREATE TABLE `tp_other` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(60) NOT NULL,
  `keyword` varchar(60) NOT NULL,
  `info` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `tp_token_open`;
CREATE TABLE `tp_token_open` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `token` varchar(60) NOT NULL,
  `access_token` varchar(1000) DEFAULT NULL,
  `jsapi_ticket` varchar(1000) DEFAULT NULL,
  `queryname` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `token` (`token`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `tp_token_open` (`id`, `uid`, `token`, `access_token`, `jsapi_ticket`, `queryname`) VALUES
(213,	1,	'Eioa5C5oj3S32qhH',	'',	NULL,	NULL),
(214,	2,	'ugaCVZBmfnkG6cnr',	NULL,	NULL,	NULL);

DROP TABLE IF EXISTS `tp_tpjl`;
CREATE TABLE `tp_tpjl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `vid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `openid` varchar(1000) NOT NULL,
  `ip` varchar(1000) NOT NULL,
  `timedate` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `tp_upyun_attachement`;
CREATE TABLE `tp_upyun_attachement` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `token` varchar(60) NOT NULL,
  `url` varchar(160) NOT NULL,
  `code` varchar(10) NOT NULL,
  `time` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `token` (`token`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `tp_user_group`;
CREATE TABLE `tp_user_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `taxisid` int(10) NOT NULL DEFAULT '0',
  `name` varchar(30) NOT NULL,
  `diynum` int(11) NOT NULL,
  `connectnum` int(11) NOT NULL,
  `iscopyright` tinyint(1) NOT NULL,
  `activitynum` int(3) NOT NULL,
  `price` int(11) NOT NULL,
  `statistics_user` int(11) NOT NULL,
  `create_card_num` int(4) NOT NULL,
  `wechat_card_num` int(3) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `agentid` int(10) NOT NULL DEFAULT '0',
  `func` varchar(3000) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `tp_user_group` (`id`, `taxisid`, `name`, `diynum`, `connectnum`, `iscopyright`, `activitynum`, `price`, `statistics_user`, `create_card_num`, `wechat_card_num`, `status`, `agentid`, `func`) VALUES
(1,	1,	'vip0',	2000,	2000,	1,	2,	2,	0,	10,	1,	1,	0,	NULL),
(2,	2,	'VIP1',	3000,	3000,	1,	2,	10,	0,	50,	1,	1,	0,	NULL),
(3,	3,	'vip2',	40000,	40000,	1,	4,	150,	0,	80,	2,	1,	0,	NULL),
(4,	4,	'vip3',	50000,	50000,	1,	10000,	200,	0,	1000,	500,	1,	0,	NULL),
(5,	1,	'å¤§ç¥žå¤§ç¥ž',	11,	11,	1,	11,	200,	0,	1,	11,	1,	2,	NULL),
(6,	1,	'123',	1,	1,	1,	1,	1,	0,	1,	1,	1,	1,	NULL),
(7,	5,	'VIP4',	2147483647,	2147483647,	1,	2147483647,	111,	0,	111111,	2147483647,	1,	0,	NULL);

DROP TABLE IF EXISTS `tp_user_request`;
CREATE TABLE `tp_user_request` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(30) NOT NULL,
  `uid` varchar(32) NOT NULL,
  `keyword` varchar(100) NOT NULL,
  `msgtype` varchar(15) NOT NULL DEFAULT 'text',
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `msgtype` (`msgtype`),
  KEY `token` (`token`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `tp_userinfo`;
CREATE TABLE `tp_userinfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `portrait` varchar(200) NOT NULL DEFAULT '',
  `wallopen` tinyint(1) NOT NULL DEFAULT '0',
  `total_score` int(10) NOT NULL DEFAULT '0',
  `expensetotal` int(10) NOT NULL DEFAULT '0',
  `token` varchar(60) NOT NULL,
  `wecha_id` varchar(60) NOT NULL,
  `wechaname` varchar(60) NOT NULL,
  `truename` varchar(60) NOT NULL,
  `tel` varchar(11) NOT NULL,
  `bornyear` varchar(4) NOT NULL DEFAULT '',
  `bornmonth` varchar(4) NOT NULL DEFAULT '',
  `bornday` varchar(4) NOT NULL DEFAULT '',
  `qq` varchar(11) NOT NULL DEFAULT '',
  `sex` tinyint(1) NOT NULL,
  `age` varchar(3) NOT NULL DEFAULT '',
  `birthday` varchar(11) NOT NULL,
  `address` varchar(100) NOT NULL,
  `info` varchar(200) NOT NULL,
  `sign_score` int(11) NOT NULL,
  `expend_score` int(11) NOT NULL,
  `continuous` int(11) NOT NULL,
  `add_expend` int(11) NOT NULL,
  `add_expend_time` int(11) NOT NULL,
  `live_time` int(11) NOT NULL,
  `getcardtime` int(10) NOT NULL,
  `type` varchar(50) DEFAULT NULL,
  `paypass` varchar(32) DEFAULT NULL,
  `balance` double(10,2) unsigned NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`),
  KEY `token` (`token`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `tp_users`;
CREATE TABLE `tp_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `inviter` int(10) NOT NULL DEFAULT '0',
  `agentid` int(10) NOT NULL DEFAULT '0',
  `gid` int(11) NOT NULL,
  `username` varchar(60) NOT NULL,
  `tel` varchar(200) NOT NULL DEFAULT '',
  `password` varchar(32) NOT NULL,
  `email` varchar(200) NOT NULL,
  `createtime` varchar(13) NOT NULL,
  `lasttime` varchar(13) NOT NULL,
  `overtime` varchar(20) NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT '1',
  `sum` varchar(11) NOT NULL DEFAULT '1',
  `gongzhong` varchar(500) NOT NULL,
  `qrimg` varchar(230) NOT NULL,
  `createip` varchar(30) NOT NULL,
  `lastip` varchar(30) NOT NULL,
  `diynum` int(11) NOT NULL,
  `activitynum` int(11) NOT NULL,
  `card_num` int(11) NOT NULL,
  `card_create_status` tinyint(1) NOT NULL,
  `money` int(11) NOT NULL,
  `moneybalance` int(10) NOT NULL DEFAULT '0',
  `spend` int(5) NOT NULL DEFAULT '0',
  `viptime` varchar(13) NOT NULL,
  `connectnum` int(11) NOT NULL DEFAULT '0',
  `lastloginmonth` smallint(2) NOT NULL DEFAULT '0',
  `attachmentsize` int(10) NOT NULL DEFAULT '0',
  `wechat_card_num` int(3) NOT NULL,
  `serviceUserNum` tinyint(3) NOT NULL,
  `invitecode` varchar(6) NOT NULL DEFAULT '',
  `smscount` int(10) NOT NULL DEFAULT '0',
  `tuchuang` int(1) NOT NULL DEFAULT '0',
  `tuaccesskey` varchar(300) DEFAULT NULL,
  `tusecretkey` varchar(300) DEFAULT NULL,
  `tupicid` varchar(100) DEFAULT NULL,
  `duoshuo` int(1) NOT NULL DEFAULT '0',
  `duoshuourl` varchar(50) DEFAULT NULL,
  `hdgd` int(4) NOT NULL DEFAULT '640',
  `hftp` int(1) NOT NULL DEFAULT '1',
  `tpxzmos` int(1) NOT NULL DEFAULT '1',
  `xz1p` int(1) NOT NULL DEFAULT '0',
  `picnum` int(2) NOT NULL DEFAULT '3',
  `yzm` int(1) NOT NULL DEFAULT '0',
  `yzmid` varchar(100) DEFAULT NULL,
  `xzlx` int(1) NOT NULL DEFAULT '0',
  `area` varchar(2000) DEFAULT NULL,
  `ydgzbt` varchar(1000) NOT NULL DEFAULT '如何参与活动',
  `ydgzan` varchar(1000) NOT NULL DEFAULT '详细了解参与方法',
  `dbdhm` varchar(500) DEFAULT NULL,
  `dbdhurl` varchar(1000) DEFAULT NULL,
  `myzps` int(4) NOT NULL DEFAULT '16',
  `tpjl` int(1) DEFAULT '0',
  `tpjlnum` int(4) DEFAULT '1',
  `gldzpid` int(4) DEFAULT '0',
  `spxz` int(1) DEFAULT '0',
  `jgfen` int(8) DEFAULT '60',
  `jgpiao` int(8) DEFAULT '300',
  `jgtext` text,
  `sdfen` int(8) DEFAULT '120',
  `sdpiao` int(8) DEFAULT '600',
  `sdtext` text,
  `zhuangxiu` tinyint(2) NOT NULL DEFAULT '0',
  `zujie` tinyint(2) NOT NULL DEFAULT '0',
  `wuye` tinyint(2) NOT NULL DEFAULT '0',
  `ktv` tinyint(2) NOT NULL DEFAULT '0',
  `weidianshang` tinyint(2) NOT NULL DEFAULT '0',
  `wcx` tinyint(2) NOT NULL DEFAULT '0',
  `whd` tinyint(2) NOT NULL DEFAULT '0',
  `wyx` tinyint(2) NOT NULL DEFAULT '0',
  `wyy` tinyint(2) NOT NULL DEFAULT '1',
  `why` tinyint(2) NOT NULL DEFAULT '0',
  `kf` tinyint(2) NOT NULL DEFAULT '0',
  `huiyuan` tinyint(2) NOT NULL DEFAULT '0',
  `hunqing` tinyint(2) NOT NULL DEFAULT '0',
  `ggk` tinyint(2) NOT NULL DEFAULT '0',
  `dzp` tinyint(2) NOT NULL DEFAULT '0',
  `yhq` tinyint(2) NOT NULL DEFAULT '1',
  `zjd` tinyint(2) NOT NULL DEFAULT '0',
  `sgj` tinyint(2) NOT NULL DEFAULT '0',
  `wxqd` tinyint(2) NOT NULL DEFAULT '0',
  `zfhk` tinyint(2) NOT NULL DEFAULT '0',
  `yiy` tinyint(2) NOT NULL DEFAULT '0',
  `zpq` tinyint(2) NOT NULL DEFAULT '0',
  `yzdd` tinyint(2) NOT NULL DEFAULT '0',
  `zthdbm` tinyint(2) NOT NULL DEFAULT '0',
  `wxq` tinyint(2) NOT NULL DEFAULT '0',
  `wmp` tinyint(2) NOT NULL DEFAULT '0',
  `wdy` tinyint(2) NOT NULL DEFAULT '1',
  `wxc` tinyint(2) NOT NULL DEFAULT '1',
  `wtp` tinyint(2) NOT NULL DEFAULT '1',
  `360qj` tinyint(2) NOT NULL DEFAULT '0',
  `wnbd` tinyint(2) NOT NULL DEFAULT '1',
  `zxyd` tinyint(2) NOT NULL DEFAULT '1',
  `wlt` tinyint(2) NOT NULL DEFAULT '1',
  `wyq` tinyint(2) NOT NULL DEFAULT '0',
  `wsm` tinyint(2) NOT NULL DEFAULT '1',
  `wxt` tinyint(2) NOT NULL DEFAULT '1',
  `qj` tinyint(2) NOT NULL DEFAULT '1',
  `fczj` tinyint(2) NOT NULL DEFAULT '0',
  `zhaopin` tinyint(2) NOT NULL DEFAULT '1',
  `gg` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `tp_users` (`id`, `inviter`, `agentid`, `gid`, `username`, `tel`, `password`, `email`, `createtime`, `lasttime`, `overtime`, `status`, `sum`, `gongzhong`, `qrimg`, `createip`, `lastip`, `diynum`, `activitynum`, `card_num`, `card_create_status`, `money`, `moneybalance`, `spend`, `viptime`, `connectnum`, `lastloginmonth`, `attachmentsize`, `wechat_card_num`, `serviceUserNum`, `invitecode`, `smscount`, `tuchuang`, `tuaccesskey`, `tusecretkey`, `tupicid`, `duoshuo`, `duoshuourl`, `hdgd`, `hftp`, `tpxzmos`, `xz1p`, `picnum`, `yzm`, `yzmid`, `xzlx`, `area`, `ydgzbt`, `ydgzan`, `dbdhm`, `dbdhurl`, `myzps`, `tpjl`, `tpjlnum`, `gldzpid`, `spxz`, `jgfen`, `jgpiao`, `jgtext`, `sdfen`, `sdpiao`, `sdtext`, `zhuangxiu`, `zujie`, `wuye`, `ktv`, `weidianshang`, `wcx`, `whd`, `wyx`, `wyy`, `why`, `kf`, `huiyuan`, `hunqing`, `ggk`, `dzp`, `yhq`, `zjd`, `sgj`, `wxqd`, `zfhk`, `yiy`, `zpq`, `yzdd`, `zthdbm`, `wxq`, `wmp`, `wdy`, `wxc`, `wtp`, `360qj`, `wnbd`, `zxyd`, `wlt`, `wyq`, `wsm`, `wxt`, `qj`, `fczj`, `zhaopin`, `gg`) VALUES
(1,	0,	0,	7,	'admin',	'微应用投票活动',	'0192023a7bbd73250516f069df18b500',	'http://',	'1397994808',	'1463622910',	'2524579200',	'1',	'9999999999',	'weixin',	'http://xxx.com',	'',	'58.221.146.158',	0,	0,	377,	0,	22477,	656,	0,	'2524579200',	0,	5,	103073392,	38,	16,	'',	116042,	0,	'',	'',	'',	0,	'tlds.duoshuo.com',	401,	1,	1,	0,	3,	0,	'9eaa5976363291e95e782a54110421c7',	0,	'池州',	'如何参与活动',	'详细了解参与方法',	'关注我们',	'',	10,	1,	5,	0,	1,	60,	1000,	'拉票频率太高有刷票嫌疑，请分时间段来拉票！',	60,	1000,	'锁定发送给选手的信息内容',	1,	1,	1,	1,	1,	1,	1,	1,	1,	1,	1,	1,	1,	1,	1,	1,	1,	1,	1,	1,	1,	1,	1,	0,	1,	1,	1,	1,	1,	0,	1,	1,	1,	1,	1,	1,	1,	1,	1,	NULL);

DROP TABLE IF EXISTS `tp_vote`;
CREATE TABLE `tp_vote` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `moban` int(2) DEFAULT '1',
  `title` varchar(50) NOT NULL,
  `fxms` varchar(1000) DEFAULT NULL,
  `ydgzts` varchar(1000) DEFAULT NULL,
  `wxgzurl` varchar(1500) DEFAULT NULL,
  `tpnub` int(4) DEFAULT '12',
  `ipnubs` int(4) DEFAULT '4',
  `btcdxz` int(4) DEFAULT '0',
  `keyword` varchar(60) NOT NULL,
  `token` varchar(50) NOT NULL,
  `check` int(10) NOT NULL DEFAULT '0',
  `type` char(5) NOT NULL COMMENT 'text/img æ–‡æœ¬/å›¾ç‰‡',
  `picurl` varchar(500) NOT NULL,
  `wappicurl` varchar(500) NOT NULL,
  `showpic` tinyint(4) NOT NULL COMMENT 'æ˜¯å¦æ˜¾ç¤ºå›¾ç‰‡',
  `info` text COMMENT 'æŠ•ç¥¨è¯´æ˜Ž',
  `statdate` int(11) NOT NULL,
  `enddate` int(11) NOT NULL,
  `start_time` int(11) DEFAULT NULL,
  `over_time` int(11) DEFAULT NULL,
  `cknums` tinyint(3) DEFAULT '1' COMMENT 'æœ€å¤šå¯é€‰æ‹©ï¼Œé»˜è®¤1',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `sl` int(11) NOT NULL,
  `display` tinyint(4) NOT NULL,
  `votelimit` tinyint(4) DEFAULT '1' COMMENT 'æŠ•ç¥¨æ¬¡æ•°é™åˆ¶',
  `qtxinxi` text NOT NULL COMMENT 'å…¶ä»–ä¿¡æ¯',
  `jiangpin` text NOT NULL,
  `cnzz` text NOT NULL,
  `shuma` text,
  `shumat` varchar(2000) DEFAULT NULL,
  `shumb` text,
  `shumbt` varchar(2000) DEFAULT NULL,
  `shumc` text,
  `shumct` varchar(2000) DEFAULT NULL,
  `xntps` int(10) DEFAULT '0',
  `xncheck` int(10) DEFAULT '0',
  `xnbms` int(8) DEFAULT '0',
  `wfbmbz` varchar(2000) DEFAULT NULL,
  `is_sh` int(1) DEFAULT '1',
  `is_sendsms` int(1) NOT NULL DEFAULT '1',
  `sms_content` varchar(500) DEFAULT NULL,
  `gonggao` text,
  `music` varchar(500) DEFAULT NULL,
  `qrwappicurl` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`),
  FULLTEXT KEY `title` (`title`),
  FULLTEXT KEY `keyword` (`keyword`),
  FULLTEXT KEY `token` (`token`),
  FULLTEXT KEY `type` (`type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `tp_vote` (`id`, `moban`, `title`, `fxms`, `ydgzts`, `wxgzurl`, `tpnub`, `ipnubs`, `btcdxz`, `keyword`, `token`, `check`, `type`, `picurl`, `wappicurl`, `showpic`, `info`, `statdate`, `enddate`, `start_time`, `over_time`, `cknums`, `status`, `sl`, `display`, `votelimit`, `qtxinxi`, `jiangpin`, `cnzz`, `shuma`, `shumat`, `shumb`, `shumbt`, `shumc`, `shumct`, `xntps`, `xncheck`, `xnbms`, `wfbmbz`, `is_sh`, `is_sendsms`, `sms_content`, `gonggao`, `music`, `qrwappicurl`) VALUES
(9,	7,	'微应用“晒幸福”赢大奖【深粉系】',	'全国青团网合影晒单赢大奖',	'请关注公众号后台再投票，点击下面的链接快速关注！',	'',	2,	4,	0,	'深粉色',	'Eioa5C5oj3S32qhH',	46,	'img',	'',	'http://0.weiapp.cc/uploads/E/Eioa5C5oj3S32qhH/c/a/b/1/thumb_56e9271ca10ba.jpg',	0,	NULL,	1452873420,	1459356900,	1452873420,	1459356900,	NULL,	1,	0,	0,	1,	'',	'',	'            ',	'&amp;lt;span style=&amp;quot;font-size:14px;&amp;quot;&amp;gt;女人如酒，每瓶酒都有故事，每个女人都是一道靓丽的风景；一杯醇香浓郁的红酒是经过特殊酿造加工而成的，所以说红酒和成熟女人的美是时间和经历所赋予的，葡萄酒比鸡汤更懂你，金色时代葡萄酒愿与成功美丽的你，共同分享灿烂人生。&amp;lt;/span&amp;gt;&amp;lt;br /&amp;gt;',	'活动介绍：',	'&amp;lt;span style=&amp;quot;font-size:14px;line-height:21px;&amp;quot;&amp;gt;&amp;lt;br /&amp;gt;\r\n&amp;lt;/span&amp;gt; \r\n&amp;lt;p&amp;gt;\r\n	&amp;lt;span style=&amp;quot;font-size:14px;line-height:21px;&amp;quot;&amp;gt;&amp;lt;img src=&amp;quot;/uploads/E/Eioa5C5oj3S32qhH/5/e/c/c/56e9273f5a964.jpg&amp;quot; alt=&amp;quot;&amp;quot; /&amp;gt;&amp;lt;br /&amp;gt;\r\n&amp;lt;/span&amp;gt; \r\n&amp;lt;/p&amp;gt;\r\n&amp;lt;p&amp;gt;\r\n	&amp;lt;span style=&amp;quot;font-size:14px;line-height:21px;&amp;quot;&amp;gt;一等奖：（得票数第1名）&amp;lt;/span&amp;gt; \r\n&amp;lt;/p&amp;gt;\r\n&amp;lt;span style=&amp;quot;font-size:14px;line-height:21px;&amp;quot;&amp;gt;价值6199元卡西欧自拍神器TR550一台&amp;lt;br /&amp;gt;\r\n+【胶己人影视】网络爆笑剧《好久没有》女主角&amp;lt;br /&amp;gt;\r\n+价值2399元【揭阳金夫人】唯美个人写真一套&amp;lt;br /&amp;gt;\r\n+价值1500元【笠人部落】桂林动车五天游&amp;lt;br /&amp;gt;\r\n+价值1200元【JULIET流行舞工作室】塑身课程卡&amp;lt;br /&amp;gt;\r\n+【天舟水上乐园】全家欢乐游豪华套票（8人游）一套&amp;lt;br /&amp;gt;\r\n+超级赛冠军荣誉奖杯+荣誉&amp;lt;br /&amp;gt;\r\n&amp;lt;img src=&amp;quot;/uploads/E/Eioa5C5oj3S32qhH/4/2/b/2/56e92751af15f.jpg&amp;quot; alt=&amp;quot;&amp;quot; /&amp;gt;&amp;lt;br /&amp;gt;\r\n二等奖： （得票数第2名）&amp;amp;nbsp;&amp;lt;br /&amp;gt;\r\n价值2199美图手机M4夜拍神器一台&amp;lt;br /&amp;gt;\r\n【胶己人影视】微电影女主角&amp;lt;br /&amp;gt;\r\n+价值1199元【揭阳金夫人】精致个人写真一套&amp;lt;br /&amp;gt;\r\n+价值800元【JULIET流行舞工作室】塑身卡&amp;lt;br /&amp;gt;\r\n+价值500元【笠人部落】厦门汽车三天游&amp;lt;br /&amp;gt;\r\n+【天舟水上乐园】全家欢乐游套票（5人游）一套&amp;lt;br /&amp;gt;\r\n&amp;lt;/span&amp;gt; \r\n&amp;lt;p&amp;gt;\r\n	&amp;lt;span style=&amp;quot;font-size:14px;line-height:21px;&amp;quot;&amp;gt;+超级赛季军定荣誉奖杯+荣誉证书&amp;lt;/span&amp;gt; \r\n&amp;lt;/p&amp;gt;\r\n&amp;lt;p&amp;gt;\r\n	&amp;lt;span style=&amp;quot;font-size:14px;line-height:21px;&amp;quot;&amp;gt;&amp;lt;img src=&amp;quot;/uploads/E/Eioa5C5oj3S32qhH/8/3/7/5/56e9276707dd4.jpg&amp;quot; alt=&amp;quot;&amp;quot; /&amp;gt;&amp;lt;br /&amp;gt;\r\n&amp;lt;/span&amp;gt; \r\n&amp;lt;/p&amp;gt;\r\n&amp;lt;span style=&amp;quot;font-size:14px;line-height:21px;&amp;quot;&amp;gt;三等奖： （得票数第3名）&amp;amp;nbsp;&amp;lt;br /&amp;gt;\r\n价值2199卡西欧自拍神器墨镜MR1一台&amp;lt;br /&amp;gt;\r\n+价值3800元【胶己人影视】剧情MV&amp;lt;br /&amp;gt;\r\n+价值699元【揭阳金夫人】高端写真定制拍摄一套&amp;lt;br /&amp;gt;\r\n+价值600元【JULIET流行舞工作室】爵士舞课程卡一张&amp;lt;br /&amp;gt;\r\n+价值138元【笠人部落】南澳汽车一天游&amp;lt;br /&amp;gt;\r\n+【天舟水上乐园】欢乐亲子游套票（3人游）一套&amp;lt;br /&amp;gt;\r\n+超级赛季军荣誉奖杯+荣誉证书&amp;amp;nbsp;&amp;lt;br /&amp;gt;\r\n&amp;lt;br /&amp;gt;\r\n四等奖：（得票数第4-15名）&amp;amp;nbsp;&amp;lt;br /&amp;gt;\r\n【胶己人影视】网络爆笑剧剧《好久没有》配角&amp;amp;nbsp;&amp;lt;br /&amp;gt;\r\n+价值300元【揭阳汇达数码】现金券&amp;lt;br /&amp;gt;\r\n+价值288元【揭阳金夫人】个人艺术照一套&amp;lt;br /&amp;gt;\r\n+价值80元【笠人部落】旅游现金抵用券&amp;amp;nbsp;&amp;lt;br /&amp;gt;\r\n+【天舟水上乐园】浪漫情侣套票一套&amp;amp;nbsp;&amp;lt;br /&amp;gt;\r\n&amp;lt;/span&amp;gt; \r\n&amp;lt;p&amp;gt;\r\n	&amp;lt;span style=&amp;quot;font-size:14px;line-height:21px;&amp;quot;&amp;gt;+荣誉奖状&amp;lt;br /&amp;gt;\r\n&amp;lt;br /&amp;gt;\r\n&amp;lt;/span&amp;gt; \r\n&amp;lt;/p&amp;gt;\r\n&amp;lt;span style=&amp;quot;font-size:14px;line-height:21px;&amp;quot;&amp;gt;五等奖： （得票数第16-30名）&amp;lt;br /&amp;gt;\r\n价值1000元【胶己人影视】剧情MV抵用金&amp;lt;br /&amp;gt;\r\n+价值480元【揭阳金夫人】产品抵用券&amp;lt;br /&amp;gt;\r\n+价值200元【揭阳汇达数码】现金券&amp;lt;br /&amp;gt;\r\n+价值50元【笠人部落】旅游抵用券&amp;lt;br /&amp;gt;\r\n+【天舟水上乐园】门票一张&amp;lt;br /&amp;gt;\r\n+荣誉奖状&amp;lt;br /&amp;gt;\r\n参与奖（10票以上即送）&amp;amp;nbsp;&amp;lt;br /&amp;gt;\r\n【胶己人影视】MV试镜资格+潮汕首部穿越大片《寻唐记》网络版优先看&amp;lt;br /&amp;gt;\r\n【揭阳天舟水上乐园】门票一张（500张，先到先得）&amp;lt;br /&amp;gt;\r\n免费领取【巴黎万株纱】提供的打底裤一条&amp;lt;br /&amp;gt;\r\n【揭阳汇达数码】购机可送小礼物一份&amp;lt;br /&amp;gt;\r\n+价值288元【揭阳金夫人】产品抵用券&amp;lt;br /&amp;gt;\r\n+价值30元【JULIET流行舞工作室】爵士舞课程1节&amp;lt;br /&amp;gt;\r\n+价值10元【笠人部落】旅游现金抵用券&amp;lt;br /&amp;gt;\r\n分享至朋友圈到店领取小礼物一份（1000份，先到先得）&amp;lt;br /&amp;gt;\r\n&amp;lt;/span&amp;gt;&amp;lt;br /&amp;gt;',	'活动奖品：',	'&amp;lt;span style=&amp;quot;font-size:14px;&amp;quot;&amp;gt;投票无效友情提示：&amp;lt;/span&amp;gt;&amp;lt;br /&amp;gt;\r\n&amp;lt;span style=&amp;quot;font-size:14px;&amp;quot;&amp;gt;1、每人每天对一个选手只能投一票；每天可以帮10个选手投票；&amp;lt;/span&amp;gt;&amp;lt;br /&amp;gt;\r\n&amp;lt;span style=&amp;quot;font-size:14px;&amp;quot;&amp;gt;1、投完票退出公众微信投&amp;lt;/span&amp;gt;&amp;lt;span style=&amp;quot;font-size:14px;font-family:SimHei;&amp;quot;&amp;gt;票无效&amp;lt;/span&amp;gt;&amp;lt;br /&amp;gt;\r\n&amp;lt;span style=&amp;quot;font-size:14px;&amp;quot;&amp;gt;2、外地领取奖品时与工作人员联系&amp;lt;/span&amp;gt;&amp;lt;br /&amp;gt;\r\n&amp;lt;span style=&amp;quot;font-size:14px;&amp;quot;&amp;gt;&amp;amp;nbsp;最后颁奖公示于3月20日&amp;lt;/span&amp;gt;',	'活动规则：',	0,	0,	0,	'若在线报名失败，可以将报名信息：姓名+联系方式+描述+宝贝照片（1~5张，至少1张）发给我们：qq:[填写客服qq]            ',	1,	1,	'您的好友{frend},刚刚您投了一票，您现在总票数为{vcount}，当前排名第{num}名，与第一名相差{diffmaxcount}票，与上一名相差{diffmincount}，继续加油哦！        ',	'',	'',	NULL),
(11,	3,	'微应用“晒幸福”赢大奖【草绿系】',	'',	'请关注公众号后台再投票，点击下面的链接快速关注！',	'',	20,	1,	2,	'草绿色',	'Eioa5C5oj3S32qhH',	3,	'img',	'',	'http://ww2.sinaimg.cn/mw1024/8bd1db32gw1f0bpvflkdjj20hs0bdacy.jpg',	0,	NULL,	1458192600,	1492324200,	1458192600,	1492324200,	NULL,	1,	0,	0,	1,	'',	'',	'   ',	'&amp;lt;span style=&amp;quot;font-size:14px;&amp;quot;&amp;gt;女人如酒，每瓶酒都有故事，每个女人都是一道靓丽的风景；一杯醇香浓郁的红酒是经过特殊酿造加工而成的，所以说红酒和成熟女人的美是时间和经历所赋予的，葡萄酒比鸡汤更懂你，金色时代葡萄酒愿与成功美丽的你，共同分享灿烂人生。&amp;lt;/span&amp;gt;&amp;lt;br /&amp;gt;\r\n&amp;lt;span style=&amp;quot;font-size:14px;&amp;quot;&amp;gt;美，又会赚钱，想把其他人嫉妒死吗！&amp;amp;nbsp;&amp;lt;/span&amp;gt;&amp;lt;br /&amp;gt;\r\n&amp;lt;span style=&amp;quot;font-size:14px;&amp;quot;&amp;gt;没错，这次我们召集全国最美女老板，必须羡煞旁人！只要你是女老板或美女店长（实体店或电商店），秀出你的美照，欢迎马上参加我们这次活动！活动结束我们会评选出最“美”老板娘，通过平台讲述她的故事，为她的店铺做全方位的推广宣传哦！&amp;lt;/span&amp;gt;&amp;lt;br /&amp;gt;\r\n&amp;lt;span style=&amp;quot;font-size:14px;&amp;quot;&amp;gt;活动时间：2016年1月18日-2016年3月18日&amp;lt;/span&amp;gt;&amp;lt;br /&amp;gt;\r\n&amp;lt;span style=&amp;quot;font-size:14px;&amp;quot;&amp;gt;参赛对象：各行各业拥有自营店铺的女老板或美女店长！&amp;lt;/span&amp;gt;&amp;lt;br /&amp;gt;\r\n&amp;lt;span style=&amp;quot;font-size:14px;&amp;quot;&amp;gt;投票人群：全国网民&amp;lt;/span&amp;gt;&amp;lt;br /&amp;gt;\r\n&amp;lt;span style=&amp;quot;font-size:14px;&amp;quot;&amp;gt;参赛方式：&amp;lt;/span&amp;gt;&amp;lt;br /&amp;gt;\r\n&amp;lt;span style=&amp;quot;font-size:14px;&amp;quot;&amp;gt;1、关注公众号：微信——添加朋友——jssdwine或金色时代葡萄酒，关注（或扫描二维码）进入&amp;lt;/span&amp;gt;&amp;lt;br /&amp;gt;\r\n&amp;lt;span style=&amp;quot;font-size:14px;&amp;quot;&amp;gt;2、进入活动页面：回复：投票或者点击自定义菜单上的“最美女老板”！&amp;lt;/span&amp;gt;&amp;lt;br /&amp;gt;\r\n&amp;lt;span style=&amp;quot;font-size:14px;&amp;quot;&amp;gt;3、我要报名：点击自定义菜单上的“我要报名”——填写个人真实信息上传照片——获取个人编号！&amp;lt;/span&amp;gt;&amp;lt;br /&amp;gt;\r\n&amp;lt;span style=&amp;quot;font-size:14px;&amp;quot;&amp;gt;4、我要投票：回复参赛者的报名编号即可成功投票！（注：每个微信号每天可以帮多个人各投一票）&amp;lt;/span&amp;gt;&amp;lt;br /&amp;gt;\r\n&amp;lt;span style=&amp;quot;font-size:14px;&amp;quot;&amp;gt;5、我要拉票：分享自己的个人页面到朋友圈或者微信群，或者直接告诉他们关注我们的公众号后直接回复自己的编号即可成功拉票！&amp;lt;/span&amp;gt;',	'活动介绍：',	'&amp;lt;span style=&amp;quot;font-size:14px;line-height:21px;&amp;quot;&amp;gt;一等奖：1名，人间仙境豪华6日游住葡园酒店豪华大床+金色时代庄园庄主亲自签名窖藏干红一桶+荣誉奖杯&amp;lt;/span&amp;gt;&amp;lt;br /&amp;gt;\r\n&amp;lt;span style=&amp;quot;font-size:14px;line-height:21px;&amp;quot;&amp;gt;二等奖：1名，金色时代庄园庄主亲自签名窖藏干红一桶+荣誉奖杯&amp;lt;/span&amp;gt;&amp;lt;br /&amp;gt;\r\n&amp;lt;span style=&amp;quot;font-size:14px;line-height:21px;&amp;quot;&amp;gt;三等奖：1名，苹果6S手机一部，金色时代庄园珍藏版干红一瓶庄主亲自签名+荣誉奖杯&amp;lt;/span&amp;gt;&amp;lt;br /&amp;gt;\r\n&amp;lt;span style=&amp;quot;font-size:14px;line-height:21px;&amp;quot;&amp;gt;入围奖：20名，洋葱干红一箱+荣誉奖杯&amp;lt;br /&amp;gt;\r\n&amp;lt;div style=&amp;quot;text-align:center;&amp;quot;&amp;gt;\r\n	&amp;lt;img src=&amp;quot;http://i1.tietuku.com/531724099b58bfe3.jpg&amp;quot; alt=&amp;quot;&amp;quot; /&amp;gt; \r\n&amp;lt;/div&amp;gt;\r\n&amp;lt;/span&amp;gt;',	'活动奖品：',	'&amp;lt;span style=&amp;quot;font-size:14px;&amp;quot;&amp;gt;投票无效友情提示：&amp;lt;/span&amp;gt;&amp;lt;br /&amp;gt;\r\n&amp;lt;span style=&amp;quot;font-size:14px;&amp;quot;&amp;gt;1、每人每天对一个选手只能投一票；每天可以帮10个选手投票；&amp;lt;/span&amp;gt;&amp;lt;br /&amp;gt;\r\n&amp;lt;span style=&amp;quot;font-size:14px;&amp;quot;&amp;gt;1、投完票退出公众微信投&amp;lt;/span&amp;gt;&amp;lt;span style=&amp;quot;font-size:14px;font-family:SimHei;&amp;quot;&amp;gt;票无效&amp;lt;/span&amp;gt;&amp;lt;br /&amp;gt;\r\n&amp;lt;span style=&amp;quot;font-size:14px;&amp;quot;&amp;gt;2、外地领取奖品时与工作人员联系&amp;lt;/span&amp;gt;&amp;lt;br /&amp;gt;\r\n&amp;lt;span style=&amp;quot;font-size:14px;&amp;quot;&amp;gt;&amp;amp;nbsp;最后颁奖公示于3月20日&amp;lt;/span&amp;gt;',	'活动规则：',	213,	12322,	123,	'若在线报名失败，可以将报名信息：姓名+联系方式+描述+宝贝照片（1~5张，至少1张）发给我们：qq:[填写客服qq]   ',	1,	1,	'   ',	'',	'',	NULL),
(12,	6,	'微应用“晒幸福”赢大奖【黄色系】',	'微应用“晒幸福”赢大奖【黄色系】',	'微应用“晒幸福”赢大奖【黄色系】',	'http://ww4.sinaimg.cn/mw1024/8bd1db32gw1f0bpqgqnidj20hs0g4afo.jpg',	22,	2,	2,	'黄色',	'Eioa5C5oj3S32qhH',	4,	'img',	'',	'',	0,	NULL,	1458193320,	1492324920,	1458193320,	1492324920,	NULL,	1,	0,	0,	1,	'',	'',	' ',	'&amp;lt;span style=&amp;quot;font-size:14px;line-height:21px;&amp;quot;&amp;gt;女人如酒，每瓶酒都有故事，每个女人都是一道靓丽的风景；一杯醇香浓郁的红酒是经过特殊酿造加工而成的，所以说红酒和成熟女人的美是时间和经历所赋予的，葡萄酒比鸡汤更懂你，金色时代葡萄酒愿与成功美丽的你，共同分享灿烂人生。&amp;lt;/span&amp;gt;',	'活动介绍：',	'&amp;lt;br /&amp;gt;\r\n&amp;lt;div&amp;gt;\r\n	&amp;lt;iframe height=&amp;quot;210&amp;quot; width=&amp;quot;320&amp;quot; src=&amp;quot;http://player.youku.com/embed/XMTQ3NTg5MTg0NA==&amp;quot; frameborder=&amp;quot;0&amp;quot;&amp;gt;\r\n	&amp;lt;/iframe&amp;gt;\r\n&amp;lt;br /&amp;gt;\r\n&amp;lt;/div&amp;gt;',	'活动奖品：',	'&amp;lt;span style=&amp;quot;font-size:14px;line-height:21px;&amp;quot;&amp;gt;1.作品内容为各位萌宝宝的真实照片，参赛报名时填写信息必须是家长的真实手机号码。同一个人不可以使用多个微信号重复报名，如发现重复报名，经查证后只保留最好的照片，取票数最高。若出现相同票数时，将按照报名参加的时间先后排序。&amp;amp;nbsp;&amp;lt;/span&amp;gt;&amp;lt;br /&amp;gt;\r\n&amp;lt;span style=&amp;quot;font-size:14px;line-height:21px;&amp;quot;&amp;gt;2.同一个照片中不可以出现两个或以上参赛选手。如遇到两个或双胞胎或多个在同一张照片中，我们将视为一个人参赛按1个名额颁发奖品。&amp;lt;/span&amp;gt;&amp;lt;br /&amp;gt;\r\n&amp;lt;span style=&amp;quot;font-size:14px;line-height:21px;&amp;quot;&amp;gt;3.本活动有防刷票功能，如投票系统后台发现恶意刷票，第一次将予以警告并扣除所刷票数；第二次发现将直接取消参赛资格。&amp;lt;/span&amp;gt;&amp;lt;br /&amp;gt;\r\n&amp;lt;span style=&amp;quot;font-size:14px;line-height:21px;&amp;quot;&amp;gt;4.为保证活动公平，防止作弊，因此投票需要通过公众号进行操作。&amp;lt;/span&amp;gt;&amp;lt;br /&amp;gt;\r\n&amp;lt;span style=&amp;quot;font-size:14px;line-height:21px;&amp;quot;&amp;gt;5.每个微信号每天可给5名萌娃投票，不可重复投票，第二天可以再投票。&amp;lt;/span&amp;gt;&amp;lt;br /&amp;gt;\r\n&amp;lt;span style=&amp;quot;font-size:14px;line-height:21px;&amp;quot;&amp;gt;6.因投票计票是一个过程，为了维持您的票数正常，我们强烈建议您保持关注公众号！避免不必要的票数异常情况！&amp;amp;nbsp;&amp;lt;/span&amp;gt;&amp;lt;br /&amp;gt;\r\n&amp;lt;span style=&amp;quot;font-size:14px;line-height:21px;&amp;quot;&amp;gt;7.不得盗用别人家宝宝进行比赛，一经发现取消参赛资格。&amp;amp;nbsp;&amp;lt;/span&amp;gt;&amp;lt;br /&amp;gt;\r\n&amp;lt;span style=&amp;quot;font-size:14px;line-height:21px;&amp;quot;&amp;gt;8.请选择并核对好宝宝照片再上传。&amp;amp;nbsp;&amp;lt;/span&amp;gt;&amp;lt;br /&amp;gt;\r\n&amp;lt;span style=&amp;quot;font-size:14px;line-height:21px;&amp;quot;&amp;gt;9.发奖将按照报名时留下的手机号码与获奖用户联系，所以请您一定要核对好报名手机号！不要因此错过大奖哦！&amp;lt;/span&amp;gt;',	'活动规则：',	222,	2421,	12,	'若在线报名失败，可以将报名信息：姓名+联系方式+描述+宝贝照片（1~5张，至少1张）发给我们：qq:[填写客服qq] ',	1,	1,	' ',	'',	'',	NULL),
(13,	5,	'微应用“晒幸福”赢大奖【土豪系】',	'微应用“晒幸福”赢大奖【土豪系】',	'请关注公众号后台再投票，点击下面的链接快速关注！',	'',	12,	12,	2,	'土豪金',	'Eioa5C5oj3S32qhH',	4,	'img',	'',	'http://ww3.sinaimg.cn/mw1024/8bd1db32gw1f0bpqibp4xj20hs0rd45n.jpg',	0,	NULL,	1458193440,	1492325040,	1458193440,	1492325040,	NULL,	1,	0,	0,	1,	'',	'',	' ',	'&amp;lt;span style=&amp;quot;font-size:14px;line-height:21px;&amp;quot;&amp;gt;女人如酒，每瓶酒都有故事，每个女人都是一道靓丽的风景；一杯醇香浓郁的红酒是经过特殊酿造加工而成的，所以说红酒和成熟女人的美是时间和经历所赋予的，葡萄酒比鸡汤更懂你，金色时代葡萄酒愿与成功美丽的你，共同分享灿烂人生。&amp;lt;/span&amp;gt;',	'活动介绍：',	'&amp;lt;span style=&amp;quot;font-size:14px;line-height:21px;&amp;quot;&amp;gt;&amp;lt;img src=&amp;quot;http://i4.tietuku.com/9e8897c2e3906267.jpg&amp;quot; width=&amp;quot;320&amp;quot; height=&amp;quot;342&amp;quot; alt=&amp;quot;&amp;quot; /&amp;gt;&amp;lt;br /&amp;gt;\r\n&amp;lt;/span&amp;gt;&amp;lt;span style=&amp;quot;font-size:14px;&amp;quot;&amp;gt;奖品丰富，名额众多。详情点击右下角菜单查看奖项设置及奖品清单，参与奖可直接领取。&amp;amp;nbsp;&amp;lt;/span&amp;gt;&amp;lt;br /&amp;gt;\r\n&amp;lt;span style=&amp;quot;font-size:14px;&amp;quot;&amp;gt;本次活动增加了投票刮奖的环节，即每投一票都可以获得一次刮奖机会，100%中奖！&amp;amp;nbsp;&amp;lt;/span&amp;gt;&amp;lt;br /&amp;gt;\r\n&amp;lt;span style=&amp;quot;font-size:14px;&amp;quot;&amp;gt;领奖需添加客服微信号：xxxxx，奖品都是包邮的！&amp;lt;/span&amp;gt;&amp;lt;br /&amp;gt;\r\n&amp;lt;span style=&amp;quot;font-size:14px;&amp;quot;&amp;gt;&amp;lt;/span&amp;gt;&amp;lt;br /&amp;gt;',	'活动奖品：',	'&amp;lt;span style=&amp;quot;font-size:14px;line-height:21px;&amp;quot;&amp;gt;1.作品内容为各位宝宝和爸爸的合影，参赛报名时填写信息必须是家长的真实手机号码。同一个人不可以使用多个微信号重复报名，如发现重复报名，经查证后只保留最好的照片，取票数最高。若出现相同票数时，将按照报名参加的时间先后排序。&amp;amp;nbsp;&amp;lt;/span&amp;gt;&amp;lt;br /&amp;gt;\r\n&amp;lt;span style=&amp;quot;font-size:14px;line-height:21px;&amp;quot;&amp;gt;2.同一个照片中不可以出现两个或以上参赛选手。如遇到两个或双胞胎或多个在同一张照片中，我们将视为一个人参赛按1个名额颁发奖品。&amp;lt;/span&amp;gt;&amp;lt;br /&amp;gt;\r\n&amp;lt;span style=&amp;quot;font-size:14px;line-height:21px;&amp;quot;&amp;gt;3.本活动有防刷票功能，如投票系统后台发现恶意刷票，第一次将予以警告并扣除所刷票数；第二次发现将直接取消参赛资格。&amp;lt;/span&amp;gt;&amp;lt;br /&amp;gt;\r\n&amp;lt;span style=&amp;quot;font-size:14px;line-height:21px;&amp;quot;&amp;gt;4.为保证活动公平，防止作弊，因此投票需要通过公众号进行操作。&amp;lt;/span&amp;gt;&amp;lt;br /&amp;gt;\r\n&amp;lt;span style=&amp;quot;font-size:14px;line-height:21px;&amp;quot;&amp;gt;5.每天可给10位选手投票，每个选手仅可投一票。为防止作弊，投票需回复验证码。&amp;lt;/span&amp;gt;&amp;lt;br /&amp;gt;\r\n&amp;lt;span style=&amp;quot;font-size:14px;line-height:21px;&amp;quot;&amp;gt;6.对成功投票后，取消关注的，被投票选手的票数将自动取消。&amp;amp;nbsp;&amp;lt;/span&amp;gt;&amp;lt;br /&amp;gt;\r\n&amp;lt;span style=&amp;quot;font-size:14px;line-height:21px;&amp;quot;&amp;gt;7.不得盗用别人家宝宝进行比赛，一经发现取消参赛资格。&amp;amp;nbsp;&amp;lt;/span&amp;gt;&amp;lt;br /&amp;gt;\r\n&amp;lt;span style=&amp;quot;font-size:14px;line-height:21px;&amp;quot;&amp;gt;8.请选择并核对好孩子与爸爸的合照再上传。&amp;amp;nbsp;&amp;lt;/span&amp;gt;&amp;lt;br /&amp;gt;\r\n&amp;lt;span style=&amp;quot;font-size:14px;line-height:21px;&amp;quot;&amp;gt;9.投票即可获得一次刮奖机会，有众多母婴商家提供的奖品，100%中奖！&amp;lt;/span&amp;gt;&amp;lt;br /&amp;gt;\r\n&amp;lt;a href=&amp;quot;http://m.iniunai.com/&amp;quot; target=&amp;quot;_blank&amp;quot;&amp;gt;&amp;lt;img src=&amp;quot;http://i1.tietuku.com/296816414e9eaa12.jpg&amp;quot; width=&amp;quot;320&amp;quot; height=&amp;quot;100&amp;quot; align=&amp;quot;left&amp;quot; alt=&amp;quot;&amp;quot; /&amp;gt;&amp;lt;/a&amp;gt;',	'活动规则：',	0,	0,	0,	'若在线报名失败，可以将报名信息：姓名+联系方式+描述+宝贝照片（1~5张，至少1张）发给我们：qq:[填写客服qq] ',	0,	0,	' ',	'',	'',	NULL),
(14,	4,	'第一届最美女老板，女同事投票活动【淡蓝】',	'第一届最美女老板，女同事投票活动【淡蓝】',	'请关注公众号后再投票，点击下面的链接快速关注！',	'',	11,	12,	1,	'淡蓝',	'Eioa5C5oj3S32qhH',	2,	'img',	'',	'http://ww2.sinaimg.cn/mw1024/8bd1db32gw1f0bpqfkk9yj20hs0e1gpc.jpg',	0,	NULL,	1458193620,	1492325220,	1458193620,	1492325220,	NULL,	1,	0,	0,	1,	'',	'',	' ',	'&amp;lt;span style=&amp;quot;font-size:14px;line-height:21px;&amp;quot;&amp;gt;女人如酒，每瓶酒都有故事，每个女人都是一道靓丽的风景；一杯醇香浓郁的红酒是经过特殊酿造加工而成的，所以说红酒和成熟女人的美是时间和经历所赋予的，葡萄酒比鸡汤更懂你，金色时代葡萄酒愿与成功美丽的你，共同分享灿烂人生。&amp;lt;/span&amp;gt;',	'活动介绍：',	'&amp;lt;span style=&amp;quot;line-height:21px;font-size:14px;&amp;quot;&amp;gt;&amp;lt;img width=&amp;quot;320&amp;quot; height=&amp;quot;342&amp;quot; alt=&amp;quot;&amp;quot; src=&amp;quot;http://i4.tietuku.com/9e8897c2e3906267.jpg&amp;quot; /&amp;gt;&amp;lt;br /&amp;gt;\r\n&amp;lt;/span&amp;gt;&amp;lt;span style=&amp;quot;font-size:14px;&amp;quot;&amp;gt;奖品丰富，名额众多。详情点击右下角菜单查看奖项设置及奖品清单，参与奖可直接领取。&amp;amp;nbsp;&amp;lt;/span&amp;gt;&amp;lt;br /&amp;gt;\r\n&amp;lt;span style=&amp;quot;font-size:14px;&amp;quot;&amp;gt;本次活动增加了投票刮奖的环节，即每投一票都可以获得一次刮奖机会，100%中奖！&amp;amp;nbsp;&amp;lt;/span&amp;gt;&amp;lt;br /&amp;gt;\r\n&amp;lt;span style=&amp;quot;font-size:14px;&amp;quot;&amp;gt;领奖需添加客服微信号：xxxxx，奖品都是包邮的！&amp;lt;span style=&amp;quot;color:#E56600;&amp;quot;&amp;gt;&amp;amp;nbsp;&amp;lt;span style=&amp;quot;color:#B8D100;&amp;quot;&amp;gt;222&amp;lt;/span&amp;gt;&amp;lt;/span&amp;gt;&amp;lt;/span&amp;gt;&amp;lt;span style=&amp;quot;font-size:14px;&amp;quot;&amp;gt;&amp;lt;/span&amp;gt;&amp;lt;br /&amp;gt;\r\n&amp;lt;div&amp;gt;\r\n	&amp;lt;span style=&amp;quot;font-size:14px;&amp;quot;&amp;gt;&amp;lt;span style=&amp;quot;color:#E56600;&amp;quot;&amp;gt;&amp;lt;span style=&amp;quot;color:#B8D100;&amp;quot;&amp;gt;&amp;lt;br /&amp;gt;\r\n&amp;lt;/span&amp;gt;&amp;lt;/span&amp;gt;&amp;lt;/span&amp;gt;\r\n&amp;lt;/div&amp;gt;',	'活动奖品：',	'&amp;lt;img src=&amp;quot;http://hb.hailaizi.com/uploads/E/Eioa5C5oj3S32qhH/7/9/7/e/56e3c829ad63f.png&amp;quot; alt=&amp;quot;&amp;quot; /&amp;gt;&amp;lt;span&amp;gt;&amp;lt;/span&amp;gt;&amp;lt;span&amp;gt;&amp;lt;/span&amp;gt;\r\n&amp;lt;div style=&amp;quot;text-align:center;&amp;quot;&amp;gt;\r\n	&amp;lt;span style=&amp;quot;color:#E53333;line-height:1.5;font-size:14px;&amp;quot;&amp;gt;1.&amp;lt;/span&amp;gt;&amp;lt;span style=&amp;quot;line-height:1.5;font-size:14px;&amp;quot;&amp;gt;作品内容为各位宝宝和爸爸的合影，参赛报名时填写信息必须是家长的真实手机号码。同一个人不可以使用多个微信号重复报名，如发现重复报名，经查证后只保留最好的照片，取票数最高。若出现相同票数时，将按照报名参加的时间先后排序。&amp;amp;nbsp;&amp;lt;/span&amp;gt;\r\n&amp;lt;/div&amp;gt;\r\n&amp;lt;span style=&amp;quot;font-size:14px;&amp;quot;&amp;gt;\r\n&amp;lt;div style=&amp;quot;text-align:center;&amp;quot;&amp;gt;\r\n	&amp;lt;span style=&amp;quot;line-height:1.5;&amp;quot;&amp;gt;2.同一个照片中不可以出现两个或以上参赛选手。如遇到两个或双胞胎或多个在同一张照片中，我们将视为一个人参赛按1个名额颁发奖品。&amp;lt;/span&amp;gt;\r\n&amp;lt;/div&amp;gt;\r\n&amp;lt;div style=&amp;quot;text-align:center;&amp;quot;&amp;gt;\r\n	&amp;lt;span style=&amp;quot;line-height:1.5;&amp;quot;&amp;gt;3.本活动有防刷票功能，如投票系统后台发现恶意刷票，第一次将予以警告并扣除所刷票数；第二次发现将直接取消参赛资格。&amp;lt;/span&amp;gt;\r\n&amp;lt;/div&amp;gt;\r\n&amp;lt;/span&amp;gt;&amp;lt;span&amp;gt;&amp;lt;/span&amp;gt;\r\n&amp;lt;p&amp;gt;\r\n	&amp;lt;span style=&amp;quot;font-size:14px;&amp;quot;&amp;gt;4.为保证活动公平，防止作弊，因此投票需要通过公众号进行操作。&amp;lt;/span&amp;gt;\r\n&amp;lt;/p&amp;gt;\r\n&amp;lt;span style=&amp;quot;font-size:14px;&amp;quot;&amp;gt;5.每天可给10位选手投票，每个选手仅可投一票。为防止作弊，投票需回复验证码。&amp;lt;br /&amp;gt;\r\n6.对成功投票后，取消关注的，被投票选手的票数将自动取消。&amp;amp;nbsp;&amp;lt;br /&amp;gt;\r\n7.不得盗用别人家宝宝进行比赛，一经发现取消参赛资格。&amp;amp;nbsp;&amp;lt;br /&amp;gt;\r\n8.请选择并核对好孩子与爸爸的合照再上传。&amp;amp;nbsp;&amp;lt;br /&amp;gt;\r\n&amp;lt;/span&amp;gt;&amp;lt;span&amp;gt;&amp;lt;/span&amp;gt;\r\n&amp;lt;p&amp;gt;\r\n	&amp;lt;span style=&amp;quot;font-size:14px;&amp;quot;&amp;gt;9.投票即可获得一次刮奖机会，有众多母婴商家提供的奖品，100%中奖！&amp;amp;nbsp;&amp;lt;/span&amp;gt;\r\n&amp;lt;/p&amp;gt;\r\n&amp;lt;p&amp;gt;\r\n	&amp;lt;span style=&amp;quot;font-size:14px;&amp;quot;&amp;gt;&amp;lt;img alt=&amp;quot;&amp;quot; src=&amp;quot;http://i4.tietuku.com/505fef9a31a6f1a5.gif&amp;quot; /&amp;gt;&amp;lt;/span&amp;gt;\r\n&amp;lt;/p&amp;gt;',	'活动规则：',	12,	32,	12,	'若在线报名失败，可以将报名信息：姓名+联系方式+描述+宝贝照片（1~5张，至少1张）发给我们：qq:[填写客服qq] ',	0,	0,	' ',	'',	'',	NULL),
(15,	1,	'微应用“晒幸福”赢大奖【深粉色】',	'微应用“晒幸福”赢大奖【深粉色】',	'请关注公众号后再投票，点击下面的链接快速关注！',	'',	2,	2,	1,	'粉色',	'Eioa5C5oj3S32qhH',	6,	'img',	'',	'http://ww3.sinaimg.cn/mw1024/8bd1db32gw1f0bpqibp4xj20hs0rd45n.jpg',	0,	NULL,	1458193800,	1492325400,	1458193800,	1492325400,	NULL,	1,	0,	0,	1,	'',	'',	'   ',	'&amp;lt;span style=&amp;quot;font-size:14px;line-height:21px;&amp;quot;&amp;gt;女人如酒，每瓶酒都有故事，每个女人都是一道靓丽的风景；一杯醇香浓郁的红酒是经过特殊酿造加工而成的，所以说红酒和成熟女人的美是时间和经历所赋予的，葡萄酒比鸡汤更懂你，金色时代葡萄酒愿与成功美丽的你，共同分享灿烂人生。&amp;lt;/span&amp;gt;',	'活动介绍：',	'&amp;lt;span style=&amp;quot;font-size:14px;line-height:21px;&amp;quot;&amp;gt;&amp;lt;img src=&amp;quot;http://i4.tietuku.com/9e8897c2e3906267.jpg&amp;quot; width=&amp;quot;320&amp;quot; height=&amp;quot;342&amp;quot; alt=&amp;quot;&amp;quot; /&amp;gt;&amp;lt;br /&amp;gt;\r\n&amp;lt;/span&amp;gt;&amp;lt;span style=&amp;quot;font-size:14px;&amp;quot;&amp;gt;奖品丰富，名额众多。详情点击右下角菜单查看奖项设置及奖品清单，参与奖可直接领取。&amp;amp;nbsp;&amp;lt;/span&amp;gt;&amp;lt;br /&amp;gt;\r\n&amp;lt;span style=&amp;quot;font-size:14px;&amp;quot;&amp;gt;本次活动增加了投票刮奖的环节，即每投一票都可以获得一次刮奖机会，100%中奖！&amp;amp;nbsp;&amp;lt;/span&amp;gt;&amp;lt;br /&amp;gt;\r\n&amp;lt;span style=&amp;quot;font-size:14px;&amp;quot;&amp;gt;领奖需添加客服微信号：xxxxx，奖品都是包邮的！&amp;lt;/span&amp;gt;&amp;lt;br /&amp;gt;\r\n&amp;lt;span style=&amp;quot;font-size:14px;&amp;quot;&amp;gt;&amp;lt;/span&amp;gt;&amp;lt;br /&amp;gt;',	'活动奖品：',	'&amp;lt;span style=&amp;quot;font-size:14px;line-height:21px;&amp;quot;&amp;gt;1.作品内容为各位宝宝和爸爸的合影，参赛报名时填写信息必须是家长的真实手机号码。同一个人不可以使用多个微信号重复报名，如发现重复报名，经查证后只保留最好的照片，取票数最高。若出现相同票数时，将按照报名参加的时间先后排序。&amp;amp;nbsp;&amp;lt;/span&amp;gt;&amp;lt;br /&amp;gt;\r\n&amp;lt;span style=&amp;quot;font-size:14px;line-height:21px;&amp;quot;&amp;gt;2.同一个照片中不可以出现两个或以上参赛选手。如遇到两个或双胞胎或多个在同一张照片中，我们将视为一个人参赛按1个名额颁发奖品。&amp;lt;/span&amp;gt;&amp;lt;br /&amp;gt;\r\n&amp;lt;span style=&amp;quot;font-size:14px;line-height:21px;&amp;quot;&amp;gt;3.本活动有防刷票功能，如投票系统后台发现恶意刷票，第一次将予以警告并扣除所刷票数；第二次发现将直接取消参赛资格。&amp;lt;/span&amp;gt;&amp;lt;br /&amp;gt;\r\n&amp;lt;span style=&amp;quot;font-size:14px;line-height:21px;&amp;quot;&amp;gt;4.为保证活动公平，防止作弊，因此投票需要通过公众号进行操作。&amp;lt;/span&amp;gt;&amp;lt;br /&amp;gt;\r\n&amp;lt;span style=&amp;quot;font-size:14px;line-height:21px;&amp;quot;&amp;gt;5.每天可给10位选手投票，每个选手仅可投一票。为防止作弊，投票需回复验证码。&amp;lt;/span&amp;gt;&amp;lt;br /&amp;gt;\r\n&amp;lt;span style=&amp;quot;font-size:14px;line-height:21px;&amp;quot;&amp;gt;6.对成功投票后，取消关注的，被投票选手的票数将自动取消。&amp;amp;nbsp;&amp;lt;/span&amp;gt;&amp;lt;br /&amp;gt;\r\n&amp;lt;span style=&amp;quot;font-size:14px;line-height:21px;&amp;quot;&amp;gt;7.不得盗用别人家宝宝进行比赛，一经发现取消参赛资格。&amp;amp;nbsp;&amp;lt;/span&amp;gt;&amp;lt;br /&amp;gt;\r\n&amp;lt;span style=&amp;quot;font-size:14px;line-height:21px;&amp;quot;&amp;gt;8.请选择并核对好孩子与爸爸的合照再上传。&amp;amp;nbsp;&amp;lt;/span&amp;gt;&amp;lt;br /&amp;gt;\r\n&amp;lt;span style=&amp;quot;font-size:14px;line-height:21px;&amp;quot;&amp;gt;9.投票即可获得一次刮奖机会，有众多母婴商家提供的奖品，100%中奖！&amp;lt;/span&amp;gt;&amp;lt;br /&amp;gt;\r\n&amp;lt;a href=&amp;quot;http://m.iniunai.com/&amp;quot; target=&amp;quot;_blank&amp;quot;&amp;gt;&amp;lt;img src=&amp;quot;http://i1.tietuku.com/296816414e9eaa12.jpg&amp;quot; width=&amp;quot;320&amp;quot; height=&amp;quot;100&amp;quot; align=&amp;quot;left&amp;quot; alt=&amp;quot;&amp;quot; /&amp;gt;&amp;lt;/a&amp;gt;',	'活动规则：',	12,	3233,	3,	'若在线报名失败，可以将报名信息：姓名+联系方式+描述+宝贝照片（1~5张，至少1张）发给我们：qq:[填写客服qq]   ',	0,	0,	'   ',	'',	'',	NULL),
(16,	8,	'微应用投票活动【清新系】',	'微应用投票活动【清新系】',	'请关注公众号后台再投票，点击下面的链接快速关注！',	'',	20,	12,	2,	'投票',	'Eioa5C5oj3S32qhH',	9,	'img',	'',	'http://ww3.sinaimg.cn/mw1024/8bd1db32gw1f0bpqibp4xj20hs0rd45n.jpg',	0,	NULL,	1458194040,	1492325640,	1458194040,	1492325640,	NULL,	1,	0,	0,	1,	'',	'',	'   ',	'&amp;lt;span style=&amp;quot;font-size:14px;line-height:21px;&amp;quot;&amp;gt;女人如酒，每瓶酒都有故事，每个女人都是一道靓丽的风景；一杯醇香浓郁的红酒是经过特殊酿造加工而成的，所以说红酒和成熟女人的美是时间和经历所赋予的，葡萄酒比鸡汤更懂你，金色时代葡萄酒愿与成功美丽的你，共同分享灿烂人生。&amp;lt;/span&amp;gt;',	'活动介绍：',	'&amp;lt;span style=&amp;quot;line-height:21px;font-size:14px;&amp;quot;&amp;gt;&amp;lt;img width=&amp;quot;320&amp;quot; height=&amp;quot;342&amp;quot; alt=&amp;quot;&amp;quot; src=&amp;quot;http://i4.tietuku.com/9e8897c2e3906267.jpg&amp;quot; /&amp;gt;&amp;lt;br /&amp;gt;\r\n&amp;lt;/span&amp;gt;&amp;lt;span style=&amp;quot;font-size:14px;&amp;quot;&amp;gt;奖品丰富，名额众多。详情点击右下角菜单查看奖项设置及奖品清单，参与奖可直接领取。&amp;amp;nbsp;&amp;lt;/span&amp;gt;&amp;lt;br /&amp;gt;\r\n&amp;lt;span style=&amp;quot;font-size:14px;&amp;quot;&amp;gt;本次活动增加了投票刮奖的环节，即每投一票都可以获得一次刮奖机会，100%中奖！&amp;amp;nbsp;&amp;lt;/span&amp;gt;&amp;lt;br /&amp;gt;\r\n&amp;lt;span style=&amp;quot;font-size:14px;&amp;quot;&amp;gt;领奖需添加客服微信号：xxxxx，奖品都是包邮的！&amp;lt;span style=&amp;quot;color:#E56600;&amp;quot;&amp;gt;&amp;amp;nbsp;&amp;lt;span style=&amp;quot;color:#B8D100;&amp;quot;&amp;gt;222&amp;lt;/span&amp;gt;&amp;lt;/span&amp;gt;&amp;lt;/span&amp;gt;&amp;lt;span style=&amp;quot;font-size:14px;&amp;quot;&amp;gt;&amp;lt;/span&amp;gt;&amp;lt;br /&amp;gt;\r\n&amp;lt;div&amp;gt;\r\n	&amp;lt;span style=&amp;quot;font-size:14px;&amp;quot;&amp;gt;&amp;lt;span style=&amp;quot;color:#E56600;&amp;quot;&amp;gt;&amp;lt;span style=&amp;quot;color:#B8D100;&amp;quot;&amp;gt;&amp;lt;br /&amp;gt;\r\n&amp;lt;/span&amp;gt;&amp;lt;/span&amp;gt;&amp;lt;/span&amp;gt; \r\n&amp;lt;/div&amp;gt;',	'活动奖品：',	'&amp;lt;img src=&amp;quot;http://hb.hailaizi.com/uploads/E/Eioa5C5oj3S32qhH/7/9/7/e/56e3c829ad63f.png&amp;quot; alt=&amp;quot;&amp;quot; /&amp;gt;&amp;lt;span&amp;gt;&amp;lt;/span&amp;gt;&amp;lt;span&amp;gt;&amp;lt;/span&amp;gt; \r\n&amp;lt;div style=&amp;quot;text-align:center;&amp;quot;&amp;gt;\r\n	&amp;lt;span style=&amp;quot;color:#E53333;line-height:1.5;font-size:14px;&amp;quot;&amp;gt;1.&amp;lt;/span&amp;gt;&amp;lt;span style=&amp;quot;line-height:1.5;font-size:14px;&amp;quot;&amp;gt;作品内容为各位宝宝和爸爸的合影，参赛报名时填写信息必须是家长的真实手机号码。同一个人不可以使用多个微信号重复报名，如发现重复报名，经查证后只保留最好的照片，取票数最高。若出现相同票数时，将按照报名参加的时间先后排序。&amp;amp;nbsp;&amp;lt;/span&amp;gt; \r\n&amp;lt;/div&amp;gt;\r\n&amp;lt;span style=&amp;quot;font-size:14px;&amp;quot;&amp;gt; \r\n&amp;lt;div style=&amp;quot;text-align:center;&amp;quot;&amp;gt;\r\n	&amp;lt;span style=&amp;quot;line-height:1.5;&amp;quot;&amp;gt;2.同一个照片中不可以出现两个或以上参赛选手。如遇到两个或双胞胎或多个在同一张照片中，我们将视为一个人参赛按1个名额颁发奖品。&amp;lt;/span&amp;gt; \r\n&amp;lt;/div&amp;gt;\r\n&amp;lt;div style=&amp;quot;text-align:center;&amp;quot;&amp;gt;\r\n	&amp;lt;span style=&amp;quot;line-height:1.5;&amp;quot;&amp;gt;3.本活动有防刷票功能，如投票系统后台发现恶意刷票，第一次将予以警告并扣除所刷票数；第二次发现将直接取消参赛资格。&amp;lt;/span&amp;gt; \r\n&amp;lt;/div&amp;gt;\r\n&amp;lt;/span&amp;gt;&amp;lt;span&amp;gt;&amp;lt;/span&amp;gt; \r\n&amp;lt;p&amp;gt;\r\n	&amp;lt;span style=&amp;quot;font-size:14px;&amp;quot;&amp;gt;4.为保证活动公平，防止作弊，因此投票需要通过公众号进行操作。&amp;lt;/span&amp;gt; \r\n&amp;lt;/p&amp;gt;\r\n&amp;lt;span style=&amp;quot;font-size:14px;&amp;quot;&amp;gt;5.每天可给10位选手投票，每个选手仅可投一票。为防止作弊，投票需回复验证码。&amp;lt;br /&amp;gt;\r\n6.对成功投票后，取消关注的，被投票选手的票数将自动取消。&amp;amp;nbsp;&amp;lt;br /&amp;gt;\r\n7.不得盗用别人家宝宝进行比赛，一经发现取消参赛资格。&amp;amp;nbsp;&amp;lt;br /&amp;gt;\r\n8.请选择并核对好孩子与爸爸的合照再上传。&amp;amp;nbsp;&amp;lt;br /&amp;gt;\r\n&amp;lt;/span&amp;gt;&amp;lt;span&amp;gt;&amp;lt;/span&amp;gt; \r\n&amp;lt;p&amp;gt;\r\n	&amp;lt;span style=&amp;quot;font-size:14px;&amp;quot;&amp;gt;9.投票即可获得一次刮奖机会，有众多母婴商家提供的奖品，100%中奖！&amp;amp;nbsp;&amp;lt;/span&amp;gt; \r\n&amp;lt;/p&amp;gt;\r\n&amp;lt;p&amp;gt;\r\n	&amp;lt;span style=&amp;quot;font-size:14px;&amp;quot;&amp;gt;&amp;lt;img alt=&amp;quot;&amp;quot; src=&amp;quot;http://i4.tietuku.com/505fef9a31a6f1a5.gif&amp;quot; /&amp;gt;&amp;lt;/span&amp;gt; \r\n&amp;lt;/p&amp;gt;',	'活动规则：',	12,	12234,	12,	'若在线报名失败，可以将报名信息：姓名+联系方式+描述+宝贝照片（1~5张，至少1张）发给我们：qq:[填写客服qq]   ',	0,	0,	'   ',	'',	'',	NULL);

DROP TABLE IF EXISTS `tp_vote_item`;
CREATE TABLE `tp_vote_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vid` int(11) NOT NULL COMMENT 'vote_id',
  `item` varchar(50) NOT NULL,
  `dcount` int(11) DEFAULT '0' COMMENT 'å–æ¶ˆå…³æ³¨å¤±åŽ»ç¥¨æ•°',
  `vcount` int(11) NOT NULL,
  `startpicurl` varchar(200) DEFAULT NULL,
  `startpicurl2` varchar(200) DEFAULT NULL,
  `startpicurl3` varchar(200) DEFAULT NULL,
  `startpicurl4` varchar(200) DEFAULT NULL,
  `startpicurl5` varchar(200) DEFAULT NULL,
  `tourl` varchar(200) NOT NULL DEFAULT '',
  `rank` int(4) unsigned NOT NULL DEFAULT '200' COMMENT 'æŽ’åº',
  `intro` text NOT NULL COMMENT 'é€‰é¡¹ä»‹ç»',
  `wechat` text NOT NULL,
  `status` smallint(2) NOT NULL DEFAULT '0' COMMENT 'å®¡æ ¸çŠ¶æ€ 0-æœªå®¡æ ¸ 1-å®¡æ ¸åŒæ„Ÿ 2 é”å®š',
  `wechat_id` varchar(100) DEFAULT NULL COMMENT 'å¾®ä¿¡id',
  `addtime` int(10) DEFAULT NULL COMMENT 'æ·»åŠ æ—¶é—´',
  `lockinfo` varchar(260) DEFAULT NULL COMMENT 'é”å®šå›žå¤',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `tp_vote_record`;
CREATE TABLE `tp_vote_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` varchar(50) NOT NULL COMMENT 'æŠ•ç¥¨é¡¹ 1,2,3,',
  `vid` int(11) NOT NULL,
  `wecha_id` varchar(100) NOT NULL,
  `touched` tinyint(4) NOT NULL,
  `touch_time` int(11) NOT NULL COMMENT 'æŠ•ç¥¨æ—¥æœŸ',
  `token` varchar(50) NOT NULL DEFAULT '',
  `ip` varchar(300) DEFAULT NULL,
  `area` varchar(500) DEFAULT NULL,
  `qxgzys` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `tp_vote_record` (`id`, `item_id`, `vid`, `wecha_id`, `touched`, `touch_time`, `token`, `ip`, `area`, `qxgzys`) VALUES
(992,	'1',	4,	'oUzB4uO1EegVRpWHasVGyyO6WALM',	1,	1452843180,	'Eioa5C5oj3S32qhH',	'122.96.186.192',	'江苏盐城',	1),
(993,	'1',	4,	'oUzB4uO1EegVRpWHasVGyyO6WALM',	1,	1452843180,	'Eioa5C5oj3S32qhH',	'122.96.186.192',	'江苏盐城',	1),
(994,	'52',	9,	'oUzB4uO1EegVRpWHasVGyyO6WALM',	1,	1452920654,	'Eioa5C5oj3S32qhH',	'122.96.186.192',	'江苏盐城',	1),
(995,	'60',	9,	'oUzB4uO1EegVRpWHasVGyyO6WALM',	1,	1452921183,	'Eioa5C5oj3S32qhH',	'122.96.47.171',	'江苏苏州',	1),
(996,	'43',	8,	'oUzB4uO1EegVRpWHasVGyyO6WALM',	1,	1452921256,	'Eioa5C5oj3S32qhH',	'122.96.47.171',	'江苏苏州',	1),
(997,	'29',	6,	'oUzB4uO1EegVRpWHasVGyyO6WALM',	1,	1452921280,	'Eioa5C5oj3S32qhH',	'122.96.47.171',	'江苏苏州',	1),
(998,	'17',	5,	'oUzB4uPtTN33ZwSzsPkeC5hG3ihA',	1,	1452941483,	'Eioa5C5oj3S32qhH',	'14.134.26.45',	'宁夏银川',	1),
(999,	'17',	5,	'oUzB4uPtTN33ZwSzsPkeC5hG3ihA',	1,	1452941493,	'Eioa5C5oj3S32qhH',	'14.134.26.45',	'宁夏银川',	1),
(1000,	'61',	9,	'oUzB4uNFMO3KXCZGe7TCDHCY_7es',	1,	1452953119,	'Eioa5C5oj3S32qhH',	'222.64.64.150',	'上海上海',	0),
(1001,	'67',	10,	'oUzB4uNFMO3KXCZGe7TCDHCY_7es',	1,	1452953545,	'Eioa5C5oj3S32qhH',	'222.64.64.150',	'上海上海',	0),
(1002,	'29',	6,	'oUzB4uO1EegVRpWHasVGyyO6WALM',	1,	1453639545,	'Eioa5C5oj3S32qhH',	'58.241.221.55',	'江苏盐城',	1),
(1003,	'40',	7,	'oUzB4uO1EegVRpWHasVGyyO6WALM',	1,	1453639639,	'Eioa5C5oj3S32qhH',	'****',	'回复投票',	1),
(1004,	'60',	9,	'oUzB4uO1EegVRpWHasVGyyO6WALM',	1,	1453640203,	'Eioa5C5oj3S32qhH',	'58.241.221.55',	'江苏盐城',	0),
(1005,	'44',	8,	'oUzB4uF4TV9h2ZDbZTLCaWE4gXmo',	1,	1453641870,	'Eioa5C5oj3S32qhH',	'115.206.59.157',	'浙江杭州',	0),
(1006,	'49',	8,	'oUzB4uF4TV9h2ZDbZTLCaWE4gXmo',	1,	1453641927,	'Eioa5C5oj3S32qhH',	'115.206.59.157',	'浙江杭州',	0),
(1007,	'1',	9,	'oqBbVs1nwAfQq_-FDzM8PV_ibtR4',	1,	1458120046,	'Eioa5C5oj3S32qhH',	'122.83.241.155',	'安徽池州',	1),
(1008,	'2',	16,	'oqBbVs1nwAfQq_-FDzM8PV_ibtR4',	1,	1458210362,	'Eioa5C5oj3S32qhH',	'122.83.241.155',	'安徽池州',	0);

DROP TABLE IF EXISTS `tp_wechat_group_list`;
CREATE TABLE `tp_wechat_group_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `g_id` varchar(20) NOT NULL DEFAULT '',
  `nickname` varchar(60) NOT NULL,
  `sex` tinyint(1) NOT NULL,
  `province` varchar(20) NOT NULL DEFAULT '',
  `city` varchar(30) NOT NULL,
  `headimgurl` varchar(200) NOT NULL,
  `subscribe_time` int(11) NOT NULL,
  `token` varchar(30) NOT NULL,
  `openid` varchar(60) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `tp_wehcat_member_enddate`;
CREATE TABLE `tp_wehcat_member_enddate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `openid` varchar(60) NOT NULL,
  `enddate` int(11) NOT NULL,
  `joinUpDate` int(11) NOT NULL DEFAULT '0',
  `uid` int(11) NOT NULL DEFAULT '0',
  `token` varchar(40) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `tp_wxuser`;
CREATE TABLE `tp_wxuser` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `routerid` varchar(50) NOT NULL,
  `uid` int(11) NOT NULL,
  `wxname` varchar(60) NOT NULL COMMENT 'å…¬ä¼—å·åç§°',
  `winxintype` smallint(2) NOT NULL DEFAULT '1',
  `appid` varchar(50) NOT NULL DEFAULT '',
  `appsecret` varchar(50) NOT NULL DEFAULT '',
  `wxid` varchar(20) NOT NULL COMMENT 'å…¬ä¼—å·åŽŸå§‹ID',
  `weixin` char(20) NOT NULL COMMENT 'å¾®ä¿¡å·',
  `headerpic` char(255) NOT NULL COMMENT 'å¤´åƒåœ°å€',
  `token` char(255) NOT NULL,
  `province` varchar(30) NOT NULL COMMENT 'çœ',
  `city` varchar(60) NOT NULL COMMENT 'å¸‚',
  `qq` char(25) NOT NULL COMMENT 'å…¬ä¼—å·é‚®ç®±',
  `wxfans` int(11) NOT NULL COMMENT 'å¾®ä¿¡ç²‰ä¸',
  `typeid` int(11) NOT NULL COMMENT 'åˆ†ç±»ID',
  `typename` varchar(90) NOT NULL DEFAULT '0' COMMENT 'åˆ†ç±»å',
  `tongji` text NOT NULL,
  `allcardnum` int(11) NOT NULL,
  `cardisok` int(11) NOT NULL,
  `yetcardnum` int(11) NOT NULL,
  `totalcardnum` int(11) NOT NULL,
  `createtime` varchar(13) NOT NULL,
  `tpltypeid` varchar(255) NOT NULL DEFAULT '1' COMMENT 'é»˜è®¤é¦–é¡µæ¨¡ç‰ˆID',
  `updatetime` varchar(13) NOT NULL,
  `tpltypename` varchar(255) NOT NULL,
  `tpllistid` varchar(2) NOT NULL COMMENT 'åˆ—è¡¨æ¨¡ç‰ˆID',
  `tpllistname` varchar(20) NOT NULL COMMENT 'åˆ—è¡¨æ¨¡ç‰ˆå',
  `tplcontentid` varchar(2) NOT NULL COMMENT 'å†…å®¹æ¨¡ç‰ˆID',
  `tplcontentname` varchar(20) NOT NULL COMMENT 'å†…å®¹æ¨¡ç‰ˆå',
  `transfer_customer_service` tinyint(1) NOT NULL DEFAULT '0',
  `color_id` int(2) NOT NULL,
  `phone` text NOT NULL,
  `smsstatus` text NOT NULL,
  `smsuser` text NOT NULL,
  `smspassword` text NOT NULL,
  `email` text NOT NULL,
  `emailstatus` text NOT NULL,
  `emailuser` text NOT NULL,
  `emailpassword` text NOT NULL,
  `username` text NOT NULL,
  `printstatus` int(1) DEFAULT '0',
  `member_code` varchar(50) DEFAULT NULL,
  `feiyin_key` varchar(50) DEFAULT NULL,
  `device_no` varchar(50) DEFAULT NULL,
  `agentid` int(10) NOT NULL DEFAULT '0',
  `shoptpltypeid` varchar(20) NOT NULL,
  `shoptpltypename` varchar(255) NOT NULL,
  `oauth` tinyint(1) NOT NULL DEFAULT '0',
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `tp_wxuser` (`id`, `routerid`, `uid`, `wxname`, `winxintype`, `appid`, `appsecret`, `wxid`, `weixin`, `headerpic`, `token`, `province`, `city`, `qq`, `wxfans`, `typeid`, `typename`, `tongji`, `allcardnum`, `cardisok`, `yetcardnum`, `totalcardnum`, `createtime`, `tpltypeid`, `updatetime`, `tpltypename`, `tpllistid`, `tpllistname`, `tplcontentid`, `tplcontentname`, `transfer_customer_service`, `color_id`, `phone`, `smsstatus`, `smsuser`, `smspassword`, `email`, `emailstatus`, `emailuser`, `emailpassword`, `username`, `printstatus`, `member_code`, `feiyin_key`, `device_no`, `agentid`, `shoptpltypeid`, `shoptpltypename`, `oauth`, `password`) VALUES
(1,	'',	1,	'comheart',	1,	'wx784cb469f6844c',	'6f003f1a3b9b3f7ba2e351c606fdf233',	'1',	'COOLADLB',	'./tpl/User/default/common/images/portrait.jpg',	'Eioa5C5oj3S32qhH',	'1',	'1',	'183345531@qq.com',	0,	1,	'æƒ…æ„Ÿ',	'',	1000,	1,	0,	0,	'1414375225',	'1',	'1414375225',	'ty_index',	'1',	'yl_list',	'1',	'ktv_content',	0,	0,	'',	'',	'',	'',	'',	'',	'',	'',	'',	0,	NULL,	NULL,	NULL,	0,	'1',	'ty_index',	0,	''),
(2,	'',	2,	'',	1,	'wx37e2c8a56728483c',	'1461c68ea2bcf9a23f2daf0b4bc0d726',	'',	'',	'',	'ugaCVZBmfnkG6cnr',	'',	'',	'',	0,	0,	'0',	'',	0,	0,	0,	0,	'',	'1',	'',	'',	'',	'',	'',	'',	0,	0,	'',	'',	'',	'',	'',	'',	'',	'',	'',	0,	NULL,	NULL,	NULL,	0,	'',	'',	0,	'');

-- 2016-05-19 09:59:08
