<?php
/**
 * *****************
 * @author  leonliang
 * @version 2010-10-14
 * @desc 增加Response的扩展，支持isTenpaySign的数组过滤
 * 
 * 
 */
class WapResponseHandler extends ResponseHandler {
	
	function __construct() {
		$this->WapResponseHandler();
	}
	
	function WapResponseHandler(){
		parent::ResponseHandler();
	}
	
	function isTenpaySign() {
		//签名需要按照数组中存在的元素进行
		$keysArr = array(				
				"ver",
				"charset",
				"pay_result",
				"transaction_id",
				"sp_billno",
				"total_fee",
				"fee_type",
				"bargainor_id",
				"attach",
				"time_end"
		);	
		return parent::isTenpaySign($keysArr);	
	}
}