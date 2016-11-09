<?php
require_once ('common/CommonRequest.class.php');
require_once ('common/CommonResponse.class.php');
require_once('common/SDKRuntimeException.class.php');
/**
 * 微博请求对像。
 * <p>
 * 主要用于生成"转发微博按钮的html代码以及发送微博时需要传递的参数"。
 * 
 * @author Tenpay
 * @date 2011-03-28
 * @since jdk1.5
 * @version 1.0
 *
 */
class MicroBlogSendRequest extends CommonRequest {
	/**
	 * 
	 */
	var $serialVersionUID = -6949609732502344014;
	/** 发送微博确认页面URL定义  **/
	var $QQ_MICROBLOG_URL ='/gateway/microBlogSendConfirm.htm';
	
	function MicroBlogSendRequest($secretKey) {
		parent::__construct(secretKey);
	}
	
	
	/**
	 * 用于生成转发到微博按钮的HTML代码
	 * @return html内容
	 */
	function toHTML(){		
		$microBlogContent = parent::getParameter("content");
		if($microBlogContent == '' )
		throw Exception("microBlogContent不能为空!");
		$stringBuilder = '<link href="https://wallet.tenpay.com/mblog/css/release_button.css" rel="stylesheet" type="text/css" />';
		$stringBuilder = '<a href="'.$this->getURL().'" target="_blank" class="release-txmblog" title="转播到腾讯微博"><span>转播到腾讯微博</span></a>';
		return $stringBuilder;
	}
	
	/**
	 * 生成微博跳转的URl地址
	 * @return
	 */
	function getURL(){
		$fromUrl = parent::getParameter("fromUrl");
		if($fromUrl==null){			
			parent::setParameter("fromUrl", $this->getRequestURL(request));
		}
		$paraString = parent::genParaStr();
		$domain = parent::getDomain();
		return $domain.$this->QQ_MICROBLOG_URL.'?'.$paraString;
	}
	/**
	 * 构造全路径的URL
	 * @param request
	 * @return
	 */
	function getRequestURL($request){
		if($_SERVER['HTTPS'] != '')
			$builder = 'https://'.$_SERVER['SERVER_NAME'];
		else
			$builder = 'http://'.$_SERVER['SERVER_NAME'];
		if($_SERVER["SERVER_PORT"] >0 && $_SERVER["SERVER_PORT"] !=80){
			$builder = $builder.':'.$_SERVER["SERVER_PORT"];
		}
		$builder = $_SERVER['SERVER_NAME'];
		return $builder;
	}

	/**
	 * 
	 */
	function getInputCharset() {
		return parent::getInputCharset();
	}

    
	/**
	 * 对于微博的SDK必须传入以下参数
	 * key=content(代表微博内容,根据http协议，中文作为http参数，必须作encoder操作)
	 * key=picUrl(代表图片的全路径URL地址)
	 * key=fromUrl(在发送微博或分享到qzone时，需要用到的来源地址定义)
	 */
	function setParameter($key, $value) {
		parent::setParameter($key, $value);
	}


	/* (non-Javadoc)
	 * @see com.tenpay.api.common.CommonRequest#send()
	 */
	function send(){
		throw new Exception();
	}
}
?>