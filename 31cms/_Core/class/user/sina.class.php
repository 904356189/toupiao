<?php
// +----------------------------------------------------------------------
// | 方维购物分享网站系统 (Build on ThinkPHP)
// +----------------------------------------------------------------------
// | Copyright (c) 2011 http://fanwe.com All rights reserved.
// +----------------------------------------------------------------------

require_once FANWE_ROOT.'core/class/user/userbase.class.php';
require_once FANWE_ROOT."sdks/sina/saetv2.ex.class.php";
class SinaUser extends UserBase
{
	public $config;
	private $type = 'sina';
	
	public function SinaUser()
	{
		$this->config = $this->getConfig($this->type);
	}
	
	public function loginHandler($token)
	{
		global $_FANWE;
		$user = $this->getUserInfo($token);
		$bind_user = $this->getUserByTypeKeyId($this->type,$user['id']);
		if($bind_user)
		{
			if($bind_user['status'] == 0)
				showError('登陆失败','该帐户已被管理员锁定',FU('index'));
			
			$_FANWE['uid'] = $bind_user['uid'];
			$this->updateBindInfo($user);
			FS('User')->setSession($bind_user,1209600);
		}
		else
		{
			$data = array();
			$data['type'] = $this->type;
			$data['user'] = $user;
			$this->jumpUserBindReg($data,$user['screen_name']);
		}
	}
	
	public function bindHandler($token)
	{
		global $_FANWE;
		if($_FANWE['uid'] == 0)
			exit;
		
		$user = $this->getUserInfo($token);
		$bind_user = $this->getUserByTypeKeyId($this->type,$user['id']);
		if($bind_user && $bind_user['uid'] != $_FANWE['uid'])
		{
			$data = array();
			$data['short_name'] = $this->config['short_name'];
			$data['keyid'] = $user['id'];
			$data['type'] = $this->type;
			$data['user'] = $user;
			fSetCookie('sync_bind_exists',authcode(serialize($data),'ENCODE'));
		}
		else
		{
			$this->bindUser($user);
		}
	}
	
	public function bindByData($data)
	{
		$this->bindUser($data['user']);
	}
	
	public function updateBindInfo($user)
	{
		global $_FANWE;	
		$refresh_time = TIME_UTC + (int)$user['token']['expires_in'];
		$info = array();
		$info['access_token'] = $user['token']['access_token'];
		unset($user['token']);
		$info['user'] = $user;

		$data = array();
		$data['refresh_time'] = $refresh_time;
		$data['info'] = addslashes(serialize($info));
		FDB::update('user_bind',$data,"uid = ".$_FANWE['uid']." AND type = '".$this->type."'");
	}
	
	public function bindUser($user,$sync='')
	{
		if($user)
		{
			global $_FANWE;	
			$data = array();
			$data['uid'] = $_FANWE['uid'];
			$data['type'] = $this->type;
			$data['keyid'] = $user['id'];
			$data['refresh_time'] = TIME_UTC + (int)$user['token']['expires_in'];
			
			$info = array();
			$info['access_token'] = $user['token']['access_token'];
			unset($user['token']);
			$info['user'] = $user;
			$data['info'] = addslashes(serialize($info));
			
			$sync = array();
			$sync['weibo'] = 1;
			$sync['topic'] = 1;
			$sync['medal'] = 1;
			$data['sync'] = serialize($sync);
			
			if(!empty($user['profile_image_url']) && FS('User')->getAvatar($_FANWE['uid']) == 0)
			{
				$img = copyFile(str_replace('/50/','/180/',$user['profile_image_url']),"temp",false);
				if($img !== false)
					FS('User')->saveAvatar($_FANWE['uid'],$img['path']);
			}

			FDB::insert('user_bind',$data,false,true);

			//绑定后推送网站信息
			if((int)$_FANWE['setting']['bind_push_weibo'] == 1)
			{
				$weibo = array();
				$weibo['content'] = sprintf(lang('user','bind_weibo_message'),$_FANWE['setting']['site_name'],$_FANWE['setting']['site_description'],$_FANWE['setting']['site_name']);
				$weibo['img'] = "";
				$weibo['ip'] = $_FANWE['client_ip'];
				$weibo['url'] = FU('u/index',array('uid'=>$_FANWE['uid']),true);
				$weibo['content'] = cutStr($weibo['content'],277 - strlen($weibo['url']));
				$this->sentShare($_FANWE['uid'],$weibo);
			}
		}
	}
	
	public function getUserInfo($token)
	{
		global $_FANWE;
		$client = new SaeTClientV2($this->config['app_key'],$this->config['app_secret'],$token['access_token']);
		$result = $client->show_user_by_id($token['uid']);
		
		if ($result === false || $result === null)
			exit("Error occured");
		
		if (isset($result['error_code']) && isset($result['error']))
			exit('Error_code: '.$result['error_code'].';  Error: '.$result['error']);
		
		$result['token'] = $token;
		return $result;
	}
	
	public function sentShare($uid,$data)
	{
		global $_FANWE;
		static $client = NULL;
		if($client === NULL)
		{
			$uid = (int)$uid;
			$bind = FS("User")->getUserBindByType($uid,'sina');
			$client = new SaeTClientV2($this->config['app_key'],$this->config['app_secret'],$bind['access_token']);
		}
		
		try
		{
			$data['content'] .= ' '.$data['url'];
			if(empty($data['img']))
				$msg = $client->update($data['content']);
			else
				$msg = $client->upload($data['content'],$data['img']);
			//print_r($msg);
			return true;
		}
		catch(Exception $e)
		{
			//print_r($e);
		}
		return false;
	}
	
	public function getFollowers($uid)
	{
		
	}
}
?>