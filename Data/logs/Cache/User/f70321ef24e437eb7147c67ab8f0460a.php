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


<div class="content">
         
          <div class="cLineB">
             <h4 class="left">您已创建微信投票活动 (<?php echo ($count); ?>) 个 <span class="FAQ"></span></h4>
              <div class="clr"></div>
          </div>
          <div class="cLine">
            <div class="pageNavigator left">
            <?php if($ok == 1): ?><a href=""  title="发起文字投票" class="btn btn-primary btn_submit  J_ajax_submit_btn" style="display:none"><img src="<?php echo RES;?>/images/text.png" class="vm">发起文字投票</a>　
			<a href="" title="发起图片投票" class="btn btn-primary btn_submit  J_ajax_submit_btn"><img src="<?php echo RES;?>/images/pic.png" class="vm">发起图片投票</a>
			<a href="<?php echo U('./Home/Index/help',array('token'=>$_SESSION['token']));?>"   title="API接口" class="btn btn-primary btn_submit  J_ajax_submit_btn">API接口</a>&nbsp&nbsp&nbsp
			<a href="<?php echo U('Diymen/index',array('token'=>$_SESSION['token']));?>"   title="底部菜单" class="btn btn-primary btn_submit  J_ajax_submit_btn">底部菜单</a>&nbsp&nbsp&nbsp
			<a href="<?php echo U('Vote/gongzhong',array('id'=>$_SESSION['id']));?>"   title="信息绑定" class="btn btn-primary btn_submit  J_ajax_submit_btn">信息绑定</a>&nbsp&nbsp&nbsp
			<a href="<?php echo U('Vote/check',array('id'=>$_SESSION['id']));?>"   title="审核信息" class="btn btn-primary btn_submit  J_ajax_submit_btn">审核信息</a>&nbsp&nbsp&nbsp
			<a href="<?php echo U('Areply/index',array('id'=>$_SESSION['id'],'token'=>$_SESSION['token']));?>"   title="关注回复" class="btn btn-primary btn_submit  J_ajax_submit_btn">关注回复</a>&nbsp&nbsp&nbsp
			<a href="<?php echo U('Index/useredit');?>"   title="修改密码" class="btn btn-primary btn_submit  J_ajax_submit_btn">修改密码</a>&nbsp&nbsp&nbsp
			<a href="<?php echo U('Home/Index/logout');?>"   title="退出登陆" class="btn btn-primary btn_submit  J_ajax_submit_btn">退出登陆</a>&nbsp&nbsp&nbsp
            <?php else: ?>
            <a href="<?php echo U('Vote/add',array('type'=>'text'));?>"  title="发起文字投票" class="btn btn-primary btn_submit  J_ajax_submit_btn" style="display:none"><img src="<?php echo RES;?>/images/text.png" class="vm">发起文字投票</a>
			<a href="<?php echo U('Vote/add',array('type'=>'img'));?>"   title="发起图片投票" class="btn btn-primary btn_submit  J_ajax_submit_btn"><img src="<?php echo RES;?>/images/pic.png" class="vm">发起图片投票</a>&nbsp&nbsp&nbsp
			<a href="<?php echo U('Vote/check',array('id'=>$_SESSION['uid']));?>"   title="审核信息" class="btn btn-primary btn_submit  J_ajax_submit_btn">审核选手</a>&nbsp&nbsp&nbsp
			<a href="<?php echo U('./Home/Index/help',array('token'=>$_SESSION['token']));?>"   title="API接口" class="btn btn-primary btn_submit  J_ajax_submit_btn">接口绑定</a>&nbsp&nbsp&nbsp
			<a href="<?php echo U('Diymen/index',array('token'=>$_SESSION['token']));?>"   title="底部菜单" class="btn btn-primary btn_submit  J_ajax_submit_btn">自定义菜单</a>&nbsp&nbsp&nbsp
			<a href="<?php echo U('Areply/index',array('id'=>$_SESSION['id'],'token'=>$_SESSION['token']));?>"   title="关注回复" class="btn btn-primary btn_submit  J_ajax_submit_btn">回复设置</a>&nbsp&nbsp&nbsp
			
			
			<a href="<?php echo U('Vote/gongzhong',array('id'=>$_SESSION['uid']));?>"   title="投票设置" class="btn btn-primary btn_submit  J_ajax_submit_btn">投票设置</a>&nbsp&nbsp&nbsp
			<a href="<?php echo U('Lottery/index',array('id'=>$_SESSION['uid']));?>"   title="大转盘管理" class="btn btn-primary btn_submit  J_ajax_submit_btn">大转盘管理</a>&nbsp&nbsp&nbsp
			<a href="<?php echo U('Index/useredit');?>"   title="修改密码" class="btn btn-primary btn_submit  J_ajax_submit_btn">修改密码</a>&nbsp&nbsp&nbsp
			<a href="<?php echo U('Home/Index/logout');?>"   title="退出登陆" class="btn btn-primary btn_submit  J_ajax_submit_btn">退出登陆</a><?php endif; ?>
            </div>
            <div class="clr"></div>
          </div>
          <div class="msgWrap">
          <form method="post" action="index.php?ac=vote-manage&amp;id=9878" id="info">
          <input name="delall" type="hidden" value="del">
           <input name="wxid" type="hidden" value="gh_423dwjkewad">
            <table class="ListProduct" border="0" cellspacing="0" cellpadding="0" width="100%">
              <thead>
                <tr>
					<th class="select">选择</th>
					<th>活动关键词</th>
					<th>活动标题</th>
					<th>报名人数</th>
					<th class="time">报名时间</th>
					<th class="time">投票时间</th>
					<th>活动链接</th>
					<th class="norightborder">操作</th>
                </tr>
              </thead>
              <tbody>
                <tr></tr>
                  <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><tr>
                  <td>  <input type="checkbox" name="del_id[]" value="674" class="checkitem"></td>
                  <td><?php echo ($list["keyword"]); ?></td>
                  <td><?php echo ($list["title"]); ?></td>
                  <td align="center" style="font-weight:900"><?php echo ($list["count"]); ?></td>
                  <td><?php echo (date('Y-m-d',$list["start_time"])); ?>至<?php echo (date('Y-m-d',$list["over_time"])); ?></td>
                  <td><?php echo (date('Y-m-d',$list["statdate"])); ?>至<?php echo (date('Y-m-d',$list["enddate"])); ?></td>
                  <td>  <a href="<?php echo U('Wap/Vote/index',array('token'=>$_SESSION['token'],'id'=>$list['id']));?>" target="_blank"> <?php if($list['type'] == 'text'): ?>文字投票<?php else: ?>图片投票<?php endif; echo ($list["id"]); ?></a></td>
                   <td class="norightborder">
				   <a href="<?php echo U('Vote/edit',array('type'=>$list['type'],'id'=>$list['id']));?>"  class="btn btn-primary btn_submit  J_ajax_submit_btn">修改活动</a>
				   <a href="<?php echo U('Vote/eitem',array('token'=>$_SESSION['token'],'id'=>$list['id']));?>"class="btn btn-primary btn_submit  J_ajax_submit_btn">选手设置</a>
				   <a href="<?php echo U('Vote/totals',array('type'=>$list['type'],'id'=>$list['id']));?>"class="btn btn-primary btn_submit  J_ajax_submit_btn">投票结果</a>
				   <a href="<?php echo U('Vote/lock',array('token'=>$_SESSION['token'],'id'=>$list['id']));?>" class="btn btn-primary btn_submit  J_ajax_submit_btn">锁定管理</a>				   
<!--				   <a href="<?php echo U('Vote/share',array('token'=>$_SESSION['token'],'id'=>$list['id']));?>" target="_blank" title="推广页" class="btn btn-primary btn_submit  J_ajax_submit_btn">推广页</a>-->
					<a href="javascript:" class="btn btn-primary btn_submit  J_ajax_submit_btn"><?php echo ($list["show"]); ?></a>
				   <a href="javascript:drop_confirm('您确定要删除吗?删除会把投票结果也一起删除！', '<?php echo U('Vote/del',array('type'=>$list['type'],'id'=>$list['id']));?>');" class="btn btn-primary btn_submit  J_ajax_submit_btn">删除</a> 


                   </td>
          
                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
      			                
                  
              </tbody>
            </table>
           </form> 
<script>
function showno(){
alert("为避免影响投票功能，请在晚22:00--早6:00期间进行编辑");
return false;
}
function showend(){
alert("活动已结束");
return false;
}
   function checkvotethis() {
var aa=document.getElementsByName('del_id[]');
var mnum = aa.length;
j=0;
for(i=0;i<mnum;i++){
if(aa[i].checked){
j++;
}
}
if(j>0) {
document.getElementById('info').submit();
} else {
alert('未选中内容！')
}
}</script>
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