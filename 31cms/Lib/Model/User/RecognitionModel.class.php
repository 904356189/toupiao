<?php
class RecognitionModel extends Model{
	protected $_validate = array(
			array('title','require','标题必须填写',1),
			array('keyword','require','关键词必须填写',1),

	 );
	protected $_auto = array (		
		array('token','getToken',Model:: MODEL_BOTH,'callback'),
	);
	function getToken(){	
		return $_SESSION['token'];
	}
}

?>
