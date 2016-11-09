<?php
class Wechat_sceneModel extends Model {

	//自动验证
	protected $_validate = array(
			array('keyword','require','关键词不能为空',1),
			array('title','require','现场标题不能为空',1),
			array('pic','require','图片不能为空',1),
	 );



}