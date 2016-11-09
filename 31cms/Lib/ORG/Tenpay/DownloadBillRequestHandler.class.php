<?php

class DownloadBillRequestHandler extends RequestHandler{


	function WapResponseHandler(){
		parent::ResponseHandler();
	}

	function createSign(){
	
	$signPars="";
	$signPars=$signPars."spid=".$this->getParameter("spid"). "&" .
		        "trans_time=".$this->getParameter("trans_time"). "&" .
				"stamp=".$this->getParameter("stamp"). "&".
				"cft_signtype=".$this->getParameter("cft_signtype"). "&" .
				"mchtype=".$this->getParameter("mchtype"). "&" .
				"key=".$this->getKey();
				
	$sign = strtolower(md5($signPars));
	
	$this->setParameter("sign", $sign);
		
		//debug信息
		$this->_setDebugInfo($signPars . " => sign:" . $sign);
	
	}

}


