<?php

class Token_openAction extends UserAction{
public function add(){
if ($this->IIIIIIIIl1ll){
$IIIIIIIllllI=M('Agent_function')->where(array('id'=>intval($this->_get('id'))))->find();
}else {
$IIIIIIIllllI=M('Function')->where(array('id'=>intval($this->_get('id'))))->find();
}
$IIIIIlIll1l1=array('uid'=>session('uid'),'token'=>session('token'));
$IIIIIlIll11I=array();
$IIIIIlIll11I['uid']=array('neq',session('uid'));
$IIIIIlIll11I['token']=session('token');
M('Token_open')->where($IIIIIlIll11I)->add();
$IIIIIIlIlI1l=M('Token_open')->where($IIIIIlIll1l1)->find();
$IIIIIII1IlII['queryname']=str_replace(',,',',',$IIIIIIlIlI1l['queryname'].','.$IIIIIIIllllI['funname']);
if (!$IIIIIIlIlI1l){
M('Token_open')->add(array('uid'=>session('uid'),'token'=>session('token')));
}
$IIIIIIIlIIIl=M('Token_open')->where($IIIIIlIll1l1)->save($IIIIIII1IlII);
if($IIIIIIIlIIIl){
echo 1;
}else{
echo 2;
}
}
public function del(){
if ($this->IIIIIIIIl1ll){
$IIIIIIIllllI=M('Agent_function')->where(array('id'=>$this->_get('id')))->find();
}else {
$IIIIIIIllllI=M('Function')->where(array('id'=>$this->_get('id')))->find();
}
$IIIIIlIll1l1=array('uid'=>session('uid'),'token'=>session('token'));
$IIIIIIlIlI1l=M('Token_open')->where($IIIIIlIll1l1)->find();
$IIIIIlIll11I=array();
$IIIIIlIll11I['uid']=array('neq',session('uid'));
$IIIIIlIll11I['token']=session('token');
M('Token_open')->where($IIIIIlIll11I)->delete();
$IIIIIII1IlII['queryname']=ltrim(str_replace(',,',',',str_replace($IIIIIIIllllI['funname'],'',$IIIIIIlIlI1l['queryname'])),',');
$IIIIIIIlIIIl=M('Token_open')->where($IIIIIlIll1l1)->save($IIIIIII1IlII);
if($IIIIIIIlIIIl){
echo 1;
}else{
echo 2;
}
}
public function checkAll(){
$IIIIIlIl1III = $_POST['stat'];
$IIIIIIIIlIlI = $_GET['token'];
$IIIIII1I1Ill = session('gid');
if($IIIIIlIl1III == 'true'){
$IIIIIIl111II = M('Function')->where("1 = 1")->select();
foreach($IIIIIIl111II as $IIIIIIIlI11I=>$IIIIIIlll11l){
$IIIIII1I1Il1.=$IIIIIIlll11l['funname'].',';
}
$IIIIIIlIlI1l['queryname']=rtrim($IIIIII1I1Il1,',');
M('Token_open')->where(array('token'=>$IIIIIIIIlIlI))->setField('queryname',$IIIIIIlIlI1l['queryname']);
}else{
$IIIIII1I1Il1 = '';
M('Token_open')->where(array('token'=>$IIIIIIIIlIlI))->setField('queryname',$IIIIII1I1Il1);
}
echo 1;
}
}
?>