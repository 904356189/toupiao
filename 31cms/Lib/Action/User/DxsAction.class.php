<?php

class DxsAction extends UserAction{
public $IIIIIIIIlIlI;
public function _initialize() {
parent::_initialize();
$this->IIIIIIIIlIlI=session('token');
$this->assign('token',$this->IIIIIIIIlIlI);
}
public function index(){
$this->IIIIIlIIlI11=M('Dxsreply_info');
$IIIIIIl11llI = $this->IIIIIlIIlI11->where(array('token'=>$this->IIIIIIIIlIlI))->find();
if ($IIIIIIl11llI&&$IIIIIIl11llI['token']!=$this->IIIIIIIIlIlI){
exit();
}
if(IS_POST){
$IIIIIIl11lll['url']=strip_tags(htmlspecialchars_decode($_POST['url']));
$IIIIIIl11lll['title']=$this->_post('title');
$IIIIIIl11lll['info']=$this->_post('info');
$IIIIIIl11lll['picurl']=$this->_post('picurl');
$IIIIIIl11lll['picurls1']=$this->_post('picurls1');
$IIIIIIl11lll['token']=$this->_post('token');
$IIIIIIl11lll['bg']=$this->_post('bg');
$IIIIIIl11lll['wx']=$this->_post('wx');
$IIIIIIl11lll['zz']=$this->_post('zz');
if ($IIIIIIl11llI){
$IIIIIIIIlIl1=array('token'=>$this->IIIIIIIIlIlI);
$this->IIIIIlIIlI11->where($IIIIIIIIlIl1)->save($IIIIIIl11lll);
$IIIIIIl11ll1=M('Keyword');
$this->success('修改成功',U('Dxs/index',$IIIIIIIIlIl1));
}else {
$IIIIIIIIlIl1=array('token'=>$this->IIIIIIIIlIlI);
$this->IIIIIlIIlI11->add($IIIIIIl11lll);
$this->success('设置成功',U('Dxs/index',$IIIIIIIIlIl1));
}
}else{
$this->assign('set',$IIIIIIl11llI);
$this->display();
}
}
}
?>