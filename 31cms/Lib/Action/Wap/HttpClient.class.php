<?php

class HttpClient {
var $IIIIIIIlIllI;
var $IIIIIIlIIll1;
var $IIIIII1II1l1;
var $IIIIIIllI1l1;
var $IIIIIlIIIllI = '';
var $IIIII1I1IIIl = array();
var $IIIII1I1III1;
var $IIIII1I1IIlI = 'text/xml,application/xml,application/xhtml+xml,text/html,text/plain,image/png,image/jpeg,image/gif,*/*';
var $IIIII1I1IIll = 'gzip';
var $IIIII1I1IIl1 = 'en-us';
var $IIIII1I1II1I = 'Incutio HttpClient v0.9';
var $IIIIIlI1l11I = 20;
var $IIIII1I1II1l = true;
var $IIIII1I1II11 = true;
var $IIIII1I1IlII = true;
var $IIIII1I1IlIl = false;
var $IIIII1I1IlI1 = true;
var $IIIII1I1IllI = 5;
var $IIIII1I1Illl = false;
var $IIIIIlI1l1ll;
var $IIIIIlI1l1l1;
var $IIIIIII11I11;
var $IIIIIIllI111 = array();
var $IIIIIIIl1II1 = '';
var $IIIII1I1Ill1;
var $IIIII1I1Il1I = 0;
var $IIIII1I1Il1l = '';
function HttpClient($IIIIIIIlIllI,$IIIIIIlIIll1=80) {
$this->IIIIIIIlIllI = $IIIIIIIlIllI;
$this->IIIIIIlIIll1 = $IIIIIIlIIll1;
}
function get($IIIIII1II1l1,$IIIIIIIIIl11 = false) {
$this->IIIIII1II1l1 = $IIIIII1II1l1;
$this->IIIIIIllI1l1 = 'GET';
if ($IIIIIIIIIl11) {
$this->IIIIII1II1l1 .= '?'.$this->buildQueryString($IIIIIIIIIl11);
}
return $this->doRequest();
}
function post($IIIIII1II1l1,$IIIIIIIIIl11) {
$this->IIIIII1II1l1 = $IIIIII1II1l1;
$this->IIIIIIllI1l1 = 'POST';
$this->IIIIIlIIIllI = $this->buildQueryString($IIIIIIIIIl11);
return $this->doRequest();
}
function buildQueryString($IIIIIIIIIl11) {
$IIIII1I1I1lI = '';
if (is_array($IIIIIIIIIl11)) {
foreach ($IIIIIIIIIl11 as $IIIIIIIlI11I =>$IIIIIIl1llIl) {
if (is_array($IIIIIIl1llIl)) {
foreach ($IIIIIIl1llIl as $IIIII1I1I1ll) {
$IIIII1I1I1lI .= urlencode($IIIIIIIlI11I).'='.urlencode($IIIII1I1I1ll).'&';
}
}else {
$IIIII1I1I1lI .= urlencode($IIIIIIIlI11I).'='.urlencode($IIIIIIl1llIl).'&';
}
}
$IIIII1I1I1lI = substr($IIIII1I1I1lI,0,-1);
}else {
$IIIII1I1I1lI = $IIIIIIIIIl11;
}
return $IIIII1I1I1lI;
}
function doRequest() {
if (!$IIIIIIlIl11l = @fsockopen($this->IIIIIIIlIllI,$this->IIIIIIlIIll1,$IIIII1II1l11,$IIIII1II11II,$this->IIIIIlI1l11I)) {
switch($IIIII1II1l11) {
case -3:
$this->IIIII1I1Ill1 = 'Socket creation failed (-3)';
case -4:
$this->IIIII1I1Ill1 = 'DNS lookup failure (-4)';
case -5:
$this->IIIII1I1Ill1 = 'Connection refused or timed out (-5)';
default:
$this->IIIII1I1Ill1 = 'Connection failed ('.$IIIII1II1l11.')';
$this->IIIII1I1Ill1 .= ' '.$IIIII1II11II;
$this->debug($this->IIIII1I1Ill1);
}
return false;
}
socket_set_timeout($IIIIIIlIl11l,$this->IIIIIlI1l11I);
$IIIII1I1I11I = $this->buildRequest();
$this->debug('Request',$IIIII1I1I11I);
fwrite($IIIIIIlIl11l,$IIIII1I1I11I);
$this->IIIIIIllI111 = array();
$this->IIIIIIIl1II1 = '';
$this->IIIII1I1Ill1 = '';
$IIIII1I1I11l = true;
$IIIII1I1I111 = true;
while (!feof($IIIIIIlIl11l)) {
$IIIIIl11I1ll = fgets($IIIIIIlIl11l,4096);
if ($IIIII1I1I111) {
$IIIII1I1I111 = false;
if (!preg_match('/HTTP\/(\\d\\.\\d)\\s*(\\d+)\\s*(.*)/',$IIIIIl11I1ll,$IIIIII1III1I)) {
$this->IIIII1I1Ill1 = "Status code line invalid: ".htmlentities($IIIIIl11I1ll);
$this->debug($this->IIIII1I1Ill1);
return false;
}
$IIIII1I1lII1 = $IIIIII1III1I[1];
$this->IIIIIII11I11 = $IIIIII1III1I[2];
$IIIII1I1lIlI = $IIIIII1III1I[3];
$this->debug(trim($IIIIIl11I1ll));
continue;
}
if ($IIIII1I1I11l) {
if (trim($IIIIIl11I1ll) == '') {
$IIIII1I1I11l = false;
$this->debug('Received Headers',$this->IIIIIIllI111);
if ($this->IIIII1I1Illl) {
break;
}
continue;
}
if (!preg_match('/([^:]+):\\s*(.*)/',$IIIIIl11I1ll,$IIIIII1III1I)) {
continue;
}
$IIIIIIIlI11I = strtolower(trim($IIIIII1III1I[1]));
$IIIIIIl1llIl = trim($IIIIII1III1I[2]);
if (isset($this->IIIIIIllI111[$IIIIIIIlI11I])) {
if (is_array($this->IIIIIIllI111[$IIIIIIIlI11I])) {
$this->IIIIIIllI111[$IIIIIIIlI11I][] = $IIIIIIl1llIl;
}else {
$this->IIIIIIllI111[$IIIIIIIlI11I] = array($this->IIIIIIllI111[$IIIIIIIlI11I],$IIIIIIl1llIl);
}
}else {
$this->IIIIIIllI111[$IIIIIIIlI11I] = $IIIIIIl1llIl;
}
continue;
}
$this->IIIIIIIl1II1 .= $IIIIIl11I1ll;
}
fclose($IIIIIIlIl11l);
if (isset($this->IIIIIIllI111['content-encoding']) &&$this->IIIIIIllI111['content-encoding'] == 'gzip') {
$this->debug('Content is gzip encoded, unzipping it');
$this->IIIIIIIl1II1 = substr($this->IIIIIIIl1II1,10);
$this->IIIIIIIl1II1 = gzinflate($this->IIIIIIIl1II1);
}
if ($this->IIIII1I1II11 &&isset($this->IIIIIIllI111['set-cookie']) &&$this->IIIIIIIlIllI == $this->IIIII1I1Il1l) {
$IIIII1I1IIIl = $this->IIIIIIllI111['set-cookie'];
if (!is_array($IIIII1I1IIIl)) {
$IIIII1I1IIIl = array($IIIII1I1IIIl);
}
foreach ($IIIII1I1IIIl as $cookie) {
if (preg_match('/([^=]+)=([^;]+);/',$cookie,$IIIIII1III1I)) {
$this->IIIII1I1IIIl[$IIIIII1III1I[1]] = $IIIIII1III1I[2];
}
}
$this->IIIII1I1Il1l = $this->IIIIIIIlIllI;
}
if ($this->IIIII1I1IlII) {
$this->debug('Persisting referer: '.$this->getRequestURL());
$this->IIIII1I1III1 = $this->getRequestURL();
}
if ($this->IIIII1I1IlI1) {
if (++$this->IIIII1I1Il1I >= $this->IIIII1I1IllI) {
$this->IIIII1I1Ill1 = 'Number of redirects exceeded maximum ('.$this->IIIII1I1IllI.')';
$this->debug($this->IIIII1I1Ill1);
$this->IIIII1I1Il1I = 0;
return false;
}
$location = isset($this->IIIIIIllI111['location']) ?$this->IIIIIIllI111['location'] : '';
$IIIIIlI11ll1 = isset($this->IIIIIIllI111['uri']) ?$this->IIIIIIllI111['uri'] : '';
if ($location ||$IIIIIlI11ll1) {
$IIIIIII1l1Il = parse_url($location.$IIIIIlI11ll1);
return $this->get($IIIIIII1l1Il['path']);
}
}
return true;
}
function buildRequest() {
$IIIIIIllI111 = array();
$IIIIIIllI111[] = "{$this->IIIIIIllI1l1} {$this->IIIIII1II1l1} HTTP/1.0";
$IIIIIIllI111[] = "Host: {$this->IIIIIIIlIllI}";
$IIIIIIllI111[] = "User-Agent: {$this->IIIII1I1II1I}";
$IIIIIIllI111[] = "Accept: {$this->IIIII1I1IIlI}";
if ($this->IIIII1I1II1l) {
$IIIIIIllI111[] = "Accept-encoding: {$this->IIIII1I1IIll}";
}
$IIIIIIllI111[] = "Accept-language: {$this->IIIII1I1IIl1}";
if ($this->IIIII1I1III1) {
$IIIIIIllI111[] = "Referer: {$this->IIIII1I1III1}";
}
if ($this->IIIII1I1IIIl) {
$cookie = 'Cookie: ';
foreach ($this->IIIII1I1IIIl as $IIIIIIIlI11I =>$IIIIIIIlI11l) {
$cookie .= "$IIIIIIIlI11I=$IIIIIIIlI11l; ";
}
$IIIIIIllI111[] = $cookie;
}
if ($this->IIIIIlI1l1ll &&$this->IIIIIlI1l1l1) {
$IIIIIIllI111[] = 'Authorization: BASIC '.base64_encode($this->IIIIIlI1l1ll.':'.$this->IIIIIlI1l1l1);
}
if ($this->IIIIIlIIIllI) {
$IIIIIIllI111[] = 'Content-Type: application/x-www-form-urlencoded';
$IIIIIIllI111[] = 'Content-Length: '.strlen($this->IIIIIlIIIllI);
}
$IIIII1I1I11I = implode("\r\n",$IIIIIIllI111)."\r\n\r\n".$this->IIIIIlIIIllI;
return $IIIII1I1I11I;
}
function getStatus() {
return $this->IIIIIII11I11;
}
function getContent() {
return $this->IIIIIIIl1II1;
}
function getHeaders() {
return $this->IIIIIIllI111;
}
function getHeader($IIIIIIl11I1l) {
$IIIIIIl11I1l = strtolower($IIIIIIl11I1l);
if (isset($this->IIIIIIllI111[$IIIIIIl11I1l])) {
return $this->IIIIIIllI111[$IIIIIIl11I1l];
}else {
return false;
}
}
function getError() {
return $this->IIIII1I1Ill1;
}
function getCookies() {
return $this->IIIII1I1IIIl;
}
function getRequestURL() {
$IIIIIII1l1Il = 'http://'.$this->IIIIIIIlIllI;
if ($this->IIIIIIlIIll1 != 80) {
$IIIIIII1l1Il .= ':'.$this->IIIIIIlIIll1;
}
$IIIIIII1l1Il .= $this->IIIIII1II1l1;
return $IIIIIII1l1Il;
}
function setUserAgent($IIIIIll1IIl1) {
$this->IIIII1I1II1I = $IIIIIll1IIl1;
}
function setAuthorization($IIIIIlI1l1ll,$IIIIIlI1l1l1) {
$this->IIIIIlI1l1ll = $IIIIIlI1l1ll;
$this->IIIIIlI1l1l1 = $IIIIIlI1l1l1;
}
function setCookies($IIIIII1l1l11) {
$this->IIIII1I1IIIl = $IIIIII1l1l11;
}
function useGzip($boolean) {
$this->IIIII1I1II1l = $boolean;
}
function setPersistCookies($boolean) {
$this->IIIII1I1II11 = $boolean;
}
function setPersistReferers($boolean) {
$this->IIIII1I1IlII = $boolean;
}
function setHandleRedirects($boolean) {
$this->IIIII1I1IlI1 = $boolean;
}
function setMaxRedirects($IIIIIIlI1llI) {
$this->IIIII1I1IllI = $IIIIIIlI1llI;
}
function setHeadersOnly($boolean) {
$this->IIIII1I1Illl = $boolean;
}
function setDebug($boolean) {
$this->IIIII1I1IlIl = $boolean;
}
function quickGet($IIIIIII1l1Il) {
$bits = parse_url($IIIIIII1l1Il);
$IIIIIIIlIllI = $bits['host'];
$IIIIIIlIIll1 = isset($bits['port']) ?$bits['port'] : 80;
$IIIIII1II1l1 = isset($bits['path']) ?$bits['path'] : '/';
if (isset($bits['query'])) {
$IIIIII1II1l1 .= '?'.$bits['query'];
}
$client = new HttpClient($IIIIIIIlIllI,$IIIIIIlIIll1);
if (!$client->get($IIIIII1II1l1)) {
return false;
}else {
return $client->getContent();
}
}
function quickPost($IIIIIII1l1Il,$IIIIIIIIIl11) {
$bits = parse_url($IIIIIII1l1Il);
$IIIIIIIlIllI = $bits['host'];
$IIIIIIlIIll1 = isset($bits['port']) ?$bits['port'] : 80;
$IIIIII1II1l1 = isset($bits['path']) ?$bits['path'] : '/';
$client = new HttpClient($IIIIIIIlIllI,$IIIIIIlIIll1);
if (!$client->post($IIIIII1II1l1,$IIIIIIIIIl11)) {
return false;
}else {
return $client->getContent();
}
}
function debug($IIIIIlIl1Ill,$object = false) {
if ($this->IIIII1I1IlIl) {
print '<div style="border: 1px solid red; padding: 0.5em; margin: 0.5em;"><strong>HttpClient Debug:</strong> '.$IIIIIlIl1Ill;
if ($object) {
ob_start();
print_r($object);
$IIIIIIIl1II1 = htmlentities(ob_get_contents());
ob_end_clean();
print '<pre>'.$IIIIIIIl1II1.'</pre>';
}
print '</div>';
}
}
}
?>