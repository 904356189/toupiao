<?php

function strExists($IIIII1I1lIl1,$IIIII1I1lI1I)
{
return !(strpos($IIIII1I1lIl1,$IIIII1I1lI1I) === FALSE);
}
class IndexAction extends WapAction{
private $IIIIIIl1lI11;
private $IIIIIIIIIlll;
public $IIIIIlIIIll1;
public $IIIII1Il11I1;
public $IIIIIII11l1l;
public $IIIIIIIIlIlI;
public $IIIII1I1lI1l;
public $IIIIII1III1l;
public function _initialize(){
parent::_initialize();
$IIIIIIIIlIl1['token']=$this->IIIIIIIIlIlI;
$IIIIIIl1lI11=$this->IIIIIIIIllIl;
$this->IIIII1I1lI1l=$IIIIIIl1lI11;
if (isset($_GET['wecha_id'])&&$_GET['wecha_id']){
$_SESSION['wecha_id']=$_GET['wecha_id'];
}
$IIIII1Illl11=M('Kefu')->where($IIIIIIIIlIl1)->find();
$this->assign('kefu',$IIIII1Illl11);
$IIIII1I1lI11=M('Classify')->where(array('token'=>$this->_get('token'),'status'=>1))->order('sorts desc')->select();
$IIIII1I1lI11=$this->convertLinks($IIIII1I1lI11);
$IIIIIIIIIlll=array();
if ($IIIII1I1lI11){
$IIIII1I1llII=array();
$IIIII1I1llIl=0;
foreach ($IIIII1I1lI11 as $IIIIIII11IIl){
$IIIII1I1llII[$IIIIIII11IIl['id']]=$IIIIIII11IIl;
if ($IIIIIII11IIl['fid']==0){
$IIIIIII11IIl['sub']=array();
$IIIIIIIIIlll[$IIIIIII11IIl['id']]=$IIIIIII11IIl;
$IIIII1I1llIl++;
}
}
foreach ($IIIII1I1lI11 as $IIIIIII11IIl){
if ($IIIIIII11IIl['fid']>0&&$IIIIIIIIIlll[$IIIIIII11IIl['fid']]){
array_push($IIIIIIIIIlll[$IIIIIII11IIl['fid']]['sub'],$IIIIIII11IIl);
}
}
if($IIIIIIIIIlll){
foreach($IIIIIIIIIlll as $IIIIIII11IIl){
$IIIIIIIIIlll[$IIIIIII11IIl['id']]['key']=$IIIII1I1llIl--;
}
}
}
$IIIIII1III1l=$this->IIIIII1III1l;
$IIIIII1III1l['info'] = str_replace(array("\r\n","\"","&quot;"),array(' ','',''),$IIIIII1III1l['info']);
$this->IIIIII1III1l['info'] = $IIIIII1III1l['info'];
$this->IIIIIIIIIlll=$IIIIIIIIIlll;
$IIIIIIl1lI11['color_id']=intval($IIIIIIl1lI11['color_id']);
$this->IIIIIIl1lI11=$IIIIIIl1lI11;
}
public function debug(){
}
public function classify(){
$this->assign('info',$this->IIIIIIIIIlll);
$this->display($this->IIIIIIl1lI11['tpltypename']);
}
public function index(){
if ($this->IIIIII1III1l['advancetpl']){
echo '<script>window.location.href="/cms/index.php?token='.$this->IIIIIIIIlIlI.'&wecha_id='.$this->IIIIIlIIIll1.'";</script>';
exit();
}
$IIIIIIIIlIl1['token']=$this->IIIIIIIIlIlI;
$IIIII1I1lllI=M('Flash')->where($IIIIIIIIlIl1)->select();
$IIIII1I1lllI=$this->convertLinks($IIIII1I1lllI);
$IIIII1I1llll=array();
$IIIII1I1lll1=array();
foreach ($IIIII1I1lllI as $IIIII1I1ll1I){
if ($IIIII1I1ll1I['url']==''){
$IIIII1I1ll1I['url']='javascript:void(0)';
}
if ($IIIII1I1ll1I['tip']==1){
array_push($IIIII1I1llll,$IIIII1I1ll1I);
}elseif ($IIIII1I1ll1I['tip']==2) {
array_push($IIIII1I1lll1,$IIIII1I1ll1I);
}
}
$this->assign('flashbg',$IIIII1I1lll1);
if(!$IIIII1I1lll1&&$this->IIIIII1III1l['homeurl']){
$IIIII1I1ll1l=M('Flash');
$IIIIIIIlII1l=array();
$IIIIIIIlII1l['token']=$this->IIIIIIIIlIlI;
$IIIIIIIlII1l['img']=$this->IIIIII1III1l['homeurl'];
$IIIIIIIlII1l['url']='';
$IIIIIIIlII1l['info']='';
$IIIIIIIlII1l['tip']=2;
if ($IIIIIIIlII1l['img']){
$IIIII1I1ll1l->add($IIIIIIIlII1l);
}
}
$IIIIIIIIIlll = $this->IIIIIIIIIlll;
$IIIII1I1ll11=$this->IIIIIIIIllIl;
$IIIII1I1ll11['color_id']=intval($IIIII1I1ll11['color_id']);
include('./iMicms/Lib/ORG/index.Tpl.php');
foreach($IIIIIIl1lI11 as $IIIIIIIllIll=>$IIIIIIlIllII){
if($IIIIIIlIllII['tpltypeid'] == $IIIII1I1ll11['tpltypeid']){
$IIIII1I1l1II = $IIIIIIlIllII;
}
}
$IIIII1I1ll11['tpltypeid'] = $IIIII1I1l1II['tpltypeid'];
$IIIII1I1ll11['tpltypename'] = $IIIII1I1l1II['tpltypename'];
foreach($IIIIIIIIIlll as $IIIIIIIllIll=>$IIIIIIlIllII){
if($IIIIIIIIIlll[$IIIIIIIllIll]['url'] == ''){
$IIIIIIIIIlll[$IIIIIIIllIll]['url'] = U('Index/lists',array('classid'=>$IIIIIIlIllII['id'],'token'=>$IIIIIIIIlIl1['token'],'wecha_id'=>$this->IIIIIlIIIll1));
}
}
if($IIIII1I1ll11['tpltypename'] == 'ktv_list'||$IIIII1I1ll11['tpltypename'] == 'yl_list'){
foreach($IIIIIIIIIlll as $IIIIIIIlI11I=>$IIIIIIl1llIl){
$IIIIIIIIIlll[$IIIIIIIlI11I]['title'] = $IIIIIIl1llIl['name'];
$IIIIIIIIIlll[$IIIIIIIlI11I]['pic'] = $IIIIIIl1llIl['img'];
if($IIIIIIIIIlll[$IIIIIIIlI11I]['url'] == ''){
$IIIIIIIIIlll[$IIIIIIIlI11I]['url'] = U('Index/lists',array('classid'=>$IIIIIIl1llIl['id'],'token'=>$IIIIIIIIlIl1['token'],'wecha_id'=>$this->IIIIIlIIIll1));
}
$IIIIIIIIIlll[$IIIIIIIlI11I]['info'] = strip_tags(htmlspecialchars_decode($IIIIIIl1llIl['info']));
}
}
$IIIIIIIII1ll=count($IIIII1I1llll);
$this->assign('flash',$IIIII1I1llll);
$this->assign('homeInfo',$this->IIIIII1III1l);
$this->assign('info',$IIIIIIIIIlll);
$this->assign('num',$IIIIIIIII1ll);
$this->assign('flashbgcount',count($IIIII1I1lll1));
$this->assign('tpl',$this->IIIIIIl1lI11);
$this->assign('copyright',$this->IIIII1Il11I1);
if($this->IIIIII1III1l['bjdh']!=''&&$this->IIIIII1III1l['bjdh']!=0){
$this->assign('bjdh','<div id="leafContainer"></div>
	<style>
	#leafContainer{position: fixed;z-index:99;top:0;}
	#leafContainer > div {position: absolute;max-width: 100px;max-height: 100px;-webkit-animation-iteration-count: infinite, infinite;-webkit-animation-direction: normal, normal;-webkit-animation-timing-function: linear, ease-in;}
	#leafContainer > div > img {position: absolute;width: 100%;-webkit-animation-iteration-count: infinite;-webkit-animation-direction: alternate;-webkit-animation-timing-function: ease-in-out;-webkit-transform-origin: 50% -100%;}
	@-webkit-keyframes fade{0%{ opacity: 1; }
	95%{ opacity: 1; }
	100%{ opacity: 0; }
	}
	@-webkit-keyframes drop
	{
	0% {-webkit-transform: translate(0px, -50px); }
	100%{ -webkit-transform: translate(0px, 650px); }
	}
	@-webkit-keyframes clockwiseSpin
	{
	0% { -webkit-transform: rotate(-50deg); }
	100% { -webkit-transform: rotate(50deg); }
	}
	@-webkit-keyframes counterclockwiseSpinAndFlip 
	{
	0% { -webkit-transform: scale(-1, 1) rotate(50deg); }
	100% { -webkit-transform: scale(-1, 1) rotate(-50deg); }
	}
	</style>
	<script src="'.RES.'/css/bjdh/'.$this->IIIIII1III1l['bjdh'].'/bjdh'.$this->IIIIII1III1l['bjdh'].'.js" type="text/javascript"></script>');
}
$this->display($this->IIIIIIl1lI11['tpltypename']);
}
public function lists(){
$IIIIIIIIlIlI = $this->IIIIIIIIlIlI;
$IIIII1I1l1Il = $this->_get('classid','intval');
$IIIII1I1l1Il = (int)$IIIII1I1l1Il;
$IIIIIIIIlIl1['token'] = $this->_get('token','trim');
$IIIII1I1l1I1 = M('classify');
$IIIIIIIIIlll = $IIIII1I1l1I1->where("id = $IIIII1I1l1Il AND token = '$IIIIIIIIlIlI'")->find();
$IIIII1I1l1lI = $IIIII1I1l1I1->where("fid = $IIIII1I1l1Il AND token = '$IIIIIIIIlIlI'")->order('sorts desc')->select();
$IIIII1I1l1lI = $this->convertLinks($IIIII1I1l1lI);
$IIIII1I1ll11=D('Wxuser')->where($IIIIIIIIlIl1)->find();
$IIIII1I1ll11['color_id']=intval($IIIII1I1ll11['color_id']);
include('./iMicms/Lib/ORG/index.Tpl.php');
foreach($IIIIIIl1lI11 as $IIIIIIIllIll=>$IIIIIIlIllII){
if($IIIIIIlIllII['tpltypeid'] == $IIIIIIIIIlll['tpid']){
$IIIII1I1l1II = $IIIIIIlIllII;
}
}
$IIIII1I1ll11['tpltypeid'] = $IIIII1I1l1II['tpltypeid'];
$IIIII1I1ll11['tpltypename'] = $IIIII1I1l1II['tpltypename'];
$IIIIIIlIl11I = M('Img')->field('id')->where("classid = $IIIII1I1l1Il")->find();
if(!empty($IIIII1I1l1lI) AND empty($IIIIIIlIl11I)){
$IIIII1I1lllI=M('Flash')->where($IIIIIIIIlIl1)->select();
$IIIII1I1lllI=$this->convertLinks($IIIII1I1lllI);
$IIIII1I1llll=array();
$IIIII1I1lll1=array();
foreach ($IIIII1I1lllI as $IIIII1I1ll1I){
if ($IIIII1I1ll1I['tip']==1){
array_push($IIIII1I1llll,$IIIII1I1ll1I);
}elseif ($IIIII1I1ll1I['tip']==2) {
array_push($IIIII1I1lll1,$IIIII1I1ll1I);
}
}
$this->assign('flashbg',$IIIII1I1lll1);
if(!$IIIII1I1lll1&&$this->IIIIII1III1l['homeurl']){
$IIIII1I1ll1l=M('Flash');
$IIIIIIIlII1l=array();
$IIIIIIIlII1l['token']=$this->IIIIIIIIlIlI;
$IIIIIIIlII1l['img']=$this->IIIIII1III1l['homeurl'];
$IIIIIIIlII1l['url']='';
$IIIIIIIlII1l['info']='';
$IIIIIIIlII1l['tip']=2;
if ($IIIIIIIlII1l['img']){
$IIIII1I1ll1l->add($IIIIIIIlII1l);
}
}
if($IIIII1I1ll11['tpltypename'] == 'ktv_list'||$IIIII1I1ll11['tpltypename'] == 'yl_list'){
foreach($IIIII1I1l1lI as $IIIIIIIlI11I=>$IIIIIIl1llIl){
$IIIII1I1l1lI[$IIIIIIIlI11I]['title'] = $IIIIIIl1llIl['name'];
$IIIII1I1l1lI[$IIIIIIIlI11I]['pic'] = $IIIIIIl1llIl['img'];
if($IIIII1I1l1lI[$IIIIIIIlI11I]['url'] == ''){
$IIIII1I1l1lI[$IIIIIIIlI11I]['url'] = U('Index/lists',array('classid'=>$IIIIIIl1llIl['id'],'token'=>$IIIIIIIIlIl1['token'],'wecha_id'=>$this->IIIIIlIIIll1));
}
$IIIII1I1l1lI[$IIIIIIIlI11I]['info'] = strip_tags(htmlspecialchars_decode($IIIIIIl1llIl['info']));
}
}
foreach($IIIII1I1l1lI as $IIIIIllIll11=>$IIIII1I1l1ll){
$IIIII1I1l1l1 = $IIIII1I1l1ll['id'];
$IIIII1I1l1lI[$IIIIIllIll11]['sub'] = M('Classify')->where("fid = $IIIII1I1l1l1")->select();
if($IIIII1I1l1lI[$IIIIIllIll11]['url'] == ''){
$IIIII1I1l1lI[$IIIIIllIll11]['url'] = U('Index/lists',array('classid'=>$IIIII1I1l1ll['id'],'token'=>$IIIIIIIIlIl1['token'],'wecha_id'=>$this->IIIIIlIIIll1));
}
}
$IIIIIIIII1ll=count($IIIII1I1llll);
$this->assign('flash',$IIIII1I1llll);
$this->assign('num',$IIIIIIIII1ll);
$this->assign('flashbgcount',count($IIIII1I1lll1));
$this->assign('info',$IIIII1I1l1lI);
$this->assign('thisClassInfo',$IIIIIIIIIlll);
$this->assign('tpl',$IIIII1I1ll11);
$this->assign('copyright',$this->IIIII1Il11I1);
$this->display($IIIII1I1ll11['tpltypename']);
}else{
$IIIIIIIIlIl1['token'] = $this->IIIIIIIIlIlI;
$IIIIIIIIlIl1['classid']=$this->_get('classid','intval');
$IIIIIIIlIII1=D('Img');
$IIIIIII11l11=$IIIIIIIlIII1->where($IIIIIIIIlIl1)->order('usort DESC')->select();
$IIIIIII11l11=$this->convertLinks($IIIIIII11l11);
foreach($IIIIIII11l11 as $IIIIIIIlI11I=>$IIIIIIl1llIl){
$IIIIIII11l11[$IIIIIIIlI11I]['name'] = $IIIIIIl1llIl['title'];
$IIIIIII11l11[$IIIIIIIlI11I]['img'] = $IIIIIIl1llIl['pic'];
if($IIIIIII11l11[$IIIIIIIlI11I]['url'] == ''){
$IIIIIII11l11[$IIIIIIIlI11I]['url'] = U('Index/content',array('id'=>$IIIIIIl1llIl['id'],'classid'=>$IIIIIIl1llIl['classid'],'token'=>$IIIIIIIIlIl1['token'],'wecha_id'=>$this->IIIIIlIIIll1));
}
$IIIIIII11l11[$IIIIIIIlI11I]['info'] = strip_tags(htmlspecialchars_decode($IIIIIIl1llIl['text']));
}
$IIIII1I1l11I = count($IIIIIII11l11);
if($IIIII1I1l11I == 1){
$IIIII1I1l11l = $IIIIIII11l11[0]['id'];
$IIIIIIIll1ll = $IIIIIII11l11[0]['classid'];
$this->content($IIIII1I1l11l,$IIIIIIIll1ll);
exit;
}
$IIIII1I1lllI=M('Flash')->where($IIIIIIIIlIl1)->select();
$IIIII1I1lllI=$this->convertLinks($IIIII1I1lllI);
$IIIII1I1llll=array();
$IIIII1I1lll1=array();
foreach ($IIIII1I1lllI as $IIIII1I1ll1I){
if ($IIIII1I1ll1I['tip']==1){
array_push($IIIII1I1llll,$IIIII1I1ll1I);
}elseif ($IIIII1I1ll1I['tip']==2) {
array_push($IIIII1I1lll1,$IIIII1I1ll1I);
}
}
$this->assign('flashbg',$IIIII1I1lll1);
if(!$IIIII1I1lll1&&$this->IIIIII1III1l['homeurl']){
$IIIII1I1ll1l=M('Flash');
$IIIIIIIlII1l=array();
$IIIIIIIlII1l['token']=$this->IIIIIIIIlIlI;
$IIIIIIIlII1l['img']=$this->IIIIII1III1l['homeurl'];
$IIIIIIIlII1l['url']='';
$IIIIIIIlII1l['info']='';
$IIIIIIIlII1l['tip']=2;
if ($IIIIIIIlII1l['img']){
$IIIII1I1ll1l->add($IIIIIIIlII1l);
}
}
$IIIIIIIII1ll=count($IIIII1I1llll);
$this->assign('flash',$IIIII1I1llll);
$this->assign('num',$IIIIIIIII1ll);
$this->assign('flashbgcount',count($IIIII1I1lll1));
$this->assign('info',$IIIIIII11l11);
$this->assign('tpl',$IIIII1I1ll11);
$this->assign('copyright',$this->IIIII1Il11I1);
$this->assign('thisClassInfo',$IIIIIIIIIlll);
$this->display($IIIII1I1ll11['tpltypename']);
}
}
public function content($IIIII1I1l11l='',$IIIIIIIll1ll=''){
$IIIIIIIIlIlI = $this->IIIIIIIIlIlI;
$IIIIIIl1l1lI = M('Classify');
$IIIIII1IllII = M('Img');
if($IIIII1I1l11l == ''AND $IIIIIIIll1ll == ''){
$IIIIIIIII1I1 = $this->_get('id','intval');
$IIIII1I1l1Il = $this->_get('classid','intval');
$IIIIIIIII1I1 = intval($IIIIIIIII1I1);
$IIIII1I1l1Il = intval($IIIII1I1l1Il);
}else{
$IIIIIIIII1I1 = intval($IIIII1I1l11l);
$IIIII1I1l1Il = intval($IIIIIIIll1ll);
}
$IIIIIII11l11 = $IIIIII1IllII->where("id = ".intval($IIIIIIIII1I1)." AND token = '$IIIIIIIIlIlI'")->find();
if($IIIII1I1l1Il == ''){
$IIIII1I1l1Il = $IIIIIII11l11['classid'];
}
$IIIIII1IllII->where("token = '$IIIIIIIIlIlI' AND id = ".intval($IIIIIIIII1I1))->setInc('click');
$IIIIIlIlll1l = $IIIIIIl1l1lI->where("id = ".intval($IIIII1I1l1Il)." AND token = '$IIIIIIIIlIlI'")->field('conttpid')->find();
$IIIII1I1l1II = D('Wxuser')->where("token = '$IIIIIIIIlIlI'")->find();
include('./iMicms/Lib/ORG/cont.Tpl.php');
foreach($IIIIIIl1llII as $IIIIIIIllIll=>$IIIIIIlIllII){
if($IIIIIIlIllII['tpltypeid'] == $IIIIIlIlll1l['conttpid']){
$IIIII1I1ll11 = $IIIIIIlIllII;
}
}
$IIIII1I1l1II['tpltypeid'] = $IIIII1I1ll11['tpltypeid'];
$IIIII1I1l1II['tpltypename'] = $IIIII1I1ll11['tpltypename'];
$IIIII1I1l111=$IIIIII1IllII->where("classid = ".intval($IIIII1I1l1Il)." AND token = '$IIIIIIIIlIlI' AND id != ".intval($IIIIIIIII1I1))->limit(5)->order('uptatetime')->select();
$IIIII1I1l111 = $this->convertLinks($IIIII1I1l111);
$this->assign('info',$this->IIIIIIIIIlll);
$this->assign('copyright',$this->IIIII1Il11I1);
$this->assign('res',$IIIIIII11l11);
$this->assign('lists',$IIIII1I1l111);
$this->assign('tpl',$IIIII1I1l1II);
$this->display($IIIII1I1l1II['tpltypename']);
}
public function flash(){
$IIIIIIIIlIl1['token']=$this->_get('token','trim');
$IIIII1I1llll=M('Flash')->where($IIIIIIIIlIl1)->select();
$IIIIIIIII1ll=count($IIIII1I1llll);
$this->assign('flash',$IIIII1I1llll);
$this->assign('info',$this->IIIIIIIIIlll);
$this->assign('num',$IIIIIIIII1ll);
$this->display('ty_index');
}
public function getLink($IIIIIII1l1Il){
$IIIIIII1l1Il=$IIIIIII1l1Il?$IIIIIII1l1Il:'javascript:void(0)';
$IIIII1I11II1=explode(' ',$IIIIIII1l1Il);
$IIIII1I11IlI=count($IIIII1I11II1);
if ($IIIII1I11IlI>1){
$IIIII1I11Ill=intval($IIIII1I11II1[1]);
}
if (strExists($IIIIIII1l1Il,'刮刮卡')){
$IIIII1I11Il1='/index.php?g=Wap&m=Guajiang&a=index&token='.$this->IIIIIIIIlIlI.'&wecha_id='.$this->IIIIIlIIIll1;
if ($IIIII1I11Ill){
$IIIII1I11Il1.='&id='.$IIIII1I11Ill;
}
}elseif (strExists($IIIIIII1l1Il,'大转盘')){
$IIIII1I11Il1='/index.php?g=Wap&m=Lottery&a=index&token='.$this->IIIIIIIIlIlI.'&wecha_id='.$this->IIIIIlIIIll1;
if ($IIIII1I11Ill){
$IIIII1I11Il1.='&id='.$IIIII1I11Ill;
}
}elseif (strExists($IIIIIII1l1Il,'优惠券')){
$IIIII1I11Il1='/index.php?g=Wap&m=Coupon&a=index&token='.$this->IIIIIIIIlIlI.'&wecha_id='.$this->IIIIIlIIIll1;
if ($IIIII1I11Ill){
$IIIII1I11Il1.='&id='.$IIIII1I11Ill;
}
}elseif (strExists($IIIIIII1l1Il,'刮刮卡')){
$IIIII1I11Il1='/index.php?g=Wap&m=Guajiang&a=index&token='.$this->IIIIIIIIlIlI.'&wecha_id='.$this->IIIIIlIIIll1;
if ($IIIII1I11Ill){
$IIIII1I11Il1.='&id='.$IIIII1I11Ill;
}
}elseif (strExists($IIIIIII1l1Il,'商家订单')){
if ($IIIII1I11Ill){
$IIIII1I11Il1=$IIIII1I11Il1='/index.php?g=Wap&m=Host&a=index&token='.$this->IIIIIIIIlIlI.'&wecha_id='.$this->IIIIIlIIIll1.'&hid='.$IIIII1I11Ill;
}else {
$IIIII1I11Il1='/index.php?g=Wap&m=Host&a=Detail&token='.$this->IIIIIIIIlIlI.'&wecha_id='.$this->IIIIIlIIIll1;
}
}elseif (strExists($IIIIIII1l1Il,'万能表单')){
if ($IIIII1I11Ill){
$IIIII1I11Il1=$IIIII1I11Il1='/index.php?g=Wap&m=Selfform&a=index&token='.$this->IIIIIIIIlIlI.'&wecha_id='.$this->IIIIIlIIIll1.'&id='.$IIIII1I11Ill;
}
}elseif (strExists($IIIIIII1l1Il,'相册')){
$IIIII1I11Il1='/index.php?g=Wap&m=Photo&a=index&token='.$this->IIIIIIIIlIlI.'&wecha_id='.$this->IIIIIlIIIll1;
if ($IIIII1I11Ill){
$IIIII1I11Il1='/index.php?g=Wap&m=Photo&a=plist&token='.$this->IIIIIIIIlIlI.'&wecha_id='.$this->IIIIIlIIIll1.'&id='.$IIIII1I11Ill;
}
}elseif (strExists($IIIIIII1l1Il,'全景')){
$IIIII1I11Il1='/index.php?g=Wap&m=Panorama&a=index&token='.$this->IIIIIIIIlIlI.'&wecha_id='.$this->IIIIIlIIIll1;
if ($IIIII1I11Ill){
$IIIII1I11Il1='/index.php?g=Wap&m=Panorama&a=item&token='.$this->IIIIIIIIlIlI.'&wecha_id='.$this->IIIIIlIIIll1.'&id='.$IIIII1I11Ill;
}
}elseif (strExists($IIIIIII1l1Il,'会员卡')){
$IIIII1I11Il1='/index.php?g=Wap&m=Card&a=index&token='.$this->IIIIIIIIlIlI.'&wecha_id='.$this->IIIIIlIIIll1;
}elseif (strExists($IIIIIII1l1Il,'商城')){
$IIIII1I11Il1='/index.php?g=Wap&m=Product&a=index&token='.$this->IIIIIIIIlIlI.'&wecha_id='.$this->IIIIIlIIIll1;
}elseif (strExists($IIIIIII1l1Il,'订餐')){
$IIIII1I11Il1='/index.php?g=Wap&m=Product&a=dining&dining=1&token='.$this->IIIIIIIIlIlI.'&wecha_id='.$this->IIIIIlIIIll1;
}elseif (strExists($IIIIIII1l1Il,'团购')){
$IIIII1I11Il1='/index.php?g=Wap&m=Groupon&a=grouponIndex&token='.$this->IIIIIIIIlIlI.'&wecha_id='.$this->IIIIIlIIIll1;
}elseif (strExists($IIIIIII1l1Il,'首页')){
$IIIII1I11Il1='/index.php?g=Wap&m=Index&a=index&token='.$this->IIIIIIIIlIlI.'&wecha_id='.$this->IIIIIlIIIll1;
}elseif (strExists($IIIIIII1l1Il,'网站分类')){
$IIIII1I11Il1='/index.php?g=Wap&m=Index&a=lists&token='.$this->IIIIIIIIlIlI.'&wecha_id='.$this->IIIIIlIIIll1;
if ($IIIII1I11Ill){
$IIIII1I11Il1='/index.php?g=Wap&m=Index&a=lists&token='.$this->IIIIIIIIlIlI.'&wecha_id='.$this->IIIIIlIIIll1.'&classid='.$IIIII1I11Ill;
}
}elseif (strExists($IIIIIII1l1Il,'图文回复')){
if ($IIIII1I11Ill){
$IIIII1I11Il1='/index.php?g=Wap&m=Index&a=index&token='.$this->IIIIIIIIlIlI.'&wecha_id='.$this->IIIIIlIIIll1.'&id='.$IIIII1I11Ill;
}
}elseif (strExists($IIIIIII1l1Il,'LBS信息')){
$IIIII1I11Il1='/index.php?g=Wap&m=Company&a=map&token='.$this->IIIIIIIIlIlI.'&wecha_id='.$this->IIIIIlIIIll1;
if ($IIIII1I11Ill){
$IIIII1I11Il1='/index.php?g=Wap&m=Company&a=map&token='.$this->IIIIIIIIlIlI.'&wecha_id='.$this->IIIIIlIIIll1.'&companyid='.$IIIII1I11Ill;
}
}elseif (strExists($IIIIIII1l1Il,'DIY宣传页')){
$IIIII1I11Il1='/index.php/show/'.$this->IIIIIIIIlIlI;
}elseif (strExists($IIIIIII1l1Il,'婚庆喜帖')){
if ($IIIII1I11Ill){
$IIIII1I11Il1='/index.php?g=Wap&m=Wedding&a=index&token='.$this->IIIIIIIIlIlI.'&wecha_id='.$this->IIIIIlIIIll1.'&id='.$IIIII1I11Ill;
}
}elseif (strExists($IIIIIII1l1Il,'投票')){
if ($IIIII1I11Ill){
$IIIII1I11Il1='/index.php?g=Wap&m=Vote&a=index&token='.$this->IIIIIIIIlIlI.'&wecha_id='.$this->IIIIIlIIIll1.'&id='.$IIIII1I11Ill;
}
}else {
$IIIII1I11Il1=str_replace(array('{wechat_id}','{siteUrl}','&amp;'),array($this->IIIIIlIIIll1,C('site_url'),'&'),$IIIIIII1l1Il);
if (!!(strpos($IIIIIII1l1Il,'tel')===false)&&$IIIIIII1l1Il!='javascript:void(0)'&&!strpos($IIIIIII1l1Il,'wecha_id=')){
if (strpos($IIIIIII1l1Il,'?')){
$IIIII1I11Il1=$IIIII1I11Il1.'&wecha_id='.$this->IIIIIlIIIll1;
}else {
$IIIII1I11Il1=$IIIII1I11Il1.'?wecha_id='.$this->IIIIIlIIIll1;
}
}
}
return $IIIII1I11Il1;
}
public function convertLinks($IIIIIIIlII1l){
$IIIIIIIllI11=0;
foreach ($IIIIIIIlII1l as $IIIIIIll1lIl){
if ($IIIIIIll1lIl['url']){
$IIIIIIIlII1l[$IIIIIIIllI11]['url']=$this->getLink($IIIIIIll1lIl['url']);
}
$IIIIIIIllI11++;
}
return $IIIIIIIlII1l;
}
public function _getPlugMenu(){
$IIIII1Il11l1=M('company');
$this->IIIIIII11l1l=$IIIII1Il11l1->where(array('token'=>$this->IIIIIIIIlIlI,'isbranch'=>0))->find();
$IIIIII1IIIl1=M('site_plugmenu');
$IIIII1I11I11=$IIIIII1IIIl1->where(array('token'=>$this->IIIIIIIIlIlI,'display'=>1))->order('taxis ASC')->limit('0,4')->select();
if ($IIIII1I11I11){
$IIIIIIIllI11=0;
foreach ($IIIII1I11I11 as $IIIII1I11lII){
switch ($IIIII1I11lII['name']){
case 'tel':
if (!$IIIII1I11lII['url']){
$IIIII1I11lII['url']='tel:/'.$this->IIIIIII11l1l['tel'];
}else {
$IIIII1I11lII['url']='tel:/'.$IIIII1I11lII['url'];
}
break;
case 'memberinfo':
if (!$IIIII1I11lII['url']){
$IIIII1I11lII['url']='/index.php?g=Wap&m=Userinfo&a=index&token='.$this->IIIIIIIIlIlI.'&wecha_id='.$this->IIIIIlIIIll1;
}
break;
case 'nav':
if (!$IIIII1I11lII['url']){
$IIIII1I11lII['url']='/index.php?g=Wap&m=Company&a=map&token='.$this->IIIIIIIIlIlI.'&wecha_id='.$this->IIIIIlIIIll1;
}
break;
case 'message':
break;
case 'share':
break;
case 'home':
if (!$IIIII1I11lII['url']){
$IIIII1I11lII['url']='/index.php?g=Wap&m=Index&a=index&token='.$this->IIIIIIIIlIlI.'&wecha_id='.$this->IIIIIlIIIll1;
}
break;
case 'album':
if (!$IIIII1I11lII['url']){
$IIIII1I11lII['url']='/index.php?g=Wap&m=Photo&a=index&token='.$this->IIIIIIIIlIlI.'&wecha_id='.$this->IIIIIlIIIll1;
}
break;
case 'email':
$IIIII1I11lII['url']='mailto:'.$IIIII1I11lII['url'];
break;
case 'shopping':
if (!$IIIII1I11lII['url']){
$IIIII1I11lII['url']='/index.php?g=Wap&m=Product&a=index&token='.$this->IIIIIIIIlIlI.'&wecha_id='.$this->IIIIIlIIIll1;
}
break;
case 'membercard':
$IIIIIll1Il11=M('member_card_create')->where(array('token'=>$this->IIIIIIIIlIlI,'wecha_id'=>$this->IIIIIlIIIll1))->find();
if (!$IIIII1I11lII['url']){
if($IIIIIll1Il11==false){
$IIIII1I11lII['url']=rtrim(C('site_url'),'/').U('Wap/Card/index',array('token'=>$this->IIIIIIIIlIlI,'wecha_id'=>$this->IIIIIlIIIll1));
}else{
$IIIII1I11lII['url']=rtrim(C('site_url'),'/').U('Wap/Card/index',array('token'=>$this->IIIIIIIIlIlI,'wecha_id'=>$this->IIIIIlIIIll1));
}
}
break;
case 'activity':
$IIIII1I11lII['url']=$this->getLink($IIIII1I11lII['url']);
break;
case 'weibo':
break;
case 'tencentweibo':
break;
case 'qqzone':
break;
case 'wechat':
$IIIII1I11lII['url']='weixin://addfriend/'.$this->IIIII1I1lI1l['wxid'];
break;
case 'music':
break;
case 'video':
break;
case 'recommend':
$IIIII1I11lII['url']=$this->getLink($IIIII1I11lII['url']);
break;
case 'other':
$IIIII1I11lII['url']=$this->getLink($IIIII1I11lII['url']);
break;
}
$IIIII1I11I11[$IIIIIIIllI11]=$IIIII1I11lII;
$IIIIIIIllI11++;
}
}else {
$IIIII1I11I11=array();
}
return $IIIII1I11I11;
}
}
?>