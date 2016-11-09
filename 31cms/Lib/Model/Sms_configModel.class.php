<?php
    class Sms_configModel extends Model{
    protected $_validate = array(
            array('server','require','请选择短信平台',1),
            array('username','require','请填写用户名',1),
            array('password','require','请填写key',1),
     );
    protected $_auto = array (
    array('token','gettoken',1,'callback'),
    );
    function gettoken(){
		return session('token');
	}
}

?>