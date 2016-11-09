<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
.img{
  width:80px;
  height:80px;
}
.img img{
	width:100%;
	display:block;

}
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
             <h4 class="left">投票报名审核<span class="FAQ"></span></h4>
              <div class="clr"></div><a href="<?php echo U('User/Vote/index');?>" class="right btn btn-primary btn_submit  J_ajax_submit_btn" style="margin-top:-27px">返回</a>
          </div>
          <div class="msgWrap">
          <form method="post" action="index.php?ac=vote-manage&amp;id=9878" id="info">
          <input name="delall" type="hidden" value="del">
           <input name="wxid" type="hidden" value="gh_423dwjkewad">
            <table class="ListProduct" border="0" cellspacing="0" cellpadding="0" width="100%">
              <thead>
                <tr>
					<th class="select">选择</th>
					<th>名称</th>
					<th>联系电话</th>
					<th>简介</th>
					<th>照片1</th>
					<th>照片2</th>
					<th>照片3</th>
					<th>照片4</th>
					<th class="time">报名时间</th>
					<th class="norightborder">操作</th>
                </tr>
              </thead>
              <tbody>
                <tr></tr>
                  <?php if(is_array($liinfo)): $i = 0; $__LIST__ = $liinfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><tr>
                  <td>  <input type="checkbox" name="del_id" value="<?php echo ($list["id"]); ?>" class="checkitem"></td>
                  <td><?php echo ($list["item"]); ?></td>
                  <td><?php echo ($list["tourl"]); ?></td>
                  <td><?php echo ($list["intro"]); ?></td>
				  <td class="img"><img src="<?php echo ($list["startpicurl"]); ?>"></td>
				   <td class="img"><?php if(!empty($list["startpicurl2"])): ?><img src="<?php echo ($list["startpicurl2"]); ?>"><?php endif; ?></td>
				    <td class="img"><?php if(!empty($list["startpicurl3"])): ?><img src="<?php echo ($list["startpicurl3"]); ?>"><?php endif; ?></td>
					 <td class="img"><?php if(!empty($list["startpicurl4"])): ?><img src="<?php echo ($list["startpicurl4"]); ?>"><?php endif; ?></td>
                  <td><?php echo (date('Y-m-d H:i:s',$list["addtime"])); ?></td>
                   <td class="norightborder">
				   <a href="javascript:;" onclick="ocheckshow(<?php echo ($list["id"]); ?>);" title="审核" name="ocheck" id="ocheck" class="btn btn-primary btn_submit  J_ajax_submit_btn">审核</a> 
				   <a href="javascript:;" onclick="delitem(<?php echo ($list["id"]); ?>)" class="btn btn-primary btn_submit  J_ajax_submit_btn">删除</a> 
                   </td>
                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
				  <tr>
				  <td><input type="checkbox" id="all_id" name="all_id" value="0" class="checkitem"></td>
				  <td><label for="all_id">全选</label></td>
				  <td></td><td></td><td></td><td></td><td></td><td></td><td></td>
				  <td><a href="javascript:;" onclick = "acheck('add')" title="全部审核" class="btn btn-primary btn_submit  J_ajax_submit_btn">全部审核</a>
				  <a href="javascript:;" onclick = "acheck('del')" title="全部审核" class="btn btn-primary btn_submit  J_ajax_submit_btn">全部删除</a> </td>
				  </tr>
              </tbody>
            </table>
           </form> 
		   <div id="checkit" style="display:none">
		     将本报名信息添加到<select id="selectvote" name="svote">
					 <?php if(is_array($lvinfo)): $i = 0; $__LIST__ = $lvinfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vlist): $mod = ($i % 2 );++$i;?><option value ="<?php echo ($vlist["id"]); ?>"><?php echo ($vlist["title"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
					</select>
		   </div>
		   <div id="checkall" style="display:none">
		     将本报名信息添加到<select id="allvote" name="avote">
					 <?php if(is_array($lvinfo)): $i = 0; $__LIST__ = $lvinfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$alist): $mod = ($i % 2 );++$i;?><option value ="<?php echo ($vlist["id"]); ?>"><?php echo ($alist["title"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
					</select>
		   </div>
		<div style="clear:both"></div>
		<div class="linkp"><?php echo ($page); ?></div>
	<script type="text/javascript">
	$(document).ready(function(){
		$("#all_id").change(function(){
		  var idval = $("#all_id").val()
		if(0 == idval){
		   $("#all_id").val(1);
			$("table :checkbox").attr("checked", true);  
		}
		else{
		   $("#all_id").val(0);
			$("table :checkbox").attr("checked", false);  		
		
		}
		
	
	});
});
	function ocheckshow(id){
	$("#checkit").dialog(
	 {
	 modal: true,
	 buttons: {
         "确定": function() {
		var vid = $("#selectvote").val();
		var submitData={
            vid : vid,
            id  : id,
        };		
		  $.post('index.php?g=User&m=Vote&a=check_vote', submitData, function(bakcdata) 
		  {
				var obj=eval('('+bakcdata+')');
					if(obj.success == 1)
						{
							alert('报名信息已加入');
							parent.location="javascript:location.reload()";
							return 0;
						}
					else
						{
							alert('报名信息添加失败，请再试');
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
function delitem(id) {
var result = confirm('您确定要删除此报名信息?');
if (!result){return false;}  
	var submitData={
            id  : id,
        };
        $.post("<?php echo U('Vote/del_item');?>", submitData,
            function(data) {
				var obj=eval('('+data+')');
				if(0 == obj.errno)
					{
					  		alert('信息删除成功');
							parent.location="javascript:location.reload()";
							return 0;
					}
				else{
				           alert("信息删除失败，请重试");
						   return 0;
				}
            });
}

function acheck(typ){
      var aid = new Array();
	  var i=0;
	      $("input[name='del_id']:checkbox").each(function(){ 
                if($(this).attr("checked")){
				  aid[i] = $(this).val(); 
				  i++;
                }
		});
	if(0 == aid.length){
	  alert("前先选择要添加的选项");
	  return false;
	}
	else{
	var id = aid.join(',');
	if('del' == typ){
	$("#checkall").text("确定要删除这些选项么？");
	}
		$("#checkall").dialog(
	 {
	 modal: true,
	 buttons: {
         "确定": function() {
		var vid = $("#allvote").val();
		var submitData={
            vid : vid,
            aid  : id,
			typ  :typ
        };			 
		  $.post('index.php?g=User&m=Vote&a=check_avote', submitData, function(bakcdata) 
		  {
				var obj=eval('('+bakcdata+')');
					if(obj.success == 1)
						{
							alert('报名信息已加入');
							parent.location="javascript:location.reload()";
							return 0;
						}
					else if(obj.success == 2){
							alert('信息删除成功');
							parent.location="javascript:location.reload()";
							return 0;
					}
					else
						{
							alert('报名信息添加失败，请再试');
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