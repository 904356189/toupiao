<?php

class MapAction extends Action{
public $IIIIIIIIlIlI;
public $IIIIIII1I1II;
public function _initialize() {
$this->IIIIIIIIlIlI=$this->_get('token');
$this->assign('token',$this->IIIIIIIIlIlI);
$this->IIIIIII1I1II=C('baidu_map_api');
$this->assign('apikey',$this->IIIIIII1I1II);
}
public function staticCompanyMap(){
$IIIIIII1I1I1=M('Company');
$IIIIIIIIlIl1=array('token'=>$this->IIIIIIIIlIlI);
$IIIIIII1I1lI=$IIIIIII1I1I1->where($IIIIIIIIlIl1)->order('isbranch ASC')->find();
$IIIIIIIIlIl1['isbranch']=1;
$IIIIIII1I1ll=$IIIIIII1I1I1->where($IIIIIIIIlIl1)->order('taxis ASC')->select();
$IIIIIIIlll1I=array();
$IIIIIII1I1l1='http://api.map.baidu.com/staticimage?center='.$IIIIIII1I1lI['longitude'].','.$IIIIIII1I1lI['latitude'].'&width=640&height=320&zoom=11&markers='.$IIIIIII1I1lI['longitude'].','.$IIIIIII1I1lI['latitude'].'&markerStyles=l,1';
$IIIIIII1I11I=$IIIIIII1I1lI['name'].'地图';
if ($IIIIIII1I1ll){
$IIIIIII1I11I='1.'.$IIIIIII1I11I;
}
$IIIIIIIlll1I[]=array($IIIIIII1I11I,"电话：".$IIIIIII1I1lI['tel']."\r\n地址：".$IIIIIII1I1lI['address']."\r\n回复“开车去”“步行去”或“坐公交”获取详细线路\r\n点击查看详细",$IIIIIII1I1l1,C('site_url').'/index.php?g=Wap&m=Company&a=map&token='.$this->IIIIIIIIlIlI);
if ($IIIIIII1I1ll){
$IIIIIIIllI11=2;
$IIIIIII1I11l='';
foreach ($IIIIIII1I1ll as $IIIIIII1I1lI){
$IIIIIII1I1l1='http://api.map.baidu.com/staticimage?center='.$IIIIIII1I1lI['longitude'].','.$IIIIIII1I1lI['latitude'].'&width=80&height=80&zoom=11&markers='.$IIIIIII1I1lI['longitude'].','.$IIIIIII1I1lI['latitude'].'&markerStyles=l,'.$IIIIIIIllI11;
$IIIIIIIlll1I[]=array($IIIIIIIllI11.'.'.$IIIIIII1I1lI['name'].'地图',"电话：".$IIIIIII1I1lI['tel']."\r\n地址：".$IIIIIII1I1lI['address']."\r\n点击查看详细",$IIIIIII1I1l1,C('site_url').'/index.php?g=Wap&m=Company&a=map&companyid='.$IIIIIII1I1lI['id'].'&token='.$this->IIIIIIIIlIlI);
$IIIIIIIllI11++;
}
$IIIIIII1I1l1=$IIIIIII1I1lI['logourl'];
$IIIIIIIlll1I[]=array('回复“最近的”查看哪一个离你最近，或者回复“开车去+编号”“步行去+编号”或“坐公交+编号”获取详细线路',"电话：".$IIIIIII1I1lI['tel']."\r\n地址：".$IIIIIII1I1lI['address']."\r\n点击查看详细",$IIIIIII1I1l1,C('site_url').'/index.php?g=Wap&m=Company&a=map&token='.$this->IIIIIIIIlIlI);
}
return array($IIIIIIIlll1I,'news');
}
public function walk($IIIIIII1II1I,$IIIIIII1lIII,$IIIIIII1lIIl=1){
$IIIIIII1I1I1=M('Company');
$IIIIIIIIlIl1=array('token'=>$this->IIIIIIIIlIlI);
$IIIIIII1I1ll=$IIIIIII1I1I1->where($IIIIIIIIlIl1)->order('isbranch ASC,taxis ASC')->select();
$IIIIIIIllI11=intval($IIIIIII1lIIl)-1;
$IIIIIII1I1lI=$IIIIIII1I1ll[$IIIIIIIllI11];
$IIIIIII1lII1=json_decode(file_get_contents('http://api.map.baidu.com/direction/v1?mode=walking&origin='.$IIIIIII1II1I.','.$IIIIIII1lIII.'&destination='.$IIIIIII1I1lI['latitude'].','.$IIIIIII1I1lI['longitude'].'&region=&output=json&ak='.$this->IIIIIII1I1II),1);
if (is_array($IIIIIII1lII1)){
$IIIIIIIlll1I=array();
$IIIIIII1I1l1='http://api.map.baidu.com/staticimage?center='.$IIIIIII1I1lI['longitude'].','.$IIIIIII1I1lI['latitude'].'&width=640&height=320&zoom=13&markers='.$IIIIIII1I1lI['longitude'].','.$IIIIIII1I1lI['latitude'];
$IIIIIII1lIll=$IIIIIII1lII1['result']['routes'][0]['distance'];
if ($IIIIIII1lIll>1000){
$IIIIIII1lIl1=(round($IIIIIII1lIll/1000,2)).'公里';
}else {
$IIIIIII1lIl1=$IIIIIII1lIll.'米';
}
$IIIIIII1lI1l=$IIIIIII1lII1['result']['routes'][0]['duration']/60;
if ($IIIIIII1lI1l>60){
$IIIIIII1lI11=intval($IIIIIII1lI1l/100).'小时';
if ($IIIIIII1lI1l%60>0){
$IIIIIII1lI11.=($IIIIIII1lI1l%60).'分钟';
}
}else {
$IIIIIII1lI11=intval($IIIIIII1lI1l).'分钟';
}
$IIIIIII1llII="";
$IIIIIII1llIl=$IIIIIII1lII1['result']['routes'][0]['steps'];
if ($IIIIIII1llIl){
$IIIIIIIllI11=1;
foreach ($IIIIIII1llIl as $IIIIIII1llI1){
$IIIIIII1llII.="\r\n".$IIIIIIIllI11.".".str_replace(array('<b>','</b>'),'',$IIIIIII1llI1['instructions']);
$IIIIIIIllI11++;
}
}
$IIIIIIIlll1I[]=array('步行到'.$IIIIIII1I1lI['name'].'行程有'.$IIIIIII1lIl1.',大概需要'.$IIIIIII1lI11,"具体方案：".$IIIIIII1llII,$IIIIIII1I1l1,C('site_url').'/index.php?g=Wap&m=Company&a=walk&longitude='.$IIIIIII1lIII.'&latitude='.$IIIIIII1II1I.'&companyid='.$IIIIIII1I1lI['id'].'&token='.$this->IIIIIIIIlIlI);
return array($IIIIIIIlll1I,'news');
}else {
return array('没有相应的路书','text');
}
}
public function drive($IIIIIII1II1I,$IIIIIII1lIII,$IIIIIII1llll=1){
$IIIIIII1I1I1=M('Company');
$IIIIIIIIlIl1=array('token'=>$this->IIIIIIIIlIlI);
$IIIIIII1I1ll=$IIIIIII1I1I1->where($IIIIIIIIlIl1)->order('isbranch ASC,taxis ASC')->select();
$IIIIIIIllI11=intval($IIIIIII1llll)-1;
$IIIIIII1I1lI=$IIIIIII1I1ll[$IIIIIIIllI11];
$IIIIIII1lII1=json_decode(file_get_contents('http://api.map.baidu.com/direction/v1?mode=driving&origin='.$IIIIIII1II1I.','.$IIIIIII1lIII.'&destination='.$IIIIIII1I1lI['latitude'].','.$IIIIIII1I1lI['longitude'].'&origin_region=&destination_region=&output=json&ak='.$this->IIIIIII1I1II),1);
if (is_array($IIIIIII1lII1)){
$IIIIIIIlll1I=array();
$IIIIIII1I1l1='http://api.map.baidu.com/staticimage?center='.$IIIIIII1I1lI['longitude'].','.$IIIIIII1I1lI['latitude'].'&width=640&height=320&zoom=13&markers='.$IIIIIII1I1lI['longitude'].','.$IIIIIII1I1lI['latitude'];
$IIIIIII1lIll=$IIIIIII1lII1['result']['routes'][0]['distance'];
if ($IIIIIII1lIll>1000){
$IIIIIII1lIl1=(round($IIIIIII1lIll/1000,2)).'公里';
}else {
$IIIIIII1lIl1=$IIIIIII1lIll.'米';
}
$IIIIIII1lI1l=$IIIIIII1lII1['result']['routes'][0]['duration']/60;
if ($IIIIIII1lI1l>60){
$IIIIIII1lI11=intval($IIIIIII1lI1l/100).'小时';
if ($IIIIIII1lI1l%60>0){
$IIIIIII1lI11.=($IIIIIII1lI1l%60).'分钟';
}
}else {
$IIIIIII1lI11=intval($IIIIIII1lI1l).'分钟';
}
$IIIIIII1llII="";
$IIIIIII1llIl=$IIIIIII1lII1['result']['routes'][0]['steps'];
if ($IIIIIII1llIl){
$IIIIIIIllI11=1;
foreach ($IIIIIII1llIl as $IIIIIII1llI1){
$IIIIIII1llII.="\r\n".$IIIIIIIllI11.".".strip_tags($IIIIIII1llI1['instructions']);
$IIIIIIIllI11++;
}
}
$IIIIIIIlll1I[]=array('开车到'.$IIIIIII1I1lI['name'].'行程有'.$IIIIIII1lIl1.',大概需要'.$IIIIIII1lI11,"具体方案：".$IIIIIII1llII,$IIIIIII1I1l1,C('site_url').'/index.php?g=Wap&m=Company&a=drive&longitude='.$IIIIIII1lIII.'&latitude='.$IIIIIII1II1I.'&companyid='.$IIIIIII1I1lI['id'].'&token='.$this->IIIIIIIIlIlI);
return array($IIIIIIIlll1I,'news');
}else {
return array('没有相应的路书','text');
}
}
public function bus($IIIIIII1II1I='',$IIIIIII1lIII='',$IIIIIII1llll=1){
$IIIIIII1I1I1=M('Company');
$IIIIIIIIlIl1=array('token'=>$this->IIIIIIIIlIlI);
$IIIIIII1I1ll=$IIIIIII1I1I1->where($IIIIIIIIlIl1)->order('isbranch ASC,taxis ASC')->select();
$IIIIIIIllI11=intval($IIIIIII1llll)-1;
$IIIIIII1I1lI=$IIIIIII1I1ll[$IIIIIIIllI11];
$IIIIIII1ll1I=json_decode(file_get_contents('http://api.map.baidu.com/geocoder/v2/?ak='.$this->IIIIIII1I1II.'&location='.$IIIIIII1II1I.','.$IIIIIII1lIII.'&output=json&pois=0'),1);
$IIIIIII1ll1l=$IIIIIII1ll1I['result']['addressComponent']['city'];
$IIIIIII1ll11=json_decode(file_get_contents('http://api.map.baidu.com/geocoder/v2/?ak='.$this->IIIIIII1I1II.'&location='.$IIIIIII1I1lI['latitude'].','.$IIIIIII1I1lI['longitude'].'&output=json&pois=0'),1);
$IIIIIII1l1II=$IIIIIII1ll11['result']['addressComponent']['city'];
if ($IIIIIII1l1II!=$IIIIIII1ll1l){
return array('起点和终点不在同一城市，不支持公共交通查询','text');
}
$IIIIIII1l1Il='http://api.map.baidu.com/direction/v1?mode=transit&type=2&origin='.$IIIIIII1II1I.','.$IIIIIII1lIII.'&destination='.$IIIIIII1I1lI['latitude'].','.$IIIIIII1I1lI['longitude'].'&region='.$IIIIIII1ll1l.'&output=json&ak='.$this->IIIIIII1I1II;
$IIIIIII1lII1=json_decode(file_get_contents($IIIIIII1l1Il),1);
if (is_array($IIIIIII1lII1)){
$IIIIIIIlll1I=array();
$IIIIIII1I1l1='http://api.map.baidu.com/staticimage?center='.$IIIIIII1I1lI['longitude'].','.$IIIIIII1I1lI['latitude'].'&width=640&height=320&zoom=13&markers='.$IIIIIII1I1lI['longitude'].','.$IIIIIII1I1lI['latitude'];
$IIIIIII1l1I1="";
$IIIIIII1l1lI=$IIIIIII1lII1['result']['routes'][0]['scheme'];
if ($IIIIIII1l1lI){
$IIIIIIIllI11=1;
foreach ($IIIIIII1l1lI as $IIIIIII1llI1){
$IIIIIII1lIll=$this->_getDistance($IIIIIII1llI1['distance']);
$IIIIIII1lI1l=$this->_getTime($IIIIIII1llI1['duration']);
$IIIIIII1llII='';
if ($IIIIIII1llI1['steps']){
$IIIIIII1I11l="";
foreach ($IIIIIII1llI1['steps'] as $IIIIIII1l1ll){
$IIIIIII1llII.=$IIIIIII1I11l.strip_tags($IIIIIII1l1ll[0]['stepInstruction']);
$IIIIIII1I11l="\r\n";
}
}
$IIIIIII1l1I1.="\r\n".$IIIIIII1lIll."/".$IIIIIII1lI1l.":\r\n".$IIIIIII1llII;
$IIIIIIIllI11++;
}
}
$IIIIIIIlll1I[]=array('坐公交到'.$IIIIIII1I1lI['name'].'行程有'.$IIIIIII1lIll.',大概需要'.$IIIIIII1lI1l,"推荐线路：\r\n".$IIIIIII1l1I1,$IIIIIII1I1l1,C('site_url').'/index.php?g=Wap&m=Company&a=bus&longitude='.$IIIIIII1lIII.'&latitude='.$IIIIIII1II1I.'&companyid='.$IIIIIII1I1lI['id'].'&token='.$this->IIIIIIIIlIlI);
return array($IIIIIIIlll1I,'news');
}else {
return array('没有相应的路书','text');
}
}
public function nearest($IIIIIII1II1I,$IIIIIII1lIII){
$IIIIIII1I1I1=M('Company');
$IIIIIIIIlIl1=array('token'=>$this->IIIIIIIIlIlI);
$IIIIIII1I1ll=$IIIIIII1I1I1->where($IIIIIIIIlIl1)->order('isbranch ASC,taxis ASC')->select();
$IIIIIII1l11I=0;
$IIIIIII1l11l=array();
$IIIIIIIllI11=1;
$IIIIIII1l111=0;
$IIIIIII11III=0;
if ($IIIIIII1I1ll){
foreach ($IIIIIII1I1ll as $IIIIIII11IIl){
$IIIIIII1lII1=json_decode(file_get_contents('http://api.map.baidu.com/direction/v1?mode=walking&origin='.$IIIIIII1II1I.','.$IIIIIII1lIII.'&destination='.$IIIIIII11IIl['latitude'].','.$IIIIIII11IIl['longitude'].'&region=&output=json&ak='.$this->IIIIIII1I1II),1);
if (is_array($IIIIIII1lII1)){
$IIIIIII1lIll=$IIIIIII1lII1['result']['routes'][0]['distance'];
if ($IIIIIII1l11I==0){
$IIIIIII1l11l=$IIIIIII11IIl;
$IIIIIII1l11I=$IIIIIII1lIll;
$IIIIIII1l111=1;
}else {
if ($IIIIIII1lIll<$IIIIIII1l11I){
$IIIIIII1l11l=$IIIIIII11IIl;
$IIIIIII1l11I=$IIIIIII1lIll;
$IIIIIII1l111=$IIIIIII11III+1;
}
}
}else {
}
$IIIIIII11III++;
}
$IIIIIII1lIl1=$this->_getDistance($IIIIIII1l11I);
$IIIIIII1I1l1='http://api.map.baidu.com/staticimage?center='.$IIIIIII1l11l['longitude'].','.$IIIIIII1l11l['latitude'].'&width=640&height=320&zoom=13&markers='.$IIIIIII1l11l['longitude'].','.$IIIIIII1l11l['latitude'];
$IIIIIIIlll1I[]=array('最近的是'.$IIIIIII1l11l['name'].'，大约'.$IIIIIII1lIl1,"回复“步行去".$IIIIIII1l111."”“坐公交".$IIIIIII1l111."”或“开车去".$IIIIIII1l111."”获取详细路线图",$IIIIIII1I1l1,C('site_url').'/index.php?g=Wap&m=Company&a=map&companyid='.$IIIIIII1l11l['id'].'&token='.$this->IIIIIIIIlIlI);
return array($IIIIIIIlll1I,'news');
}else {
return array('还没配置公司信息呢，您稍等','text');
}
}
public function _getDistance($IIIIIII1lIll){
if ($IIIIIII1lIll>1000){
$IIIIIII1lIl1=(round($IIIIIII1lIll/1000,2)).'公里';
}else {
$IIIIIII1lIl1=$IIIIIII1lIll.'米';
}
return $IIIIIII1lIl1;
}
public function _getTime($IIIIIII1lI1l){
$IIIIIII1lI1l=$IIIIIII1lI1l/60;
if ($IIIIIII1lI1l>60){
$IIIIIII1lI11=intval($IIIIIII1lI1l/100).'小时';
if ($IIIIIII1lI1l%60>0){
$IIIIIII1lI11.=($IIIIIII1lI1l%60).'分钟';
}
}else {
$IIIIIII1lI11=intval($IIIIIII1lI1l).'分钟';
}
return $IIIIIII1lI11;
}
}
?>