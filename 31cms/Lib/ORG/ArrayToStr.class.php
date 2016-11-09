<?php
class ArrayToStr 
{
	public static function array_to_str($array, $paid = 0)
	{
		if (is_array($array)) {
			$msg = '';
			$msg .= chr(10).'姓名：'. $array['truename'];
			$msg .= chr(10).'电话：'.$array['tel'];
			if ($array['address']) $msg .= chr(10).'地址：'. $array['address'];
			$msg .= chr(10).'下单时间：' . date('Y-m-d H:i:s', $array['buytime']);
			if (isset($array['sendtime']) && $array['sendtime']) {
				$msg .= chr(10).'配送时间:' . date('Y-m-d H:i:s', $array['sendtime']);
			}
			if (isset($array['list'])) {
				$msg .= chr(10).'*******************************';
				foreach ($array['list'] as $row) {
					if (isset($row['day'])) {
						$msg .= chr(10). $row['name'] . ": ￥" . $row['price'] . " * " . $row['num'] . "间  * " . $row['day'] . "天";
					} else {
						$msg .= chr(10). $row['name'] . ": ￥" . $row['price'] . " * " . $row['num'];
						if (isset($row['colorName'])) $msg .=  "," . $row['colorName'];
						if (isset($row['formatName'])) $msg .= "," . $row['formatName'];
					}
				}
				$msg .= chr(10).'*******************************';
			}
			if (isset($array['des']) && $array['des']) {
				$msg .= chr(10).'备注信息：'. $array['des'];
			}
			if (isset($array['typename']) && $array['typename']) {
				$msg .= chr(10).'就餐形式：'. $array['typename'];
			}
			
			if (isset($array['takeAwayPrice']) && $array['takeAwayPrice']) {
				$msg .= chr(10).'送餐费：'. $array['takeAwayPrice'];
			}
			
			if (isset($array['tablename']) && $array['tablename']) {
				$msg .= chr(10).'餐桌号：'. $array['tablename'];
			}
			
			$msg .= chr(10).'数量：'.$array['total'];
			$msg .= chr(10).'合计：'. $array['price'].'元';
			$msg .= chr(10).'※※※※※※※※※※※※※※※※';
			$msg .= chr(10).'谢谢惠顾，欢迎下次光临';
			$msg .= chr(10).'订单编号：'.$array['orderid'];
			if ($paid) {
				$msg .= chr(10).'订单状态：已付款';
			} else {
				$msg .= chr(10).'订单状态：未付款';
			}
			$msg .= chr(10).'公司名称：'.$array['companyname'];
			$msg .= chr(10).'公司电话：'.$array['companytel'];
			$msg .= chr(10).'打印时间：'.date("Y-m-d H:i:s");
			return $msg;
		}
	}
}
