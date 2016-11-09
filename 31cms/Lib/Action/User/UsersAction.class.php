<?php

class UsersAction extends BackAction
{
public function index()
{
$IIIIIIIlIII1 = D('Users');
$IIIIIIl11l11 = M('User_group')->field('id,name')->order('id desc')->select();
$IIIIIIIIlIl1 = 'agentid = 0';
if (isset($_GET['agentid'])) {
$IIIIIIIIlIl1 = array('agentid'=>intval($_GET['agentid']));
}
if (isset($_GET['inviter'])) {
$IIIIIIIIlIl1 = array('inviter'=>intval($_GET['inviter']));
}
$IIIIIIIII1ll = $IIIIIIIlIII1->where($IIIIIIIIlIl1)->count();
$IIIIIIll1lll = new Page($IIIIIIIII1ll,25);
$IIIIIIIII11l = $IIIIIIll1lll->show();
$IIIIIIIIlIII = $IIIIIIIlIII1->where($IIIIIIIIlIl1)->order('id desc')->limit($IIIIIIll1lll->firstRow .','.$IIIIIIll1lll->listRows)->select();
foreach ($IIIIIIl11l11 as $IIIIIIIlI11I =>$IIIIIIl1llIl) {
$IIIIIIIl11l1[$IIIIIIl1llIl['id']] = $IIIIIIl1llIl['name'];
}
unset($IIIIIIl11l11);
$this->assign('info',$IIIIIIIIlIII);
$this->assign('page',$IIIIIIIII11l);
$this->assign('group',$IIIIIIIl11l1);
$this->display();
}
public function add()
{
$IIIIIllIIllI = D('Users');
if (isset($_POST['dosubmit'])) {
$IIIIIlI1l1l1 = $_POST['password'];
$IIIIIllIIlll = $_POST['repassword'];
if (empty($IIIIIlI1l1l1) ||empty($IIIIIllIIlll)) {
$this->error('密码必须填写！');
}
if ($IIIIIlI1l1l1 != $IIIIIllIIlll) {
$this->error('两次输入密码不一致！');
}
$_POST['viptime'] = strtotime($_POST['viptime']);
if ($IIIIIllIIllI->create()) {
$IIIIIllIIll1 = $IIIIIllIIllI->add();
if ($IIIIIllIIll1) {
$this->success('添加成功！',U('Users/index'));
}else {
$this->error('添加失败!');
}
}else {
$this->error($IIIIIllIIllI->getError());
}
}else {
$IIIIII1IIlIl = array('status'=>1);
if (C('agent_version')) {
$IIIIII1IIlIl['agentid'] = array('lt',1);
}
$IIIIIllIIl1I = M('User_group')->field('id,name')->where($IIIIII1IIlIl)->select();
$this->assign('role',$IIIIIllIIl1I);
$this->assign('tpltitle','添加');
$this->display();
}
}
public function search()
{
$IIIIIIIlIIII = $this->_post('name');
$IIIIIIlIllIl = $this->_post('type');
switch ($IIIIIIlIllIl) {
case 1:
$IIIIIIIIIl11['username'] = $IIIIIIIlIIII;
break;
case 2:
$IIIIIIIIIl11['id'] = $IIIIIIIlIIII;
break;
case 3:
$IIIIIIIIIl11['email'] = $IIIIIIIlIIII;
}
$IIIIIIIIlIII = M('Users')->where($IIIIIIIIIl11)->select();
$this->assign('info',$IIIIIIIIlIII);
$this->display('index');
}
public function edit()
{
$IIIIIllIIllI = D('Users');
if (isset($_POST['dosubmit'])) {
S('user_'.intval($_POST['id']),NULL);
$IIIIIlI1l1l1 = $this->_post('password','trim',0);
$IIIIIllIIlll = $this->_post('repassword','trim',0);
$IIIIII1I1IIl = M('Users')->field('gid')->find($_POST['id']);
if ($IIIIIlI1l1l1 != $IIIIIllIIlll) {
$this->error('两次输入密码不一致！');
}
if ($IIIIIlI1l1l1 == false) {
unset($_POST['password']);
unset($_POST['repassword']);
}else {
$_POST['password'] = md5($IIIIIlI1l1l1);
}
unset($_POST['dosubmit']);
unset($_POST['__hash__']);
$_POST['viptime'] = strtotime($_POST['viptime']);
if ($IIIIIllIIllI->save($_POST)) {
if ($_POST['gid'] != $IIIIII1I1IIl['gid']) {
$IIIIII1I1Il1 = M('User_group')->field('func')->where(array('id'=>$_POST['gid']))->find();
$IIIIIIlIlI1l['queryname'] = $IIIIII1I1Il1['func'];
$IIIIIIIIIlII['uid'] = $_POST['id'];
$IIIIIIIIlIlI = M('Wxuser')->field('token')->where($IIIIIIIIIlII)->select();
if ($IIIIIIIIlIlI) {
$IIIIIllIIl11 = M('Token_open');
foreach ($IIIIIIIIlIlI as $IIIIIIIlI11I =>$IIIIIIl1llIl) {
$IIIIIllII1II['token'] = $IIIIIIl1llIl['token'];
$IIIIIllIIl11->where($IIIIIllII1II)->save($IIIIIIlIlI1l);
}
}
}
$this->success('编辑成功！',U('Users/index'));
}else {
$this->error('编辑失败!');
}
}else {
$IIIIIIIII1I1 = $this->_get('id','intval',0);
if (!$IIIIIIIII1I1) {
$this->error('参数错误!');
}
$IIIIII1IIlIl = array('status'=>1);
if (C('agent_version')) {
$IIIIII1IIlIl['agentid'] = array('lt',1);
}
$IIIIIllIIl1I = M('User_group')->field('id,name')->where($IIIIII1IIlIl)->select();
$IIIIIIIIIlll = $IIIIIllIIllI->find($IIIIIIIII1I1);
$IIIIIllII1Il = $IIIIIllIIllI->where(array('inviter'=>$IIIIIIIII1I1))->count();
$this->assign('inviteCount',$IIIIIllII1Il);
$this->assign('tpltitle','编辑');
$this->assign('role',$IIIIIllIIl1I);
$this->assign('info',$IIIIIIIIIlll);
$this->display('add');
}
}
public function addfc()
{
$IIIIIIl11l1I = M('Token_open');
$IIIIIIlIlI1l['uid'] = session('uid');
$IIIIIIlIlI1l['token'] = $_POST['token'];
$IIIIII1I1Ill = session('gid');
$IIIIIIIllllI = M('Function')->field('funname,gid,isserve')->where('`gid` <= '.$IIIIII1I1Ill)->select();
foreach ($IIIIIIIllllI as $IIIIIIIlI11I =>$IIIIIIlll11l) {
$IIIIII1I1Il1 .= $IIIIIIlll11l['funname'] .',';
}
$IIIIIIlIlI1l['queryname'] = rtrim($IIIIII1I1Il1,',');
$IIIIIIl11l1I->data($IIIIIIlIlI1l)->add();
}
public function del()
{
$IIIIIIIII1I1 = $this->_get('id','intval',0);
if (!$IIIIIIIII1I1) {
$this->error('参数错误!');
}
$IIIIIllIIllI = D('Users');
$IIIIIllII1I1 = $IIIIIllIIllI->where(array('id'=>$IIIIIIIII1I1))->find();
$IIIIIIIIlIl1['uid'] = $IIIIIIIII1I1;
$IIIIIllII1lI = M('wxuser')->where($IIIIIIIIlIl1)->count();
if ($IIIIIllIIllI->delete($IIIIIIIII1I1)) {
if ($IIIIIllII1I1['agentid']) {
M('Agent')->where(array('id'=>$IIIIIllII1I1['agentid']))->setDec('usercount');
M('Agent')->where(array('id'=>$IIIIIllII1I1['agentid']))->setDec('wxusercount',$IIIIIllII1lI);
}
$this->assign('jumpUrl');
$this->success('删除成功！');
}else {
$this->error('删除失败!');
}
}
}
?>