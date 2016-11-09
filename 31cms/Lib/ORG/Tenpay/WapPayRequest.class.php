<?php

require_once ('common/CommonRequest.class.php');
require_once ('common/CommonResponse.class.php');
require_once('common/util/XmlParseUtil.php');
require_once('common/util/HttpClientUtil.php');
require_once('WapPayInitResponse.class.php');
require_once('common/SDKRuntimeException.class.php');
//require_once('common/util/XmlParseUtil.php');
/**
 * Wap支付请求对象<br/>
 * 根据设置参数生成支付请求url
 * 
 * @author reymondtu
 * @date 2010-12-06
 * @since jdk1.5
 * @version 1.1.0
 */
class WapPayRequest extends CommonRequest {

	/**
	 * 构造方法
	 * 
	 * @param secretKey
	 *            加密KEY
	 */
	function WapPayRequest($secretKey) {
		parent::__construct($secretKey);
	}

	/**
	 * 生成支付跳转链接
	 * 
	 * @return Wap支付中心URL
	 * @throws Exception Wap支付中心连接异常, Wap支付中心初始化返回异常
	 */
	function getURL(){
		$paraString = parent::genParaStr();
		$domain = parent::getDomain();
		$url = $domain . parent::$this->WAP_PAY_OPPOSITE_ADDRESS . '?' . $paraString;
		try {
			$http	= new HttpClientUtil();
			$util	= new XmlParseUtil();
			$str = $http->httpClientCall($url,"utf-8");
			$wapPayInitResponse = new WapPayInitResponse(
				$util->openapiXmlToMap($str,"utf-8"),
				parent::getSecretKey()
				);
		} catch (SDKRuntimeException $e){
			die($e->errorMessage());
			throw new SDKRuntimeException('Wap支付中心连接异常.'. $e->getMessage(), e);
		}
		if ($wapPayInitResponse && $wapPayInitResponse->isRetCodeOK()) {
			return $wapPayInitResponse->getURL();
		} else {
			throw new SDKRuntimeException('Wap支付中心初始化返回异常.'.$wapPayInitResponse->getMessage());
		}
	}

	function send(){
		return null;
	}
	
	var $serialVersionUID = 6463049083989401969;

}