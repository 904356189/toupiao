<?php
echo '﻿';
class ShakeprizeAction extends BaseAction{
public function index(){
$IIIII1Ill1II = $_SERVER['HTTP_USER_AGENT'];
if(!strpos($IIIII1Ill1II,"Mobile")) {
}
$IIIIIIIIlIlI	  =  $this->_get('token');
$IIIIIlIIIll1 = $this->_get('wecha_id');
if (!$IIIIIlIIIll1){
$IIIIIlIIIll1='null';
}
$IIIIIIIII1I1 	  = $this->_get('id');
$IIIIIll1lll1 =	M('Lottery')->where(array('id'=>$IIIIIIIII1I1,'token'=>$IIIIIIIIlIlI,'type'=>6))->find();
$this->assign('Shakeprize',$IIIIIll1lll1);
$this->assign('token',$IIIIIIIIlIlI);
$this->display();
}
public function info() {
$IIIIIIIII1I1 = $this->_get("id");
$IIIIIIIIlIlI = $this->_get("token");
$IIIIIlIIIll1 = $this->_get("wxid");
$IIIIIIIIlIl1	  = array('token'=>$IIIIIIIIlIlI,'id'=>$IIIIIIIII1I1);
$IIIII1llI1ll = M("Lottery")->where($IIIIIIIIlIl1)->find();
if(!$IIIII1llI1ll){
die(json_encode(array("ret"=>1,"msg"=>"活动不存在")));
}
$IIIII1I11l11=array();
if($IIIII1llI1ll['fist']!=""&&$IIIII1llI1ll['fistnums']!=0){
$IIIII1I11l11[]=array("name"=>$IIIII1llI1ll['fist'],"number"=>$IIIII1llI1ll['fistnums'],"pic"=>"/assets/public/css/images/liwu.png","bigpic"=>"/assets/public/css/images/liwu.png");
}
if($IIIII1llI1ll['second']!=""&&$IIIII1llI1ll['secondnums']!=0){
$IIIII1I11l11[]=array("name"=>$IIIII1llI1ll['second'],"number"=>$IIIII1llI1ll['secondnums'],"pic"=>"/assets/public/css/images/liwu.png","bigpic"=>"/assets/public/css/images/liwu.png");
}
if($IIIII1llI1ll['third']!=""&&$IIIII1llI1ll['thirdnums']!=0){
$IIIII1I11l11[]=array("name"=>$IIIII1llI1ll['fist'],"number"=>$IIIII1llI1ll['thirdnums'],"pic"=>"/assets/public/css/images/liwu.png","bigpic"=>"/assets/public/css/images/liwu.png");
}
$IIIII1llI1l1 = array();
$IIIII1llI11I = array();
$IIIII1lIl111	  = array('token'=>$IIIIIIIIlIlI,'wecha_id'=>$IIIIIlIIIll1,'lid'=>$IIIIIIIII1I1);
$IIIII1llI11l = M("Lottery_record")->where($IIIII1lIl111)->find();
$IIIII1llI111 = 0;
if($IIIII1llI11l){
if($IIIII1llI11l["islottery"]){
$IIIII1llI1l1[]=array("id"=>$IIIII1llI11l["id"],"prize_name"=>$IIIII1llI11l["prize"],"prize_type"=>$IIIII1llI11l["prize"],"status"=>0,"inputtime"=>$IIIII1llI11l["time"]);
}
$IIIII1llI111 = $IIIII1llI11l["usenums"];
}
$IIIII1lllIII = $IIIII1llI1ll['canrqnums']-$IIIII1llI111;
$IIIIIIIlll1I = array(
"ret"=>0,
"data"=>array(
"id"=>$IIIII1llI1ll['lid'],
"cate_id"=>"",
"wid"=>"",
"title"=>$IIIII1llI1ll['title'],
"desc"=>$IIIII1llI1ll['info'],
"content"=>$IIIII1llI1ll['info'],
"start_time"=>$IIIII1llI1ll['statdate'],
"end_time"=>$IIIII1llI1ll['enddate'],
"rule"=>array("number"=>$IIIII1llI1ll['canrqnums'],"type"=>1,"lotterynum"=>0),
"prize"=>$IIIII1I11l11,
"advset"=>array("displaywinner"=>0,"showprizenum"=>1),
"cover_img"=>array("image_start"=>"/assets/game/shake_start.jpg","image_end"=>"/assets/game/shake_start.jpg"),
"backgroundimage"=>"",
"tips"=>array("wintips"=>$IIIII1llI1ll["sttxt"],"failtips"=>"再接再厉哟，大奖马上就来！","endtitle"=>$IIIII1llI1ll["endtite"]),
"views"=>$IIIII1llI1ll['click'],
"joins"=>$IIIII1llI1ll['joinnum'],
"auth"=>"0",
"chance"=>$IIIII1lllIII,
"type"=>"5",
"validatecode"=>"g",
"inputtime"=>$IIIII1llI1ll['createtime'],
"is_deleted"=>0,
"is_start"=>1,
"is_end"=>1,
"game_status"=>1,
"totalchance"=>100,
"recordList"=>$IIIII1llI11I,
"myRecordList"=>$IIIII1llI1l1,
)
);
die(json_encode($IIIIIIIlll1I));
}
public function run() {
$IIIIIIIII1I1 = $this->_post("id");
$IIIIIIIIlIlI = $this->_post("token");
$IIIIIlIIIll1 = $this->_post("wxid");
$IIIII1I11lIl	  = M('Lottery_record');
$IIIIIIIIlIl1	  = array('token'=>$IIIIIIIIlIlI,'wecha_id'=>$IIIIIlIIIll1,'lid'=>$IIIIIIIII1I1);
$IIIIII1llllI   = $IIIII1I11lIl->where($IIIIIIIIlIl1)->find();
if($IIIIII1llllI == Null){
$IIIII1I11lIl->add($IIIIIIIIlIl1);
$IIIIII1llllI =$IIIII1I11lIl->where($IIIIIIIIlIl1)->find();
}
$IIIIIll1lll1 =	M('Lottery')->where(array('id'=>$IIIIIIIII1I1,'token'=>$IIIIIIIIlIlI,'type'=>6))->find();
$IIIIIIIIIl11 = array();
if ($IIIIIll1lll1['enddate'] <time()) {
$IIIIIIIlll1I = array("ret"=>1,"msg"=>"活动已经结束");
die(json_encode($IIIIIIIlll1I));
}
if ($IIIIII1llllI['islottery'] == 1) {
$IIIIIIIlll1I = array("ret"=>1,"msg"=>"您已经中过一个奖，把机会留给别人吧");
die(json_encode($IIIIIIIlll1I));
}else{
if ($IIIIII1llllI['usenums'] >= $IIIIIll1lll1['canrqnums'] ) {
$IIIIIIIlll1I = array("ret"=>1,"msg"=>"抽奖次数已用完");
die(json_encode($IIIIIIIlll1I));
}else{
$IIIII1I11lIl->where(array('id'=>$IIIIII1llllI['id']))->setInc('usenums');
$IIIIII1llllI = $IIIII1I11lIl->where(array('id'=>$IIIIII1llllI['id']))->find();
$IIIII1lIIlI1=intval($IIIIIll1lll1['fistnums']);
$IIIII1lIIllI=intval($IIIIIll1lll1['secondnums']);
$IIIII1lIIlll=intval($IIIIIll1lll1['thirdnums']);
$IIIII1lIIll1=intval($IIIIIll1lll1['fournums']);
$IIIII1lIIl1I=intval($IIIIIll1lll1['fivenums']);
$IIIII1lIIl1l=intval($IIIIIll1lll1['sixnums']);
$IIIIII1IlI11=intval($IIIIIll1lll1['canrqnums']);
$IIIII1lIIl11 = array(
'0'=>array('id'=>1,'prize'=>'一等奖:'.$IIIIIll1lll1['fist'],'v'=>$IIIII1lIIlI1,'start'=>0,'end'=>$IIIII1lIIlI1),
'1'=>array('id'=>2,'prize'=>'二等奖'.$IIIIIll1lll1['second'],'v'=>$IIIII1lIIllI,'start'=>$IIIII1lIIlI1,'end'=>$IIIII1lIIlI1+$IIIII1lIIllI),
'2'=>array('id'=>3,'prize'=>'三等奖'.$IIIIIll1lll1['third'],'v'=>$IIIII1lIIlll,'start'=>$IIIII1lIIlI1+$IIIII1lIIllI,'end'=>$IIIII1lIIlI1+$IIIII1lIIllI+$IIIII1lIIlll),
'3'=>array('id'=>4,'prize'=>'谢谢参与','v'=>(intval($IIIIIll1lll1['allpeople']))*$IIIIII1IlI11-($IIIII1lIIlI1+$IIIII1lIIllI+$IIIII1lIIlll),'start'=>$IIIII1lIIlI1+$IIIII1lIIllI+$IIIII1lIIlll,'end'=>intval($IIIIIll1lll1['allpeople'])*$IIIIII1IlI11)
);
foreach ($IIIII1lIIl11 as $IIIIIIIlI11I =>$IIIIIIl1llIl) {
$IIIIIIIlII1l[$IIIIIIl1llIl['id']] = $IIIIIIl1llIl;
}
if ($IIIIIll1lll1['allpeople'] == 1) {
if ($IIIIIll1lll1['fistlucknums'] <= $IIIIIll1lll1['fistnums']) {
$IIIIII1llI11 = 1;
}else{
$IIIIII1llI11 = 4;
}
}else{
$IIIIII1llI11 = $this->get_rand($IIIIIIIlII1l,intval($IIIIIll1lll1['allpeople'])*$IIIIII1IlI11);
}
$IIIII1lII1Il = $IIIII1lIIl11[$IIIIII1llI11-1]['prize'];
$IIIII1lllIlI = false;
$IIIII1lII1II = 0;
switch($IIIIII1llI11){
case 1:
if ($IIIIIll1lll1['fistlucknums'] >$IIIIIll1lll1['fistnums']) {
$IIIII1lllIlI = false;
$IIIII1lII1Il = '谢谢参与';
}else{
$IIIII1lllIlI	= true;
$IIIII1lII1II = 1;
M('Lottery')->where(array('id'=>$IIIIIIIII1I1))->setInc('fistlucknums');
}
break;
case 2:
if ($IIIIIll1lll1['secondlucknums'] >$IIIIIll1lll1['secondnums']) {
$IIIII1lllIlI = false;
$IIIII1lII1Il = '谢谢参与';
}else{
if(empty($IIIIIll1lll1['second']) &&empty($IIIIIll1lll1['secondnums'])){
$IIIII1lllIlI = false;
$IIIII1lII1Il = '谢谢参与';
}else{
$IIIII1lllIlI	= true;
$IIIII1lII1II = 2;
M('Lottery')->where(array('id'=>$IIIIIIIII1I1))->setInc('secondlucknums');
}
}
break;
case 3:
if ($IIIIIll1lll1['thirdlucknums'] >$IIIIIll1lll1['thirdnums']) {
$IIIII1lllIlI = false;
$IIIII1lII1Il = '谢谢参与';
}else{
if(empty($IIIIIll1lll1['third']) &&empty($IIIIIll1lll1['thirdnums'])){
$IIIII1lllIlI = false;
$IIIII1lII1Il = '谢谢参与';
}else{
$IIIII1lllIlI	= true;
$IIIII1lII1II = 3;
M('Lottery')->where(array('id'=>$IIIIIIIII1I1))->setInc('thirdlucknums');
}
}
break;
default:
$IIIII1lllIlI = false;
$IIIII1lII1Il = '谢谢参与';
break;
}
}
}
if($IIIII1lllIlI){
$IIIII1I11lIl->where($IIIIIIIIlIl1)->save(array("prize"=>$IIIII1lII1Il,"prizetype"=>$IIIII1lII1II,'islottery'=>1));
$IIIIIIIlll1I = array(
"ret"=>0,
"data"=>array(
"data"=>array(
"gid"=>$IIIIIIIII1I1,
"type"=>3,
"prize"=>$IIIII1lII1Il,
"prize_type"=>$IIIII1lII1II,
"pic"=>"/assets/public/css/images/liwu.png",
"tips"=>"恭喜您，中奖了！您的运气实在太好了！",
"recordid"=>$IIIIII1llllI["id"],
"mobile"=>$IIIIII1llllI["phone"],
"address"=>$IIIIII1llllI["address"],
"name"=>$IIIIII1llllI["name"],
"inputtime"=>$IIIIII1llllI["createtime"]
))
);
}else{
$IIIIIIIlll1I = array(
"ret"=>0,
"data"=>array(
"data"=>array(
"type"=>0,
"prize"=>$IIIII1lII1Il,
"prize_type"=>0,
"pic"=>"",
"tips"=>"再接再厉哟！",
))
);
}
die(json_encode($IIIIIIIlll1I));
}
public function giveUpPrize(){
$IIIIIIIII1I1 				= $this->_post('id');
$IIIIIlIIIll1 			= $this->_post('wxid');
$IIIII1I11lIl = M('Lottery_record');
$IIIIIIIIlIl1 = array('id'=>$IIIIIIIII1I1,'wecha_id'=>$IIIIIlIIIll1);
$IIIIII1llllI = $IIIII1I11lIl->where($IIIIIIIIlIl1)->find();
if($IIIIII1llllI){
$IIIII1I11lIl->where($IIIIIIIIlIl1)->save(array("prize"=>"","prizetype"=>0,'islottery'=>0));
die(json_encode(array("ret"=>0,"msg"=>"已经取消该次中奖")));
}else{
die(json_encode(array("ret"=>1,"msg"=>"记录不存在")));
}
}
public function submit(){
if(IS_POST){
$IIIII1lII1l1 				= $this->_post('lid');
$IIIIIIIII1I1 				= $this->_post('rid');
$IIIIIlIIIll1 			= $this->_post('wxid');
$IIIIIIIIIl11['phone'] 		= $this->_post('mobile');
$IIIIIIIIIl11['name']		= $this->_post('username');
$IIIIIIIIIl11['address']	= $this->_post('address');
$IIIIIIIIIl11['time']		= time();
$IIIIIIIIIl11['sn']			= uniqid();
$IIIII1lII111 = M('Lottery_record')->where(array('id'=>$IIIIIIIII1I1,'wecha_id'=>$IIIIIlIIIll1))->save($IIIIIIIIIl11);
die(json_encode(array("ret"=>0,"msg"=>"更新成功")));
}
}
protected function get_rand($IIIII1I111I1,$IIIIII1II1I1) {
$IIIIIlIII11I = 7;
$IIIII1I111ll = mt_rand(1,$IIIIII1II1I1);
foreach ($IIIII1I111I1 as $IIIIIIIllIll =>$IIIIIIlIllII) {
if ($IIIIIIlIllII['v']>0){
if ($IIIII1I111ll>$IIIIIIlIllII['start']&&$IIIII1I111ll<=$IIIIIIlIllII['end']){
$IIIIIlIII11I=$IIIIIIIllIll;
break;
}
}
}
return $IIIIIlIII11I;
}
}
?>