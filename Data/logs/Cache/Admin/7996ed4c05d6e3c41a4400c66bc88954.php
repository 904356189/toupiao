<?php if (!defined('THINK_PATH')) exit();?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>微联云多用户投票系统管理后台</title>
   
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="apple-mobile-web-app-capable" content="yes" />    
    
    <link href="<?php echo RES;?>/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?php echo RES;?>/css/bootstrap-responsive.min.css" rel="stylesheet" />
    
    <link href="<?php echo RES;?>/css/font-awesome.css" rel="stylesheet" />
    
    <link href="<?php echo RES;?>/css/adminia.css" rel="stylesheet" /> 
    <link href="<?php echo RES;?>/css/adminia-responsive.css" rel="stylesheet" /> 
    
    <link href="<?php echo RES;?>/css/pages/dashboard.css" rel="stylesheet" /> 
    <link href="<?php echo RES;?>/css/pages/faq.css" rel="stylesheet" />

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="<?php echo RES;?>/js/html5.js"></script>
    <![endif]-->
	
	<script src="<?php echo RES;?>/js/jquery-1.7.2.min.js"></script>
	
	

  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript">
	$(function(){

		var str = $(".widget-header h3").html();
		// alert(str.indexOf("&gt;"));
		var hstr = $.trim(str.substr(0, str.indexOf("&gt;")));
		var num = '';
		if(hstr == "站点设置")
			num = '1';
		else if(hstr == '用户管理')
			num = '2';
		else if(hstr == '内容管理')
			num = '3';
		else if(hstr == '公众号管理')
			num = '4';
		else if(hstr == '功能管理')
			num = '5'
		else if(hstr == '扩展管理')
			num = '6';

		var current = '#collapse' + num;
		$(current).css('height','auto').removeClass('collapse').addClass('in');

	})
</script>
</head>

<body>
	
<div class="navbar navbar-fixed-top">
	
	<div class="navbar-inner">
		
		<div class="container">
			
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> 
				<span class="icon-bar"></span> 
				<span class="icon-bar"></span> 
				<span class="icon-bar"></span> 				
			</a>
			
			<a class="brand" href="">微联云多用户投票系统</a>
			
			<div class="nav-collapse">
			
				<ul class="nav pull-right">

					
					<li class="divider-vertical"></li>
					
					<li class="dropdown">
						
						<a data-toggle="dropdown" class="dropdown-toggle " href="<?php echo U('Index/loginout');?>">
							退出系统 <b class="caret"></b>							
						</a>
						
						<ul class="dropdown-menu">
							
							<!--<li>
								<a href="/index.php?g=System&m=User&a=edit&id=1"><i class="icon-lock"></i> 密码修改</a>
							</li>-->
							
							<li class="divider"></li>
							
							<li>
								<a href="<?php echo U('Index/loginout');?>"><i class="icon-off"></i> 退出系统</a>
							</li>
						</ul>
					</li>
				</ul>
				
			</div> <!-- /nav-collapse -->
			
		</div> <!-- /container -->
		
	</div> <!-- /navbar-inner -->
	
</div> <!-- /navbar -->

<div id="content">
	
	<div class="container">
		
		<div class="row">
			
			<div class="span3">
				
				<ul id="main-nav" class="nav nav-tabs nav-stacked">
									
					<li class="active accordion-group">
		              <a class="accordion-toggle" data-toggle="collapse" data-parent="" href="#collapse2">
		                <i class="icon-user"></i>
		                用户管理
		              </a>

		              <div id="collapse2" class="accordion-body collapse" style="height: 0px; ">
					  
					   <a class="accordion-toggle" data-toggle="collapse" data-parent="" href="" onclick="javascript:window.location.href = '<?php echo U('Index/set');?>'">
		                  <i class="icon-share-alt"></i>
		                  基础设置
		                </a>
					  
		                <a class="accordion-toggle" data-toggle="collapse" data-parent="" href="" onclick="javascript:window.location.href = '<?php echo U('Index/user');?>'">
		                  <i class="icon-share-alt"></i>
		                  管理员中心
		                </a>
						
		                <a class="accordion-toggle" data-toggle="collapse" data-parent="" href="" onclick="javascript:window.location.href = '<?php echo U('Index/qtuser');?>'">
		                  <i class="icon-share-alt"></i>
		                  前台用户
		                </a>
		              </div>
					</li>
				</ul>	
			
				<br />
		
			</div> <!-- /span3 -->
				
			<div class="span9">

				<div class="widget widget-table">
										
					<div class="widget-header">
						<i class="icon-th-list"></i>
						<h3>用户管理 >>  用户中心 >> 
						
						添加用户
						
						</h3>
					</div> <!-- /widget-header -->
					
					<div class="widget-content">

		 <form action="" method="post" >
			<table class="table table-striped table-bordered" style="margin-top:10px;" id="set_table" <?php if(($info["id"]) > "0"): else: ?>style="display:none"<?php endif; ?>>

				 <tr>
					<th colspan="4"><?php echo ($title); ?></th>
				</tr>
				<tr>
					<td><strong>用户名称：</strong></td>
					<td colspan="3" class="lt">
						<input type="text" name="username" class="ipt" size="45" value="<?php echo ($info["username"]); ?>" >
					</td>
				</tr>
				<tr>
					<td><strong>密　　码：</strong></td>
					<td colspan="3" class="lt">
						<input type="password" name="password" class="ipt" size="45" value="" >
					</td>
				</tr>
		
				<tr>
					<td><strong>用户活动名称：</strong></td>
					<td colspan="3" class="lt">
						<input type="text" name="tel" class="ipt" size="45" value="<?php echo ($info["tel"]); ?>" />
					</td>
				</tr>

				<tr>
					<td><strong>用可创建活动数：</strong></td>
					<td colspan="3" class="lt">
						<input type="text" name="sum" class="ipt" size="45" value="<?php echo ($sum); ?>" />
					</td>
				</tr>

				<tr>
					<td><strong>到期时间：</strong></td>
					<td colspan="3" class="lt">
						<input type="text" name="overtime" class="ipt" size="45" value="<?php echo ($free_time); ?>">
					</td>
				</tr>

				<tr>
					<td height="48" align="right"><strong>用户状态：</strong></td>
					<td colspan="3" class="lt">
						<input type="radio" class="radio" class="ipt" value="1" name="status" id="status1" checked="" >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="status" id="status2" <?php if(($info["status"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭
					</td>
				</tr>
			
				
			

	<tr>
		<td colspan="4">
		
			
				<input class="btn" type="submit" name="dosubmit" value="添 加" >
				
		
			<input class="btn" type="button" onclick="javascript:history.back(-1);" value="返 回" ></td>
	</tr>
</table>
</form>

					
					</div> <!-- /widget-content -->
					
				</div> <!-- /widget -->
			
			</div> <!-- /span9 -->
			
			
		</div> <!-- /row -->
		
	</div> <!-- /container -->
	
</div> <!-- /content -->
					
	
<div class="navbar navbar-fixed-bottom">
	<div class="navbar-inner" style="text-align: center;color:#fff;">
		微联云多用户投票系统 版权所有 2014-2016
	</div>
</div>


    

<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

<script src="<?php echo RES;?>/js/excanvas.min.js"></script>
<script src="<?php echo RES;?>/js/common.js"></script>
<script src="<?php echo RES;?>/js/jquery.flot.js"></script>
<script src="<?php echo RES;?>/js/jquery.flot.pie.js"></script>
<script src="<?php echo RES;?>/js/jquery.flot.orderBars.js"></script>
<script src="<?php echo RES;?>/js/jquery.flot.resize.js"></script>



<script src="<?php echo RES;?>/js/bootstrap.js"></script>
<script src="<?php echo RES;?>/js/charts/bar.js"></script>
  </body>
</html>