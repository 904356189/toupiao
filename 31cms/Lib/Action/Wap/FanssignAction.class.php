<?php

class FanssignAction extends WapAction{
public $IIIIIlIIIll1;
public $IIIIIIIIlIlI;
public $IIIII1Il1IIl;
public $IIIIIllII1I1;
public $IIIIIlIlIlI1;
public $IIIIIlIlIlII =5;
public function _initialize() {
parent::_initialize();
}
public function __construct(){
parent::_initialize();
if (!defined('RES')){
define('RES',THEME_PATH.'common');
}
$this->IIIIIlIIIll1	= $this->_get('wecha_id');
$this->IIIIIIIIlIlI 	= $this->_get('token');
$this->IIIII1Il1IIl = $this->IIIIIlll1IIl;
$this->IIIIIllII1I1 = M('Userinfo')->where(array('token'=>$this->_get('token'),'wecha_id'=>$this->IIIIIlIIIll1))->find();
$this->IIIIIlIlIlI1 	= M('sign_in');
$this->assign('token',$this->IIIIIIIIlIlI);
$this->assign('wecha_id',$this->IIIIIlIIIll1);
}
public function index(){
if ($this->IIIIIlIIIll1&&!$this->IIIIIlll1IIl){
$this->error('请先完善个人资料再签到',U('Userinfo/index',array('token'=>$this->IIIIIIIIlIlI,'wecha_id'=>$this->IIIIIlIIIll1,'redirect'=>MODULE_NAME.'/index|id:'.intval($IIIIIIIII1I1))));
}
$IIIIIIIIlIl1 		= array('token'=>$this->IIIIIIIIlIlI,'wecha_id'=>$this->IIIIIlIIIll1);
$IIIIIIIII1ll		= $this->IIIIIlIlIlI1->where($IIIIIIIIlIl1)->sum('integral');
$IIIII1Il1II1   = $this->IIIIIlIlIlI1->where($IIIIIIIIlIl1)->order('time desc')->getField('continue');
$IIIIIlIlIllI 	= $this->_get('id','intval');
$IIIIIII111Il 		= $this->_get('month','intval');
if(empty($IIIIIII111Il)){
$IIIIIII111Il 	= date('m');
}
$IIIII1Il1IlI = $this->_mFristAndLast($IIIIIII111Il);
$IIIIIIIIlIl1['time']	= array(array('gt',$IIIII1Il1IlI['firstday']),array('lt',$IIIII1Il1IlI['lastday']),'AND');
$IIIIIIIIlIII 	 	= $this->IIIIIlIlIlI1->where($IIIIIIIIlIl1)->order('time desc')->limit(6)->select();
$this->top_pic = M('sign_set')->where(array('token'=>$this->IIIIIIIIlIlI,'id'=>$IIIIIlIlIllI))->getField('top_pic');
$IIIII1Il1Ill 	= $this->IIIIIlIlIlII +$this->_reward($IIIII1Il1II1,0);
$this->assign('empty','<tr><td colspan="2">您本月还没有签到</td></tr>');
$this->assign('set_id',$IIIIIlIlIllI);
if ($this->top_pic){
$this->assign('sign_pic',$this->top_pic);
}else {
$this->assign('sign_pic','/tpl/static/sign/top.jpg');
}
$this->assign('tody_sign',$this->_todySign());
$this->assign('integral',$IIIII1Il1Ill);
$this->assign('count',$IIIIIIIII1ll);
$this->assign('sign_num',$IIIII1Il1II1);
$this->assign('list',$IIIIIIIIlIII);
$this->display();
}
public function addSign(){
if($this->_todySign()){
echo'{"success":1,"msg":"您今天已经签到了"}';
exit();
}
$IIIII1Il1II1  = $this->IIIIIlIlIlI1->where(array('token'=>$this->IIIIIIIIlIlI,'wecha_id'=>$this->IIIIIlIIIll1))->order('time desc')->getField('continue');
$IIIIIIIIIl11	 			= array();
$IIIIIIIIIl11['token'] 		= $this->IIIIIIIIlIlI;
$IIIIIIIIIl11['wecha_id']	= $this->IIIIIlIIIll1;
$IIIIIIIIIl11['user_name']	= $this->IIIIIlll1IIl['wechaname']?$this->IIIIIlll1IIl['wechaname']:'';
$IIIIIIIIIl11['integral']	= $this->IIIIIlIlIlII +$this->_reward($IIIII1Il1II1);
$IIIIIIIIIl11['time']		= time();
$IIIIIIIIIl11['continue']	= $this->_continue($IIIII1Il1II1);
$IIIIIIIIIl11['phone']		= $this->IIIIIlll1IIl['tel']?$this->IIIIIlll1IIl['tel']:'';
if($this->IIIIIlIlIlI1->add($IIIIIIIIIl11)){
echo'{"success":1,"msg":"恭喜您签到成功"}';
}else{
echo'{"success":1,"msg":"暂时无法签到"}';
}
}
public function _todySign(){
$IIIII1Il1I1l 	= 0;
$IIIIIIlIIlII 		= strtotime(date('Y-m-d'));
$IIIII1Il1I11 	= $this->IIIIIlIlIlI1->where(array('token'=>$this->IIIIIIIIlIlI,'wecha_id'=>$this->IIIIIlIIIll1))->order('time desc')->getField('time');
if($IIIIIIlIIlII<$IIIII1Il1I11){
$IIIII1Il1I1l = 1;
}
return $IIIII1Il1I1l;
}
public function _reward($IIIII1Il1II1,$IIIII1Il1lIl){
if($IIIII1Il1lIl){
$IIIIIlIlIlIl 		= M('sign_conf');
$IIIII1Il1Ill 		= '';
$IIIII1Il1Ill  = $IIIIIlIlIlIl->where(array('stair'=>array('elt',$IIIII1Il1II1),'use'=>1))->getField('integral');
if(empty($IIIII1Il1Ill)){
return 0;
}else{
return $IIIII1Il1Ill;
}
}else{
return 0;
}
}
public function _continue($IIIII1Il1II1){
$IIIII1Il1llI = mktime(0,0,0,date('m'),date('d')-1,date('Y'));
$IIIII1Il1lll	= mktime(0,0,0,date('m'),date('d'),date('Y'))-1;
$IIIIIIIIlIl1['token']		= $this->IIIIIIIIlIlI;
$IIIIIIIIlIl1['wecha_id']	= $this->IIIIIlIIIll1;
$IIIIIIIIlIl1['time']		= array(array('gt',$IIIII1Il1llI),array('lt',$IIIII1Il1lll),'AND');
$IIIIIIlIIlII 	= $this->IIIIIlIlIlI1->where($IIIIIIIIlIl1)->getField('time');
if($IIIIIIlIIlII){
return $IIIII1Il1II1+1;
}else{
return 0;
}
}
function _mFristAndLast($IIIIII1III1I = "",$IIIIIII1lIII = "") {
if ($IIIIIII1lIII == "")
$IIIIIII1lIII = date ( "Y");
if ($IIIIII1III1I == "")
$IIIIII1III1I = date ( "m");
$IIIIII1III1I = sprintf ( "%02d",intval ( $IIIIII1III1I ) );
$IIIIIII1lIII = str_pad ( intval ( $IIIIIII1lIII ),4,"0",STR_PAD_RIGHT );
$IIIIII1III1I >12 ||$IIIIII1III1I <1 ?$IIIIII1III1I = 1 : $IIIIII1III1I = $IIIIII1III1I;
$IIIII1Il1l1I = strtotime ( $IIIIIII1lIII .$IIIIII1III1I ."01000000");
$IIIII1Il1l1l = date ( "Y-m-01",$IIIII1Il1l1I );
$IIIII1Il1l11 = strtotime ( date ( 'Y-m-d 23:59:59',strtotime ( "$IIIII1Il1l1l +1 month -1 day") ) );
return array ("firstday"=>$IIIII1Il1l1I,"lastday"=>$IIIII1Il1l11 );
}
}
?>