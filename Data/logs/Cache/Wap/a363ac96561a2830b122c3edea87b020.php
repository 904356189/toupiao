<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="format-detection" content="telephone=no">
<meta name="description" content="">

<title>Cron</title>
</head>
<body>
<!--main start-->
<div class="main" >
<script src="http://libs.baidu.com/jquery/1.8.3/jquery.min.js" type="text/javascript"></script> 




<!--content start-->
<style>
    .content{max-width: 640px;margin: 0 auto;}
    
    .content select,.content input{width: 100%;padding:5px 0px;}
    .content div{padding: 5px;}
    
</style>
<div class="content">
    <form action="" method="post">
          <div>
              <select name="vote" id="vote">
                        <option value="">选择项目</option>
                           <?php if(is_array($vote)): $i = 0; $__LIST__ = $vote;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$li): $mod = ($i % 2 );++$i;?><!-- ggt为图片分组 -->
                            <option value="<?php echo ($li["id"]); ?>"><?php echo ($li["title"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                  
              </select>
          </div>

           <div>
              <select name="item" id="item">
                  <option value="">请先选择项目后选择选手</option>
              </select>
          </div>


          <div><input type="text" name="openid" placeholder="" required></div>  
          <div><input type="text" name="ip" placeholder="" required></div>  
          <div><input type="text" name="city" placeholder="" required></div>  
          <div><input type="text" name="time" placeholder="" required></div>   
          <div><input type="text" name="token" placeholder="" required></div>   
          <div><input type="submit" value="提交"></div>
    </form>
</div>

<div>
   <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$li): $mod = ($i % 2 );++$i;?><p><?php echo ($li["item"]); ?>-<?php echo ($li["tourl"]); ?>-<?php echo ($li["wechat"]); ?></p><?php endforeach; endif; else: echo "" ;endif; ?>

</div>

<script>
    
$(function(){
   $("#vote").change(function(event) {
        var vote_id=$("#vote  option:selected").val();
        $.post('',{vote_id:vote_id,ajax:'1'}, function(data) {
            
            if(data.length>4){

                var dataObj=eval("("+data+")");  
                   for(var i=0;i<dataObj.length;i++){ 
                    $("#item").append("<option value='"+dataObj[i].id+"'>"+dataObj[i].item+"</option>")     
                        //console.log(dataObj[i].item)    
                   } 
                //console.log(dataObj);
            }else{
                $("#item option").eq(0).text("无可选选手")
            }
        });

        
   });
    
})
</script>




</body>
</html>