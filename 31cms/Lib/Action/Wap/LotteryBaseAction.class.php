<?php

class LotteryBaseAction extends WapAction{
public function __construct(){
parent::_initialize();
$IIIII1I111II['wecha_id']=$this->IIIIIlIIIll1;
$IIIII1I111II['token']=$this->_get('token');
$IIIII1I111Il=M('Userinfo')->where($IIIII1I111II)->find();
if ($IIIIIIIIIl11){
if ($IIIII1I111Il){
unset($IIIIIIIIIl11['id']);
}else {
unset($IIIIIIIIIl11['id']);
M('Userinfo')->add($IIIIIIIIIl11);
}
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
public function prizeHandle($IIIIIIIIlIlI,$IIIIIlIIIll1,$IIIIIll1lll1){
$this->IIIII1Ill11l=M('Lottery_record');
$this->IIIII1Ill111=M('Lottery');
$IIIIIII111II=time();
$IIIIIIIII1I1 		= $IIIIIll1lll1['id'];
$IIIII1I11lIl		= $this->IIIII1Ill11l;
$IIIIIIIIlIl1 		= array('token'=>$IIIIIIIIlIlI,'wecha_id'=>$IIIIIlIIIll1,'lid'=>$IIIIIIIII1I1);
$IIIIII1llllI 	= $IIIII1I11lIl->where($IIIIIIIIlIl1)->find();
if($IIIIII1llllI == Null){
$IIIIII1llllI = $IIIIIIIIlIl1;
$IIIIII1llllI['usenums']=0;
}
if ($IIIIIll1lll1['enddate'] <$IIIIIII111II) {
$IIIIIIIIIl11['end'] = 2;
$IIIIIIIIIl11['endinfo'] = $IIIIIll1lll1['endinfo'];
$IIIIIIIIIl11['endimg']  = empty($IIIIIll1lll1['endpicurl']) ?1 : $IIIIIll1lll1['endpicurl'];
}else{
$IIIII1I1111I=array('token'=>$IIIIIIIIlIlI,'wecha_id'=>$IIIIIlIIIll1,'lid'=>$IIIIIIIII1I1,'islottery'=>1);
$IIIII1I1111l=$IIIII1I11lIl->where($IIIII1I1111I)->count();
$IIIII1I11111=intval($IIIIIll1lll1['maxgetprizenum']);
$IIIII1I11111=$IIIII1I11111?$IIIII1I11111:1;
if ($IIIII1I1111l>=$IIIII1I11111){
$IIIIIIIIIl11['end'] = 3;
if($IIIII1I11111>1){
$IIIIIIIIIl11['msg'] = "您的中奖次数超过了限制次数，不能再中了，谢谢";
}else{
$IIIIIIIIIl11['msg'] = "您已经中过奖了，不能再领取了，谢谢";
}
$IIIIIIIIIl11['wxname']=$IIIIII1llllI['wecha_name'];
$IIIIIIIIIl11['wecha_name']=$IIIIII1llllI['wecha_name'];
$IIIIIIIIIl11['sn']  = $IIIIII1llllI['sn'];
$IIIIIIIIIl11['myprize'] 	= $this->getPrizeName($IIIIIll1lll1,$IIIIII1llllI['prize']);
$IIIIIIIIIl11['prize'] 	= $IIIIII1llllI['prize'];
}else {
if ($IIIIII1llllI['usenums'] >= $IIIIIll1lll1['canrqnums'] ) {
$IIIIIIIIIl11['end'] = -1;
$IIIIIIIIIl11['prizetype'] = 4;
$IIIIIIIIIl11['zjl']	  = 0;
$IIIIIIIIIl11['usenums']  = $IIIIII1llllI['usenums'];
$IIIIIIIIIl11['winprize']	   = "抽奖次数已经用完";
}else{
$IIIIIIIIlI1I=0;
if($IIIIIll1lll1['cyfs']==1){
$IIIIIlIIlll1=date('Y',$IIIIIII111II);
$IIIIIII111Il=date('m',$IIIIIII111II);
$IIIIIlIIl1lI=date('d',$IIIIIII111II);
$IIIII1lIIIII=mktime(0,0,0,$IIIIIII111Il,$IIIIIlIIl1lI,$IIIIIlIIlll1);
$IIIII1lIIIIl=mktime(23,59,59,$IIIIIII111Il,$IIIIIlIIl1lI,$IIIIIlIIlll1);
$IIIII1lIIII1='wecha_id=\''.$IIIIIlIIIll1.'\' AND lid='.$IIIIIIIII1I1.' AND time>'.$IIIII1lIIIII.' AND time<'.$IIIII1lIIIIl;
$IIIII1lIIIlI=$IIIII1I11lIl->where($IIIII1lIIII1)->count();
$IIIII1lIIIlI=intval($IIIII1lIIIlI);
if ($IIIIIll1lll1['daynums']&&$IIIII1lIIIlI>=$IIIIIll1lll1['daynums']){
$IIIIIIIIIl11['end'] = -2;
$IIIIIIIIIl11['zjl']	  = 0;
$IIIIIIIIIl11['winprize']	   = "今天已经抽了".$IIIII1lIIIlI."次了，没名额了，明天再来吧";
}else{$IIIIIIIIlI1I=1;}
}else if($IIIIIll1lll1['cyfs']==2){
$IIIIIIllIlII=M('fusers')->where(array('openid'=>$IIIIIlIIIll1))->find();
if($IIIIIIllIlII['jfnum']>=$IIIIIll1lll1['decjf']){
$IIIIIIIIlI1I=1;
}else{
$IIIIIIIIIl11['end'] = -5;
$IIIIIIIIIl11['zjl']	  = 0;
if($IIIIIIllIlII['jfnum']==0){$IIIIIIIIIl11['winprize']= "您没有积分了，请到投票活动页面投票获取积分后再来参与吧";}else{$IIIIIIIIIl11['winprize']="您所剩积分不够本次抽奖所需积分了，请到到投票活动页面投票获取积分后再来参与吧";}
}
}
if($IIIIIIIIlI1I==1){
$this->IIIII1Ill111->where(array('id'=>$IIIIIIIII1I1))->setInc('joinnum');
if($IIIIIll1lll1['fistlucknums']  == $IIIIIll1lll1['fistnums'] &&
$IIIIIll1lll1['secondlucknums'] == $IIIIIll1lll1['secondnums'] &&
$IIIIIll1lll1['thirdlucknums']  == $IIIIIll1lll1['thirdnums'] &&
$IIIIIll1lll1['fourlucknums']  == $IIIIIll1lll1['fournums'] &&
$IIIIIll1lll1['fivelucknums']  == $IIIIIll1lll1['fivenums'] &&
$IIIIIll1lll1['sixlucknums']  == $IIIIIll1lll1['sixnums']
){
$IIIII1lIIIll=7;
}else{
$IIIII1lIIIl1=M('Lottery_cheat')->where(array('lid'=>$IIIIIIIII1I1,'wecha_id'=>$IIIIIlIIIll1,'isok'=>1,'isuse'=>0))->find();
if ($IIIII1lIIIl1){
$IIIII1lIIIll=intval($IIIII1lIIIl1['prizetype']);
M('Lottery_cheat')->where(array('lid'=>$IIIIIIIII1I1,'wecha_id'=>$IIIIIlIIIll1,'isok'=>1,'isuse'=>0))->save(array('isuse'=>1));
}else {
$IIIII1lIIIll=intval($this->get_prize($IIIIIll1lll1,$IIIIIlIIIll1));
}
}
switch ($IIIII1lIIIll){
default:
$IIIIIIIIIl11['prizetype'] = 7;
$IIIIIIIIIl11['zjl']	  = 0;
$IIIIIIIIIl11['winprize']	   = "谢谢参与";
$IIIII1lIII1I=0;
$IIIIIIIIIl11['sncode']    = '';
break;
case 1:
$IIIIIIIIIl11['prizetype'] = 1;
$IIIIIIIIIl11['sncode'] = uniqid();
$IIIIIIIIIl11['winprize']	   = $IIIIIll1lll1['fist'];
$IIIIIIIIIl11['zjl']	   = 1;
$this->IIIII1Ill111->where(array('id'=>$IIIIIIIII1I1))->setInc('fistlucknums');
$IIIII1lIII1I=1;
break;
case 2:
$IIIIIIIIIl11['prizetype'] = 2;
$IIIIIIIIIl11['winprize']  = $IIIIIll1lll1['second'];
$IIIIIIIIIl11['zjl']	   = 1;
$IIIIIIIIIl11['sncode']    = uniqid();
$this->IIIII1Ill111->where(array('id'=>$IIIIIIIII1I1))->setInc('secondlucknums');
$IIIII1lIII1I=1;
break;
case 3:
$IIIIIIIIIl11['prizetype'] = 3;
$IIIIIIIIIl11['winprize']	   = $IIIIIll1lll1['third'];
$IIIIIIIIIl11['zjl']	   = 1;
$IIIIIIIIIl11['sncode'] = uniqid();
$this->IIIII1Ill111->where(array('id'=>$IIIIIIIII1I1))->setInc('thirdlucknums');
$IIIII1lIII1I=1;
break;
case 4:
$IIIIIIIIIl11['prizetype'] = 4;
$IIIIIIIIIl11['winprize']	   = $IIIIIll1lll1['four'];
$IIIIIIIIIl11['zjl']	   = 1;
$IIIIIIIIIl11['sncode'] = uniqid();
$this->IIIII1Ill111->where(array('id'=>$IIIIIIIII1I1))->setInc('fourlucknums');
$IIIII1lIII1I=1;
break;
case 5:
$IIIIIIIIIl11['prizetype'] = 5;
$IIIIIIIIIl11['winprize']	   = $IIIIIll1lll1['five'];
$IIIIIIIIIl11['zjl']	   = 1;
$IIIIIIIIIl11['sncode'] = uniqid();
$this->IIIII1Ill111->where(array('id'=>$IIIIIIIII1I1))->setInc('fivelucknums');
$IIIII1lIII1I=1;
break;
case 6:
$IIIIIIIIIl11['prizetype'] = 6;
$IIIIIIIIIl11['winprize']	   = $IIIIIll1lll1['six'];
$IIIIIIIIIl11['zjl']	   = 1;
$IIIIIIIIIl11['sncode'] = uniqid();
$this->IIIII1Ill111->where(array('id'=>$IIIIIIIII1I1))->setInc('sixlucknums');
$IIIII1lIII1I=1;
break;
}
$IIIII1lIII1l=array('token'=>$IIIIIIIIlIlI,'lid'=>intval($IIIIIIIII1I1),'wecha_id'=>'','islottery'=>0,'time'=>0,'prize'=>intval($IIIIIIIIIl11['prizetype']));
$IIIIIIl111Il=$this->IIIII1Ill11l->where($IIIII1lIII1l)->find();
if ($IIIII1lIII1I&&$IIIIIIl111Il){
$IIIIIIIIIl11['sncode']=$IIIIIIl111Il['sn'];
$this->IIIII1Ill11l->where(array('sn'=>$IIIIIIIIIl11['sncode'],'lid'=>$IIIIIIIII1I1,'token'=>$IIIIIIIIlIlI))->save(array('wecha_id'=>$IIIIIlIIIll1,'usenums'=>$IIIIII1llllI['usenums'],'islottery'=>$IIIII1lIII1I,'wecha_name'=>'','phone'=>'','sn'=>$IIIIIIIIIl11['sncode'],'time'=>$IIIIIII111II,'sendtime'=>0));
}else {
$this->IIIII1Ill11l->add(array('token'=>$IIIIIIIIlIlI,'wecha_id'=>$IIIIIlIIIll1,'lid'=>$IIIIIIIII1I1,'usenums'=>$IIIIII1llllI['usenums'],'islottery'=>$IIIII1lIII1I,'wecha_name'=>'','phone'=>'','sn'=>$IIIIIIIIIl11['sncode'],'time'=>$IIIIIII111II,'prize'=>intval($IIIIIIIIIl11['prizetype']),'sendtime'=>0));
}
$this->IIIII1Ill11l->where(array('lid'=>$IIIIIIIII1I1,'wecha_id'=>$IIIIIlIIIll1))->setInc('usenums');
if($IIIIIll1lll1['cyfs']==2){
M('fusers')->where(array('openid'=>$IIIIIlIIIll1))->save(array('jfnum'=>$IIIIIIllIlII['jfnum']-$IIIIIll1lll1['decjf']));
}
$IIIIII1llllI['usenums']=intval($IIIIII1llllI['usenums'])+1;
}
}
}
}
$IIIIII1llllI 	= $IIIII1I11lIl->where(array('wecha_id'=>$IIIIIlIIIll1,'islottery'=>1,'lid'=>$IIIIIIIII1I1))->find();
if (!$IIIIII1llllI){
$IIIIII1llllI 	= $IIIII1I11lIl->where(array('wecha_id'=>$IIIIIlIIIll1,'islottery'=>0,'lid'=>$IIIIIIIII1I1))->find();
}
$IIIIIIIIIl11['rid']		= intval($IIIIII1llllI['id']);
$IIIIIIIIIl11['phone']		= $IIIIII1llllI['phone'];
$IIIIIIIIIl11['sn']		= $IIIIII1llllI['sn'];
$IIIIIIIIIl11['usenums']	= $IIIIII1llllI['usenums'];
$IIIIIIIIIl11['sendtime']	= $IIIIII1llllI['sendtime'];
return $IIIIIIIIIl11;
}
protected function get_prize($IIIIIll1lll1,$IIIIIlIIIll1){
$IIIIIIIII1I1=intval($IIIIIll1lll1['id']);
$IIIII1lIIlII=M('Lottery');
$IIIII1lIIlIl=$IIIIIll1lll1['joinnum'];
$IIIII1lIIlI1=intval($IIIIIll1lll1['fistnums'])-intval($IIIIIll1lll1['fistlucknums']);
$IIIII1lIIllI=intval($IIIIIll1lll1['secondnums'])-intval($IIIIIll1lll1['secondlucknums']);
$IIIII1lIIlll=intval($IIIIIll1lll1['thirdnums'])-intval($IIIIIll1lll1['thirdlucknums']);
$IIIII1lIIll1=intval($IIIIIll1lll1['fournums'])-intval($IIIIIll1lll1['fourlucknums']);
$IIIII1lIIl1I=intval($IIIIIll1lll1['fivenums'])-intval($IIIIIll1lll1['fivelucknums']);
$IIIII1lIIl1l=intval($IIIIIll1lll1['sixnums'])-intval($IIIIIll1lll1['sixlucknums']);
$IIIIII1IlI11=intval($IIIIIll1lll1['canrqnums']);
$IIIII1lIIl11 = array(
'0'=>array('id'=>1,'prize'=>'一等奖','v'=>$IIIII1lIIlI1,'start'=>0,'end'=>$IIIII1lIIlI1),
'1'=>array('id'=>2,'prize'=>'二等奖','v'=>$IIIII1lIIllI,'start'=>$IIIII1lIIlI1,'end'=>$IIIII1lIIlI1+$IIIII1lIIllI),
'2'=>array('id'=>3,'prize'=>'三等奖','v'=>$IIIII1lIIlll,'start'=>$IIIII1lIIlI1+$IIIII1lIIllI,'end'=>$IIIII1lIIlI1+$IIIII1lIIllI+$IIIII1lIIlll),
'3'=>array('id'=>4,'prize'=>'四等奖','v'=>$IIIII1lIIll1,'start'=>$IIIII1lIIlI1+$IIIII1lIIllI+$IIIII1lIIlll,'end'=>$IIIII1lIIlI1+$IIIII1lIIllI+$IIIII1lIIlll+$IIIII1lIIll1),
'4'=>array('id'=>5,'prize'=>'五等奖','v'=>$IIIII1lIIl1I,'start'=>$IIIII1lIIlI1+$IIIII1lIIllI+$IIIII1lIIlll+$IIIII1lIIll1,'end'=>$IIIII1lIIlI1+$IIIII1lIIllI+$IIIII1lIIlll+$IIIII1lIIll1+$IIIII1lIIl1I),
'5'=>array('id'=>6,'prize'=>'六等奖','v'=>$IIIII1lIIl1l,'start'=>$IIIII1lIIlI1+$IIIII1lIIllI+$IIIII1lIIlll+$IIIII1lIIll1+$IIIII1lIIl1I,'end'=>$IIIII1lIIlI1+$IIIII1lIIllI+$IIIII1lIIlll+$IIIII1lIIll1+$IIIII1lIIl1I+$IIIII1lIIl1l),
'6'=>array('id'=>7,'prize'=>'谢谢参与','v'=>(intval($IIIIIll1lll1['allpeople']))*$IIIIII1IlI11-($IIIII1lIIlI1+$IIIII1lIIllI+$IIIII1lIIlll+$IIIII1lIIll1+$IIIII1lIIl1I+$IIIII1lIIl1l),'start'=>$IIIII1lIIlI1+$IIIII1lIIllI+$IIIII1lIIlll+$IIIII1lIIll1+$IIIII1lIIl1I+$IIIII1lIIl1l,'end'=>intval($IIIIIll1lll1['allpeople'])*$IIIIII1IlI11)
);
foreach ($IIIII1lIIl11 as $IIIIIIIlI11I =>$IIIIIIl1llIl) {
$IIIIIIIlII1l[$IIIIIIl1llIl['id']] = $IIIIIIl1llIl;
}
if ($IIIIIll1lll1['allpeople'] == 1) {
if ($IIIIIll1lll1['fistlucknums'] <= $IIIIIll1lll1['fistnums']) {
$IIIII1lII1II = 1;
}else{
$IIIII1lII1II = 7;
}
}else{
$IIIII1lII1II = $this->get_rand($IIIIIIIlII1l,(intval($IIIIIll1lll1['allpeople'])*$IIIIII1IlI11)-$IIIII1lIIlIl);
}
switch($IIIII1lII1II){
case 1:
if ($IIIIIll1lll1['fistlucknums'] >= $IIIIIll1lll1['fistnums']) {
$IIIII1lII1II = '';
}else{
$IIIII1lII1II = 1;
}
break;
case 2:
if ($IIIIIll1lll1['secondlucknums'] >= $IIIIIll1lll1['secondnums']) {
$IIIII1lII1II = '';
}else{
if(empty($IIIIIll1lll1['second']) &&empty($IIIIIll1lll1['secondnums'])){
$IIIII1lII1II = '';
}else{
$IIIII1lII1II = 2;
}
}
break;
case 3:
if ($IIIIIll1lll1['thirdlucknums'] >= $IIIIIll1lll1['thirdnums']) {
$IIIII1lII1II = '';
}else{
if(empty($IIIIIll1lll1['third']) &&empty($IIIIIll1lll1['thirdnums'])){
$IIIII1lII1II = '';
}else{
$IIIII1lII1II = 3;
}
}
break;
case 4:
if ($IIIIIll1lll1['fourlucknums'] >= $IIIIIll1lll1['fournums']) {
$IIIII1lII1II =  '';
}else{
if(empty($IIIIIll1lll1['four']) &&empty($IIIIIll1lll1['fournums'])){
$IIIII1lII1II =  '';
}else{
$IIIII1lII1II = 4;
}
}
break;
case 5:
if ($IIIIIll1lll1['fivelucknums'] >= $IIIIIll1lll1['fivenums']) {
$IIIII1lII1II =  '';
}else{
if(empty($IIIIIll1lll1['five']) &&empty($IIIIIll1lll1['fivenums'])){
$IIIII1lII1II =  '';
}else{
$IIIII1lII1II = 5;
}
}
break;
case 6:
if ($IIIIIll1lll1['sixlucknums'] >= $IIIIIll1lll1['sixnums']) {
$IIIII1lII1II =  '';
}else{
if(empty($IIIIIll1lll1['six']) &&empty($IIIIIll1lll1['sixnums'])){
$IIIII1lII1II =  '';
}else{
$IIIII1lII1II = 6;
}
}
break;
default:
$IIIII1lII1II =  '';
break;
}
return $IIIII1lII1II;
}
public function add(){
$this->IIIII1Ill11l=M('Lottery_record');
$this->IIIII1Ill111=M('Lottery');
if($_POST['action'] ==  'add'){
$IIIII1lII1l1 				= intval($this->_post('lid'));
$IIIII1lII11I 			= $this->IIIIIlIIIll1;
if (!$IIIII1lII11I){
$IIIII1lII11I=$this->_post('wechaid');
}
$IIIIIIIIIl11['phone'] 		= $this->_post('tel');
$IIIIIIIIIl11['wecha_name'] = $this->_post('wxname');
$IIIIII1llI11=intval($this->_post('rid'));
$IIIII1lII11l=$this->IIIII1Ill11l->where(array('lid'=>$IIIII1lII1l1,'wecha_id'=>$IIIII1lII11I,'islottery'=>1))->find();
$IIIIII1llI11=$IIIII1lII11l['id'];
$IIIII1lII111 = $this->IIIII1Ill11l->where(array('lid'=>$IIIII1lII1l1,
'wecha_id'=>$IIIII1lII11I,'id'=>$IIIIII1llI11))->save($IIIIIIIIIl11);
$IIIIII1llllI=$IIIII1lII11l;
echo'{"success":1,"msg":"恭喜！尊敬的<font color=red>'.$IIIIIIIIIl11['wecha_name'].'</font>请您保持手机通畅！你的领奖序号:<font color=red>'.$IIIIII1llllI['sn'].'</font>"}';
exit;
}
}
public function exchange(){
$this->IIIII1Ill11l=M('Lottery_record');
$this->IIIII1Ill111=M('Lottery');
if(IS_POST){
$IIIIIll1lll1 	= $this->IIIII1Ill111->where(array('id'=>intval($_POST['id'])))->find();
if ($IIIIIll1lll1['parssword']!=trim($this->_post('parssword'))){
echo'{"success":0,"msg":"兑奖密码不正确"}';exit;
}else {
$IIIIIIIIIl11['sendtime']		= time();
$IIIIIIIIIl11['sendstutas']	= 1;
$this->IIIII1Ill11l->where(array('id'=>intval($_POST['rid'])))->save($IIIIIIIIIl11);
echo'{"success":1,"msg":"兑奖成功","changed":1}';
}
}
}
function getPrizeName($IIIIIll1lll1,$IIIII1lII1II){
switch ($IIIII1lII1II){
default:
return $IIIII1lII1II;
break;
case 1:
return $IIIIIll1lll1['fist'];
break;
case 2:
return $IIIIIll1lll1['second'];
break;
case 3:
return $IIIIIll1lll1['third'];
break;
case 4:
return $IIIIIll1lll1['four'];
break;
case 5:
return $IIIIIll1lll1['five'];
break;
case 6:
return $IIIIIll1lll1['six'];
break;
}
}
}
?>