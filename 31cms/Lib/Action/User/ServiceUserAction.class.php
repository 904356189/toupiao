<?php

class  ServiceUserAction extends UserAction{
public $IIIIIIIIlIlI;
private $IIIIIIIIIl11;
private $IIIIIIlIlIll;
public function _initialize(){
parent::_initialize();
$this->IIIIIIlIlIll=$this->_get('openid','htmlspecialchars');
if($this->IIIIIIlIlIll==false){
}
$this->IIIIIIIIlIlI=session('token');
$this->IIIIIIIIIl11=D('Service_user');
}
public function wechatService(){
if (IS_POST){
D('Wxuser')->where(array('token'=>$this->IIIIIIIIlIlI))->save(array('transfer_customer_service'=>intval($_POST['transfer_customer_service'])));
S('wxuser_'.$this->IIIIIIIIlIlI,NULL);
$this->success('设置成功');
}else {
$this->IIIIIIIIllIl=S('wxuser_'.$this->IIIIIIIIlIlI);
if (!$this->IIIIIIIIllIl){
$this->IIIIIIIIllIl=D('Wxuser')->where(array('token'=>$this->IIIIIIIIlIlI))->find();
S('wxuser_'.$this->IIIIIIIIlIlI,$this->IIIIIIIIllIl);
}
$this->assign('info',$this->IIIIIIIIllIl);
$this->display();
}
}
public function index(){
$IIIIIIIIlIl1['token']=session('token');
$IIIIIIIII1ll=$this->IIIIIIIIIl11->where($IIIIIIIIlIl1)->count();
$IIIIIIIII11I=new Page($IIIIIIIII1ll,25);
$IIIIIIIIlIII=$this->IIIIIIIIIl11->where($IIIIIIIIlIl1)->limit($IIIIIIIII11I->firstRow.','.$IIIIIIIII11I->listRows)->order('id desc')->select();
$this->assign('page',$IIIIIIIII11I->show());
if ($IIIIIIIIlIII){
$IIIIIlIlIII1=30*60;
$IIIIIlIlIIlI=time();
$IIIIIIlIIlII=$IIIIIlIlIIlI-$IIIIIlIlIII1;
$IIIIIIIllI11=0;
foreach ($IIIIIIIIlIII as $IIIIII1Il1I1){
$IIIIIIIIlIII[$IIIIIIIllI11]['online']=0;
if ($IIIIII1Il1I1['endJoinDate']>$IIIIIIlIIlII){
$IIIIIIIIlIII[$IIIIIIIllI11]['online']=1;
}
$IIIIIIIllI11++;
}
}
$this->assign('list',$IIIIIIIIlIII);
$this->assign('type','list');
$this->display();
}
public function add(){
if(IS_POST){
$IIIIIIIlIII1=D("Service_user");
if($IIIIIIIlIII1->create()===false){
$this->error($IIIIIIIlIII1->getError());
}else{
$IIIIIIIII1I1=$IIIIIIIlIII1->add();
if($IIIIIIIII1I1==true){
M('Users')->where(array('id'=>session('uid')))->setInc('serviceUserNum');
$this->success('操作成功');
}else{
$this->error('操作失败');
}
}
}else{
$this->display();
}
}
public function closeService(){
$IIIIIIIIlIl1['token']=session('token');
$IIIIIlIlIIl1=time()-60*600;
$IIIIIII1lII1=M('Service_user')->where($IIIIIIIIlIl1)->save(array('endJoinDate'=>$IIIIIlIlIIl1));
$this->success('操作成功');
}
public function edit(){
if(IS_POST){
if(empty($_POST['userPwd'])){
unset($_POST['userPwd']);
}
$_POST['id']=$this->_get('id','intval');
$this->all_save('Service_user','/index');
}else{
$IIIIIIIIlIl1['id']=$this->_get('id','intval');
$IIIIIIIIlIl1['session']=session('session');
$IIIIIIIIIlll=M('ServiceUser')->where($IIIIIIIIlIl1)->find();
$this->assign('serviceUser',$IIIIIIIIIlll);
$this->display('add');
}
}
public function chat_log(){
$IIIIIIIIIl11=M('service_logs');
$IIIIIIIIlIl1['token']=session('token');
$IIIIIIIII1ll=$IIIIIIIIIl11->where($IIIIIIIIlIl1)->count();
$IIIIIIIII11I=new Page($IIIIIIIII1ll,25);
$IIIIIIIIlIII=$IIIIIIIIIl11->where($IIIIIIIIlIl1)->limit($IIIIIIIII11I->firstRow.','.$IIIIIIIII11I->listRows)->order('id desc')->select();
foreach($IIIIIIIIlIII as $IIIIIIIlI11I=>$IIIIIIlll11l){
$IIIIIIIIlIII[$IIIIIIIlI11I]['name']=D('Service_user')->getServiceUser($IIIIIIlll11l['pid']);
}
$this->assign('page',$IIIIIIIII11I->show());
$this->assign('list',$IIIIIIIIlIII);
$this->assign('type','list');
$this->display();
}
public function del (){
M('Users')->where(array('id'=>session('uid')))->setDec('serviceUserNum');
$this->del_id();
}
public function chat_log_del (){
$this->del_id('service_logs','Service/chat_log');
}
}
?>