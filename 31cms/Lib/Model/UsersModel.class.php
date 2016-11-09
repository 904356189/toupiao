<?php
class UsersModel extends Model{

	//自动验证
	protected $_validate=array(
		array('username','require','用户名称必须填写！',1,'',3),
		array('password','require','用户密码必须填写！',0,'',3),
		array('repassword','password','两次密码不一致',0,'confirm'),
		array('username','','用户名称已经存在！',1,'unique',1), // 新增修改时候验证username字段是否唯一
		array('email','email','邮箱格式不正确'),
		array('email','','邮箱已经存在！',1,'unique',1),
	);
	
	protected $_auto = array (
		array('password','md5',self::MODEL_BOTH,'function'),
		array('repassword','md5',self::MODEL_BOTH,'function'),
		array('createtime','time',self::MODEL_INSERT,'function'),
		array('createip','getip',self::MODEL_INSERT,'callback'),
		//array('viptime','time',self::MODEL_BOTH,'function'),
		array('lasttime','time',self::MODEL_BOTH,'function'),
		array('lastip','getip',self::MODEL_BOTH,'callback'),
		array('status','getstatus',self::MODEL_BOTH,'callback'),
		//array('gid','getgid',self::MODEL_INSERT,'callback'),
	);
	
	public function getip(){
		return htmlspecialchars(trim(get_client_ip()));
	}
	
	public function getstatus(){
		return C('ischeckuser')=='true'?1:0;
	}
	
	public function getgid(){
		return 1;
	}
}