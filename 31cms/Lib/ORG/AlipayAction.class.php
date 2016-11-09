<?php
class AlipayAction extends BaseAction{
	public $token;
	public $wecha_id;
	public $alipayConfig;
	public function __construct(){
		$this->token = $this->_get('token');
		$this->wecha_id	= $this->_get('wecha_id');
		if (!$this->token){
			//
			$product_cart_model=M('product_cart');
			$out_trade_no = $this->_get('out_trade_no');
			$order=$product_cart_model->where(array('orderid'=>$out_trade_no))->find();
			if (!$order){
				$order=$product_cart_model->where(array('id'=>intval($this->_get('out_trade_no'))))->find();
			}
			$this->token=$order['token'];
		}
		//读取配置
		$alipay_config_db=M('Alipay_config');
		$this->alipayConfig=$alipay_config_db->where(array('token'=>$this->token))->find();
	}
	public function pay(){
		//参数数据
		$orderName=$_GET['orderName'];
		$orderid=$_GET['orderid'];
		if (!$orderid){
			$orderid=$_GET['single_orderid'];//单个订单
		}
		//before
		
		$payHandel=new payHandle($this->token,$_GET['from']);
		$orderInfo=$payHandel->beforePay($orderid);
		$price=$orderInfo['price'];
		//
		$from=isset($_GET['from'])?$_GET['from']:'shop';
		//
		$alipayConfig=$this->alipayConfig;
		//
		if(!$price)exit('必须有价格才能支付');
		import("@.ORG.Alipay.AlipaySubmit");
		switch ($alipayConfig['paytype']){
			default:
				$alipayConfig['paytype']='Alipaytype';
				break;
			case 'tenpay':
				$alipayConfig['paytype']='Tenpay';
				break;
			case 'weixin':
				$alipayConfig['paytype']='Weixin';
				break;
			case 'tenpayComputer':
				$alipayConfig['paytype']='TenpayComputer';
				break;
		}
		if ($alipayConfig['paytype']=='Weixin'){
			header('Location:/wxpay/index.php?g=Wap&m='.$alipayConfig['paytype'].'&a=pay&price='.$price.'&orderName='.$orderName.'&single_orderid='.$orderid.'&showwxpaytitle=1&from='.$from.'&token='.$this->token.'&wecha_id='.$this->wecha_id);
		}else {
			header('Location:/index.php?g=Wap&m='.$alipayConfig['paytype'].'&a=pay&price='.$price.'&orderName='.$orderName.'&single_orderid='.$orderid.'&from='.$from.'&token='.$this->token.'&wecha_id='.$this->wecha_id);
		}
	}
}
?>