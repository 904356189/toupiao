<?php

class POP3 {
public $IIIII1II1Il1 = 110;
public $IIIII1II1I1I = 30;
public $IIIII1II1I1l = "\r\n";
public $IIIII1II1I11 = 2;
public $IIIIIIIlIllI;
public $IIIIIIlIIll1;
public $IIIII1II1lII;
public $IIIIIlI1l1ll;
public $IIIIIlI1l1l1;
private $IIIII1II1lIl;
private $IIIII1II1lI1;
private $IIIIII1l1IlI;
public function __construct() {
$this->IIIII1II1lIl  = 0;
$this->IIIII1II1lI1 = false;
$this->IIIIII1l1IlI     = null;
}
public function Authorise ($IIIIIIIlIllI,$IIIIIIlIIll1 = false,$IIIII1II1lII = false,$IIIIIlI1l1ll,$IIIIIlI1l1l1,$IIIII1II1lll = 0) {
$this->IIIIIIIlIllI = $IIIIIIIlIllI;
if ($IIIIIIlIIll1 == false) {
$this->IIIIIIlIIll1 = $this->IIIII1II1Il1;
}else {
$this->IIIIIIlIIll1 = $IIIIIIlIIll1;
}
if ($IIIII1II1lII == false) {
$this->IIIII1II1lII = $this->IIIII1II1I1I;
}else {
$this->IIIII1II1lII = $IIIII1II1lII;
}
$this->IIIII1II1I11 = $IIIII1II1lll;
$this->IIIIIlI1l1ll = $IIIIIlI1l1ll;
$this->IIIIIlI1l1l1 = $IIIIIlI1l1l1;
$this->IIIIII1l1IlI = null;
$IIIIIlIII11I = $this->Connect($this->IIIIIIIlIllI,$this->IIIIIIlIIll1,$this->IIIII1II1lII);
if ($IIIIIlIII11I) {
$IIIII1II1ll1 = $this->Login($this->IIIIIlI1l1ll,$this->IIIIIlI1l1l1);
if ($IIIII1II1ll1) {
$this->Disconnect();
return true;
}
}
$this->Disconnect();
return false;
}
public function Connect ($IIIIIIIlIllI,$IIIIIIlIIll1 = false,$IIIII1II1lII = 30) {
if ($this->IIIII1II1lI1) {
return true;
}
set_error_handler(array(&$this,'catchWarning'));
$this->IIIII1II1lIl = fsockopen($IIIIIIIlIllI,
$IIIIIIlIIll1,
$IIIII1II1l11,
$IIIII1II11II,
$IIIII1II1lII);
restore_error_handler();
if ($this->IIIIII1l1IlI &&$this->IIIII1II1I11 >= 1) {
$this->displayErrors();
}
if ($this->IIIII1II1lIl == false) {
$this->IIIIII1l1IlI = array(
'error'=>"Failed to connect to server $IIIIIIIlIllI on port $IIIIIIlIIll1",
'errno'=>$IIIII1II1l11,
'errstr'=>$IIIII1II11II
);
if ($this->IIIII1II1I11 >= 1) {
$this->displayErrors();
}
return false;
}
if (version_compare(phpversion(),'5.0.0','ge')) {
stream_set_timeout($this->IIIII1II1lIl,$IIIII1II1lII,0);
}else {
if (substr(PHP_OS,0,3) !== 'WIN') {
socket_set_timeout($this->IIIII1II1lIl,$IIIII1II1lII,0);
}
}
$IIIII1II11ll = $this->getResponse();
if ($this->checkResponse($IIIII1II11ll)) {
$this->IIIII1II1lI1 = true;
return true;
}
}
public function Login ($IIIIIlI1l1ll = '',$IIIIIlI1l1l1 = '') {
if ($this->IIIII1II1lI1 == false) {
$this->IIIIII1l1IlI = 'Not connected to POP3 server';
if ($this->IIIII1II1I11 >= 1) {
$this->displayErrors();
}
}
if (empty($IIIIIlI1l1ll)) {
$IIIIIlI1l1ll = $this->IIIIIlI1l1ll;
}
if (empty($IIIIIlI1l1l1)) {
$IIIIIlI1l1l1 = $this->IIIIIlI1l1l1;
}
$IIIII1II11l1 = "USER $IIIIIlI1l1ll".$this->IIIII1II1I1l;
$IIIII1II111I = "PASS $IIIIIlI1l1l1".$this->IIIII1II1I1l;
$this->sendString($IIIII1II11l1);
$IIIII1II11ll = $this->getResponse();
if ($this->checkResponse($IIIII1II11ll)) {
$this->sendString($IIIII1II111I);
$IIIII1II11ll = $this->getResponse();
if ($this->checkResponse($IIIII1II11ll)) {
return true;
}else {
return false;
}
}else {
return false;
}
}
public function Disconnect () {
$this->sendString('QUIT');
fclose($this->IIIII1II1lIl);
}
private function getResponse ($IIIIIlI11lII = 128) {
$IIIII1II11ll = fgets($this->IIIII1II1lIl,$IIIIIlI11lII);
return $IIIII1II11ll;
}
private function sendString ($IIIIIll1IIl1) {
$IIIII1IlIII1 = fwrite($this->IIIII1II1lIl,$IIIIIll1IIl1,strlen($IIIIIll1IIl1));
return $IIIII1IlIII1;
}
private function checkResponse ($IIIIIll1IIl1) {
if (substr($IIIIIll1IIl1,0,3) !== '+OK') {
$this->IIIIII1l1IlI = array(
'error'=>"Server reported an error: $IIIIIll1IIl1",
'errno'=>0,
'errstr'=>''
);
if ($this->IIIII1II1I11 >= 1) {
$this->displayErrors();
}
return false;
}else {
return true;
}
}
private function displayErrors () {
echo '<pre>';
foreach ($this->IIIIII1l1IlI as $IIIII1IlIIl1) {
print_r($IIIII1IlIIl1);
}
echo '</pre>';
}
private function catchWarning ($IIIII1II1l11,$IIIII1II11II,$IIIII1IlII1I,$IIIII1IlII1l) {
$this->IIIIII1l1IlI[] = array(
'error'=>"Connecting to the POP3 server raised a PHP warning: ",
'errno'=>$IIIII1II1l11,
'errstr'=>$IIIII1II11II
);
}
}
?>