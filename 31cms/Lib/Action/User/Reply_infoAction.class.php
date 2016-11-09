<?php

class Reply_infoAction extends UserAction{
public $IIIIIIIIlIlI;
public $IIIIIlIIlI11;
Public $IIIIIlIIllII;
public function _initialize() {
parent::_initialize();
$this->IIIIIlIIlI11=M('reply_info');
$this->IIIIIIIIlIlI=session('token');
$this->assign('token',$this->IIIIIIIIlIlI);
$this->IIIIIlIIllII=array(
'Groupon'=>array('type'=>'Groupon','name'=>'团购','keyword'=>'团购','url'=>'/index.php?g=Wap&m=Groupon&a=grouponIndex&token='.$this->IIIIIIIIlIlI),
'Dining'=>array('type'=>'Dining','name'=>'订餐','keyword'=>'订餐','url'=>'/index.php?g=Wap&m=Product&a=dining&dining=1&token='.$this->IIIIIIIIlIlI),
'Shop'=>array('type'=>'Shop','name'=>'商城','keyword'=>'商城','url'=>'/index.php?g=Wap&m=Product&a=cats&token='.$this->IIIIIIIIlIlI),
'panorama'=>array('type'=>'panorama','name'=>'全景','keyword'=>'全景','url'=>'/index.php?g=Wap&m=Product&a=cats&token='.$this->IIIIIIIIlIlI),
'Hotels'=>array('type'=>'Hotels','name'=>'酒店','keyword'=>'酒店','url'=>'/index.php?g=Wap&m=Hotels&a=index&token='.$this->IIIIIIIIlIlI),
);
if (isset($_GET['infotype'])&&$_GET['infotype']=='Dining'){
$this->IIIIII111III=1;
}else {
$this->IIIIII111III=0;
}
$this->assign('isDining',$this->IIIIII111III);
}
public function set(){
$IIIIIlIII1II = $this->_get('infotype');
$IIIIIIl11llI = $this->IIIIIlIIlI11->where(array('infotype'=>$IIIIIlIII1II,'token'=>$this->IIIIIIIIlIlI))->find();
if ($IIIIIIl11llI&&$IIIIIIl11llI['token']!=$this->IIIIIIIIlIlI){
exit();
}
if(IS_POST){
$IIIIIIl11lll['title']=$this->_post('title');
$IIIIIIl11lll['info']=$this->_post('info');
$IIIIIIl11lll['picurl']=$this->_post('picurl');
$IIIIIIl11lll['apiurl']=$this->_post('apiurl');
$IIIIIIl11lll['token']=$this->_post('token');
$IIIIIIl11lll['infotype']=$this->_post('infotype');
if ($IIIIIIl11lll['infotype']=='Dining'){
$IIIIIlIIllIl=intval($_POST['diningyuding']);
$IIIIIlIIllI1=intval($_POST['diningwaimai']);
if (isset($_POST['diningyuding'])){
$IIIIIIl11lll['diningyuding']=intval($_POST['diningyuding']);
}else {
$IIIIIIl11lll['diningyuding']=0;
}
if (isset($_POST['diningwaimai'])){
$IIIIIIl11lll['diningwaimai']=intval($_POST['diningwaimai']);
}else {
$IIIIIIl11lll['diningwaimai']=0;
}
$IIIIIIl11lll['config']=serialize(array('waimaiclose'=>$IIIIIlIIllI1,'yudingclose'=>$IIIIIlIIllIl,'yudingdays'=>intval($_POST['yudingdays'])));
}
if ($IIIIIIl11llI){
$IIIIIIIIlIl1=array('infotype'=>$IIIIIIl11llI['infotype'],'token'=>$this->IIIIIIIIlIlI);
$this->IIIIIlIIlI11->where($IIIIIIIIlIl1)->save($IIIIIIl11lll);
$IIIIIIl11ll1=M('Keyword');
$IIIIIIl11ll1->where(array('token'=>$this->IIIIIIIIlIlI,'pid'=>$IIIIIIl11llI['id'],'module'=>'Reply_info'))->save(array('keyword'=>$_POST['keyword']));
$this->success('修改成功',U('Reply_info/set',$IIIIIIIIlIl1));
}else {
$this->all_insert('Reply_info','/set?infotype='.$IIIIIlIII1II);
}
}else{
$IIIIII1l11ll=unserialize($IIIIIIl11llI['config']);
$this->assign('config',$IIIIII1l11ll);
$this->assign('infoType',$this->IIIIIlIIllII[$IIIIIlIII1II]);
$this->assign('set',$IIIIIIl11llI);
$this->display();
}
}
}
?>