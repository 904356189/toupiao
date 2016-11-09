<?php

class AuthAction extends UserAction
{
public function _initialize()
{
parent::_initialize();
}
public function index()
{
$IIIIIIIIIlll=M('Wxuser')->where(array('token'=>$this->IIIIIIIIlIlI))->find();
$this->assign('info',$IIIIIIIIIlll);
if (IS_POST) {
M('Wxuser')->where(array('token'=>$this->IIIIIIIIlIlI))->save(array('oauth'=>intval($_POST['oauth'])));
$this->success('设置成功');
}else {
$this->assign('tab','index');
$this->display();
}
}
public function advantage()
{
$this->assign('tab','advantage');
$this->display();
}
public function help()
{
$this->assign('tab','help');
$this->display();
}
}
?>