<?php
//---------------------------------------------------------
//处理返回的xml数据
//---------------------------------------------------------

class XmlParseUtil{
	
	/**
	 * 解析xml字符串为Document对象
	 * 
	 * @param xmlStr
	 * @param charsetName
	 * @return
	 */
	function parseDoc($xmlStr, $charsetName){
		$dom = new DOMDocument('1.0', $charsetName);
        $dom->loadXML($xmlStr);
		return $dom;
	}
	
	/**
	 * 将xml解析为map
	 * 
	 * @param xml
	 * @param charset
	 * @return
	 */
	function openapiXmlToMapByDoc($doc, $charset) {
		$doc->normalize();
		$root = $doc->documentElement; //获取XML数据的根
		$nodeList = $root->childNodes; //获得$node的所有子节点
		return $this->openapiXmlToMapByNodeList($nodeList, $charset);
	}

	/**
	 * 将xml nodelist解析为map
	 * 
	 * @param xml
	 * @param charset
	 * @return
	 */
	function openapiXmlToMapByNodeList($nodeList, $charset) {
		$hashMap = array();
		if(!empty($nodeList)){
			foreach($nodeList as $e) //循环读取每一个子节点
			{
				if($e->nodeType == XML_ELEMENT_NODE) //如果子节点为节点对象，则调用函数处理
				{
					$value= iconv("UTF-8",$charset,$e->nodeValue); //注意要转码对于中文，因为XML默认为UTF-8格式
					$hashMap[$e->nodeName] = $value;
				}
			}
		}
		return $hashMap;
	}

	/**
	 * 将xml解析为map
	 * 
	 * @param xml
	 * @param charset
	 * @return
	 */
	function openapiXmlToMap($xml, $charset) {
		$stringDOM = new DOMDocument();
		try{
			@$stringDOM->loadXML($xml);
			return $this->openapiXmlToMapByDoc($stringDOM, $charset);
		}
		catch(Exception $e){
			throw new SDKRuntimeException("解析xml失败:" . $xml . ",". $e . "<br>");
		}
	}
	
	/**
	 * 得到唯一结点的文本
	 * 
	 * @param doc      XML Document
	 * @param tagName  结点名
	 * @return
	 */
	function getSingleValue($doc, $tagName) {
		$tmp_tag = $doc->getElementsByTagName($TagName);
        $tmp_value = $tmp_tag -> nodeValue;
        return iconv("UTF-8","GBK",$tmp_value);
	}

	
}


?>