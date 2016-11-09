<?php
// +----------------------------------------------------------------------
// | 方维购物分享网站系统 (Build on ThinkPHP)
// +----------------------------------------------------------------------
// | Copyright (c) 2011 http://fanwe.com All rights reserved.
// +----------------------------------------------------------------------

require_once FANWE_ROOT.'core/class/user/userbase.class.php';
require_once FANWE_ROOT."sdks/tqq/Tencent.php";
class TqqUser extends UserBase
{
	public $config;
	private $type = 'tqq';
	
	public function TqqUser()
	{
		$this->config = $this->getConfig($this->type);
		TqqOAuth::init($this->config['app_key'],$this->config['app_secret']);
	}
	
	public function loginHandler()
	{
		global $_FANWE;
		$user = $this->getUserInfo();
		$bind_user = $this->getUserByTypeKeyId($this->type,$user['name']);
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
			$data['user_email'] = $user['email'];
			$data['type'] = $this->type;
			$data['user'] = $user;
			$this->jumpUserBindReg($data,$user['nick']);
		}
	}
	
	public function bindHandler()
	{
		global $_FANWE;
		if($_FANWE['uid'] == 0)
			exit;
		
		$user = $this->getUserInfo();
		$bind_user = $this->getUserByTypeKeyId($this->type,$user['name']);
		if($bind_user && $bind_user['uid'] != $_FANWE['uid'])
		{
			$data = array();
			$data['short_name'] = $this->config['short_name'];
			$data['keyid'] = $user['name'];
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
		$refresh_time = TIME_UTC + (int)$user['token']['t_expire_in'];
		$info = array();
		$info['token'] = $user['token'];
		unset($user['token']);
		$info['user'] = $user;
		
		$data = array();
		$data['info'] = addslashes(serialize($info));
		$data['refresh_time'] = $refresh_time;
		FDB::update('user_bind',$data,"uid = ".$_FANWE['uid']." AND type = '".$this->type."'");
	}
	
	public function bindUser($user)
	{
		if($user)
		{
			global $_FANWE;	
			$data = array();
			$data['uid'] = $_FANWE['uid'];
			$data['type'] = $this->type;
			$data['keyid'] = $user['name'];
			$data['refresh_time'] = TIME_UTC + (int)$user['token']['t_expire_in'];

			$info = array();
			$info['token'] = $user['token'];
			unset($user['token']);
			$info['user'] = $user;
			$data['info'] = addslashes(serialize($info));
			
			$sync = array();
			$sync['weibo'] = 1;
			$sync['topic'] = 1;
			$sync['medal'] = 1;
			$data['sync'] = serialize($sync);
			
			if(!empty($user['head']) && FS('User')->getAvatar($_FANWE['uid']) == 0)
			{
				$img = copyFile($user['head'].'/180',"temp",false);
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
	
	public function sentShare($uid,$data)
	{
		global $_FANWE;
		static $bln = false;
		if(!$bln)
		{
			$uid = (int)$uid;
			$bind = FS("User")->getUserBindByType($uid,'tqq');
			$_FANWE['login_oauth']['tqq'] = $bind['token'];
			TqqOAuth::init($this->config['app_key'],$this->config['app_secret']);
			$bln = true;
		}
		
		$data['content'] .= ' '.$data['url'];
		if(empty($data['img']))
		{
			TencentTqq::api('t/add', array(
				'content' => $data['content'],
				'clientip' => $_FANWE['client_ip'],
			), 'POST');
		}
		else
		{
			TencentTqq::api('t/add_pic_url',array(
				'content' => $data['content'],
				'clientip' => $_FANWE['client_ip'],
				'pic_url'  => $data['img_url'],
			), 'POST');
		}
	}
	
	public function getUserInfo()
	{
		global $_FANWE;
		$user = json_decode(TencentTqq::api('user/info'), true);
		if((int)$user['errcode'] != 0 || (int)$user['ret'] != 0)
			exit($user['msg']);
		
		$user = $user['data'];
		$user['token'] = $_FANWE['login_oauth']['tqq'];
		return $user;
	}
}
?>