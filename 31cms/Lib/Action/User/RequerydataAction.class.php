<?php

class RequerydataAction extends UserAction{
public $IIIIIIIIlIlI;
public $IIIIIlIIlllI;
public function _initialize(){
parent::_initialize();
$this->IIIIIIIIlIlI=session('token');
$this->IIIIIlIIlllI=M('Requestdata');
}
public function index(){
if($this->_get('month')==false){
$IIIIIII111Il=date('m');
}else{
$IIIIIII111Il=$this->_get('month');
}
$IIIIIlIIllll=date('Y');
if($this->_get('year')==false){
$IIIIIlIIlll1=$IIIIIlIIllll;
}else{
$IIIIIlIIlll1=$this->_get('year');
}
$this->assign('month',$IIIIIII111Il);
$this->assign('year',$IIIIIlIIlll1);
$IIIIIlIIll1I=$IIIIIlIIllll-1;
if ($IIIIIlIIlll1==$IIIIIlIIll1I){
$IIIIIlIIll1l='<option value="'.$IIIIIlIIll1I.'" selected>'.$IIIIIlIIll1I.'</option><option value="'.$IIIIIlIIllll.'">'.$IIIIIlIIllll.'</option>';
}else {
$IIIIIlIIll1l='<option value="'.$IIIIIlIIll1I.'">'.$IIIIIlIIll1I.'</option><option value="'.$IIIIIlIIllll.'" selected>'.$IIIIIlIIllll.'</option>';
}
$this->assign('yearOption',$IIIIIlIIll1l);
$IIIIIIIIlIl1=array('token'=>$this->IIIIIIIIlIlI,'month'=>$IIIIIII111Il,'year'=>$IIIIIlIIlll1);
$IIIIIIIIlIII=$this->IIIIIlIIlllI->where($IIIIIIIIlIl1)->limit(31)->order('id desc')->select();
$this->assign('list',$IIIIIIIIlIII);
$IIIIIlIIll11='<chart caption="'.$IIIIIII111Il.'月统计图" xAxisName="日期" yAxisName="" labelStep="" showNames="" showValues="" rotateNames="" showColumnShadow="1" animation="1" showAlternateHGridColor="0" AlternateHGridColor="ff5904" divLineColor="D0DCE4" divLineAlpha="100" alternateHGridAlpha="5"   formatNumberScale="0"  baseFontColor="666666" baseFont="宋体" baseFontSize="12" outCnvBaseFontSize="12"  canvasBorderThickness="1" canvasBorderColor="D0DCE4"  bgColor="FFFFFF" bgAlpha="0"  showBorder="0"  lineColor="0F6FCF" lineThickness="3"  anchorBorderColor="FFFFFF" anchorBorderThickness="2" anchorBgColor="0F6FCF"   numDivLines="2" numVDivLines="3"><categories>';
$IIIIIlIIl1II='';
$IIIIIlIIl1Il='';
$IIIIIlIIl1I1=array_reverse($IIIIIIIIlIII);
foreach ($IIIIIlIIl1I1 as $IIIIII1IIll1){
$IIIIIlIIl1lI=$IIIIII1IIll1['day'];
$IIIIIlIIll11.='<category label="'.$IIIIIlIIl1lI.'"/>';
$IIIIIlIIl1II.='<set value="'.$IIIIII1IIll1['follownum'].'"/>';
$IIIIIlIIl1Il.='<set value="'.$IIIIII1IIll1['textnum'].'"/>';
}
$IIIIIlIIll11.='</categories><dataset seriesName="关注数" color="1D8BD1" anchorBorderColor="1D8BD1" anchorBgColor="1D8BD1">'.$IIIIIlIIl1II.'</dataset><dataset seriesName="文本请求数" color="2AD62A" anchorBorderColor="2AD62A" anchorBgColor="2AD62A">'.$IIIIIlIIl1Il.'</dataset><styles><definition><style name="CaptionFont" type="font" size="12"/></definition><application><apply toObject="CAPTION" styles="CaptionFont"/><apply toObject="SUBCAPTION" styles="CaptionFont"/></application></styles></chart>';
$this->assign('xml',$IIIIIlIIll11);
$this->display();
}
}
?>