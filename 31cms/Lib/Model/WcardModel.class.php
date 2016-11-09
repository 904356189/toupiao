<?php
class WcardModel extends Model{
	protected $_validate = array(
			array('title','require','喜帖标题不能为空',1),
			array('keyword','require','关键字不能为空',1),
			array('picurl','require','封面图片必须填写',1),
			array('man','require','新郎名字必须填写',1),
                        array('woman','require','新娘名字必须填写',1),				
			
			 

	 );
	protected $_auto = array (		
		array('token','getToken',Model:: MODEL_BOTH,'callback'),
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
}

?>
