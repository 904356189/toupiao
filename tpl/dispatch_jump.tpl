<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>跳转提示</title>
    <style type="text/css">
        .message{ position:absolute; left:50%; top:50%; width:650px; height:200px; margin:-150px 0 0 -325px; background-color: transparent;background-color: rgba(0, 0, 0, 0.2); filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=#33000000,endColorstr=#33000000); zoom: 1;}
	    .systips_detail{ height:240px; box-shadow:0 0 20px rgba(0,0,0,.2); line-height:30px; background:#fff; color:#666; border:1px solid #ccc; padding:50px 20px 10px;}
		a{color:#333}
		a:hover{color:#333}
		.z{ margin-top:-40px; width:150px; height:150px; float:left;background:#fff url({iMicms::C('site_url')}/tpl/tipsicon.gif) no-repeat left -150px;}
		.c{ margin-top:-40px; width:150px; height:150px; float:left;background:#fff url({iMicms::C('site_url')}/tpl/tipsicon.gif) no-repeat left -450px;}
		.tip_title{font-size:18px; padding:10px 0; font-weight:bold; text-align:left; color:#333; border-bottom:1px solid #ccc; font-family:"微软雅黑";}
		.spantext{font-size:36px;font-family:"微软雅黑"; font-weight:bold; line-height:40px;}
		.tip_messages{margin-top:40px;}
    </style>
</head>
<body>
<div style="width:500px; height:300px; margin-top:30px; margin-left: auto;
margin-right: auto; text-align:center;">
    <div class="systips animated bounceIn">
        <div class="systips_detail">
		<div style="margin-top:-30px;">
            <div class="tip_title">操作提示</div>
            <div class="tip_messages">
			<present name="message">
			<div class="success">
			<div class="z"></div>
			<span class="spantext"><?php echo($message); ?></span>
			</div>
			<else/>		
			<div class="error">
			<div class="c"></div>
			<span class="spantext"><?php echo($error); ?></span>
			</div>
			</present>
			</div>
			</div>
			<div style="float:right; margin-right:10px; margin-top:65px;">
			本页<span id="wait" style="font-weight:bold;"><?php echo($waitSecond +1);?></span>秒后将自动<a id="href" href="<?php echo($jumpUrl); ?>">跳转</a></div>
		</div>
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