<?php

class AlipaytypeAction extends BaseAction{
public $IIIIIIIIlIlI;
public $IIIIIlIIIll1;
public $IIIIIl1Ill11;
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
$IIIIIl1Il1Il=M('Alipay_config');
$this->IIIIIl1Ill11=$IIIIIl1Il1Il->where(array('token'=>$this->IIIIIIIIlIlI))->find();
}
public function pay(){
$IIIIIlIIIIIl=$_GET['price'];
$IIIIIl1Il1lI=$_GET['orderName'];
if (!$IIIIIl1Il1lI){
$IIIIIl1Il1lI=microtime();
}
$IIIIIl1Il1ll=$_GET['orderid'];
if (!$IIIIIl1Il1ll){
$IIIIIl1Il1ll=$_GET['single_orderid'];
}
$IIIIIl1Ill11=$this->IIIIIl1Ill11;
if(!$IIIIIlIIIIIl)exit('必须有价格才能支付');
import("@.ORG.Alipay.AlipaySubmit");
$IIIIIl1Il11I = "1";
$IIIIIl1Il11l = C('site_url').'/index.php?g=Wap&m=Alipaytype&a=notify_url';
$IIIIIl1Il111 = C('site_url').'/index.php?g=Wap&m=Alipaytype&a=return_url&token='.$_GET['token'].'&wecha_id='.$_GET['wecha_id'].'&from='.$_GET['from'];
$IIIIIl1I1III =trim($IIIIIl1Ill11['name']);
$IIIIIl1Il1II = $IIIIIl1Il1ll;
$IIIIIIlII1lI =$IIIIIl1Il1lI;
$IIIIIl1I1IIl =floatval($IIIIIlIIIIIl);
$IIIIIIlII1l1 = $IIIIIl1Il1lI;
$IIIIIl1I1II1 = C('site_url').U('Home/Index/price');
$IIIIIl1I1IlI = "";
$IIIIIl1I1Ill = "";
$IIIIIIlII1l1 = $IIIIIIlII1lI;
$IIIIIl1I1II1 = rtrim(C('site_url'),'/');
$IIIIIl1I1Il1 = array(
"service"=>"create_direct_pay_by_user",
"partner"=>trim($IIIIIl1Ill11['pid']),
"payment_type"=>$IIIIIl1Il11I,
"notify_url"=>$IIIIIl1Il11l,
"return_url"=>$IIIIIl1Il111,
"seller_email"=>$IIIIIl1I1III,
"out_trade_no"=>$IIIIIl1Il1II,
"subject"=>$IIIIIIlII1lI,
"total_fee"=>$IIIIIl1I1IIl,
"body"=>$IIIIIIlII1l1,
"show_url"=>$IIIIIl1I1II1,
"anti_phishing_key"=>$IIIIIl1I1IlI,
"exter_invoke_ip"=>$IIIIIl1I1Ill,
"_input_charset"=>trim(strtolower('utf-8'))
);
$IIIIIl1I1I1I = new AlipaySubmit($this->setconfig());
$IIIIIl1I1I1l = $IIIIIl1I1I1I->buildRequestForm($IIIIIl1I1Il1,"get","进行支付");
echo '正在跳转到支付宝进行支付...<div style="display:none">'.$IIIIIl1I1I1l.'</div>';
}
public function setconfig(){
$IIIIIl1I1lII['partner']		= trim($this->IIIIIl1Ill11['pid']);
$IIIIIl1I1lII['key']			= trim($this->IIIIIl1Ill11['key']);
$IIIIIl1I1lII['sign_type']    = strtoupper('MD5');
$IIIIIl1I1lII['input_charset']= strtolower('utf-8');
$IIIIIl1I1lII['cacert']    = getcwd().'\\iMicms\\Lib\\ORG\\Alipay\\cacert.pem';
$IIIIIl1I1lII['transport']    = 'http';
return $IIIIIl1I1lII;
}
public function return_url (){
import("@.ORG.Alipay.AlipayNotify");
$IIIIIl1I1lI1 = new AlipayNotify($this->setconfig());
$IIIIIl1I1llI = $IIIIIl1I1lI1->verifyReturn();
$IIIIIl1Il1II = $this->_get('out_trade_no');
$IIIIIl1I1lll =  $this->_get('trade_no');
$IIIIIl1I1ll1 =  $this->_get('trade_status');
if( $this->_get('trade_status') == 'TRADE_FINISHED'||$this->_get('trade_status') == 'TRADE_SUCCESS') {
$IIIIIl1I1l1I=M('Member_card_create');
$IIIIIl1I1l1l=$IIIIIl1I1l1I->where(array('token'=>$this->IIIIIIIIlIlI,'wecha_id'=>$this->IIIIIlIIIll1))->find();
$IIIIIl1I1l11=M('Member_card_set');
$IIIIIl1I11II=$IIIIIl1I1l11->where(array('id'=>intval($IIIIIl1I1l1l['cardid'])))->find();
$IIIIIl1I11Il = M('Member_card_exchange')->where(array('cardid'=>intval($IIIIIl1I11II['id'])))->find();
$IIIIIIIlII1l['token']=$this->IIIIIIIIlIlI;
$IIIIIIIlII1l['wecha_id']=$this->IIIIIlIIIll1;
$IIIIIIIlII1l['expense']=$this->_get('total_fee');
$IIIIIIIlII1l['time']=time();
$IIIIIIIlII1l['cat']=99;
$IIIIIIIlII1l['staffid']=0;
$IIIIIIIlII1l['score']=intval($IIIIIl1I11Il['reward'])*$IIIIIIIlII1l['expense'];
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