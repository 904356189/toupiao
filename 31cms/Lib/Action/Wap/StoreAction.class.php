<?php

class StoreAction extends WapAction{
public $IIIIII11l11l;
public $IIIIII11l111;
public $IIIII1llll11;
public $IIIII1lll1II = 0;
public $IIIII1lll1Il;
public $IIIII1lll1I1 = 0;
public $IIIII1lll1lI = null;
public function _initialize() {
parent::_initialize();
$IIIII1Ill1II = $_SERVER['HTTP_USER_AGENT'];
if (!strpos($IIIII1Ill1II,"MicroMessenger")) {
}
$this->IIIII1lll1II = session("session_company_{$this->IIIIIIIIlIlI}");
$this->assign('cid',$this->IIIII1lll1II);
$this->IIIII1llll11 = "session_cart_products_{$this->IIIIIIIIlIlI}_{$this->IIIII1lll1II}";
if (!$this->IIIIIlIIIll1){
}
$this->IIIIII11l11l = M('Product');
$this->IIIIII11l111 = M('Product_cat');
if (C('zhongshuai')) {
$this->IIIII1lll1lI = M('Company')->where("`token`='{$this->IIIIIIIIlIlI}' AND `isbranch`=0")->find();
$IIIIIIIll1ll = $this->IIIII1lll1lI['id'];
$IIIIIIlll111 = M('Product_setting')->where(array('token'=>$this->IIIIIIIIlIlI,'cid'=>$this->IIIII1lll1lI['id']))->find();
$this->IIIII1lll1I1 = isset($IIIIIIlll111['isgroup']) ?intval($IIIIIIlll111['isgroup']) : 0;
}
if ($this->IIIII1lll1II) {
$this->IIIII1lll1Il = M('Product_setting')->where(array('token'=>$this->IIIIIIIIlIlI,'cid'=>$this->IIIII1lll1II))->find();
$this->assign('productSet',$this->IIIII1lll1Il);
$IIIIIIIll1ll = $this->IIIII1lll1I1 ?$this->IIIII1lll1lI['id'] : $this->IIIII1lll1II;
$IIIIII111lII = $this->IIIIII11l111->where(array('token'=>$this->IIIIIIIIlIlI,'cid'=>$IIIIIIIll1ll,'parentid'=>0))->order("sort ASC, id DESC")->select();
$this->assign('cats',$IIIIII111lII);
}
$this->assign('staticFilePath',str_replace('./','/',THEME_PATH.'common/css/store'));
$IIIII1lll1ll = $this->calCartInfo();
$this->assign('totalProductCount',$IIIII1lll1ll[0]);
$this->assign('totalProductFee',$IIIII1lll1ll[1]);
}
public function select()
{
$IIIIIII11l1l = M('Company')->where("`token`='{$this->IIIIIIIIlIlI}' AND ((`isbranch`=1 AND `display`=1) OR `isbranch`=0)")->select();
if (count($IIIIIII11l1l) == 1) {
$this->redirect(U('Store/cats',array('token'=>$this->IIIIIIIIlIlI,'wecha_id'=>$this->IIIIIlIIIll1,'cid'=>$IIIIIII11l1l[0]['id'])));
}
$this->assign('company',$IIIIIII11l1l);
$this->assign('metaTitle','商城分布');
$this->display();
}
public function index() 
{
$this->redirect(U('Store/cats',array('token'=>$this->IIIIIIIIlIlI,'wecha_id'=>$this->IIIIIlIIIll1)));
}
public function cats() 
{
$IIIIIII11l1l = M('Company')->where("`token`='{$this->IIIIIIIIlIlI}' AND `isbranch`=0")->find();
D("Product_cat")->where(array('token'=>$this->IIIIIIIIlIlI,'cid'=>0))->save(array('cid'=>$IIIIIII11l1l['id']));
D("Attribute")->where(array('token'=>$this->IIIIIIIIlIlI,'cid'=>0))->save(array('cid'=>$IIIIIII11l1l['id']));
D("Product")->where(array('token'=>$this->IIIIIIIIlIlI,'cid'=>0))->save(array('cid'=>$IIIIIII11l1l['id']));
D("Product_cart")->where(array('token'=>$this->IIIIIIIIlIlI,'cid'=>0))->save(array('cid'=>$IIIIIII11l1l['id']));
D("Product_cart_list")->where(array('token'=>$this->IIIIIIIIlIlI,'cid'=>0))->save(array('cid'=>$IIIIIII11l1l['id']));
D("Product_comment")->where(array('token'=>$this->IIIIIIIIlIlI,'cid'=>0))->save(array('cid'=>$IIIIIII11l1l['id']));
D("product_setting")->where(array('token'=>$this->IIIIIIIIlIlI,'cid'=>0))->save(array('cid'=>$IIIIIII11l1l['id']));
$IIIIIIIll1ll = $this->IIIII1lll1II = isset($_GET['cid']) ?intval($_GET['cid']) : $IIIIIII11l1l['id'];
if ($this->IIIII1lll1I1) {
$IIIIIIIll1ll = $IIIIIII11l1l['id'];
$IIIII1lll11l = M("Product_relation")->where(array('token'=>$this->IIIIIIIIlIlI,'cid'=>$this->IIIII1lll1II))->select();
if (empty($IIIII1lll11l) &&$this->IIIII1lll1II != $IIIIIIIll1ll) {
$this->error("该店铺暂时没有商品可卖，先逛逛别的",U('Store/select',array('token'=>$this->IIIIIIIIlIlI,'wecha_id'=>$this->IIIIIlIIIll1)));
}
}
session("session_company_{$this->IIIIIIIIlIlI}",$this->IIIII1lll1II);
$this->assign('cid',$this->IIIII1lll1II);
$IIIIII111II1 = isset($_GET['parentid']) ?intval($_GET['parentid']) : 0;
$IIIIII111lII = $this->IIIIII11l111->where(array('token'=>$this->IIIIIIIIlIlI,'cid'=>$IIIIIIIll1ll,'parentid'=>$IIIIII111II1))->order("sort ASC, id DESC")->select();
$IIIIIIIIIlll = array();
foreach ($IIIIII111lII as &$IIIIIIl11lll) {
$IIIIIIl11lll['info'] = $IIIIIIl11lll['des'];
$IIIIIIl11lll['img'] = $IIIIIIl11lll['logourl'];
if ($IIIIIIl11lll['isfinal'] == 1) {
$IIIIIIl11lll['url'] = U('Store/products',array('token'=>$this->IIIIIIIIlIlI,'catid'=>$IIIIIIl11lll['id'],'wecha_id'=>$this->IIIIIlIIIll1));
}else {
$IIIIIIl11lll['url'] = U('Store/cats',array('token'=>$this->IIIIIIIIlIlI,'cid'=>$this->IIIII1lll1II,'parentid'=>$IIIIIIl11lll['id'],'wecha_id'=>$this->IIIIIlIIIll1));
}
$IIIIIIIIIlll[] = $IIIIIIl11lll;
}
$this->assign('info',$IIIIIIIIIlll);
$this->assign('metaTitle','商品分类');
include('./iMicms/Lib/ORG/index.Tpl.php');
include('./iMicms/Lib/ORG/cont.Tpl.php');
$IIIII1lll111[0] = array('id'=>0,'name'=>'所有商品','picurl'=>'/tpl/static/store/m-act-cat.png','k'=>0,'vo'=>array(),'url'=>U('Store/cats',array('token'=>$this->IIIIIIIIlIlI,'wecha_id'=>$this->IIIIIlIIIll1,'cid'=>$this->IIIII1lll1II)));
$IIIII1lll111[1] = array('id'=>1,'name'=>'购物车','picurl'=>'/tpl/static/store/m-act-cart.png','k'=>1,'vo'=>array(),'url'=>U('Store/cart',array('token'=>$this->IIIIIIIIlIlI,'wecha_id'=>$this->IIIIIlIIIll1,'cid'=>$this->IIIII1lll1II)));
$IIIII1lll111[2] = array('id'=>2,'name'=>'查物流','picurl'=>'/tpl/static/store/m-act-wuliu.png','k'=>2,'vo'=>array(),'url'=>U('Store/my',array('token'=>$this->IIIIIIIIlIlI,'wecha_id'=>$this->IIIIIlIIIll1,'cid'=>$this->IIIII1lll1II)));
$IIIII1lll111[3] = array('id'=>3,'name'=>'用户中心','picurl'=>'/tpl/static/store/user2.png','k'=>3,'vo'=>array(),'url'=>U('Store/my',array('token'=>$this->IIIIIIIIlIlI,'wecha_id'=>$this->IIIIIlIIIll1,'cid'=>$this->IIIII1lll1II)));
$this->assign('catemenu',$IIIII1lll111);
$IIIIIIlll111 = M("Product_setting")->where(array('token'=>$this->IIIIIIIIlIlI,'cid'=>$this->IIIII1lll1II))->find();
if (isset($IIIIIIl1lI11[$IIIIIIlll111['tpid'] -1]['tpltypename'])) {
$IIIIII1II11l = $IIIIIIl1lI11[$IIIIIIlll111['tpid'] -1]['tpltypename'];
$IIIII1ll1III = "tpl/Wap/default/Index_menuStyle{$IIIIIIlll111['footerid']}.html";
$this->assign('cateMenuFileName',$IIIII1ll1III);
$IIIII1I1lllI=M('Store_flash')->where(array('token'=>$this->IIIIIIIIlIlI,'cid'=>$this->IIIII1lll1II))->select();
foreach ($IIIII1I1lllI as &$IIIIIIIl1111) {
if ($IIIIIIIl1111['url']) {
$IIIIIII1l1Il = $IIIIIIIl1111['url'];
$IIIII1I11Il1=str_replace(array('{wechat_id}','{siteUrl}','&amp;'),array($this->IIIIIlIIIll1,$this->siteUrl,'&'),$IIIIIII1l1Il);
if (!!(strpos($IIIIIII1l1Il,'tel')===false)&&$IIIIIII1l1Il!='javascript:void(0)'&&!strpos($IIIIIII1l1Il,'wecha_id=')){
if (strpos($IIIIIII1l1Il,'?')){
$IIIII1I11Il1=$IIIII1I11Il1.'&wecha_id='.$this->IIIIIlIIIll1;
}else {
$IIIII1I11Il1=$IIIII1I11Il1.'?wecha_id='.$this->IIIIIlIIIll1;
}
}
$IIIIIIIl1111['url'] = $IIIII1I11Il1;
}
}
$IIIII1I1llll = array();
$IIIII1I1lll1 = array();
foreach ($IIIII1I1lllI as $IIIII1I1ll1I){
if ($IIIII1I1ll1I['url']=='') {
$IIIII1I1ll1I['url']='javascript:void(0)';
}
if ($IIIII1I1ll1I['type'] == 1) {
array_push($IIIII1I1llll,$IIIII1I1ll1I);
}elseif ($IIIII1I1ll1I['type'] == 0) {
array_push($IIIII1I1lll1,$IIIII1I1ll1I);
}
}
$IIIIIIIII1ll = count($IIIII1I1llll);
$this->assign('flash',$IIIII1I1llll);
$this->assign('num',$IIIIIIIII1ll);
$this->assign('flashbg',$IIIII1I1lll1);
$this->assign('flashbgcount',count($IIIII1I1lll1));
$this->display("Index:{$IIIIII1II11l}");
}else {
$this->assign('cats',$IIIIIIIIIlll);
$this->display();
}
}
public function products() 
{
$IIIIIIIIlIl1 = array('token'=>$this->IIIIIIIIlIlI,'cid'=>$this->IIIII1lll1II,'groupon'=>0,'dining'=>0,'status'=>0);
if ($this->IIIII1lll1I1) {
$IIIII1lll11l = M("Product_relation")->where(array('token'=>$this->IIIIIIIIlIlI,'cid'=>$this->IIIII1lll1II))->select();
$IIIII1ll1IlI = array();
foreach ($IIIII1lll11l as $IIIIII1ll11I) {
$IIIII1ll1IlI[] = $IIIIII1ll11I['gid'];
}
if ($IIIII1ll1IlI) $IIIIIIIIlIl1['gid'] = array('in',$IIIII1ll1IlI);
$IIIIIIIIlIl1['cid'] = $this->IIIII1lll1lI['id'];
}
$IIIIII111IIl = isset($_GET['catid']) ?intval($_GET['catid']) : 0;
if ($IIIIII111IIl) {
$IIIIIIIIlIl1['catid'] = $IIIIII111IIl;
$IIIIII111llI = $this->IIIIII11l111->where(array('id'=>$IIIIII111IIl))->find();
$IIIIIIIIlIl1['cid'] = $IIIIII111llI['cid'];
if (empty($this->IIIII1lll1II) ||$this->IIIII1lll1II != $IIIIII111llI['cid']) {
$this->IIIII1lll1II = $IIIIII111llI['cid'];
session("session_company_{$this->IIIIIIIIlIlI}",$this->IIIII1lll1II);
}
$this->assign('thisCat',$IIIIII111llI);
}
if (IS_POST){
$IIIIIIIlI11I = $this->_post('search_name');
$this->redirect('/index.php?g=Wap&m=Store&a=products&token='.$this->IIIIIIIIlIlI .'&wecha_id='.$this->IIIIIlIIIll1 .'&keyword='.$IIIIIIIlI11I);
}
if (isset($_GET['keyword'])){
$IIIIIIIIlIl1['name|intro|keyword'] = array('like',"%".$_GET['keyword']."%");
$this->assign('isSearch',1);
}
$IIIIIIIII1ll = $this->IIIIII11l11l->where($IIIIIIIIlIl1)->count();
$this->assign('count',$IIIIIIIII1ll);
$IIIIIIllI1l1 = isset($_GET['method']) &&($_GET['method']=='DESC'||$_GET['method']=='ASC') ?$_GET['method'] : 'DESC';
$IIIIIlIIII1l = array('time','discount','price','salecount');
$IIIIIIIIl1Il = isset($_GET['order']) &&in_array($_GET['order'],$IIIIIlIIII1l) ?$_GET['order'] : 'time';
$this->assign('order',$IIIIIIIIl1Il);
$this->assign('method',$IIIIIIllI1l1);
$IIIIII11111l = $this->IIIIII11l11l->where($IIIIIIIIlIl1)->order("sort ASC, ".$IIIIIIIIl1Il.' '.$IIIIIIllI1l1)->limit('0, 8')->select();
$this->assign('products',$IIIIII11111l);
$IIIIIIIlIIII = isset($IIIIII111llI['name']) ?$IIIIII111llI['name'] .'列表': "商品列表";
$this->assign('metaTitle',$IIIIIIIlIIII);
$this->display();
}
public function ajaxProducts()
{
$IIIIIIIIlIl1 = array('token'=>$this->IIIIIIIIlIlI,'cid'=>$this->IIIII1lll1II,'groupon'=>0,'dining'=>0,'status'=>0);
if ($this->IIIII1lll1I1) {
$IIIII1lll11l = M("Product_relation")->where(array('token'=>$this->IIIIIIIIlIlI,'cid'=>$this->IIIII1lll1II))->select();
$IIIII1ll1IlI = array();
foreach ($IIIII1lll11l as $IIIIII1ll11I) {
$IIIII1ll1IlI[] = $IIIIII1ll11I['gid'];
}
if ($IIIII1ll1IlI) $IIIIIIIIlIl1['gid'] = array('in',$IIIII1ll1IlI);
$IIIIIIIIlIl1['cid'] = $this->IIIII1lll1lI['id'];
}
if (isset($_GET['catid'])) {
$IIIIII111IIl = intval($_GET['catid']);
$IIIIIIIIlIl1['catid'] = $IIIIII111IIl;
}
$IIIIIIIII11I = isset($_GET['page']) &&intval($_GET['page']) >1 ?intval($_GET['page']) : 2;
$IIIII1ll1Il1 = isset($_GET['pagesize']) &&intval($_GET['pagesize']) >1 ?intval($_GET['pagesize']) : 8;
$IIIIIIllI1l1 = isset($_GET['method']) &&($_GET['method']=='DESC'||$_GET['method']=='ASC') ?$_GET['method'] : 'DESC';
$IIIIIlIIII1l = array('time','discount','price','salecount');
$IIIIIIIIl1Il = isset($_GET['order']) &&in_array($_GET['order'],$IIIIIlIIII1l) ?$_GET['order'] : 'time';
$IIIII1ll1I1I = ($IIIIIIIII11I-1) * $IIIII1ll1Il1;
$IIIIII11111l = $this->IIIIII11l11l->where($IIIIIIIIlIl1)->order("sort ASC, ".$IIIIIIIIl1Il.' '.$IIIIIIllI1l1)->limit($IIIII1ll1I1I .','.$IIIII1ll1Il1)->select();
exit(json_encode(array('products'=>$IIIIII11111l)));
}
public function product() 
{
$IIIIIIIII1I1 = isset($_GET['id']) ?intval($_GET['id']) : 0;
$IIIIIIIIlIl1 = array('token'=>$this->IIIIIIIIlIlI,'id'=>$IIIIIIIII1I1);
$IIIII1ll1I11 = $this->IIIIII11l11l->where($IIIIIIIIlIl1)->find();
if (empty($IIIII1ll1I11)) {
$this->redirect(U('Store/products',array('token'=>$this->IIIIIIIIlIlI,'wecha_id'=>$this->IIIIIlIIIll1)));
}
$IIIIIIIll1ll = $this->IIIII1lll1I1 ?$this->IIIII1lll1lI['id'] : $this->IIIII1lll1II;
$IIIII1ll1I11['intro'] = isset($IIIII1ll1I11['intro']) ?htmlspecialchars_decode($IIIII1ll1I11['intro']) : '';
$this->assign('product',$IIIII1ll1I11);
if ($IIIII1ll1I11['endtime']){
$IIIII1ll1lII = intval($IIIII1ll1I11['endtime'] -time());
$this->assign('leftSeconds',$IIIII1ll1lII);
}
$IIIII1ll1lIl = M("Norms")->where(array('catid'=>$IIIII1ll1I11['catid']))->select();
foreach ($IIIII1ll1lIl as $IIIIIIl11lll) {
$IIIII1ll1lI1[$IIIIIIl11lll['id']] = $IIIIIIl11lll['value'];
}
if($IIIII1ll1llI = M('Product_cat')->where(array('id'=>$IIIII1ll1I11['catid'],'token'=>$this->IIIIIIIIlIlI,'cid'=>$IIIIIIIll1ll))->find()) {
$this->assign('catData',$IIIII1ll1llI);
}
$IIIII1ll1lll = $IIIII1ll1ll1 = $IIIII1ll1l1I = array();
$IIIII1ll1l1l = M("Product_attribute")->where(array('pid'=>$IIIII1ll1I11['id']))->select();
$IIIII1ll1l11 = M("Product_detail")->where(array('pid'=>$IIIII1ll1I11['id']))->select();
foreach ($IIIII1ll1l11 as $IIIIII1IllIl) {
$IIIIII1IllIl['formatName'] = $IIIII1ll1lI1[$IIIIII1IllIl['format']];
$IIIIII1IllIl['colorName'] = $IIIII1ll1lI1[$IIIIII1IllIl['color']];
$IIIII1ll11II[$IIIIII1IllIl['format']] = $IIIII1ll11Il[$IIIIII1IllIl['color']] = $IIIII1ll1l1I[] = $IIIIII1IllIl;
$IIIII1ll1lll[$IIIIII1IllIl['color']][] = $IIIIII1IllIl;
$IIIII1ll11I1[$IIIIII1IllIl['format']][] = $IIIIII1IllIl;
}
$IIIII1ll11lI = M("Product_image")->where(array('pid'=>$IIIII1ll1I11['id']))->select();
$this->assign('imageList',$IIIII1ll11lI);
$this->assign('productDetail',$IIIII1ll1l1I);
$this->assign('attributeData',$IIIII1ll1l1l);
$this->assign('normsDetail',$IIIII1ll11I1);
$this->assign('colorDetail',$IIIII1ll1lll);
$this->assign('formatData',$IIIII1ll11II);
$this->assign('colorData',$IIIII1ll11Il);
$this->assign('metaTitle',$IIIII1ll1I11['name']);
$IIIIIIIIlIl1 = array('token'=>$this->IIIIIIIIlIlI,'cid'=>$IIIIIIIll1ll,'pid'=>$IIIIIIIII1I1,'isdelete'=>0);
$IIIIII11l11l = M("Product_comment");
$IIIII1ll11ll      = $IIIIII11l11l->where($IIIIIIIIlIl1)->sum('score');
$IIIIIIIII1ll      = $IIIIII11l11l->where($IIIIIIIIlIl1)->count();
$IIIII1ll11l1 = $IIIIII11l11l->where($IIIIIIIIlIl1)->order('id desc')->limit("0, 10")->select();
foreach ($IIIII1ll11l1 as &$IIIII1ll111I) {
$IIIII1ll111I['wecha_id'] = substr($IIIII1ll111I['wecha_id'],0,7) ."****";
}
$IIIII1ll111l = "100%";
if ($IIIIIIIII1ll) {
$IIIII1ll11ll = number_format($IIIII1ll11ll / $IIIIIIIII1ll,1);
$IIIII1ll111l =  number_format($IIIII1ll11ll / 5,2) * 100 ."%";
}
$IIIII1ll1111 = ceil($IIIIIIIII1ll / 10);
$IIIIIIIII11I = $IIIII1ll1111 >1 ?2 : 0;
$this->assign('score',$IIIII1ll11ll);
$this->assign('num',$IIIIIIIII1ll);
$this->assign('page',$IIIIIIIII11I);
$this->assign('comment',$IIIII1ll11l1);
$this->assign('percent',$IIIII1ll111l);
$this->display();
}
public function getcomment()
{
$IIIIIIIII11I = isset($_GET['page']) ?max(intval($_GET['page']),1) : 1;
$IIIII1ll1I1I = ($IIIIIIIII11I -1) * $IIIIII11Il1l;
$IIIIII11Il1l = 10;
$IIIIIIIIlllI = isset($_GET['pid']) ?intval($_GET['pid']) : 0;
$IIIIIIIIlIl1 = array('token'=>$this->IIIIIIIIlIlI,'pid'=>$IIIIIIIIlllI,'isdelete'=>0);
$IIIIII11l11l = M("Product_comment");
$IIIIIIIII1ll = $IIIIII11l11l->where($IIIIIIIIlIl1)->count();
$IIIII1ll11l1 = $IIIIII11l11l->where($IIIIIIIIlIl1)->order('id desc')->limit($IIIII1ll1I1I,$IIIIII11Il1l)->select();
foreach ($IIIII1ll11l1 as &$IIIII1ll111I) {
$IIIII1ll111I['wecha_id'] = substr($IIIII1ll111I['wecha_id'],0,7) ."****";
$IIIII1ll111I['dateline'] = date("Y-m-d H:i",$IIIII1ll111I['dateline']);
}
$IIIII1ll1111 = ceil($IIIIIIIII1ll / $IIIIII11Il1l);
$IIIIIIIII11I = $IIIII1ll1111 >$IIIIIIIII11I ?intval($IIIIIIIII11I +1) : 0;
exit(json_encode(array('error_code'=>false,'data'=>$IIIII1ll11l1,'page'=>$IIIIIIIII11I)));
}
public function addProductToCart()
{
$IIIIIIIII1ll = isset($_GET['count']) ?intval($_GET['count']) : 1;
$IIIIII1111lI = $this->_getCart();
$IIIIIIIII1I1 = intval($_GET['id']);
$IIIII1l1IIlI = isset($_GET['did']) ?intval($_GET['did']) : 0;
if (isset($IIIIII1111lI[$IIIIIIIII1I1])) {
if ($IIIII1l1IIlI) {
if (isset($IIIIII1111lI[$IIIIIIIII1I1][$IIIII1l1IIlI])) {
$IIIIII1111lI[$IIIIIIIII1I1][$IIIII1l1IIlI]['count'] += $IIIIIIIII1ll;
}else {
$IIIIII1111lI[$IIIIIIIII1I1][$IIIII1l1IIlI]['count'] = $IIIIIIIII1ll;
}
}else {
$IIIIII1111lI[$IIIIIIIII1I1] += $IIIIIIIII1ll;
}
}else {
if ($IIIII1l1IIlI) {
$IIIIII1111lI[$IIIIIIIII1I1][$IIIII1l1IIlI]['count'] = $IIIIIIIII1ll;
}else {
$IIIIII1111lI[$IIIIIIIII1I1] = $IIIIIIIII1ll;
}
}
$_SESSION[$this->IIIII1llll11] = serialize($IIIIII1111lI);
$IIIII1lll1ll = $this->calCartInfo();
echo $IIIII1lll1ll[0].'|'.$IIIII1lll1ll[1];
}
private function calCartInfo($IIIIII1111lI='')
{
$IIIIII11111I = $IIIIII1111l1 = 0;
if (!$IIIIII1111lI) {
$IIIIII1111lI = $this->_getCart();
}
$IIIIIIIIIl11 = $this->getCat($IIIIII1111lI);
if (isset($IIIIIIIIIl11[1])) {
foreach ($IIIIIIIIIl11[1] as $IIIIIIIIlllI =>$IIIIIIl11lll) {
$IIIIII11111I += $IIIIIIl11lll['total'];
$IIIIII1111l1 += $IIIIIIl11lll['totalPrice'];
}
}
return array($IIIIII11111I,$IIIIII1111l1,$IIIIIIIIIl11[2]);
}
private function _getCart()
{
if (!isset($_SESSION[$this->IIIII1llll11])||!strlen($_SESSION[$this->IIIII1llll11])){
$IIIIII1111lI = array();
}else {
$IIIIII1111lI=unserialize($_SESSION[$this->IIIII1llll11]);
}
return $IIIIII1111lI;
}
public function cart()
{
if (empty($this->IIIIIlIIIll1)) {
unset($_SESSION[$this->IIIII1llll11]);
}
$IIIIII11111I = $IIIIII1111l1 = 0;
$IIIIIIIIIl11 = $this->getCat($this->_getCart());
if (isset($IIIIIIIIIl11[1])) {
foreach ($IIIIIIIIIl11[1] as $IIIIIIIIlllI =>$IIIIIIl11lll) {
$IIIIII11111I += $IIIIIIl11lll['total'];
$IIIIII1111l1 += $IIIIIIl11lll['totalPrice'];
}
}
$IIIIIIIIlIII = $IIIIIIIIIl11[0];
$this->assign('products',$IIIIIIIIlIII);
$this->assign('totalFee',$IIIIII1111l1);
$this->assign('totalCount',$IIIIII11111I);
$this->assign('metaTitle','购物车');
$this->display();
}
public function getCat($IIIIII1111lI = '')
{
$IIIIII1111lI = empty($IIIIII1111lI) ?$this->_getCart() : $IIIIII1111lI;
$IIIII1l1II11 = 0;
$IIIII1l1IlII = array_keys($IIIIII1111lI);
$IIIII1l1IlIl = $IIIII1l1IlI1 = array();
if (empty($IIIII1l1IlII)) {
return array(array(),array(),array());
}
$IIIII1l1IllI = $this->IIIIII11l11l->where(array('id'=>array('in',$IIIII1l1IlII)))->select();
foreach ($IIIII1l1IllI as $IIIIII1IllIl) {
if (!in_array($IIIIII1IllIl['catid'],$IIIII1l1IlI1)) {
$IIIII1l1IlI1[] = $IIIIII1IllIl['catid'];
}
$IIIII1l1II11 = max($IIIII1l1II11,$IIIIII1IllIl['mailprice']);
$IIIII1l1IlIl[$IIIIII1IllIl['id']] = $IIIIII1IllIl;
}
$IIIII1l1Illl = $IIIII1l1Ill1 = array();
if ($IIIII1l1IlI1) {
$IIIII1l1Il1I = M('norms')->where(array('catid'=>array('in',$IIIII1l1IlI1)))->select();
foreach ($IIIII1l1Il1I as $IIIIII1ll11I) {
$IIIII1l1Ill1[$IIIIII1ll11I['id']] = $IIIIII1ll11I['value'];
}
$IIIII1l1Il1l = M('Product_cat')->where(array('id'=>array('in',$IIIII1l1IlI1)))->select();
foreach ($IIIII1l1Il1l as $IIIII1l1Il11) {
$IIIII1l1Illl[$IIIII1l1Il11['id']] = $IIIII1l1Il11;
}
}
$IIIII1l1I1II = array();
foreach ($IIIIII1111lI as $IIIIIIIIlllI =>$IIIII1l1I1Il) {
if (is_array($IIIII1l1I1Il)) {
$IIIII1l1I1II = array_merge($IIIII1l1I1II,array_keys($IIIII1l1I1Il));
}
}
$IIIII1l1I1I1 = 0;
$IIIIIIIIIl11 = array();
if ($IIIII1l1I1II) {
$IIIII1l1I1II = array_unique($IIIII1l1I1II);
$IIIII1l1I1ll = M('Product_detail')->where(array('id'=>array('in',$IIIII1l1I1II)))->select();
foreach ($IIIII1l1I1ll as $IIIIIIl11lll) {
$IIIIIIl11lll['colorName'] = isset($IIIII1l1Ill1[$IIIIIIl11lll['color']]) ?$IIIII1l1Ill1[$IIIIIIl11lll['color']] : '';
$IIIIIIl11lll['formatName'] = isset($IIIII1l1Ill1[$IIIIIIl11lll['format']]) ?$IIIII1l1Ill1[$IIIIIIl11lll['format']] : '';
$IIIIIIl11lll['count'] = isset($IIIIII1111lI[$IIIIIIl11lll['pid']][$IIIIIIl11lll['id']]['count']) ?$IIIIII1111lI[$IIIIIIl11lll['pid']][$IIIIIIl11lll['id']]['count'] : 0;
if ($this->IIIIIlll1IIl['getcardtime'] >0) {
$IIIIIIl11lll['price'] = $IIIIIIl11lll['vprice'] ?$IIIIIIl11lll['vprice'] : $IIIIIIl11lll['price'];
}
$IIIII1l1IlIl[$IIIIIIl11lll['pid']]['detail'][] = $IIIIIIl11lll;
$IIIIIIIIIl11[$IIIIIIl11lll['pid']]['total'] = isset($IIIIIIIIIl11[$IIIIIIl11lll['pid']]['total']) ?intval($IIIIIIIIIl11[$IIIIIIl11lll['pid']]['total'] +$IIIIIIl11lll['count']) : $IIIIIIl11lll['count'];
$IIIIIIIIIl11[$IIIIIIl11lll['pid']]['totalPrice'] = isset($IIIIIIIIIl11[$IIIIIIl11lll['pid']]['totalPrice']) ?intval($IIIIIIIIIl11[$IIIIIIl11lll['pid']]['totalPrice'] +$IIIIIIl11lll['count'] * $IIIIIIl11lll['price']) : $IIIIIIl11lll['count'] * $IIIIIIl11lll['price'];
$IIIII1l1I1I1 += $IIIIIIIIIl11[$IIIIIIl11lll['pid']]['totalPrice'];
}
}
$IIIIIIIIlIII = array();
foreach ($IIIII1l1IlIl as $IIIIIIIIlllI =>$IIIIIIl11lll) {
if (!isset($IIIIIIIIIl11[$IIIIIIIIlllI]['total'])) {
$IIIIIIIII1ll = $IIIIIlIIIIIl = 0;
if (isset($IIIIII1111lI[$IIIIIIIIlllI]) &&is_array($IIIIII1111lI[$IIIIIIIIlllI])) {
$IIIIIIll1lIl = explode("|",$IIIIII1111lI[$IIIIIIIIlllI]['count']);
$IIIIIIIII1ll = isset($IIIIIIll1lIl[0]) ?$IIIIIIll1lIl[0] : 0;
$IIIIIlIIIIIl = isset($IIIIIIll1lIl[1]) ?$IIIIIIll1lIl[1] : 0;
}else {
$IIIIIIll1lIl = explode("|",$IIIIII1111lI[$IIIIIIIIlllI]);
$IIIIIIIII1ll = isset($IIIIIIll1lIl[0]) ?$IIIIIIll1lIl[0] : 0;
$IIIIIlIIIIIl = isset($IIIIIIll1lIl[1]) ?$IIIIIIll1lIl[1] : 0;
}
$IIIIIIIIIl11[$IIIIIIIIlllI] = array();
$IIIIIIl11lll['price'] = $IIIIIlIIIIIl ?$IIIIIlIIIIIl : $IIIIIIl11lll['price'];
$IIIIIIl11lll['count'] = $IIIIIIIIIl11[$IIIIIIIIlllI]['total'] = $IIIIIIIII1ll;
if (empty($IIIIIIIII1ll) &&empty($IIIIIlIIIIIl)) {
$IIIIIIl11lll['count'] = $IIIIIIIIIl11[$IIIIIIIIlllI]['total'] = isset($IIIIII1111lI[$IIIIIIIIlllI]['count']) ?$IIIIII1111lI[$IIIIIIIIlllI]['count'] : (isset($IIIIII1111lI[$IIIIIIIIlllI]) &&is_int($IIIIII1111lI[$IIIIIIIIlllI]) ?$IIIIII1111lI[$IIIIIIIIlllI] : 0);
if ($this->IIIIIlll1IIl['getcardtime'] >0) {
$IIIIIIl11lll['price'] = $IIIIIIl11lll['vprice'] ?$IIIIIIl11lll['vprice'] : $IIIIIIl11lll['price'];
}
}
$IIIIIIIIIl11[$IIIIIIIIlllI]['totalPrice'] = $IIIIIIIIIl11[$IIIIIIIIlllI]['total'] * $IIIIIIl11lll['price'];
$IIIII1l1I1I1 += $IIIIIIIIIl11[$IIIIIIIIlllI]['totalPrice'];
}
$IIIIIIl11lll['formatTitle'] =  isset($IIIII1l1Illl[$IIIIIIl11lll['catid']]['norms']) ?$IIIII1l1Illl[$IIIIIIl11lll['catid']]['norms'] : '';
$IIIIIIl11lll['colorTitle'] =  isset($IIIII1l1Illl[$IIIIIIl11lll['catid']]['color']) ?$IIIII1l1Illl[$IIIIIIl11lll['catid']]['color'] : '';
$IIIIIIIIlIII[] = $IIIIIIl11lll;
}
if ($IIIIIll11lII = M('Product_setting')->where(array('token'=>$this->IIIIIIIIlIlI,'cid'=>$this->IIIII1lll1II))->find()) {
if ($IIIII1l1I1I1 >= $IIIIIll11lII['price']) $IIIII1l1II11 = 0;
}
return array($IIIIIIIIlIII,$IIIIIIIIIl11,$IIIII1l1II11);
}
public function deleteCart()
{
$IIIIII11111l=array();
$IIIIII111111=array();
$IIIIII1111lI=$this->_getCart();
$IIIII1l1IIlI = isset($_GET['did']) ?intval($_GET['did']) : 0;
$IIIIIIIII1I1 = isset($_GET['id']) ?intval($_GET['id']) : 0;
if ($IIIII1l1IIlI) {
unset($IIIIII1111lI[$IIIIIIIII1I1][$IIIII1l1IIlI]);
if (empty($IIIIII1111lI[$IIIIIIIII1I1])) {
unset($IIIIII1111lI[$IIIIIIIII1I1]);
}
}else {
unset($IIIIII1111lI[$IIIIIIIII1I1]);
}
$_SESSION[$this->IIIII1llll11] = serialize($IIIIII1111lI);
$this->redirect(U('Store/cart',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id'])));
}
public function ajaxUpdateCart(){
$IIIIIIIII1ll = isset($_GET['count']) ?intval($_GET['count']) : 1;
$IIIIII1111lI = $this->_getCart();
$IIIIIIIII1I1 = intval($_GET['id']);
$IIIII1l1IIlI = isset($_GET['did']) ?intval($_GET['did']) : 0;
if (isset($IIIIII1111lI[$IIIIIIIII1I1])) {
if ($IIIII1l1IIlI) {
$IIIIII1111lI[$IIIIIIIII1I1][$IIIII1l1IIlI]['count'] = $IIIIIIIII1ll;
}else {
$IIIIII1111lI[$IIIIIIIII1I1] = $IIIIIIIII1ll;
}
}else {
if ($IIIII1l1IIlI) {
$IIIIII1111lI[$IIIIIIIII1I1][$IIIII1l1IIlI]['count'] = $IIIIIIIII1ll;
}else {
$IIIIII1111lI[$IIIIIIIII1I1] = $IIIIIIIII1ll;
}
}
$_SESSION[$this->IIIII1llll11] = serialize($IIIIII1111lI);
$IIIII1lll1ll = $this->calCartInfo();
echo $IIIII1lll1ll[0].'|'.$IIIII1lll1ll[1];
}
public function ordersave()
{
$IIIIIIl11lll = array();
$IIIIIIl11lll['orderid'] = $IIIIIl1Il1ll = substr($this->IIIIIlIIIll1,-1,4) .date("YmdHis");
$IIIIIIl11lll['truename'] = $this->_post('truename');
$IIIIIIl11lll['tel'] = $this->_post('tel');
$IIIIIIl11lll['address'] = $this->_post('address');
$IIIIIIl11lll['token'] = $this->IIIIIIIIlIlI;
$IIIIIIl11lll['wecha_id'] = $this->IIIIIlIIIll1;
$IIIIIIl11lll['time'] = $IIIIIIlIIlII = time();
$IIIIIIl11lll['paymode'] = isset($_POST['paymode']) ?intval($_POST['paymode']) : 0;
$IIIIIIl11lll['cid'] = $IIIIIIIll1ll = $this->IIIII1lll1I1 ?$this->IIIII1lll1lI['id'] : $this->IIIII1lll1II;
$IIIII1ll11ll = isset($_POST['score']) ?intval($_POST['score']) : 0;
$IIIII1l1lIII = 0;
$IIIIII1111lI = $this->_getCart();
$IIIIIIIIIlll = array();
if ($IIIIII1111lI){
$IIIII1lll1ll = $this->calCartInfo($IIIIII1111lI);
foreach ($IIIIII1111lI as $IIIIIIIIlllI =>$IIIII1l1I1Il) {
$IIIIII1II1I1 = 0;
$IIIII1IIl1lI = M('product')->where(array('id'=>$IIIIIIIIlllI))->find();
if (is_array($IIIII1l1I1Il)) {
foreach ($IIIII1l1I1Il as $IIIII1l1IIlI =>$IIIII1l1lIIl) {
$IIIIIIlllII1 = M('Product_detail')->where(array('id'=>$IIIII1l1IIlI,'pid'=>$IIIIIIIIlllI))->find();
if ($IIIIIIlllII1['num'] <$IIIII1l1lIIl['count']) {
$this->error('购买的量超过了库存');
}
$IIIIII1II1I1 += $IIIII1l1lIIl['count'];
$IIIIIlIIIIIl = $this->IIIIIlll1IIl['getcardtime'] ?($IIIIIIlllII1['vprice'] ?$IIIIIIlllII1['vprice'] : $IIIIIIlllII1['price']) : $IIIIIIlllII1['price'];
$IIIIIIIIIlll[$IIIIIIIIlllI][$IIIII1l1IIlI] = array('count'=>$IIIII1l1lIIl['count'],'price'=>$IIIIIlIIIIIl);
}
}else {
$IIIIII1II1I1 = $IIIII1l1I1Il;
$IIIIIlIIIIIl = $this->IIIIIlll1IIl['getcardtime'] ?($IIIII1IIl1lI['vprice'] ?$IIIII1IIl1lI['vprice'] : $IIIII1IIl1lI['price']) : $IIIII1IIl1lI['price'];
$IIIIIIIIIlll[$IIIIIIIIlllI] = $IIIII1l1I1Il ."|".$IIIIIlIIIIIl;
}
if ($IIIII1IIl1lI['num'] <$IIIIII1II1I1) {
$this->error('购买的量超过了库存');
}
}
$IIIII1l1lII1 = M('Product_setting')->where(array('token'=>$this->IIIIIIIIlIlI,'cid'=>$IIIIIIIll1ll))->find();
$IIIII1l1I1I1 = $IIIII1lll1ll[1] +$IIIII1lll1ll[2];
if ($IIIII1ll11ll &&$IIIII1l1lII1 &&$IIIII1l1lII1['score'] >0 &&$this->IIIIIlll1IIl['total_score'] >= $IIIII1ll11ll) {
$IIIII1l1I1I1 -= $IIIII1ll11ll / $IIIII1l1lII1['score'];
if ($IIIII1l1I1I1 <0) {
$IIIII1ll11ll = ($IIIII1lll1ll[1] +$IIIII1lll1ll[2]) * $IIIII1l1lII1['score'];
$IIIII1l1I1I1 = 0;
$IIIIIIl11lll['paid'] = 1;
}
}
$IIIIIIl11lll['total'] = $IIIII1lll1ll[0];
$IIIIIIl11lll['price'] = $IIIII1l1I1I1;
$IIIIIIl11lll['diningtype'] = 0;
$IIIIIIl11lll['buytime'] = '';
$IIIIIIl11lll['tableid'] = 0;
$IIIIIIl11lll['info'] = serialize($IIIIIIIIIlll);
$IIIIIIl11lll['groupon']=0;
$IIIIIIl11lll['dining'] = 0;
$IIIIIIl11lll['score'] = $IIIII1ll11ll;
$IIIIIlIIIIlI = M('product_cart');
$IIIII1l1lIII = $IIIIIlIIIIlI->add($IIIIIIl11lll);
if ($IIIII1l1lIII) {
$IIIIIIIIIlll=M('deliemail')->where(array('token'=>$this->_get('token')))->find();
$IIIIIl1l11I1->IIIIIl1I111l    = 'UTF-8';
$IIIII1lI111l=$IIIIIIIIIlll['shangcheng'];
$IIIII1lI1111=$IIIIIIIIIlll['receive'];
$IIIIIIIl1II1 = $this->sms1();
if($IIIIIIIIIlll['type'] == 1){
$IIIII1llIIII=$IIIIIIIIIlll['smtpserver'];
$IIIII1llIIIl=$IIIIIIIIIlll['port'];
$IIIII1llIII1=$IIIIIIIIIlll['name'];
$IIIII1llIIlI=$IIIIIIIIIlll['password'];
}else{
$IIIII1llIIII=C('email_server');
$IIIII1llIIIl=C('email_port');
$IIIII1llIII1=C('email_user');
$IIIII1llIIlI=C('email_pwd');
}
$IIIII1llIIll=explode('@',$IIIII1llIII1);
$IIIII1llIIll=$IIIII1llIIll[0];
if ($IIIII1lI111l == 1) {
if ($IIIIIIIl1II1) {
date_default_timezone_set('PRC');
require("class.phpmailer.php");
$IIIIIl1l11I1 = new PHPMailer();
$IIIIIl1l11I1->IsSMTP();
$IIIIIl1l11I1->IIIIIl1lIl1I = "$IIIII1llIIII";
$IIIIIl1l11I1->IIIIIl1lI1Il = true;
$IIIIIl1l11I1->IIIIIl1lI1I1 = "$IIIII1llIIll";
$IIIIIl1l11I1->IIIIIl1lI1lI = "$IIIII1llIIlI";
$IIIIIl1l11I1->IIIIIl1lIII1 = $IIIII1llIII1;
$IIIIIl1l11I1->IIIIIl1lIIlI = C('site_name');
$IIIIIl1l11I1->AddAddress("$IIIII1lI1111","商户");
$IIIIIl1l11I1->AddReplyTo($IIIII1llIII1,"Information");
$IIIIIl1l11I1->IIIIIl1lII11 = 50;
$IIIIIl1l11I1->IsHTML(false);
$IIIIIl1l11I1->IIIIIl1lIIl1 = '有新的商城订单';
$IIIIIl1l11I1->IIIIIl1lII1I    = $IIIIIIIl1II1;
$IIIIIl1l11I1->IIIIIl1lII1l = "";
if(!$IIIIIl1l11I1->Send())
{
echo "Message could not be sent. <p>";
echo "Mailer Error: ".$IIIIIl1l11I1->IIIIIl1lIIIl;
exit;
}
}
}
$IIIII1l1lIlI = $this->getCat($IIIIII1111lI);
$IIIIIIIIlIII = array();
foreach ($IIIII1l1lIlI[0] as $IIIII1I1l1ll) {
$IIIIII1II11l = array();
if (!empty($IIIII1I1l1ll['detail'])) {
foreach ($IIIII1I1l1ll['detail'] as $IIIIIIlIllII) {
$IIIIII1II11l = array('num'=>$IIIIIIlIllII['count'],'colorName'=>$IIIIIIlIllII['colorName'],'formatName'=>$IIIIIIlIllII['formatName'],'price'=>$IIIIIIlIllII['price'],'name'=>$IIIII1I1l1ll['name']);
$IIIIIIIIlIII[] = $IIIIII1II11l;
}
}else {
$IIIIII1II11l = array('num'=>$IIIII1I1l1ll['count'],'price'=>$IIIII1I1l1ll['price'],'name'=>$IIIII1I1l1ll['name']);
$IIIIIIIIlIII[] = $IIIIII1II11l;
}
}
$IIIIIII11l1l = D('Company')->where(array('token'=>$this->IIIIIIIIlIlI,'id'=>$IIIIIIIll1ll))->find();
$IIIIII11lI1I = new orderPrint();
$IIIIIlIl1Ill = array('companyname'=>$IIIIIII11l1l['name'],'companytel'=>$IIIIIII11l1l['tel'],'truename'=>$IIIIIIl11lll['truename'],'tel'=>$IIIIIIl11lll['tel'],'address'=>$IIIIIIl11lll['address'],'buytime'=>$IIIIIIl11lll['time'],'orderid'=>$IIIIIIl11lll['orderid'],'sendtime'=>'','price'=>$IIIIIIl11lll['price'],'total'=>$IIIIIIl11lll['total'],'list'=>$IIIIIIIIlIII);
$IIIIIlIl1Ill = ArrayToStr::array_to_str($IIIIIlIl1Ill);
$IIIIII11lI1I->printit($this->IIIIIIIIlIlI,$this->IIIII1lll1II,'Store',$IIIIIlIl1Ill,0);
$IIIII1l1lIll = D('Userinfo')->where(array('token'=>$this->IIIIIIIIlIlI,'wecha_id'=>$this->IIIIIlIIIll1))->find();
Sms::sendSms($this->IIIIIIIIlIlI,"您的顾客{$IIIII1l1lIll['truename']}刚刚下了一个订单，订单号：{$IIIIIl1Il1ll}，请您注意查看并处理");
}
}
if ($IIIII1l1lIII){
$IIIIII11l11l = M('product');
$IIIIIlIIIIll = M('product_cart_list');
$IIIII1l1lIl1 = array();
$IIIII1l1lIlI = $this->getCat($IIIIII1111lI);
foreach ($IIIIII1111lI as $IIIIIIIllIll =>$IIIIIII11IIl){
$IIIII1l1lIl1['cartid'] = $IIIII1l1lIII;
$IIIII1l1lIl1['productid'] = $IIIIIIIllIll;
$IIIII1l1lIl1['price'] = $IIIII1l1lIlI[1][$IIIIIIIllIll]['totalPrice'];
$IIIII1l1lIl1['total'] = $IIIII1l1lIlI[1][$IIIIIIIllIll]['total'];
$IIIII1l1lIl1['wecha_id'] = $IIIIIIl11lll['wecha_id'];
$IIIII1l1lIl1['token'] = $IIIIIIl11lll['token'];
$IIIII1l1lIl1['cid'] = $IIIIIIl11lll['cid'];
$IIIII1l1lIl1['time'] = $IIIIIIlIIlII;
$IIIIIlIIIIll->add($IIIII1l1lIl1);
$IIIIII11l11l->where(array('id'=>$IIIIIIIllIll))->setInc('salecount',$IIIII1l1lIlI[1][$IIIIIIIllIll]['total']);
}
foreach ($IIIIII1111lI as $IIIIIIIIlllI =>$IIIII1l1I1Il) {
$IIIIII1II1I1 = 0;
if (is_array($IIIII1l1I1Il)) {
foreach ($IIIII1l1I1Il as $IIIII1l1IIlI =>$IIIII1l1lIIl) {
M('Product_detail')->where(array('id'=>$IIIII1l1IIlI,'pid'=>$IIIIIIIIlllI))->setDec('num',$IIIII1l1lIIl['count']);
$IIIIII1II1I1 += $IIIII1l1lIIl['count'];
}
}else {
$IIIIII1II1I1 = $IIIII1l1I1Il;
}
$IIIIII11l11l->where(array('id'=>$IIIIIIIIlllI))->setDec('num',$IIIIII1II1I1);
}
$_SESSION[$this->IIIII1llll11] = null;
unset($_SESSION[$this->IIIII1llll11]);
if ($_POST['saveinfo']){
$IIIII1l1lI1I = M('Userinfo');
$IIIIIllII1I1 = $IIIII1l1lI1I->where(array('token'=>$this->IIIIIIIIlIlI,'wecha_id'=>$this->IIIIIlIIIll1))->find();
$this->assign('thisUser',$IIIIIllII1I1);
$IIIII1l1lI1l=array('tel'=>$IIIIIIl11lll['tel'],'truename'=>$IIIIIIl11lll['truename'],'address'=>$IIIIIIl11lll['address']);
if ($IIIIIllII1I1) {
$IIIII1l1lI1I->where(array('id'=>$IIIIIllII1I1['id']))->save($IIIII1l1lI1l);
$IIIII1l1lI1I->where(array('id'=>$IIIIIllII1I1['id'],'total_score'=>array('egt',$IIIII1ll11ll)))->setDec('total_score',$IIIII1ll11ll);
F('fans_token_wechaid',NULL);
}else {
$IIIII1l1lI1l['token']=$this->IIIIIIIIlIlI;
$IIIII1l1lI1l['wecha_id']=$this->IIIIIlIIIll1;
$IIIII1l1lI1l['wechaname']='';
$IIIII1l1lI1l['qq']=0;
$IIIII1l1lI1l['sex']=-1;
$IIIII1l1lI1l['age']=0;
$IIIII1l1lI1l['birthday']='';
$IIIII1l1lI1l['info']='';
$IIIII1l1lI1l['total_score']=0;
$IIIII1l1lI1l['sign_score']=0;
$IIIII1l1lI1l['expend_score']=0;
$IIIII1l1lI1l['continuous']=0;
$IIIII1l1lI1l['add_expend']=0;
$IIIII1l1lI1l['add_expend_time']=0;
$IIIII1l1lI1l['live_time']=0;
$IIIII1l1lI1I->add($IIIII1l1lI1l);
}
}
$IIIIIl1Ill11 = M('Alipay_config')->where(array('token'=>$this->IIIIIIIIlIlI))->find();
if ($IIIII1l1I1I1) {
if ($IIIIIl1Ill11['open'] &&$IIIII1l1I1I1 &&$IIIIIIl11lll['paymode'] == 1) {
$this->success('正在提交中...',U('Alipay/pay',array('token'=>$this->IIIIIIIIlIlI,'wecha_id'=>$this->IIIIIlIIIll1,'success'=>1,'from'=>'Store','orderName'=>$IIIIIl1Il1ll,'single_orderid'=>$IIIIIl1Il1ll,'price'=>$IIIII1l1I1I1)));
die;
}elseif ($this->IIIIIlll1IIl['balance'] >0 &&$IIIIIIl11lll['paymode'] == 4) {
$this->success('正在提交中...',U('CardPay/pay',array('token'=>$this->IIIIIIIIlIlI,'wecha_id'=>$this->IIIIIlIIIll1,'success'=>1,'from'=>'Store','orderName'=>$IIIIIl1Il1ll,'single_orderid'=>$IIIIIl1Il1ll,'price'=>$IIIII1l1I1I1)));
die;
}
}
$IIIIIlIllI1l = new templateNews();
$IIIIIlIllI1l->sendTempMsg('TM00820',array('href'=>U('Store/my',array('token'=>$this->IIIIIIIIlIlI,'wecha_id'=>$this->IIIIIlIIIll1)),'wecha_id'=>$this->IIIIIlIIIll1,'first'=>'购买商品提醒','keynote1'=>'订单未支付','keynote2'=>date("Y年m月d日H时i分s秒"),'remark'=>'购买成功，感谢您的光临，欢迎下次再次光临！'));
$this->success('预定成功,进入您的订单页',U('Store/my',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id'],'success'=>1)));
}else {
$this->error('订单生产失败');
}
}
public function sms1(){
$IIIIIIIIlIl1['token']=$this->IIIIIIIIlIlI;
$IIIIIIIIlIl1['wecha_id']=$this->IIIIIlIIIll1;
$IIIIIIIIlIl1['printed']=0;
$this->IIIIIlIIIIlI=M('product_cart');
$IIIIIIIII1ll      = $this->IIIIIlIIIIlI->where($IIIIIIIIlIl1)->count();
$IIIIIlIIII1l=$this->IIIIIlIIIIlI->where($IIIIIIIIlIl1)->order('time DESC')->limit(0,1)->select();
$IIIIIII111II=time();
if ($IIIIIlIIII1l){
$IIIIII1111II=$IIIIIlIIII1l[0];
switch ($IIIIII1111II['diningtype']){
case 0:
$IIIII1l1llII='购物';
break;
case 1:
$IIIII1l1llII='点餐';
break;
case 2:
$IIIII1l1llII='外卖';
break;
case 3:
$IIIII1l1llII='预定餐桌';
break;
}
$IIIIII1111Il=M('product_diningtable');
if ($IIIIII1111II['tableid']) {
$IIIIII1111I1=$IIIIII1111Il->where(array('id'=>$IIIIII1111II['tableid']))->find();
$IIIIII1111II['tableName']=$IIIIII1111I1['name'];
}else{
$IIIIII1111II['tableName']='未指定';
}
$IIIIIII1IlII="订单类型：".$IIIII1l1llII."\r\n订单编号：".$IIIIII1111II['orderid']."\r\n姓名：".$IIIIII1111II['truename']."\r\n电话：".$IIIIII1111II['tel']."\r\n地址：".$IIIIII1111II['address']."\r\n下单时间：".date('Y-m-d H:i:s',$IIIIII1111II['time'])."\r\n";
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
$IIIIII11111l=$this->IIIIII11l11l->where(array('id'=>array('in',$IIIIII111111)))->select();
}
if ($IIIIII11111l){
$IIIIIIIllI11=0;
foreach ($IIIIII11111l as $IIIIII1IllIl){
$IIIIII11111l[$IIIIIIIllI11]['count']=$IIIIII1111lI[$IIIIII1IllIl['id']]['count'];
$IIIIIII1IlII.=$IIIIII1IllIl['name']."  ".$IIIIII11111l[$IIIIIIIllI11]['count']."份  单价：".$IIIIII1IllIl['price']."元\r\n";
$IIIIIIIllI11++;
}
}
$IIIIIII1IlII.="合计：".$IIIIII1111II['price']."元";
return $IIIIIII1IlII;
}else {
return '';
}
}
public function orderCart()
{
if (empty($this->IIIIIlIIIll1)) {
unset($_SESSION[$this->IIIII1llll11]);
}
$IIIIIIIll1ll = $this->IIIII1lll1I1 ?$this->IIIII1lll1lI['id'] : $this->IIIII1lll1II;
$IIIII1l1lII1 = M('Product_setting')->where(array('token'=>$this->IIIIIIIIlIlI,'cid'=>$IIIIIIIll1ll))->find();
$this->assign('setting',$IIIII1l1lII1);
$IIIIIl1Ill11 = M('Alipay_config')->where(array('token'=>$this->IIIIIIIIlIlI))->find();
$this->assign('alipayConfig',$IIIIIl1Ill11);
$IIIIII11111I = $IIIIII1111l1 = 0;
$IIIIIIIIIl11 = $this->getCat($this->_getCart());
if (empty($IIIIIIIIIl11[0])) {
$this->redirect(U('Store/cart',array('token'=>$this->IIIIIIIIlIlI,'wecha_id'=>$this->IIIIIlIIIll1)));
}
if (isset($IIIIIIIIIl11[1])) {
foreach ($IIIIIIIIIl11[1] as $IIIIIIIIlllI =>$IIIIIIl11lll) {
$IIIIII11111I += $IIIIIIl11lll['total'];
$IIIIII1111l1 += $IIIIIIl11lll['totalPrice'];
}
}
if (empty($IIIIII11111I)) {
$this->error('没有购买商品!',U('Store/cart',array('token'=>$this->IIIIIIIIlIlI,'wecha_id'=>$this->IIIIIlIIIll1)));
}
$IIIIIIIIlIII = $IIIIIIIIIl11[0];
$this->assign('products',$IIIIIIIIlIII);
$this->assign('totalFee',$IIIIII1111l1);
$this->assign('totalCount',$IIIIII11111I);
$this->assign('mailprice',$IIIIIIIIIl11[2]);
$this->assign('metaTitle','购物车结算');
$this->display();
}
public function my()
{
$IIIIII11Il1l = 5;
$IIIIIIIII11I = isset($_GET['page']) ?max(intval($_GET['page']),1) : 1;
$IIIII1ll1I1I = ($IIIIIIIII11I -1) * $IIIIII11Il1l;
$IIIIIlIIIIlI = M('product_cart');
$IIIIIlIIII1l = $IIIIIlIIIIlI->where(array('token'=>$this->IIIIIIIIlIlI,'wecha_id'=>$this->IIIIIlIIIll1,'groupon'=>0,'dining'=>0))->limit($IIIII1ll1I1I,$IIIIII11Il1l)->order('time DESC')->select();
$IIIIIIIII1ll = $IIIIIlIIIIlI->where(array('token'=>$this->IIIIIIIIlIlI,'wecha_id'=>$this->IIIIIlIIIll1,'groupon'=>0,'dining'=>0))->count();
$IIIIIIIIlIII = array();
if ($IIIIIlIIII1l){
foreach ($IIIIIlIIII1l as $IIIIIllI11l1){
$IIIIII11111l = unserialize($IIIIIllI11l1['info']);
$IIIII1l1IlII = array_keys($IIIIII11111l);
$IIIIIllI11l1['productInfo'] = array();
if ($IIIII1l1IlII) {
$IIIIIllI11l1['productInfo'] = M('product')->where(array('id'=>array('in',$IIIII1l1IlII)))->select();
}
$IIIIIIIIlIII[] = $IIIIIllI11l1;
}
}
$IIIII1l1llI1 = ceil($IIIIIIIII1ll / $IIIIII11Il1l);
$this->assign('orders',$IIIIIIIIlIII);
$this->assign('ordersCount',$IIIIIIIII1ll);
$this->assign('totalpage',$IIIII1l1llI1);
$this->assign('page',$IIIIIIIII11I);
$this->assign('metaTitle','我的订单');
$IIIIIl1Ill11 = M('Alipay_config')->where(array('token'=>$this->IIIIIIIIlIlI))->find();
$this->assign('alipayConfig',$IIIIIl1Ill11);
$this->display();
}
public function myDetail()
{
$IIIII1l1llll = isset($_GET['cartid']) &&intval($_GET['cartid'])?intval($_GET['cartid']) : 0;
$IIIIIlIIIIlI = M('product_cart');
$IIIIIIIIlIII = array();
if ($IIIII1l1lll1 = $IIIIIlIIIIlI->where(array('token'=>$this->IIIIIIIIlIlI,'wecha_id'=>$this->IIIIIlIIIll1,'id'=>$IIIII1l1llll))->find()){
$IIIIII11111l = unserialize($IIIII1l1lll1['info']);
$IIIIIIIIIl11 = $this->getCat($IIIIII11111l);
$IIIII1l1IlII = array_keys($IIIIII11111l);
$IIIII1l1lll1['productInfo'] = array();
if ($IIIII1l1IlII) {
$IIIII1l1lll1['productInfo'] = M('product')->where(array('id'=>array('in',$IIIII1l1IlII)))->select();
}
$IIIIII11111I = $IIIIII1111l1 = 0;
if (isset($IIIIIIIIIl11[1])) {
foreach ($IIIIIIIIIl11[1] as $IIIIIIIIlllI =>$IIIIIIl11lll) {
$IIIIII11111I += $IIIIIIl11lll['total'];
$IIIIII1111l1 += $IIIIIIl11lll['totalPrice'];
}
}
$IIIIIIIIlIII = $IIIIIIIIIl11[0];
$IIIII1l1ll1I = array();
$IIIII1ll11l1 = M("Product_comment")->where(array('token'=>$this->IIIIIIIIlIlI,'cartid'=>$IIIII1l1llll,'wecha_id'=>$this->IIIIIlIIIll1))->select();
foreach ($IIIII1ll11l1 as $IIIIIIl11lll) {
$IIIII1l1ll1I[$IIIIIIl11lll['pid']][$IIIIIIl11lll['detailid']] = $IIIIIIl11lll;
}
$IIIIIl1Ill11 = M('Alipay_config')->where(array('token'=>$this->IIIIIIIIlIlI))->find();
foreach ($IIIIIIIIlIII as &$IIIIIIl11lll) {
if ($IIIIIIl11lll['detail']) {
foreach ($IIIIIIl11lll['detail'] as &$IIIIII1ll11I) {
if (isset($IIIII1l1ll1I[$IIIIIIl11lll['id']][$IIIIII1ll11I['id']])) {
$IIIIII1ll11I['comment'] = 0;
}else {
$IIIIII1ll11I['comment'] = $IIIIIl1Ill11['open'] ?($IIIII1l1lll1['paid'] ?1 : 0) : 1;
}
}
}else {
if (isset($IIIII1l1ll1I[$IIIIIIl11lll['id']][0])) {
$IIIIIIl11lll['comment'] = 0;
}else {
$IIIIIIl11lll['comment'] = $IIIII1l1lll1['paid'] ?1 : 0;
}
}
}
$this->assign('commentList',$IIIII1l1ll1I);
$this->assign('products',$IIIIIIIIlIII);
$this->assign('totalFee',$IIIIII1111l1);
$this->assign('totalCount',$IIIIII11111I);
$this->assign('mailprice',$IIIIIIIIIl11[2]);
$this->assign('cartData',$IIIII1l1lll1);
$this->assign('cartid',$IIIII1l1llll);
}
$this->assign('metaTitle','我的订单');
$this->display();
}
public function cancelCart()
{
$IIIII1l1llll = isset($_GET['cartid']) &&intval($_GET['cartid'])?intval($_GET['cartid']) : 0;
$IIIIII11l11l=M('product');
$IIIIIlIIIIlI = M('product_cart');
$IIIIIlIIIIll = M('product_cart_list');
$IIIIII1111II = $IIIIIlIIIIlI->where(array('id'=>$IIIII1l1llll))->find();
if (empty($IIIIII1111II)) {
exit(json_encode(array('error_code'=>true,'msg'=>'没有此订单')));
}
$IIIIIIIII1I1 = $IIIIII1111II['id'];
if (empty($IIIIII1111II['paid'])) {
$IIIIIlIIIIlI->where(array('id'=>$IIIII1l1llll))->delete();
$IIIIIlIIIIll->where(array('cartid'=>$IIIII1l1llll))->delete();
$IIIII1l1lI1I = M('Userinfo');
$IIIIIllII1I1 = $IIIII1l1lI1I->where(array('token'=>$this->IIIIIIIIlIlI,'wecha_id'=>$this->IIIIIlIIIll1))->find();
$IIIII1l1lI1I->where(array('id'=>$IIIIIllII1I1['id']))->setInc('total_score',$IIIIII1111II['score']);
F('fans_token_wechaid',NULL);
$IIIIII1111lI = unserialize($IIIIII1111II['info']);
foreach ($IIIIII1111lI as $IIIIIIIIlllI =>$IIIII1l1I1Il) {
$IIIIII1II1I1 = 0;
if (is_array($IIIII1l1I1Il)) {
foreach ($IIIII1l1I1Il as $IIIII1l1IIlI =>$IIIIIIl11lll) {
M('product_detail')->where(array('id'=>$IIIII1l1IIlI,'pid'=>$IIIIIIIIlllI))->setInc('num',$IIIIIIl11lll['count']);
$IIIIII1II1I1 += $IIIIIIl11lll['count'];
}
}else {
$IIIIII1II1I1 = $IIIII1l1I1Il;
}
$IIIIII11l11l->where(array('id'=>$IIIIIIIIlllI))->setInc('num',$IIIIII1II1I1);
$IIIIII11l11l->where(array('id'=>$IIIIIIIIlllI))->setDec('salecount',$IIIIII1II1I1);
}
exit(json_encode(array('error_code'=>false,'msg'=>'订单取消成功')));
}
exit(json_encode(array('error_code'=>true,'msg'=>'购买成功的订单不能取消')));
}
public function updateOrder(){
$IIIIIlIIIIlI = M('product_cart');
$IIIIII1111II = $IIIIIlIIIIlI->where(array('id'=>intval($_GET['id'])))->find();
if ($IIIIII1111II['wecha_id']!=$this->IIIIIlIIIll1){
exit();
}
$this->assign('thisOrder',$IIIIII1111II);
$IIIIII1111lI = unserialize($IIIIII1111II['info']);
$IIIIII11111I = $IIIIII1111l1 = 0;
$IIIII1I1l11I = array();
$IIIIIIIIIl11 = $this->getCat($IIIIII1111lI);
if (isset($IIIIIIIIIl11[1])) {
foreach ($IIIIIIIIIl11[1] as $IIIIIIIIlllI =>$IIIIIIl11lll) {
$IIIIII11111I += $IIIIIIl11lll['total'];
$IIIIII1111l1 += $IIIIIIl11lll['totalPrice'];
$IIIII1I1l11I[$IIIIIIIIlllI] = $IIIIIIl11lll['total'];
}
}
$IIIIIIIIlIII = $IIIIIIIIIl11[0];
$this->assign('products',$IIIIIIIIlIII);
$this->assign('totalFee',$IIIIII1111l1);
$this->assign('listNum',$IIIII1I1l11I);
$this->assign('metaTitle','修改订单');
$IIIIIl1Ill11 = M('Alipay_config')->where(array('token'=>$this->IIIIIIIIlIlI))->find();
$this->assign('alipayConfig',$IIIIIl1Ill11);
$this->display();
}
public function comment()
{
$IIIII1l1llll = isset($_GET['cartid']) &&intval($_GET['cartid'])?intval($_GET['cartid']) : 0;
$IIIIIIIIlllI = isset($_GET['pid']) ?intval($_GET['pid']) : 0;
$IIIII1l1l1Il = isset($_GET['detailid']) ?intval($_GET['detailid']) : 0;
$IIIIIl1Ill11 = M('Alipay_config')->where(array('token'=>$this->IIIIIIIIlIlI))->find();
if ($IIIII1l1lll1 = M("product_cart")->where(array('token'=>$this->IIIIIIIIlIlI,'wecha_id'=>$this->IIIIIlIIIll1,'id'=>$IIIII1l1llll))->find()){
if ($IIIII1l1lll1['paid'] == 0 &&$IIIIIl1Ill11['open']) {
$this->error("您暂时还不能评论该商品");
}
}else {
$this->error("您还没有购买此商品，暂时无法对其评论");
}
$this->assign('cartid',$IIIII1l1llll);
$this->assign('detailid',$IIIII1l1l1Il);
$this->assign('pid',$IIIIIIIIlllI);
$this->display();
}
public function commentSave()
{
$IIIII1l1llll = isset($_POST['cartid']) &&intval($_POST['cartid'])?intval($_POST['cartid']) : 0;
$IIIIIIIIlllI = isset($_POST['pid']) ?intval($_POST['pid']) : 0;
$IIIII1l1l1Il = isset($_POST['detailid']) ?intval($_POST['detailid']) : 0;
$IIIIIl1Ill11 = M('Alipay_config')->where(array('token'=>$this->IIIIIIIIlIlI))->find();
if ($IIIII1l1lll1 = M("product_cart")->where(array('token'=>$this->IIIIIIIIlIlI,'wecha_id'=>$this->IIIIIlIIIll1,'id'=>$IIIII1l1llll))->find()){
if ($IIIII1l1lll1['paid'] == 0 &&$IIIIIl1Ill11['open']) {
$this->error("您暂时还不能评论该商品");
}
$IIIIIIIIIl11 = array();
if ($IIIII1ll1I11 = M("Product")->where(array('id'=>$IIIIIIIIlllI,'token'=>$this->IIIIIIIIlIlI))->find()) {
if ($IIIII1l1l1Il) {
$IIIIII11111l = unserialize($IIIII1l1lll1['info']);
$IIIIIlIII11I = $this->getCat($IIIIII11111l);
foreach ($IIIIIlIII11I[0] as $IIIIIIl11lll) {
foreach ($IIIIIIl11lll['detail'] as $IIIIIlllI111) {
if ($IIIIIlllI111['id'] == $IIIII1l1l1Il) {
$IIIIIII1IlII = $IIIIIIl11lll['colorTitle'] &&$IIIIIlllI111['colorName'] ?$IIIIIIl11lll['colorTitle'] .":".$IIIIIlllI111['colorName'] : '';
$IIIIIII1IlII .= $IIIIIIl11lll['formatTitle'] &&$IIIIIlllI111['formatName'] ?", ".$IIIIIIl11lll['formatTitle'] .":".$IIIIIlllI111['formatName'] : '';
$IIIIIIIIIl11['productinfo'] = $IIIIIII1IlII;
}
}
}
}
}else {
$this->error("此产品可能下架了，暂时无法对其评论");
}
}else {
$this->error("您还没有购买此商品，暂时无法对其评论");
}
$IIIII1ll11l1 = D("Product_comment");
$IIIIIIIIIl11['cartid'] = $IIIII1l1llll;
$IIIIIIIIIl11['pid'] = $IIIIIIIIlllI;
$IIIIIIIIIl11['detailid'] = $IIIII1l1l1Il;
$IIIIIIIIIl11['score'] = $_POST['score'];
$IIIIIIIIIl11['content'] = htmlspecialchars($_POST['content']);
$IIIIIIIIIl11['token'] = $this->IIIIIIIIlIlI;
$IIIIIIIIIl11['wecha_id'] = $this->IIIIIlIIIll1;
$IIIIIIIIIl11['truename'] = $IIIII1l1lll1['truename'];
$IIIIIIIIIl11['tel'] = $IIIII1l1lll1['tel'];
$IIIIIIIIIl11['__hash__'] = $_POST['__hash__'];
$IIIIIIIIIl11['dateline'] = time();
if (false !== $IIIII1ll11l1->create($IIIIIIIIIl11)) {
unset($IIIIIIIIIl11['__hash__']);
$IIIII1ll11l1->add($IIIIIIIIIl11);
$this->success("评论成功",U('Store/myDetail',array('token'=>$this->IIIIIIIIlIlI,'wecha_id'=>$this->IIIIIlIIIll1,'cartid'=>$IIIII1l1llll)));
}else {
$this->error($IIIII1ll11l1->IIIIII1l1IlI,U('Store/myDetail',array('token'=>$this->IIIIIIIIlIlI,'wecha_id'=>$this->IIIIIlIIIll1,'cartid'=>$IIIII1l1llll)));
}
}
public function deleteOrder(){
$IIIIII11l11l=M('product');
$IIIIIlIIIIlI=M('product_cart');
$IIIIIlIIIIll=M('product_cart_list');
$IIIIII1111II=$IIIIIlIIIIlI->where(array('id'=>intval($_GET['id'])))->find();
$IIIIIIIII1I1=$IIIIII1111II['id'];
if ($IIIIII1111II['wecha_id']!=$this->IIIIIlIIIll1||$IIIIII1111II['handled']==1){
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
$this->redirect(U('Store/my',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id'])));
}
public function payReturn() {
$IIIIIl1Il1ll = $_GET['orderid'];
if ($IIIIIIIIl1Il = M('Product_cart')->where(array('orderid'=>$IIIIIl1Il1ll,'token'=>$this->IIIIIIIIlIlI))->find()) {
if ($IIIIIIIIl1Il['paid']) {
$IIIIII1111lI = unserialize($IIIIIIIIl1Il['info']);
$IIIII1l1lIlI = $this->getCat($IIIIII1111lI);
$IIIIIIIIlIII = array();
foreach ($IIIII1l1lIlI[0] as $IIIII1I1l1ll) {
$IIIIII1II11l = array();
if (!empty($IIIII1I1l1ll['detail'])) {
foreach ($IIIII1I1l1ll['detail'] as $IIIIIIlIllII) {
$IIIIII1II11l = array('num'=>$IIIIIIlIllII['count'],'colorName'=>$IIIIIIlIllII['colorName'],'formatName'=>$IIIIIIlIllII['formatName'],'price'=>$IIIIIIlIllII['price'],'name'=>$IIIII1I1l1ll['name']);
$IIIIIIIIlIII[] = $IIIIII1II11l;
}
}else {
$IIIIII1II11l = array('num'=>$IIIII1I1l1ll['count'],'price'=>$IIIII1I1l1ll['price'],'name'=>$IIIII1I1l1ll['name']);
$IIIIIIIIlIII[] = $IIIIII1II11l;
}
}
$IIIIIII11l1l = D('Company')->where(array('token'=>$this->IIIIIIIIlIlI,'id'=>$IIIIIIIIl1Il['cid']))->find();
$IIIIII11lI1I = new orderPrint();
$IIIIIlIl1Ill = array('companyname'=>$IIIIIII11l1l['name'],'companytel'=>$IIIIIII11l1l['tel'],'truename'=>$IIIIIIIIl1Il['truename'],'tel'=>$IIIIIIIIl1Il['tel'],'address'=>$IIIIIIIIl1Il['address'],'buytime'=>$IIIIIIIIl1Il['time'],'orderid'=>$IIIIIIIIl1Il['orderid'],'sendtime'=>'','price'=>$IIIIIIIIl1Il['price'],'total'=>$IIIIIIIIl1Il['total'],'list'=>$IIIIIIIIlIII);
$IIIIIlIl1Ill = ArrayToStr::array_to_str($IIIIIlIl1Ill,1);
$IIIIII11lI1I->printit($this->IIIIIIIIlIlI,$this->IIIII1lll1II,'Store',$IIIIIlIl1Ill,1);
$IIIII1l1lIll = D('Userinfo')->where(array('token'=>$this->IIIIIIIIlIlI,'wecha_id'=>$this->IIIIIlIIIll1))->find();
Sms::sendSms($this->IIIIIIIIlIlI,"您的顾客{$IIIII1l1lIll['truename']}刚刚对订单号：{$IIIIIl1Il1ll}的订单进行了支付，请您注意查看并处理");
$IIIIIlIllI1l = new templateNews();
$IIIIIlIllI1l->sendTempMsg('TM00820',array('href'=>U('Store/my',array('token'=>$this->IIIIIIIIlIlI,'wecha_id'=>$this->IIIIIlIIIll1)),'wecha_id'=>$this->IIIIIlIIIll1,'first'=>'购买商品提醒','keynote1'=>'订单已支付','keynote2'=>date("Y年m月d日H时i分s秒"),'remark'=>'购买成功，感谢您的光临，欢迎下次再次光临！'));
}
$this->redirect(U('Store/my',array('token'=>$this->IIIIIIIIlIlI,'wecha_id'=>$this->IIIIIlIIIll1)));
}else{
exit('订单不存在');
}
}
}
?>