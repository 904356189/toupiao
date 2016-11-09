<?php

class AttachmentAction extends UserAction{
public function _initialize() {
parent::_initialize();
C('site_url','http://'.$_SERVER['HTTP_HOST']);
}
public function index(){
$IIIIIIlIllIl=$_GET['type'];
$IIIIIIlIllIl=$IIIIIIlIllIl?$IIIIIIlIllIl:'icon';
$this->assign('type',$IIIIIIlIllIl);
$IIIIIIll1I1l=$_GET['folder'];
$IIIIIIll1I11=$this->files();
$IIIIIIll1lII=array();
$IIIIIIIllI11=0;
foreach ($IIIIIIll1I11[$IIIIIIlIllIl] as $IIIIIIIllIll=>$IIIIIIll1lIl){
array_push($IIIIIIll1lII,array('name'=>$IIIIIIll1lIl['name'],'folder'=>$IIIIIIIllIll));
if ($IIIIIIIllI11==0&&!$IIIIIIll1I1l){
$IIIIIIll1I1l=$IIIIIIIllIll;
}
$IIIIIIIllI11++;
}
$this->assign('folders',$IIIIIIll1lII);
$this->assign('folder',$IIIIIIll1I1l);
$IIIIIIll1lI1=$IIIIIIll1I11[$IIIIIIlIllIl][$IIIIIIll1I1l]['files'];
$IIIIIIll1llI=$IIIIIIll1I11[$IIIIIIlIllIl][$IIIIIIll1I1l]['height'];
$IIIIIIIII1ll = count($IIIIIIll1lI1);
$IIIIIIll1lll       = new Page($IIIIIIIII1ll,32);
$IIIIIIll1lI1 = array_slice($IIIIIIll1lI1,$IIIIIIll1lll->firstRow,$IIIIIIll1lll->listRows);
$IIIIIIIII11l       = $IIIIIIll1lll->show();
$this->assign('files',$IIIIIIll1lI1);
$this->assign('show',$IIIIIIIII11l);
$this->assign('height',$IIIIIIll1llI);
$this->assign('siteUrl',C('site_url'));
$this->display();
}
public function files(){
$IIIIIIll1l1l = $_GET['color'];
$IIIIIIll1I1l = isset($_GET['folder'])?$_GET['folder']:'canyin';
$IIIIIIll1l11 = array(
'canyin'=>'餐饮',
'wedding'=>'婚纱摄影',
'fangdichan'=>'房地产',
'tour'=>'旅游',
'jianshenmeirong'=>'健身美容',
'health'=>'医疗保健',
'edu'=>'教育培训',
'car'=>'汽车',
'hotel'=>'酒店'
);
$IIIIIIll11II = array(
'canyin'=>array(
'name'=>'餐饮',
'height'=>60,
),
'hotel'=>array(
'name'=>'酒店',
'height'=>60,
),
'car'=>array(
'name'=>'汽车',
'height'=>60,
),
'tour'=>array(
'name'=>'旅游',
'height'=>60,
),
'fangdichan'=>array(
'name'=>'房地产',
'height'=>60,
),
'edu'=>array(
'name'=>'教育培训',
'height'=>60,
),
'jianshenmeirong'=>array(
'name'=>'健身美容',
'height'=>60,
),
'health'=>array(
'name'=>'医疗保健',
'height'=>60,
),
'wedding'=>array(
'name'=>'婚纱摄影',
'height'=>60,
),
'lovely'=>array(
'name'=>'卡通图标',
'height'=>60,
'files'=>array('1.png','backpack-2.png','bill.png','bookmark.png','bookshelf.png','briefcase.png','bus.png','calc.png','candy.png','car.png','chalkboard.png','clock.png','cloud-check.png','cloud-down.png','cloud-error.png','cloud-refresh.png','cloud-up.png','donut.png','drop.png','eye.png','flag.png','glasses.png','glove.png','hamburger.png','hand.png','hotdog.png','knife.png','label.png','map.png','map2.png','marker.png','mcfly.png','medicine.png','mountain.png','muffin.png','open-letter.png','packman.png','paper-plane.png','photo.png','piggy.png','pin.png','pizza.png','r2d2.png','rocket.png','skull.png','speakers.png','store.png','tactics.png','toaster.png','train.png','umbrella.png','watch.png','www.png','2.png','3.png','4.png','5.png','6.png','7.png','8.png','9.png','10.png','11.png')
),
'colorful'=>array(
'name'=>'彩色图标',
'height'=>70,
'files'=>array('1.png','2.png','3.png','4.png','5.png','6.png','7.png','8.png','9.png','10.png','11.png')
),
'white'=>array(
'name'=>'白色图标',
'height'=>50,
'files'=>array('1.png','2.png','3.png','4.png','5.png','6.png','7.png','8.png','9.png','10.png','11.png','12.png','13.png','14.png','15.png','16.png')
),
'line'=>array(
'name'=>'线条图标',
'height'=>50,
'files'=>array('banknote.png','bubble.png','bulb.png','calendar.png','camera.png','clip.png','clock.png','cloud.png','cup.png','data.png','diamond.png','display.png','eye.png','fire.png','food.png','heart.png','key.png','lab.png','like.png','location.png','lock.png','mail.png','megaphone.png','music.png','news.png','note.png','paperplane.png','params.png','pen.png','phone.png','photo.png','search.png','settings.png','shop.png','sound.png','stack.png','star.png','study.png','t-shirt.png','tag.png','trash.png','truck.png','tv.png','user.png','vallet.png','video.png','vynil.png','world.png')
),
);
$IIIIIIll1l11 = array_flip($IIIIIIll1l11);
$this->assign('folderArr',$IIIIIIll1l11);
if(in_array($IIIIIIll1I1l,$IIIIIIll1l11)){
$IIIIIIll11I1 = 
array(
'canyin'=>24,
'hotel'=>27,
'car'=>28,
'tour'=>25,
'fangdichan'=>24,
'edu'=>28,
'jianshenmeirong'=>25,
'health'=>25,
'wedding'=>21
);
$IIIIIIlI1llI = $IIIIIIll11I1[$IIIIIIll1I1l];
if(isset($IIIIIIll1l1l)){
for($IIIIIII11III=1;$IIIIIII11III<=$IIIIIIlI1llI;$IIIIIII11III++){
$IIIIIIll11lI[] = "{$IIIIIIll1I1l}_{$IIIIIIll1l1l}/{$IIIIIII11III}.png";
}
$IIIIIIll11II[$IIIIIIll1I1l]['files'] = $IIIIIIll11lI;
}else{
$IIIIIIll11ll = array('red','orange','yellow','green','blue','gray','purple','brown','white');
foreach($IIIIIIll11ll as $IIIIIIIllIll=>$IIIIIIlIllII){
for($IIIIIII11III=1;$IIIIIII11III<=$IIIIIIlI1llI;$IIIIIII11III++){
$IIIIIIll11lI[$IIIIIIIllIll][] = "{$IIIIIIll1I1l}_{$IIIIIIlIllII}/{$IIIIIII11III}.png";
}
$IIIIIIIlII1l[$IIIIIIIllIll] = $IIIIIIll11lI[$IIIIIIIllIll];
}
$IIIIIIll11II[$IIIIIIll1I1l]['files'] = array_merge($IIIIIIIlII1l[0],$IIIIIIIlII1l[1],$IIIIIIIlII1l[2],$IIIIIIIlII1l[3],$IIIIIIIlII1l[4],$IIIIIIIlII1l[5],$IIIIIIIlII1l[6],$IIIIIIIlII1l[7],$IIIIIIIlII1l[8]);
}
}
$IIIIIIll111I=array(
'view'=>'',
'canyin'=>array(
'name'=>'餐饮',
'height'=>100,
'files'=>array('1.jpg','2.jpg','3.jpg','4.jpg','5.jpg','6.jpg','7.jpg','8.jpg')
),
'hotel'=>array(
'name'=>'酒店',
'height'=>100,
'files'=>array('1.jpg','2.jpg','3.jpg','4.jpg','5.jpg')
),
'car'=>array(
'name'=>'汽车',
'height'=>100,
'files'=>array('1.jpg','2.jpg','3.jpg','4.jpg','5.jpg','6.jpg','7.jpg','8.jpg','9.jpg','10.jpg','11.jpg','12.jpg')
),
'tour'=>array(
'name'=>'旅游',
'height'=>100,
'files'=>array('1.jpg','2.jpg','3.jpg','4.jpg','5.jpg')
),
'fangdichan'=>array(
'name'=>'房地产',
'height'=>100,
'files'=>array('1.jpg','2.jpg','3.jpg','4.jpg','5.jpg','6.jpg','7.jpg','8.jpg','9.jpg')
),
'edu'=>array(
'name'=>'教育培训',
'height'=>100,
'files'=>array('1.jpg','2.jpg','3.jpg','4.jpg','5.jpg','6.jpg','7.jpg','8.jpg','9.jpg','10.jpg','11.jpg','12.jpg','13.jpg','14.jpg','15.jpg','16.jpg','17.jpg','18.jpg','19.jpg','20.jpg','21.jpg','22.jpg','23.jpg','24.jpg','25.jpg','26.jpg','27.jpg')
),
'jianshenmeirong'=>array(
'name'=>'健身美容',
'height'=>100,
'files'=>array('1.jpg','2.jpg','3.jpg','4.jpg','5.jpg','6.jpg','7.jpg','8.jpg','9.jpg','10.jpg')
),
'health'=>array(
'name'=>'医疗保健',
'height'=>100,
'files'=>array('1.jpg','2.jpg','3.jpg','4.jpg','5.jpg','6.jpg','7.jpg','8.jpg','9.jpg','10.jpg','11.jpg','12.jpg','13.jpg','14.jpg')
),
'wedding'=>array(
'name'=>'婚纱摄影',
'height'=>100,
'files'=>array('1.jpg','2.jpg','3.jpg','4.jpg','5.jpg','6.jpg','7.jpg','8.jpg','9.jpg')
),
);
if($_GET['type'] == 'background'){
function canyinMap($IIIIIIll1111){
return '../canyin/'.$IIIIIIll1111;
}
function hotelMap($IIIIIIll1111){
return '../hotel/'.$IIIIIIll1111;
}
function carMap($IIIIIIll1111){
return '../car/'.$IIIIIIll1111;
}
function tourMap($IIIIIIll1111){
return '../tour/'.$IIIIIIll1111;
}
function fangdichanMap($IIIIIIll1111){
return '../fangdichan/'.$IIIIIIll1111;
}
function eduMap($IIIIIIll1111){
return '../edu/'.$IIIIIIll1111;
}
function jianshenmeirongMap($IIIIIIll1111){
return '../jianshenmeirong/'.$IIIIIIll1111;
}
function healthMap($IIIIIIll1111){
return '../health/'.$IIIIIIll1111;
}
function weddingMap($IIIIIIll1111){
return '../wedding/'.$IIIIIIll1111;
}
$IIIIIIl1II11['canyin'] = array_map("canyinMap",$IIIIIIll111I['canyin']['files']);
$IIIIIIl1II11['hotel'] = array_map("hotelMap",$IIIIIIll111I['hotel']['files']);
$IIIIIIl1II11['car'] = array_map("carMap",$IIIIIIll111I['car']['files']);
$IIIIIIl1II11['tour'] = array_map("tourMap",$IIIIIIll111I['tour']['files']);
$IIIIIIl1II11['fangdichan'] = array_map("fangdichanMap",$IIIIIIll111I['fangdichan']['files']);
$IIIIIIl1II11['edu'] = array_map("eduMap",$IIIIIIll111I['edu']['files']);
$IIIIIIl1II11['jianshenmeirong'] = array_map("jianshenmeirongMap",$IIIIIIll111I['jianshenmeirong']['files']);
$IIIIIIl1II11['health'] = array_map("healthMap",$IIIIIIll111I['health']['files']);
$IIIIIIl1II11['wedding'] = array_map("weddingMap",$IIIIIIll111I['wedding']['files']);
$IIIIIIl1II11['view'] = array('1.jpg','2.jpg','3.jpg','4.jpg','5.jpg','6.jpg','7.jpg','8.jpg','9.jpg');
$IIIIIIll111I['view'] = array(
'name'=>'默认',
'height'=>100,
'files'=>array_merge($IIIIIIl1II11['view'],$IIIIIIl1II11['canyin'],$IIIIIIl1II11['hotel'],$IIIIIIl1II11['car'],$IIIIIIl1II11['tour'],$IIIIIIl1II11['fangdichan'],$IIIIIIl1II11['edu'],$IIIIIIl1II11['jianshenmeirong'],$IIIIIIl1II11['health'],$IIIIIIl1II11['wedding'])
);
}
$IIIIIIl1IlIl=array(
'default'=>'',
'canyin'=>array(
'name'=>'餐饮',
'height'=>70,
'files'=>array('1.jpg','2.jpg','3.jpg','4.jpg','5.jpg','6.jpg','7.jpg','8.jpg','9.jpg','10.jpg','11.jpg','12.jpg','13.jpg','14.jpg')
),
'hotel'=>array(
'name'=>'酒店',
'height'=>70,
'files'=>array('1.jpg','2.jpg','3.jpg','4.jpg','5.jpg','6.jpg','7.jpg','8.jpg','9.jpg')
),
'car'=>array(
'name'=>'汽车',
'height'=>70,
'files'=>array('1.jpg','2.jpg','3.jpg','4.jpg','5.jpg','6.jpg','7.jpg','8.jpg','9.jpg','10.jpg','11.jpg','12.jpg','13.jpg','14.jpg','15.jpg','16.jpg')
),
'tour'=>array(
'name'=>'旅游',
'height'=>70,
'files'=>array('1.jpg','2.jpg','3.jpg','4.jpg','5.jpg','6.jpg','7.jpg','8.jpg','9.jpg','10.jpg','11.jpg','12.jpg','13.jpg','14.jpg')
),
'fangdichan'=>array(
'name'=>'房地产',
'height'=>70,
'files'=>array('1.jpg','2.jpg','3.jpg','4.jpg','5.jpg','6.jpg','7.jpg','8.jpg','9.jpg')
),
'edu'=>array(
'name'=>'教育培训',
'height'=>70,
'files'=>array('1.jpg','2.jpg','3.jpg','4.jpg','5.jpg','6.jpg','7.jpg','8.jpg','9.jpg','10.jpg','11.jpg','12.jpg','13.jpg','14.jpg','15.jpg','16.jpg','17.jpg')
),
'jianshenmeirong'=>array(
'name'=>'健身美容',
'height'=>70,
'files'=>array('1.jpg','2.jpg','3.jpg','4.jpg','5.jpg','6.jpg','7.jpg','8.jpg','9.jpg','10.jpg','11.jpg','12.jpg','13.jpg')
),
'health'=>array(
'name'=>'医疗保健',
'height'=>70,
'files'=>array('1.jpg','2.jpg','3.jpg','4.jpg','5.jpg','6.jpg','7.jpg','8.jpg','9.jpg','10.jpg','11.jpg')
),
'wedding'=>array(
'name'=>'婚纱摄影',
'height'=>70,
'files'=>array('1.jpg','2.jpg','3.jpg','4.jpg','5.jpg','6.jpg','7.jpg','8.jpg','9.jpg','10.jpg','11.jpg','12.jpg','13.jpg')
),
);
if($_GET['type'] == 'focus'){
function canyinMap($IIIIIIll1111){
return '../canyin/'.$IIIIIIll1111;
}
function hotelMap($IIIIIIll1111){
return '../hotel/'.$IIIIIIll1111;
}
function carMap($IIIIIIll1111){
return '../car/'.$IIIIIIll1111;
}
function tourMap($IIIIIIll1111){
return '../tour/'.$IIIIIIll1111;
}
function fangdichanMap($IIIIIIll1111){
return '../fangdichan/'.$IIIIIIll1111;
}
function eduMap($IIIIIIll1111){
return '../edu/'.$IIIIIIll1111;
}
function jianshenmeirongMap($IIIIIIll1111){
return '../jianshenmeirong/'.$IIIIIIll1111;
}
function healthMap($IIIIIIll1111){
return '../health/'.$IIIIIIll1111;
}
function weddingMap($IIIIIIll1111){
return '../wedding/'.$IIIIIIll1111;
}
$IIIIIIl1II11['canyin'] = array_map("canyinMap",$IIIIIIl1IlIl['canyin']['files']);
$IIIIIIl1II11['hotel'] = array_map("hotelMap",$IIIIIIl1IlIl['hotel']['files']);
$IIIIIIl1II11['car'] = array_map("carMap",$IIIIIIl1IlIl['car']['files']);
$IIIIIIl1II11['tour'] = array_map("tourMap",$IIIIIIl1IlIl['tour']['files']);
$IIIIIIl1II11['fangdichan'] = array_map("fangdichanMap",$IIIIIIl1IlIl['fangdichan']['files']);
$IIIIIIl1II11['edu'] = array_map("eduMap",$IIIIIIl1IlIl['edu']['files']);
$IIIIIIl1II11['jianshenmeirong'] = array_map("jianshenmeirongMap",$IIIIIIl1IlIl['jianshenmeirong']['files']);
$IIIIIIl1II11['health'] = array_map("healthMap",$IIIIIIl1IlIl['health']['files']);
$IIIIIIl1II11['wedding'] = array_map("weddingMap",$IIIIIIl1IlIl['wedding']['files']);
$IIIIIIl1II11['view'] = array('1.gif','2.jpg','3.jpg','4.jpg','5.gif','6.jpg');
$IIIIIIl1IlIl['default'] = array(
'name'=>'默认',
'height'=>100,
'files'=>array_merge($IIIIIIl1II11['view'],$IIIIIIl1II11['canyin'],$IIIIIIl1II11['hotel'],$IIIIIIl1II11['car'],$IIIIIIl1II11['tour'],$IIIIIIl1II11['fangdichan'],$IIIIIIl1II11['edu'],$IIIIIIl1II11['jianshenmeirong'],$IIIIIIl1II11['health'],$IIIIIIl1II11['wedding'])
);
}
$IIIIIIl1IlI1=array(
'default'=>array('name'=>'默认','files'=>array(array('file'=>'1.mp3','name'=>'汪峰-一起摇摆'),array('file'=>'2.mp3','name'=>'方大同-明天我要嫁给你了'),array('file'=>'3.mp3','name'=>'今天你要嫁给我'),array('file'=>'4.mp3','name'=>'钢琴曲卡农'))),
);
return array('icon'=>$IIIIIIll11II,'background'=>$IIIIIIll111I,'music'=>$IIIIIIl1IlI1,'focus'=>$IIIIIIl1IlIl);
}
public function my(){
$IIIIIIIlIII1=M('Files');
$IIIIIIIIlIl1=array('token'=>$this->IIIIIIIIlIlI);
$IIIIIIIII1ll      = $IIIIIIIlIII1->where($IIIIIIIIlIl1)->count();
$IIIIIIll1lll       = new Page($IIIIIIIII1ll,5);
$IIIIIIIII11l       = $IIIIIIll1lll->show();
$IIIIIIIIlIII=$IIIIIIIlIII1->where($IIIIIIIIlIl1)->limit($IIIIIIll1lll->firstRow.','.$IIIIIIll1lll->listRows)->order('id DESC')->select();
$this->assign('list',$IIIIIIIIlIII);
$this->assign('page',$IIIIIIIII11l);
$this->assign('type','my');
$this->display('index');
}
public function delete(){
$IIIIIIIII1I1=intval($_GET['id']);
$IIIIIIl1Ill1=M('Files')->where(array('id'=>$IIIIIIIII1I1))->find();
M('Files')->where(array('id'=>$IIIIIIIII1I1,'token'=>$this->IIIIIIIIlIlI))->delete();
$IIIIIIl1Il1I=str_replace('http://','',$IIIIIIl1Ill1['url']);
$IIIIIIl1Il1l=explode('/',$IIIIIIl1Il1I);
$IIIIIIl1Il11=str_replace($IIIIIIl1Il1l[0],'',$IIIIIIl1Il1I);
@unlink($_SERVER['DOCUMENT_ROOT'].$IIIIIIl1Il11);
$this->success('删除成功');
}
}
?>