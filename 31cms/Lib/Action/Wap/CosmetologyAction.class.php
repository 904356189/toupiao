<?php

class CosmetologyAction extends BaseAction{
public function _initialize(){
parent::_initialize();
$IIIIIIIIlIl1['token']=$this->IIIIIIIIlIlI;
$IIIII1Illl11=M('Kefu')->where($IIIIIIIIlIl1)->find();
$this->assign('kefu',$IIIII1Illl11);
}
public function index(){
$IIIII1Ill1II = $_SERVER['HTTP_USER_AGENT'];
if(!strpos($IIIII1Ill1II,"MicroMessenger")&&!isset($_SESSION['token'])) {
echo '此功能只能在微信浏览器中使用';exit;
}
$IIIII1Ill1Il=M('Cosmetology')->where(array('token'=>$this->_GET('token')))->find();
$this->assign('pt',$IIIII1Ill1Il);
$this->display();
}
}
?>