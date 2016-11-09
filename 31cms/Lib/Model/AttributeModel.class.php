<?php
class AttributeModel extends Model{

	protected $_validate =array(
		array('name','require','名称不能为空',1),
		array('value','require','属性值不能为空',1),
	);
}