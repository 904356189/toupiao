<?php

class BackAction extends BaseAction{
protected $IIIIIIIIlllI;
protected function _initialize(){
if(!isset($_SESSION['username'])){$this->error('非法操作',U('System/Admin/index'));}
parent::_initialize();
if (C('USER_AUTH_ON') &&!in_array(MODULE_NAME,explode(',',C('NOT_AUTH_MODULE')))) {
if (!RBAC::AccessDecision()) {
if (!$_SESSION [C('USER_AUTH_KEY')]) {
redirect(PHP_FILE .C('USER_AUTH_GATEWAY'));
}
if (C('RBAC_ERROR_PAGE')) {
redirect(C('RBAC_ERROR_PAGE'));
}else {
if (C('GUEST_AUTH_ON')) {
$this->assign('jumpUrl',PHP_FILE .C('USER_AUTH_GATEWAY'));
}
$this->error(L('_VALID_ACCESS_'));
}
}
}
$this->show_menu();
}
private function show_menu(){
$this->IIIIIIIIlllI=$this->_get('pid','intval')?$this->_get('pid','intval'):2;
$IIIIIIIIlIl1['level']=$this->_get('level','intval');
$IIIIIIIIlIl1['pid']=$this->IIIIIIIIlllI;
$IIIIIIIIll11=rawurldecode($this->_get('title'));
$IIIIIIIIlIl1['status']=1;
$IIIIIIIIlIl1['display']=array('gt',0);
$IIIIIIIIl1Il['sort']='asc';
$IIIIIIIIl1I1=M('Node')->where($IIIIIIIIlIl1)->order($IIIIIIIIl1Il)->select();
$this->assign('title',$IIIIIIIIll11);
$this->assign('nav',$IIIIIIIIl1I1);
}
}?>