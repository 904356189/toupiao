<?php

class ProductAction extends UserAction{
public $IIIIIIIIlIlI;
public $IIIIII11l11l;
public $IIIIII11l111;
public $IIIIII111III;
public function _initialize() {
parent::_initialize();
$IIIIIIl11l1I=M('token_open')->field('queryname')->where(array('token'=>session('token')))->find();
if((!intval($_GET['dining'])&&!strpos($IIIIIIl11l1I['queryname'],'shop')) ||(intval($_GET['dining'])&&!strpos($IIIIIIl11l1I['queryname'],'dx'))){
$this->error('您的VIP权限不够,请到升级会员VIP',U('Alipay/vip',array('token'=>session('token'),'id'=>session('wxid'))));
}
if (isset($_GET['dining'])&&intval($_GET['dining'])){
$this->IIIIII111III=1;
}else {
$this->IIIIII111III=0;
}
$this->assign('isDining',$this->IIIIII111III);
}
public function index(){
$IIIIII111IIl=intval($_GET['catid']);
$IIIIII111IIl=$IIIIII111IIl==''?0:$IIIIII111IIl;
$IIIIII11l11l=M('Product');
$IIIIII11l111=M('Product_cat');
$IIIIIIIIlIl1=array('token'=>session('token'));
if ($IIIIII111IIl){
$IIIIIIIIlIl1['catid']=$IIIIII111IIl;
}
$IIIIIIIIlIl1['dining']=$this->IIIIII111III;
$IIIIIIIIlIl1['groupon']=array('neq',1);
if(IS_POST){
$IIIIIIIlI11I = $this->_post('searchkey');
if(empty($IIIIIIIlI11I)){
$this->error("关键词不能为�?);
            }

            $IIIIII1IIlIl['token'] = $this->get('token'); 
            $IIIIII1IIlIl['name|intro|keyword'] = array('like',"%$IIIIIIIlI11I%"); 
            $IIIIIIIIlIII = $IIIIII11l11l->where($IIIIII1IIlIl)->select(); 
            $IIIIIIIII1ll      = $IIIIII11l11l->where($IIIIII1IIlIl)->count();       
            $IIIIIIll1lll       = new Page($IIIIIIIII1ll,20);
        	$IIIIIIIII11l       = $IIIIIIll1lll->show();
        }else{
        	$IIIIIIIII1ll      = $IIIIII11l11l->where($IIIIIIIIlIl1)->count();
        	$IIIIIIll1lll       = new Page($IIIIIIIII1ll,20);
        	$IIIIIIIII11l       = $IIIIIIll1lll->show();
        	$IIIIIIIIlIII = $IIIIII11l11l->where($IIIIIIIIlIl1)->order('id desc')->limit($IIIIIIll1lll->firstRow.','.$IIIIIIll1lll->listRows)->select();
        }
		$this->assign('page',$IIIIIIIII11l);		
		$this->assign('list',$IIIIIIIIlIII);
		$this->assign('isProductPage',1);
		
		$this->display();		
	}
	public function cats(){		
		/*
		$IIIIIIl11l1I=M('token_open')->field('queryname')->where(array('token'=>session('token')))->find();

		if(!strpos($IIIIIIl11l1I['queryname'],'adma')){
            $this->error('您的VIP权限不够,请到升级会员VIP',U('Alipay/vip',array('token'=>session('token'),'id'=>session('wxid'))));}
		 */
		$IIIIII111II1=intval($_GET['parentid']);
		$IIIIII111II1=$IIIIII111II1==''?0:$IIIIII111II1;
		$IIIIIIIIIl11=M('Product_cat');
		$IIIIIIIIlIl1=array('parentid'=>$IIIIII111II1,'token'=>session('token'));
		$IIIIIIIIlIl1['dining']=$this->IIIIII111III;
        if(IS_POST){
            $IIIIIIIlI11I = $this->_post('searchkey');
            if(empty($IIIIIIIlI11I)){
                $this->error("关键词不能为�?);
}
$IIIIII1IIlIl['token'] = $this->get('token');
$IIIIII1IIlIl['name|des'] = array('like',"%$IIIIIIIlI11I%");
$IIIIIIIIlIII = $IIIIIIIIIl11->where($IIIIII1IIlIl)->select();
$IIIIIIIII1ll      = $IIIIIIIIIl11->where($IIIIII1IIlIl)->count();
$IIIIIIll1lll       = new Page($IIIIIIIII1ll,20);
$IIIIIIIII11l       = $IIIIIIll1lll->show();
}else{
$IIIIIIIII1ll      = $IIIIIIIIIl11->where($IIIIIIIIlIl1)->count();
$IIIIIIll1lll       = new Page($IIIIIIIII1ll,20);
$IIIIIIIII11l       = $IIIIIIll1lll->show();
$IIIIIIIIlIII = $IIIIIIIIIl11->where($IIIIIIIIlIl1)->limit($IIIIIIll1lll->firstRow.','.$IIIIIIll1lll->listRows)->select();
}
$this->assign('page',$IIIIIIIII11l);
$this->assign('list',$IIIIIIIIlIII);
if ($IIIIII111II1){
$IIIIII111IlI = $IIIIIIIIIl11->where(array('id'=>$IIIIII111II1))->find();
}
$this->assign('parentCat',$IIIIII111IlI);
$this->assign('parentid',$IIIIII111II1);
$this->display();
}
public function catAdd(){
if(IS_POST){
if ($this->IIIIII111III){
$this->insert('Product_cat','/cats?dining=1&parentid='.$this->_post('parentid'));
}else {
$this->insert('Product_cat','/cats?parentid='.$this->_post('parentid'));
}
}else{
$IIIIII111II1=intval($_GET['parentid']);
$IIIIII111II1=$IIIIII111II1==''?0:$IIIIII111II1;
$this->assign('parentid',$IIIIII111II1);
$this->display('catSet');
}
}
public function catDel(){
if($this->_get('token')!=session('token')){$this->error('非法操作');}
$IIIIIIIII1I1 = $this->_get('id');
if(IS_GET){
$IIIIIIIIlIl1=array('id'=>$IIIIIIIII1I1,'token'=>session('token'));
$IIIIIIIIIl11=M('Product_cat');
$IIIIIIl111Il=$IIIIIIIIIl11->where($IIIIIIIIlIl1)->find();
if($IIIIIIl111Il==false)   $this->error('非法操作');
$IIIIII11l11l=M('Product');
$IIIIII111I1I=$IIIIII11l11l->where(array('catid'=>$IIIIIIIII1I1))->select;
if (count($IIIIII111I1I)){
$this->error('本分类下有商品，请删除商品后再删除分�?,U('Product/cats',array('token'=>session('token'),'dining'=>$this->isDining)));
            }
            $back=$data->where($wehre)->delete();
            if($back==true){
            	if (!$this->isDining){
                $this->success('操作成功',U('Product/cats',array('token'=>session('token'),'parentid'=>$check['parentid'])));
            	}else {
            		$this->success('操作成功',U('Product/cats',array('token'=>session('token'),'parentid'=>$check['parentid'],'dining'=>1)));
            	}
            }else{
                 $this->error('服务器繁�?请稍后再�?,U('Product/cats',array('token'=>session('token'))));
}
}
}
public function catSet(){
$IIIIIIIII1I1 = $this->_get('id');
$IIIIII1IIlI1 = M('Product_cat')->where(array('id'=>$IIIIIIIII1I1))->find();
if(empty($IIIIII1IIlI1)){
$this->error("没有相应记录.您现在可以添�?",U('Product/catAdd'));
}
if(IS_POST){
$IIIIIIIIIl11=D('Product_cat');
$IIIIIIIIlIl1=array('id'=>$this->_post('id'),'token'=>session('token'));
$IIIIIIl111Il=$IIIIIIIIIl11->where($IIIIIIIIlIl1)->find();
if($IIIIIIl111Il==false)$this->error('非法操作');
if($IIIIIIIIIl11->create()){
if($IIIIIIIIIl11->where($IIIIIIIIlIl1)->save($_POST)){
if (!$this->IIIIII111III){
$this->success('修改成功',U('Product/cats',array('token'=>session('token'),'parentid'=>$this->_post('parentid'))));
}else {
$this->success('修改成功',U('Product/cats',array('token'=>session('token'),'parentid'=>$this->_post('parentid'),'dining'=>1)));
}
}else{
$this->error('操作失败');
}
}else{
$this->error($IIIIIIIIIl11->getError());
}
}else{
$this->assign('parentid',$IIIIII1IIlI1['parentid']);
$this->assign('set',$IIIIII1IIlI1);
$this->display();
}
}
public function add(){
if(IS_POST){
$this->all_insert('Product','/index?token='.session('token').'&dining='.$this->IIIIII111III);
}else{
$IIIIIIIIIl11=M('Product_cat');
$IIIIII111I11=array('parentid'=>0,'token'=>session('token'));
if ($this->IIIIII111III){
$IIIIII111I11['dining']=1;
}else {
$IIIIII111I11['dining']=0;
}
$IIIIII111lII=$IIIIIIIIIl11->where($IIIIII111I11)->select();
if (!$IIIIII111lII){
$this->error("请先添加分类",U('Product/catAdd',array('token'=>session('token'),'dining'=>$this->IIIIII111III)));
exit();
}
$this->assign('cats',$IIIIII111lII);
$IIIIII111lIl=$this->catOptions($IIIIII111lII,0);
$this->assign('catsOptions',$IIIIII111lIl);
$this->assign('isProductPage',1);
$this->display('set');
}
}
public function ajaxCatOptions(){
$IIIIII111II1=intval($_GET['parentid']);
$IIIIIIIIIl11=M('Product_cat');
$IIIIII111I11=array('parentid'=>$IIIIII111II1,'token'=>session('token'));
$IIIIII111lII=$IIIIIIIIIl11->where($IIIIII111I11)->select();
$IIIIIII1IlII='';
if ($IIIIII111lII){
foreach ($IIIIII111lII as $IIIIIII11IIl){
$IIIIIII1IlII.='<option value="'.$IIIIIII11IIl['id'].'">'.$IIIIIII11IIl['name'].'</option>';
}
}
$this->show($IIIIIII1IlII);
}
public function set(){
$IIIIIIIII1I1 = $this->_get('id');
$IIIIII11l11l=M('Product');
$IIIIII11l111=M('Product_cat');
$IIIIII1IIlI1 = $IIIIII11l11l->where(array('id'=>$IIIIIIIII1I1))->find();
if(empty($IIIIII1IIlI1)){
$this->error("没有相应记录.您现在可以添�?",U('Product/add'));
}
if(IS_POST){
$IIIIIIIIlIl1=array('id'=>$this->_post('id'),'token'=>session('token'));
$IIIIIIl111Il=$IIIIII11l11l->where($IIIIIIIIlIl1)->find();
if($IIIIIIl111Il==false)$this->error('非法操作');
if($IIIIII11l11l->create()){
if($IIIIII11l11l->where($IIIIIIIIlIl1)->save($_POST)){
$this->success('修改成功',U('Product/index',array('token'=>session('token'),'dining'=>$this->IIIIII111III)));
$IIIIIIl11ll1=M('Keyword');
$IIIIIIl11ll1->where(array('token'=>session('token'),'pid'=>$this->_post('id'),'module'=>'Product'))->save(array('keyword'=>$this->_post('keyword')));
}else{
$this->error('操作失败');
}
}else{
$this->error($IIIIII11l11l->getError());
}
}else{
$IIIIII111I11=array('parentid'=>0,'token'=>session('token'));
if ($this->IIIIII111III){
$IIIIII111I11['dining']=1;
}
$IIIIII111lII=$IIIIII11l111->where($IIIIII111I11)->select();
$this->assign('cats',$IIIIII111lII);
$IIIIII111llI=$IIIIII11l111->where(array('id'=>$IIIIII1IIlI1['catid']))->find();
$IIIIII111lll=$IIIIII11l111->where(array('parentid'=>$IIIIII111llI['parentid']))->select();
$this->assign('thisCat',$IIIIII111llI);
$this->assign('parentCatid',$IIIIII111llI['parentid']);
$this->assign('childCats',$IIIIII111lll);
$this->assign('isUpdate',1);
$IIIIII111lIl=$this->catOptions($IIIIII111lII,$IIIIII1IIlI1['catid']);
$IIIIII111ll1=$this->catOptions($IIIIII111lll,$IIIIII111llI['id']);
$this->assign('catsOptions',$IIIIII111lIl);
$this->assign('childCatsOptions',$IIIIII111ll1);
$this->assign('set',$IIIIII1IIlI1);
$this->assign('isProductPage',1);
$this->display();
}
}
public function catOptions($IIIIII111lII,$IIIIII111l1l){
$IIIIIII1IlII='';
if ($IIIIII111lII){
foreach ($IIIIII111lII as $IIIIIII11IIl){
$IIIIII111l11='';
if ($IIIIIII11IIl['id']==$IIIIII111l1l){
$IIIIII111l11=' selected';
}
$IIIIIII1IlII.='<option value="'.$IIIIIII11IIl['id'].'"'.$IIIIII111l11.'>'.$IIIIIII11IIl['name'].'</option>';
}
}
return $IIIIIII1IlII;
}
public function del(){
$IIIIII11l11l=M('Product');
if($this->_get('token')!=session('token')){$this->error('非法操作');}
$IIIIIIIII1I1 = $this->_get('id');
if(IS_GET){
$IIIIIIIIlIl1=array('id'=>$IIIIIIIII1I1,'token'=>session('token'));
$IIIIIIl111Il=$IIIIII11l11l->where($IIIIIIIIlIl1)->find();
if($IIIIIIl111Il==false)   $this->error('非法操作');
$IIIIIIIlIIIl=$IIIIII11l11l->where($IIIIII1IIllI)->delete();
if($IIIIIIIlIIIl==true){
$IIIIIIl11ll1=M('Keyword');
$IIIIIIl11ll1->where(array('token'=>session('token'),'pid'=>$IIIIIIIII1I1,'module'=>'Product'))->delete();
$this->success('操作成功',U('Product/index',array('token'=>session('token'),'dining'=>$this->IIIIII111III)));
}else{
$this->error('服务器繁�?请稍后再�?,U('Product/index',array('token'=>session('token'))));
            }
        }        
	}
	public function orders(){
		$product_cart_model=M('product_cart');
		if (IS_POST){
			if ($_POST['token']!=$this->_session('token')){
				exit();
			}
			for ($i=0;$i<40;$i++){
				if (isset($_POST['id_'.$i])){
					$thiCartInfo=$product_cart_model->where(array('id'=>intval($_POST['id_'.$i])))->find();
					if ($thiCartInfo['handled']){
					$product_cart_model->where(array('id'=>intval($_POST['id_'.$i])))->save(array('handled'=>0));
					}else {
						$product_cart_model->where(array('id'=>intval($_POST['id_'.$i])))->save(array('handled'=>1));
					}
				}
			}
			$this->success('操作成功',U('Product/orders',array('token'=>session('token'),'dining'=>$this->isDining)));
		}else{
			

			$where=array('token'=>$this->_session('token'));
			if ($this->isDining){
				$where['dining']=1;
			}else {
				$where['dining']=0;
			}
			$where['groupon']=array('neq',1);
			if(IS_POST){
				$key = $this->_post('searchkey');
				if(empty($key)){
					$this->error("关键词不能为�?);
				}

				$where['truename|address'] = array('like',"%$key%");
				$orders = $product_cart_model->where($where)->select();
				$count      = $product_cart_model->where($where)->limit($Page->firstRow.','.$Page->listRows)->count();
				$Page       = new Page($count,20);
				$show       = $Page->show();
			}else {
				if (isset($_GET['handled'])){
					$where['handled']=intval($_GET['handled']);
				}
				$count      = $product_cart_model->where($where)->count();
				$Page       = new Page($count,20);
				$show       = $Page->show();
				$orders=$product_cart_model->where($where)->order('time DESC')->limit($Page->firstRow.','.$Page->listRows)->select();
			}


			$unHandledCount=$product_cart_model->where(array('token'=>$this->_session('token'),'handled'=>0,'dining'=>intval($_GET['dining'])))->count();
			$this->assign('unhandledCount',$unHandledCount);


			$this->assign('orders',$orders);

			$this->assign('page',$show);
			$this->display();
		}
	}
	public function orderInfo(){
		$this->product_model=M('Product');
		$this->product_cat_model=M('Product_cat');
		$product_cart_model=M('product_cart');
		$thisOrder=$product_cart_model->where(array('id'=>intval($_GET['id'])))->find();
		//检查权�?
		if (strtolower($thisOrder['token'])!=strtolower($this->_session('token'))){
			exit();
		}
		if (IS_POST){
			if (intval($_POST['sent'])){
				$_POST['handled']=1;
			}
			$product_cart_model->where(array('id'=>$thisOrder['id']))->save(array('sent'=>intval($_POST['sent']),'paid'=>intval($_POST['paid']),'logistics'=>$_POST['logistics'],'logisticsid'=>$_POST['logisticsid'],'handled'=>1));
			//
			/************************************************/
			if (intval($_POST['paid'])&&intval($thisOrder['price'])){
				$member_card_create_db=M('Member_card_create');
				$wecha_id=$thisOrder['wecha_id'];
				$userCard=$member_card_create_db->where(array('token'=>$this->token,'wecha_id'=>$wecha_id))->find();
				$member_card_set_db=M('Member_card_set');
				$thisCard=$member_card_set_db->where(array('id'=>intval($userCard['cardid'])))->find();
				$set_exchange = M('Member_card_exchange')->where(array('cardid'=>intval($thisCard['id'])))->find();
				//
				$arr['token']=$this->token;
				$arr['wecha_id']=$wecha_id;
				$arr['expense']=$thisOrder['price'];
				$arr['time']=time();
				$arr['cat']=99;
				$arr['staffid']=0;
				$arr['score']=intval($set_exchange['reward'])*$order['price'];
				M('Member_card_use_record')->add($arr);
				$userinfo_db=M('Userinfo');
				$thisUser = $userinfo_db->where(array('token'=>$thisCard['token'],'wecha_id'=>$arr['wecha_id']))->find();
				$userArr=array();
				$userArr['total_score']=$thisUser['total_score']+$arr['score'];
				$userArr['expensetotal']=$thisUser['expensetotal']+$arr['expense'];
				$userinfo_db->where(array('token'=>$thisCard['token'],'wecha_id'=>$arr['wecha_id']))->save($userArr);
			}
			/************************************************/
			//
			if ($thisOrder['paytype']=='weixin'&&$thisOrder['transactionid']){
				$this->success('修改成功,正在同步发货状态到微信�?,U('Product/deliveryNotify',array('token'=>session('token'),'orderid'=>$IIIIII1111II['orderid'],'wecha_id'=>$IIIIII1111II['wecha_id'],'transactionid'=>$IIIIII1111II['transactionid'],'id'=>$IIIIII1111II['id'])));
}else {
$this->success('修改成功',U('Product/orderInfo',array('token'=>session('token'),'id'=>$IIIIII1111II['id'])));
}
}else {
$IIIIII1111Il=M('product_diningtable');
if ($IIIIII1111II['tableid']) {
$IIIIII1111I1=$IIIIII1111Il->where(array('id'=>$IIIIII1111II['tableid']))->find();
$IIIIII1111II['tableName']=$IIIIII1111I1['name'];
}
$this->assign('thisOrder',$IIIIII1111II);
$IIIIII1111lI=unserialize($IIIIII1111II['info']);
$IIIIII1111l1=0;
$IIIIII11111I=0;
$IIIIII11111l=array();
$IIIIII111111=array();
foreach ($IIIIII1111lI as $IIIIIIIllIll=>$IIIIIII11IIl){
if (is_array($IIIIIII11IIl)){
$IIIIIlIIIIII=$IIIIIIIllIll;
$IIIIIlIIIIIl=$IIIIIII11IIl['price'];
$IIIIIIIII1ll=$IIIIIII11IIl['count'];
if (!in_array($IIIIIlIIIIII,$IIIIII111111)){
array_push($IIIIII111111,$IIIIIlIIIIII);
}
$IIIIII1111l1+=$IIIIIlIIIIIl*$IIIIIIIII1ll;
$IIIIII11111I+=$IIIIIIIII1ll;
}
}
if (count($IIIIII111111)){
$IIIIIIIIlIII=$this->IIIIII11l11l->where(array('id'=>array('in',$IIIIII111111)))->select();
}
if ($IIIIIIIIlIII){
$IIIIIIIllI11=0;
foreach ($IIIIIIIIlIII as $IIIIII1IllIl){
$IIIIIIIIlIII[$IIIIIIIllI11]['count']=$IIIIII1111lI[$IIIIII1IllIl['id']]['count'];
$IIIIIIIllI11++;
}
}
$this->assign('products',$IIIIIIIIlIII);
$this->assign('totalFee',$IIIIII1111l1);
$this->display();
}
}
public function deleteOrder(){
$IIIIII11l11l=M('product');
$IIIIIlIIIIlI=M('product_cart');
$IIIIIlIIIIll=M('product_cart_list');
$IIIIII1111II=$IIIIIlIIIIlI->where(array('id'=>intval($_GET['id'])))->find();
$IIIIIIIII1I1=$IIIIII1111II['id'];
if ($IIIIII1111II['token']!=$this->_session('token')){
exit();
}
$IIIIIlIIIIlI->where(array('id'=>$IIIIIIIII1I1))->delete();
$IIIIIlIIIIll->where(array('cartid'=>$IIIIIIIII1I1))->delete();
$IIIIII1111lI=unserialize($IIIIII1111II['info']);
foreach ($IIIIII1111lI as $IIIIIIIllIll=>$IIIIIII11IIl){
if (is_array($IIIIIII11IIl)){
$IIIIIlIIIIII=$IIIIIIIllIll;
$IIIIIlIIIIIl=$IIIIIII11IIl['price'];
$IIIIIIIII1ll=$IIIIIII11IIl['count'];
$IIIIII11l11l->where(array('id'=>$IIIIIIIllIll))->setDec('salecount',$IIIIIII11IIl['count']);
}
}
$this->success('操作成功',$_SERVER['HTTP_REFERER']);
}
public function tables(){
$IIIIII1111Il=M('product_diningtable');
if (IS_POST){
if ($_POST['token']!=$this->_session('token')){
exit();
}
for ($IIIIIIIllI11=0;$IIIIIIIllI11<40;$IIIIIIIllI11++){
if (isset($_POST['id_'.$IIIIIIIllI11])){
$IIIIIlIIII1I=$IIIIIlIIIIlI->where(array('id'=>intval($_POST['id_'.$IIIIIIIllI11])))->find();
if ($IIIIIlIIII1I['handled']){
$IIIIIlIIIIlI->where(array('id'=>intval($_POST['id_'.$IIIIIIIllI11])))->save(array('handled'=>0));
}else {
$IIIIIlIIIIlI->where(array('id'=>intval($_POST['id_'.$IIIIIIIllI11])))->save(array('handled'=>1));
}
}
}
$this->success('操作成功',U('Product/orders',array('token'=>session('token'))));
}else{
$IIIIIIIIlIl1=array('token'=>$this->_session('token'));
if(IS_POST){
$IIIIIIIlI11I = $this->_post('searchkey');
if(empty($IIIIIIIlI11I)){
$this->error("关键词不能为�?);
				}

				$IIIIIIIIlIl1['truename|address'] = array('like',"%$IIIIIIIlI11I%");
				$IIIIIlIIII1l = $IIIIIlIIIIlI->where($IIIIIIIIlIl1)->select();
				$IIIIIIIII1ll      = $IIIIIlIIIIlI->where($IIIIIIIIlIl1)->count();
				$IIIIIIll1lll       = new Page($IIIIIIIII1ll,20);
				$IIIIIIIII11l       = $IIIIIIll1lll->show();
			}else {
				
				$IIIIIIIII1ll      = $IIIIII1111Il->where($IIIIIIIIlIl1)->count();
				$IIIIIIll1lll       = new Page($IIIIIIIII1ll,20);
				$IIIIIIIII11l       = $IIIIIIll1lll->show();
				$IIIIIlIIII11=$IIIIII1111Il->where($IIIIIIIIlIl1)->order('taxis ASC')->limit($IIIIIIll1lll->firstRow.','.$IIIIIIll1lll->listRows)->select();
			}

			$this->assign('tables',$IIIIIlIIII11);
			$this->assign('page',$IIIIIIIII11l);
			$this->display();
		}
	}
	public function tableAdd(){ 
		if(IS_POST){
			$this->insert('Product_diningtable','/tables?dining=1');
		}else{
			$this->display('tableSet');
		}
	}
	public function tableSet(){
		$IIIIII1111Il=M('product_diningtable');
        $IIIIIIIII1I1 = $this->_get('id'); 
		$IIIIII1IIlI1 = $IIIIII1111Il->where(array('id'=>$IIIIIIIII1I1))->find();
		if(IS_POST){ 
            $IIIIIIIIlIl1=array('id'=>$this->_post('id'),'token'=>session('token'));
			$IIIIIIl111Il=$IIIIII1111Il->where($IIIIIIIIlIl1)->find();
			if($IIIIIIl111Il==false)$this->error('非法操作');
			if($IIIIII1111Il->create()){
				if($IIIIII1111Il->where($IIIIIIIIlIl1)->save($_POST)){
					$this->success('修改成功',U('Product/tables',array('token'=>session('token'),'dining'=>1)));
				}else{
					$this->error('操作失败');
				}
			}else{
				$this->error($IIIIIIIIIl11->getError());
			}
		}else{
			$this->assign('set',$IIIIII1IIlI1);
			$this->display();	
		
		}
	}
	public function tableDel(){
		if($this->_get('token')!=session('token')){$this->error('非法操作');}
        $IIIIIIIII1I1 = $this->_get('id');
        if(IS_GET){                              
            $IIIIIIIIlIl1=array('id'=>$IIIIIIIII1I1,'token'=>session('token'));
            $IIIIII1111Il=M('product_diningtable');
            $IIIIIIl111Il=$IIIIII1111Il->where($IIIIIIIIlIl1)->find();
            if($IIIIIIl111Il==false)   $this->error('非法操作');
           
            $IIIIIIIlIIIl=$IIIIII1111Il->where($IIIIII1IIllI)->delete();
            if($IIIIIIIlIIIl==true){
            	$this->success('操作成功',U('Product/tables',array('token'=>session('token'),'dining'=>1)));
            }else{
                 $this->error('服务器繁�?请稍后再�?,U('Product/tables',array('token'=>session('token'),'dining'=>1)));
            }
        }        
	}
	function deliveryNotify(){
		$IIIIIlIIIlII=M('Alipay_config');
		$this->IIIII1l1l1ll=$IIIIIlIIIlII->where(array('token'=>$this->IIIIIIIIlIlI))->find();

		$IIIIIIIIlIl1=array('token'=>$this->IIIIIIIIlIlI);
		$IIIIIlIIIlIl=M('Wxuser')->where($IIIIIIIIlIl1)->find();
		//wecha_id   orderid   transactionid   
		//deliver notify
		$IIIIIlIIIlIl=M('Wxuser')->where(array('token'=>$this->IIIIIIIIlIlI))->find();
		$IIIIIIl11IIl='https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$IIIIIlIIIlIl['appid'].'&secret='.$IIIIIlIIIlIl['appsecret'];
		$IIIIIIl11II1=json_decode($this->curlGet($IIIIIIl11IIl));
		if (!$IIIIIIl11II1->IIIIIIl11Il1){
			//return array('rt'=>true,'errorno'=>0);
		}else {
			$this->error('获取access_token发生错误：错误代�?.$IIIIIIl11II1->errcode.',微信返回错误信息�?.$IIIIIIl11II1->IIIIIIl11Il1);
		}

		$IIIIIII1l1Il='https://api.weixin.qq.com/pay/delivernotify?access_token='.$IIIIIIl11II1->IIIIIIlllllI;
		$IIIIIII111II=time();

		$IIIIIlIIIlI1=sha1('appid='.$this->IIIII1l1l1ll['appid'].'&appkey='.$this->IIIII1l1l1ll['paysignkey'].'&deliver_msg=ok&deliver_status=1&deliver_timestamp='.$IIIIIII111II.'&openid='.$_GET['wecha_id'].'&out_trade_no='.$_GET['orderid'].'&transid='.$_GET['transactionid'].'');
		$IIIIIlIIIllI='{"appid":"'.$this->payConfig['appid'].'","openid":"'.$_GET['wecha_id'].'","transid":"'.$_GET['transactionid'].'","out_trade_no":"'.$_GET['orderid'].'","deliver_timestamp":"'.$now.'","deliver_status":"1","deliver_msg":"ok","app_signature":"'.$string1.'","sign_method":"sha1"}';
		$this->api_notice_increment($IIIIIII1l1Il,$IIIIIlIIIllI);
		$this->success('同步成功',U('Product/orderInfo',array('token'=>session('token'),'id'=>$_GET['id'])));
	}
	protected function api_notice_increment($IIIIIII1l1Il, $IIIIIIIIIl11){
		$IIIIIIllI11I = curl_init();
		$IIIIIIl11I1l = "Accept-Charset: utf-8";
		curl_setopt($IIIIIIllI11I, CURLOPT_URL, $IIIIIII1l1Il);
		curl_setopt($IIIIIIllI11I, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($IIIIIIllI11I, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($IIIIIIllI11I, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($IIIIIIllll11, CURLOPT_HTTPHEADER, $IIIIIIl11I1l);
		curl_setopt($IIIIIIllI11I, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
		curl_setopt($IIIIIIllI11I, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($IIIIIIllI11I, CURLOPT_AUTOREFERER, 1);
		curl_setopt($IIIIIIllI11I, CURLOPT_POSTFIELDS, $IIIIIIIIIl11);
		curl_setopt($IIIIIIllI11I, CURLOPT_RETURNTRANSFER, true);
		$IIIIIIl11I11 = curl_exec($IIIIIIllI11I);
		$IIIIIIl11lII=curl_errno($IIIIIIllI11I);
		if ($IIIIIIl11lII) {
			return array('rt'=>false,'errorno'=>$IIIIIIl11lII);
		}else{
			$IIIIIIl11lI1=json_decode($IIIIIIl11I11,1);
			if ($IIIIIIl11lI1['errcode']=='0'){
				return array('rt'=>true,'errorno'=>0);
			}else {
				
				$this->error('发生错误：错误代�?.$IIIIIIl11lI1['errcode'].',微信返回错误信息�?.$IIIIIIl11lI1['errmsg']);
			}
		}
	}
	function curlGet($IIIIIII1l1Il){
		$IIIIIIllI11I = curl_init();
		$IIIIIIl11I1l = "Accept-Charset: utf-8";
		curl_setopt($IIIIIIllI11I, CURLOPT_URL, $IIIIIII1l1Il);
		curl_setopt($IIIIIIllI11I, CURLOPT_CUSTOMREQUEST, "GET");
		curl_setopt($IIIIIIllI11I, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($IIIIIIllI11I, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($IIIIIIllll11, CURLOPT_HTTPHEADER, $IIIIIIl11I1l);
		curl_setopt($IIIIIIllI11I, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
		curl_setopt($IIIIIIllI11I, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($IIIIIIllI11I, CURLOPT_AUTOREFERER, 1);
		curl_setopt($IIIIIIllI11I, CURLOPT_POSTFIELDS, $IIIIIIIIIl11);
		curl_setopt($IIIIIIllI11I, CURLOPT_RETURNTRANSFER, true);
		$IIIIIIlllII1 = curl_exec($IIIIIIllI11I);
		return $IIIIIIlllII1;
	}
}


?>

?>