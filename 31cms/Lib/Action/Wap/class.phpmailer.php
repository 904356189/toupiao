<?php

if (version_compare(PHP_VERSION,'5.0.0','<') ) exit("Sorry, this version of PHPMailer will only run on PHP version 5 or greater!\n");
class PHPMailer {
public $IIIIIl1I111I          = 3;
public $IIIIIl1I111l           = 'iso-8859-1';
public $IIIIIl1I1111       = 'text/plain';
public $IIIIIl1lIIII          = '8bit';
public $IIIIIl1lIIIl         = '';
public $IIIIIl1lIII1              = 'root@localhost';
public $IIIIIl1lIIlI          = 'Root User';
public $IIIIIl1lIIll            = '';
public $IIIIIl1lIIl1           = '';
public $IIIIIl1lII1I              = '';
public $IIIIIl1lII1l           = '';
public $IIIIIl1lII11          = 0;
public $IIIIIl1lIlII            = 'mail';
public $IIIIIl1lIlIl          = '/usr/sbin/sendmail';
public $IIIIIl1lIlI1         = '';
public $IIIIIl1lIllI  = '';
public $IIIIIl1lIlll          = '';
public $IIIIIl1lIll1         = '';
public $IIIIIl1lIl1I          = 'localhost';
public $IIIIIl1lIl1l          = 25;
public $IIIIIl1lIl11          = '';
public $IIIIIl1lI1II    = '';
public $IIIIIl1lI1Il      = false;
public $IIIIIl1lI1I1      = '';
public $IIIIIl1lI1lI      = '';
public $IIIIIl1lI1l1       = 10;
public $IIIIIl1lI11I     = false;
public $IIIIIl1lI11l = false;
public $IIIIIl1lI111      = false;
public $IIIIIl1llIII = array();
public $IIIIIl1llIIl              = "\n";
public $IIIIIl1llII1   = 'phpmailer';
public $IIIIIl1llIlI   = '';
public $IIIIIl1llIll     = '';
public $IIIIIl1llIl1    = '';
public $IIIIIl1lllIl = '';
public $IIIIIl1lllI1         = '5.1';
private   $IIIIIIlII1Il           = NULL;
private   $IIIIIIlII1I1             = array();
private   $IIIIIl1llI11             = array();
private   $IIIIIl1lllII            = array();
private   $IIIIIl1llllI        = array();
private   $IIIIIl1lllll = array();
private   $IIIIIl1llll1     = array();
private   $IIIIIl1lll1I   = array();
private   $IIIIIl1lll1l   = '';
private   $IIIIIl1lll11       = array();
protected $IIIIIl1ll1II       = array();
private   $IIIIIl1ll1Il    = 0;
private   $IIIIIl1ll1I1 = "";
private   $IIIIIl1ll1lI  = "";
private   $IIIIIl1ll1ll  = "";
private   $IIIIIl1ll1l1     = false;
const STOP_MESSAGE  = 0;
const STOP_CONTINUE = 1;
const STOP_CRITICAL = 2;
public function __construct($IIIIIl1ll1l1 = false) {
$this->IIIIIl1ll1l1 = ($IIIIIl1ll1l1 == true);
}
public function IsHTML($IIIIIl1ll11I = true) {
if ($IIIIIl1ll11I) {
$this->IIIIIl1I1111 = 'text/html';
}else {
$this->IIIIIl1I1111 = 'text/plain';
}
}
public function IsSMTP() {
$this->IIIIIl1lIlII = 'smtp';
}
public function IsMail() {
$this->IIIIIl1lIlII = 'mail';
}
public function IsSendmail() {
if (!stristr(ini_get('sendmail_path'),'sendmail')) {
$this->IIIIIl1lIlIl = '/var/qmail/bin/sendmail';
}
$this->IIIIIl1lIlII = 'sendmail';
}
public function IsQmail() {
if (stristr(ini_get('sendmail_path'),'qmail')) {
$this->IIIIIl1lIlIl = '/var/qmail/bin/sendmail';
}
$this->IIIIIl1lIlII = 'sendmail';
}
public function AddAddress($IIIIIl1l1Ill,$IIIIIIIlIIII = '') {
return $this->AddAnAddress('to',$IIIIIl1l1Ill,$IIIIIIIlIIII);
}
public function AddCC($IIIIIl1l1Ill,$IIIIIIIlIIII = '') {
return $this->AddAnAddress('cc',$IIIIIl1l1Ill,$IIIIIIIlIIII);
}
public function AddBCC($IIIIIl1l1Ill,$IIIIIIIlIIII = '') {
return $this->AddAnAddress('bcc',$IIIIIl1l1Ill,$IIIIIIIlIIII);
}
public function AddReplyTo($IIIIIl1l1Ill,$IIIIIIIlIIII = '') {
return $this->AddAnAddress('ReplyTo',$IIIIIl1l1Ill,$IIIIIIIlIIII);
}
private function AddAnAddress($IIIIIl1l1lIl,$IIIIIl1l1Ill,$IIIIIIIlIIII = '') {
if (!preg_match('/^(to|cc|bcc|ReplyTo)$/',$IIIIIl1l1lIl)) {
echo 'Invalid recipient array: '.kind;
return false;
}
$IIIIIl1l1Ill = trim($IIIIIl1l1Ill);
$IIIIIIIlIIII = trim(preg_replace('/[\r\n]+/','',$IIIIIIIlIIII));
if (!self::ValidateAddress($IIIIIl1l1Ill)) {
$this->SetError($this->Lang('invalid_address').': '.$IIIIIl1l1Ill);
if ($this->IIIIIl1ll1l1) {
throw new phpmailerException($this->Lang('invalid_address').': '.$IIIIIl1l1Ill);
}
echo $this->Lang('invalid_address').': '.$IIIIIl1l1Ill;
return false;
}
if ($IIIIIl1l1lIl != 'ReplyTo') {
if (!isset($this->IIIIIl1lllll[strtolower($IIIIIl1l1Ill)])) {
array_push($this->$IIIIIl1l1lIl,array($IIIIIl1l1Ill,$IIIIIIIlIIII));
$this->IIIIIl1lllll[strtolower($IIIIIl1l1Ill)] = true;
return true;
}
}else {
if (!array_key_exists(strtolower($IIIIIl1l1Ill),$this->IIIIIl1llllI)) {
$this->IIIIIl1llllI[strtolower($IIIIIl1l1Ill)] = array($IIIIIl1l1Ill,$IIIIIIIlIIII);
return true;
}
}
return false;
}
public function SetFrom($IIIIIl1l1Ill,$IIIIIIIlIIII = '',$IIIIIl1l1lll=1) {
$IIIIIl1l1Ill = trim($IIIIIl1l1Ill);
$IIIIIIIlIIII = trim(preg_replace('/[\r\n]+/','',$IIIIIIIlIIII));
if (!self::ValidateAddress($IIIIIl1l1Ill)) {
$this->SetError($this->Lang('invalid_address').': '.$IIIIIl1l1Ill);
if ($this->IIIIIl1ll1l1) {
throw new phpmailerException($this->Lang('invalid_address').': '.$IIIIIl1l1Ill);
}
echo $this->Lang('invalid_address').': '.$IIIIIl1l1Ill;
return false;
}
$this->IIIIIl1lIII1 = $IIIIIl1l1Ill;
$this->IIIIIl1lIIlI = $IIIIIIIlIIII;
if ($IIIIIl1l1lll) {
if (empty($this->IIIIIl1llllI)) {
$this->AddAnAddress('ReplyTo',$IIIIIl1l1Ill,$IIIIIIIlIIII);
}
if (empty($this->IIIIIl1lIIll)) {
$this->IIIIIl1lIIll = $IIIIIl1l1Ill;
}
}
return true;
}
public static function ValidateAddress($IIIIIl1l1Ill) {
if (function_exists('filter_var')) {
if(filter_var($IIIIIl1l1Ill,FILTER_VALIDATE_EMAIL) === FALSE) {
return false;
}else {
return true;
}
}else {
return preg_match('/^(?:[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+\.)*[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+@(?:(?:(?:[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!\.)){0,61}[a-zA-Z0-9_-]?\.)+[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!$)){0,61}[a-zA-Z0-9_]?)|(?:\[(?:(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\.){3}(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\]))$/',$IIIIIl1l1Ill);
}
}
public function Send() {
try {
if ((count($this->IIIIIIlII1I1) +count($this->IIIIIl1llI11) +count($this->IIIIIl1lllII)) <1) {
throw new phpmailerException($this->Lang('provide_address'),self::STOP_CRITICAL);
}
if(!empty($this->IIIIIl1lII1l)) {
$this->IIIIIl1I1111 = 'multipart/alternative';
}
$this->IIIIIl1ll1Il = 0;
$this->SetMessageType();
$IIIIIIl11I1l = $this->CreateHeader();
$IIIIIIlII1l1 = $this->CreateBody();
if (empty($this->IIIIIl1lII1I)) {
throw new phpmailerException($this->Lang('empty_message'),self::STOP_CRITICAL);
}
if ($this->IIIIIl1llIll &&$this->IIIIIl1llIl1) {
$IIIIIl1l1l1I = $this->DKIM_Add($IIIIIIl11I1l,$this->IIIIIl1lIIl1,$IIIIIIlII1l1);
$IIIIIIl11I1l = str_replace("\r\n","\n",$IIIIIl1l1l1I) .$IIIIIIl11I1l;
}
switch($this->IIIIIl1lIlII) {
case 'sendmail':
return $this->SendmailSend($IIIIIIl11I1l,$IIIIIIlII1l1);
case 'smtp':
return $this->SmtpSend($IIIIIIl11I1l,$IIIIIIlII1l1);
default:
return $this->MailSend($IIIIIIl11I1l,$IIIIIIlII1l1);
}
}catch (phpmailerException $IIIIIlI1lII1) {
$this->SetError($IIIIIlI1lII1->getMessage());
if ($this->IIIIIl1ll1l1) {
throw $IIIIIlI1lII1;
}
echo $IIIIIlI1lII1->getMessage()."\n";
return false;
}
}
protected function SendmailSend($IIIIIIl11I1l,$IIIIIIlII1l1) {
if ($this->IIIIIl1lIIll != '') {
$IIIIIl1l1l11 = sprintf("%s -oi -f %s -t",escapeshellcmd($this->IIIIIl1lIlIl),escapeshellarg($this->IIIIIl1lIIll));
}else {
$IIIIIl1l1l11 = sprintf("%s -oi -t",escapeshellcmd($this->IIIIIl1lIlIl));
}
if ($this->IIIIIl1lI111 === true) {
foreach ($this->IIIIIl1llIII as $IIIIIIIlI11I =>$IIIIIIl1llIl) {
if(!@$IIIIIl1l11I1 = popen($IIIIIl1l1l11,'w')) {
throw new phpmailerException($this->Lang('execute') .$this->IIIIIl1lIlIl,self::STOP_CRITICAL);
}
fputs($IIIIIl1l11I1,"To: ".$IIIIIIl1llIl ."\n");
fputs($IIIIIl1l11I1,$IIIIIIl11I1l);
fputs($IIIIIl1l11I1,$IIIIIIlII1l1);
$IIIIIlIII11I = pclose($IIIIIl1l11I1);
$IIIIIl1l111l = ($IIIIIlIII11I == 0) ?1 : 0;
$this->doCallback($IIIIIl1l111l,$IIIIIIl1llIl,$this->IIIIIl1llI11,$this->IIIIIl1lllII,$this->IIIIIl1lIIl1,$IIIIIIlII1l1);
if($IIIIIlIII11I != 0) {
throw new phpmailerException($this->Lang('execute') .$this->IIIIIl1lIlIl,self::STOP_CRITICAL);
}
}
}else {
if(!@$IIIIIl1l11I1 = popen($IIIIIl1l1l11,'w')) {
throw new phpmailerException($this->Lang('execute') .$this->IIIIIl1lIlIl,self::STOP_CRITICAL);
}
fputs($IIIIIl1l11I1,$IIIIIIl11I1l);
fputs($IIIIIl1l11I1,$IIIIIIlII1l1);
$IIIIIlIII11I = pclose($IIIIIl1l11I1);
$IIIIIl1l111l = ($IIIIIlIII11I == 0) ?1 : 0;
$this->doCallback($IIIIIl1l111l,$this->IIIIIIlII1I1,$this->IIIIIl1llI11,$this->IIIIIl1lllII,$this->IIIIIl1lIIl1,$IIIIIIlII1l1);
if($IIIIIlIII11I != 0) {
throw new phpmailerException($this->Lang('execute') .$this->IIIIIl1lIlIl,self::STOP_CRITICAL);
}
}
return true;
}
protected function MailSend($IIIIIIl11I1l,$IIIIIIlII1l1) {
$IIIIIl11IIII = array();
foreach($this->IIIIIIlII1I1 as $IIIIII1II11l) {
$IIIIIl11IIII[] = $this->AddrFormat($IIIIII1II11l);
}
$IIIIIIlII1I1 = implode(', ',$IIIIIl11IIII);
$IIIIIl11IIIl = sprintf("-oi -f %s",$this->IIIIIl1lIIll);
if ($this->IIIIIl1lIIll != ''&&strlen(ini_get('safe_mode'))<1) {
$IIIIIl11III1 = ini_get('sendmail_from');
ini_set('sendmail_from',$this->IIIIIl1lIIll);
if ($this->IIIIIl1lI111 === true &&count($IIIIIl11IIII) >1) {
foreach ($IIIIIl11IIII as $IIIIIIIlI11I =>$IIIIIIl1llIl) {
$IIIIIII1lII1 = @mail($IIIIIIl1llIl,$this->EncodeHeader($this->SecureHeader($this->IIIIIl1lIIl1)),$IIIIIIlII1l1,$IIIIIIl11I1l,$IIIIIl11IIIl);
$IIIIIl1l111l = ($IIIIIII1lII1 == 1) ?1 : 0;
$this->doCallback($IIIIIl1l111l,$IIIIIIl1llIl,$this->IIIIIl1llI11,$this->IIIIIl1lllII,$this->IIIIIl1lIIl1,$IIIIIIlII1l1);
}
}else {
$IIIIIII1lII1 = @mail($IIIIIIlII1I1,$this->EncodeHeader($this->SecureHeader($this->IIIIIl1lIIl1)),$IIIIIIlII1l1,$IIIIIIl11I1l,$IIIIIl11IIIl);
$IIIIIl1l111l = ($IIIIIII1lII1 == 1) ?1 : 0;
$this->doCallback($IIIIIl1l111l,$IIIIIIlII1I1,$this->IIIIIl1llI11,$this->IIIIIl1lllII,$this->IIIIIl1lIIl1,$IIIIIIlII1l1);
}
}else {
if ($this->IIIIIl1lI111 === true &&count($IIIIIl11IIII) >1) {
foreach ($IIIIIl11IIII as $IIIIIIIlI11I =>$IIIIIIl1llIl) {
$IIIIIII1lII1 = @mail($IIIIIIl1llIl,$this->EncodeHeader($this->SecureHeader($this->IIIIIl1lIIl1)),$IIIIIIlII1l1,$IIIIIIl11I1l,$IIIIIl11IIIl);
$IIIIIl1l111l = ($IIIIIII1lII1 == 1) ?1 : 0;
$this->doCallback($IIIIIl1l111l,$IIIIIIl1llIl,$this->IIIIIl1llI11,$this->IIIIIl1lllII,$this->IIIIIl1lIIl1,$IIIIIIlII1l1);
}
}else {
$IIIIIII1lII1 = @mail($IIIIIIlII1I1,$this->EncodeHeader($this->SecureHeader($this->IIIIIl1lIIl1)),$IIIIIIlII1l1,$IIIIIIl11I1l);
$IIIIIl1l111l = ($IIIIIII1lII1 == 1) ?1 : 0;
$this->doCallback($IIIIIl1l111l,$IIIIIIlII1I1,$this->IIIIIl1llI11,$this->IIIIIl1lllII,$this->IIIIIl1lIIl1,$IIIIIIlII1l1);
}
}
if (isset($IIIIIl11III1)) {
ini_set('sendmail_from',$IIIIIl11III1);
}
if(!$IIIIIII1lII1) {
throw new phpmailerException($this->Lang('instantiate'),self::STOP_CRITICAL);
}
return true;
}
protected function SmtpSend($IIIIIIl11I1l,$IIIIIIlII1l1) {
require_once $this->IIIIIl1lIlI1 .'class.smtp.php';
$IIIIIl11IIl1 = array();
if(!$this->SmtpConnect()) {
throw new phpmailerException($this->Lang('smtp_connect_failed'),self::STOP_CRITICAL);
}
$IIIIIl11II1I = ($this->IIIIIl1lIIll == '') ?$this->IIIIIl1lIII1 : $this->IIIIIl1lIIll;
if(!$this->IIIIIIlII1Il->Mail($IIIIIl11II1I)) {
throw new phpmailerException($this->Lang('from_failed') .$IIIIIl11II1I,self::STOP_CRITICAL);
}
foreach($this->IIIIIIlII1I1 as $IIIIIIlII1I1) {
if (!$this->IIIIIIlII1Il->Recipient($IIIIIIlII1I1[0])) {
$IIIIIl11IIl1[] = $IIIIIIlII1I1[0];
$IIIIIl1l111l = 0;
$this->doCallback($IIIIIl1l111l,$IIIIIIlII1I1[0],'','',$this->IIIIIl1lIIl1,$IIIIIIlII1l1);
}else {
$IIIIIl1l111l = 1;
$this->doCallback($IIIIIl1l111l,$IIIIIIlII1I1[0],'','',$this->IIIIIl1lIIl1,$IIIIIIlII1l1);
}
}
foreach($this->IIIIIl1llI11 as $IIIIIl1llI11) {
if (!$this->IIIIIIlII1Il->Recipient($IIIIIl1llI11[0])) {
$IIIIIl11IIl1[] = $IIIIIl1llI11[0];
$IIIIIl1l111l = 0;
$this->doCallback($IIIIIl1l111l,'',$IIIIIl1llI11[0],'',$this->IIIIIl1lIIl1,$IIIIIIlII1l1);
}else {
$IIIIIl1l111l = 1;
$this->doCallback($IIIIIl1l111l,'',$IIIIIl1llI11[0],'',$this->IIIIIl1lIIl1,$IIIIIIlII1l1);
}
}
foreach($this->IIIIIl1lllII as $IIIIIl1lllII) {
if (!$this->IIIIIIlII1Il->Recipient($IIIIIl1lllII[0])) {
$IIIIIl11IIl1[] = $IIIIIl1lllII[0];
$IIIIIl1l111l = 0;
$this->doCallback($IIIIIl1l111l,'','',$IIIIIl1lllII[0],$this->IIIIIl1lIIl1,$IIIIIIlII1l1);
}else {
$IIIIIl1l111l = 1;
$this->doCallback($IIIIIl1l111l,'','',$IIIIIl1lllII[0],$this->IIIIIl1lIIl1,$IIIIIIlII1l1);
}
}
if (count($IIIIIl11IIl1) >0 ) {
$IIIIIl11II1l = implode(', ',$IIIIIl11IIl1);
throw new phpmailerException($this->Lang('recipients_failed') .$IIIIIl11II1l);
}
if(!$this->IIIIIIlII1Il->Data($IIIIIIl11I1l .$IIIIIIlII1l1)) {
throw new phpmailerException($this->Lang('data_not_accepted'),self::STOP_CRITICAL);
}
if($this->IIIIIl1lI11l == true) {
$this->IIIIIIlII1Il->Reset();
}
return true;
}
public function SmtpConnect() {
if(is_null($this->IIIIIIlII1Il)) {
$this->IIIIIIlII1Il = new SMTP();
}
$this->IIIIIIlII1Il->IIIII1II1I11 = $this->IIIIIl1lI11I;
$IIIIIl11IlIl = explode(';',$this->IIIIIl1lIl1I);
$IIIIIII1l111 = 0;
$IIIIIl11IlI1 = $this->IIIIIIlII1Il->Connected();
try {
while($IIIIIII1l111 <count($IIIIIl11IlIl) &&!$IIIIIl11IlI1) {
$IIIIIl11IllI = array();
if (preg_match('/^(.+):([0-9]+)$/',$IIIIIl11IlIl[$IIIIIII1l111],$IIIIIl11IllI)) {
$IIIIIIIlIllI = $IIIIIl11IllI[1];
$IIIIIIlIIll1 = $IIIIIl11IllI[2];
}else {
$IIIIIIIlIllI = $IIIIIl11IlIl[$IIIIIII1l111];
$IIIIIIlIIll1 = $this->IIIIIl1lIl1l;
}
$IIIIIl11Illl = ($this->IIIIIl1lI1II == 'tls');
$IIIIIl11Ill1 = ($this->IIIIIl1lI1II == 'ssl');
if ($this->IIIIIIlII1Il->Connect(($IIIIIl11Ill1 ?'ssl://':'').$IIIIIIIlIllI,$IIIIIIlIIll1,$this->IIIIIl1lI1l1)) {
$IIIIIl11Il1I = ($this->IIIIIl1lIl11 != ''?$this->IIIIIl1lIl11 : $this->ServerHostname());
$this->IIIIIIlII1Il->Hello($IIIIIl11Il1I);
if ($IIIIIl11Illl) {
if (!$this->IIIIIIlII1Il->StartTLS()) {
throw new phpmailerException($this->Lang('tls'));
}
$this->IIIIIIlII1Il->Hello($IIIIIl11Il1I);
}
$IIIIIl11IlI1 = true;
if ($this->IIIIIl1lI1Il) {
if (!$this->IIIIIIlII1Il->Authenticate($this->IIIIIl1lI1I1,$this->IIIIIl1lI1lI)) {
throw new phpmailerException($this->Lang('authenticate'));
}
}
}
$IIIIIII1l111++;
if (!$IIIIIl11IlI1) {
throw new phpmailerException($this->Lang('connect_host'));
}
}
}catch (phpmailerException $IIIIIlI1lII1) {
$this->IIIIIIlII1Il->Reset();
throw $IIIIIlI1lII1;
}
return true;
}
public function SmtpClose() {
if(!is_null($this->IIIIIIlII1Il)) {
if($this->IIIIIIlII1Il->Connected()) {
$this->IIIIIIlII1Il->Quit();
$this->IIIIIIlII1Il->Close();
}
}
}
function SetLanguage($IIIIIl11Il11 = 'en',$IIIIIl11I1II = 'language/') {
$IIIIIl11I1I1 = array(
'provide_address'=>'You must provide at least one recipient email address.',
'mailer_not_supported'=>' mailer is not supported.',
'execute'=>'Could not execute: ',
'instantiate'=>'Could not instantiate mail function.',
'authenticate'=>'SMTP Error: Could not authenticate.',
'from_failed'=>'The following From address failed: ',
'recipients_failed'=>'SMTP Error: The following recipients failed: ',
'data_not_accepted'=>'SMTP Error: Data not accepted.',
'connect_host'=>'SMTP Error: Could not connect to SMTP host.',
'file_access'=>'Could not access file: ',
'file_open'=>'File Error: Could not open file: ',
'encoding'=>'Unknown encoding: ',
'signing'=>'Signing Error: ',
'smtp_error'=>'SMTP server error: ',
'empty_message'=>'Message body empty',
'invalid_address'=>'Invalid address',
'variable_set'=>'Cannot set or reset variable: '
);
$IIIIIII1II1l = true;
if ($IIIIIl11Il11 != 'en') {
$IIIIIII1II1l = @include $IIIIIl11I1II.'phpmailer.lang-'.$IIIIIl11Il11.'.php';
}
$this->IIIIIl1ll1II = $IIIIIl11I1I1;
return ($IIIIIII1II1l == true);
}
public function GetTranslations() {
return $this->IIIIIl1ll1II;
}
public function AddrAppend($IIIIIIlIllIl,$addr) {
$addr_str = $IIIIIIlIllIl .': ';
$addresses = array();
foreach ($addr as $IIIIIIll1lIl) {
$addresses[] = $this->AddrFormat($IIIIIIll1lIl);
}
$addr_str .= implode(', ',$addresses);
$addr_str .= $this->IIIIIl1llIIl;
return $addr_str;
}
public function AddrFormat($addr) {
if (empty($addr[1])) {
return $this->SecureHeader($addr[0]);
}else {
return $this->EncodeHeader($this->SecureHeader($addr[1]),'phrase') ." <".$this->SecureHeader($addr[0]) .">";
}
}
public function WrapText($IIIIIlIII1ll,$IIIIIlI11l1l,$IIIIIl11I111 = false) {
$IIIIIl11lII1 = ($IIIIIl11I111) ?sprintf(" =%s",$this->IIIIIl1llIIl) : $this->IIIIIl1llIIl;
$IIIIIl11I1lI = (strtolower($this->IIIIIl1I111l) == "utf-8");
$IIIIIlIII1ll = $this->FixEOL($IIIIIlIII1ll);
if (substr($IIIIIlIII1ll,-1) == $this->IIIIIl1llIIl) {
$IIIIIlIII1ll = substr($IIIIIlIII1ll,0,-1);
}
$IIIIIl11I1ll = explode($this->IIIIIl1llIIl,$IIIIIlIII1ll);
$IIIIIlIII1ll = '';
for ($IIIIIIIllI11=0 ;$IIIIIIIllI11 <count($IIIIIl11I1ll);$IIIIIIIllI11++) {
$IIIIIl11I1l1 = explode(' ',$IIIIIl11I1ll[$IIIIIIIllI11]);
$IIIIIl11I11I = '';
for ($IIIIIlI1lII1 = 0;$IIIIIlI1lII1<count($IIIIIl11I1l1);$IIIIIlI1lII1++) {
$IIIIIl11I11l = $IIIIIl11I1l1[$IIIIIlI1lII1];
if ($IIIIIl11I111 and (strlen($IIIIIl11I11l) >$IIIIIlI11l1l)) {
$IIIIIl11lIII = $IIIIIlI11l1l -strlen($IIIIIl11I11I) -1;
if ($IIIIIlI1lII1 != 0) {
if ($IIIIIl11lIII >20) {
$IIIIIIIllI1I = $IIIIIl11lIII;
if ($IIIIIl11I1lI) {
$IIIIIIIllI1I = $this->UTF8CharBoundary($IIIIIl11I11l,$IIIIIIIllI1I);
}elseif (substr($IIIIIl11I11l,$IIIIIIIllI1I -1,1) == "=") {
$IIIIIIIllI1I--;
}elseif (substr($IIIIIl11I11l,$IIIIIIIllI1I -2,1) == "=") {
$IIIIIIIllI1I -= 2;
}
$IIIIIl11lIIl = substr($IIIIIl11I11l,0,$IIIIIIIllI1I);
$IIIIIl11I11l = substr($IIIIIl11I11l,$IIIIIIIllI1I);
$IIIIIl11I11I .= ' '.$IIIIIl11lIIl;
$IIIIIlIII1ll .= $IIIIIl11I11I .sprintf("=%s",$this->IIIIIl1llIIl);
}else {
$IIIIIlIII1ll .= $IIIIIl11I11I .$IIIIIl11lII1;
}
$IIIIIl11I11I = '';
}
while (strlen($IIIIIl11I11l) >0) {
$IIIIIIIllI1I = $IIIIIlI11l1l;
if ($IIIIIl11I1lI) {
$IIIIIIIllI1I = $this->UTF8CharBoundary($IIIIIl11I11l,$IIIIIIIllI1I);
}elseif (substr($IIIIIl11I11l,$IIIIIIIllI1I -1,1) == "=") {
$IIIIIIIllI1I--;
}elseif (substr($IIIIIl11I11l,$IIIIIIIllI1I -2,1) == "=") {
$IIIIIIIllI1I -= 2;
}
$IIIIIl11lIIl = substr($IIIIIl11I11l,0,$IIIIIIIllI1I);
$IIIIIl11I11l = substr($IIIIIl11I11l,$IIIIIIIllI1I);
if (strlen($IIIIIl11I11l) >0) {
$IIIIIlIII1ll .= $IIIIIl11lIIl .sprintf("=%s",$this->IIIIIl1llIIl);
}else {
$IIIIIl11I11I = $IIIIIl11lIIl;
}
}
}else {
$IIIIIl11lIlI = $IIIIIl11I11I;
$IIIIIl11I11I .= ($IIIIIlI1lII1 == 0) ?$IIIIIl11I11l : (' '.$IIIIIl11I11l);
if (strlen($IIIIIl11I11I) >$IIIIIlI11l1l and $IIIIIl11lIlI != '') {
$IIIIIlIII1ll .= $IIIIIl11lIlI .$IIIIIl11lII1;
$IIIIIl11I11I = $IIIIIl11I11l;
}
}
}
$IIIIIlIII1ll .= $IIIIIl11I11I .$this->IIIIIl1llIIl;
}
return $IIIIIlIII1ll;
}
public function UTF8CharBoundary($IIIIIl11lIll,$IIIIIl11lIl1) {
$IIIIIl11lI1l = false;
$IIIIIl11lI11 = 3;
while (!$IIIIIl11lI1l) {
$IIIIIl11llII = substr($IIIIIl11lIll,$IIIIIl11lIl1 -$IIIIIl11lI11,$IIIIIl11lI11);
$IIIIIl11llIl = strpos($IIIIIl11llII,"=");
if ($IIIIIl11llIl !== false) {
$IIIIIl11llI1 = substr($IIIIIl11lIll,$IIIIIl11lIl1 -$IIIIIl11lI11 +$IIIIIl11llIl +1,2);
$IIIIIl11lllI = hexdec($IIIIIl11llI1);
if ($IIIIIl11lllI <128) {
$IIIIIl11lIl1 = ($IIIIIl11llIl == 0) ?$IIIIIl11lIl1 :
$IIIIIl11lIl1 -($IIIIIl11lI11 -$IIIIIl11llIl);
$IIIIIl11lI1l = true;
}elseif ($IIIIIl11lllI >= 192) {
$IIIIIl11lIl1 = $IIIIIl11lIl1 -($IIIIIl11lI11 -$IIIIIl11llIl);
$IIIIIl11lI1l = true;
}elseif ($IIIIIl11lllI <192) {
$IIIIIl11lI11 += 3;
}
}else {
$IIIIIl11lI1l = true;
}
}
return $IIIIIl11lIl1;
}
public function SetWordWrap() {
if($this->IIIIIl1lII11 <1) {
return;
}
switch($this->IIIIIl1lll1l) {
case 'alt':
case 'alt_attachments':
$this->IIIIIl1lII1l = $this->WrapText($this->IIIIIl1lII1l,$this->IIIIIl1lII11);
break;
default:
$this->IIIIIl1lII1I = $this->WrapText($this->IIIIIl1lII1I,$this->IIIIIl1lII11);
break;
}
}
public function CreateHeader() {
$IIIIIlIII11I = '';
$IIIIIl11ll1l = md5(uniqid(time()));
$this->IIIIIl1lll11[1] = 'b1_'.$IIIIIl11ll1l;
$this->IIIIIl1lll11[2] = 'b2_'.$IIIIIl11ll1l;
$IIIIIlIII11I .= $this->HeaderLine('Date',self::RFCDate());
if($this->IIIIIl1lIIll == '') {
$IIIIIlIII11I .= $this->HeaderLine('Return-Path',trim($this->IIIIIl1lIII1));
}else {
$IIIIIlIII11I .= $this->HeaderLine('Return-Path',trim($this->IIIIIl1lIIll));
}
if($this->IIIIIl1lIlII != 'mail') {
if ($this->IIIIIl1lI111 === true) {
foreach($this->IIIIIIlII1I1 as $IIIIII1II11l) {
$this->IIIIIl1llIII[] = $this->AddrFormat($IIIIII1II11l);
}
}else {
if(count($this->IIIIIIlII1I1) >0) {
$IIIIIlIII11I .= $this->AddrAppend('To',$this->IIIIIIlII1I1);
}elseif (count($this->IIIIIl1llI11) == 0) {
$IIIIIlIII11I .= $this->HeaderLine('To','undisclosed-recipients:;');
}
}
}
$IIIIIl1Il1l1 = array();
$IIIIIl1Il1l1[0][0] = trim($this->IIIIIl1lIII1);
$IIIIIl1Il1l1[0][1] = $this->IIIIIl1lIIlI;
$IIIIIlIII11I .= $this->AddrAppend('From',$IIIIIl1Il1l1);
if(count($this->IIIIIl1llI11) >0) {
$IIIIIlIII11I .= $this->AddrAppend('Cc',$this->IIIIIl1llI11);
}
if((($this->IIIIIl1lIlII == 'sendmail') ||($this->IIIIIl1lIlII == 'mail')) &&(count($this->IIIIIl1lllII) >0)) {
$IIIIIlIII11I .= $this->AddrAppend('Bcc',$this->IIIIIl1lllII);
}
if(count($this->IIIIIl1llllI) >0) {
$IIIIIlIII11I .= $this->AddrAppend('Reply-to',$this->IIIIIl1llllI);
}
if($this->IIIIIl1lIlII != 'mail') {
$IIIIIlIII11I .= $this->HeaderLine('Subject',$this->EncodeHeader($this->SecureHeader($this->IIIIIl1lIIl1)));
}
if($this->IIIIIl1lIll1 != '') {
$IIIIIlIII11I .= $this->HeaderLine('Message-ID',$this->IIIIIl1lIll1);
}else {
$IIIIIlIII11I .= sprintf("Message-ID: <%s@%s>%s",$IIIIIl11ll1l,$this->ServerHostname(),$this->IIIIIl1llIIl);
}
$IIIIIlIII11I .= $this->HeaderLine('X-Priority',$this->IIIIIl1I111I);
$IIIIIlIII11I .= $this->HeaderLine('X-Mailer','PHPMailer '.$this->IIIIIl1lllI1.' (phpmailer.sourceforge.net)');
if($this->IIIIIl1lIllI != '') {
$IIIIIlIII11I .= $this->HeaderLine('Disposition-Notification-To','<'.trim($this->IIIIIl1lIllI) .'>');
}
for($IIIIIII1l111 = 0;$IIIIIII1l111 <count($this->IIIIIl1lll1I);$IIIIIII1l111++) {
$IIIIIlIII11I .= $this->HeaderLine(trim($this->IIIIIl1lll1I[$IIIIIII1l111][0]),$this->EncodeHeader(trim($this->IIIIIl1lll1I[$IIIIIII1l111][1])));
}
if (!$this->IIIIIl1ll1lI) {
$IIIIIlIII11I .= $this->HeaderLine('MIME-Version','1.0');
$IIIIIlIII11I .= $this->GetMailMIME();
}
return $IIIIIlIII11I;
}
public function GetMailMIME() {
$IIIIIlIII11I = '';
switch($this->IIIIIl1lll1l) {
case 'plain':
$IIIIIlIII11I .= $this->HeaderLine('Content-Transfer-Encoding',$this->IIIIIl1lIIII);
$IIIIIlIII11I .= sprintf("Content-Type: %s; charset=\"%s\"",$this->IIIIIl1I1111,$this->IIIIIl1I111l);
break;
case 'attachments':
case 'alt_attachments':
if($this->InlineImageExists()){
$IIIIIlIII11I .= sprintf("Content-Type: %s;%s\ttype=\"text/html\";%s\tboundary=\"%s\"%s",'multipart/related',$this->IIIIIl1llIIl,$this->IIIIIl1llIIl,$this->IIIIIl1lll11[1],$this->IIIIIl1llIIl);
}else {
$IIIIIlIII11I .= $this->HeaderLine('Content-Type','multipart/mixed;');
$IIIIIlIII11I .= $this->TextLine("\tboundary=\"".$this->IIIIIl1lll11[1] .'"');
}
break;
case 'alt':
$IIIIIlIII11I .= $this->HeaderLine('Content-Type','multipart/alternative;');
$IIIIIlIII11I .= $this->TextLine("\tboundary=\"".$this->IIIIIl1lll11[1] .'"');
break;
}
if($this->IIIIIl1lIlII != 'mail') {
$IIIIIlIII11I .= $this->IIIIIl1llIIl.$this->IIIIIl1llIIl;
}
return $IIIIIlIII11I;
}
public function CreateBody() {
$IIIIIIlII1l1 = '';
if ($this->IIIIIl1ll1lI) {
$IIIIIIlII1l1 .= $this->GetMailMIME();
}
$this->SetWordWrap();
switch($this->IIIIIl1lll1l) {
case 'alt':
$IIIIIIlII1l1 .= $this->GetBoundary($this->IIIIIl1lll11[1],'','text/plain','');
$IIIIIIlII1l1 .= $this->EncodeString($this->IIIIIl1lII1l,$this->IIIIIl1lIIII);
$IIIIIIlII1l1 .= $this->IIIIIl1llIIl.$this->IIIIIl1llIIl;
$IIIIIIlII1l1 .= $this->GetBoundary($this->IIIIIl1lll11[1],'','text/html','');
$IIIIIIlII1l1 .= $this->EncodeString($this->IIIIIl1lII1I,$this->IIIIIl1lIIII);
$IIIIIIlII1l1 .= $this->IIIIIl1llIIl.$this->IIIIIl1llIIl;
$IIIIIIlII1l1 .= $this->EndBoundary($this->IIIIIl1lll11[1]);
break;
case 'plain':
$IIIIIIlII1l1 .= $this->EncodeString($this->IIIIIl1lII1I,$this->IIIIIl1lIIII);
break;
case 'attachments':
$IIIIIIlII1l1 .= $this->GetBoundary($this->IIIIIl1lll11[1],'','','');
$IIIIIIlII1l1 .= $this->EncodeString($this->IIIIIl1lII1I,$this->IIIIIl1lIIII);
$IIIIIIlII1l1 .= $this->IIIIIl1llIIl;
$IIIIIIlII1l1 .= $this->AttachAll();
break;
case 'alt_attachments':
$IIIIIIlII1l1 .= sprintf("--%s%s",$this->IIIIIl1lll11[1],$this->IIIIIl1llIIl);
$IIIIIIlII1l1 .= sprintf("Content-Type: %s;%s"."\tboundary=\"%s\"%s",'multipart/alternative',$this->IIIIIl1llIIl,$this->IIIIIl1lll11[2],$this->IIIIIl1llIIl.$this->IIIIIl1llIIl);
$IIIIIIlII1l1 .= $this->GetBoundary($this->IIIIIl1lll11[2],'','text/plain','') .$this->IIIIIl1llIIl;
$IIIIIIlII1l1 .= $this->EncodeString($this->IIIIIl1lII1l,$this->IIIIIl1lIIII);
$IIIIIIlII1l1 .= $this->IIIIIl1llIIl.$this->IIIIIl1llIIl;
$IIIIIIlII1l1 .= $this->GetBoundary($this->IIIIIl1lll11[2],'','text/html','') .$this->IIIIIl1llIIl;
$IIIIIIlII1l1 .= $this->EncodeString($this->IIIIIl1lII1I,$this->IIIIIl1lIIII);
$IIIIIIlII1l1 .= $this->IIIIIl1llIIl.$this->IIIIIl1llIIl;
$IIIIIIlII1l1 .= $this->EndBoundary($this->IIIIIl1lll11[2]);
$IIIIIIlII1l1 .= $this->AttachAll();
break;
}
if ($this->IsError()) {
$IIIIIIlII1l1 = '';
}elseif ($this->IIIIIl1ll1lI) {
try {
$IIIIIlI11II1 = tempnam('','mail');
file_put_contents($IIIIIlI11II1,$IIIIIIlII1l1);
$IIIIIl11l1lI = tempnam("","signed");
if (@openssl_pkcs7_sign($IIIIIlI11II1,$IIIIIl11l1lI,"file://".$this->IIIIIl1ll1I1,array("file://".$this->IIIIIl1ll1lI,$this->IIIIIl1ll1ll),NULL)) {
@unlink($IIIIIlI11II1);
@unlink($IIIIIl11l1lI);
$IIIIIIlII1l1 = file_get_contents($IIIIIl11l1lI);
}else {
@unlink($IIIIIlI11II1);
@unlink($IIIIIl11l1lI);
throw new phpmailerException($this->Lang("signing").openssl_error_string());
}
}catch (phpmailerException $IIIIIlI1lII1) {
$IIIIIIlII1l1 = '';
if ($this->IIIIIl1ll1l1) {
throw $IIIIIlI1lII1;
}
}
}
return $IIIIIIlII1l1;
}
private function GetBoundary($IIIIIl1lll11,$IIIIIl11l11l,$IIIIIl11l111,$IIIIIl111III) {
$IIIIIlIII11I = '';
if($IIIIIl11l11l == '') {
$IIIIIl11l11l = $this->IIIIIl1I111l;
}
if($IIIIIl11l111 == '') {
$IIIIIl11l111 = $this->IIIIIl1I1111;
}
if($IIIIIl111III == '') {
$IIIIIl111III = $this->IIIIIl1lIIII;
}
$IIIIIlIII11I .= $this->TextLine('--'.$IIIIIl1lll11);
$IIIIIlIII11I .= sprintf("Content-Type: %s; charset = \"%s\"",$IIIIIl11l111,$IIIIIl11l11l);
$IIIIIlIII11I .= $this->IIIIIl1llIIl;
$IIIIIlIII11I .= $this->HeaderLine('Content-Transfer-Encoding',$IIIIIl111III);
$IIIIIlIII11I .= $this->IIIIIl1llIIl;
return $IIIIIlIII11I;
}
private function EndBoundary($IIIIIl1lll11) {
return $this->IIIIIl1llIIl .'--'.$IIIIIl1lll11 .'--'.$this->IIIIIl1llIIl;
}
private function SetMessageType() {
if(count($this->IIIIIl1llll1) <1 &&strlen($this->IIIIIl1lII1l) <1) {
$this->IIIIIl1lll1l = 'plain';
}else {
if(count($this->IIIIIl1llll1) >0) {
$this->IIIIIl1lll1l = 'attachments';
}
if(strlen($this->IIIIIl1lII1l) >0 &&count($this->IIIIIl1llll1) <1) {
$this->IIIIIl1lll1l = 'alt';
}
if(strlen($this->IIIIIl1lII1l) >0 &&count($this->IIIIIl1llll1) >0) {
$this->IIIIIl1lll1l = 'alt_attachments';
}
}
}
public function HeaderLine($IIIIIIIlIIII,$IIIIIIIlI11l) {
return $IIIIIIIlIIII .': '.$IIIIIIIlI11l .$this->IIIIIl1llIIl;
}
public function TextLine($IIIIIIIlI11l) {
return $IIIIIIIlI11l .$this->IIIIIl1llIIl;
}
public function AddAttachment($IIIIII1II1l1,$IIIIIIIlIIII = '',$IIIIIl111III = 'base64',$IIIIIIlIllIl = 'application/octet-stream') {
try {
if ( !@is_file($IIIIII1II1l1) ) {
throw new phpmailerException($this->Lang('file_access') .$IIIIII1II1l1,self::STOP_CONTINUE);
}
$IIIIIl111I1I = basename($IIIIII1II1l1);
if ( $IIIIIIIlIIII == '') {
$IIIIIIIlIIII = $IIIIIl111I1I;
}
$this->IIIIIl1llll1[] = array(
0 =>$IIIIII1II1l1,
1 =>$IIIIIl111I1I,
2 =>$IIIIIIIlIIII,
3 =>$IIIIIl111III,
4 =>$IIIIIIlIllIl,
5 =>false,
6 =>'attachment',
7 =>0
);
}catch (phpmailerException $IIIIIlI1lII1) {
$this->SetError($IIIIIlI1lII1->getMessage());
if ($this->IIIIIl1ll1l1) {
throw $IIIIIlI1lII1;
}
echo $IIIIIlI1lII1->getMessage()."\n";
if ( $IIIIIlI1lII1->getCode() == self::STOP_CRITICAL ) {
return false;
}
}
return true;
}
public function GetAttachments() {
return $this->IIIIIl1llll1;
}
private function AttachAll() {
$IIIIIl111lIl = array();
$IIIIIl111lI1 = array();
$IIIIIl111llI = array();
foreach ($this->IIIIIl1llll1 as $IIIIIl1llll1) {
$IIIIIl111lll = $IIIIIl1llll1[5];
if ($IIIIIl111lll) {
$IIIIIll1IIl1 = $IIIIIl1llll1[0];
}else {
$IIIIII1II1l1 = $IIIIIl1llll1[0];
}
if (in_array($IIIIIl1llll1[0],$IIIIIl111llI)) {continue;}
$IIIIIl111I1I    = $IIIIIl1llll1[1];
$IIIIIIIlIIII        = $IIIIIl1llll1[2];
$IIIIIl111III    = $IIIIIl1llll1[3];
$IIIIIIlIllIl        = $IIIIIl1llll1[4];
$IIIIIl111ll1 = $IIIIIl1llll1[6];
$IIIIIIIll1ll         = $IIIIIl1llll1[7];
$IIIIIl111llI[]      = $IIIIIl1llll1[0];
if ( $IIIIIl111ll1 == 'inline'&&isset($IIIIIl111lI1[$IIIIIIIll1ll]) ) {continue;}
$IIIIIl111lI1[$IIIIIIIll1ll] = true;
$IIIIIl111lIl[] = sprintf("--%s%s",$this->IIIIIl1lll11[1],$this->IIIIIl1llIIl);
$IIIIIl111lIl[] = sprintf("Content-Type: %s; name=\"%s\"%s",$IIIIIIlIllIl,$this->EncodeHeader($this->SecureHeader($IIIIIIIlIIII)),$this->IIIIIl1llIIl);
$IIIIIl111lIl[] = sprintf("Content-Transfer-Encoding: %s%s",$IIIIIl111III,$this->IIIIIl1llIIl);
if($IIIIIl111ll1 == 'inline') {
$IIIIIl111lIl[] = sprintf("Content-ID: <%s>%s",$IIIIIIIll1ll,$this->IIIIIl1llIIl);
}
$IIIIIl111lIl[] = sprintf("Content-Disposition: %s; filename=\"%s\"%s",$IIIIIl111ll1,$this->EncodeHeader($this->SecureHeader($IIIIIIIlIIII)),$this->IIIIIl1llIIl.$this->IIIIIl1llIIl);
if($IIIIIl111lll) {
$IIIIIl111lIl[] = $this->EncodeString($IIIIIll1IIl1,$IIIIIl111III);
if($this->IsError()) {
return '';
}
$IIIIIl111lIl[] = $this->IIIIIl1llIIl.$this->IIIIIl1llIIl;
}else {
$IIIIIl111lIl[] = $this->EncodeFile($IIIIII1II1l1,$IIIIIl111III);
if($this->IsError()) {
return '';
}
$IIIIIl111lIl[] = $this->IIIIIl1llIIl.$this->IIIIIl1llIIl;
}
}
$IIIIIl111lIl[] = sprintf("--%s--%s",$this->IIIIIl1lll11[1],$this->IIIIIl1llIIl);
return join('',$IIIIIl111lIl);
}
private function EncodeFile($IIIIII1II1l1,$IIIIIl111III = 'base64') {
try {
if (!is_readable($IIIIII1II1l1)) {
throw new phpmailerException($this->Lang('file_open') .$IIIIII1II1l1,self::STOP_CONTINUE);
}
if (function_exists('get_magic_quotes')) {
function get_magic_quotes() {
return false;
}
}
if (PHP_VERSION <6) {
$IIIIIl1111Il = get_magic_quotes_runtime();
set_magic_quotes_runtime(0);
}
$IIIIIl1111I1  = file_get_contents($IIIIII1II1l1);
$IIIIIl1111I1  = $this->EncodeString($IIIIIl1111I1,$IIIIIl111III);
if (PHP_VERSION <6) {set_magic_quotes_runtime($IIIIIl1111Il);}
return $IIIIIl1111I1;
}catch (Exception $IIIIIlI1lII1) {
$this->SetError($IIIIIlI1lII1->getMessage());
return '';
}
}
public function EncodeString ($IIIIIII1IlII,$IIIIIl111III = 'base64') {
$IIIIIl1111ll = '';
switch(strtolower($IIIIIl111III)) {
case 'base64':
$IIIIIl1111ll = chunk_split(base64_encode($IIIIIII1IlII),76,$this->IIIIIl1llIIl);
break;
case '7bit':
case '8bit':
$IIIIIl1111ll = $this->FixEOL($IIIIIII1IlII);
if (substr($IIIIIl1111ll,-(strlen($this->IIIIIl1llIIl))) != $this->IIIIIl1llIIl)
$IIIIIl1111ll .= $this->IIIIIl1llIIl;
break;
case 'binary':
$IIIIIl1111ll = $IIIIIII1IlII;
break;
case 'quoted-printable':
$IIIIIl1111ll = $this->EncodeQP($IIIIIII1IlII);
break;
default:
$this->SetError($this->Lang('encoding') .$IIIIIl111III);
break;
}
return $IIIIIl1111ll;
}
public function EncodeHeader($IIIIIII1IlII,$IIIIIl11111l = 'text') {
$IIIIIII1II1I = 0;
switch (strtolower($IIIIIl11111l)) {
case 'phrase':
if (!preg_match('/[\200-\377]/',$IIIIIII1IlII)) {
$IIIIIl1111ll = addcslashes($IIIIIII1IlII,"\0..\37\177\\\"");
if (($IIIIIII1IlII == $IIIIIl1111ll) &&!preg_match('/[^A-Za-z0-9!#$%&\'*+\/=?^_`{|}~ -]/',$IIIIIII1IlII)) {
return ($IIIIIl1111ll);
}else {
return ("\"$IIIIIl1111ll\"");
}
}
$IIIIIII1II1I = preg_match_all('/[^\040\041\043-\133\135-\176]/',$IIIIIII1IlII,$IIIII1IIIIIl);
break;
case 'comment':
$IIIIIII1II1I = preg_match_all('/[()"]/',$IIIIIII1IlII,$IIIII1IIIIIl);
case 'text':
default:
$IIIIIII1II1I += preg_match_all('/[\000-\010\013\014\016-\037\177-\377]/',$IIIIIII1IlII,$IIIII1IIIIIl);
break;
}
if ($IIIIIII1II1I == 0) {
return ($IIIIIII1IlII);
}
$IIIII1IIIII1 = 75 -7 -strlen($this->IIIIIl1I111l);
if (strlen($IIIIIII1IlII)/3 <$IIIIIII1II1I) {
$IIIIIl111III = 'B';
if (function_exists('mb_strlen') &&$this->HasMultiBytes($IIIIIII1IlII)) {
$IIIIIl1111ll = $this->Base64EncodeWrapMB($IIIIIII1IlII);
}else {
$IIIIIl1111ll = base64_encode($IIIIIII1IlII);
$IIIII1IIIII1 -= $IIIII1IIIII1 %4;
$IIIIIl1111ll = trim(chunk_split($IIIIIl1111ll,$IIIII1IIIII1,"\n"));
}
}else {
$IIIIIl111III = 'Q';
$IIIIIl1111ll = $this->EncodeQ($IIIIIII1IlII,$IIIIIl11111l);
$IIIIIl1111ll = $this->WrapText($IIIIIl1111ll,$IIIII1IIIII1,true);
$IIIIIl1111ll = str_replace('='.$this->IIIIIl1llIIl,"\n",trim($IIIIIl1111ll));
}
$IIIIIl1111ll = preg_replace('/^(.*)$/m'," =?".$this->IIIIIl1I111l."?$IIIIIl111III?\\1?=",$IIIIIl1111ll);
$IIIIIl1111ll = trim(str_replace("\n",$this->IIIIIl1llIIl,$IIIIIl1111ll));
return $IIIIIl1111ll;
}
public function HasMultiBytes($IIIIIII1IlII) {
if (function_exists('mb_strlen')) {
return (strlen($IIIIIII1IlII) >mb_strlen($IIIIIII1IlII,$this->IIIIIl1I111l));
}else {
return false;
}
}
public function Base64EncodeWrapMB($IIIIIII1IlII) {
$IIIII1ll1I1I = "=?".$this->IIIIIl1I111l."?B?";
$end = "?=";
$IIIIIl1111ll = "";
$mb_length = mb_strlen($IIIIIII1IlII,$this->IIIIIl1I111l);
$IIIIIlI11l1l = 75 -strlen($IIIII1ll1I1I) -strlen($end);
$ratio = $mb_length / strlen($IIIIIII1IlII);
$IIIIII11Il1l = $avgLength = floor($IIIIIlI11l1l * $ratio * .75);
for ($IIIIIIIllI11 = 0;$IIIIIIIllI11 <$mb_length;$IIIIIIIllI11 += $IIIIII11Il1l) {
$IIIIIl11lI11 = 0;
do {
$IIIIII11Il1l = $avgLength -$IIIIIl11lI11;
$chunk = mb_substr($IIIIIII1IlII,$IIIIIIIllI11,$IIIIII11Il1l,$this->IIIIIl1I111l);
$chunk = base64_encode($chunk);
$IIIIIl11lI11++;
}
while (strlen($chunk) >$IIIIIlI11l1l);
$IIIIIl1111ll .= $chunk .$this->IIIIIl1llIIl;
}
$IIIIIl1111ll = substr($IIIIIl1111ll,0,-strlen($this->IIIIIl1llIIl));
return $IIIIIl1111ll;
}
public function EncodeQPphp( $input = '',$IIIII1IIII1I = 76,$IIIII1IIII1l = false) {
$IIIIIl11llI1 = array('0','1','2','3','4','5','6','7','8','9','A','B','C','D','E','F');
$IIIII1II1IlI = preg_split('/(?:\r\n|\r|\n)/',$input);
$eol = "\r\n";
$escape = '=';
$IIIIIIlll1II = '';
while( list(,$IIIIIl11I1ll) = each($IIIII1II1IlI) ) {
$linlen = strlen($IIIIIl11I1ll);
$newline = '';
for($IIIIIIIllI11 = 0;$IIIIIIIllI11 <$linlen;$IIIIIIIllI11++) {
$IIIIIII11IIl = substr( $IIIIIl11I1ll,$IIIIIIIllI11,1 );
$IIIIIl11lllI = ord( $IIIIIII11IIl );
if ( ( $IIIIIIIllI11 == 0 ) &&( $IIIIIl11lllI == 46 ) ) {
$IIIIIII11IIl = '=2E';
}
if ( $IIIIIl11lllI == 32 ) {
if ( $IIIIIIIllI11 == ( $linlen -1 ) ) {
$IIIIIII11IIl = '=20';
}else if ( $IIIII1IIII1l ) {
$IIIIIII11IIl = '=20';
}
}elseif ( ($IIIIIl11lllI == 61) ||($IIIIIl11lllI <32 ) ||($IIIIIl11lllI >126) ) {
$h2 = floor($IIIIIl11lllI/16);
$h1 = floor($IIIIIl11lllI%16);
$IIIIIII11IIl = $escape.$IIIIIl11llI1[$h2].$IIIIIl11llI1[$h1];
}
if ( (strlen($newline) +strlen($IIIIIII11IIl)) >= $IIIII1IIII1I ) {
$IIIIIIlll1II .= $newline.$escape.$eol;
$newline = '';
if ( $IIIIIl11lllI == 46 ) {
$IIIIIII11IIl = '=2E';
}
}
$newline .= $IIIIIII11IIl;
}
$IIIIIIlll1II .= $newline.$eol;
}
return $IIIIIIlll1II;
}
public function EncodeQP($IIIIIll1IIl1,$IIIII1IIII1I = 76,$IIIII1IIII1l = false) {
if (function_exists('quoted_printable_encode')) {
return quoted_printable_encode($IIIIIll1IIl1);
}
$IIIII1IIIIl1 = stream_get_filters();
if (!in_array('convert.*',$IIIII1IIIIl1)) {
return $this->EncodeQPphp($IIIIIll1IIl1,$IIIII1IIII1I,$IIIII1IIII1l);
}
$IIIIIIlIl11l = fopen('php://temp/','r+');
$IIIIIll1IIl1 = preg_replace('/\r\n?/',$this->IIIIIl1llIIl,$IIIIIll1IIl1);
$IIIIIl11IIIl = array('line-length'=>$IIIII1IIII1I,'line-break-chars'=>$this->IIIIIl1llIIl);
$IIIIIII1llI1 = stream_filter_append($IIIIIIlIl11l,'convert.quoted-printable-encode',STREAM_FILTER_READ,$IIIIIl11IIIl);
fputs($IIIIIIlIl11l,$IIIIIll1IIl1);
rewind($IIIIIIlIl11l);
$IIIIIl1II1l1 = stream_get_contents($IIIIIIlIl11l);
stream_filter_remove($IIIIIII1llI1);
$IIIIIl1II1l1 = preg_replace('/^\./m','=2E',$IIIIIl1II1l1);
fclose($IIIIIIlIl11l);
return $IIIIIl1II1l1;
}
public function EncodeQ ($IIIIIII1IlII,$IIIIIl11111l = 'text') {
$IIIIIl1111ll = preg_replace('/[\r\n]*/','',$IIIIIII1IlII);
switch (strtolower($IIIIIl11111l)) {
case 'phrase':
$IIIIIl1111ll = preg_replace("/([^A-Za-z0-9!*+\/ -])/e","'='.sprintf('%02X', ord('\\1'))",$IIIIIl1111ll);
break;
case 'comment':
$IIIIIl1111ll = preg_replace("/([\(\)\"])/e","'='.sprintf('%02X', ord('\\1'))",$IIIIIl1111ll);
case 'text':
default:
$IIIIIl1111ll = preg_replace('/([\000-\011\013\014\016-\037\075\077\137\177-\377])/e',
"'='.sprintf('%02X', ord('\\1'))",$IIIIIl1111ll);
break;
}
$IIIIIl1111ll = str_replace(' ','_',$IIIIIl1111ll);
return $IIIIIl1111ll;
}
public function AddStringAttachment($IIIIIll1IIl1,$IIIIIl111I1I,$IIIIIl111III = 'base64',$IIIIIIlIllIl = 'application/octet-stream') {
$this->IIIIIl1llll1[] = array(
0 =>$IIIIIll1IIl1,
1 =>$IIIIIl111I1I,
2 =>basename($IIIIIl111I1I),
3 =>$IIIIIl111III,
4 =>$IIIIIIlIllIl,
5 =>true,
6 =>'attachment',
7 =>0
);
}
public function AddEmbeddedImage($IIIIII1II1l1,$IIIIIIIll1ll,$IIIIIIIlIIII = '',$IIIIIl111III = 'base64',$IIIIIIlIllIl = 'application/octet-stream') {
if ( !@is_file($IIIIII1II1l1) ) {
$this->SetError($this->Lang('file_access') .$IIIIII1II1l1);
return false;
}
$IIIIIl111I1I = basename($IIIIII1II1l1);
if ( $IIIIIIIlIIII == '') {
$IIIIIIIlIIII = $IIIIIl111I1I;
}
$this->IIIIIl1llll1[] = array(
0 =>$IIIIII1II1l1,
1 =>$IIIIIl111I1I,
2 =>$IIIIIIIlIIII,
3 =>$IIIIIl111III,
4 =>$IIIIIIlIllIl,
5 =>false,
6 =>'inline',
7 =>$IIIIIIIll1ll
);
return true;
}
public function InlineImageExists() {
foreach($this->IIIIIl1llll1 as $IIIIIl1llll1) {
if ($IIIIIl1llll1[6] == 'inline') {
return true;
}
}
return false;
}
public function ClearAddresses() {
foreach($this->IIIIIIlII1I1 as $IIIIIIlII1I1) {
unset($this->IIIIIl1lllll[strtolower($IIIIIIlII1I1[0])]);
}
$this->IIIIIIlII1I1 = array();
}
public function ClearCCs() {
foreach($this->IIIIIl1llI11 as $IIIIIl1llI11) {
unset($this->IIIIIl1lllll[strtolower($IIIIIl1llI11[0])]);
}
$this->IIIIIl1llI11 = array();
}
public function ClearBCCs() {
foreach($this->IIIIIl1lllII as $IIIIIl1lllII) {
unset($this->IIIIIl1lllll[strtolower($IIIIIl1lllII[0])]);
}
$this->IIIIIl1lllII = array();
}
public function ClearReplyTos() {
$this->IIIIIl1llllI = array();
}
public function ClearAllRecipients() {
$this->IIIIIIlII1I1 = array();
$this->IIIIIl1llI11 = array();
$this->IIIIIl1lllII = array();
$this->IIIIIl1lllll = array();
}
public function ClearAttachments() {
$this->IIIIIl1llll1 = array();
}
public function ClearCustomHeaders() {
$this->IIIIIl1lll1I = array();
}
protected function SetError($IIIIIlIl1Ill) {
$this->IIIIIl1ll1Il++;
if ($this->IIIIIl1lIlII == 'smtp'and !is_null($this->IIIIIIlII1Il)) {
$IIIII1III1ll = $this->IIIIIIlII1Il->getError();
if (!empty($IIIII1III1ll) and array_key_exists('smtp_msg',$IIIII1III1ll)) {
$IIIIIlIl1Ill .= '<p>'.$this->Lang('smtp_error') .$IIIII1III1ll['smtp_msg'] ."</p>\n";
}
}
$this->IIIIIl1lIIIl = $IIIIIlIl1Ill;
}
public static function RFCDate() {
$IIIII1III11I = date('Z');
$IIIII1III11l = ($IIIII1III11I <0) ?'-': '+';
$IIIII1III11I = abs($IIIII1III11I);
$IIIII1III11I = (int)($IIIII1III11I/3600)*100 +($IIIII1III11I%3600)/60;
$IIIIIlIII11I = sprintf("%s %s%04d",date('D, j M Y H:i:s'),$IIIII1III11l,$IIIII1III11I);
return $IIIIIlIII11I;
}
private function ServerHostname() {
if (!empty($this->IIIIIl1lIlll)) {
$IIIIIlIII11I = $this->IIIIIl1lIlll;
}elseif (isset($_SERVER['SERVER_NAME'])) {
$IIIIIlIII11I = $_SERVER['SERVER_NAME'];
}else {
$IIIIIlIII11I = 'localhost.localdomain';
}
return $IIIIIlIII11I;
}
private function Lang($IIIIIIIlI11I) {
if(count($this->IIIIIl1ll1II) <1) {
$this->SetLanguage('en');
}
if(isset($this->IIIIIl1ll1II[$IIIIIIIlI11I])) {
return $this->IIIIIl1ll1II[$IIIIIIIlI11I];
}else {
return 'Language string failed to load: '.$IIIIIIIlI11I;
}
}
public function IsError() {
return ($this->IIIIIl1ll1Il >0);
}
private function FixEOL($IIIIIII1IlII) {
$IIIIIII1IlII = str_replace("\r\n","\n",$IIIIIII1IlII);
$IIIIIII1IlII = str_replace("\r","\n",$IIIIIII1IlII);
$IIIIIII1IlII = str_replace("\n",$this->IIIIIl1llIIl,$IIIIIII1IlII);
return $IIIIIII1IlII;
}
public function AddCustomHeader($IIIII1IIlIl1) {
$this->IIIIIl1lll1I[] = explode(':',$IIIII1IIlIl1,2);
}
public function MsgHTML($IIIIIlIII1ll,$IIIII1IIlI1l = '') {
preg_match_all("/(src|background)=\"(.*)\"/Ui",$IIIIIlIII1ll,$IIIII1IIlI11);
if(isset($IIIII1IIlI11[2])) {
foreach($IIIII1IIlI11[2] as $IIIIIIIllI11 =>$IIIIIII1l1Il) {
if (!preg_match('#^[A-z]+://#',$IIIIIII1l1Il)) {
$IIIIIl111I1I = basename($IIIIIII1l1Il);
$IIIII1IIllII = dirname($IIIIIII1l1Il);
($IIIII1IIllII == '.')?$IIIII1IIllII='':'';
$IIIIIIIll1ll = 'cid:'.md5($IIIIIl111I1I);
$IIIIIlll1l1l = pathinfo($IIIIIl111I1I,PATHINFO_EXTENSION);
$IIIII1IIllIl  = self::_mime_types($IIIIIlll1l1l);
if ( strlen($IIIII1IIlI1l) >1 &&substr($IIIII1IIlI1l,-1) != '/') {$IIIII1IIlI1l .= '/';}
if ( strlen($IIIII1IIllII) >1 &&substr($IIIII1IIllII,-1) != '/') {$IIIII1IIllII .= '/';}
if ( $this->AddEmbeddedImage($IIIII1IIlI1l.$IIIII1IIllII.$IIIIIl111I1I,md5($IIIIIl111I1I),$IIIIIl111I1I,'base64',$IIIII1IIllIl) ) {
$IIIIIlIII1ll = preg_replace("/".$IIIII1IIlI11[1][$IIIIIIIllI11]."=\"".preg_quote($IIIIIII1l1Il,'/')."\"/Ui",$IIIII1IIlI11[1][$IIIIIIIllI11]."=\"".$IIIIIIIll1ll."\"",$IIIIIlIII1ll);
}
}
}
}
$this->IsHTML(true);
$this->IIIIIl1lII1I = $IIIIIlIII1ll;
$IIIII1IIlllI = trim(strip_tags(preg_replace('/<(head|title|style|script)[^>]*>.*?<\/\\1>/s','',$IIIIIlIII1ll)));
if (!empty($IIIII1IIlllI) &&empty($this->IIIIIl1lII1l)) {
$this->IIIIIl1lII1l = html_entity_decode($IIIII1IIlllI);
}
if (empty($this->IIIIIl1lII1l)) {
$this->IIIIIl1lII1l = 'To view this email message, open it in a program that understands HTML!'."\n\n";
}
}
public static function _mime_types($IIIIIlll1l1l = '') {
$IIIII1IIlll1 = array(
'hqx'=>'application/mac-binhex40',
'cpt'=>'application/mac-compactpro',
'doc'=>'application/msword',
'bin'=>'application/macbinary',
'dms'=>'application/octet-stream',
'lha'=>'application/octet-stream',
'lzh'=>'application/octet-stream',
'exe'=>'application/octet-stream',
'class'=>'application/octet-stream',
'psd'=>'application/octet-stream',
'so'=>'application/octet-stream',
'sea'=>'application/octet-stream',
'dll'=>'application/octet-stream',
'oda'=>'application/oda',
'pdf'=>'application/pdf',
'ai'=>'application/postscript',
'eps'=>'application/postscript',
'ps'=>'application/postscript',
'smi'=>'application/smil',
'smil'=>'application/smil',
'mif'=>'application/vnd.mif',
'xls'=>'application/vnd.ms-excel',
'ppt'=>'application/vnd.ms-powerpoint',
'wbxml'=>'application/vnd.wap.wbxml',
'wmlc'=>'application/vnd.wap.wmlc',
'dcr'=>'application/x-director',
'dir'=>'application/x-director',
'dxr'=>'application/x-director',
'dvi'=>'application/x-dvi',
'gtar'=>'application/x-gtar',
'php'=>'application/x-httpd-php',
'php4'=>'application/x-httpd-php',
'php3'=>'application/x-httpd-php',
'phtml'=>'application/x-httpd-php',
'phps'=>'application/x-httpd-php-source',
'js'=>'application/x-javascript',
'swf'=>'application/x-shockwave-flash',
'sit'=>'application/x-stuffit',
'tar'=>'application/x-tar',
'tgz'=>'application/x-tar',
'xhtml'=>'application/xhtml+xml',
'xht'=>'application/xhtml+xml',
'zip'=>'application/zip',
'mid'=>'audio/midi',
'midi'=>'audio/midi',
'mpga'=>'audio/mpeg',
'mp2'=>'audio/mpeg',
'mp3'=>'audio/mpeg',
'aif'=>'audio/x-aiff',
'aiff'=>'audio/x-aiff',
'aifc'=>'audio/x-aiff',
'ram'=>'audio/x-pn-realaudio',
'rm'=>'audio/x-pn-realaudio',
'rpm'=>'audio/x-pn-realaudio-plugin',
'ra'=>'audio/x-realaudio',
'rv'=>'video/vnd.rn-realvideo',
'wav'=>'audio/x-wav',
'bmp'=>'image/bmp',
'gif'=>'image/gif',
'jpeg'=>'image/jpeg',
'jpg'=>'image/jpeg',
'jpe'=>'image/jpeg',
'png'=>'image/png',
'tiff'=>'image/tiff',
'tif'=>'image/tiff',
'css'=>'text/css',
'html'=>'text/html',
'htm'=>'text/html',
'shtml'=>'text/html',
'txt'=>'text/plain',
'text'=>'text/plain',
'log'=>'text/plain',
'rtx'=>'text/richtext',
'rtf'=>'text/rtf',
'xml'=>'text/xml',
'xsl'=>'text/xml',
'mpeg'=>'video/mpeg',
'mpg'=>'video/mpeg',
'mpe'=>'video/mpeg',
'qt'=>'video/quicktime',
'mov'=>'video/quicktime',
'avi'=>'video/x-msvideo',
'movie'=>'video/x-sgi-movie',
'doc'=>'application/msword',
'word'=>'application/msword',
'xl'=>'application/excel',
'eml'=>'message/rfc822'
);
return (!isset($IIIII1IIlll1[strtolower($IIIIIlll1l1l)])) ?'application/octet-stream': $IIIII1IIlll1[strtolower($IIIIIlll1l1l)];
}
public function set($IIIIIIIlIIII,$IIIIIIIlI11l = '') {
try {
if (isset($this->$IIIIIIIlIIII) ) {
$this->$IIIIIIIlIIII = $IIIIIIIlI11l;
}else {
throw new phpmailerException($this->Lang('variable_set') .$IIIIIIIlIIII,self::STOP_CRITICAL);
}
}catch (Exception $IIIIIlI1lII1) {
$this->SetError($IIIIIlI1lII1->getMessage());
if ($IIIIIlI1lII1->getCode() == self::STOP_CRITICAL) {
return false;
}
}
return true;
}
public function SecureHeader($IIIIIII1IlII) {
$IIIIIII1IlII = str_replace("\r",'',$IIIIIII1IlII);
$IIIIIII1IlII = str_replace("\n",'',$IIIIIII1IlII);
return trim($IIIIIII1IlII);
}
public function Sign($IIIII1IIl1II,$IIIII1IIll1l,$IIIII1IIll11) {
$this->IIIIIl1ll1I1 = $IIIII1IIl1II;
$this->IIIIIl1ll1lI = $IIIII1IIll1l;
$this->IIIIIl1ll1ll = $IIIII1IIll11;
}
public function DKIM_QP($IIIII1IIl1I1) {
$IIIII1IIl1lI="";
$IIIIIl11I1ll="";
for ($IIIIIIIllI11=0;$IIIIIIIllI11<strlen($IIIII1IIl1I1);$IIIIIIIllI11++) {
$IIIII1IIl1ll=ord($IIIII1IIl1I1[$IIIIIIIllI11]);
if ( ((0x21 <= $IIIII1IIl1ll) &&($IIIII1IIl1ll <= 0x3A)) ||$IIIII1IIl1ll == 0x3C ||((0x3E <= $IIIII1IIl1ll) &&($IIIII1IIl1ll <= 0x7E)) ) {
$IIIIIl11I1ll.=$IIIII1IIl1I1[$IIIIIIIllI11];
}else {
$IIIIIl11I1ll.="=".sprintf("%02X",$IIIII1IIl1ll);
}
}
return $IIIIIl11I1ll;
}
public function DKIM_Sign($IIIIIII1llI1) {
$IIIII1IIl11I = file_get_contents($this->IIIIIl1llIl1);
if ($this->DKIM_passphrase!='') {
$IIIII1IIl11l = openssl_pkey_get_private($IIIII1IIl11I,$this->DKIM_passphrase);
}else {
$IIIII1IIl11l = $IIIII1IIl11I;
}
if (openssl_sign($IIIIIII1llI1,$IIIII1II1IIl,$IIIII1IIl11l)) {
return base64_encode($IIIII1II1IIl);
}
}
public function DKIM_HeaderC($IIIIIII1llI1) {
$IIIIIII1llI1=preg_replace("/\r\n\s+/"," ",$IIIIIII1llI1);
$IIIII1II1IlI=explode("\r\n",$IIIIIII1llI1);
foreach ($IIIII1II1IlI as $IIIIIIIlI11I=>$IIIIIl11I1ll) {
list($IIIII1II1Ill,$IIIIIIIlI11l)=explode(":",$IIIIIl11I1ll,2);
$IIIII1II1Ill=strtolower($IIIII1II1Ill);
$IIIIIIIlI11l=preg_replace("/\s+/"," ",$IIIIIIIlI11l) ;
$IIIII1II1IlI[$IIIIIIIlI11I]=$IIIII1II1Ill.":".trim($IIIIIIIlI11l) ;
}
$IIIIIII1llI1=implode("\r\n",$IIIII1II1IlI);
return $IIIIIII1llI1;
}
public function DKIM_BodyC($IIIIIIlII1l1) {
if ($IIIIIIlII1l1 == '') return "\r\n";
$IIIIIIlII1l1=str_replace("\r\n","\n",$IIIIIIlII1l1);
$IIIIIIlII1l1=str_replace("\n","\r\n",$IIIIIIlII1l1);
while (substr($IIIIIIlII1l1,strlen($IIIIIIlII1l1)-4,4) == "\r\n\r\n") {
$IIIIIIlII1l1=substr($IIIIIIlII1l1,0,strlen($IIIIIIlII1l1)-2);
}
return $IIIIIIlII1l1;
}
public function DKIM_Add($headers_line,$IIIIIIlII1lI,$IIIIIIlII1l1) {
$DKIMsignatureType    = 'rsa-sha1';
$DKIMcanonicalization = 'relaxed/simple';
$DKIMquery            = 'dns/txt';
$DKIMtime             = time() ;
$subject_header       = "Subject: $IIIIIIlII1lI";
$IIIIIIllI111              = explode("\r\n",$headers_line);
foreach($IIIIIIllI111 as $IIIIIIl11I1l) {
if (strpos($IIIIIIl11I1l,'From:') === 0) {
$from_header=$IIIIIIl11I1l;
}elseif (strpos($IIIIIIl11I1l,'To:') === 0) {
$to_header=$IIIIIIl11I1l;
}
}
$IIIIIl1Il1l1     = str_replace('|','=7C',$this->DKIM_QP($from_header));
$IIIIIIlII1I1       = str_replace('|','=7C',$this->DKIM_QP($to_header));
$IIIIIIlII1lI  = str_replace('|','=7C',$this->DKIM_QP($subject_header)) ;
$IIIIIIlII1l1     = $this->DKIM_BodyC($IIIIIIlII1l1);
$DKIMlen  = strlen($IIIIIIlII1l1) ;
$DKIMb64  = base64_encode(pack("H*",sha1($IIIIIIlII1l1))) ;
$ident    = ($this->IIIIIl1llIlI == '')?'': " i=".$this->IIIIIl1llIlI .";";
$dkimhdrs = "DKIM-Signature: v=1; a=".$DKIMsignatureType ."; q=".$DKIMquery ."; l=".$DKIMlen ."; s=".$this->IIIIIl1llII1 .";\r\n".
"\tt=".$DKIMtime ."; c=".$DKIMcanonicalization .";\r\n".
"\th=From:To:Subject;\r\n".
"\td=".$this->IIIIIl1llIll .";".$ident ."\r\n".
"\tz=$IIIIIl1Il1l1\r\n".
"\t|$IIIIIIlII1I1\r\n".
"\t|$IIIIIIlII1lI;\r\n".
"\tbh=".$DKIMb64 .";\r\n".
"\tb=";
$toSign   = $this->DKIM_HeaderC($from_header ."\r\n".$to_header ."\r\n".$subject_header ."\r\n".$dkimhdrs);
$IIIIIl11l1lI   = $this->DKIM_Sign($toSign);
return "X-PHPMAILER-DKIM: phpmailer.worxware.com\r\n".$dkimhdrs.$IIIIIl11l1lI."\r\n";
}
protected function doCallback($IIIIIl1l111l,$IIIIIIlII1I1,$IIIIIl1llI11,$IIIIIl1lllII,$IIIIIIlII1lI,$IIIIIIlII1l1) {
if (!empty($this->IIIIIl1lllIl) &&function_exists($this->IIIIIl1lllIl)) {
$IIIIIl11IIIl = array($IIIIIl1l111l,$IIIIIIlII1I1,$IIIIIl1llI11,$IIIIIl1lllII,$IIIIIIlII1lI,$IIIIIIlII1l1);
call_user_func_array($this->IIIIIl1lllIl,$IIIIIl11IIIl);
}
}
}
class phpmailerException extends Exception {
public function errorMessage() {
$errorMsg = '<strong>'.$this->getMessage() ."</strong><br />\n";
return $errorMsg;
}
}
?>