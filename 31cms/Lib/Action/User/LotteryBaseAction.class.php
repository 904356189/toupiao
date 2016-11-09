<?php

class LotteryBaseAction extends UserAction{
public function index($IIIIIIlIllIl){
if(session('gid')==1){
}
$IIIIIIl11l11=$this->IIIIIl1IlI11;
$this->assign('group',$IIIIIIl11l11);
$this->assign('activitynum',intval($this->IIIIIIIIII1I['activitynum']));
$IIIIIIIIlIl1=array('token'=>session('token'),'type'=>$IIIIIIlIllIl);
$IIIIIIIII1I1 = isset($_GET['id']) ?intval($_GET['id']) : 0;
if ($IIIIIIIII1I1 &&$IIIIIIlIllIl == 6) {
$IIIIIIIIlIl1['id'] = $IIIIIIIII1I1;
}
$IIIIIIIIlIII=M('Lottery')->where($IIIIIIIIlIl1)->select();
if ($IIIIIIlIllIl == 8 ||$IIIIIIlIllIl == 7 ||$IIIIIIlIllIl == 9 ||$IIIIIIlIllIl == 10) {
foreach($IIIIIIIIlIII as $IIIIIIIlI11I=>$IIIIIIl1llIl){
$IIIIIIIIlIII[$IIIIIIIlI11I]['joinnum'] = M('Lottery_record')->where(array('token'=>session('token'),'type'=>$IIIIIIlIllIl,'lid'=>$IIIIIIl1llIl['id']))->count();
}
}
$this->assign('count',M('Lottery')->where($IIIIIIIIlIl1)->count());
$this->assign('list',$IIIIIIIIlIII);
}
public function add($IIIIIIlIllIl){
switch ($IIIIIIlIllIl){
case 1:
$IIIIII1llI1l='Lottery';
break;
case 2:
$IIIIII1llI1l='Guajiang';
break;
case 3:
$IIIIII1llI1l='Coupon';
break;
case 4:
$IIIIII1llI1l='LuckyFruit';
break;
case 5:
$IIIIII1llI1l='GoldenEgg';
break;
case 6:
$IIIIII1llI1l='Research';
break;
case 7:
$IIIIII1llI1l='AppleGame';
break;
case 8:
$IIIIII1llI1l='Lovers';
break;
case 9:
$IIIIII1llI1l='Autumn';
break;
case 10:
$IIIIII1llI1l='Jiugong';
break;
}
if(IS_POST){
$IIIIIIIIIl11=D('lottery');
$_POST['statdate']=strtotime($this->_post('statdate'));
$_POST['enddate']=strtotime($this->_post('enddate'));
$_POST['token']=$this->IIIIIIIIlIlI;
$_POST['type']=$IIIIIIlIllIl;
if($_POST['enddate'] <$_POST['statdate']){
$this->error('结束时间不能小于开始时间');
}else{
if($IIIIIIIIIl11->create()!=false){
if($IIIIIIIII1I1=$IIIIIIIIIl11->add()){
$IIIIIIllllI1['pid']=$IIIIIIIII1I1;
$IIIIIIllllI1['module']='Lottery';
$IIIIIIllllI1['token']=$this->IIIIIIIIlIlI;
$IIIIIIllllI1['keyword']=$this->_post('keyword');
$IIIIIIIIlI1I = M('keyword')->add($IIIIIIllllI1);
if ($_POST['statdate']<time()){
$this->_start($IIIIIIIII1I1);
}
$IIIIII1llI11 = isset($_POST['researchid']) ?intval($_POST['researchid']) : 0;
if ($IIIIIIlIllIl == 6 &&$IIIIII1llI11) {
M('Research')->where(array('id'=>$IIIIII1llI11))->save(array('lid'=>$IIIIIIIII1I1));
$this->success('活设置成功',U($IIIIII1llI1l.'/index'));
}else {
$this->success('活动创建成功',U($IIIIII1llI1l.'/index'));
}
}else{
$this->error('服务器繁忙,请稍候再试');
}
}else{
$this->error($IIIIIIIIIl11->getError());
}
}
}else{
$IIIIIII111II=time();
$IIIIII1lllII['statdate']=$IIIIIII111II;
$IIIIII1lllII['enddate']=$IIIIIII111II+30*24*3600;
$IIIIII1lllII['cyfs']=2;
$this->assign('vo',$IIIIII1lllII);
$this->display();
}
}
public function edit($IIIIIIlIllIl){
switch ($IIIIIIlIllIl){
case 1:
$IIIIII1llI1l='Lottery';
break;
case 2:
$IIIIII1llI1l='Guajiang';
break;
case 3:
$IIIIII1llI1l='Coupon';
break;
case 4:
$IIIIII1llI1l='LuckyFruit';
break;
case 5:
$IIIIII1llI1l='GoldenEgg';
break;
case 6:
$IIIIII1llI1l='Research';
break;
case 7:
$IIIIII1llI1l='AppleGame';
break;
case 8:
$IIIIII1llI1l='Lovers';
break;
case 9:
$IIIIII1llI1l='Autumn';
break;
case 10:
$IIIIII1llI1l='Jiugong';
break;
}
if(IS_POST){
$IIIIIIIIIl11=D('Lottery');
$_POST['id']=$this->_get('id');
$_POST['token']=session('token');
$_POST['statdate']=strtotime($_POST['statdate']);
$_POST['enddate']=strtotime($_POST['enddate']);
if($_POST['enddate'] <$_POST['statdate']){
$this->error('结束时间不能小于开始时间');
}else{
$IIIIIIIIlIl1=array('id'=>$_POST['id'],'token'=>$_POST['token'],'type'=>$IIIIIIlIllIl);
$IIIIIIl111Il=$IIIIIIIIIl11->where($IIIIIIIIlIl1)->find();
if($IIIIIIl111Il==false)$this->error('非法操作');
if($IIIIIIIIIl11->where($IIIIIIIIlIl1)->save($_POST)){
$IIIIIIllllI1['pid']=$_POST['id'];
$IIIIIIllllI1['module']='Lottery';
$IIIIIIllllI1['token']=$this->IIIIIIIIlIlI;
$IIIIIIllllI1['keyword']=$_POST['keyword'];
$IIIIIIIIlI1I = M('keyword')->where(array('id'=>$_POST['id']))->save($IIIIIIllllI1);
$this->success('修改成功',U($IIIIII1llI1l.'/index',array('token'=>session('token'))));
}else{
$this->error('操作失败');
}
}
}else{
$IIIIIIIII1I1=$this->_get('id');
$IIIIIIIIlIl1=array('id'=>$IIIIIIIII1I1,'token'=>session('token'));
$IIIIIIIIIl11=M('Lottery');
$IIIIIIl111Il=$IIIIIIIIIl11->where($IIIIIIIIlIl1)->find();
if($IIIIIIl111Il==false)$this->error('非法操作');
$IIIIII1lllII=$IIIIIIIIIl11->where($IIIIIIIIlIl1)->find();
$this->assign('vo',$IIIIII1lllII);
$this->display('add');
}
}
public function cheat(){
$IIIIIIIII1I1=intval($_GET['id']);
$IIIIIIIIlIl1=array('id'=>$IIIIIIIII1I1,'token'=>$this->IIIIIIIIlIlI);
$IIIIIIlI11lI=M('Lottery')->where($IIIIIIIIlIl1)->find();
$this->assign('thisLottery',$IIIIIIlI11lI);
$IIIIII1lllIl=M('Lottery_cheat')->where(array('lid'=>$IIIIIIlI11lI['id']))->order('prizetype asc')->select();
$this->assign('records',$IIIIII1lllIl);
}
public function okCheat(){
$IIIIII1llllI=M('Lottery_cheat')->where(array('id'=>intval($_GET['id'])))->find();
$IIIIIIlI11lI=M('Lottery')->where(array('id'=>$IIIIII1llllI['lid']))->find();
if ($IIIIIIlI11lI['token']!=$this->IIIIIIIIlIlI){
$this->error('非法操作');
}else{
$IIIIIIIIlI1I=M('Lottery_cheat')->where(array('id'=>intval($IIIIII1llllI['id'])))->save(array('isok'=>1));
if($IIIIIIIIlI1I){$this->success('确认成功');}else{$this->error('确认失败');}
}
}
public function deleteCheat(){
$IIIIII1llllI=M('Lottery_cheat')->where(array('id'=>intval($_GET['id'])))->find();
$IIIIIIlI11lI=M('Lottery')->where(array('id'=>$IIIIII1llllI['lid']))->find();
if ($IIIIIIlI11lI['token']!=$this->IIIIIIIIlIlI){
$this->error('非法操作');
}else{
M('Lottery_cheat')->where(array('id'=>intval($IIIIII1llllI['id'])))->delete();
$this->success('删除成功');
}
}
public function sn($IIIIIIlIllIl){
$IIIIII1llll1=M('Lottery_record');
$IIIIIIIII1I1=intval($this->_get('id'));
$IIIIIIIIIl11=M('Lottery')->where(array('token'=>$this->IIIIIIIIlIlI,'id'=>$IIIIIIIII1I1,'type'=>$IIIIIIlIllIl))->find();
$this->assign('thisLottery',$IIIIIIIIIl11);
$IIIIII1lll1I='token="'.$this->IIIIIIIIlIlI.'" and islottery=1 and lid='.$IIIIIIIII1I1;
$IIIIIIIII1ll 	= $IIIIII1llll1->where($IIIIII1lll1I)->count();
$IIIIIIIII11I 	= new Page($IIIIIIIII1ll,20);
$this->assign('page',$IIIIIIIII11I->show());
$IIIIII1lll1l 	= $IIIIII1llll1->where($IIIIII1lll1I)->order('time desc')->limit($IIIIIIIII11I->firstRow.','.$IIIIIIIII11I->listRows)->select();
$IIIIII1lll11 = array();
$IIIIII1ll1II = array();
$IIIIII1ll1Il = M("userinfo");
foreach($IIIIII1lll1l as $IIIIIIIllIll =>$IIIIIIlIllII){
$IIIIII1llllI[$IIIIIIIllIll] = $IIIIIIlIllII;
$IIIIII1ll1I1['wecha_id'] = $IIIIIIlIllII['wecha_id'];
$IIIIII1ll1II[$IIIIIIlIllII['id']] = $IIIIII1ll1Il->where($IIIIII1ll1I1)->getField("tel");
$IIIIII1lll11[] = $IIIIIIlIllII['wecha_id'];
}
$IIIIII1ll1lI=$IIIIIIIIIl11['fistlucknums']+$IIIIIIIIIl11['secondlucknums']+$IIIIIIIIIl11['thirdlucknums']+$IIIIIIIIIl11['fourlucknums']+$IIIIIIIIIl11['fivelucknums']+$IIIIIIIIIl11['sixlucknums'];
$IIIIII1ll1ll=$IIIIIIIIIl11['fistnums']+$IIIIIIIIIl11['secondnums']+$IIIIIIIIIl11['thirdnums']+$IIIIIIIIIl11['fournums']+$IIIIIIIIIl11['fivenums']+$IIIIIIIIIl11['sixnums'];
$IIIIII1ll1l1=$IIIIII1llll1->where(array('lid'=>$IIIIIIIII1I1,'sendstutas'=>1,'islottery'=>1))->count();
$this->assign('sendCount',$IIIIII1ll1l1);
$this->assign('datacount',$IIIIII1ll1ll);
$this->assign('recordcount',$IIIIII1ll1lI);
$this->assign('phone',$IIIIII1ll1II);
if ($IIIIII1llllI){
$IIIIIIIllI11=0;
foreach ($IIIIII1llllI as $IIIIII1ll11I){
switch (intval($IIIIII1ll11I['prizetype'])){
default:
$IIIIII1llllI[$IIIIIIIllI11]['prizeName']=$IIIIII1ll11I['prize'];
break;
case 1:
$IIIIII1llllI[$IIIIIIIllI11]['prizeName']=$IIIIIIIIIl11['fist'];
break;
case 2:
$IIIIII1llllI[$IIIIIIIllI11]['prizeName']=$IIIIIIIIIl11['second'];
break;
case 3:
$IIIIII1llllI[$IIIIIIIllI11]['prizeName']=$IIIIIIIIIl11['third'];
break;
case 4:
$IIIIII1llllI[$IIIIIIIllI11]['prizeName']=$IIIIIIIIIl11['four'];
break;
case 5:
$IIIIII1llllI[$IIIIIIIllI11]['prizeName']=$IIIIIIIIIl11['five'];
break;
case 6:
$IIIIII1llllI[$IIIIIIIllI11]['prizeName']=$IIIIIIIIIl11['six'];
break;
case 7:
$IIIIII1llI1l='AppleGame';
break;
case 8:
$IIIIII1llI1l='Lovers';
break;
case 9:
$IIIIII1llI1l='Autumn';
break;
case 10:
$IIIIII1llI1l='Jiugong';
break;
}
$IIIIIIIllI11++;
}
}
$this->assign('record',$IIIIII1llllI);
}
public function sendnull(){
$IIIIIIIII1I1=intval($this->_get('id'));
$IIIIIIIIlIl1=array('id'=>$IIIIIIIII1I1,'token'=>$this->IIIIIIIIlIlI);
$IIIIIIIIIl11['sendtime'] = '';
$IIIIIIIIIl11['sendstutas'] = 0;
$IIIIIIIlIIIl = M('Lottery_record')->where($IIIIIIIIlIl1)->save($IIIIIIIIIl11);
if($IIIIIIIlIIIl==true){
$this->success('已经取消');
}else{
$this->error('操作失败');
}
}
public function sendprize(){
$IIIIIIIII1I1=$this->_get('id');
$IIIIIIIIlIl1=array('id'=>$IIIIIIIII1I1,'token'=>$this->IIIIIIIIlIlI);
$IIIIIIIIIl11['sendtime'] = time();
$IIIIIIIIIl11['sendstutas'] = 1;
$IIIIIIIlIIIl = M('Lottery_record')->where($IIIIIIIIlIl1)->save($IIIIIIIIIl11);
if($IIIIIIIlIIIl==true){
$this->success('操作成功');
}else{
$this->error('操作失败');
}
}
public function endLottery(){
$IIIIIIIII1I1=intval($this->_get('id'));
$IIIIIIIIlIl1=array('id'=>$IIIIIIIII1I1,'token'=>$this->IIIIIIIIlIlI);
$IIIIIIIIIl11=M('Lottery')->where($IIIIIIIIlIl1)->save(array('status'=>0));
if($IIIIIIIIIl11!=false){
M('Users')->where(array('uid'=>$this->IIIIIIIIII1I['id']))->setDec('activitynum');
$this->success('活动已结束');
}else{
$this->error('服务器繁忙,请稍候再试');
}
}
public function startLottery(){
$IIIIIIIII1I1=$this->_get('id');
$IIIIIIIIlIl1=array('id'=>$IIIIIIIII1I1,'token'=>$this->IIIIIIIIlIlI);
$IIIIIIIIIl11=M('Lottery')->where($IIIIIIIIlIl1)->save(array('status'=>1));
if ($IIIIIIIIIl11){
$this->success('活动已经开始');
}else {
$this->error('启用失败');
}
}
public function _start($IIIIIIIII1I1){
$IIIIII1l1IlI=0;
$IIIIIIIIlIl1=array('id'=>$IIIIIIIII1I1,'token'=>$this->IIIIIIIIlIlI);
$IIIIIIIIII1I=M('Users')->field('gid,activitynum')->where(array('id'=>session('uid')))->find();
$IIIIIIl11l11=$this->IIIIIl1IlI11;
if($IIIIIIIIII1I['activitynum']>=$IIIIIIl11l11['activitynum']){
$IIIIII1l1IlI=-1;
return $IIIIII1l1IlI;
}
$IIIIIIIIIl11=M('Lottery')->where($IIIIIIIIlIl1)->save(array('status'=>1));
M('Users')->where(array('id'=>session('uid')))->setInc('activitynum');
if($IIIIIIIIIl11!=false){
return 1;
}else{
$IIIIII1l1IlI=-2;
}
return $IIIIII1l1IlI;
}
public function del(){
$IIIIIIIII1I1=intval($this->_get('id'));
$IIIIIIIIlIl1=array('id'=>$IIIIIIIII1I1,'token'=>$this->IIIIIIIIlIlI);
$IIIIIIIIIl11=M('Lottery');
$IIIIIIl111Il=$IIIIIIIIIl11->where($IIIIIIIIlIl1)->find();
if($IIIIIIl111Il==false)$this->error('非法操作');
$IIIIIIIlIIIl=$IIIIIIIIIl11->where($IIIIII1IIllI)->delete();
if($IIIIIIIlIIIl==true){
M('keyword')->where(array('pid'=>$IIIIIIIII1I1))->delete();
$this->success('删除成功');
}else{
$this->error('操作失败');
}
}
public function snDelete(){
$IIIIIIIlIII1=M('Lottery_record');
$IIIIIII1lII1=$IIIIIIIlIII1->where(array('id'=>intval($_GET['id'])))->find();
if ($this->IIIIIIIIlIlI!=$IIIIIII1lII1['token']){
exit('no permission');
}
switch ($IIIIIII1lII1['prize']){
case 1:
M('Lottery')->where(array('id'=>$IIIIIII1lII1['lid']))->setDec('fistlucknums');
break;
case 2:
M('Lottery')->where(array('id'=>$IIIIIII1lII1['lid']))->setDec('secondlucknums');
break;
case 3:
M('Lottery')->where(array('id'=>$IIIIIII1lII1['lid']))->setDec('thirdlucknums');
break;
case 4:
M('Lottery')->where(array('id'=>$IIIIIII1lII1['lid']))->setDec('fourlucknums');
break;
case 5:
M('Lottery')->where(array('id'=>$IIIIIII1lII1['lid']))->setDec('fivelucknums');
break;
case 6:
M('Lottery')->where(array('id'=>$IIIIIII1lII1['lid']))->setDec('sixlucknums');
break;
case 7:
$IIIIII1llI1l='AppleGame';
break;
case 8:
$IIIIII1llI1l='Lovers';
break;
case 9:
$IIIIII1llI1l='Autumn';
break;
}
$IIIIIIIlIII1->where(array('id'=>intval($_GET['id'])))->delete();
$this->success('操作成功');
}
public function exportSN(){
header("Content-Type: text/html; charset=utf-8");
header("Content-type:application/vnd.ms-execl");
header("Content-Disposition:filename=huizong.xls");
$IIIIII1l1I1l=explode(',',strtoupper('a,b,c,d,e,f,g'));
$IIIIIIIlII1l=array(
array('en'=>'sn','cn'=>'SN码(中奖号)'),
array('en'=>'prize','cn'=>'奖项'),
array('en'=>'sendstutas','cn'=>'是否已发奖品'),
array('en'=>'sendtime','cn'=>'奖品发送时间'),
array('en'=>'phone','cn'=>'中奖者手机号'),
array('en'=>'wecha_name','cn'=>'中奖者微信码'),
array('en'=>'time','cn'=>'中奖时间'),
);
$IIIIII1l1I11=array('piaomianjia','shuifei','yingshoujine','yingfupiaomianjia','yingfushuifei','yingfujine','dailishouru','fandian','jichangjianshefei','ranyoufei');
$IIIIIIIllI11=0;
$IIIIII1l1lII=count($IIIIIIIlII1l);
$IIIIIII1llI1=0;
foreach ($IIIIIIIlII1l as $IIIIIIIl1111){
if ($IIIIIII1llI1<$IIIIII1l1lII-1){
echo iconv('utf-8','gbk',$IIIIIIIl1111['cn'])."\t";
}else {
echo iconv('utf-8','gbk',$IIIIIIIl1111['cn'])."\n";
}
$IIIIIII1llI1++;
}
$IIIIIIIlIII1=M('Lottery_record');
$IIIIII1l1lIl=$IIIIIIIlIII1->where(array('lid'=>intval($_GET['id']),'islottery'=>1))->order('id ASC')->select();
if ($IIIIII1l1lIl){
if ($IIIIII1l1lIl[0]['token']!=$this->IIIIIIIIlIlI){
exit('no permission');
}
foreach ($IIIIII1l1lIl as $IIIIIIIlIlll){
$IIIIIII11III=0;
foreach ($IIIIIIIlII1l as $IIIIII1l1lI1){
$IIIIII1l1llI=$IIIIIIIlIlll[$IIIIII1l1lI1['en']];
switch ($IIIIII1l1lI1['en']){
default:
break;
case 'time':
case 'sendtime':
if ($IIIIII1l1llI){
$IIIIII1l1llI=date('Y-m-d H:i:s',$IIIIII1l1llI);
}else {
$IIIIII1l1llI='';
}
break;
case 'wecha_name':
case 'prize':
$IIIIII1l1llI=iconv('utf-8','gbk',$IIIIII1l1llI);
break;
}
if ($IIIIIII11III<$IIIIII1l1lII-1){
echo $IIIIII1l1llI."\t";
}else {
echo $IIIIII1l1llI."\n";
}
$IIIIIII11III++;
}
$IIIIIIIllI11++;
}
}
exit();
}
}
?>