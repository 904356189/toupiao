<?php

class Wechat_behaviorAction extends UserAction
{
public $IIIIIIIIlIlI;
private $IIIIIIIIIl11;
private $IIIIIIlIlIll;
public function _initialize()
{
parent::_initialize();
$this->IIIIIIlIlIll = $this->_get('openid','htmlspecialchars');
if ($this->IIIIIIlIlIll == false) {
}
$this->IIIIIIIIlIlI = session('token');
$this->IIIIIIIIIl11  = D('Behavior');
}
public function wechatList()
{
$this->IIIIII1I111I   = $this->_modules();
$IIIIIIIIlIl1['openid'] = $this->IIIIIIlIlIll;
$IIIIIIIIIlIl        = M('wechat_group_list')->where($IIIIIIIIlIl1)->find();
$this->assign('userinfo',$IIIIIIIIIlIl);
$IIIIIlllI1ll = M('wehcat_member_enddate')->where($IIIIIIIIlIl1)->find();
$this->assign('endtime',$IIIIIlllI1ll['enddate']);
$IIIIIIIII1ll = $this->IIIIIIIIIl11->where($IIIIIIIIlIl1)->count();
$IIIIIIIII11I  = new Page($IIIIIIIII1ll,25);
$IIIIIIIIlIII  = $this->IIIIIIIIIl11->where($IIIIIIIIlIl1)->limit($IIIIIIIII11I->firstRow .','.$IIIIIIIII11I->listRows)->order('id desc')->select();
foreach ($IIIIIIIIlIII as $IIIIIIIlI11I =>$IIIIIIlll11l) {
$IIIIIIIIlIII[$IIIIIIIlI11I]['behavior'] = $this->IIIIII1I111I[strtolower($IIIIIIlll11l['model'])]['name'];
if (!$IIIIIIIIlIII[$IIIIIIIlI11I]['behavior']) {
$IIIIIIIIlIII[$IIIIIIIlI11I]['behavior'] = '其他';
}
}
$this->assign('page',$IIIIIIIII11I->show());
$this->assign('list',$IIIIIIIIlIII);
$this->assign('type','list');
$this->display();
}
public function statisticsOfSingleFans()
{
$IIIIIIIIlIl1['openid'] = $this->IIIIIIlIlIll;
$IIIIIIIIIlIl        = M('wechat_group_list')->where($IIIIIIIIlIl1)->find();
$this->assign('userinfo',$IIIIIIIIIlIl);
$IIIIIlllI1ll = M('wehcat_member_enddate')->where($IIIIIIIIlIl1)->find();
$this->assign('endtime',$IIIIIlllI1ll['enddate']);
$this->IIIIII1I111I = $this->_modules();
$IIIIIIlIlIll        = $this->IIIIIIlIlIll;
$IIIIIIIIlIl1         = array(
'token'=>$this->IIIIIIIIlIlI
);
if ($IIIIIIlIlIll) {
$IIIIIIIIlIl1['openid'] = $IIIIIIlIlIll;
}
$IIIIIlIlI111 = M('Behavior');
$IIIIII1lIII1       = $IIIIIlIlI111->where($IIIIIIIIlIl1)->order('num DESC')->select();
$IIIIIIlI11Il       = array();
if ($IIIIII1lIII1) {
foreach ($IIIIII1lIII1 as $IIIIII1Il1I1) {
$IIIIIlIllIII = strtolower($IIIIII1Il1I1['model']);
if (key_exists($IIIIIlIllIII,$IIIIIIlI11Il)) {
$IIIIIIlI11Il[$IIIIIlIllIII]++;
}else {
$IIIIIIlI11Il[$IIIIIlIllIII] = 1;
}
}
}
asort($IIIIIIlI11Il);
$IIIIIlIIll11 = '<chart borderThickness="0" caption="粉丝行为统计分析" baseFontColor="666666" baseFont="宋体" baseFontSize="14" bgColor="FFFFFF" bgAlpha="0" showBorder="0" bgAngle="360" pieYScale="90"  pieSliceDepth="5" smartLineColor="666666">';
if ($IIIIIIlI11Il) {
foreach ($IIIIIIlI11Il as $IIIIIIIllIll =>$IIIIIIlIllII) {
$IIIIIlIIll11 .= '<set label="'.$this->IIIIII1I111I[$IIIIIIIllIll]['name'] .'" value="'.$IIIIIIlIllII .'"/>';
}
}
$IIIIIlIIll11 .= '</chart>';
$this->assign('items',$IIIIII1lIII1);
$this->assign('xml',$IIIIIlIIll11);
$this->display('wechatList');
}
public function statistics()
{
$IIIIIlllI11l = 7;
$this->assign('days',$IIIIIlllI11l);
$this->IIIIII1I111I    = $this->_modules();
$IIIIIIIIlIl1            = array(
'token'=>$this->IIIIIIIIlIlI
);
$IIIIIIIIlIl1['enddate'] = array(
'gt',
time() -$IIIIIlllI11l * 24 * 3600
);
$IIIIIlIlI111      = M('Behavior');
$IIIIII1lIII1            = $IIIIIlIlI111->where($IIIIIIIIlIl1)->order('num DESC')->select();
$IIIIIIlI11Il            = array();
if ($IIIIII1lIII1) {
foreach ($IIIIII1lIII1 as $IIIIII1Il1I1) {
$IIIIIlIllIII = strtolower($IIIIII1Il1I1['model']);
if (key_exists($IIIIIlIllIII,$IIIIIIlI11Il)) {
$IIIIIIlI11Il[$IIIIIlIllIII] += $IIIIII1Il1I1['num'];
}else {
$IIIIIIlI11Il[$IIIIIlIllIII] = $IIIIII1Il1I1['num'];
}
}
}
asort($IIIIIIlI11Il);
$IIIIIlIIll11 = '<chart borderThickness="0" caption="'.$IIIIIlllI11l .'日内粉丝行为分析" baseFontColor="666666" baseFont="宋体" baseFontSize="14" bgColor="FFFFFF" bgAlpha="0" showBorder="0" bgAngle="360" pieYScale="90"  pieSliceDepth="5" smartLineColor="666666">';
if ($IIIIIIlI11Il) {
foreach ($IIIIIIlI11Il as $IIIIIIIllIll =>$IIIIIIlIllII) {
$IIIIIlIIll11 .= '<set label="'.$this->IIIIII1I111I[$IIIIIIIllIll]['name'] .'" value="'.$IIIIIIlIllII .'"/>';
}
}
$IIIIIlIIll11 .= '</chart>';
$this->assign('items',$IIIIII1lIII1);
$this->assign('xml',$IIIIIlIIll11);
$IIIIIIIIlIII = array();
if ($IIIIIIlI11Il) {
foreach ($IIIIIIlI11Il as $IIIIIIIllIll =>$IIIIIlllI111) {
if ($this->IIIIII1I111I[$IIIIIIIllIll]['detail']) {
array_push($IIIIIIIIlIII,array(
'module'=>$IIIIIIIllIll,
'count'=>$IIIIIlllI111,
'name'=>$this->IIIIII1I111I[$IIIIIIIllIll]['name']
));
}
}
}
$IIIIIIIIlIII = array_reverse($IIIIIIIIlIII);
$this->assign('statisticsAll',1);
$this->assign('list',$IIIIIIIIlIII);
$this->assign('listinfo',1);
$this->display();
}
public function statisticsTrend()
{
$IIIIIII111II           = time();
$this->IIIIII1I111I = $this->_modules();
$IIIIIIIIlIl1         = array(
'token'=>$this->IIIIIIIIlIlI
);
$IIIIIlllI11l          = 7;
$this->assign('days',$IIIIIlllI11l);
$IIIIIIIIlIl1['enddate'] = array(
'gt',
$IIIIIII111II -$IIIIIlllI11l * 24 * 3600
);
$IIIIIlIlI111      = M('Behavior');
$IIIIII1lIII1            = $IIIIIlIlI111->where($IIIIIIIIlIl1)->order('num DESC')->select();
$IIIIIIlI11Il            = array();
$IIIIIllllIIl           = array();
if ($IIIIII1lIII1) {
foreach ($IIIIII1lIII1 as $IIIIII1Il1I1) {
$IIIIIlIllIII          = strtolower($IIIIII1Il1I1['model']);
$IIIIIllllIIl[$IIIIIlIllIII] = 0;
if (key_exists($IIIIIlIllIII,$IIIIIIlI11Il)) {
$IIIIIIlI11Il[$IIIIIlIllIII] += $IIIIII1Il1I1['num'];
}else {
$IIIIIIlI11Il[$IIIIIlIllIII] = $IIIIII1Il1I1['num'];
}
}
}
asort($IIIIIIlI11Il);
$IIIIIllllII1 = $IIIIIII111II -2 * $IIIIIlllI11l * 24 * 3600;
$IIIIIlllI1ll   = $IIIIIII111II -$IIIIIlllI11l * 24 * 3600;
$IIIIIllllIlI    = $IIIIIlIlI111->where('token=\''.$this->IIIIIIIIlIlI .'\' AND enddate>'.$IIIIIllllII1 .' AND enddate<'.$IIIIIlllI1ll)->select();
if ($IIIIIllllIlI) {
foreach ($IIIIIllllIlI as $IIIIII1Il1I1) {
$IIIIIlIllIII = strtolower($IIIIII1Il1I1['model']);
$IIIIIllllIIl[$IIIIIlIllIII] += $IIIIII1Il1I1['num'];
}
}
$IIIIIIIIlIII        = array();
$IIIIIlIIll11         = '<chart bgColor="ffffff" outCnvBaseFontColor="666666" caption="'.$IIIIIlllI11l .'天趋势分析图" xAxisName="模块" yAxisName="数量" showNames="1" showValues="0" plotFillAlpha="50" numVDivLines="10" showAlternateVGridColor="1" bgAlpha="0" showBorder="0" bgColor="ffffff" AlternateVGridColor="e1f5ff" divLineColor="e1f5ff" vdivLineColor="e1f5ff" baseFontColor="666666" baseFontSize="12" borderThickness="0" canvasBorderThickness="0" showPlotBorder="0" plotBorderThickness="0" canvasBorderColor="eeeeee">';
$IIIIIllllIll = '<categories>';
$IIIIIllllIl1    = '<dataset seriesName="本周期" color="B1D1DC" plotBorderColor="B1D1DC">';
if ($IIIIIIlI11Il) {
$IIIIIIIllI11 = 0;
foreach ($IIIIIIlI11Il as $IIIIIIIllIll =>$IIIIIIlIllII) {
$IIIIIllllI1I = $this->IIIIII1I111I[$IIIIIIIllIll]['name'];
if (!$IIIIIllllI1I) {
$IIIIIllllI1I = $IIIIIIIllIll;
}
$IIIIIIIIlIII[$IIIIIIIllI11] = array(
'name'=>$IIIIIllllI1I,
'count'=>$IIIIIIlIllII,
'lastcount'=>0
);
$IIIIIllllIll .= '<category label="'.$IIIIIllllI1I .'"/>';
$IIIIIllllIl1 .= '<set value="'.$IIIIIIlIllII .'"/>';
$IIIIIIIllI11++;
}
}
$IIIIIllllIll .= '</categories>';
$IIIIIllllIl1 .= '</dataset>';
$IIIIIllllI1l = '<dataset seriesName="上一周期" color="C8A1D1" plotBorderColor="C8A1D1">';
if ($IIIIIllllIIl) {
$IIIIIIIllI11 = 0;
foreach ($IIIIIllllIIl as $IIIIIIIllIll =>$IIIIIIlIllII) {
$IIIIIIIIlIII[$IIIIIIIllI11]['lastcount'] = $IIIIIIlIllII;
$IIIIIllllI1l .= '<set value="'.$IIIIIIlIllII .'"/>';
$IIIIIIIllI11++;
}
}
$IIIIIllllI1l .= '</dataset>';
$IIIIIlIIll11 .= $IIIIIllllIll .$IIIIIllllIl1 .$IIIIIllllI1l .'</chart>';
$this->assign('xml',$IIIIIlIIll11);
$this->assign('statisticsTrend',1);
$this->assign('list',$IIIIIIIIlIII);
$this->display('statistics');
}
public function statisticsOfModule()
{
$this->IIIIII1I111I = $this->_modules();
if (!$this->IIIIII1I111I[$_GET['module']]) {
$this->error('非法操作');
}
$IIIIIIIIlIl1            = array(
'token'=>$this->IIIIIIIIlIlI
);
$IIIIIIIIlIl1['enddate'] = array(
'gt',
time() -30 * 24 * 3600
);
$IIIIIIIIlIl1['model']   = $_GET['module'];
$IIIIIlIlI111      = M('Behavior');
$IIIIII1lIII1            = $IIIIIlIlI111->where($IIIIIIIIlIl1)->order('num DESC')->select();
$IIIIIIIIlIII             = array();
$IIIIII111111              = array();
if ($IIIIII1lIII1) {
foreach ($IIIIII1lIII1 as $IIIIII1Il1I1) {
if (in_array($IIIIII1Il1I1['fid'],$IIIIII111111)) {
$IIIIIIIIlIII[$IIIIII1Il1I1['fid']]['count'] += $IIIIII1Il1I1['num'];
}else {
$IIIIIIIIlIII[$IIIIII1Il1I1['fid']] = array(
'count'=>$IIIIII1Il1I1['num']
);
array_push($IIIIII111111,$IIIIII1Il1I1['fid']);
}
}
}
asort($IIIIIIIIlIII);
$IIIIIIIlIII1     = M($_GET['module']);
$IIIIIlllllII     = $IIIIIIIlIII1->where(array(
'id'=>array(
'in',
$IIIIII111111
)
))->select();
$IIIIIlllllIl = array();
if ($IIIIIlllllII) {
foreach ($IIIIIlllllII as $IIIIIIIIllI1) {
$IIIIIlllllIl[$IIIIIIIIllI1['id']] = $IIIIIIIIllI1;
}
}
if ($IIIIIIIIlIII) {
foreach ($IIIIIIIIlIII as $IIIIIIIllIll =>$IIIIIII1II1l) {
$IIIIIIIIlIII[$IIIIIIIllIll]['fid']  = $IIIIIlllllIl[$IIIIIIIllIll]['id'];
$IIIIIIIIlIII[$IIIIIIIllIll]['name'] = $IIIIIlllllIl[$IIIIIIIllIll]['name'] ?$IIIIIlllllIl[$IIIIIIIllIll]['name'] : $IIIIIlllllIl[$IIIIIIIllIll]['title'];
if (!$IIIIIIIIlIII[$IIIIIIIllIll]['fid']) {
unset($IIIIIIIIlIII[$IIIIIIIllIll]);
}
}
}
$this->assign('list',$IIIIIIIIlIII);
$IIIIIlIIll11 = '<chart borderThickness="0" caption="'.$this->IIIIII1I111I[$_GET['module']]['name'] .'详细统计" baseFontColor="666666" baseFont="宋体" baseFontSize="14" bgColor="FFFFFF" bgAlpha="0" showBorder="0" smartLineColor="cccccc"  showValues="0" canvasBorderThickness="1" canvasBorderColor="eeeeee" decimalPrecision="0" plotFillAngle="30" plotBorderColor="999999" showAlternateVGridColor="1" divLineAlpha="0">';
if ($IIIIIIIIlIII) {
foreach ($IIIIIIIIlIII as $IIIIIIIllIll =>$IIIIIIlIllII) {
$IIIIIlIIll11 .= '<set label="'.$IIIIIIlIllII['name'] .'" value="'.$IIIIIIlIllII['count'] .'"/>';
}
}
$IIIIIlIIll11 .= '</chart>';
$this->assign('xml',$IIIIIlIIll11);
$this->assign('detail',1);
$this->assign('listinfo',1);
$this->display('statistics');
}
private function getModel($IIIIIlIllI1l,$IIIIIIlIllIl = '1')
{
$IIIIIIIIIl11['token'] = session('token');
$IIIIIIIIIl11['model'] = $IIIIIlIllI1l;
if ($IIIIIIlIllIl == 1) {
$IIIIIIIIIl11['openid'] = $this->IIIIIIlIlIll;
}
$IIIIIllllllI = $this->IIIIIIIIIl11->where($IIIIIIIIIl11)->select();
return count($IIIIIllllllI);
}
public function _modules()
{
return array(
'home'=>array(
'name'=>'微网站'
),
'text'=>array(
'name'=>'文本请求',
'detail'=>1
),
'member_card_set'=>array(
'name'=>'会员卡'
),
'lottery'=>array(
'name'=>'推广活动',
'detail'=>1
),
'help'=>array(
'name'=>'帮助'
),
'wedding'=>array(
'name'=>'婚庆喜帖',
'detail'=>1
),
'img'=>array(
'name'=>'图文消息',
'detail'=>1
),
'selfform'=>array(
'name'=>'万能表单',
'detail'=>1
),
'host'=>array(
'name'=>'通用订单',
'detail'=>1
),
'panorama'=>array(
'name'=>'全景',
'detail'=>1
),
'usernamecheck'=>array(
'name'=>'账号审核'
),
'album'=>array(
'name'=>'相册'
),
'vote'=>array(
'name'=>'投票',
'detail'=>1
),
'product'=>array(
'name'=>'商城',
'detail'=>1
),
'voiceresponse'=>array(
'name'=>'语音消息'
),
'estate'=>array(
'name'=>'房产'
),
'follow'=>array(
'name'=>'关注'
)
);
}
public function modelName($IIIIIII1IlII)
{
$IIIIII1l1l11 = array(
'3G微网站'=>'3G微网站',
'Lottery'=>'1',
'Member_card_set'=>'会员卡',
'Wedding'=>'喜帖',
'Img'=>'图文信息',
'帮助'=>'帮助提示',
'Selfform'=>'万能表单功能',
'Text'=>'文本信息',
'Host'=>'订单信息',
'帐号审核'=>'帐号审核',
'3g相册'=>'帐号审核',
'Vote'=>'投票活动',
'Product'=>'电商产品'
);
return $IIIIII1l1l11[$IIIIIII1IlII];
}
}
?>