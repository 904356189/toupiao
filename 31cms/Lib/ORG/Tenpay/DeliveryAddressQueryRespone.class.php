<?php
//---------------------------------------------------------
//收货地址查询响应
//---------------------------------------------------------
require_once ("common/CommonResponse.class.php");
require_once ("common/util/XmlParseUtil.php");
require_once ("DeliveryAddressInfo.class.php");
class DeliveryAddressQueryRespone extends CommonResponse{
	
	// 地址列表
	var $deliveryAddresss = array();
	
	/**
	 * XML构造方法
	 * 
	 * @param xml        收货地址查询XML
	 * @param charset    XML字符集
	 */
	function DeliveryAddressQueryRespone($xml, $charset) {
		$this->CommonResponse($xml, $charset, null, true, false);
		$this->parseDeliveryAddress($xml, $charset);
	}

	/**
	 * 得到用户ID
	 * 
	 * @return  用户ID
	 */
	function getUser_id() {
		return $this->getParameter("user_id");
	}

	/**
	 * 得到APPID
	 * 
	 * @return  应用APPID,用户注册时由财付通统一分配
	 */
	function getApp_id() {
		return $this->getParameter("appid");
	}

	/**
	 * 得到收货地址列表
	 * 
	 * @return  收货地址列表
	 */
	function getDeliveryAddresss() {
		return $this->deliveryAddresss;
	}

	function setDeliveryAddresss($deliveryAddresss) {
		$this->deliveryAddresss = $deliveryAddresss;
	}
	/**
	 * 将xml解析为地址列表
	 * 
	 * @param xml       需要解析的XML
	 * @param charset   XML的字符集
	 */
	function parseDeliveryAddress($xml, $charset) {
		$doc = null;
		$xmlUtil = new XmlParseUtil();
		try {
			$doc = $xmlUtil->parseDoc($xml, $charset);
		} catch (Exception $e) {
			throw new SDKRuntimeException("解析xml失败:" . $xml . ",". $e);
		}
		$deliveryAddressInfo = null;
		$addresss = array();
		// 提取地址列表
		$root = $doc->documentElement;
		foreach($root->childNodes as $node) {
			if ($node->nodeName == "addressInfos") {
				foreach($node->childNodes as $child) {
					if ($child->nodeName == "item") {
						$node = $child;
						$deliveryAddressInfo = new DeliveryAddressInfo();
						foreach($node->childNodes as $child) {
							$value= iconv("UTF-8",$charset,$child->nodeValue); //注意要转码对于中文，因为XML默认为UTF-8格式
							$this->setAddressInfoAttr($deliveryAddressInfo,$child->nodeName,$value);
						}
						array_push($addresss,$deliveryAddressInfo);
					}
				}
			}
		}
		$this->setDeliveryAddresss($addresss);
	}
	
	/**
	 * 根据XML结点名称,设置DeliveryAddressInfo相应的属性
	 * 
	 * @param deliveryAddressInfo   需要设置的DeliveryAddressInfo对象
	 * @param nodeName              XML结点名称
	 * @param textContent           XML结点文本
	 */
	function setAddressInfoAttr($deliveryAddressInfo, $nodeName, $textContent) {
		if(strcmp("address",$nodeName)==0) {
			$deliveryAddressInfo->setAddress($textContent);
		} 
		
		if(strcmp("mobilePhone",$nodeName)==0) {
			$deliveryAddressInfo->setMobilePhone($textContent);
		} 
		
		if(strcmp("name",$nodeName)==0) {
			$deliveryAddressInfo->setName($textContent);
		} 
		
		if(strcmp("telPhone",$nodeName)==0) {
			$deliveryAddressInfo->setTelPhone($textContent);
		} 
		
		if(strcmp("zipCode",$nodeName)==0) {
			$deliveryAddressInfo->setZipCode($textContent);
		} 
	}
}


?>