<?php

class Cosmetology_setupAction extends BaseAction{
public function content(){
$IIIII1Ill1II = $_SERVER['HTTP_USER_AGENT'];
if(!strpos($IIIII1Ill1II,"MicroMessenger")&&!isset($_SESSION['token'])) {
echo '此功能只能在微信浏览器中使用';exit;
}
$IIIIIIIIlIl1['token']= $this->_get('token');
$IIIIIIlll111=M('Cosmetology_setup')->where($IIIIIIIIlIl1)->find();
$IIIII1Ill1I1=M('Cosmetology_setup_control')->where($IIIIIIIIlIl1)->find();
$IIIII1Ill1Il=M('Cosmetology')->where(array('token'=>$this->_GET('token')))->find();
$IIIII1Ill1lI=M('Cosmetology_departments')->where(array('token'=>$this->_GET('token')))->find();
$IIIIIIIII1I1=M('Cosmetology_departments')->where(array('token'=>$this->_GET('token')))->order('id desc')->select();
$this->assign('ks',$IIIII1Ill1lI);
$this->assign('id',$IIIIIIIII1I1);
$this->assign('pd',$IIIII1Ill1I1);
$this->assign('pt',$IIIII1Ill1Il);
$this->assign('set',$IIIIIIlll111);
$this->display();
}
public function orders(){
$IIIII1Ill1II = $_SERVER['HTTP_USER_AGENT'];
if(!strpos($IIIII1Ill1II,"MicroMessenger")&&!isset($_SESSION['token'])) {
echo '此功能只能在微信浏览器中使用';exit;
}
$IIIIIIIIlIl1['token']= $this->_get('token');
$IIIIIIlll111=M('Cosmetology_setup')->where($IIIIIIIIlIl1)->find();
$IIIII1Ill1I1=M('Cosmetology_setup_control')->where($IIIIIIIIlIl1)->find();
$IIIII1Ill1l1=M('Cosmetology_setup')->where(array('token'=>$this->_GET('token'),'wecha_id'=>$this->_GET('wecha_id')))->find();
$IIIII1Ill1Il=M('Cosmetology')->where(array('token'=>$this->_GET('token')))->find();
$IIIII1Ill1lI=M('Cosmetology_departments')->where(array('token'=>$this->_GET('token')))->find();
$IIIIIIIII1I1=M('Cosmetology_departments')->where(array('token'=>$this->_GET('token')))->order('id desc')->select();
$this->assign('ckdd',$IIIII1Ill1l1);
$this->assign('ks',$IIIII1Ill1lI);
$this->assign('id',$IIIIIIIII1I1);
$this->assign('pd',$IIIII1Ill1I1);
$this->assign('pt',$IIIII1Ill1Il);
$this->assign('set',$IIIIIIlll111);
$this->display();
}
public function book(){
if($_POST['action'] == 'book'){
$IIIIIIIIIl11['token']  =  $this->_get('token');
$IIIIIIIIIl11['wecha_id']  =  $this->_get('wecha_id');
$IIIIIIIIIl11['name']  =  $this->_post('name');
$IIIIIIIIIl11['sex']  =  $this->_post('sex');
$IIIIIIIIIl11['age']  =  $this->_post('age');
$IIIIIIIIIl11['phone']  =  $this->_post('phone');
$IIIIIIIIIl11['scheduled_date']  =  $this->_post('scheduled_date');
$IIIIIIIIIl11['address']  =  $this->_post('address');
$IIIIIIIIIl11['departments']  =  $this->_post('departments');
$IIIIIIIIIl11['expert']  =  $this->_post('expert');
$IIIIIIIIIl11['disease']  =  $this->_post('disease');
$IIIIIIIIIl11['process']  =  "未处理";
$IIIIIIIII1ll = M('Cosmetology_setup')->where(array('token'=>$IIIIIIIIIl11['token'],'wecha_id'=>$IIIIIIIIIl11['wecha_id'],'status'=>0))->count();
if ($IIIIIIIII1ll<1) $IIIIIIIIl1Il = M('Cosmetology_setup')->data($IIIIIIIIIl11)->add();
if($IIIIIIIIl1Il){
echo "下单成功";
}else{
echo "您已经下过此单";
}
}
}
}
?>