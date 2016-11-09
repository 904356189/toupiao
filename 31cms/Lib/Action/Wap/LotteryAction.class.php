<?php

class LotteryAction extends LotteryBaseAction{
public function index(){
$IIIII1Ill1II = $_SERVER['HTTP_USER_AGENT'];
if(!strpos($IIIII1Ill1II,"icroMessenger")) {
$this->error('此功能只能在微信浏览器中使用');
}
C('site_url','http://'.$_SERVER['HTTP_HOST']);
$IIIIIIIIlIlI		= $this->_get('token');
$IIIIIlIIIll1	= $this->_get('wecha_id');
$IIIIIIIII1I1 		= $this->_get('id');
if($IIIIIIIII1I1 == ''){
$this->error("不存在的活动");
}
if(!$_COOKIE['dzp_openid']){
if($_GET['wecha_id']){
$IIIIIIlIlIll = $_GET['wecha_id'];
setcookie('dzp_openid',$IIIIIIlIlIll,time()+31536000);
$this->redirect('Wap/Lottery/index',array('id'=>$IIIIIIIII1I1,'token'=>$IIIIIIIIlIlI));
exit;
}
}else{
if($_GET['wecha_id']){
if($_GET['wecha_id']!=$_COOKIE['dzp_openid']){
$IIIIIIlIlIll = $_GET['wecha_id'];
setcookie('dzp_openid',$IIIIIIlIlIll,time()+31536000);
}
$this->redirect('Wap/Lottery/index',array('id'=>$IIIIIIIII1I1,'token'=>$IIIIIIIIlIlI));
exit;
}
}
if(!$_GET['wecha_id']){
$IIIIIlIIIll1=$_COOKIE['dzp_openid']?$_COOKIE['dzp_openid']:NULL;
$IIIII1I11lIl		= M('Lottery_record');
$IIIIIIIIlIl1 		= array('token'=>$IIIIIIIIlIlI,'wecha_id'=>$IIIIIlIIIll1,'lid'=>$IIIIIIIII1I1);
$IIIIII1llllI 	= $IIIII1I11lIl->where(array('token'=>$IIIIIIIIlIlI,'wecha_id'=>$IIIIIlIIIll1,'lid'=>$IIIIIIIII1I1,'islottery'=>1))->find();
if (!$IIIIII1llllI){
$IIIIII1llllI 	= $IIIII1I11lIl->where($IIIIIIIIlIl1)->order('id DESC')->find();
}
$IIIIIll1lll1 	= M('Lottery')->where(array('id'=>$IIIIIIIII1I1,'token'=>$IIIIIIIIlIlI,'type'=>1,'status'=>1))->find();
if(!($IIIIIll1lll1)){
$this->error("不存在的活动");
}
$IIIIIll1lll1['renametel']=$IIIIIll1lll1['renametel']?$IIIIIll1lll1['renametel']:'手机号';
$IIIIIll1lll1['renamesn']=$IIIIIll1lll1['renamesn']?$IIIIIll1lll1['renamesn']:'SN码';
$IIIIIIIIIl11=$IIIIIll1lll1;
if ($IIIIIll1lll1['enddate'] <time()) {
$IIIIIIIIIl11['end'] = 1;
$IIIIIIIIIl11['endinfo'] = $IIIIIll1lll1['endinfo'];
$this->assign('Dazpan',$IIIIIIIIIl11);
$this->display();
exit();
}
if ($IIIIII1llllI['islottery'] == 1) {
$IIIIIIIIIl11['end'] = 5;
$IIIIIIIIIl11['sn']	 	 = $IIIIII1llllI['sn'];
$IIIIIIIIIl11['uname']	 = $IIIIII1llllI['wecha_name'];
$IIIIIIIIIl11['prize']	 = $IIIIII1llllI['prize'];
$IIIIIIIIIl11['tel'] 	 = $IIIIII1llllI['phone'];
}
if($IIIIIlIIIll1){
$IIIII1I11lI1=M('fusers')->where(array('openid'=>$IIIIIlIIIll1,'is_gz'=>1))->find();
if($IIIII1I11lI1){
if($IIIIIll1lll1['cyfs']==2){
$IIIIIIllIlII=$IIIII1I11lI1['jfnum'];
$IIIIIIIIIl11['sycs']=floor($IIIIIIllIlII/$IIIIIll1lll1['decjf']);
$IIIIIIIIIl11['jf']=$IIIIIIllIlII?$IIIIIIllIlII:0;
$IIIIIIIIIl11['decjf']=$IIIIIll1lll1['decjf'];
}
}else{$IIIIIlIIIll1=NULL;$IIIIIIIIIl11['jf']=0;}
}
$IIIIIIIIIl11['On'] 		= 1;
$IIIIIIIIIl11['token'] 		= $IIIIIIIIlIlI;
$IIIIIIIIIl11['wecha_id']	= $IIIIIlIIIll1;
$IIIIIIIIIl11['lid']		= $IIIIIll1lll1['id'];
$IIIIIIIIIl11['rid']		= intval($IIIIII1llllI['id']);
$IIIIIIIIIl11['usenums'] 	= $IIIIII1llllI['usenums'];
$IIIIIIIIIl11['info']=str_replace('&lt;br&gt;','<br>',$IIIIIIIIIl11['info']);
$IIIIIIIIIl11['endinfo']=str_replace('&lt;br&gt;','<br>',$IIIIIIIIIl11['endinfo']);
$IIIIIIIIIl11['ydgzurl']=$IIIIIll1lll1['ydgzurl'];
$IIIIIIIIIl11['cyfs']=$IIIIIll1lll1['cyfs'];
$IIIIIIIIIl11['fxbt']=$IIIIIll1lll1['fxbt'];
$IIIIIIIIIl11['fxzy']=$IIIIIll1lll1['fxzy'];
$IIIIIII11I1I=M('diymen_set')->where(array('token'=>$IIIIIIIIlIlI))->find();
import('@.ORG.Jssdk');
$IIIII1I11lll = new JSSDK($IIIIIII11I1I['id'],$IIIIIII11I1I['appid'],$IIIIIII11I1I['appsecret']);
$IIIII1I11ll1 = $IIIII1I11lll->GetSignPackage();
$this->assign('signPackage',$IIIII1I11ll1);
$this->assign('Dazpan',$IIIIIIIIIl11);
$IIIIII1llllI['id']=intval($IIIIII1llllI['id']);
$this->assign('record',$IIIIII1llllI);
$this->display();
}
}
public function getajax(){
$IIIIIIIIlIlI 		=	$this->_get('token');
$IIIIIlIIIll1	=	$this->_get('oneid');
$IIIIIIIII1I1 		=	$this->_get('id');
$IIIIII1llI11 		= 	$this->_get('rid');
$IIIIIll1lll1=M('Lottery')->where(array('id'=>$IIIIIIIII1I1))->find();
$IIIIIIIIIl11=$this->prizeHandle($IIIIIIIIlIlI,$IIIIIlIIIll1,$IIIIIll1lll1);
if ($IIIIIIIIIl11['end']==3){
$IIIIIIIlIlll	 	 = $IIIIIIIIIl11['sn'];
$IIIII1I11l1l	 = $IIIIIIIIIl11['wecha_name'];
$IIIII1I11l11	 = $IIIIIIIIIl11['prize'];
$IIIIIIlIll1I 	 = $IIIIIIIIIl11['phone'];
$IIIIIlIl1Ill = $IIIIIIIIIl11['msg'];
echo '{"error":1,"msg":"'.$IIIIIlIl1Ill.'"}';
exit;
}
if ($IIIIIIIIIl11['end']==-1){
$IIIIIlIl1Ill = $IIIIIIIIIl11['winprize'];
echo '{"error":1,"msg":"'.$IIIIIlIl1Ill.'"}';
exit;
}
if ($IIIIIIIIIl11['end']==-2){
$IIIIIlIl1Ill = $IIIIIIIIIl11['winprize'];
echo '{"error":1,"msg":"'.$IIIIIlIl1Ill.'"}';
exit;
}
if ($IIIIIIIIIl11['end']==-5){
$IIIIIlIl1Ill = $IIIIIIIIIl11['winprize'];
echo '{"error":1,"msg":"'.$IIIIIlIl1Ill.'"}';
exit;
}
if ($IIIIIIIIIl11['prizetype'] >= 1 &&$IIIIIIIIIl11['prizetype'] <= 6) {
echo '{"success":1,"sn":"'.$IIIIIIIIIl11['sncode'].'","prizetype":"'.$IIIIIIIIIl11['prizetype'].'","usenums":"'.$IIIIIIIIIl11['usenums'].'"}';
}else{
echo '{"success":0,"prizetype":"","usenums":"'.$IIIIIIIIIl11['usenums'].'"}';
}
exit();
}
}
?>