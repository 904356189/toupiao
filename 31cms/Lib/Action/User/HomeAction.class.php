<?php

class HomeAction extends UserAction{
public $IIIIIIIIlIlI;
public $IIIIII1IIIIl;
public function _initialize() {
parent::_initialize();
$this->IIIIIIIIlIlI=$this->_session('token');
$this->IIIIII1IIIIl=M('home');
$this->canUseFunction('shouye');
}
public function set(){
$IIIIII1IIII1=$this->IIIIII1IIIIl->where(array('token'=>session('token')))->find();
if(IS_POST){
$IIIIIIIIlIlI = session('token');
S("homeinfo_".$IIIIIIIIlIlI,NULL);
if($IIIIII1IIII1==false){
$this->all_insert('Home','/set');
}else{
$_POST['id']=$IIIIII1IIII1['id'];
$this->all_save('Home','/set');
}
}else{
$this->assign('home',$IIIIII1IIII1);
$this->display();
}
}
public function plugmenu(){
$IIIIIIIIlIl1=array('token'=>$this->IIIIIIIIlIlI);
$IIIIII1IIIll=array('tel','memberinfo','nav','message','share','home','album','email','shopping','membercard','activity','weibo','tencentweibo','qqzone','wechat','music','video','recommend','other');
$IIIIII1IIII1=$this->IIIIII1IIIIl->where(array('token'=>session('token')))->find();
$IIIIII1IIIl1=M('site_plugmenu');
if (!$IIIIII1IIII1){
$this->error('请先配置3g网站信息',U('Home/set',array('token'=>session('token'))));
}else {
S("homeinfo_".$this->IIIIIIIIlIlI,NULL);
if(IS_POST){
$this->IIIIII1IIIIl->where($IIIIIIIIlIl1)->save(array('plugmenucolor'=>$this->_post('plugmenucolor'),'copyright'=>$this->_post('copyright')));
$IIIIII1IIIl1->where($IIIIIIIIlIl1)->delete();
foreach ($IIIIII1IIIll as $IIIIII1III1I){
$IIIIIIl11lll=array('token'=>$this->IIIIIIIIlIlI);
$IIIIIIl11lll['name']=$IIIIII1III1I;
$IIIIIIl11lll['url']=$this->_post('url_'.$IIIIII1III1I);
$IIIIIIl11lll['taxis']=intval($_POST['sort_'.$IIIIII1III1I]);
$IIIIIIl11lll['display']=intval($_POST['display_'.$IIIIII1III1I]);
$IIIIII1IIIl1->add($IIIIIIl11lll);
}
$this->success('设置成功',U('Home/plugmenu',array('token'=>$this->IIIIIIIIlIlI)));
}else {
$IIIIII1III1l=$this->IIIIII1IIIIl->where($IIIIIIIIlIl1)->find();
if (!$IIIIII1III1l['plugmenucolor']){
$IIIIII1III1l['plugmenucolor']='#ff0000';
}
$this->assign('userGroup',$this->IIIIIl1IlI11);
$this->assign('homeInfo',$IIIIII1III1l);
$IIIIII1III11=$IIIIII1IIIl1->where($IIIIIIIIlIl1)->select();
$IIIIII1IIlII=array();
foreach ($IIIIII1III11 as $IIIIII1III1I){
$IIIIII1IIlII[$IIIIII1III1I['name']]=$IIIIII1III1I;
}
$this->assign('menus',$IIIIII1IIlII);
$this->display();
}
}
}
}
?>