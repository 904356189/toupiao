<?php
echo '﻿';
class FanyanAction extends WapAction{
public $IIIIIIIIlIlI;
public $IIIIIlIIIll1;
public $IIIII1Il11II;
public $IIIII1Il11Il;
public function __construct(){
parent::__construct();
$this->IIIIIIIIlIlI=session('token');
$this->assign('token',$this->IIIIIIIIlIlI);
$this->IIIIIlIIIll1	= $this->_get('wecha_id');
if (!$this->IIIIIlIIIll1){
$this->IIIIIlIIIll1='null';
}
$IIIIIIIIlIl1['token']=$this->IIIIIIIIlIlI;
$IIIII1Illl11=M('Kefu')->where($IIIIIIIIlIl1)->find();
$this->assign('kefu',$IIIII1Illl11);
$this->assign('wecha_id',$this->IIIIIlIIIll1);
$this->Fanyan_model=M('Fanyan');
}
public function index(){
$IIIIIIIIlllI = $this->_get('id');
$IIIIIlIIIll1 = $this->_get('wecha_id');
$IIIIIIIIIlll = M('Fanyan')->where(array('token'=>$this->_get('token')))->select();
$IIIIIIIII1ll=M('Fanyan')->where(array('token'=>$this->_get('token')))->count();
$IIIII1Il11I1=M('Fanyan_reply')->where(array('token'=>$this->_get('token')))->find();
$IIIII1Il11I1[url]=str_replace('{siteUrl}','',$IIIII1Il11I1[url]);
$IIIII1Il11I1[url]=str_replace('{wechat_id}',$IIIIIlIIIll1,$IIIII1Il11I1[url]);
$this->assign('copyright',$IIIII1Il11I1);$this->assign('copyright',$IIIII1Il11I1);
$this->assign('count',$IIIIIIIII1ll);
$this->assign('info',$IIIIIIIIIlll);
$this->display();
}
public function info(){
$IIIIIIIIll11 = M('Fanyan')->where(array('token'=>$this->_get('token'),'id'=>$this->_get('id')))->find();
$IIIIIIIIlllI = $this->_get('id');
$IIIIIIIIlIl1 = array('token'=>$this->_get('token'),'pid'=>$IIIIIIIIlllI);
$IIIII1Il11lI = array(
'token'=>$this->_get('token'),
'wecha_id'=>$this->_get('wecha_id')
);
$IIIIIIIIIlll = M('Fanyan_setcin')->where($IIIIIIIIlIl1)->select();
$IIIII1Il11I1=M('Fanyan_reply')->where(array('token'=>$this->_get('token')))->find();
$this->assign('copyright',$IIIII1Il11I1);
$this->assign('info',$IIIIIIIIIlll);
$this->assign('title',$IIIIIIIIll11);
$this->display();
}
}
?>