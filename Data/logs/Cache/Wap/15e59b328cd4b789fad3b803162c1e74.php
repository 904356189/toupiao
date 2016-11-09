<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=uft-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
    <meta content="yes" name="apple-mobile-web-app-capable">
    <meta content="black" name="apple-mobile-web-app-status-bar-style">
    <meta content="telephone=no" name="format-detection">
    <meta charset="uft-8">
    <title><?php echo ($vote["title"]); ?></title>
    <meta name="description" content="<?php echo ($vote["title"]); ?>">
    <link rel="stylesheet" href="<?php echo STATICS;?>/vote/index<?php echo ($vote['moban']); ?>/touch.css">    
	<script type="text/javascript" src="<?php echo STATICS;?>/vote/index<?php echo ($vote['moban']); ?>/jquery-2.1.3.min.js"></script>

                 <script type="text/javascript" src="<?php echo STATICS;?>/vote/index<?php echo ($vote['moban']); ?>/app.js"></script>
                 <script type="text/javascript" src="<?php echo STATICS;?>/vote/index<?php echo ($vote['moban']); ?>/jquery.masonry.min.js"></script>
  <style>
.slider{display:none;}
.focus span{width:5px;height:5px;margin-left:5px;border-radius:50%;background:#CDCDCD;font-size:0}
.focus span.current{background:red;}
</style>
                
    </head>
<body>
<header>

    <img src="<?php echo ($vote["wappicurl"]); ?>" alt="shareImg" width="0px" height="0px"/>  

    <div class="m_head clearfix">
    	<?php if(!empty($ggduotu)): ?><div class="slider">
		<ul>
        <?php if(is_array($ggpic)): $i = 0; $__LIST__ = $ggpic;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$li): $mod = ($i % 2 );++$i;?><!-- ggt为图片分组 -->
	    					<li><a href="#"><img src="<?php echo ($li["ggurl"]); ?>"/></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
				  	</ul>
		</div>
       <?php else: ?>
        	<img src="<?php echo ($ggpic[0]['ggurl']); ?>" title="<?php echo ($vote["title"]); ?>"><?php endif; ?>


       <div class="num_box">
            <?php if($ishavezp == 1): ?><a href="<?php echo U('Vote/detail',array('token'=>$token,'id'=>$id,'zid'=>$havezpid));?>" class="join_us">我的参赛</a>
			<?php else: ?>
			<?php if($istime == 1): ?><a href="<?php echo U('Vote/signup',array('token'=>$token,'id'=>$id));?>" class="join_us">我要报名</a><?php endif; endif; ?>          
            <ul class="num_box_ul">
                <li>
                    <span class="text">已报名</span>
                    <span><?php echo ($rc); ?></span>
                </li>
                <li>
                    <span class="text">投票人次</span>
                    <span><?php echo ($tpl); ?></span>
                </li>
                <li>
                    <span class="text">浏览量</span>
                    <span><?php echo ($check); ?></span>
                </li>
            </ul>
            <img src="<?php echo STATICS;?>/vote/index<?php echo ($vote['moban']); ?>/mw_004.jpg" />
        </div>
            </div>
</header>   

<script type="text/javascript" src="<?php echo STATICS;?>/vote/js/exif.js"></script>
    <script type="text/javascript" src="<?php echo STATICS;?>/vote/js/binaryajax.js"></script>
    <script type="text/vbscript">
    Function IEBinary_getByteAt(strBinary, iOffset)
        IEBinary_getByteAt = AscB(MidB(strBinary, iOffset + 1, 1))
    End Function
    Function IEBinary_getBytesAt(strBinary, iOffset, iLength)
      Dim aBytes()
      ReDim aBytes(iLength - 1)
      For i = 0 To iLength - 1
       aBytes(i) = IEBinary_getByteAt(strBinary, iOffset + i)
      Next
      IEBinary_getBytesAt = aBytes
    End Function
    Function IEBinary_getLength(strBinary)
        IEBinary_getLength = LenB(strBinary)
    End Function
    </script>
<script type="text/javascript" src="<?php echo STATICS;?>/vote/js/localResizeIMG2.js"></script>
<script type="text/javascript" src="<?php echo STATICS;?>/vote/js/mobileBUGFix.mini.js"></script>

    <div class="apply">
        <p>报名处</p>
        <div class="blank10"></div>

        <form action="" id="signupok" method="post" accept-charset="utf-8">
         
         <input type="hidden" name="id" value="<?php echo ($id); ?>" />
		 <input type="hidden" name="token" value="<?php echo ($token); ?>" />
            <dl class="clearfix">
                <dt>姓名:</dt>
                <dd><input type="text" class="input_txt" id="zpname" value="" name="zpname" placeholder="请输入姓名:"></dd>
            </dl>
            <dl class="clearfix">
                <dt>微信号:</dt>
                <dd><input type="text" class="input_txt" id="wechat" value="" name="wechat" placeholder="请输入姓名:"></dd>
            </dl>
            <dl class="clearfix">
                <dt>联系电话:</dt>
                <dd><input type="number" class="input_txt" value="" name="telphone" id="telphone" placeholder="请输入您的真实手机号"></dd>
            </dl>
            <dl class="upload clearfix">
                <dt>上传照片<br><?php if(($picnum) == "1"): ?>1<?php else: ?>1-<?php echo ($picnum); endif; ?>张:</dt>
                <dd class="upload_area clearfix">
                    <ul id="imglist" class="post_imglist"></ul>
                    <div class="upload_btn">
                        <input type="file" id="upload_image" value="图片上传" accept="image/jpeg,image/gif,image/png" capture="camera">
                    </div>
                </dd>
            </dl>
            <dl class="clearfix">
                <dt>参赛宣言:</dt>
                <dd><textarea class="textarea" placeholder="请输入参赛宣言" name="content" id="content"></textarea></dd>
            </dl>
            <div style="color: #EC6941;font-size: 16px;padding: 0 15px 15px 15px; line-height:24px; font-weight:bolder;"><?php echo ($vote['wfbmsm']); ?></div> <!-- 无法报名说明 -->
                        <div class="btn_box">
                <input type="submit" name="signup" class="button" value="确认报名">
				<br>
				 <input type="button" onclick="javascript:location.href='<?php echo U('Vote/index',array('token'=>$token,'id'=>$id));?>';" class="button" value="返回首页">
            </div>
            <div class="blank10"></div>
        </form>
    </div>
</div>
<section class="rules">
 
 <div class="text">
 <?php if(!empty($vote["shumat"])): ?><div class="prize"><?php echo ($vote['shumat']); ?></div>
            <div class="neirong"><?php  echo html_entity_decode(htmlspecialchars_decode($vote['shuma'])); ?></div><?php endif; ?>
    <?php if(!empty($vote["shumbt"])): ?><div class="prize"><?php echo ($vote['shumbt']); ?></div>
            <div class="neirong"><?php  echo html_entity_decode(htmlspecialchars_decode($vote['shumb'])); ?></div><?php endif; ?>
</div>
<div class="text">
  <?php if(!empty($vote["shumct"])): ?><div class="prize"><?php echo ($vote['shumct']); ?></div>
            <div class="neirong"><?php  echo html_entity_decode(htmlspecialchars_decode($vote['shumc'])); ?></div><?php endif; ?>
</div>
    <div style=" height:60px; width:100%; display:block;"></div>

</section>


<section>
<?php if($bmzt == 1): ?><div class="pop" id="guanzhu" style="display:block">
        <div class="mengceng"></div>
        <div class="pop_up">
                        <p class="tit_p">报名还未开始</p>
            <p class="tit_txt">请<?php echo (date('Y-m-d H:i:s',$vote[start_time])); ?>后再来！</p>
            
        </div>
    </div>
<?php elseif($bmzt == 2): ?>
    <div class="pop" id="guanzhu" style="display:block">
        <div class="mengceng"></div>
        <div class="pop_up">
                        <p class="tit_p">对不起！报名已经结束！</p>
        </div>
    </div>
<?php elseif($bmzt == 3): ?>

	<?php else: endif; ?>
</section>

<div id="console"></div>

<!-- <link rel="stylesheet" type="text/css" href="<?php echo STATICS;?>/vote/index2/daohang.css">
<div class="bot_main">
  <ul>
    <li class="ico_1"><span class="ico"><img src="<?php echo STATICS;?>/vote//index2/i1.png" /></span><span class="txt">首页</span></li>
    <li class="ico_2"><span class="ico"><img src="<?php echo STATICS;?>/vote//index2/i3.png" /></span><span class="txt">排名</span></li>
    <li class="ico_3"><span class="ico"><img src="<?php echo STATICS;?>/vote//index2/i11.png" /></span><span class="txt"><?php if(!empty($ishavezp)): ?>我的<?php else: ?>报名<?php endif; ?></span></li>
    <li class="ico_4"><span class="ico"><img src="<?php echo STATICS;?>/vote/index2/i4.png" /></span><span class="txt">自定义</span></li>
  </ul>
</div> -->
 
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script type="text/javascript">
    wx.config({
        debug: false, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
       appId: '<?php echo ($signPackage["appId"]); ?>', // 必填，公众号的唯一标识
        timestamp: "<?php echo ($signPackage["timestamp"]); ?>", // 必填，生成签名的时间戳
        nonceStr: '<?php echo ($signPackage["nonceStr"]); ?>', // 必填，生成签名的随机串
        signature: '<?php echo ($signPackage["signature"]); ?>',// 必填，签名，见附录1
        jsApiList: ['onMenuShareTimeline', 'onMenuShareAppMessage'] // 必填，需要使用的JS接口列表，所有JS接口列表见附录2
    });

  wx.ready(function(){
        wx.error(function(res){
            console.log(res);
        });
        //朋友圈
        wx.onMenuShareTimeline({
            title: "<?php echo ($vote['title']); ?>", // 分享标题
            link: "<?php echo C('site_url'); echo U('Vote/index',array('token'=>$token,'id'=>$id));?>", // 分享链接
            imgUrl: "<?php echo ($vote['wappicurl']); ?>", // 分享图标
            success: function () {
                // 用户确认分享后执行的回调函数
            },
            cancel: function () {
                // 用户取消分享后执行的回调函数
            }
        });

        //分享给朋友
        wx.onMenuShareAppMessage({
            title: "<?php echo ($vote['title']); ?>", // 分享标题
            desc: "<?php echo ($vote['fxms']); ?>", // 分享描述
            link: "<?php echo C('site_url'); echo U('Vote/index',array('token'=>$token,'id'=>$id));?>", // 分享链接
            imgUrl: "<?php echo ($vote['wappicurl']); ?>", // 分享图标
            type: '', // 分享类型,music、video或link，不填默认为link
            dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
            success: function () {
                // 用户确认分享后执行的回调函数
            },
            cancel: function () {
                // 用户取消分享后执行的回调函数
            }
        });
    });
</script>
 
<script type="text/javascript">
    (function () {
        var viewImg = $("#imglist");
        var imgurl = '';
        var imgcount = 0;
        $('#upload_image').localResizeIMG({
            width: 480,
            quality: 0.8,
            success: function (result) {
                var status = true;
                if (result.height > 1600) {
                    status = false;
                    alert("照片最大高度不超过1600像素");
                }
                if (viewImg.find("li").length > <?php echo ($xzpic); ?>) {
                    status = false;
                    alert("最多上传<?php echo ($picnum); ?>张照片");
                }
                if (status) {
                    viewImg.append('<li><span class="pic_time"><span class="p_img"></span><em>50%</em></span></li>');
                    viewImg.find("li:last-child").html('<span class="del"></span><img class="wh60" src="' + result.base64 + '"/><input type="hidden" id="file'
                    + imgcount
                    + '" name="fileup[]" value="'
                    + result.clearBase64 + '">');

                    $(".del").on("click",function(){
                        $(this).parent('li').remove();
                        $("#upload_image").show();
                    });
                    imgcount++;
                }
            }
        });
    })();
</script>
<script type="text/javascript">
$(function($){
	$("#signupok").submit(function(){
		var name = $("#zpname").val();
		var tel = $("#telphone").val();
		var content = $("#content").val();

		if(name.length == 0){alert('请输入姓名');return false;}

		var telreg = /^1[3|4|5|7|8][0-9]\d{8}$|^\d{8}$/;
		if (tel.length == 0) {alert("请输入您的真实手机号"); return false;}
		if (!telreg.test(tel)){alert("请输入正确的手机号！");return false;}


		var length = $("#imglist").find("li").length;
		if(length == ''|| length == null  || length == undefined || length == 'undefined' || length < 1 ){alert('请上传1张以上图片');return false;}
		if(content== '' || content == null || content == undefined || content == 'undefined' ){alert('请输入参赛宣言');return false;}
	});
});


$('.ico_1').on('click', function(){
  location.href = "<?php echo U('Vote/index',array('token'=>$token,'id'=>$id));?>";
});
$('.ico_2').on('click', function(){
  location.href = "<?php echo U('Vote/top',array('token'=>$token,'id'=>$id));?>";
});
$('.ico_3').on('click', function(){ 
 <?php if(!empty($ishavezp)): ?>location.href = "<?php echo U('Vote/detail',array('token'=>$token,'id'=>$id,'zid'=>$havezpid));?>";
  <?php else: ?>
  	<?php if($vote['start_time'] < time() && $vote['over_time'] > time()): ?>location.href = "<?php echo U('Vote/singup',array('token'=>$token,'id'=>$id));?>";
  	<?php else: ?>
  		<?php if($vote['start_time'] > time()): ?>$('#voting_title').html("<?php echo date('Y-m-d H:i:s',$vote['start_time']); ?>后才能报名");
						$('#voting_content').html('');
                        $('#voting').show();
  		<?php else: ?>
						$('#voting_title').html('报名已结束！');
						$('#voting_content').html('');
                        $('#voting').show();<?php endif; endif; endif; ?>
});
$('.ico_4').on('click', function(){
	location.href = "<?php echo ($vote['dbdhurl']); ?>";  //底部导航链接 
});

</script>
<div style="display:none;">
<script src="http://s4.cnzz.com/stat.php?id=1257172712&web_id=1257172712" language="JavaScript">
</script></div>
<?php if(!empty($ggduotu)): ?><!-- 判断首页幻灯片是否为多图  -->
  <script type="text/javascript" src="<?php echo STATICS;?>/vote/slider/yxMobileSlider.js"></script>
<script type="text/javascript">
	$(".slider").yxMobileSlider({during:5000,height:<?php echo ($user['hdgd']); ?>});   //height可以设置首页幻灯片高度
	var nowtime=new Date().getTime();
	function _fresh(){
		var endtime=new Date("2015/02/18 12:00:00");//这里设置的时间为2011年，您可以修改为其它时间。
		//var nowtime = new Date();
		var leftsecond=parseInt((endtime.getTime()-nowtime)/1000);
		if(leftsecond<0){leftsecond=0;}
			__d=parseInt(leftsecond/3600/24);
			__h=parseInt((leftsecond/3600)%24);
			__m=parseInt((leftsecond/60)%60);
			__s=parseInt(leftsecond%60);
		var sums=__d+__h+__m+__s;
		var if_Receive="";
		if(sums!=0){
			var d=document.getElementById("_d");
			var h=document.getElementById("_h");
			var m=document.getElementById("_m");
			var s=document.getElementById("_s");
			h.innerHTML=__h+__d*24;
			m.innerHTML=__m;
			s.innerHTML=__s;
		nowtime=nowtime+1000;
		setTimeout(_fresh,1000);
		}else if(!if_Receive){
			document.getElementById("msg").innerHTML="";
		}
	}
	_fresh();
</script><?php endif; ?>

<div style="display:none">
<?php  echo html_entity_decode(htmlspecialchars_decode($vote['cnzz'])); ?>
	</div></body>
</html>