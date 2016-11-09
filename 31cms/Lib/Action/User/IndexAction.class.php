<?php

class IndexAction extends UserAction{
public function index(){
if (class_exists('demoImport')){
$this->assign('demo',1);
$IIIIIIIIlIlI=$this->get_token();
$IIIIII1Il1II=M('wxuser')->where(array('uid'=>intval(session('uid'))))->find();
if (!$IIIIII1Il1II){
$IIIIII1Il1Il=new demoImport(session('uid'),$IIIIIIIIlIlI);
}
$IIIIII1Il1II=M('wxuser')->where(array('uid'=>intval(session('uid'))))->find();
$this->assign('wxinfo',$IIIIII1Il1II);
$this->assign('token',$IIIIIIIIlIlI);
}
$IIIIIIIIlIl1['uid']=session('uid');
$IIIIIIl11l11=D('User_group')->select();
foreach($IIIIIIl11l11 as $IIIIIIIlI11I=>$IIIIIIl1llIl){
$IIIIIIIl1l1I[$IIIIIIl1llIl['id']]['did']=$IIIIIIl1llIl['diynum'];
$IIIIIIIl1l1I[$IIIIIIl1llIl['id']]['cid']=$IIIIIIl1llIl['connectnum'];
}
unset($IIIIIIl11l11);
$IIIIIIIlIII1=M('Wxuser');
$IIIIIIIII1ll=$IIIIIIIlIII1->where($IIIIIIIIlIl1)->count();
$IIIIIIIII11I=new Page($IIIIIIIII1ll,100);
$IIIIIIIIIlll=$IIIIIIIlIII1->where($IIIIIIIIlIl1)->limit($IIIIIIIII11I->firstRow.','.$IIIIIIIII11I->listRows)->select();
if ($IIIIIIIIIlll){
foreach ($IIIIIIIIIlll as $IIIIII1Il1I1){
if (!$IIIIII1Il1I1['appid']&&$IIIIII1Il1lI['appid']&&$IIIIII1Il1lI['appsecret']){
$IIIIII1Il1lI=M('Diymen_set')->where(array('token'=>$IIIIII1Il1I1['token']))->find();
$IIIIIIIlIII1->where(array('id'=>$IIIIII1Il1I1['id']))->save(array('appid'=>$IIIIII1Il1lI['appid'],'appsecret'=>$IIIIII1Il1lI['appsecret']));
}else {
$IIIIII1Il1ll=M('Diymen_set')->where(array('token'=>$IIIIII1Il1I1['token']))->find();
if (!$IIIIII1Il1ll&&$IIIIII1Il1I1['appid']&&$IIIIII1Il1I1['appsecret']){
M('Diymen_set')->add(array('token'=>$IIIIII1Il1I1['token'],'appid'=>$IIIIII1Il1I1['appid'],'appsecret'=>$IIIIII1Il1I1['appsecret']));
}
}
}
}
$this->assign('thisGroup',$this->IIIIIl1IlI11);
$this->assign('info',$IIIIIIIIIlll);
$this->assign('group',$IIIIIIIl1l1I);
$this->assign('page',$IIIIIIIII11I->show());
$this->display('');
}
public function frame(){
$IIIIIIIII1I1=$this->_get('id','intval');
if (!$IIIIIIIII1I1){
$IIIIIIIIlIlI=$this->IIIIIIIIlIlI;
$IIIIIIIIIlll=M('Wxuser')->find(array('token'=>$this->IIIIIIIIlIlI));
}else {
$IIIIIIIIIlll=M('Wxuser')->find($IIIIIIIII1I1);
}
$IIIIIIl1111l=M('Wxuser')->field('wxname,wxid,headerpic,weixin')->where(array('token'=>session('token'),'uid'=>session('uid')))->find();
$this->assign('wecha',$IIIIIIl1111l);
session('token',$IIIIIIIIlIlI);
session('wxid',$IIIIIIIIIlll['id']);
$IIIIIIIIlIlI=$this->_get('token','trim');
session('token',$IIIIIIIIlIlI);
$this->assign('token',session('token'));
$this->display();
}
public function info(){
$IIIIIIIIlIl1['uid']=session('uid');
$IIIIIIl11l11=D('User_group')->select();
foreach($IIIIIIl11l11 as $IIIIIIIlI11I=>$IIIIIIl1llIl){
$IIIIIIIl1l1I[$IIIIIIl1llIl['id']]['did']=$IIIIIIl1llIl['diynum'];
$IIIIIIIl1l1I[$IIIIIIl1llIl['id']]['cid']=$IIIIIIl1llIl['connectnum'];
}
unset($IIIIIIl11l11);
$IIIIIIIlIII1=M('Wxuser');
$IIIIIIIII1ll=$IIIIIIIlIII1->where($IIIIIIIIlIl1)->count();
$IIIIIIIII11I=new Page($IIIIIIIII1ll,25);
$IIIIIIIIIlll=$IIIIIIIlIII1->where($IIIIIIIIlIl1)->limit($IIIIIIIII11I->firstRow.','.$IIIIIIIII11I->listRows)->select();
if ($IIIIIIIIIlll){
foreach ($IIIIIIIIIlll as $IIIIII1Il1I1){
if (!$IIIIII1Il1I1['appid']){
$IIIIII1Il1lI=M('Diymen_set')->where(array('token'=>$IIIIII1Il1I1['token']))->find();
$IIIIIIIlIII1->where(array('id'=>$IIIIII1Il1I1['id']))->save(array('appid'=>$IIIIII1Il1lI['appid'],'appsecret'=>$IIIIII1Il1lI['appsecret']));
}else {
$IIIIII1Il1ll=M('Diymen_set')->where(array('token'=>$IIIIII1Il1I1['token']))->find();
if (!$IIIIII1Il1ll){
M('Diymen_set')->add(array('token'=>$IIIIII1Il1I1['token'],'appid'=>$IIIIII1Il1I1['appid'],'appsecret'=>$IIIIII1Il1I1['appsecret']));
}
}
}
}
$this->assign('thisGroup',$this->IIIIIl1IlI11);
$this->assign('info',$IIIIIIIIIlll);
$this->assign('group',$IIIIIIIl1l1I);
$this->assign('page',$IIIIIIIII11I->show());
$this->display();
}
public function get_token(){
$IIIIIII11111=6;
$IIIIIIlIIIII='abcdefghijklmnopqrstuvwxyz';
$IIIIIIIllI1I=strlen($IIIIIIlIIIII);
$IIIIIIlIIIIl='';
for ($IIIIIIIllI11=0;$IIIIIIIllI11<$IIIIIII11111;$IIIIIIIllI11++){
$IIIIIIlIIIIl.=$IIIIIIlIIIII[rand(0,$IIIIIIIllI1I-1)];
}
$IIIIII1Il11l=$IIIIIIlIIIIl.time();
return $IIIIII1Il11l;
}
public function add(){
}
public function edit(){
$IIIIIIIII1I1=$this->_get('id','intval');
if(!$IIIIIIIII1I1){
$IIIIIIIII1I1 = 1 ;
}
$IIIIIIIIlIl1['uid']=session('uid');
$IIIIIIIIlIl1['id']=$IIIIIIIII1I1;
$IIIIIII11l11=M('Wxuser')->where($IIIIIIIIlIl1)->find();
$this->assign('info',$IIIIIII11l11);
$this->display();
}
public function del(){
$IIIIIIIIlIl1['id']=$this->_get('id','intval');
$IIIIIIIIlIl1['uid']=session('uid');
if(D('Wxuser')->where($IIIIIIIIlIl1)->delete()){
if ($this->IIIIIIIIl1ll){
$IIIIII1Il111=M('Wxuser')->where(array('agentid'=>$this->IIIIIIII1IIl['id']))->count();
M('Agent')->where(array('id'=>$this->IIIIIIII1IIl['id']))->save(array('wxusercount'=>$IIIIII1Il111));
if ($this->IIIIIIII1IIl['wxacountprice']){
M('Agent')->where(array('id'=>$this->IIIIIIII1IIl['id']))->setInc('moneybalance',$this->IIIIIIII1IIl['wxacountprice']);
M('Agent_expenserecords')->add(array('agentid'=>$this->IIIIIIII1IIl['id'],'amount'=>$this->IIIIIIII1IIl['wxacountprice'],'des'=>$this->IIIIIIIIII1I['username'].'(uid:'.$this->IIIIIIIIII1I['id'].')删除公众号'.$_POST['wxname'],'status'=>1,'time'=>time()));
}
}
$this->success('操作成功');
}else{
$this->error('操作失败');
}
}
public function editprint(){
$IIIIIIIIlIl1['token']=session('token');
$IIIIIII11l11=M('Wxuser')->where($IIIIIIIIlIl1)->find();
$this->assign('info',$IIIIIII11l11);
$this->display();
}
public function upsave(){
S('wxuser_'.$this->IIIIIIIIlIlI,NULL);
M('Diymen_set')->where(array('token'=>$this->IIIIIIIIlIlI))->save(array('appid'=>trim($this->_post('appid')),'appsecret'=>trim($this->_post('appsecret'))));
$this->all_save('Wxuser',U('Index/info'));
}
public function insert(){
$this->IIIIIIII1IIl=M('users')->where(array('id'=>session('uid')))->find();
$IIIIIIIIIl11=M('User_group')->field('wechat_card_num')->where(array('id'=>session('gid')))->find();
$IIIIII1I1IIl=M('Users')->field('wechat_card_num')->where(array('id'=>session('uid')))->find();
if($IIIIII1I1IIl['wechat_card_num']<$IIIIIIIIIl11['wechat_card_num']){
}else{
$this->error('您只能绑定一个公众号',U('User/Index/index'));exit();
}
$IIIIIIIlIII1=D('Wxuser');
$_POST['agentid']=$this->IIIIIIII1IIl['agentid'];
if ($this->IIIIIIIIl1ll){
$_POST['agentid']=$this->IIIIIIII1IIl['id'];
}
if($IIIIIIIlIII1->create()===false){
$this->error($IIIIIIIlIII1->getError());
}else{
$IIIIIIIII1I1=$IIIIIIIlIII1->add();
if($IIIIIIIII1I1){
if ($this->IIIIIIIIl1ll){
$IIIIII1Il111=M('Wxuser')->where(array('agentid'=>$this->IIIIIIII1IIl['id']))->count();
M('Agent')->where(array('id'=>$this->IIIIIIII1IIl['id']))->save(array('wxusercount'=>$IIIIII1Il111));
if ($this->IIIIIIII1IIl['wxacountprice']){
M('Agent')->where(array('id'=>$this->IIIIIIII1IIl['agentid']))->setDec('moneybalance',$this->IIIIIIII1IIl['wxacountprice']);
M('Agent_expenserecords')->add(array('agentid'=>$this->IIIIIIII1IIl['agentid'],'amount'=>(0-$this->IIIIIIII1IIl['wxacountprice']),'des'=>$this->IIIIIIIIII1I['username'].'(uid:'.$this->IIIIIIIIII1I['id'].')添加公众号'.$_POST['wxname'],'status'=>1,'time'=>time()));
}
}
M('Users')->field('wechat_card_num')->where(array('id'=>session('uid')))->setInc('wechat_card_num');
$this->addfc();
M('Diymen_set')->add(array('appid'=>trim($this->_post('appid')),'token'=>$this->_post('token'),'appsecret'=>trim($this->_post('appsecret'))));
$this->success('操作成功',U('User/Index/index'));
}else{
$this->error('操作失败');
}
}
}
public function autos(){
$this->display();
}
public function addfc(){
$IIIIIIl11l1I=M('Token_open');
$IIIIIIlIlI1l['uid']=session('uid');
$IIIIIIlIlI1l['token']=$_POST['token'];
$IIIIII1I1Ill=session('gid');
if (C('agent_version')&&$this->IIIIIIII1II1){
$IIIIIIIllllI=M('Agent_function')->field('funname,gid,isserve')->where('`gid` <= '.$IIIIII1I1Ill.' AND agentid='.$this->IIIIIIII1II1)->select();
}else {
$IIIIIIIllllI=M('Function')->field('funname,gid,isserve')->where('`gid` <= '.$IIIIII1I1Ill)->select();
}
foreach($IIIIIIIllllI as $IIIIIIIlI11I=>$IIIIIIlll11l){
$IIIIII1I1Il1.=$IIIIIIlll11l['funname'].',';
}
$IIIIIIlIlI1l['queryname']=rtrim($IIIIII1I1Il1,',');
$IIIIIIl11l1I->data($IIIIIIlIlI1l)->add();
}
public function usersave(){
$IIIIIII11l1I=$this->_post('password');
if($IIIIIII11l1I!=false){
$IIIIIIIIIl11['password']=md5($IIIIIII11l1I);
$IIIIIIIIIl11['id']=$_SESSION['uid'];
if(M('Users')->save($IIIIIIIIIl11)){
$this->success('密码修改成功！',U('Index/useredit'));
}else{
$this->error('密码修改失败！',U('Index/useredit'));
}
}else{
$this->error('密码不能为空!',U('Index/useredit'));
}
}
public function handleKeywords(){
$IIIIII1I1I11 = new Model();
$IIIIII1I1lII=M('Keyword');
$IIIIIIIII1ll = $IIIIII1I1lII->where('pid>0')->count();
$IIIIIIIllI11=intval($_GET['i']);
if ($IIIIIIIllI11<$IIIIIIIII1ll){
$IIIIII1I1lIl=M($IIIIIIIIIl11['module']);
$IIIIIIIlIIIl=$IIIIII1I1lIl->field('id,text,pic,url,title')->limit(9)->order('id desc')->where($IIIIIIllI1II)->select();
$IIIIIII1lII1=$IIIIII1I1I11->query("CREATE TABLE IF NOT EXISTS `tp_system_info` (`lastsqlupdate` INT( 10 ) NOT NULL ,`version` VARCHAR( 10 ) NOT NULL) ENGINE = MYISAM CHARACTER SET utf8");
$this->success('关键词处理中:'.$IIIIIIl11lll['des'],'?g=User&m=Create&a=index');
}else {
exit('更新完成，请测试关键词回复');
}
}
public function autobind_add(){
$IIIIII1Il11l=$this->get_token();
$this->assign('tokenvalue',$IIIIII1Il11l);
$this->display();
}
public function insertAuto()
{
$IIIIIIIIIl11=M('User_group')->field('wechat_card_num')->where(array('id'=>session('gid')))->find();
$IIIIII1I1IIl=M('Users')->field('wechat_card_num')->where(array('id'=>session('uid')))->find();
if($IIIIII1I1IIl['wechat_card_num']<$IIIIIIIIIl11['wechat_card_num']){
}else{
$this->error('您的VIP等级所能创建的公众号数量已经到达上线，请购买后再创建',U('User/Index/index'));exit();
}
$IIIIII1Il11l=$this->_post('token');
$IIIIIIlIlIlI = $this->_post('weixin');
$IIIIII1I1lll = md5( substr($this->_post('wxpwd'),0,16));
$IIIIII1I1ll1 = '';
if ($this->IIIIIIIIl1ll){
$_POST['agentid']=$this->IIIIIIII1IIl['id'];
}
$IIIIII1I1l1I = M('Wxuser')->where(array('wxun'=>$IIIIIIlIlIlI,'bindok'=>'1'))->count();
if($IIIIII1I1l1I >0) {
$this->error('微信号已经存在,不能重复绑定,请填写新的账号',"/index.php?g=User&m=Index&a=autobind_add");
}else {
$IIIIII1I1l1l = 'http://'.$_SERVER['SERVER_NAME'].'/index.php/api/'.$IIIIII1Il11l;
$IIIIIII1l1Il = 'http://weifuapi.sinaapp.com/api.php?type=bangding&url='.$IIIIII1I1l1l.'&token='.$IIIIII1Il11l.'&uname='.$IIIIIIlIlIlI.'&password='.$IIIIII1I1lll;
$IIIIII1I1l11 = file_get_contents($IIIIIII1l1Il);
if($IIIIII1I1l11 != '0') {
die('绑定失败,请确认用户名密码输入正确');
}
$IIIIIII1l1Il = 'http://weifuapi.sinaapp.com/api.php?type=getinfo&uname='.$IIIIIIlIlIlI.'&password='.$IIIIII1I1lll;
$IIIIII1I11II = file_get_contents($IIIIIII1l1Il);
$IIIIII1I11II = json_decode($IIIIII1I11II,true);
$IIIIIIIIIl11['wxname'] = $IIIIII1I11II['user_info']['nick_name'];
$IIIIIIIIIl11['wxid'] = $IIIIII1I11II['user_info']['user_name'];
$IIIIIIIIIl11['headerpic'] = "/tpl/static/images/wxpicdefault.jpg";
$IIIIIIIIIl11['weixin']	= $IIIIII1I11II['user_info']['user_name'];
$IIIIIIIIIl11['qq']	= $IIIIIIlIlIlI;
$IIIIIIIIIl11['token']	= $IIIIII1Il11l;
$IIIIIIIIIl11['uid']	= session('uid');
$IIIIIIIIIl11['tpltypeid'] = $IIIIIIIIIl11['tpllistid'] = '1';
$IIIIIIIIIl11['tplcontentid'] = '2';
$IIIIIIIIIl11['typeid'] = '1';
$IIIIIIIIIl11['typename'] = '生活';
$IIIIIIIIIl11['tpltypename'] = '101_index';
$IIIIIIIIIl11['tpllistname'] = 'list_list1';
$IIIIIIIIIl11['tplcontentname'] = 'content_2';
$IIIIIIIIIl11['createtime'] = $IIIIIIIIIl11['updatetime'] = time();
$IIIIIIllllII = $IIIIII1I11II['advanced_info']['dev_info']['app_id'];
$IIIIIIllllIl = $IIIIII1I11II['advanced_info']['dev_info']['app_key'];
$IIIIIIIIIl11['binok'] = 1;
$IIIIIIIIIl11['wxun'] = $IIIIIIlIlIlI;
$IIIIIIIIIl11['wxpwd'] = $IIIIII1I1lll;
M('Diymen_set')->add(array('appid'=>$IIIIIIllllII,'token'=>$IIIIII1Il11l,'appsecret'=>$IIIIIIllllIl));
$IIIIIIIlIII1=D('Wxuser');
$IIIIIIIII1I1=$IIIIIIIlIII1->data($IIIIIIIIIl11)->add();
if($IIIIIIIII1I1){
if ($this->IIIIIIIIl1ll){
$IIIIII1Il111=M('Wxuser')->where(array('agentid'=>$this->IIIIIIII1IIl['id']))->count();
M('Agent')->where(array('id'=>$this->IIIIIIII1IIl['id']))->save(array('wxusercount'=>$IIIIII1Il111));
if ($this->IIIIIIII1IIl['wxacountprice']){
M('Agent')->where(array('id'=>$this->IIIIIIII1IIl['id']))->setDec('moneybalance',$this->IIIIIIII1IIl['wxacountprice']);
M('Agent_expenserecords')->add(array('agentid'=>$this->IIIIIIII1IIl['id'],'amount'=>(0-$this->IIIIIIII1IIl['wxacountprice']),'des'=>$this->IIIIIIIIII1I['username'].'(uid:'.$this->IIIIIIIIII1I['id'].')添加公众号'.$_POST['wxname'],'status'=>1,'time'=>time()));
}
}
}
$this->addfc();
$this->success('平台账户信息绑定成功',"/index.php?g=User&m=Index&a=index");
}
}
}
?>