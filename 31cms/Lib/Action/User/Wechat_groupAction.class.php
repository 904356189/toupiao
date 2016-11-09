<?php

class Wechat_groupAction extends UserAction{
public $IIIIIIl1l1Il;
public function _initialize() {
parent::_initialize();
$IIIIIIIIlIl1=array('token'=>$this->IIIIIIIIlIlI);
$this->IIIIIIl1l1Il=M('Wxuser')->where($IIIIIIIIlIl1)->find();
if (!$this->IIIIIIl1l1Il['appid']||!$this->IIIIIIl1l1Il['appsecret']){
$this->error('请先设置AppID和AppSecret再使用本功能，谢谢','?g=User&m=Index&a=edit&id='.$this->IIIIIIl1l1Il['id']);
}
if ($this->IIIIIIl1l1Il['winxintype']!=3){
$this->error('只有微信官方认证的高级服务号才能使用本功能','?g=User&m=Index&a=edit&id='.$this->IIIIIIl1l1Il['id']);
}
}
public function index(){
$IIIIIlllll1I=1;
if (isset($_GET['p'])||isset($_POST['keyword'])){
$IIIIIlllll1I=0;
}
$this->assign('showStatistics',$IIIIIlllll1I);
$IIIIIlIlI1lI=M('Wechat_group_list');
$IIIIIIIIlIl1=array('token'=>$this->IIIIIIIIlIlI);
if (IS_POST&&strlen(trim($_POST['keyword']))){
$IIIIII11IlI1=htmlspecialchars(trim($_POST['keyword']));
$IIIIIIIIlIl1['nickname'] = array('like','%'.$IIIIII11IlI1.'%');
$IIIIIIIIlIII=$IIIIIlIlI1lI->where($IIIIIIIIlIl1)->order('id desc')->select();
}else {
if (isset($_GET['wechatgroupid'])){
$IIIIIIIIlIl1['g_id']=intval($_GET['wechatgroupid']);
}
$IIIIIIIII1ll=$IIIIIlIlI1lI->where($IIIIIIIIlIl1)->count();
$IIIIIIIII11I=new Page($IIIIIIIII1ll,10);
$IIIIIIIIlIII=$IIIIIlIlI1lI->where($IIIIIIIIlIl1)->limit($IIIIIIIII11I->firstRow.','.$IIIIIIIII11I->listRows)->order('id desc')->select();
$this->assign('page',$IIIIIIIII11I->show());
}
$IIIIIlllll1l=M('Wechat_group');
$IIIIIIlllllI=$this->_getAccessToken();
$IIIIIII1l1Il='https://api.weixin.qq.com/cgi-bin/groups/get?access_token='.$IIIIIIlllllI;
$IIIIIIl11II1=json_decode($this->curlGet($IIIIIII1l1Il));
$IIIIIlllll11=$IIIIIIl11II1->IIIIIIIl1l1I;
$IIIIIllll1II=array();
if ($IIIIIlllll11){
foreach ($IIIIIlllll11 as $IIIIIIIl11l1){
$IIIIIllll1Il=$IIIIIlllll1l->where(array('token'=>$this->IIIIIIIIlIlI,'wechatgroupid'=>$IIIIIIIl11l1->IIIIIIIII1I1))->find();
$IIIIIIIlII1l=array('token'=>$this->IIIIIIIIlIlI,'wechatgroupid'=>$IIIIIIIl11l1->IIIIIIIII1I1,'name'=>$IIIIIIIl11l1->IIIIIIIlIIII,'fanscount'=>$IIIIIIIl11l1->IIIIIIIII1ll);
if (!$IIIIIllll1Il){
$IIIIIlllll1l->add($IIIIIIIlII1l);
}else {
$IIIIIlllll1l->where(array('id'=>$IIIIIllll1Il['id']))->save($IIIIIIIlII1l);
}
array_push($IIIIIllll1II,$IIIIIIIl11l1->IIIIIIIII1I1);
}
}
$IIIIIlllll1l=M('Wechat_group');
$IIIIIIIl1l1I=$IIIIIlllll1l->where(array('token'=>$this->IIIIIIIIlIlI))->order('id ASC')->select();
$this->assign('groups',$IIIIIIIl1l1I);
$IIIIIllll1I1=array();
if ($IIIIIIIl1l1I){
foreach ($IIIIIIIl1l1I as $IIIIIIIl11l1){
$IIIIIllll1I1[$IIIIIIIl11l1['wechatgroupid']]=$IIIIIIIl11l1;
}
}
if ($IIIIIIIIlIII){
$IIIIIIIllI11=0;
foreach ($IIIIIIIIlIII as $IIIIII1Il1I1){
$IIIIII1II11l=substr($IIIIII1Il1I1['headimgurl'],0,-1);
$IIIIIIIIlIII[$IIIIIIIllI11]['smallheadimgurl']=$IIIIII1Il1I1['headimgurl'];
$IIIIIIIIlIII[$IIIIIIIllI11]['groupName']=$IIIIIllll1I1[$IIIIII1Il1I1['g_id']]['name'];
$IIIIIIIllI11++;
}
}
$this->assign('list',$IIIIIIIIlIII);
if ($IIIIIlllll1I){
$IIIIIlIlI1ll=$IIIIIlIlI1lI->where($IIIIIIIIlIl1)->count();
$IIIIIIIIlIl1['sex']=1;
$IIIIIlIlI1l1=$IIIIIlIlI1lI->where($IIIIIIIIlIl1)->count();
$IIIIIIIIlIl1['sex']=2;
$IIIIIlIlI11I=$IIIIIlIlI1lI->where($IIIIIIIIlIl1)->count();
$this->assign('fansCount',$IIIIIlIlI1ll);
$this->assign('maleCount',$IIIIIlIlI1l1);
$this->assign('femaleCount',$IIIIIlIlI11I);
$IIIIIlIlI11l=$IIIIIlIlI1ll-$IIIIIlIlI1l1-$IIIIIlIlI11I;
$this->assign('unknownSexCount',$IIIIIlIlI11l);
$IIIIIlIIll11='<chart borderThickness="0" caption="粉丝性别比例图" baseFontColor="666666" baseFont="宋体" baseFontSize="14" bgColor="FFFFFF" bgAlpha="0" showBorder="0" bgAngle="360" pieYScale="90"  pieSliceDepth="5" smartLineColor="666666"><set label="男性" value="'.$IIIIIlIlI1l1.'"/><set label="女性" value="'.$IIIIIlIlI11I.'"/><set label="未知性别" value="'.$IIIIIlIlI11l.'"/></chart>';
$this->assign('xml',$IIIIIlIIll11);
}
$this->display();
}
public function  send(){
if(IS_GET){
$IIIIIIlllllI=$this->_getAccessToken();
$IIIIIII1l1Il='https://api.weixin.qq.com/cgi-bin/user/get?access_token='.$IIIIIIlllllI;
if (isset($_GET['next_openid'])){
$IIIIIII1l1Il.='&next_openid='.$_GET['next_openid'];
}
$IIIIIllll1ll=json_decode($this->curlGet($IIIIIII1l1Il));
$IIIIIllll1l1=$IIIIIllll1ll->IIIIIIIIIl11->IIIIIIlIlIll;
$IIIIIllll11I=$IIIIIllll1ll->next_openid;
$IIIIIIll1lIl=0;
$IIIIIllll11l=0;
foreach($IIIIIllll1l1 as $IIIIIIIIIl11){
$IIIIIIl111Il=M('Wechat_group_list')->field('openid')->where(array('openid'=>$IIIIIIIIIl11))->find();
if($IIIIIIl111Il==false){
M('Wechat_group_list')->data(array('openid'=>$IIIIIIIIIl11,'token'=>$this->IIIIIIIIlIlI))->add();
$IIIIIIll1lIl++;
}else{
$IIIIIllll11l++;
}
}
if (strlen($IIIIIllll11I)){
$this->success('本次更新'.$IIIIIIll1lIl.'条,重复'.$IIIIIllll11l=$IIIIIllll11l==1?0:$IIIIIllll11l.'条，正在获取下一批粉丝数据','?g=User&m=Wechat_group&a=send&token='.$this->IIIIIIIIlIlI.'&next_openid='.$IIIIIllll11I);
}else {
$this->success('更新完成,现在获取粉丝详细信息','?g=User&m=Wechat_group&a=send_info&token='.$this->IIIIIIIIlIlI);
}
}else{
$this->error('非法操作');
}
}
public function  send_info(){return;
if(IS_GET){
$IIIIIlll1III=isset($_GET['all'])?1:0;
$IIIIIIlllllI=$this->_getAccessToken();
if ($IIIIIlll1III){
$IIIIIlIlI1ll=M('Wechat_group_list')->where(array('token'=>session('token')))->count();
$IIIIIIIllI11=intval($_GET['i']);
$IIIIIII1l1ll=20;
$IIIIIlll1IIl=M('Wechat_group_list')->where(array('token'=>session('token')))->order('id DESC')->limit($IIIIIIIllI11,$IIIIIII1l1ll)->select();
if ($IIIIIlll1IIl){
foreach($IIIIIlll1IIl as $IIIIIlll1II1){
$IIIIIIl1Il1I='https://api.weixin.qq.com/cgi-bin/user/info?openid='.$IIIIIlll1II1['openid'].'&access_token='.$IIIIIIlllllI;
$IIIIIlll1IlI=json_decode($this->curlGet($IIIIIIl1Il1I));
if ($IIIIIlll1IlI->subscribe==1){
$IIIIIIIIIl11['nickname']=str_replace("'",'',$IIIIIlll1IlI->nickname);
$IIIIIIIIIl11['sex']=$IIIIIlll1IlI->sex;
$IIIIIIIIIl11['city']=$IIIIIlll1IlI->city;
$IIIIIIIIIl11['province']=$IIIIIlll1IlI->province;
$IIIIIIIIIl11['headimgurl']=$IIIIIlll1IlI->headimgurl;
$IIIIIIIIIl11['subscribe_time']=$IIIIIlll1IlI->subscribe_time;
S($this->IIIIIIIIlIlI.'_'.$IIIIIlll1II1['openid'],null);
$IIIIIlll1Ill='https://api.weixin.qq.com/cgi-bin/groups/getid?access_token='.$IIIIIIlllllI;
$IIIIIlll1Il1=json_decode($this->curlGet($IIIIIlll1Ill,'post','{"openid":"'.$IIIIIIIIIl11['openid'].'"}'));
$IIIIIIIIIl11['g_id']=$IIIIIIl11II1->groupid;
M('wechat_group_list')->where(array('id'=>$IIIIIlll1II1['id']))->save($IIIIIIIIIl11);
S('fans_'.$this->IIIIIIIIlIlI.'_'.$IIIIIlll1II1['openid'],NULL);
}else {
M('wechat_group_list')->delete($IIIIIlll1II1['id']);
}
}
$IIIIIIIllI11=$IIIIIII1l1ll+$IIIIIIIllI11;
$this->success('更新中请勿关闭...进度：'.$IIIIIIIllI11.'/'.$IIIIIlIlI1ll,'?g=User&m=Wechat_group&a=send_info&token='.$this->IIIIIIIIlIlI.'&all=1&i='.$IIIIIIIllI11);
}else {
$this->success('更新完毕','?g=User&m=Wechat_group&a=index&token='.$this->IIIIIIIIlIlI);
exit();
}
}else {
$IIIIIlll1I1I=M('Wechat_group_list')->field('openid,id')->where(array('token'=>session('token'),'subscribe_time'=>''))->order('id desc')->limit(20)->select();
if($IIIIIlll1I1I ==false){
$this->success('更新完毕','?g=User&m=Wechat_group&a=index&token='.$this->IIIIIIIIlIlI);
exit();
}
$IIIIIIIllI11=0;
foreach($IIIIIlll1I1I as $IIIIIlll1II1){
$IIIIIIl1Il1I='https://api.weixin.qq.com/cgi-bin/user/info?openid='.$IIIIIlll1II1['openid'].'&access_token='.$IIIIIIlllllI;
$IIIIIlll1IlI=json_decode($this->curlGet($IIIIIIl1Il1I));
if ($IIIIIlll1IlI->subscribe==1){
$IIIIIIIIIl11['openid']=$IIIIIlll1IlI->IIIIIIlIlIll;
$IIIIIIIIIl11['nickname']=str_replace("'",'',$IIIIIlll1IlI->nickname);
$IIIIIIIIIl11['sex']=$IIIIIlll1IlI->sex;
$IIIIIIIIIl11['city']=$IIIIIlll1IlI->city;
$IIIIIIIIIl11['province']=$IIIIIlll1IlI->province;
$IIIIIIIIIl11['headimgurl']=$IIIIIlll1IlI->headimgurl;
$IIIIIIIIIl11['subscribe_time']=$IIIIIlll1IlI->subscribe_time;
$IIIIIIIIIl11['token']=session('token');
$IIIIIIIIIl11['id']=$IIIIIlll1II1['id'];
S($this->IIIIIIIIlIlI.'_'.$IIIIIlll1II1['openid'],null);
$IIIIIlll1Ill='https://api.weixin.qq.com/cgi-bin/groups/getid?access_token='.$IIIIIIlllllI;
$IIIIIlll1Il1=json_decode($this->curlGet($IIIIIlll1Ill,'post','{"openid":"'.$IIIIIIIIIl11['openid'].'"}'));
$IIIIIIIIIl11['g_id']=$IIIIIIl11II1->groupid;
M('wechat_group_list')->save($IIIIIIIIIl11);
$IIIIIIIllI11++;
}else {
M('wechat_group_list')->delete($IIIIIlll1II1['id']);
}
}
$IIIIIIIII1ll=M('Wechat_group_list')->field('id')->where(array('token'=>session('token'),'subscribe_time'=>''))->count();
$this->success('还有'.$IIIIIIIII1ll.'个粉丝信息没有更新,<br />请耐心等待',U('Wechat_group/send_info'));
}
}else{
$this->error('非法操作');
}
}
public function setGroup(){
if (IS_POST){
$IIIIIlll1I11=M('wechat_group_list');
$IIIIIlll1lII=intval($this->_post('wechatgroupid'));
$IIIIIIlllllI=$this->_getAccessToken();
foreach ($_POST as $IIIIIIIllIll=>$IIIIIIlIllII){
if(!(strpos($IIIIIIIllIll,'id_') === FALSE)){
$IIIIIIIII1I1=intval(str_replace('id_','',$IIIIIIIllIll));
$IIIIIlll1lIl=$IIIIIlll1I11->where(array('id'=>$IIIIIIIII1I1,'token'=>$this->IIIIIIIIlIlI))->find();
$IIIIIII1l1Il='https://api.weixin.qq.com/cgi-bin/groups/members/update?access_token='.$IIIIIIlllllI;
$IIIIIIl11II1=json_decode($this->curlGet($IIIIIII1l1Il,'post','{"openid":"'.$IIIIIlll1lIl['openid'].'","to_groupid":'.$IIIIIlll1lII.'}'));
$IIIIIlll1I11->where(array('id'=>$IIIIIIIII1I1))->save(array('g_id'=>$IIIIIlll1lII));
}
}
$this->success('设置完毕','?g=User&m=Wechat_group&a=index&token='.$this->IIIIIIIIlIlI);
}
}
function curlGet($IIIIIII1l1Il,$IIIIIIllI1l1='get',$IIIIIIIIIl11=''){
$IIIIIIllI11I = curl_init();
$IIIIIIl11I1l = "Accept-Charset: utf-8";
curl_setopt($IIIIIIllI11I,CURLOPT_URL,$IIIIIII1l1Il);
curl_setopt($IIIIIIllI11I,CURLOPT_CUSTOMREQUEST,strtoupper($IIIIIIllI1l1));
curl_setopt($IIIIIIllI11I,CURLOPT_SSL_VERIFYPEER,FALSE);
curl_setopt($IIIIIIllI11I,CURLOPT_SSL_VERIFYHOST,FALSE);
curl_setopt($IIIIIIllll11,CURLOPT_HTTPHEADER,$IIIIIIl11I1l);
curl_setopt($IIIIIIllI11I,CURLOPT_USERAGENT,'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
curl_setopt($IIIIIIllI11I,CURLOPT_FOLLOWLOCATION,1);
curl_setopt($IIIIIIllI11I,CURLOPT_AUTOREFERER,1);
curl_setopt($IIIIIIllI11I,CURLOPT_POSTFIELDS,$IIIIIIIIIl11);
curl_setopt($IIIIIIllI11I,CURLOPT_RETURNTRANSFER,true);
$IIIIIIlllII1 = curl_exec($IIIIIIllI11I);
return $IIIIIIlllII1;
}
function showExternalPic(){
$IIIIII1I11ll = array(
'gif'=>'image/gif',
'jpeg'=>'image/jpeg',
'jpg'=>'image/jpeg',
'jpe'=>'image/jpeg',
'png'=>'image/png',
);
$IIIIIlIIIll1=$this->_get('wecha_id');
$IIIIIIIIlIlI=$this->_get('token');
$IIIIIlll1llI = S($IIIIIIIIlIlI.'_'.$IIIIIlIIIll1);
if (!$IIIIIlll1llI){
$IIIIIII1l1Il=$_GET['url'];
$IIIIIlll1lll = pathinfo($IIIIIII1l1Il);
$IIIIIIIlIllI = $IIIIIlll1lll['dirname'];
$IIIIIlll1l1I = 'http://www.qq.com/';
$IIIIIIllI11I = curl_init($IIIIIII1l1Il);
curl_setopt ($IIIIIIllI11I,CURLOPT_REFERER,$IIIIIlll1l1I);
curl_setopt($IIIIIIllI11I,CURLOPT_RETURNTRANSFER,true);
curl_setopt($IIIIIIllI11I,CURLOPT_RETURNTRANSFER,1);
curl_setopt($IIIIIIllI11I,CURLOPT_BINARYTRANSFER,1);
$IIIIIIIIIl11 = curl_exec($IIIIIIllI11I);
curl_close($IIIIIIllI11I);
$IIIIIlll1l1l = strtolower(substr(strrchr($IIIIIII1l1Il,'.'),1,10));
$IIIIIlll1l1l='jpg';
$IIIIIIlIllIl = $IIIIII1I11ll[$IIIIIlll1l1l] ?$IIIIII1I11ll[$IIIIIlll1l1l] : 'image/jpeg';
S($IIIIIIIIlIlI.'_'.$IIIIIlIIIll1,$IIIIIIIIIl11);
header("Content-type: ".$IIIIIIlIllIl);
echo  $IIIIIIIIIl11;
}else {
$IIIIIlll1l1l='jpg';
$IIIIIIlIllIl = $IIIIII1I11ll[$IIIIIlll1l1l] ?$IIIIII1I11ll[$IIIIIlll1l1l] : 'image/jpeg';
header("Content-type: ".$IIIIIIlIllIl);
echo  $IIIIIlll1llI;
}
}
function groups(){
$IIIIIlllll1l=M('Wechat_group');
$IIIIIIIl1l1I=$IIIIIlllll1l->where(array('token'=>$this->IIIIIIIIlIlI))->order('id ASC')->select();
$this->assign('groups',$IIIIIIIl1l1I);
$this->display();
}
function sysGroups(){
$IIIIIlllll1l=M('Wechat_group');
$IIIIIIlllllI=$this->_getAccessToken();
$IIIIIII1l1Il='https://api.weixin.qq.com/cgi-bin/groups/get?access_token='.$IIIIIIlllllI;
$IIIIIIl11II1=json_decode($this->curlGet($IIIIIII1l1Il));
$IIIIIlllll11=$IIIIIIl11II1->IIIIIIIl1l1I;
$IIIIIllll1II=array();
if ($IIIIIlllll11){
foreach ($IIIIIlllll11 as $IIIIIIIl11l1){
$IIIIIllll1Il=$IIIIIlllll1l->where(array('token'=>$this->IIIIIIIIlIlI,'wechatgroupid'=>$IIIIIIIl11l1->IIIIIIIII1I1))->find();
$IIIIIIIlII1l=array('token'=>$this->IIIIIIIIlIlI,'wechatgroupid'=>$IIIIIIIl11l1->IIIIIIIII1I1,'name'=>$IIIIIIIl11l1->IIIIIIIlIIII,'fanscount'=>$IIIIIIIl11l1->IIIIIIIII1ll);
if (!$IIIIIllll1Il){
$IIIIIlllll1l->add($IIIIIIIlII1l);
}else {
$IIIIIlllll1l->where(array('id'=>$IIIIIllll1Il['id']))->save($IIIIIIIlII1l);
}
array_push($IIIIIllll1II,$IIIIIIIl11l1->IIIIIIIII1I1);
}
}
$IIIIIIIl1l1I=$IIIIIlllll1l->where(array('token'=>$this->IIIIIIIIlIlI))->order('id ASC')->select();
if ($IIIIIIIl1l1I){
foreach ($IIIIIIIl1l1I as $IIIIIIIl11l1){
if (!in_array($IIIIIIIl11l1['wechatgroupid'],$IIIIIllll1II)){
$IIIIIlllll1l->where(array('id'=>$IIIIIIIl11l1['id']))->delete();
}
}
}
$this->success('操作成功',U('Wechat_group/groups'));
}
function groupSet(){
$IIIIIlllll1l=M('Wechat_group');
$IIIIIlll11lI=$IIIIIlllll1l->where(array('id'=>intval($_GET['id'])))->find();
if ($IIIIIlll11lI&&$IIIIIlll11lI['token']!=$this->IIIIIIIIlIlI){
$this->error('非法操作');
}
if (IS_POST){
$IIIIIIIlII1l=array();
$IIIIIIIlII1l['name']=$this->_post('name');
$IIIIIIIlII1l['intro']=$this->_post('intro');
$IIIIIIIlII1l['token']=$this->IIIIIIIIlIlI;
$IIIIIIlllllI=$this->_getAccessToken();
if (isset($_POST['id'])){
$IIIIIII1l1Il='https://api.weixin.qq.com/cgi-bin/groups/update?access_token='.$IIIIIIlllllI;
$IIIIIIl11II1=json_decode($this->curlGet($IIIIIII1l1Il,'post','{"group":{"id":'.$IIIIIlll11lI['wechatgroupid'].',"name":"'.$IIIIIIIlII1l['name'].'"}}'));
$IIIIIlllll1l->where(array('id'=>intval($_POST['id'])))->save($IIIIIIIlII1l);
}else {
$IIIIIII1l1Il='https://api.weixin.qq.com/cgi-bin/groups/create?access_token='.$IIIIIIlllllI;
$IIIIIIl11II1=json_decode($this->curlGet($IIIIIII1l1Il,'post','{"group":{"name":"'.$IIIIIIIlII1l['name'].'"}}'));
$IIIIIIIlII1l['wechatgroupid']=$IIIIIIl11II1->IIIIIIl11l11->IIIIIIIII1I1;
$IIIIIlllll1l->add($IIIIIIIlII1l);
}
$this->success('操作成功',U('Wechat_group/groups'));
}else {
$this->assign('thisGroup',$IIIIIlll11lI);
$this->display();
}
}
function groupDelete(){
}
function _getAccessToken(){
$IIIIIIl11IIl='https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$this->IIIIIIl1l1Il['appid'].'&secret='.$this->IIIIIIl1l1Il['appsecret'];
$IIIIIIl11II1=json_decode($this->curlGet($IIIIIIl11IIl));
if (!$IIIIIIl11II1->IIIIIIl11Il1){
}else {
$this->error('获取access_token发生错误：错误代码'.$IIIIIIl11II1->errcode.',微信返回错误信息：'.$IIIIIIl11II1->IIIIIIl11Il1);
}
return $IIIIIIl11II1->IIIIIIlllllI;
}
}
?>