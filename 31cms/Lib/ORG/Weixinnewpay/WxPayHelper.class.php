<?php
/**
* 
*/
include_once("CommonUtil.class.php");
include_once("SDKRuntimeException.class.php");
include_once("MD5SignUtil.php");
class WxPayHelper
{
	var $parameters; //cft 参数
	public $appid;
	public $appKey;
	public $partnerKey;
	function __construct($appid,$appkey,$partnerkey)
	{
		
		$this->appid=$appid;
		$this->appKey=$appkey;
		$this->partnerKey=$partnerkey;
		
	}
	function setParameter($parameter, $parameterValue) {
		$this->parameters[CommonUtil::trimString($parameter)] = CommonUtil::trimString($parameterValue);
	}
	function getParameter($parameter) {
		return $this->parameters[$parameter];
	}
	protected function create_noncestr( $length = 16 ) {  
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";  
		$str ="";  
		for ( $i = 0; $i < $length; $i++ )  {  
			$str.= substr($chars, mt_rand(0, strlen($chars)-1), 1);  
			//$str .= $chars[ mt_rand(0, strlen($chars) - 1) ];  
		}  
		return $str;  
	}
	function check_cft_parameters(){
		if($this->parameters["bank_type"] == null || $this->parameters["body"] == null || $this->parameters["partner"] == null || 
			$this->parameters["out_trade_no"] == null || $this->parameters["total_fee"] == null || $this->parameters["fee_type"] == null ||
			$this->parameters["notify_url"] == null || $this->parameters["spbill_create_ip"] == null || $this->parameters["input_charset"] == null
			)
		{
			return false;
		}
		return true;

	}
	protected function get_cft_package(){
		try {
			
			if (null == $this->partnerKey || "" == $this->partnerKey ) {
				throw new SDKRuntimeException("密钥不能为空！" . "<br>");
			}
			$commonUtil = new CommonUtil();
			ksort($this->parameters);
			$unSignParaString = $commonUtil->formatQueryParaMap($this->parameters, false);
			$paraString = $commonUtil->formatQueryParaMap($this->parameters, true);

			$md5SignUtil = new MD5SignUtil();
			return $paraString . "&sign=" . $md5SignUtil->sign($unSignParaString,$commonUtil->trimString($this->partnerKey));
		}catch (SDKRuntimeException $e)
		{
			die($e->errorMessage());
		}

	}
	protected function get_biz_sign($bizObj){
		 foreach ($bizObj as $k => $v){
			 $bizParameters[strtolower($k)] = $v;
		 }
		 try {
		 	if($this->appKey == ""){
		 			throw new SDKRuntimeException("$this->appKey为空！" . "<br>");
		 	}
		 	$bizParameters["appkey"] = $this->appKey;
		 	ksort($bizParameters);
		 	//var_dump($bizParameters);
		 	$commonUtil = new CommonUtil();
		 	$bizString = $commonUtil->formatBizQueryParaMap($bizParameters, false);
		 	//var_dump($bizString);
		 	return sha1($bizString);
		 }catch (SDKRuntimeException $e)
		 {
			die($e->errorMessage());
		 }
	}
	//生成app支付请求json
	/*
    {
	"appid":"wwwwb4f85f3a797777",
	"traceid":"crestxu",
	"noncestr":"111112222233333",
	"package":"bank_type=WX&body=XXX&fee_type=1&input_charset=GBK&notify_url=http%3a%2f%2f
		www.qq.com&out_trade_no=16642817866003386000&partner=1900000109&spbill_create_ip=127.0.0.1&total_fee=1&sign=BEEF37AD19575D92E191C1E4B1474CA9",
	"timestamp":1381405298,
	"app_signature":"53cca9d47b883bd4a5c85a9300df3da0cb48565c",
	"sign_method":"sha1"
	}
	*/
	function create_app_package($traceid=""){
		//echo $this->create_noncestr();
        try {
           //var_dump($this->parameters);
		   if($this->check_cft_parameters() == false) {
			   throw new SDKRuntimeException("生成package参数缺失！" . "<br>");
		    }
		    $nativeObj["appid"] = $this->appid;
		    $nativeObj["package"] = $this->get_cft_package();
		    $nativeObj["timestamp"] = time();
		    $nativeObj["traceid"] = $traceid;
		    $nativeObj["noncestr"] = $this->create_noncestr();
		    $nativeObj["app_signature"] = $this->get_biz_sign($nativeObj);
		    $nativeObj["sign_method"] = SIGNTYPE;


		   
		    return   json_encode($nativeObj);

		   
		}catch (SDKRuntimeException $e)
		{
			die($e->errorMessage());
		}		
	}
	//生成jsapi支付请求json
	/*
	"appId" : "wxf8b4f85f3a794e77", //公众号名称，由商户传入
	"timeStamp" : "189026618", //时间戳这里随意使用了一个值
	"nonceStr" : "adssdasssd13d", //随机串
	"package" : "bank_type=WX&body=XXX&fee_type=1&input_charset=GBK&notify_url=http%3a%2f
	%2fwww.qq.com&out_trade_no=16642817866003386000&partner=1900000109&spbill_create_i
	p=127.0.0.1&total_fee=1&sign=BEEF37AD19575D92E191C1E4B1474CA9",
	//扩展字段，由商户传入
	"signType" : "SHA1", //微信签名方式:sha1
	"paySign" : "7717231c335a05165b1874658306fa431fe9a0de" //微信签名
	*/
	function create_biz_package(){
		 try {
		  
			if($this->check_cft_parameters() == false) {  
				
			   throw new SDKRuntimeException("生成package参数缺失！" . "<br>");
		    }
		    $nativeObj["appId"] = $this->appid;
		    $nativeObj["package"] = $this->get_cft_package();
		    $nativeObj["timeStamp"] = strval(time());
		    $nativeObj["nonceStr"] = $this->create_noncestr();
		    $nativeObj["paySign"] = $this->get_biz_sign($nativeObj);
		    $nativeObj["signType"] = SIGNTYPE;
		   
		    return   json_encode($nativeObj);
		   
		}catch (SDKRuntimeException $e)
		{
			die($e->errorMessage());
		}		   
		
	}
	//生成原生支付url
	/*
	weixin://wxpay/bizpayurl?sign=XXXXX&appid=XXXXXX&productid=XXXXXX&timestamp=XXXXXX&noncestr=XXXXXX
	*/
	function create_native_url($productid){

			$commonUtil = new CommonUtil();
		    $nativeObj["appid"] = $this->appid;
		    $nativeObj["productid"] = urlencode($productid);
		    $nativeObj["timestamp"] = time();
		    $nativeObj["noncestr"] = $this->create_noncestr();
		    $nativeObj["sign"] = $this->get_biz_sign($nativeObj);
		    $bizString = $commonUtil->formatBizQueryParaMap($nativeObj, false);
		    return "weixin://wxpay/bizpayurl?".$bizString;
		    
	}
	//生成原生支付请求xml
	/*
	<xml>
    <AppId><![CDATA[wwwwb4f85f3a797777]]></AppId>
    <Package><![CDATA[a=1&url=http%3A%2F%2Fwww.qq.com]]></Package>
    <TimeStamp> 1369745073</TimeStamp>
    <NonceStr><![CDATA[iuytxA0cH6PyTAVISB28]]></NonceStr>
    <RetCode>0</RetCode>
    <RetErrMsg><![CDATA[ok]]></ RetErrMsg>
    <AppSignature><![CDATA[53cca9d47b883bd4a5c85a9300df3da0cb48565c]]>
    </AppSignature>
    <SignMethod><![CDATA[sha1]]></ SignMethod >
    </xml>
	*/
	function create_native_package($retcode = 0, $reterrmsg = "ok"){
		 try {
		   if($this->check_cft_parameters() == false && $retcode == 0) {   //如果是正常的返回， 检查财付通的参数
			   throw new SDKRuntimeException("生成package参数缺失！" . "<br>");
		    }
		    $nativeObj["AppId"] = $this->appid;
		    $nativeObj["Package"] = $this->get_cft_package();
		    $nativeObj["TimeStamp"] = time();
		    $nativeObj["NonceStr"] = $this->create_noncestr();
		    $nativeObj["RetCode"] = $retcode;
		    $nativeObj["RetErrMsg"] = $reterrmsg;
		    $nativeObj["AppSignature"] = $this->get_biz_sign($nativeObj);
		    $nativeObj["SignMethod"] = SIGNTYPE;
		    $commonUtil = new CommonUtil();

		    return  $commonUtil->arrayToXml($nativeObj);
		   
		}catch (SDKRuntimeException $e)
		{
			die($e->errorMessage());
		}		

	}

}

?>