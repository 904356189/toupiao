<?php

class WeixinAction extends BaseAction{
public $IIIIIIIIlIlI;
public $IIIIIlIIIll1;
public $IIIII1l1l1ll;
public function __construct(){
parent::_initialize();
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
$IIIII1l1l1ll = M('Alipay_config')->where(array('token'=>$this->IIIIIIIIlIlI))->find();
if(!empty($IIIII1l1l1ll['info'])){
$IIIII11I111I = unserialize($IIIII1l1l1ll['info']);
$this->IIIII1l1l1ll= $IIIII11I111I['weixin'];
if(ACTION_NAME == 'pay'&&empty($IIIII1l1l1ll['paysignkey'])){
$this->new_pay();
exit;
}
}else if(!empty($IIIII1l1l1ll['mchid'])){
$this->IIIII1l1l1ll['appid'] = $IIIII1l1l1ll['appid'];
$this->IIIII1l1l1ll['mchid'] = $IIIII1l1l1ll['mchid'];
$this->IIIII1l1l1ll['key'] = $IIIII1l1l1ll['paysignkey'];
$this->IIIII1l1l1ll['appsecret'] = $IIIII1l1l1ll['appsecret'];
if(ACTION_NAME == 'pay'){
$this->new_pay();
exit;
}
}else{
$this->IIIII1l1l1ll = $IIIII1l1l1ll;
}
}
public function new_pay(){
import('@.ORG.Weixinnewpay.WxPayPubHelper');
$IIIII11I1111 = new JsApi_pub($this->IIIII1l1l1ll['appid'],$this->IIIII1l1l1ll['mchid'],$this->IIIII1l1l1ll['key'],$this->IIIII1l1l1ll['appsecret']);
if (!isset($_GET['code'])){
$IIIIIII1l1Il = $IIIII11I1111->createOauthUrlForCode(urlencode(C('site_url').'/wxpay/index.php?g=Wap&m=Weixin&a=new_pay&price='.$_GET['price'].'&orderName='.$_GET['orderName'].'&single_orderid='.$_GET['single_orderid'].'&showwxpaytitle=1&from='.$_GET['from'].'&token='.$_GET['token'].'&wecha_id='.$_GET['wecha_id']));
Header("Location: $IIIIIII1l1Il");exit();
}
$IIIIIIIl1lII = $_GET['code'];
$IIIII11I1111->setCode($IIIIIIIl1lII);
$IIIIIIlIlIll = $IIIII11I1111->getOpenId();
$IIIIIl1Il1ll=$_GET['single_orderid'];
$IIIII11lIIII=new payHandle($this->IIIIIIIIlIlI,$_GET['from'],'weixin');
$IIIII11lIIIl=$IIIII11lIIII->beforePay($IIIIIl1Il1ll);
$IIIIIlIIIIIl=$IIIII11lIIIl['price'];
if($IIIII11lIIIl['paid']) exit('您已经支付过此次订单！');
$IIIII11lIII1 = new UnifiedOrder_pub($this->IIIII1l1l1ll['appid'],$this->IIIII1l1l1ll['mchid'],$this->IIIII1l1l1ll['key'],$this->IIIII1l1l1ll['appsecret']);
$IIIII11lIII1->setParameter("openid",$IIIIIIlIlIll);
$IIIII11lIII1->setParameter("body",$IIIIIl1Il1ll);
$IIIII11lIII1->setParameter("out_trade_no",$IIIIIl1Il1ll);
$IIIII11lIII1->setParameter("total_fee",$IIIIIlIIIIIl*100);
$IIIII11lIII1->setParameter("notify_url",C('site_url').'/wxpay/notice.php');
$IIIII11lIII1->setParameter("trade_type","JSAPI");
$IIIII11lIII1->setParameter("attach",'token='.$_GET['token'].'&wecha_id='.$_GET['wecha_id'].'&from='.$_GET['from']);
$IIIII11lIIlI = $IIIII11lIII1->getPrepayId();
$IIIII11I1111->setPrepayId($IIIII11lIIlI);
$IIIII11lIIll = $IIIII11I1111->getParameters();
$this->assign('jsApiParameters',$IIIII11lIIll);
$IIIIIl1Il1l1 = $_GET['from'];
$IIIIIl1Il1l1 = $IIIIIl1Il1l1 ?$IIIIIl1Il1l1 : 'Groupon';
$IIIIIl1Il1l1 = $IIIIIl1Il1l1!='groupon'?$IIIIIl1Il1l1 : 'Groupon';
$IIIII11lIIl1 = C('site_url').'/index.php?g=Wap&m='.$IIIIIl1Il1l1.'&a=payReturn&token='.$_GET['token'].'&wecha_id='.$_GET['wecha_id'].'&orderid='.$IIIIIl1Il1ll;
$this->assign('returnUrl',$IIIII11lIIl1);
echo '<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /><meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;" /><meta name="apple-mobile-web-app-capable" content="yes" /><meta name="apple-mobile-web-app-status-bar-style" content="black" /><meta name="format-detection" content="telephone=no" /><link href="/tpl/Wap/default/common/css/style/css/hotels.css" rel="stylesheet" type="text/css" /><title>微信支付</title><script language="javascript">function callpay(){WeixinJSBridge.invoke("getBrandWCPayRequest",'.$IIIII11lIIll.',function(res){WeixinJSBridge.log(res.err_msg);if(res.err_msg=="get_brand_wcpay_request:ok"){document.getElementById("payDom").style.display="none";document.getElementById("successDom").style.display="";setTimeout("window.location.href = \''.$IIIII11lIIl1.'\'",2000);}else{if(res.err_msg == "get_brand_wcpay_request:cancel"){var err_msg = "您取消了支付";}else if(res.err_msg == "get_brand_wcpay_request:fail"){var err_msg = "支付失败<br/>错误信息："+res.err_desc;}else{var err_msg = res.err_msg +"<br/>"+res.err_desc;}document.getElementById("payDom").style.display="none";document.getElementById("failDom").style.display="";document.getElementById("failRt").innerHTML=err_msg;}});}</script></head><body style="padding-top:20px;"><style>.deploy_ctype_tip{z-index:1001;width:100%;text-align:center;position:fixed;top:50%;margin-top:-23px;left:0;}.deploy_ctype_tip p{display:inline-block;padding:13px 24px;border:solid #d6d482 1px;background:#f5f4c5;font-size:16px;color:#8f772f;line-height:18px;border-radius:3px;}</style><div id="payDom" class="cardexplain"><ul class="round"><li class="title mb"><span class="none">支付信息</span></li><li class="nob"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="kuang"><tr><th>金额</th><td>'.floatval($_GET['price']).'元</td></tr></table></li></ul><div class="footReturn" style="text-align:center"><input type="button" style="margin:0 auto 20px auto;width:100%"  onclick="callpay()"  class="submit" value="点击进行微信支付" /></div></div><div id="failDom" style="display:none" class="cardexplain"><ul class="round"><li class="title mb"><span class="none">支付结果</span></li><li class="nob"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="kuang"><tr><th>支付失败</th><td><div id="failRt"></div></td></tr></table></li></ul><div class="footReturn" style="text-align:center"><input type="button" style="margin:0 auto 20px auto;width:100%"  onclick="callpay()"  class="submit" value="重新进行支付" /></div></div><div id="successDom" style="display:none" class="cardexplain"><ul class="round"><li class="title mb"><span class="none">支付成功</span></li><li class="nob"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="kuang"><tr><td>您已支付成功，页面正在跳转...</td></tr></table><div id="failRt"></div></li></ul></div></body></html>';
}
public function pay(){
import("@.ORG.Weixinpay.CommonUtil");
import("@.ORG.Weixinpay.WxPayHelper");
$IIIII11lII1I = new CommonUtil();
$IIIIIl1Il1ll=$_GET['single_orderid'];
$IIIII11lIIII=new payHandle($this->IIIIIIIIlIlI,$_GET['from'],'weixin');
$IIIII11lIIIl=$IIIII11lIIII->beforePay($IIIIIl1Il1ll);
$IIIIIlIIIIIl=$IIIII11lIIIl['price'];
if($IIIII11lIIIl['paid']) exit('您已经支付过此次订单！');
$IIIII11lII1l = new WxPayHelper($this->IIIII1l1l1ll['appid'],$this->IIIII1l1l1ll['paysignkey'],$this->IIIII1l1l1ll['partnerkey']);
$IIIII11lII1l->setParameter("bank_type","WX");
$IIIII11lII1l->setParameter("body",$IIIIIl1Il1ll);
$IIIII11lII1l->setParameter("partner",$this->IIIII1l1l1ll['partnerid']);
$IIIII11lII1l->setParameter("out_trade_no",$IIIIIl1Il1ll);
$IIIII11lII1l->setParameter("total_fee",$IIIIIlIIIIIl*100);
$IIIII11lII1l->setParameter("fee_type","1");
$IIIII11lII1l->setParameter("notify_url",C('site_url').'/index.php?g=Wap&m=Weixin&a=return_url&token='.$_GET['token'].'&wecha_id='.$_GET['wecha_id'].'&from='.$_GET['from']);
$IIIII11lII1l->setParameter("spbill_create_ip",$_SERVER['REMOTE_ADDR']);
$IIIII11lII1l->setParameter("input_charset","GBK");
$IIIIIII1l1Il=$IIIII11lII1l->create_biz_package();
$this->assign('url',$IIIIIII1l1Il);
$IIIIIl1Il1l1=$_GET['from'];
$IIIIIl1Il1l1=$IIIIIl1Il1l1?$IIIIIl1Il1l1:'Groupon';
$IIIIIl1Il1l1=$IIIIIl1Il1l1!='groupon'?$IIIIIl1Il1l1:'Groupon';
switch ($IIIIIl1Il1l1){
default:
case 'Groupon':
break;
}
$IIIII11lIIl1='/index.php?g=Wap&m='.$IIIIIl1Il1l1.'&a=payReturn&token='.$_GET['token'].'&wecha_id='.$_GET['wecha_id'].'&orderid='.$IIIIIl1Il1ll;
$this->assign('returnUrl',$IIIII11lIIl1);
echo '<html><head><meta http-equiv="Content-Type"content="text/html; charset=UTF-8"><meta name="viewport"content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;"><meta name="apple-mobile-web-app-capable"content="yes"><meta name="apple-mobile-web-app-status-bar-style"content="black"><meta name="format-detection"content="telephone=no"><link href="/tpl/Wap/default/common/css/style/css/hotels.css"rel="stylesheet"type="text/css"><title>微信支付</title></head><script language="javascript">function callpay(){WeixinJSBridge.invoke(\'getBrandWCPayRequest\','.$IIIIIII1l1Il.',function(res){WeixinJSBridge.log(res.err_msg);if(res.err_msg==\'get_brand_wcpay_request:ok\'){document.getElementById(\'payDom\').style.display=\'none\';document.getElementById(\'successDom\').style.display=\'\';setTimeout("window.location.href = \''.$IIIII11lIIl1.'\'",2000);}else{document.getElementById(\'payDom\').style.display=\'none\';document.getElementById(\'failDom\').style.display=\'\';document.getElementById(\'failRt\').innerHTML=res.err_code+\'|\'+res.err_desc+\'|\'+res.err_msg;}});}</script><body style="padding-top:20px;"><style>.deploy_ctype_tip{z-index:1001;width:100%;text-align:center;position:fixed;top:50%;margin-top:-23px;left:0;}.deploy_ctype_tip p{display:inline-block;padding:13px 24px;border:solid#d6d482 1px;background:#f5f4c5;font-size:16px;color:#8f772f;line-height:18px;border-radius:3px;}</style><div id="payDom"class="cardexplain"><ul class="round"><li class="title mb"><span class="none">支付信息</span></li><li class="nob"><table width="100%"border="0"cellspacing="0"cellpadding="0"class="kuang"><tr><th>金额</th><td>'.$IIIIIlIIIIIl.'元</td></tr></table></li></ul><div class="footReturn"style="text-align:center"><input type="button"style="margin:0 auto 20px auto;width:100%"onclick="callpay()"class="submit"value="点击进行微信支付"/></div></div><div id="failDom"style="display:none"class="cardexplain"><ul class="round"><li class="title mb"><span class="none">支付结果</span></li><li class="nob"><table width="100%"border="0"cellspacing="0"cellpadding="0"class="kuang"><tr><th>支付失败</th><td><div id="failRt"></div></td></tr></table></li></ul><div class="footReturn"style="text-align:center"><input type="button"style="margin:0 auto 20px auto;width:100%"onclick="callpay()"class="submit"value="重新进行支付"/></div></div><div id="successDom"style="display:none"class="cardexplain"><ul class="round"><li class="title mb"><span class="none">支付成功</span></li><li class="nob"><table width="100%"border="0"cellspacing="0"cellpadding="0"class="kuang"><tr><th>您已支付成功，页面正在跳转...</th></tr></table><div id="failRt"></div></td></tr></table></li></ul></div></body></html>';
}
public function new_return_url (){
$IIIIIl1Il1II = $this->_get('out_trade_no');
if(intval($_GET['total_fee']) &&!intval($_GET['trade_state'])) {
$IIIII11lIIII=new payHandle($_GET['token'],$_GET['from'],'weixin');
$IIIII11lIIIl=$IIIII11lIIII->afterPay($IIIIIl1Il1II,$_GET['transaction_id'],$_GET['transaction_id']);
exit('SUCCESS');
}else {
exit('付款失败');
}
}
public function return_url (){
S('pay',$_GET);
$IIIIIl1Il1II = $this->_get('out_trade_no');
if(intval($_GET['total_fee']) &&!intval($_GET['trade_state'])) {
$IIIII11lIIII=new payHandle($_GET['token'],$_GET['from'],'weixin');
$IIIII11lIIIl=$IIIII11lIIII->afterPay($IIIIIl1Il1II,$_GET['transaction_id'],$_GET['transaction_id']);
exit('SUCCESS');
}else {
exit('付款失败');
}
}
public function notify_url(){
echo "success";
eixt();
}
protected function api_notice_increment($IIIIIII1l1Il,$IIIIIIIIIl11){
$IIIIIIllI11I = curl_init();
$IIIIIIl11I1l = "Accept-Charset: utf-8";
curl_setopt($IIIIIIllI11I,CURLOPT_URL,$IIIIIII1l1Il);
curl_setopt($IIIIIIllI11I,CURLOPT_CUSTOMREQUEST,"POST");
curl_setopt($IIIIIIllI11I,CURLOPT_SSL_VERIFYPEER,FALSE);
curl_setopt($IIIIIIllI11I,CURLOPT_SSL_VERIFYHOST,FALSE);
curl_setopt($IIIIIIllll11,CURLOPT_HTTPHEADER,$IIIIIIl11I1l);
curl_setopt($IIIIIIllI11I,CURLOPT_USERAGENT,'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
curl_setopt($IIIIIIllI11I,CURLOPT_FOLLOWLOCATION,1);
curl_setopt($IIIIIIllI11I,CURLOPT_AUTOREFERER,1);
curl_setopt($IIIIIIllI11I,CURLOPT_POSTFIELDS,$IIIIIIIIIl11);
curl_setopt($IIIIIIllI11I,CURLOPT_RETURNTRANSFER,true);
$IIIIIIl11I11 = curl_exec($IIIIIIllI11I);
$IIIIIIl11lII=curl_errno($IIIIIIllI11I);
if ($IIIIIIl11lII) {
return array('rt'=>false,'errorno'=>$IIIIIIl11lII);
}else{
$IIIIIIl11lI1=json_decode($IIIIIIl11I11,1);
if ($IIIIIIl11lI1['errcode']=='0'){
return array('rt'=>true,'errorno'=>0);
}else {
$this->error('发生错误：错误代码'.$IIIIIIl11lI1['errcode'].',微信返回错误信息：'.$IIIIIIl11lI1['errmsg']);
}
}
}
}
?>