<?php

class OrderingAction extends UserAction{
public function index(){
$this->display();
}
public function add(){
if(IS_POST){
$this->error('功能内测中,您无内测资格！');
}else{
$this->display();
}
}
public function set(){
$IIIIII1l11II=M('Ordering_set')->where(array('token'=>session('token')))->find();
if(IS_POST){
if($IIIIII1l11II==false){
$this->all_insert('Ordering_set','/set');
}else{
$_POST['id']=$IIIIII1l11II['id'];
$this->all_save('Ordering_set','/set');
}
}else{
$this->assign('ordering',$IIIIII1l11II);
$this->display();
}
}
public function class_list(){
if(IS_POST){
$this->insert('Ordering_class','/class_list');
}else{
$IIIIIIIIIl11=M('Ordering_class');
$IIIIIIIII1ll      = $IIIIIIIIIl11->where(array('token'=>$_SESSION['token']))->count();
$IIIIIIll1lll       = new Page($IIIIIIIII1ll,12);
$IIIIIIIII11l       = $IIIIIIll1lll->show();
$IIIIIIIIlIII = $IIIIIIIIIl11->where(array('token'=>$_SESSION['token']))->limit($IIIIIIll1lll->firstRow.','.$IIIIIIll1lll->listRows)->order('sort desc')->select();
$this->assign('page',$IIIIIIIII11l);
$this->assign('list',$IIIIIIIIlIII);
$this->display();
}
}
public function class_edit(){
if($this->_get('token')!=session('token')){$this->error('非法操作');}
if(IS_POST){
$IIIIIIl111Il=M('Ordering_class')->field('id')->where(array('token'=>$_SESSION['token'],'id'=>$this->_post('id')))->find();
if($IIIIIIl111Il==false){$this->error('非法操作');}
$this->all_save('Ordering_class','/class_list');
}else{
$this->error('非法操作');
}
}
public function class_del(){
if($this->_get('token')!=session('token')){$this->error('非法操作');}
$IIIIIIl111Il=M('Ordering_class')->field('id')->where(array('token'=>$_SESSION['token'],'id'=>$this->_get('id')))->find();
if($IIIIIIl111Il==false){$this->error('服务器繁忙');}
if(M('Ordering_class')->where(array('id'=>$IIIIIIl111Il['id']))->delete()){
$this->success('操作成功');
}else{
$this->error('服务器繁忙,请稍后再试');
}
}
}
?>