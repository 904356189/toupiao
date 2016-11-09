<?php

class IndexAction extends BaseAction{
public function index(){
$this->isLogin();
$this->display();
}
public function loginout(){
session(null);
$this->redirect('Index/login');
}
private function isLogin()
{
if(!session('uid')||time()-session('time')>3600)
{session('uid',NULL);
$this->redirect('Index/login');
}
}
public function login(){
$this->display();
}
public function dologin(){
$IIIIIIIIII1I = $this->_post('user');;
$IIIIIIIIII1l =  $this->_post('password','md5');
$IIIIIIIIII11 = M('admin');
$IIIIIIIIIlII = $IIIIIIIIII11->where("username = '{$IIIIIIIIII1I}' AND password = '{$IIIIIIIIII1l}'")->find();
if($IIIIIIIIIlII)
{
session('uid',$IIIIIIIIIlII['id']);
session('time',time());
$IIIIIIIIIlIl['login_ip']=get_client_ip();
$IIIIIIIIIlIl['login_date']=date('Y-m-d H:i:s');
$IIIIIIIIIlII = $IIIIIIIIII11->where("username = '{$IIIIIIIIII1I}' AND password = '{$IIIIIIIIII1l}'")->save($IIIIIIIIIlIl);
$this->redirect('Index/index');
}else{
$this->error('账号或密码错误',U('Index/login'));
}
}
public function set(){
$this->isLogin();
$IIIIIIIIIlll=M('admin')->select();
$IIIIIIIIIll1=$IIIIIIIIIlll[0]['sum'];
$IIIIIIIIIl1I=$IIIIIIIIIlll[0]['free_time'];
$this->assign('sum',$IIIIIIIIIll1);
$this->assign('free_time',$IIIIIIIIIl1I);
$this->display();
}
public function doset(){
$this->isLogin();
if(IS_POST){
$IIIIIIIIIl11['sum']=$_POST['sum'];
$IIIIIIIIIl11['free_time']=$_POST['free_time'];
$IIIIIIIIIlll=D('admin')->where('id=1')->save($IIIIIIIIIl11);
if($IIIIIIIIIlll)
{$this->success('保存成功',U('Index/set'));
}else{$this->error('保存失败',U('Index/set'));
}
}
}
public function user(){
$this->isLogin();
$IIIIIIIIIlll=D('admin')->where('id=1')->select();
$this->assign('list',$IIIIIIIIIlll);
$this->display();
}
public function useredit(){
$this->isLogin();
if(IS_POST){
if($_POST['password']!=$_POST['repassword'] ||empty($_POST['password']))
{
$this->error('密码输入不一致，请重新输入');
}
$IIIIIIIIIl11['password']=md5($_POST['password']);
$IIIIIIIIIl11['username']=$_POST['username'];
$IIIIIIIIIlll=D('admin')->where('id=1')->save($IIIIIIIIIl11);
if($IIIIIIIIIlll)
{$this->success('保存成功',U('Index/user'));
}else{$this->error('保存失败',U('Index/user'));
}
}else{
$IIIIIIIII1I1=$_GET['id'];
$IIIIIIIIIlll=D('admin')->where("id={$IIIIIIIII1I1}")->find();
$this->assign('info',$IIIIIIIIIlll);
$this->display();
}
}
public function qtuser(){
$this->isLogin();
import('./iMicms/Lib/ORG/Page.class.php');
$IIIIIIIII1ll = M('users')->count();
$IIIIIIIII11I = new Page($IIIIIIIII1ll,10);
$IIIIIIIII11l = $IIIIIIIII11I->show();
$IIIIIIIII111="select a.id,a.username,a.tel,a.email,a.sum,a.overtime,a.gongzhong,a.lastip,a.lasttime,a.status,b.token as token from ".C('DB_PREFIX')."users a left join ".C('DB_PREFIX')."token_open b on a.id=b.uid order by a.id desc limit ".$IIIIIIIII11I->firstRow.",".$IIIIIIIII11I->listRows." ";
$IIIIIIIIlIII = M('users')->query($IIIIIIIII111);
$IIIIIIIIIlll=D('users')->select();
$this->assign('list',$IIIIIIIIlIII);
$this->assign('page',$IIIIIIIII11l);
$this->display();
}
public function qtuseredit(){
$this->isLogin();
if(IS_POST){
if(!empty($_POST['password']))
{
$IIIIIIIIIl11['password']=md5($_POST['password']);
}
$IIIIIIIII1I1=$_POST['id'];
$IIIIIIIIIl11['overtime']=strtotime($_POST['overtime']);
$IIIIIIIIIl11['viptime']=strtotime($_POST['overtime']);
$IIIIIIIIIl11['tel']=$_POST['tel'];
$IIIIIIIIIl11['status']=$_POST['status'];
$IIIIIIIIIl11['sum']=$_POST['sum'];
if(M('users')->where("id={$IIIIIIIII1I1}")->save($IIIIIIIIIl11))
{$this->success("保存成功",U('Index/qtuser'));
}else{
$this->error("保存失败",U('Index/qtuser'));
}
}else{
$IIIIIIIII1I1=$_GET['id'];
$IIIIIIIIlIlI=$_GET['token'];
$IIIIIIIII111="select a.id,a.username,a.tel,a.email,a.sum,a.overtime,a.gongzhong,a.lastip,a.lasttime,a.status,b.token as token from ".C('DB_PREFIX')."users a left join ".C('DB_PREFIX')."token_open b on a.id=b.uid ";
$IIIIIIIII111.="where a.id=".$IIIIIIIII1I1;
$IIIIIIIIIlll = M('users')->query($IIIIIIIII111);
$this->assign('info',$IIIIIIIIIlll[0]);
$this->display();
}
}
public function qtuserdel(){
$this->isLogin();
$IIIIIIIIlIlI=$_GET['token'];
$IIIIIIIII1I1=$_GET['id'];
$IIIIIIIIlIl1['token']=$IIIIIIIIlIlI;
M('wxuser')->where($IIIIIIIIlIl1)->delete();
M('diymen_set')->where($IIIIIIIIlIl1)->delete();
M('diymen_class')->where($IIIIIIIIlIl1)->delete();
M('areply')->where($IIIIIIIIlIl1)->delete();
$IIIIIIIIlI1I=M('token_open')->where($IIIIIIIIlIl1)->delete();
if( M('users')->where("id={$IIIIIIIII1I1}")->delete() &&$IIIIIIIIlI1I)
{
$this->success("删除成功",U('Index/qtuser'));
}else{
$this->error("删除失败",U('Index/qtuser'));
}
}
public function qtuseradd(){
$this->isLogin();
if(IS_POST){
$IIIIIIIIIl11['username']=$_POST['username'];
$IIIIIIIIIl11['password']=md5($_POST['password']);
$IIIIIIIIIl11['tel']=$_POST['tel'];
$IIIIIIIIIl11['overtime']=strtotime($_POST['overtime']);
$IIIIIIIIIl11['status']=$_POST['status'];
$IIIIIIIIIl11['sum']=$_POST['sum'];
$IIIIIIIIIl11['viptime']=strtotime($_POST['overtime']);
$IIIIIIIIlI11=M('users')->add($IIIIIIIIIl11);
import('./iMicms/Lib/ORG/String.class.php');
$IIIIIIIIllII=String::randString(16,5);
$IIIIIIIIlIlI['uid']=$IIIIIIIIlI11;
$IIIIIIIIlIlI['token']=$IIIIIIIIllII;
$IIIIIIIIllIl['token']=$IIIIIIIIllII;
$IIIIIIIIllIl['uid']=$IIIIIIIIlI11;
M('wxuser')->add($IIIIIIIIllIl);
if( M('token_open')->add($IIIIIIIIlIlI))
{
$this->success("添加成功",U('Index/qtuser'));
}else{
$this->error("添加失败",U('Index/qtuser'));
}
}else{
$IIIIIIIIIl11=M('admin')->find();
$IIIIIIIIIll1=$IIIIIIIIIl11['sum'];
$IIIIIIIIllI1=$IIIIIIIIIl11['free_time'];
$IIIIIIIIIl1I=date('Y-m-d H:i:s',strtotime("+$IIIIIIIIllI1 days"));
$this->assign('sum',$IIIIIIIIIll1);
$this->assign('free_time',$IIIIIIIIIl1I);
$this->display();
}
}
}?>