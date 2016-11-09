<?php

class ImgAction extends UserAction{
public function index(){
$IIIIIIIlIII1=D('Img');
$IIIIIIIIlIlI = session('token');
if(IS_POST &&$_POST['search'] != ''){
$IIIIIIlllIl1 = trim($this->_post('search'));
$IIIIIIIIlIl1 = "token = '$IIIIIIIIlIlI' AND title like '%$IIIIIIlllIl1%'";
}else{
$IIIIIIIIlIl1['token']=$IIIIIIIIlIlI;
}
$IIIIIIIII1ll=$IIIIIIIlIII1->where($IIIIIIIIlIl1)->count();
$IIIIIIIII11I=new Page($IIIIIIIII1ll,20);
$IIIIIIIIIlll=$IIIIIIIlIII1->where($IIIIIIIIlIl1)->order('usort DESC')->limit($IIIIIIIII11I->firstRow.','.$IIIIIIIII11I->listRows)->select();
$this->assign('page',$IIIIIIIII11I->show());
$this->assign('info',$IIIIIIIIIlll);
$this->display();
}
public function add(){
$IIIIII1II1Il=M('Classify');
$IIIIIIl1l1lI=$IIIIII1II1Il->field("fid,id,name,concat(path,'-',id) as bpath")->order('bpath ASC')->where(array('token'=>session('token')))->select();
foreach($IIIIIIl1l1lI as $IIIIIIIllIll=>$IIIIIIlIllII){
$IIIIII1II1I1=(count(explode('-',$IIIIIIlIllII['bpath']))-2)*10;
for($IIIIIIIllI11=0;$IIIIIIIllI11<$IIIIII1II1I1;$IIIIIIIllI11++){
$IIIIIIl1l1lI[$IIIIIIIllIll]['fg'].='-';
}
$IIIIIIIII1I1 = $IIIIIIlIllII['id'];
$IIIIII1II1lI[] = $IIIIII1II1Il->field('distinct(fid)')->where(array('token'=>session('token'),"fid"=>$IIIIIIIII1I1))->select();
if(!$IIIIII1II1lI[$IIIIIIIllIll][0]['fid'] == NULL){
$IIIIIIl1I1I1[] = $IIIIII1II1lI[$IIIIIIIllIll][0]['fid'];
}
}
if($IIIIIIl1l1lI==false){$this->error('请先添加3G网站分类',U('Classify/index',array('token'=>session('token'))));}
$this->assign('info',$IIIIIIl1l1lI);
$this->assign('fid',$IIIIIIl1I1I1);
$this->display();
}
public function edit(){
$IIIIIIIlIII1=M('Classify');
$IIIIIIIIlIl1['token']=session('token');
$IIIIIIIIlIl1['id']=$this->_get('id','intval');
$IIIIIIIIlIl1['uid']=session('uid');
$IIIIIII11l11=D('Img')->where($IIIIIIIIlIl1)->find();
$IIIIII1II1ll=M('Classify')->field('id,path')->where(array('id'=>$IIIIIII11l11['classid']))->find();
$IIIIII1II1l1 = $IIIIII1II1ll['path'].'-'.$IIIIII1II1ll['id'];
$IIIIII1II11I = explode('-',$IIIIII1II1l1);
foreach($IIIIII1II11I as $IIIIIIIllIll=>$IIIIIIlIllII){
if($IIIIIIlIllII != 0){
$IIIIIIIlIIII[] = $IIIIIIIlIII1->field("name")->where(array('token'=>session('token'),'id'=>$IIIIIIlIllII))->find();
}else{
unset($IIIIII1II11I[$IIIIIIIllIll]);
}
}
foreach ($IIIIIIIlIIII as $IIIIIIIlI11I=>$IIIIIIl1llIl){
$IIIIII1II11l .= $IIIIIIl1llIl['name'].' >> ';
$IIIIII1II111 = $IIIIIIl1llIl['name'];
}
$IIIIII1II11l = rtrim($IIIIII1II11l,' >> ');
$this->assign('classValue',array_pop($IIIIII1II11I).','.$IIIIII1II111);
$this->assign('thisClass',$IIIIII1II1ll);
$this->assign('classtree',$IIIIII1II11l);
$this->assign('fid',$IIIIIIl1I1I1);
$this->assign('info',$IIIIIII11l11);
$this->assign('class',$IIIIIIl1l1lI);
$this->assign('res',$IIIIIIl1l1lI);
$this->display();
}
public function del(){
$IIIIIIIIlIl1['id']=$this->_get('id','intval');
$IIIIIIIIlIl1['token']=$this->IIIIIIIIlIlI;
if(D(MODULE_NAME)->where($IIIIIIIIlIl1)->delete()){
M('Keyword')->where(array('pid'=>$this->_get('id','intval'),'token'=>session('token'),'module'=>'Img'))->delete();
$this->success('操作成功',U(MODULE_NAME.'/index'));
}else{
$this->error('操作失败',U(MODULE_NAME.'/index'));
}
}
public function insert(){
$IIIIII1IlII1 = M("Img")->where(array('token'=>session('token')))->order('id DESC')->limit(1)->getField('id');
$_POST['usort'] = $IIIIII1IlII1+1;
$_POST['info']=str_replace('\'','&apos;',$_POST['info']);
$IIIIII1IlIlI=M('Users');
$IIIIII1IlIlI->where(array('id'=>$this->IIIIIIIIII1I['id']))->setInc('diynum');
$this->all_insert();
}
public function upsave(){
$_POST['info']=str_replace('\'','&apos;',$_POST['info']);
$this->all_save();
}
public function editClass(){
$IIIIIIIIlIlI = $this->IIIIIIIIlIlI;
$IIIIIIIlIII1 = M('Classify');
$IIIIIIIII1I1 = (int)$this->_get('id');
$IIIIIIl1l1lI = $IIIIIIIlIII1->field('id,name,path')->where("token = '$IIIIIIIIlIlI' AND fid = $IIIIIIIII1I1")->select();
foreach($IIIIIIl1l1lI as $IIIIIIIllIll=>$IIIIIIlIllII){
$IIIIIIl1I1I1 = $IIIIIIlIllII['id'];
$IIIIIIl1l1lI[$IIIIIIIllIll]['sub'] = $IIIIIIIlIII1->where("token = '$IIIIIIIIlIlI' AND fid = $IIIIIIl1I1I1")->field('id,name')->select();
}
$this->assign('class',$IIIIIIl1l1lI);
$this->display();
}
public function editUsort(){
$IIIIIIIIlIlI = $this->_post('token',"htmlspecialchars");
unset($_POST['__hash__']);
foreach($_POST as $IIIIIIIllIll=>$IIIIIIlIllII){
$IIIIIIIllIll = str_replace('usort','',$IIIIIIIllIll);
$IIIIIIIIIl11[$IIIIIIIllIll]=$IIIIIIlIllII;
M('Img')->where(array('token'=>$IIIIIIIIlIlI,'id'=>$IIIIIIIllIll))->setField('usort',$IIIIIIlIllII);
}
$this->success('保存成功');
}
public function multiImgDel(){
$IIIIIIIII1I1 = (int)$this->_get('id');
if(M('Img_multi')->where(array('token'=>$this->IIIIIIIIlIlI,'id'=>$IIIIIIIII1I1))->delete() &&M('Keyword')->where(array('token'=>$this->IIIIIIIIlIlI,'pid'=>$IIIIIIIII1I1))->delete()){
$this->success('删除成功');
}else{
$this->error('删除失败，请稍后再试~');
}
}
public function multi(){
if((int)$this->_get('tip') == 2){
$IIIIII1IlI11 = M('Img_multi');
$IIIIII1IllII = M('Img');
$IIIIIIIIlIl1['token'] = $this->IIIIIIIIlIlI;
$IIIIIIIII1ll=$IIIIII1IlI11->where($IIIIIIIIlIl1)->count();
$IIIIIIIII11I=new Page($IIIIIIIII1ll,20);
$IIIIIIIIlIII = $IIIIII1IlI11->where($IIIIIIIIlIl1)->limit($IIIIIIIII11I->firstRow.','.$IIIIIIIII11I->listRows)->order('id DESC')->select();
$IIIIII1IllIl = $IIIIIIIII11I->show();
foreach($IIIIIIIIlIII as $IIIIIIIllIll=>$IIIIIIlIllII){
$IIIIIIIII1I1 = explode(',',$IIIIIIlIllII['imgs']);
foreach($IIIIIIIII1I1 as $IIIIIIIlI11I=>$IIIIIIl1llIl){
$IIIIIIIIll11[$IIIIIIIllIll][$IIIIIIl1llIl] = $IIIIII1IllII->where(array('token'=>$this->IIIIIIIIlIlI,'id'=>$IIIIIIl1llIl))->getField('title');
}
$IIIIIIIIlIII[$IIIIIIIllIll]['title'] = $IIIIIIIIll11[$IIIIIIIllIll];
}
$this->assign('list',$IIIIIIIIlIII);
$this->assign('page',$IIIIII1IllIl);
}
$this->display();
}
public function multiSave(){
$IIIIII1IlllI = $this->_post('keywords','trim');
$IIIIII1Illll = $this->_post('imgids');
$IIIIII1Illll = trim($IIIIII1Illll,',');
if(!$IIIIII1IlllI) $this->error('请填写关键词。');
if(!$IIIIII1Illll) $this->error('请选择图文消息。');
if(M('Img_multi')->where(array('token'=>$this->IIIIIIIIlIlI,'keywords'=>$IIIIII1IlllI))->getField(id)){
$this->error('这个关键词已经存在了，请换个关键词哦。');
}
$IIIIIIIIIl11['imgs'] = $IIIIII1Illll;
$IIIIIIIIIl11['keywords'] = $IIIIII1IlllI;
$IIIIIIIIIl11['token'] = $this->IIIIIIIIlIlI;
$IIIIIIIIIl11['__hash__'] = $_POST['__hash__'];
$IIIIII1IlI11 = M('Img_multi');
if($IIIIII1IlI11->create($IIIIIIIIIl11)){
if($IIIIII1Illl1 = $IIIIII1IlI11->add($IIIIIIIIIl11)){
$IIIIII1Ill1I['keyword'] = $IIIIII1IlllI;
$IIIIII1Ill1I['token'] = $this->IIIIIIIIlIlI;
$IIIIII1Ill1I['module'] = 'Multi';
$IIIIII1Ill1I['pid'] = $IIIIII1Illl1;
if(M('Keyword')->add($IIIIII1Ill1I)){
$this->success('保存成功',U('Img/multi',array('tip'=>2)));
}
}else{
$this->error('保存失败，请稍后再试~');
}
}else{
$this->error($IIIIII1IlI11->getError());
}
}
}
?>