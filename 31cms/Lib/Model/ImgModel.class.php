<?php
class ImgModel extends Model{

	protected $_validate =array(
		array('title','require','标题不能为空',1),
		array('classid','require','分类必须选择',1),
	);
	
	protected $_auto = array (
		array('uid','getuser',self::MODEL_INSERT,'callback'),
		array('uname','getname',self::MODEL_INSERT,'callback'),
		array('createtime','time',self::MODEL_INSERT,'function'),
		array('uptatetime','time',self::MODEL_BOTH,'function'),
		array('classid','getclassid',self::MODEL_BOTH,'callback'),
		array('classname','getclassname',self::MODEL_BOTH,'callback'),
		array('token','gettoken',self::MODEL_INSERT,'callback'),
		array('click','0'),
	);
	
	public function getuser(){
		return session('uid');
	}
	
	public function getname(){
		return session('uname');
	}
	//获取分类ID
	public function getclassid(){
		$id=explode(',',$_POST['classid']);
		return $id[0];
	}
	//获取分类名字
	public function getclassname(){
		$id=explode(',',$_POST['classid']);
		return $id[1];
	}
	function gettoken(){
		return session('token');
	}
	
}