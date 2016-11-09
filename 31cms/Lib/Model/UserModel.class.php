<?php 
class UserModel extends Model {

	//自动完成
	protected $_auto = array ( 
		array('password','md5',1,'function'),	//新增时
		array('last_login_time','time',1,'function'), 	//新增时
		array('last_login_ip','127.0.0.1'), 	//新增时
		array('last_location','新建用户'), 	//新增时
	);

	//自动验证
	protected $_validate=array(
		array('username','require','用户名称必须！',1,'',3),
		array('username','','用户名称已经存在！',1,'unique',3), // 新增修改时候验证username字段是否唯一
	);

	// 获取所有用户信息
	public function getAllUser($where = '' , $order = 'id  ASC', $limit='') {
		return $this->where($where)->order($order)->limit($limit)->select();
	}

	// 获取单个用户信息
	public function getUser($where = '',$field = '*') {
		return $this->field($field)->where($where)->find();
	}

	// 删除用户
	public function delUser($where) {
		if($where){
			return $this->where($where)->delete();
		}else{
			return false;
		}
	}

	// 更新用户
	public function upUser($data) {
		if($data){
			return $this->save($data);
		}else{
			return false;
		}
	}

	// 更新用户
	public function check_name($username,$user_id=0){
        if($user_id){   //编辑时查询
        	$map['id']  = array('neq',$user_id);
        	$map['username']  = array('eq',$username);
        }else{  // 新增是查询
        	$map['username']  = array('eq',$username);
        }
        return $this->where($map)->find();
	}

}