<?php

require_once ("common/CommonResponse.class.php");

/**
 * Wap支付初始化相应对象
 * 
 * @author reymondtu
 * @date 2010-12-06
 * @since php5
 * @version 1.1.0
 *
 */
class WapPayInitResponse extends CommonResponse {

	var $serialVersionUID = -6343534412212614956;

	function WapPayInitResponse($paraMap, $secretKey) {
		parent::CommonResponse($paraMap, $secretKey);
	}
	
	function isRetCodeOK() {
		return parent::isRetCodeOK();
	}
	
	function getURL() {
		return parent::getParameter("url");
	}
	
	function getMessage() {
		return parent::getParameter("message");
	}
}
