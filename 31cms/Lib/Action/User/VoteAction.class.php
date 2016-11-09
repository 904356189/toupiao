<?php
class VoteAction extends UserAction{

public function _initialize() {

parent::_initialize();

$IIIIIllII1ll  = 6;

C('site_url','http://'.$_SERVER['HTTP_HOST']);

}

public function index(){

$IIIIIIIIII1I=M('Users')->field('gid,activitynum,sum')->where(array('id'=>session('uid')))->find();

$IIIIIIl11l11=M('User_group')->where(array('id'=>$IIIIIIIIII1I['gid']))->find();

$this->assign('group',$IIIIIIl11l11);

$this->assign('sum',$IIIIIIIIII1I['sum']);

$this->assign('activitynum',$IIIIIIIIII1I['activitynum']);

$IIIIIIIIlIII=M('Vote')->where(array('token'=>session('token')))->order('id DESC')->select();

$IIIIIllII1l1 = intval (date("Hi"));

foreach ($IIIIIIIIlIII as $IIIIIIIlI11I=>$IIIIIIl1llIl)

{

$IIIIIII111II=time();

$IIIIIllII11I=array('vid'=>$IIIIIIl1llIl['id']);

$IIIIIllII11I['status'] =array('gt',0);

$IIIIIIIIlIII[$IIIIIIIlI11I]['count']= M('Vote_item')->where($IIIIIllII11I)->count();

$IIIIIIIIlIII[$IIIIIIIlI11I]['limitedit'] = 1;

if($IIIIIII111II<$IIIIIIIIlIII[$IIIIIIIlI11I]['statdate'])

{

$IIIIIIIIlIII[$IIIIIIIlI11I]['show'] = '尚未开始';

}

elseif($IIIIIII111II>$IIIIIIIIlIII[$IIIIIIIlI11I]['enddate']){

$IIIIIIIIlIII[$IIIIIIIlI11I]['show'] = '活动结束';

$IIIIIIIIlIII[$IIIIIIIlI11I]['limitedit'] = 2;

}

else {

$IIIIIIIIlIII[$IIIIIIIlI11I]['show'] = '进行中';

if ($IIIIIllII1l1 >"600"&&$IIIIIllII1l1 <"2200") {

$IIIIIIIIlIII[$IIIIIIIlI11I]['limitedit'] = 0;

}

}

}

$IIIIIIIII1ll = M('Vote')->where(array('token'=>session('token')))->count();

$this->assign('count',$IIIIIIIII1ll);

if ($IIIIIllII1l1 >"600"&&$IIIIIllII1l1 <"2200") {

$IIIIIllII11l= 0;

}

$this->assign('limitedit',$IIIIIllII11l);

$this->assign('list',$IIIIIIIIlIII);

$this->display();

}

public function totals(){

$IIIIIIIIlIlI      = session('token');

$IIIIIIIII1I1         = $this->_get('id');

$IIIIIllIlIII     = M('Vote');

$IIIIIllIlIIl  = M('Vote_record');

$IIIIIIIIlIl1      = array('id'=>$IIIIIIIII1I1,'token'=>session('token'));

$IIIIIIlI1111   = $IIIIIllIlIII->where($IIIIIIIIlIl1)->find();

if(empty($IIIIIIlI1111)){

exit('非法操作');

}

$IIIIIllIlII1 = array('vid'=>$IIIIIIIII1I1,'status'=>1);

import('./iMicms/Lib/ORG/Page.class.php');

$IIIIIIIII1ll = M('Vote_item')->where($IIIIIllIlII1)->count();

$IIIIIIIII11I = new Page($IIIIIIIII1ll,20);

$IIIIIIIII11I->setConfig('theme','<li><a>%totalRow% %header%</a></li> %upPage%  %linkPage% %downPage% ');

$IIIIIIIII11l = $IIIIIIIII11I->show();

$IIIIIllIlIlI = M('Vote_item')->where($IIIIIllIlII1)->order('vcount DESC')->limit($IIIIIIIII11I->firstRow.','.$IIIIIIIII11I->listRows)->select();

$IIIIIllIlIll =  M('Vote_item')->where($IIIIIllIlII1)->sum("vcount");

if(!$IIIIIllIlIll){$IIIIIllIlIll = 0;}

$this->assign('count',$IIIIIllIlIll);

$IIIIIllIlIl1 = M('Vote_item')->where($IIIIIllIlII1)->field('vcount')->group('vcount')->select();

foreach($IIIIIllIlIl1 as $IIIIIIIlI11I =>$IIIIIIIlI11l){

$IIIIIllIlI1I[$IIIIIIIlI11I] = $IIIIIllIlIl1[$IIIIIIIlI11I]['vcount'];

}

$IIIIIllIlIl1 = array_reverse($IIIIIllIlI1I);

$IIIIIllIlI1l = M('Vote_item')->where($IIIIIllIlII1)->order('vcount desc')->limit($IIIIIIIII11I->firstRow.','.$IIIIIIIII11I->listRows)->select();

$IIIIIllIlI11['vcount'] = array('gt',$IIIIIllIlI1l[0]['vcount']);

foreach ($IIIIIllIlI1l as $IIIIIIIllIll=>$IIIIIIIlI11l) {

$IIIIIllIlIlI[$IIIIIIIllIll]['per']=(number_format(($IIIIIIIlI11l['vcount'] / $IIIIIllIlIll),2))*100;

$IIIIIllIlIlI[$IIIIIIIllIll]['pro']=$IIIIIIIlI11l['vcount'];

$IIIIIllIlIlI[$IIIIIIIllIll]['prode']=$IIIIIIIlI11l['dcount'];

$IIIIIllIllIl = array_keys($IIIIIllIlIl1,$IIIIIIIlI11l['vcount']);

$IIIIIllIllIl = intval($IIIIIllIllIl[0]) +1;

$IIIIIllIlIlI[$IIIIIIIllIll]['mingci']=$IIIIIllIllIl;

}

$this->assign('page',$IIIIIIIII11l);

$this->assign('total',$IIIIII1II1I1);

$this->assign('vote_item',$IIIIIllIlIlI);

$this->assign('vote',$IIIIIIlI1111);

$this->display();

}

public function share(){

$IIIIIIIIlIlI      = $this->_get('token');

$IIIIIIIII1I1         = $this->_get('id');

$IIIIIllIlIII     = M('Vote');

$IIIIIllIlIIl  = M('Vote_record');

$IIIIIIIIlIl1      = array('id'=>$IIIIIIIII1I1,'token'=>$IIIIIIIIlIlI);

$IIIIIIlI1111   = $IIIIIllIlIII->where($IIIIIIIIlIl1)->find();

if(empty($IIIIIIlI1111)){

exit('非法操作');

}

$IIIIIllIlII1 = array('vid'=>$IIIIIIIII1I1,'status'=>1);

import('./iMicms/Lib/ORG/Page.class.php');

$IIIIIIIII1ll = M('Vote_item')->where($IIIIIllIlII1)->count();

$IIIIIIIII11I = new Page($IIIIIIIII1ll,60);

$IIIIIIIII11I->setConfig('theme','<li><a>%totalRow% %header%</a></li> %upPage%  %linkPage% %downPage% ');

$IIIIIIIII11l = $IIIIIIIII11I->show();

$IIIIIllIlIlI = M('Vote_item')->where($IIIIIllIlII1)->order('vcount DESC')->limit($IIIIIIIII11I->firstRow.','.$IIIIIIIII11I->listRows)->select();

$IIIIIllIlIll =  M('Vote_item')->where($IIIIIllIlII1)->sum("vcount");

if(!$IIIIIllIlIll){$IIIIIllIlIll = 0;}

$this->assign('count',$IIIIIllIlIll);

$IIIIIllIlIl1 = M('Vote_item')->where($IIIIIllIlII1)->field('vcount')->group('vcount')->select();

foreach($IIIIIllIlIl1 as $IIIIIIIlI11I =>$IIIIIIIlI11l){

$IIIIIllIlI1I[$IIIIIIIlI11I] = $IIIIIllIlIl1[$IIIIIIIlI11I]['vcount'];

}

$IIIIIllIlIl1 = array_reverse($IIIIIllIlI1I);

$IIIIIllIlI1l = M('Vote_item')->where($IIIIIllIlII1)->order('vcount desc')->limit($IIIIIIIII11I->firstRow.','.$IIIIIIIII11I->listRows)->select();

$IIIIIllIlI11['vcount'] = array('gt',$IIIIIllIlI1l[0]['vcount']);

foreach ($IIIIIllIlI1l as $IIIIIIIllIll=>$IIIIIIIlI11l) {

$IIIIIllIlIlI[$IIIIIIIllIll]['per']=(number_format(($IIIIIIIlI11l['vcount'] / $IIIIIllIlIll),2))*100;

$IIIIIllIlIlI[$IIIIIIIllIll]['pro']=$IIIIIIIlI11l['vcount'];

$IIIIIllIlIlI[$IIIIIIIllIll]['prode']=$IIIIIIIlI11l['dcount'];

$IIIIIllIllIl = array_keys($IIIIIllIlIl1,$IIIIIIIlI11l['vcount']);

$IIIIIllIllIl = intval($IIIIIllIllIl[0]) +1;

$IIIIIllIlIlI[$IIIIIIIllIll]['mingci']=$IIIIIllIllIl;

}

$IIIIIllIlllI = M('Token_open');

$IIIIIllIllll = M('Users');

$IIIIIllIlll1 = $IIIIIllIlllI->where(array('token'=>$IIIIIIIIlIlI))->getField('uid');

$IIIIIllIllll = M('Users')->where(array('id'=>$IIIIIllIlll1))->find();

$this->assign('page',$IIIIIIIII11l);

$this->assign('total',$IIIIII1II1I1);

$this->assign('vote_item',$IIIIIllIlIlI);

$this->assign('vote',$IIIIIIlI1111);

$this->assign('id',$IIIIIIIII1I1);

$this->assign('toke',$IIIIIIIIlIlI);

$this->assign('info',$IIIIIllIllll);

$this->display();

}

public function add(){

$this->assign('type',$this->_get('type'));

if(IS_POST){

$IIIIIllIll1I=$_REQUEST['picurl_guanggao'];

$IIIIIllIll1l = $_REQUEST['add'];

foreach ($IIIIIllIll1l as $IIIIIllIll11 =>$IIIIIIIlI11l) {

foreach ($IIIIIIIlI11l as $IIIIIIIllIll =>$IIIIIIlIllII) {

if($IIIIIIlIllII != "")

$IIIIIllIl1II[$IIIIIIIllIll][$IIIIIllIll11]=$IIIIIIlIllII;

}

}

foreach ($IIIIIllIll1I as $IIIIIllIll11 =>$IIIIIIIlI11l) {

foreach ($IIIIIIIlI11l as $IIIIIIIllIll =>$IIIIIIlIllII) {

if($IIIIIIlIllII != "")

$IIIIIllIl1Il[$IIIIIIIllIll][$IIIIIllIll11]=$IIIIIIlIllII;

}

}

$IIIIIIIIIl11=D('Vote');

$IIIIIllIl1I1['token']=session('token');

$IIIIIllIl1I1['type'] = $this->_get('type');

$IIIIIllIl1I1['statdate']=strtotime($this->_post('statdate'));

$IIIIIllIl1I1['enddate']=strtotime($this->_post('enddate'));

$IIIIIllIl1I1['start_time']=strtotime($this->_post('start_time'));

$IIIIIllIl1I1['over_time']=strtotime($this->_post('over_time'));

$IIIIIllIl1I1['cknums'] = $this->_post('cknums');

$IIIIIllIl1I1['is_sh'] = $this->_post('is_sh');

$IIIIIllIl1I1['is_sendsms'] = $this->_post('is_sendsms');

$IIIIIllIl1I1['xncheck'] = $this->_post('xncheck');

$IIIIIllIl1I1['xntps'] = $this->_post('xntps');

$IIIIIllIl1I1['xnbms'] = $this->_post('xnbms');

$IIIIIllIl1I1['moban'] = $this->_post("moban");

$IIIIIllIl1I1['fxms'] = $this->_post("fxms");

$IIIIIllIl1I1['music'] = $this->_post("music");

$IIIIIllIl1I1['gonggao'] = $this->_post("gonggao");

$IIIIIllIl1I1['wappicurl'] = $this->_post("wappicurl");

$IIIIIllIl1I1['ydgzts'] = $this->_post("ydgzts");

$IIIIIllIl1I1['wxgzurl'] = $this->_post("wxgzurl");

$IIIIIllIl1I1['tpnub'] = $this->_post("tpnub");

$IIIIIllIl1I1['ipnubs'] = $this->_post("ipnubs");

$IIIIIllIl1I1['btcdxz'] = $this->_post("btcdxz");

$IIIIIllIl1I1['shumat'] = $this->_post("shumat");

$IIIIIllIl1I1['shumbt'] = $this->_post("shumbt");

$IIIIIllIl1I1['shumct'] = $this->_post("shumct");

$IIIIIllIl1I1['shuma'] = strip_tags($this->_post("shuma"));

$IIIIIllIl1I1['shumb'] = strip_tags($this->_post("shumb"));

$IIIIIllIl1I1['shumc'] = strip_tags($this->_post("shumc"));

$IIIIIllIl1I1['wfbmbz'] = strip_tags($this->_post("wfbmbz"));

$IIIIIllIl1I1['title'] = $this->_post("title");

$IIIIIllIl1I1['keyword'] = $this->_post('keyword');

$IIIIIllIl1I1['cnzz']=$this->_post('cnzz');
$IIIIIllIl1I1['sms_content']=$this->_post('sms_content');

if($IIIIIllIl1I1['enddate']<$IIIIIllIl1I1['statdate']){

$this->error('投票结束时间不能小于开始时间!');

exit;

}

if($IIIIIllIl1I1['start_time']>$IIIIIllIl1I1['over_time']){

$this->error('报名结束时间不能小于开始时间!');

exit;

}

$IIIIIIll1Il1 = $IIIIIIIIIl11->where(array('keyword'=>$IIIIIllIl1I1['keyword'],'token'=>$IIIIIllIl1I1['token']))->field('keyword')->find();

if($IIIIIIll1Il1 != NULL){

$this->error('此关键词已经存在，请换其它关键词！');

exit;

}

$IIIIIIlI111l = M('Vote_item');

$IIIIIllIl1lI = M('Guanggao');

if($IIIIIIIII1I1=$IIIIIIIIIl11->add($IIIIIllIl1I1)){

foreach($IIIIIllIl1Il as $IIIIIIlIllII){

$IIIIIllIl1l1['vid'] = $IIIIIIIII1I1;

$IIIIIllIl1l1['ggurl'] = $IIIIIIlIllII['url'];

$IIIIIllIl1lI->add($IIIIIllIl1l1);

}

$IIIIIIllllI1['pid']=$IIIIIIIII1I1;

$IIIIIIllllI1['module']='Vote';

$IIIIIIllllI1['token']=session('token');

$IIIIIIllllI1['keyword']=$_POST['keyword'];

M('keyword')->add($IIIIIIllllI1);

$this->success('添加成功',U('Vote/index',array('token'=>session('token'))));

}else{

$this->error('服务器繁忙,请稍候再试');

}

}else{

$IIIIIIIIII1I=M('Users')->field('sum')->where(array('id'=>session('uid')))->find();

$IIIIIIIII1ll = M('Vote')->where(array('token'=>session('token')))->count();

if ($IIIIIIIII1ll>=$IIIIIIIIII1I['sum']){$this->error('创建活动数已用完，请联系管理员增加数量');}

$IIIIIllIl1I1['statdate']=time()-3600;

$IIIIIllIl1I1['enddate']=time()+3600*24*30;

$IIIIIllIl1I1['start_time']=time()-3600;

$IIIIIllIl1I1['over_time']=time()+3600*24*30;

$this->assign('vo',$IIIIIllIl1I1);

$this->display();

}

}

public function del(){

$IIIIIIlIllIl = $this->_get('type');

$IIIIIIIII1I1 = $this->_get('id');

$IIIIIIlI1111 = M('Vote');

$IIIIIlII11lI = array('id'=>$IIIIIIIII1I1,'type'=>$IIIIIIlIllIl);

$IIIIIlIII11I = $IIIIIIlI1111->where($IIIIIlII11lI)->find();

if($IIIIIlIII11I){

$IIIIIIlI1111->where('id='.$IIIIIlIII11I['id'])->delete();

M('Vote_item')->where('vid='.$IIIIIlIII11I['id'])->delete();

M('Vote_record')->where('vid='.$IIIIIlIII11I['id'])->delete();

$IIIIIIIIlIl1 = array('pid'=>$IIIIIlIII11I['id'],'module'=>'Vote','token'=>session('token'));

M('Keyword')->where($IIIIIIIIlIl1)->delete();

$this->success('删除成功',U('Vote/index',array('token'=>session('token'))));

}else{

$this->error('非法操作！');

}

}

public function setinc(){

$IIIIIIIII1I1=$this->_get('id');

$IIIIIIIIlIl1=array('id'=>$IIIIIIIII1I1,'token'=>session('token'));

$IIIIIIl111Il=M('Vote')->where($IIIIIIIIlIl1)->find();

if($IIIIIIl111Il==NULL)$this->error('非法操作');

$IIIIIIIIII1I=M('Users')->field('gid,activitynum')->where(array('id'=>session('uid')))->find();

$IIIIIIl11l11=M('User_group')->where(array('id'=>$IIIIIIIIII1I['gid']))->find();

if($IIIIIIIIII1I['activitynum']>=$IIIIIIl11l11['activitynum']){

}

if ($IIIIIIl111Il['status']==0){

$IIIIIIIIIl11=M('Vote')->where($IIIIIIIIlIl1)->save(array('status'=>1));

$IIIIIllIl11l='恭喜你,活动已经开始';

}else {

$IIIIIIIIIl11=M('Vote')->where($IIIIIIIIlIl1)->save(array('status'=>0));

$IIIIIllIl11l='设置成功,活动已经结束';

}

if($IIIIIIIIIl11!=NULL){

$this->success($IIIIIllIl11l);

}else{

$this->error('设置失败');

}

}

public function setdes(){

$IIIIIIIII1I1=$this->_get('id');

$IIIIIIIIlIl1=array('id'=>$IIIIIIIII1I1,'token'=>session('token'));

$IIIIIIl111Il=M('Vote')->where($IIIIIIIIlIl1)->find();

if($IIIIIIl111Il==NULL)$this->error('非法操作');

$IIIIIIIIIl11=M('Vote')->where($IIIIIIIIlIl1)->setDec('status');

if($IIIIIIIIIl11!=NULL){

$this->success('活动已经结束');

}else{

$this->error('服务器繁忙,请稍候再试');

}

}

public function edit(){

$this->assign('type',$this->_get('type'));

if(IS_POST){

$IIIIIllIll1l = $_REQUEST['add'];

$IIIIIllIll1I=$_REQUEST['picurl_guanggao'];

$IIIIIIIIIl11=D('Vote');

$IIIIIllIl1I1['token']=session('token');

$IIIIIllIl1I1['type'] = $this->_get('type');

$IIIIIllIl1I1['statdate']=strtotime($this->_post('statdate'));

$IIIIIllIl1I1['enddate']=strtotime($this->_post('enddate'));

$IIIIIllIl1I1['start_time']=strtotime($this->_post('start_time'));

$IIIIIllIl1I1['over_time']=strtotime($this->_post('over_time'));

$IIIIIllIl1I1['cknums'] = $this->_post('cknums');

$IIIIIllIl1I1['is_sh'] = $this->_post('is_sh');
$IIIIIllIl1I1['is_sendsms'] = $this->_post('is_sendsms');

$IIIIIllIl1I1['xncheck'] = $this->_post('xncheck');

$IIIIIllIl1I1['xntps'] = $this->_post('xntps');

$IIIIIllIl1I1['xnbms'] = $this->_post('xnbms');

$IIIIIllIl1I1['moban'] = $this->_post("moban");

$IIIIIllIl1I1['fxms'] = $this->_post("fxms");

$IIIIIllIl1I1['music'] = $this->_post("music");

$IIIIIllIl1I1['gonggao'] = $this->_post("gonggao");

$IIIIIllIl1I1['wappicurl'] = $this->_post("wappicurl");

$IIIIIllIl1I1['ydgzts'] = $this->_post("ydgzts");

$IIIIIllIl1I1['wxgzurl'] = $this->_post("wxgzurl");

$IIIIIllIl1I1['tpnub'] = $this->_post("tpnub");

$IIIIIllIl1I1['ipnubs'] = $this->_post("ipnubs");

$IIIIIllIl1I1['btcdxz'] = $this->_post("btcdxz");

$IIIIIllIl1I1['shumat'] = $this->_post("shumat");

$IIIIIllIl1I1['shumbt'] = $this->_post("shumbt");

$IIIIIllIl1I1['shumct'] = $this->_post("shumct");

$IIIIIllIl1I1['shuma'] = strip_tags($this->_post("shuma"));

$IIIIIllIl1I1['shumb'] = strip_tags($this->_post("shumb"));

$IIIIIllIl1I1['shumc'] = strip_tags($this->_post("shumc"));

$IIIIIllIl1I1['wfbmbz'] = strip_tags($this->_post("wfbmbz"));

$IIIIIllIl1I1['title'] = $this->_post("title");

$IIIIIllIl1I1['keyword'] = $this->_post('keyword');

$IIIIIllIl1I1['cnzz']=$this->_post('cnzz');
$IIIIIllIl1I1['sms_content']=$this->_post('sms_content');
if($IIIIIllIl1I1['enddate']<$IIIIIllIl1I1['statdate']){

$this->error('投票结束时间不能小于开始时间!');

exit;

}

if($IIIIIllIl1I1['start_time']>$IIIIIllIl1I1['over_time']){

$this->error('报名结束时间不能小于开始时间!');

exit;

}

$IIIIIIIIlIl1=array('id'=>$_POST['id'],'token'=>session('token'));

$IIIIIIll1Il1 = $IIIIIIIIIl11->where(array('keyword'=>$IIIIIllIl1I1['keyword'],'token'=>$IIIIIllIl1I1['token']))->field('id,keyword')->find();

if($IIIIIIll1Il1['id']!=$_POST['id'] &&$IIIIIIll1Il1 != NULL){

$this->error('此关键词已经存在，请换其它关键词！');

exit;

}

$IIIIIIlI111l = M('Vote_item');

$IIIIIllIl1lI = M('Guanggao');

$IIIIIIlI11Il = $_REQUEST['add'];

foreach ($IIIIIllIll1I as $IIIIIllIll11 =>$IIIIIIIlI11l) {

foreach ($IIIIIIIlI11l as $IIIIIIIllIll =>$IIIIIIlIllII) {

if($IIIIIIlIllII != "")

$IIIIIllIl1Il[$IIIIIIIllIll][$IIIIIllIll11]=$IIIIIIlIllII;

}

}

foreach ($IIIIIllIl1Il as $IIIIIIIllIll =>$IIIIIIlIllII) {

$IIIIIIll1lIl++;

if($IIIIIIlIllII['url'] !=""){

$IIIIIllI1II1['id']=$IIIIIIlIllII['id'];

if($IIIIIllI1II1['id'] != ''){

$IIIIIllIl1l1['ggurl']=$IIIIIIlIllII['url'];

$IIIIIllIl1lI->where(array('id'=>$IIIIIllI1II1['id'],'vid'=>$_POST['id']))->save($IIIIIllIl1l1);

}else{

$IIIIIllIl1l1['vid'] = $_POST['id'];

$IIIIIllIl1l1['ggurl']=$IIIIIIlIllII['url'];

$IIIIIllIl1lI->add($IIIIIllIl1l1);

}

}

}

if($IIIIIIIIIl11->where($IIIIIIIIlIl1)->save($IIIIIllIl1I1)){

$IIIIIIllllI1['pid']=$_POST['id'];

$IIIIIIllllI1['module']='Vote';

$IIIIIIllllI1['token']=session('token');

$IIIIIIIlII11['keyword']=trim($_POST['keyword']);

$IIIIIIIIlI1I = M('keyword')->where($IIIIIIllllI1)->save($IIIIIIIlII11);

$this->success('修改成功!',U('Vote/index',array('token'=>session('token'))));exit;

}else{

$this->success('修改成功',U('Vote/index',array('token'=>session('token'))));exit;

}

}else{

$IIIIIIIII1I1=(int)$this->_get('id');

$IIIIIIIIlIl1=array('id'=>$IIIIIIIII1I1,'token'=>session('token'));

$IIIIIIIIIl11=M('Vote');

$IIIIIIl111Il=$IIIIIIIIIl11->where($IIIIIIIIlIl1)->find();

if($IIIIIIl111Il==NULL)$this->error('非法操作');
$IIIIIIlll11l=$IIIIIIIIIl11->where($IIIIIIIIlIl1)->find();

$IIIIII1lIII1 = M('Vote_item')->where(array('vid'=>$IIIIIIIII1I1,'status'=>1))->order('rank DESC')->select();

$IIIIIllI1IlI = array('vid'=>$IIIIIIIII1I1);

$IIIIIllI1Ill = M('Guanggao')->where($IIIIIllI1IlI)->select();

$this->assign('guanggao',$IIIIIllI1Ill);

$this->assign('items',$IIIIII1lIII1);

$this->assign('vo',$IIIIIIlll11l);

$this->display('add');

}

}

public function del_tab(){

$IIIIIIIlII11['tid']      = strval($this->_post('id'));

M('Vote_item')->where(array('id'=>$IIIIIIIlII11['tid']))->delete();

exit;

}

public function del_item(){

$IIIIIIIlII11['tid']      = strval($this->_post('id'));

M('Vote_item')->where(array('id'=>$IIIIIIIlII11['tid']))->delete();

$IIIIIIIlII1l=array('errno'=>0,'tid'=>$IIIIIIIlII11['tid']);

echo json_encode($IIIIIIIlII1l);

exit;

}

public function del_gg(){

$IIIIIIIlII11['tid']      = strval($this->_post('id'));

M('Guanggao')->where(array('id'=>$IIIIIIIlII11['tid']))->delete();

exit;

}

public function check(){

$IIIIIllI1lII = M('Vote');

$IIIIIllI1lIl = M('Vote_item');

$IIIIIllI1lI1['token'] = session('token');

$IIIIIllI1llI = $IIIIIllI1lII->where($IIIIIllI1lI1)->order('id desc')->select();

if(empty($IIIIIllI1llI)) {$this->error("请先创建活动");}

foreach ($IIIIIllI1llI as $IIIIIIIllIll=>$IIIIIIlIllII){

$IIIIIllI1lll[]=$IIIIIIlIllII['id'];

}

$IIIIIllII11I['status'] = 0;

$IIIIIllII11I['vid']=array('in',$IIIIIllI1lll);

import('./iMicms/Lib/ORG/Page.class.php');

$IIIIIIIII1ll = M('Vote_item')->where($IIIIIllII11I)->count();

$IIIIIIIII11I = new Page($IIIIIIIII1ll,20);

$IIIIIIIII11I->setConfig('theme','<li><a>%totalRow% %header%</a></li> %upPage%  %linkPage% %downPage% ');

$IIIIIIIII11l = $IIIIIIIII11I->show();

$IIIIIllI1ll1 = $IIIIIllI1lIl->where($IIIIIllII11I)->order('id DESC')->limit($IIIIIIIII11I->firstRow.','.$IIIIIIIII11I->listRows)->select();

$IIIIIllIlIll =  $IIIIIllI1lIl->where(array('vid'=>$IIIIIIlI1111['id']))->sum("vcount");

$this->assign('count',$IIIIIllIlIll);

$this->assign('page',$IIIIIIIII11l);

$this->assign('lvinfo',$IIIIIllI1llI);

$this->assign('liinfo',$IIIIIllI1ll1);

$this->display();

}

public function check_vote(){

$IIIIIllI1l1l 		=	$this->_post('vid');

$IIIIIIIII1I1 		= 	$this->_post('id');

$IIIIIllI1l11 = M("Vote_item");

$IIIIIIIIlIl1['id'] 	= $IIIIIIIII1I1;

$IIIIIIIIIl11['vid'] 	= $IIIIIllI1l1l;

$IIIIIIIIIl11['status'] = 1;

$IIIIIIIIlI1I = $IIIIIllI1l11->where($IIIIIIIIlIl1)->save($IIIIIIIIIl11);

if(false === $IIIIIIIIlI1I){

$IIIIIIIlII1l=array('success'=>0);

echo json_encode($IIIIIIIlII1l);

exit;

}else{

$IIIIIIIlII1l=array('success'=>1);

echo json_encode($IIIIIIIlII1l);

$IIIIIIIIlIlI=M('vote')->where(array('id'=>$IIIIIllI1l1l))->find();

$IIIIIIIIll11=$IIIIIIIIlIlI['title'];

$IIIIIII11I1I=M('diymen_set')->where(array('token'=>$IIIIIIIIlIlI['token']))->find();

if ($IIIIIII11I1I['expire_access'] <time()) {

$IIIIIII1l1Il = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$IIIIIII11I1I['appid']."&secret=".$IIIIIII11I1I['appsecret'];

$IIIIIII11l11 = json_decode($this->https_request($IIIIIII1l1Il));

$IIIIIIlllllI = $IIIIIII11l11->IIIIIIlllllI;

if ($IIIIIIlllllI) {

$IIIIIIllllll['expire_access'] = time() +7000;

$IIIIIIllllll['access_token'] = $IIIIIIlllllI;

M('diymen_set')->where(array('token'=>$IIIIIIIIlIlI['token']))->save($IIIIIIllllll);

}

}else {

$IIIIIIlllllI = $IIIIIII11I1I['access_token'];

}

$IIIIIIlIlIll=M('vote_item')->where("id={$IIIIIIIII1I1}")->find();

$IIIIIIlIlIll=$IIIIIIlIlIll['wechat_id'];

if($IIIIIIlIlIll){

$IIIIIIIIIl11='{"touser": "'.$IIIIIIlIlIll.'","msgtype": "text","text": {"content":"亲，您参加的 '.$IIIIIIIIll11.' 已经审核通过，赶快在活动公众号回复关键字进入活动投票吧，同时分享您的活动页面到朋友圈，让您的朋友帮你投票，大奖等着您！"}}';

$this->api_notice_increment('https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token='.$IIIIIIlllllI,$IIIIIIIIIl11);

}

exit;

}

}

public function check_avote(){

$IIIIIllI1l1l 		=	$this->_post('vid');

$IIIIIlII1lI1 		= 	$this->_post('aid');

$IIIIIllI11Il        =   $this->_post('typ');

$IIIIIII1llI1=0;

$IIIIIlII1lI1 =	explode(',',$IIIIIlII1lI1);

$IIIIIllI1l11 = M("Vote_item");

if('del'== $IIIIIllI11Il){

foreach ($IIIIIlII1lI1 as $IIIIIIIII1I1)

{

$IIIIIIIIlIl1['id'] 	= $IIIIIIIII1I1;

$IIIIIIIIlI1I = $IIIIIllI1l11->where($IIIIIIIIlIl1)->delete();

if(false === $IIIIIIIIlI1I){

$IIIIIII1llI1=1;

}

}

if(1 == $IIIIIII1llI1){

$IIIIIIIlII1l=array('success'=>0);

echo json_encode($IIIIIIIlII1l);

exit;

}else{

$IIIIIIIlII1l=array('success'=>2);

echo json_encode($IIIIIIIlII1l);

exit;

}

}

else{

$IIIIIIIIIl11['vid'] 	= $IIIIIllI1l1l;

$IIIIIIIIIl11['status'] = 1;

foreach ($IIIIIlII1lI1 as $IIIIIIIII1I1)

{

$IIIIIIIIlIl1['id'] 	= $IIIIIIIII1I1;

$IIIIIIIIlI1I = $IIIIIllI1l11->where($IIIIIIIIlIl1)->save($IIIIIIIIIl11);

if(false === $IIIIIIIIlI1I){

$IIIIIII1llI1=1;

}

}

if(1 == $IIIIIII1llI1){

$IIIIIIIlII1l=array('success'=>0);

echo json_encode($IIIIIIIlII1l);

exit;

}else{

$IIIIIIIlII1l=array('success'=>1);

echo json_encode($IIIIIIIlII1l);

exit;

}

}

}


public function gongzhong(){

$IIIIIllI11lI = M('Users');

$IIIIIllI11ll = M('diymen_set');

$IIIIIIIII1I1 = session('uid');

$IIIIIIIIlIlI=$_SESSION['token'];

if($_POST)

{

$IIIIIIIIIl11['tuchuang'] = trim($_POST['tuchuang']);

$IIIIIIIIIl11['tuaccesskey'] = trim($_POST['tuaccesskey']);

$IIIIIIIIIl11['tusecretkey'] = trim($_POST['tusecretkey']);

$IIIIIIIIIl11['tupicid'] = trim($_POST['tupicid']);

$IIIIIIIIIl11['duoshuo'] = trim($_POST['duoshuo']);

$IIIIIIIIIl11['duoshuourl'] = trim($_POST['duoshuourl']);

$IIIIIIIIIl11['hdgd'] = trim($_POST['hdgd']);

$IIIIIIIIIl11['hftp'] = trim($_POST['hftp']);

$IIIIIIIIIl11['tpxzmos'] = trim($_POST['tpxzmos']);

$IIIIIIIIIl11['xz1p'] = trim($_POST['xz1p']);

$IIIIIIIIIl11['picnum'] = trim($_POST['picnum']);

$IIIIIIIIIl11['yzm'] = trim($_POST['yzm']);

$IIIIIIIIIl11['yzmid'] = trim($_POST['yzmid']);

$IIIIIIIIIl11['xzlx'] = trim($_POST['xzlx']);

$IIIIIIIIIl11['area'] = trim($_POST['area']);

$IIIIIIIIIl11['ydgzbt'] = trim($_POST['ydgzbt']);

$IIIIIIIIIl11['ydgzan'] = trim($_POST['ydgzan']);

$IIIIIIIIIl11['dbdhm'] = trim($_POST['dbdhm']);

$IIIIIIIIIl11['dbdhurl']	= trim($_POST['dbdhurl']);

$IIIIIIIIIl11['myzps']	= trim($_POST['myzps']);

$IIIIIIIIIl11['tpjl']= trim($_POST['tpjl']);

$IIIIIIIIIl11['tpjlnum']=trim($_POST['tpjlnum']);

$IIIIIIIIIl11['gldzpid']=trim($_POST['gldzpid']);

$IIIIIIIIIl11['jgfen']=trim($_POST['jgfen']);

$IIIIIIIIIl11['jgpiao']=trim($_POST['jgpiao']);

$IIIIIIIIIl11['jgtext']=trim($_POST['jgtext']);

$IIIIIIIIIl11['sdfen']=trim($_POST['sdfen']);

$IIIIIIIIIl11['sdpiao']=trim($_POST['sdpiao']);

$IIIIIIIIIl11['sdtext']=trim($_POST['sdtext']);

$IIIIIIIIIl11['spxz']=trim($_POST['spxz']);

$IIIIIII11I1I['appid'] = trim($_POST['appid']);

$IIIIIII11I1I['appsecret'] = trim($_POST['appsecret']);

$IIIIIIIIlI1I=$IIIIIllI11lI->where('id='.$IIIIIIIII1I1)->save($IIIIIIIIIl11);

$IIIIIllI11l1=$IIIIIllI11ll->where("token='{$IIIIIIIIlIlI}'")->find();

if($IIIIIllI11l1){

$IIIIIllI11ll->where("token='{$IIIIIIIIlIlI}'")->save($IIIIIII11I1I);

}else{

$IIIIIII11I1I['token']=$IIIIIIIIlIlI;

$IIIIIllI11ll->add($IIIIIII11I1I);

}

M('Wxuser')->where(array('token'=>$IIIIIIIIlIlI))->save(array('appid'=>$IIIIIII11I1I['appid'],'appsecret'=>$IIIIIII11I1I['appsecret']));

if($IIIIIIIIlI1I !== false &&$IIIIIllI11l1 !== false){

$this->success("保存成功");

}

else 

{

$this->error("保存失败");

}

}else{

$IIIIIIIIIlll=$IIIIIllI11lI->where("id=".$IIIIIIIII1I1)->find();

$IIIIII1Il1ll = $IIIIIllI11ll->where("token='{$IIIIIIIIlIlI}'")->find();

$IIIIII1lllII=M('Lottery')->where("token='{$IIIIIIIIlIlI}'")->select();

$this->assign('lottery',$IIIIII1lllII);

$this->assign('info',$IIIIIIIIIlll);

$this->assign('diymen',$IIIIII1Il1ll);

$this->display();

}

}

public function lock(){

if(IS_POST){

$IIIIIIIII1I1=$_POST['searchitem'];

$IIIIIllI1l1l=$_POST['vid'];

if(empty($IIIIIIIII1I1)){$this->error('请输入选手编号或名称');}

if( is_numeric($IIIIIIIII1I1)){

$IIIIIIIIlIl1['id']=$IIIIIIIII1I1;

}else{

$IIIIIIIIlIl1['item']=array('like','%'.$IIIIIIIII1I1.'%');

}

$IIIIIllI1ll1=M('Vote_item')->where($IIIIIIIIlIl1)->select();

if(empty($IIIIIllI1ll1)){$this->error('无此选手');}

$this->assign('vid',$IIIIIllI1l1l);

$this->assign('liinfo',$IIIIIllI1ll1);

$this->display();

}else{

$IIIIIIIII1I1=(int)$this->_get('id');

$IIIIIllII11I=array('vid'=>$IIIIIIIII1I1);

$IIIIIllI1lIl = M('Vote_item');

$IIIIIllII11I['status'] = array('gt',0);

import('./iMicms/Lib/ORG/Page.class.php');

$IIIIIIIII1ll = M('Vote_item')->where($IIIIIllII11I)->count();

$IIIIIIIII11I = new Page($IIIIIIIII1ll,20);

$IIIIIIIII11I->setConfig('theme','<li><a>%totalRow% %header%</a></li> %upPage%  %linkPage% %downPage% ');

$IIIIIIIII11l = $IIIIIIIII11I->show();

$IIIIIllI1ll1 = $IIIIIllI1lIl->where($IIIIIllII11I)->order('id DESC')->limit($IIIIIIIII11I->firstRow.','.$IIIIIIIII11I->listRows)->select();

$IIIIIllIlIll =  $IIIIIllI1lIl->where(array('vid'=>$IIIIIIlI1111['id']))->sum("vcount");

$this->assign('count',$IIIIIllIlIll);

$this->assign('page',$IIIIIIIII11l);

$this->assign('lvinfo',$IIIIIllI1llI);

$this->assign('vid',$IIIIIIIII1I1);

$this->assign('liinfo',$IIIIIllI1ll1);

$this->display();

}

}

public function lockall(){

$IIIIIIIII1I1=(int)$this->_post('id');

$IIIIIllI1111     =   trim($this->_post('msg'));

$IIIIIllII11I=array('vid'=>$IIIIIIIII1I1);

$IIIIIllI1lIl = M('Vote_item');

$IIIIIllII11I['status'] = array('gt',0);

$IIIIIIIIIl11['status']   = 2;

$IIIIIIIIIl11['lockinfo'] = $IIIIIllI1111;

$IIIIIIIIlI1I = $IIIIIllI1lIl->where($IIIIIllII11I)->save($IIIIIIIIIl11);

if(false === $IIIIIIIIlI1I){

$IIIIIIIlII1l=array('success'=>0,'msg'=>"操作失败，请重新尝试");

echo json_encode($IIIIIIIlII1l);

exit;

}else{

$IIIIIIIlII1l=array('success'=>1,'msg'=>"锁定成功");

echo json_encode($IIIIIIIlII1l);

exit;

}

}

public function lock_vote(){

$IIIIIllI1l1l 		=	(int)$this->_post('vid');

$IIIIIIIII1I1 		= 	(int)$this->_post('id');

$IIIIIII11I11     =   $this->_post('s');

$IIIIIlIl1Ill = '';

$IIIIIllI1l11 = M("Vote_item");

$IIIIIIIIlIl1['id'] 	= $IIIIIIIII1I1;

$IIIIIIIIlIl1['vid'] 	= $IIIIIllI1l1l;

if(1== $IIIIIII11I11)

{$IIIIIII11I11=2;

$IIIIIlIl1Ill="锁定成功";

}

elseif(2 == $IIIIIII11I11)

{

$IIIIIII11I11=1;

$IIIIIlIl1Ill = "解锁成功";

}

else{

$IIIIIlIl1Ill = "参数错误";

$IIIIIIIlII1l=array('success'=>0,'msg'=>$IIIIIlIl1Ill);

echo json_encode($IIIIIIIlII1l);

exit;

}

$IIIIIIIIIl11['status'] = $IIIIIII11I11;

$IIIIIIIIlI1I = $IIIIIllI1l11->where($IIIIIIIIlIl1)->save($IIIIIIIIIl11);

if(false === $IIIIIIIIlI1I){

$IIIIIIIlII1l=array('success'=>0,'msg'=>"操作失败，请重新尝试");

echo json_encode($IIIIIIIlII1l);

exit;

}else{

$IIIIIIIlII1l=array('success'=>1,'msg'=>$IIIIIlIl1Ill);

echo json_encode($IIIIIIIlII1l);

exit;

}

}

public function lock_msg(){

$IIIIIIIII1I1 		= 	(int)$this->_post('id');

$IIIIIllI1111     =   $this->_post('msg');

$IIIIIllI1l11 = M("Vote_item");

$IIIIIIIIlIl1['id'] 	= $IIIIIIIII1I1;

$IIIIIIIIIl11['lockinfo'] = $IIIIIllI1111;

$IIIIIIIIlI1I = $IIIIIllI1l11->where($IIIIIIIIlIl1)->save($IIIIIIIIIl11);

if(false === $IIIIIIIIlI1I){

$IIIIIIIlII1l=array('success'=>0,''=>"操作失败，请重新尝试");

echo json_encode($IIIIIIIlII1l);

exit;

}else{

$IIIIIIIlII1l=array('success'=>1,'msg'=>"回复信息添加成功！");

echo json_encode($IIIIIIIlII1l);

exit;

}

}

public function eitem(){

if(IS_POST){

$IIIIIIIII1I1=$_POST['searchitem'];

$IIIIIllI1l1l=$_POST['vid'];

if(empty($IIIIIIIII1I1)){$this->error('请输入选手编号或名称');}

if( is_numeric($IIIIIIIII1I1)){

$IIIIIIIIlIl1['id']=$IIIIIIIII1I1;

}else{

$IIIIIIIIlIl1['item']=array('like','%'.$IIIIIIIII1I1.'%');

}

$IIIIIllI1ll1=M('Vote_item')->where($IIIIIIIIlIl1)->select();

if(empty($IIIIIllI1ll1)){$this->error('无此选手');}

$IIIIIllII11I=array('vid'=>$IIIIIllI1l1l);

$IIIIIllII11I['status'] =array('gt',0);

$IIIIIIIII1ll = M('Vote_item')->where($IIIIIllII11I)->count();

$this->assign('count',$IIIIIIIII1ll);

$this->assign('vid',$IIIIIllI1l1l);

$this->assign('liinfo',$IIIIIllI1ll1);

$this->display();

}else{

$IIIIIIIII1I1=(int)$this->_get('id');

$IIIIIllII11I=array('vid'=>$IIIIIIIII1I1);

$IIIIIllI1lIl = M('Vote_item');

$IIIIIllII11I['status'] =array('gt',0);

import('./iMicms/Lib/ORG/Page.class.php');

$IIIIIIIII1ll = M('Vote_item')->where($IIIIIllII11I)->count();

$IIIIIIIII11I = new Page($IIIIIIIII1ll,20);

$IIIIIIIII11I->setConfig('theme','<li><a>%totalRow% %header%</a></li> %upPage%  %linkPage% %downPage% ');

$IIIIIIIII11l = $IIIIIIIII11I->show();

$IIIIIllI1ll1 = $IIIIIllI1lIl->where($IIIIIllII11I)->order('id DESC')->limit($IIIIIIIII11I->firstRow.','.$IIIIIIIII11I->listRows)->order('vcount desc')->select();

$this->assign('count',$IIIIIIIII1ll);

$this->assign('page',$IIIIIIIII11l);

$this->assign('vid',$IIIIIIIII1I1);

$this->assign('liinfo',$IIIIIllI1ll1);

$this->display();

}

}

public function eitem_vote(){

$IIIIIIIII1I1 		= 	intval($this->_post('id'));

$IIIIII1Il1I1     =   $this->_post('item');

$IIIIIlllIIll     =   intval($this->_post('rank'));

$IIIIIllIlIll     =   intval($this->_post('vcount'));

$IIIIIlllIIl1     =    $this->_post('vtype');

$IIIIIlllII1I     =   $this->_post('tourl');

$IIIIIlllII1l     =   $this->_post('intro');

$IIIIIlllII11     =   $this->_post('startpicurl');

$IIIIIlllIlII     =   $this->_post('startpicurl2');

$IIIIIlllIlIl     =   $this->_post('startpicurl3');

$IIIIIlllIlI1    =   $this->_post('startpicurl4');

$IIIIIlIl1Ill = '选项信息更改成功';

$IIIIIllI1l11 = M("Vote_item");

$IIIIIIIIlIl1['id'] 	= $IIIIIIIII1I1;

$IIIIIIIIIl11['item'] = $IIIIII1Il1I1;

$IIIIIIIIIl11['rank'] = $IIIIIlllIIll;

$IIIIIIIIIl11['tourl'] = $IIIIIlllII1I;

$IIIIIIIIIl11['intro'] = $IIIIIlllII1l;

$IIIIIIIIIl11['startpicurl'] = $IIIIIlllII11;

$IIIIIIIIIl11['startpicurl2'] = $IIIIIlllIlII;

$IIIIIIIIIl11['startpicurl3'] = $IIIIIlllIlIl;

$IIIIIIIIIl11['startpicurl4'] = $IIIIIlllIlI1;

$IIIIIIIIlI1I = $IIIIIllI1l11->where($IIIIIIIIlIl1)->save($IIIIIIIIIl11);

if('up'== $IIIIIlllIIl1){

$IIIIIlllIllI = $IIIIIllI1l11->where($IIIIIIIIlIl1)->setInc('vcount',$IIIIIllIlIll);

}elseif('down'== $IIIIIlllIIl1)

{

$IIIIIlllIllI = $IIIIIllI1l11->where($IIIIIIIIlIl1)->setDec('vcount',$IIIIIllIlIll);

}

$IIIIIlllIlll = $IIIIIllI1l11->where($IIIIIIIIlIl1)->getField('vcount');

if($IIIIIlllIlll<0){

$IIIIIllI1l11->where($IIIIIIIIlIl1)->save(array('vcount'=>0));

}

if(false === $IIIIIIIIlI1I){

$IIIIIIIlII1l=array('success'=>0,'msg'=>"操作失败，请重新尝试");

echo json_encode($IIIIIIIlII1l);

exit;

}else{

$IIIIIIIlII1l=array('success'=>1,'msg'=>$IIIIIlIl1Ill);

echo json_encode($IIIIIIIlII1l);

exit;

}

}

public function eitem_add(){

$IIIIIllI1l1l 		= 	intval($this->_post('vid'));

$IIIIII1Il1I1     	=  	 $this->_post('item');

$IIIIIlllIIll    	=   intval($this->_post('rank'));

$IIIIIllIlIll     =   intval($this->_post('vcount'));

$IIIIIlllII1I      =   $this->_post('tourl');

$IIIIIlllII1l      =   $this->_post('intro');

$IIIIIlllII11     =   $this->_post('startpicurl');

$IIIIIlllIlII     =   $this->_post('startpicurl2');

$IIIIIlllIlIl     =   $this->_post('startpicurl3');

$IIIIIlllIlI1     =   $this->_post('startpicurl4');

$IIIIIlIl1Ill = '选项信息添加成功';

$IIIIIllI1l11 = M("Vote_item");

$IIIIIIIIIl11['vid'] 	= $IIIIIllI1l1l;

$IIIIIIIIIl11['item'] = $IIIIII1Il1I1;

$IIIIIIIIIl11['rank'] = $IIIIIlllIIll;

$IIIIIIIIIl11['vcount'] = $IIIIIllIlIll;

$IIIIIIIIIl11['tourl'] = $IIIIIlllII1I;

$IIIIIIIIIl11['intro'] = $IIIIIlllII1l;

$IIIIIIIIIl11['status'] = 1;

$IIIIIIIIIl11['addtime'] = time();

$IIIIIIIIIl11['startpicurl'] = $IIIIIlllII11;

$IIIIIIIIIl11['startpicurl2'] = $IIIIIlllIlII;

$IIIIIIIIIl11['startpicurl3'] = $IIIIIlllIlIl;

$IIIIIIIIIl11['startpicurl4'] = $IIIIIlllIlI1;

$IIIIIIIIlI1I = $IIIIIllI1l11->add($IIIIIIIIIl11);

if(false === $IIIIIIIIlI1I){

$IIIIIIIlII1l=array('success'=>0,'msg'=>"操作失败，请重新尝试");

echo json_encode($IIIIIIIlII1l);

exit;

}else{

$IIIIIIIlII1l=array('success'=>1,'msg'=>$IIIIIlIl1Ill);

echo json_encode($IIIIIIIlII1l);

exit;

}

}

public function tpjl(){

$IIIIIlllIl1l=$_GET['zid'];

$IIIIIllI1l1l=$_GET['vid'];

import('./iMicms/Lib/ORG/Page.class.php');

$IIIIIIIII1ll=M('vote_record')->where(array('item_id'=>$IIIIIlllIl1l,'vid'=>$IIIIIllI1l1l))->count();

$IIIIIIIII11I = new Page($IIIIIIIII1ll,20);

$IIIIIIIII11I->setConfig('theme','<li><a>%totalRow% %header%</a></li> %upPage%  %linkPage% %downPage% ');

$IIIIIIIII11l = $IIIIIIIII11I->show();

$IIIIIIIIlIII=M('vote_record')->where(array('item_id'=>$IIIIIlllIl1l,'vid'=>$IIIIIllI1l1l))->order('touch_time desc')->limit($IIIIIIIII11I->firstRow.','.$IIIIIIIII11I->listRows)->select();

$this->assign('page',$IIIIIIIII11l);

$this->assign('liinfo',$IIIIIIIIlIII);

$this->assign('zid',$IIIIIlllIl1l);

$this->assign('vid',$IIIIIllI1l1l);

$this->display();

}

public function outtpjl(){

$IIIIIlllIl1l=$_GET['zid'];

$IIIIIllI1l1l=$_GET['vid'];

$IIIIIIIIlIII=M('vote_record')->where(array('item_id'=>$IIIIIlllIl1l,'vid'=>$IIIIIllI1l1l))->order('touch_time desc')->select();

$IIIIIIIIIl11 = array(  

1 =>array ('序号','投票人openid','投票ip','投票城市','投票时间')					 

);

foreach($IIIIIIIIlIII as $IIIIIIIlI11I=>$IIIIIIIIIlll){

$IIIIIIIIIl11[]= array($IIIIIIIIIlll['id'],$IIIIIIIIIlll['wecha_id'],$IIIIIIIIIlll['ip'],$IIIIIIIIIlll['area'],date("Y-m-d H:i:s",$IIIIIIIIIlll['touch_time']));

}

import('./iMicms/Lib/ORG/Exp_excel.class.php');

$IIIIIlllI1II = new Exp_excel();

$IIIIIlllI1II->addArray($IIIIIIIIIl11);

echo $IIIIIlllI1II->generateXML(time());

}

public function outxls(){

$IIIIIIIII1I1=(int)$this->_get('id');

$IIIIIllII11I=array('vid'=>$IIIIIIIII1I1,'status'=>1);

$IIIIIllI1lIl = M('Vote_item');

$IIIIIllIlIl1 = M('Vote_item')->where($IIIIIllII11I)->field('vcount')->group('vcount')->select();

foreach($IIIIIllIlIl1 as $IIIIIIIlI11I =>$IIIIIIIlI11l){

$IIIIIllIlI1I[$IIIIIIIlI11I] = $IIIIIllIlIl1[$IIIIIIIlI11I]['vcount'];

}

$IIIIIllIlIl1 = array_reverse($IIIIIllIlI1I);

$IIIIIIIIIl11 = array(  

1 =>array ('编号','排名','选手姓名','手机号','选手简介','取消关注人数','最终票数','报名时间','图片地址')					 

);

$IIIIIlllI1I1 = $IIIIIllI1lIl->where($IIIIIllII11I)->order('vcount desc')->select();

foreach($IIIIIlllI1I1 as $IIIIIIIlI11I=>$IIIIIIIIIlll){

$IIIIIllIllIl = array_keys($IIIIIllIlIl1,$IIIIIIIIIlll['vcount']);

$IIIIIllIllIl = intval($IIIIIllIllIl[0]) +1;

$IIIIIIIIIlll['addtime'] = date('Y-m-d H:i:s',$IIIIIIIIIlll['addtime']);

$IIIIIIIIIl11[]= array($IIIIIIIIIlll['id'],$IIIIIllIllIl,$IIIIIIIIIlll['item'],$IIIIIIIIIlll['tourl'],$IIIIIIIIIlll['intro'],$IIIIIIIIIlll['dcount'],$IIIIIIIIIlll['vcount'],$IIIIIIIIIlll['addtime'],$IIIIIIIIIlll['startpicurl']);

}

import('./iMicms/Lib/ORG/Exp_excel.class.php');

$IIIIIlllI1II = new Exp_excel();

$IIIIIlllI1II->addArray($IIIIIIIIIl11);

echo $IIIIIlllI1II->generateXML(time());

}

}

?>