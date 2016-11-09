<?php
class Selfform_inputModel extends Model{
	protected $_validate = array(
	array('displayname','require','显示名称不能为空',1),
	array('inputtype','require','输入类型不能为空',1),
	array('fieldname','require','字段名称不能为空',1)
	);
	protected $_auto = array (
	array('time','time',1,'function')
	);
}

?>