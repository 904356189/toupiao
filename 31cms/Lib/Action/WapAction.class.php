<?php

class WapAction extends BaseAction{
public $IIIIIIIIlIlI;
public $IIIIIlIIIll1;
public $IIIIIlll1IIl;
public $IIIIII1III1l;
public $IIIII11lIlII;
public $IIIIIIIIllIl;
public $IIIIIIIIII1I;
public $IIIIIIl11l11;
public $IIIIIII11l1l;
public $IIIII11lIlIl;
protected function _initialize(){
parent::_initialize();
$this->IIIIIIIIlIlI=$this->_get('token');
$this->assign('token',$this->IIIIIIIIlIlI);
$this->IIIIIlIIIll1=$this->_get('wecha_id');
$this->assign('wecha_id',$this->IIIIIlIIIll1);
$IIIII1Il1IIl=S('fans_'.$this->IIIIIIIIlIlI.'_'.$this->IIIIIlIIIll1);
if (!$IIIII1Il1IIl){
$IIIII1Il1IIl=M('Userinfo')->where(array('token'=>$this->IIIIIIIIlIlI,'wecha_id'=>$this->IIIIIlIIIll1))->find();
$IIIII11lIlI1=M('Wechat_group_list')->where(array('token'=>$this->IIIIIIIIlIlI,'openid'=>$this->IIIIIlIIIll1))->find();
if ($IIIII11lIlI1){
$IIIII1Il1IIl['nickname']=$IIIII11lIlI1['nickname'];
if (!$IIIII1Il1IIl['wechaname']){
$IIIII1Il1IIl['wechaname']=$IIIII11lIlI1['nickname'];
}
$IIIII1Il1IIl['sex']=$IIIII11lIlI1['sex'];
$IIIII1Il1IIl['province']=$IIIII11lIlI1['province'];
$IIIII1Il1IIl['city']=$IIIII11lIlI1['city'];
}
S('fans_'.$this->IIIIIIIIlIlI.'_'.$this->IIIIIlIIIll1,$IIIII1Il1IIl);
}
$this->IIIIIlll1IIl=$IIIII1Il1IIl;
$this->assign('fans',$IIIII1Il1IIl);
$IIIIII1III1l=S('homeinfo_'.$this->IIIIIIIIlIlI);
if (!$IIIIII1III1l){
$IIIIII1III1l=M('home')->where(array('token'=>$this->IIIIIIIIlIlI))->find();
S('homeinfo_'.$this->IIIIIIIIlIlI,$IIIIII1III1l);
}
$this->IIIIII1III1l=$IIIIII1III1l;
$this->assign('homeInfo',$this->IIIIII1III1l);
$this->IIIIIIIIllIl=S('wxuser_'.$this->IIIIIIIIlIlI);
if (!$this->IIIIIIIIllIl){
$this->IIIIIIIIllIl=D('Wxuser')->where(array('token'=>$this->IIIIIIIIlIlI))->find();
S('wxuser_'.$this->IIIIIIIIlIlI,$this->IIIIIIIIllIl);
}
$this->assign('wxuser',$this->IIIIIIIIllIl);
$IIIII1lll111=S('bottomMenus_'.$this->IIIIIIIIlIlI);
if (!$IIIII1lll111){
$IIIII11lIllI=M('catemenu');
$IIIII1lll111=$IIIII11lIllI->where(array('token'=>$this->IIIIIIIIlIlI,'status'=>1))->order('orderss desc')->select();
S('bottomMenus_'.$this->IIIIIIIIlIlI,$IIIII1lll111);
}
$IIIII11lIlll=array();
if ($IIIII1lll111){
$IIIIIII11l11=array();
$IIIII11lIll1=0;
foreach ($IIIII1lll111 as $IIIIIIl1llIl){
$IIIIIIl1llIl['url']=$this->getLink($IIIIIIl1llIl['url']);
$IIIIIII11l11[$IIIIIIl1llIl['id']]=$IIIIIIl1llIl;
if ($IIIIIIl1llIl['fid']==0){
$IIIIIIl1llIl['vo']=array();
$IIIII11lIlll[$IIIIIIl1llIl['id']]=$IIIIIIl1llIl;
$IIIII11lIlll[$IIIIIIl1llIl['id']]['k']=$IIIII11lIll1;
$IIIII11lIll1++;
}
}
foreach ($IIIII1lll111 as $IIIIIIl1llIl){
$IIIIIIl1llIl['url']=$this->getLink($IIIIIIl1llIl['url']);
if ($IIIIIIl1llIl['fid']>0){
array_push($IIIII11lIlll[$IIIIIIl1llIl['fid']]['vo'],$IIIIIIl1llIl);
}
}
}
$IIIII1lll111=$IIIII11lIlll;
$this->IIIII11lIlII=$IIIII1lll111;
$this->assign('catemenu',$this->IIIII11lIlII);
$IIIIIIl1lIIl=$IIIIII1III1l['radiogroup'];
if($IIIIIIl1lIIl==false){
$IIIIIIl1lIIl=0;
}
$IIIII1ll1III='tpl/Wap/default/Index_menuStyle'.$IIIIIIl1lIIl.'.html';
$this->assign('cateMenuFileName',$IIIII1ll1III);
$this->assign('radiogroup',$IIIIIIl1lIIl);
$this->IIIIIIIIII1I=S('user_'.$this->IIIIIIIIllIl['uid']);
if (!$this->IIIIIIIIII1I){
$this->IIIIIIIIII1I=D('Users')->find(intval($this->IIIIIIIIllIl['uid']));
S('user_'.$this->IIIIIIIIllIl['uid'],$this->IIIIIIIIII1I);
}
$this->assign('user',$this->IIIIIIIIII1I);
$this->IIIIIIl11l11=S('group_'.$this->IIIIIIIIII1I['gid']);
if (!$this->IIIIIIl11l11){
$this->IIIIIIl11l11=M('User_group')->where(array('id'=>intval($this->IIIIIIIIII1I['gid'])))->find();
S('group_'.$this->IIIIIIIIII1I['gid'],$this->IIIIIIl11l11);
}
$this->assign('group',$this->IIIIIIl11l11);
$this->IIIIIII11l1l=S('company_'.$this->IIIIIIIIlIlI);
if (!$this->IIIIIII11l1l){
$IIIII1Il11l1=M('company');
$this->IIIIIII11l1l=$IIIII1Il11l1->where(array('token'=>$this->IIIIIIIIlIlI,'isbranch'=>0))->find();
S('company_'.$this->IIIIIIIIlIlI,$this->IIIIIII11l1l);
}
$this->assign('company',$this->IIIIIII11l1l);
$this->IIIII1Il11I1=$this->IIIIIIl11l11['iscopyright'];
$this->assign('iscopyright',$this->IIIII1Il11I1);
$this->assign('siteCopyright',C('copyright'));
$this->assign('copyright',$this->IIIII1Il11I1);
$this->IIIII11lIlIl="<script>document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {
        WeixinJSBridge.on('menu:share:appmessage', function (argv) {
         shareHandle('friend');
            WeixinJSBridge.invoke('sendAppMessage', { 
                \"img_url\": window.shareData.imgUrl,
                \"img_width\": \"640\",
                \"img_height\": \"640\",
                \"link\": window.shareData.sendFriendLink,
                \"desc\": window.shareData.tContent,
                \"title\": window.shareData.tTitle
            }, function (res) {
                _report('send_msg', res.err_msg);
            })
        });

        WeixinJSBridge.on('menu:share:timeline', function (argv) {
         shareHandle('frineds');
            WeixinJSBridge.invoke('shareTimeline', {
                \"img_url\": window.shareData.imgUrl,
                \"img_width\": \"640\",
                \"img_height\": \"640\",
                \"link\": window.shareData.sendFriendLink,
                \"desc\": window.shareData.tContent,
                \"title\": window.shareData.tTitle
            }, function (res) {
                _report('timeline', res.err_msg);
            });
        });

        WeixinJSBridge.on('menu:share:weibo', function (argv) {
         shareHandle('weibo');
            WeixinJSBridge.invoke('shareWeibo', {
                \"content\": window.shareData.tContent,
                \"url\": window.shareData.sendFriendLink,
            }, function (res) {
                _report('weibo', res.err_msg);
            });
        });
        }, false)
        
        function shareHandle(to) {
	var submitData = {
		module: window.shareData.moduleName,
		moduleid: window.shareData.moduleID,
		token:'".$this->IIIIIIIIlIlI."',
		wecha_id:'".$this->IIIIIlIIIll1."',
		url: window.shareData.sendFriendLink,
		to:to
	};
	$.post('".U('Share/shareData',array('token'=>$this->IIIIIIIIlIlI,'wecha_id'=>$this->IIIIIlIIIll1))."',submitData,function (data) {},'json')
}
        </script>";
$this->assign('shareScript',$this->IIIII11lIlIl);
}
public function getLink($IIIIIII1l1Il){
$IIIIIII1l1Il=$IIIIIII1l1Il?$IIIIIII1l1Il:'javascript:void(0)';
$IIIII1I11II1=explode(' ',$IIIIIII1l1Il);
$IIIII1I11IlI=count($IIIII1I11II1);
if ($IIIII1I11IlI>1){
$IIIII1I11Ill=intval($IIIII1I11II1[1]);
}
if ($this->strExists($IIIIIII1l1Il,'刮刮卡')){
$IIIII1I11Il1='/index.php?g=Wap&m=Guajiang&a=index&token='.$this->IIIIIIIIlIlI.'&wecha_id='.$this->IIIIIlIIIll1;
if ($IIIII1I11Ill){
$IIIII1I11Il1.='&id='.$IIIII1I11Ill;
}
}elseif ($this->strExists($IIIIIII1l1Il,'大转盘')){
$IIIII1I11Il1='/index.php?g=Wap&m=Lottery&a=index&token='.$this->IIIIIIIIlIlI.'&wecha_id='.$this->IIIIIlIIIll1;
if ($IIIII1I11Ill){
$IIIII1I11Il1.='&id='.$IIIII1I11Ill;
}
}elseif ($this->strExists($IIIIIII1l1Il,'优惠券')){
$IIIII1I11Il1='/index.php?g=Wap&m=Coupon&a=index&token='.$this->IIIIIIIIlIlI.'&wecha_id='.$this->IIIIIlIIIll1;
if ($IIIII1I11Ill){
$IIIII1I11Il1.='&id='.$IIIII1I11Ill;
}
}elseif ($this->strExists($IIIIIII1l1Il,'刮刮卡')){
$IIIII1I11Il1='/index.php?g=Wap&m=Guajiang&a=index&token='.$this->IIIIIIIIlIlI.'&wecha_id='.$this->IIIIIlIIIll1;
if ($IIIII1I11Ill){
$IIIII1I11Il1.='&id='.$IIIII1I11Ill;
}
}elseif ($this->strExists($IIIIIII1l1Il,'商家订单')){
if ($IIIII1I11Ill){
$IIIII1I11Il1=$IIIII1I11Il1='/index.php?g=Wap&m=Host&a=index&token='.$this->IIIIIIIIlIlI.'&wecha_id='.$this->IIIIIlIIIll1.'&hid='.$IIIII1I11Ill;
}else {
$IIIII1I11Il1='/index.php?g=Wap&m=Host&a=Detail&token='.$this->IIIIIIIIlIlI.'&wecha_id='.$this->IIIIIlIIIll1;
}
}elseif ($this->strExists($IIIIIII1l1Il,'万能表单')){
if ($IIIII1I11Ill){
$IIIII1I11Il1=$IIIII1I11Il1='/index.php?g=Wap&m=Selfform&a=index&token='.$this->IIIIIIIIlIlI.'&wecha_id='.$this->IIIIIlIIIll1.'&id='.$IIIII1I11Ill;
}
}elseif ($this->strExists($IIIIIII1l1Il,'相册')){
$IIIII1I11Il1='/index.php?g=Wap&m=Photo&a=index&token='.$this->IIIIIIIIlIlI.'&wecha_id='.$this->IIIIIlIIIll1;
if ($IIIII1I11Ill){
$IIIII1I11Il1='/index.php?g=Wap&m=Photo&a=plist&token='.$this->IIIIIIIIlIlI.'&wecha_id='.$this->IIIIIlIIIll1.'&id='.$IIIII1I11Ill;
}
}elseif ($this->strExists($IIIIIII1l1Il,'全景')){
$IIIII1I11Il1='/index.php?g=Wap&m=Panorama&a=index&token='.$this->IIIIIIIIlIlI.'&wecha_id='.$this->IIIIIlIIIll1;
if ($IIIII1I11Ill){
$IIIII1I11Il1='/index.php?g=Wap&m=Panorama&a=item&token='.$this->IIIIIIIIlIlI.'&wecha_id='.$this->IIIIIlIIIll1.'&id='.$IIIII1I11Ill;
}
}elseif ($this->strExists($IIIIIII1l1Il,'会员卡')){
$IIIII1I11Il1='/index.php?g=Wap&m=Card&a=index&token='.$this->IIIIIIIIlIlI.'&wecha_id='.$this->IIIIIlIIIll1;
}elseif ($this->strExists($IIIIIII1l1Il,'商城')){
$IIIII1I11Il1='/index.php?g=Wap&m=Product&a=index&token='.$this->IIIIIIIIlIlI.'&wecha_id='.$this->IIIIIlIIIll1;
}elseif ($this->strExists($IIIIIII1l1Il,'订餐')){
$IIIII1I11Il1='/index.php?g=Wap&m=Product&a=dining&dining=1&token='.$this->IIIIIIIIlIlI.'&wecha_id='.$this->IIIIIlIIIll1;
}elseif ($this->strExists($IIIIIII1l1Il,'团购')){
$IIIII1I11Il1='/index.php?g=Wap&m=Groupon&a=grouponIndex&token='.$this->IIIIIIIIlIlI.'&wecha_id='.$this->IIIIIlIIIll1;
}elseif ($this->strExists($IIIIIII1l1Il,'首页')){
$IIIII1I11Il1='/index.php?g=Wap&m=Index&a=index&token='.$this->IIIIIIIIlIlI.'&wecha_id='.$this->IIIIIlIIIll1;
}elseif ($this->strExists($IIIIIII1l1Il,'网站分类')){
$IIIII1I11Il1='/index.php?g=Wap&m=Index&a=lists&token='.$this->IIIIIIIIlIlI.'&wecha_id='.$this->IIIIIlIIIll1;
if ($IIIII1I11Ill){
$IIIII1I11Il1='/index.php?g=Wap&m=Index&a=lists&token='.$this->IIIIIIIIlIlI.'&wecha_id='.$this->IIIIIlIIIll1.'&classid='.$IIIII1I11Ill;
}
}elseif ($this->strExists($IIIIIII1l1Il,'图文回复')){
if ($IIIII1I11Ill){
$IIIII1I11Il1='/index.php?g=Wap&m=Index&a=index&token='.$this->IIIIIIIIlIlI.'&wecha_id='.$this->IIIIIlIIIll1.'&id='.$IIIII1I11Ill;
}
}elseif ($this->strExists($IIIIIII1l1Il,'LBS信息')){
$IIIII1I11Il1='/index.php?g=Wap&m=Company&a=map&token='.$this->IIIIIIIIlIlI.'&wecha_id='.$this->IIIIIlIIIll1;
if ($IIIII1I11Ill){
$IIIII1I11Il1='/index.php?g=Wap&m=Company&a=map&token='.$this->IIIIIIIIlIlI.'&wecha_id='.$this->IIIIIlIIIll1.'&companyid='.$IIIII1I11Ill;
}
}elseif ($this->strExists($IIIIIII1l1Il,'DIY宣传页')){
$IIIII1I11Il1='/index.php/show/'.$this->IIIIIIIIlIlI;
}elseif ($this->strExists($IIIIIII1l1Il,'婚庆喜帖')){
if ($IIIII1I11Ill){
$IIIII1I11Il1='/index.php?g=Wap&m=Wedding&a=index&token='.$this->IIIIIIIIlIlI.'&wecha_id='.$this->IIIIIlIIIll1.'&id='.$IIIII1I11Ill;
}
}elseif ($this->strExists($IIIIIII1l1Il,'投票')){
if ($IIIII1I11Ill){
$IIIII1I11Il1='/index.php?g=Wap&m=Vote&a=index&token='.$this->IIIIIIIIlIlI.'&wecha_id='.$this->IIIIIlIIIll1.'&id='.$IIIII1I11Ill;
}
}else {
$IIIII1I11Il1=str_replace(array('{wechat_id}','{siteUrl}','&amp;'),array($this->IIIIIlIIIll1,C('site_url'),'&'),$IIIIIII1l1Il);
if (!!(strpos($IIIIIII1l1Il,'tel')===false)&&$IIIIIII1l1Il!='javascript:void(0)'&&!strpos($IIIIIII1l1Il,'wecha_id=')){
if (strpos($IIIIIII1l1Il,'?')){
$IIIII1I11Il1=$IIIII1I11Il1.'&wecha_id='.$this->IIIIIlIIIll1;
}else {
$IIIII1I11Il1=$IIIII1I11Il1.'?wecha_id='.$this->IIIIIlIIIll1;
}
}
}
return $IIIII1I11Il1;
}
function strExists($IIIII1I1lIl1,$IIIII1I1lI1I)
{
return !(strpos($IIIII1I1lIl1,$IIIII1I1lI1I) === FALSE);
}
}
?>