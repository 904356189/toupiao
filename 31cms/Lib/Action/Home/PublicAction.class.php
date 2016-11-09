<?php

class PublicAction extends BaseAction{
public function footer(){
$IIIIIIIIlIl1['status']=1;
$IIIIIII11Ill=D('Links')->where($IIIIIIIIlIl1)->select();
$this->assign('links',$IIIIIII11Ill);
}
}?>