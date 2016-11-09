<?php
//---------------------------------------------------------
//请求基础类，定义相关参数及处理
//---------------------------------------------------------

require_once ("Constants.class.php");
require_once ("SDKRuntimeException.class.php");
require_once ("util/CommonUtil.php");
require_once ("util/MD5SignUtil.php");
class CommonRequest {
	var $SIGN_TYPE = "sign_type";
	var $SERVICE_VERSION = "service_version";
	var $INPUT_CHARSET = "input_charset";
	var $APPID = "appid";
	var $SIGN_KEY_INDEX = "sign_key_index";
	var $SIGN = "sign";
	var $SANDBOX_ADDRESS = "https://sandbox.tenpay.com/api";
	var $API_ADDRESS = "https://api.tenpay.com";
	
	//支付相对地址
	var $PAY_OPPOSITE_ADDRESS = "/gateway/pay.htm";
	//订单查询相对地址
	var $NORMALQUERY_OPPOSITE_ADDRESS = "/gateway/normalorderquery.xml";
	//通知验证相对地址
	var $VERIFY_NOTIFY_OPPOSITE_ADDRESS = "/gateway/verifynotifyid.xml";

	 //获取收获地址URL
	var $DELIVERADDRESS_QUERY_OPPOSITE_ADDRESS = "/gateway/querydeliveryaddress.xml";
	//Wap支付初始化相对地址
	var $WAP_PAY_OPPOSITE_ADDRESS = "/gateway/wappayinit.xml";
	
	//支付相对地址
	var $SMS_SEND_ADDRESS = "/sms/sender.xml";
	
	var $secretKey;
	var $inSandBox = false;
	
	var $connectTimeout = 3000;
	
	var $timeout = 10000;
	//参数
	var $parameters = array();
	
	function __construct($secretKey) {
		$this->secretKey = $secretKey;
	}
	
	function genParaStr(){
		try {
			if (null == $this->getAppid()) {
				throw new SDKRuntimeException("appid不能为空！" . "<br>");
			}
			
			if (null == $this->getSecretKey()) {
				throw new SDKRuntimeException("密钥不能为空！" . "<br>");
			}
			$commonUtil = new CommonUtil();
			ksort($this->parameters);
			$unSignParaString = $commonUtil->formatQueryParaMap($this->parameters, false);
			$paraString = $commonUtil->formatQueryParaMap($this->parameters, true);

			$md5SignUtil = new MD5SignUtil();
			return $paraString . "&sign=" . $md5SignUtil->sign($unSignParaString,$commonUtil->trimString($this->getSecretKey()));
		}catch (SDKRuntimeException $e)
		{
			die($e->errorMessage());
		}

	}
	/**
	*获取业务参数值
	*/
	function getParameter($parameter) {
		return $this->parameters[$parameter];
	}
	
	/**
	*设置业务参数值
	*/
	function setParameter($parameter, $parameterValue) {
		$commonUtil = new CommonUtil();
		$this->parameters[$commonUtil->trimString($parameter)] = $commonUtil->trimString($parameterValue);
	}
	
	function getConnectTimeout() {
		return $this->connectTimeout;
	}

	/**
	 * 设置连接超时
	 * 
	 * @param connectTimeout
	 */
	function setConnectTimeout($connectTimeout) {
		$this->connectTimeout = $connectTimeout;
	}
	
	function getTimeout(){
		return $this->timeout;
	}
	
	function setTimeout($timeout){
		$this->timeout = $timeout;
	}
	
	function getSignType(){
		return $this->getParameter($this->SIGN_TYPE);
	}
	
	function setSignType($signType){
		$this->setParameter($this->SIGN_TYPE, $signType);
	}
	
	function getServiceVersion(){
		return $this->getParameter($this->SERVICE_VERSION);
	}
	
	function setServiceVersion($serviceVersion){
		$this->setParameter($this->SERVICE_VERSION, $serviceVersion);
	}
	
	function getInputCharset(){
		$charSet = null;
		if (array_key_exists($this->INPUT_CHARSET, $this->parameters)){
			$charSet = $this->getParameter($this->INPUT_CHARSET);
		}
		if(null == $charSet){
			$constants = new Constants();
			// 默认为GBK
			$charSet = $constants->DEFAULT_CHARSET;
		}
		return $charSet;
	}
	
	function setInputCharset($inputCharset){
		$this->setParameter($this->INPUT_CHARSET, $inputCharset);
	}
	
	function getSign(){
		return $this->getParameter($this->SIGN);
	}
	
	function setSign($sign){
		$this->setParameter($this->SIGN, $sign);
	}
	
	function getAppid(){
		return $this->getParameter($this->APPID);
	}
	
	/**
	 * 设置应用ID
	 * 
	 * @param appid
	 *            应用ID
	 */
	function setAppid($appid){
		$this->setParameter($this->APPID, $appid);
	}
	
	function getSignKeyIndex(){
		return $this->getParameter($this->SIGN_KEY_INDEX);
	}
	
	function setSignKeyIndex($signKeyIndex){
		$this->setParameter($this->SIGN_KEY_INDEX, $signKeyIndex);
	}
	
	/**
	 * 获取密钥
	 */
	function getSecretKey(){
		return $this->secretKey;
	}
	/**
	 * 设置密钥
	 * 
	 * @param secretKey
	 *            密钥
	 */
	function setSecretKey($secretKey){
		$this->secretKey = $secretKey;
	}
	
	/**
	 * 获取是否在沙箱环境
	 */
	function isInSandBox() {
		return $this->inSandBox;
	}
	
	/**
	 * 设置是否在沙箱环境
	 * 
	 * @param inSandBox
	 *            true表示请求发送到沙箱环境，false表示请求发送到正式环境
	 */
	function setInSandBox($inSandBox) {
		$this->inSandBox = $inSandBox;
	}
	
	/**
	 * 获取域名地址
	 *
	 * @return 接口地址
	 */
	function getDomain(){
		$domain;
		if($this->isInSandBox()) {
			$domain = $this->SANDBOX_ADDRESS;
		}else{
			$domain = $this->API_ADDRESS;
		}
		return $domain;
	}

	protected function send(){
		
	}

}

?>