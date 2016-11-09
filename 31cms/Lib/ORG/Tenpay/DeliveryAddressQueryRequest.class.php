<?php
//---------------------------------------------------------
//通知查询请求
//---------------------------------------------------------


require_once ("common/RetXmlRequest.class.php");
require_once ("DeliveryAddressQueryRespone.class.php");
class DeliveryAddressQueryRequest extends RetXmlRequest{
	
	function DeliveryAddressQueryRequest($secretKey) {
		parent::RetXmlRequest($secretKey);
	}
	
	function send(){
		$respone = new DeliveryAddressQueryRespone($this->httpCallRetXmlStr($this->DELIVERADDRESS_QUERY_OPPOSITE_ADDRESS), $this->getInputCharset());
		return $respone;
	}

}


?>