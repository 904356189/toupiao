<?php
//分类、ID、名称、地址、图标、说明
	

$func = array(
	//分类总汇
	'func' => array(
				
					'find' => '查询工具',
					'trip' => '商旅 & 旅游',
					'trans' => '交通出行',
					'health' => '健康医疗',
					'luck' => '运势占卜',
					'lottery' => '彩票购买',
					'service' => '便民服务',
					'leisure' => '快乐休闲',
					'food' => '吃货天地',
					'pay' => '充值支付',
					'edu' => '教育培训',
					'calc' => '理财计算',
					'game' => '网页小游戏',
					'other' => '其他',	
	
	),

	'find' => array(
	
				array(
					'id' => 1,
					'name' => '天气查询',
					'url' => 'http://m.hao123.com/a/tianqi',
					'icon' => 'c01.png',
					'info' => '天气查询',
				),
				array(
					'id' => 2,
					'name' => '快递查询',
					'url' => 'http://m.kuaidi100.com/uc/index.html',
					'icon' => 'c03.png',
					'info' => '',
				),
				array(
					'id' => 3,
					'name' => '查身份证',
					'url' => 'http://m.46644.com/tool/idcard/?tpltype=uc',
					'icon' => 'c07.png',
					'info' => '',
				),
				array(
					'id' => 4,
					'name' => '万年历',
					'url' => 'http://baidu365.duapp.com/uc/Calendar.html',
					'icon' => 'c09.png',
					'info' => '',
				),

				array(
					'id' => 5,
					'name' => '查P.M',
					'url' => 'http://m.46644.com/tool/aqi/?tpltype=uc',
					'icon' => 'c02.png',
					'info' => '',
				),
				array(
					'id' => 6,
					'name' => '手机归属地',
					'url' => 'http://m.46644.com/tool/shouji/?tpltype=uc',
					'icon' => 'c08.png',
					'info' => '',
				),
				array(
					'id' => 7,
					'name' => '在线翻译',
					'url' => 'http://m.46644.com/tool/translate/?tpltype=uc',
					'icon' => 'c10.png',
					'info' => '',
				),
				array(
					'id' => 8,
					'name' => '常用电话',
					'url' => 'http://m.hao123.com/n/v/dianhua',
					'icon' => '',
					'info' => ''
				),
				array(
					'id' => 9,
					'name' => '查邮编',
					'url' => 'http://m.46644.com/tool/zipcode/?tpltype=uc',
					'icon' => '',
					'info' => '',
				),
				array(
					'id' => 10,
					'name' => '查购物返利',
					'url' => 'http://m.dabizi.cn/wapsite',
					'icon' => '',
					'info' => '',
				),	
				array(
					'id' => 11,
					'name' => '查区号',
					'url' => 'http://m.46644.com/tool/areacode/?tpltype=uc',
					'icon' => '',
					'info' => '',
				),
				array(
					'id' => 12,
					'name' => '安全期',
					'url' => 'http://health.sohu.com/eden/anquanqi/jump.html',
					'icon' => '',
					'info' => '',
				),
				array(
					'id' => 13,
					'name' => '影讯',
					'url' => 'http://m.mtime.cn/',
					'icon' => '',
					'info' => '',
				),
	
			),
			
			
	'trip' => array(
	
				array(
					'id' => 1,
					'name' => '抢火车票',
					'url' => 'http://12306.uodoo.com/',
					'icon' => 'a04.png',
					'info' => '',
				),
				array(
					'id' => 2,
					'name' => '机票预订',
					'url' => 'http://hao.uc.cn/bst/flight?uc_param_str=prdnfrpfbivelabtbmntpvsscp',
					'icon' => 'a01.png',
					'info' => '',
				),
				array(
					'id' => 3,
					'name' => '航班动态',
					'url' => 'http://wx.133.cn/hbrobot/wap',
					'icon' => 'a02.png',
					'info' => '',
				),
				array(
					'id' => 4,
					'name' => '酒店查询',
					'url' => 'http://m.zhuna.cn/?agent_id=194',
					'icon' => 'a03.png',
					'info' => '',
				),
				array(
					'id' => 5,
					'name' => '旅游路线',
					'url' => 'http://m.tuniu.com/',
					'icon' => 'a07.png',
					'info' => '',
				),
				array(
					'id' => 6,
					'name' => '景点门票',
					'url' => 'http://wap.yikuaiqu.com/?s=uc',
					'icon' => 'a06.png',
					'info' => '',
				),
				array(
					'id' => 7,
					'name' => '景点导览',
					'url' => 'http://lvyou.baidu.com/main/webapp/index',
					'icon' => 'a05.png',
					'info' => '',
				),
				array(
					'id' => 8,
					'name' => '攻略游记',
					'url' => 'http://m.mafengwo.cn/mdd',
					'icon' => 'a08.png',
					'info' => '',
				),
	
	
	),
	
	'trans' => array(
	
				array(
					'id' => 1,
					'name' => '违章查询',
					'url' => 'http://cha.weiche.me/uc',
					'icon' => 'b08.png',
					'info' => '',
				),
				array(
					'id' => 2,
					'name' => '长途客运',
					'url' => 'http://m.46644.com/tool/bus/?tpltype=uc',
					'icon' => 'b03.png',
					'info' => '',
				),
				array(
					'id' => 3,
					'name' => '公交换乘',
					'url' => 'http://gj.aibang.com/',
					'icon' => 'b01.png',
					'info' => '',
				),
				array(
					'id' => 4,
					'name' => '地铁线路',
					'url' => 'http://m.8684.cn/dt_switch',
					'icon' => 'b02.png',
					'info' => '',
				),
				array(
					'id' => 5,
					'name' => '地图导航',
					'url' => 'http://map.baidu.com/mobile/webapp/index/index/foo=bar/vt=map/?third_party=ucsearchbox',
					'icon' => 'b05.png',
					'info' => '',
				),
				array(
					'id' => 6,
					'name' => '交通路况',
					'url' => 'http://map.baidu.com/mobile/webapp/index/index/foo=bar/vt=map&traffic=on&viewmode=no_ad/?third_party=ucsearchbox',
					'icon' => 'b04.png',
					'info' => '',
				),
				array(
					'id' => 7,
					'name' => '附近加油站',
					'url' => 'http://map.baidu.com/mobile/webapp/search/search/qt=s&wd=%E5%8A%A0%E6%B2%B9%E7%AB%99/needloc=1?third_party=ucsearchbox',
					'icon' => 'b07.png',
					'info' => '',
				),
				array(
					'id' => 8,
					'name' => '附近停车场',
					'url' => 'http://map.baidu.com/mobile/webapp/search/search/qt=s&wd=%E5%81%9C%E8%BD%A6%E5%9C%BA/needloc=1?third_party=ucsearchbox',
					'icon' => 'b06.png',
					'info' => '',
				),
	
	
	),

	'health' => array(
	
				array(
					'id' => 1,
					'name' => '两性知识',
					'url' => 'http://3g.39.net/sex',
					'icon' => 'f08.png',
					'info' => '',
				),
				array(
					'id' => 2,
					'name' => '男性健康',
					'url' => 'http://3g.39.net/man',
					'icon' => 'f05.png',
					'info' => '',
				),
				array(
					'id' => 3,
					'name' => '女性健康',
					'url' => 'http://3g.39.net/woman',
					'icon' => 'f03.png',
					'info' => '',
				),
				array(
					'id' => 4,
					'name' => '问医生',
					'url' => 'http://m.soujibing.com',
					'icon' => 'f01.png',
					'info' => '',
				),
				array(
					'id' => 5,
					'name' => '养生保健',
					'url' => 'http://3g.39.net/care',
					'icon' => 'f06.png',
					'info' => '',
				),	
				array(
					'id' => 6,
					'name' => '运动减肥',
					'url' => 'http://3g.39.net/fitness/ydjf',
					'icon' => 'f07.png',
					'info' => '',
				),
				array(
					'id' => 7,
					'name' => '用药指南',
					'url' => 'http://3g.yao.xywy.com',
					'icon' => 'f02.png',
					'info' => '',
				),
				array(
					'id' => 8,
					'name' => '孕产妇婴',
					'url' => 'http://3g.yaolan.com/',
					'icon' => 'f04.png',
					'info' => '',
				),
				array(
					'id' => 9,
					'name' => '附近医院',
					'url' => 'http://map.baidu.com/mobile/webapp/search/search/qt=s&wd=%E5%8C%BB%E9%99%A2/needloc=1&viewmode=no_ad/?third_party=ucsearchbox',
					'icon' => '',
					'info' => '',
				),
				array(
					'id' => 10,
					'name' => '附近药店',
					'url' => 'http://map.baidu.com/mobile/webapp/search/search/qt=s&wd=%E8%8D%AF%E5%BA%97/needloc=1&viewmode=no_ad/?third_party=ucsearchbox',
					'icon' => '',
					'info' => '',
				),
				array(
					'id' => 11,
					'name' => '附近健身苑',
					'url' => 'http://map.baidu.com/mobile/webapp/search/search/qt=s&wd=%E5%81%A5%E8%BA%AB%E5%9B%AD/needloc=1&viewmode=no_ad/?third_party=ucsearchbox',
					'icon' => '',
					'info' => '',
				),	
				array(
					'id' => 12,
					'name' => '医疗论坛',
					'url' => 'http://3g.dxy.cn/',
					'icon' => '',
					'info' => '',
				),

	
	),

	'luck' => array(
	
				array(
					'id' => 1,
					'name' => '占卜算命',
					'url' => 'http://m.lnka.cn/',
					'icon' => 'h03.png',
					'info' => '',
				),
				array(
					'id' => 2,
					'name' => '星座运势',
					'url' => 'http://infoapp.3g.qq.com/g/s?aid=astro&g_ut=3&g_f=20585#home',
					'icon' => 'h01.png',
					'info' => '',
				),
				array(
					'id' => 3,
					'name' => '生肖运势',
					'url' => 'http://3g.d1xz.net/sx',
					'icon' => 'h02.png',
					'info' => '',
				),
				array(
					'id' => 4,
					'name' => '周公解梦',
					'url' => 'http://3g.d1xz.net/jm',
					'icon' => 'h04.png',
					'info' => '',
				),
	
	),

	'lottery' => array(
	
				array(
					'id' => 1,
					'name' => '双色球',
					'url' => 'http://m.quecai.com/lotteryview/ssq.php?from=lottbst_cata&uc_param_str=cpligiwisndnfrpfbivessupntlaminieisipi&uc_common_param=true',
					'icon' => 'l01.png',
					'info' => '',
				),
				array(
					'id' => 2,
					'name' => '大乐透',
					'url' => 'http://m.quecai.com/lotteryview/dlt.php?from=lottbst_cata&uc_param_str=cpligiwisndnfrpfbivessupntlaminieisipi&uc_common_param=true',
					'icon' => 'l02.png',
					'info' => '',
				),
				array(
					'id' => 3,
					'name' => '快3',
					'url' => 'http://m.quecai.com/lotteryview/k3.php?from=lottbst_cata&uc_param_str=cpligiwisndnfrpfbivessupntlaminieisipi&uc_common_param=true',
					'icon' => 'l03.png',
					'info' => '',
				),
				array(
					'id' => 4,
					'name' => '11选5',
					'url' => 'http://m.quecai.com/lotteryview/syydj.php?from=lottbst_cata&uc_param_str=cpligiwisndnfrpfbivessupntlaminieisipi&uc_common_param=true',
					'icon' => 'l04.png',
					'info' => '',
				),
				array(
					'id' => 5,
					'name' => '竞足',
					'url' => 'http://m.quecai.com/lotteryview/jczq_ht.php?from=lottbst_cata&uc_param_str=cpligiwisndnfrpfbivessupntlaminieisipi&uc_common_param=true',
					'icon' => '',
					'info' => '',
				),
				array(
					'id' => 6,
					'name' => '福彩3D',
					'url' => 'http://m.quecai.com/lotteryview/3d.php?from=lottbst_cata&uc_param_str=cpligiwisndnfrpfbivessupntlaminieisipi&uc_common_param=true',
					'icon' => '',
					'info' => '',
				),
				array(
					'id' => 7,
					'name' => '时时彩',
					'url' => 'http://m.quecai.com/lotteryview/ssc.php?from=lottbst_cata&uc_param_str=cpligiwisndnfrpfbivessupntlaminieisipi&uc_common_param=true',
					'icon' => '',
					'info' => '',
				),
				array(
					'id' => 8,
					'name' => '开奖',
					'url' => 'http://m.quecai.com/notice/index.php?from=lottbst_cata&uc_param_str=cpligiwisndnfrpfbivessupntlaminieisipi&uc_common_param=true',
					'icon' => '',
					'info' => '',
				),
	),

	'service' => array(
	
				array(
					'id' => 1,
					'name' => '二手车辆',
					'url' => 'http://m.58.com/ershouche',
					'icon' => 'e02.png',
					'info' => '',
				),
				array(
					'id' => 2,
					'name' => '找工作',
					'url' => 'http://m.51job.com/?partner=uc3',
					'icon' => 'e05.png',
					'info' => '',
				),
				array(
					'id' => 3,
					'name' => '找兼职',
					'url' => 'http://m.58.com/jianzhi.shtml',
					'icon' => 'e06.png',
					'info' => '',
				),
				array(
					'id' => 4,
					'name' => '去相亲',
					'url' => 'http://m.baihe.com/search.php',
					'icon' => 'e08.png',
					'info' => '',
				),
				array(
					'id' => 5,
					'name' => '二手物品',
					'url' => 'http://m.58.com/sale.shtml',
					'icon' => 'e01.png',
					'info' => '',
				),
				array(
					'id' => 6,
					'name' => '租房买房',
					'url' => 'http://m.soufun.com/zf?sf_source=ucbrowser04',
					'icon' => 'e03.png',
					'info' => '',
				),
				array(
					'id' => 7,
					'name' => '家政/钟点工',
					'url' => 'http://m.58.com/zhongdiangong',
					'icon' => 'e04.png',
					'info' => '',
				),
				array(
					'id' => 8,
					'name' => '优惠券',
					'url' => 'http://m.dianping.com/promo/shanghai',
					'icon' => 'e07.png',
					'info' => '',
				),
				array(
					'id' => 9,
					'name' => '附近银行',
					'url' => 'http://map.baidu.com/mobile/webapp/search/search/qt=s&wd=%E9%93%B6%E8%A1%8C/needloc=1&viewmode=no_ad/?third_party=ucsearchbox',
					'icon' => '',
					'info' => '',
				),
				array(
					'id' => 10,
					'name' => '附近营业厅',
					'url' => 'http://map.baidu.com/mobile/webapp/search/search/qt=s&wd=%E8%90%A5%E4%B8%9A%E5%8E%85/needloc=1&viewmode=no_ad/?third_party=ucsearchbox',
					'icon' => '',
					'info' => '',
				),
				array(
					'id' => 11,
					'name' => '附近邮局',
					'url' => 'http://map.baidu.com/mobile/webapp/search/search/qt=s&wd=%E9%82%AE%E5%B1%80/needloc=1&viewmode=no_ad/?third_party=ucsearchbox',
					'icon' => '',
					'info' => '',
				),
				array(
					'id' => 12,
					'name' => '附近美容',
					'url' => 'http://map.baidu.com/mobile/webapp/search/search/qt=s&wd=%E7%BE%8E%E5%AE%B9/needloc=1&viewmode=no_ad/?third_party=ucsearchbox',
					'icon' => '',
					'info' => '',
				),

	
	),

	'leisure' => array(
	
	
				array(
					'id' => 1,
					'name' => '电视节目',
					'url' => 'http://m.46644.com/tool/tv/?tpltype=u',
					'icon' => 'j01.png',
					'info' => '',
				),
				array(
					'id' => 2,
					'name' => '心理测试',
					'url' => 'http://infoapp.3g.qq.com/g/s?aid=astro&g_ut=3&g_f=20585#toplist?tab=new',
					'icon' => 'j11.png',
					'info' => '',
				),
				array(
					'id' => 3,
					'name' => '幽默笑话',
					'url' => 'http://m.pengfu.com/',
					'icon' => 'j09.png',
					'info' => '',
				),
				array(
					'id' => 4,
					'name' => '祝福短信',
					'url' => 'http://sms.waptw.com/lifesearch/ucsms/index?tpl=ucm_sms_index',
					'icon' => 'j12.png',
					'info' => '',
				),
				array(
					'id' => 5,
					'name' => '节目直播',
					'url' => 'http://now.3g.cn/?fr=uciapp',
					'icon' => 'j02.png',
					'info' => '',
				),	
				array(
					'id' => 6,
					'name' => '电影资讯',
					'url' => 'http://m.taoying.com/',
					'icon' => 'j03.png',
					'info' => '',
				),
				array(
					'id' => 7,
					'name' => '在线广播',
					'url' => 'http://m.weibo.cn/pubs/radio?pos=63&vt=4&from=bst&s2w=bst&wm=ig_0001_bst',
					'icon' => 'j05.png',
					'info' => '',
				),
				array(
					'id' => 8,
					'name' => '搞笑漫画',
					'url' => 'http://manhua.yicha.cn/',
					'icon' => 'j08.png',
					'info' => '',
				),
				array(
					'id' => 9,
					'name' => '音乐电台',
					'url' => 'http://douban.fm/partner/uc',
					'icon' => '',
					'info' => '',
				),
				array(
					'id' => 10,
					'name' => '玩小游戏',
					'url' => 'http://duopao.com/',
					'icon' => '',
					'info' => '',
				),
				array(
					'id' => 11,
					'name' => '演出门票',
					'url' => 'http://m.damai.cn/',
					'icon' => '',
					'info' => '',
				),	
				array(
					'id' => 12,
					'name' => '电影票团购',
					'url' => 'http://tuan.uc.cn/?keyword=%E7%94%B5%E5%BD%B1#!/index',
					'icon' => '',
					'info' => '',
				),
				array(
					'id' => 13,
					'name' => '附近KTV',
					'url' => 'http://map.baidu.com/mobile/webapp/search/search/qt=s&wd=ktv/needloc=1&viewmode=no_ad/?third_party=ucsearchbox',
					'icon' => '',
					'info' => '',
				),
				array(
					'id' => 14,
					'name' => '附近网吧',
					'url' => 'http://map.baidu.com/mobile/webapp/search/search/qt=s&wd=%E7%BD%91%E5%90%A7/needloc=1&viewmode=no_ad/?third_party=ucsearchbox',
					'icon' => '',
					'info' => '',
				),
				array(
					'id' => 15,
					'name' => '附近电影院',
					'url' => 'http://map.baidu.com/mobile/webapp/search/search/qt=s&wd=%E7%94%B5%E5%BD%B1%E9%99%A2/needloc=1&viewmode=no_ad/?third_party=ucsearchbox',
					'icon' => '',
					'info' => '',
				),
				array(
					'id' => 16,
					'name' => '附近足疗',
					'url' => 'http://map.baidu.com/mobile/webapp/search/search/qt=s&wd=%E8%B6%B3%E7%96%97/needloc=1&viewmode=no_ad/?third_party=ucsearchbox',
					'icon' => '',
					'info' => '',
				),
	),

	'food' => array(

				array(
					'id' => 1,
					'name' => '好吃菜谱',
					'url' => 'http://home.meishichina.com/wap.php?ac=recipe&t=3&fr=ucapp#utm_source=wap3_popnav_recipe_0',
					'icon' => 'i01.png',
					'info' => '',
				),
				array(
					'id' => 2,
					'name' => '食疗养生',
					'url' => 'http://m.meishij.net/html5/list.php?cid=9',
					'icon' => 'i04.png',
					'info' => '',
				),
				array(
					'id' => 3,
					'name' => '美食团购',
					'url' => 'http://tuan.uc.cn/?keyword=%E7%BE%8E%E9%A3%9F#!/index',
					'icon' => 'i03.png',
					'info' => '',
				),
				array(
					'id' => 4,
					'name' => '附近美食',
					'url' => 'http://map.baidu.com/mobile/webapp/search/search/qt=s&wd=%E7%BE%8E%E9%A3%9F/needloc=1&viewmode=no_ad/?third_party=ucsearchbox',
					'icon' => 'i02.png',
					'info' => '',
				),

	),

	'pay' => array(
	
				array(
					'id' => 1,
					'name' => '话费充值',
					'url' => 'http://wvs.m.taobao.com/',
					'icon' => 'd01.png',
					'info' => '',
				),
				array(
					'id' => 2,
					'name' => 'QQ充值',
					'url' => 'http://wvs.m.taobao.com/game_card.htm?&pds=qq%23h%23zhichong&type=3&unid=null',
					'icon' => 'd02.png',
					'info' => '',
				),
				array(
					'id' => 3,
					'name' => '游戏充值',
					'url' => 'http://wvs.m.taobao.com/game_card.htm?&pds=qq%23h%23zhichong&type=1&unid=null',
					'icon' => 'd03.png',
					'info' => '',
				),
				array(
					'id' => 4,
					'name' => 'U点充值',
					'url' => 'http://pay.uc.cn/',
					'icon' => 'd04.png',
					'info' => '',
				),

	),

	'edu' => array(
	
				array(
					'id' => 1,
					'name' => '学车考驾照',
					'url' => 'http://m.jxedt.com/',
					'icon' => 'g04.png',
					'info' => '',
				),
				array(
					'id' => 2,
					'name' => '国学经典',
					'url' => 'http://app.sso56.com/webapp.html?dm=guoxue&fr=uc',
					'icon' => 'g03.png',
					'info' => '',
				),

				array(
					'id' => 3,
					'name' => '备战高考',
					'url' => 'http://www.gaokao.com/touch',
					'icon' => 'g02.png',
					'info' => '',
				),
	
	),

	'calc' => array(
	
				array(
					'id' => 1,
					'name' => '养老险计算',
					'url' => 'http://dp.sina.cn/dpool/tools/money/single.php?flag=old_per&pos=63&vt=4',
					'icon' => 'k01.png',
					'info' => '',
				),
				array(
					'id' => 2,
					'name' => '购车计算',
					'url' => 'http://auto.sina.com.cn/calculator/',
					'icon' => 'k07.png',
					'info' => '',
				),
				array(
					'id' => 3,
					'name' => '房贷计算',
					'url' => 'http://house.sina.cn/touch/tools/house_loan.html',
					'icon' => 'k06.png',
					'info' => '',
				),
				array(
					'id' => 4,
					'name' => '公积金计算',
					'url' => 'http://dp.sina.cn/dpool/tools/money/single.php?flag=house_per&pos=63&vt=4',
					'icon' => 'k04.png',
					'info' => '',
				),
				array(
					'id' => 5,
					'name' => '个税计算',
					'url' => 'http://dp.sina.cn/dpool/tools/money/single.php?city_id=1&flag=per_tax&pos=63&vt=4',
					'icon' => '',
					'info' => '',
				),
				array(
					'id' => 6,
					'name' => '医疗险计算',
					'url' => 'http://dp.sina.cn/dpool/tools/money/single.php?flag=health_per&pos=63&vt=4',
					'icon' => '',
					'info' => '',
				),
				array(
					'id' => 7,
					'name' => '失业险计算',
					'url' => 'http://dp.sina.cn/dpool/tools/money/single.php?flag=lose_per&pos=63&vt=4',
					'icon' => '',
					'info' => '',
				),
				array(
					'id' => 8,
					'name' => '汇率换算',
					'url' => 'http://m.wap.soso.com/app/forex/index.jsp?g_ut=3&biz=newHome',
					'icon' => '',
					'info' => '',
				),
	
	),

	'game' => array(
	
				array(
					'id' => 1,
					'name' => '问答游戏',
					'url' => 'http://u.3g.cn/qasuperman/?fr=wdcr',
					'icon' => '',
					'info' => '',
				),
				array(
					'id' => 2,
					'name' => '画画游戏',
					'url' => 'http://hc.3g.cn/Index.aspx?fr=grzx',
					'icon' => '',
					'info' => '',
				),
				array(
					'id' => 3,
					'name' => '神器泡泡',
					'url' => 'http://m.edianyou.com/h5game/bubbleHit.html',
					'icon' => '',
					'info' => '',
				),
				array(
					'id' => 4,
					'name' => '一笔一划',
					'url' => 'http://line.3g.cn/?fr=grzx',
					'icon' => '',
					'info' => '',
				),
				array(
					'id' => 5,
					'name' => '你被点名了',
					'url' => 'http://ltldev.sinaapp.com/wx_apps/dianming/index.php?from=wx_xlnl',
					'icon' => '',
					'info' => '',
				),
				array(
					'id' => 6,
					'name' => '谁是卧底',
					'url' => 'http://fanzhuo.sinaapp.com/wodiwx/creater.html',
					'icon' => '',
					'info' => '',
				),
				array(
					'id' => 7,
					'name' => '斗地主',
					'url' => 'http://h.lexun.com/game/DouDiZhu/play.aspx',
					'icon' => '',
					'info' => '',
				),
				array(
					'id' => 8,
					'name' => '大家来找不同',
					'url' => 'http://resource.duopao.com/duopao/games/small_games/weixingame/sameclick/sameclick.htm',
					'icon' => '',
					'info' => '',
				),
				array(
					'id' => 9,
					'name' => '神秘方块',
					'url' => 'http://resource.duopao.com/duopao/games/small_games/weixingame/unitem/Unitem.htm',
					'icon' => '',
					'info' => '',
				),
				array(
					'id' => 10,
					'name' => '梦幻农场连连看',
					'url' => 'http://resource.duopao.com/duopao/games/small_games/weixingame/DreamFarmLink/DreamFarmLink.htm',
					'icon' => '',
					'info' => '',
				),
				array(
					'id' => 11,
					'name' => '小怪物吃饼干',
					'url' => 'http://resource.duopao.com/duopao/games/small_games/weixingame/bouffecookie/bouffecookie.htm',
					'icon' => '',
					'info' => '',
				),
	
	),

	'other' => array(
	
				array(
					'id' => 1,
					'name' => '爱星座',
					'url' => 'http://infoapp.3g.qq.com/g/s?g_f=22207&aid=astro#home',
					'icon' => '',
					'info' => '',
				),
				array(
					'id' => 2,
					'name' => '中国天气网',
					'url' => 'http://mobile.weather.com.cn/',
					'icon' => '',
					'info' => '',
				),
				array(
					'id' => 3,
					'name' => '下厨房',
					'url' => 'http://m.xiachufang.com/',
					'icon' => '',
					'info' => '',
				),
				array(
					'id' => 4,
					'name' => '好大夫',
					'url' => 'http://m.haodf.com/touch',
					'icon' => '',
					'info' => '',
				),
				array(
					'id' => 5,
					'name' => '艺龙酒店预订',
					'url' => 'http://m.elong.com/hotel/',
					'icon' => '',
					'info' => '',
				),
				array(
					'id' => 6,
					'name' => '彩票开奖查询',
					'url' => 'http://loto.sina.cn/index.do?vt=5&sid=fc055b3a-d72c-41bf-96bc-b8e436ea79ea&agentId=233258',
					'icon' => '',
					'info' => '',
				),
				array(
					'id' => 7,
					'name' => '快递查询',
					'url' => 'http://m.kuaidi100.com/',
					'icon' => '',
					'info' => '',
				),
				array(
					'id' => 8,
					'name' => '航班查询',
					'url' => 'http://wx.133.cn/hbrobot/wap',
					'icon' => '',
					'info' => '',
				),
				array(
					'id' => 9,
					'name' => '火车余票查询',
					'url' => 'http://12306.uodoo.com/#!/index',
					'icon' => '',
					'info' => '',
				),
				array(
					'id' => 10,
					'name' => '租房',
					'url' => 'http://m.soufun.com',
					'icon' => '',
					'info' => '',
				),
				array(
					'id' => 11,
					'name' => '运势',
					'url' => 'http://dp.sina.cn/dpool/astro/starent/xingyun.php',
					'icon' => '',
					'info' => '',
				),
				array(
					'id' => 12,
					'name' => '算命',
					'url' => 'http://www.aqioo.cn/free',
					'icon' => '',
					'info' => '',
				),
				array(
					'id' => 13,
					'name' => '解梦',
					'url' => 'http://www.aqioo.cn/dream',
					'icon' => '',
					'info' => '',
				),
				array(
					'id' => 14,
					'name' => '房贷计算',
					'url' => 'http://house.sina.cn/touch/tools/house_loan.html',
					'icon' => '',
					'info' => '',
				),
				array(
					'id' => 15,
					'name' => '股票',
					'url' => 'http://finance.sina.cn/?sa=t60d13v512&pos=63&vt=4',
					'icon' => '',
					'info' => '',
				),
				array(
					'id' => 16,
					'name' => '个税计算',
					'url' => 'http://dp.sina.cn/dpool/tools/money/single.php?city_id=1&flag=per_tax&pos=63&vt=4',
					'icon' => '',
					'info' => '',
				),
				array(
					'id' => 17,
					'name' => '医疗保险计算',
					'url' => 'http://dp.sina.cn/dpool/tools/money/single.php?flag=health_per&pos=63&vt=4',
					'icon' => '',
					'info' => '',
				),
				array(
					'id' => 18,
					'name' => '养老保险',
					'url' => 'http://dp.sina.cn/dpool/tools/money/single.php?flag=old_per&pos=63&vt=4',
					'icon' => '',
					'info' => '',
				),
				array(
					'id' => 19,
					'name' => '住房公积金计算',
					'url' => 'http://dp.sina.cn/dpool/tools/money/single.php?flag=house_per&pos=63&vt=4',
					'icon' => '',
					'info' => '',
				),
				array(
					'id' => 20,
					'name' => '常用电话',
					'url' => 'http://m.46644.com/tool/tel/',
					'icon' => '',
					'info' => '',
				),
				array(
					'id' => 21,
					'name' => '塔罗占卜',
					'url' => 'http://ast.sina.cn/?sa=t282d771v166&pos=19&vt=4',
					'icon' => '',
					'info' => '',
				),
				
	),
	

	
);
return $func;

?>