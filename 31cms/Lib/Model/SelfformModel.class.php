<?php
class SelfformModel extends Model{
	protected $_validate = array(
	array('name','require','名称不能为空',1)
	);
	protected $_auto = array (
	array('token','gettoken',1,'callback'),
	array('endtime','getTime',3,'callback'),
	array('time','time',1,'function')
	);
	function gettoken(){
		return session('token');
	}
	function getTime(){
		$date=$_POST['enddate'];
		if ($date){
		$dates=explode('-',$date);
		$time=mktime(23,59,59,$dates[1],$dates[2],$dates[0]);
		}else {
			$time=0;
		}

		return $time;
	}
}

?>