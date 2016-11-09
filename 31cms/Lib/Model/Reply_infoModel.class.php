<?php
class Reply_infoModel extends Model{
	protected $_validate = array(
	array('title','require','标题不能为空',1)
	);
	protected $_auto = array (
	array('token','gettoken',1,'callback')
	);
	function gettoken(){
		return session('token');
	}
}

?>