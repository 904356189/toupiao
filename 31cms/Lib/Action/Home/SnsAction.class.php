<?php

class SnsAction extends BaseAction{
public function _initialize(){
parent::_initialize();
Vendor('Oauth.Oauth2.php');
}
public function login(){
define('BASEPATH','1');
$IIIIIIIlIIII=$this->_get('name');
$IIIIIII11I1I=C($IIIIIIIlIIII);
include realpath('YiCms/Extend/Vendor/Oauth/Oauth2.php');
$IIIIIII11I11=Oauth2::provider($IIIIIIIlIIII,$IIIIIII11I1I);
dump($IIIIIII11I11);
}
}?>