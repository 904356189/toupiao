<?php

class IndexAction extends BaseAction{
public $IIIIIIIll1I1;
protected function _initialize(){
parent::_initialize();
$this->IIIIIIIIl1l1=$this->IIIIIIIIl1l1?$this->IIIIIIIIl1l1:'default';
$this->IIIIIIIll1I1='./tpl/Home/'.$this->IIIIIIIIl1l1.'/';
$this->assign('includeHeaderPath',$this->IIIIIIIll1I1.'Public_header.html');
$this->assign('includeFooterPath',$this->IIIIIIIll1I1.'Public_footer.html');
}
public function clogin()
{
$IIIIIIIll1ll = isset($_GET['cid']) ?intval($_GET['cid']) : 0;
$IIIIIIIllIll = isset($_GET['k']) ?$_GET['k'] : '';
$this->assign('cid',$IIIIIIIll1ll);
$this->assign('k',$IIIIIIIllIll);
$this->display($this->IIIIIIIIl1l1.':Index:'.ACTION_NAME);
}
public function index(){
$this->display($this->IIIIIIIIl1l1.':Index:'.ACTION_NAME);
}
public function news(){
$IIIIIIIIIlll=M('artical')->order('date DESC')->select();
$this->assign('info',$IIIIIIIIIlll);
$this->display($this->IIIIIIIIl1l1.':Index:'.ACTION_NAME);
}
public function news1(){
$IIIIIIIIIlll=M('artical')->where(array('type'=>'公司新闻'))->order('date DESC')->select();
$this->assign('info',$IIIIIIIIIlll);
$this->display($this->IIIIIIIIl1l1.':Index:'.ACTION_NAME);
}
public function news2(){
$IIIIIIIIIlll=M('artical')->where(array('type'=>'行业新闻'))->order('date DESC')->select();
$this->assign('info',$IIIIIIIIIlll);
$this->display($this->IIIIIIIIl1l1.':Index:'.ACTION_NAME);
}
public function newss(){
$IIIIIIIIIlll=M('artical')->where(array('id'=>$_GET['id']))->find();
$this->assign('info',$IIIIIIIIIlll);
$this->display($this->IIIIIIIIl1l1.':Index:'.ACTION_NAME);
}
public function show(){
$IIIIIIIIlIl1['id'] = $this->_get('id');
$IIIIIIIl1IIl = M('Seo');
$IIIIIIIIIl11 = $IIIIIIIl1IIl->where($IIIIIIIIlIl1)->find();
$IIIIIIIl1II1 = stripslashes(htmlspecialchars_decode($IIIIIIIIIl11['content']));
$this->assign('data',$IIIIIIIIIl11);
$this->assign('content',$IIIIIIIl1II1);
$this->display();
}
public function logout() {
session(null);
session_destroy();
unset($_SESSION);
redirect(U('Home/Index/index'));
}
public function verify(){
Image::buildImageVerify(4,1,'png',0,28,'verify');
}
public function verifyLogin(){
Image::buildImageVerify(4,1,'png',0,28,'loginverify');
}
public function resetpwd(){
$IIIIIIIIIlII=$this->_get('uid','intval');
$IIIIIIIl1lII=$this->_get('code','trim');
$IIIIIIIl1lIl=$this->_get('resettime','intval');
$IIIIIIIIIlll=M('Users')->find($IIIIIIIIIlII);
if( (md5($IIIIIIIIIlll['uid'].$IIIIIIIIIlll['password'].$IIIIIIIIIlll['email'])!==$IIIIIIIl1lII) ||($IIIIIIIl1lIl<time()) ){
$this->error('非法操作',U('Index/index'));
}
$this->assign('uid',$IIIIIIIIIlII);
$this->display($this->IIIIIIIIl1l1.':Index:'.ACTION_NAME);
}
public function fc(){
$this->display($this->IIIIIIIIl1l1.':Index:'.ACTION_NAME);
}
public function about(){
$this->display($this->IIIIIIIIl1l1.':Index:'.ACTION_NAME);
}
public function price(){
$IIIIIIIl1ll1=array();
$IIIIIIIl1ll1['status']=1;
if (C('agent_version')){
$IIIIIIIl1ll1['agentid']=$this->IIIIIIII1II1;
}
$IIIIIIIl1l1I=M('User_group')->where($IIIIIIIl1ll1)->order('id ASC')->select();
$this->assign('groups',$IIIIIIIl1l1I);
$IIIIIIIII1ll=count($IIIIIIIl1l1I);
$this->assign('count',$IIIIIIIII1ll);
$IIIIIIIl1l1l=array();
$IIIIIIIl1l11=array();
$IIIIIIIl11II=array();
$IIIIIIIl11Il=array();
$IIIIIIIl11I1=array();
$IIIIIIIl11lI=array();
$IIIIIIIl11ll=array();
if ($IIIIIIIl1l1I){
foreach ($IIIIIIIl1l1I as $IIIIIIIl11l1){
array_push($IIIIIIIl1l1l,$IIIIIIIl11l1['price']);
array_push($IIIIIIIl1l11,$IIIIIIIl11l1['copyright']);
array_push($IIIIIIIl11II,$IIIIIIIl11l1['wechat_card_num']);
array_push($IIIIIIIl11Il,$IIIIIIIl11l1['diynum']);
array_push($IIIIIIIl11I1,$IIIIIIIl11l1['connectnum']);
array_push($IIIIIIIl11lI,$IIIIIIIl11l1['activitynum']);
array_push($IIIIIIIl11ll,$IIIIIIIl11l1['create_card_num']);
}
}
$this->assign('prices',$IIIIIIIl1l1l);
$this->assign('copyrights',$IIIIIIIl1l11);
$this->assign('wechatNums',$IIIIIIIl11II);
$this->assign('diynums',$IIIIIIIl11Il);
$this->assign('connectnums',$IIIIIIIl11I1);
$this->assign('activitynums',$IIIIIIIl11lI);
$this->assign('create_card_nums',$IIIIIIIl11ll);
if (C('agent_version')&&$this->IIIIIIII1II1){
$IIIIIIIl111l=M('Agent_function')->where(array('status'=>1,'agentid'=>$this->IIIIIIII1II1))->order('gid DESC')->select();
}else {
$IIIIIIIl111l=M('Function')->where(array('status'=>1))->order('gid DESC')->select();
}
if ($IIIIIIIl111l){
$IIIIIIIllI11=0;
foreach ($IIIIIIIl111l as $IIIIIIIl1111){
$IIIIIIIl111l[$IIIIIIIllI11]['access']=array();
if ($IIIIIIIl1l1I){
foreach ($IIIIIIIl1l1I as $IIIIIIIl11l1){
if ($IIIIIIIl1111['gid']>$IIIIIIIl11l1['id']){
$IIIIIII1IIII=0;
}else {
$IIIIIII1IIII=1;
}
array_push($IIIIIIIl111l[$IIIIIIIllI11]['access'],$IIIIIII1IIII);
}
}
$IIIIIIIllI11++;
}
}
$this->assign('funs',$IIIIIIIl111l);
$this->display($this->IIIIIIIIl1l1.':Index:'.ACTION_NAME);
}
public function help(){
$IIIIIII1III1 = $this->_server('HTTP_HOST');
$this->assign('myurl',$IIIIIII1III1);
$this->display($this->IIIIIIIIl1l1.':Index:'.ACTION_NAME);
}
function think_encrypt($IIIIIIIIIl11,$IIIIIIIlI11I = '',$IIIIIII1IIll = 0) {
$IIIIIIIlI11I  = md5(empty($IIIIIIIlI11I) ?C('DATA_AUTH_KEY') : $IIIIIIIlI11I);
$IIIIIIIIIl11 = base64_encode($IIIIIIIIIl11);
$IIIIIII1II1I    = 0;
$IIIIIIIllI1I  = strlen($IIIIIIIIIl11);
$IIIIIII1II1l    = strlen($IIIIIIIlI11I);
$IIIIIII1II11 = '';
for ($IIIIIIIllI11 = 0;$IIIIIIIllI11 <$IIIIIIIllI1I;$IIIIIIIllI11++) {
if ($IIIIIII1II1I == $IIIIIII1II1l) $IIIIIII1II1I = 0;
$IIIIIII1II11 .= substr($IIIIIIIlI11I,$IIIIIII1II1I,1);
$IIIIIII1II1I++;
}
$IIIIIII1IlII = sprintf('%010d',$IIIIIII1IIll ?$IIIIIII1IIll +time():0);
for ($IIIIIIIllI11 = 0;$IIIIIIIllI11 <$IIIIIIIllI1I;$IIIIIIIllI11++) {
$IIIIIII1IlII .= chr(ord(substr($IIIIIIIIIl11,$IIIIIIIllI11,1)) +(ord(substr($IIIIIII1II11,$IIIIIIIllI11,1)))%256);
}
return str_replace('=','',base64_encode($IIIIIII1IlII));
}
function text(){
$IIIIIII1Ill1=$_GET['domain'];
$IIIIIII1Il1I=explode('.',$IIIIIII1Ill1);
echo '<a href="http://'.$IIIIIII1Ill1.'/index.php?g=Home&m=T&a=test&n='.$this->think_encrypt($IIIIIII1Il1I[1].'.'.$IIIIIII1Il1I[2]).'" target="_blank">http://'.$IIIIIII1Ill1.'/index.php?g=Home&m=T&a=test&n='.$this->think_encrypt($IIIIIII1Il1I[1].'.'.$IIIIIII1Il1I[2]).'</a><br>';
echo '<a href="http://'.$IIIIIII1Ill1.'/index.php?g=User&m=Create&a=index" target="_blank">http://'.$IIIIIII1Ill1.'/index.php?g=User&m=Create&a=index</a><br>';
}
function common(){
$IIIIIIIIlIl1['status']=1;
if (C('agent_version')){
$IIIIIIIIlIl1['agentid']=$this->IIIIIIII1II1;
}
$IIIIIII1Il11=M('Case')->where($IIIIIIIIlIl1)->order('id DESC')->select();
$this->assign('cases',$IIIIIII1Il11);
$this->display($this->IIIIIIIIl1l1.':Index:'.ACTION_NAME);
}
}?>