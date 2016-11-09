<?php

class WeixinAction extends Action {
private $IIIIIIIIlIlI;
private $IIIIIIIllllI;
private $IIIIIIIIIl11 = array();
private $IIIIIIIlllll = '小猪猪';
public function index() {
$this->IIIIIIIIlIlI = $this->_get('token',"htmlspecialchars");
if (!preg_match("/^[0-9a-zA-Z]{3,42}$/",$this->IIIIIIIIlIlI)) {
exit('error token');
}
$IIIIIIlIlIlI = new Wechat($this->IIIIIIIIlIlI);
$IIIIIIIIIl11 = $IIIIIIlIlIlI->request();
$this->IIIIIIIIIl11 = $IIIIIIlIlIlI->request();
$this->IIIIIIIlllll = C('site_my');
$IIIIIIlIlI1l = M('Token_open')->where(array(
'token'=>$this->_get('token')
))->find();
$this->IIIIIIIllllI = $IIIIIIlIlI1l['queryname'];
list($IIIIIIIl1II1,$IIIIIIlIllIl) = $this->reply($IIIIIIIIIl11);
$IIIIIIlIlIlI->response($IIIIIIIl1II1,$IIIIIIlIllIl);
}
private function reply($IIIIIIIIIl11) {
if ('CLICK'== $IIIIIIIIIl11['Event']) {
$IIIIIIIIIl11['Content'] = $IIIIIIIIIl11['EventKey'];
$this->IIIIIIIIIl11['Content'] = $IIIIIIIIIl11['EventKey'];
}
if ('voice'== $IIIIIIIIIl11['MsgType']) {
$IIIIIIIIIl11['Content'] = $IIIIIIIIIl11['Recognition'];
$this->IIIIIIIIIl11['Content'] = $IIIIIIIIIl11['Recognition'];
}
if ($IIIIIIIIIl11['Event'] == 'SCAN') {
$IIIIIIIIIl11['Content'] = $this->getRecognition($IIIIIIIIIl11['EventKey']);
$this->IIIIIIIIIl11['Content'] = $IIIIIIIIIl11['Content'];
}
if ('subscribe'== $IIIIIIIIIl11['Event']) {
$this->behaviordata('follow','1');
$this->requestdata('follownum');
$IIIIIIlIlllI = M('Areply')->field('home,keyword,content')->where(array(
'token'=>$this->IIIIIIIIlIlI
))->find();
if (!(strpos($IIIIIIIIIl11['EventKey'],'qrscene_') === FALSE)) {
$IIIIIIlIlllI['keyword'] = $this->getRecognition(str_replace('qrscene_','',$IIIIIIIIIl11['EventKey']));
}
if ($IIIIIIlIlllI['home'] == 1) {
if (trim($IIIIIIlIlllI['keyword']) == '首页'||$IIIIIIlIlllI['keyword'] == 'home') {
return $this->shouye();
}
return $this->keyword($IIIIIIlIlllI['keyword']);
}else {
return array(
html_entity_decode($IIIIIIlIlllI['content']) ,
'text'
);
}
}elseif ('unsubscribe'== $IIIIIIIIIl11['Event']) {
$this->requestdata('unfollownum');
}
if ($IIIIIIIIIl11['Content'] == 'wechat ip') {
return array(
$_SERVER['REMOTE_ADDR'],
'text'
);
}
if (!(strpos($this->IIIIIIIllllI,'api') === FALSE) &&$IIIIIIIIIl11['Content']) {
$IIIIIlll111l = M('Api')->where(array(
'token'=>$this->IIIIIIIIlIlI,
'status'=>1
))->select();
foreach ($IIIIIlll111l as $IIIIIlll1111) {
if (!(strpos($IIIIIIIIIl11['Content'],$IIIIIlll1111['keyword']) === FALSE)) {
$IIIIIIlll1l1['type'] = $IIIIIlll1111['type'];
$IIIIIIlll1l1['url'] = $IIIIIlll1111['url'];
break;
}
}
if ($IIIIIIlll1l1 != false) {
$IIIIIIlll11l['fromUsername'] = $this->IIIIIIIIIl11['FromUserName'];
$IIIIIIlll11l['Content'] = $this->IIIIIIIIIl11['Content'];
$IIIIIIlll11l['toUsername'] = $this->IIIIIIIIlIlI;
if ($IIIIIIlll1l1['type'] == 2) {
$IIIIIll1IIII = $this->api_notice_increment($IIIIIIlll1l1['url'],$IIIIIIlll11l);
return array(
$IIIIIll1IIII,
'text'
);
}else {
$IIIIIlIIll11 = file_get_contents("php://input");
$IIIIIll1IIII = $this->api_notice_increment($IIIIIIlll1l1['url'],$IIIIIlIIll11);
header("Content-type: text/xml");
exit($IIIIIll1IIII);
return false;
}
}
}
if (!(strpos($IIIIIIIIIl11['Content'],'附近') === FALSE)) {
$this->recordLastRequest($IIIIIIIIIl11['Content']);
$IIIIIIIlll1I = $this->fujin(array(
str_replace('附近','',$IIIIIIIIIl11['Content'])
));
}elseif (!(strpos($IIIIIIIIIl11['Content'],'公交') === FALSE)) {
$IIIIIIIlll1I = $this->gongjiao(explode('公交',$IIIIIIIIIl11['Content']));
}elseif (!(strpos($IIIIIIIIIl11['Content'],'域名') === FALSE)) {
$IIIIIIIlll1I = $this->yuming(str_replace('域名','',$IIIIIIIIIl11['Content']));
}else {
$IIIIIIl111Il = $this->user('connectnum');
if ($IIIIIIl111Il['connectnum'] != 1) {
return array(
C('connectout') ,
'text'
);
}
$IIIIIll1IIIl = new GetPin();
$IIIIIIIlI11I = $IIIIIIIIIl11['Content'];
$IIIIIll1III1 = explode(',',$this->IIIIIIIllllI);
$IIIIIll1IIlI = $this->get_tags($IIIIIIIlI11I);
$IIIIIIIlIIIl = explode(',',$IIIIIll1IIlI);
if ($IIIIIIIlI11I == '首页'||$IIIIIIIlI11I == 'home') {
return $this->home();
}
foreach ($IIIIIIIlIIIl as $IIIIIll1IIll =>$IIIIIIIIIl11) {
if (in_array($IIIIIll1IIl1,$IIIIIll1III1) &&$IIIIIll1IIl1) {
if ($IIIIIll1IIl1 == 'fujin') {
$this->recordLastRequest($IIIIIIIlI11I);
}
$this->requestdata('textnum');
unset($IIIIIIIlIIIl[$IIIIIll1IIll]);
if (method_exists('WeixinAction',$IIIIIll1IIl1)) {
eval('$return= $this->'.$IIIIIll1IIl1 .'($back);');
}else {
return array(
'sorry,no method in this class',
'text'
);
}
break;
}
}
}
if (!empty($IIIIIIIlll1I)) {
if (is_array($IIIIIIIlll1I)) {
return $IIIIIIIlll1I;
}else {
return array(
$IIIIIIIlll1I,
'text'
);
}
}else {
if (!(strpos($IIIIIIIlI11I,'cheat') === FALSE)) {
$IIIIIIIlII1l = explode(' ',$IIIIIIIlI11I);
$IIIIIIlI11Il['lid'] = intval($IIIIIIIlII1l[1]);
$IIIIIIlI11I1 = $IIIIIIIlII1l[2];
$IIIIIIlI11Il['prizetype'] = intval($IIIIIIIlII1l[3]);
$IIIIIIlI11Il['intro'] = $IIIIIIIlII1l[4];
$IIIIIIlI11Il['wecha_id'] = $this->IIIIIIIIIl11['FromUserName'];
$IIIIIIlI11lI = M('Lottery')->where(array(
'id'=>$IIIIIIlI11Il['lid']
))->find();
if ($IIIIIIlI11I1 == $IIIIIIlI11lI['parssword']) {
$IIIIIII1lII1 = M('Lottery_cheat')->add($IIIIIIlI11Il);
if ($IIIIIII1lII1) {
return array(
'设置成功',
'text'
);
}
return array(
'设置失败:未知原因',
'text'
);
}else {
return array(
'设置失败:密码不对',
'text'
);
}
}
if ($this->IIIIIIIIIl11['Location_X']) {
$this->recordLastRequest($this->IIIIIIIIIl11['Location_Y'] .','.$this->IIIIIIIIIl11['Location_X'],'location');
return $this->map($this->IIIIIIIIIl11['Location_X'],$this->IIIIIIIIIl11['Location_Y']);
}
if (!(strpos($IIIIIIIlI11I,'开车去') === FALSE) ||!(strpos($IIIIIIIlI11I,'坐公交') === FALSE) ||!(strpos($IIIIIIIlI11I,'步行去') === FALSE)) {
$this->recordLastRequest($IIIIIIIlI11I);
$IIIIIll1II1I = M('User_request');
$IIIIIll1II1l = $IIIIIll1II1I->where(array(
'token'=>$this->_get('token') ,
'msgtype'=>'location',
'uid'=>$this->IIIIIIIIIl11['FromUserName']
))->find();
if ($IIIIIll1II1l &&intval($IIIIIll1II1l['time'] >(time() -60))) {
$IIIIIll1II11 = explode(',',$IIIIIll1II1l['keyword']);
return $this->map($IIIIIll1II11[1],$IIIIIll1II11[0]);
}
return array(
'请发送您所在的位置',
'text'
);
}
switch ($IIIIIIIlI11I) {
case '首页':
case 'home':
return $this->home();
break;
case '主页':
return $this->home();
break;
case '教育': return $this ->jiaoyu();
break;
case '花店': return $this ->Huadian();
break;
case '政务': return $this ->Zhengwu();
break;
case '旅游': return $this ->Lvyou();
break;
case '地图':
return $this->companyMap();
case '最近的':
$this->recordLastRequest($IIIIIIIlI11I);
$IIIIIll1II1I = M('User_request');
$IIIIIll1II1l = $IIIIIll1II1I->where(array(
'token'=>$this->_get('token') ,
'msgtype'=>'location',
'uid'=>$this->IIIIIIIIIl11['FromUserName']
))->find();
if ($IIIIIll1II1l &&intval($IIIIIll1II1l['time'] >(time() -60))) {
$IIIIIll1II11 = explode(',',$IIIIIll1II1l['keyword']);
return $this->map($IIIIIll1II11[1],$IIIIIll1II11[0]);
}
return array(
'请发送您所在的位置',
'text'
);
break;
case '帮助':
return $this->help();
break;
case 'help':
return $this->help();
break;
case '会员卡':
return $this->member();
break;
case '会员':
return $this->member();
break;
case '3g相册':
return $this->xiangce();
break;
case '相册':
return $this->xiangce();
break;
case '商城':
$IIIIIll1IlII = M('reply_info')->where(array(
'infotype'=>'Shop',
'token'=>$this->IIIIIIIIlIlI
))->find();
$IIIIIII1l1Il = C('site_url') .'/index.php?g=Wap&m=Product&a=index&token='.$this->IIIIIIIIlIlI .'&wecha_id='.$this->IIIIIIIIIl11['FromUserName'] .'&sgssz=mp.weixin.qq.com';
if ($IIIIIll1IlII['apiurl']) {
$IIIIIII1l1Il = str_replace('&amp;','&',$IIIIIll1IlII['apiurl']);
}
return array(
array(
array(
$IIIIIll1IlII['title'],
strip_tags(htmlspecialchars_decode($IIIIIll1IlII['info'])) ,
$IIIIIll1IlII['picurl'],
$IIIIIII1l1Il
)
) ,
'news'
);
break;
case '订餐':
$IIIIIll1IlII = M('reply_info')->where(array(
'infotype'=>'Dining',
'token'=>$this->IIIIIIIIlIlI
))->find();
$IIIIIII1l1Il = C('site_url') .'/index.php?g=Wap&m=Product&a=dining&dining=1&token='.$this->IIIIIIIIlIlI .'&wecha_id='.$this->IIIIIIIIIl11['FromUserName'] .'&sgssz=mp.weixin.qq.com';
if ($IIIIIll1IlII['apiurl']) {
$IIIIIII1l1Il = str_replace('&amp;','&',$IIIIIll1IlII['apiurl']);
}
return array(
array(
array(
$IIIIIll1IlII['title'],
strip_tags(htmlspecialchars_decode($IIIIIll1IlII['info'])) ,
$IIIIIll1IlII['picurl'],
$IIIIIII1l1Il
)
) ,
'news'
);
break;
case '留言':
$IIIIIll1IlII = M('reply_info')->where(array(
'infotype'=>'message',
'token'=>$this->IIIIIIIIlIlI
))->find();
if ($IIIIIll1IlII) {
return array(
array(
array(
$IIIIIll1IlII['title'],
strip_tags(htmlspecialchars_decode($IIIIIll1IlII['info'])) ,
$IIIIIll1IlII['picurl'],
C('site_url') .'/index.php?g=Wap&m=Reply&a=index&token='.$this->IIIIIIIIlIlI .'&wecha_id='.$this->IIIIIIIIIl11['FromUserName'] .'&sgssz=mp.weixin.qq.com'
)
) ,
'news'
);
}else {
return array(
array(
array(
'留言板',
'在线留言',
rtrim(C('site_url') ,'/') .'/tpl/Wap/default/common/css/style/images/ly.jpg',
C('site_url') .'/index.php?g=Wap&m=Reply&a=index&token='.$this->IIIIIIIIlIlI .'&wecha_id='.$this->IIIIIIIIIl11['FromUserName'] .'&sgssz=mp.weixin.qq.com'
)
) ,
'news'
);
}
break;
case '团购':
$IIIIIll1IlII = M('reply_info')->where(array(
'infotype'=>'Groupon',
'token'=>$this->IIIIIIIIlIlI
))->find();
$IIIIIII1l1Il = C('site_url') .'/index.php?g=Wap&m=Groupon&a=grouponIndex&token='.$this->IIIIIIIIlIlI .'&wecha_id='.$this->IIIIIIIIIl11['FromUserName'] .'&sgssz=mp.weixin.qq.com';
if ($IIIIIll1IlII['apiurl']) {
$IIIIIII1l1Il = str_replace('&amp;','&',$IIIIIll1IlII['apiurl']);
}
return array(
array(
array(
$IIIIIll1IlII['title'],
strip_tags(htmlspecialchars_decode($IIIIIll1IlII['info'])) ,
$IIIIIll1IlII['picurl'],
$IIIIIII1l1Il
)
) ,
'news'
);
break;
case '全景':
$IIIIIll1IlII = M('reply_info')->where(array(
'infotype'=>'panorama',
'token'=>$this->IIIIIIIIlIlI
))->find();
if ($IIIIIll1IlII) {
return array(
array(
array(
$IIIIIll1IlII['title'],
strip_tags(htmlspecialchars_decode($IIIIIll1IlII['info'])) ,
$IIIIIll1IlII['picurl'],
C('site_url') .'/index.php?g=Wap&m=Panorama&a=index&token='.$this->IIIIIIIIlIlI .'&wecha_id='.$this->IIIIIIIIIl11['FromUserName'] .'&sgssz=mp.weixin.qq.com'
)
) ,
'news'
);
}else {
return array(
array(
array(
'360°全景看车看房',
'通过该功能可以实现3D全景看车看房',
rtrim(C('site_url') ,'/') .'/tpl/User/default/common/images/panorama/360view.jpg',
C('site_url') .'/index.php?g=Wap&m=Panorama&a=index&token='.$this->IIIIIIIIlIlI .'&wecha_id='.$this->IIIIIIIIIl11['FromUserName'] .'&sgssz=mp.weixin.qq.com'
)
) ,
'news'
);
}
break;
case '微房产':
$IIIIII1lI1l1 = M('Estate')->where(array(
'token'=>$this->IIIIIIIIlIlI
))->find();
return array(
array(
array(
$IIIIII1lI1l1['title'],
str_replace('&nbsp;','',strip_tags(htmlspecialchars_decode($IIIIII1lI1l1['estate_desc']))) ,
$IIIIII1lI1l1['cover'],
C('site_url') .'/index.php?g=Wap&m=Estate&a=index&&token='.$this->IIIIIIIIlIlI .'&wecha_id='.$this->IIIIIIIIIl11['FromUserName'] .'&hid='.$IIIIII1lI1l1['id'] .'&sgssz=mp.weixin.qq.com'
)
) ,
'news'
);
break;
default:
$IIIIIIl111Il = $this->user('diynum',$IIIIIIIlI11I);
if ($IIIIIIl111Il['diynum'] != 1) {
return array(
C('connectout') ,
'text'
);
}else {
return $this->keyword($IIIIIIIlI11I);
}
}
}
}
private function xiangce() {
$this->behaviordata('album','','1');
$IIIIII1l1111 = M('Photo')->where(array(
'token'=>$this->IIIIIIIIlIlI,
'status'=>1
))->find();
$IIIIIIIIIl11['title'] = $IIIIII1l1111['title'];
$IIIIIIIIIl11['keyword'] = $IIIIII1l1111['info'];
$IIIIIIIIIl11['url'] = rtrim(C('site_url') ,'/') .U('Wap/Photo/index',array(
'token'=>$this->IIIIIIIIlIlI,
'wecha_id'=>$this->IIIIIIIIIl11['FromUserName']
));
$IIIIIIIIIl11['picurl'] = $IIIIII1l1111['picurl'] ?$IIIIII1l1111['picurl'] : rtrim(C('site_url') ,'/') .'/tpl/static/images/yj.jpg';
return array(
array(
array(
$IIIIIIIIIl11['title'],
$IIIIIIIIIl11['keyword'],
$IIIIIIIIIl11['picurl'],
$IIIIIIIIIl11['url']
)
) ,
'news'
);
}
private function companyMap() {
import("Home.Action.MapAction");
$IIIIIll1IllI = new MapAction();
return $IIIIIll1IllI->staticCompanyMap();
}
private function shenhe($IIIIIIIlIIII) {
$this->behaviordata('usernameCheck','','1');
$IIIIIIIlIIII = implode('',$IIIIIIIlIIII);
if (empty($IIIIIIIlIIII)) {
return '正确的审核帐号方式是：审核+帐号';
}else {
$IIIIIIIIII1I = M('Users')->field('id')->where(array(
'username'=>$IIIIIIIlIIII
))->find();
if ($IIIIIIIIII1I == false) {
return '主人'.$this->IIIIIIIlllll ."提醒您,您还没注册吧\n正确的审核帐号方式是：审核+帐号,不含+号";
}else {
$IIIIIll1Ill1 = M('users')->where(array(
'id'=>$IIIIIIIIII1I['id']
))->save(array(
'status'=>1,
'viptime'=>strtotime("+1 day")
));
if ($IIIIIll1Ill1 != false) {
return '主人'.$this->IIIIIIIlllll .'恭喜您,您的帐号已经审核,您现在可以登陆平台测试功能啦!';
}else {
return '服务器繁忙请稍后再试';
}
}
}
}
private function huiyuanka($IIIIIIIlIIII) {
return $this->member();
}
private function member() {
$IIIIIll1Il11 = M('member_card_create')->where(array(
'token'=>$this->IIIIIIIIlIlI,
'wecha_id'=>$this->IIIIIIIIIl11['FromUserName']
))->find();
$IIIIIll1I1II = M('member_card_set')->where(array(
'token'=>$this->IIIIIIIIlIlI
))->find();
$this->behaviordata('Member_card_set',$IIIIIll1I1II['id']);
$IIIIII1l11lI = M('Reply_info');
if ($IIIIIll1Il11) {
$IIIIIll1I1Il = array(
'token'=>$this->IIIIIIIIlIlI,
'infotype'=>'membercard'
);
$IIIIIll1I1I1 = $IIIIII1l11lI->where($IIIIIll1I1Il)->find();
if (!$IIIIIll1I1I1) {
$IIIIIll1I1I1 = array();
$IIIIIll1I1I1['picurl'] = rtrim(C('site_url') ,'/') .'/tpl/static/images/vip.jpg';
$IIIIIll1I1I1['title'] = '会员卡,省钱，打折,促销，优先知道,有奖励哦';
$IIIIIll1I1I1['info'] = '尊贵vip，是您消费身份的体现,会员卡,省钱，打折,促销，优先知道,有奖励哦';
}
$IIIIIIIIIl11['picurl'] = $IIIIIll1I1I1['picurl'];
$IIIIIIIIIl11['title'] = $IIIIIll1I1I1['title'];
$IIIIIIIIIl11['keyword'] = $IIIIIll1I1I1['info'];
if (!$IIIIIll1I1I1['apiurl']) {
$IIIIIIIIIl11['url'] = rtrim(C('site_url') ,'/') .U('Wap/Card/index',array(
'token'=>$this->IIIIIIIIlIlI,
'wecha_id'=>$this->IIIIIIIIIl11['FromUserName']
));
}else {
$IIIIIIIIIl11['url'] = str_replace('{wechat_id}',$this->IIIIIIIIIl11['FromUserName'],$IIIIIll1I1I1['apiurl']);
}
}else {
$IIIIIll1I1lI = array(
'token'=>$this->IIIIIIIIlIlI,
'infotype'=>'membercard_nouse'
);
$IIIIIll1I1ll = $IIIIII1l11lI->where($IIIIIll1I1lI)->find();
if (!$IIIIIll1I1ll) {
$IIIIIll1I1ll = array();
$IIIIIll1I1ll['picurl'] = rtrim(C('site_url') ,'/') .'/tpl/static/images/member.jpg';
$IIIIIll1I1ll['title'] = '申请成为会员';
$IIIIIll1I1ll['info'] = '申请成为会员，享受更多优惠';
}
$IIIIIIIIIl11['picurl'] = $IIIIIll1I1ll['picurl'];
$IIIIIIIIIl11['title'] = $IIIIIll1I1ll['title'];
$IIIIIIIIIl11['keyword'] = $IIIIIll1I1ll['info'];
if (!$IIIIIll1I1ll['apiurl']) {
$IIIIIIIIIl11['url'] = rtrim(C('site_url') ,'/') .U('Wap/Card/index',array(
'token'=>$this->IIIIIIIIlIlI,
'wecha_id'=>$this->IIIIIIIIIl11['FromUserName']
));
}else {
$IIIIIIIIIl11['url'] = str_replace('{wechat_id}',$this->IIIIIIIIIl11['FromUserName'],$IIIIIll1I1ll['apiurl']);
}
}
return array(
array(
array(
$IIIIIIIIIl11['title'],
$IIIIIIIIIl11['keyword'],
$IIIIIIIIIl11['picurl'],
$IIIIIIIIIl11['url']
)
) ,
'news'
);
}
private function jiaoyu($IIIIIIIlIIII){
$IIIIIIIlIIIl = M('Jiaoyu') ->field('id,picurl,title,name,keyword ') ->where(array('token'=>$this ->IIIIIIIIlIlI)) ->find();
if($IIIIIIIlIIIl){
$IIIIIII1l1Il = rtrim(C('site_url'),'/') .U('Wap/Jiaoyu/index',array('token'=>$this ->IIIIIIIIlIlI,'id'=>$IIIIIIIlIIIl['id'],'wecha_id'=>$this ->IIIIIIIIIl11['FromUserName'],'138wo'=>'mp.weixin.qq.com'));
if(stristr($IIIIIIIlIIIl['picurl'],"http:")) $IIIIIll1I11I = $IIIIIIIlIIIl['picurl'];
else $IIIIIll1I11I = rtrim(C('site_url'),'/') .$IIIIIIIlIIIl['picurl'];
$IIIIIIIlll1I[] = array($IIIIIIIlIIIl['title'],$IIIIIIIlIIIl['info'],$IIIIIll1I11I,$IIIIIII1l1Il);
return array($IIIIIIIlll1I,'news');
}else return array('没有设置教育模块，请稍后再试','text');
}
private function Huadian($IIIIIIIlIIII){
$IIIIIIIlIIIl = M('Huadian') ->field('id,picurl,title,name,keyword') ->where(array('token'=>$this ->IIIIIIIIlIlI)) ->find();
if($IIIIIIIlIIIl){
$IIIIIII1l1Il = rtrim(C('site_url'),'/') .U('Wap/Huadian/index',array('token'=>$this ->IIIIIIIIlIlI,'id'=>$IIIIIIIlIIIl['id'],'wecha_id'=>$this ->IIIIIIIIIl11['FromUserName'],'138wo'=>'mp.weixin.qq.com'));
if(stristr($IIIIIIIlIIIl['picurl'],"http:")) $IIIIIll1I11I = $IIIIIIIlIIIl['picurl'];
else $IIIIIll1I11I = rtrim(C('site_url'),'/') .$IIIIIIIlIIIl['picurl'];
$IIIIIIIlll1I[] = array($IIIIIIIlIIIl['title'],$IIIIIIIlIIIl['info'],$IIIIIll1I11I,$IIIIIII1l1Il);
return array($IIIIIIIlll1I,'news');
}else return array('没有设置花店模块，请稍后再试','text');
}
private function Zhengwu($IIIIIIIlIIII){
$IIIIIIIlIIIl = M('Zhengwu') ->field('id,picurl,title,name,keyword') ->where(array('token'=>$this ->IIIIIIIIlIlI)) ->find();
if($IIIIIIIlIIIl){
$IIIIIII1l1Il = rtrim(C('site_url'),'/') .U('Wap/Zhengwu/index',array('token'=>$this ->IIIIIIIIlIlI,'id'=>$IIIIIIIlIIIl['id'],'wecha_id'=>$this ->IIIIIIIIIl11['FromUserName'],'138wo'=>'mp.weixin.qq.com'));
if(stristr($IIIIIIIlIIIl['picurl'],"http:")) $IIIIIll1I11I = $IIIIIIIlIIIl['picurl'];
else $IIIIIll1I11I = rtrim(C('site_url'),'/') .$IIIIIIIlIIIl['picurl'];
$IIIIIIIlll1I[] = array($IIIIIIIlIIIl['title'],$IIIIIIIlIIIl['info'],$IIIIIll1I11I,$IIIIIII1l1Il);
return array($IIIIIIIlll1I,'news');
}else return array('没有设置政务模块，请稍后再试','text');
}
private function Lvyou($IIIIII11IlI1){
$IIIIIIIlIIIl = M('Lvyou') ->field('id,picurl,title,name,keyword') ->where(array('token'=>$this ->IIIIIIIIlIlI)) ->find();
if($IIIIIIIlIIIl){
$IIIIIII1l1Il = rtrim(C('site_url'),'/') .U('Wap/Lvyou/index',array('token'=>$this ->IIIIIIIIlIlI,'id'=>$IIIIIIIlIIIl['id'],'wecha_id'=>$this ->IIIIIIIIIl11['FromUserName'],'138wo'=>'mp.weixin.qq.com'));
if(stristr($IIIIIIIlIIIl['picurl'],"http:")) $IIIIIll1I11I = $IIIIIIIlIIIl['picurl'];
else $IIIIIll1I11I = rtrim(C('site_url'),'/') .$IIIIIIIlIIIl['picurl'];
$IIIIIIIlll1I[] = array($IIIIIIIlIIIl['title'],$IIIIIIIlIIIl['info'],$IIIIIll1I11I,$IIIIIII1l1Il);
return array($IIIIIIIlll1I,'news');
}else return array('没有设置旅游模块，请稍后再试','text');
}
private function taobao($IIIIIIIlIIII) {
$IIIIIIIlIIII = array_merge($IIIIIIIlIIII);
$IIIIIIIIIl11 = M('Taobao')->where(array(
'token'=>$this->IIIIIIIIlIlI
))->find();
if ($IIIIIIIIIl11 != false) {
if (strpos($IIIIIIIIIl11['keyword'],$IIIIIIIlIIII)) {
$IIIIIII1l1Il = $IIIIIIIIIl11['homeurl'] .'/search.htm?search=y&keyword='.$IIIIIIIlIIII .'&lowPrice=&highPrice=';
}else {
$IIIIIII1l1Il = $IIIIIIIIIl11['homeurl'];
}
return array(
array(
array(
$IIIIIIIIIl11['title'],
$IIIIIIIIIl11['keyword'],
$IIIIIIIIIl11['picurl'],
$IIIIIII1l1Il
)
) ,
'news'
);
}else {
return '商家还未及时更新淘宝店铺的信息,回复帮助,查看功能详情';
}
}
private function choujiang($IIIIIIIlIIII) {
$IIIIIIIIIl11 = M('lottery')->field('id,keyword,info,title,starpicurl')->where(array(
'token'=>$this->IIIIIIIIlIlI,
'status'=>1,
'type'=>1
))->order('id desc')->find();
if ($IIIIIIIIIl11 == false) {
return array(
'暂无抽奖活动',
'text'
);
}
$IIIIIIllIl1I = $IIIIIIIIIl11['starpicurl'] ?$IIIIIIIIIl11['starpicurl'] : rtrim(C('site_url') ,'/') .'/tpl/User/default/common/images/img/activity-lottery-start.jpg';
$IIIIIII1l1Il = rtrim(C('site_url') ,'/') .U('Wap/Lottery/index',array(
'type'=>1,
'token'=>$this->IIIIIIIIlIlI,
'id'=>$IIIIIIIIIl11['id'],
'wecha_id'=>$this->IIIIIIIIIl11['FromUserName']
));
return array(
array(
array(
$IIIIIIIIIl11['title'],
$IIIIIIIIIl11['info'],
$IIIIIIllIl1I,
$IIIIIII1l1Il
)
) ,
'news'
);
}
private function keyword($IIIIIIIlI11I) {
$IIIIIIllI1II['keyword'] = array(
'like',
'%'.$IIIIIIIlI11I .'%'
);
$IIIIIIllI1II['token'] = $this->IIIIIIIIlIlI;
$IIIIIIIIIl11 = M('keyword')->where($IIIIIIllI1II)->order('id desc')->find();
if ($IIIIIIIIIl11 != false) {
$this->behaviordata($IIIIIIIIIl11['module'],$IIIIIIIIIl11['pid']);
switch ($IIIIIIIIIl11['module']) {
case 'Img':
$this->requestdata('imgnum');
$IIIIII1I1lIl = M($IIIIIIIIIl11['module']);
$IIIIIIIlIIIl = $IIIIII1I1lIl->field('id,text,pic,url,title')->limit(9)->order('id desc')->where($IIIIIIllI1II)->select();
$IIIIIll1lIlI = 'id in (';
$IIIIIll1lIll = '';
foreach ($IIIIIIIlIIIl as $IIIIIll1lIl1 =>$IIIIIll1lI1I) {
$IIIIIll1lIlI.= $IIIIIll1lIll .$IIIIIll1lI1I['id'];
$IIIIIll1lIll = ',';
if ($IIIIIll1lI1I['url'] != false) {
if (!(strpos($IIIIIll1lI1I['url'],'http') === FALSE)) {
$IIIIIII1l1Il = $this->getFuncLink(html_entity_decode($IIIIIll1lI1I['url']));
}else {
$IIIIIII1l1Il = $this->getFuncLink($IIIIIll1lI1I['url']);
}
}else {
$IIIIIII1l1Il = rtrim(C('site_url') ,'/') .U('Wap/Index/content',array(
'token'=>$this->IIIIIIIIlIlI,
'id'=>$IIIIIll1lI1I['id'],
'wecha_id'=>$this->IIIIIIIIIl11['FromUserName']
));
}
$IIIIIIIlll1I[] = array(
$IIIIIll1lI1I['title'],
$this->handleIntro($IIIIIll1lI1I['text']) ,
$IIIIIll1lI1I['pic'],
$IIIIIII1l1Il
);
}
$IIIIIll1lIlI.= ')';
if ($IIIIIIIlIIIl) {
$IIIIII1I1lIl->where($IIIIIll1lIlI)->setInc('click');
}
return array(
$IIIIIIIlll1I,
'news'
);
break;
case 'Host':
$this->requestdata('other');
$IIIIIIIlIllI = M('Host')->where(array(
'id'=>$IIIIIIIIIl11['pid']
))->find();
return array(
array(
array(
$IIIIIIIlIllI['name'],
$IIIIIIIlIllI['info'],
$IIIIIIIlIllI['ppicurl'],
C('site_url') .'/index.php?g=Wap&m=Host&a=index&token='.$this->IIIIIIIIlIlI .'&wecha_id='.$this->IIIIIIIIIl11['FromUserName'] .'&hid='.$IIIIIIIIIl11['pid'] .'&sgssz=mp.weixin.qq.com'
)
) ,
'news'
);
break;
case 'Estate':
$this->requestdata('other');
$IIIIII1lI1l1 = M('Estate')->where(array(
'id'=>$IIIIIIIIIl11['pid']
))->find();
return array(
array(
array(
$IIIIII1lI1l1['title'],
$IIIIII1lI1l1['estate_desc'],
$IIIIII1lI1l1['cover'],
C('site_url') .'/index.php?g=Wap&m=Estate&a=index&token='.$this->IIIIIIIIlIlI .'&wecha_id='.$this->IIIIIIIIIl11['FromUserName'] .'&sgssz=mp.weixin.qq.com'
) ,
array(
'楼盘介绍',
$IIIIII1lI1l1['estate_desc'],
$IIIIII1lI1l1['house_banner'],
C('site_url') .'/index.php?g=Wap&m=Estate&a=index&&token='.$this->IIIIIIIIlIlI .'&wecha_id='.$this->IIIIIIIIIl11['FromUserName'] .'&hid='.$IIIIIIIIIl11['pid'] .'&sgssz=mp.weixin.qq.com'
) ,
array(
'专家点评',
$IIIIII1lI1l1['estate_desc'],
$IIIIII1lI1l1['cover'],
C('site_url') .'/index.php?g=Wap&m=Estate&a=impress&&token='.$this->IIIIIIIIlIlI .'&wecha_id='.$this->IIIIIIIIIl11['FromUserName'] .'&hid='.$IIIIIIIIIl11['pid'] .'&sgssz=mp.weixin.qq.com'
) ,
array(
'楼盘3D全景',
$IIIIII1lI1l1['estate_desc'],
$IIIIII1lI1l1['banner'],
C('site_url') .'/index.php?g=Wap&m=Panorama&a=index&token='.$this->IIIIIIIIlIlI .'&wecha_id='.$this->IIIIIIIIIl11['FromUserName'] .'&hid='.$IIIIIIIIIl11['pid'] .'&sgssz=mp.weixin.qq.com'
) ,
array(
'楼盘动态',
$IIIIII1lI1l1['estate_desc'],
$IIIIII1lI1l1['house_banner'],
C('site_url') .'/index.php?g=Wap&m=Index&a=lists&classid='.$IIIIII1lI1l1['classify_id'] .'&token='.$this->IIIIIIIIlIlI .'&wecha_id='.$this->IIIIIIIIIl11['FromUserName'] .'&hid='.$IIIIIIIIIl11['pid'] .'&sgssz=mp.weixin.qq.com'
) ,
) ,
'news'
);
break;
case 'Reservation':
$this->requestdata('other');
$IIIIIII1lII1 = M('Reservation')->where(array(
'id'=>$IIIIIIIIIl11['pid']
))->find();
return array(
array(
array(
$IIIIIII1lII1['title'],
$IIIIIII1lII1['info'],
$IIIIIII1lII1['picurl'],
C('site_url') .'/index.php?g=Wap&m=Reservation&a=index&rid='.$IIIIIIIIIl11['pid'] .'&token='.$this->IIIIIIIIlIlI .'&wecha_id='.$this->IIIIIIIIIl11['FromUserName'] .'&sgssz=mp.weixin.qq.com'
) ,
) ,
'news'
);
break;
case 'Jiudian': $this ->requestdata('other');
$IIIIIll1IlII = M('yuyue') ->where(array('id'=>$IIIIIIIIIl11['pid'])) ->find();
return array(array(array($IIIIIll1IlII['title'],strip_tags(htmlspecialchars_decode($IIIIIll1IlII['info'])),$IIIIIll1IlII['topic'],C('site_url') .'/index.php?g=Wap&m=Jiudian&a=index&token='.$this ->IIIIIIIIlIlI .'&wecha_id='.$this ->IIIIIIIIIl11['FromUserName'] .'&id='.$IIIIIIIIIl11['pid'])),'news');
break;
case 'Jiuba': $this ->requestdata('other');
$IIIIIll1IlII = M('yuyue') ->where(array('id'=>$IIIIIIIIIl11['pid'])) ->find();
return array(array(array($IIIIIll1IlII['title'],strip_tags(htmlspecialchars_decode($IIIIIll1IlII['info'])),$IIIIIll1IlII['topic'],C('site_url') .'/index.php?g=Wap&m=Jiuba&a=index&token='.$this ->IIIIIIIIlIlI .'&wecha_id='.$this ->IIIIIIIIIl11['FromUserName'] .'&id='.$IIIIIIIIIl11['pid'])),'news');
break;
case 'Yiliao': $this ->requestdata('other');
$IIIIIll1IlII = M('yuyue') ->where(array('id'=>$IIIIIIIIIl11['pid'])) ->find();
return array(array(array($IIIIIll1IlII['title'],strip_tags(htmlspecialchars_decode($IIIIIll1IlII['info'])),$IIIIIll1IlII['topic'],C('site_url') .'/index.php?g=Wap&m=Yiliao&a=index&token='.$this ->IIIIIIIIlIlI .'&wecha_id='.$this ->IIIIIIIIIl11['FromUserName'] .'&id='.$IIIIIIIIIl11['pid'])),'news');
break;
case 'Text':
$this->requestdata('textnum');
$IIIIIIIIIlll = M($IIIIIIIIIl11['module'])->order('id desc')->find($IIIIIIIIIl11['pid']);
return array(
htmlspecialchars_decode(str_replace('{wechat_id}',$this->IIIIIIIIIl11['FromUserName'],$IIIIIIIIIlll['text'])) ,
'text'
);
break;
case 'Diaoyan':
$this->requestdata('other');
$IIIIIll1IlII = M('diaoyan')->where(array(
'id'=>$IIIIIIIIIl11['pid']
))->find();
return array(
array(
array(
$IIIIIll1IlII['title'],
strip_tags(htmlspecialchars_decode($IIIIIll1IlII['sinfo'])),
$IIIIIll1IlII['pic'],
C('site_url') .'/index.php?g=Wap&m=Diaoyan&a=index&token='.$this->IIIIIIIIlIlI .'&wecha_id='.$this->IIIIIIIIIl11['FromUserName'] .'&id='.$IIIIIIIIIl11['pid']
)
),
'news'
);
break;
case 'Product':
$this->requestdata('other');
$IIIIIll1lI1l = M('Product')->limit(9)->order('id desc')->where($IIIIIIllI1II)->select();
if ($IIIIIll1lI1l) {
$IIIIIIIlll1I = array();
foreach ($IIIIIll1lI1l as $IIIIIIIIIlll) {
$IIIIIIIlll1I[] = array(
$IIIIIIIIIlll['name'],
strip_tags(htmlspecialchars_decode($IIIIIIIIIlll['intro'])) ,
$IIIIIIIIIlll['logourl'],
C('site_url') .'/index.php?g=Wap&m=Product&a=product&token='.$this->IIIIIIIIlIlI .'&wecha_id='.$this->IIIIIIIIIl11['FromUserName'] .'&id='.$IIIIIIIIIlll['id'] .'&sgssz=mp.weixin.qq.com'
);
}
}
return array(
$IIIIIIIlll1I,
'news'
);
break;
case 'Selfform':
$this->requestdata('other');
$IIIIIll1IlII = M('Selfform')->where(array(
'id'=>$IIIIIIIIIl11['pid']
))->find();
return array(
array(
array(
$IIIIIll1IlII['name'],
strip_tags(htmlspecialchars_decode($IIIIIll1IlII['intro'])) ,
$IIIIIll1IlII['logourl'],
C('site_url') .'/index.php?g=Wap&m=Selfform&a=index&token='.$this->IIIIIIIIlIlI .'&wecha_id='.$this->IIIIIIIIIl11['FromUserName'] .'&id='.$IIIIIIIIIl11['pid'] .'&sgssz=mp.weixin.qq.com'
)
) ,
'news'
);
break;
case 'Panorama':
$this->requestdata('other');
$IIIIIll1IlII = M('Panorama')->where(array(
'id'=>$IIIIIIIIIl11['pid']
))->find();
return array(
array(
array(
$IIIIIll1IlII['name'],
strip_tags(htmlspecialchars_decode($IIIIIll1IlII['intro'])) ,
$IIIIIll1IlII['frontpic'],
C('site_url') .'/index.php?g=Wap&m=Panorama&a=item&token='.$this->IIIIIIIIlIlI .'&wecha_id='.$this->IIIIIIIIIl11['FromUserName'] .'&id='.$IIIIIIIIIl11['pid'] .'&sgssz=mp.weixin.qq.com'
)
) ,
'news'
);
break;
case 'Wedding':
$this->requestdata('other');
$IIIIIll1lI11 = M('Wedding')->where(array(
'id'=>$IIIIIIIIIl11['pid']
))->find();
return array(
array(
array(
$IIIIIll1lI11['title'],
strip_tags(htmlspecialchars_decode($IIIIIll1lI11['word'])) ,
$IIIIIll1lI11['coverurl'],
C('site_url') .'/index.php?g=Wap&m=Wedding&a=index&token='.$this->IIIIIIIIlIlI .'&wecha_id='.$this->IIIIIIIIIl11['FromUserName'] .'&id='.$IIIIIIIIIl11['pid'] .'&sgssz=mp.weixin.qq.com'
) ,
array(
'查看我的祝福',
strip_tags(htmlspecialchars_decode($IIIIIll1lI11['word'])) ,
$IIIIIll1lI11['picurl'],
C('site_url') .'/index.php?g=Wap&m=Wedding&a=check&type=1&token='.$this->IIIIIIIIlIlI .'&wecha_id='.$this->IIIIIIIIIl11['FromUserName'] .'&id='.$IIIIIIIIIl11['pid'] .'&sgssz=mp.weixin.qq.com'
) ,
array(
'查看我的来宾',
strip_tags(htmlspecialchars_decode($IIIIIll1lI11['word'])) ,
$IIIIIll1lI11['picurl'],
C('site_url') .'/index.php?g=Wap&m=Wedding&a=check&type=2&token='.$this->IIIIIIIIlIlI .'&wecha_id='.$this->IIIIIIIIIl11['FromUserName'] .'&id='.$IIIIIIIIIl11['pid'] .'&sgssz=mp.weixin.qq.com'
) ,
) ,
'news'
);
break;
case 'Vote':
$this->requestdata('other');
$IIIIIIllI1Il = M('Vote')->where(array(
'id'=>$IIIIIIIIIl11['pid']
))->order('id DESC')->find();
return array(
array(
array(
$IIIIIIllI1Il['title'],
str_replace(array(
'&nbsp;',
'br /',
'&amp;',
'gt;',
'lt;'
) ,'',strip_tags(htmlspecialchars_decode($IIIIIIllI1Il['info']))) ,
$IIIIIIllI1Il['picurl'],
C('site_url') .'/index.php?g=Wap&m=Vote&a=index&token='.$this->IIIIIIIIlIlI .'&wecha_id='.$this->IIIIIIIIIl11['FromUserName'] .'&id='.$IIIIIIIIIl11['pid'] .'&sgssz=mp.weixin.qq.com'
)
) ,
'news'
);
break;
case 'Greeting_card':
$this->requestdata('other');
$IIIIIIllI1Il = M('Greeting_card')->where(array(
'id'=>$IIIIIIIIIl11['pid']
))->order('id DESC')->find();
return array(
array(
array(
$IIIIIIllI1Il['title'],
str_replace(array(
'&nbsp;',
'br /',
'&amp;',
'gt;',
'lt;'
) ,'',strip_tags(htmlspecialchars_decode($IIIIIIllI1Il['info']))) ,
$IIIIIIllI1Il['picurl'],
C('site_url') .'/index.php?g=Wap&m=Greeting_card&a=index&id='.$IIIIIIIIIl11['pid'] .'&sgssz=mp.weixin.qq.com'
)
) ,
'news'
);
break;
case 'Lottery':
$this->requestdata('other');
$IIIIIIIIIlll = M('Lottery')->find($IIIIIIIIIl11['pid']);
if ($IIIIIIIIIlll == false ||$IIIIIIIIIlll['status'] == 3) {
return array(
'活动可能已经结束或者被删除了',
'text'
);
}
switch ($IIIIIIIIIlll['type']) {
case 1:
$IIIIIlIllI1l = 'Lottery';
break;
case 2:
$IIIIIlIllI1l = 'Guajiang';
break;
case 3:
$IIIIIlIllI1l = 'Coupon';
break;
case 4:
$IIIIIlIllI1l = 'LuckyFruit';
break;
case 5:
$IIIIIlIllI1l = 'GoldenEgg';
break;
}
$IIIIIIIII1I1 = $IIIIIIIIIlll['id'];
$IIIIIIlIllIl = $IIIIIIIIIlll['type'];
if ($IIIIIIIIIlll['status'] == 1) {
$IIIIIIllI1I1 = $IIIIIIIIIlll['starpicurl'];
$IIIIIIIIll11 = $IIIIIIIIIlll['title'];
$IIIIIIIII1I1 = $IIIIIIIIIlll['id'];
$IIIIIIIIIlll = $IIIIIIIIIlll['info'];
}else {
$IIIIIIllI1I1 = $IIIIIIIIIlll['endpicurl'];
$IIIIIIIIll11 = $IIIIIIIIIlll['endtite'];
$IIIIIIIIIlll = $IIIIIIIIIlll['endinfo'];
}
$IIIIIII1l1Il = C('site_url') .U('Wap/'.$IIIIIlIllI1l .'/index',array(
'token'=>$this->IIIIIIIIlIlI,
'type'=>$IIIIIIlIllIl,
'wecha_id'=>$this->IIIIIIIIIl11['FromUserName'],
'id'=>$IIIIIIIII1I1,
'type'=>$IIIIIIlIllIl
));
return array(
array(
array(
$IIIIIIIIll11,
$IIIIIIIIIlll,
$IIIIIIllI1I1,
$IIIIIII1l1Il
)
) ,
'news'
);
case 'Carowner':
$this->requestdata('other');
$IIIIII1lI11l = M('Carowner')->where(array(
'id'=>$IIIIIIIIIl11['pid']
))->find();
return array(
array(
array(
$IIIIII1lI11l['title'],
str_replace(array(
'&nbsp;',
'br /',
'&amp;',
'gt;',
'lt;'
) ,'',strip_tags(htmlspecialchars_decode($IIIIII1lI11l['info']))) ,
$IIIIII1lI11l['head_url'],
C('site_url') .'/index.php?g=Wap&m=Car&a=owner&token='.$this->IIIIIIIIlIlI .'&wecha_id='.$this->IIIIIIIIIl11['FromUserName'] .'&id='.$IIIIIIIIIl11['pid'] .'&sgssz=mp.weixin.qq.com'
)
) ,
'news'
);
break;
case 'Carowner':
$this->requestdata('other');
$IIIIII1lI11l = M('Carowner')->where(array(
'id'=>$IIIIIIIIIl11['pid']
))->find();
return array(
array(
array(
$IIIIII1lI11l['title'],
str_replace(array(
'&nbsp;',
'br /',
'&amp;',
'gt;',
'lt;'
) ,'',strip_tags(htmlspecialchars_decode($IIIIII1lI11l['info']))) ,
$IIIIII1lI11l['head_url'],
C('site_url') .'/index.php?g=Wap&m=Car&a=owner&token='.$this->IIIIIIIIlIlI .'&wecha_id='.$this->IIIIIIIIIl11['FromUserName']
)
) ,
'news'
);
break;
case 'Carset':
$this->requestdata('other');
$IIIIII1lI11l = M('Carset')->where(array(
'id'=>$IIIIIIIIIl11['pid']
))->find();
$IIIIIll1llII = array();
array_push($IIIIIll1llII,array(
$IIIIII1lI11l['title'],
'',
$IIIIII1lI11l['head_url'],
$IIIIII1lI11l['url'] ?$IIIIII1lI11l['url'] : C('site_url') .'/index.php?g=Wap&m=Car&a=index&token='.$this->IIIIIIIIlIlI .'&wecha_id='.$this->IIIIIIIIIl11['FromUserName']
));
array_push($IIIIIll1llII,array(
$IIIIII1lI11l['title1'],
'',
$IIIIII1lI11l['head_url_1'],
$IIIIII1lI11l['url1'] ?$IIIIII1lI11l['url1'] : C('site_url') .'/index.php?g=Wap&m=Car&a=brands&token='.$this->IIIIIIIIlIlI .'&wecha_id='.$this->IIIIIIIIIl11['FromUserName']
));
array_push($IIIIIll1llII,array(
$IIIIII1lI11l['title2'],
'',
$IIIIII1lI11l['head_url_2'],
$IIIIII1lI11l['url2'] ?$IIIIII1lI11l['url2'] : C('site_url') .'/index.php?g=Wap&m=Car&a=salers&token='.$this->IIIIIIIIlIlI .'&wecha_id='.$this->IIIIIIIIIl11['FromUserName']
));
array_push($IIIIIll1llII,array(
$IIIIII1lI11l['title3'],
'',
$IIIIII1lI11l['head_url_3'],
htmlspecialchars_decode($IIIIII1lI11l['url3'])?$IIIIII1lI11l['url3'] : C('site_url') .'/index.php?g=Wap&m=Car&a=CarReserveBook&addtype=drive&token='.$this->IIIIIIIIlIlI .'&wecha_id='.$this->IIIIIIIIIl11['FromUserName']
));
array_push($IIIIIll1llII,array(
$IIIIII1lI11l['title4'],
'',
$IIIIII1lI11l['head_url_4'],
htmlspecialchars_decode($IIIIII1lI11l['url3']) ?$IIIIII1lI11l['url4'] : C('site_url') .'/index.php?g=Wap&m=Car&a=owner&token='.$this->IIIIIIIIlIlI .'&wecha_id='.$this->IIIIIIIIIl11['FromUserName']
));
array_push($IIIIIll1llII,array(
$IIIIII1lI11l['title5'],
'',
$IIIIII1lI11l['head_url_5'],
$IIIIII1lI11l['url5'] ?$IIIIII1lI11l['url5'] : C('site_url') .'/index.php?g=Wap&m=Car&a=tool&token='.$this->IIIIIIIIlIlI .'&wecha_id='.$this->IIIIIIIIIl11['FromUserName']
));
return array(
$IIIIIll1llII,
'news'
);
break;
case 'medicalSet':
$IIIIII1lI11l = M('Medical_set')->where(array(
'id'=>$IIIIIIIIIl11['pid']
))->find();
return array(
array(
array(
$IIIIII1lI11l['title'],
str_replace(array(
'&nbsp;',
'br /',
'&amp;',
'gt;',
'lt;'
) ,'',strip_tags(htmlspecialchars_decode($IIIIII1lI11l['info']))) ,
$IIIIII1lI11l['head_url'],
C('site_url') .'/index.php?g=Wap&m=Medical&a=index&token='.$this->IIIIIIIIlIlI .'&wecha_id='.$this->IIIIIIIIIl11['FromUserName']
)
) ,
'news'
);
break;
default:
$this->requestdata('videonum');
$IIIIIIIIIlll = M($IIIIIIIIIl11['module'])->order('id desc')->find($IIIIIIIIIl11['pid']);
return array(
array(
$IIIIIIIIIlll['title'],
$IIIIIIIIIlll['keyword'],
$IIIIIIIIIlll['musicurl'],
$IIIIIIIIIlll['hqmusicurl']
) ,
'music'
);
}
}else {
$IIIIIll1llIl = M('Function')->where(array(
'funname'=>'liaotian'
))->find();
if (!strpos($this->IIIIIIIllllI,'liaotian') ||!$IIIIIll1llIl['status']) {
$IIIIII1l11I1 = M('Other')->where(array(
'token'=>$this->IIIIIIIIlIlI
))->find();
if ($IIIIII1l11I1 == false) {
return array(
'回复帮助，可了解所有功能',
'text'
);
}else {
if (empty($IIIIII1l11I1['keyword'])) {
return array(
$IIIIII1l11I1['info'],
'text'
);
}else {
$IIIIII1IllII = M('Img')->field('id,text,pic,url,title')->limit(5)->order('id desc')->where(array(
'token'=>$this->IIIIIIIIlIlI,
'keyword'=>array(
'like',
'%'.$IIIIII1l11I1['keyword'] .'%'
)
))->select();
if ($IIIIII1IllII == false) {
return array(
'无此图文信息,请提醒商家，重新设定关键词',
'text'
);
}
foreach ($IIIIII1IllII as $IIIIIll1lIl1 =>$IIIIIll1lI1I) {
if ($IIIIIll1lI1I['url'] != false) {
if (!(strpos($IIIIIll1lI1I['url'],'http') === FALSE)) {
$IIIIIII1l1Il = $this->getFuncLink(html_entity_decode($IIIIIll1lI1I['url']));
}else {
$IIIIIII1l1Il = $this->getFuncLink($IIIIIll1lI1I['url']);
}
}else {
$IIIIIII1l1Il = rtrim(C('site_url') ,'/') .U('Wap/Index/content',array(
'token'=>$this->IIIIIIIIlIlI,
'id'=>$IIIIIll1lI1I['id'],
'wecha_id'=>$this->IIIIIIIIIl11['FromUserName']
));
}
$IIIIIIIlll1I[] = array(
$IIIIIll1lI1I['title'],
$IIIIIll1lI1I['text'],
$IIIIIll1lI1I['pic'],
$IIIIIII1l1Il
);
}
return array(
$IIIIIIIlll1I,
'news'
);
}
}
}
$this->selectService();
return array(
$this->chat($IIIIIIIlI11I) ,
'text'
);
}
}
private function getFuncLink($IIIIIll1lllI) {
$IIIIIll1llll = explode(' ',$IIIIIll1lllI);
switch ($IIIIIll1llll[0]) {
default:
$IIIIIII1l1Il = str_replace(array(
'{wechat_id}',
'{siteUrl}',
'&amp;'
) ,array(
$this->IIIIIIIIIl11['FromUserName'],
C('site_url') ,
'&'
) ,$IIIIIll1llll[0]);
break;
case '刮刮卡':
$IIIIIll1lll1 = M('Lottery')->where(array(
'token'=>$this->IIIIIIIIlIlI,
'type'=>2,
'status'=>1
))->order('id DESC')->find();
$IIIIIII1l1Il = C('site_url') .U('Wap/Guajiang/index',array(
'token'=>$this->IIIIIIIIlIlI,
'wecha_id'=>$this->IIIIIIIIIl11['FromUserName'],
'id'=>$IIIIIll1lll1['id']
));
break;
case '大转盘':
$IIIIIll1lll1 = M('Lottery')->where(array(
'token'=>$this->IIIIIIIIlIlI,
'type'=>1,
'status'=>1
))->order('id DESC')->find();
$IIIIIII1l1Il = C('site_url') .U('Wap/Lottery/index',array(
'token'=>$this->IIIIIIIIlIlI,
'wecha_id'=>$this->IIIIIIIIIl11['FromUserName'],
'id'=>$IIIIIll1lll1['id']
));
break;
case '商家订单':
$IIIIIII1l1Il = C('site_url') .'/index.php?g=Wap&m=Host&a=index&token='.$this->IIIIIIIIlIlI .'&wecha_id='.$this->IIIIIIIIIl11['FromUserName'] .'&hid='.$IIIIIll1llll[1] .'&sgssz=mp.weixin.qq.com';
break;
case '优惠券':
$IIIIIll1lll1 = M('Lottery')->where(array(
'token'=>$this->IIIIIIIIlIlI,
'type'=>3,
'status'=>1
))->order('id DESC')->find();
$IIIIIII1l1Il = C('site_url') .U('Wap/Coupon/index',array(
'token'=>$this->IIIIIIIIlIlI,
'wecha_id'=>$this->IIIIIIIIIl11['FromUserName'],
'id'=>$IIIIIll1lll1['id']
));
break;
case '万能表单':
$IIIIIII1l1Il = C('site_url') .U('Wap/Selfform/index',array(
'token'=>$this->IIIIIIIIlIlI,
'wecha_id'=>$this->IIIIIIIIIl11['FromUserName'],
'id'=>$IIIIIll1llll[1]
));
break;
case '会员卡':
$IIIIIII1l1Il = C('site_url') .U('Wap/Card/vip',array(
'token'=>$this->IIIIIIIIlIlI,
'wecha_id'=>$this->IIIIIIIIIl11['FromUserName']
));
break;
case '首页':
$IIIIIII1l1Il = rtrim(C('site_url') ,'/') .'/index.php?g=Wap&m=Index&a=index&token='.$this->IIIIIIIIlIlI .'&wecha_id='.$this->IIIIIIIIIl11['FromUserName'];
break;
case '团购':
$IIIIIII1l1Il = rtrim(C('site_url') ,'/') .'/index.php?g=Wap&m=Groupon&a=grouponIndex&token='.$this->IIIIIIIIlIlI .'&wecha_id='.$this->IIIIIIIIIl11['FromUserName'];
break;
case '商城':
$IIIIIII1l1Il = rtrim(C('site_url') ,'/') .'/index.php?g=Wap&m=Product&a=index&token='.$this->IIIIIIIIlIlI .'&wecha_id='.$this->IIIIIIIIIl11['FromUserName'];
break;
case '订餐':
$IIIIIII1l1Il = rtrim(C('site_url') ,'/') .'/index.php?g=Wap&m=Product&a=dining&dining=1&token='.$this->IIIIIIIIlIlI .'&wecha_id='.$this->IIIIIIIIIl11['FromUserName'];
break;
case '相册':
$IIIIIII1l1Il = rtrim(C('site_url') ,'/') .'/index.php?g=Wap&m=Photo&a=index&token='.$this->IIIIIIIIlIlI .'&wecha_id='.$this->IIIIIIIIIl11['FromUserName'];
break;
case '网站分类':
$IIIIIII1l1Il = C('site_url') .U('Wap/Index/lists',array(
'token'=>$this->IIIIIIIIlIlI,
'wecha_id'=>$this->IIIIIIIIIl11['FromUserName'],
'classid'=>$IIIIIll1llll[1]
));
break;
case 'LBS信息':
if ($IIIIIll1llll[1]) {
$IIIIIII1l1Il = C('site_url') .U('Wap/Company/map',array(
'token'=>$this->IIIIIIIIlIlI,
'wecha_id'=>$this->IIIIIIIIIl11['FromUserName'],
'companyid'=>$IIIIIll1llll[1]
));
}else {
$IIIIIII1l1Il = C('site_url') .U('Wap/Company/map',array(
'token'=>$this->IIIIIIIIlIlI,
'wecha_id'=>$this->IIIIIIIIIl11['FromUserName']
));
}
break;
case 'DIY宣传页':
$IIIIIII1l1Il = C('site_url') .'/index.php/show/'.$this->IIIIIIIIlIlI;
break;
case '婚庆喜帖':
$IIIIIII1l1Il = C('site_url') .U('Wap/Wedding/index',array(
'token'=>$this->IIIIIIIIlIlI,
'wecha_id'=>$this->IIIIIIIIIl11['FromUserName'],
'id'=>$IIIIIll1llll[1]
));
break;
case '投票':
$IIIIIII1l1Il = C('site_url') .U('Wap/Vote/index',array(
'token'=>$this->IIIIIIIIlIlI,
'wecha_id'=>$this->IIIIIIIIIl11['FromUserName'],
'id'=>$IIIIIll1llll[1]
));
break;
}
return $IIIIIII1l1Il;
}
private function home() {
return $this->shouye();
}
private function shouye($IIIIIIIlIIII) {
$IIIIII1IIII1 = M('Home')->where(array(
'token'=>$this->IIIIIIIIlIlI
))->find();
$this->behaviordata('home','','1');
if ($IIIIII1IIII1 == false) {
return array(
'商家未做首页配置，请稍后再试',
'text'
);
}else {
$IIIIIll1ll11 = $IIIIII1IIII1['picurl'];
if ($IIIIII1IIII1['apiurl'] == false) {
if (!$IIIIII1IIII1['advancetpl']) {
$IIIIIII1l1Il = rtrim(C('site_url') ,'/') .'/index.php?g=Wap&m=Index&a=index&token='.$this->IIIIIIIIlIlI .'&wecha_id='.$this->IIIIIIIIIl11['FromUserName'] .'&sgssz=mp.weixin.qq.com';
}else {
$IIIIIII1l1Il = rtrim(C('site_url') ,'/') .'/cms/index.php?token='.$this->IIIIIIIIlIlI .'&wecha_id='.$this->IIIIIIIIIl11['FromUserName'] .'&sgssz=mp.weixin.qq.com';
}
}else {
$IIIIIII1l1Il = $IIIIII1IIII1['apiurl'];
}
}
return array(
array(
array(
$IIIIII1IIII1['title'],
$IIIIII1IIII1['info'],
$IIIIIll1ll11,
$IIIIIII1l1Il
)
) ,
'news'
);
}
private function kuaidi($IIIIIIIIIl11) {
$IIIIIIIIIl11 = array_merge($IIIIIIIIIl11);
$IIIIIII1IlII = file_get_contents('http://www.weinxinma.com/api/index.php?m=Express&a=index&name='.$IIIIIIIIIl11[0] .'&number='.$IIIIIIIIIl11[1]);
if ($IIIIIII1IlII == '不支持的快递公司') {
$IIIIIII1IlII = file_get_contents('http://www.weinxinma.com/api/index.php?m=Express&a=index&name='.$IIIIIIIIIl11[1] .'&number='.$IIIIIIIIIl11[0]);
}
return $IIIIIII1IlII;
}
private function langdu($IIIIIIIIIl11) {
$IIIIIIIIIl11 = implode('',$IIIIIIIIIl11);
$IIIIIll1l1I1 = 'http://www.apiwx.com/aaa.php?w='.urlencode($IIIIIIIIIl11);
return array(
array(
$IIIIIIIIIl11,
'点听收听',
$IIIIIll1l1I1,
$IIIIIll1l1I1
) ,
'music'
);
}
private function jiankang($IIIIIIIIIl11) {
if (empty($IIIIIIIIIl11)) return '主人，'.$this->IIIIIIIlllll ."提醒您\n正确的查询方式是:\n健康+身高,+体重\n例如：健康170,65";
$IIIIIIll1llI = $IIIIIIIIIl11[1] / 100;
$IIIIIll1l1ll = $IIIIIIIIIl11[2];
$IIIIIll1l1l1 = ($IIIIIIll1llI * 100 -80) * 0.7;
$IIIIIll1l11I = 66 +13.7 * $IIIIIll1l1ll +5 * $IIIIIIll1llI * 100 -6.8 * 25;
$IIIIIll1l11l = $IIIIIll1l1ll -$IIIIIll1l1l1;
$IIIIIll1l111 = $IIIIIll1l11l * 0.1;
$IIIIIII11l11 = round($IIIIIll1l1ll / ($IIIIIIll1llI * $IIIIIIll1llI) ,1);
if ($IIIIIII11l11 <18.5) {
$IIIIIIIIIlll = '您的体形属于骨感型，需要增加体重'.$IIIIIll1l11l .'公斤哦!';
$IIIIIIllIl1I = 1;
}elseif ($IIIIIII11l11 <24) {
$IIIIIIIIIlll = '您的体形属于圆滑型的身材，需要减少体重'.$IIIIIll1l11l .'公斤哦!';
}elseif ($IIIIIII11l11 >24) {
$IIIIIIIIIlll = '您的体形属于肥胖型，需要减少体重'.$IIIIIll1l11l .'公斤哦!';
}elseif ($IIIIIII11l11 >28) {
$IIIIIIIIIlll = '您的体形属于严重肥胖，请加强锻炼，或者使用我们推荐的减肥方案进行减肥';
}
return $IIIIIIIIIlll;
}
private function fujin($IIIIII11IlI1) {
$IIIIII11IlI1 = implode('',$IIIIII11IlI1);
if ($IIIIII11IlI1 == false) {
return $this->IIIIIIIlllll ."很难过,无法识别主人的指令,正确使用方法是:输入【附近+关键词】当".$this->IIIIIIIlllll .'提醒您输入地理位置的时候就OK啦';
}
$IIIIIIIIIl11 = array();
$IIIIIIIIIl11['time'] = time();
$IIIIIIIIIl11['token'] = $this->_get('token');
$IIIIIIIIIl11['keyword'] = $IIIIII11IlI1;
$IIIIIIIIIl11['uid'] = $this->IIIIIIIIIl11['FromUserName'];
$IIIIIIll1IIl = M('Nearby_user');
$IIIIIIIIII1I = $IIIIIIll1IIl->where(array(
'token'=>$this->_get('token') ,
'uid'=>$IIIIIIIIIl11['uid']
))->find();
if ($IIIIIIIIII1I == false) {
$IIIIIIll1IIl->data($IIIIIIIIIl11)->add();
}else {
$IIIIIIIII1I1['id'] = $IIIIIIIIII1I['id'];
$IIIIIIll1IIl->where($IIIIIIIII1I1)->save($IIIIIIIIIl11);
}
return "主人【".$this->IIIIIIIlllll ."】已经接收到你的指令\n请发送您的地理位置给我哈";
}
private function recordLastRequest($IIIIIIIlI11I,$IIIIIll11II1 = 'text') {
$IIIIIll11IlI = array();
$IIIIIll11IlI['time'] = time();
$IIIIIll11IlI['token'] = $this->_get('token');
$IIIIIll11IlI['keyword'] = $IIIIIIIlI11I;
$IIIIIll11IlI['msgtype'] = $IIIIIll11II1;
$IIIIIll11IlI['uid'] = $this->IIIIIIIIIl11['FromUserName'];
$IIIIIll1II1I = M('User_request');
$IIIIIll11Ill = $IIIIIll1II1I->where(array(
'token'=>$this->_get('token') ,
'msgtype'=>$IIIIIll11II1,
'uid'=>$IIIIIll11IlI['uid']
))->find();
if (!$IIIIIll11Ill) {
$IIIIIll1II1I->add($IIIIIll11IlI);
}else {
$IIIIII1llI11['id'] = $IIIIIll11Ill['id'];
$IIIIIll1II1I->where($IIIIII1llI11)->save($IIIIIll11IlI);
}
}
function map($IIIIIII1II1I,$IIIIIII1lIII) {
$IIIIIll11I1I = 'http://api.map.baidu.com/ag/coord/convert?from=2&to=4&x='.$IIIIIII1II1I .'&y='.$IIIIIII1lIII;
$IIIIIIl11II1 = Http::fsockopenDownload($IIIIIll11I1I);
if ($IIIIIIl11II1 == false) {
$IIIIIIl11II1 = file_get_contents($IIIIIll11I1I);
}
$IIIIIIIlII1l = json_decode($IIIIIIl11II1,true);
$IIIIIII1II1I = base64_decode($IIIIIIIlII1l['x']);
$IIIIIII1lIII = base64_decode($IIIIIIIlII1l['y']);
$IIIIIll1II1I = M('User_request');
$IIIIIll11Ill = $IIIIIll1II1I->where(array(
'token'=>$this->_get('token') ,
'msgtype'=>'text',
'uid'=>$this->IIIIIIIIIl11['FromUserName']
))->find();
if (!(strpos($IIIIIll11Ill['keyword'],'附近') === FALSE)) {
$IIIIIIIIII1I = M('Nearby_user')->where(array(
'token'=>$this->_get('token') ,
'uid'=>$this->IIIIIIIIIl11['FromUserName']
))->find();
$IIIIII11IlI1 = $IIIIIIIIII1I['keyword'];
$IIIIII1l1l1l = 2000;
$IIIIII1IIlIl = new baiduMap($IIIIII11IlI1,$IIIIIII1II1I,$IIIIIII1lIII);
$IIIIIII1IlII = $IIIIII1IIlIl->echoJson();
$IIIIII1l1l11 = json_decode($IIIIIII1IlII);
$IIIIII1IIlIl = array();
foreach ($IIIIII1l1l11 as $IIIIIIIlI11I =>$IIIIIIlll11l) {
$IIIIII1IIlIl[] = array(
$IIIIIIlll11l->IIIIIIIIll11,
$IIIIIIIlI11I,
rtrim(C('site_url') ,'/') .'/tpl/static/images/home.jpg',
$IIIIIIlll11l->IIIIIII1l1Il
);
}
if ($IIIIII1IIlIl) {
return array(
$IIIIII1IIlIl,
'news'
);
}else {
return array(
'附近信息无法调出，请稍候再试一下',
'text'
);
}
}else {
import("Home.Action.MapAction");
$IIIIIll1IllI = new MapAction();
if (!(strpos($IIIIIll11Ill['keyword'],'开车去') === FALSE) ||!(strpos($IIIIIll11Ill['keyword'],'坐公交') === FALSE) ||!(strpos($IIIIIll11Ill['keyword'],'步行去') === FALSE)) {
if (!(strpos($IIIIIll11Ill['keyword'],'步行去') === FALSE)) {
$IIIIIII1lIIl = str_replace('步行去','',$IIIIIll11Ill['keyword']);
if (!$IIIIIII1lIIl) {
$IIIIIII1lIIl = 1;
}
return $IIIIIll1IllI->walk($IIIIIII1II1I,$IIIIIII1lIII,$IIIIIII1lIIl);
}
if (!(strpos($IIIIIll11Ill['keyword'],'开车去') === FALSE)) {
$IIIIIII1lIIl = str_replace('开车去','',$IIIIIll11Ill['keyword']);
if (!$IIIIIII1lIIl) {
$IIIIIII1lIIl = 1;
}
return $IIIIIll1IllI->drive($IIIIIII1II1I,$IIIIIII1lIII,$IIIIIII1lIIl);
}
if (!(strpos($IIIIIll11Ill['keyword'],'坐公交') === FALSE)) {
$IIIIIII1lIIl = str_replace('坐公交','',$IIIIIll11Ill['keyword']);
if (!$IIIIIII1lIIl) {
$IIIIIII1lIIl = 1;
}
return $IIIIIll1IllI->bus($IIIIIII1II1I,$IIIIIII1lIII,$IIIIIII1lIIl);
}
}else {
switch ($IIIIIll11Ill['keyword']) {
case '最近的':
return $IIIIIll1IllI->nearest($IIIIIII1II1I,$IIIIIII1lIII);
break;
}
}
}
}
private function suanming($IIIIIIIlIIII) {
$IIIIIIIlIIII = implode('',$IIIIIIIlIIII);
if (empty($IIIIIIIlIIII)) {
return '主人'.$this->IIIIIIIlllll .'提醒您正确的使用方法是[算命+姓名]';
}
$IIIIIIIIIl11 = require_once (CONF_PATH .'suanming.php');
$IIIIIIlI1llI = mt_rand(0,80);
return $IIIIIIIlIIII ."\n".trim($IIIIIIIIIl11[$IIIIIIlI1llI]);
}
private function yinle($IIIIIIIlIIII) {
$IIIIIIIlIIII = implode('',$IIIIIIIlIIII);
$IIIIIII1l1Il = 'http://httop1.duapp.com/mp3.php?musicName='.$IIIIIIIlIIII;
$IIIIIII1IlII = file_get_contents($IIIIIII1l1Il);
$IIIIIll11lII = json_decode($IIIIIII1IlII);
return array(
array(
$IIIIIIIlIIII,
$IIIIIIIlIIII,
$IIIIIll11lII->IIIIIII1l1Il,
$IIIIIll11lII->IIIIIII1l1Il
) ,
'music'
);
}
function geci($IIIIIIIIllI1) {
$IIIIIIIlIIII = implode('',$IIIIIIIIllI1);
@$IIIIIII1IlII = 'http://api.ajaxsns.com/api.php?key=free&appid=0&msg='.urlencode('歌词'.$IIIIIIIlIIII);
$IIIIIIl11II1 = json_decode(file_get_contents($IIIIIII1IlII));
$IIIIIII1IlII = str_replace('{br}',"\n",$IIIIIIl11II1->IIIIIIIl1II1);
return str_replace('mzxing_com','iMicms',$IIIIIII1IlII);
}
private function yuming($IIIIIIIIllI1) {
$IIIIIIIlIIII = implode('',$IIIIIIIIllI1);
@$IIIIIII1IlII = 'http://api.ajaxsns.com/api.php?key=free&appid=0&msg='.urlencode('域名'.$IIIIIIIlIIII);
$IIIIIIl11II1 = json_decode(file_get_contents($IIIIIII1IlII));
$IIIIIII1IlII = str_replace('{br}',"\n",$IIIIIIl11II1->IIIIIIIl1II1);
return str_replace('mzxing_com','iMicms',$IIIIIII1IlII);
}
private function tianqi($IIIIIIIIllI1) {
$IIIIIIIlIIII = implode('',$IIIIIIIIllI1);
if ($IIIIIIIlIIII == '') {
$IIIIIIIlIIII = '玉林';
}
@$IIIIIII1IlII = 'http://api.ajaxsns.com/api.php?key=free&appid=0&msg='.urlencode('天气'.$IIIIIIIlIIII);
$IIIIIIl11II1 = json_decode(file_get_contents($IIIIIII1IlII));
$IIIIIII1IlII = str_replace('{br}',"\n",$IIIIIIl11II1->IIIIIIIl1II1);
return str_replace('菲菲',C('site_my') ,$IIIIIII1IlII);
}
private function shouji($IIIIIIIIllI1) {
$IIIIIIIlIIII = implode('',$IIIIIIIIllI1);
@$IIIIIII1IlII = 'http://api.ajaxsns.com/api.php?key=free&appid=0&msg='.urlencode('归属'.$IIIIIIIlIIII);
$IIIIIIl11II1 = json_decode(file_get_contents($IIIIIII1IlII));
$IIIIIII1IlII = str_replace('{br}',"\n",$IIIIIIl11II1->IIIIIIIl1II1);
$IIIIIII1IlII = str_replace('菲菲',$this->IIIIIIIlllll,str_replace('提示：',$this->IIIIIIIlllll .'提醒您:',str_replace('{br}',"\n",$IIIIIII1IlII)));
return $IIIIIII1IlII;
}
private function shenfenzheng($IIIIIIIIllI1) {
$IIIIIIIIllI1 = implode('',$IIIIIIIIllI1);
if (count($IIIIIIIIllI1) >1) {
$this->error_msg($IIIIIIIIllI1);
return false;
};
$IIIIIll11l1I = file_get_contents('http://www.youdao.com/smartresult-xml/search.s?jsFlag=true&type=id&q='.$IIIIIIIIllI1);
$IIIIII1l1l11 = explode(':',$IIIIIll11l1I);
$IIIIII1l1l11[2] = rtrim($IIIIII1l1l11[4],",'gender'");
$IIIIIII1IlII = trim($IIIIII1l1l11[3],",'birthday'");
if ($IIIIIII1IlII !== iconv('UTF-8','UTF-8',iconv('UTF-8','UTF-8',$IIIIIII1IlII))) $IIIIIII1IlII = iconv('GBK','UTF-8',$IIIIIII1IlII);
$IIIIIII1IlII = '【身份证】 '.$IIIIIIIIllI1 ."\n".'【地址】'.$IIIIIII1IlII ."\n 【该身份证主人的生日】".str_replace("'",'',$IIIIII1l1l11[2]);
return $IIIIIII1IlII;
}
private function gongjiao($IIIIIIIIIl11) {
$IIIIIIIIIl11 = array_merge($IIIIIIIIIl11);
if (count($IIIIIIIIIl11) <2) {
$this->error_msg();
return false;
};
$IIIIIIl11II1 = file_get_contents("http://www.twototwo.cn/bus/Service.aspx?format=json&action=QueryBusByLine&key=5da453b2-b154-4ef1-8f36-806ee58580f6&zone=".$IIIIIIIIIl11[0] ."&line=".$IIIIIIIIIl11[1]);
$IIIIIIIIIl11 = json_decode($IIIIIIl11II1);
$IIIIIll11l11 = $IIIIIIIIIl11->Response->Head->XianLu;
$IIIIIll111II = get_object_vars($IIIIIll11l11->ShouMoBanShiJian);
$IIIIIll111II = $IIIIIll111II['#cdata-section'];
$IIIIIll111Il = get_object_vars($IIIIIll11l11->PiaoJia);
$IIIIIll111II = $IIIIIll111II .' -- '.$IIIIIll111Il['#cdata-section'];
$IIIIIll111I1 = $IIIIIIIIIl11->Response->Main->Item->FangXiang;
$IIIIIll11l11 = $IIIIIll111I1[0]->ZhanDian;
$IIIIIII1IlII = "【本公交途经】\n";
for ($IIIIIIIllI11 = 0;$IIIIIIIllI11 <count($IIIIIll11l11);$IIIIIIIllI11++) {
$IIIIIII1IlII.= "\n".trim($IIIIIll11l11[$IIIIIIIllI11]->ZhanDianMingCheng);
}
return $IIIIIII1IlII;
}
private function huoche($IIIIIIIIIl11,$IIIIIIlIIlII = '') {
$IIIIIIIIIl11 = array_merge($IIIIIIIIIl11);
$IIIIIIIIIl11[2] = date('Y',time()) .$IIIIIIlIIlII;
if (count($IIIIIIIIIl11) != 3) {
$this->error_msg($IIIIIIIIIl11[0] .'至'.$IIIIIIIIIl11[1]);
return false;
};
$IIIIIIlIIlII = empty($IIIIIIlIIlII) ?date('Y-m-d',time()) : date('Y-',time()) .$IIIIIIlIIlII;
$IIIIIIl11II1 = file_get_contents("http://www.twototwo.cn/train/Service.aspx?format=json&action=QueryTrainScheduleByTwoStation&key=5da453b2-b154-4ef1-8f36-806ee58580f6&startStation=".$IIIIIIIIIl11[0] ."&arriveStation=".$IIIIIIIIIl11[1] ."&startDate=".$IIIIIIIIIl11[2] ."&ignoreStartDate=0&like=1&more=0");
if ($IIIIIIl11II1) {
$IIIIIIIIIl11 = json_decode($IIIIIIl11II1);
$IIIIIll111I1 = $IIIIIIIIIl11->Response->Main->Item;
if (count($IIIIIll111I1) >10) {
$IIIIIll111ll = 10;
}else {
$IIIIIll111ll = count($IIIIIll111I1);
}
for ($IIIIIIIllI11 = 0;$IIIIIIIllI11 <$IIIIIll111ll;$IIIIIIIllI11++) {
$IIIIIII1IlII.= "\n 【编号】".$IIIIIll111I1[$IIIIIIIllI11]->CheCiMingCheng ."\n 【类型】".$IIIIIll111I1[$IIIIIIIllI11]->CheXingMingCheng ."\n【发车时间】:　".$IIIIIIlIIlII .' '.$IIIIIll111I1[$IIIIIIIllI11]->FaShi ."\n【耗时】".$IIIIIll111I1[$IIIIIIIllI11]->LiShi .' 小时';
$IIIIIII1IlII.= "\n----------------------";
}
}else {
$IIIIIII1IlII = '没有找到 '.$IIIIIIIlIIII .' 至 '.$IIIIIll111l1 .' 的列车';
}
return $IIIIIII1IlII;
}
private function fanyi($IIIIIIIlIIII) {
$IIIIIIIlIIII = array_merge($IIIIIIIlIIII);
$IIIIIII1l1Il = "http://openapi.baidu.com/public/2.0/bmt/translate?client_id=kylV2rmog90fKNbMTuVsL934&q=".$IIIIIIIlIIII[0] ."&from=auto&to=auto";
$IIIIIIl11II1 = Http::fsockopenDownload($IIIIIII1l1Il);
if ($IIIIIIl11II1 == false) {
$IIIIIIl11II1 = file_get_contents($IIIIIII1l1Il);
}
$IIIIIIl11II1 = json_decode($IIIIIIl11II1);
$IIIIIII1IlII = $IIIIIIl11II1->trans_result;
if ($IIIIIII1IlII[0]->dst == false) return $this->error_msg($IIIIIIIlIIII[0]);
$IIIIIll1l1I1 = 'http://www.apiwx.com/aaa.php?w='.$IIIIIII1IlII[0]->dst;
return array(
array(
$IIIIIII1IlII[0]->src,
$IIIIIII1IlII[0]->dst,
$IIIIIll1l1I1,
$IIIIIll1l1I1
) ,
'music'
);
}
private function caipiao($IIIIIIIlIIII) {
$IIIIIIIlIIII = array_merge($IIIIIIIlIIII);
$IIIIIII1l1Il = "http://api2.sinaapp.com/search/lottery/?appkey=0020130430&appsecert=fa6095e113cd28fd&reqtype=text&keyword=".$IIIIIIIlIIII[0];
$IIIIIIl11II1 = Http::fsockopenDownload($IIIIIII1l1Il);
if ($IIIIIIl11II1 == false) {
$IIIIIIl11II1 = file_get_contents($IIIIIII1l1Il);
}
$IIIIIIl11II1 = json_decode($IIIIIIl11II1,true);
$IIIIIII1IlII = $IIIIIIl11II1['text']['content'];
return $IIIIIII1IlII;
}
private function mengjian($IIIIIIIlIIII) {
$IIIIIIIlIIII = array_merge($IIIIIIIlIIII);
if (empty($IIIIIIIlIIII)) return '周公睡着了,无法解此梦,这年头神仙也偷懒';
$IIIIIIIIIl11 = M('Dream')->field('content')->where("`title` LIKE '%".$IIIIIIIlIIII[0] ."%'")->find();
if (empty($IIIIIIIIIl11)) return '周公睡着了,无法解此梦,这年头神仙也偷懒';
return $IIIIIIIIIl11['content'];
}
function gupiao($IIIIIIIlIIII) {
$IIIIIII1l1Il = "http://api2.sinaapp.com/search/stock/?appkey=0020130430&appsecert=fa6095e113cd28fd&reqtype=text&keyword=".$IIIIIIIlIIII[1];
$IIIIIIl11II1 = Http::fsockopenDownload($IIIIIII1l1Il);
if ($IIIIIIl11II1 == false) {
$IIIIIIl11II1 = file_get_contents($IIIIIII1l1Il);
}
$IIIIIIl11II1 = json_decode($IIIIIIl11II1,true);
$IIIIIII1IlII = $IIIIIIl11II1['text']['content'];
return $IIIIIII1IlII;
}
function getmp3($IIIIIIIIIl11) {
$IIIIIll11lII = new getYu();
$IIIIIl1IIII1 = $IIIIIll11lII->getGoogleTTS($IIIIIIIIIl11);
$IIIIIl1IIIlI = 'mp3/'.time() .'_'.sprintf('%02d',rand(0,999)) .".mp3";
return rtrim(C('site_url') ,'/') .$IIIIIl1IIIlI;
}
function xiaohua() {
$IIIIIIIlIIII = implode('',$IIIIIIIIllI1);
@$IIIIIII1IlII = 'http://api.ajaxsns.com/api.php?key=free&appid=0&msg='.urlencode('笑话'.$IIIIIIIlIIII);
$IIIIIIl11II1 = json_decode(file_get_contents($IIIIIII1IlII));
$IIIIIII1IlII = str_replace('{br}',"\n",$IIIIIIl11II1->IIIIIIIl1II1);
return str_replace(array(
'mzxing_com',
'提示：按分类看笑话请发送“笑话分类”'
) ,array(
'iMicms',
''
) ,$IIIIIII1IlII);
}
private function liaotian($IIIIIIIlIIII) {
$IIIIIIIlIIII = array_merge($IIIIIIIlIIII);
$this->chat($IIIIIIIlIIII[0]);
}
private function chat($IIIIIIIlIIII) {
$IIIIIIlll1lI = M('Function')->where(array(
'funname'=>'liaotian'
))->find();
if (!$IIIIIIlll1lI['status']) {
return '';
}
$this->requestdata('textnum');
$IIIIIIl111Il = $this->user('connectnum');
if ($IIIIIIl111Il['connectnum'] != 1) {
return C('connectout');
}
if (!(strpos($IIIIIIIlIIII,'你是') === FALSE)) {
return '咳咳，我是只能微信机器人';
}
if ($IIIIIIIlIIII == "你叫什么"||$IIIIIIIlIIII == "你是谁") {
return '咳咳，我是聪明与智慧并存的美女，主人你可以叫我'.$this->IIIIIIIlllll .',人家刚交男朋友,你不可追我啦';
}elseif ($IIIIIIIlIIII == "你父母是谁"||$IIIIIIIlIIII == "你爸爸是谁"||$IIIIIIIlIIII == "你妈妈是谁") {
return '主人,'.$this->IIIIIIIlllll .'是iMicms创造的,所以他们是我的父母,不过主人我属于你的';
}elseif ($IIIIIIIlIIII == '糗事') {
$IIIIIIIlIIII = '笑话';
}elseif ($IIIIIIIlIIII == '网站'||$IIIIIIIlIIII == '官网'||$IIIIIIIlIIII == '网址'||$IIIIIIIlIIII == '3g网址') {
return "【".C('site_name') ."】\n".C('site_name') ."\n【".C('site_name') ."服务宗旨】\n化繁为简,让菜鸟也能使用强大的系统!";
}
$IIIIIII1IlII = 'http://api.ajaxsns.com/api.php?key=free&appid=0&msg='.urlencode($IIIIIIIlIIII);
$IIIIIIl11II1 = Http::fsockopenDownload($IIIIIII1IlII);
if ($IIIIIIl11II1 == false) {
$IIIIIIl11II1 = file_get_contents($IIIIIII1IlII);
}
$IIIIIIl11II1 = json_decode($IIIIIIl11II1,true);
$IIIIIII1IlII = str_replace('菲菲',$this->IIIIIIIlllll,str_replace('提示：',$this->IIIIIIIlllll .'提醒您:',str_replace('{br}',"\n",$IIIIIIl11II1['content'])));
return str_replace('mzxing_com','iMicms',$IIIIIII1IlII);
}
private function fistMe($IIIIIIIIIl11) {
if ('event'== $IIIIIIIIIl11['MsgType'] &&'subscribe'== $IIIIIIIIIl11['Event']) {
return $this->help();
}
}
private function help() {
$this->behaviordata('help','','1');
$IIIIIIIIIl11 = M('Areply')->where(array(
'token'=>$this->IIIIIIIIlIlI
))->find();
return array(
preg_replace("/(\015\012)|(\015)|(\012)/","\n",$IIIIIIIIIl11['content']) ,
'text'
);
}
private function error_msg($IIIIIIIIIl11) {
return '没有找到'.$IIIIIIIIIl11 .'相关的数据';
}
private function user($IIIIIl1IIlIl,$IIIIII11IlI1 = '') {
$IIIIIIIIII1I = M('Wxuser')->field('uid')->where(array(
'token'=>$this->IIIIIIIIlIlI
))->find();
$IIIIII1IlIlI = M('Users');
$IIIIIl1IIlI1 = array(
'id'=>$IIIIIIIIII1I['uid']
);
$IIIIII1I1IIl = $IIIIII1IlIlI->field('gid,diynum,connectnum,activitynum,viptime')->where(array(
'id'=>$IIIIIIIIII1I['uid']
))->find();
$IIIIIIl11l11 = M('User_group')->where(array(
'id'=>$IIIIII1I1IIl['gid']
))->find();
if ($IIIIII1I1IIl['diynum'] <$IIIIIIl11l11['diynum']) {
$IIIIIIIIIl11['diynum'] = 1;
if ($IIIIIl1IIlIl == 'diynum') {
}
}
if ($IIIIII1I1IIl['connectnum'] <$IIIIIIl11l11['connectnum']) {
$IIIIIIIIIl11['connectnum'] = 1;
if ($IIIIIl1IIlIl == 'connectnum') {
$IIIIII1IlIlI->where($IIIIIl1IIlI1)->setInc('connectnum');
}
}
if ($IIIIII1I1IIl['viptime'] >time()) {
$IIIIIIIIIl11['viptime'] = 1;
}
return $IIIIIIIIIl11;
}
private function requestdata($IIIIII1l1lI1) {
$IIIIIIIIIl11['year'] = date('Y');
$IIIIIIIIIl11['month'] = date('m');
$IIIIIIIIIl11['day'] = date('d');
$IIIIIIIIIl11['token'] = $this->IIIIIIIIlIlI;
$IIIIIlIIlllI = M('Requestdata');
$IIIIIIl111Il = $IIIIIlIIlllI->field('id')->where($IIIIIIIIIl11)->find();
if ($IIIIIIl111Il == false) {
$IIIIIIIIIl11['time'] = time();
$IIIIIIIIIl11[$IIIIII1l1lI1] = 1;
$IIIIIlIIlllI->add($IIIIIIIIIl11);
}else {
$IIIIIlIIlllI->where($IIIIIIIIIl11)->setInc($IIIIII1l1lI1);
}
}
private function behaviordata($IIIIII1l1lI1,$IIIIIIIII1I1 = '',$IIIIIIlIllIl = '') {
$IIIIIIIIIl11['date'] = date('Y-m-d',time());
$IIIIIIIIIl11['token'] = $this->IIIIIIIIlIlI;
$IIIIIIIIIl11['openid'] = $this->IIIIIIIIIl11['FromUserName'];
$IIIIIIIIIl11['keyword'] = $this->IIIIIIIIIl11['Content'];
if (!$IIIIIIIIIl11['keyword']) {
$IIIIIIIIIl11['keyword'] = '用户关注';
}
$IIIIIIIIIl11['model'] = $IIIIII1l1lI1;
if ($IIIIIIIII1I1 != false) {
$IIIIIIIIIl11['fid'] = $IIIIIIIII1I1;
}
if ($IIIIIIlIllIl != false) {
$IIIIIIIIIl11['type'] = 1;
}
$IIIIIlIIlllI = M('Behavior');
if (is_resource($IIIIIlIIlllI)) {
$IIIIIIl111Il = $IIIIIlIIlllI->field('id')->where($IIIIIIIIIl11)->find();
$this->updateMemberEndTime($IIIIIIIIIl11['openid']);
if ($IIIIIIl111Il == false) {
$IIIIIIIIIl11['enddate'] = time();
$IIIIIlIIlllI->add($IIIIIIIIIl11);
}else {
$IIIIIlIIlllI->where($IIIIIIIIIl11)->setInc('num');
}
}
}
private function updateMemberEndTime($IIIIIIlIlIll) {
$IIIIIlIIlllI = M('Wehcat_member_enddate');
if (is_resource($IIIIIlIIlllI)) {
$IIIIIIIII1I1 = $IIIIIlIIlllI->field('id')->where(array(
'openid'=>$IIIIIIlIlIll
))->find();
$IIIIIIIIIl11['enddate'] = time();
$IIIIIIIIIl11['openid'] = $IIIIIIlIlIll;
$IIIIIIIIIl11['token'] = $this->IIIIIIIIlIlI;
if ($IIIIIIIII1I1 == false) {
$IIIIIlIIlllI->add($IIIIIIIIIl11);
}else {
$IIIIIIIIIl11['id'] = $IIIIIIIII1I1['id'];
$IIIIIlIIlllI->save($IIIIIIIIIl11);
}
}
}
private function selectService() {
$this->behaviordata('chat','');
$IIIIIIlIIlII = time() -(30 * 60);
$IIIIIIIIlIl1['token'] = $this->IIIIIIIIlIlI;
$IIIIIl1IIl1l = M('Service_user')->field('id')->where('`token` = "'.$this->IIIIIIIIlIlI .'" and `status` = 0 and `endJoinDate` > '.$IIIIIIlIIlII)->select();
if ($IIIIIl1IIl1l != false) {
$IIIIIIIIlIII = M('wechat_group_list')->field('id')->where(array(
'openid'=>$this->IIIIIIIIIl11['FromUserName']
))->find();
if ($IIIIIIIIlIII == false) {
$this->adddUserInfo();
}
$IIIIIl1IIl11 = M('wehcat_member_enddate')->field('id,uid,joinUpDate')->where(array(
'token'=>$this->IIIIIIIIlIlI,
'openid'=>$this->IIIIIIIIIl11['FromUserName']
))->find();
if ($IIIIIl1IIl11['uid'] == false) {
foreach ($IIIIIl1IIl1l as $IIIIIIIlI11I =>$IIIIII1I1IIl) {
$IIIIIIIIII1I[] = $IIIIII1I1IIl['id'];
}
if (count($IIIIIIIIII1I) == 1) {
$IIIIIIIII1I1 = $IIIIIIIIII1I[0];
}else {
$IIIIIIIIllII = mt_rand(0,count($IIIIIIIIII1I) -1);
$IIIIIIIII1I1 = $IIIIIIIIII1I[$IIIIIIIIllII];
}
$IIIIIIIIlIl1['id'] = $IIIIIl1IIl11['id'];
$IIIIIIIIlIl1['uid'] = $IIIIIIIII1I1;
M('wehcat_member_enddate')->data($IIIIIIIIlIl1)->save();
}else {
$IIIIIlllI1ll = 30 * 60;
$IIIIIII111II = $IIIIIIlIIlII -$IIIIIl1IIl11['joinUpDate'];
if ($IIIIIII111II <$IIIIIlllI1ll) {
exit();
}
}
}
}
private function baike($IIIIIIIlIIII) {
$IIIIIIIlIIII = implode('',$IIIIIIIlIIII);
if ($IIIIIIIlIIII == 'iMicms') {
return '世界上最牛B的微信营销系统，两天前被腾讯收购，当然这只是一个笑话';
}
$IIIIIl1II1Il = iconv('utf-8','gbk',$IIIIIIIlIIII);
$IIIIIl1II1I1 = urlencode($IIIIIl1II1Il);
$IIIIIII1l1Il = 'http://baike.baidu.com/list-php/dispose/searchword.php?word='.$IIIIIl1II1I1 .'&pic=1';
$IIIIIl1II1lI = $this->httpGetRequest_baike($IIIIIII1l1Il);
$IIIIIl1II1ll = iconv('gbk','utf-8',$IIIIIl1II1lI);
preg_match("/URL=(\S+)'>/s",$IIIIIl1II1ll,$IIIIIl1II1l1);
$IIIIIl1II11I = 'http://baike.baidu.com'.$IIIIIl1II1l1[1];
$IIIIIl1II11l = $this->httpGetRequest_baike($IIIIIl1II11I);
preg_match('#"Description"\scontent="(.+?)"\s\/\>#is',$IIIIIl1II11l,$IIIIIl1II111);
if (isset($IIIIIl1II111[1]) &&$IIIIIl1II111[1] != "") {
return htmlspecialchars_decode($IIIIIl1II111[1]);
}else {
return "抱歉，没有找到与“".$IIIIIIIlIIII ."”相关的百科结果。";
}
}
private function getRecognition($IIIIIIIII1I1) {
$IIIIIl1IlIIl = D('Recognition');
$IIIIIIIIIl11 = $IIIIIl1IlIIl->field('keyword')->where(array(
'id'=>$IIIIIIIII1I1,
'status'=>0
))->find();
if ($IIIIIIIIIl11 != false) {
$IIIIIl1IlIIl->where(array(
'id'=>$IIIIIIIII1I1
))->setInc('attention_num');
return $IIIIIIIIIl11['keyword'];
}else {
return false;
}
}
protected function api_notice_increment($IIIIIII1l1Il,$IIIIIIIIIl11) {
$IIIIIIllI11I = curl_init();
$IIIIIIl11I1l = "Accept-Charset: utf-8";
if (strpos($IIIIIII1l1Il,'?')) {
$IIIIIII1l1Il.= '&token='.$this->IIIIIIIIlIlI;
}else {
$IIIIIII1l1Il.= '?token='.$this->IIIIIIIIlIlI;
}
curl_setopt($IIIIIIllI11I,CURLOPT_URL,$IIIIIII1l1Il);
curl_setopt($IIIIIIllI11I,CURLOPT_CUSTOMREQUEST,"POST");
curl_setopt($IIIIIIllI11I,CURLOPT_SSL_VERIFYPEER,FALSE);
curl_setopt($IIIIIIllI11I,CURLOPT_SSL_VERIFYHOST,FALSE);
curl_setopt($IIIIIIllll11,CURLOPT_HTTPHEADER,$IIIIIIl11I1l);
curl_setopt($IIIIIIllI11I,CURLOPT_USERAGENT,'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
curl_setopt($IIIIIIllI11I,CURLOPT_FOLLOWLOCATION,1);
curl_setopt($IIIIIIllI11I,CURLOPT_AUTOREFERER,1);
curl_setopt($IIIIIIllI11I,CURLOPT_POSTFIELDS,$IIIIIIIIIl11);
curl_setopt($IIIIIIllI11I,CURLOPT_RETURNTRANSFER,true);
$IIIIIIl11I11 = curl_exec($IIIIIIllI11I);
if (curl_errno($IIIIIIllI11I)) {
return false;
}else {
return $IIIIIIl11I11;
}
}
private function httpGetRequest_baike($IIIIIII1l1Il) {
$IIIIIIllI111 = array(
"User-Agent: Mozilla/5.0 (Windows NT 5.1; rv:14.0) Gecko/20100101 Firefox/14.0.1",
"Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8",
"Accept-Language: en-us,en;q=0.5",
"Referer: http://www.baidu.com/"
);
$IIIIIIllI11I = curl_init();
curl_setopt($IIIIIIllI11I,CURLOPT_URL,$IIIIIII1l1Il);
curl_setopt($IIIIIIllI11I,CURLOPT_RETURNTRANSFER,1);
curl_setopt($IIIIIIllI11I,CURLOPT_HTTPHEADER,$IIIIIIllI111);
$IIIIIIlll1II = curl_exec($IIIIIIllI11I);
curl_close($IIIIIIllI11I);
if ($IIIIIIlll1II === FALSE) {
return "cURL Error: ".curl_error($IIIIIIllI11I);
}
return $IIIIIIlll1II;
}
private function adddUserInfo() {return;
$IIIIIIlllllI = $this->_getAccessToken();
$IIIIIIl1Il1I = 'https://api.weixin.qq.com/cgi-bin/user/info?openid='.$this->IIIIIIIIIl11['FromUserName'] .'&access_token='.$IIIIIIlllllI;
$IIIIIlll1IlI = json_decode($this->curlGet($IIIIIIl1Il1I));
if ($IIIIIlll1IlI->subscribe == 1) {
$IIIIIIIIIl11['nickname'] = str_replace("'",'',$IIIIIlll1IlI->nickname);
$IIIIIIIIIl11['sex'] = $IIIIIlll1IlI->sex;
$IIIIIIIIIl11['city'] = $IIIIIlll1IlI->city;
$IIIIIIIIIl11['province'] = $IIIIIlll1IlI->province;
$IIIIIIIIIl11['headimgurl'] = $IIIIIlll1IlI->headimgurl;
$IIIIIIIIIl11['subscribe_time'] = $IIIIIlll1IlI->subscribe_time;
$IIIIIlll1Ill = 'https://api.weixin.qq.com/cgi-bin/groups/getid?access_token='.$IIIIIIlllllI;
$IIIIIlll1Il1 = json_decode($this->curlGet($IIIIIlll1Ill,'post','{"openid":"'.$IIIIIIIIIl11['openid'] .'"}'));
$IIIIIIIIIl11['g_id'] = $IIIIIIl11II1->groupid;
M('wechat_group_list')->data($IIIIIIIIIl11)->add();
}
}
private function _getAccessToken() {
$IIIIIIIIlIl1 = array(
'token'=>$this->IIIIIIIIIl11['FromUserName']
);
$this->IIIIIIl1l1Il = M('Wxuser')->where($IIIIIIIIlIl1)->find();
$IIIIIIl11IIl = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$this->IIIIIIl1l1Il['appid'] .'&secret='.$this->IIIIIIl1l1Il['appsecret'];
$IIIIIIl11II1 = json_decode($this->curlGet($IIIIIIl11IIl));
if (!$IIIIIIl11II1->IIIIIIl11Il1) {
}else {
$this->error('获取access_token发生错误：错误代码'.$IIIIIIl11II1->errcode .',微信返回错误信息：'.$IIIIIIl11II1->IIIIIIl11Il1);
}
return $IIIIIIl11II1->IIIIIIlllllI;
}
private function curlGet($IIIIIII1l1Il,$IIIIIIllI1l1 = 'get',$IIIIIIIIIl11 = '') {
$IIIIIIllI11I = curl_init();
$IIIIIIl11I1l = "Accept-Charset: utf-8";
curl_setopt($IIIIIIllI11I,CURLOPT_URL,$IIIIIII1l1Il);
curl_setopt($IIIIIIllI11I,CURLOPT_CUSTOMREQUEST,strtoupper($IIIIIIllI1l1));
curl_setopt($IIIIIIllI11I,CURLOPT_SSL_VERIFYPEER,FALSE);
curl_setopt($IIIIIIllI11I,CURLOPT_SSL_VERIFYHOST,FALSE);
curl_setopt($IIIIIIllll11,CURLOPT_HTTPHEADER,$IIIIIIl11I1l);
curl_setopt($IIIIIIllI11I,CURLOPT_USERAGENT,'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
curl_setopt($IIIIIIllI11I,CURLOPT_FOLLOWLOCATION,1);
curl_setopt($IIIIIIllI11I,CURLOPT_AUTOREFERER,1);
curl_setopt($IIIIIIllI11I,CURLOPT_POSTFIELDS,$IIIIIIIIIl11);
curl_setopt($IIIIIIllI11I,CURLOPT_RETURNTRANSFER,true);
$IIIIIIlllII1 = curl_exec($IIIIIIllI11I);
return $IIIIIIlllII1;
}
private function get_tags($IIIIIIIIll11,$IIIIIIlI1llI = 10) {
vendor('Pscws.Pscws4','','.class.php');
$IIIIIl1IlI1I = new PSCWS4();
$IIIIIl1IlI1I->set_dict(CONF_PATH .'etc/dict.utf8.xdb');
$IIIIIl1IlI1I->set_rule(CONF_PATH .'etc/rules.utf8.ini');
$IIIIIl1IlI1I->set_ignore(true);
$IIIIIl1IlI1I->send_text($IIIIIIIIll11);
$IIIIIl1IlI1l = $IIIIIl1IlI1I->get_tops($IIIIIIlI1llI);
$IIIIIl1IlI1I->close();
$IIIIIll1IIlI = array();
foreach ($IIIIIl1IlI1l as $IIIIIIl1llIl) {
$IIIIIll1IIlI[] = $IIIIIIl1llIl['word'];
}
return implode(',',$IIIIIll1IIlI);
}
public function handleIntro($IIIIIII1IlII) {
$IIIIIIlllIl1 = array(
'&quot;'
);
$IIIIIIlllI1I = array(
'"'
);
return str_replace($IIIIIIlllIl1,$IIIIIIlllI1I,$IIIIIII1IlII);
}
}
?>