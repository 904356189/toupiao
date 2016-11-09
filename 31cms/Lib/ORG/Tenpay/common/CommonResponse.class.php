<?php
//---------------------------------------------------------
//响应基础类，定义相关参数及处理
//---------------------------------------------------------

include_once ("SDKRuntimeException.class.php");
include_once("util/CommonUtil.php");
include_once("util/MD5SignUtil.php");
include_once("util/XmlParseUtil.php");
class CommonResponse {
	var $RETCODE = "retcode";
	var $RETMSG = "retmsg";
	var $TRADE_STATE = "trade_state";
	var $TRADE_STATE_SUCCESS = "0";
	/** 密钥 */
	var $secretKey;
	var $parameters = array();
	var $hasRetcode = true;
	var $hasSign = true;
	
	function __call($method, $arguments)
	{
		if ($method=="CommonResponse") {
			if(count($arguments)==2){
				$this->CommonResponse2($arguments[0],$arguments[1]);
			}
			if(count($arguments)==3){
				$this->CommonResponse3($arguments[0],$arguments[1],$arguments[2]);
			}
			if(count($arguments)==4){
				$this->CommonResponse4($arguments[0],$arguments[1],$arguments[2],$arguments[3]);
			}
			if(count($arguments)==5){
				$this->CommonResponse5($arguments[0],$arguments[1],$arguments[2],$arguments[3],$arguments[4]);
			}
		}
	}
	
	function CommonResponse2($paraMap,$secretKey) {
		$this->CommonResponse($paraMap, $secretKey, true);
	}
	
	function CommonResponse3($paraMap, $secretKey, $hasRetcode) {
		$this->CommonResponse($paraMap, $secretKey, $hasRetcode, true);
	}
	
	function CommonResponse4($paraMap, $secretKey, $hasRetcode, $hasSign) {
		$this->hasRetcode = $hasRetcode;
		$this->hasSign = $hasSign;
		$this->secretKey = $secretKey;
		unset($this->parameters);
		$this->parameters = $paraMap;
		if ($this->checkSign()) {
			$this->verifySign();
		}
	}
	
	function CommonResponse5($xml, $charset, $secretKey,$hasRetcode, $hasSign) {
		$xmlUtil = new XmlParseUtil();
		$this->CommonResponse4($xmlUtil->openapiXmlToMap($xml, $charset), $secretKey, $hasRetcode, $hasSign);
	}
	
	protected function verifySign(){
		try {
		if (null == $this->parameters) {
			throw new SDKRuntimeException("parameters为空!". "<br>");
		}
		
		$sign = $this->getParameter("sign");
		if (null == $sign) {
			throw new SDKRuntimeException("sign为空!". "<br>");
		}
		$charSet = $this->getParameter("input_charset");
		if (null == $charSet) {
			$charSet = Constants::DEFAULT_CHARSET;
		}
		$signStr = CommonUtil::formatQueryParaMap($this->parameters, false);
		if (null == $this->secretKey) {
			throw new SDKRuntimeException("签名key为空!". "<br>");
		}
		if(!MD5SignUtil::verifySignature($signStr,$sign,$this->secretKey)){
			throw new SDKRuntimeException("返回值签名验证失败!". "<br>");
		}
		return true;
		}catch (SDKRuntimeException $e)
		{
			die($e->errorMessage());
		}
	}
	/**
	 * 获取密钥
	 */
	function getSecretKey(){
		return $this->key;
	}
	/**
	 * 设置密钥
	 * 
	 * @param secretKey
	 *            密钥
	 */
	function setSecretKey($secretKey){
		$this->key = $secretKey;
	}
	/**
	*获取参数值
	*/
	function getParameter($parameter) {
		return $this->parameters[$parameter];
	}
	
	/**
	*设置参数值
	*/
	function setParameter($parameter, $parameterValue) {
		$this->parameters[$parameter] = $parameterValue;
	}
	
	/**
	 * 检查是否需要签名
	 * 
	 * @return 是否签名
	 */
	function checkSign() {
		return $this->isRetCodeOK() && $this->hasSign;
	}
	/**
	 * 接口调用是否成功
	 */
	function isRetCodeOK(){
		$code = (bool)$this->hasRetcode;
		return "0"==$this->getRetCode() || !$code;
	}
	
	function isPayed(){
		return $this->isRetCodeOK() && $this->TRADE_STATE_SUCCESS == $this->getParameter($this->TRADE_STATE);
	}
	/**
	 * 获取接口返回码
	 */
	function getRetCode(){
		return $this->getParameter($this->RETCODE);
	}
	/**
	 * 获取错误信息
	 */
	function getPayInfo(){
	    $info = $this->getParameter($this->RETMSG);
		if(null == CommonUtil::trimString($info) && !$this->isPayed()){
		   $info = "订单尚未支付成功";
		}
		return $info;
	}
	
	
}


?>