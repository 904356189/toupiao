<?php

class TmplsAction extends UserAction {
public function index() {
$IIIIIIIlIII1 = D('Wxuser');
$IIIIIIIIlIl1['token'] = session('token');
$IIIIIIIIlIl1['uid'] = session('uid');
$IIIIIIIIIlll = $IIIIIIIlIII1->where($IIIIIIIIlIl1)->find();
include('./iMicms/Lib/ORG/index.Tpl.php');
foreach($IIIIIIl1lI11 as $IIIIIIIllIll=>$IIIIIIlIllII){
$IIIIIIl1llll[$IIIIIIIllIll] = $IIIIIIlIllII['sort'];
$IIIIIIl1lll1[$IIIIIIIllIll] = $IIIIIIlIllII['tpltypeid'];
}
array_multisort($IIIIIIl1llll,SORT_DESC ,$IIIIIIl1lll1 ,SORT_DESC ,$IIIIIIl1lI11);
$this->assign('info',$IIIIIIIIIlll);
$this->assign('tpl',$IIIIIIl1lI11);
$IIIIIlIllll1['token']=session('token');
$IIIIIlIllll1['fid']=intval($_GET['fid']);
if(isset($_GET['cid'])){
$IIIIIlIllll1['fid'] = (int)$_GET['cid'];
}
$IIIIIlIlll1I=D('Classify');
$IIIIIlIlll1l=$IIIIIlIlll1I->where($IIIIIlIllll1)->order('sorts desc')->select();
$this->assign('classinfo',$IIIIIlIlll1l);
$this->display();
}
public function QRcode(){
include './iMicms/Lib/ORG/phpqrcode.php';
$IIIIIlIll1II = C('site_url').U('Wap/Index/index',array('token'=>$this->IIIIIIIIlIlI));
$IIIIIII1l1Il = urldecode($IIIIIlIll1II);
QRcode::png($IIIIIII1l1Il,false,0,8);
}
public function add() {
$IIIIII1Ill11 = $this->_get('style');
$IIIIIIIlIII1 = M('Wxuser');
include('./iMicms/Lib/ORG/index.Tpl.php');
foreach ($IIIIIIl1lI11 as $IIIIIIIllIll=>$IIIIIIlIllII){
if($IIIIII1Ill11 == $IIIIIIlIllII['tpltypeid']){
$IIIIIIIIIl11['tpltypeid'] = $IIIIIIlIllII['tpltypeid'];
$IIIIIIIIIl11['tpltypename'] = $IIIIIIlIllII['tpltypename'];
}
}
$IIIIIIIIlIl1['token'] = session('token');
S("homeinfo_".$IIIIIIIIlIl1['token'],NULL);
S("wxuser_".$IIIIIIIIlIl1['token'],NULL);
$IIIIIIIlIII1->where($IIIIIIIIlIl1)->save($IIIIIIIIIl11);
M('Home')->where(array('token'=>session('token')))->save(array('advancetpl'=>0));
if (isset($_GET['noajax'])) {
$this->success('设置成功','/index.php?g=User&m=Tmpls&a=index&token='.$this->IIIIIIIIlIlI);
}
}
public function lists() {
$IIIIII1Ill11 = $this->_get('style');
$IIIIIIIlIII1 = M('Wxuser');
switch ($IIIIII1Ill11) {
case 4:
$IIIIIIIIIl11['tpllistid'] = 4;
$IIIIIIIIIl11['tpllistname'] = 'ktv_list';
break;
case 1:
$IIIIIIIIIl11['tpllistid'] = 1;
$IIIIIIIIIl11['tpllistname'] = 'yl_list';
break;
}
$IIIIIIIIlIl1['token'] = session('token');
$IIIIIIIlIII1->where($IIIIIIIIlIl1)->save($IIIIIIIIIl11);
}
public function content() {
$IIIIII1Ill11 = $this->_get('style');
$IIIIIIIlIII1 = M('Wxuser');
switch ($IIIIII1Ill11) {
case 1:
$IIIIIIIIIl11['tplcontentid'] = 1;
$IIIIIIIIIl11['tplcontentname'] = 'yl_content';
break;
case 3:
$IIIIIIIIIl11['tplcontentid'] = 3;
$IIIIIIIIIl11['tplcontentname'] = 'ktv_content';
break;
}
$IIIIIIIIlIl1['token'] = session('token');
$IIIIIIIlIII1->where($IIIIIIIIlIl1)->save($IIIIIIIIIl11);
}
public function background() {
$IIIIIIIIIl11['color_id'] = $this->_get('style');
$IIIIIIIlIII1 = M('Wxuser');
$IIIIIIIIlIl1['token'] = session('token');
S("homeinfo_".$IIIIIIIIlIl1['token'],NULL);
S("wxuser_".$IIIIIIIIlIl1['token'],NULL);
$IIIIIIIlIII1->where($IIIIIIIIlIl1)->save($IIIIIIIIIl11);
}
public function insert() {
}
public function upsave() {
}
}
?>