<?php
class GameReply
{	
	public $item;
	public $wechat_id;
	public $siteUrl;
	public $token;
	public function __construct($token,$wechat_id,$data,$siteUrl)
	{
		$this->item=M('Games')->where(array('id'=>$data['pid']))->find();
		$this->wechat_id=$wechat_id;
		$this->siteUrl=$siteUrl;
		$this->token=$token;
	}
	public function index(){
		$thisItem=$this->item;
		$game=new game();
		$link=$game->getLink($thisItem,$this->wechat_id);
		return array(array(array($thisItem['title'],$thisItem['intro'],$thisItem['picurl'],$link)),'news');
	}
}
?>

