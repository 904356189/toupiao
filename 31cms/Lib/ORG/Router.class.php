<?php
final class Router {
	public $topdomain;
	public $key;
	public $smsapi_url;
	/**
	 * 
	 * 初始化接口类
	 * @param int $userid 用户id
	 * @param int $productid 产品id
	 * @param string $sms_key 密钥
	 */
	public function __construct() {
		
	}
	
	public function login($token,$openid) {
		$thisRouter=M('Router')->where(array('token'=>$token))->find();
		$wxuser=M('Wxuser')->where(array('token'=>$token))->find();
		$str='source_id='.$openid.'&target_id='.$wxuser['weixin'].'&type=1';
		$enstr=Router::ecryptdString($str,substr(trim(C('router_key')),0,16));
		//return 'http://verify.iMicms.cn/login/?gw_address=192.168.1.1&gw_port=2060&gw_id='.$thisRouter['gw_id'].'&mac=f8:2f:a8:f8:0e:39&url=wwws.iMicms.cn/index.html?a='.$enstr.'&b='.substr(trim(C('router_key')),0,16);
		return 'http://vvvv.iMicms.cn/verify.wifi?a='.$enstr.'&b='.substr(trim(C('router_key')),0,16);
	}
	protected function ecryptdString($str,$keys="6461772803150152",$iv="8105547186756005",$cipher_alg=MCRYPT_RIJNDAEL_128){
		//
		//
		//source_id=xxx&target_id=xxx&type=1
		$encrypted_string = bin2hex(mcrypt_encrypt($cipher_alg, $keys, $str, MCRYPT_MODE_CBC,$iv));
		return $encrypted_string;
	}
	/*
	* 实现AES解密
	* $str : 要解密的字符串
	* $keys : 加密密钥
	* $iv : 加密向量
	* $cipher_alg : 加密方式
	*/
	protected function decryptString($str,$keys="6461772803150152",$iv="8105547186756005",$cipher_alg=MCRYPT_RIJNDAEL_128){
		$decrypted_string = mcrypt_decrypt($cipher_alg, $keys, pack("H*",$str),MCRYPT_MODE_CBC, $iv);
		return $decrypted_string;
	}

	function curlGet($url){
		$ch = curl_init();
		$header = "Accept-Charset: utf-8";
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$temp = curl_exec($ch);
		return $temp;
	}
}
?>