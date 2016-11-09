<?php

class BaseAction extends Action
{
public $IIIIIIIIl1ll;
public $IIIIIIIIl1l1;
public $IIIIIIIIl11I;
public $IIIIIIIIl11l;
public $IIIIIIIIl111;
public $IIIIIIII1III;
public $IIIIIIII1IIl;
public $IIIIIIII1II1;
public $IIIIIIII1IlI;
protected function _initialize()
{
define('RES',THEME_PATH .'common');
define('STATICS',TMPL_PATH .'static');
$this->assign('action',$this->getActionName());
$this->IIIIIIIIl1ll = 0;
if (C('agent_version')) {
$IIIIIIII1IIl = M('agent')->where(array(
'siteurl'=>'http://'.$_SERVER['HTTP_HOST']
))->find();
if ($IIIIIIII1IIl) {
$this->IIIIIIIIl1ll = 1;
}
}
if (!$this->IIIIIIIIl1ll) {
$this->IIIIIIII1II1       = 0;
if (!C('site_logo')) {
$IIIIIIII1I1I = 'tpl/Home/default/common/images/logo-iMicms.png';
}else {
$IIIIIIII1I1I = C('site_logo');
}
$IIIIIIII1I1l          = C('SITE_NAME');
$IIIIIIII1I11         = C('SITE_TITLE');
$IIIIIIII1lII       = C('keyword');
$IIIIIIII1lIl           = C('content');
$IIIIIIII1lI1                = C('site_qq');
$IIIIIIII1llI                = C('site_kfqq');
$IIIIIIII1lll                = C('site_qqqun');
$IIIIIIII1ll1                = C('site_tel');
$IIIIIIII1l1I                = C('site_email');
$IIIIIIII1l1l                = C('chatkey');
$IIIIIIII1l11                = C('drbg');
$IIIIIIII11II                = C('drlogo');
$IIIIIIII11Il            = C('site_qrcode');
$IIIIIIII11I1           = C('site_url');
$IIIIIIII11lI           = C('lt_url');
$IIIIIIII11ll           = C('ipc');
$IIIIIIII11l1           = C('copyright');
$this->IIIIIIIIl1l1    = C('DEFAULT_THEME');
$IIIIIIII111I         = C('reg_needmp') == 'true'?1 : 0;
$this->IIIIIIIIl11I = C('ischeckuser') == 'false'?1 : 0;
$this->IIIIIIIIl11l    = 1;
$this->IIIIIIIIl111 = C('reg_validdays');
$this->IIIIIIII1III   = C('reg_groupid');
$this->IIIIIIII1IlI       = C('site_mp');
$IIIIIIII1ll1               = C('site_tel');
}else {
$this->IIIIIIII1II1    = $IIIIIIII1IIl['id'];
$this->IIIIIIII1IIl  = $IIIIIIII1IIl;
$IIIIIIII1I1I           = $IIIIIIII1IIl['sitelogo'];
$IIIIIIII1I1l       = $IIIIIIII1IIl['sitename'];
$IIIIIIII1I11      = $IIIIIIII1IIl['sitetitle'];
$IIIIIIII1lII    = $IIIIIIII1IIl['metakeywords'];
$IIIIIIII1lIl        = $IIIIIIII1IIl['metades'];
$IIIIIIII1lI1             = $IIIIIIII1IIl['qq'];
$IIIIIIII1llI                = C('site_kfqq');
$IIIIIIII1lll                = C('site_qqqun');
$IIIIIIII1ll1                = C('site_tel');
$IIIIIIII1l1I                = C('site_email');
$IIIIIIII1l1l                = C('chatkey');
$IIIIIIII1l11                = C('drbg');
$IIIIIIII11II                = C('drlogo');
$IIIIIIII11l1           = C('copyright');
$IIIIIIII11lI           = C('lt_url');
$IIIIIIII11ll           = C('ipc');
$IIIIIIII11Il         = $IIIIIIII1IIl['qrcode'];
$IIIIIIII11I1        = $IIIIIIII1IIl['siteurl'];
$this->IIIIIIIIl1l1 = C('DEFAULT_THEME');
if (file_exists($_SERVER['DOCUMENT_ROOT'] .'/tpl/Home/'.'agent_'.$IIIIIIII1IIl['id'])) {
$this->IIIIIIIIl1l1 = 'agent_'.$IIIIIIII1IIl['id'];
}
$IIIIIIII111I         = $IIIIIIII1IIl['regneedmp'];
$this->IIIIIIIIl11I = $IIIIIIII1IIl['needcheckuser'];
$IIIIIIII111l            = M('User_group')->where(array(
'agentid'=>$IIIIIIII1IIl['id']
))->order('id ASC')->find();
$this->IIIIIIIIl11l    = $IIIIIIII111l['id'];
$this->IIIIIIIIl111 = $IIIIIIII1IIl['regvaliddays'];
$this->IIIIIIII1III   = C('reggid');
$this->IIIIIIII1IlI       = $IIIIIIII1IIl['mp'];
$IIIIIIII1ll1               = $IIIIIIII1IIl['mp'];
}
$this->assign('f_tel',$IIIIIIII1ll1);
$this->assign('f_logo',$IIIIIIII1I1I);
$this->assign('f_siteName',$IIIIIIII1I1l);
$this->assign('f_siteTitle',$IIIIIIII1I11);
$this->assign('f_metaKeyword',$IIIIIIII1lII);
$this->assign('f_metaDes',$IIIIIIII1lIl);
$this->assign('f_qq',$IIIIIIII1lI1);
$this->assign('f_qqqun',$IIIIIIII1lll);
$this->assign('f_kfqq',$IIIIIIII1llI);
$this->assign('f_email',$IIIIIIII1l1I);
$this->assign('f_chatkey',$IIIIIIII1l1l);
$this->assign('f_drbg',$IIIIIIII1l11);
$this->assign('f_drlogo',$IIIIIIII11II);
$this->assign('f_copyright',$IIIIIIII11l1);
$this->assign('f_ipc',$IIIIIIII11ll);
$this->assign('f_tel',$IIIIIIII1ll1);
$this->assign('f_qrcode',$IIIIIIII11Il);
$this->assign('f_siteUrl',$IIIIIIII11I1);
$this->assign('f_ltUrl',$IIIIIIII11lI);
$this->assign('f_regNeedMp',$IIIIIIII111I);
}
protected function all_insert($IIIIIIIlIIII = '',$IIIIIIIlIIIl = '/index')
{
$IIIIIIIlIIII = $IIIIIIIlIIII ?$IIIIIIIlIIII : MODULE_NAME;
$IIIIIIIlIII1   = D($IIIIIIIlIIII);
if ($IIIIIIIlIII1->create() === false) {
$this->error($IIIIIIIlIII1->getError());
}else {
$IIIIIIIII1I1 = $IIIIIIIlIII1->add();
if ($IIIIIIIII1I1) {
$IIIIIIIlIIlI = array(
'Img',
'Text',
'Voiceresponse',
'Ordering',
'Lottery',
'Host',
'Product',
'Selfform',
'Panorama',
'Wedding',
'Vote',
'Goldegg',
'Estate',
'Reservation',
'Car_baoyang',
'Car_guanhuai',
'Medical',
'Shipin',
'Jiaoyu',
'Lvyou',
'Huadian',
'Wuye',
'Jiuba',
'Hunqing',
'Zhuangxiu',
'Ktv',
'Jianshen',
'Zhengwu',
'Cosmetology',
'Greeting_card',
'Diaoyan',
'Invites',
'Carowner',
'Carset',
'Kefu',
'Home',
'Wifi'
);
if (in_array($IIIIIIIlIIII,$IIIIIIIlIIlI)) {
$IIIIIIIIIl11['pid']=$IIIIIIIII1I1;
$IIIIIIIIIl11['module']=$IIIIIIIlIIII;
$IIIIIIIIIl11['token']=session('token');
$IIIIIIIIIl11['keyword']=$_POST['keyword'];
M('Keyword')->add($IIIIIIIIIl11);
}
$this->success('操作成功',U(MODULE_NAME .$IIIIIIIlIIIl));
}else {
$this->error('操作失败',U(MODULE_NAME .$IIIIIIIlIIIl));
}
}
}
protected function insert($IIIIIIIlIIII = '',$IIIIIIIlIIIl = '/index')
{
$IIIIIIIlIIII = $IIIIIIIlIIII ?$IIIIIIIlIIII : MODULE_NAME;
$IIIIIIIlIII1   = D($IIIIIIIlIIII);
if ($IIIIIIIlIII1->create() === false) {
$this->error($IIIIIIIlIII1->getError());
}else {
$IIIIIIIII1I1 = $IIIIIIIlIII1->add();
if ($IIIIIIIII1I1 == true) {
$this->success('操作成功',U(MODULE_NAME .$IIIIIIIlIIIl));
}else {
$this->error('操作失败',U(MODULE_NAME .$IIIIIIIlIIIl));
}
}
}
protected function save($IIIIIIIlIIII = '',$IIIIIIIlIIIl = '/index')
{
$IIIIIIIlIIII = $IIIIIIIlIIII ?$IIIIIIIlIIII : MODULE_NAME;
$IIIIIIIlIII1   = D($IIIIIIIlIIII);
if ($IIIIIIIlIII1->create() === false) {
$this->error($IIIIIIIlIII1->getError());
}else {
$IIIIIIIII1I1 = $IIIIIIIlIII1->save();
if ($IIIIIIIII1I1 == true) {
$this->success('操作成功',U(MODULE_NAME .$IIIIIIIlIIIl));
}else {
$this->error('操作失败',U(MODULE_NAME .$IIIIIIIlIIIl));
}
}
}
protected function all_save($IIIIIIIlIIII = '',$IIIIIIIlIIIl = '/index',$IIIIIIIlII1l = array())
{
$IIIIIIIlIIII = $IIIIIIIlIIII ?$IIIIIIIlIIII : MODULE_NAME;
$IIIIIIIlIII1   = D($IIIIIIIlIIII);
if ($IIIIIIIlIII1->create() === false) {
$this->error($IIIIIIIlIII1->getError());
}else {
$IIIIIIIII1I1 = $IIIIIIIlIII1->save();
if ($IIIIIIIII1I1) {
$IIIIIIIlIIlI = array(
'Img',
'Text',
'Voiceresponse',
'Ordering',
'Lottery',
'Host',
'Product',
'Selfform',
'Panorama',
'Wedding',
'Vote',
'Goldegg',
'Estate',
'Reservation',
'Car_baoyang',
'Car_guanhuai',
'Medical',
'Shipin',
'Jiaoyu',
'Lvyou',
'Huadian',
'Wuye',
'Jiuba',
'Hunqing',
'Zhuangxiu',
'Ktv',
'Jianshen',
'Zhengwu',
'Cosmetology',
'Greeting_card',
'Diaoyan',
'Invites',
'Carowner',
'Wifi',
'Kefu',
'Home',
'Carset'
);
if (in_array($IIIIIIIlIIII,$IIIIIIIlIIlI)) {
$IIIIIIIIIl11['pid']    = $_POST['id'];
$IIIIIIIIIl11['module'] = $IIIIIIIlIIII;
$IIIIIIIIIl11['token']  = session('token');
$IIIIIIIlII11['keyword']  = $_POST['keyword'];
M('Keyword')->where($IIIIIIIIIl11)->save($IIIIIIIlII11);
}
$this->success('操作成功',U(MODULE_NAME .$IIIIIIIlIIIl,$IIIIIIIlII1l));
}else {
$this->error('操作失败',U(MODULE_NAME .$IIIIIIIlIIIl,$IIIIIIIlII1l));
}
}
}
protected function del_id($IIIIIIIlIIII = '',$IIIIIIIlIlIl = '')
{
$IIIIIIIlIIII           = $IIIIIIIlIIII ?$IIIIIIIlIIII : MODULE_NAME;
$IIIIIIIlIlIl           = empty($IIIIIIIlIIII) ?MODULE_NAME .'/index': $IIIIIIIlIlIl;
$IIIIIIIlIII1             = D($IIIIIIIlIIII);
$IIIIIIIIlIl1['id']    = $this->_get('id','intval');
$IIIIIIIIlIl1['token'] = session('token');
if ($IIIIIIIlIII1->where($IIIIIIIIlIl1)->delete()) {
$this->success('操作成功',U($IIIIIIIlIlIl));
}else {
$this->error('操作失败',U(MODULE_NAME .'/index'));
}
}
protected function all_del($IIIIIIIII1I1,$IIIIIIIlIIII = '',$IIIIIIIlIIIl = '/index')
{
$IIIIIIIlIIII = $IIIIIIIlIIII ?$IIIIIIIlIIII : MODULE_NAME;
$IIIIIIIlIII1   = D($IIIIIIIlIIII);
if ($IIIIIIIlIII1->delete($IIIIIIIII1I1)) {
$this->ajaxReturn('操作成功',U(MODULE_NAME .$IIIIIIIlIIIl));
}else {
$this->ajaxReturn('操作失败',U(MODULE_NAME .$IIIIIIIlIIIl));
}
}
}
?>