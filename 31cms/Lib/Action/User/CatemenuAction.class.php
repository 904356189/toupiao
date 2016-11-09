<?php

class CatemenuAction extends UserAction {
public $IIIIIIl1I1I1;
public $IIIIIIIIlIlI;
public function _initialize() {
parent::_initialize();
$this->IIIIIIl1I1I1=intval($_GET['fid']);
$this->assign('fid',$this->IIIIIIl1I1I1);
if ($this->IIIIIIl1I1I1){
$IIIIIIl1I1lI=M('Catemenu')->find($this->IIIIIIl1I1I1);
$this->assign('thisCatemenu',$IIIIIIl1I1lI);
}
}
public function index(){
$IIIIIIIlIII1=D('catemenu');
$IIIIIIIIlIl1['token']=session('token');
$IIIIIIIIlIl1['fid']=intval($_GET['fid']);
$IIIIIIIII1ll=$IIIIIIIlIII1->where($IIIIIIIIlIl1)->count();
$IIIIIIIII11I=new Page($IIIIIIIII1ll,25);
$IIIIIIIIIlll=$IIIIIIIlIII1->where($IIIIIIIIlIl1)->order('orderss desc')->limit($IIIIIIIII11I->firstRow.','.$IIIIIIIII11I->listRows)->select();
$this->assign('countMenu',$IIIIIIIII1ll);
$this->assign('page',$IIIIIIIII11I->show());
$this->assign('info',$IIIIIIIIIlll);
$this->display();
}
public function add(){
$this->display();
}
public function edit(){
$IIIIIIIII1I1=$this->_get('id','intval');
$IIIIIIIIIlll=M('Catemenu')->find($IIIIIIIII1I1);
$this->assign('info',$IIIIIIIIIlll);
$this->display();
}
public function del(){
$IIIIIIIIlIl1['id']=$this->_get('id','intval');
$IIIIIIIIlIl1['token']=session('token');
S("bottomMenus_".$IIIIIIIIlIl1['token'],NULL);
if(D(MODULE_NAME)->where($IIIIIIIIlIl1)->delete()){
$IIIIIIl1I1l1['fid']=intval($IIIIIIIIlIl1['id']);
D(MODULE_NAME)->where($IIIIIIl1I1l1)->delete();
$this->success('操作成功',U(MODULE_NAME.'/index',array('fid'=>$_GET['fid'])));
}else{
$this->error('操作失败',U(MODULE_NAME.'/index',array('fid'=>$_GET['fid'])));
}
}
public function insert(){
$IIIIIIIIlIlI = $this->_post('token',htmlspecialchars);
S("bottomMenus_".$IIIIIIIIlIlI,NULL);
$IIIIIIIlIIII='Catemenu';
$IIIIIIIlIII1=D($IIIIIIIlIIII);
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
$IIIIIIIIlIlI = session('token');
S("bottomMenus_".$IIIIIIIIlIlI,NULL);
$this->all_save();
}
public function styleSet(){
$IIIIIIIlIII1=M('home');
$IIIIIIl1I111=$IIIIIIIlIII1->where(array('token'=>$this->IIIIIIIIlIlI))->getfield("RadioGroup");
$this->assign('RadioGroup1',$IIIIIIl1I111);
$this->assign('radiogroup',$IIIIIIl1I111);
$this->display();
}
public function styleChange(){
$IIIIIIIlIII1=M('home');
$IIIIIIIIIlll=$IIIIIIIlIII1->where(array('token'=>$this->IIIIIIIIlIlI))->find();
$IIIIIIl1lIIl=$this->_get('radiogroup');
$IIIIIIIIlIlI = $this->IIIIIIIIlIlI;
S("homeinfo_".$IIIIIIIIlIlI,NULL);
$IIIIIIIIIl11['radiogroup']=$IIIIIIl1lIIl;
if($IIIIIIIIIlll==false){
$IIIIIII11l11=$IIIIIIIlIII1->add($IIIIIIIIIl11);
}else{
$IIIIIIIIIl11['id']=$IIIIIIIIIlll['id'];
$IIIIIII11l11=$IIIIIIIlIII1->save($IIIIIIIIIl11);
}
}
public function colorChange(){
$IIIIIIIlIII1=M('styleset');
$IIIIIIIIIlll=$IIIIIIIlIII1->where(array('token'=>$this->IIIIIIIIlIlI))->find();
$IIIIIIl1lIlI=$this->_get('themestyle');
$IIIIIIIIIl11['plugmenucolor']=$IIIIIIl1lIlI;
if($IIIIIIIIIlll==false){
$IIIIIII11l11=$IIIIIIIlIII1->add($IIIIIIIIIl11);
}else{
$IIIIIIIIIl11['id']=$IIIIIIIIIlll['id'];
$IIIIIII11l11=$IIIIIIIlIII1->save($IIIIIIIIIl11);
}
}
public function chooseMenu()
{
$IIIIIIl1lIl1 = isset($_GET['tpid']) ?intval($_GET['tpid']) : 0;
include('./iMicms/Lib/ORG/radiogroup.php');
$this->assign("info",$IIIIIIl1lI1I[$IIIIIIl1lIl1]);
$this->assign('menu',$IIIIIIl1lI1I);
$this->display();
}
}
?>