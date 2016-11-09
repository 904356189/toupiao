<?php

class InvitesAction extends BaseAction{
public $IIIIIII1I1II;
public function _initialize() {
parent::_initialize();
$this->IIIIIII1I1II=C('baidu_map_api');
$this->assign('apikey',$this->IIIIIII1I1II);
$IIIIIIIIlIl1['token']=$this->IIIIIIIIlIlI;
$IIIII1Illl11=M('Kefu')->where($IIIIIIIIlIl1)->find();
$this->assign('kefu',$IIIII1Illl11);
}
public function index(){
$IIIIIIIIlIlI	  =  $this->_get('token');
$IIIIIIIII1I1 	  = $this->_get('id');
$IIIIII1I11I1 = M('Invites')->where(array('id'=>$IIIIIIIII1I1,'token'=>$IIIIIIIIlIlI))->find();
$this->assign('Invites',$IIIIII1I11I1);
$this->assign('token',$IIIIIIIIlIlI);
$this->assign('id',$IIIIIIIII1I1);
if($IIIIII1I11I1['type'] =='1'){
$this->display('./tpl/Wap/default/Invites_index.html','utf-8','text/html');
}else{
$this->display('./tpl/Wap/default/Invites_index2.html','utf-8','text/html');
}
}
public function add(){
if($_POST['action'] =='add'){
$IIIIIIIIIl11=array();
$IIIIIIIIIl11['iid'] 		= $this->_post('id');
$IIIIIIIIIl11['token'] 		= $this->_post('token');
$IIIIIIIIIl11['username'] = $this->_post('username');
$IIIIIIIIIl11['telphone'] = $this->_post('telphone');
$IIIIIIIIIl11['content'] = $this->_post('content');
$IIIIIIIIIl11['rdo_go'] = $this->_post('rdo_go');
$IIIIIIIIIl11['type'] = $this->_post('type');
$IIIIIlIII11I=M('Invites_info')->add($IIIIIIIIIl11);
echo'提交成功';
exit;
}else{
echo'提交失败';
}
}
}
?>