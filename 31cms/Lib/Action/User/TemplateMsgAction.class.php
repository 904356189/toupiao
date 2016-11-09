<?php

class TemplateMsgAction extends UserAction{
public function __construct(){
parent::__construct();
}
public function index(){
if(IS_POST){
$IIIIIIIIIl11 = array();
$IIIIIIIIIl11['tempkey'] = $_REQUEST['tempkey'];
$IIIIIIIIIl11['name'] = $_REQUEST['name'];
$IIIIIIIIIl11['content'] = $_REQUEST['content'];
$IIIIIIIIIl11['topcolor'] = $_REQUEST['topcolor'];
$IIIIIIIIIl11['textcolor'] = $_REQUEST['textcolor'];
$IIIIIIIIIl11['status'] = $_REQUEST['status'];
$IIIIIIIIIl11['tempid'] = $_REQUEST['tempid'];
foreach ($IIIIIIIIIl11 as $IIIIIIIlI11I =>$IIIIIIl1llIl){
foreach ($IIIIIIl1llIl as $IIIIIIIllIll =>$IIIIIIlIllII){
$IIIIIIIIIlll[$IIIIIIIllIll][$IIIIIIIlI11I] = $IIIIIIlIllII;
}
}
foreach ($IIIIIIIIIlll as $IIIIIlIllIl1 =>$IIIIIlIllI1I){
if($IIIIIlIllI1I['tempid'] == ''){
$IIIIIIIIIlll[$IIIIIlIllIl1]['status'] = 0;
}
$IIIIIIIIIlll[$IIIIIlIllIl1]['token'] = session('token');
$IIIIIIIIlIl1 = array('token'=>session('token'),'tempkey'=>$IIIIIIIIIlll[$IIIIIlIllIl1]['tempkey']);
if(M('Tempmsg')->where($IIIIIIIIlIl1)->getField('id')){
M('Tempmsg')->where($IIIIIIIIlIl1)->save($IIIIIIIIIlll[$IIIIIlIllIl1]);
}else{
M('Tempmsg')->add($IIIIIIIIIlll[$IIIIIlIllIl1]);
}
}
$this->success('操作成功');
}else{
$IIIIIlIllI1l = new templateNews();
$IIIIIlIllI11 = $IIIIIlIllI1l->templates();
$IIIIIIIIlIII = M('Tempmsg')->where(array('token'=>session('token')))->select();
$IIIIIlII1l1I = array_keys($IIIIIIIIlIII);
$IIIIIIIllI11=count($IIIIIIIIlIII);
$IIIIIII11III = 0;
foreach ($IIIIIlIllI11 as $IIIIIIIllIll =>$IIIIIIlIllII){
$IIIIIlIlllIl = M('Tempmsg')->where(array('token'=>session('token'),'tempkey'=>$IIIIIIIllIll))->find();
if($IIIIIlIlllIl == ''){
$IIIIIIIIlIII[$IIIIIIIllI11]['tempkey'] = $IIIIIIIllIll;
$IIIIIIIIlIII[$IIIIIIIllI11]['name'] = $IIIIIIlIllII['name'];
$IIIIIIIIlIII[$IIIIIIIllI11]['content'] = $IIIIIIlIllII['content'];
$IIIIIIIIlIII[$IIIIIIIllI11]['topcolor'] = '#029700';
$IIIIIIIIlIII[$IIIIIIIllI11]['textcolor'] = '#000000';
$IIIIIIIIlIII[$IIIIIIIllI11]['status'] = 0;
$IIIIIIIllI11++;
}else{
$IIIIIIIIlIII[$IIIIIII11III]['name'] = $IIIIIIlIllII['name'];
$IIIIIIIIlIII[$IIIIIII11III]['content'] = $IIIIIIlIllII['content'];
$IIIIIII11III++;
}
}
$this->assign('list',$IIIIIIIIlIII);
$this->display();
}
}
}?>