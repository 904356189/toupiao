<?php
//---------------------------------------------------------
//通知查询响应
//---------------------------------------------------------
require_once ("common/CommonResponse.class.php");
class NotifyQueryResponse extends CommonResponse{
	
	function NotifyQueryResponse($paraMap, $secretKey) {
		$this->CommonResponse($paraMap, $secretKey);
	}
	
}


?>