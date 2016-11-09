<?php

class CouponAction extends LotteryBaseAction{
public $IIIIIIIIlIlI;
public $IIIIIlIIIll1;
public $IIIII1Ill11l;
public $IIIII1Ill111;
public function index(){
$IIIII1Ill1II = $_SERVER['HTTP_USER_AGENT'];
if(!strpos($IIIII1Ill1II,"icroMessenger")) {
}
$this->IIIIIIIIlIlI=$this->_get('token');
$this->IIIIIlIIIll1	= $this->_get('wecha_id');
$this->IIIII1Ill11l=M('Lottery_record');
$this->IIIII1Ill111=M('Lottery');
if (!defined('RES')){
define('RES',THEME_PATH.'common');
}
if (!defined('STATICS')){
define('STATICS',TMPL_PATH.'static');
}
$IIIIIIIIlIlI		= $this->IIIIIIIIlIlI;
$IIIIIlIIIll1	= $this->IIIIIlIIIll1;
$IIIIIIIII1I1 		= $this->_get('id');
$IIIIIll1lll1 	= $this->IIIII1Ill111->where(array('id'=>$IIIIIIIII1I1,'token'=>$IIIIIIIIlIlI,'type'=>3,'status'=>1))->find();
$IIIIIll1lll1['renametel']=$IIIIIll1lll1['renametel']?$IIIIIll1lll1['renametel']:'手机号';
$IIIIIll1lll1['renamesn']=$IIIIIll1lll1['renamesn']?$IIIIIll1lll1['renamesn']:'SN码';
$this->assign('lottery',$IIIIIll1lll1);
if ($IIIIIll1lll1['statdate']>time()){
$IIIIIIIIIl11['usenums']=0;
}else {
$IIIIIIIIIl11=$this->prizeHandle($IIIIIIIIlIlI,$IIIIIlIIIll1,$IIIIIll1lll1);
}
$IIIIIIIIIl11['token'] 		= $IIIIIIIIlIlI;
$IIIIIIIIIl11['wecha_id']	= $IIIIIlIIIll1;
$IIIIIIIIIl11['lid']		= $IIIIIll1lll1['id'];
$IIIIIIIIIl11['phone']		= $IIIIIIIIIl11['phone'];
$IIIIIIIIIl11['usenums']	= $IIIIIIIIIl11['usenums'];
$IIIIIIIIIl11['sendtime']	= $IIIIIIIIIl11['sendtime'];
$IIIIIIIIIl11['canrqnums']	= $IIIIIll1lll1['canrqnums'];
$IIIIIIIIIl11['fist'] 		= $IIIIIll1lll1['fist'];
$IIIIIIIIIl11['second'] 	= $IIIIIll1lll1['second'];
$IIIIIIIIIl11['third'] 		= $IIIIIll1lll1['third'];
$IIIIIIIIIl11['fistnums'] 	= $IIIIIll1lll1['fistnums'];
$IIIIIIIIIl11['secondnums'] = $IIIIIll1lll1['secondnums'];
$IIIIIIIIIl11['thirdnums'] 	= $IIIIIll1lll1['thirdnums'];
$IIIIIIIIIl11['info']		= $IIIIIll1lll1['info'];
$IIIIIIIIIl11['aginfo']		= $IIIIIll1lll1['aginfo'];
$IIIIIIIIIl11['txt']		= $IIIIIll1lll1['txt'];
$IIIIIIIIIl11['sttxt']		= $IIIIIll1lll1['sttxt'];
$IIIIIIIIIl11['title']		= $IIIIIll1lll1['title'];
$IIIIIIIIIl11['statdate']	= $IIIIIll1lll1['statdate'];
$IIIIIIIIIl11['enddate']	= $IIIIIll1lll1['enddate'];
$IIIIIIIIIl11['info']=nl2br($IIIIIIIIIl11['info']);
$IIIIIIIIIl11['endinfo']=nl2br($IIIIIIIIIl11['endinfo']);
$this->assign('Coupon',$IIIIIIIIIl11);
$this->display();
}
}
?>