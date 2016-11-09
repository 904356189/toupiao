<?php 
class ReservationModel extends Model {

	//自动验证
	protected $_validate = array(
			
			array('title','require','图文信息标题不能为空'),
			array('keyword','require','触发关键词不能为空',3),
			array('picurl','require','图文封面不能为空'),
			array('address','require','预约地不能为空'),
			array('headpic','require','订单页头部图片不能为空'),
			array('info','require','订单详情不能为空'),
			array('picurl','require','图文封面不能为空'),
			array('address','require','预约地不能为空'),
				
	 );


}