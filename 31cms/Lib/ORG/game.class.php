<?php
class game {
	public $name;
	public $serverUrl;
	public function __construct(){
		$this->serverUrl='http://g.404.cn/';
		$this->key=trim(C('server_key'));
		$this->topdomain=trim(C('server_topdomain'));
		if (!$this->topdomain){
			$this->topdomain=$this->getTopDomain();
		}
		$this->token=$token;
	}
	public function getLink($item,$openid=''){
		$thisUser=M('Game_config')->where(array('token'=>$item['token']))->find();
		$link=$this->serverUrl.'index.php?m=home&c=game&a=game&id='.$item['gameid'].'&uid='.$thisUser['uid'].'&ugameid='.$item['id'].'&openid='.$openid;
		return $link;
	}
	public function config($token,$wxname,$wxid,$wxlogo,$link){
		$name=implode('',$name);
		$data=array(
		'username'=>$this->topdomain.'_'.$token,
		'wxname'=>$wxname,
		'domain'=>$_SERVER['HTTP_HOST'],
		'wxid'=>$wxid,
		'wxlogo'=>urlencode($wxlogo),
		'link'=>urlencode($link)
		);
		$url=$this->serverUrl.'index.php?m=home&c=api&a=newUser';
		$rt=$this->api_notice_increment($url,$data);
		return json_decode($rt,1);
	}
	public function gameCats(){
		$url=$this->serverUrl.'index.php?m=home&c=api&a=gameCats';
		$rt=$this->api_notice_increment($url);
		return json_decode($rt,1);
	}
	public function gameList($catid){
		$url=$this->serverUrl.'index.php?m=home&c=api&a=gameList';
		$rt=$this->api_notice_increment($url);
		return json_decode($rt,1);
	}
	public function getGame($id){
		$url=$this->serverUrl.'index.php?m=home&c=api&a=game&id='.$id;
		$rt=$this->api_notice_increment($url);
		return json_decode($rt,1);
	}
	public function gameSelfs($id){
		$url=$this->serverUrl.'index.php?m=home&c=api&a=gameSelfs&id='.$id;
		$rt=$this->api_notice_increment($url);
		return json_decode($rt,1);
	}
	public function gameSelfSet($uid,$gameid,$userGameid,$gameortest='game',$key='',$data,$delete=0){
		$url=$this->serverUrl.'index.php?m=home&c=api&a=gameSelfSet&gameid='.$gameid.'&uid='.$uid.'&usergameid='.$userGameid.'&gameortest='.$gameortest.'&key='.$key.'&delete='.$delete;
		$rt=$this->api_notice_increment($url,$data);

		return json_decode($rt,1);
	}

	function api_notice_increment($url,$data,$method='POST'){
		$ch = curl_init();
		$header = "Accept-Charset: utf-8";
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($ch, CURLOPT_SSLVERSION, 3);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$tmpInfo = curl_exec($ch);
		$errorno=curl_errno($ch);
		if ($errorno) {
			return array('rt'=>false,'errorno'=>$errorno);
		}else{
			//$js=json_decode($tmpInfo,1);
			//return $js;
			return $tmpInfo;
		}
	}
	function getTopDomain(){
		$host=$_SERVER['HTTP_HOST'];
		$host=strtolower($host);
		if(strpos($host,'/')!==false){
			$parse = @parse_url($host);
			$host = $parse['host'];
		}
		$topleveldomaindb=array('com','edu','gov','int','mil','net','org','biz','info','pro','name','museum','coop','aero','xxx','idv','mobi','cc','me');
		$str='';
		foreach($topleveldomaindb as $v){
			$str.=($str ? '|' : '').$v;
		}
		$matchstr="[^\.]+\.(?:(".$str.")|\w{2}|((".$str.")\.\w{2}))$";
		if(preg_match("/".$matchstr."/ies",$host,$matchs)){
			$domain=$matchs['0'];
		}else{
			$domain=$host;
		}
		return $domain;
	}
}
