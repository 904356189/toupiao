<?php

class ApiAction extends UserAction{
public function index(){
$IIIIIIlll1lI=M('Function')->where(array('funname'=>'api'))->find();
if (intval($this->IIIIIIIIII1I['gid'])<intval($IIIIIIlll1lI['gid'])){
$this->error('您的VIP权限不够,请到升级会员VIP',U('Alipay/vip',array('token'=>$this->IIIIIIIIlIlI)));
}
$IIIIIIIIIl11=D('Api');
$this->assign('api',$IIIIIIIIIl11->where(array('token'=>session('token'),'uid'=>session('uid')))->select());
if(IS_POST){
$_POST['uid']=SESSION('uid');
$_POST['token']=SESSION('token');
if($IIIIIIIIIl11->create()){
if($IIIIIIIIIl11->add()){
$this->success('操作成功');
}else{
$this->error('服务器繁忙，请稍候再试');
}
}else{
$this->error($IIIIIIIIIl11->getError());
}
}else{
$this->display();
}
}
public function add(){
$IIIIIIIIIl11=D('Api');
if(IS_POST){
$_POST['uid']=SESSION('uid');
$_POST['token']=SESSION('token');
if($IIIIIIIIIl11->create()){
if($IIIIIIIIIl11->add()){
$this->success('操作成功',U('User/Api/index'));
}else{
$this->error('服务器繁忙，请稍候再试');
}
}else{
$this->error($IIIIIIIIIl11->getError());
}
}else{
$this->display();
}
}
public function edit(){
$IIIIIIIIIl11=D('Api');
if(IS_POST){
$_POST['token']=session('token');
$_POST['uid']=session('uid');
$_POST['id']=$this->_get('id','intval');
if($IIIIIIIIIl11->create()){
if($IIIIIIIIIl11->save()!=false){
$this->success('操作成功',U('User/Api/index'));
}else{
$this->error('没做任何修改');
}
}else{
$this->error($IIIIIIIIIl11->getError());
}
}else{
$IIIIIIlll1l1=$IIIIIIIIIl11->where(array('token'=>session('token'),'uid'=>session('uid'),'id'=>$this->_get('id','intval')))->find();
if($IIIIIIlll1l1==false){$this->error('非法操作');}
$this->assign('api',$IIIIIIlll1l1);
$this->display('add');
}
}
public function setInc(){
if($this->_get('id')==true){
$IIIIIIIIIl11=D('Api');
$IIIIIIlll11l['id']=$this->_get('id','intval');
$IIIIIIlll11l['token']=session('token');
$IIIIIIlll111=$IIIIIIIIIl11->where($IIIIIIlll11l)->find();
if($IIIIIIlll111!=false){
$IIIIIIlIllIl=$this->_get('type','intval');
if($IIIIIIlIllIl==1){
$IIIIIIIlIIIl=$IIIIIIIIIl11->where($IIIIIIlll11l)->setInc('status');
if($IIIIIIIlIIIl!=false){
$this->success('操作成功');
}else{
$this->error('操作失败');
}
}else{
$IIIIIIIlIIIl=$IIIIIIIIIl11->where($IIIIIIlll11l)->setDec('status');
if($IIIIIIIlIIIl!=false){
$this->success('操作成功');
}else{
$this->error('操作失败');
}
}
}else{
$this->error('无权限修改');
}
}else{
$this->error('非法操作');
}
}
public function del(){
$IIIIIIIIIl11['id']=$this->_get('id','intval');
$IIIIIIIIIl11['token']=session('token');
$IIIIIIll1IIl=M('Api')->where($IIIIIIIIIl11)->find();
if($IIIIIIll1IIl==false){
$this->error('非法操作');
}else{
$IIIIIIll1II1=M('Api')->where($IIIIIIIIIl11)->delete();
if($IIIIIIll1II1==false){
$this->error('没做任何修改');
}else{
$this->success('删除成功');
}
}
}
}
?>