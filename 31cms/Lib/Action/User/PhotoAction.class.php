<?php

class PhotoAction extends UserAction{
public function index(){
$IIIIII1l11lI=M('Reply_info');
$IIIIII1l11ll=$IIIIII1l11lI->where(array('token'=>$this->IIIIIIIIlIlI,'infotype'=>'album'))->find();
if ($IIIIII1l11ll){
$IIIIII1l11l1=$IIIIII1l11ll['picurl'];
}else {
$IIIIII1l11l1='/tpl/Wap/default/common/css/Photo/banner.jpg';
}
$this->assign('headpic',$IIIIII1l11l1);
$this->canUseFunction('album');
$IIIIIIIIIl11=M('Photo');
$IIIIIIIII1ll      = $IIIIIIIIIl11->where(array('token'=>$_SESSION['token']))->count();
$IIIIIIll1lll       = new Page($IIIIIIIII1ll,12);
$IIIIIIIII11l       = $IIIIIIll1lll->show();
$IIIIIIIIlIII = $IIIIIIIIIl11->where(array('token'=>$_SESSION['token']))->limit($IIIIIIll1lll->firstRow.','.$IIIIIIll1lll->listRows)->select();
$this->assign('page',$IIIIIIIII11l);
$this->assign('photo',$IIIIIIIIlIII);
$this->display();
}
public function config(){
$IIIIII1l11lI=M('Reply_info');
$IIIIII1l11ll=$IIIIII1l11lI->where(array('token'=>$this->IIIIIIIIlIlI,'infotype'=>'album'))->find();
$IIIIII1l111l=array();
$IIIIII1l111l['title']='相册';
$IIIIII1l111l['info']='';
$IIIIII1l111l['picurl']=$this->_post('picurl');
$IIIIII1l111l['token']=$this->IIIIIIIIlIlI;
$IIIIII1l111l['apiurl']='';
$IIIIII1l111l['infotype']='album';
if ($IIIIII1l11ll){
$IIIIII1l11lI->where(array('token'=>$this->IIIIIIIIlIlI,'infotype'=>'album'))->save($IIIIII1l111l);
}else {
$IIIIII1l11lI->add($IIIIII1l111l);
}
$this->success('操作成功');
}
public function edit(){
if($this->_get('token')!=session('token')){$this->error('非法操作');}
$IIIIIIIIIl11=D('Photo');
if(IS_POST){
$this->all_save('Photo');
}else{
$IIIIII1l1111=$IIIIIIIIIl11->where(array('token'=>session('token'),'id'=>$this->_get('id')))->find();
if($IIIIII1l1111==false){
$this->error('相册不存在');
}else{
$this->assign('photo',$IIIIII1l1111);
}
$this->display();
}
}
public function list_edit(){
if($this->_get('token')!=session('token')){$this->error('非法操作');}
$IIIIIIl111Il=M('Photo_list')->field('id,pid')->where(array('token'=>$_SESSION['token'],'id'=>$this->_post('id')))->find();
if($IIIIIIl111Il==false){$this->error('照片不存在');}
if(IS_POST){
$this->all_save('Photo_list','/list_add?id='.$IIIIIIl111Il['pid']);
}else{
$this->error('非法操作');
}
}
public function list_del(){
if($this->_get('token')!=session('token')){$this->error('非法操作');}
$IIIIIIl111Il=M('Photo_list')->field('id,pid')->where(array('token'=>$_SESSION['token'],'id'=>$this->_get('id')))->find();
if($IIIIIIl111Il==false){$this->error('服务器繁忙');}
if(empty($_POST['edit'])){
if(M('Photo_list')->where(array('id'=>$IIIIIIl111Il['id']))->delete()){
M('Photo')->where(array('id'=>$IIIIIIl111Il['pid']))->setDec('num');
$this->success('操作成功');
}else{
$this->error('服务器繁忙,请稍后再试');
}
}
}
public function list_add(){
$IIIIII1IIlI1=M('Photo')->where(array('token'=>$_SESSION['token'],'pid'=>$this->_get('pid')))->find();
if($IIIIII1IIlI1==false){$this->error('相册不存在');}
if(IS_POST){
unset($_POST['s']);
$IIIIIIIIlllI = (int)$_POST['pid'];
unset($_POST['__hash__']);
unset($_POST['pid']);
$IIIIII11IIlI = M('Photo_list');
foreach($_POST as $IIIIIIIllIll=>$IIIIIIlIllII){
$IIIIII11IIll = explode('_',$IIIIIIIllIll);
$IIIIIIIlII1l[$IIIIII11IIll[1]][$IIIIII11IIll[0]] = $IIIIIIlIllII;
}
foreach($IIIIIIIlII1l as $IIIIIIIlI11I=>$IIIIIIl1llIl){
if(!array_key_exists('status',$IIIIIIl1llIl)){
$IIIIIIIlII1l[$IIIIIIIlI11I]['status'] = '0';
}
if($IIIIIIIlII1l[$IIIIIIIlI11I]['title'] == '') $IIIIIIIlII1l[$IIIIIIIlI11I]['title'] = '12345';
$IIIIIIIlII1l[$IIIIIIIlI11I]['pid'] = $IIIIIIIIlllI;
$IIIIIIIlII1l[$IIIIIIIlI11I]['token'] = $this->IIIIIIIIlIlI;
$IIIIIIIlII1l[$IIIIIIIlI11I]['create_time'] = time();
$IIIIII11IIlI->add($IIIIIIIlII1l[$IIIIIIIlI11I]);
}
M('Photo')->where(array('token'=>session('token'),'id'=>$IIIIIIIIlllI))->setInc('num',count($IIIIIIIlII1l));
$this->success('保存成功');
}else{
$IIIIIIIIIl11=M('Photo_list');
$IIIIIIIII1ll      = $IIIIIIIIIl11->where(array('token'=>$_SESSION['token'],'pid'=>$this->_get('pid')))->count();
$IIIIIIll1lll       = new Page($IIIIIIIII1ll,120);
$IIIIIIIII11l       = $IIIIIIll1lll->show();
$IIIIIIIIlIII = $IIIIIIIIIl11->where(array('token'=>$_SESSION['token'],'pid'=>$this->_get('id')))->order('sort desc')->limit($IIIIIIll1lll->firstRow.','.$IIIIIIll1lll->listRows)->select();
$IIIIII11II1I = UNYUN_BUCKET;
$IIIIII11II1l = UNYUN_FORM_API_SECRET;
$IIIIII11II11 = array();
$IIIIII11II11['bucket'] = $IIIIII11II1I;
$IIIIII11II11['expiration'] = time()+600;
$IIIIII11II11['save-key'] = '/'.$this->IIIIIIIIlIlI.'/{year}/{mon}/{day}/'.time().'_{random}{.suffix}';
$IIIIII11II11['allow-file-type'] = C('up_exts');
$IIIIII11II11['content-length-range'] = '0,'.intval(C('up_size'))*1024;
if (intval($_GET['width'])){
$IIIIII11II11['x-gmkerl-type'] = 'fix_width';
$IIIIII11II11['fix_width '] = $_GET['width'];
}
$IIIIII11IlII = base64_encode(json_encode($IIIIII11II11));
$IIIIII11IlIl = md5($IIIIII11IlII.'&'.$IIIIII11II1l);
$this->assign('bucket',$IIIIII11II1I);
$this->assign('sign',$IIIIII11IlIl);
$this->assign('policy',$IIIIII11IlII);
$this->assign('page',$IIIIIIIII11l);
$this->assign('photo',$IIIIIIIIlIII);
$this->display();
}
}
public function add(){
if(IS_POST){
$this->all_insert('Photo','/add');
}else{
$this->display();
}
}
public function del(){
if($this->_get('token')!=session('token')){$this->error('非法操作');}
$IIIIIIl111Il=M('Photo')->field('id')->where(array('token'=>$_SESSION['token'],'id'=>$this->_get('id')))->find();
if($IIIIIIl111Il==false){$this->error('服务器繁忙');}
if(empty($_POST['edit'])){
if(M('Photo')->where(array('id'=>$IIIIIIl111Il['id']))->delete()){
M('Photo_list')->where(array('pid'=>$IIIIIIl111Il['id']))->delete();
$this->success('操作成功');
}else{
$this->error('服务器繁忙,请稍后再试');
}
}
}
}
?>