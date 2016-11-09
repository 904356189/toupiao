<?php

class AreplyAction extends UserAction{
public function index(){
$IIIIIIIlIII1=D('Areply');
$IIIIIIIIlIl1['uid']=$_SESSION['uid'];
$IIIIIIIIlIl1['token']=$_SESSION['token'];
$IIIIIII11l11=$IIIIIIIlIII1->where($IIIIIIIIlIl1)->find();
$IIIIIIIlI11I=M('keyword')->where(array('pid'=>$_SESSION['uid'],'token'=>$_SESSION['token'],'module'=>'gjz'))->select();
$this->assign('key',$IIIIIIIlI11I);
$this->assign('areply',$IIIIIII11l11);
$this->display();
}
public function insert(){
$IIIIIIIlIII1=D('Areply');
$IIIIIIIIlIl1['uid']=$_SESSION['uid'];
$IIIIIIIIlIl1['token']=$_SESSION['token'];
$IIIIIII11l11=$IIIIIIIlIII1->where($IIIIIIIIlIl1)->find();
if($IIIIIII11l11==false){
$IIIIIIIIlIl1['content']=html_entity_decode($this->_post('content'));
$IIIIIIIIlIl1['content2']=html_entity_decode($this->_post('content2'));
$IIIIIIIIlIl1['keyword']='';
if($IIIIIIIIlIl1['content']==false ||$IIIIIIIIlIl1['content2']==false){$this->error('内容必须填写');}
$IIIIIIIIlIl1['createtime']=time();
$IIIIIIIII1I1=$IIIIIIIlIII1->data($IIIIIIIIlIl1)->add();
if($IIIIIIIII1I1){
$this->success('保存成功',U('Vote/index'));
}else{
$this->error('保存失败',U('Areply/index'));
}
}else{
$IIIIIIIIlIl1['id']=$IIIIIII11l11['id'];
$IIIIIIIIlIl1['content']=html_entity_decode($this->_post('content'));
$IIIIIIIIlIl1['content2']=html_entity_decode($this->_post('content2'));
$IIIIIIIIlIl1['home']=intval($this->_post('home'));
$IIIIIIIIlIl1['updatetime']=time();
if(isset($_POST['keyword'])){
$IIIIIIIIlIl1['keyword']=$this->_post('keyword');
}
if($IIIIIIIlIII1->save($IIIIIIIIlIl1)){
$this->success('更新成功',U('Vote/index'));
}else{
$this->error('更新失败',U('Areply/index'));
}
}
}
public function inkeyword(){
if(IS_POST){
$IIIIIIIIIl11['keyword']=trim($_POST['keyword']);
$IIIIIIIlIII1=M('keyword');
$IIIIIIIIlIl1['pid']=$_SESSION['uid'];
$IIIIIIIIlIl1['token']=$_SESSION['token'];
$IIIIIIIIlIl1['keyword']=array('like','%'.$IIIIIIIIIl11['keyword'].'%');
$IIIIIII11l11=$IIIIIIIlIII1->where($IIIIIIIIlIl1)->find();
if($IIIIIII11l11==false){
$IIIIIIIIIl11['content']=html_entity_decode($this->_post('content'));
$IIIIIIIIIl11['module']='gjz';
$IIIIIIIIIl11['pid']=$_SESSION['uid'];
$IIIIIIIIIl11['token']=$_SESSION['token'];
$IIIIIIIII1I1=$IIIIIIIlIII1->add($IIIIIIIIIl11);
if($IIIIIIIII1I1){
$this->success('添加关键字成功',U('Areply/index'));
}else{
$this->error('添加关键字失败',U('Areply/index'));
}
}else{
$this->error('此关键字已经存在，请换一个关键字',U('Areply/index'));
}
}else{
$this->display();
}
}
public function edkeyword(){
if(IS_POST){
$IIIIIIIII1I1=$_POST['id'];
$IIIIIIIIIl11['keyword']=trim($_POST['keyword']);
$IIIIIIIlIII1=M('keyword');
$IIIIIIIIlIl1['pid']=$_SESSION['uid'];
$IIIIIIIIlIl1['token']=$_SESSION['token'];
$IIIIIIIIlIl1['keyword']=array('like','%'.$IIIIIIIIIl11['keyword'].'%');
$IIIIIII11l11=$IIIIIIIlIII1->where($IIIIIIIIlIl1)->find();
if($IIIIIII11l11['id']!=$IIIIIIIII1I1 &&$IIIIIIll1Il1 != NULL){
$this->error('此关键词已经存在，请换其它关键词！');
exit;
}
$IIIIIIIIIl11['content']=html_entity_decode($this->_post('content'));
$IIIIIIIIIl11['module']='gjz';
$IIIIIIIII1I1=$IIIIIIIlIII1->where(array('id'=>$IIIIIIIII1I1,'pid'=>$_SESSION['uid'],'token'=>$_SESSION['token']))->save($IIIIIIIIIl11);
if($IIIIIIIII1I1){
$this->success('修改成功',U('Areply/index'));
}else{
$this->error('修改失败',U('Areply/index'));
}
}else{
$IIIIIIIIlllI=$_GET['pid'];
$IIIIIIIII1I1=$_GET['id'];
$IIIIIIIIlIlI=$_GET['token'];
$IIIIIIIlI11I=M('keyword')->where(array('pid'=>$IIIIIIIIlllI,'id'=>$IIIIIIIII1I1,'token'=>$IIIIIIIIlIlI))->find();
$this->assign('key',$IIIIIIIlI11I);
$this->display();
}
}
public function delkeyword(){
$IIIIIIIIlllI=$_GET['pid'];
$IIIIIIIII1I1=$_GET['id'];
$IIIIIIIIlIlI=$_GET['token'];
if(M('keyword')->where(array('pid'=>$IIIIIIIIlllI,'id'=>$IIIIIIIII1I1,'token'=>$IIIIIIIIlIlI))->delete())
{
$this->success('删除关键字成功',U('Areply/index'));
}else{
$this->error('删除关键字失败',U('Areply/index'));
}
}
}
?>