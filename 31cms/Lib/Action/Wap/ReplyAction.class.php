<?php

class ReplyAction extends BaseAction{
public $IIIIIIIIlIlI;
public $IIIIIlIIIlll;
public $IIIIIlIlIII1;
public $IIIIIlIIIll1;
public function __construct(){
parent::__construct();
$this->IIIIIIIIlIlI=$this->_get('token');
$this->IIIIIlIIlI11=M('reply_info');
$IIIIIlIIIl1l = $this->IIIIIlIIlI11->where(array('infotype'=>'message','token'=>$this->IIIIIIIIlIlI))->find();
$IIIIIlIIIl11=unserialize($IIIIIlIIIl1l['config']);
$this->IIIIIlIIIlll=intval($IIIIIlIIIl11['needcheck']);
$this->IIIIIlIlIII1=60;
$this->IIIIIlIIIll1	= $this->_get('wecha_id');
$this->assign('wecha_id',$this->IIIIIlIIIll1);
$this->assign('needCheck',$this->IIIIIlIIIlll);
$this->assign('token',$this->IIIIIIIIlIlI);
}
public function index(){
$IIIIIlIII1I1 =M("leave");
if(IS_GET){
$IIIIIIIIlIl1 = array("token"=>$this->IIIIIIIIlIlI,'checked'=>1);
import('ORG.Util.Page');
$IIIIIIIII1ll      = $IIIIIlIII1I1->where($IIIIIIIIlIl1)->count();
$IIIIIIll1lll       = new Page($IIIIIIIII1ll,10);
$IIIIIIIII11l       = $IIIIIIll1lll->show();
$IIIIIII11l11 = $IIIIIlIII1I1->where($IIIIIIIIlIl1)->order('id DESC')->limit($IIIIIIll1lll->firstRow.','.$IIIIIIll1lll->listRows)->select();
foreach($IIIIIII11l11 as $IIIIIIIlI11I=>$IIIIIIl1llIl){
$IIIIIlIII1lI = M("reply");
$IIIIIIIIlIl1 = array("message_id"=>$IIIIIIl1llIl['id'],"checked"=>1);
$IIIIIII11l11[$IIIIIIIlI11I]['vo'] = $IIIIIlIII1lI->where($IIIIIIIIlIl1)->order("time DESC")->select();
}
$this->assign('res',$IIIIIII11l11);
$this->assign('page',$IIIIIIIII11l);
$this->display();
}
}
public function leave(){
$IIIIIlIII1I1 =M("leave");
$IIIIIlIII1ll=$this->_get('message');
$IIIIIIIlIIII=$this->_get('name');
$IIIII1lIlIlI = array();
$IIIII1lIlIlI['checked'] = 1-intval($this->IIIIIlIIIlll);
$IIIII1lIlIlI['name'] =$IIIIIIIlIIII;
$IIIII1lIlIlI['message'] = $IIIIIlIII1ll;
$IIIII1lIlIlI['wecha_id'] = $this->IIIIIlIIIll1;
$IIIII1lIlIlI['token']=$this->IIIIIIIIlIlI;
$IIIII1lIlIlI['time'] =time();
$IIIII1lIlIll = $IIIIIlIII1I1->where(array("token"=>$this->IIIIIIIIlIlI))->getField("max(time)");
$IIIII1lIlIl1 = time() -$IIIII1lIlIll;
if($IIIII1lIlIl1 <$this->IIIIIlIlIII1){
$this->ajaxReturn("","您已留言,请60秒以后再留言",0);
exit;
}else{
$IIIIIII11l11 = $IIIIIlIII1I1->add($IIIII1lIlIlI);
if($IIIIIII11l11){
$IIIII1lIlIlI['id']=$IIIIIII11l11;
if($IIIII1lIlIlI['checked'] == 1){
$IIIII1lIlIlI['time'] =date("Y-m-d H:i:s",$IIIII1lIlIlI['time']);
$IIIIIIIIIl11['data'] =$IIIII1lIlIlI;
$IIIIIIIIIl11['info'] ="留言成功";
$IIIIIIIIIl11['status'] = 1;
$this->ajaxReturn($IIIIIIIIIl11);
exit;
}else{
$IIIIIIIIIl11['data'] =$IIIII1lIlIlI;
$IIIIIIIIIl11['info'] ="留言成功,正在审核中";
$IIIIIIIIIl11['status'] = 2;
$this->ajaxReturn($IIIIIIIIIl11);
exit;
}
}else{
$IIIIIIIIIl11['data'] ="";
$IIIIIIIIIl11['info'] ="留言失败";
$IIIIIIIIIl11['status'] = 0;
$this->ajaxReturn($IIIIIIIIIl11);
exit;
}
}
}
public function reply(){
$IIIIIlIII1lI=M("reply");
$IIIIIlIIlIlI = $this->_get('message_id');
$IIIII1lIlI1I = $this->_get('reply');
$IIIII1lIlI1l = array();
if (intval($this->IIIIIlIIIlll)){
$IIIII1lIlI1l['checked'] = 0;
}else {
$IIIII1lIlI1l['checked'] = 1;
}
$IIIII1lIlI1l['wecha_id'] = $this->IIIIIlIIIll1;
$IIIII1lIlI1l['message_id'] = $IIIIIlIIlIlI;
$IIIIIlIII1I1 =M("leave");
$IIIII1lIlI11=$IIIIIlIII1I1->where(array('id'=>intval($IIIIIlIIlIlI)))->find();
if (!$IIIII1lIlI11){
$this->ajaxReturn("","留言不存在",0);
exit;
}
$IIIII1lIlI1l['reply'] = $IIIII1lIlI1I;
$IIIII1lIlI1l['time'] =time();
$IIIII1lIlIll = $IIIIIlIII1lI->where(array('message_id'=>$IIIIIlIIlIlI))->getField("max(time)");
$IIIII1lIlIl1 = time() -$IIIII1lIlIll;
if($IIIII1lIlIl1 <$this->IIIIIlIlIII1){
$this->ajaxReturn("","你已回复，请60秒以后再回复",0);
exit;
}else{
$IIIIIII11l11 = $IIIIIlIII1lI->add($IIIII1lIlI1l);
if($IIIIIII11l11){
$IIIII1lIlI1l['id']=$IIIIIII11l11;
if($IIIII1lIlI1l['checked'] == 1){
$IIIII1lIlI1l['time'] =date("Y-m-d H:i:s",$IIIII1lIlI1l['time']);
$IIIIIIIIIl11['data'] =$IIIII1lIlI1l;
$IIIIIIIIIl11['info'] ="回复成功";
$IIIIIIIIIl11['status'] = 1;
$this->ajaxReturn($IIIIIIIIIl11);
exit;
}else{
$IIIIIIIIIl11['data'] =$IIIII1lIlI1l;
$IIIIIIIIIl11['info'] ="回复成功,正在审核中";
$IIIIIIIIIl11['status'] = 2;
$this->ajaxReturn($IIIIIIIIIl11);
exit;
}
}else{
$IIIIIIIIIl11['data'] ="";
$IIIIIIIIIl11['info'] ="回复失败";
$IIIIIIIIIl11['status'] = 0;
$this->ajaxReturn($IIIIIIIIIl11);
exit;
}
}
}
}
?>