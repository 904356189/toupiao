<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/bootstrap_min.css?2013-9-13-2" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/bootstrap_responsive_min.css?2013-9-13-2" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/sstyle.css?2013-9-13-2" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/todc_bootstrap.css?2013-9-13-2" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/themes.css?2013-9-13-2" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/inside.css?2013-9-13-2" media="all" />
<script type="text/javascript" src="<?php echo RES;?>/js/jQuery.js?2013-9-13-2"></script>
<script type="text/javascript" src="<?php echo RES;?>/js/bootstrap_min.js?2013-9-13-2"></script>
<script type="text/javascript" src="<?php echo RES;?>/js/inside.js?2013-9-13-2"></script>
<script type="text/javascript" src="<?php echo RES;?>/js/jquery_validate_min.js?2013-9-13-2"></script>
<script type="text/javascript" src="<?php echo RES;?>/js/jquery_validate_methods.js?2013-9-13-2"></script>
<script type="text/javascript" src="<?php echo RES;?>/js/jquery_form_min.js?2013-9-13-2"></script>
<script src="<?php echo STATICS;?>/jquery-1.4.2.min.js" type="text/javascript"></script>
<script src="<?php echo RES;?>/js/common.js" type="text/javascript"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> <?php echo C('site_title');?> <?php echo C('site_name');?></title>
<meta name="keywords" content="<?php echo C('keyword');?>" />
<meta name="description" content="<?php echo C('content');?>" />
<meta http-equiv="MSThemeCompatible" content="Yes" />
<script>var SITEURL='';</script>
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/style_2_common.css?BPm" />
<script src="<?php echo RES;?>/js/common.js" type="text/javascript"></script>
</head>
<body id="nv_member" class="pg_CURMODULE" onkeydown="if(event.keyCode==27) return false;">
 
    
    
 

 <link href="<?php echo RES;?>/css/style.css" rel="stylesheet" type="text/css" />
  <!--中间内容
  <script src="<?php echo STATICS;?>/jquery-1.4.2.min.js" type="text/javascript"></script>
  
  <div class="contentmanage">
    <div class="developer">
       <div class="appTitle normalTitle2">
        <div class="vipuser">


 

<div id="nickname">
<strong><?php echo ($wecha["wxname"]); ?></strong><a href="#" target="_blank" class="vipimg vip-icon<?php echo $userinfo['id']-1; ?>" title=""></a></div>
<div id="weixinid">微信号:<?php echo ($wecha["wxid"]); ?></div>
</div>

 <div class="accountInfo">
<table class="vipInfo" width="100%" border="0" cellpadding="0" cellspacing="0">
<tr>
<td><strong>VIP有效期：</strong><?php if($_SESSION['viptime'] != 0): echo (date("Y-m-d",session('viptime'))); else: ?>vip0不限时间<?php endif; ?></td>
<td><strong>图文自定义：</strong><?php echo (session('diynum')); ?>/<?php echo ($userinfo["diynum"]); ?></td>
<td><strong>活动创建数：</strong><?php echo (session('activitynum')); ?>/<?php echo ($userinfo["activitynum"]); ?></td>
<td><strong>请求数：</strong><?php echo (session('connectnum')); ?>/<?php echo ($userinfo["connectnum"]); ?></td>
</tr>
<tr>
<td><strong>请求数剩余：</strong><?php echo ($userinfo['connectnum']-$_SESSION['connectnum']); ?></td>
<td><strong>已使用：</strong><?php echo $_SESSION['diynum']; ?></td>
<td><strong>当月赠送请求数：</strong><?php echo ($userinfo["activitynum"]); ?></td>
<td><strong>当月剩余请求数：</strong><?php echo $userinfo['connectnum']-$_SESSION['connectnum']; ?></td>
</tr>

</table>
 </div>
        <div class="clr"></div>
      </div>
  
      <div class="tableContent">-->
        
        <!--左侧功能菜单-->
            
<link rel="stylesheet" type="text/css" href="./tpl/User/default/common/css/cymain.css" />
 <link rel="stylesheet" href="<?php echo RES;?>/css/diymen/tipswindown.css" type="text/css" media="all" />
<script type="text/javascript" src="<?php echo RES;?>/css/diymen/tipswindown.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/bootstrap_min.css?2013-9-13-2" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/bootstrap_responsive_min.css?2013-9-13-2" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/sstyle.css?2013-9-13-2" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/todc_bootstrap.css?2013-9-13-2" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/themes.css?2013-9-13-2" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/inside.css?2013-9-13-2" media="all" />
<div id="main">
        <div class="container-fluid">

            <div class="row-fluid">
                <div class="span12">

                    <div class="box">
                        <div class="box-title">
                            <div class="span8">
                                <h3><i class="icon-table"></i>自定义菜单管理  </h3>
                            </div>
<div class="span2"><a class="btn btn-primary btn_submit  J_ajax_submit_btn" href="<?php echo U('User/Vote/index');?>">返回</a></div>
                        </div>
<div class="box-content">
                            <div class="alert">
                                <p>注意：1级菜单最多只能开启3个，2级子菜单最多开启5个!</p>
                                <p>只有保存主菜单后才可以添加子菜单</p>
                                <p>生成自定义菜单,必须在已经保存的基础上进行,临时勾选启用点击生成是无效的! 第一步必须先修改保存状态！第二步点击生成!</p>
                                <p>当您为自定义菜单填写链接地址时请填写以"http://"开头，这样可以保证用户手机浏览的兼容性更好</p>
                            </div>
                            <div class="row-fluid">

                                <div class="span8 control-group">
								<a href="<?php echo U('Diymen/class_add',array('token'=>$_SESSION['token']));?>"   title="添加菜单" class="btn btn-primary btn_submit  J_ajax_submit_btn"><i class="icon-plus"></i>添加菜单</a>
                                </div>

                            </div>

<script type="text/javascript">
 $(document).ready(function() {
	
	$("#iframe1").click(function(){
		tipsWindown("添加菜单","iframe:<?php echo U('Diymen/class_add');?>","760","450","true","","true","leotheme");
	});
 });
 </script>

 <div class="cLineD">
 	<form enctype="multipart/form-data" action="" method="post"> 
    AppId:<input type="text" size="20" tabindex="1" class="px" value="<?php echo ($diymen["appid"]); ?>" id="appid" name="appid">　 
	AppSecret: <input type="text" size="20" tabindex="1" class="px" value="<?php echo ($diymen["appsecret"]); ?>" id="appsecret" name="appsecret">
	<button class="btn btn-primary" value="true" name="appidsubmit" type="submit" style="margin-top:-10px" ><strong>保存</strong></button>
	
</form>
         </div>

 <div class="msgWrap form">
       <form enctype="multipart/form-data" action="" method="post"><input type="hidden" value="" name="anchor">
       
		  
    <table width="100%" cellspacing="0" cellpadding="0" border="0" class="ListProduct"> 
<thead>
<tr>
	<th style=" width:60px;">显示顺序</th>
	<th style=" width:220px;">主菜单名称</th>
	<th style=" width:170px;">菜单类型</th>
	<th>类型数值</th>
	<th class="norightborder" style=" width:160px;">操作</th>
</tr>
</thead>
   <tbody>
  	<?php if(is_array($class)): $i = 0; $__LIST__ = $class;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$class): $mod = ($i % 2 );++$i;?><tr class="hover">
        <td class="td25">
			<span><?php echo ($class["sort"]); ?></span>
		</td>
        <td>
          <div>
			<span><?php echo ($class["title"]); ?></span>
          </div>
        </td>
        <td>
        	<span>
        		
	        	    <?php if($class["keyword"] != ''): ?>顶级菜单-【关键词回复菜单】
		        	<?php elseif($class["url"] != ''): ?>
		        		顶级菜单-【url外链菜单】
		        	<?php elseif($class["wxsys"] != ''): ?>
		        		顶级菜单-【微信扩展菜单】
		        	<?php else: ?>
		        		父级菜单<?php endif; ?>
        	</span>
        </td>
        <td>
        	<span>
			 		<?php if($class["keyword"] != ''): echo ($class["keyword"]); ?>
		        	<?php elseif($class["url"] != ''): ?>
		        		<?php echo ($class["url"]); ?>
		        	<?php elseif($class["wxsys"] != ''): ?>
		        		<?php echo ($class["wxsys"]); ?>
		        	<?php else: ?>
		        		无<?php endif; ?>
        	</span>
        
        </td>
        <td>

			<a href="<?php echo U('Diymen/class_edit',array('id'=>$class['id']));?>"   title="修改主菜单" class="btn btn-primary btn_submit  J_ajax_submit_btn">修改</a>
			<a class="btn" href="<?php echo U('Diymen/class_del',array('id'=>$class['id']));?>">删除</a>
		</td>				
      </tr>
	  <?php if(is_array($class['class'])): $i = 0; $__LIST__ = $class['class'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$class1): $mod = ($i % 2 );++$i;?><tr class="td29">
			<td class="td25" colspan="1">
				<span><?php echo ($class1["sort"]); ?></span>
			</td>
			<td colspan="1">
			  <div class="board">
				<span><?php echo ($class1["title"]); ?></span>
			  </div>
			</td>
			
			<td colspan="1">
				<span>
					<?php if($class1["keyword"] != ''): ?>关键词回复菜单
		        	<?php elseif($class1["url"] != ''): ?>
		        		url外链菜单
		        	<?php elseif($class1["wxsys"] != ''): ?>
		        		微信扩展菜单<?php endif; ?>
				</span>
			</td>
			 <td>
			 	<span>
			 	
			 		<?php if($class1["keyword"] != ''): echo ($class1["keyword"]); ?>
		        	<?php elseif($class1["url"] != ''): ?>
		        		<?php echo ($class1["url"]); ?>
		        	<?php elseif($class1["wxsys"] != ''): ?>
		        		<?php echo ($class1["wxsys"]); endif; ?>
			 	
			 	</span>
			 
			 </td>
			<td colspan="1">
			<a href="<?php echo U('Diymen/class_edit',array('id'=>$class1['id']));?>"   title="修改主菜单" class="btn btn-primary btn_submit  J_ajax_submit_btn">修改</a>
			<a class="btn" href="<?php echo U('Diymen/class_del',array('id'=>$class1['id']));?>">删除</a></td>				
	 </tr><?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
	<tr class="hover">
        <td class="td25" colspan="5">
		<?php if($class != false): ?><a class="btn btn-primary " href="<?php echo U('Diymen/class_send');?>" title="">生成自定义菜单</a><?php endif; ?>
		<span style="float:left;" id="cdul">
		<style>
			#cdul{
				float:left;
				color:red;
			}
		</style>
		注：<br>
		(使用前提是已经拥有了自定义菜单的用户才能够使用，)<br>
		第一步:必须先填写【AppId】【 AppSecret】！<br>
		第二步:添加菜单，<br>
		第三步:点击生成!<br>
		注意：1级菜单最多只能开启3个，2级子菜单最多开启5个<br>
		官方说明：修改后，需要重新关注，或者最迟隔天才会看到修改后的效果！<br>
		</span>
		</td>				
      </tr>
	      	  
    </tbody>
</table>
</form>
       <p>

       </p>
       <div class="clear"></div>
      </div>
  </div>
         </div>
        </dd>
</dl>
<div style="display:none">
<link href="tpl/static/simpleboot/themes/flat/theme.min.css" rel="stylesheet">
</div>