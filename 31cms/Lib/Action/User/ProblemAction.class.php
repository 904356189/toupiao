<?php

class ProblemAction extends UserAction{
public function _initialize() {
parent::_initialize();
$this->canUseFunction('Problem');
}
public function index(){
$IIIIII11IlI1= $this->_post('searchkey','trim');
$IIIIIIIIlIl1 	= array('token'=>$this->IIIIIIIIlIlI);
if(!empty($IIIIII11IlI1)){
$IIIIIIIIlIl1['name|title|keyword'] = array('like','%'.$IIIIII11IlI1.'%');
}
$IIIIIIIII1ll	= M('Problem_game')->where($IIIIIIIIlIl1)->count();
$IIIIIIll1lll   = new Page($IIIIIIIII1ll,15);
$IIIIIIIIlIII 	= M('Problem_game')->where($IIIIIIIIlIl1)->order('id desc')->limit($IIIIIIll1lll->firstRow.','.$IIIIIIll1lll->listRows)->select();
$this->assign('list',$IIIIIIIIlIII);
$this->assign('page',$IIIIIIll1lll->show());
$this->display();
}
public function game_set(){
$IIIIII11Illl 		= M('Problem_game');
$IIIIII1I1lII		= M('Keyword');
$IIIIIIIIlIl1  		= array('token'=>$this->IIIIIIIIlIlI,'id'=>$this->_get('id','intval'));
$IIIIII11Ill1 	= $IIIIII11Illl->where($IIIIIIIIlIl1)->find();
if(IS_POST){
$_POST['add_time'] 	= time();
$_POST['token'] 	= $this->IIIIIIIIlIlI;
if($IIIIII11Illl->create()){
if(empty($IIIIII11Ill1)){
if($_POST['is_open'] == 1){
$_POST['start_time'] = time();
}
$IIIIIIIII1I1 = $IIIIII11Illl->add($_POST);
if($IIIIIIIII1I1){
$IIIIII11IlI1['pid']		= $IIIIIIIII1I1;
$IIIIII11IlI1['module']	= 'Problem';
$IIIIII11IlI1['token']	= $this->IIIIIIIIlIlI;
$IIIIII11IlI1['keyword']	= $this->_post('keyword','trim');
$IIIIII1I1lII->add($IIIIII11IlI1);
}
$this->success('添加成功',U('Problem/index',array('token'=>$this->IIIIIIIIlIlI)));
}else{
if($IIIIII11Ill1['start_time'] == ''){
if($_POST['is_open'] == 1){
$_POST['start_time'] = time();
}
}
$IIIIII11Il1I = array('token'=>$this->IIIIIIIIlIlI,'id'=>$this->_post('id','intval'));
$IIIIII11Il1l = $IIIIII11Illl->where($IIIIII11Il1I)->save($_POST);
if($IIIIII11Il1l){
$IIIIII11IlI1['pid']		= $this->_POST('id','intval');
$IIIIII11IlI1['module']	= 'Problem';
$IIIIII11IlI1['token']	= $this->IIIIIIIIlIlI;
$IIIIII11IlI1['keyword']	= $this->_post('keyword','trim');
$IIIIII1I1lII->where(array('token'=>$this->IIIIIIIIlIlI,'pid'=>$this->_post('id','intval'),'module'=>'Problem'))->save($IIIIII11IlI1);
}
$this->success('修改成功',U('Problem/index',array('token'=>$this->IIIIIIIIlIlI)));
}
}else{
$this->error($IIIIII11Illl->getError());
}
}else{
$this->assign('set',$IIIIII11Ill1);
$this->display();
}
}
public function game_del(){
$IIIIIIIII1I1 	= $this->_get('id','intval');
$IIIIIIIIlIl1 	= array('token'=>$this->IIIIIIIIlIlI,'id'=>$IIIIIIIII1I1);
if(M('Problem_game')->where($IIIIIIIIlIl1)->delete()){
$IIIIII11I1II 	= M('Problem_question')->where(array('token'=>$this->IIIIIIIIlIlI,'problem_id'=>$IIIIIIIII1I1))->getField('id',true);
M('Problem_question')->where(array('token'=>$this->IIIIIIIIlIlI,'problem_id'=>$IIIIIIIII1I1))->delete();
if(!empty($IIIIII11I1II)){
M('Problem_option')->where(array('token'=>$this->IIIIIIIIlIlI,'question_id'=>array('in',$IIIIII11I1II)))->delete();
}
M('Problem_question_log')->where(array('token'=>$this->IIIIIIIIlIlI,'problem_id'=>$IIIIIIIII1I1))->delete();
M('Problem_user')->where(array('token'=>$this->IIIIIIIIlIlI,'problem_id'=>$IIIIIIIII1I1))->delete();
M('Keyword')->where(array('token'=>$this->IIIIIIIIlIlI,'pid'=>$IIIIIIIII1I1,'module'=>'Problem'))->delete();
$this->success('删除成功',U('Problem/index',array('token'=>$this->IIIIIIIIlIlI)));
}
}
public function question(){
$IIIIII11I1I1 	= $this->_get('problem_id','intval');
$IIIIII11I1lI 		= $this->_post('searchkey','trim');
$IIIIIIIIlIl1 	= array('token'=>$this->IIIIIIIIlIlI,'problem_id'=>$IIIIII11I1I1);
if(!empty($IIIIII11I1lI)){
$IIIIIIIIlIl1['title'] 	= array('like','%'.$IIIIII11I1lI.'%');
}
$IIIIIIIII1ll	= M('Problem_question')->where($IIIIIIIIlIl1)->count();
$IIIIIIll1lll   = new Page($IIIIIIIII1ll,15);
$IIIIII11I1ll = M('Problem_question')->where($IIIIIIIIlIl1)->order('sort desc,id desc')->limit($IIIIIIll1lll->firstRow.','.$IIIIIIll1lll->listRows)->select();
foreach ($IIIIII11I1ll as $IIIIIIIlI11I =>$IIIIIIIlI11l) {
$IIIIII11I1l1 	= array('token'=>$this->IIIIIIIIlIlI,'question_id'=>$IIIIIIIlI11l['id']);
$IIIIII11I1ll[$IIIIIIIlI11I]['option'] 	= M('Problem_option')->where($IIIIII11I1l1)->select();
}
$IIIIII11I11I = 'abcdefghijklmnopqrstuvwxyz';
$this->assign('ic',$IIIIII11I11I);
$this->assign('question_info',$IIIIII11I1ll);
$this->assign('page',$IIIIIIll1lll->show());
$this->assign('problem_id',$IIIIII11I1I1);
$this->display();
}
public function question_add(){
$IIIIII11I1I1 	= $this->_get('problem_id','intval');
if(IS_POST){
$IIIIII11I111 	= $_REQUEST['question'];
$IIIIIIl1llll   	= $_REQUEST['sort'];
$IIIIII11lIII   	= $_REQUEST['is_show'];
$IIIIII11lIIl   	= $_REQUEST['option'];
$IIIIII11lII1  	= $_REQUEST['is_true'];
$IIIIII11lIlI = true;
for ($IIIIIIIllI11=0;$IIIIIIIllI11 <count($IIIIII11I111);$IIIIIIIllI11++) {
$IIIIII11lIll['token'] 		= $this->IIIIIIIIlIlI;
$IIIIII11lIll['problem_id'] 	= $IIIIII11I1I1;
$IIIIII11lIll['title'] 		= $IIIIII11I111[$IIIIIIIllI11];
$IIIIII11lIll['sort'] 		= $IIIIIIl1llll[$IIIIIIIllI11]?$IIIIIIl1llll[$IIIIIIIllI11]:50;
$IIIIII11lIll['is_show'] 		= $IIIIII11lIII[$IIIIIIIllI11]?1:0;
$IIIIII11lIl1 = M('Problem_question')->add($IIIIII11lIll);
if($IIIIII11lIl1){
for ($IIIIIIIllIll=0;$IIIIIIIllIll <count($IIIIII11lIIl[$IIIIIIIllI11]);$IIIIIIIllIll++) {
$IIIIII11lI1I['token'] 		= $this->IIIIIIIIlIlI;
$IIIIII11lI1I['question_id'] 	= $IIIIII11lIl1;
$IIIIII11lI1I['answer'] 		= $IIIIII11lIIl[$IIIIIIIllI11][$IIIIIIIllIll];
$IIIIII11lI1I['is_true'] 		= $IIIIII11lII1[$IIIIIIIllI11][$IIIIIIIllIll]?$IIIIII11lII1[$IIIIIIIllI11][$IIIIIIIllIll]:0;
$IIIIII11lI1I['sort'] 		= 50;
$IIIIII11lI1l = M('Problem_option')->add($IIIIII11lI1I);
if(!$IIIIII11lI1l){
$IIIIII11lIlI = false;
M('Problem_question')->where(array('token'=>$this->IIIIIIIIlIlI,'id'=>$IIIIII11lIl1))->delete();
}
}
}else{
$IIIIII11lIlI = false;
}
}
if($IIIIII11lIlI){
$this->success('添加成功',U('Problem/question',array('token'=>$this->IIIIIIIIlIlI,'problem_id'=>$IIIIII11I1I1)));
}else{
$this->error('未知错误，请重新添加',U('Problem/question_add',array('token'=>$this->IIIIIIIIlIlI,'problem_id'=>$IIIIII11I1I1)));
}
}else{
$this->assign('problem_id',$IIIIII11I1I1);
$this->display();
}
}
public function question_edit(){
$IIIIII11I1I1	= $this->_get('problem_id','intval');
$IIIIIIIII1I1 		= $this->_get('id','intval');
$IIIIIIIIlIl1 		= array('token'=>$this->IIIIIIIIlIlI,'problem_id'=>$IIIIII11I1I1,'id'=>$IIIIIIIII1I1);
$IIIIII11llII = M('Problem_question')->where($IIIIIIIIlIl1)->find();
$IIIIII11I1l1	= array('token'=>$IIIIIIIIlIlI,'question_id'=>$IIIIII11llII['id']);
$IIIIII11llII['op_data'] 	= M('Problem_option')->where($IIIIII11I1l1)->order('sort desc')->select();
if(IS_POST){
$IIIIII11llIl 			= $_REQUEST['qid'];
$IIIIII11llI1 		= $_REQUEST['title'];
$IIIIII11lllI		= $_REQUEST['is_show'];
$IIIIII11llll		= $_REQUEST['sort'];
$IIIIII11lIll['id']		= $IIIIII11llIl[0];
$IIIIII11lIll['title']	= $IIIIII11llI1[0];
$IIIIII11lIll['is_show']	= $IIIIII11lllI[0];
$IIIIII11lIll['sort']		= $IIIIII11llll[0];
$IIIIII11lll1 		= array('token'=>$this->IIIIIIIIlIlI,'id'=>$IIIIII11lIll['id']);
M('Problem_question')->where($IIIIII11lll1)->save($IIIIII11lIll);
if($IIIIII11lIll['id']){
$IIIIII11ll1I 		= $_REQUEST['oid'][0];
$IIIIII11ll1l 	= $_REQUEST['answer'][0];
$IIIIII11ll11 = $_REQUEST['is_true'][0];
for ($IIIIIIIllI11=0;$IIIIIIIllI11 <count($IIIIII11ll1l);$IIIIIIIllI11++) {
$IIIIII11lI1I['token'] 		= $this->IIIIIIIIlIlI;
$IIIIII11lI1I['question_id']	= $IIIIII11lIll['id'];
$IIIIII11lI1I['answer']		= $IIIIII11ll1l[$IIIIIIIllI11];
$IIIIII11lI1I['sort']			= 50;
$IIIIII11lI1I['is_true']		= $IIIIII11ll11[$IIIIIIIllI11]?$IIIIII11ll11[$IIIIIIIllI11]:0;
if(empty($IIIIII11ll1I[$IIIIIIIllI11])){
M('Problem_option')->add($IIIIII11lI1I);
}else{
$IIIIII11I1l1 		= array('question_id'=>$IIIIII11lI1I['question_id'],'id'=>$IIIIII11ll1I[$IIIIIIIllI11]);
M('Problem_option')->where($IIIIII11I1l1)->save($IIIIII11lI1I);
}
}
}
$this->success('修改成功',U('Problem/question',array('token'=>$this->IIIIIIIIlIlI,'problem_id'=>$IIIIII11I1I1)));
}else{
$this->assign('problem_id',$IIIIII11I1I1);
$this->assign('quest_info',$IIIIII11llII);
$this->display();
}
}
public function question_del(){
$IIIIII11I1I1	= $this->_get('problem_id','intval');
$IIIIIIIII1I1 		= $this->_get('id');
$IIIIIIIIlIl1 		= array('token'=>$this->IIIIIIIIlIlI,'problem_id'=>$IIIIII11I1I1,'id'=>$IIIIIIIII1I1);
if(M('Problem_question')->where($IIIIIIIIlIl1)->delete()){
$IIIIII11I1l1 = array('question_id'=>$IIIIIIIII1I1);
M('Problem_option')->where($IIIIII11I1l1)->delete();
$this->success('删除成功',U('Problem/question',array('token'=>$this->IIIIIIIIlIlI,'problem_id'=>$IIIIII11I1I1)));
}
}
public function option_del(){
$IIIIII11I1I1	= $this->_get('problem_id','intval');
$IIIIIIIII1I1 		= $this->_get('id');
$IIIIIIIIlIl1 		= array('token'=>$this->IIIIIIIIlIlI,'id'=>$IIIIIIIII1I1);
if(M('Problem_option')->where($IIIIIIIIlIl1)->delete()){
if($this->_get('is_ajax','intval') == 1){
echo true;
}else{
$this->success('删除成功',U('Problem/question',array('token'=>$this->IIIIIIIIlIlI,'problem_id'=>$IIIIII11I1I1)));
}
}
}
public function user_info(){
$IIIIIIlllIl1 	= $this->_post('search','trim');
$IIIIII11I1I1 = $this->_get('problem_id','intval');
$IIIIIIIIlIl1 		= array('token'=>$this->IIIIIIIIlIlI,'problem_id'=>$IIIIII11I1I1);
if(!empty($IIIIIIlllIl1)){
$IIIIIIIIlIl1['user_name|nickname'] = array('like','%'.$IIIIIIlllIl1.'%');
}
$IIIIIIIII1ll		= M('Problem_user')->where($IIIIIIIIlIl1)->count();
$IIIIIIll1lll   	= new Page($IIIIIIIII1ll,15);
$IIIIIIIIIlll 		= M('Problem_user')->where($IIIIIIIIlIl1)->order('add_time desc')->limit($IIIIIIll1lll->firstRow.','.$IIIIIIll1lll->listRows)->select();
$this->assign('info',$IIIIIIIIIlll);
$this->assign('problem_id',$IIIIII11I1I1);
$this->assign('page',$IIIIIIll1lll->show());
$this->display();
}
public function user_del(){
$IIIIIIIIIlII 		= $this->_get('uid','intval');
$IIIIIIIIlllI 		= $this->_get('problem_id','intval');
$IIIIIIIIlIl1 		= array('token'=>$this->IIIIIIIIlIlI,'problem_id'=>$IIIIIIIIlllI,'id'=>$IIIIIIIIIlII);
if(M('Problem_user')->where($IIIIIIIIlIl1)->delete()){
$IIIIII11l1ll = array('token'=>$this->IIIIIIIIlIlI,'problem_id'=>$IIIIIIIIlllI,'uid'=>$IIIIIIIIIlII);
M('problem_question_log')->where($IIIIII11l1ll)->delete();
$this->success('删除成功',U('Problem/user_info',array('token'=>$this->IIIIIIIIlIlI,'problem_id'=>$IIIIIIIIlllI)));
}
}
public function show_question_log(){
$IIIIII11I1I1 = $this->_get('problem_id','intval');
$IIIIIIIIIlII 		= $this->_get('uid','intval');
$IIIIIIIIlIl1 		= array('token'=>$this->IIIIIIIIlIlI,'problem_id'=>$IIIIII11I1I1,'uid'=>$IIIIIIIIIlII);
$IIIIIIIII1ll		= M('Problem_user')->where($IIIIIIIIlIl1)->count();
$IIIIIIll1lll   	= new Page($IIIIIIIII1ll,5);
$IIIIII11l11I 		= M('problem_question_log')->where($IIIIIIIIlIl1)->order('add_time desc')->limit($IIIIIIll1lll->firstRow.','.$IIIIIIll1lll->listRows)->select();
foreach ($IIIIII11l11I as $IIIIIIIlI11I =>$IIIIIIIlI11l) {
$IIIIII11l11I[$IIIIIIIlI11I]['q_name'] = M('Problem_question')->where(array('id'=>$IIIIIIIlI11l['question_id']))->getField('title');
if($IIIIIIIlI11l['option_id'] != 0){
$IIIIII11l11I[$IIIIIIIlI11I]['o_name'] = M('Problem_option')->where(array('id'=>$IIIIIIIlI11l['option_id']))->getField('answer');
}else{
$IIIIII11l11I[$IIIIIIIlI11I]['o_name'] = '超时错误';
}
}
$this->assign('log',$IIIIII11l11I);
$this->assign('page',$IIIIIIll1lll->show());
$this->display();
}
}
?>