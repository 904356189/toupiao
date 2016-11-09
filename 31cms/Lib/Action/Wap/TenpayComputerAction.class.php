<?php

class TenpayComputerAction extends BaseAction{
public $IIIIIIIIlIlI;
public $IIIIIlIIIll1;
public $IIIII1l1l1ll;
public function __construct(){
$this->IIIIIIIIlIlI = $this->_get('token');
$this->IIIIIlIIIll1	= $this->_get('wecha_id');
if (!$this->IIIIIIIIlIlI){
$IIIIIlIIIIlI=M('product_cart');
$IIIIIl1Il1II = $this->_get('out_trade_no');
$IIIIIIIIl1Il=$IIIIIlIIIIlI->where(array('orderid'=>$IIIIIl1Il1II))->find();
if (!$IIIIIIIIl1Il){
$IIIIIIIIl1Il=$IIIIIlIIIIlI->where(array('id'=>intval($this->_get('out_trade_no'))))->find();
}
$this->IIIIIIIIlIlI=$IIIIIIIIl1Il['token'];
}
$IIIIIlIIIlII=M('Alipay_config');
$this->IIIII1l1l1ll=$IIIIIlIIIlII->where(array('token'=>$this->IIIIIIIIlIlI))->find();
}
public function pay(){
$IIIIIlIIIIIl=$_GET['price'];
$IIIIIl1Il1lI=$_GET['orderName'];
$IIIIIl1Il1ll=$_GET['orderid'];
if (!$IIIIIl1Il1ll){
$IIIIIl1Il1ll=$_GET['single_orderid'];
}
$IIIIIl1Il11l = C('site_url').'/index.php?g=Wap&m=TenpayComputer&a=notify_url';
$IIIIIl1Il111 = C('site_url').'/index.php?g=Wap&m=TenpayComputer&a=return_url&token='.$_GET['token'].'&wecha_id='.$_GET['wecha_id'].'&from='.$_GET['from'];
if(!$IIIIIlIIIIIl)exit('必须有价格才能支付');
$IIIIIl1I1IIl =floatval($IIIIIlIIIIIl)*100;
import("@.ORG.TenpayComputer.RequestHandler");
$IIIIIl1Il1II = $IIIIIl1Il1ll;
$IIIII1l1l11I = new RequestHandler();
$IIIII1l1l11I->init();
$IIIIIIIlI11I=$this->IIIII1l1l1ll['partnerkey'];
$IIIII1l1l1l1=$this->IIIII1l1l1ll['partnerid'];
$IIIII1l1l11I->setKey($IIIIIIIlI11I);
$IIIII1l1l11I->setGateUrl("https://gw.tenpay.com/gateway/pay.htm");
$IIIII1l1l11I->setParameter("partner",$IIIII1l1l1l1);
$IIIII1l1l11I->setParameter("out_trade_no",$IIIIIl1Il1II);
$IIIII1l1l11I->setParameter("total_fee",$IIIIIl1I1IIl);
$IIIII1l1l11I->setParameter("return_url",$IIIIIl1Il111);
$IIIII1l1l11I->setParameter("notify_url",$IIIIIl1Il11l);
$IIIII1l1l11I->setParameter("body",'财付通在线支付');
$IIIII1l1l11I->setParameter("bank_type","DEFAULT");
$IIIII1l1l11I->setParameter("spbill_create_ip",$_SERVER['REMOTE_ADDR']);
$IIIII1l1l11I->setParameter("fee_type","1");
$IIIII1l1l11I->setParameter("subject",'weixin');
$IIIII1l1l11I->setParameter("sign_type","MD5");
$IIIII1l1l11I->setParameter("service_version","1.0");
$IIIII1l1l11I->setParameter("input_charset","utf-8");
$IIIII1l1l11I->setParameter("sign_key_index","1");
$IIIII1l1l11I->setParameter("attach","");
$IIIII1l1l11I->setParameter("product_fee","");
$IIIII1l1l11I->setParameter("transport_fee","0");
$IIIII1l1l11I->setParameter("time_start",date("YmdHis"));
$IIIII1l1l11I->setParameter("time_expire","");
$IIIII1l1l11I->setParameter("buyer_id","");
$IIIII1l1l11I->setParameter("goods_tag","");
$IIIII1l1l11I->setParameter("trade_mode",1);
$IIIII1l1l11I->setParameter("transport_desc","");
$IIIII1l1l11I->setParameter("trans_type","1");
$IIIII1l1l11I->setParameter("agentid","");
$IIIII1l1l11I->setParameter("agent_type","");
$IIIII1l1l11I->setParameter("seller_id","");
$IIIII1l11IlI = $IIIII1l1l11I->getRequestURL();
$IIIII1l11I1I = $IIIII1l1l11I->getDebugInfo();
header('Location:'.$IIIII1l11IlI);
}
public function return_url (){
import("@.ORG.TenpayComputer.ResponseHandler");
$IIIII1l1l111 = new ResponseHandler();
$IIIIIIIlI11I=$this->IIIII1l1l1ll['partnerkey'];
$IIIII1l1l111->setKey($IIIIIIIlI11I);
$IIIIIl1Il1II = $this->_get('out_trade_no');
$IIIII1l11I1l = $IIIII1l1l111->getParameter("notify_id");
$IIIIIl1Il1II = $IIIII1l1l111->getParameter("out_trade_no");
$IIIII1l11Ill = $IIIII1l1l111->getParameter("transaction_id");
$IIIIIl1I1IIl = $IIIII1l1l111->getParameter("total_fee");
$IIIII1l11I11 = $IIIII1l1l111->getParameter("discount");
$IIIII1l11lII = $IIIII1l1l111->getParameter("trade_state");
$IIIII1l11lIl = $IIIII1l1l111->getParameter("trade_mode");
if("0"== $IIIII1l11lII) {
$IIIIIl1I1l1I=M('Member_card_create');
$IIIIIl1I1l1l=$IIIIIl1I1l1I->where(array('token'=>$this->IIIIIIIIlIlI,'wecha_id'=>$this->IIIIIlIIIll1))->find();
$IIIIIl1I1l11=M('Member_card_set');
$IIIIIl1I11II=$IIIIIl1I1l11->where(array('id'=>intval($IIIIIl1I1l1l['cardid'])))->find();
$IIIIIl1I11Il = M('Member_card_exchange')->where(array('cardid'=>intval($IIIIIl1I11II['id'])))->find();
$IIIIIIIlII1l['token']=$this->IIIIIIIIlIlI;
$IIIIIIIlII1l['wecha_id']=$this->IIIIIlIIIll1;
$IIIIIIIlII1l['expense']=intval($IIIIIl1I1IIl/100);
$IIIIIIIlII1l['time']=time();
$IIIIIIIlII1l['cat']=99;
$IIIIIIIlII1l['staffid']=0;
$IIIIIIIlII1l['score']=intval($IIIIIl1I11Il['reward'])*$IIIIIIIIl1Il['price'];
M('Member_card_use_record')->add($IIIIIIIlII1l);
$IIIIII1ll1Il=M('Userinfo');
$IIIIIllII1I1 = $IIIIII1ll1Il->where(array('token'=>$IIIIIl1I11II['token'],'wecha_id'=>$IIIIIIIlII1l['wecha_id']))->find();
$IIIIIl1I11I1=array();
$IIIIIl1I11I1['total_score']=$IIIIIllII1I1['total_score']+$IIIIIIIlII1l['score'];
$IIIIIl1I11I1['expensetotal']=$IIIIIllII1I1['expensetotal']+$IIIIIIIlII1l['expense'];
$IIIIII1ll1Il->where(array('token'=>$IIIIIl1I11II['token'],'wecha_id'=>$IIIIIIIlII1l['wecha_id']))->save($IIIIIl1I11I1);
$IIIIIl1Il1l1=$_GET['from'];
$IIIIIl1Il1l1=$IIIIIl1Il1l1?$IIIIIl1Il1l1:'Groupon';
$IIIIIl1Il1l1=$IIIIIl1Il1l1!='groupon'?$IIIIIl1Il1l1:'Groupon';
switch (strtolower($IIIIIl1Il1l1)){
default:
case 'groupon':
case 'store':
$IIIIIl1I11lI=M('product_cart');
break;
case 'repast':
$IIIIIl1I11lI=M('Dish_order');
break;
case 'hotels':
$IIIIIl1I11lI=M('Hotels_order');
break;
case 'business':
$IIIIIl1I11lI=M('Reservebook');
break;
}
$IIIIIl1I11lI->where(array('orderid'=>$IIIIIl1Il1II))->setField('paid',1);
$this->redirect('/index.php?g=Wap&m='.$IIIIIl1Il1l1.'&a=payReturn&token='.$_GET['token'].'&wecha_id='.$_GET['wecha_id'].'&orderid='.$IIIIIl1Il1II);
}else {
exit('付款失败');
}
}
public function notify_url(){
echo "success";
eixt();
}
}
?>