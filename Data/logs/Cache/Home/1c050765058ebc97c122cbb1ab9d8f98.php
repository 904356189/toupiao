<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html lang="zh-cn">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>微应用数字投票管理系统</title>
	<meta name="keywords" content="微平台投票系统" />
	<meta name="description" content="微平台投票管理系统，微平台投票管理系统是一款落地式的微信公众平台管理系统，是国内最完善的移动网站及移动互联网技术解决方案。" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="apple-mobile-web-app-capable" content="yes" />    
    
  <link href="/tpl/Home/default/style/css/style2.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="/tpl/Home/default/style/js/jquery1.6.js"></script>
<script src="/tpl/Home/default/style/js/cloud.js" type="text/javascript"></script>

<script language="javascript">
	$(function(){
    $('.loginbox').css({'position':'absolute','left':($(window).width()-692)/2});
	$(window).resize(function(){  
    $('.loginbox').css({'position':'absolute','left':($(window).width()-692)/2});
    })  
});  
</script> 
<style>
html{
overflow:hidden}
</style>

	<script type="text/javascript">
	if(navigator.appName == 'Microsoft Internet Explorer'){
		if(navigator.userAgent.indexOf("MSIE 5.0")>0 || navigator.userAgent.indexOf("MSIE 6.0")>0 || navigator.userAgent.indexOf("MSIE 7.0")>0) {
			alert('您使用的 IE 浏览器版本过低, 推荐使用 Chrome 浏览器或 IE8 及以上版本浏览器.');
		}
	}
	</script>
</head>










<body style="background-color:#1c77ac; background-image:url(/tpl/Home/default/style/images/img/light.png); background-repeat:no-repeat; background-position:center top; overflow:hidden;">


		<form action="<?php echo U('Users/checklogin');?>" method="post" enctype="multipart/form-data"  style="background:url(/tpl/Home/default/style/images/img/ybg.png) center center no-repeat"/>
    <div id="mainBody">
      <div id="cloud1" class="cloud"></div>
      <div id="cloud2" class="cloud"></div>
    </div>  


<div class="logintop" style="position:fixed">    
    <span>欢迎登录微信投票系统</span>    
    <ul>
    <li><a href="#">回首页</a></li>
   
    </ul>    
    </div>
    
    <div class="loginbody">
    
    <span class="systemlogo"></span> 
       
    <div class="loginbox">
    
    <ul style="margin-top:75px; float:left  ">
    <li style="margin-bottom:15px;"><span>用户名：</span><input type="text" name="username" id="username" value="" class="loginuser uname" /></li>
    <li style="margin-bottom:15px;"><span>密　码：</span>	<input type="password" name="password" id="password" value="" class="loginpwd pass" />
	</li>
	 
    
	<li>
	<input  type="submit"  class="loginbtn login_button" value="登录" style="float:left; margin-left:60px; display:inline"/><span style=" color:#FF0000; padding-left:10px;" class="error_msg"></span>
	

	</li>
    </ul>
    
    
    </div>
    
    </div>
    
    
    
    <div class="loginbm" style="left:0; position:fixed">版权所有© 2016　微应用企业级投票后台管理系统 </div>
	</form>
  <script type="text/javascript">
$('.login_button').click(function(){
	submit_data(this);
});
	
//回车键提交
document.onkeypress=function(e)
{
	　　var code;
	　　if  (!e)
	　　{
	　　		var e=window.event;
	　　}
	　　if(e.keyCode)
	　　{
	　　		code=e.keyCode;
	　　}
	　　else if(e.which)
	　　{
	　　		code   =   e.which;
	　　}
	　　if(code==13) //回车键
	　　{
			submit_data();
	　　}
}









</body>
</html>