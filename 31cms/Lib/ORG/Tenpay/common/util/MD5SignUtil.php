<?php
//---------------------------------------------------------
//MD5加密处理类
//---------------------------------------------------------


class MD5SignUtil {
	
	function sign($content, $key) {
	    try {
		    if (null == $key) {
			   throw new SDKRuntimeException("签名key为空！" . "<br>");
		    }
			if (null == $content) {
			   throw new SDKRuntimeException("加密串为空！" . "<br>");
		    }
		    $signStr = $content . "&key=" . $key;
		
		    return md5($signStr);
		}catch (SDKRuntimeException $e)
		{
			die($e->errorMessage());
		}
	}
	
	function verifySignature($content, $sign, $md5Key) {
		$signStr = $content . "&key=" . $md5Key;
		$calculateSign = strtolower(md5($signStr));
		$tenpaySign = strtolower($sign);
		return $calculateSign == $tenpaySign;
	}
	
}


?>