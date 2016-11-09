<?php

class MapTestAction extends BaseAction{
public $IIIIIIIIlIlI;
public $IIIIIII1I1II;
public function setLatLng(){
if(IS_POST){
}else{
$this->display();
}
}
public function index(){
$IIIIII1l1l1l=2000;
$IIIIII1IIlIl=new baiduMap('酒店',31.844931631914,117.21469057536);
$IIIIIII1IlII=$IIIIII1IIlIl->echoJson();
$IIIIII1l1l11=json_decode($IIIIIII1IlII);
echo $IIIIIII1IlII;
}
}
?>