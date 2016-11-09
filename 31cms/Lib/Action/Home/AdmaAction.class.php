<?php

class AdmaAction extends BaseAction{
public function show(){
if($this->_get('token')!=false){
$IIIIIIIlllI1=M('Adma')->where(array('token'=>$this->_get('token')))->find();
if($IIIIIIIlllI1==false){
$this->error('不在的宣传页',U('Home/Index/index'));
}else{
$this->assign('adma',$IIIIIIIlllI1);
}
}else{
$this->error('身份验证失败',U('Home/Index/index'));
}
$this->display();
}
}
?>