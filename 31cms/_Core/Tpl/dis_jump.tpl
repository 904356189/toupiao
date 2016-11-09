<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>跳转提示</title>
 
</head>
<body>
<div class="system-message">
	 
		<present name="message">		
		<div class="success"><img style="margin-right: 9px;padding-top:10px;" src="/Data/conf/images/success.png"><span><?php echo($message); ?></span></div>
		<else/>		
		<div class="error"><img style="margin-right: 9px;padding-top:10px;" src="/Data/conf/images/error.png" style="cursor:pointer;"><span style="padding-top:0px;"><?php echo($error); ?></div>
		</present>
	
	 
<p class="detail"></p>
<div class="jump" style="float:right;padding-right:5px;">
页面自动 <a id="href" href="<?php echo($jumpUrl); ?>">跳转</a> 等待时间： <b id="wait"><?php echo($waitSecond); ?></b>
</div>
</div>
<script type="text/javascript">
(function(){
var wait = document.getElementById('wait'),href = document.getElementById('href').href;
var interval = setInterval(function(){
	var time = --wait.innerHTML;
	if(time == 0) {
		 location.href = href;
		 
		clearInterval(interval);
	};
}, 1000);
})();
</script>
</body>
</html>