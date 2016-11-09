<?php

class ToshakeAction extends BaseAction{
public function index(){
$IIIII1Ill1II = $_SERVER['HTTP_USER_AGENT'];
if(!strpos($IIIII1Ill1II,"MicroMessenger")) {
}
$IIIIIIIIIl11=array();
$IIIIIIIIIl11['phone'] 		= $this->_get('phone');
$IIIIIIIIIl11['token'] 		= $this->_get('token');
$IIIIIIIIIl11['wecha_id'] = $this->_get('wecha_id');
$IIIII1l11lI1=M('Shake')->where(array('token'=>$IIIIIIIIIl11['token'],'isopen'=>array('neq',2)))->find();
if($IIIII1l11lI1==false){echo '<script>alert ("商家目前没有进行中的摇一摇活动")</script>';return;}
$IIIII1l11llI=M('Toshake')->where(array('wecha_id'=>$IIIIIIIIIl11['wecha_id']))->select();
if($IIIII1l11llI==false){M('Toshake')->add($IIIIIIIIIl11);}
$this->assign('info',$IIIIIIIIIl11);
$this->assign('ctime',$IIIII1l11lI1['clienttime']);
$this->assign('endshake',$IIIII1l11lI1['endshake']);
$this->assign('music',$IIIII1l11lI1['wapsound']);
$this->display();
}
public function repoint(){
$IIIIIIIIIl11=array();
$IIIIIIIIIl11['phone'] 		= $this->_post('phone');
$IIIIIIIIIl11['token'] 		= $this->_post('token');
$IIIIIIIIIl11['wecha_id'] = $this->_post('wecha_id');
$IIIIIIIIIl11['point'] = $this->_post('point');
$IIIII1l11llI=M('Shake')->where(array('token'=>$IIIIIIIIIl11['token'],'isact'=>'1','isopen'=>array('neq',2)))->select();
if($IIIII1l11llI==false){echo '1';return;}
$IIIIIIIIlIl1['wecha_id'] = $IIIIIIIIIl11['wecha_id'];
$IIIIIIIIlIl1['token'] = $IIIIIIIIIl11['token'];
$IIIII1l11ll1=M('Toshake')->where($IIIIIIIIlIl1)->save($IIIIIIIIIl11);
}
}
?>