<?php
//---------------------------------------------------------
//订单查询响应
//---------------------------------------------------------

require_once ("common/CommonResponse.class.php");
class OrderQueryResponse extends CommonResponse {
	
	function OrderQueryResponse($paraMap, $secretKey) {
		$this->CommonResponse($paraMap, $secretKey);
	}
	
}


?>