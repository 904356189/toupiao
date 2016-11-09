<?php
class Service_userModel extends Model{
	protected $_validate = array(
			array('name','require','工号名必须填写',1),
			array('userName','require','登陆用户名必须填写',1),
			//array('userPwd','require','登陆密码必须填写',1),
			array('id','checkid','非法操作',2,'callback',2),
	 );
	protected $_auto = array (		
		array('token','getToken',Model:: MODEL_BOTH,'callback'),
		array('userPwd','userPwd',Model:: MODEL_BOTH,'callback'),
		array('create_time','time',1,'function'), // 对create_time字段在更新的时候写入当前时间戳);
	);
	function checkid(){
		$dataid=$this->field('id')->where(array('id'=>$_POST['id'],'token'=>session('token')))->find();
		if($dataid==false){
			return false;
		}else{
			return true;
		}
	}
	function getToken(){	
		return $_SESSION['token'];
	}
	function userPwd(){	
		return md5($_POST['userPwd']);
	}
	function getServiceUser($id){
		$where['token']=session('token');
		$where['id']=$id;
		$data=M('Service_user')->where($where)->find();
		//dump(M('Service_user')->getLastSql());
		//dump($data);
		return $data['name'];
	
	}
}

?>
