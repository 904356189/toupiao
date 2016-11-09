<?php
class CaseModel extends Model{
	protected $_validate =array(
		array('name','require','内容不能为空',1),
		array('url','url','url格式不正确',0),
	);

}