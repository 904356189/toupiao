<?php if (!defined('THINK_PATH')) exit();?> <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>微信投票管理系统</title>
	<meta name="keywords" content="微信投票管理系统" />
	<meta name="description" content="微信投票管理系统" />
<meta http-equiv="MSThemeCompatible" content="Yes" />
<script>var SITEURL='';</script>
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/style_2_common.css?BPm" />
<link href="<?php echo RES;?>/css/style.css" rel="stylesheet" type="text/css" />
<link href="<?php echo RES;?>/css/stylet.css" rel="stylesheet" type="text/css" />
<link href="<?php echo STATICS;?>/simpleboot/themes/flat/theme.min.css" rel="stylesheet">

<script src="<?php echo RES;?>/js/common.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo RES;?>/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo RES;?>/js/main.js"></script>
<script type="text/javascript" src="<?php echo RES;?>/js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="<?php echo RES;?>/js/global.js"></script>
  <link rel="stylesheet" href="<?php echo RES;?>/css/cymain.css" />
  <link rel="stylesheet" href="<?php echo STATICS;?>/kindeditor/themes/default/default.css" />
<script src="<?php echo STATICS;?>/upyun.js"></script>

<script src="<?php echo STATICS;?>/artDialog/jquery.artDialog.js?skin=default"></script>

<script src="<?php echo STATICS;?>/artDialog/plugins/iframeTools.js"></script>

<link rel="stylesheet" href="<?php echo STATICS;?>/kindeditor/plugins/code/prettify.css" />



<script src="<?php echo STATICS;?>/kindeditor/kindeditor.js" type="text/javascript"></script>



<script src="<?php echo STATICS;?>/kindeditor/lang/zh_CN.js" type="text/javascript"></script>



<script src="<?php echo STATICS;?>/kindeditor/plugins/code/prettify.js" type="text/javascript"></script>

<script>
var editor;
KindEditor.ready(function(K) {
editor = K.create('#content2', {
resizeType : 1,
allowPreviewEmoticons : false,
allowImageUpload : true,
uploadJson : '/index.php?g=User&m=Upyun&a=kindedtiropic',
items : [
        'source', '|', 'undo', 'redo', '|', 'preview', 'print', 'template', 'code', 'cut', 'copy', 'paste',
        'plainpaste', 'wordpaste', '|', 'justifyleft', 'justifycenter', 'justifyright',
        'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript',
        'superscript', 'clearhtml', 'quickformat', 'selectall', '|', 'fullscreen', '/',
        'formatblock', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold',
        'italic', 'underline', 'strikethrough', 'lineheight', 'removeformat', '|', 'image', 'multiimage',
        'flash', 'media', 'insertfile', 'table', 'hr', 'emoticons', 'baidumap', 'pagebreak',
        'anchor', 'link', 'unlink', '|', 'about'
],
afterBlur: function(){this.sync();}
});
});
</script>
<script>
var editor;
KindEditor.ready(function(K) {
editor = K.create('#content1', {
resizeType : 1,
allowPreviewEmoticons : false,
allowImageUpload : true,
uploadJson : '/index.php?g=User&m=Upyun&a=kindedtiropic',
items : [
        'source', '|', 'undo', 'redo', '|', 'preview', 'print', 'template', 'code', 'cut', 'copy', 'paste',
        'plainpaste', 'wordpaste', '|', 'justifyleft', 'justifycenter', 'justifyright',
        'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript',
        'superscript', 'clearhtml', 'quickformat', 'selectall', '|', 'fullscreen', '/',
        'formatblock', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold',
        'italic', 'underline', 'strikethrough', 'lineheight', 'removeformat', '|', 'image', 'multiimage',
        'flash', 'media', 'insertfile', 'table', 'hr', 'emoticons', 'baidumap', 'pagebreak',
        'anchor', 'link', 'unlink', '|', 'about'
],
afterBlur: function(){this.sync();}
});
});
</script>
<script>
var editor;
KindEditor.ready(function(K) {
editor = K.create('#content', {
resizeType : 1,
allowPreviewEmoticons : false,
allowImageUpload : true,
uploadJson : '/index.php?g=User&m=Upyun&a=kindedtiropic',
items :[
        'source', '|', 'undo', 'redo', '|', 'preview', 'print', 'template', 'code', 'cut', 'copy', 'paste',
        'plainpaste', 'wordpaste', '|', 'justifyleft', 'justifycenter', 'justifyright',
        'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript',
        'superscript', 'clearhtml', 'quickformat', 'selectall', '|', 'fullscreen', '/',
        'formatblock', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold',
        'italic', 'underline', 'strikethrough', 'lineheight', 'removeformat', '|', 'image', 'multiimage',
        'flash', 'media', 'insertfile', 'table', 'hr', 'emoticons', 'baidumap', 'pagebreak',
        'anchor', 'link', 'unlink', '|', 'about'
],
afterBlur: function(){this.sync();}
});
});
</script>
<script>
var editor;
KindEditor.ready(function(K) {
editor = K.create('#intro', {
resizeType : 1,
allowPreviewEmoticons : false,
allowImageUpload : true,
uploadJson : '/index.php?g=User&m=Upyun&a=kindedtiropic',
items : [
'source','undo','clearhtml','hr',
'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
'insertunorderedlist', '|', 'emoticons','fontname', 'fontsize','forecolor','hilitecolor','bold','image','link', 'unlink','baidumap','lineheight','table','anchor','preview','print','template','code','cut', 'music', 'video','map'],
afterBlur: function(){this.sync();}
});
});
</script>
<script>
var editor;
KindEditor.ready(function(K) {
editor = K.create('#qtxinxi', {
resizeType : 1,
allowPreviewEmoticons : false,
allowImageUpload : true,
uploadJson : '/index.php?g=User&m=Upyun&a=kindedtiropic',
items : [
'source', '|', 'undo', 'redo', '|', 'preview', 'print', 'template', 'code', 'cut', 'copy', 'paste',
        'plainpaste', 'wordpaste', '|', 'justifyleft', 'justifycenter', 'justifyright',
        'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript',
        'superscript', 'clearhtml', 'quickformat', 'selectall', '|', 'fullscreen', '/',
        'formatblock', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold',
        'italic', 'underline', 'strikethrough', 'lineheight', 'removeformat', '|', 'image', 'multiimage',
        'flash', 'media', 'insertfile', 'table', 'hr', 'emoticons', 'baidumap', 'pagebreak',
        'anchor', 'link', 'unlink', '|', 'about'],
afterBlur: function(){this.sync();}
});
});
</script>


<style>
.content {
 background:none; margin-left:30px; margin-top:20px; border:none; margin-bottom:30px;
}
</style>
</head>

<body>

 <style>
.CC_table{ border-top:2px solid #abd2f3;  width:100%; line-height:26px; font-size:14px; border-collapse:collapse;}
.CC_table th{background:#f5f5f5; border-bottom:1px dashed #ccc; padding:0 12px; color:#333;  font-weight:bold; }
.CC_table td{ border-bottom:1px dashed #ccc; padding-left:6px;height:50px;}
 </style>
<div class="content" style="margin-left:20px; height:400px">
<link href="<?php echo RES;?>/css/style.css?id=100" rel="stylesheet" type="text/css" />
          <div class="cLineB"><h4>投票设置</h4><a href="<?php echo U('User/Vote/index');?>" class="right btn btn-primary btn_submit  J_ajax_submit_btn" style="margin-top:-27px">返回</a></div>
          <form method="post" action="" enctype="multipart/form-data">
          <div class="msgWrap">
            <table class="CC_table" border="0" cellspacing="0" cellpadding="0" width="100%" >
              <tbody>
				<!-- <tr>
                	<th>&nbsp;&nbsp;&nbsp;&nbsp;<span class="red">*</span>活动名称</th>
                	<td><input type="text" class="px"  value="<?php echo ($info['tel']); ?>" name="tel">　请输入您的活动名称</td>
                </tr>
				 -->
				  <tr>  
                	<th>&nbsp;&nbsp;&nbsp;&nbsp;<span class="red">*</span>每页显示作品数</th>
                	<td><input type="text" class="px"  value="<?php echo ($info['myzps']); ?>" name="myzps">&nbsp&nbsp&nbsp&nbsp一般设置为12或16等，设置数字过大会影响打开速度。</td>
                </tr>
                  	<tr>
                	<th >&nbsp;&nbsp;&nbsp;&nbsp;<span class="red">*</span>开启自动上传图床</th>
                	<td><input type="radio" class="px" <?php if(($info["tuchuang"]) == "1"): ?>checked<?php endif; ?> name="tuchuang" onclick="javascript:document.getElementById('tuc').style.display ='';" value="1">　开启
					 &nbsp&nbsp&nbsp&nbsp	<input type="radio" class="px" <?php if(($info["tuchuang"]) == "0"): ?>checked<?php endif; ?> name="tuchuang" onclick="javascript:document.getElementById('tuc').style.display ='none';" value="0">　关闭</td>
                </tr>
			 
				<tr id="tuc" style='display:<?php if ($info["tuchuang"]==1){echo "";}else{echo "none";} ?>;'> 
                	<th>&nbsp;&nbsp;&nbsp;&nbsp;<span class="red">*</span>图床接口信息</th>
                	<td>
					AccessKey:<input type="text" class="px"  value="<?php echo ($info['tuaccesskey']); ?>" name="tuaccesskey">　
					SecretKey:<input type="text" class="px"  value="<?php echo ($info['tusecretkey']); ?>" name="tusecretkey">　
					相册ID:<input type="text" class="px"  value="<?php echo ($info['tupicid']); ?>" name="tupicid">　
					
					</td>
                </tr>
				
				<tr>
                	<th>&nbsp;&nbsp;&nbsp;&nbsp;<span class="red">*</span>开启多说评论</th>
                	<td><input type="radio" class="px" <?php if(($info["duoshuo"]) == "1"): ?>checked<?php endif; ?> name="duoshuo" onclick="javascript:document.getElementById('duos').style.display ='';" value="1">　开启
					 &nbsp&nbsp&nbsp&nbsp	<input type="radio" class="px" <?php if(($info["duoshuo"]) == "0"): ?>checked<?php endif; ?> name="duoshuo" onclick="javascript:document.getElementById('duos').style.display ='none';" value="0">　关闭</td>
                </tr>
			 
				<tr id="duos" style='display:<?php if ($info["duoshuo"]==1){echo "";}else{echo "none";} ?>;'> 
                	<th>&nbsp;&nbsp;&nbsp;&nbsp;<span class="red">*</span>注册多说设置的域名</th>
                	<td>
					<input type="text" class="px"  value="<?php echo ($info['duoshuourl']); ?>" name="duoshuourl">&nbsp&nbsp&nbsp&nbsp(打开此网站注册：<a href="http://duoshuo.com/create-site/" target=_blank>http://duoshuo.com</a>)　
								
					</td>
                </tr>
                    <tr>  
                	<th>&nbsp;&nbsp;&nbsp;&nbsp;<span class="red">*</span>广告幻灯高度设置</th>
                	<td><input type="text" class="px"  value="<?php echo ($info['hdgd']); ?>" name="hdgd"></td>
                </tr>
				<tr>
                	<th>&nbsp;&nbsp;&nbsp;&nbsp;<span class="red">*</span>公众号回复编号投票</th>
                	<td><input type="radio" class="px" <?php if(($info["hftp"]) == "1"): ?>checked<?php endif; ?> name="hftp" value="1">开启
					 &nbsp&nbsp&nbsp&nbsp	<input type="radio" class="px" <?php if(($info["hftp"]) == "0"): ?>checked<?php endif; ?> name="hftp" value="0">关闭</td>
                </tr>
				<tr>
                	<th>&nbsp;&nbsp;&nbsp;&nbsp;<span class="red">*</span>投票限制模式</th>
                	<td><input type="radio" class="px" <?php if(($info["tpxzmos"]) == "1"): ?>checked<?php endif; ?> name="tpxzmos" value="1">按天为单位限制
					 &nbsp&nbsp&nbsp&nbsp	<input type="radio" class="px" <?php if(($info["tpxzmos"]) == "0"): ?>checked<?php endif; ?> name="tpxzmos" value="0" >按活动期为单位限制 &nbsp&nbsp&nbsp&nbsp (设置按天或是按活动投票)</td>
                </tr>

              <tr>
                	<th>&nbsp;&nbsp;&nbsp;&nbsp;<span class="red">*</span>每个微信号同作品限1票</th>
                	<td><input type="radio" class="px" <?php if(($info["xz1p"]) == "1"): ?>checked<?php endif; ?> name="xz1p" value="1">开启
					 &nbsp&nbsp&nbsp&nbsp	<input type="radio" class="px" <?php if(($info["xz1p"]) == "0"): ?>checked<?php endif; ?> name="xz1p" value="0">关闭&nbsp&nbsp&nbsp&nbsp(开启后每个微信用户限制期间对于每个作品只能投一票！)</td>
                </tr>
               <tr>
                	<th>&nbsp;&nbsp;&nbsp;&nbsp;<span class="red">*</span>作品图片上传数限制</th>
                	<td><input type="text" class="px"  value="<?php echo ($info['picnum']); ?>" name="picnum"></td>
                </tr>
				<!-- <tr> 
                	<th>&nbsp;&nbsp;&nbsp;&nbsp;<span class="red">*</span>公众号</th>
                	<td><input type="text" class="px"  value="<?php echo ($info['gongzhong']); ?>" name="gongzhong">　请输入您的公众号</td>
                </tr> -->
				
               <tr>
                	<th>&nbsp;&nbsp;&nbsp;&nbsp;<span class="red">*</span>是否开启投票验证码</th>
                	<td><input type="radio" class="px" <?php if(($info["yzm"]) == "1"): ?>checked<?php endif; ?> name="yzm" onclick="javascript:document.getElementById('yzm').style.display ='';" value="1">　开启
					 &nbsp&nbsp&nbsp&nbsp	<input type="radio" class="px" <?php if(($info["yzm"]) == "0"): ?>checked<?php endif; ?> name="yzm" onclick="javascript:document.getElementById('yzm').style.display ='none';" value="0">　关闭</td>
                </tr>
			 
				<tr id="yzm" style='display:<?php if ($info["yzm"]==1){echo "";}else{echo "none";} ?>;'> 
                	<th>&nbsp;&nbsp;&nbsp;&nbsp;<span class="red">*</span>验证码ID</th>
                	<td>
					<input type="text" class="px"  value="<?php echo ($info['yzmid']); ?>" name="yzmid">　&nbsp&nbsp&nbsp&nbsp
					(注册账号后获取的ID,打开此网站注册：<a href="http://user.geetest.com" target=_blank>http://user.geetest.com</a>)			
					</td>
                </tr>
              
			   <tr>
                	<th>&nbsp;&nbsp;&nbsp;&nbsp;<span class="red"></span>限制区域投票</th>
                	<td><input type="radio" class="px" <?php if(($info["xzlx"]) == "1"): ?>checked<?php endif; ?> name="xzlx" onclick="javascript:document.getElementById('xzlx').style.display ='';" value="1">按省限制
					 &nbsp&nbsp&nbsp&nbsp<input type="radio" class="px" <?php if(($info["xzlx"]) == "2"): ?>checked<?php endif; ?> name="xzlx" onclick="javascript:document.getElementById('xzlx').style.display ='';" value="2">按市限制
					 &nbsp&nbsp&nbsp&nbsp	<input type="radio" class="px" <?php if(($info["xzlx"]) == "0"): ?>checked<?php endif; ?> name="xzlx" onclick="javascript:document.getElementById('xzlx').style.display ='none';" value="0">关闭&nbsp&nbsp&nbsp&nbsp(开启后只有输入区域的IP才能投票,3G 4G网络IP存在不确定性请知晓！)</td>
                </tr>
                <tr id="xzlx" style='display:<?php if ($info["xzlx"]==1 || $info["xzlx"]==2 ){echo "";}else{echo "none";} ?>;'> 
                	<th>&nbsp;&nbsp;&nbsp;&nbsp;<span class="red">*</span>限制区域</th>
                	<td>
					<input type="text" class="px"  value="<?php echo ($info['area']); ?>" name="area">　&nbsp&nbsp&nbsp&nbsp
					(输入要限制的省或市，请以英文的逗号隔开。)			
					</td>
                </tr>
				  <tr>
                	<th>&nbsp;&nbsp;&nbsp;&nbsp;<span class="red"></span>开启刷票警告锁定</th>
                	<td><input type="radio" class="px" <?php if(($info["spxz"]) == "1"): ?>checked<?php endif; ?> name="spxz" onclick="javascript:document.getElementById('spxz').style.display ='';document.getElementById('spxz2').style.display ='';" value="1">开启
					 &nbsp&nbsp&nbsp&nbsp<input type="radio" class="px" <?php if(($info["spxz"]) == "0"): ?>checked<?php endif; ?> name="spxz" onclick="javascript:document.getElementById('spxz').style.display ='none';document.getElementById('spxz2').style.display ='none';" value="0">关闭&nbsp&nbsp&nbsp&nbsp(开启后当投票量在一定的时间内达到设定的值后会警告或锁定选手!)</td>
                </tr>
				 <tr id="spxz" style='display:<?php if ($info["spxz"]==1){echo "";}else{echo "none";} ?>;'> 
                	<th>&nbsp;&nbsp;&nbsp;&nbsp;<span class="red">*</span>警告规则</th>
                	<td><br>
					当<input type="text" class="px"  value="<?php echo ($info['jgfen']); ?>" name="jgfen" style="width:40px">分钟的投票量超过<input type="text" class="px"  value="<?php echo ($info['jgpiao']); ?>" name="jgpiao" style="width:40px">票时警告选手。<br> 
					报警发送给选手的信息内容：<input type="text" name="jgtext" value="<?php echo ($info['jgtext']); ?>" style="width:800px">
					<br>(当满足以上设置的条件时会通过微信公众号向此选手微信发送以上报警信息内容，用以警告选手。)		
					</td>
                </tr>
				<tr id="spxz2" style='display:<?php if ($info["spxz"]==1){echo "";}else{echo "none";} ?>;'> 
                	<th>&nbsp;&nbsp;&nbsp;&nbsp;<span class="red">*</span>自动锁定规则</th>
                	<td><br>
					当<input type="text" class="px"  value="<?php echo ($info['sdfen']); ?>" name="sdfen" style="width:40px">分钟的投票量超过<input type="text" class="px"  value="<?php echo ($info['sdpiao']); ?>" name="sdpiao" style="width:40px">票时自动锁定选手。<br> 
					锁定发送给选手的信息内容：<input type="text" name="sdtext" value="<?php echo ($info['sdtext']); ?>" style="width:800px">
					
					<br>(当满足以上设置的条件时会通过微信公众号向此选手微信发送以上信息内容，选手锁定后，只能浏览，但不能投票，只有在后台解锁后才可以继续投票。)		
					</td>
                </tr>
				<tr>
                	<th>&nbsp;&nbsp;&nbsp;&nbsp;<span class="red">*</span>引导用户关注的标题</th>
                	<td><input type="text" class="px"  value="<?php echo ($info['ydgzbt']); ?>" name="ydgzbt">&nbsp&nbsp&nbsp&nbsp(未关注用户点击投票或者报名跳出的提示标题）</td>
                </tr>
				<tr>
                	<th>&nbsp;&nbsp;&nbsp;&nbsp;<span class="red">*</span>引导用户关注按钮名称</th>
                	<td><input type="text" class="px"  value="<?php echo ($info['ydgzan']); ?>" name="ydgzan">&nbsp&nbsp&nbsp&nbsp(未关注用户点击投票或者报名跳出的提示下方的关注链接按钮）</td>
                </tr>
				<tr>

				<tr>
                	<th>&nbsp;&nbsp;&nbsp;&nbsp;<span class="red">*</span>页面右下角菜单名称:</th>
                	<td><input type="text" class="px"  value="<?php echo ($info['dbdhm']); ?>" name="dbdhm">&nbsp&nbsp&nbsp&nbsp(页面右下角菜单名称）</td>
                </tr>
				<tr>

				<tr>
                	<th>&nbsp;&nbsp;&nbsp;&nbsp;<span class="red">*</span>页面右下角菜单链接</th>
                	<td><input type="text" class="px"  value="<?php echo ($info['dbdhurl']); ?>" name="dbdhurl">&nbsp&nbsp&nbsp&nbsp(页面右下角菜单链接）</td>
                </tr> 
				<tr>
				 <tr>
                	<th>&nbsp;&nbsp;&nbsp;&nbsp;<span class="red">*</span>开启投票者奖励</th>
                	<td><input type="radio" class="px" <?php if(($info["tpjl"]) == "1"): ?>checked<?php endif; ?> name="tpjl" onclick="javascript:document.getElementById('tpjl').style.display ='';document.getElementById('tpjl2').style.display ='';" value="1">　开启
					 &nbsp&nbsp&nbsp&nbsp	<input type="radio" class="px" <?php if(($info["tpjl"]) == "0"): ?>checked<?php endif; ?> name="tpjl" onclick="javascript:document.getElementById('tpjl').style.display ='none';document.getElementById('tpjl2').style.display ='none';" value="0">　关闭</td>
                </tr>
				<tr id="tpjl" <?php if(empty($info["tpjl"])): ?>style="display:none;"<?php endif; ?> >
                	<th>&nbsp;&nbsp;&nbsp;&nbsp;<span class="red">*</span>每次投票奖励积分数:</th>
                	<td><input type="text" class="px"  value="<?php echo ($info['tpjlnum']); ?>" name="tpjlnum">&nbsp&nbsp&nbsp&nbsp(投一票获取积分数，积分可以用来参与抽奖）</td>
                </tr>
				<tr>
				<tr id="tpjl2" <?php if(empty($info["tpjl"])): ?>style="display:none;"<?php endif; ?> >
                	<th>&nbsp;&nbsp;&nbsp;&nbsp;<span class="red">*</span>选择所关联抽奖活动:</th>
                	<td>
					<select name="gldzpid">
                    <?php if(!empty($lottery)): if(is_array($lottery)): $i = 0; $__LIST__ = $lottery;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value=<?php echo ($vo["id"]); ?> <?php if(($vo["id"]) == $info["gldzpid"]): ?>selected<?php endif; ?> > <?php echo ($vo["title"]); ?> </option><?php endforeach; endif; else: echo "" ;endif; ?>
                    <?php else: ?>
					<option> 没有创建大转盘活动，请到大转盘管理里添加抽奖活动</option><?php endif; ?>
					</select>
					&nbsp&nbsp&nbsp&nbsp(选择所关联抽奖活动）</td>
                </tr>
				<tr>


                	<th>&nbsp;&nbsp;&nbsp;&nbsp;<span class="red">*</span>公众号appid</th>
                	<td><input type="text" class="px"  value="<?php echo ($diymen['appid']); ?>" name="appid">&nbsp&nbsp&nbsp&nbsp(去你的公众号后台开发者中心找。)</td>
                </tr> 
				<tr>
                	<th>&nbsp;&nbsp;&nbsp;&nbsp;<span class="red">*</span>公众号appsecret</th>
                	<td><input type="text" class="px"  value="<?php echo ($diymen['appsecret']); ?>" name="appsecret">&nbsp&nbsp&nbsp&nbsp(去你的公众号后台开发者中心找。)</td>
                </tr> 
				<!-- <tr>

                	<th>&nbsp;&nbsp;&nbsp;&nbsp;<span class="red">*</span>公众号二维码图片</th>
                	<td><input type="text" name="picurl" id="picurl" value="<?php echo ($info["qrimg"]); ?>" class="px" ">
						<a href="#" onclick="upyunPicUpload('picurl',700,400,'<?php echo ($token); ?>')" class="btn btn-primary btn_submit  J_ajax_submit_btn">上传</a>
					</td>
                </tr>
				<tr>
                	<th>&nbsp;&nbsp;&nbsp;&nbsp;<span class="red">*</span>关注回复</th>
                	<td><input type="text" class="px"  value="<?php echo ($rep['content']); ?>" name="content">关注您的公众账号后回复的内容（默认不需要改动）</td>
                </tr>
				<tr>
                	<th>&nbsp;&nbsp;&nbsp;&nbsp;<span class="red">*</span>关注地址</th>
                	<td><input type="text" class="px"  value="<?php echo ($info['email']); ?>" name="email">请输入您的公众号一键关注的链接</td>
                </tr>-->
                 <tr>
                 	<th></th>
                 	<td><button type="submit" name="button" class="btn btn-primary btn_submit  J_ajax_submit_btn">保存</button></td>
                 	</tr> 
              </tbody>
            </table>
            
          </div>
          </form>
          
        </div>



  <!--底部-->
  	</div><div style="display:none">
<link href="tpl/static/simpleboot/themes/flat/theme.min.css" rel="stylesheet">
</div>