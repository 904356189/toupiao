<?php 
class RoleModel extends Model {

	//自动验证
	protected $_validate=array(
		array('name','require','角色名称必须！',1,'',3),
		array('name','','角色名称已经存在！',1,'unique',3), 
		array('status','require','角色状态必须！',1,'',3),
	);

	// 获取所有角色信息
	public function getAllRole($where = '' , $order = 'sort DESC' ,$field = '*') {
		return $this->field($field)->where($where)->order($order)->select();
	}

	// 获取单个角色信息
	public function getRole($where = '',$field = '*') {
		return $this->field($field)->where($where)->find();
	}

	// 删除角色
	public function delRole($where) {
		if($where){
			return $this->where($where)->delete();
		}else{
			return false;
		}
	}

	// 更新角色
	public function upRole($data) {
		if($data){
			return $this->save($data);
		}else{
			return false;
		}
	}

}