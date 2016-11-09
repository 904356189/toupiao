<?php

class UsersAction extends BaseAction{
public function index(){
header("Location: /");
}
public function companylogin() {
$IIIIIII11ll1 = D('Company');
$IIIIIIIIlIl1['username'] = $this->_post('username','trim');
$IIIIIIIll1ll = $IIIIIIIIlIl1['id'] = $this->_post('cid','intval');
$IIIIIIIllIll = $this->_post('k','trim, htmlspecialchars');
if (empty($IIIIIIIllIll) ||$IIIIIIIllIll != md5($IIIIIIIIlIl1['id'] .$IIIIIIIIlIl1['username'])) {
$this->error('帐号密码错误',U('Home/Index/clogin',array('cid'=>$IIIIIIIll1ll,'k'=>$IIIIIIIllIll)));
}
$IIIIIII11l1I = $this->_post('password','trim,md5');
$IIIIIII11l1l = $IIIIIII11ll1->where($IIIIIIIIlIl1)->find();
if($IIIIIII11l1l &&($IIIIIII11l1I === $IIIIIII11l1l['password'])){
if ($IIIIIIIIllIl = D('Wxuser')->where(array('token'=>$IIIIIII11l1l['token']))->find()) {
$IIIIIIIIIlII = $IIIIIIIIllIl['uid'];
$IIIIIIIlIII1 = D('Users');
$IIIIIII11l11 = $IIIIIIIlIII1->where(array('id'=>$IIIIIIIIIlII))->find();
}else {
$this->error('帐号密码错误',U('Home/Index/clogin',array('cid'=>$IIIIIIIll1ll,'k'=>$IIIIIIIllIll)));
}
session('companyk',$IIIIIIIllIll);
session('companyLogin',1);
session('companyid',$IIIIIII11l1l['id']);
session('token',$IIIIIII11l1l['token']);
session('uid',$IIIIIII11l11['id']);
session('gid',$IIIIIII11l11['gid']);
session('uname',$IIIIIII11l11['username']);
$IIIIIIIIIlll=M('user_group')->find($IIIIIII11l11['gid']);
session('diynum',$IIIIIII11l11['diynum']);
session('connectnum',$IIIIIII11l11['connectnum']);
session('activitynum',$IIIIIII11l11['activitynum']);
session('viptime',$IIIIIII11l11['viptime']);
session('gname',$IIIIIIIIIlll['name']);
$IIIIIII111II=time();
$IIIIIII111Il=date('m',$IIIIIII111II);
if($IIIIIII111Il!=$IIIIIII11l11['lastloginmonth']&&$IIIIIII11l11['lastloginmonth']!=0){
$IIIIIIIIIl11['id']=$IIIIIII11l11['id'];
$IIIIIIIIIl11['imgcount']=0;
$IIIIIIIIIl11['diynum']=0;
$IIIIIIIIIl11['textcount']=0;
$IIIIIIIIIl11['musiccount']=0;
$IIIIIIIIIl11['connectnum']=0;
$IIIIIIIIIl11['activitynum']=0;
$IIIIIIIlIII1->save($IIIIIIIIIl11);
session('diynum',0);
session('connectnum',0);
session('activitynum',0);
}
$IIIIIIIlIII1->where(array('id'=>$IIIIIII11l11['id']))->save(array('lasttime'=>$IIIIIII111II,'lastloginmonth'=>$IIIIIII111Il,'lastip'=>$_SERVER['REMOTE_ADDR']));
$this->success('登录成功',U('User/Repast/index',array('cid'=>$IIIIIIIll1ll)));
}else{
$this->error('帐号密码错误',U('Home/Index/clogin',array('cid'=>$IIIIIIIll1ll,'k'=>$IIIIIIIllIll)));
}
}
public function companyLogout()
{
$IIIIIIIll1ll = session('companyid');
$IIIIIIIllIll = session('companyk');
session(null);
session_destroy();
unset($_SESSION);
if(session('?'.C('USER_AUTH_KEY'))) {
session(C('USER_AUTH_KEY'),null);
redirect(U('Home/Index/clogin',array('cid'=>$IIIIIIIll1ll,'k'=>$IIIIIIIllIll)));
}else {
$this->success('已经登出！',U('Home/Index/clogin',array('cid'=>$IIIIIIIll1ll,'k'=>$IIIIIIIllIll)));
}
}
public function checklogin(){
$IIIIIII111ll=$this->_post('verifycode2','intval,md5',0);
if (isset($_POST['verifycode2'])){
if($IIIIIII111ll != $_SESSION['loginverify']){
$this->error('验证码错误',U('Index/login'));
}
}
$IIIIIIIlIII1=D('Users');
$IIIIIIIIlIl1['username']=$this->_post('username','trim');
$IIIIIII11l1I=$this->_post('password','trim,md5');
$IIIIIII11l11=$IIIIIIIlIII1->where($IIIIIIIIlIl1)->find();
if($IIIIIII11l11&&($IIIIIII11l1I===$IIIIIII11l11['password'])){
if($IIIIIII11l11['status']==0){
$this->error('请联系在线客服，为您人工审核帐号');exit;
}
if($IIIIIII11l11['overtime']<time()){
$this->error('您的账户已过期，请联系在线服续费');exit;
}
$IIIIIII111l1['uid'] = $IIIIIII11l11['id'];
$IIIIIII1111I = D('token_open');
$IIIIIIIIlIlI = $IIIIIII1111I->where($IIIIIII111l1)->getField('token');
session('uid',$IIIIIII11l11['id']);
session('gid',$IIIIIII11l11['gid']);
session('uname',$IIIIIII11l11['username']);
$IIIIIIIIIlll=M('user_group')->find($IIIIIII11l11['gid']);
session('diynum',$IIIIIII11l11['diynum']);
session('connectnum',$IIIIIII11l11['connectnum']);
session('activitynum',$IIIIIII11l11['activitynum']);
session('viptime',$IIIIIII11l11['viptime']);
session('gname',$IIIIIIIIIlll['name']);
session('token',$IIIIIIIIlIlI);
$IIIIIII111II=time();
$IIIIIII111Il=date('m',$IIIIIII111II);
if($IIIIIII111Il!=$IIIIIII11l11['lastloginmonth']&&$IIIIIII11l11['lastloginmonth']!=0){
$IIIIIIIIIl11['id']=$IIIIIII11l11['id'];
$IIIIIIIIIl11['imgcount']=0;
$IIIIIIIIIl11['diynum']=0;
$IIIIIIIIIl11['textcount']=0;
$IIIIIIIIIl11['musiccount']=0;
$IIIIIIIIIl11['connectnum']=0;
$IIIIIIIIIl11['activitynum']=0;
$IIIIIIIlIII1->save($IIIIIIIIIl11);
session('diynum',0);
session('connectnum',0);
session('activitynum',0);
}
$IIIIIIIlIII1->where(array('id'=>$IIIIIII11l11['id']))->save(array('lasttime'=>$IIIIIII111II,'lastloginmonth'=>$IIIIIII111Il,'lastip'=>htmlspecialchars(trim(get_client_ip()))));
$this->success('登录成功',U('User/Vote/index'));
}else{
$this->error('帐号密码错误',U('Index/index'));
}
}
function randStr($IIIIIII11111){
$IIIIIII11111=intval($IIIIIII11111);
$IIIIIIlIIIII='abcdefghjkmnpqrstuvwxyz';
$IIIIIIIllI1I=strlen($IIIIIIlIIIII);
$IIIIIIlIIIIl='';
for ($IIIIIIIllI11=0;$IIIIIIIllI11<$IIIIIII11111;$IIIIIIIllI11++){
$IIIIIIlIIIIl.=$IIIIIIlIIIII[rand(0,$IIIIIIIllI1I-1)];
}
return $IIIIIIlIIIIl;
}
public function checkreg(){
}
public function get_sms_auth_code() {
}
public function checkAuthCode(){
if($_POST['tel_auth_code'] != ''&&$_POST['tel_auth_code'] == session('smsAuthCode')){
$this->ajaxReturn('1','json');
}else{
$this->ajaxReturn('2','json');
}
}
protected function sendSMS($IIIIIIlIII1I,$IIIIIIIIIlII,$IIIIIII11l1I,$IIIIIIlIII1l,$IIIIIIIl1II1,$IIIIIIlIII11,$IIIIIIlIIlII='',$IIIIIIlIIlIl='')
{
}
protected function postSMS($IIIIIII1l1Il,$IIIIIIIIIl11='')
{
}
public function checkpwd(){
$IIIIIIIIlIl1['username']=$this->_post('username');
$IIIIIIIIlIl1['email']=$this->_post('email');
$IIIIIIIlIII1=D('Users');
$IIIIIIIIlIII=$IIIIIIIlIII1->where($IIIIIIIIlIl1)->find();
if($IIIIIIIIlIII==false) $this->error('邮箱和帐号不正确',U('Index/regpwd'));
$IIIIIIlIIlll = C('email_server');
$IIIIIIlIIll1 = C('email_port');
$IIIIIIlIIl1I = C('email_user');
$IIIIIIlIIl1l = C('email_pwd');
$IIIIIIlIIl11 = "TXT";
$IIIIIIlII1II = C('email_user');
$IIIIIIlII1Il = new Smtp($IIIIIIlIIlll,$IIIIIIlIIll1,true,$IIIIIIlIIl1I,$IIIIIIlIIl1l,$IIIIIIlII1II);
$IIIIIIlII1I1 = $IIIIIIIIlIII['email'];
$IIIIIIlII1lI = C('pwd_email_title');
$IIIIIIIl1lII = C('site_url').U('Index/resetpwd',array('uid'=>$IIIIIIIIlIII['id'],'code'=>md5($IIIIIIIIlIII['id'].$IIIIIIIIlIII['password'].$IIIIIIIIlIII['email']),'resettime'=>time()));
$IIIIIIlII1ll = C('pwd_email_content');
$IIIIIIlII1ll = str_replace('{username}',$IIIIIIIIlIl1['username'],$IIIIIIlII1ll);
$IIIIIIlII1ll = str_replace('{time}',date('Y-m-d H:i:s',$_SERVER['REQUEST_TIME']),$IIIIIIlII1ll);
$IIIIIIlII1ll = str_replace('{code}',$IIIIIIIl1lII,$IIIIIIlII1ll);
$IIIIIIlII1l1=$IIIIIIlII1ll;
$IIIIIIlII11l=$IIIIIIlII1Il->sendmail($IIIIIIlII1I1,$IIIIIIlII1II,$IIIIIIlII1lI,$IIIIIIlII1l1,$IIIIIIlIIl11);
$this->success('请访问你的邮箱 '.$IIIIIIIIlIII['email'].' 验证邮箱后登录!<br/>');
}
public function resetpwd(){
$IIIIIIIIlIl1['id']=$this->_post('uid','intval');
$IIIIIIIIlIl1['password']=$this->_post('password','md5');
if(M('Users')->save($IIIIIIIIlIl1)){
$this->success('修改成功，请登录！',U('Index/login'));
}else{
$this->error('密码修改失败！',U('Index/index'));
}
}
}?>