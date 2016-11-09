<?php

class HostAction extends BaseAction{
public function __construct(){
parent::_initialize();
}
public function index(){
$IIIII1Ill1II = $_SERVER['HTTP_USER_AGENT'];
if(!strpos($IIIII1Ill1II,"icroMessenger")) {
}
$IIIIIIIIlIlI      = $this->_get('token');
$IIIIII1IIlll         = $this->_get('hid');
$IIIIIIIIlIl1      = array('token'=>$IIIIIIIIlIlI,'hid'=>$IIIIII1IIlll);
$IIIIII1IIl1I     = M('Host_list_add')->where($IIIIIIIIlIl1)->select();
$IIIII1Il11ll =  M('Host')->where(array('token'=>$IIIIIIIIlIlI,'id'=>$IIIIII1IIlll))->find();
$this->assign('list',$IIIIII1IIl1I);
$IIIII1Il11l1=M('Company');
$IIIIIII1I1lI=$IIIII1Il11l1->where(array('token'=>$IIIIIIIIlIlI,'isbranch'=>0))->find();
$IIIII1Il11ll['address']=$IIIIIII1I1lI['address'];
$this->assign('set',$IIIII1Il11ll);
$this->display();
}
public function online($IIIII1Il111l=1){
$IIIII1Ill1II = $_SERVER['HTTP_USER_AGENT'];
if(!strpos($IIIII1Ill1II,"icroMessenger")) {
}
$IIIIIIIIlIlI      = $this->_get('token');
if(empty($IIIIIIIIlIlI))  $this->error('非法操作');
$IIIIIIIIlIl1      = array('token'=>$IIIIIIIIlIlI);
$IIIIIIIIIl11=M('Host');
$IIIIIIIII1ll      = $IIIIIIIIIl11->where( $IIIIIIIIlIl1 )->count();
$IIIIIIll1lll       = new Page($IIIIIIIII1ll,7);
$IIIIIIIII11l       = $IIIIIIll1lll->show();
$IIIIIIIIlIII = $IIIIIIIIIl11->where( $IIIIIIIIlIl1 )->limit($IIIIIIll1lll->firstRow.','.$IIIIIIll1lll->listRows)->select();
$this->assign('list',$IIIIIIIIlIII);
$this->assign('show',$IIIIIIIII11l);
$IIIIII1IIlll         = $this->_get('hid');
$IIIII1Il11ll =  M('Host')->where(array('token'=>$IIIIIIIIlIlI,'id'=>$IIIIII1IIlll))->find();
$this->assign('set',$IIIII1Il11ll);
if ($IIIII1Il111l){
$this->display();
}
}
public function companyDetail(){
$this->online(0);
$this->display();
}
public function lists(){
$IIIII1Ill1II = $_SERVER['HTTP_USER_AGENT'];
if(!strpos($IIIII1Ill1II,"MicroMessenger")) {
}
$IIIIIIIII1I1    = $this->_get('id');
$IIIIIIIIlIlI = $this->_get('token');
$IIIIII1IIlll = $this->_get('hid');
$IIIIIlIIIll1 = $this->_get('wecha_id');
$IIIIIIIIIlIl = M('userinfo')->where(array('wecha_id'=>$IIIIIlIIIll1,'token'=>$IIIIIIIIlIlI))->find();
$IIIIIIIlIllI = M('Host')->where(array('id'=>$IIIIII1IIlll,'token'=>$IIIIIIIIlIlI))->find();
$IIIIIIIIlIl1 = array('id'=>$IIIIIIIII1I1,'token'=>$IIIIIIIIlIlI);
$IIIIII1I11ll = M('Host_list_add')->where($IIIIIIIIlIl1)->find();
$IIIIII1I11ll['picurl']=str_replace('&amp;','&',$IIIIII1I11ll['picurl']);
$this->assign('types',$IIIIII1I11ll);
$IIIII1I1IIII = $IIIIII1I11ll['price'] -$IIIIII1I11ll['yhprice'];
$this->assign('userinfo',$IIIIIIIIIlIl);
$this->assign('saves',$IIIII1I1IIII );
$this->assign('host',$IIIIIIIlIllI);
$this->display();
}
public function book(){
$IIIII1Ill1II = $_SERVER['HTTP_USER_AGENT'];
if(!strpos($IIIII1Ill1II,"MicroMessenger")) {
echo '此功能只能在微信浏览器中使用';exit;
}
if($_POST['action'] == 'book'){
$IIIIIIIIIl11['wecha_id']  =  $this->_post('wecha_id');
$IIIIIIIIIl11['book_people']  =  $this->_post('truename');
$IIIIIIIIIl11['remarks']   =  $this->_post('remarks');
$IIIIIIIIIl11['tel']       = $this->_post('tel');
$IIIIIIIIIl11['book_num']      = $this->_post('nums');
$IIIIIIIIIl11['book_time']  = strtotime($this->_post('dateline'));
$IIIIIIIII1I1       = $this->_post('id');
$IIIIIIIIIl11['room_type'] = $this->_post('roomtype');
$IIIIIIIIIl11['order_status'] = 3 ;
$IIIIIIIIIl11['hid'] = $this->_get('hid');
$IIIIIIIIIl11['token'] = $this->_get('token');
$IIIIIlIIIIIl = M('Host_list_add')->where(array('id'=>$IIIIIIIII1I1,'token'=>$IIIIIIIIIl11['token'],'hid'=>$IIIIIIIIIl11['hid']))->find();
$IIIIIIIIIl11['price'] = $IIIIIlIIIIIl['yhprice'] * $IIIIIIIIIl11['book_num'];
$IIIIIIIIl1Il = M('Host_order')->data($IIIIIIIIIl11)->add();
if($IIIIIIIIl1Il){
echo'{"success":1,"msg":"恭喜,预定成功。"}';
}else{
echo'{"success":0,"msg":"请从新预定。"}';
}
exit;
}
}
}
?>