<?php

class AdmaAction extends UserAction{
public function index(){
$this->canUseFunction('adma');
$IIIIIIIIIl11=D('Adma');
$IIIIIIIlllI1=$IIIIIIIIIl11->where(array('token'=>session('token'),'uid'=>session('uid')))->find();
$this->assign('adma',$IIIIIIIlllI1);
if(IS_POST){
$_POST['uid']=session('uid');
$_POST['token']=session('token');
if($IIIIIIIIIl11->create()){
if($IIIIIIIlllI1==false){
if($IIIIIIIIIl11->add()){
$this->success('操作成功');
}else{
$this->error('服务器繁忙，请稍候再试');
}
}else{
$_POST['id']=$IIIIIIIlllI1['id'];
if($IIIIIIIIIl11->save($_POST)){
$this->success('操作成功');
}else{
$this->error('服务器繁忙，请稍候再试');
}
}
}else{
$this->error($IIIIIIIIIl11->getError());
}
}else{
if($IIIIIIIlllI1==false){
$IIIIIIIlllI1=array();
$IIIIIIIlllI1['url']='/tpl/Home/default/common/images/ewm2.jpg';
$IIIIIIIlllI1['copyright']='© 2001-2013 某某微信版权所有';
$IIIIIIIlllI1['info']='微信营销管理平台为个人和企业提供基于微信公众平台的一系列功能，包括智能回复、微信3G网站、互动营销活动，会员管理，在线订单，数据统计等系统功能,带给你全新的微信互动营销体验。';
$IIIIIIIlllI1['title']=C('site_name');
$this->assign('adma',$IIIIIIIlllI1);
}
$this->display();
}
}
public function edit(){
if($this->_get('token')!=session('token')){$this->error('非法操作');}
$IIIIIIIIIl11=D('Api');
if(IS_POST){
if($IIIIIIIIIl11->create()){
if($IIIIIIIIIl11->where(array('token'=>session('token'),'uid'=>session('uid')))->save()!=false){
$this->success('操作成功');
}else{
$this->error('服务器繁忙，请稍候再试');
}
}else{
$this->error($IIIIIIIIIl11->getError());
}
}else{
$this->error('非法操作');
}
}
}
?>