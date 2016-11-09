<?php
final class funcDict {
	public function __construct() {
		
	}
	
	public function moduleName($index) {
		$moudles=funcDict::modules();
		if (key_exists(strtolower($index),$moudles)){
			return $moudles[strtolower($index)]['name'];
		}else {
			if (!$index){
				return '其他';
			}else {
				return $index;
			}
		}
	}
	public function modules() {
		$moudles=array(
		'home'=>array('name'=>'微网站'),
		'text'=>array('name'=>'文本请求','detail'=>1),
		'member_card_set'=>array('name'=>'会员卡'),
		'lottery'=>array('name'=>'推广活动','detail'=>1),
		'help'=>array('name'=>'帮助'),
		'wedding'=>array('name'=>'婚庆喜帖','detail'=>1),
		'img'=>array('name'=>'图文消息','detail'=>1),
		'selfform'=>array('name'=>'万能表单','detail'=>1),
		'host'=>array('name'=>'通用订单','detail'=>1),
		'panorama'=>array('name'=>'全景','detail'=>1),
		'usernamecheck'=>array('name'=>'账号审核'),
		'album'=>array('name'=>'相册'),
		'vote'=>array('name'=>'投票','detail'=>1),
		'product'=>array('name'=>'商城','detail'=>1),
		'voiceresponse'=>array('name'=>'语音消息'),
		'estate'=>array('name'=>'房产'),
		'follow'=>array('name'=>'关注'),
		'index'=>array('name'=>'微网站'),
		'forum'=>array('name'=>'微论坛'),
		'luckyfruit'=>array('name'=>'水果机'),
		);
		return $moudles;
	}
}
?>