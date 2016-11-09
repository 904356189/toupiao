<?php
class otherModel extends Model{
	protected $_validate = array(
			array('id','checkid','非法操作',2,'callback',2),
	);
	protected $_auto = array (		
		array('token','getToken',Model:: MODEL_BOTH,'callback'),
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
}
?>
