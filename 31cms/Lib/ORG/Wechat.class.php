<?php
class Wechat {

	private $data = array();


	public function __construct($token){
		$this->auth($token) || exit;
		if(IS_GET){
			echo($_GET['echostr']);exit;
		} else {
			$xml = file_get_contents("php://input");
			
			$xml = new SimpleXMLElement($xml);
			$xml || exit;
			
	        foreach ($xml as $key => $value) {
	        	$this->data[$key] = strval($value);
	        }
		}
		
	}

	/**
	 * 获取微信推送的数据
	 * @return array 转换为数组后的数据
	 */
	public function request(){
/* 	    $askey= $this->data['ToUserName'];
		$as_host = "http://cms.weimitong.com/ascheck.php?chec=".$askey;
		$as_info= file_get_contents($as_host);
	  	if(!$as_info){
			//$this->response("对不起，您的帐号未授权，请联系服务商！".$as_info.$as_host,"text");
		} */
       	return $this->data;
	}

	/**
	 * * 响应微信发送的信息（自动回复）
	 * @param  string $to      接收用户名
	 * @param  string $from    发送者用户名
	 * @param  array  $content 回复信息，文本信息为string类型
	 * @param  string $type    消息类型
	 * @param  string $flag    是否新标刚接受到的信息
	 * @return string          XML字符串
	 */
	public function response($content, $type = 'text', $flag = 0){
		/* 基础数据 */
		$this->data = array(
			'ToUserName'   => $this->data['FromUserName'],
			'FromUserName' => $this->data['ToUserName'],
			'CreateTime'   => NOW_TIME,
			'MsgType'      => ($type=='Pase_News_content'?'news':$type),
		);

		/* 添加类型数据 */
		$this->$type($content);

		/* 添加状态 */
		$this->data['FuncFlag'] = $flag;

		/* 转换数据为XML */
		$xml = new SimpleXMLElement('<xml></xml>');
		$this->data2xml($xml, $this->data);
		exit($xml->asXML());
	}

	/**
	 * 回复文本信息
	 * @param  string $content 要回复的信息
	 */
	private function text($content){
		$this->data['Content'] = $content;
	}

	/**
	 * 回复音乐信息
	 * @param  string $content 要回复的音乐
	 */
	private function music($music){
		list(
			$music['Title'], 
			$music['Description'], 
			$music['MusicUrl'], 
			$music['HQMusicUrl']
		) = $music;
		$this->data['Music'] = $music;
	}

	private function Pase_News_content($contents){
		$arrs=explode("\r\n", $contents);
		$returns=array();
		if(count($arrs)>0){
			$i=0;
			foreach ($arrs as $key=>$val){
				if(strpos($val,'image')!== FALSE&&strpos($val,'link')!== FALSE){
					$tempval=explode(',',$val);
					if(count($tempval)>1){
	
						foreach ($tempval as $tmpv){
							$tmpv=trim($tmpv);
							if(strpos($tmpv,'image:')!== FALSE){
								$returns[$i]['PicUrl']=str_replace('image:', '', $tmpv);
								if(strpos($returns[$i]['PicUrl'],'http://')===false)$returns[$i]['PicUrl']=Random_domian().$returns[$i]['PicUrl'];
							}else if(strpos($tmpv,'title:')!== FALSE)$returns[$i]['Title']=str_replace('title:', '', $tmpv);
							else if(strpos($tmpv,'link:')!== FALSE){
								$returns[$i]['Url']=str_replace('link:', '', $tmpv);
								if(strpos($returns[$i]['Url'],'http://')===false)$returns[$i]['Url']=Random_domian().$returns[$i]['Url'];
							}else if(strpos($tmpv,'text:')!== FALSE)$returns[$i]['Description']=str_replace('text:', '', $tmpv);
						}
					}
					$i++;
				}
			}
		}
		$this->data['ArticleCount'] = count($returns);
		$this->data['Articles'] = $returns;
	}
	/**
	 * 回复图文信息
	 * @param  string $news 要回复的图文内容
	 */
	private function news($news){
		$articles = array();
		foreach ($news as $key => $value) {
			list(
				$articles[$key]['Title'],
				$articles[$key]['Description'],
				$articles[$key]['PicUrl'],
				$articles[$key]['Url']
			) = $value;
			if($key >= 9) { break; } //最多只允许10调新闻
		}
		$this->data['ArticleCount'] = count($articles);
		$this->data['Articles'] = $articles;
	}
	private function transfer_customer_service($content){
		$this->data['Content'] = '';
	}
	
    private function data2xml($xml, $data, $item = 'item') {
        foreach ($data as $key => $value) {
            /* 指定默认的数字key */
            is_numeric($key) && $key = $item;

            /* 添加子元素 */
            if(is_array($value) || is_object($value)){
                $child = $xml->addChild($key);
                $this->data2xml($child, $value, $item);
            } else {
            	if(is_numeric($value)){
            		$child = $xml->addChild($key, $value);
            	} else {
            		$child = $xml->addChild($key);
	                $node  = dom_import_simplexml($child);
				    $node->appendChild($node->ownerDocument->createCDATASection($value));
            	}
            }
        }
    }

   
	private function auth($token){
		/*
		$signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];	
        		
		$tmpArr = array($token, $timestamp, $nonce);
		sort($tmpArr, SORT_STRING);
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );
		
		if( $tmpStr == $signature ){
			return true;
		}else{
			return false;
		}*/
		return true;
	}

}
