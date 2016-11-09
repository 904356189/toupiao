<?php

class ResearchAction extends LotteryBaseAction{
public $IIIIIIIIlIlI;
public $IIIIIlIIIll1 = '';
public $IIIII1lIllII = 0;
public $IIIII1lIllIl;
public function __construct(){
parent :: __construct();
$IIIII1Ill1II = $_SERVER['HTTP_USER_AGENT'];
if (!strpos($IIIII1Ill1II,"MicroMessenger")){
}
$this ->IIIIIIIIlIlI = isset($_REQUEST['token']) ?htmlspecialchars($_REQUEST['token']) : '';
$this ->assign('token',$this ->IIIIIIIIlIlI);
$this ->IIIIIlIIIll1 = isset($_REQUEST['wecha_id']) ?$_REQUEST['wecha_id'] : '';
$this ->assign('wecha_id',$this ->IIIIIlIIIll1);
$this ->IIIII1lIllII = isset($_REQUEST['reid']) ?intval($_REQUEST['reid']) : 0;
if ($this ->IIIII1lIllIl = M('Research') ->where(array('id'=>$this ->IIIII1lIllII,'token'=>$this ->IIIIIIIIlIlI)) ->find()){
$this ->assign('research',$this ->IIIII1lIllIl);
$this ->assign('rid',$this ->IIIII1lIllII);
}else{
exit('调研不存在');
}
}
public function index(){
$IIIIIII11I11 = 0;
if ($this ->IIIII1lIllIl['starttime'] >time()){
$IIIIIII11I11 = 1;
}elseif ($this ->IIIII1lIllIl['endtime'] <time()){
$IIIIIII11I11 = 2;
}else{
$IIIII1lIllI1 = M('Research_result') ->where(array('rid'=>$this ->IIIII1lIllII,'wecha_id'=>$this ->IIIIIlIIIll1)) ->count();
$IIIII1lIlllI = M('Research_question') ->where(array('rid'=>$this ->IIIII1lIllII)) ->count();
if ($IIIII1lIllI1 >= $IIIII1lIlllI){
$IIIIIII11I11 = 3;
}
}
$this ->assign('status',$IIIIIII11I11);
$this ->assign('metaTitle','微调研');
$this ->display();
}
public function answer(){
$IIIII1lIlll1 = M('Research_result') ->where(array('rid'=>$this ->IIIII1lIllII,'wecha_id'=>$this ->IIIIIlIIIll1)) ->order('id asc') ->select();
$IIIIIlII1IlI = array();
foreach ($IIIII1lIlll1 as $IIIIII1ll11I){
$IIIIIlII1IlI[] = $IIIIII1ll11I['qid'];
}
if (IS_POST){
$IIIIIlII1lIl = isset($_POST['qid']) ?intval($_POST['qid']) : 0;
$IIIIIlII1Ill = isset($_POST['answers']) ?htmlspecialchars($_POST['answers']) : '';
if (empty($IIIIIlII1lIl) ||empty($IIIIIlII1Ill) ||empty($this ->IIIII1lIllII)){
exit(json_encode(array('error_code'=>true,'msg'=>'不合法的操作')));
}
if (empty($IIIIIlII1IlI)){
M('Research') ->where(array('id'=>$this ->IIIII1lIllII,'token'=>$this ->IIIIIIIIlIlI)) ->setInc('nums',1);
}
$IIIIIIIIIl11 = array('qid'=>$IIIIIlII1lIl,'wecha_id'=>$this ->IIIIIlIIIll1,'rid'=>$this ->IIIII1lIllII,'aids'=>$IIIIIlII1Ill);
if ($IIIIII1ll11I = D('Research_result') ->add($IIIIIIIIIl11)){
$IIIIIlII1Ill = explode(",",$IIIIIlII1Ill);
M('Research_answer') ->where(array('id'=>array('in',$IIIIIlII1Ill),'qid'=>$IIIIIlII1lIl)) ->setInc('nums',1);
exit(json_encode(array('error_code'=>false,'msg'=>'ok')));
}
}
$IIIII1lIll1I = array();
$IIIIII11I111 = M('Research_question') ->where(array('rid'=>$this ->IIIII1lIllII)) ->order('id asc') ->select();
foreach ($IIIIII11I111 as $IIIIIlII1I1l){
if (!in_array($IIIIIlII1I1l['id'],$IIIIIlII1IlI)){
$IIIII1lIll1I = $IIIIIlII1I1l;
break;
}
}
if (empty($IIIII1lIll1I)){
$this ->success("参加完毕，现在进行自动抽奖",U("Research/lotter",array('reid'=>$this ->IIIII1lIllII,'wecha_id'=>$this ->IIIIIlIIIll1,'token'=>$this ->IIIIIIIIlIlI)));
}
$IIIII1lIll1l = M('Research_answer') ->where(array('qid'=>$IIIII1lIll1I['id'])) ->order('id asc') ->select();
$IIIII1lIll11 = $IIIII1lIll1I['type'] ?count($IIIII1lIll1l) : 1;
$this ->assign('question',$IIIII1lIll1I);
$this ->assign('maxsel',$IIIII1lIll11);
$this ->assign('answer',$IIIII1lIll1l);
$this ->assign('metaTitle',$IIIII1lIll1I['name']);
$this ->display();
}
public function detail(){
$IIIII1lIl1Il = isset($_GET['nextqid']) ?intval($_GET['nextqid']) : 0;
$IIIII1lIll1I = array();
if ($IIIII1lIl1Il){
$IIIIII11I111 = M('Research_question') ->where(array('rid'=>$this ->IIIII1lIllII,'id'=>array('egt',$IIIII1lIl1Il))) ->order('id asc') ->limit(2) ->select();
$IIIII1lIll1I = $IIIIII11I111[0];
$IIIII1lIl1Il = isset($IIIIII11I111[1]['id']) ?$IIIIII11I111[1]['id'] : 0;
}else{
$IIIIII11I111 = M('Research_question') ->where(array('rid'=>$this ->IIIII1lIllII)) ->order('id asc') ->limit(2) ->select();
$IIIII1lIll1I = $IIIIII11I111[0];
$IIIII1lIl1Il = isset($IIIIII11I111[1]['id']) ?$IIIIII11I111[1]['id'] : 0;
}
if ($IIIII1lIll1I){
$IIIII1lIll1l = M('Research_answer') ->where(array('qid'=>$IIIII1lIll1I['id'])) ->order('id asc') ->select();
$IIIII1lIlll1 = M('Research_result') ->where(array('qid'=>$IIIII1lIll1I['id'],'wecha_id'=>$this ->IIIIIlIIIll1)) ->find();
$IIIIIlII1Ill = array();
if (isset($IIIII1lIlll1['aids']) &&$IIIII1lIlll1['aids']){
$IIIIIlII1Ill = explode(",",$IIIII1lIlll1['aids']);
}
foreach ($IIIII1lIll1l as &$IIIIIIl11lll){
$IIIIIIl11lll['select'] = 0;
if (in_array($IIIIIIl11lll['id'],$IIIIIlII1Ill)){
$IIIIIIl11lll['select'] = 1;
}
}
}
$IIIII1lIll11 = $IIIII1lIll1I['type'] ?count($IIIII1lIll1l) : 1;
$this ->assign('question',$IIIII1lIll1I);
$this ->assign('nextqid',$IIIII1lIl1Il);
$this ->assign('maxsel',$IIIII1lIll11);
$this ->assign('answer',$IIIII1lIll1l);
$this ->assign('metaTitle',$IIIII1lIll1I['name']);
$this ->display();
}
public function lotter(){
$IIIII1Ill1II = $_SERVER['HTTP_USER_AGENT'];
if(!strpos($IIIII1Ill1II,"icroMessenger")){
}
$IIIII1lIll1I = $IIIIIlII1IlI = array();
$IIIII1lIl1lI = M('Research_result') ->where(array('rid'=>$this ->IIIII1lIllII,'wecha_id'=>$this ->IIIIIlIIIll1)) ->count();
$IIIII1lIl1ll = M('Research_question') ->where(array('rid'=>$this ->IIIII1lIllII)) ->count();
if ($IIIII1lIl1lI <$IIIII1lIl1ll){
$this ->redirect(U("Research/index",array('reid'=>$this ->IIIII1lIllII,'wecha_id'=>$this ->IIIIIlIIIll1,'token'=>$this ->IIIIIIIIlIlI)));
}
$IIIIIIIIlIlI = $this ->IIIIIIIIlIlI;
$IIIIIlIIIll1 = $this ->IIIIIlIIIll1;
$IIIIIIIII1I1 = $this ->IIIII1lIllIl['lid'];
if (empty($IIIIIIIII1I1)){
$this ->redirect(U("Research/index",array('reid'=>$this ->IIIII1lIllII,'wecha_id'=>$this ->IIIIIlIIIll1,'token'=>$this ->IIIIIIIIlIlI)));
}
$IIIII1I11lIl = M('Lottery_record');
$IIIIIIIIlIl1 = array('token'=>$IIIIIIIIlIlI,'wecha_id'=>$IIIIIlIIIll1,'lid'=>$IIIIIIIII1I1);
$IIIIII1llllI = $IIIII1I11lIl ->where(array('token'=>$IIIIIIIIlIlI,'wecha_id'=>$IIIIIlIIIll1,'lid'=>$IIIIIIIII1I1,'islottery'=>1)) ->find();
if (!$IIIIII1llllI){
$IIIIII1llllI = $IIIII1I11lIl ->where($IIIIIIIIlIl1) ->order('id DESC') ->find();
}
if (!$IIIIII1llllI){
$IIIIII1llllI['id'] = 0;
$IIIIII1llllI['lid'] = $IIIIIIIII1I1;
}
$IIIIII1llllI['wecha_id'] = $IIIIIlIIIll1;
$this ->assign('record',$IIIIII1llllI);
$IIIIIll1lll1 = M('Lottery') ->where(array('id'=>$IIIIIIIII1I1,'token'=>$IIIIIIIIlIlI,'type'=>6)) ->find();
if ($this ->IIIIIlIIIll1 &&!$this ->IIIIIlll1IIl &&$IIIIIll1lll1['needreg']){
$this ->error('请先完善个人资料再参加活动',U('Userinfo/index',array('token'=>$this ->IIIIIIIIlIlI,'wecha_id'=>$this ->IIIIIlIIIll1,'redirect'=>MODULE_NAME .'/index|id:'.intval($IIIIIIIII1I1))));
}
$IIIIIll1lll1['renametel'] = $IIIIIll1lll1['renametel']?$IIIIIll1lll1['renametel']:'手机号';
$IIIIIll1lll1['renamesn'] = $IIIIIll1lll1['renamesn']?$IIIIIll1lll1['renamesn']:'SN码';
$IIIIIIIIIl11 = $IIIIIll1lll1;
$IIIIIIIIIl11['info'] = nl2br($IIIIIIIIIl11['info']);
$IIIIIIIIIl11['endinfo'] = nl2br($IIIIIIIIIl11['endinfo']);
$IIIIIIIIIl11['info'] = str_replace('&lt;br&gt;','<br>',$IIIIIIIIIl11['info']);
$IIIIIIIIIl11['endinfo'] = str_replace('&lt;br&gt;','<br>',$IIIIIIIIIl11['endinfo']);
$this ->assign('Research',$IIIIIIIIIl11);
$IIIIIIIlll1I = $this ->prizeHandle($IIIIIIIIlIlI,$IIIIIlIIIll1,$IIIIIll1lll1);
if ($IIIIIIIlll1I['end'] == 2){
$IIIIIIIIIl11['usenums'] = 3;
$IIIIIIIIIl11['endinfo'] = $IIIIIll1lll1['endinfo'];
$this ->assign('Research',$IIIIIIIIIl11);
$this ->display();
exit();
}
if ($IIIIIIIlll1I['end'] == 3){
$IIIIIIIIIl11['usenums'] = 2;
$IIIIIIIIIl11['sncode'] = $IIIIII1llllI['sn'];
$IIIIIIIIIl11['uname'] = $IIIIII1llllI['wecha_name'];
$IIIIIIIIIl11['winprize'] = $this ->getPrizeName($IIIIIll1lll1,$IIIIII1llllI['prize']);
}else{
if ($IIIIIIIlll1I['end'] == -1){
$IIIIIIIIIl11['usenums'] = 1;
$IIIIIIIIIl11['winprize'] = '抽奖次数已用完';
}elseif ($IIIIIIIlll1I['end'] == -2){
$IIIIIIIIIl11['usenums'] = 1;
$IIIIIIIIIl11['winprize'] = '当天次数已用完';
}else{
$IIIIIIIIIl11['zjl'] = $IIIIIIIlll1I['zjl'];
$IIIIIIIIIl11['wecha_id'] = $IIIIIlIIIll1;
$IIIIIIIIIl11['lid'] = $IIIIIIIII1I1;
$IIIIIIIIIl11['winprize'] = $this ->getPrizeName($IIIIIll1lll1,$IIIIIIIlll1I['winprize']);
}
}
$IIIIIIIIIl11['usecout'] = intval($IIIIII1llllI['usenums']);
$IIIIIIIIIl11['zjl'] = isset($IIIIIIIIIl11['zjl']) ?$IIIIIIIIIl11['zjl'] : 0;
$this ->assign('Research',$IIIIIIIIIl11);
$IIIII1lIl1l1 = '<p>一等奖: '.$IIIIIll1lll1['fist'];
if ($IIIIIll1lll1['displayjpnums']){
$IIIII1lIl1l1 .= '奖品数量:'.$IIIIIll1lll1['fistnums'];
}
$IIIII1lIl1l1 .= '</p>';
if ($IIIIIll1lll1['second']){
$IIIII1lIl1l1 .= '<p>二等奖: '.$IIIIIll1lll1['second'];
if ($IIIIIll1lll1['displayjpnums']){
$IIIII1lIl1l1 .= '奖品数量:'.$IIIIIll1lll1['secondnums'];
}
$IIIII1lIl1l1 .= '</p>';
}
if ($IIIIIll1lll1['third']){
$IIIII1lIl1l1 .= '<p>三等奖: '.$IIIIIll1lll1['third'];
if ($IIIIIll1lll1['displayjpnums']){
$IIIII1lIl1l1 .= '奖品数量:'.$IIIIIll1lll1['thirdnums'];
}
$IIIII1lIl1l1 .= '</p>';
}
$this ->assign('prizeStr',$IIIII1lIl1l1);
$this ->display();
}
}
?>