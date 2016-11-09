<?php

class UserAction extends BaseAction
{
public $IIIIIl1IlI11;
public $IIIIIIIIlIlI;
public $IIIIIIIIII1I;
public $IIIIIl1IllII;
protected function _initialize()
{
parent::_initialize();
$IIIIIIIIIlIl        = M('User_group')->where(array(
'id'=>session('gid')
))->find();
$this->IIIIIl1IlI11 = $IIIIIIIIIlIl;
$IIIIII1I1IIl = M('Users') ->where(array('id'=>$_SESSION['uid'])) ->find();
$this ->IIIIIIIIII1I = $IIIIII1I1IIl;
$this ->assign('thisUser',$IIIIII1I1IIl);
$IIIIII1I1IIl           = M('Users')->where(array(
'id'=>$_SESSION['uid']
))->find();
$this->IIIIIIIIII1I      = $IIIIII1I1IIl;
$this->assign('thisUser',$IIIIII1I1IIl);
$this->assign('viptime',$IIIIII1I1IIl['viptime']);
if (session('uid')) {
if ($IIIIII1I1IIl['viptime'] <time()) {
session(null);
session_destroy();
unset($_SESSION);
$this->error('您的帐号已经到期，请充值后再使用');
}
}
$IIIIIIl1111l = M('Wxuser')->field('wxname,weixin,wxid,headerpic')->where(array(
'token'=>session('token'),
'uid'=>session('uid')
))->find();
$this->assign('wecha',$IIIIIIl1111l);
$this->IIIIIIIIlIlI = session('token');
$this->assign('token',$this->IIIIIIIIlIlI);
$IIIIIIl11l1I          = M('token_open')->field('queryname')->where(array(
'token'=>$this->IIIIIIIIlIlI
))->find();
$this->IIIIIl1IllII = explode(',',$IIIIIIl11l1I['queryname']);
$this->assign('userinfo',$IIIIIIIIIlIl);
if (session('uid') == false) {
if (MODULE_NAME != 'Upyun') {
if(MODULE_NAME == 'Vote'&&ACTION_NAME == 'share'){}
else{
$this->redirect('Home/Index/index');
}
}
}
if (session('companyLogin') == 1 &&!in_array(MODULE_NAME,array(
'Attachment',
'Repast',
'Upyun',
'Hotels'
))) {
$this->redirect(U('User/Repast/index',array(
'cid'=>session('companyid')
)));
}
define('UNYUN_BUCKET',C('up_bucket'));
define('UNYUN_USERNAME',C('up_username'));
define('UNYUN_PASSWORD',C('up_password'));
define('UNYUN_FORM_API_SECRET',C('up_form_api_secret'));
define('UNYUN_DOMAIN',C('up_domainname'));
$this->assign('upyun_domain','http://'.UNYUN_DOMAIN);
$this->assign('upyun_bucket',UNYUN_BUCKET);
$IIIIIIIIlIlI = $this->_session('token');
if (!$IIIIIIIIlIlI) {
if (isset($_GET['token'])) {
$IIIIIIIIlIlI = $this->_get('token');
}else {
$IIIIIIIIlIlI = 'admin';
}
}
$IIIIII11II11                         = array();
$IIIIIII111II                             = time();
$IIIIII11II11['bucket']               = UNYUN_BUCKET;
$IIIIII11II11['expiration']           = $IIIIIII111II +600;
$IIIIII11II11['save-key']             = ((('/'.$IIIIIIIIlIlI) .'/{year}/{mon}/{day}/') .$IIIIIII111II) .'_{random}{.suffix}';
$IIIIII11II11['allow-file-type']      = C('up_exts');
$IIIIII11II11['content-length-range'] = '0,'.intval(C('up_size')) * 1000;
if (isset($_GET['width'])) {
if (intval($_GET['width'])) {
$IIIIII11II11['x-gmkerl-type'] = 'fix_width';
$IIIIII11II11['fix_width ']    = $_GET['width'];
}
}
$IIIIII11IlII = base64_encode(json_encode($IIIIII11II11));
$IIIIII11IlIl   = md5(($IIIIII11IlII .'&') .UNYUN_FORM_API_SECRET);
$this->assign('editor_upyun_sign',$IIIIII11IlIl);
$this->assign('editor_upyun_policy',$IIIIII11IlII);
}
public function canUseFunction($IIIIIl1Ill1l)
{
$IIIIIIl11l1I = M('token_open')->field('queryname')->where(array(
'token'=>$this->IIIIIIIIlIlI
))->find();
if (C('agent_version') &&$this->IIIIIIII1II1) {
$IIIIIIlll1lI = M('Agent_function')->where(array(
'funname'=>$IIIIIl1Ill1l,
'agentid'=>$this->IIIIIIII1II1
))->find();
}else {
$IIIIIIlll1lI = M('Function')->where(array(
'funname'=>$IIIIIl1Ill1l
))->find();
}
}
}
?>