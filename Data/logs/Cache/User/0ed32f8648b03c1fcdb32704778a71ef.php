<?php if (!defined('THINK_PATH')) exit();?><script src="/tpl/static/jquery-1.4.2.min.js" type="text/javascript"></script>
<script src="/tpl/static/upyun.js?2013"></script>
<script src="/tpl/static/artDialog/jquery.artDialog.js?skin=default"></script>
<script src="/tpl/static/artDialog/plugins/iframeTools.js"></script>
<style>
.action {
    background: none repeat scroll 0 0 #FFFFFF;
    box-shadow: 1px 1px 3px #666666;
    width: 359px;
}
a{text-decoration:none}
a.a_upload,a.a_choose{border:1px solid #3d810c;box-shadow:0 1px #CCCCCC;-moz-box-shadow:0 1px #CCCCCC;-webkit-box-shadow:0 1px #CCCCCC;cursor:pointer;display:inline-block;text-align:center;vertical-align:bottom;overflow:visible;border-radius:3px;-moz-border-radius:3px;-webkit-border-radius:3px;vertical-align:middle;background-color:#f1f1f1;background-image: -webkit-linear-gradient(bottom, #CCC 0%, #E5E5E5 3%, #FFF 97%, #FFF 100%); background-image: -moz-linear-gradient(bottom, #CCC 0%, #E5E5E5 3%, #FFF 97%, #FFF 100%); background-image: -ms-linear-gradient(bottom, #CCC 0%, #E5E5E5 3%, #FFF 97%, #FFF 100%); color:#000;border:1px solid #AAA;padding:2px 8px 2px 8px;text-shadow: 0 1px #FFFFFF;font-size: 14px;line-height: 1.5;
}
th,td{text-align: -webkit-left;font-size:12px;}
</style>

	<form action="" method="post" target="_parent" id="realinfo_form">
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tbody>
		<tr bgcolor="#F1F1F1">
			<th align="right" height="62" width="100">菜单类型：</th>
			<td>
				<div class="mr15 l">
				
				<select name="menu_type" class="menu_type">
					<option  value="1">关键词回复菜单</option>		
					<option  value="2">url链接菜单</option>
					<option  value="3">微信扩展菜单</option>
				</select>
					添加父级菜单只需要填写菜单名称即可。
				</div>
			</td>
		</tr>
		<tr>
			<th align="right" height="62" width="100">父级菜单：</th>
			<td>
				<div class="mr15 l">
				<select name="pid" id="pid">
					<option selected="selected" value="0">请选择父菜单：</option>
					<?php if(is_array($class)): $i = 0; $__LIST__ = $class;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$class): $mod = ($i % 2 );++$i;?><option  value="<?php echo ($class["id"]); ?>"><?php echo ($class["title"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select>
				设置二级菜单需要先选择父菜单
				</div>
			</td>
		</tr>
		<tr bgcolor="#F1F1F1">
			<th align="right" height="62" width="">主菜单名称：</th>
			<td>
				<div class="mr15 l">
				<input id="menu_title" class="txt" name="title" title="主菜单名称" value="" type="text">			
				</div>
				
				<div class="system l"></div>
			</td>
		</tr>
					
		<tr class="keyword">
			<th align="right" height="62" width="">关联关键词：</th>
			<td>
				<div class="mr15 l">
					<input id="menu_keyword" class="txt" name="keyword" title="关联关键词" value="" type="text"> 
				
					
				</div>
				<div class="system l"></div>
			</td>
		</tr>
		
		<tr  style="display:none;"  class="url">
			<th align="right" height="62" width="">外链接url：</th>
			<td>
				<div class="mr15 l">
				<input id="menu_key" class="txt" name="url" size="60" title="外链接url" value="" type="text"> 
				<!-- <?php if($wxuser['winxintype'] == 3): ?><a href="###" onclick="addLink('menu_key',0)" class="a_choose">从功能库添加</a><?php endif; ?> --><br/>
				非认证服务号或未开启用户授权请不要填写本站url (<span style="color:red">微信自定义菜单已不支持一键拨号</span>)
				</div>
				<div class="system l"></div>
			</td>
		</tr>
		
		<tr  style="display:none;" class="wxsys">
			<th align="right" height="62" width="">扩展菜单：</th>
			<td>
				<div class="mr15 l">
					<select name="wxsys">
						<option value="">请选择..</option>
						<?php if(is_array($wxsys)): $i = 0; $__LIST__ = $wxsys;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$wxsys): $mod = ($i % 2 );++$i;?><option value="<?php echo ($wxsys); ?>"><?php echo ($wxsys); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
					</select>
				</div>
				<div class="system l"></div>
			</td>
		</tr>
		<tr bgcolor="#F1F1F1">
			<th align="right" height="62">显示：</th>
			<td>
				<div class="mr15 l">
				<input type="radio" name="is_show" checked="checked" value="1">是&nbsp;
				<input type="radio" name="is_show" value="0">否&nbsp;
				</div>
				<div class="system l"></div>
			</td>
		</tr>
		<tr>
			<th align="right" height="62">排序：</th>
			<td>
				<div class="mr15 l">
				<input id="sortid" class="txt" name="sort" title="排序" value="" type="text"></div>
				<div class="system l"></div>
			</td>
		</tr>
		<tr bgcolor="#F1F1F1">
			<td height="42">&nbsp;</td>
			<td>
				<input class="btn" type="submit" name="submit" value="提交">
			</td>
		</tr>
<script>
$(function(){
	$('.menu_type').change(function(){
		var val 	= $(this).val();
		if(val == 1){
			$('.keyword').css('display','');
			$('.wxsys').css('display','none');
			$('.url').css('display','none');
		}else if(val == 2){
			$('.keyword').css('display','none');
			$('.wxsys').css('display','none');
			$('.url').css('display','');		
		}else if(val == 3){

			$('.keyword').css('display','none');
			$('.wxsys').css('display','');
			$('.url').css('display','none');
		}
	});
});
</script>
	</tbody></table>
</form>