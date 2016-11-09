<?php
/**
 * *****************
 * @author  leonliang
 * @version 2010-10-14
 * @desc 增加Response的扩展，支持isTenpaySign的数组过滤
 * 
 * 
 */
class WapNotifyResponseHandler extends ResponseHandler {
	
	function __construct() {
		$this->WapNotifyResponseHandler();
	}
	
	function WapNotifyResponseHandler(){
		parent::ResponseHandler();
	}
	
	function isTenpaySign() {
		//签名需要按照数组中存在的元素进行
		$keysArr = array(				
				"ver",
				"charset",
				"bank_type",
				"bank_billno", //选填
				"pay_result",
				"pay_info",     //选填
				"purchase_alias",  
				"bargainor_id",  
				"transaction_id",
				"sp_billno",
				"total_fee",
				"fee_type",
				"attach",
				"time_end"
		);	
		return parent::isTenpaySign($keysArr);	
	}
}