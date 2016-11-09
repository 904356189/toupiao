<?php
//---------------------------------------------------------
//参数字符处理类
//---------------------------------------------------------

class CommonUtil{
	/**
	 * 估计url和参数生成完整连接
	 * 
	 * @param toURL
	 * @param paras
	 * @return
	 */
	function genAllUrl($toURL, $paras) {
		$allUrl = null;
		if(null == $toURL){
			die("toURL is null");
		}
		if (strripos($toURL,"?") =="") {
			$allUrl = $toURL . "?" . $paras;
		}else {
			$allUrl = $toURL . "&" . $paras;
		}

		return $allUrl;
	}
	
	/**
	 * 将参数传按照给定连接符拆开 参数名称与值之间用=连接
	 * 
	 * @param src
	 * @param token
	 * @return
	 */
	function splitParaStr($src, $token) {
		$resMap = array();
		$items = explode($token,$src);
		foreach ($items as $item){
			$paraAndValue = explode("=",$item);
			if ($paraAndValue != "") {
				$resMap[$paraAndValue[0]] = $parameterValue[1];
			}
		}
		return $resMap;
	}
	
	/**
	 * trim 0长字符串转换为null
	 * 
	 * @param value
	 * @return
	 */
	function trimString($value){
		$ret = null;
		if (null != $value) {
			$ret = $value;
			if (strlen($ret) == 0) {
				$ret = null;
			}
		}
		return $ret;
	}
	
	function formatQueryParaMap($paraMap, $urlencode){
		$buff = "";
		ksort($paraMap);
		foreach ($paraMap as $k => $v){
			if (null != $v && "null" != $v && "sign" != $k) {
			    if($urlencode){
				   $v = urlencode($v);
				}
				$buff .= $k . "=" . $v . "&";
			}
		}
		$reqPar;
		if (strlen($buff) > 0) {
			$reqPar = substr($buff, 0, strlen($buff)-1);
		}
		return $reqPar;
	}
	
}


?>