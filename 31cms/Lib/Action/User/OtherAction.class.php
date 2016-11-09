<?php

class OtherAction extends UserAction{
public function index(){
$IIIIII1l11I1=M('Other')->where(array('token'=>session('token')))->find();
if(IS_POST){
if($IIIIII1l11I1==false){
$this->all_insert('Other','/index');
}else{
$_POST['id']=$IIIIII1l11I1['id'];
$this->all_save('Other','/index');
}
}else{
$this->assign('other',$IIIIII1l11I1);
$this->display();
}
}
}
?>