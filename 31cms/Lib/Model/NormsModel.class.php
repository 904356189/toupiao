<?php
class NormsModel extends Model{
	protected $_validate =array(
		array('value','require','属性值不能为空',1),
	);
}