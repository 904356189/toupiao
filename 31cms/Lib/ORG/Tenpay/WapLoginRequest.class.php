<?php

require_once ("common/CommonRequest.class.php");
require_once ("common/CommonResponse.class.php");

/**
 * Wap登录请求类
 * 
 * @author marcyli
 * @date 2011-05-11
 * @php5
 * @version 1.0
 */
class WapLoginRequest extends CommonRequest
{
	
	var $serialVersionUID = 17438016780420756;
	
	var $WAP_LOGIN_ADDRESS = "https://wap.tenpay.com/cgi-bin/wapmainv2.0/loginsh_gate.cgi";
	var $SANDBOX_WAP_LOGIN_ADDRESS = "http://sandwap.tenpay.com/cgi-bin/wapmainv2.0/loginsh_gate.cgi";
	
	var $SIGN_ENCRYPT_KEYID = "sign_encrypt_keyid";
	var $VSERSION = "version";
	var $CHTYPE = "chtype";
	

	function WapLoginRequest($secretKey) {
		parent::__construct($secretKey);
		//super(secretKey);
		parent::setParameter($this->SIGN_ENCRYPT_KEYID, "0");
		parent::setParameter($this->VSERSION, "1.0");
		parent::setParameter($this->CHTYPE, "0");
		parent::setParameter($this->INPUT_CHARSET, "GBK");
	}
	
	/**
	 * 获取域名地址
	 */
	function getDomain() {
		$domain = null;
		if (parent::isInSandBox()) {
			$domain = $this->SANDBOX_WAP_LOGIN_ADDRESS;
		} else {
			$domain = $this->WAP_LOGIN_ADDRESS;
		}
		return $domain;
	}
	
	function getURL() {
		$url = $this->getDomain()."?".parent::genParaStr();
		return $url;
	}

	function send(){
		return null;
	}

}
?>