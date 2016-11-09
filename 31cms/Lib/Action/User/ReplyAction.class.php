<?php

class ReplyAction extends UserAction{
public $IIIIIIIIlIlI;
public $IIIIIlIIIlll;
public $IIIIIlIIIll1;
public $IIIIIlIIIl1I;
public function _initialize(){
parent::_initialize();
$IIIIIIlll1lI=M('Function')->where(array('funname'=>'message'))->find();
if (intval($this->IIIIIIIIII1I['gid'])<intval($IIIIIIlll1lI['gid'])){
$this->error('您的VIP权限不够,请到升级会员VIP',U('Alipay/vip',array('token'=>$this->IIIIIIIIlIlI)));
}
$this->IIIIIlIIIll1	= $this->_get('wecha_id');
$this->IIIIIlIIlI11=M('reply_info');
$IIIIIlIIIl1l = $this->IIIIIlIIlI11->where(array('infotype'=>'message','token'=>$this->IIIIIIIIlIlI))->find();
$IIIIIlIIIl11=unserialize($IIIIIlIIIl1l['config']);
$this->IIIIIlIIIlll=intval($IIIIIlIIIl11['needcheck']);
$this->IIIIIlIIIl1I=1;
$this->assign("wecha_id",$this->IIIIIlIIIll1);
$this->assign('token',$this->IIIIIIIIlIlI);
$this->assign('needCheck',$this->IIIIIlIIIlll);
}
public function config(){
$IIIIIlIII1II = 'message';
$IIIIIIl11llI = $this->IIIIIlIIlI11->where(array('infotype'=>$IIIIIlIII1II,'token'=>$this->IIIIIIIIlIlI))->find();
if ($IIIIIIl11llI&&$IIIIIIl11llI['token']!=$this->IIIIIIIIlIlI){
exit();
}
if(IS_POST){
$IIIIIIl11lll['title']=$this->_post('title');
$IIIIIIl11lll['info']=$this->_post('info');
$IIIIIIl11lll['picurl']=$this->_post('picurl');
$IIIIIIl11lll['token']=$this->IIIIIIIIlIlI;
$IIIIIIl11lll['infotype']=$IIIIIlIII1II;
$IIIIIIl11lll['config']=serialize(array('needcheck'=>intval($_POST['needcheck'])));
if ($IIIIIIl11llI){
$IIIIIIIIlIl1=array('infotype'=>$IIIIIIl11llI['infotype'],'token'=>$this->IIIIIIIIlIlI);
$this->IIIIIlIIlI11->where($IIIIIIIIlIl1)->save($IIIIIIl11lll);
$this->success('修改成功',U('Reply/config'));
}else {
$this->IIIIIlIIlI11->add($IIIIIIl11lll);
$this->success('添加成功',U('Reply/config'));
}
}else{
$IIIIII1l11ll=unserialize($IIIIIIl11llI['config']);
$IIIIIIl11llI['needcheck']=$IIIIII1l11ll['needcheck'];
$this->assign('set',$IIIIIIl11llI);
$this->display();
}
}
public function index(){
$IIIIIlIII1I1 =M("leave");
import("ORG.Util.Page");
$IIIIIIIIlIl1 = array('token'=>$this->IIIIIIIIlIlI);
$IIIIIIIII1ll      = $IIIIIlIII1I1->where($IIIIIIIIlIl1)->count();
$IIIIIIll1lll       = new Page($IIIIIIIII1ll,10);
$IIIIIIIII11l       = $IIIIIIll1lll->show();
$IIIIIII11l11 = $IIIIIlIII1I1->where($IIIIIIIIlIl1)->order('id DESC')->limit($IIIIIIll1lll->firstRow.','.$IIIIIIll1lll->listRows)->select();
foreach($IIIIIII11l11 as $IIIIIIIlI11I=>$IIIIIIl1llIl){
$IIIIIlIII1lI = M("reply");
$IIIIIIIIlIl1 = array("message_id"=>$IIIIIIl1llIl['id']);
$IIIIIII11l11[$IIIIIIIlI11I]['count'] = $IIIIIlIII1lI->where($IIIIIIIIlIl1)->count();
$IIIIIIIIlIl1 = array("message_id"=>$IIIIIIl1llIl['id'],"checked"=>0);
$IIIIIII11l11[$IIIIIIIlI11I]['chkcount'] = $IIIIIlIII1lI->where($IIIIIIIIlIl1)->count();
}
$this->assign('res',$IIIIIII11l11);
$this->assign('page',$IIIIIIIII11l);
$this->display();
}
public function reply(){
$IIIIIlIII1lI =M("reply");
$IIIIIIIII1I1=$this->_get('msgid');
$IIIIIlIII1I1 =M("leave");
$IIIIIlIII1ll = $IIIIIlIII1I1->where(array('id'=>$IIIIIIIII1I1))->getField('message');
$this->assign("message_id",$IIIIIIIII1I1);
$this->assign('message',$IIIIIlIII1ll);
$IIIIIIIIlIl1 = array("message_id"=>$IIIIIIIII1I1);
import('ORG.Util.Page');
$IIIIIIIII1ll      = $IIIIIlIII1lI->where($IIIIIIIIlIl1)->count();
$IIIIIIll1lll       = new Page($IIIIIIIII1ll,10);
$IIIIIIIII11l       = $IIIIIIll1lll->show();
$IIIIIII11l11= $IIIIIlIII1lI->where($IIIIIIIIlIl1)->order('id DESC')->limit($IIIIIIll1lll->firstRow.','.$IIIIIIll1lll->listRows)->select();
if($IIIIIII11l11){
$this->assign("res",$IIIIIII11l11);
}else{
$this->assign("res",0);
}
$this->assign('page',$IIIIIIIII11l);
$this->display();
}
public function checkMany(){
$IIIIIlIII1I1 = M("leave");
$IIIIIIIII1I1 = $_GET['chk_value'];
$IIIIIIIII1I1 = explode(",",$IIIIIIIII1I1);
$IIIIIlIII11I =array();
foreach($IIIIIIIII1I1 as $IIIIIIl1llIl){
$IIIIIII11l11 = $IIIIIlIII1I1->where(array("id"=>intval($IIIIIIl1llIl)))->setField("checked",1);
if($IIIIIII11l11){
$IIIIIlIII11I = 1;
}else{
$IIIIIlIII11I = 0;
}
}
if(in_array("0",$IIIIIlIII11I)){
echo "审核失败";
}else{
echo "审核成功";
}
}
public function checkOne(){
$IIIIIlIII1I1 = M("leave");
$IIIIIIIII1I1 = $_GET['chk_value'];
$IIIIIlIII111 = $IIIIIlIII1I1->where(array("id"=>intval($IIIIIIIII1I1)))->getField("checked");
if($IIIIIlIII111 == 1){
$this->success("已审核",U('User/Reply/index',array('wecha_id'=>$this->IIIIIlIIIll1,'token'=>$this->IIIIIIIIlIlI)));
}else{
$IIIIIII11l11 = $IIIIIlIII1I1->where(array("id"=>$IIIIIIIII1I1))->setField("checked",1);
if($IIIIIII11l11){
$this->success("审核成功",U('User/Reply/index',array('wecha_id'=>$this->IIIIIlIIIll1,'token'=>$this->IIIIIIIIlIlI)));
}else{
$this->error("审核失败",U('User/Reply/index',array('wecha_id'=>$this->IIIIIlIIIll1,'token'=>$this->IIIIIIIIlIlI)));
}
}
}
public function del(){
$IIIIIlIII1I1 = M("leave");
$IIIIIIIII1I1 = $_GET['chk_value'];
$IIIIIII11l11 = $IIIIIlIII1I1->delete($IIIIIIIII1I1);
if($IIIIIII11l11){
echo "删除成功";
exit;
}else{
echo "删除失败";
exit;
}
}
public function deled(){
$IIIIIlIII1I1 = M("leave");
$IIIIIIIII1I1 = $_GET['chk_value'];
$IIIIIII11l11 = $IIIIIlIII1I1->delete($IIIIIIIII1I1);
if($IIIIIII11l11){
$this->success("删除成功",U('User/Reply/index',array('wecha_id'=>$this->IIIIIlIIIll1,'token'=>$this->IIIIIIIIlIlI)));
}else{
$this->success("删除失败",U('User/Reply/index',array('wecha_id'=>$this->IIIIIlIIIll1,'token'=>$this->IIIIIIIIlIlI)));
}
}
public function addreply(){
$IIIIIlIII1lI = M("reply");
$IIIIIIIl1II1 = $this->_post('content');
$IIIIIIIIIl11['wecha_id']='';
$IIIIIIIIIl11['checked'] =1;
$IIIIIIIIIl11['differ'] =$this->IIIIIlIIIl1I;
$IIIIIIIIIl11['message_id']=$this->_get('message_id');
$IIIIIIIIIl11['reply'] =$IIIIIIIl1II1;
$IIIIIIIIIl11['time']=time();
$IIIIIII11l11 = $IIIIIlIII1lI->add($IIIIIIIIIl11);
if($IIIIIII11l11){
$this->success("回复成功") ;
}else{
$this->error("回复失败") ;
}
}
public function add(){
$IIIIIlIII1lI = M("reply");
$IIIIIlIIlII1 =$this->_get('chk_value');
$IIIIIlIII111 =$this->_get('checked');
$this->assign("chk_value",$IIIIIlIIlII1);
$this->assign("checked",$IIIIIlIII111);
$this->display();
}
public function insert(){
$IIIIIlIII1lI = M("reply");
$IIIIIIIl1II1 = $this->_post('content');
$IIIIIlIII111 =$this->_post('checked');
$IIIIIlIIlIlI =$this->_post('chk');
$IIIIIIIII1I1 = explode(",",$IIIIIlIIlIlI);
$IIIIIlIII11I = array();
foreach($IIIIIIIII1I1 as $IIIIIIl1llIl){
$IIIIIIIIIl11['wecha_id']=$this->IIIIIlIIIll1;
$IIIIIIIIIl11['differ'] =$this->IIIIIlIIIl1I;
$IIIIIIIIIl11['checked'] =$IIIIIlIII111;
$IIIIIIIIIl11['message_id']=$IIIIIIl1llIl;
$IIIIIIIIIl11['reply'] =$IIIIIIIl1II1;
$IIIIIIIIIl11['time']=time();
$IIIIIII11l11 = $IIIIIlIII1lI->add($IIIIIIIIIl11);
if($IIIIIII11l11){
$IIIIIlIII11I[]= 1;
}else{
$IIIIIlIII11I[]= 0;
}
}
if(in_array("0",$IIIIIlIII11I)){
$this->error("回复失败",U('User/Reply/index',array('wecha_id'=>$this->IIIIIlIIIll1,'token'=>$this->IIIIIIIIlIlI))) ;
}else{
$this->success("回复成功",U('User/Reply/index',array('wecha_id'=>$this->IIIIIlIIIll1,'token'=>$this->IIIIIIIIlIlI))) ;
}
}
public function replyChk(){
$IIIIIlIII1lI = M("reply");
$IIIIIIIII1I1 = $this->_get('chk_value');
$IIIIIIIII1I1 = explode(",",$IIIIIIIII1I1);
$IIIIIlIII11I =array();
foreach($IIIIIIIII1I1 as $IIIIIIl1llIl){
$IIIIIII11l11 = $IIIIIlIII1lI->where(array("id"=>intval($IIIIIIl1llIl)))->setField("checked",1);
if($IIIIIII11l11){
$IIIIIlIII11I = 1;
}else{
$IIIIIlIII11I = 0;
}
}
if(in_array("0",$IIIIIlIII11I)){
echo "审核失败";
}else{
echo "审核成功";
}
}
public function replyChked(){
$IIIIIlIII1lI = M("reply");
$IIIIIIIII1I1 = $this->_get('id');
$IIIIIlIII111 = $IIIIIlIII1lI->where(array("id"=>intval($IIIIIIIII1I1)))->getField("checked");
if($IIIIIlIII111 == 1){
$this->success("已审核",U('User/Reply/index',array('wecha_id'=>$this->IIIIIlIIIll1,'token'=>$this->IIIIIIIIlIlI)));
}else{
$IIIIIII11l11 = $IIIIIlIII1lI->where(array("id"=>$IIIIIIIII1I1))->setField("checked",1);
if($IIIIIII11l11){
$this->success("审核成功",U('User/Reply/reply',array('wecha_id'=>$this->IIIIIlIIIll1,'token'=>$this->IIIIIIIIlIlI)));
}else{
$this->error("审核失败",U('User/Reply/reply',array('wecha_id'=>$this->IIIIIlIIIll1,'token'=>$this->IIIIIIIIlIlI)));
}
}
}
public function replyDel(){
$IIIIIlIII1lI = M("reply");
$IIIIIIIII1I1 = $this->_get('chk_value');
$IIIIIII11l11 = $IIIIIlIII1lI->delete($IIIIIIIII1I1);
if($IIIIIII11l11){
echo "删除成功";
exit;
}else{
echo "删除失败";
exit;
}
}
public function replyDeled(){
$IIIIIlIII1lI = M("reply");
$IIIIIIIII1I1 = $this->_get('id');
$IIIIIII11l11 = $IIIIIlIII1lI->delete($IIIIIIIII1I1);
if($IIIIIII11l11){
$this->success("删除成功");
}else{
$this->success("删除失败");
}
}
}
?>