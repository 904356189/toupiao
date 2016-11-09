<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title><?php echo C('site_name');?></title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="apple-mobile-web-app-capable" content="yes" />    
    
    <link href="<?php echo RES;?>/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?php echo RES;?>/css/bootstrap-responsive.min.css" rel="stylesheet" />
    
    <link href="<?php echo RES;?>/css/font-awesome.css" rel="stylesheet" />
    
    <link href="<?php echo RES;?>/css/adminia.css" rel="stylesheet" /> 
    <link href="<?php echo RES;?>/css/adminia-responsive.css" rel="stylesheet" /> 
    
    <link href="<?php echo RES;?>/css/pages/login.css" rel="stylesheet" /> 

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="<?php echo RES;?>/js/html5.css"></script>
    <![endif]-->
	
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>

<body>
	
<div class="navbar navbar-fixed-top">
	
	<div class="navbar-inner">
		
		<div class="container">
			
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> 
				<span class="icon-bar"></span> 
				<span class="icon-bar"></span> 
				<span class="icon-bar"></span> 				
			</a>
			
			<a class="brand" href="./"><?php echo C('site_name');?></a>
			
			<div class="nav-collapse">
			
				<ul class="nav pull-right">
					
					<li class="">
						
						<a href="/"><i class="icon-chevron-left"></i> 回到前台首页</a>
					</li>
				</ul>
				
			</div> <!-- /nav-collapse -->
			
		</div> <!-- /container -->
		
	</div> <!-- /navbar-inner -->
	
</div> <!-- /navbar -->


<div id="login-container">
	
	
	<div id="login-header">
		
		<h3>登陆</h3>
		
	</div> <!-- /login-header -->
	
	<div id="login-content" class="clearfix">
	
	<form action="index.php?g=Admin&m=Index&a=dologin" method="post"/>
				<fieldset>
					<div class="control-group">
						<label class="control-label" for="user">管理员账号</label>
						<div class="controls">
							<input type="text" name="user" id="user" value="" />
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="password">管理员密码</label>
						<div class="controls">
							<input type="password" name="password" id="password" value="" />
						</div>
					</div>
				</fieldset>
				

				
				<div class="">
					<input value="Login" type="submit" class="btn btn-warning btn-large" style="width:383px;">
				</div>
			</form>
			
		</div> <!-- /login-content -->
		
		
		<div id="login-extra">
			
			<p>&copy;名邦网络2016投票系统后台管理</p>
			
		</div> <!-- /login-extra -->
	
</div> <!-- /login-wrapper -->

    

<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="<?php echo RES;?>/js/jquery-1.7.2.min.js"></script>


<script src="<?php echo RES;?>/js/bootstrap.js"></script>

  </body>
</html>