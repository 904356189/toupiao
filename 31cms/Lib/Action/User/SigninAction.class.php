<?php

class  SigninAction extends UserAction {
public $IIIIIlIlII11	= 1;
public $IIIIIlIlIlII = 5;
public $IIIIIlIlIlIl;
public $IIIIIlIlIlI1;
public function _initialize() {
parent::_initialize();
$this->IIIIIlIlIlIl = M('sign_conf');
$this->IIIIIlIlIlI1   = M('sign_in');
}
public function index(){
if($this->IIIIIlIlII11 == 0){
}
$IIIIIlIlIllI 	= M('sign_set')->where(array('token'=>session('token')))->getField('id');
$IIIIIIIIlIl1 		= array();
$IIIIIlIlIlll	= $this->_post('user_name','htmlspecialchars,trim');
$IIIIIIl1llll		= $this->_post('sort','trim');
$IIIIIlIlIll1	= strtotime($this->_post('startdate','trim'));
$IIIIIlIlIl1I	= strtotime($this->_post('enddate','trim'));
if($IIIIIlIlIll1 &&$IIIIIlIlIl1I){
$IIIIIIIIlIl1['time'] = array(array('gt',$IIIIIlIlIll1),array('lt',$IIIIIlIlIl1I),'and');
}
if($IIIIIlIlIlll){
$IIIIIIIIlIl1['user_name'] = array('like','%'.$IIIIIlIlIlll.'%');
}
if(empty($IIIIIIl1llll)){
$IIIIIIIIl1Il 	= 'time desc';
}else{
$IIIIIIIIl1Il 	= 'time '.$IIIIIIl1llll;
}
$IIIIIIIII1ll      = $this->IIIIIlIlIlI1->where($IIIIIIIIlIl1)->count();
$IIIIIIll1lll       = new Page($IIIIIIIII1ll,12);
$IIIIIIIIlIII 		= $this->IIIIIlIlIlI1->where(array('token'=>session('token')))->order($IIIIIIIIl1Il)->limit($IIIIIIll1lll->firstRow.','.$IIIIIIll1lll->listRows)->select();
$this->assign('search',array('startdate'=>$IIIIIlIlIll1,'enddate'=>$IIIIIlIlIl1I,'sort'=>$IIIIIIl1llll));
$this->assign('page',$IIIIIIll1lll->show());
$this->assign('list',$IIIIIIIIlIII);
$this->assign('listinfo',1);
$this->display();
}
public function integral_conf(){
$IIIIIIIIlIl1 = array('token'=>$this->IIIIIIIIlIlI);
$IIIIIIIIlIII = $this->IIIIIlIlIlIl->where($IIIIIIIIlIl1)->order(array('use'=>'desc','conf_id'=>'desc'))->select();
$this->assign('list',$IIIIIIIIlIII);
$this->assign('listinfo',2);
$this->display();
}
public function add_integral(){
$IIIIIIlll111 = $this->IIIIIlIlIlIl->where(array('token'=>$this->IIIIIIIIlIlI,'conf_id'=>$this->_get('id','intval')))->find();
if(IS_POST){
$IIIIIIIIIl11 = array();
$IIIIIIIIIl11['integral'] 	= $this->_post('integral','intval');
$IIIIIIIIIl11['stair']	 	= $this->_post('stair','intval');
$IIIIIIIIIl11['use'] 		= $this->_post('use');
$IIIIIIIIIl11['token'] 		= $this->IIIIIIIIlIlI;
if($IIIIIIIIIl11['integral']==0 ||$IIIIIIIIIl11['stair']==0 ){
$this->error('签到奖励和签到次数必须为大于0的整数');
exit();
}
if($IIIIIIlll111){
$this->IIIIIlIlIlIl->where(array('token'=>$this->IIIIIIIIlIlI,'conf_id'=>$this->_post('conf_id','intval')))->save($IIIIIIIIIl11);
$this->success('修改成功',U("Signin/integral_conf",array('token'=>session('token'))));
}else{
$this->IIIIIlIlIlIl->add($IIIIIIIIIl11);
$this->success('设置成功',U("Signin/integral_conf",array('token'=>session('token'))));
}
}
$this->assign('set',$IIIIIIlll111);
$this->display();
}
public function del_integral(){
$IIIIIlIlI1Il 	= filter_var($this->_get('id'),FILTER_VALIDATE_INT);
$IIIIIIIIlIl1 		= array('conf_id'=>$IIIIIlIlI1Il,'token'=>session('token'));
$IIIIIIll1II1 = $this->IIIIIlIlIlIl->where($IIIIIIIIlIl1)->delete();
if($IIIIIIll1II1){
$this->success('操作成功',U("Signin/sign_conf",array('token'=>session('token'))));
}else{
$this->error('操作失败');
}
}
public function set(){
$IIIIII11Illl		= M('sign_set');
$IIIIII1I1lII	= M('keyword');
$IIIIIIIIlIl1 	= array('token'=>$this->IIIIIIIIlIlI);
$IIIIIlIlI1I1	= $IIIIII11Illl->where($IIIIIIIIlIl1)->find();
if(IS_POST){
$IIIIIIIIIl11 				= array();
$IIIIIIIIIl11['keywords'] 	= $this->_post('keywords','trim');
$IIIIIIIIIl11['title'] 		= $this->_post('title','trim');
$IIIIIIIIIl11['content'] 	= $this->_post('content','htmlspecialchars');
$IIIIIIIIIl11['reply_img'] 	= $this->_post('reply_img','trim');
$IIIIIIIIIl11['top_pic'] 	= $this->_post('top_pic','trim');
$IIIIIIIIIl11['token'] 		= $this->IIIIIIIIlIlI;
if($IIIIIlIlI1I1){
$IIIIII11Illl->where($IIIIIIIIlIl1)->save($IIIIIIIIIl11);
$IIIIII11IlI1['pid']		= $this->_post('id','intval');
$IIIIII11IlI1['module']	= 'Sign';
$IIIIII11IlI1['token']	= $this->IIIIIIIIlIlI;
$IIIIII11IlI1['keyword']	= $IIIIIIIIIl11['keywords'];
$IIIIII1I1lII->where(array('token'=>$this->IIIIIIIIlIlI,'pid'=>$this->_post('id','intval')))->save($IIIIII11IlI1);
$this->success('修改成功');
}else{
$IIIIIIIII1I1 = $IIIIII11Illl->add($IIIIIIIIIl11);
$IIIIII11IlI1['pid']		= $IIIIIIIII1I1;
$IIIIII11IlI1['module']	= 'Sign';
$IIIIII11IlI1['token']	= $this->IIIIIIIIlIlI;
$IIIIII11IlI1['keyword']	= $IIIIIIIIIl11['keywords'];
$IIIIII1I1lII->add($IIIIII11IlI1);
$this->success('设置成功');
}
}else{
if (!$IIIIIlIlI1I1){
$IIIIIlIlI1I1['top_pic']=C('site_url').'/tpl/static/sign/top.jpg';
$IIIIIlIlI1I1['reply_img']=C('site_url').'/tpl/static/sign/r.jpg';
}
$this->assign('set',$IIIIIlIlI1I1);
$this->assign('listinfo',3);
$this->display();
}
}
}
?>