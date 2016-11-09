<?php 
class getYu{ 
	public function getGoogleTTS($key,$tl='zh-cn'){ 
		$post_data = array( 
			'idx=0',
			'ie=UTF-8',
			'q='.$key,
			'tl='.$tl,
			'total=1',
			'textlen='.(string)mb_strlen($key,"UTF-8")
		);
			$post_data = implode('&',$post_data); $url="http://translate.google.com/translate_tts";
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt( $ch, CURLOPT_REFERER, "http://translate.google.com" );
			curl_setopt( $ch, CURLOPT_HEADER, true );
			curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
			curl_setopt( $ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 5.1; rv:20.0) Gecko/20100101 Firefox/20.0" );
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Host: translate.google.com'));
			//host curl_setopt( $ch, CURLOPT_POST, true );
			curl_setopt( $ch, CURLOPT_POSTFIELDS, $post_data );
			//curl_setopt($ch, CURLOPT_COOKIE, $matches[1][0]);
			$content = curl_exec($ch);
			curl_close($ch);
			$response_msg=trim($content); return $content;
	} 
	
}
 ?>