<?php
header("Content-type: text/html; charset=utf-8");
date_default_timezone_set('PRC');
if (get_magic_quotes_gpc()) {
 function stripslashes_deep($value){
  $value = is_array($value) ?
  array_map('stripslashes_deep', $value) :
  stripslashes($value);
  return $value;
 }
 $_REQUEST = array_map('stripslashes_deep', $_REQUEST);
 $_POST = array_map('stripslashes_deep', $_POST);
 $_GET = array_map('stripslashes_deep', $_GET);
 $_COOKIE = array_map('stripslashes_deep', $_COOKIE);
}
//require('./360_safe3.php');
define('CVS_ROOT', str_replace("\\", '/', dirname(__FILE__)));
define('APP_DEBUG',1);
define('APP_NAME', '31cms');
define('CONF_PATH','./Data/conf/');
define('RUNTIME_PATH','./Data/logs/');
define('TMPL_PATH','./tpl/');
define('HTML_PATH','./Data/html/');
define('APP_PATH','./31cms/');
define('CORE','./31cms/_Core');
 
require(CORE.'/iMicms.php');