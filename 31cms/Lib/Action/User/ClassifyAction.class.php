<?php

class ClassifyAction extends UserAction{
public $IIIIIIl1I1I1;
public function _initialize() {
parent::_initialize();
$this->IIIIIIl1I1I1=intval($_GET['fid']);
$this->assign('fid',$this->IIIIIIl1I1I1);
if ($this->IIIIIIl1I1I1){
$IIIIIIl1lI1l=M('Classify')->find($this->IIIIIIl1I1I1);
$this->assign('thisClassify',$IIIIIIl1lI1l);
}
}
public function index(){
$IIIIIIIlIII1=D('Classify');
$IIIIIIIIlIl1['token']=session('token');
$IIIIIIIIlIl1['fid']=intval($_GET['fid']);
$IIIIIIIII1ll=$IIIIIIIlIII1->where($IIIIIIIIlIl1)->count();
$IIIIIIIII11I=new Page($IIIIIIIII1ll,25);
$IIIIIIIIIlll=$IIIIIIIlIII1->where($IIIIIIIIlIl1)->order('sorts desc')->limit($IIIIIIIII11I->firstRow.','.$IIIIIIIII11I->listRows)->select();
$this->assign('page',$IIIIIIIII11I->show());
$this->assign('info',$IIIIIIIIIlll);
$this->display();
}
public function add(){
include('./iMicms/Lib/ORG/index.Tpl.php');
include('./iMicms/Lib/ORG/cont.Tpl.php');
$this->assign('tpl',$IIIIIIl1lI11);
$this->assign('contTpl',$IIIIIIl1llII);
$this->display();
}
public function edit(){
$IIIIIIIII1I1=$this->_get('id','intval');
$IIIIIIIIIlll=M('Classify')->find($IIIIIIIII1I1);
include('./iMicms/Lib/ORG/index.Tpl.php');
include('./iMicms/Lib/ORG/cont.Tpl.php');
foreach($IIIIIIl1lI11 as $IIIIIIIllIll=>$IIIIIIlIllII){
if($IIIIIIlIllII['tpltypeid'] == $IIIIIIIIIlll['tpid']){
$IIIIIIIIIlll['tplview'] = $IIIIIIlIllII['tplview'];
}
}
foreach($IIIIIIl1llII as $IIIIIIIlI11I=>$IIIIIIl1llIl){
if($IIIIIIl1llIl['tpltypeid'] == $IIIIIIIIIlll['conttpid']){
$IIIIIIIIIlll['tplview2'] = $IIIIIIl1llIl['tplview'];
}
}
$this->assign('contTpl',$IIIIIIl1llII);
$this->assign('tpl',$IIIIIIl1lI11);
$this->assign('info',$IIIIIIIIIlll);
$this->display();
}
public function del(){
$IIIIIIIIlIl1['id']=$this->_get('id','intval');
$IIIIIIIIlIl1['uid']=session('uid');
if(D(MODULE_NAME)->where($IIIIIIIIlIl1)->delete()){
$IIIIIIl1I1l1['fid']=intval($IIIIIIIIlIl1['id']);
D(MODULE_NAME)->where($IIIIIIl1I1l1)->delete();
$this->success('操作成功',U(MODULE_NAME.'/index',array('fid'=>$_GET['fid'])));
}else{
$this->error('操作失败',U(MODULE_NAME.'/index',array('fid'=>$_GET['fid'])));
}
}
public function insert(){
$IIIIIIIlIIII='Classify';
$IIIIIIIlIII1=D($IIIIIIIlIIII);
$IIIIIIl1I1I1 = $this->_post('fid','intval');
$_POST['info'] = str_replace('&quot;','',$_POST['info']);
if($IIIIIIl1I1I1 != ''){
$IIIIIIIl1111 = $IIIIIIIlIII1->field('path')->where("id = $IIIIIIl1I1I1")->find();
$_POST['path'] = $IIIIIIIl1111['path'].'-'.$IIIIIIl1I1I1;
}
if($IIIIIIIlIII1->create()===false){
$this->error($IIIIIIIlIII1->getError());
}else{
$IIIIIIIII1I1=$IIIIIIIlIII1->add();
if($IIIIIIIII1I1){
$this->success('操作成功',U(MODULE_NAME.'/index',array('fid'=>$_POST['fid'])));
}else{
$this->error('操作失败',U(MODULE_NAME.'/index',array('fid'=>$_POST['fid'])));
}
}
}
public function upsave(){
$_POST['info'] = str_replace('&quot;','',$_POST['info']);
$IIIIIIl1I1I1 = $this->_post('fid','intval');
if($IIIIIIl1I1I1 == ''){
$this->all_save();
}else{
$this->all_save('','/index?fid='.$IIIIIIl1I1I1);
}
}
public function chooseTpl(){
include('./iMicms/Lib/ORG/index.Tpl.php');
include('./iMicms/Lib/ORG/cont.Tpl.php');
$IIIIIIl1lI11 = array_reverse($IIIIIIl1lI11);
$IIIIIIl1llII = array_reverse($IIIIIIl1llII);
$IIIIIIl1lIl1 = $this->_get('tpid','intval');
foreach($IIIIIIl1lI11 as $IIIIIIIllIll=>$IIIIIIlIllII){
$IIIIIIl1llll[$IIIIIIIllIll] = $IIIIIIlIllII['sort'];
$IIIIIIl1lll1[$IIIIIIIllIll] = $IIIIIIlIllII['tpltypeid'];
if($IIIIIIlIllII['tpltypeid'] == $IIIIIIl1lIl1){
$IIIIIIIIIlll['tplview'] = $IIIIIIlIllII['tplview'];
}
}
foreach($IIIIIIl1llII as $IIIIIIIlI11I=>$IIIIIIl1llIl){
if($IIIIIIl1llIl['tpltypeid'] == $IIIIIIl1lIl1){
$IIIIIIIIIlll['tplview2'] = $IIIIIIl1llIl['tplview'];
}
}
$this->assign('info',$IIIIIIIIIlll);
$this->assign('contTpl',$IIIIIIl1llII);
$this->assign('tpl',$IIIIIIl1lI11);
$this->display();
}
public function changeClassifyTpl(){
$IIIIIIl1ll11 = $this->_post('tid','intval');
$IIIIIIIll1ll = $this->_post('cid','intval');
M('Classify')->where(array('token'=>$this->IIIIIIIIlIlI,'id'=>$IIIIIIIll1ll))->setField('tpid',$IIIIIIl1ll11);
echo 200;
}
public function changeClassifyContTpl(){
$IIIIIIl1ll11 = $this->_post('tid','intval');
$IIIIIIIll1ll = $this->_post('cid','intval');
M('Classify')->where(array('token'=>$this->IIIIIIIIlIlI,'id'=>$IIIIIIIll1ll))->setField('conttpid',$IIIIIIl1ll11);
echo 200;
}
}
?>