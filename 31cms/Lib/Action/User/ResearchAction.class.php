<?php

class ResearchAction extends LotteryBaseAction{
public function _initialize(){
parent :: _initialize();
if (empty($this ->IIIIIIIIlIlI)){
$this ->error('不合法的操作',U('Index/index'));
}
}
public function index(){
$IIIIIIIIIl11 = M('Research') ->where(array('token'=>$this ->IIIIIIIIlIlI)) ->order('id desc') ->select();
$this ->assign('list',$IIIIIIIIIl11);
$this ->display();
}
public function saveInfo(){
$IIIIII1llI11 = isset($_REQUEST['rid']) ?intval($_REQUEST['rid']) : 0;
if ($IIIIIIIIIl11 = M('Research') ->where(array('id'=>$IIIIII1llI11,'token'=>$this ->IIIIIIIIlIlI)) ->find()){
$IIIIIIIIIl11['starttime'] = date("Y-m-d H:i:s",$IIIIIIIIIl11['starttime']);
$IIIIIIIIIl11['dateline'] = date("Y-m-d H:i:s",$IIIIIIIIIl11['endtime']);
$IIIIIlIIl1l1 = M('Research_question') ->where(array('rid'=>$IIIIII1llI11)) ->order('id asc') ->select();
$IIIIIlIIl11I = $IIIIIlIIl11l = $IIIIIIIIlIII = array();
foreach ($IIIIIlIIl1l1 as $IIIIIIlIllII){
$IIIIIlIIl11I[] = $IIIIIIlIllII['id'];
$IIIIIlIIl111 = M('Research_answer') ->where(array('qid'=>$IIIIIIlIllII['id'])) ->order('id asc') ->select();
$IIIIIIlIllII['answer'] = $IIIIIlIIl111;
$IIIIIIIIlIII[] = $IIIIIIlIllII;
foreach ($IIIIIlIIl111 as $IIIIIIll1lIl){
$IIIIIlIIl11l[] = $IIIIIIll1lIl['id'];
}
}
}
if (IS_POST){
$IIIIIlII1III = array();
$IIIIIlII1III['title'] = isset($_REQUEST['title']) ?htmlspecialchars($_REQUEST['title']) : '';
$IIIIIlII1III['description'] = isset($_REQUEST['description']) ?htmlspecialchars($_REQUEST['description']) : '';
$IIIIII11IlI1 = $IIIIIlII1III['keyword'] = isset($_REQUEST['keyword']) ?htmlspecialchars($_REQUEST['keyword']) : '';
$IIIIIlII1III['logourl'] = isset($_REQUEST['logourl']) ?htmlspecialchars($_REQUEST['logourl']) : '';
$IIIIIlII1III['token'] = $this ->IIIIIIIIlIlI;
$IIIIIlII1III['starttime'] = isset($_REQUEST['starttime']) ?strtotime(htmlspecialchars($_REQUEST['starttime'])) : '';
$IIIIIlII1III['endtime'] = isset($_REQUEST['deadline']) ?strtotime(htmlspecialchars($_REQUEST['deadline'])) : '';
$IIIIII11I111 = isset($_REQUEST['question']) ?$_REQUEST['question'] : array();
$IIIIII11lIIl = isset($_REQUEST['option']) ?$_REQUEST['option'] : array();
$IIIIIlII1IIl = isset($_REQUEST['ismulti']) ?$_REQUEST['ismulti'] : array();
$IIIIIlII1II1 = D('Research');
if ($IIIIII1llI11 &&($IIIIIII11l11 = $IIIIIlII1II1 ->where(array('id'=>$IIIIII1llI11)) ->find())){
$_POST['id'] = $IIIIII1llI11;
$IIIIIlII1IlI = isset($_REQUEST['qid']) ?$_REQUEST['qid'] : array();
$IIIIIlII1Ill = isset($_REQUEST['oid']) ?$_REQUEST['oid'] : array();
$IIIIIlII1Il1 = $IIIIIlII1I1I = array();
if ($IIIIIlII1II1 ->create() !== false){
$IIIIIlII1III['id'] = $IIIIII1llI11;
$IIIIIlII1II1 ->save($IIIIIlII1III);
D("Lottery") ->where(array('id'=>$IIIIIII11l11['lid'])) ->save(array('keyword'=>$IIIIIlII1III['keyword'],'statdate'=>$IIIIIlII1III['starttime'],'enddate'=>$IIIIIlII1III['endtime'],'info'=>$IIIIIlII1III['description'],'title'=>$IIIIIlII1III['title']));
foreach ($IIIIII11I111 as $IIIIIIIllIll =>$IIIIIlII1I1l){
if (!isset($IIIIII11lIIl[$IIIIIIIllIll]) ||(isset($IIIIII11lIIl[$IIIIIIIllIll]) &&empty($IIIIII11lIIl[$IIIIIIIllIll])) ||empty($IIIIIlII1I1l) ||!isset($IIIIIlII1IlI[$IIIIIIIllIll])) continue;
$IIIIIlII1I11 = array('rid'=>$IIIIII1llI11,'name'=>htmlspecialchars($IIIIIlII1I1l),'type'=>isset($IIIIIlII1IIl[$IIIIIIIllIll]) ?intval($IIIIIlII1IIl[$IIIIIIIllIll]) : 0);
if ($IIIIIlII1IlI[$IIIIIIIllIll]){
$IIIIIlII1I11['id'] = $IIIIIlII1IlI[$IIIIIIIllIll];
D('Research_question') ->save($IIIIIlII1I11);
$IIIIIlII1Il1[] = $IIIIIlII1IlI[$IIIIIIIllIll];
foreach ($IIIIII11lIIl[$IIIIIIIllIll] as $IIIIIIIllI11 =>$IIIIIIlIllII){
if (!isset($IIIIIlII1Ill[$IIIIIIIllIll][$IIIIIIIllI11])) continue;
$IIIIIlII1lII = array('qid'=>$IIIIIlII1IlI[$IIIIIIIllIll],'name'=>htmlspecialchars($IIIIIIlIllII));
if (empty($IIIIIlII1Ill[$IIIIIIIllIll][$IIIIIIIllI11])){
D('Research_answer') ->add($IIIIIlII1lII);
}else{
$IIIIIlII1lII['id'] = $IIIIIlII1Ill[$IIIIIIIllIll][$IIIIIIIllI11];
D('Research_answer') ->save($IIIIIlII1lII);
$IIIIIlII1I1I[] = $IIIIIlII1Ill[$IIIIIIIllIll][$IIIIIIIllI11];
}
}
}else{
if ($IIIIIlII1lIl = D('Research_question') ->add($IIIIIlII1I11)){
foreach ($IIIIII11lIIl[$IIIIIIIllIll] as $IIIIIIlIllII){
if (empty($IIIIIIlIllII)) continue;
$IIIIIlII1lII = array('qid'=>$IIIIIlII1lIl,'name'=>htmlspecialchars($IIIIIIlIllII));
$IIIIIlII1lI1 = D('Research_answer') ->add($IIIIIlII1lII);
}
}
}
}
$IIIIIlII1llI = array_diff($IIIIIlIIl11I,$IIIIIlII1Il1);
if ($IIIIIlII1llI){
M('Research_question') ->where(array('id'=>array('in',$IIIIIlII1llI))) ->delete();
}
$IIIIIlII1ll1 = array_diff($IIIIIlIIl11l,$IIIIIlII1I1I);
if ($IIIIIlII1ll1){
M('Research_answer') ->where(array('id'=>array('in',$IIIIIlII1ll1))) ->delete();
}
}else{
exit(json_encode(array('error_code'=>true,'msg'=>'数据有误')));
}
}else{
$IIIIIlII1III['dateline'] = time();
if ($IIIIIlII1II1 ->create() !== false){
if ($IIIIII1llI11 = $IIIIIlII1II1 ->add($IIIIIlII1III)){
foreach ($IIIIII11I111 as $IIIIIIIllIll =>$IIIIIlII1I1l){
if (!isset($IIIIII11lIIl[$IIIIIIIllIll]) ||(isset($IIIIII11lIIl[$IIIIIIIllIll]) &&empty($IIIIII11lIIl[$IIIIIIIllIll])) ||empty($IIIIIlII1I1l)) continue;
$IIIIIlII1I11 = array('rid'=>$IIIIII1llI11,'name'=>htmlspecialchars($IIIIIlII1I1l),'type'=>isset($IIIIIlII1IIl[$IIIIIIIllIll]) ?intval($IIIIIlII1IIl[$IIIIIIIllIll]) : 0);
if ($IIIIIlII1lIl = M('Research_question') ->add($IIIIIlII1I11)){
foreach ($IIIIII11lIIl[$IIIIIIIllIll] as $IIIIIIlIllII){
if (empty($IIIIIIlIllII)) continue;
$IIIIIlII1lII = array('qid'=>$IIIIIlII1lIl,'name'=>htmlspecialchars($IIIIIIlIllII));
$IIIIIlII1lI1 = M('Research_answer') ->add($IIIIIlII1lII);
}
}
}
}
}else{
exit(json_encode(array('error_code'=>true,'msg'=>'数据有误')));
}
}
if ($IIIIIlII1l1I = M('Keyword') ->where(array('pid'=>$IIIIII1llI11,'token'=>$this ->IIIIIIIIlIlI,'module'=>'Research')) ->find()){
M('Keyword') ->where(array('pid'=>$IIIIII1llI11,'token'=>$this ->IIIIIIIIlIlI,'id'=>$IIIIIlII1l1I['id'])) ->save(array('keyword'=>$IIIIII11IlI1));
}else{
M('Keyword') ->add(array('token'=>$this ->IIIIIIIIlIlI,'pid'=>$IIIIII1llI11,'keyword'=>$IIIIII11IlI1,'module'=>'Research'));
}
exit(json_encode(array('error_code'=>false,'msg'=>'ok')));
}else{
if ($IIIIII1llI11){
$this ->assign('list',$IIIIIIIIlIII);
$this ->assign('research',$IIIIIIIIIl11);
$this ->display('reedit');
}else{
$this ->display('readd');
}
}
}
public function count(){
$IIIIIIIII1I1 = intval($this ->_get('rid'));
$IIIIII11I111 = M('Research_question') ->where(array('rid'=>$IIIIIIIII1I1)) ->order('id asc') ->select();
$IIIIIIIIlIII = array();
foreach ($IIIIII11I111 as $IIIIIlII1I1l){
$IIIIIlII1I1l['answer'] = M('Research_answer') ->where(array('qid'=>$IIIIIlII1I1l['id'])) ->order('id asc') ->select();
$IIIIIlII1I1l['rowspan'] = count($IIIIIlII1I1l['answer']);
$IIIIIIIIlIII[] = $IIIIIlII1I1l;
}
$this ->assign('list',$IIIIIIIIlIII);
$this ->display();
}
public function delResearch(){
if($this ->_get('token') != session('token')){
$this ->error('非法操作');
}
$IIIIIIIII1I1 = intval($this ->_get('rid'));
if(IS_GET){
$IIIIIIIIlIl1 = array('id'=>$IIIIIIIII1I1,'token'=>session('token'));
$IIIIIIIIIl11 = M('Research');
$IIIIIIl111Il = $IIIIIIIIIl11 ->where($IIIIIIIIlIl1) ->find();
if($IIIIIIl111Il == false) $this ->error('非法操作');
if ($IIIIIIIlIIIl = $IIIIIIIIIl11 ->where($IIIIIIIIlIl1) ->delete()){
$IIIIIlIIl1l1 = M('Research_question') ->where(array('rid'=>$IIIIIIIII1I1)) ->select();
$IIIIIlIIl11I = $IIIIIlIIl11l = array();
foreach ($IIIIIlIIl1l1 as $IIIIIIlIllII){
$IIIIIlIIl11I[] = $IIIIIIlIllII['id'];
$IIIIIlIIl111 = M('Research_answer') ->where(array('qid'=>$IIIIIIlIllII['id'])) ->order('id asc') ->select();
foreach ($IIIIIlIIl111 as $IIIIIIll1lIl){
$IIIIIlIIl11l[] = $IIIIIIll1lIl['id'];
}
}
if ($IIIIIlIIl11I){
M('Research_question') ->where(array('id'=>array('in',$IIIIIlIIl11I))) ->delete();
}
if ($IIIIIlIIl11l){
M('Research_answer') ->where(array('id'=>array('in',$IIIIIlIIl11l))) ->delete();
}
if ($IIIIIlII1l1I = M('Keyword') ->where(array('pid'=>$IIIIIIl111Il['id'],'token'=>$this ->IIIIIIIIlIlI,'module'=>'Research')) ->find()){
M('Keyword') ->where(array('pid'=>$IIIIIIl111Il['id'],'token'=>$this ->IIIIIIIIlIlI,'id'=>$IIIIIlII1l1I['id'])) ->delete();
}
$this ->success('操作成功',U('Research/index',array('token'=>session('token'))));
}else{
$this ->error('服务器繁忙,请稍后再试',U('Research/index',array('token'=>session('token'))));
}
}
}
public function cheat(){
parent :: cheat();
$this ->display();
}
public function research(){
parent :: index(6);
$IIIIII1llI11 = isset($_GET['researchid']) ?intval($_GET['researchid']) : 0;
if (empty($IIIIII1llI11)){
$this ->redirect(U('Research/index'));
}
$this ->assign('rid',$IIIIII1llI11);
$this ->display();
}
public function sn(){
parent :: sn(6);
$this ->display('Lottery:sn');
}
public function add(){
$IIIIII1llI11 = isset($_GET['researchid']) ?intval($_GET['researchid']) : 0;
$IIIIIIIIIl11 = M('Research') ->where(array('id'=>$IIIIII1llI11,'token'=>$this ->IIIIIIIIlIlI)) ->find();
if (empty($IIIIIIIIIl11)){
$this ->redirect(U('Research/index'));
}
$this ->assign('research',$IIIIIIIIIl11);
parent :: add(6);
}
public function edit(){
$IIIIII1llI11 = isset($_GET['researchid']) ?intval($_GET['researchid']) : 0;
$IIIIIIIIIl11 = M('Research') ->where(array('id'=>$IIIIII1llI11,'token'=>$this ->IIIIIIIIlIlI)) ->find();
if (empty($IIIIIIIIIl11)){
$this ->redirect(U('Research/index'));
}
$this ->assign('research',$IIIIIIIIIl11);
parent :: edit(6);
}
}
?>