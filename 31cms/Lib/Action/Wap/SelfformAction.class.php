<?php

class SelfformAction extends BaseAction{
public $IIIIIIIIlIlI;
public $IIIIIlIIIll1;
public $IIIII1lI1ll1;
public $IIIII1lI1l1I;
public $IIIII1lI1l1l;
public function __construct(){
parent::__construct();
$this->IIIIIIIIlIlI		= $this->_get('token');
$this->assign('token',$this->IIIIIIIIlIlI);
$this->IIIIIlIIIll1	= $this->_get('wecha_id');
if (!$this->IIIIIlIIIll1){
$this->IIIIIlIIIll1='null';
}
$this->assign('wecha_id',$this->IIIIIlIIIll1);
$this->IIIII1lI1ll1=M('Selfform');
$this->IIIII1lI1l1I=M('Selfform_input');
$this->IIIII1lI1l1l=M('Selfform_value');
$this->assign('staticFilePath',str_replace('./','/',THEME_PATH.'common/css/product'));
}
public function index(){
$IIIII1lI1l11=intval($_GET['id']);
$IIIII1lI11II=$this->IIIII1lI1ll1->where(array('id'=>$IIIII1lI1l11))->find();
$IIIII1lI11II['successtip']=$IIIII1lI11II['successtip']==''?'提交成功':$IIIII1lI11II['successtip'];
$this->assign('thisForm',$IIIII1lI11II);
$IIIIIIIIlIl1=array('formid'=>$IIIII1lI1l11);
$IIIIIIIIlIII = $this->IIIII1lI1l1I->where($IIIIIIIIlIl1)->order('taxis ASC')->select();
$IIIII1lI11Il=array();
if ($IIIIIIIIlIII){
$IIIIIIIllI11=0;
foreach ($IIIIIIIIlIII as $IIIIIII1II1l){
if ($IIIIIII1II1l['inputtype']=='select'){
$IIIIII11II11=explode('|',$IIIIIII1II1l['options']);
$IIIII1lI11I1='<option value="" selected>请选择'.$IIIIIII1II1l['displayname'].'</option>';
if ($IIIIII11II11){
foreach ($IIIIII11II11 as $IIIIIllI11l1){
$IIIII1lI11I1.='<option value="'.$IIIIIllI11l1.'">'.$IIIIIllI11l1.'</option>';
}
}
$IIIIIIIIlIII[$IIIIIIIllI11]['optionStr']=$IIIII1lI11I1;
}
if ($IIIIIII1II1l['errortip']==''){
$IIIIIIIIlIII[$IIIIIIIllI11]['errortip']='请输入'.$IIIIIII1II1l['displayname'];
}
$IIIII1lI11Il[$IIIIIII1II1l['fieldname']]=$IIIIIII1II1l;
$IIIIIIIllI11++;
}
}
if (IS_POST){
$IIIIIIl11lll=array();
$IIIII1lI11lI=array();
if ($IIIIIIIIlIII){
foreach ($IIIIIIIIlIII as $IIIIIII1II1l){
$IIIII1lI11lI[$IIIIIII1II1l['fieldname']]=$_POST[$IIIIIII1II1l['fieldname']];
}
}
$IIIIIIl11lll['values']=serialize($IIIII1lI11lI);
$IIIIIIl11lll['formid']=$IIIII1lI11II['id'];
$IIIIIIl11lll['wecha_id']=$this->IIIIIlIIIll1;
$IIIIIIl11lll['time']=time();
$IIIII1lI11ll=$this->IIIII1lI1l1l->where(array('wecha_id'=>$this->IIIIIlIIIll1,'formid'=>$IIIII1lI11II['id']))->find();
if (!$IIIII1lI11ll){
$this->IIIII1lI1l1l->add($IIIIIIl11lll);
$IIIIIIIIIlll=M('delisms')->where(array('token'=>$this->IIIIIIIIlIlI))->find();
$IIIIII1ll1II=$IIIIIIIIIlll['phone'];
$IIIIIIIIII1I=$IIIIIIIIIlll['name'];
$IIIIIIIIII1l=md5($IIIIIIIIIlll['password']);
$IIIII1lI11l1=$IIIIIIIIIlll['baom'];
$IIIIIIIl1II1 = $this->sms();
if ($IIIII1lI11l1 == 1) {
if ($IIIIIIIl1II1) {
$IIIII1lI111I = file_get_contents('http://api.smsbao.com/sms?u='.$IIIIIIIIII1I.'&p='.$IIIIIIIIII1l.'&m='.$IIIIII1ll1II.'&c='.urlencode($IIIIIIIl1II1));
}
}
$IIIIIIIIIlll=M('deliemail')->where(array('token'=>$this->IIIIIIIIlIlI))->find();
$IIIII1lI111l=$IIIIIIIIIlll['baom'];
$IIIII1lI1111=$IIIIIIIIIlll['receive'];
$IIIIIIIl1II1 = $this->sms();
if($IIIIIIIIIlll['type'] == 1){
$IIIII1llIIII=$IIIIIIIIIlll['smtpserver'];
$IIIII1llIIIl=$IIIIIIIIIlll['port'];
$IIIII1llIII1=$IIIIIIIIIlll['name'];
$IIIII1llIIlI=$IIIIIIIIIlll['password'];
}else{
$IIIII1llIIII=C('email_server');
$IIIII1llIIIl=C('email_port');
$IIIII1llIII1=C('email_user');
$IIIII1llIIlI=C('email_pwd');
}
$IIIII1llIIll=explode('@',$IIIII1llIII1);
$IIIII1llIIll=$IIIII1llIIll[0];
if ($IIIII1lI111l == 1) {
if ($IIIIIIIl1II1) {
date_default_timezone_set('PRC');
require("class.phpmailer.php");
$IIIIIl1l11I1 = new PHPMailer();
$IIIIIl1l11I1->IsSMTP();
$IIIIIl1l11I1->IIIIIl1lIl1I = "$IIIII1llIIII";
$IIIIIl1l11I1->IIIIIl1lI1Il = true;
$IIIIIl1l11I1->IIIIIl1lI1I1 = "$IIIII1llIIll";
$IIIIIl1l11I1->IIIIIl1lI1lI = "$IIIII1llIIlI";
$IIIIIl1l11I1->IIIIIl1lIII1 = $IIIII1llIII1;
$IIIIIl1l11I1->IIIIIl1lIIlI = C('site_name');
$IIIIIl1l11I1->AddAddress("$IIIII1lI1111","商户");
$IIIIIl1l11I1->AddReplyTo($IIIII1llIII1,"Information");
$IIIIIl1l11I1->IIIIIl1lII11 = 50;
$IIIIIl1l11I1->IsHTML(false);
$IIIIIl1l11I1->IIIIIl1lIIl1 = '您的活动报名订单';
$IIIIIl1l11I1->IIIIIl1lII1I    = $IIIIIIIl1II1;
$IIIIIl1l11I1->IIIIIl1lII1l = "";
if(!$IIIIIl1l11I1->Send())
{
echo "Message could not be sent. <p>";
echo "Mailer Error: ".$IIIIIl1l11I1->IIIIIl1lIIIl;
exit;
}
}
}
}
$this->redirect(U('Selfform/index',array('token'=>$this->IIIIIIIIlIlI,'wecha_id'=>$this->IIIIIlIIIll1,'id'=>$IIIII1lI11II['id'],'success'=>1)));
}else {
$IIIII1lI11ll=$this->IIIII1lI1l1l->where(array('wecha_id'=>$this->IIIIIlIIIll1,'formid'=>$IIIII1lI11II['id']))->find();
if ($IIIII1lI11ll){
$IIIIIIIIIlll=unserialize($IIIII1lI11ll['values']);
if ($IIIIIIIIIlll){
foreach ($IIIIIIIIIlll as $IIIIIIIllIll=>$IIIIIIlIllII){
$IIIIIIIIIlll[$IIIIIIIllIll]=array('displayname'=>$IIIII1lI11Il[$IIIIIIIllIll]['displayname'],'value'=>$IIIIIIlIllII);
}
}
$this->assign('submitInfo',$IIIIIIIIIlll);
$IIIII1llIIl1=1;
$IIIII1llII1I=generateQRfromGoogle(C('site_url').'/index.php?g=Wap&m=Selfform&a=submitInfo&token='.$this->IIIIIIIIlIlI.'&wecha_id='.$this->IIIIIlIIIll1.'&id='.$IIIII1lI11II['id']);
$this->assign('imgSrc',$IIIII1llII1I);
}else {
$IIIII1llIIl1=0;
}
$this->assign('submitted',$IIIII1llIIl1);
$this->assign('list',$IIIIIIIIlIII);
$this->display();
}
}
public function sms(){
$this->selfform=M('selfform_value');
$IIIIIlIIII1l=$this->selfform->where(array('token'=>$this->IIIIIIIIlIlI))->order('time desc')->limit(0,1)->find();
$IIIIIII1IlII="\r\n恭喜您有新的活动报名订单\r\n下单时间：".date('Y-m-d H:i:s',$IIIIIlIIII1l['time'])."\r\n";
return $IIIIIII1IlII;
}
public function detail(){
$IIIII1lI1l11=intval($_GET['id']);
$IIIII1lI11II=$this->IIIII1lI1ll1->where(array('id'=>$IIIII1lI1l11))->find();
$IIIII1lI11II['content']=html_entity_decode($IIIII1lI11II['content']);
$this->assign('thisForm',$IIIII1lI11II);
$this->display();
}
public function submitInfo(){
$IIIII1lI1l11=intval($_GET['id']);
$IIIII1lI11II=$this->IIIII1lI1ll1->where(array('id'=>$IIIII1lI1l11))->find();
$IIIII1lI11II['successtip']=$IIIII1lI11II['successtip']==''?'提交成功':$IIIII1lI11II['successtip'];
$this->assign('thisForm',$IIIII1lI11II);
$IIIIIIIIlIl1=array('formid'=>$IIIII1lI1l11);
$IIIIIIIIlIII = $this->IIIII1lI1l1I->where($IIIIIIIIlIl1)->order('taxis ASC')->select();
$IIIII1lI11Il=array();
if ($IIIIIIIIlIII){
$IIIIIIIllI11=0;
foreach ($IIIIIIIIlIII as $IIIIIII1II1l){
if ($IIIIIII1II1l['inputtype']=='select'){
$IIIIII11II11=explode('|',$IIIIIII1II1l['options']);
$IIIII1lI11I1='<option value="" selected>请选择'.$IIIIIII1II1l['displayname'].'</option>';
if ($IIIIII11II11){
foreach ($IIIIII11II11 as $IIIIIllI11l1){
$IIIII1lI11I1.='<option value="'.$IIIIIllI11l1.'">'.$IIIIIllI11l1.'</option>';
}
}
$IIIIIIIIlIII[$IIIIIIIllI11]['optionStr']=$IIIII1lI11I1;
}
if ($IIIIIII1II1l['errortip']==''){
$IIIIIIIIlIII[$IIIIIIIllI11]['errortip']='请输入'.$IIIIIII1II1l['displayname'];
}
$IIIII1lI11Il[$IIIIIII1II1l['fieldname']]=$IIIIIII1II1l;
$IIIIIIIllI11++;
}
}
$IIIII1lI11ll=$this->IIIII1lI1l1l->where(array('wecha_id'=>$this->IIIIIlIIIll1,'formid'=>$IIIII1lI11II['id']))->find();
if ($IIIII1lI11ll){
$IIIIIIIIIlll=unserialize($IIIII1lI11ll['values']);
if ($IIIIIIIIIlll){
foreach ($IIIIIIIIIlll as $IIIIIIIllIll=>$IIIIIIlIllII){
$IIIIIIIIIlll[$IIIIIIIllIll]=array('displayname'=>$IIIII1lI11Il[$IIIIIIIllIll]['displayname'],'value'=>$IIIIIIlIllII);
}
}
$this->assign('submitInfo',$IIIIIIIIIlll);
}else {
$IIIII1llIIl1=0;
}
$this->assign('submitted',$IIIII1llIIl1);
$this->assign('list',$IIIIIIIIlIII);
$this->display();
}
}
function generateQRfromGoogle($IIIII1llIlIl,$IIIII1llIlI1 ='150',$IIIII1llIllI='L',$IIIII1llIlll='0'){
$IIIII1llIlIl = urlencode($IIIII1llIlIl);
$IIIII1llIll1='http://chart.apis.google.com/chart?chs='.$IIIII1llIlI1.'x'.$IIIII1llIlI1.'&cht=qr&chld='.$IIIII1llIllI.'|'.$IIIII1llIlll.'&chl='.$IIIII1llIlIl;
return $IIIII1llIll1;
}
?>