<?php

class ReservationAction extends BaseAction{
public $IIIIIIIIlIlI;
public $IIIIIlIIIll1;
public function _initialize() {
parent::_initialize();
$IIIIIIIIlIlI=$this->_get('token');
$IIIIIlIIIll1=$this->_get('wecha_id');
$this->assign('token',$IIIIIIIIlIlI);
$this->assign('wecha_id',$IIIIIlIIIll1);
if(!isset($_SESSION)){
session_start();
}
}
public function index(){
$IIIII1Ill1II = $_SERVER['HTTP_USER_AGENT'];
if(!strpos($IIIII1Ill1II,"icroMessenger")) {
}
$IIIIIIIIIl11 = M("Reservation");
$IIIIIIIIlIlI      = $this->_get('token');
$IIIIIlIIIll1   = $this->_get('wecha_id');
$IIIIII1llI11         = (int)$this->_get('rid');
$this->assign('token',$IIIIIIIIlIlI);
$this->assign('wecha_id',$IIIIIlIIIll1);
$IIIIIIIIlIl1 = array('token'=>$IIIIIIIIlIlI);
if($IIIIII1llI11 != ''){
$this->assign('rid',$IIIIII1llI11);
$IIIII1lIl111 = array('token'=>$IIIIIIIIlIlI,'id'=>$IIIIII1llI11);
$IIIIIlII11I1 =  $IIIIIIIIIl11->where($IIIII1lIl111)->find();
if($IIIIIlII11I1['addtype'] =='drive'){
$IIIII1lI1III = array('token'=>$IIIIIIIIlIlI,'addtype'=>'drive');
$IIIII1lI1IIl =  $IIIIIIIIIl11->where($IIIII1lI1III)->find();
$this->assign('addtype','drive');
$IIIII1lI1II1 = array('token'=>$IIIIIIIIlIlI,'wecha_id'=>$IIIIIlIIIll1);
$IIIIIIIIII1I = M('Caruser')->where($IIIII1lI1II1)->field('car_userName as truename,brand_serise,car_no as carnum,user_tel,car_care_mileage as km')->find();
if(!empty($IIIIIIIIII1I)){
$IIIII1lI1IIl = array_merge($IIIII1lI1IIl,$IIIIIIIIII1I);
}
$this->assign('reser',$IIIII1lI1IIl);
$IIIII1lI1IlI = array('token'=>$IIIIIIIIlIlI,'wecha_id'=>$IIIIIlIIIll1,'type'=>$IIIIIlII11II);
$IIIIIIIII1ll = M('Reservebook')->where($IIIII1lI1IlI)->count();
$this->assign('count',$IIIIIIIII1ll);
$this->display("Car:CarReserveBook");
exit;
}
if($IIIIIlII11I1['addtype'] =='maintain'){
$IIIII1lI1Ill  =  array('token'=>$IIIIIIIIlIlI,'addtype'=>'maintain');
$this->assign('addtype','maintain');
$IIIII1lI1IIl =  $IIIIIIIIIl11->where($IIIII1lI1Ill)->find();
$IIIII1lI1Il1 = array('token'=>$IIIIIIIIlIlI,'wecha_id'=>$IIIIIlIIIll1);
$IIIIIIIIII1I = M('Caruser')->where($IIIII1lI1Il1)->field('car_userName as truename,brand_serise,car_no as carnum,user_tel,car_care_mileage as km')->find();
if(!empty($IIIIIIIIII1I)){
$IIIII1lI1IIl = array_merge($IIIII1lI1IIl,$IIIIIIIIII1I);
}
$this->assign('reser',$IIIII1lI1IIl);
$IIIII1lI1I1I = array('token'=>$IIIIIIIIlIlI,'wecha_id'=>$IIIIIlIIIll1,'type'=>$IIIIIlII11II);
$IIIIIIIII1ll = M('Reservebook')->where($IIIII1lI1I1I)->count();
$this->assign('count',$IIIIIIIII1ll);
$this->display("Car:CarReserveBook");
exit;
}
}
$IIIII1lI1II1 = array('token'=>$IIIIIIIIlIlI,'wecha_id'=>$IIIIIlIIIll1);
$IIIIIIIIII1I = M('Userinfo')->where($IIIII1lI1II1)->field('truename,tel as user_tel')->find();
if(!empty($IIIIIIIIII1I)){
$IIIIIlII11I1 = array_merge($IIIIIlII11I1,$IIIIIIIIII1I);
}
$this->assign('reslist',$IIIIIlII11I1);
$IIIII1lI1I1l = M('Estate_housetype');
$IIIII1lI1I11 = $IIIII1lI1I1l->where($IIIIIIIIlIl1)->order('sort desc')->field('id as hid,name')->select();
$this->assign('housetype',$IIIII1lI1I11);
$IIIII1lI1IlI = array('token'=>$IIIIIIIIlIlI,'wecha_id'=>$IIIIIlIIIll1,'type'=>'house_book');
$IIIIIIIII1ll = M('Reservebook')->where($IIIII1lI1IlI)->count();
$this->assign('count',$IIIIIIIII1ll);
$this->display();
}
public function add(){
$IIIII1Ill1II = $_SERVER['HTTP_USER_AGENT'];
if(!strpos($IIIII1Ill1II,"icroMessenger")) {
}
$IIIIIIIlII11['token']      = strval($this->_get('token'));
$IIIIIIIlII11['wecha_id']   = strval($this->_post('wecha_id'));
$IIIIIIIlII11['rid']        = (int)$this->_post('rid');
$IIIIIIIlII11['truename']   = strval($this->_post("truename"));
$IIIIIIIlII11['dateline']   = strval($this->_post("dateline"));
$IIIIIIIlII11['timepart']   = strval($this->_post("timepart"));
$IIIIIIIlII11['info']       = strval($this->_post("info"));
$IIIIIIIlII11['tel']        = strval($this->_post("tel"));
$IIIIIIIlII11['type']       = strval($this->_post('type'));
$IIIIIIIlII11['housetype']  = $this->_post('housetype');
$IIIIIIIlII11['booktime']   = time();
$IIIII1lI1lII['id']        = (int)$this->_post('id');
if($IIIIIIIlII11['type'] =='maintain'){
$IIIIIIIlII11['carnum']   = strval($this->_post("carnum"));
$IIIIIIIlII11['km']       = (int)$this->_post('km');
}
$IIIII1lI1lIl   =   M('Reservebook');
$IIIIIIIIlIlI = strval($this->_get('token'));
$IIIIIlIIIll1 = strval($this->_get('wecha_id'));
$IIIIIII1l1Il ='http://'.$_SERVER['HTTP_HOST'];
$IIIIIII1l1Il .= U('Reservation/mylist',array('token'=>$IIIIIIIIlIlI,'wecha_id'=>$IIIIIlIIIll1));
if($IIIII1lI1lII['id'] != ''){
$IIIIIllI11l1 = $IIIII1lI1lIl->where(array('id'=>$IIIII1lI1lII['id']))->save($IIIIIIIlII11);
if($IIIIIllI11l1){
$IIIIIIIlII1l=array('errno'=>0,'msg'=>'修改成功','url'=>$IIIIIII1l1Il,'token'=>$IIIIIIIIlIlI,'wecha_id'=>$IIIIIlIIIll1);
echo json_encode($IIIIIIIlII1l);
exit;
}else{
$IIIIIIIlII1l=array('errno'=>1,'msg'=>'修改失败','url'=>$IIIIIII1l1Il,'token'=>$IIIIIIIIlIlI,'wecha_id'=>$IIIIIlIIIll1);
echo json_encode($IIIIIIIlII1l);
exit;
}
}
$IIIIIIIIlI1I = $IIIII1lI1lIl->data($IIIIIIIlII11)->add();
if(!empty($IIIIIIIIlI1I)){
$IIIIIIIlII1l=array('errno'=>0,'msg'=>'恭喜预约成功','token'=>$IIIIIIIIlIlI,'wecha_id'=>$IIIIIlIIIll1,'url'=>$IIIIIII1l1Il);
echo json_encode($IIIIIIIlII1l);
exit;
}else{
$IIIIIIIlII1l=array('errno'=>1,'msg'=>'预约失败，请重新预约','token'=>$IIIIIIIIlIlI,'wecha_id'=>$IIIIIlIIIll1,'url'=>$IIIIIII1l1Il);
echo json_encode($IIIIIIIlII1l);
exit;
}
}
public function mylist(){
$IIIII1Ill1II = $_SERVER['HTTP_USER_AGENT'];
if(!strpos($IIIII1Ill1II,"icroMessenger")) {
}
$IIIIIIIIlIlI      = $this->_get('token');
$IIIIIlIIIll1   = $this->_get('wecha_id');
$this->assign('token',$IIIIIIIIlIlI);
$this->assign('wecha_id',$IIIIIlIIIll1);
$IIIII1lI1lIl   =   M('Reservebook');
$IIIIIIIIlIl1 = array('token'=>$IIIIIIIIlIlI,'wecha_id'=>$IIIIIlIIIll1,'type'=>'house_book');
$IIIIIlII111I  = $IIIII1lI1lIl->where($IIIIIIIIlIl1)->order('id DESC')->select();
$this->assign('books',$IIIIIlII111I);
$IIIIIIIIIl11 = M("Reservation");
$IIIII1lIl111 = array('token'=>$IIIIIIIIlIlI);
$IIIIII1llI11 = $IIIIIIIIIl11->where($IIIII1lIl111)->getField('headpic');
$IIIIII1llI11 = M('Estate')->where($IIIIIIIIlIl1)->getField('res_id');
if($IIIIII1llI11 != ''){
$IIIII1lI1II1 = array('token'=>$IIIIIIIIlIlI,'id'=>$IIIIII1llI11);
$IIIIII1l11l1 =  $IIIIIIIIIl11->where($IIIII1lI1II1)->getField('headpic');
}
$this->assign('headpic',$IIIIII1l11l1);
$this->assign('books',$IIIIIlII111I);
$this->display();
}
public function edit(){
$IIIII1Ill1II = $_SERVER['HTTP_USER_AGENT'];
if(!strpos($IIIII1Ill1II,"icroMessenger")) {
}
$IIIIII1llI11 = (int)$this->_get('rid');
$this->assign('rid',$IIIIII1llI11);
$IIIII1lI1lIl = M('Reservebook');
$IIIIIIIII1I1 = (int)$this->_get('id');
$IIIIIIIIlIlI = $this->_get('token');
$IIIIIlIIIll1 = $this->_get('wecha_id');
$IIIIIIIIlIl1 = array('id'=>$IIIIIIIII1I1,'token'=>$IIIIIIIIlIlI,'wecha_id'=>$IIIIIlIIIll1);
$IIIIIlII11I1 = $IIIII1lI1lIl->where($IIIIIIIIlIl1)->field('id,rid,token,wecha_id,truename,tel as user_tel,housetype,dateline,timepart,info as userinfo,type,booktime')->find();
$IIIII1lI1lll = M('Reservation')->where(array('token'=>$IIIIIIIIlIlI,'id'=>$IIIIII1llI11))->field('picurl,info,address,place,lng,lat,title,tel')->find();
if(!empty($IIIIIlII11I1)){
$IIIIIlII11I1 = array_merge($IIIII1lI1lll,$IIIIIlII11I1);
$this->assign('reslist',$IIIIIlII11I1);
$IIIII1lI1I1l = M('Estate_housetype');
$IIIII1lI1I11 = $IIIII1lI1I1l->where(array('token'=>$IIIIIIIIlIlI))->order('sort desc')->field('id as hid,name')->select();
$this->assign('housetype',$IIIII1lI1I11);
}else{
$this->error('操作错误',U('Index/index',array('token'=>$IIIIIIIIlIlI,'wecha_id'=>$IIIIIlIIIll1)));
}
$IIIII1lI1IlI = array('token'=>$IIIIIIIIlIlI,'wecha_id'=>$IIIIIlIIIll1,'type'=>'house_book');
$IIIIIIIII1ll = M('Reservebook')->where($IIIII1lI1IlI)->count();
$this->assign('count',$IIIIIIIII1ll);
$this->display('index');
}
}?>