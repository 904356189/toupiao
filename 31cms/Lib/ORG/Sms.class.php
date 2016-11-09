<?php
final class Sms {
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
	
	public function checkmobile($mobilephone) {
		$mobilephone = trim($mobilephone);
		if(preg_match("/^13[0-9]{1}[0-9]{8}$|15[01236789]{1}[0-9]{8}$|18[01236789]{1}[0-9]{8}$/",$mobilephone)){
			return  $mobilephone;
		} else {
			return false;
		}
	}
	
	/**
	 * 
	 * 批量发送短信
	 * @param array $mobile 手机号码
	 * @param string $content 短信内容
	 * @param datetime $send_time 发送时间
	 * @param string $charset 短信字符类型 gbk / utf-8
	 * @param string $id_code 唯一值 、可用于验证码
	 */
	public function sendSms($token, $content='',$mobile='', $send_time='', $charset='utf-8',$id_code = '') {
		$companyid=0;
		if(!(strpos($token,'_') === FALSE)){
			$sarr=explode('_',$token);
			$token=$sarr[0];
			$companyid=intval($sarr[1]);
		}
		if (!$mobile){
			$companyWhere=array();
			$companyWhere['token']=$token;
			if ($companyid){
				$companyWhere['id']=$companyid;
			}
			$company=M('Company')->where($companyWhere)->find();
			$mobile=$company['mp'];
		}
		//
		$thisWxUser=M('Wxuser')->where(array('token'=>Sms::_safe_replace($token)))->find();
		$thisUser=M('Users')->where(array('id'=>$thisWxUser['uid']))->find();
		if ($token=='admin'){
			$thisUser=array('id'=>0);
			$thisWxUser=array('uid'=>0,'token'=>$this->token);
		}
		//if ($token!='admin'){
		if ($thisUser['smscount']<1){
			//echo "fffffffffffffffffffff";
			//exit;
			
				
		}else {
			//
			//短信发送状态
			if(is_array($mobile)){
				$mobile = implode(",", $mobile);
			}

			$content = Sms::_safe_replace($content);
			$data = array(
			'topdomain' => C('server_topdomain'),
			'key' => C('sms_key'),
			'token' => $token,
			'content' => $content,
			'mobile'=>$mobile,
			'mobileids'=>'11'
			);
			$post = '';
			foreach($data as $k=>$v) {
				$post .= $k.'='.$v.'&';
			}

			//$smsapi_senturl = 'http://up.weiyiyi.cn/oa/admin.php?m=sms&c=sms&a=send';			
			$smsapi_senturl=C('sms_url');
			$uid=C('uid');
			$pwd=C('pwd');
			$mobile=$data['mobile'];
			$content=$data['content'];
			$mobileids=C('mobileids');

			//$return = Sms::_post($smsapi_senturl, 0, $post);
			$return=Sms::send_SMS($smsapi_senturl,$uid,$pwd,$mobile,$content,$mobileids);
			

			$arr = explode('&',$return);
			$sta=explode("=",$arr[1]);			
			$this->statuscode = $sta[1];
			//增加到本地数据库
			$row=array('uid'=>$thisUser['id'],'token'=>$thisWxUser['token'],'time'=>time(),'mp'=>$mobile,'text'=>$content,'status'=>$this->statuscode,'price'=>C('sms_price'));
			M('Sms_record')->add($row);
			if (intval($this->statuscode)==100&&$token!='admin'){
				M('Users')->where(array('id'=>$thisWxUser['uid']))->setDec('smscount');
			}
			//end
			//print_r($return);
			//exit;
			return $this->statuscode;
			
		}
	}
		
	
	
	/**
	 *  post数据
	 *  @param string $url		post的url
	 *  @param int $limit		返回的数据的长度
	 *  @param string $post		post数据，字符串形式username='dalarge'&password='123456'
	 *  @param string $cookie	模拟 cookie，字符串形式username='dalarge'&password='123456'
	 *  @param string $ip		ip地址
	 *  @param int $timeout		连接超时时间
	 *  @param bool $block		是否为阻塞模式
	 *  @return string			返回字符串
	 */
	
	private function _post($url, $limit = 0, $post = '', $cookie = '', $ip = '', $timeout = 15, $block = true) {
		$return = '';
		$url=str_replace('&amp;','&',$url);
		$matches = parse_url($url);
		$host = $matches['host'];
		$path = $matches['path'] ? $matches['path'].($matches['query'] ? '?'.$matches['query'] : '') : '/';
		$port = !empty($matches['port']) ? $matches['port'] : 80;
		$siteurl = Sms::_get_url();
		if($post) {
			$out = "POST $path HTTP/1.1\r\n";
			$out .= "Accept: */*\r\n";
			$out .= "Referer: ".$siteurl."\r\n";
			$out .= "Accept-Language: zh-cn\r\n";
			$out .= "Content-Type: application/x-www-form-urlencoded\r\n";
			$out .= "User-Agent: $_SERVER[HTTP_USER_AGENT]\r\n";
			$out .= "Host: $host\r\n" ;
			$out .= 'Content-Length: '.strlen($post)."\r\n" ;
			$out .= "Connection: Close\r\n" ;
			$out .= "Cache-Control: no-cache\r\n" ;
			$out .= "Cookie: $cookie\r\n\r\n" ;
			$out .= $post ;
		} else {
			$out = "GET $path HTTP/1.1\r\n";
			$out .= "Accept: */*\r\n";
			$out .= "Referer: ".$siteurl."\r\n";
			$out .= "Accept-Language: zh-cn\r\n";
			$out .= "User-Agent: $_SERVER[HTTP_USER_AGENT]\r\n";
			$out .= "Host: $host\r\n";
			$out .= "Connection: Close\r\n";
			$out .= "Cookie: $cookie\r\n\r\n";
		}
		$fp = @fsockopen(($ip ? $ip : $host), $port, $errno, $errstr, $timeout);
		if(!$fp) return '';
		
		stream_set_blocking($fp, $block);
		stream_set_timeout($fp, $timeout);
		@fwrite($fp, $out);
		$status = stream_get_meta_data($fp);
	
		if($status['timed_out']) return '';	
		while (!feof($fp)) {
			if(($header = @fgets($fp)) && ($header == "\r\n" ||  $header == "\n"))  break;				
		}
		
		$stop = false;
		while(!feof($fp) && !$stop) {
			$data = fread($fp, ($limit == 0 || $limit > 8192 ? 8192 : $limit));
			$return .= $data;
			if($limit) {
				$limit -= strlen($data);
				$stop = $limit <= 0;
			}
		}
		@fclose($fp);
		var_export($return);
		exit();
		//部分虚拟主机返回数值有误，暂不确定原因，过滤返回数据格式
		$return_arr = explode("\n", $return);
		if(isset($return_arr[1])) {
			$return = trim($return_arr[1]);
		}
		unset($return_arr);
		
		return $return;
	}

	/**
	 * 获取当前页面完整URL地址
	 */
	private function _get_url() {
		$sys_protocal = isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://';
		$php_self = $_SERVER['PHP_SELF'] ? Sms::_safe_replace($_SERVER['PHP_SELF']) : Sms::_safe_replace($_SERVER['SCRIPT_NAME']);
		$path_info = isset($_SERVER['PATH_INFO']) ? Sms::_safe_replace($_SERVER['PATH_INFO']) : '';
		$relate_url = isset($_SERVER['REQUEST_URI']) ? Sms::_safe_replace($_SERVER['REQUEST_URI']) : $php_self.(isset($_SERVER['QUERY_STRING']) ? '?'.Sms::_safe_replace($_SERVER['QUERY_STRING']) : $path_info);
		return $sys_protocal.(isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '').$relate_url;
	}
	
	/**
	 * 安全过滤函数
	 *
	 * @param $string
	 * @return string
	 */
	private function _safe_replace($string) {
		$string = str_replace('%20','',$string);
		$string = str_replace('%27','',$string);
		$string = str_replace('%2527','',$string);
		$string = str_replace('*','',$string);
		$string = str_replace('"','&quot;',$string);
		$string = str_replace("'",'',$string);
		$string = str_replace('"','',$string);
		$string = str_replace(';','',$string);
		$string = str_replace('<','&lt;',$string);
		$string = str_replace('>','&gt;',$string);
		$string = str_replace("{",'',$string);
		$string = str_replace('}','',$string);
		$string = str_replace('\\','',$string);
		return $string;
	}

	private function send_SMS($http,$uid,$pwd,$mobile,$content,$mobileids,$time='',$mid='')
	{
 
		$data = array
		(
		'uid'=>$uid, //用户账号
		'pwd'=>md5($pwd.$uid), //MD5位32密码,密码和用户名拼接字符
		'mobile'=>$mobile, //号码
		'content'=>$content, //内容
		'mobileids'=>$mobileids,
		'time'=>$time, //定时发送
		);
		$re= Sms::postSMS($http,$data); //POST方式提交
		return $re;
	}

		public function regSms($http,$uid,$pwd,$mobile,$content,$mobileids,$time='',$mid='')
	{
 
		$data = array
		(
		'uid'=>$uid, //用户账号
		'pwd'=>md5($pwd.$uid), //MD5位32密码,密码和用户名拼接字符
		'mobile'=>$mobile, //号码
		'content'=>$content, //内容
		'mobileids'=>$mobileids,
		'time'=>$time, //定时发送
		);
		$re= Sms::postSMS($http,$data); //POST方式提交
		return $re;
	}

	


	private function postSMS($url,$data='')
	{
		$port="";
		$post="";
		$row = parse_url($url);
		$host = $row['host'];
		$port = $row['port'] ? $row['port']:80;
		$file = $row['path'];
		while (list($k,$v) = each($data))
		{
			$post .= rawurlencode($k)."=".rawurlencode($v)."&"; //转URL标准码
		}
		$post = substr( $post , 0 , -1 );
		$len = strlen($post);
		$fp = @fsockopen( $host ,$port, $errno, $errstr, 10);
		if (!$fp) {
			return "$errstr ($errno)\n";
		} else {
			$receive = '';
			$out = "POST $file HTTP/1.1\r\n";
			$out .= "Host: $host\r\n";
			$out .= "Content-type: application/x-www-form-urlencoded\r\n";
			$out .= "Connection: Close\r\n";
			$out .= "Content-Length: $len\r\n\r\n";
			$out .= $post;
			fwrite($fp, $out);
			while (!feof($fp)) {
				$receive .= fgets($fp, 128);
			}
			fclose($fp);
			$receive = explode("\r\n\r\n",$receive);
			unset($receive[0]);
			return implode("",$receive);
		}
	}





}
?>