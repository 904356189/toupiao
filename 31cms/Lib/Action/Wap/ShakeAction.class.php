<?php

class ShakeAction extends WapAction{
public $IIIII1llIl1I;
public $IIIII1llIl1l;
public function __construct(){
parent::__construct();
$this->IIIII1llIl1l 	= $this->_get('act_type','intval');
$this->IIIII1llIl1I 	= M('Shake');
}
public function index(){
if(!in_array($this->IIIII1llIl1l,array('2','3')) ||!$this->IIIIIlIIIll1){
echo '参数错误';
exit();
}
if($this->IIIII1llIl1l == 2){
$IIIIIIIII1I1 = $this->_get('id','intval');
}else if($this->IIIII1llIl1l == 3){
$IIIIIIIII1I1 = M('Wechat_scene')->where(array('token'=>$this->IIIIIIIIlIlI,'id'=>$this->_get('id','intval')))->getField('shake_id');
}
$IIIIIIIIlIl1 		= array('wecha_id'=>$this->IIIIIlIIIll1,'token'=>$this->IIIIIIIIlIlI,'act_id'=>$this->_get('id','intval'),'act_type'=>$this->IIIII1llIl1l);
$IIIII1llIl11 	= M('wall_member')->where($IIIIIIIIlIl1)->find();
if (!$IIIII1llIl11){
header('location:'.U('Scene_member/index',array('token'=>$this->IIIIIIIIlIlI,'wecha_id'=>$this->IIIIIlIIIll1,'id'=>$IIIIIIIIlIl1['act_id'],'act_type'=>$IIIIIIIIlIl1['act_type'],'name'=>'shake')));
exit();
}
$IIIIIIIIIlll=array();
$IIIIIIIIIlll['phone'] 	= $this->_get('phone');
$IIIII1llI1II 		= $this->IIIII1llIl1I->where(array('token'=>$this->IIIIIIIIlIlI,'id'=>$IIIIIIIII1I1,'isopen'=>1))->find();
$IIIII1llI1II['rule'] 	= nl2br($IIIII1llI1II['rule']);
$IIIII1llI1II['info']	= nl2br($IIIII1llI1II['info']);
$IIIII1llI1II['act_id']= $this->_get('id','intval');
$this->assign('act_type',$this->IIIII1llIl1l);
$this->assign('info',$IIIII1llI1II);
$this->display();
}
public function shakeActivityStatus(){
$IIIII1llI1II=$this->IIIII1llIl1I->where(array('token'=>$this->IIIIIIIIlIlI,'id'=>intval($_GET['id'])))->find();
echo'{"isact":'.$IIIII1llI1II['isact'].'}';exit;
}
public function refreshScreen(){
$IIIII1llIl1l 	= $this->_get('act_type','intval');
$IIIIIIIIlIl1=array();
$IIIIIIIIlIl1['token']	= $this->_get('token');
$IIIIIIIIlIl1['id']	= $this->_get('id','intval');
$IIIIIIIIlIl1['isopen']= '1';
$IIIII1llI1II		= $this->IIIII1llIl1I->where($IIIIIIIIlIl1)->find();
if(empty($IIIII1llI1II)){
echo -1;
exit();
}
if ($IIIII1llI1II){
$IIIIIIIIIl11=array();
$IIIIII11Il1I 	= array('shakeid'=>$IIIIIIIIlIl1['id'],'wecha_id'=>$this->IIIIIlIIIll1,'round'=>'0','token'=>$this->IIIIIIIIlIlI);
if($IIIII1llIl1l == 2){
$IIIIII11Il1I['is_scene'] 	= '0';
$IIIIIIIIIl11['is_scene'] 		= '0';
}else if($IIIII1llIl1l == 3){
$IIIIII11Il1I['is_scene'] 	= '1';
$IIIIIIIIIl11['is_scene'] 		= '1';
}
$IIIII1llI1lI 			= M('Shake_rt')->where($IIIIII11Il1I)->find();
$IIIIIIIIIl11['token'] 		= $this->_get('token');
$IIIIIIIIIl11['wecha_id'] 	= $this->_get('wecha_id');
$IIIIIIIIIl11['shakeid'] 	= $this->_get('id');
$IIIIIIIIIl11['count']		= intval($_POST['count']);
$IIIIIIIIIl11['round']		= 0;
if ($IIIII1llI1lI){
M('Shake_rt')->where($IIIIII11Il1I)->save($IIIIIIIIIl11);
}else {
M('Shake_rt')->add($IIIIIIIIIl11);
}
}
}
}
?>