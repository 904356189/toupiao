<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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

	<script src="<?php echo STATICS;?>/jquery-ui.js" type="text/javascript"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo STATICS;?>/jquery-ui.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo STATICS;?>/jquery-ui.theme.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo STATICS;?>/jquery-ui.structure.css" />
<style>
	.linkp{
list-style-type:none;
margin-right:130px;
text-align:right;
color:red;
letter-spacing:5px;
}
.linkp a{
color:#000;
}
.linkp li a{
letter-spacing:2px;
}
.linkp .total{
float:right;
}
</style>
<div class="content">
         
          <div class="cLineB">
             <h4 class="left">锁定管理<span class="FAQ"></span></h4>
              <div class="clr"></div>
			  <a href="<?php echo U('User/Vote/index');?>" class="right btn btn-primary btn_submit  J_ajax_submit_btn" style="margin-top:-27px">返回</a>
			  <a href="javascript:" onclick="lockall(<?php echo ($vid); ?>)" class="right btn btn-primary btn_submit  J_ajax_submit_btn" style="margin-top:-27px;margin-right:20px;">全部锁定</a>
			  <form action="" method="post" >
			  <input type="submit" value="搜索" class="right btn btn-primary btn_submit  J_ajax_submit_btn" style="margin-top:-27px;margin-right:40px;">  <input type="text" name="searchitem" class="right" style="margin-top:-27px;margin-right:8px;height:40px;" placeholder="请输入选手编号或姓名">
			  <input type="hidden" name="vid" value="<?php echo ($vid); ?>">
			  </form>
          </div>
          <div class="msgWrap">
          <form method="post" action="index.php?ac=vote-manage&amp;id=9878" id="info">
            <table class="ListProduct" border="0" cellspacing="0" cellpadding="0" width="100%">
              <thead>
                <tr>
					<th>序号</th>
					<th>名称</th>
					<th>票数</th>
					<th>联系电话</th>
					<th class="time">报名时间</th>
					<th class="norightborder">操作</th>
                </tr>
              </thead>
              <tbody>
                <tr></tr>
                  <?php if(is_array($liinfo)): $i = 0; $__LIST__ = $liinfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><tr>
                  <td> <?php echo ($list["id"]); ?></td>
                  <td><?php echo ($list["item"]); ?></td>
				   <td><?php echo ($list["vcount"]); ?></td>
                  <td><?php echo ($list["tourl"]); ?></td>
                  <td><?php echo (date('Y-m-d',$list["addtime"])); ?></td>
                   <td class="norightborder">
				   <a href="javascript:;" onclick="" att="<?php echo ($list["id"]); ?>"  vid="<?php echo ($list["vid"]); ?>" arr="<?php echo ($list["status"]); ?>"  name="onlock" id="onlock" class="btn btn-primary btn_submit  J_ajax_submit_btn">
				    <?php if($list["status"] == 1): ?>锁定<?php else: ?>解锁<?php endif; ?>
					</a> 
				   <a href="javascript:;" onclick="" con="<?php echo ($list["lockinfo"]); ?>" att="<?php echo ($list["id"]); ?>" name="lockmsg" id="lockmsg" <?php if(1 == $list['status']){?> style="display:none"<?php }?> class="btn btn-primary btn_submit  J_ajax_submit_btn">
				    投票回复
					</a> 
                   </td>
                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
              </tbody>
            </table>
           </form> 
		   <div id="checkit" style="display:none;width:100%;">
			 <input type="text" id="msgtext" size="30" class="msgtext" style="width:80%;" >
		   </div>
		   	<div id="checkall" style="display:none;width:100%;">
			 <input type="text" id="msgall" size="30" class="msgall" style="width:80%;" >
		   </div>
		<div style="clear:both"></div>
		<div class="linkp"><?php echo ($page); ?></div>
	<script type="text/javascript">
	$(document).ready(function(){
       $("a[name='onlock']").click(function(){
	    var id= $(this).attr('att');
		var s = $(this).attr('arr');
		var vid = $(this).attr('vid');
		var msg ;
		if(1 == s){
		  msg ="确定要锁定该用户么？ 锁定后无法再投票";
		}
		if(2 == s){
		  msg ="确定要解锁该用户么？";
		}
		var statu = confirm(msg);
        if(!statu){
            return false;
        }
		else{	
				onlock(id,s,vid);
		}
	   });
	 $("a[name='lockmsg']").click(function(){
		 var id= $(this).attr('att');
		var content = $(this).attr('con');
		$('#msgtext').val(content);
		$("#checkit").dialog(
		{
		modal: true,
		title:"投票回复信息",
		buttons: {
			"确定": function() {
			var msg = $("#msgtext").val();
			var submitData={
				msg : msg,
				id  : id,
			};		
			$.post('index.php?g=User&m=Vote&a=lock_msg', submitData, function(bakcdata) 
			{
					var obj=eval('('+bakcdata+')');
						if(obj.success == 1)
							{
								alert(obj.msg);
								parent.location="javascript:location.reload()";
								return 0;
							}
						else
							{
								alert(obj.msg);
								return false;
							}  
				});
				$(this).dialog('close');
			},
			"取消": function() {
				$(this).dialog('close');
			}
		}
		});
	 
	 });
});
	function onlock(id,s,vid){
		var submitData={
            vid : vid,
            id  : id,
			s   : s
        };		
		  $.post('index.php?g=User&m=Vote&a=lock_vote', submitData, function(bakcdata) 
		  {
				var obj=eval('('+bakcdata+')');
					if(obj.success == 1)
						{
							alert(obj.msg);
							parent.location="javascript:location.reload()";
							return 0;
						}
					else
						{
							alert('操作失败，请稍后再试');
							return false;
						}  
		  	 });
	}
	function lockall(d){
	 if(!confirm("确定要全部锁定么？"))
		{
			return false;
		}
		$("#checkall").dialog(
		{
		modal: true,
		title:"请设置锁定后投票回复信息",
		buttons: {
			"确定": function() {
			var msg = $("#msgall").val();
			var submitData={
				msg : msg,
				id  : d,
			};		
			$.post('index.php?g=User&m=Vote&a=lockall', submitData, function(bakcdata) 
			{
					var obj=eval('('+bakcdata+')');
						if(obj.success == 1)
							{
								alert(obj.msg);
								parent.location="javascript:location.reload()";
								return 0;
							}
						else
							{
								alert(obj.msg);
								return false;
							}  
				});
				$(this).dialog('close');
			},
			"取消": function() {
				$(this).dialog('close');
			}
		}
		});
	
	}

 </script>
   </div> 
          <div class="cLine">
            <div class="pageNavigator right">
                 <div class="pages"></div>
              </div>
            <div class="clr"></div>
          </div>
  </div>
<div style="display:none">
<link href="tpl/static/simpleboot/themes/flat/theme.min.css" rel="stylesheet">
</div>