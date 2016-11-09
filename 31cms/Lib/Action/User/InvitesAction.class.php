<?php

class InvitesAction extends UserAction{
public function index(){
$IIIIIIIlIII1=D('Invites');
$IIIIIIIIlIl1['token']=session('token');
$IIIIIIIII1ll=$IIIIIIIlIII1->where($IIIIIIIIlIl1)->count();
$IIIIIIIII11I=new Page($IIIIIIIII1ll,25);
$IIIIIIIIIlll=$IIIIIIIlIII1->where($IIIIIIIIlIl1)->order('id ASC')->limit($IIIIIIIII11I->firstRow.','.$IIIIIIIII11I->listRows)->select();
$this->assign('page',$IIIIIIIII11I->show());
$this->assign('list',$IIIIIIIIIlll);
$this->display();
}
public function add(){
$IIIIIIIIlIlI	  =  $this->_get('token');
if(IS_POST){
$IIIIIIIIIl11=D('Invites');
$_POST['token']=session('token');
if($IIIIIIIIIl11->create()!=false){
if($IIIIIIIII1I1=$IIIIIIIIIl11->add()){
$IIIIIIllllI1['pid']=$IIIIIIIII1I1;
$IIIIIIllllI1['module']='Invites';
$IIIIIIllllI1['token']=session('token');
$IIIIIIllllI1['keyword']=$_POST['keyword'];
M('Keyword')->add($IIIIIIllllI1);
$this->success('添加成功',U('Invites/index'));
}else{
$this->error('服务器繁忙,请稍候再试');
}
}else{
$this->error($IIIIIIIIIl11->getError());
}
}else{
$this->assign('Token',$IIIIIIIIlIlI);
$this->display();
}
}
public function edit(){
$IIIIIIIII1I1=intval($_GET['id']);
$IIIIIIIIlIl1['id']=$IIIIIIIII1I1;
$IIIIIIIIlIl1['token']=session('token');
$IIIIII1I11I1=M('Invites')->where($IIIIIIIIlIl1)->find();
if(IS_POST){
$IIIIIIIIIl11=D('Invites');
$IIIIIIIIlIlI	  =  $this->_get('token');
$IIIIIIIII1I1=intval($_GET['id']);
$_POST['id']=$this->_get('id');
$_POST['token']=session('token');
$IIIIIIIIlIl1=array('id'=>$_POST['id'],'token'=>$_POST['token']);
$IIIIIIl111Il=$IIIIIIIIIl11->where($IIIIIIIIlIl1)->find();
if($IIIIIIl111Il==false)$this->error('非法操作');
if($IIIIIIIIIl11->create()){
if($IIIIIIIII1I1=$IIIIIIIIIl11->where($IIIIIIIIlIl1)->save($_POST)){
$IIIIIIllllI1['pid']=$_POST['id'];
$IIIIIIllllI1['module']='Invites';
$IIIIIIllllI1['token']=session('token');
$IIIIIIIlII11['keyword']=$_POST['keyword'];
M('Keyword')->where($IIIIIIllllI1)->save($IIIIIIIlII11);
$this->success('修改成功');
}else{
$this->error('操作失败');
}
}else{
$this->error($IIIIIIIIIl11->getError());
}
}else{
$IIIIIIIII1I1=$this->_get('id');
$IIIIIIIIlIl1=array('id'=>$IIIIIIIII1I1,'token'=>session('token'));
$IIIIIIIIIl11=M('Invites');
$IIIIIIl111Il=$IIIIIIIIIl11->where($IIIIIIIIlIl1)->find();
if($IIIIIIl111Il==false)$this->error('非法操作');
$IIIIII1I11lI=$IIIIIIIIIl11->where($IIIIIIIIlIl1)->find();
$this->assign('info',$IIIIII1I11I1);
$this->display();
}
}
public function info(){
$IIIIIIIIlIl1['iid'] = intval($_GET['id']);
$IIIIIIIIlIl1['type'] = intval($_GET['type']);
$IIIIIIIIlIl1['token']	  =  $this->_get('token');
$IIIIII1I11ll = intval($_GET['type']);
$IIIIIIIII1ll=M('Invites_info')->where($IIIIIIIIlIl1)->count();
$IIIIIIIII11I=new Page($IIIIIIIII1ll,25);
$IIIIIIIIIlll=M('Invites_info')->where($IIIIIIIIlIl1)->limit($IIIIIIIII11I->firstRow.','.$IIIIIIIII11I->listRows)->select();
$this->assign('page',$IIIIIIIII11I->show());
$this->assign('info',$IIIIIIIIIlll);
$this->assign('types',$IIIIII1I11ll);
$this->display();
}
public function del(){
$IIIIIIIII1I1=$this->_get('id');
$IIIIIIIIlIl1=array('id'=>$IIIIIIIII1I1,'token'=>session('token'));
$IIIIIIIIIl11=M('Invites');
$IIIIIIl111Il=$IIIIIIIIIl11->where($IIIIIIIIlIl1)->find();
if($IIIIIIl111Il==false)$this->error('非法操作');
$IIIIIIIlIIIl=$IIIIIIIIIl11->where($IIIIII1IIllI)->delete();
if($IIIIIIIlIIIl==true){
M('Keyword')->where(array('pid'=>$IIIIIIIII1I1,'token'=>session('token'),'module'=>'Invites'))->delete();
M('Invites_info')->where(array('iid'=>$IIIIIIIII1I1,'token'=>session('token')))->delete();
$this->success('删除成功');
}else{
$this->error('操作失败');
}
}
public function info_del(){
$IIIIIIIIlIl1['id']=$this->_get('id','intval');
$IIIIIIIIlIl1['type']=$this->_get('type','intval');
$IIIIIIIIlIl1['token']=$this->_get('token','intval');
if(D('Invites_info')->where($IIIIIIIIlIl1)->delete()){
$this->success('操作成功');
}else{
$this->error('操作失败');
}
}
}
?>