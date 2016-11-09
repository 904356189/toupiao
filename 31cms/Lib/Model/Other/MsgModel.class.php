<?php
    class MsgModel extends Model{
    protected $_validate = array(
			array('domain','','请勿添加他人的授权域名',0,'unique',1), 
            array('qq','require','负责人qq不能为空',1),
            array('username','require','负责人名称不能为空',1),
            array('tel','require','商家电话不能为空',1),
			array('type',array(1,2,3),'非法操作',2,'in'), 
            array('domain','require','授权域名不能为空',1),
            array('time','require','购买时间必须填写',1),
            array('price','require','购买的价格必须填写',1),
            array('info','require','此次升级需要提示服务器信息',1)
     );
    protected $_auto = array ( 
        array('creat_time','time',1,'function'), // 对create_time字段在更新的时候写入当前时间戳
    );

}

?>