<?php

class InfoAction extends UserAction{
function index(){
$IIIIIIIII1I1=$this->_get('id','intval');
if (!$IIIIIIIII1I1){
$IIIIIIIIlIlI=$this->IIIIIIIIlIlI;
$IIIIIIIIIlll=M('Wxuser')->find(array('token'=>$this->IIIIIIIIlIlI));
}else {
$IIIIIIIIIlll=M('Wxuser')->find($IIIIIIIII1I1);
}
$IIIIIIIIlIlI=$this->_get('token','trim');
session('token',$IIIIIIIIlIlI);
session('wxid',$IIIIIIIIIlll['id']);
$IIIIIIl11l1I=M('Token_open');
$IIIIIIl11l1l=$IIIIIIl11l1I->field('id,queryname')->where(array('token'=>session('token'),'uid'=>session('uid')))->find();
$IIIIIIlIlI1l['uid']=session('uid');
$IIIIIIlIlI1l['token']=session('token');
if (!C('agent_version')){
$IIIIIIl11l11=M('User_group')->field('id,name')->where('status=1')->select();
}else {
$IIIIIIl11l11=M('User_group')->field('id,name')->where('status=1 AND agentid='.$this->IIIIIIII1II1)->select();
}
$IIIIIIl111Il=explode(',',$IIIIIIl11l1l['queryname']);
$this->assign('check',$IIIIIIl111Il);
foreach($IIIIIIl11l11 as $IIIIIIIlI11I=>$IIIIIIlll11l){
if (C('agent_version')&&$this->IIIIIIII1II1){
$IIIIIIIllllI=M('Agent_function')->where(array('status'=>1,'gid'=>$IIIIIIlll11l['id']))->select();
}else {
$IIIIIIIllllI=M('Function')->where(array('status'=>1,'gid'=>$IIIIIIlll11l['id']))->select();
}
foreach($IIIIIIIllllI as $IIIIII1IIIII=>$IIIIIIlll11l){
$IIIIIIlll1lI[$IIIIIIIlI11I][$IIIIII1IIIII]=$IIIIIIlll11l;
}
}
$this->assign('fun',$IIIIIIlll1lI);
$IIIIIIl1111l=M('Wxuser')->field('wxname,wxid,headerpic,weixin')->where(array('token'=>session('token'),'uid'=>session('uid')))->find();
$IIIIIIIIIlll=M('wxuser')->where(array('token'=>session('token'),'id'=>session('id')))->select();
$this->assign('wecha',$IIIIIIl1111l);
$this->assign('info',$IIIIIIIIIlll);
$this->assign('token',session('token'));
$this->display();
}
}
?>