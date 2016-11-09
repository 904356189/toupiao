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
.countadd{
margin-top:-10px;
}
label{
display:inline;
}
.linkp{
list-style-type:none;
margin-right:30px;
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
             <h4 class="left">投票选手管理  (共报名<?php echo ($count); ?>个选手) <span class="FAQ"></span></h4>
              <div class="clr"></div>	
			  
         

              <a href="<?php echo U('User/Vote/index');?>" class="right btn btn-primary btn_submit  J_ajax_submit_btn" style="margin-top:-27px">返回</a>
			  <a href="javascript:;" onclick="additem()" class="right btn btn-primary btn_submit  J_ajax_submit_btn" style="margin-top:-27px;margin-right:20px;">添加新选手</a> 
			  <form action="" method="post" >
			  <input type="submit" value="搜索" class="right btn btn-primary btn_submit  J_ajax_submit_btn" style="margin-top:-27px;margin-right:40px;">  <input type="text" name="searchitem" class="right" style="margin-top:-27px;margin-right:8px;" placeholder="请输入选手编号或姓名">
			  <input type="hidden" name="vid" value="<?php echo ($vid); ?>">
			  </form>
          </div>
          <div class="msgWrap">
          <form method="post" action="" id="info">
            <table class="ListProduct" border="0" cellspacing="0" cellpadding="0" width="100%">
              <thead>
                <tr>
					<th>序号</th>
					<th>名称</th>
					<th>微信号</th>
					<th>排序</th>
					<th>票数</th>
					<th>电话</th>
					<th>报名时间</th>
					<th>照片1</th>
					<th>照片2</th>
					<th>照片3</th>
					<th>照片4</th>
					<th class="norightborder">操作</th>
                </tr>
              </thead>
              <tbody>
                <tr></tr>
                  <?php if(is_array($liinfo)): $i = 0; $__LIST__ = $liinfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><tr id="item_<?php echo ($list["id"]); ?>">
                  <td> <?php echo ($list["id"]); ?></td>
                  <td><?php echo ($list["item"]); ?></td>
                  <td><?php echo ($list["wechat"]); ?></td>
				  <td><?php echo ($list["rank"]); ?></td>
                  <td><?php echo ($list["vcount"]); ?></td>
				  <td><?php echo ($list["tourl"]); ?></td>
				  <td><?php echo (date('Y-m-d H:i:s',$list["addtime"])); ?></td>
				  <td style="display:none"><?php echo ($list["intro"]); ?></td>
                  <td class="img"><img src="<?php echo ($list["startpicurl"]); ?>" ></td>
				  <td class="img"> <?php if(!empty($list["startpicurl2"])): ?><img src="<?php echo ($list["startpicurl2"]); ?>" ><?php endif; ?></td>
				  <td class="img">  <?php if(!empty($list["startpicurl3"])): ?><img src="<?php echo ($list["startpicurl3"]); ?>" ><?php endif; ?></td>
				  <td class="img">  <?php if(!empty($list["startpicurl4"])): ?><img src="<?php echo ($list["startpicurl4"]); ?>" ><?php endif; ?></td>
				 
				
				  </td>
                  <td class="norightborder">
				   <a href="javascript:;" onclick="thisedit('<?php echo ($list["id"]); ?>')"  name="onedit" id="onedit" class="btn btn-primary btn_submit  J_ajax_submit_btn">
				   修改
					</a> 
				<a href="javascript:;" onclick="dooow('<?php echo ($list["id"]); ?>')"  name="ondell" id="ondell" class="btn btn-primary btn_submit  J_ajax_submit_btn">
				   删除
					</a> 
					</a> 
				<a href="<?php echo U('User/Vote/tpjl',array('zid'=>$list['id'],'vid'=>$vid));?>"  name="tpjl" id="tpjl" class="btn btn-primary btn_submit ">
				   投票记录
					</a>
                  </td>
                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
              </tbody>
            </table>
           </form> 
		   <div id="editit" style="display:none;width:100%;">
		   <table>
			 <input type="hidden" id="itemid" size="30" class="msgtext" style="width:80%;" >
			<div> 姓名：<input type="text" id="itemitem" name="itemitem" size="30" class="msgtext" style="width:70%;" ></div>
			<div> 排序：<input type="text" id="itemrank" name="itemrank" size="30" class="msgtext" style="width:70%;" ></div>
			<div>票数：	<input type="radio" name="countadd" checked="checked" id="countadd" value="up" /><label style="display:inline" for="countadd"> 加票</label>
						<input type="text" id="itemvcount" value="0" name="itemvcount" size="30" class="msgtext" style="width:40%;" >
						<input type="radio" name="countadd"  id="countzz" value="down" /><label style = "display:inline" for="countzz">减票</label>
			</div>
			 <div>电话：<input type="text" id="itemtourl" name="itemtourl" size="30" class="msgtext" style="width:70%;" ></div>
			 <div>简介：<input type="text" id="itemintro" name="itemintro" size="30" class="msgtext" style="width:70%;" ></div>
			<div> 照片1：<input type="text" id="itemstartpicurl" name="itemstartpicurl" size="30" class="msgtext" style="width:50%;" >
					<a href="#" onclick="upyunPicUpload('itemstartpicurl',700,400,'<?php echo ($token); ?>')" class="btn btn-primary btn_submit  J_ajax_submit_btn">上传</a> 
					<a href="#" onclick="viewImg('itemstartpicurl')">预览</a></div>

					<div> 照片2：<input type="text" id="itemstartpicurl2" name="itemstartpicurl2" size="30" class="msgtext" style="width:50%;" >
					<a href="#" onclick="upyunPicUpload('itemstartpicurl2',700,400,'<?php echo ($token); ?>')" class="btn btn-primary btn_submit  J_ajax_submit_btn">上传</a> 
					<a href="#" onclick="viewImg('itemstartpicurl2')">预览</a></div>

					<div> 照片3：<input type="text" id="itemstartpicurl3" name="itemstartpicurl3" size="30" class="msgtext" style="width:50%;" >
					<a href="#" onclick="upyunPicUpload('itemstartpicurl3',700,400,'<?php echo ($token); ?>')" class="btn btn-primary btn_submit  J_ajax_submit_btn">上传</a> 
					<a href="#" onclick="viewImg('itemstartpicurl3')">预览</a></div>

					<div> 照片4：<input type="text" id="itemstartpicurl4" name="itemstartpicurl4" size="30" class="msgtext" style="width:50%;" >
					<a href="#" onclick="upyunPicUpload('itemstartpicurl4',700,400,'<?php echo ($token); ?>')" class="btn btn-primary btn_submit  J_ajax_submit_btn">上传</a> 
					<a href="#" onclick="viewImg('itemstartpicurl4')">预览</a></div>
		   </table>
		   </div>
		   
		   	<div id="addit" style="display:none;width:100%;">
			<table>
			 <div> 姓名：<input type="text" id="additem" size="30" class="msgtext" style="width:70%;" ></div>
			 <div> 排序：<input type="text" id="addrank" size="30" class="msgtext" style="width:70%;" ></div>
			<div>票数：<input type="text" id="addvcount" size="30" class="msgtext" style="width:70%;" ></div>
			 <div>电话： <input type="text" id="addtourl" size="30" class="msgtext" style="width:70%;" ></div>
			 <div>简介： <input type="text" id="addintro" size="30" class="msgtext" style="width:70%;" ></div>
			<div> 照片1： <input type="text" id="addstartpicurl" id="addstartpicurl" size="30" class="msgtext" style="width:50%;" >
					<a href="#" onclick="upyunPicUpload('addstartpicurl',700,400,'<?php echo ($token); ?>')" class="btn btn-primary btn_submit  J_ajax_submit_btn">上传</a> 
					<a href="#" onclick="viewImg('addstartpicurl')">预览</a></div>
					<div> 照片2： <input type="text" id="addstartpicurl2" id="addstartpicurl2" size="30" class="msgtext" style="width:50%;" >
					<a href="#" onclick="upyunPicUpload('addstartpicurl2',700,400,'<?php echo ($token); ?>')" class="btn btn-primary btn_submit  J_ajax_submit_btn">上传</a> 
					<a href="#" onclick="viewImg('addstartpicurl2')">预览</a></div>
					<div> 照片3： <input type="text" id="addstartpicurl3" id="addstartpicurl3" size="30" class="msgtext" style="width:50%;" >
					<a href="#" onclick="upyunPicUpload('addstartpicurl3',700,400,'<?php echo ($token); ?>')" class="btn btn-primary btn_submit  J_ajax_submit_btn">上传</a> 
					<a href="#" onclick="viewImg('addstartpicurl3')">预览</a></div>
					<div> 照片4： <input type="text" id="addstartpicurl4" id="addstartpicurl4" size="30" class="msgtext" style="width:50%;" >
					<a href="#" onclick="upyunPicUpload('addstartpicurl4',700,400,'<?php echo ($token); ?>')" class="btn btn-primary btn_submit  J_ajax_submit_btn">上传</a> 
					<a href="#" onclick="viewImg('addstartpicurl4')">预览</a></div>
			
			</table>
			</div>
		<div style="clear:both"></div>
		<div class="linkp"><?php echo ($page); ?></div>
	<script type="text/javascript">
	$(document).ready(function(){

		});
	function thisedit(id){
	var thisitem = $("#item_"+id);
	$("#itemid").val(thisitem.children("td").eq(0).text());
	$("#itemitem").val(thisitem.children("td").eq(1).text());
	$("#itemrank").val(thisitem.children("td").eq(2).text());
	$("#itemtourl").val(thisitem.children("td").eq(4).text());
	$("#itemintro").val(thisitem.children("td").eq(6).text());
	$("#itemstartpicurl").val(thisitem.children("td").eq(7).children("img").attr("src"));
	$("#itemstartpicurl2").val(thisitem.children("td").eq(8).children("img").attr("src"));
	$("#itemstartpicurl3").val(thisitem.children("td").eq(9).children("img").attr("src"));
	$("#itemstartpicurl4").val(thisitem.children("td").eq(10).children("img").attr("src"));
	
	$("#editit").dialog(
		{
		modal: true,
		title:"投票选项管理",
		width:400,
		buttons: {
			"确定": function() {
			var id = $("#itemid").val();
			var item = $("#itemitem").val();
			var rank = $("#itemrank").val();
			var vcount = $("#itemvcount").val();
			var vtype  =$('input[name="countadd"]:checked').val();
			var tourl = $("#itemtourl").val();
			var intro = $("#itemintro").val();
			var startpicurl = $("#itemstartpicurl").val();
			var startpicurl2 = $("#itemstartpicurl2").val();
			var startpicurl3 = $("#itemstartpicurl3").val();
			var startpicurl4 = $("#itemstartpicurl4").val();

			
			var submitData={
				id  : id,
				item : item,
				rank : rank,
				vcount : vcount,
				vtype : vtype,
				tourl : tourl,
				intro :intro,
				startpicurl : startpicurl,
				startpicurl2 : startpicurl2,
				startpicurl3 : startpicurl3,
				startpicurl4 : startpicurl4
			};		
			$.post('index.php?g=User&m=Vote&a=eitem_vote', submitData, function(bakcdata) 
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
	function dooow(objsp) {
   var obj = {id:objsp}
   var statu = confirm("确定要删除该选项么?");
     if(statu){
        $.post("<?php echo U('Vote/del_tab');?>", obj,function(data) {
		parent.location="javascript:location.reload()";
		},"json");
}
	}
	
	function additem(){
	
	$("#addit").dialog(
		{
		modal: true,
		title:"添加新选手",
		width:400,
		buttons: {
			"添加": function() {
			var item = $("#additem").val();
			var rank = $("#addrank").val();
			var vcount = $("#addvcount").val();
			var tourl = $("#addtourl").val();
			var intro = $("#addintro").val();
			var startpicurl = $("#addstartpicurl").val();
			var startpicurl2 = $("#addstartpicurl2").val();
			var startpicurl3 = $("#addstartpicurl3").val();
			var startpicurl4 = $("#addstartpicurl4").val();
			
			var submitData={
				vid  : <?php echo ($vid); ?>,
				item : item,
				rank : rank,
				vcount : vcount,
				tourl : tourl,
				intro : intro,
				startpicurl : startpicurl,
				startpicurl2 : startpicurl2,
				startpicurl3 : startpicurl3,
				startpicurl4 : startpicurl4
			};		
			$.post('index.php?g=User&m=Vote&a=eitem_add', submitData, function(bakcdata) 
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