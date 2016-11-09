<?php

class MapAction extends UserAction{
public $IIIIIIIIlIlI;
public $IIIIIII1I1II;
public function _initialize() {
parent::_initialize();
$this->IIIIIIIIlIlI=session('token');
$this->assign('token',$this->IIIIIIIIlIlI);
$this->IIIIIII1I1II=C('baidu_map_api');
$this->assign('apikey',$this->IIIIIII1I1II);
}
public function setLatLng(){
if(IS_POST){
}else{
$this->display();
}
}
public function staticCompanyMap(){
$IIIIIII1I1I1=M('Company');
$IIIIIIIIlIl1=array('token'=>$this->IIIIIIIIlIlI);
$IIIIIII1I1ll=$IIIIIII1I1I1->where($IIIIIIIIlIl1)->order('isbranch ASC')->select();
if ($IIIIIII1I1ll){
$IIIIII1l1ll1='';
$IIIIII1l1l1I='';
$IIIIIIIllI11=1;
$IIIIIII1I11l='';
foreach ($IIIIIII1I1ll as $IIIIIII11IIl){
$IIIIII1l1ll1.=$IIIIIII1I11l.$IIIIIII11IIl['longitude'].','.$IIIIIII11IIl['latitude'];
$IIIIII1l1l1I.=$IIIIIII1I11l.'m,'.$IIIIIIIllI11;
$IIIIIII1I11l='|';
$IIIIIIIllI11++;
}
}
$IIIIIII1I1l1='http://api.map.baidu.com/staticimage?center='.$IIIIIII1I1ll[0]['longitude'].','.$IIIIIII1I1ll[0]['latitude'].'&width=400&height=300&zoom=11&markers='.$IIIIII1l1ll1.'&markerStyles='.$IIIIII1l1l1I;
return array(array(array($IIIIIII1I1ll[0]['name'].'地图','点击查看详细',$IIIIIII1I1l1,$IIIIIIIIIl11['url'])),'news');
}
}
?>