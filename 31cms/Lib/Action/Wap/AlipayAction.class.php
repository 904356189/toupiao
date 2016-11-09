<?php
echo '﻿';
class AlipayAction extends BaseAction{
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
$IIIIIl1Il1ll=$_GET['orderid'];
if (!$IIIIIl1Il1ll){
$IIIIIl1Il1ll=$_GET['single_orderid'];
}
$IIIIIl1Il1l1=isset($_GET['from'])?$_GET['from']:'shop';
$IIIIIl1Ill11=$this->IIIIIl1Ill11;
if(!$IIIIIlIIIIIl)exit('必须有价格才能支付');
import("@.ORG.Alipay.AlipaySubmit");
switch ($IIIIIl1Ill11['paytype']){
default:
$IIIIIl1Ill11['paytype']='Alipaytype';
break;
case 'tenpay':
$IIIIIl1Ill11['paytype']='Tenpay';
break;
case 'weixin':
$IIIIIl1Ill11['paytype']='Weixin';
break;
case 'tenpayComputer':
$IIIIIl1Ill11['paytype']='TenpayComputer';
break;
}
if ($IIIIIl1Ill11['paytype']=='Weixin'){
header('Location:/index.php?g=Wap&m='.$IIIIIl1Ill11['paytype'].'&a=pay&price='.$IIIIIlIIIIIl.'&orderName='.$IIIIIl1Il1lI.'&single_orderid='.$IIIIIl1Il1ll.'&showwxpaytitle=1&from='.$IIIIIl1Il1l1.'&token='.$this->IIIIIIIIlIlI.'&wecha_id='.$this->IIIIIlIIIll1);
}else {
header('Location:/index.php?g=Wap&m='.$IIIIIl1Ill11['paytype'].'&a=pay&price='.$IIIIIlIIIIIl.'&orderName='.$IIIIIl1Il1lI.'&single_orderid='.$IIIIIl1Il1ll.'&from='.$IIIIIl1Il1l1.'&token='.$this->IIIIIIIIlIlI.'&wecha_id='.$this->IIIIIlIIIll1);
}
}
}
?>