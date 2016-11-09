<?php

class ReservationAction extends UserAction{
public $IIIIIlII11II;
public function _initialize() {
parent::_initialize();
$this->IIIIIlII11II = $this->_get('addtype');
$this->assign('addtype',$this->IIIIIlII11II);
}
public function index(){
if(session('gid')==1){
$this->error('vip0无法使用预约管理,请充值后再使用',U('Home/Index/price'));
}
$IIIIIIIIIl11 = M("Reservation");
$IIIIIIIIlIl1 = array('token'=>session('token'),'addtype'=>'house_book');
$IIIIIIIII1ll      = $IIIIIIIIIl11->where($IIIIIIIIlIl1)->count();
$IIIIIIll1lll       = new Page($IIIIIIIII1ll,12);
$IIIIIIIII11l       = $IIIIIIll1lll->show();
$IIIIIlII11I1 = $IIIIIIIIIl11->where($IIIIIIIIlIl1)->limit($IIIIIIll1lll->firstRow.','.$IIIIIIll1lll->listRows)->select();
$this->assign('page',$IIIIIIIII11l);
$this->assign('reslist',$IIIIIlII11I1);
$this->display();
}
public function add(){
if(session('gid')==1){
$this->error('vip0无法使用预约管理,请充值后再使用',U('Home/Index/price'));
}
$IIIIIlII11II = $this->_get('addtype');
if(IS_POST){
$IIIIIIIIIl11=D('Reservation');
$_POST['token']=session('token');
$_POST['addtype'] = 'house_book';
if($IIIIIIIIIl11->create()!=false){
if($IIIIIIIII1I1=$IIIIIIIIIl11->data($_POST)->add()){
$IIIIIIllllI1['pid']=$IIIIIIIII1I1;
$IIIIIIllllI1['module']='Reservation';
$IIIIIIllllI1['token']=session('token');
$IIIIIIllllI1['keyword']=trim($_POST['keyword']);
M('Keyword')->add($IIIIIIllllI1);
if($IIIIIlII11II == 'drive'){
$this->success('添加成功',U('Car/drive',array('token'=>session('token'))));
}elseif($IIIIIlII11II == 'maintain'){
$this->success('添加成功',U('Car/maintain',array('token'=>session('token'))));
}else{
$this->success('添加成功',U('Reservation/index',array('token'=>session('token'))));
}
}else{
$this->error('服务器繁忙,请稍候再试');
}
}else{
$this->error($IIIIIIIIIl11->getError());
}
}else{
$this->display();
}
}
public function edit(){
if(IS_POST){
$IIIIIIIIIl11=D('Reservation');
$IIIIIIIIlIl1=array('id'=>(int)$this->_post('id'),'token'=>session('token'));
$IIIIIIl111Il=$IIIIIIIIIl11->where($IIIIIIIIlIl1)->find();
if($IIIIIIl111Il==false)$this->error('非法操作');
if($IIIIIIIIIl11->create()){
$_POST['addtype'] = 'house_book';
if($IIIIIIIIIl11->where($IIIIIIIIlIl1)->save($_POST)){
$IIIIIIllllI1['pid']=(int)$this->_post('id');
$IIIIIIllllI1['module']='Reservation';
$IIIIIIllllI1['token']=session('token');
$IIIIIIIlII11['keyword']=trim($_POST['keyword']);
M('Keyword')->where($IIIIIIllllI1)->save($IIIIIIIlII11);
$this->success('修改成功',U('Reservation/index',array('token'=>session('token'))));
}else{
$this->error('操作失败');
}
}else{
$this->error($IIIIIIIIIl11->getError());
}
}else{
$IIIIIIIII1I1=$this->_get('id');
$IIIIIIIIlIl1=array('id'=>$IIIIIIIII1I1,'token'=>session('token'));
$IIIIIIIIIl11=M('Reservation');
$IIIIIIl111Il=$IIIIIIIIIl11->where($IIIIIIIIlIl1)->find();
if($IIIIIIl111Il==false)$this->error('非法操作');
$IIIIIlII11I1=$IIIIIIIIIl11->where($IIIIIIIIlIl1)->find();
$this->assign('reslist',$IIIIIlII11I1);
$this->display('add');
}
}
public function del(){
$IIIIIIIII1I1 = (int)$this->_get('id');
$IIIIIII11l11 = M('Reservation');
$IIIIIlII11lI = array('id'=>$IIIIIIIII1I1,'token'=>$this->_get('token'));
$IIIIIlIII11I = $IIIIIII11l11->where($IIIIIlII11lI)->find();
if($IIIIIlIII11I){
$IIIIIII11l11->where('id='.$IIIIIlIII11I['id'])->delete();
$IIIIIIIIlIl1 = array('pid'=>$IIIIIlIII11I['id'],'module'=>'Reservation','token'=>session('token'));
M('Keyword')->where($IIIIIIIIlIl1)->delete();
$this->success('删除成功',U('Reservation/index',array('token'=>session('token'))));
exit;
}else{
$this->error('非法操作！');
exit;
}
}
public function manage(){
$IIIIIlII11l1 = M('Reservebook');
$IIIIII1llI11 = (int)$this->_get('id');
$IIIIIlII11II = strval($this->_get('addtype'));
if($IIIIIlII11II == 'drive'){
$IIIIIIIIlIl1 = array('token'=>session('token'),'rid'=>$IIIIII1llI11,'type'=>$IIIIIlII11II);
}elseif($IIIIIlII11II =='maintain'){
$IIIIIIIIlIl1 = array('token'=>session('token'),'rid'=>$IIIIII1llI11,'type'=>$IIIIIlII11II);
}else{
$IIIIIlII11II='house_book';
$IIIIIIIIlIl1 = array('token'=>session('token'),'rid'=>$IIIIII1llI11,'type'=>'house_book');
}
$IIIIIIIII1ll      = $IIIIIlII11l1->where($IIIIIIIIlIl1)->count();
$IIIIIIll1lll       = new Page($IIIIIIIII1ll,12);
$IIIIIIIII11l       = $IIIIIIll1lll->show();
$IIIIIlII111I = $IIIIIlII11l1->where($IIIIIIIIlIl1)->limit($IIIIIIll1lll->firstRow.','.$IIIIIIll1lll->listRows)->select();
$this->assign('page',$IIIIIIIII11l);
$this->assign('books',$IIIIIlII111I);
$this->assign('count',$IIIIIlII11l1->where(array('token'=>session('token'),'rid'=>$IIIIII1llI11,'type'=>$IIIIIlII11II))->count());
$this->assign('ok_count',$IIIIIlII11l1->where(array('token'=>session('token'),'rid'=>$IIIIII1llI11,'type'=>$IIIIIlII11II,'remate'=>'1'))->count());
$this->assign('lose_count',$IIIIIlII11l1->where(array('token'=>session('token'),'rid'=>$IIIIII1llI11,'type'=>$IIIIIlII11II,'remate'=>'2'))->count());
$this->assign('call_count',$IIIIIlII11l1->where(array('token'=>session('token'),'rid'=>$IIIIII1llI11,'type'=>$IIIIIlII11II,'remate'=>'0'))->count());
$this->display();
}
public function reservation_uinfo(){
$IIIIIIIII1I1 = $this->_get('id');
$IIIIIIIIlIlI = $this->_get('token');
$IIIIIIIIlIl1 = array('id'=>$IIIIIIIII1I1,'token'=>$IIIIIIIIlIlI);
$IIIIIlII11l1 = M('Reservebook');
$IIIIIIIIIlIl = $IIIIIlII11l1->where($IIIIIIIIlIl1)->find();
$this->assign('userinfo',$IIIIIIIIIlIl);
if(IS_POST){
$IIIIIIIII1I1 = $this->_post('id');
$IIIIIIIIlIlI = session('token');
$IIIIIIIIlIl1 =  array('id'=>$IIIIIIIII1I1,'token'=>$IIIIIIIIlIlI);
$IIIIIIIIlI1I = $IIIIIlII11l1->where($IIIIIIIIlIl1)->save($_POST);
if($IIIIIIIIlI1I){
$this->assign('ok',1);
}else{
$this->assign('ok',2);
}
}
$this->display();
}
public function manage_del(){
$IIIIIIIII1I1 = $this->_get('id');
$IIIIIlII11l1 = M('Reservebook');
$IIIIIIIIlIl1 = array('id'=>$IIIIIIIII1I1,'token'=>$this->_get('token'));
$IIIIIIl111Il  = $IIIIIlII11l1->where($IIIIIIIIlIl1)->find();
$IIIIIlII11Il = $this->_get('car');
if(!empty($IIIIIIl111Il)){
$IIIIIlII11l1->where(array('id'=>$IIIIIIl111Il['id']))->delete();
if($IIIIIlII11Il == 'car'){
$this->success('删除成功',U('Car/reservation',array('token'=>session('token'))));
exit;
}else{
$this->success('删除成功',U('Reservation/index',array('token'=>session('token'))));
exit;
}
}else{
$this->error('非法操作！');
exit;
}
}
public  function total(){
$this->display();
}
}?>