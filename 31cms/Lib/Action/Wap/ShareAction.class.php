<?php

class ShareAction extends WapAction{
public function __construct(){
parent::_initialize();
}
public function shareData(){
if(IS_POST&&isset($_POST['wecha_id'])){
$IIIIIIl11lll=array();
$IIIIIIl11lll['token']=$this->IIIIIIIIlIlI;
$IIIIIIl11lll['wecha_id']=$this->IIIIIlIIIll1;
$IIIIIIl11lll['to']=$this->_post('to');
$IIIIIIl11lll['module']=$this->_post('module');
$IIIIIIl11lll['moduleid']=intval($this->_post('moduleid'));
$IIIIIIl11lll['time']=time();
$IIIIIIl11lll['url']=$this->_post('url');
M('share')->add($IIIIIIl11lll);
$IIIII1lllI1l=M('Share_set')->where(array('token'=>$this->IIIIIIIIlIlI))->find();
if ($IIIII1lllI1l){
$IIIII1lllI11=array();
$IIIII1lllI11['token']=$this->IIIIIIIIlIlI;
$IIIII1lllI11['wecha_id']=$this->IIIIIlIIIll1;
$IIIIIIIIlIl1=array('token'=>$this->IIIIIIIIlIlI,'wecha_id'=>$this->IIIIIlIIIll1,'cat'=>98);
$IIIIIII111II=time();
$IIIIIlIIlll1=date('Y',$IIIIIII111II);
$IIIIIII111Il=date('m',$IIIIIII111II);
$IIIIIlIIl1lI=date('d',$IIIIIII111II);
$IIIII1lIIIII=mktime(0,0,0,$IIIIIII111Il,$IIIIIlIIl1lI,$IIIIIlIIlll1);
$IIIIIIIIlIl1['time']=array('gt',$IIIII1lIIIII);
$IIIII1llllII=M('Member_card_use_record')->where($IIIIIIIIlIl1)->count();
if ($IIIII1llllII<$IIIII1lllI1l['daylimit']){
$IIIII1lllI11['expense']=0;
$IIIII1lllI11['time']=$IIIIIII111II;
$IIIII1lllI11['cat']=98;
$IIIII1lllI11['staffid']=0;
$IIIII1lllI11['score']=intval($IIIII1lllI1l['score']);
M('Member_card_use_record')->add($IIIII1lllI11);
M('Userinfo')->where(array('token'=>$this->IIIIIIIIlIlI,'wecha_id'=>$this->IIIIIlIIIll1))->setInc('total_score',$IIIII1lllI11['score']);
}
}
}
}
}
?>