<?php

class FunctionAction extends UserAction{
function index(){
$IIIIIIIII1I1=$this->_get('id','intval');
if (!$IIIIIIIII1I1){
$IIIIIIIIIlll=M('Wxuser')->find(array('where'=>array('token'=>$this->IIIIIIIIlIlI)));
}else {
$IIIIIIIIIlll=M('Wxuser')->find($IIIIIIIII1I1);
}
$IIIIIIIIlIlI=$this->_get('token','trim');
if($IIIIIIIIIlll==false||$IIIIIIIIIlll['token']!=$IIIIIIIIlIlI){
$this->error('非法操作',U('Home/Index/index'));
}
session('token',$IIIIIIIIlIlI);
session('wxid',$IIIIIIIIIlll['id']);
$IIIIIIl11l1I=M('Token_open');
$IIIIIIl11l1l=$IIIIIIl11l1I->field('id,queryname')->where(array('token'=>session('token'),'uid'=>session('uid')))->find();
$IIIIIIlIlI1l['uid']=session('uid');
$IIIIIIlIlI1l['token']=session('token');
if (!C('agent_version') ||!$this->IIIIIIII1II1 ){
$IIIIIIl11l11=M('User_group')->field('id,name,func')->where('status=1 AND id = '.session('gid'))->order('id ASC')->find();
$IIIIIIIIlIl1['gid'] = array('elt',session('gid'));
$IIIIIIl111II = M('Function')->where($IIIIIIIIlIl1)->select();
}else {
$IIIIIIl11l11=M('User_group')->field('id,name,func')->where('status=1 AND agentid='.$this->IIIIIIII1II1.' AND id = '.session('gid'))->order('id ASC')->find();
$IIIIIIl111II = M('Agent_function')->where(array('agentid'=>$this->IIIIIIII1II1))->select();
}
$IIIIIIl111Il=explode(',',trim($IIIIIIl11l1l['queryname'],','));
foreach ($IIIIIIl111Il as $IIIIIIl111I1 =>$IIIIIIl111lI){
if(strpos($IIIIIIl11l11['func'],$IIIIIIl111lI) === false){
$IIIIIIl11l11['func'] .= ','.$IIIIIIl111lI;
}
}
$IIIIIIl11l11['func'] = explode(',',$IIIIIIl11l11['func']);
foreach ($IIIIIIl11l11['func'] as $IIIIIIl111ll=>$IIIIIIl111l1){
$IIIIIIl1111I = M('Token_open')->where(array('token'=>session('token'),'uid'=>session('uid')))->getField('queryname');
if(strpos($IIIIIIl1111I,$IIIIIIl111l1) === false){
$IIIIIIIIlIl1 = array('funname'=>$IIIIIIl111l1,'status'=>1);
}else{
$IIIIIIIIlIl1 = array('funname'=>$IIIIIIl111l1);
}
if (C('agent_version')&&$this->IIIIIIII1II1){
$IIIIIIIIlIl1['agentid'] = $this->IIIIIIII1II1;
$IIIIIIl11l11['func'][$IIIIIIl111ll] = M('Agent_function')->where($IIIIIIIIlIl1)->field('id,funname,name,info')->find();
}else{
$IIIIIIl11l11['func'][$IIIIIIl111ll] = M('Function')->where($IIIIIIIIlIl1)->field('id,funname,name,info')->find();
}
if($IIIIIIl11l11['func'][$IIIIIIl111ll] == NULL){
unset($IIIIIIl11l11['func'][$IIIIIIl111ll]);
}
}
$this->assign('fun',$IIIIIIl11l11);
$this->assign('funcs',$IIIIIIl111II);
$IIIIIIl1111l=M('Wxuser')->field('wxname,wxid,headerpic,weixin')->where(array('token'=>session('token'),'uid'=>session('uid')))->find();
$this->assign('wecha',$IIIIIIl1111l);
$this->assign('token',session('token'));
$this->assign('check',$IIIIIIl111Il);
$this->display();
}
function info(){
$IIIIIIl11111=M('Users')->where(array('id'=>session('uid')))->find();
$IIIIIIIIlIl1=array('token'=>$this->IIIIIIIIlIlI,'year'=>date('Y'),'month'=>date('m'),'day'=>date('d'));
$IIIIIIIIlIII=M('Requestdata')->where($IIIIIIIIlIl1)->find();
$this->assign('list',$IIIIIIIIlIII);
$IIIIIIIII1I1=$this->_get('id','intval');
if (!$IIIIIIIII1I1){
$IIIIIIIIlIlI=$this->IIIIIIIIlIlI;
$IIIIIIIIIlll=M('Wxuser')->find(array('token'=>$this->IIIIIIIIlIlI));
}else {
$IIIIIIIIIlll=M('Wxuser')->find($IIIIIIIII1I1);
}
$IIIIIIIIlIlI=$this->_get('token','trim');
if($IIIIIIIIIlll==false||$IIIIIIIIIlll['token']!=$IIIIIIIIlIlI){
$this->error('非法操作',U('Home/Index/index'));
}
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
$this->assign('wecha',$IIIIIIl1111l);
$this->assign('token',session('token'));
$this->assign('qx',$IIIIIIl11111);
$this->display();
}
}
?>