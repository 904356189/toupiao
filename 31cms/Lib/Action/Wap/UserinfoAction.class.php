<?php

class UserinfoAction extends WapAction{
public function _initialize() {
parent::_initialize();
session('wapupload',1);
if (!$this->IIIIIlIIIll1){
$this->error('您无权访问','');
}
}
public function index(){
$IIIII1Ill1II = $_SERVER['HTTP_USER_AGENT'];
if(!strpos($IIIII1Ill1II,"icroMessenger")) {
}
$IIIIIlIl1llI=intval($this->_get('cardid'));
$IIIII1l11l1I = M('Member_card_custom')->where(array('token'=>$this->IIIIIIIIlIlI))->find();
$this->assign('conf',$IIIII1l11l1I);
$IIIIIll1Il11 = D('Member_card_create');
$IIIIIIIIIl11['wecha_id']=$this->_get('wecha_id');
$IIIIIIIIIl11['token']=$this->_get('token');
$IIIII1l11l1l['wecha_id']=$this->_get('wecha_id');
$IIIII1l11l1l['token']=$this->_get('token');
$IIIII1l11l1l['cardid']=$this->_get('cardid');
$IIIII1l11l11=$IIIIIll1Il11->where($IIIII1l11l1l)->find();
$this->assign('cardInfo',$IIIII1l11l11);
$IIIIIl1I1l11=M('Member_card_set');
$IIIIIl1I11II=$IIIIIl1I1l11->where(array('token'=>$this->_get('token'),'id'=>intval($_GET['cardid'])))->find();
if (!$IIIIIl1I11II&&$IIIIIlIl1llI){
exit();
}
$IIIIIIIII111=D('Userinfo');
$IIIIIIIIIlIl=$IIIIIIIII111->where($IIIIIIIIIl11)->find();
if($IIIIIl1I11II['memberinfo']!=false){
$IIIIII1IllII=$IIIIIl1I11II['memberinfo'];
}else{
$IIIIII1IllII='tpl/Wap/default/common/images/userinfo/fans.jpg';
}
$this->assign('cardnum',$IIIII1l11l11['number']);
$this->assign('homepic',$IIIIII1IllII);
$this->assign('info',$IIIIIIIIIlIl);
$this->assign('cardid',$IIIIIlIl1llI);
if (isset($_GET['redirect'])){
$IIIII1l111II=explode('|',$_GET['redirect']);
$IIIII1l111Il=explode(',',$IIIII1l111II[1]);
$IIIII1l111I1=array('token'=>$IIIII1l11l1l['token'],'wecha_id'=>$IIIII1l11l1l['wecha_id']);
if ($IIIII1l111Il){
foreach ($IIIII1l111Il as $IIIII1l111lI){
$IIIII1l111ll=explode(':',$IIIII1l111lI);
$IIIII1l111I1[$IIIII1l111ll[0]]=$IIIII1l111ll[1];
}
}
$IIIII1l111l1=U($IIIII1l111II[0],$IIIII1l111I1);
$this->assign('redirectUrl',$IIIII1l111l1);
}
if(IS_POST){
$IIIIIIIIIl11['wechaname'] = $this->_post('wechaname');
$IIIIIIIIIl11['tel']       = $this->_post('tel');
if(M('Member_card_custom')->where(array('token'=>$this->IIIIIIIIlIlI))->getField('tel')){
if(empty($IIIIIIIIIl11['tel'])){
$this->error("手机号必填。");exit;
}
}
$IIIIIIIIIl11['truename']  = $this->_post('truename');
$IIIIIIIIIl11['qq']  = $this->_post('qq');
$IIIIIIIIIl11['sex'] = $this->_post('sex');
$IIIIIIIIIl11['bornyear'] = $this->_post('bornyear');
$IIIIIIIIIl11['bornmonth'] = $this->_post('bornmonth');
$IIIIIIIIIl11['bornday'] = $this->_post('bornday');
$IIIIIIIIIl11['portrait'] = $this->_post('portrait');
if($this->_post('paypass') != ''){
$IIIIIIIIIl11['paypass'] = md5($this->_post('paypass'));
}
if ($IIIIIlIl1llI==0){
$IIIII1I111II=array();
$IIIII1I111II['wecha_id']=$IIIIIIIIIl11['wecha_id'];
$IIIII1I111II['token']=$IIIIIIIIIl11['token'];
$IIIII1I111Il=M('Userinfo')->where($IIIII1I111II)->find();
if ($IIIII1I111Il){
M('Userinfo')->where($IIIII1I111II)->save($IIIIIIIIIl11);
}else {
M('Userinfo')->add($IIIIIIIIIl11);
}
S('fans_'.$this->IIIIIIIIlIlI.'_'.$this->IIIIIlIIIll1,NULL);
echo 1;exit;
}else {
if($IIIII1l11l11){
$IIIII1l1111I['wecha_id']=$IIIIIIIIIl11['wecha_id'];
$IIIII1l1111I['token']=$IIIIIIIIIl11['token'];
unset($IIIIIIIIIl11['wecha_id']);
unset($IIIIIIIIIl11['token']);
if(M('Userinfo')->where($IIIII1l1111I)->save($IIIIIIIIIl11)){
S('fans_'.$this->IIIIIIIIlIlI.'_'.$this->IIIIIlIIIll1,NULL);
echo 1;exit;
}else{
echo 0;exit;
}
}else{
Sms::sendSms($this->IIIIIIIIlIlI,'有新的会员领了会员卡');
$IIIIIll1Il11=M('Member_card_create')->field('id,number')->where("token='".$this->_get('token')."' and cardid=".intval($_POST['cardid'])." and wecha_id = ''")->order('id ASC')->find();
$IIIIII1ll1Il=M('Userinfo');
$IIIII1l1111l=$IIIIII1ll1Il->where(array('token'=>$this->_get('token'),'wecha_id'=>$this->_get('wecha_id')))->select();
$IIIII1l11111=0;
if ($IIIII1l1111l){
$IIIII1l11111=intval($IIIII1l1111l[0]['total_score']);
$IIIII1l1lIll=$IIIII1l1111l[0];
}
if(!$IIIIIll1Il11){
echo 3;exit;
}else {
if (intval($IIIIIl1I11II['miniscore'])==0||$IIIII1l11111>intval($IIIIIl1I11II['minscore'])){
M('Member_card_create')->where(array('token'=>$this->_get('token'),'wecha_id'=>$this->_get('wecha_id')))->delete();
$IIIII11IIIII=M('Member_card_create')->where(array('id'=>$IIIIIll1Il11['id']))->save(array('wecha_id'=>$this->_get('wecha_id')));
$IIIIIIIIIl11['getcardtime']=time();
if ($IIIIIIIIIlIl){
$IIIII1l1111I['wecha_id']=$IIIIIIIIIl11['wecha_id'];
$IIIII1l1111I['token']=$IIIIIIIIIl11['token'];
M('Userinfo')->where($IIIII1l1111I)->save($IIIIIIIIIl11);
}else {
M('Userinfo')->data($IIIIIIIIIl11)->add();
}
S('fans_'.$this->IIIIIIIIlIlI.'_'.$this->IIIIIlIIIll1,NULL);
echo 2;exit;
}else {
echo 4;exit;
}
}
}
}
}else {
$this->display();
}
}
}
?>