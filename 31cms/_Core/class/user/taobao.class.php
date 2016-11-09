<?php
// +----------------------------------------------------------------------
// | 方维购物分享网站系统 (Build on ThinkPHP)
// +----------------------------------------------------------------------
// | Copyright (c) 2011 http://fanwe.com All rights reserved.
// +----------------------------------------------------------------------
require_once 'userbase.class.php';
require_once FANWE_ROOT.'sdks/taobao/TopClient.php';
require_once FANWE_ROOT."sdks/taobao/taobao.func.php";
class TaobaoUser extends UserBase
{
	public $config;
	private $type = 'taobao';
	private $client;
	
	public function __construct()
	{
		$this->config = $this->getConfig($this->type);
		$this->client = new TopClient;
		$this->client->appkey = $this->config['app_key'];
		$this->client->secretKey = $this->config['app_secret'];
	}
	
	public function loginHandler($parameters)
	{
		global $_FANWE;
		//$user = $this->getUserInfo($parameters['nick']);
		$user = $parameters;
		$bind_user = $this->getUserByTypeKeyId($this->type,$user['user_id']);
		
		if($bind_user)
		{
			if($bind_user['status'] == 0)
				showError('登陆失败','该帐户已被管理员锁定',FU('index'));
			$_FANWE['uid'] = $bind_user['uid'];
			$this->bindUser($user,$parameters);
			FS('User')->setSession($bind_user,1209600);
		}
		else
		{
			$data = array();
			$data['type'] = $this->type;
			$data['user'] = $user;
			$data['parameters'] = $parameters;
			$this->jumpUserBindReg($data,$parameters['nick']);
		}
	}
	
	public function bindHandler($parameters)
	{
		global $_FANWE;
		if($_FANWE['uid'] == 0)
			exit;
		
		//$user = $this->getUserInfo($parameters['nick']);
		$user = $parameters;
		$bind_user = $this->getUserByTypeKeyId($this->type,$user['user_id']);
		
		if($bind_user && $bind_user['uid'] != $_FANWE['uid'])
		{
			$data = array();
			$data['type'] = $this->type;
			$data['keyid'] = $user['user_id'];
			$data['short_name'] = $this->config['short_name'];
			$data['user'] = $user;
			$data['parameters'] = $parameters;
			$data['session'] = $session;
			fSetCookie('sync_bind_exists',authcode(serialize($data),'ENCODE'));
		}
		else
		{
			$this->bindUser($user,$parameters);
		}
	}
	
	public function buyerHandler($parameters)
	{
		global $_FANWE;	
		if($_FANWE['uid'] > 0)
		{
			//$user = $this->getUserInfo($parameters['nick']);
			$user = $parameters;
			$this->bindUser($user,$parameters);
		}
	}
	
	public function bindByData($data)
	{
		$this->bindUser($data['user'],$data['parameters'],$data['session']);
	}
	
	public function bindUser($user,$parameters)
	{
		if($user)
		{
			global $_FANWE;	
			$data = array();
			$data['uid'] = $_FANWE['uid'];
			$data['type'] = $this->type;
			$data['keyid'] = $user['user_id'];

			$info = array();
			$info['refresh_token'] = 0;

			$info['user'] = $user;
			$data['info'] = addslashes(serialize($info));
			
			/*$update = array();
			$update['buyer_level'] = $user['buyer_credit']['level'];
			$update['seller_level'] = $user['seller_credit']['level'];
			FDB::update('user',$update,'uid = '.$_FANWE['uid']);
			
			$buyer = array();
			$buyer['is_buyer'] = 1;
			if($update['buyer_level'] < 2 || $update['seller_level'] > 6)
				$buyer['is_buyer'] = 0;
			FDB::update('user',$buyer,'uid = '.$_FANWE['uid'].' AND is_buyer > -1');
			
			if(!empty($user['avatar']) && FS('User')->getAvatar($_FANWE['uid']) == 0)
			{
				$img = copyFile($user['avatar'],"temp",false);
				if($img !== false)
					FS('User')->saveAvatar($_FANWE['uid'],$img['path']);
			}*/
			FDB::insert('user_bind',$data,false,true);
		}
	}
	
	public function getUserInfo($nick)
	{
		require_once FANWE_ROOT."sdks/taobao/request/UserGetRequest.php";
		$req = new UserGetRequest;
		$req->setFields("user_id,uid,nick,sex,buyer_credit,seller_credit,location,birthday,type,status,alipay_no,alipay_account,alipay_account,email,consumer_protection,alipay_bind,avatar");
		$req->setNick($nick);
		$resp = $this->client->execute($req);
		if(isset($resp->user))
			$user = (array)$resp->user;
		elseif(isset($resp->code))
			exit(print_r($resp,true));
		else
			exit('error');
		
		if(empty($user['email']))
			$user['email'] = '';
		$user['buyer_credit'] = (array)$user['buyer_credit'];
		$user['location'] = (array)$user['location'];
		$user['seller_credit'] = (array)$user['seller_credit'];
		return $user;
	}
}
?>