<?php
class WxuserModel extends Model{
	protected $_validate =array(
		array('wxname','require','公众号名称不能为空',1),
		array('wxid','require','公众号原始id不能为空',1),
		array('weixin','require','微信号不能为空',1),
		array('headerpic','require','头像地址不能为空',1),
		array('token','require','TOKEN不能为空',1),
		array('token','','token已经存在！',1,'unique',1),
		array('province','require','省份不能为空',1),
		array('city','require','市级不能为空',1),
		array('qq','email','公众号邮箱格式不正确'),
		array('wxfans','number','微信粉丝格式不正确'),
		array('typename','require','分类必须选择！',0,'',3),
		
	);
	
	protected $_auto = array (
		array('uid','getuser',self::MODEL_INSERT,'callback'),
		array('uname','getname',self::MODEL_INSERT,'callback'),
		array('tpltypeid','1',self::MODEL_INSERT),
		array('shoptpltypeid','1',self::MODEL_INSERT),
		array('tpllistid','1',self::MODEL_INSERT),
		array('tplcontentid','1',self::MODEL_INSERT),
		array('tpltypename','ty_index',self::MODEL_INSERT),
		array('shoptpltypename','ty_index',self::MODEL_INSERT),
		array('tpllistname','yl_list',self::MODEL_INSERT),
		array('tplcontentname','ktv_content',self::MODEL_INSERT),
		array('createtime','time',self::MODEL_INSERT,'function'),
		array('updatetime','time',self::MODEL_BOTH,'function'),
		array('typeid','gettypeid',self::MODEL_BOTH,'callback'),
		array('typename','gettypename',self::MODEL_BOTH,'callback'),
	);
	public function chekWechatCardNums(){
		$data=M('User_group')->field('wechat_card_num')->where(array('id'=>session('gid')))->find();
		$users=M('Users')->field('wechat_card_num')->where(array('id'=>session('uid')))->find();
		if($users['wechat_card_num']<$data['wechat_card_num']){
			//M('Users')->field('wechat_card_num')->where(array('id'=>session('uid')))->setInc('wechat_card_num');
			return 0;
		}else{
			return 1;
		}
	
	}
	public function getuser(){
		return session('uid');
	}
	
	public function getname(){
		return session('uname');
	}
	
	public function gettypeid(){
		$res=explode(',',$_POST['type']);
		return $res[0];
	}
	
	public function gettypename(){
		$res=explode(',',$_POST['type']);
		return $res[1];
	}
	
}
?>