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

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="keywords" content="<?php echo C('keyword');?>" />
<meta name="description" content="<?php echo C('content');?>" />   
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/vote/bootstrap_min.css?2013-9-13-2" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/vote/bootstrap_responsive_min.css?2013-9-13-2" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/vote/sstyle.css?2013-9-13-2" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/vote/todc_bootstrap_button.css?2013-9-13-2" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/vote/themes.css?2013-9-13-2" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/vote/daterangepicker.css?2013-9-13-2" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/vote/inside.css?2013-9-13-2" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/vote/chosen.css?2013-9-13-2" media="all" />
<script type="text/javascript" src="<?php echo RES;?>/js/jQuery.js?2013-9-13-2"></script>
<script type="text/javascript" src="<?php echo RES;?>/js/jquery_ui_widget_min.js?2013-9-13-2"></script>
<script type="text/javascript" src="<?php echo RES;?>/js/bootstrap_min.js?2013-9-13-2"></script>
<script type="text/javascript" src="<?php echo RES;?>/js/jquery_form_min.js?2013-9-13-2"></script>
<script type="text/javascript" src="<?php echo RES;?>/js/jquery_validate_min.js?2013-9-13-2"></script>
<script type="text/javascript" src="<?php echo RES;?>/js/jquery_validate_methods.js?2013-9-13-2"></script>
<script type="text/javascript" src="<?php echo RES;?>/js/jquery_form_wizard_min.js?2013-9-13-2"></script>
<script type="text/javascript" src="<?php echo RES;?>/js/daterangepicker.js?2013-9-13-2"></script>
<script type="text/javascript" src="<?php echo RES;?>/js/moment_min.js?2013-9-13-2"></script>
<script type="text/javascript" src="<?php echo RES;?>/js/inside.js?2013-9-13-2"></script>
<title><?php echo C('site_name');?>-<?php echo C('site_title');?></title>
 <style>
.CC_table{ border-top:2px solid #abd2f3;  width:100%; line-height:26px; font-size:14px; border-collapse:collapse;}
.CC_table th{background:#f5f5f5; border-bottom:1px dashed #ccc; padding:0 12px; color:#333;  font-weight:bold; }
.CC_table td{ border-bottom:1px dashed #ccc; padding-left:6px;height:50px;}
 </style>

<div class="box">
<div class="box-title">
                            <div class="span10">
                                <h3>关注和默认回复内容设置 <span class="FAQ">可参考右边的范例来写,关注回复文字的信息，回复帮助也是此信息！</span></h3>
                            </div>
                            <div class="span2"><a class="btn btn-primary btn_submit  J_ajax_submit_btn" href="<?php echo U('User/Vote/index');?>">返回</a></div>
                        </div>
         <div class="zdhuifu">
                  <form method="post"  action="<?php echo U('Areply/insert');?>">
                 
   <table class="CC_table" border="0" cellspacing="0" cellpadding="0" width="100%" >
              <tbody>
				
                  	<tr>
                	<th >&nbsp;&nbsp;&nbsp;&nbsp;<span class="red">*</span>关注时回复的内容</th>
                	<td><textarea class="px" style="width:600px; height:70px; margin:5px 0"  id="Hfcontent" name="content">
<?php echo ($areply["content"]); ?>
</textarea>填写活动的关键词，即可输出活动图文；否则以文本内容显示！</td>
                </tr>
				 <tr>
				 <tr>
                	<th >&nbsp;&nbsp;&nbsp;&nbsp;<span class="red">*</span>回复不上来回复的内容</th>
                	<td><textarea class="px" style="width:600px; height:70px; margin:5px 0"  id="Hfcontent" name="content2">
<?php echo ($areply["content2"]); ?>
</textarea>参考范例：
请直接填写要投票选项的数字编号,客服微信号：***</td>
                </tr>
				 <tr>
                 	<td colspan="2"  align="center"><button type="submit" name="button" class="btn btn-primary btn_submit  J_ajax_submit_btn">保存</button></td>
                 	</tr> 
				</tbody>
				</table>
  <!-- <table cellspacing="0" cellpadding="0" border="0" width="100%">
  <tr><td height="5"></td><td></td></tr>
<tr>
<td valign="top" width="420"><textarea class="px" style="width:420px; height:500px; margin:5px 0"  id="Hfcontent" name="content">
<?php echo ($areply["content"]); ?>
</textarea><p> <input name="home" type="checkbox" <?php if($areply['home'] == 1): ?>checked="checked"<?php endif; ?> value="1"   />若是想关注回复多图，此项必须沟选 </p><p>
关键词：<input type="text" style="width:100px;" class="px" id="keyword" value="<?php echo ($areply["keyword"]); ?>" name="keyword" style="width:500px" ><br/>例：填写"功能",系统会检索包含最近发布的9条信息，若想关注回复回复首页,此项请填写 首页<br/></td>
<td valign="top">
     	<div class="zdhuifu" style="margin-left:20px">
<h4>参考范例：</h4>
输入编号为选手投票<br/>
输入"报名"参与投票<br/>
输入"投票"查看投票信息<br/>

</div></td>
</tr>
<tr>
<td height="50">
       
<input type="submit" value="保存"  name="sbmt"   class="btn btn-primary btn_submit  J_ajax_submit_btn"  />

<script type="text/javascript">
function jsbq(srt){
document.getElementById("Hfcontent").value=document.getElementById("Hfcontent").value+"/"+srt;
}
</script>


</td><td valign="top">
</tr>
</table> -->
</form>
  <div class="span10"><h4>设置自动回复关键字 <span class="FAQ">自定义关键字和回复内容(设置的关键字请不要与投票活动关键字重复)</span></h3></div>
                
   <table class="CC_table" border="0" cellspacing="0" cellpadding="0" width="100%" >
              <tbody>
			 
				<tr><td>关键字</td><td>回复内容</td></tr>
                <?php if(is_array($key)): $i = 0; $__LIST__ = $key;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$li): $mod = ($i % 2 );++$i;?><tr>
                	<td ><input type="text" value="<?php echo ($li["keyword"]); ?>" ></td>
                	<td><textarea class="px" style="width:600px; height:40px; margin:5px 0"  id="Hfcontent" name="content" >
<?php echo ($li["content"]); ?>
</textarea>
<a class="btn btn-primary btn_submit  J_ajax_submit_btn" href="<?php echo U('Areply/edkeyword',array('id'=>$li['id'],'pid'=>$li['pid'],'token'=>$li['token']));?>">编辑</a>

<a class="btn btn-primary btn_submit  J_ajax_submit_btn"  onclick="if (confirm('确定要退出吗？')) return true; else return false;" href="<?php echo U('Areply/delkeyword',array('id'=>$li['id'],'pid'=>$li['pid'],'token'=>$li['token']));?>">删除</a>
</td>
                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
				
				 <tr>
                 	<td colspan="2"  align="center"><a class="btn btn-primary btn_submit  J_ajax_submit_btn" href="<?php echo U('Areply/inkeyword');?>">添加</a></td>
                 	</tr> 
				</tbody>
				</table>

		
      </div>
        </div>

        <div class="clr"></div>
      </div>
    </div>
  </div>
  <script>
$(document).ready( function(){ 
$('.checkall').click(function(){

$('.checkitem').each(function(){
$(this).attr('checked',$('.checkall').attr('checked'));
});
});

});
  </script>
  <!--底部-->
  	</div>
<div style="display:none">
<link href="tpl/static/simpleboot/themes/flat/theme.min.css" rel="stylesheet">
</div>