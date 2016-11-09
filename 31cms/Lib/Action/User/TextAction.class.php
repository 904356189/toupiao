<?php

class TextAction extends UserAction{
public function index(){
$IIIIIIIlIII1=D('Text');
$IIIIIIIIlIl1['uid']=session('uid');
$IIIIIIIIlIl1['token']=session('token');
$IIIIIIIII1ll=$IIIIIIIlIII1->where($IIIIIIIIlIl1)->count();
$IIIIIIIII11I=new Page($IIIIIIIII1ll,25);
$IIIIIIIIIlll=$IIIIIIIlIII1->where($IIIIIIIIlIl1)->limit($IIIIIIIII11I->firstRow.','.$IIIIIIIII11I->listRows)->select();
$this->assign('page',$IIIIIIIII11I->show());
$this->assign('info',$IIIIIIIIIlll);
$this->display();
}
public function add(){
$this->display();
}
public function edit(){
$IIIIIIIIlIl1['id']=$this->_get('id','intval');
$IIIIIIIIlIl1['uid']=session('uid');
$IIIIIIIIlIl1['token']=session('token');
$IIIIIII11l11=D('Text')->where($IIIIIIIIlIl1)->find();
$this->assign('info',$IIIIIII11l11);
$this->display();
}
public function del(){
$IIIIIIIIlIl1['id']=$this->_get('id','intval');
$IIIIIIIIlIl1['uid']=session('uid');
if(D(MODULE_NAME)->where($IIIIIIIIlIl1)->delete()){
M('Keyword')->where(array('pid'=>$this->_get('id','intval'),'token'=>session('token'),'module'=>'Text'))->delete();
$this->success('操作成功',U(MODULE_NAME.'/index'));
}else{
$this->error('操作失败',U(MODULE_NAME.'/index'));
}
}
public function insert(){
$this->all_insert();
}
public function upsave(){
$this->all_save();
}
public function clearKeywrods(){
$IIIIIIl11ll1=M('Keyword');
$IIIIIIIII1ll=$IIIIIIl11ll1->count();
$IIIIII1IlllI=$IIIIIIl11ll1->select();
$IIIIIIIllI11=intval($_GET['i']);
$IIIIIII1l1ll=5;
if ($IIIIIIIllI11<$IIIIIIIII1ll){
for ($IIIIIII11III=0;$IIIIIII11III<$IIIIIII1l1ll;$IIIIIII11III++){
$IIIIIII1l111=$IIIIIIIllI11+$IIIIIII11III;
if ($IIIIII1IlllI[$IIIIIII1l111]){
$IIIIIlIllllI=M($IIIIII1IlllI[$IIIIIII1l111]['module']);
if (!$IIIIIlIllllI->where(array('id'=>$IIIIII1IlllI[$IIIIIII1l111]['pid']))->find()){
$IIIIIIl11ll1->where(array('id'=>$IIIIII1IlllI[$IIIIIII1l111]['id']))->save(array('keyword'=>''));
}
}
}
$IIIIIlIlllll=$IIIIIIIllI11+$IIIIIII1l1ll;
$this->success('正在刷新关键词 '.$IIIIIIIllI11.'/'.$IIIIIIIII1ll,'/index.php?g=User&m=Text&a=clearKeywrods&i='.$IIIIIlIlllll);
}else {
exit('操作成功了');
}
}
}
?>