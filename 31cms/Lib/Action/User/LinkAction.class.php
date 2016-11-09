<?php
echo '﻿';
class LinkAction extends UserAction{
public $IIIIIIIIlIl1;
public $IIIIII1I111I;
public function _initialize() {
parent::_initialize();
$this->IIIIIIIIlIl1=array('token'=>$this->IIIIIIIIlIlI);
$this->IIIIII1I111I=array(
'Home'=>'首页',
'Classify'=>'网站分类',
'Img'=>'图文回复',
'Company'=>'LBS信息',
'Adma'=>'DIY宣传页',
'Photo'=>'相册',
'Selfform'=>'万能表单',
'Custom'=>'预约',
'Host'=>'通用订单',
'Groupon'=>'团购',
'Shop'=>'商城',
'Repast'=>'订餐',
'Repastwql'=>'简版点菜',
'Wedding'=>'婚庆喜帖',
'Vcard'=>'微名片',
'Vote'=>'投票',
'Panorama'=>'全景',
'Lottery'=>'大转盘',
'Guajiang'=>'刮刮卡',
'Coupon'=>'优惠券',
'MemberCard'=>'会员卡',
'Estate'=>'微房产',
'Message'=>'留言板',
'Car'=>'汽车',
'GoldenEgg'=>'砸金蛋',
'LuckyFruit'=>'水果机',
'Forum'=>'论坛',
'GreetingCard'=>'贺卡',
'Medical'=>'微医疗',
'School'=>'微教育',
'Hotels'=>'酒店宾馆',
'Yuyue'=>'新版预约',
'Jiejing'=>'街景导航',
'Market'=>'微商圈',
'Business'=>'行业应用',
'Fansign'=>'微信签到',
'Baoming'=>'报名活动',
'Sjm'=>'神经猫',
'Zhaopin'=>'微招聘',
'Fangchan'=>'微房产',
'Yingyong'=>'场景应用',
'Research'=>'微调研',
'Fenlei'=>'微商盟',
'OutsideLink'=>'<font color="red">生活服务</font>',
);
}
public function insert(){
if ($_GET['iskeyword']){
$IIIIII1I111I=$this->keywordModules();
}else {
$IIIIII1I111I=$this->modules();
}
$this->assign('modules',$IIIIII1I111I);
$this->display();
}
public function keywordModules(){
$IIIIIIIIlIl1=$this->IIIIIIIIlIl1;
$IIIIII1I1111=M('Jiejing')->where($IIIIIIIIlIl1)->find();
return array(
array('module'=>'Home','linkcode'=>'{siteUrl}/index.php?g=Wap&m=Index&a=index&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}','name'=>'微站首页','sub'=>0,'canselected'=>1,'linkurl'=>'','keyword'=>$this->IIIIII1I111I['Home'],'askeyword'=>1),
array('module'=>'Img','linkcode'=>'{siteUrl}/index.php?g=Wap&m=Index&a=content&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}','name'=>$this->IIIIII1I111I['Img'],'sub'=>1,'canselected'=>0,'linkurl'=>'','keyword'=>'','askeyword'=>1),
array('module'=>'Company','linkcode'=>'{siteUrl}/index.php?g=Wap&m=Company&a=map&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}','name'=>$this->IIIIII1I111I['Company'],'canselected'=>1,'linkurl'=>'','keyword'=>'地图','askeyword'=>1),
array('module'=>'Photo','linkcode'=>'{siteUrl}/index.php?g=Wap&m=Photo&a=index&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}','name'=>$this->IIIIII1I111I['Photo'],'canselected'=>1,'linkurl'=>'','keyword'=>'相册','askeyword'=>1),
array('module'=>'Selfform','linkcode'=>'{siteUrl}/index.php?g=Wap&m=Selfform&a=index&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}','name'=>$this->IIIIII1I111I['Selfform'],'sub'=>1,'canselected'=>0,'linkurl'=>'','keyword'=>'','askeyword'=>1),
array('module'=>'Custom','linkcode'=>'{siteUrl}/index.php?g=Wap&m=Custom&a=index&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}','name'=>$this->IIIIII1I111I['Custom'],'sub'=>1,'canselected'=>0,'linkurl'=>'','keyword'=>'','askeyword'=>1),
array('module'=>'Host','linkcode'=>'{siteUrl}/index.php?g=Wap&m=Host&a=detail&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}','name'=>$this->IIIIII1I111I['Host'],'sub'=>1,'canselected'=>0,'linkurl'=>'','keyword'=>'','askeyword'=>1),
array('module'=>'Groupon','linkcode'=>'{siteUrl}/index.php?g=Wap&m=Groupon&a=grouponIndex&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}','name'=>$this->IIIIII1I111I['Groupon'],'sub'=>0,'canselected'=>1,'linkurl'=>'','keyword'=>'团购','askeyword'=>1),
array('module'=>'Shop','linkcode'=>'{siteUrl}/index.php?g=Wap&m=Store&a=index&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}','name'=>$this->IIIIII1I111I['Shop'],'canselected'=>1,'linkurl'=>'','keyword'=>'商城','askeyword'=>1),
array('module'=>'Repast','linkcode'=>'{siteUrl}/index.php?g=Wap&m=Repast&a=index&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}','name'=>$this->IIIIII1I111I['Repast'],'sub'=>0,'canselected'=>1,'linkurl'=>'','keyword'=>'订餐','askeyword'=>1),
array('module'=>'Repastwql','linkcode'=>'{siteUrl}/index.php?g=Wap&m=Repastwql&a=index&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}','name'=>$this->IIIIII1I111I['Repastwql'],'sub'=>0,'canselected'=>1,'linkurl'=>'','keyword'=>'简版点菜','askeyword'=>1),
array('module'=>'Wedding','linkcode'=>'{siteUrl}/index.php?g=Wap&m=Wedding&a=index&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}','name'=>$this->IIIIII1I111I['Wedding'],'sub'=>1,'canselected'=>0,'linkurl'=>'','keyword'=>'','askeyword'=>1),
array('module'=>'Vote','linkcode'=>'{siteUrl}/index.php?g=Wap&m=Vote&a=index&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}','name'=>$this->IIIIII1I111I['Vote'],'sub'=>1,'canselected'=>0,'linkurl'=>'','keyword'=>'','askeyword'=>1),
array('module'=>'Panorama','linkcode'=>'{siteUrl}/index.php?g=Wap&m=Panorama&a=index&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}','name'=>$this->IIIIII1I111I['Panorama'],'sub'=>1,'canselected'=>0,'linkurl'=>'','keyword'=>$this->IIIIII1I111I['Panorama'],'askeyword'=>1),
array('module'=>'Lottery','linkcode'=>'','name'=>$this->IIIIII1I111I['Lottery'],'sub'=>1,'canselected'=>0,'linkurl'=>'','keyword'=>'','askeyword'=>1),
array('module'=>'Guajiang','linkcode'=>'','name'=>$this->IIIIII1I111I['Guajiang'],'sub'=>1,'canselected'=>0,'linkurl'=>'','keyword'=>'','askeyword'=>1),
array('module'=>'Coupon','linkcode'=>'','name'=>$this->IIIIII1I111I['Coupon'],'sub'=>1,'canselected'=>0,'linkurl'=>'','keyword'=>'','askeyword'=>1),
array('module'=>'Vcard','linkcode'=>'','name'=>$this->IIIIII1I111I['Vcard'],'sub'=>1,'canselected'=>0,'linkurl'=>'','keyword'=>'','askeyword'=>1),
array('module'=>'MemberCard','linkcode'=>'{siteUrl}/index.php?g=Wap&m=Card&a=index&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}','name'=>$this->IIIIII1I111I['MemberCard'],'sub'=>0,'canselected'=>1,'linkurl'=>'','keyword'=>'会员卡','askeyword'=>1),
array('module'=>'Estate','linkcode'=>'{siteUrl}/index.php?g=Wap&m=Estate&a=index&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}','name'=>$this->IIIIII1I111I['Estate'],'sub'=>0,'canselected'=>1,'linkurl'=>'','keyword'=>'微房产','askeyword'=>1),
array('module'=>'Message','linkcode'=>'{siteUrl}/index.php?g=Wap&m=Reply&a=index&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}','name'=>$this->IIIIII1I111I['Message'],'sub'=>0,'canselected'=>1,'linkurl'=>'','keyword'=>'留言','askeyword'=>1),
array('module'=>'Car','linkcode'=>'{siteUrl}/index.php?g=Wap&m=brands&a=index&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}','name'=>$this->IIIIII1I111I['Car'],'sub'=>0,'canselected'=>1,'linkurl'=>'','keyword'=>'汽车','askeyword'=>1),
array('module'=>'GoldenEgg','linkcode'=>'','name'=>$this->IIIIII1I111I['GoldenEgg'],'sub'=>1,'canselected'=>0,'linkurl'=>'','keyword'=>'','askeyword'=>1),
array('module'=>'LuckyFruit','linkcode'=>'','name'=>$this->IIIIII1I111I['LuckyFruit'],'sub'=>1,'canselected'=>0,'linkurl'=>'','keyword'=>'','askeyword'=>1),
array('module'=>'Forum','linkcode'=>'{siteUrl}/index.php?g=Wap&m=Forum&a=index&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}','name'=>$this->IIIIII1I111I['Forum'],'sub'=>0,'canselected'=>1,'linkurl'=>'','keyword'=>'论坛','askeyword'=>1),
array('module'=>'Hotels','linkcode'=>'{siteUrl}/index.php?g=Wap&m=Hotels&a=index&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}','name'=>'酒店宾馆','sub'=>0,'canselected'=>1,'linkurl'=>'','keyword'=>'酒店','askeyword'=>1),
array('module'=>'Jiejing','linkcode'=>'http://apis.map.qq.com/uri/v1/streetview?pano='.$IIIIII1I1111['pano'].'&heading=30&pitch=10','name'=>$this->IIIIII1I111I['Jiejing'],'sub'=>0,'canselected'=>1,'linkurl'=>'','keyword'=>'街景导航','askeyword'=>1),
array('module'=>'Yuyue','linkcode'=>'{siteUrl}/index.php?g=Wap&m=Yuyue&a=index&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}','name'=>$this->IIIIII1I111I['Yuyue'],'sub'=>1,'canselected'=>0,'linkurl'=>'','keyword'=>'微预约','askeyword'=>1),
array('module'=>'Market','linkcode'=>'{siteUrl}/index.php?g=Wap&m=Market&a=index&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}','name'=>$this->IIIIII1I111I['Market'],'sub'=>0,'canselected'=>1,'linkurl'=>'','keyword'=>'微商圈','askeyword'=>1),
array('module'=>'Fenlei','linkcode'=>'{siteUrl}/index.php?g=Wap&m=Fenlei&a=index&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}','name'=>$this->IIIIII1I111I['Fenlei'],'sub'=>0,'canselected'=>1,'linkurl'=>'','keyword'=>'微商盟','askeyword'=>1),
array('module'=>'Research','linkcode'=>'','name'=>$this->IIIIII1I111I['Research'],'sub'=>1,'canselected'=>0,'linkurl'=>'','keyword'=>'','askeyword'=>1),
array('module'=>'Fansign','linkcode'=>'','name'=>'微信签到','sub'=>0,'canselected'=>1,'linkurl'=>'','keyword'=>'微信签到','askeyword'=>1),
array('module'=>'Sjm','linkcode'=>'','name'=>'神经猫','sub'=>0,'canselected'=>1,'linkurl'=>'','keyword'=>'神经猫','askeyword'=>1),
array('module'=>'Zhaopin','linkcode'=>'','name'=>'微招聘','sub'=>0,'canselected'=>1,'linkurl'=>'','keyword'=>'微招聘','askeyword'=>1),
array('module'=>'Fangchan','linkcode'=>'','name'=>'微房产（定制）','sub'=>0,'canselected'=>1,'linkurl'=>'','keyword'=>'找房子','askeyword'=>1),
array('module'=>'Yingyong','linkcode'=>'','name'=>'场景应用','sub'=>0,'canselected'=>1,'linkurl'=>'','keyword'=>'场景应用','askeyword'=>1),
array('module'=>'Business','linkcode'=>'','name'=>$this->IIIIII1I111I['Business'],'sub'=>1,'canselected'=>0,'linkurl'=>'','keyword'=>'','askeyword'=>1),
array('module'=>'GreetingCard','linkcode'=>'','name'=>$this->IIIIII1I111I['GreetingCard'],'sub'=>1,'canselected'=>0,'linkurl'=>'','keyword'=>'','askeyword'=>1),
array('module'=>'Baoming','linkcode'=>'{siteUrl}/index.php?g=Wap&m=Baoming&a=list&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}','name'=>'报名活动','sub'=>0,'canselected'=>1,'linkurl'=>'','keyword'=>'报名活动','askeyword'=>1),
);
}
public function modules(){
$IIIIIIIIlIl1=$this->IIIIIIIIlIl1;
$IIIIII1I1111=M('Jiejing')->where($IIIIIIIIlIl1)->find();
$IIIIIII11l1l=M('company')->where($IIIIIIIIlIl1)->find();
return array(
array('module'=>'Home','linkcode'=>'{siteUrl}/index.php?g=Wap&m=Index&a=index&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}','name'=>'微站首页','sub'=>0,'canselected'=>1,'linkurl'=>'','keyword'=>$this->IIIIII1I111I['Home'],'askeyword'=>1),
array('module'=>'Classify','linkcode'=>'{siteUrl}/index.php?g=Wap&m=Index&a=lists&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}','name'=>$this->IIIIII1I111I['Classify'],'sub'=>1,'canselected'=>0,'linkurl'=>'','keyword'=>'','askeyword'=>0),
array('module'=>'Img','linkcode'=>'{siteUrl}/index.php?g=Wap&m=Index&a=content&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}','name'=>$this->IIIIII1I111I['Img'],'sub'=>1,'canselected'=>0,'linkurl'=>'','keyword'=>'','askeyword'=>1),
array('module'=>'Company','linkcode'=>'http://api.map.baidu.com/marker?location='.$IIIIIII11l1l['latitude'].','.$IIIIIII11l1l['longitude'].'&title='.$IIIIIII11l1l['shortname'].'&content='.$IIIIIII11l1l['shortname'].'&output=html','name'=>$this->IIIIII1I111I['Company'],'sub'=>1,'canselected'=>1,'linkurl'=>'','keyword'=>'地图','askeyword'=>1),
array('module'=>'Adma','linkcode'=>'{siteUrl}/index.php/show/'.$this->IIIIIIIIlIlI,'name'=>$this->IIIIII1I111I['Adma'],'sub'=>0,'canselected'=>1,'linkurl'=>'','keyword'=>'','askeyword'=>0),
array('module'=>'Photo','linkcode'=>'{siteUrl}/index.php?g=Wap&m=Photo&a=index&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}','name'=>$this->IIIIII1I111I['Photo'],'sub'=>1,'canselected'=>1,'linkurl'=>'','keyword'=>'相册','askeyword'=>1),
array('module'=>'Selfform','linkcode'=>'{siteUrl}/index.php?g=Wap&m=Selfform&a=index&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}','name'=>$this->IIIIII1I111I['Selfform'],'sub'=>1,'canselected'=>0,'linkurl'=>'','keyword'=>'','askeyword'=>1),
array('module'=>'Custom','linkcode'=>'{siteUrl}/index.php?g=Wap&m=Custom&a=index&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}','name'=>$this->IIIIII1I111I['Custom'],'sub'=>1,'canselected'=>0,'linkurl'=>'','keyword'=>'','askeyword'=>1),
array('module'=>'Host','linkcode'=>'{siteUrl}/index.php?g=Wap&m=Host&a=detail&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}','name'=>$this->IIIIII1I111I['Host'],'sub'=>1,'canselected'=>0,'linkurl'=>'','keyword'=>'','askeyword'=>1),
array('module'=>'Groupon','linkcode'=>'{siteUrl}/index.php?g=Wap&m=Groupon&a=grouponIndex&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}','name'=>$this->IIIIII1I111I['Groupon'],'sub'=>0,'canselected'=>1,'linkurl'=>'','keyword'=>'团购','askeyword'=>1),
array('module'=>'Shop','linkcode'=>'{siteUrl}/index.php?g=Wap&m=Store&a=index&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}','name'=>$this->IIIIII1I111I['Shop'],'sub'=>1,'canselected'=>1,'linkurl'=>'','keyword'=>'商城','askeyword'=>1),
array('module'=>'Repast','linkcode'=>'{siteUrl}/index.php?g=Wap&m=Repast&a=index&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}','name'=>$this->IIIIII1I111I['Repast'],'sub'=>0,'canselected'=>1,'linkurl'=>'','keyword'=>'订餐','askeyword'=>1),
array('module'=>'Wedding','linkcode'=>'{siteUrl}/index.php?g=Wap&m=Wedding&a=index&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}','name'=>$this->IIIIII1I111I['Wedding'],'sub'=>1,'canselected'=>0,'linkurl'=>'','keyword'=>'','askeyword'=>1),
array('module'=>'Vote','linkcode'=>'{siteUrl}/index.php?g=Wap&m=Vote&a=index&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}','name'=>$this->IIIIII1I111I['Vote'],'sub'=>1,'canselected'=>0,'linkurl'=>'','keyword'=>'','askeyword'=>1),
array('module'=>'Panorama','linkcode'=>'{siteUrl}/index.php?g=Wap&m=Panorama&a=index&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}','name'=>$this->IIIIII1I111I['Panorama'],'sub'=>1,'canselected'=>1,'linkurl'=>'','keyword'=>$this->IIIIII1I111I['Panorama'],'askeyword'=>1),
array('module'=>'Lottery','linkcode'=>'','name'=>$this->IIIIII1I111I['Lottery'],'sub'=>1,'canselected'=>0,'linkurl'=>'','keyword'=>'','askeyword'=>1),
array('module'=>'Guajiang','linkcode'=>'','name'=>$this->IIIIII1I111I['Guajiang'],'sub'=>1,'canselected'=>0,'linkurl'=>'','keyword'=>'','askeyword'=>1),
array('module'=>'Coupon','linkcode'=>'','name'=>$this->IIIIII1I111I['Coupon'],'sub'=>1,'canselected'=>0,'linkurl'=>'','keyword'=>'','askeyword'=>1),
array('module'=>'Vcard','linkcode'=>'','name'=>$this->IIIIII1I111I['Vcard'],'sub'=>1,'canselected'=>0,'linkurl'=>'','keyword'=>'','askeyword'=>1),
array('module'=>'MemberCard','linkcode'=>'{siteUrl}/index.php?g=Wap&m=Card&a=index&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}','name'=>$this->IIIIII1I111I['MemberCard'],'sub'=>0,'canselected'=>1,'linkurl'=>'','keyword'=>'会员卡','askeyword'=>1),
array('module'=>'Estate','linkcode'=>'{siteUrl}/index.php?g=Wap&m=Estate&a=index&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}','name'=>$this->IIIIII1I111I['Estate'],'sub'=>1,'canselected'=>1,'linkurl'=>'','keyword'=>'微房产','askeyword'=>1),
array('module'=>'Message','linkcode'=>'{siteUrl}/index.php?g=Wap&m=Reply&a=index&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}','name'=>$this->IIIIII1I111I['Message'],'sub'=>0,'canselected'=>1,'linkurl'=>'','keyword'=>'留言','askeyword'=>1),
array('module'=>'Car','linkcode'=>'{siteUrl}/index.php?g=Wap&m=brands&a=index&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}','name'=>$this->IIIIII1I111I['Car'],'sub'=>1,'canselected'=>0,'linkurl'=>'','keyword'=>'','askeyword'=>1),
array('module'=>'Medical','linkcode'=>'{siteUrl}/index.php?g=Wap&m=Medical&a=index&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}','name'=>$this->IIIIII1I111I['Medical'],'sub'=>1,'canselected'=>0,'linkurl'=>'','keyword'=>'微医疗','askeyword'=>0),
array('module'=>'School','linkcode'=>'{siteUrl}/index.php?g=Wap&m=School&a=index&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}','name'=>$this->IIIIII1I111I['School'],'sub'=>1,'canselected'=>1,'linkurl'=>'','keyword'=>'微医疗','askeyword'=>0),
array('module'=>'GoldenEgg','linkcode'=>'','name'=>$this->IIIIII1I111I['GoldenEgg'],'sub'=>1,'canselected'=>0,'linkurl'=>'','keyword'=>'','askeyword'=>1),
array('module'=>'LuckyFruit','linkcode'=>'','name'=>$this->IIIIII1I111I['LuckyFruit'],'sub'=>1,'canselected'=>0,'linkurl'=>'','keyword'=>'','askeyword'=>1),
array('module'=>'Forum','linkcode'=>'{siteUrl}/index.php?g=Wap&m=Forum&a=index&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}','name'=>$this->IIIIII1I111I['Forum'],'sub'=>0,'canselected'=>1,'linkurl'=>'','keyword'=>'论坛','askeyword'=>1),
array('module'=>'GreetingCard','linkcode'=>'','name'=>$this->IIIIII1I111I['GreetingCard'],'sub'=>1,'canselected'=>0,'linkurl'=>'','keyword'=>'','askeyword'=>1),
array('module'=>'Hotels','linkcode'=>'{siteUrl}/index.php?g=Wap&m=Hotels&a=index&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}','name'=>'酒店宾馆','sub'=>0,'canselected'=>1,'linkurl'=>'','keyword'=>'酒店','askeyword'=>1),
array('module'=>'Jiejing','linkcode'=>'http://apis.map.qq.com/uri/v1/streetview?pano='.$IIIIII1I1111['pano'].'&heading=30&pitch=10','name'=>$this->IIIIII1I111I['Jiejing'],'sub'=>0,'canselected'=>1,'linkurl'=>'','keyword'=>'街景导航','askeyword'=>1),
array('module'=>'Yuyue','linkcode'=>'{siteUrl}/index.php?g=Wap&m=Yuyue&a=index&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}','name'=>$this->IIIIII1I111I['Yuyue'],'sub'=>1,'canselected'=>0,'linkurl'=>'','keyword'=>'微预约','askeyword'=>1),
array('module'=>'Market','linkcode'=>'{siteUrl}/index.php?g=Wap&m=Market&a=index&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}','name'=>$this->IIIIII1I111I['Market'],'sub'=>0,'canselected'=>1,'linkurl'=>'','keyword'=>'','askeyword'=>0),
array('module'=>'Fenlei','linkcode'=>'{siteUrl}/index.php?g=Wap&m=Fenlei&a=index&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}','name'=>$this->IIIIII1I111I['Fenlei'],'sub'=>0,'canselected'=>1,'linkurl'=>'','keyword'=>'','askeyword'=>0),
array('module'=>'Fansign','linkcode'=>'{siteUrl}/index.php?g=Wap&m=Fanssign&a=index&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}','name'=>$this->IIIIII1I111I['Fansign'],'sub'=>0,'canselected'=>1,'linkurl'=>'','keyword'=>'','askeyword'=>0),
array('module'=>'Sjm','linkcode'=>'{siteUrl}/index.php?g=Wap&m=Sjm&a=index&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}','name'=>$this->IIIIII1I111I['Sjm'],'sub'=>0,'canselected'=>1,'linkurl'=>'','keyword'=>'','askeyword'=>0),
array('module'=>'Zhaopin','linkcode'=>'{siteUrl}/index.php?g=Wap&m=Zhaopin&a=index&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}','name'=>$this->IIIIII1I111I['Zhaopin'],'sub'=>0,'canselected'=>1,'linkurl'=>'','keyword'=>'','askeyword'=>0),
array('module'=>'Fangchan','linkcode'=>'{siteUrl}/index.php?g=Wap&m=Fangchan&a=index&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}','name'=>$this->IIIIII1I111I['Fangchan'],'sub'=>0,'canselected'=>1,'linkurl'=>'','keyword'=>'','askeyword'=>0),
array('module'=>'Yingyong','linkcode'=>'{siteUrl}/index.php?g=Wap&m=Yingyong&a=index&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}','name'=>$this->IIIIII1I111I['Yingyong'],'sub'=>0,'canselected'=>1,'linkurl'=>'','keyword'=>'','askeyword'=>0),
array('module'=>'Business','linkcode'=>'','name'=>$this->IIIIII1I111I['Business'],'sub'=>1,'canselected'=>0,'linkurl'=>'','keyword'=>'','askeyword'=>1),
array('module'=>'Research','linkcode'=>'','name'=>$this->IIIIII1I111I['Research'],'sub'=>1,'canselected'=>0,'linkurl'=>'','keyword'=>'','askeyword'=>0),
array('module'=>'Baoming','linkcode'=>'{siteUrl}/index.php?g=Wap&m=Baoming&a=list&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}','name'=>'报名活动','sub'=>0,'canselected'=>1,'linkurl'=>'','keyword'=>'报名活动','askeyword'=>1),
array('module'=>'OutsideLink','linkcode'=>'','name'=>$this->IIIIII1I111I['OutsideLink'],'sub'=>1,'canselected'=>0,'linkurl'=>'','keyword'=>'','askeyword'=>0),
);
}
public function Classify(){
$this->assign('moduleName',$this->IIIIII1I111I['Classify']);
$IIIIIIIlIII1=M('Classify');
$IIIIIIIIlIl1=$this->IIIIIIIIlIl1;
$IIIIIIIII1ll      = $IIIIIIIlIII1->where($IIIIIIIIlIl1)->count();
$IIIIIIll1lll       = new Page($IIIIIIIII1ll,5);
$IIIIIIIII11l       = $IIIIIIll1lll->show();
$IIIIIIIIlIII=$IIIIIIIlIII1->where($IIIIIIIIlIl1)->limit($IIIIIIll1lll->firstRow.','.$IIIIIIll1lll->listRows)->order('id DESC')->select();
$IIIIII1lIII1=array();
if ($IIIIIIIIlIII){
foreach ($IIIIIIIIlIII as $IIIIII1Il1I1){
array_push($IIIIII1lIII1,array('id'=>$IIIIII1Il1I1['id'],'name'=>$IIIIII1Il1I1['name'],'linkcode'=>'{siteUrl}/index.php?g=Wap&m=Index&a=lists&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}&classid='.$IIIIII1Il1I1['id'],'linkurl'=>'','keyword'=>$IIIIII1Il1I1['keyword']));
}
}
$this->assign('list',$IIIIII1lIII1);
$this->assign('page',$IIIIIIIII11l);
$this->display('detail');
}
public function Img(){
$this->assign('moduleName',$this->IIIIII1I111I['Img']);
$IIIIIIIlIII1=M('Img');
$IIIIIIIIlIl1=$this->IIIIIIIIlIl1;
$IIIIIIIII1ll      = $IIIIIIIlIII1->where($IIIIIIIIlIl1)->count();
$IIIIIIll1lll       = new Page($IIIIIIIII1ll,5);
$IIIIIIIII11l       = $IIIIIIll1lll->show();
$IIIIIIIIlIII=$IIIIIIIlIII1->where($IIIIIIIIlIl1)->limit($IIIIIIll1lll->firstRow.','.$IIIIIIll1lll->listRows)->order('id DESC')->select();
$IIIIII1lIII1=array();
if ($IIIIIIIIlIII){
foreach ($IIIIIIIIlIII as $IIIIII1Il1I1){
array_push($IIIIII1lIII1,array('id'=>$IIIIII1Il1I1['id'],'name'=>$IIIIII1Il1I1['title'],'linkcode'=>'{siteUrl}/index.php?g=Wap&m=Index&a=content&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}&id='.$IIIIII1Il1I1['id'],'linkurl'=>'','keyword'=>$IIIIII1Il1I1['keyword']));
}
}
$this->assign('list',$IIIIII1lIII1);
$this->assign('page',$IIIIIIIII11l);
$this->display('detail');
}
public function Company(){
$this->assign('moduleName',$this->IIIIII1I111I['Company']);
$IIIIIIIlIII1=M('Company');
$IIIIIIIIlIl1=$this->IIIIIIIIlIl1;
$IIIIIIIII1ll      = $IIIIIIIlIII1->where($IIIIIIIIlIl1)->count();
$IIIIIIll1lll       = new Page($IIIIIIIII1ll,5);
$IIIIIIIII11l       = $IIIIIIll1lll->show();
$IIIIIIIIlIII=$IIIIIIIlIII1->where($IIIIIIIIlIl1)->limit($IIIIIIll1lll->firstRow.','.$IIIIIIll1lll->listRows)->order('id DESC')->select();
$IIIIII1lIII1=array();
if ($IIIIIIIIlIII){
foreach ($IIIIIIIIlIII as $IIIIII1Il1I1){
array_push($IIIIII1lIII1,array('id'=>$IIIIII1Il1I1['id'],'name'=>$IIIIII1Il1I1['name'],'linkcode'=>'http://api.map.baidu.com/marker?location='.$IIIIII1Il1I1['latitude'].','.$IIIIII1Il1I1['longitude'].'&title='.$IIIIII1Il1I1['shortname'].'&content='.$IIIIII1Il1I1['shortname'].'&output=html','linkurl'=>'','keyword'=>'地图'));
}
}
$this->assign('list',$IIIIII1lIII1);
$this->assign('page',$IIIIIIIII11l);
$this->display('detail');
}
public function Photo(){
$this->assign('moduleName',$this->IIIIII1I111I['Photo']);
$IIIIIIIlIII1=M('Photo');
$IIIIIIIIlIl1=$this->IIIIIIIIlIl1;
$IIIIIIIII1ll      = $IIIIIIIlIII1->where($IIIIIIIIlIl1)->count();
$IIIIIIll1lll       = new Page($IIIIIIIII1ll,5);
$IIIIIIIII11l       = $IIIIIIll1lll->show();
$IIIIIIIIlIII=$IIIIIIIlIII1->where($IIIIIIIIlIl1)->limit($IIIIIIll1lll->firstRow.','.$IIIIIIll1lll->listRows)->order('id DESC')->select();
$IIIIII1lIII1=array();
if ($IIIIIIIIlIII){
foreach ($IIIIIIIIlIII as $IIIIII1Il1I1){
array_push($IIIIII1lIII1,array('id'=>$IIIIII1Il1I1['id'],'name'=>$IIIIII1Il1I1['title'],'linkcode'=>'{siteUrl}/index.php?g=Wap&m=Photo&a=plist&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}&id='.$IIIIII1Il1I1['id'],'linkurl'=>'','keyword'=>'相册'));
}
}
$this->assign('list',$IIIIII1lIII1);
$this->assign('page',$IIIIIIIII11l);
$this->display('detail');
}
public function Yuyue(){
$this->assign('moduleName',$this->IIIIII1I111I['Yuyue']);
$IIIIIIIlIII1=M('Yuyue');
$IIIIIIIIlIl1=$this->IIIIIIIIlIl1;
$IIIIIIIII1ll      = $IIIIIIIlIII1->where(array('token'=>$this->IIIIIIIIlIlI,'type'=>'yuyue'))->count();
$IIIIIIll1lll       = new Page($IIIIIIIII1ll,5);
$IIIIIIIII11l       = $IIIIIIll1lll->show();
$IIIIIIIIlIII=$IIIIIIIlIII1->where(array('token'=>$this->IIIIIIIIlIlI,'type'=>'yuyue'))->limit($IIIIIIll1lll->firstRow.','.$IIIIIIll1lll->listRows)->order('id DESC')->select();
$IIIIII1lIII1=array();
if ($IIIIIIIIlIII){
foreach ($IIIIIIIIlIII as $IIIIII1Il1I1){
array_push($IIIIII1lIII1,array('id'=>$IIIIII1Il1I1['id'],'name'=>$IIIIII1Il1I1['title'],'linkcode'=>'{siteUrl}/index.php?g=Wap&m=Yuyue&a=index&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}&id='.$IIIIII1Il1I1['id'],'linkurl'=>'','keyword'=>$IIIIII1Il1I1['keyword']));
}
}
$this->assign('list',$IIIIII1lIII1);
$this->assign('page',$IIIIIIIII11l);
$this->display('detail');
}
public function Selfform(){
$this->assign('moduleName',$this->IIIIII1I111I['Selfform']);
$IIIIIIIlIII1=M('Selfform');
$IIIIIIIIlIl1=$this->IIIIIIIIlIl1;
$IIIIIIIII1ll      = $IIIIIIIlIII1->where($IIIIIIIIlIl1)->count();
$IIIIIIll1lll       = new Page($IIIIIIIII1ll,5);
$IIIIIIIII11l       = $IIIIIIll1lll->show();
$IIIIIIIIlIII=$IIIIIIIlIII1->where($IIIIIIIIlIl1)->limit($IIIIIIll1lll->firstRow.','.$IIIIIIll1lll->listRows)->order('id DESC')->select();
$IIIIII1lIII1=array();
if ($IIIIIIIIlIII){
foreach ($IIIIIIIIlIII as $IIIIII1Il1I1){
array_push($IIIIII1lIII1,array('id'=>$IIIIII1Il1I1['id'],'name'=>$IIIIII1Il1I1['name'],'linkcode'=>'{siteUrl}/index.php?g=Wap&m=Selfform&a=index&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}&id='.$IIIIII1Il1I1['id'],'linkurl'=>'','keyword'=>$IIIIII1Il1I1['keyword']));
}
}
$this->assign('list',$IIIIII1lIII1);
$this->assign('page',$IIIIIIIII11l);
$this->display('detail');
}
public function Custom(){
$this->assign('moduleName',$this->IIIIII1I111I['Selfform']);
$IIIIIIIlIII1=M('Custom_set');
$IIIIIIIIlIl1=$this->IIIIIIIIlIl1;
$IIIIIIIII1ll      = $IIIIIIIlIII1->where($IIIIIIIIlIl1)->count();
$IIIIIIll1lll       = new Page($IIIIIIIII1ll,5);
$IIIIIIIII11l       = $IIIIIIll1lll->show();
$IIIIIIIIlIII=$IIIIIIIlIII1->where($IIIIIIIIlIl1)->limit($IIIIIIll1lll->firstRow.','.$IIIIIIll1lll->listRows)->order('set_id DESC')->select();
$IIIIII1lIII1=array();
if ($IIIIIIIIlIII){
foreach ($IIIIIIIIlIII as $IIIIII1Il1I1){
array_push($IIIIII1lIII1,array('id'=>$IIIIII1Il1I1['set_id'],'name'=>$IIIIII1Il1I1['title'],'linkcode'=>'{siteUrl}/index.php?g=Wap&m=Custom&a=index&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}&id='.$IIIIII1Il1I1['set_id'],'linkurl'=>'','keyword'=>$IIIIII1Il1I1['keyword']));
}
}
$this->assign('list',$IIIIII1lIII1);
$this->assign('page',$IIIIIIIII11l);
$this->display('detail');
}
public function Host(){
$IIIIII1lIlIl='Host';
$this->assign('moduleName',$this->IIIIII1I111I[$IIIIII1lIlIl]);
$IIIIIIIlIII1=M($IIIIII1lIlIl);
$IIIIIIIIlIl1=$this->IIIIIIIIlIl1;
$IIIIIIIII1ll      = $IIIIIIIlIII1->where($IIIIIIIIlIl1)->count();
$IIIIIIll1lll       = new Page($IIIIIIIII1ll,5);
$IIIIIIIII11l       = $IIIIIIll1lll->show();
$IIIIIIIIlIII=$IIIIIIIlIII1->where($IIIIIIIIlIl1)->limit($IIIIIIll1lll->firstRow.','.$IIIIIIll1lll->listRows)->order('id DESC')->select();
$IIIIII1lIII1=array();
if ($IIIIIIIIlIII){
foreach ($IIIIIIIIlIII as $IIIIII1Il1I1){
array_push($IIIIII1lIII1,array('id'=>$IIIIII1Il1I1['id'],'name'=>$IIIIII1Il1I1['name'],'linkcode'=>'{siteUrl}/index.php?g=Wap&m=Host&a=index&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}&hid='.$IIIIII1Il1I1['id'],'linkurl'=>'','keyword'=>$IIIIII1Il1I1['keyword']));
}
}
$this->assign('list',$IIIIII1lIII1);
$this->assign('page',$IIIIIIIII11l);
$this->display('detail');
}
public function Panorama(){
$this->assign('moduleName',$this->IIIIII1I111I['Panorama']);
$IIIIIIIlIII1=M('Panorama');
$IIIIIIIIlIl1=$this->IIIIIIIIlIl1;
$IIIIIIIII1ll      = $IIIIIIIlIII1->where($IIIIIIIIlIl1)->count();
$IIIIIIll1lll       = new Page($IIIIIIIII1ll,5);
$IIIIIIIII11l       = $IIIIIIll1lll->show();
$IIIIIIIIlIII=$IIIIIIIlIII1->where($IIIIIIIIlIl1)->limit($IIIIIIll1lll->firstRow.','.$IIIIIIll1lll->listRows)->order('time DESC')->select();
$IIIIII1lIII1=array();
if ($IIIIIIIIlIII){
foreach ($IIIIIIIIlIII as $IIIIII1Il1I1){
array_push($IIIIII1lIII1,array('id'=>$IIIIII1Il1I1['id'],'name'=>$IIIIII1Il1I1['name'],'linkcode'=>'{siteUrl}/index.php?g=Wap&m=Panorama&a=item&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}&id='.$IIIIII1Il1I1['id'],'linkurl'=>'','keyword'=>$IIIIII1Il1I1['keyword']));
}
}
$this->assign('list',$IIIIII1lIII1);
$this->assign('page',$IIIIIIIII11l);
$this->display('detail');
}
public function Wedding(){
$IIIIII1lIlIl='Wedding';
$this->assign('moduleName',$this->IIIIII1I111I[$IIIIII1lIlIl]);
$IIIIIIIlIII1=M($IIIIII1lIlIl);
$IIIIIIIIlIl1=$this->IIIIIIIIlIl1;
$IIIIIIIII1ll      = $IIIIIIIlIII1->where($IIIIIIIIlIl1)->count();
$IIIIIIll1lll       = new Page($IIIIIIIII1ll,5);
$IIIIIIIII11l       = $IIIIIIll1lll->show();
$IIIIIIIIlIII=$IIIIIIIlIII1->where($IIIIIIIIlIl1)->limit($IIIIIIll1lll->firstRow.','.$IIIIIIll1lll->listRows)->order('id DESC')->select();
$IIIIII1lIII1=array();
if ($IIIIIIIIlIII){
foreach ($IIIIIIIIlIII as $IIIIII1Il1I1){
array_push($IIIIII1lIII1,array('id'=>$IIIIII1Il1I1['id'],'name'=>$IIIIII1Il1I1['title'],'linkcode'=>'{siteUrl}/index.php?g=Wap&m=Wedding&a=index&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}&id='.$IIIIII1Il1I1['id'],'linkurl'=>'','keyword'=>$IIIIII1Il1I1['keyword']));
}
}
$this->assign('list',$IIIIII1lIII1);
$this->assign('page',$IIIIIIIII11l);
$this->display('detail');
}
public function Lottery(){
$IIIIII1lIlIl='Lottery';
$this->assign('moduleName',$this->IIIIII1I111I[$IIIIII1lIlIl]);
$IIIIIIIlIII1=M($IIIIII1lIlIl);
$IIIIIIIIlIl1=$this->IIIIIIIIlIl1;
$IIIIIIIIlIl1['type']=1;
$IIIIIIIII1ll      = $IIIIIIIlIII1->where($IIIIIIIIlIl1)->count();
$IIIIIIll1lll       = new Page($IIIIIIIII1ll,5);
$IIIIIIIII11l       = $IIIIIIll1lll->show();
$IIIIIIIIlIII=$IIIIIIIlIII1->where($IIIIIIIIlIl1)->limit($IIIIIIll1lll->firstRow.','.$IIIIIIll1lll->listRows)->order('id DESC')->select();
$IIIIII1lIII1=array();
if ($IIIIIIIIlIII){
foreach ($IIIIIIIIlIII as $IIIIII1Il1I1){
array_push($IIIIII1lIII1,array('id'=>$IIIIII1Il1I1['id'],'name'=>$IIIIII1Il1I1['title'],'linkcode'=>'{siteUrl}/index.php?g=Wap&m=Lottery&a=index&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}&id='.$IIIIII1Il1I1['id'],'linkurl'=>'','keyword'=>$IIIIII1Il1I1['keyword']));
}
}
$this->assign('list',$IIIIII1lIII1);
$this->assign('page',$IIIIIIIII11l);
$this->display('detail');
}
public function Guajiang(){
$IIIIII1lIlIl='Guajiang';
$this->assign('moduleName',$this->IIIIII1I111I[$IIIIII1lIlIl]);
$IIIIIIIlIII1=M('Lottery');
$IIIIIIIIlIl1=$this->IIIIIIIIlIl1;
$IIIIIIIIlIl1['type']=2;
$IIIIIIIII1ll      = $IIIIIIIlIII1->where($IIIIIIIIlIl1)->count();
$IIIIIIll1lll       = new Page($IIIIIIIII1ll,5);
$IIIIIIIII11l       = $IIIIIIll1lll->show();
$IIIIIIIIlIII=$IIIIIIIlIII1->where($IIIIIIIIlIl1)->limit($IIIIIIll1lll->firstRow.','.$IIIIIIll1lll->listRows)->order('id DESC')->select();
$IIIIII1lIII1=array();
if ($IIIIIIIIlIII){
foreach ($IIIIIIIIlIII as $IIIIII1Il1I1){
array_push($IIIIII1lIII1,array('id'=>$IIIIII1Il1I1['id'],'name'=>$IIIIII1Il1I1['title'],'linkcode'=>'{siteUrl}/index.php?g=Wap&m=Guajiang&a=index&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}&id='.$IIIIII1Il1I1['id'],'linkurl'=>'','keyword'=>$IIIIII1Il1I1['keyword']));
}
}
$this->assign('list',$IIIIII1lIII1);
$this->assign('page',$IIIIIIIII11l);
$this->display('detail');
}
public function Coupon(){
$IIIIII1lIlIl='Coupon';
$this->assign('moduleName',$this->IIIIII1I111I[$IIIIII1lIlIl]);
$IIIIIIIlIII1=M('Lottery');
$IIIIIIIIlIl1=$this->IIIIIIIIlIl1;
$IIIIIIIIlIl1['type']=3;
$IIIIIIIII1ll      = $IIIIIIIlIII1->where($IIIIIIIIlIl1)->count();
$IIIIIIll1lll       = new Page($IIIIIIIII1ll,5);
$IIIIIIIII11l       = $IIIIIIll1lll->show();
$IIIIIIIIlIII=$IIIIIIIlIII1->where($IIIIIIIIlIl1)->limit($IIIIIIll1lll->firstRow.','.$IIIIIIll1lll->listRows)->order('id DESC')->select();
$IIIIII1lIII1=array();
if ($IIIIIIIIlIII){
foreach ($IIIIIIIIlIII as $IIIIII1Il1I1){
array_push($IIIIII1lIII1,array('id'=>$IIIIII1Il1I1['id'],'name'=>$IIIIII1Il1I1['title'],'linkcode'=>'{siteUrl}/index.php?g=Wap&m=Coupon&a=index&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}&id='.$IIIIII1Il1I1['id'],'linkurl'=>'','keyword'=>$IIIIII1Il1I1['keyword']));
}
}
$this->assign('list',$IIIIII1lIII1);
$this->assign('page',$IIIIIIIII11l);
$this->display('detail');
}
public function Vcard(){
$IIIIII1lIlIl='Vcard';
$this->assign('moduleName',$this->IIIIII1I111I[$IIIIII1lIlIl]);
$IIIIIIIlIII1=M('Vcard_list');
$IIIIIIIIlIl1=$this->IIIIIIIIlIl1;
$IIIIIIIII1ll      = $IIIIIIIlIII1->where($IIIIIIIIlIl1)->count();
$IIIIIIll1lll       = new Page($IIIIIIIII1ll,5);
$IIIIIIIII11l       = $IIIIIIll1lll->show();
$IIIIIIIIlIII=$IIIIIIIlIII1->where($IIIIIIIIlIl1)->limit($IIIIIIll1lll->firstRow.','.$IIIIIIll1lll->listRows)->order('id DESC')->select();
$IIIIII1lIII1=array();
if ($IIIIIIIIlIII){
foreach ($IIIIIIIIlIII as $IIIIII1Il1I1){
array_push($IIIIII1lIII1,array('id'=>$IIIIII1Il1I1['id'],'name'=>$IIIIII1Il1I1['name'],'linkcode'=>'{siteUrl}/index.php?g=Wap&m=Vcard&a=index&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}&id='.$IIIIII1Il1I1['id'],'linkurl'=>'','keyword'=>$IIIIII1Il1I1['name']));
}
}
$this->assign('list',$IIIIII1lIII1);
$this->assign('page',$IIIIIIIII11l);
$this->display('detail');
}
public function LuckyFruit(){
$IIIIII1lIlIl='LuckyFruit';
$this->assign('moduleName',$this->IIIIII1I111I[$IIIIII1lIlIl]);
$IIIIIIIlIII1=M('Lottery');
$IIIIIIIIlIl1=$this->IIIIIIIIlIl1;
$IIIIIIIIlIl1['type']=4;
$IIIIIIIII1ll      = $IIIIIIIlIII1->where($IIIIIIIIlIl1)->count();
$IIIIIIll1lll       = new Page($IIIIIIIII1ll,5);
$IIIIIIIII11l       = $IIIIIIll1lll->show();
$IIIIIIIIlIII=$IIIIIIIlIII1->where($IIIIIIIIlIl1)->limit($IIIIIIll1lll->firstRow.','.$IIIIIIll1lll->listRows)->order('id DESC')->select();
$IIIIII1lIII1=array();
if ($IIIIIIIIlIII){
foreach ($IIIIIIIIlIII as $IIIIII1Il1I1){
array_push($IIIIII1lIII1,array('id'=>$IIIIII1Il1I1['id'],'name'=>$IIIIII1Il1I1['title'],'linkcode'=>'{siteUrl}/index.php?g=Wap&m=LuckyFruit&a=index&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}&id='.$IIIIII1Il1I1['id'],'linkurl'=>'','keyword'=>$IIIIII1Il1I1['keyword']));
}
}
$this->assign('list',$IIIIII1lIII1);
$this->assign('page',$IIIIIIIII11l);
$this->display('detail');
}
public function GoldenEgg(){
$IIIIII1lIlIl='GoldenEgg';
$this->assign('moduleName',$this->IIIIII1I111I[$IIIIII1lIlIl]);
$IIIIIIIlIII1=M('Lottery');
$IIIIIIIIlIl1=$this->IIIIIIIIlIl1;
$IIIIIIIIlIl1['type']=5;
$IIIIIIIII1ll      = $IIIIIIIlIII1->where($IIIIIIIIlIl1)->count();
$IIIIIIll1lll       = new Page($IIIIIIIII1ll,5);
$IIIIIIIII11l       = $IIIIIIll1lll->show();
$IIIIIIIIlIII=$IIIIIIIlIII1->where($IIIIIIIIlIl1)->limit($IIIIIIll1lll->firstRow.','.$IIIIIIll1lll->listRows)->order('id DESC')->select();
$IIIIII1lIII1=array();
if ($IIIIIIIIlIII){
foreach ($IIIIIIIIlIII as $IIIIII1Il1I1){
array_push($IIIIII1lIII1,array('id'=>$IIIIII1Il1I1['id'],'name'=>$IIIIII1Il1I1['title'],'linkcode'=>'{siteUrl}/index.php?g=Wap&m=GoldenEgg&a=index&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}&id='.$IIIIII1Il1I1['id'],'linkurl'=>'','keyword'=>$IIIIII1Il1I1['keyword']));
}
}
$this->assign('list',$IIIIII1lIII1);
$this->assign('page',$IIIIIIIII11l);
$this->display('detail');
}
public function Research(){
$IIIIII1lIlIl='Research';
$this->assign('moduleName',$this->IIIIII1I111I[$IIIIII1lIlIl]);
$IIIIIIIlIII1=M('Research');
$IIIIIIIIlIl1=$this->IIIIIIIIlIl1;
$IIIIIIIII1ll      = $IIIIIIIlIII1->where($IIIIIIIIlIl1)->count();
$IIIIIIll1lll       = new Page($IIIIIIIII1ll,5);
$IIIIIIIII11l       = $IIIIIIll1lll->show();
$IIIIIIIIlIII=$IIIIIIIlIII1->where($IIIIIIIIlIl1)->limit($IIIIIIll1lll->firstRow.','.$IIIIIIll1lll->listRows)->order('id DESC')->select();
$IIIIII1lIII1=array();
if ($IIIIIIIIlIII){
foreach ($IIIIIIIIlIII as $IIIIII1Il1I1){
array_push($IIIIII1lIII1,array('id'=>$IIIIII1Il1I1['id'],'name'=>$IIIIII1Il1I1['title'],'linkcode'=>'{siteUrl}/index.php?g=Wap&m=Research&a=index&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}&reid='.$IIIIII1Il1I1['id'],'linkurl'=>'','keyword'=>$IIIIII1Il1I1['keyword']));
}
}
$this->assign('list',$IIIIII1lIII1);
$this->assign('page',$IIIIIIIII11l);
$this->display('detail');
}
public function GreetingCard(){
$IIIIII1lIlIl='GreetingCard';
$this->assign('moduleName',$this->IIIIII1I111I[$IIIIII1lIlIl]);
$IIIIIIIlIII1=M('greeting_card');
$IIIIIIIIlIl1=$this->IIIIIIIIlIl1;
$IIIIIIIII1ll      = $IIIIIIIlIII1->where($IIIIIIIIlIl1)->count();
$IIIIIIll1lll       = new Page($IIIIIIIII1ll,5);
$IIIIIIIII11l       = $IIIIIIll1lll->show();
$IIIIIIIIlIII=$IIIIIIIlIII1->where($IIIIIIIIlIl1)->limit($IIIIIIll1lll->firstRow.','.$IIIIIIll1lll->listRows)->order('id DESC')->select();
$IIIIII1lIII1=array();
if ($IIIIIIIIlIII){
foreach ($IIIIIIIIlIII as $IIIIII1Il1I1){
array_push($IIIIII1lIII1,array('id'=>$IIIIII1Il1I1['id'],'name'=>$IIIIII1Il1I1['title'],'linkcode'=>'{siteUrl}/index.php?g=Wap&m=Greeting_card&a=index&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}&id='.$IIIIII1Il1I1['id'],'linkurl'=>'','keyword'=>$IIIIII1Il1I1['keyword']));
}
}
$this->assign('list',$IIIIII1lIII1);
$this->assign('page',$IIIIIIIII11l);
$this->display('detail');
}
public function Vote(){
$IIIIII1lIlIl='Vote';
$this->assign('moduleName',$this->IIIIII1I111I[$IIIIII1lIlIl]);
$IIIIIIIlIII1=M($IIIIII1lIlIl);
$IIIIIIIIlIl1=$this->IIIIIIIIlIl1;
$IIIIIIIII1ll      = $IIIIIIIlIII1->where($IIIIIIIIlIl1)->count();
$IIIIIIll1lll       = new Page($IIIIIIIII1ll,5);
$IIIIIIIII11l       = $IIIIIIll1lll->show();
$IIIIIIIIlIII=$IIIIIIIlIII1->where($IIIIIIIIlIl1)->limit($IIIIIIll1lll->firstRow.','.$IIIIIIll1lll->listRows)->order('id DESC')->select();
$IIIIII1lIII1=array();
if ($IIIIIIIIlIII){
foreach ($IIIIIIIIlIII as $IIIIII1Il1I1){
array_push($IIIIII1lIII1,array('id'=>$IIIIII1Il1I1['id'],'name'=>$IIIIII1Il1I1['title'],'linkcode'=>'{siteUrl}/index.php?g=Wap&m=Vote&a=index&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}&id='.$IIIIII1Il1I1['id'],'linkurl'=>'','keyword'=>$IIIIII1Il1I1['keyword']));
}
}
$this->assign('list',$IIIIII1lIII1);
$this->assign('page',$IIIIIIIII11l);
$this->display('detail');
}
public function Shop(){
$IIIIII1lIlIl='Shop';
$this->assign('moduleName',$this->IIIIII1I111I[$IIIIII1lIlIl]);
$IIIIIIIlIII1=M('Product_cat');
$IIIIIIIIlIl1=array('dining'=>0,'token'=>$this->IIIIIIIIlIlI);
$IIIIIIIII1ll      = $IIIIIIIlIII1->where($IIIIIIIIlIl1)->count();
$IIIIIIll1lll       = new Page($IIIIIIIII1ll,5);
$IIIIIIIII11l       = $IIIIIIll1lll->show();
$IIIIIIIIlIII=$IIIIIIIlIII1->where($IIIIIIIIlIl1)->limit($IIIIIIll1lll->firstRow.','.$IIIIIIll1lll->listRows)->order('id DESC')->select();
$IIIIII1lIII1=array();
if ($IIIIIIIIlIII){
foreach ($IIIIIIIIlIII as $IIIIII1Il1I1){
array_push($IIIIII1lIII1,array('id'=>$IIIIII1Il1I1['id'],'name'=>$IIIIII1Il1I1['name'],'linkcode'=>'{siteUrl}/index.php?g=Wap&m=Store&a=products&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}&catid='.$IIIIII1Il1I1['id'],'linkurl'=>'','keyword'=>'商城'));
}
}
$this->assign('list',$IIIIII1lIII1);
$this->assign('page',$IIIIIIIII11l);
$this->display('detail');
}
public function Estate(){
$IIIIII1lIlIl='Estate';
$this->assign('moduleName',$this->IIIIII1I111I[$IIIIII1lIlIl]);
$IIIIII1lIII1=array();
array_push($IIIIII1lIII1,array('id'=>1,'name'=>'楼盘介绍','linkcode'=>'{siteUrl}/index.php?g=Wap&m=Estate&a=index&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}','linkurl'=>'','keyword'=>'微房产'));
array_push($IIIIII1lIII1,array('id'=>2,'name'=>'楼盘相册','linkcode'=>'{siteUrl}/index.php?g=Wap&m=Estate&a=album&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}','linkurl'=>'','keyword'=>'微房产'));
array_push($IIIIII1lIII1,array('id'=>3,'name'=>'户型全景','linkcode'=>'{siteUrl}/index.php?g=Wap&m=Estate&a=housetype&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}','linkurl'=>'','keyword'=>'微房产'));
array_push($IIIIII1lIII1,array('id'=>4,'name'=>'专家点评','linkcode'=>'{siteUrl}/index.php?g=Wap&m=Estate&a=impress&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}','linkurl'=>'','keyword'=>'微房产'));
$IIIIII1lI1l1=M('Estate')->where(array('token'=>$this->IIIIIIIIlIlI))->find();
$IIIIIII1lII1=M('Reservation')->where(array('id'=>$IIIIII1lI1l1['res_id']))->find();
array_push($IIIIII1lIII1,array('id'=>5,'name'=>'看房预约','linkcode'=>'{siteUrl}/index.php?g=Wap&m=Reservation&a=index&rid='.$IIIIII1lI1l1['res_id'].'&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}','linkurl'=>'','keyword'=>$IIIIIII1lII1['keyword']));
$this->assign('list',$IIIIII1lIII1);
$this->display('detail');
}
public function Car(){
$IIIIII1lIlIl='Car';
$this->assign('moduleName',$this->IIIIII1I111I[$IIIIII1lIlIl]);
$IIIIII1lI11l=M('Carset')->where(array('token'=>$this->IIIIIIIIlIlI))->find();
$IIIIII1lI111=M('Carnews')->where(array('token'=>$this->IIIIIIIIlIlI))->find();
$IIIIII1lIII1=array();
array_push($IIIIII1lIII1,array('id'=>1,'name'=>'经销车型','linkcode'=>'{siteUrl}/index.php?g=Wap&m=Car&a=brands&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}','linkurl'=>'','keyword'=>$IIIIII1lI11l['keyword']));
array_push($IIIIII1lIII1,array('id'=>2,'name'=>'销售顾问','linkcode'=>'{siteUrl}/index.php?g=Wap&m=Car&a=salers&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}','linkurl'=>'','keyword'=>$IIIIII1lI11l['keyword']));
array_push($IIIIII1lIII1,array('id'=>3,'name'=>'车主关怀','linkcode'=>'{siteUrl}/index.php?g=Wap&m=Car&a=owner&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}','linkurl'=>'','keyword'=>$IIIIII1lI11l['keyword']));
array_push($IIIIII1lIII1,array('id'=>4,'name'=>'车型欣赏','linkcode'=>'{siteUrl}/index.php?g=Wap&m=Car&a=showcar&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}','linkurl'=>'','keyword'=>$IIIIII1lI11l['keyword']));
array_push($IIIIII1lIII1,array('id'=>5,'name'=>'实用工具','linkcode'=>'{siteUrl}/index.php?g=Wap&m=Car&a=tool&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}','linkurl'=>'','keyword'=>$IIIIII1lI11l['keyword']));
array_push($IIIIII1lIII1,array('id'=>6,'name'=>'预约试驾','linkcode'=>'{siteUrl}/index.php?g=Wap&m=Car&a=CarReserveBook&addtype=drive&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}','linkurl'=>'','keyword'=>$IIIIII1lI11l['keyword']));
array_push($IIIIII1lIII1,array('id'=>7,'name'=>'预约保养','linkcode'=>'{siteUrl}/index.php?g=Wap&m=Car&a=CarReserveBook&addtype=maintain&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}','linkurl'=>'','keyword'=>$IIIIII1lI11l['keyword']));
array_push($IIIIII1lIII1,array('id'=>8,'name'=>'最新车讯','linkcode'=>'{siteUrl}/index.php?g=Wap&m=Index&a=lists&classid='.$IIIIII1lI111['news_id'].'&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}','linkurl'=>'','keyword'=>$IIIIII1lI11l['keyword']));
array_push($IIIIII1lIII1,array('id'=>9,'name'=>'最新优惠','linkcode'=>'{siteUrl}/index.php?g=Wap&m=Index&a=lists&classid='.$IIIIII1lI111['pre_id'].'&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}','linkurl'=>'','keyword'=>$IIIIII1lI11l['keyword']));
array_push($IIIIII1lIII1,array('id'=>10,'name'=>'尊享二手车','linkcode'=>'{siteUrl}/index.php?g=Wap&m=Index&a=lists&classid='.$IIIIII1lI111['usedcar_id'].'&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}','linkurl'=>'','keyword'=>$IIIIII1lI11l['keyword']));
array_push($IIIIII1lIII1,array('id'=>11,'name'=>'品牌相册','linkcode'=>'{siteUrl}/index.php?g=Wap&m=Photo&a=plist&id='.$IIIIII1lI111['album_id'].'&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}','linkurl'=>'','keyword'=>$IIIIII1lI11l['keyword']));
array_push($IIIIII1lIII1,array('id'=>12,'name'=>'店铺LBS','linkcode'=>'{siteUrl}/index.php?g=Wap&m=Company&a=map&companyid='.$IIIIII1lI111['company_id'].'&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}','linkurl'=>'','keyword'=>$IIIIII1lI11l['keyword']));
$this->assign('list',$IIIIII1lIII1);
$this->display('detail');
}
public function Medical(){
$IIIIII1lIlIl='Medical';
$this->assign('moduleName',$this->IIIIII1I111I[$IIIIII1lIlIl]);
$IIIIII1lI11l=M('Medical_set')->where(array('token'=>$this->IIIIIIIIlIlI))->find();
$IIIIII1lIII1=array();
array_push($IIIIII1lIII1,array('id'=>1,'name'=>'医院简介','linkcode'=>'{siteUrl}/index.php?g=Wap&m=Medical&a=Introduction&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}','linkurl'=>'','keyword'=>$IIIIII1lI11l['keyword']));
array_push($IIIIII1lIII1,array('id'=>2,'name'=>'热点聚焦','linkcode'=>'{siteUrl}/index.php?g=Wap&m=Medical&a=publicListTmp&type=hotfocus&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}','linkurl'=>'','keyword'=>$IIIIII1lI11l['keyword']));
array_push($IIIIII1lIII1,array('id'=>3,'name'=>'医院专家','linkcode'=>'{siteUrl}/index.php?g=Wap&m=Medical&&a=publicListTmp&type=experts&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}','linkurl'=>'','keyword'=>$IIIIII1lI11l['keyword']));
array_push($IIIIII1lIII1,array('id'=>4,'name'=>'尖端设备','linkcode'=>'{siteUrl}/index.php?g=Wap&m=Medical&a=publicListTmp&type=equipment&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}','linkurl'=>'','keyword'=>$IIIIII1lI11l['keyword']));
array_push($IIIIII1lIII1,array('id'=>5,'name'=>'康复案例','linkcode'=>'{siteUrl}/index.php?g=Wap&m=Medical&a=publicListTmp&type=rcase&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}','linkurl'=>'','keyword'=>$IIIIII1lI11l['keyword']));
array_push($IIIIII1lIII1,array('id'=>6,'name'=>'先进技术','linkcode'=>'{siteUrl}/index.php?g=Wap&m=Medical&&a=publicListTmp&type=technology&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}','linkurl'=>'','keyword'=>$IIIIII1lI11l['keyword']));
array_push($IIIIII1lIII1,array('id'=>6,'name'=>'研发药物','linkcode'=>'{siteUrl}/index.php?g=Wap&m=Medical&&a=publicListTmp&type=drug&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}','linkurl'=>'','keyword'=>$IIIIII1lI11l['keyword']));
array_push($IIIIII1lIII1,array('id'=>6,'name'=>'预约挂号','linkcode'=>'{siteUrl}/index.php?g=Wap&m=Medical&&a=registered&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}','linkurl'=>'','keyword'=>$IIIIII1lI11l['keyword']));
$this->assign('list',$IIIIII1lIII1);
$this->display('detail');
}
public function School(){
$IIIIII1lIlIl='School';
$this->assign('moduleName',$this->IIIIII1I111I[$IIIIII1lIlIl]);
$IIIIII1lI11l=M('Medical_set')->where(array('token'=>$this->IIIIIIIIlIlI))->find();
$IIIIII1lIII1=array();
array_push($IIIIII1lIII1,array('id'=>1,'name'=>'成绩查询','linkcode'=>'{siteUrl}/index.php?g=Wap&m=School&a=qresults&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}','linkurl'=>'','keyword'=>$IIIIII1lI11l['keyword']));
array_push($IIIIII1lIII1,array('id'=>1,'name'=>'食谱列表','linkcode'=>'{siteUrl}/index.php?g=Wap&m=School&a=public_list&type=school&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}','linkurl'=>'','keyword'=>$IIIIII1lI11l['keyword']));
$this->assign('list',$IIIIII1lIII1);
$this->display('detail');
}
public function OutsideLink(){
$IIIIIIIl1111 = include('./iMicms/Lib/ORG/Func.links.php');
$IIIIIIIllI11=0;
foreach ($IIIIIIIl1111['func'] as $IIIIIIIllIll=>$IIIIIIlIllII){
$IIIIIIIIlIII[$IIIIIIIllI11]['name'] = $IIIIIIlIllII;
$IIIIIIIIlIII[$IIIIIIIllI11]['code'] = $IIIIIIIllIll;
$IIIIIIIllI11++;
}
$this->assign('list',$IIIIIIIIlIII);
$this->display();
}
public function outsideLinkDetail(){
$IIIIIII11IIl = $this->_get('c');
$IIIIIIIl1111 = include('./iMicms/Lib/ORG/Func.links.php');
$IIIIIIIIlIII = $IIIIIIIl1111[$IIIIIII11IIl];
$this->assign('list',$IIIIIIIIlIII);
$this->display('OutsideLink');
}
public function Business(){
$this->assign('moduleName',$this->IIIIII1I111I['Business']);
$IIIIIIIlIII1=M('Busines');
$IIIIIIIIlIl1=$this->IIIIIIIIlIl1;
$IIIIIIIII1ll      = $IIIIIIIlIII1->where($IIIIIIIIlIl1)->count();
$IIIIIIll1lll       = new Page($IIIIIIIII1ll,5);
$IIIIIIIII11l       = $IIIIIIll1lll->show();
$IIIIIIIIlIII=$IIIIIIIlIII1->where($IIIIIIIIlIl1)->limit($IIIIIIll1lll->firstRow.','.$IIIIIIll1lll->listRows)->order('bid DESC')->select();
$IIIIII1lIII1=array();
if ($IIIIIIIIlIII){
foreach ($IIIIIIIIlIII as $IIIIII1Il1I1){
array_push($IIIIII1lIII1,array('bid'=>$IIIIII1Il1I1['bid'],'name'=>$IIIIII1Il1I1['mtitle'],'linkcode'=>'{siteUrl}/index.php?g=Wap&m=Business&a=index&token='.$this->IIIIIIIIlIlI.'&wecha_id={wechat_id}&bid='.$IIIIII1Il1I1['bid'].'&type='.$IIIIII1Il1I1['type'],'linkurl'=>'','keyword'=>$IIIIII1Il1I1['keyword']));
}
}
$this->assign('list',$IIIIII1lIII1);
$this->assign('page',$IIIIIIIII11l);
$this->display('detail');
}
}
?>