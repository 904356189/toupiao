<?php
//---------------------------------------------------------
//支付请求
//---------------------------------------------------------

require_once ("common/CommonRequest.class.php");
class PayRequest extends CommonRequest {
	
	/**
	 * secretKey
	 * @param secretKey
	 */
	function PayRequest($secretKey) {
		parent::__construct($secretKey);
	}
	
	/**
	 * 生成支付跳转链接
	 */
	function getURL(){
		$paraString = $this->genParaStr();
		$domain = $this->getDomain();
		return $domain . $this->PAY_OPPOSITE_ADDRESS . "?" . $paraString;
	}
	
	function send(){
		return null;
	}
	
}


?>