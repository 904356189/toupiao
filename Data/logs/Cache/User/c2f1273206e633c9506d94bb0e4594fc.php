<?php if (!defined('THINK_PATH')) exit();?>﻿<style>
 .userinfoarea th {
text-align: left;
width: 145px;
height: 30px;
font-size: 14px;
font-weight: bold;
line-height: 30px;
padding: 8px 0;
}
.userinfoarea td {
margin-left: 10px;
padding: 8px 0;
color: #666;
font-size: 12px;
height: 50px;
}
.userinfoarea td .px{ height:35px}
.right{}
 </style>
<div class="content" style="margin-left:20px; height:400px">
<link href="<?php echo RES;?>/css/style.css?id=100" rel="stylesheet" type="text/css" />
          <div class="cLineB"><h4>修改密码</h4><a href="<?php echo U('User/Vote/index');?>" class="right btn btn-primary btn_submit  J_ajax_submit_btn" style="margin-top:-27px">返回</a></div>
          <form method="post" action="<?php echo U('Index/usersave');?>" enctype="multipart/form-data">
          <div class="msgWrap">
            <table class="userinfoArea" border="0" cellspacing="0" cellpadding="0" width="100%">
             
              <tbody>
				<tr>
                	<th>&nbsp;&nbsp;&nbsp;&nbsp;<span class="red">*</span>修改密码</th>
                	<td><input type="password" class="px"  value="" name="password">　请注意区分大小写 更改后重新登录生效。</td>
                </tr>
                 <tr>
                 	<th></th>
                 	<td><button type="submit" name="button" class="btn btn-primary btn_submit  J_ajax_submit_btn">提交</button></td>
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