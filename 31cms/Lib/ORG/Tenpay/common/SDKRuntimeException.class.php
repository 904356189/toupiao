<?php
//---------------------------------------------------------
//自定义异常处理类
//---------------------------------------------------------


class  SDKRuntimeException extends Exception {
	public function errorMessage()
	{
		return $this->getMessage();
	}

}

?>