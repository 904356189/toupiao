<?php
class ClassifyModel extends Model{
	protected $_validate =array(
		array('name','require','分类名不能为空',1),
		array('img','require','分类图片不能为空',1),
	);
	
	protected $_auto = array (
		array('token','gettoken',self::MODEL_INSERT,'callback'),
	);
	
	public function gettoken(){
		return session('token');
	}
	
	
}