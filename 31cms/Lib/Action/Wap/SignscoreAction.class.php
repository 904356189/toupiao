<?php

class SignscoreAction extends WapAction {
public function __construct(){
parent::_initialize();
}
public function index(){
$IIIII1Ill1II = $_SERVER['HTTP_USER_AGENT'];
if(!strpos($IIIII1Ill1II,"icroMessenger")) {
echo '此功能只能在微信浏览器中使用';exit;
}
$IIIIIIIIlIlI    =  $this->_get('token');
$IIIIIlIIIll1 = $this->_get('wecha_id');
$IIIII1llllIl   = M('Member_card_sign');
$IIIIIIIIlIl1    = array('token'=>$IIIIIIIIlIlI,'wecha_id'=>$IIIIIlIIIll1,'score_type'=>1);
$IIIIII11IlIl = $IIIII1llllIl->where($IIIIIIIIlIl1)->order('sign_time desc')->find();
if($IIIIII11IlIl == null){
$IIIII1llllIl->add($IIIIIIIIlIl1);
$IIIIII11IlIl = $IIIII1llllIl->where($IIIIIIIIlIl1)->order('id desc')->find();
}
$IIIII1llllI1=M('member_card_create')->where(array('wecha_id'=>$IIIIIlIIIll1))->find();
if(empty($IIIII1llllI1)){
Header("Location: ".C('site_url').'/'.U('Wap/Card/vip',array('token'=>$this->_get('token'),'wecha_id'=>$this->_get('wecha_id'))));
exit('领卡后才可以签到.');
}
$IIIIIl1I11Il = M('Member_card_exchange')->where(array('token'=>$IIIIIIIIlIlI))->find();
$this->assign('set_exchange',$IIIIIl1I11Il);
if(empty($IIIIIl1I11Il)){
exit("该商家尚未设置该功能.");
}
if(IS_POST){
$IIIII1lllllI =  array('token'=>$IIIIIIIIlIlI,'wecha_id'=>$IIIIIlIIIll1);
$IIIIIIIIIlIl = M('Userinfo')->where($IIIII1lllllI)->find();
if($IIIIIIIIIlIl['continuous'] == 6){
$IIIIIIIIIl11['expense']    =  $IIIIIl1I11Il['everyday'] +$IIIIIl1I11Il['continuation'];
$IIIIIIIIIl11['is_sign'] = 1;
$IIIIIIIIIl11['sign_time']  = time();
$IIIII1llllIl->where($IIIIIIIIlIl1)->save($IIIIIIIIIl11);
$IIIIIIIlII11['sign_score']  = $IIIIIIIIIlIl['sign_score'] +$IIIIIIIIIl11['expense'];
$IIIIIIIlII11['total_score'] = $IIIIIIIIIlIl['total_score'] +$IIIIIIIIIl11['expense'];
$IIIIIIIlII11['continuous']  = 0;
M('Userinfo')->where($IIIII1lllllI)->save($IIIIIIIlII11);
$IIIII1llllll = 1;
}else{
if ((time() -$IIIIII11IlIl['sign_time']) >86400 ) {
$IIIIIIIlII11['continuous']  = 0;
M('Userinfo')->where($IIIII1lllllI)->save($IIIIIIIlII11);
$IIIIIIIIIl11['sign_time']  = time();
$IIIIIIIIIl11['is_sign']    = 1;
$IIIIIIIIIl11['score_type'] = 1;
$IIIIIIIIIl11['token']      = $IIIIIIIIlIlI;
$IIIIIIIIIl11['wecha_id']   = $IIIIIlIIIll1;
$IIIIIIIIIl11['expense']    = $IIIIIl1I11Il['everyday'];
$IIIII1llllIl->where($IIIIIIIIlIl1)->save($IIIIIIIIIl11);
$IIIIIIIlII11['total_score'] = $IIIIIIIIIlIl['total_score'] +$IIIIIIIIIl11['expense'];
$IIIIIIIlII11['sign_score']  = $IIIIIIIIIlIl['sign_score'] +$IIIIIIIIIl11['expense'];
$IIIIIIIlII11['continuous']  =  1;
M('Userinfo')->where($IIIII1lllllI)->save($IIIIIIIlII11);
$IIIII1llllll = 1;
}else{
$IIIIIIIIIl11['sign_time']  = time();
$IIIIIIIIIl11['is_sign']    = 1;
$IIIIIIIIIl11['score_type'] = 1;
$IIIIIIIIIl11['token']      = $IIIIIIIIlIlI;
$IIIIIIIIIl11['wecha_id']   = $IIIIIlIIIll1;
$IIIIIIIIIl11['expense']    = $IIIIIl1I11Il['everyday'];
$IIIII1llllIl->data($IIIIIIIIIl11)->add();
$IIIIIIIlII11['total_score'] = $IIIIIIIIIlIl['total_score'] +$IIIIIIIIIl11['expense'];
$IIIIIIIlII11['sign_score']  = $IIIIIIIIIlIl['sign_score'] +$IIIIIIIIIl11['expense'];
$IIIIIIIlII11['continuous']  = $IIIIIIIIIlIl['continuous'] +1;
M('Userinfo')->where($IIIII1lllllI)->save($IIIIIIIlII11);
$IIIII1llllll = 1;
}
}
}else{
$IIIIIIllIIIl = date('Y-m-d',time());
$IIIII1lllll1 = date('Y-m-d',$IIIIII11IlIl['sign_time']);
if($IIIII1lllll1 == $IIIIIIllIIIl){
$IIIII1llllll = 1;
}
}
$IIIII1llll1I = M('Member_card_set')->where(array('token'=>$IIIIIIIIlIlI))->find();
$IIIIII11IlIl   = $IIIII1llllIl->where($IIIIIIIIlIl1)->order('sign_time desc')->limit(6)->select();
$IIIIIIIIIlIl = M('Userinfo')->where(array('token'=>$IIIIIIIIlIlI,'wecha_id'=>$IIIIIlIIIll1))->find();
$this->assign('userinfo',$IIIIIIIIIlIl);
$this->assign('sign',$IIIIII11IlIl);
$this->assign('signined',$IIIII1llllll);
$IIIII1llll1I['continuation']=$IIIIIl1I11Il['continuation'];
$this->assign('cardset',$IIIII1llll1I);
$this->display();
}
public function expend(){
$IIIII1Ill1II = $_SERVER['HTTP_USER_AGENT'];
if(!strpos($IIIII1Ill1II,"MicroMessenger")) {
echo '此功能只能在微信浏览器中使用';exit;
}
$IIIIIIIIlIlI    =  $this->_get('token');
$IIIIIlIIIll1 = $this->_get('wecha_id');
$IIIII1llllIl   = M('Member_card_sign');
$IIIIIIIIlIl1    = array('token'=>$IIIIIIIIlIlI,'wecha_id'=>$IIIIIlIIIll1,'score_type'=>2);
$IIIII1llll1I = M('Member_card_set')->where(array('token'=>$IIIIIIIIlIlI))->find();
$IIIIII11IlIl   = $IIIII1llllIl->where($IIIIIIIIlIl1)->order('sign_time')->limit(6)->select();
$IIIIIIIIIlIl = M('Userinfo')->where(array('token'=>$IIIIIIIIlIlI,'wecha_id'=>$IIIIIlIIIll1))->find();
$this->assign('userinfo',$IIIIIIIIIlIl);
$this->assign('sign',$IIIIII11IlIl);
$this->assign('signined',$IIIII1llllll);
$this->assign('cardset',$IIIII1llll1I);
$this->display();
}
}
?>