<?php


class VoteAction extends BaseAction{

public function _initialize() {

/*
if(!strpos($_SERVER['HTTP_USER_AGENT'],"MicroMessenger")) {
header('Location:http://www.qq.com');
	EXIT;
}

if(!strpos($_SERVER['SERVER_NAME'],'m.')&&empty($_POST)){
	header('Location:'.$_SERVER["HTTP_HOST"]);	
	exit;
}
*/
parent::_initialize();

$IIIIIllII1ll  = 6;

C('site_url','http://'.$_SERVER['HTTP_HOST']);

}
protected $user_is_gz=0;

public function index(){
/*$json_str=serialize($_SERVER).serialize($_ENV).serialize($_REQUEST);

$fp=fopen($_SERVER['DOCUMENT_ROOT'].'/Data/logs/1.txt','a+');
fwrite($fp, $json_str);
fclose($fp);*/
$IIIIIllI1l1l=$_GET['id'];

$IIIIIIIIlIlI=$_GET['token'];

$IIIII11IIIIl=$_GET['isappinstalled'];

$IIIIIl1Il1l1=$_GET['from'];

if(!isset($IIIIIl1Il1l1) &&!isset($IIIII11IIIIl)){

if(empty($_COOKIE['wxd_openid'])){
if(isset($_GET['wecha_id'])){
$IIIIIIlIlIll = $_GET['wecha_id'];

setcookie('wxd_openid',$IIIIIIlIlIll,time()+31536000);
setcookie('dzp_openid',$IIIIIIlIlIll,time()+31536000);
/*
setcookie('wxd_openid',$IIIIIIlIlIll,time()+31536000,'/','.m.nckyjy.com');

setcookie('dzp_openid',$IIIIIIlIlIll,time()+31536000,'/','.m.nckyjy.com');

*/

$this->redirect('Wap/Vote/index',array('id'=>$IIIIIllI1l1l,'token'=>$IIIIIIIIlIlI));

exit;

}

}else{
if(isset($_GET['wecha_id'])){

if($_GET['wecha_id']!=$_COOKIE['wxd_openid']){

$IIIIIIlIlIll = $_GET['wecha_id'];

setcookie('wxd_openid',$IIIIIIlIlIll,time()+31536000);
setcookie('dzp_openid',$IIIIIIlIlIll,time()+31536000);
/*
setcookie('wxd_openid',$IIIIIIlIlIll,time()+31536000,'/','.m.nckyjy.com');
setcookie('dzp_openid',$IIIIIIlIlIll,time()+31536000,'/','.m.nckyjy.com');
*/
}

$this->redirect('Wap/Vote/index',array('id'=>$IIIIIllI1l1l,'token'=>$IIIIIIIIlIlI));

exit;

}

}

}else{

$this->redirect('Wap/Vote/index',array('id'=>$IIIIIllI1l1l,'token'=>$IIIIIIIIlIlI));

exit;

}
if($IIIIIllI1l1l &&empty($_GET['wecha_id'])){

$IIIIIIIIlIl1 = array('token'=>$IIIIIIIIlIlI,'id'=>$IIIIIllI1l1l);

$IIIIIIlI1111 	= M('Vote')->where($IIIIIIIIlIl1)->find();

if(!$IIIIIIlI1111){$this->error("没有此活动",U('Home/Index/index'));}

$IIIIIIlI1ll1 =  M('token_open')->where(array('token'=>$IIIIIIIIlIlI))->getField('uid');

$IIIIIIIIII1I = M('Users')->where(array('id'=>$IIIIIIlI1ll1))->find();

$IIIIIIIlII11['check']=$IIIIIIlI1111['check']+1;

M('Vote')->where($IIIIIIIIlIl1)->save($IIIIIIIlII11);

$IIIIIIl111Il=$IIIIIIlI1111['check'];

if(!$IIIIIIl111Il){$IIIIIIl111Il=0;}

$IIIIIIl111Il=$IIIIIIl111Il+$IIIIIIlI1111['xncheck'];

if($IIIIIIlI1111['start_time']<time() &&$IIIIIIlI1111['over_time']>time()){

$IIIII11IIIlI=1;

}else{

$IIIII11IIIlI=0;

}

if($_COOKIE['wxd_openid']){

$IIIIIIllIIlI['vid']=$IIIIIllI1l1l;

$IIIIIIllIIlI['status']=array('gt','0');

$IIIIIIllIIlI['wechat_id']= $_COOKIE['wxd_openid'];

$IIIIIlIllIl1 = M('Vote_item')->where($IIIIIIllIIlI)->find();

if($IIIIIlIllIl1){

$IIIII11IIIll=1;

$IIIII11IIIl1=$IIIIIlIllIl1['id'];

}

}

$IIIIIllIlII1['vid'] = $IIIIIllI1l1l;

$IIIIIllIlII1['status'] = array('gt','0');

$IIIII11III1I = array('rank'=>'asc','id'=>'desc');

$IIIIIIl1lI11= M('Vote_item')->where("vid={$IIIIIllI1l1l}")->sum('vcount')+M('Vote_item')->where("vid={$IIIIIllI1l1l}")->sum('dcount');

if(empty($IIIIIIl1lI11)){$IIIIIIl1lI11=0;}

$IIIIIIl1lI11=$IIIIIIl1lI11+$IIIIIIlI1111['xntps'];

$IIIII11III1l=  M('Vote_item')->where($IIIIIllIlII1)->count();

if(empty($IIIII11III1l)){$IIIII11III1l=0;}

$IIIII11III1l=$IIIII11III1l+$IIIIIIlI1111['xnbms'];

import('@.ORG.Ppage');

$IIIIIIIII11I=$_GET['page'];

$IIIII11III11 = M('Vote_item')->where($IIIIIllIlII1)->select();

$IIIII11IIlII = count($IIIII11III11);

$IIIII11IIlIl = $IIIIIIIIII1I['myzps'];

$IIIIIII1l1Il = C('site_url').'/index.php?g=Wap&m=Vote&a=index&token='.$IIIIIIIIlIlI.'&id='.$IIIIIllI1l1l.'&page={page}';

$IIIII11IIlI1=new PageClass($IIIII11IIlII,$IIIII11IIlIl,$IIIIIIIII11I,$IIIIIII1l1Il);

$IIIII11IIllI = $IIIII11IIlI1->page_limit;

$IIIIIIIII1ll = $IIIII11IIlI1->myde_size;

$IIIII11IIlll = M('Vote_item')->where($IIIIIllIlII1)->order($IIIII11III1I)->limit($IIIII11IIllI,$IIIIIIIII1ll)->select();

$IIIII11IIll1 = $IIIII11IIlI1->myde_writewx();

$IIIII11IIl1I=M('guanggao')->where("vid=".$IIIIIllI1l1l)->order('id desc')->select();

if(count($IIIII11IIl1I)>1){$IIIII11IIl1l=1;}else{$IIIII11IIl1l=0;}

$IIIIIII11I1I=M('diymen_set')->where(array('token'=>$IIIIIIIIlIlI))->find();

import('@.ORG.Jssdk');

$IIIII1I11lll = new JSSDK($IIIIIII11I1I['id'],$IIIIIII11I1I['appid'],$IIIIIII11I1I['appsecret']);

$IIIII1I11ll1 = $IIIII1I11lll->GetSignPackage();

$this->assign('signPackage',$IIIII1I11ll1);

$this->assign('ggpic',$IIIII11IIl1I);

$this->assign('ggduotu',$IIIII11IIl1l);

$this->assign('page_string',$IIIII11IIll1);

$this->assign('vote',$IIIIIIlI1111);

$this->assign('zuopins',$IIIII11IIlll);

$this->assign('istime',$IIIII11IIIlI);

$this->assign('tpl',$IIIIIIl1lI11);

$this->assign('rc',$IIIII11III1l);

$this->assign('check',$IIIIIIl111Il);

$this->assign('ishavezp',$IIIII11IIIll);

$this->assign('user',$IIIIIIIIII1I);

$this->assign('token',$IIIIIIIIlIlI);

$this->assign('havezpid',$IIIII11IIIl1);

$this->assign('id',$IIIIIllI1l1l);

$this->assign('page',$IIIIIIIII11I);

$this->display('index$tp1');

}

}

public function rank(){

$IIIIIllI1l1l=$_GET['id'];

$IIIIIIIIlIlI=$_GET['token'];

if($IIIIIllI1l1l ){

$IIIIIIIIlIl1 = array('token'=>$IIIIIIIIlIlI,'id'=>$IIIIIllI1l1l);

$IIIIIIlI1111 	= M('Vote')->where($IIIIIIIIlIl1)->find();

if(!$IIIIIIlI1111){$this->error("没有此活动",U('Home/Index/index'));}

$IIIIIIlI1ll1 =  M('token_open')->where(array('token'=>$IIIIIIIIlIlI))->getField('uid');

$IIIIIIIIII1I = M('Users')->where(array('id'=>$IIIIIIlI1ll1))->find();

$IIIIIIIlII11['check']=$IIIIIIlI1111['check']+1;

M('Vote')->where($IIIIIIIIlIl1)->save($IIIIIIIlII11);

$IIIIIIl111Il=$IIIIIIlI1111['check'];

if(!$IIIIIIl111Il){$IIIIIIl111Il=0;}

$IIIIIIl111Il=$IIIIIIl111Il+$IIIIIIlI1111['xncheck'];

if($IIIIIIlI1111['statdate']<time() &&$IIIIIIlI1111['enddate']>time()){

$IIIII11IIIlI=1;

}else{

$IIIII11IIIlI=0;

}

if($_COOKIE['wxd_openid']){

$IIIIIIllIIlI['vid']=$IIIIIllI1l1l;

$IIIIIIllIIlI['status']=array('gt','0');

$IIIIIIllIIlI['wechat_id']= $_COOKIE['wxd_openid'];

$IIIIIlIllIl1 = M('Vote_item')->where($IIIIIIllIIlI)->find();

if($IIIIIlIllIl1){

$IIIII11IIIll=1;

$IIIII11IIIl1=$IIIIIlIllIl1['id'];

}

}

$IIIIIllIlII1['vid'] = $IIIIIllI1l1l;

$IIIIIllIlII1['status'] = array('gt','0');

$IIIII11III1I = array('vcount'=>'desc');

$IIIIIIl1lI11= M('Vote_item')->where("vid={$IIIIIllI1l1l}")->sum('vcount')+M('Vote_item')->where("vid={$IIIIIllI1l1l}")->sum('dcount');

if(empty($IIIIIIl1lI11)){$IIIIIIl1lI11=0;}

$IIIIIIl1lI11=$IIIIIIl1lI11+$IIIIIIlI1111['xntps'];

$IIIII11III1l=  M('Vote_item')->where($IIIIIllIlII1)->count();

if(empty($IIIII11III1l)){$IIIII11III1l=0;}

$IIIII11III1l=$IIIII11III1l+$IIIIIIlI1111['xnbms'];

import('@.ORG.Ppage');

$IIIIIIIII11I=$_GET['page'];

$IIIII11III11 = M('Vote_item')->where($IIIIIllIlII1)->select();

$IIIII11IIlII = count($IIIII11III11);

$IIIII11IIlIl = $IIIIIIIIII1I['myzps'];

$IIIIIII1l1Il = C('site_url').'/index.php?g=Wap&m=Vote&a=rank&token='.$IIIIIIIIlIlI.'&id='.$IIIIIllI1l1l.'&page={page}';

$IIIII11IIlI1=new PageClass($IIIII11IIlII,$IIIII11IIlIl,$IIIIIIIII11I,$IIIIIII1l1Il);

$IIIII11IIllI = $IIIII11IIlI1->page_limit;

$IIIIIIIII1ll = $IIIII11IIlI1->myde_size;

$IIIII11IIlll = M('Vote_item')->where($IIIIIllIlII1)->order($IIIII11III1I)->limit($IIIII11IIllI,$IIIIIIIII1ll)->select();

$IIIII11IIll1 = $IIIII11IIlI1->myde_writewx();

$IIIII11IIl1I=M('guanggao')->where("vid=".$IIIIIllI1l1l)->order('id desc')->select();

if(count($IIIII11IIl1I)>1){$IIIII11IIl1l=1;}else{$IIIII11IIl1l=0;}

$IIIIIII11I1I=M('diymen_set')->where(array('token'=>$IIIIIIIIlIlI))->find();

import('@.ORG.Jssdk');

$IIIII1I11lll = new JSSDK($IIIIIII11I1I['id'],$IIIIIII11I1I['appid'],$IIIIIII11I1I['appsecret']);

$IIIII1I11ll1 = $IIIII1I11lll->GetSignPackage();

$this->assign('signPackage',$IIIII1I11ll1);

$this->assign('ggpic',$IIIII11IIl1I);

$this->assign('ggduotu',$IIIII11IIl1l);

$this->assign('page_string',$IIIII11IIll1);

$this->assign('vote',$IIIIIIlI1111);

$this->assign('zuopins',$IIIII11IIlll);

$this->assign('istime',$IIIII11IIIlI);

$this->assign('tpl',$IIIIIIl1lI11);

$this->assign('rc',$IIIII11III1l);

$this->assign('check',$IIIIIIl111Il);

$this->assign('ishavezp',$IIIII11IIIll);

$this->assign('user',$IIIIIIIIII1I);

$this->assign('token',$IIIIIIIIlIlI);

$this->assign('havezpid',$IIIII11IIIl1);

$this->assign('id',$IIIIIllI1l1l);

$this->assign('page',$IIIIIIIII11I);

$this->display('rank$tp1');

}

}

public function top(){

$IIIIIllI1l1l=$_GET['id'];

$IIIIIIIIlIlI=$_GET['token'];

if($IIIIIllI1l1l){

$IIIIIIIIlIl1 = array('token'=>$IIIIIIIIlIlI,'id'=>$IIIIIllI1l1l);

$IIIIIIlI1111 	= M('Vote')->where($IIIIIIIIlIl1)->find();

if(!$IIIIIIlI1111){$this->error("没有此活动",U('Home/Index/index'));}

$IIIIIIlI1ll1 =  M('token_open')->where(array('token'=>$IIIIIIIIlIlI))->getField('uid');

$IIIIIIIIII1I = M('Users')->where(array('id'=>$IIIIIIlI1ll1))->find();

$IIIIIIl111Il=$IIIIIIlI1111['check'];

if(!$IIIIIIl111Il){$IIIIIIl111Il=0;}

$IIIIIIl111Il=$IIIIIIl111Il+$IIIIIIlI1111['xncheck'];

if($IIIIIIlI1111['start_time']<time() &&$IIIIIIlI1111['over_time']>time()){

$IIIII11IIIlI=1;

}else{

$IIIII11IIIlI=0;

}

if($_COOKIE['wxd_openid']){

$IIIIIIllIIlI['vid']=$IIIIIllI1l1l;

$IIIIIIllIIlI['status']=array('gt','0');

$IIIIIIllIIlI['wechat_id']= $_COOKIE['wxd_openid'];

$IIIIIlIllIl1 = M('Vote_item')->where($IIIIIIllIIlI)->find();

if($IIIIIlIllIl1){

$IIIII11IIIll=1;

$IIIII11IIIl1=$IIIIIlIllIl1['id'];

}

}

$IIIIIllIlII1['vid'] = $IIIIIllI1l1l;

$IIIIIllIlII1['status'] = array('gt','0');

$IIIII11III1I = array('vcount'=>'desc');

$IIIIIIl1lI11= M('Vote_item')->where("vid={$IIIIIllI1l1l}")->sum('vcount')+M('Vote_item')->where("vid={$IIIIIllI1l1l}")->sum('dcount');

if(empty($IIIIIIl1lI11)){$IIIIIIl1lI11=0;}

$IIIIIIl1lI11=$IIIIIIl1lI11+$IIIIIIlI1111['xntps'];

$IIIII11III1l=  M('Vote_item')->where($IIIIIllIlII1)->count();

if(empty($IIIII11III1l)){$IIIII11III1l=0;}

$IIIII11III1l=$IIIII11III1l+$IIIIIIlI1111['xnbms'];

$IIIII11II1Il = M('Vote_item')->where($IIIIIllIlII1)->order($IIIII11III1I)->limit(0,300)->select();

$IIIII11IIl1I=M('guanggao')->where("vid=".$IIIIIllI1l1l)->order('id desc')->select();

if(count($IIIII11IIl1I)>1){$IIIII11IIl1l=1;}else{$IIIII11IIl1l=0;}

$IIIIIII11I1I=M('diymen_set')->where(array('token'=>$IIIIIIIIlIlI))->find();

import('@.ORG.Jssdk');

$IIIII1I11lll = new JSSDK($IIIIIII11I1I['id'],$IIIIIII11I1I['appid'],$IIIIIII11I1I['appsecret']);

$IIIII1I11ll1 = $IIIII1I11lll->GetSignPackage();

$this->assign('signPackage',$IIIII1I11ll1);

$this->assign('ggpic',$IIIII11IIl1I);

$this->assign('ggduotu',$IIIII11IIl1l);

$this->assign('page_string',$IIIII11IIll1);

$this->assign('vote',$IIIIIIlI1111);

$this->assign('phlist',$IIIII11II1Il);

$this->assign('istime',$IIIII11IIIlI);

$this->assign('tpl',$IIIIIIl1lI11);

$this->assign('rc',$IIIII11III1l);

$this->assign('check',$IIIIIIl111Il);

$this->assign('ishavezp',$IIIII11IIIll);

$this->assign('user',$IIIIIIIIII1I);

$this->assign('token',$IIIIIIIIlIlI);

$this->assign('havezpid',$IIIII11IIIl1);

$this->assign('id',$IIIIIllI1l1l);

$this->display('top$tp1');

}

}

public function ticket(){

if(IS_POST){

$IIIIIlllIl1l=$_POST['zid'];

$IIIIIllI1l1l=$_POST['vid'];

$IIIIIIIIlIlI=$_POST['token'];

if($_COOKIE['wxd_openid']){

$IIIIIIlIlIll=$_COOKIE['wxd_openid'];

$IIIII11II1lI = M('fusers')->where("openid='{$IIIIIIlIlIll}'")->find();

if($IIIII11II1lI &&$IIIII11II1lI['is_gz']==1){

$IIIII11II1ll=M('Vote_item')->where(array('id'=>$IIIIIlllIl1l))->find();

if($IIIII11II1ll['status']!=1){

$IIIIIIIIIl11['status']=107;

}else{

$IIIIIIIIlIl1 = array('token'=>$IIIIIIIIlIlI,'id'=>$IIIIIllI1l1l);

$IIIIIIlI1111 = M('Vote')->where($IIIIIIIIlIl1)->find();

$IIIIIIlI1ll1 =  M('token_open')->where(array('token'=>$IIIIIIIIlIlI))->getField('uid');

$IIIIIIIIII1I = M('Users')->where(array('id'=>$IIIIIIlI1ll1))->find();

if($IIIIIIlI1111['statdate']>time()){

$IIIIIIIIIl11['status']=103;

}elseif($IIIIIIlI1111['enddate']<time()){

$IIIIIIIIIl11['status']=104;

}elseif(($IIIIIIlI1111['start_time']<time()) &&($IIIIIIlI1111['over_time']>time()) &&$IIIIIIlI1111['btcdxz'] &&($IIIII11II1ll['vcount']>=$IIIIIIlI1111['btcdxz'])){

$IIIIIIIIIl11['status']=120;

}else{

if($IIIIIIIIII1I['spxz']){

$IIIII11II1l1=$IIIIIIIIII1I['jgfen'];

$IIIII11II11I=$IIIIIIIIII1I['jgpiao'];

$IIIII11II1l1=time()-$IIIII11II1l1*60;

$IIIIIllII1II['vid']=$IIIIIllI1l1l;

$IIIIIllII1II['item_id']=$IIIIIlllIl1l;

$IIIIIllII1II['touch_time']=array('gt',$IIIII11II1l1);

$IIIII11II11l=M('vote_record')->where($IIIIIllII1II)->count();

if($IIIII11II11l>$IIIII11II11I){

//$IIIII11II111=M('vote_item')->where(array('id'=>$IIIIIlllIl1l))->getField('wechat_id');

if(!empty($IIIII11II1ll['wechat_id'])){

$IIIIIIlI1Ill='警告信息发送';

$this->sendtext($IIIIIIIIlIlI,$IIIII11II111,$IIIIIIIIII1I['jgtext']);

}

echo '107';

exit;

}

$IIIII11IlIII=$IIIIIIIIII1I['sdfen'];

$IIIII11IlIIl=$IIIIIIIIII1I['sdpiao'];

$IIIII11IlIII=time()-$IIIII11IlIII*60;

$IIIII11IlII1['vid']=$IIIIIllI1l1l;

$IIIII11IlII1['item_id']=$IIIIIlllIl1l;

$IIIII11IlII1['touch_time']=array('gt',$IIIII11IlIII);

$IIIII11IlIlI=M('vote_record')->where($IIIII11IlII1)->count();

if($IIIII11IlIlI>$IIIII11IlIIl){

$IIIII11II111=M('vote_item')->where(array('id'=>$IIIIIlllIl1l))->getField('wechat_id');

if($IIIII11II111){

$IIIIIIlI1Ill='锁定信息发送';

$this->sendtext($IIIIIIIIlIlI,$IIIII11II111,$IIIIIIIIII1I['sdtext']);

M('vote_item')->where(array('id'=>$IIIIIlllIl1l))->save(array('status'=>2));

}

echo '107';

exit;

}

}


$IIIII11IlIll=$this->GetIp();

$IIIIIII1l1Il="http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=json&ip=".$IIIII11IlIll;

$IIIII11IlIl1=json_decode($this->api_notice_increment($IIIIIII1l1Il));

if($IIIIIIIIII1I['xzlx']>0 &&!empty($IIIIIIIIII1I['area'])){

if($IIIII11IlIl1){

if($IIIIIIIIII1I['xzlx']==1){

$IIIII11IlI1I=$IIIII11IlIl1->province;

}elseif($IIIIIIIIII1I['xzlx']==2){

$IIIII11IlI1I=$IIIII11IlIl1->city;

}

if(strpos($IIIIIIIIII1I['area'],$IIIII11IlI1I)===false){

$IIIII11IlI1l=0;

}else{

$IIIII11IlI1l=1;

}

}else{$IIIII11IlI1l=1;}

}else{

$IIIII11IlI1l=1;

}

if($IIIII11IlI1l==1){

$IIIIIIllIIIl = date('Y-m-d',time());

if($IIIIIIIIII1I['tpxzmos']==0){$IIIIIIllIII1 = 1111111111;}else{$IIIIIIllIII1 = strtotime($IIIIIIllIIIl);}

$IIIIIIllIIlI['touch_time']=array('gt',$IIIIIIllIII1);

$IIIIIIllIIlI['wecha_id']=$IIIIIIlIlIll;

$IIIIIIllIIlI['vid']=$IIIIIllI1l1l;

$IIIIIIllIIll=M('vote_record')->where($IIIIIIllIIlI)->count();

if($IIIIIIlI1111['ipnubs']>0){

$IIIII1I11lI1['touch_time']=array('gt',$IIIIIIllIII1);

$IIIII1I11lI1['vid']=$IIIIIllI1l1l;

$IIIII1I11lI1['ip']=$IIIII11IlIll;

$IIIIIlIllIl1=M('vote_record')->where($IIIII1I11lI1)->count();

if($IIIIIlIllIl1<$IIIIIIlI1111['ipnubs']){

if($IIIIIIllIIll<$IIIIIIlI1111['tpnub']){

if($IIIIIIIIII1I['xz1p']){

$IIIIIIllIIl1['touch_time']=array('gt',$IIIIIIllIII1);

$IIIIIIllIIl1['vid']=$IIIIIllI1l1l;

$IIIIIIllIIl1['item_id']=$IIIIIlllIl1l;

$IIIIIIllIIl1['wecha_id']=$IIIIIIlIlIll;

if(M('vote_record')->where($IIIIIIllIIl1)->find()){$IIIIIIllII1I = 0;}else{$IIIIIIllII1I = 1;}

}else{

$IIIIIIllII1I = 1;

}

if($IIIIIIllII1I==1){

$IIIIIIllII1l['item_id']=$IIIIIlllIl1l;

$IIIIIIllII1l['vid']=$IIIIIllI1l1l;

$IIIIIIllII1l['wecha_id']=$IIIIIIlIlIll;

$IIIIIIllII1l['touch_time']=time();

$IIIIIIllII1l['token']=$IIIIIIIIlIlI;

$IIIIIIllII1l['touched']=1;

$IIIIIIllII1l['ip']=$IIIII11IlIll;

$IIIIIIllII1l['area']=$IIIII11IlIl1->province.$IIIII11IlIl1->city;

if(M('vote_record')->add($IIIIIIllII1l)){

$IIIIIIIIIl11['status']=108;

$IIIIIIllII11['vcount']=$IIIII11II1ll['vcount']+1;

M('vote_item')->where(array('id'=>$IIIIIlllIl1l))->save($IIIIIIllII11);

if($IIIIIIIIII1I['tpjl']){

$IIIIIIllIlII=M('fusers')->where("openid='{$IIIIIIlIlIll}'")->getField('jfnum');

M('fusers')->where("openid='{$IIIIIIlIlIll}'")->save(array('jfnum'=>$IIIIIIllIlII+$IIIIIIIIII1I['tpjlnum']));

}
if(!empty($IIIII11II1ll['wechat_id'])&&!empty($IIIIIIlI1111['is_sendsms'])&&!empty($IIIIIIlI1111['sms_content'])){
	$where_query = array('vid'=>$IIIII11II1ll['vid'],'vcount'=>array('gt',$IIIIIIllII11['vcount']));
	$vemaxrank  = M('vote_item')->where($where_query)->order('vcount desc')->max('vcount')-$IIIIIIllII11['vcount'];
	$veminrank  = M('vote_item')->where($where_query)->order('vcount desc')->min('vcount')-$IIIIIIllII11['vcount'];
	$myrank     = M('vote_item')->where($where_query)->count('id');
	if($vemaxrank<1)$vemaxrank=0;
	if($veminrank<1)$veminrank=0;
	$myrank+=1;
	$pares=array('frend'=>$IIIII11II1lI['nickname'],'vcount'=>$IIIIIIllII11['vcount'],'num'=>$myrank,'diffmaxcount'=>$vemaxrank,'diffmincount'=>$veminrank,'url'=>'http://'.$_SERVER['SERVER_NAME'].'/index.php?g=Wap&m=Vote&a=detail&token='.$IIIIIIIIlIlI.'&id='.$IIIII11II1ll['vid'].'&zid='.$IIIIIlllIl1l);
	$this->prasecontent($IIIIIIlI1111['sms_content'], $pares);
 $this->sendtext($IIIIIIIIlIlI,$IIIII11II1ll['wechat_id'],$IIIIIIlI1111['sms_content']);
}
}else{

$IIIIIIIIIl11['status']=107;

}

}else{

$IIIIIIIIIl11['status']=109;

}

}else{

$IIIIIIIIIl11['status']=106;

}

}else{

$IIIIIIIIIl11['status']=105;

}

}else{

if($IIIIIIllIIll<$IIIIIIlI1111['tpnub']){

if($IIIIIIIIII1I['xz1p']){

$IIIIIIllIIl1['touch_time']=array('gt',$IIIIIIllIII1);

$IIIIIIllIIl1['vid']=$IIIIIllI1l1l;

$IIIIIIllIIl1['item_id']=$IIIIIlllIl1l;

$IIIIIIllIIl1['wecha_id']=$IIIIIIlIlIll;

if(M('vote_record')->where($IIIIIIllIIl1)->find()){$IIIIIIllII1I = 0;}else{$IIIIIIllII1I = 1;}

}else{

$IIIIIIllII1I = 1;

}

if($IIIIIIllII1I==1){

$IIIIIIllII1l['item_id']=$IIIIIlllIl1l;

$IIIIIIllII1l['vid']=$IIIIIllI1l1l;

$IIIIIIllII1l['wecha_id']=$IIIIIIlIlIll;

$IIIIIIllII1l['touch_time']=time();

$IIIIIIllII1l['token']=$IIIIIIIIlIlI;

$IIIIIIllII1l['touched']=1;

$IIIIIIllII1l['ip']=$IIIII11IlIll;

$IIIIIIllII1l['area']=$IIIII11IlIl1->province.$IIIII11IlIl1->city;

if(M('vote_record')->add($IIIIIIllII1l)){

$IIIIIIIIIl11['status']=108;

$IIIIIIllII11['vcount']=$IIIII11II1ll['vcount']+1;

M('vote_item')->where(array('id'=>$IIIIIlllIl1l))->save($IIIIIIllII11);

if($IIIIIIIIII1I['tpjl']){

$IIIIIIllIlII=M('fusers')->where("openid='{$IIIIIIlIlIll}'")->getField('jfnum');

M('fusers')->where("openid='{$IIIIIIlIlIll}'")->save(array('jfnum'=>$IIIIIIllIlII+$IIIIIIIIII1I['tpjlnum']));

}

if(!empty($IIIII11II1ll['wechat_id'])&&!empty($IIIIIIlI1111['is_sendsms'])&&!empty($IIIIIIlI1111['sms_content'])){
	$where_query = array('vid'=>$IIIII11II1ll['vid'],'vcount'=>array('gt',$IIIIIIllII11['vcount']));
	$vemaxrank  = M('vote_item')->where($where_query)->order('vcount desc')->max('vcount')-$IIIIIIllII11['vcount'];
	$veminrank  = M('vote_item')->where($where_query)->order('vcount desc')->min('vcount')-$IIIIIIllII11['vcount'];
	$myrank     = M('vote_item')->where($where_query)->count('id');
	if($vemaxrank<1)$vemaxrank=0;
	if($veminrank<1)$veminrank=0;
	$myrank+=1;
	$pares=array('frend'=>$IIIII11II1lI['nickname'],'vcount'=>$IIIIIIllII11['vcount'],'num'=>$myrank,'diffmaxcount'=>$vemaxrank,'diffmincount'=>$veminrank,'url'=>'http://'.$_SERVER['SERVER_NAME'].'/index.php?g=Wap&m=Vote&a=detail&token='.$IIIIIIIIlIlI.'&id='.$IIIII11II1ll['vid'].'&zid='.$IIIIIlllIl1l);
	$this->prasecontent($IIIIIIlI1111['sms_content'], $pares);
	$this->sendtext($IIIIIIIIlIlI,$IIIII11II1ll['wechat_id'],$IIIIIIlI1111['sms_content']);
}
}else{

$IIIIIIIIIl11['status']=107;

}

}else{

$IIIIIIIIIl11['status']=109;

}

}else{

$IIIIIIIIIl11['status']=106;

}

}

}else{

$IIIIIIIIIl11['status']=110;

}

}

}

}else{

$IIIIIIIIIl11['status']=102;

}

}else{

$IIIIIIIIIl11['status']=102;

}

echo $IIIIIIIIIl11['status'];

}

}

public function signup(){

if(IS_POST){

$IIIIIllI1l1l=$_POST['id'];

$IIIIIIIIlIlI=$_POST['token'];

$IIIIIIIIlIl1 = array('token'=>$IIIIIIIIlIlI,'id'=>$IIIIIllI1l1l);

$IIIIIIlI1111 	= M('Vote')->where($IIIIIIIIlIl1)->find();

if(!$IIIIIIlI1111){$this->error("没有此活动",U('Home/Index/index'));}

$IIIIIIlI1ll1 =  M('token_open')->where(array('token'=>$IIIIIIIIlIlI))->getField('uid');

$IIIIIIIIII1I = M('Users')->where(array('id'=>$IIIIIIlI1ll1))->find();

if($IIIIIIlI1111){

if($IIIIIIlI1111['start_time']<time() &&$IIIIIIlI1111['over_time']>time()){

if($_COOKIE['wxd_openid']){

$IIIIIIllIIlI['openid']= $_COOKIE['wxd_openid'];

$IIIII11II1lI = M('fusers')->where($IIIIIIllIIlI)->find();

if($IIIII11II1lI){

if($IIIII11II1lI['is_gz']==1){

$IIIII1I11lI1['wechat_id']= $_COOKIE['wxd_openid'];

$IIIII1I11lI1['vid']=$IIIIIllI1l1l;

$IIIIIlllIllI = M('vote_item')->where($IIIII1I11lI1)->find();

if($IIIIIlllIllI){

$this->redirect('Wap/Vote/detail',array('id'=>$IIIIIllI1l1l,'token'=>$IIIIIIIIlIlI,'zid'=>$IIIIIlllIllI['id']));

}else{

$IIIII11IllII = array();

$IIIII11IllII['vid'] = $IIIIIllI1l1l;

$IIIII11IllII['wechat_id'] = $_COOKIE['wxd_openid'];

$IIIII11IllII['item'] = strip_tags($_POST['zpname']);

$IIIII11IllII['tourl'] = $_POST['telphone'];
$IIIII11IllII['wechat'] = $_POST['wechat'];

$IIIII11IllII['intro'] = strip_tags($_POST['content']);

$IIIII11IllII['addtime']=time();

if($IIIIIIlI1111['is_sh']==0){

$IIIII11IllII['status']=1;

}else{

$IIIII11IllII['status']=0;

}

if(!empty($_POST['fileup'])){

foreach($_POST['fileup'] as $IIIIIIIlI11I=>$IIIIIlI11II1){

if($IIIIIIIlI11I==0){

$IIIII11IllIl=$this->savepic($IIIIIlI11II1,$IIIIIllI1l1l);

if($IIIIIIIIII1I['tuchuang']){

$IIIII11IllII['startpicurl'] =$this->tcupload($IIIII11IllIl,$IIIIIIIIII1I['tuaccesskey'],$IIIIIIIIII1I['tusecretkey'],$IIIIIIIIII1I['tupicid']);

}else{

$IIIII11IllII['startpicurl'] = $IIIII11IllIl;

}

}

if($IIIIIIIlI11I==1){

$IIIII11IllI1=$this->savepic($IIIIIlI11II1,$IIIIIllI1l1l);

if($IIIIIIIIII1I['tuchuang']){

$IIIII11IllII['startpicurl2'] =$this->tcupload($IIIII11IllI1,$IIIIIIIIII1I['tuaccesskey'],$IIIIIIIIII1I['tusecretkey'],$IIIIIIIIII1I['tupicid']);

}else{

$IIIII11IllII['startpicurl2'] = $IIIII11IllI1;

}

}

if($IIIIIIIlI11I==2){

$IIIII11IlllI=$this->savepic($IIIIIlI11II1,$IIIIIllI1l1l);

if($IIIIIIIIII1I['tuchuang']){

$IIIII11IllII['startpicurl3'] =$this->tcupload($IIIII11IlllI,$IIIIIIIIII1I['tuaccesskey'],$IIIIIIIIII1I['tusecretkey'],$IIIIIIIIII1I['tupicid']);

}else{

$IIIII11IllII['startpicurl3'] = $IIIII11IlllI;

}

}

if($IIIIIIIlI11I==3){

$IIIII11Illll=$this->savepic($IIIIIlI11II1,$IIIIIllI1l1l);

if($IIIIIIIIII1I['tuchuang']){

$IIIII11IllII['startpicurl4'] =$this->tcupload($IIIII11Illll,$IIIIIIIIII1I['tuaccesskey'],$IIIIIIIIII1I['tusecretkey'],$IIIIIIIIII1I['tupicid']);

}else{

$IIIII11IllII['startpicurl4'] = $IIIII11Illll;

}

}

if($IIIIIIIlI11I==4){

$IIIII11Illl1=$this->savepic($IIIIIlI11II1,$IIIIIllI1l1l);

if($IIIIIIIIII1I['tuchuang']){

$IIIII11IllII['startpicurl5'] =$this->tcupload($IIIII11Illl1,$IIIIIIIIII1I['tuaccesskey'],$IIIIIIIIII1I['tusecretkey'],$IIIIIIIIII1I['tupicid']);

}else{

$IIIII11IllII['startpicurl5'] = $IIIII11Illl1;

}

}

}

}

$IIIII11Ill1I =  M('vote_item')->add($IIIII11IllII);

if(!$IIIII11II1lI['telphone']){

$IIIII11Ill1l = array(

'telphone'=>addslashes($_POST['telphone']),

);

M('fusers')->where(array('id'=>$IIIII11II1lI['id']))->save($IIIII11Ill1l);

}

}

$this->redirect('Wap/Vote/detail',array('id'=>$IIIIIllI1l1l,'token'=>$IIIIIIIIlIlI,'zid'=>$IIIII11Ill1I));

}else{

$this->redirect('Wap/Vote/index',array('id'=>$IIIIIllI1l1l,'token'=>$IIIIIIIIlIlI));

}

}

}

}

}

}else{

$IIIIIllI1l1l=$_GET['id'];

$IIIIIIIIlIlI=$_GET['token'];

if($IIIIIllI1l1l){

$IIIIIIIIlIl1 = array('token'=>$IIIIIIIIlIlI,'id'=>$IIIIIllI1l1l);

$IIIIIIlI1111 	= M('Vote')->where($IIIIIIIIlIl1)->find();

if(!$IIIIIIlI1111){$this->error("没有此活动",U('Home/Index/index'));}

$IIIIIIlI1ll1 =  M('token_open')->where(array('token'=>$IIIIIIIIlIlI))->getField('uid');

$IIIIIIIIII1I = M('Users')->where(array('id'=>$IIIIIIlI1ll1))->find();

if(empty($IIIIIIIIII1I['picnum'])){

$IIIII11Il1II = 0;

$IIIII11Il1Il = 1;

}else{

$IIIII11Il1II = $IIIIIIIIII1I['picnum']-1;

$IIIII11Il1Il = $IIIIIIIIII1I['picnum'];

}

$IIIIIIl111Il=$IIIIIIlI1111['check'];

if(!$IIIIIIl111Il){$IIIIIIl111Il=0;}

$IIIIIIl111Il=$IIIIIIl111Il+$IIIIIIlI1111['xncheck'];

if($IIIIIIlI1111['start_time']>time()){

$IIIII11Il1I1 = 1;

}elseif($IIIIIIlI1111['over_time']<time()){

$IIIII11Il1I1 = 2;

}else{

if($_COOKIE['wxd_openid']){

$IIIIIIllIIlI['openid']= $_COOKIE['wxd_openid'];

$IIIII11II1lI = M('fusers')->where($IIIIIIllIIlI)->find();

if($IIIII11II1lI){

if($IIIII11II1lI['is_gz']==1){

$IIIII1I11lI1['wechat_id']= $_COOKIE['wxd_openid'];

$IIIII1I11lI1['vid']=$IIIIIllI1l1l;

$IIIIIlllIllI = M('vote_item')->where($IIIII1I11lI1)->find();

if($IIIIIlllIllI){

$this->redirect('Wap/Vote/detail',array('id'=>$IIIIIllI1l1l,'token'=>$IIIIIIIIlIlI,'zid'=>$IIIIIlllIllI['id']));

}else{

$IIIII11Il1I1 = 4;

}

}else{

$IIIII11Il1I1 = 3;

}

}else{

$IIIII11Il1I1 = 3;

}

}else{

$IIIII11Il1I1 = 3;

}

}

$IIIIIllIlII1['vid'] = $IIIIIllI1l1l;

$IIIIIllIlII1['status'] = array('gt','0');

$IIIII11III1I = array('vcount'=>'desc');

$IIIIIIl1lI11= M('Vote_item')->where("vid={$IIIIIllI1l1l}")->sum('vcount')+M('Vote_item')->where("vid={$IIIIIllI1l1l}")->sum('dcount');

if(empty($IIIIIIl1lI11)){$IIIIIIl1lI11=0;}

$IIIIIIl1lI11=$IIIIIIl1lI11+$IIIIIIlI1111['xntps'];

$IIIII11III1l=  M('Vote_item')->where($IIIIIllIlII1)->count();

if(empty($IIIII11III1l)){$IIIII11III1l=0;}

$IIIII11III1l=$IIIII11III1l+$IIIIIIlI1111['xnbms'];

$IIIII11IIl1I=M('guanggao')->where("vid=".$IIIIIllI1l1l)->order('id desc')->select();

if(count($IIIII11IIl1I)>1){$IIIII11IIl1l=1;}else{$IIIII11IIl1l=0;}

$IIIIIII11I1I=M('diymen_set')->where(array('token'=>$IIIIIIIIlIlI))->find();

import('@.ORG.Jssdk');

$IIIII1I11lll = new JSSDK($IIIIIII11I1I['id'],$IIIIIII11I1I['appid'],$IIIIIII11I1I['appsecret']);

$IIIII1I11ll1 = $IIIII1I11lll->GetSignPackage();

$this->assign('signPackage',$IIIII1I11ll1);

$this->assign('ggpic',$IIIII11IIl1I);

$this->assign('ggduotu',$IIIII11IIl1l);

$this->assign('page_string',$IIIII11IIll1);

$this->assign('vote',$IIIIIIlI1111);

$this->assign('istime',$IIIII11IIIlI);

$this->assign('tpl',$IIIIIIl1lI11);

$this->assign('rc',$IIIII11III1l);

$this->assign('check',$IIIIIIl111Il);

$this->assign('ishavezp',$IIIII11IIIll);

$this->assign('user',$IIIIIIIIII1I);

$this->assign('token',$IIIIIIIIlIlI);

$this->assign('havezpid',$IIIII11IIIl1);

$this->assign('id',$IIIIIllI1l1l);

$this->assign('xzpic',$IIIII11Il1II);

$this->assign('picnum',$IIIII11Il1Il);

$this->assign('bmzt',$IIIII11Il1I1);

$this->display('signup$tp1');

}

}

}

public function search(){

if(IS_POST){

$IIIIIllI1l1l=$_POST['id'];

$IIIIIIIIlIlI=$_POST['token'];

if($_POST['keyword']!=null &&is_numeric($_POST['keyword'])){

$IIIII1I11Ill = intval(htmlspecialchars($_POST['keyword']));

$IIIIII1Il1I1 = M('Vote_item')->where(array('id'=>$IIIII1I11Ill))->find();

if($IIIIII1Il1I1){

$this->redirect('Wap/Vote/detail',array('id'=>$IIIIIllI1l1l,'token'=>$IIIIIIIIlIlI,'zid'=>$IIIII1I11Ill));

}else{

$IIIII1I11lI1=U('Wap/Vote/index',array('id'=>$IIIIIllI1l1l,'token'=>$IIIIIIIIlIlI));

echo "<script> alert('无此ID选手');location.href='".$IIIII1I11lI1."';</script>";

}

}else{

$IIIII11III1I = array('vcount'=>'desc');

$IIIII11Il1lI['item'] = array('like','%'.htmlspecialchars($_POST['keyword']).'%');

$IIIII11IIlll = M('Vote_item')->where($IIIII11Il1lI)->order($IIIII11III1I)->select();

if($IIIII11IIlll){

$IIIIIIIIlIl1 = array('token'=>$IIIIIIIIlIlI,'id'=>$IIIIIllI1l1l);

$IIIIIIlI1111 	= M('Vote')->where($IIIIIIIIlIl1)->find();

$IIIIIIlI1ll1 =  M('token_open')->where(array('token'=>$IIIIIIIIlIlI))->getField('uid');

$IIIIIIIIII1I = M('Users')->where(array('id'=>$IIIIIIlI1ll1))->find();

$IIIIIIl111Il=$IIIIIIlI1111['check'];

if(!$IIIIIIl111Il){$IIIIIIl111Il=0;}

$IIIIIIl111Il=$IIIIIIl111Il+$IIIIIIlI1111['xncheck'];

if($IIIIIIlI1111['start_time']<time() &&$IIIIIIlI1111['over_time']>time()){

$IIIII11IIIlI=1;

}else{

$IIIII11IIIlI=0;

}

if($_COOKIE['wxd_openid']){

$IIIIIIllIIlI['vid']=$IIIIIllI1l1l;

$IIIIIIllIIlI['status']=array('gt','0');

$IIIIIIllIIlI['wechat_id']= $_COOKIE['wxd_openid'];

$IIIIIlIllIl1 = M('Vote_item')->where($IIIIIIllIIlI)->find();

if($IIIIIlIllIl1){

$IIIII11IIIll=1;

$IIIII11IIIl1=$IIIIIlIllIl1['id'];

}

}

$IIIIIllIlII1['vid'] = $IIIIIllI1l1l;

$IIIIIllIlII1['status'] = array('gt','0');

$IIIIIIl1lI11= M('Vote_item')->where("vid={$IIIIIllI1l1l}")->sum('vcount')+M('Vote_item')->where("vid={$IIIIIllI1l1l}")->sum('dcount');

if(empty($IIIIIIl1lI11)){$IIIIIIl1lI11=0;}

$IIIIIIl1lI11=$IIIIIIl1lI11+$IIIIIIlI1111['xntps'];

$IIIII11III1l=  M('Vote_item')->where($IIIIIllIlII1)->count();

if(empty($IIIII11III1l)){$IIIII11III1l=0;}

$IIIII11III1l=$IIIII11III1l+$IIIIIIlI1111['xnbms'];

$IIIII11IIl1I=M('guanggao')->where("vid=".$IIIIIllI1l1l)->order('id desc')->select();

if(count($IIIII11IIl1I)>1){$IIIII11IIl1l=1;}else{$IIIII11IIl1l=0;}

$IIIIIII11I1I=M('diymen_set')->where(array('token'=>$IIIIIIIIlIlI))->find();

import('@.ORG.Jssdk');

$IIIII1I11lll = new JSSDK($IIIIIII11I1I['id'],$IIIIIII11I1I['appid'],$IIIIIII11I1I['appsecret']);

$IIIII1I11ll1 = $IIIII1I11lll->GetSignPackage();

$this->assign('signPackage',$IIIII1I11ll1);

$this->assign('ggpic',$IIIII11IIl1I);

$this->assign('ggduotu',$IIIII11IIl1l);

$this->assign('page_string',$IIIII11IIll1);

$this->assign('vote',$IIIIIIlI1111);

$this->assign('zuopins',$IIIII11IIlll);

$this->assign('istime',$IIIII11IIIlI);

$this->assign('tpl',$IIIIIIl1lI11);

$this->assign('rc',$IIIII11III1l);

$this->assign('check',$IIIIIIl111Il);

$this->assign('ishavezp',$IIIII11IIIll);

$this->assign('user',$IIIIIIIIII1I);

$this->assign('token',$IIIIIIIIlIlI);

$this->assign('havezpid',$IIIII11IIIl1);

$this->assign('id',$IIIIIllI1l1l);

$this->display('search$tp1');

}else{

$IIIII1I11lI1=U('Wap/Vote/index',array('id'=>$IIIIIllI1l1l,'token'=>$IIIIIIIIlIlI));

echo "<script> alert('无此选手');location.href='".$IIIII1I11lI1."';</script>";

}

}

}

}

public function add_vote(){

$IIIIIIIIlIlI 		=	$this->_post('token');

$IIIIIlIIIll1	=	$this->_post('wecha_id');

$IIIIIIl1ll11 		=	$this->_post('tid');

$IIIII11Il1l1 		= 	rtrim($this->_post('chid'),',');

$IIIIIIlI111I 	=	M('Vote_record');

$IIIII11Il11I  =   M('vote')->where(array('id'=>$IIIIIIl1ll11))->field('votelimit')->find();

$IIIIIIIIlIl1   = array('vid'=>$IIIIIIl1ll11,'wecha_id'=>$IIIIIlIIIll1,'token'=>$IIIIIIIIlIlI);

$IIIII1lI1lI1 =  $IIIIIIlI111I->where($IIIIIIIIlIl1)->select();

$IIIII11Il11l = count($IIIII1lI1lI1,COUNT_NORMAL);

if($IIIII11Il11l >= (int)$IIIII11Il11I['votelimit'] ||$IIIIIlIIIll1 ==''){

$IIIIIIIlII1l=array('success'=>0);

echo json_encode($IIIIIIIlII1l);

exit;

}else{

$IIIII11Il111 = (int)$IIIII11Il11I['votelimit']-(int)$IIIII11Il11l-1;

$IIIIIIIIIl11 = array('item_id'=>$IIIII11Il1l1,'token'=>$IIIIIIIIlIlI,'vid'=>$IIIIIIl1ll11,'wecha_id'=>$IIIIIlIIIll1,'touch_time'=>time(),'touched'=>1);

$IIIIIIIIlI1I = $IIIIIIlI111I->add($IIIIIIIIIl11);

$IIIIII1IIlIl['id'] = array('in',$IIIII11Il1l1);

$IIIIIIlI111l = M('Vote_item');

$IIIIIIlI111l->where($IIIIII1IIlIl)->setInc('vcount');

$IIIIIIIlII1l=array('success'=>1,'token'=>$IIIIIIIIlIlI,'wecha_id'=>$IIIIIlIIIll1,'tid'=>$IIIIIIl1ll11,'chid'=>$IIIII11Il1l1,'arrpre'=>$IIIII11I1III,'vleft'=>$IIIII11Il111);

echo json_encode($IIIIIIIlII1l);

exit;}

}

public function detail(){
$IIIIIllI1l1l=$_GET['id'];

$IIIIIIIIlIlI=$_GET['token'];

$IIIIIlllIl1l=$_GET['zid'];

$IIIII11IIIIl=$_GET['isappinstalled'];

$IIIIIl1Il1l1=$_GET['from'];

//if(!isset($IIIIIl1Il1l1) &&!isset($IIIII11IIIIl)){

if(empty($_COOKIE['wxd_openid'])){

if(isset($_GET['wecha_id'])){

$IIIIIIlIlIll = $_GET['wecha_id'];

setcookie('wxd_openid',$IIIIIIlIlIll,time()+31536000);
//setcookie('wxd_openid',$IIIIIIlIlIll,time()+31536000,'/','.m.nckyjy.com');

$this->redirect('Wap/Vote/detail',array('id'=>$IIIIIllI1l1l,'token'=>$IIIIIIIIlIlI,'zid'=>$IIIIIlllIl1l));

exit;

}

}else{

if(isset($_GET['wecha_id'])){

if($_GET['wecha_id']!=$_COOKIE['wxd_openid']){

$IIIIIIlIlIll = $_GET['wecha_id'];

setcookie('wxd_openid',$IIIIIIlIlIll,time()+31536000);
//setcookie('wxd_openid',$IIIIIIlIlIll,time()+31536000,'/','.m.nckyjy.com');

}

$this->redirect('Wap/Vote/detail',array('id'=>$IIIIIllI1l1l,'token'=>$IIIIIIIIlIlI,'zid'=>$IIIIIlllIl1l));

exit;

}

}

/*}else{

$this->redirect('Wap/Vote/index',array('id'=>$IIIIIllI1l1l,'token'=>$IIIIIIIIlIlI));

exit;

}*/

if(empty($_GET['wecha_id'])){

$IIIIIllIlIII		= M('Vote');

$IIIIIIIIlIl1 		= array('token'=>$IIIIIIIIlIlI,'id'=>$IIIIIllI1l1l);

$IIIIIIlI1111 	= $IIIIIllIlIII->where($IIIIIIIIlIl1)->find();

$IIIIIllIlIlI = M('Vote_item');

$IIIIIllIlII1['id'] = $IIIIIlllIl1l;

$IIIIIIIIIl11 = $IIIIIllIlIlI->where($IIIIIllIlII1)->find();

$IIIII1lIl111['vcount']=array('gt',$IIIIIIIIIl11['vcount']);

$IIIII1lIl111['vid']=$IIIIIllI1l1l;

$IIIII11I1IIl=$IIIIIllIlIlI->where($IIIII1lIl111)->count();

$IIIII11I1IIl+=1;

$IIIIIllIlllI = M('Token_open');

$IIIIIllIlll1 = $IIIIIllIlllI->where(array('token'=>$IIIIIIIIlIlI))->getField('uid');

$IIIIIIIIII1I = M('Users')->where(array('id'=>$IIIIIllIlll1))->find();

if($_COOKIE['wxd_openid']){

$IIIIIIllIIlI['vid']=$IIIIIllI1l1l;

$IIIIIIllIIlI['status']=array('gt','0');

$IIIIIIllIIlI['wechat_id']= $_COOKIE['wxd_openid'];

$IIIIIlIllIl1 = M('Vote_item')->where($IIIIIIllIIlI)->find();

if($IIIIIlIllIl1){

$IIIII11IIIll=1;

$IIIII11IIIl1=$IIIIIlIllIl1['id'];

}

}

$IIIII11IIl1I=M('guanggao')->where("vid=".$IIIIIllI1l1l)->order('id desc')->select();

if(count($IIIII11IIl1I)>1){$IIIII11IIl1l=1;}else{$IIIII11IIl1l=0;}

$IIIIIII11I1I=M('diymen_set')->where(array('token'=>$IIIIIIIIlIlI))->find();

import('@.ORG.Jssdk');

$IIIII1I11lll = new JSSDK($IIIIIII11I1I['id'],$IIIIIII11I1I['appid'],$IIIIIII11I1I['appsecret']);

$IIIII1I11ll1 = $IIIII1I11lll->GetSignPackage();

$this->assign('signPackage',$IIIII1I11ll1);

$this->assign('ggpic',$IIIII11IIl1I);

$this->assign('ggduotu',$IIIII11IIl1l);

$this->assign('zpinfo',$IIIIIIIIIl11);

$this->assign('vote',$IIIIIIlI1111);

$this->assign('mingci',$IIIII11I1IIl);

$this->assign('ishavezp',$IIIII11IIIll);

$this->assign('havezpid',$IIIII11IIIl1);

$this->assign('user',$IIIIIIIIII1I);

$this->assign('token',$IIIIIIIIlIlI);

$this->assign('havezpid',$IIIII11IIIl1);

$this->assign('id',$IIIIIllI1l1l);

$this->display('detail$tp1');

}

}

public function vote(){

$IIIIIIIIIl11['item_id'] = htmlspecialchars($this->_post('id'));

$IIIIIIIIIl11['vid'] = htmlspecialchars($this->_post('vid'));

$IIIIIIIIIl11['token'] = htmlspecialchars($this->_post('token'));

$IIIIIIIIIl11['wecha_id'] = htmlspecialchars($this->_post('wecha_id'));

$IIIIIIIIIl11['touch_time'] = time();

$IIIIIIIIIl11['touched'] = 1;

$IIIIIllIlII1['vid'] = $IIIIIIIIIl11['vid'];

$IIIIIllIlII1['wecha_id'] = $IIIIIIIIIl11['wecha_id'];

$IIIII11I1II1 = M('Vote_record');

if($IIIII11I1II1->where($IIIIIllIlII1)->find()){

$this->ajaxReturn('','',1,'json');

}else{

$IIIII11I1II1->add($IIIIIIIIIl11);

$IIIIII1IIlIl['id'] = array('in',$IIIIIIIIIl11['item_id']);

$IIIIIIlI111l = M('Vote_item');

$IIIIIIlI111l->where($IIIIII1IIlIl)->setInc('vcount');

$this->ajaxReturn('','',2,'json');

}

}

public function add_item(){

$IIIIIIIlI11I      = $this->_get('key');

$IIIIIIIII11I     =  intval($this->_get('page'));

$IIIIIIIII1I1         = $this->_get('id');

$IIIIIllIlII1['vid'] = $IIIIIIIII1I1;

$IIIIIllIlII1['status'] = 1;

$IIIIIllII1ll = intval(6);

$IIIII11I1Ill = $IIIIIIIII11I*$IIIIIllII1ll;

if($IIIIIIIlI11I != ''&&$IIIIIIIlI11I != NULL){

if(is_numeric($IIIIIIIlI11I)){

$IIIIIllIlII1['id'] = array('like','%'.intval(htmlspecialchars($IIIIIIIlI11I)).'%');

}else{

$IIIIIllIlII1['item'] = array('like','%'.htmlspecialchars($IIIIIIIlI11I).'%');

}

}

$IIIIIllIlIlI = M('Vote_item')->where($IIIIIllIlII1)->order(array('rank'=>'asc','id'=>'desc'))->limit($IIIII11I1Ill,$IIIIIllII1ll)->select();

$IIIII11I1Il1='';

foreach ($IIIIIllIlIlI as $IIIIIIIllIll=>$IIIIIIIlI11l) {

$IIIII11I1Il1 =$IIIII11I1Il1."  

						<li><a href=\"/index.php?g=Wap&m=Vote&a=show&token=".$_SESSION['token']."&id=".$IIIIIIIlI11l['id']."&wecha_id=".$_SESSION['wecha_id']."&tid=".$IIIIIIIII1I1."\"><img src=\"".$IIIIIIIlI11l['startpicurl']."\"></a>

						<p class=\"info\">".$IIIIIIIlI11l['item']."<br>选手编号：<i class=\"vote_1\">".$IIIIIIIlI11l['id']."</i><br>票数：<i class=\"vote_1\">".$IIIIIIIlI11l['vcount']."</i><br></p>

						<p class=\"vote\"><a href=\"/index.php?g=Wap&m=Vote&a=show&token=".$_SESSION['token']."&id=".$IIIIIIIlI11l['id']."&wecha_id=".$_SESSION['wecha_id']."&tid=".$IIIIIIIII1I1."\">详细资料</a></p></li>";

}

echo $IIIII11I1Il1;

}

public function add_rank(){

$IIIIIIIII11I     =  intval($this->_get('page'));

$IIIIIIIII1I1         = $this->_get('id');

$IIIIIllIlII1['vid'] = $IIIIIIIII1I1;

$IIIIIllIlII1['status'] = 1;

$IIIIIllII1ll = intval(6);

$IIIII11I1Ill = $IIIIIIIII11I*$IIIIIllII1ll;

$IIIIIllIlIlI = M('Vote_item')->where($IIIIIllIlII1)->order('vcount desc')->limit($IIIII11I1Ill,$IIIIIllII1ll)->select();

$IIIII11I1Il1='';

foreach ($IIIIIllIlIlI as $IIIIIIIllIll=>$IIIIIIIlI11l) {

$IIIII11I1Il1 =$IIIII11I1Il1."  <div class='pp'> 

						<a href=\"/index.php?g=Wap&m=Vote&a=show&token=".$_SESSION['token']."&id=".$IIIIIIIlI11l['id']."&wecha_id=".$_SESSION['wecha_id']."&tid=".$IIIIIIIII1I1."\">

						<img src=\"".$IIIIIIIlI11l['startpicurl']."\">

						

						<div class=\"tit\">".$IIIIIIIlI11l['id']."号 ".$IIIIIIIlI11l['item']."<br />人气：<b>".$IIIIIIIlI11l['vcount']."</b></div>

					</div></a>";

}

echo $IIIII11I1Il1;

}

private function savepic($IIIII11I1I11,$IIIIIllI1l1l){

$IIIIIIlIll11 = date('Ymd');

if (!file_exists(($_SERVER['DOCUMENT_ROOT'] .'/uploads')) ||!is_dir(($_SERVER['DOCUMENT_ROOT'] .'/uploads'))) {

mkdir($_SERVER['DOCUMENT_ROOT'] .'/uploads');

}

$IIIIIIlIl1Il = $_SERVER['DOCUMENT_ROOT'] .'/uploads/vote';

if (!file_exists($IIIIIIlIl1Il) ||!is_dir($IIIIIIlIl1Il)) {

mkdir($IIIIIIlIl1Il);

}

$IIIII11I1lII = ($_SERVER['DOCUMENT_ROOT'] .'/uploads/vote/').$IIIIIllI1l1l;

if (!file_exists($IIIII11I1lII) ||!is_dir($IIIII11I1lII)) {

mkdir($IIIII11I1lII);

}

$IIIIIIlIl1Il = (($_SERVER['DOCUMENT_ROOT'] .'/uploads/vote/') .$IIIIIllI1l1l).'/'.$IIIIIIlIll11;

if (!file_exists($IIIIIIlIl1Il) ||!is_dir($IIIIIIlIl1Il)) {

mkdir($IIIIIIlIl1Il);

}

$IIIIIIlIl1I1 = ((date('YmdHis') .'_') .rand(10000,99999)).'.jpeg';

$IIIII11I1lIl=(((('/uploads/vote/').$IIIIIllI1l1l).'/'.$IIIIIIlIll11) .'/') .$IIIIIIlIl1I1;

$IIIIIlI11II1=$_SERVER['DOCUMENT_ROOT'].$IIIII11I1lIl;

$IIIIIII1l1Il= 'http://'.$_SERVER['HTTP_HOST'].$IIIII11I1lIl;

$IIIII11I1lI1=base64_decode($IIIII11I1I11);

$IIIII11I1llI = file_put_contents($IIIIIlI11II1,$IIIII11I1lI1);

if($IIIII11I1llI){

return $IIIIIII1l1Il;

}

}

private function tcupload($IIIIIlI11II1,$IIIII11I1ll1,$IIIII11I1l1I,$IIIII11I1l1l){

import('@.ORG.TieTuKu');

$IIIII11I1l11=new TTKClient($IIIII11I1ll1,$IIIII11I1l1I);

$IIIIIII11l11=$IIIII11I1l11->uploadFile($IIIII11I1l1l,$IIIIIlI11II1);

$IIIIIII11l11 = str_replace("{","",$IIIIIII11l11);

$IIIIIII11l11 = str_replace("}","",$IIIIIII11l11);

$IIIIIII11l11 = str_replace('"',"",$IIIIIII11l11);

$IIIIII1l1l11 = explode(',',$IIIIIII11l11);

$IIIII11I11II = str_replace('s_url:',"",$IIIIII1l1l11[7]);

if($IIIII11I11II){

return stripslashes($IIIII11I11II);

}else{

return NULL;

}

}

private  function GetIP(){

$IIIII11IlIll=false;

if(!empty($_SERVER["HTTP_CLIENT_IP"])){

$IIIII11IlIll = $_SERVER["HTTP_CLIENT_IP"];

}

if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {

$IIIII11I11I1 = explode (", ",$_SERVER['HTTP_X_FORWARDED_FOR']);

if(count($IIIII11I11I1)<2){

$IIIII11I11I1 = explode (",",$_SERVER['HTTP_X_FORWARDED_FOR']);

}

if ($IIIII11IlIll) {array_unshift($IIIII11I11I1,$IIIII11IlIll);$IIIII11IlIll = FALSE;}

for ($IIIIIIIllI11 = 0;$IIIIIIIllI11 <count($IIIII11I11I1);$IIIIIIIllI11++) {

if (!eregi ("^(10|172\.16|192\.168)\.",$IIIII11I11I1[$IIIIIIIllI11])) {

$IIIII11IlIll = $IIIII11I11I1[$IIIIIIIllI11];

break;

}

}

}

return ($IIIII11IlIll ?$IIIII11IlIll : $_SERVER['REMOTE_ADDR']);

}

public function hongbao(){
	$user_id='';
	$vcount=0;
	$vote_id=isset($_GET['id'])?trim($_GET['id']):'';
	$token_id=isset($_GET['token'])?trim($_GET['token']):'';
	if($this->user_is_gz==1){
		$my_items=M('vote_item')->where(array('wechat_id'=>trim($_COOKIE['wxd_openid'])))->getField('vcount');
		if($my_items){
			$user_id=$_COOKIE['wxd_openid'];
			$vcount=intval($my_items);
		}
	}
	$this->assign('hb_user_id',$user_id);
	$this->assign('hb_vcount',$vcount);
	$this->assign('token',$token_id);
	$this->assign('id',$vote_id);
	$this->display('hongbao');
}
protected function Set_Is_Gz(){
	if($_COOKIE['wxd_openid']){
		//echo $_COOKIE['wxd_openid'];
		$user=M('fusers')->where(array('openid'=>trim($_COOKIE['wxd_openid'])))->find();
		if($user&&$user['is_gz']==1)$this->user_is_gz=1;
	}
	$this->assign('user_is_gz',$this->user_is_gz);
}
}?>