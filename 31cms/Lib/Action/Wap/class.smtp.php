<?php

class SMTP {
public $IIIII1IlIlII = 25;
public $IIIII1II1I1l = "\r\n";
public $IIIII1II1I11;
public $IIIII1IlIlIl = false;
private $IIIII1IlIlI1;
private $IIIIII1l1IlI;
private $IIIII1IlIllI;
public function __construct() {
$this->IIIII1IlIlI1 = 0;
$this->IIIIII1l1IlI = null;
$this->IIIII1IlIllI = null;
$this->IIIII1II1I11 = 0;
}
public function Connect($IIIIIIIlIllI,$IIIIIIlIIll1 = 0,$IIIII1II1lII = 30) {
$this->IIIIII1l1IlI = null;
if($this->connected()) {
$this->IIIIII1l1IlI = array("error"=>"Already connected to a server");
return false;
}
if(empty($IIIIIIlIIll1)) {
$IIIIIIlIIll1 = $this->IIIII1IlIlII;
}
$this->IIIII1IlIlI1 = @fsockopen($IIIIIIIlIllI,
$IIIIIIlIIll1,
$IIIII1II1l11,
$IIIII1II11II,
$IIIII1II1lII);
if(empty($this->IIIII1IlIlI1)) {
$this->IIIIII1l1IlI = array("error"=>"Failed to connect to server",
"errno"=>$IIIII1II1l11,
"errstr"=>$IIIII1II11II);
if($this->IIIII1II1I11 >= 1) {
echo "SMTP -> ERROR: ".$this->IIIIII1l1IlI["error"] .": $IIIII1II11II ($IIIII1II1l11)".$this->IIIII1II1I1l .'<br />';
}
return false;
}
if(substr(PHP_OS,0,3) != "WIN")
socket_set_timeout($this->IIIII1IlIlI1,$IIIII1II1lII,0);
$IIIII1IlIlll = $this->get_lines();
if($this->IIIII1II1I11 >= 2) {
echo "SMTP -> FROM SERVER:".$IIIII1IlIlll .$this->IIIII1II1I1l .'<br />';
}
return true;
}
public function StartTLS() {
$this->IIIIII1l1IlI = null;# to avoid confusion
if(!$this->connected()) {
$this->IIIIII1l1IlI = array("error"=>"Called StartTLS() without being connected");
return false;
}
fputs($this->IIIII1IlIlI1,"STARTTLS".$this->IIIII1II1I1l);
$IIIII1IlIl1I = $this->get_lines();
$IIIIIIIl1lII = substr($IIIII1IlIl1I,0,3);
if($this->IIIII1II1I11 >= 2) {
echo "SMTP -> FROM SERVER:".$IIIII1IlIl1I .$this->IIIII1II1I1l .'<br />';
}
if($IIIIIIIl1lII != 220) {
$this->IIIIII1l1IlI =
array("error"=>"STARTTLS not accepted from server",
"smtp_code"=>$IIIIIIIl1lII,
"smtp_msg"=>substr($IIIII1IlIl1I,4));
if($this->IIIII1II1I11 >= 1) {
echo "SMTP -> ERROR: ".$this->IIIIII1l1IlI["error"] .": ".$IIIII1IlIl1I .$this->IIIII1II1I1l .'<br />';
}
return false;
}
if(!stream_socket_enable_crypto($this->IIIII1IlIlI1,true,STREAM_CRYPTO_METHOD_TLS_CLIENT)) {
return false;
}
return true;
}
public function Authenticate($IIIIIlI1l1ll,$IIIIIlI1l1l1) {
fputs($this->IIIII1IlIlI1,"AUTH LOGIN".$this->IIIII1II1I1l);
$IIIII1IlIl1I = $this->get_lines();
$IIIIIIIl1lII = substr($IIIII1IlIl1I,0,3);
if($IIIIIIIl1lII != 334) {
$this->IIIIII1l1IlI =
array("error"=>"AUTH not accepted from server",
"smtp_code"=>$IIIIIIIl1lII,
"smtp_msg"=>substr($IIIII1IlIl1I,4));
if($this->IIIII1II1I11 >= 1) {
echo "SMTP -> ERROR: ".$this->IIIIII1l1IlI["error"] .": ".$IIIII1IlIl1I .$this->IIIII1II1I1l .'<br />';
}
return false;
}
fputs($this->IIIII1IlIlI1,base64_encode($IIIIIlI1l1ll) .$this->IIIII1II1I1l);
$IIIII1IlIl1I = $this->get_lines();
$IIIIIIIl1lII = substr($IIIII1IlIl1I,0,3);
if($IIIIIIIl1lII != 334) {
$this->IIIIII1l1IlI =
array("error"=>"Username not accepted from server",
"smtp_code"=>$IIIIIIIl1lII,
"smtp_msg"=>substr($IIIII1IlIl1I,4));
if($this->IIIII1II1I11 >= 1) {
echo "SMTP -> ERROR: ".$this->IIIIII1l1IlI["error"] .": ".$IIIII1IlIl1I .$this->IIIII1II1I1l .'<br />';
}
return false;
}
fputs($this->IIIII1IlIlI1,base64_encode($IIIIIlI1l1l1) .$this->IIIII1II1I1l);
$IIIII1IlIl1I = $this->get_lines();
$IIIIIIIl1lII = substr($IIIII1IlIl1I,0,3);
if($IIIIIIIl1lII != 235) {
$this->IIIIII1l1IlI =
array("error"=>"Password not accepted from server",
"smtp_code"=>$IIIIIIIl1lII,
"smtp_msg"=>substr($IIIII1IlIl1I,4));
if($this->IIIII1II1I11 >= 1) {
echo "SMTP -> ERROR: ".$this->IIIIII1l1IlI["error"] .": ".$IIIII1IlIl1I .$this->IIIII1II1I1l .'<br />';
}
return false;
}
return true;
}
public function Connected() {
if(!empty($this->IIIII1IlIlI1)) {
$IIIII1IlI1II = socket_get_status($this->IIIII1IlIlI1);
if($IIIII1IlI1II["eof"]) {
if($this->IIIII1II1I11 >= 1) {
echo "SMTP -> NOTICE:".$this->IIIII1II1I1l ."EOF caught while checking if connected";
}
$this->Close();
return false;
}
return true;
}
return false;
}
public function Close() {
$this->IIIIII1l1IlI = null;
$this->IIIII1IlIllI = null;
if(!empty($this->IIIII1IlIlI1)) {
fclose($this->IIIII1IlIlI1);
$this->IIIII1IlIlI1 = 0;
}
}
public function Data($IIIII1IlI1ll) {
$this->IIIIII1l1IlI = null;
if(!$this->connected()) {
$this->IIIIII1l1IlI = array(
"error"=>"Called Data() without being connected");
return false;
}
fputs($this->IIIII1IlIlI1,"DATA".$this->IIIII1II1I1l);
$IIIII1IlIl1I = $this->get_lines();
$IIIIIIIl1lII = substr($IIIII1IlIl1I,0,3);
if($this->IIIII1II1I11 >= 2) {
echo "SMTP -> FROM SERVER:".$IIIII1IlIl1I .$this->IIIII1II1I1l .'<br />';
}
if($IIIIIIIl1lII != 354) {
$this->IIIIII1l1IlI =
array("error"=>"DATA command not accepted from server",
"smtp_code"=>$IIIIIIIl1lII,
"smtp_msg"=>substr($IIIII1IlIl1I,4));
if($this->IIIII1II1I11 >= 1) {
echo "SMTP -> ERROR: ".$this->IIIIII1l1IlI["error"] .": ".$IIIII1IlIl1I .$this->IIIII1II1I1l .'<br />';
}
return false;
}
$IIIII1IlI1ll = str_replace("\r\n","\n",$IIIII1IlI1ll);
$IIIII1IlI1ll = str_replace("\r","\n",$IIIII1IlI1ll);
$IIIII1II1IlI = explode("\n",$IIIII1IlI1ll);
$IIIIII1l1lI1 = substr($IIIII1II1IlI[0],0,strpos($IIIII1II1IlI[0],":"));
$IIIII1IlI11I = false;
if(!empty($IIIIII1l1lI1) &&!strstr($IIIIII1l1lI1," ")) {
$IIIII1IlI11I = true;
}
$IIIII1IlI111 = 998;
while(list(,$IIIIIl11I1ll) = @each($IIIII1II1IlI)) {
$IIIII1IllIII = null;
if($IIIIIl11I1ll == ""&&$IIIII1IlI11I) {
$IIIII1IlI11I = false;
}
while(strlen($IIIIIl11I1ll) >$IIIII1IlI111) {
$IIIII1IllIIl = strrpos(substr($IIIIIl11I1ll,0,$IIIII1IlI111)," ");
if(!$IIIII1IllIIl) {
$IIIII1IllIIl = $IIIII1IlI111 -1;
$IIIII1IllIII[] = substr($IIIIIl11I1ll,0,$IIIII1IllIIl);
$IIIIIl11I1ll = substr($IIIIIl11I1ll,$IIIII1IllIIl);
}else {
$IIIII1IllIII[] = substr($IIIIIl11I1ll,0,$IIIII1IllIIl);
$IIIIIl11I1ll = substr($IIIIIl11I1ll,$IIIII1IllIIl +1);
}
if($IIIII1IlI11I) {
$IIIIIl11I1ll = "\t".$IIIIIl11I1ll;
}
}
$IIIII1IllIII[] = $IIIIIl11I1ll;
while(list(,$IIIII1IllIlI) = @each($IIIII1IllIII)) {
if(strlen($IIIII1IllIlI) >0)
{
if(substr($IIIII1IllIlI,0,1) == ".") {
$IIIII1IllIlI = ".".$IIIII1IllIlI;
}
}
fputs($this->IIIII1IlIlI1,$IIIII1IllIlI .$this->IIIII1II1I1l);
}
}
fputs($this->IIIII1IlIlI1,$this->IIIII1II1I1l .".".$this->IIIII1II1I1l);
$IIIII1IlIl1I = $this->get_lines();
$IIIIIIIl1lII = substr($IIIII1IlIl1I,0,3);
if($this->IIIII1II1I11 >= 2) {
echo "SMTP -> FROM SERVER:".$IIIII1IlIl1I .$this->IIIII1II1I1l .'<br />';
}
if($IIIIIIIl1lII != 250) {
$this->IIIIII1l1IlI =
array("error"=>"DATA not accepted from server",
"smtp_code"=>$IIIIIIIl1lII,
"smtp_msg"=>substr($IIIII1IlIl1I,4));
if($this->IIIII1II1I11 >= 1) {
echo "SMTP -> ERROR: ".$this->IIIIII1l1IlI["error"] .": ".$IIIII1IlIl1I .$this->IIIII1II1I1l .'<br />';
}
return false;
}
return true;
}
public function Hello($IIIIIIIlIllI = '') {
$this->IIIIII1l1IlI = null;
if(!$this->connected()) {
$this->IIIIII1l1IlI = array(
"error"=>"Called Hello() without being connected");
return false;
}
if(empty($IIIIIIIlIllI)) {
$IIIIIIIlIllI = "localhost";
}
if(!$this->SendHello("EHLO",$IIIIIIIlIllI)) {
if(!$this->SendHello("HELO",$IIIIIIIlIllI)) {
return false;
}
}
return true;
}
private function SendHello($IIIIIl11Il1I,$IIIIIIIlIllI) {
fputs($this->IIIII1IlIlI1,$IIIIIl11Il1I ." ".$IIIIIIIlIllI .$this->IIIII1II1I1l);
$IIIII1IlIl1I = $this->get_lines();
$IIIIIIIl1lII = substr($IIIII1IlIl1I,0,3);
if($this->IIIII1II1I11 >= 2) {
echo "SMTP -> FROM SERVER: ".$IIIII1IlIl1I .$this->IIIII1II1I1l .'<br />';
}
if($IIIIIIIl1lII != 250) {
$this->IIIIII1l1IlI =
array("error"=>$IIIIIl11Il1I ." not accepted from server",
"smtp_code"=>$IIIIIIIl1lII,
"smtp_msg"=>substr($IIIII1IlIl1I,4));
if($this->IIIII1II1I11 >= 1) {
echo "SMTP -> ERROR: ".$this->IIIIII1l1IlI["error"] .": ".$IIIII1IlIl1I .$this->IIIII1II1I1l .'<br />';
}
return false;
}
$this->IIIII1IlIllI = $IIIII1IlIl1I;
return true;
}
public function Mail($IIIIIl1Il1l1) {
$this->IIIIII1l1IlI = null;
if(!$this->connected()) {
$this->IIIIII1l1IlI = array(
"error"=>"Called Mail() without being connected");
return false;
}
$IIIII1IllI1l = ($this->IIIII1IlIlIl ?"XVERP": "");
fputs($this->IIIII1IlIlI1,"MAIL FROM:<".$IIIIIl1Il1l1 .">".$IIIII1IllI1l .$this->IIIII1II1I1l);
$IIIII1IlIl1I = $this->get_lines();
$IIIIIIIl1lII = substr($IIIII1IlIl1I,0,3);
if($this->IIIII1II1I11 >= 2) {
echo "SMTP -> FROM SERVER:".$IIIII1IlIl1I .$this->IIIII1II1I1l .'<br />';
}
if($IIIIIIIl1lII != 250) {
$this->IIIIII1l1IlI =
array("error"=>"MAIL not accepted from server",
"smtp_code"=>$IIIIIIIl1lII,
"smtp_msg"=>substr($IIIII1IlIl1I,4));
if($this->IIIII1II1I11 >= 1) {
echo "SMTP -> ERROR: ".$this->IIIIII1l1IlI["error"] .": ".$IIIII1IlIl1I .$this->IIIII1II1I1l .'<br />';
}
return false;
}
return true;
}
public function Quit($IIIII1IllI11 = true) {
$this->IIIIII1l1IlI = null;
if(!$this->connected()) {
$this->IIIIII1l1IlI = array(
"error"=>"Called Quit() without being connected");
return false;
}
fputs($this->IIIII1IlIlI1,"quit".$this->IIIII1II1I1l);
$IIIII1IlllIl = $this->get_lines();
if($this->IIIII1II1I11 >= 2) {
echo "SMTP -> FROM SERVER:".$IIIII1IlllIl .$this->IIIII1II1I1l .'<br />';
}
$IIIII1IlllI1 = true;
$IIIIIlI1lII1 = null;
$IIIIIIIl1lII = substr($IIIII1IlllIl,0,3);
if($IIIIIIIl1lII != 221) {
$IIIIIlI1lII1 = array("error"=>"SMTP server rejected quit command",
"smtp_code"=>$IIIIIIIl1lII,
"smtp_rply"=>substr($IIIII1IlllIl,4));
$IIIII1IlllI1 = false;
if($this->IIIII1II1I11 >= 1) {
echo "SMTP -> ERROR: ".$IIIIIlI1lII1["error"] .": ".$IIIII1IlllIl .$this->IIIII1II1I1l .'<br />';
}
}
if(empty($IIIIIlI1lII1) ||$IIIII1IllI11) {
$this->Close();
}
return $IIIII1IlllI1;
}
public function Recipient($IIIIIIlII1I1) {
$this->IIIIII1l1IlI = null;
if(!$this->connected()) {
$this->IIIIII1l1IlI = array(
"error"=>"Called Recipient() without being connected");
return false;
}
fputs($this->IIIII1IlIlI1,"RCPT TO:<".$IIIIIIlII1I1 .">".$this->IIIII1II1I1l);
$IIIII1IlIl1I = $this->get_lines();
$IIIIIIIl1lII = substr($IIIII1IlIl1I,0,3);
if($this->IIIII1II1I11 >= 2) {
echo "SMTP -> FROM SERVER:".$IIIII1IlIl1I .$this->IIIII1II1I1l .'<br />';
}
if($IIIIIIIl1lII != 250 &&$IIIIIIIl1lII != 251) {
$this->IIIIII1l1IlI =
array("error"=>"RCPT not accepted from server",
"smtp_code"=>$IIIIIIIl1lII,
"smtp_msg"=>substr($IIIII1IlIl1I,4));
if($this->IIIII1II1I11 >= 1) {
echo "SMTP -> ERROR: ".$this->IIIIII1l1IlI["error"] .": ".$IIIII1IlIl1I .$this->IIIII1II1I1l .'<br />';
}
return false;
}
return true;
}
public function Reset() {
$this->IIIIII1l1IlI = null;
if(!$this->connected()) {
$this->IIIIII1l1IlI = array(
"error"=>"Called Reset() without being connected");
return false;
}
fputs($this->IIIII1IlIlI1,"RSET".$this->IIIII1II1I1l);
$IIIII1IlIl1I = $this->get_lines();
$IIIIIIIl1lII = substr($IIIII1IlIl1I,0,3);
if($this->IIIII1II1I11 >= 2) {
echo "SMTP -> FROM SERVER:".$IIIII1IlIl1I .$this->IIIII1II1I1l .'<br />';
}
if($IIIIIIIl1lII != 250) {
$this->IIIIII1l1IlI =
array("error"=>"RSET failed",
"smtp_code"=>$IIIIIIIl1lII,
"smtp_msg"=>substr($IIIII1IlIl1I,4));
if($this->IIIII1II1I11 >= 1) {
echo "SMTP -> ERROR: ".$this->IIIIII1l1IlI["error"] .": ".$IIIII1IlIl1I .$this->IIIII1II1I1l .'<br />';
}
return false;
}
return true;
}
public function SendAndMail($IIIIIl1Il1l1) {
$this->IIIIII1l1IlI = null;
if(!$this->connected()) {
$this->IIIIII1l1IlI = array(
"error"=>"Called SendAndMail() without being connected");
return false;
}
fputs($this->IIIII1IlIlI1,"SAML FROM:".$IIIIIl1Il1l1 .$this->IIIII1II1I1l);
$IIIII1IlIl1I = $this->get_lines();
$IIIIIIIl1lII = substr($IIIII1IlIl1I,0,3);
if($this->IIIII1II1I11 >= 2) {
echo "SMTP -> FROM SERVER:".$IIIII1IlIl1I .$this->IIIII1II1I1l .'<br />';
}
if($IIIIIIIl1lII != 250) {
$this->IIIIII1l1IlI =
array("error"=>"SAML not accepted from server",
"smtp_code"=>$IIIIIIIl1lII,
"smtp_msg"=>substr($IIIII1IlIl1I,4));
if($this->IIIII1II1I11 >= 1) {
echo "SMTP -> ERROR: ".$this->IIIIII1l1IlI["error"] .": ".$IIIII1IlIl1I .$this->IIIII1II1I1l .'<br />';
}
return false;
}
return true;
}
public function Turn() {
$this->IIIIII1l1IlI = array("error"=>"This method, TURN, of the SMTP ".
"is not implemented");
if($this->IIIII1II1I11 >= 1) {
echo "SMTP -> NOTICE: ".$this->IIIIII1l1IlI["error"] .$this->IIIII1II1I1l .'<br />';
}
return false;
}
public function getError() {
return $this->IIIIII1l1IlI;
}
private function get_lines() {
$IIIIIIIIIl11 = "";
while($IIIIIII1IlII = @fgets($this->IIIII1IlIlI1,515)) {
if($this->IIIII1II1I11 >= 4) {
echo "SMTP -> get_lines(): \$data was \"$IIIIIIIIIl11\"".$this->IIIII1II1I1l .'<br />';
echo "SMTP -> get_lines(): \$str is \"$IIIIIII1IlII\"".$this->IIIII1II1I1l .'<br />';
}
$IIIIIIIIIl11 .= $IIIIIII1IlII;
if($this->IIIII1II1I11 >= 4) {
echo "SMTP -> get_lines(): \$data is \"$IIIIIIIIIl11\"".$this->IIIII1II1I1l .'<br />';
}
if(substr($IIIIIII1IlII,3,1) == " ") {break;}
}
return $IIIIIIIIIl11;
}
}
?>