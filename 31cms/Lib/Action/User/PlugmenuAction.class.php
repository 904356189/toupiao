<?php

class PlugmenuAction extends UserAction{
public function set(){
$IIIIII1IIII1=M('Home')->where(array('token'=>session('token')))->find();
if(IS_POST){
if($IIIIII1IIII1==false){
$this->all_insert('Home','/set');
}else{
$_POST['id']=$IIIIII1IIII1['id'];
$this->all_save('Home','/set');
}
}else{
$this->assign('home',$IIIIII1IIII1);
$this->display();
}
}
}
?>