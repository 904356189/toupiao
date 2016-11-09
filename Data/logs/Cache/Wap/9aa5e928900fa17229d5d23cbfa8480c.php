<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=uft-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
    <meta content="yes" name="apple-mobile-web-app-capable">
    <meta content="black" name="apple-mobile-web-app-status-bar-style">
    <meta content="telephone=no" name="format-detection">
    <meta charset="uft-8">
    <title>我是<?php echo ($zpinfo['item']); ?> 编号:<?php echo ($zpinfo['id']); ?>,正在参加<?php echo ($vote['title']); ?>,快来帮我投票吧!</title>
    <meta name="description" content="<?php echo ($vote['title']); ?>">
     <link rel="stylesheet" href="<?php echo STATICS;?>/vote/index<?php echo ($vote['moban']); ?>/touch.css">  
	<script type="text/javascript" src="<?php echo STATICS;?>/vote/index<?php echo ($vote['moban']); ?>/jquery-2.1.3.min.js"></script>

                   <script type="text/javascript" src="<?php echo STATICS;?>/vote/index<?php echo ($vote['moban']); ?>/app.js"></script>
                 <script type="text/javascript" src="<?php echo STATICS;?>/vote/index<?php echo ($vote['moban']); ?>/jquery.masonry.min.js"></script>
  <style>
.slider{display:none;}
.focus span{width:5px;height:5px;margin-left:5px;border-radius:50%;background:#CDCDCD;font-size:0}
.focus span.current{background:red;}

#mcover {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.7);
    display: none;
    z-index: 20000;
}
#mcover img {
    position: fixed;
    right: 18px;
    top: 5px;
    width: 260px!important;
    height: 180px!important;
    z-index: 20001;
}


		.guide-close:after{content:'';position:absolute;left:50%;bottom:18px;width:20px;height:20px;background:url("<?php echo STATICS;?>/ico-close.png") no-repeat;-webkit-background-size:100% auto;-moz-background-size:100% auto;background-size:100% auto;opacity:.55}
</style>

<style>
            /*闊充箰鍥炬爣*/
            #audio_btn {
                position: absolute;
                right: 10px;
                top: 18px;
                z-index: 200;
                display: none;
                width: 50px;
                height: 50px;
                background-repeat: no-repeat;
                cursor: pointer;
            }
            .loading_background {
                background-image: url(http://ap.haoxiangc.com/source/plugin/hejin_toupiao/public/music/music_loading.gif);
                background-size: 30px 30px;
                opacity: 0.5;
                background-position: center center;
            }
            .loading_yinfu {
                position: absolute;
                left: 10px;
                top: 10px;
                width: 30px;
                height: 30px;
                background-image: url(http://ap.haoxiangc.com/source/plugin/hejin_toupiao/public/music/music_yinfu.png);
                background-repeat: no-repeat;
                background-position: center center;
            }
            .play_yinfu {
                background-image: url(http://ap.haoxiangc.com/source/plugin/hejin_toupiao/public/music/music.gif);
                background-repeat: no-repeat;
                background-position: center center;
                background-size: 60px 60px;
            }
            .rotate {
                position: absolute;
                left: 10px;
                top: 10px;
                width: 30px;
                height: 30px;
                background-size: 100% 100%;
                background-image: url(http://ap.haoxiangc.com/source/plugin/hejin_toupiao/public/music/music_off.png);
                -webkit-animation: rotating 1.2s linear infinite;
                -moz-animation: rotating 1.2s linear infinite;
                -o-animation: rotating 1.2s linear infinite;
                animation: rotating 1.2s linear infinite;
            }
            @-webkit-keyframes rotating {
                from {
                    -webkit-transform: rotate(0deg);
                }
                to {
                    -webkit-transform: rotate(360deg);
                }
            }
            @keyframes rotating {
                from {
                    transform: rotate(0deg);
                }
                to {
                    transform: rotate(360deg);
                }
            }
            @-moz-keyframes rotating {
                from {
                    -moz-transform: rotate(0deg);
                }
                to {
                    -moz-transform: rotate(360deg);
                }
            }
            .off {
                background-image: url(http://ap.haoxiangc.com/source/plugin/hejin_toupiao/public/music/music_no.png);
                background-size: 30px 30px;
                background-repeat: no-repeat;
                background-position: center center;
            }
</style>

<script>
$(function() {
                    var audio = $('#media');
                    audio[0].play();
                    $("#audio_btn").bind('click', function() {
                        $(this).hasClass("off") ? ($(this).addClass("play_yinfu").removeClass("off"), $("#yinfu").addClass("rotate"), $("#media")[0].play()) : ($(this).addClass("off").removeClass("play_yinfu"), $("#yinfu").removeClass("rotate"), $("#media")[0].pause());
                    });
                }); 
var scroll = document.getElementById("scroll");
var scroll1 = document.getElementById("scroll1");
var scroll2 = document.getElementById("scroll2");
scroll2.innerHTML=document.getElementById("scroll1").innerHTML;
function Marquee(){
if(scroll.scrollLeft-scroll2.offsetWidth>=0){
 scroll.scrollLeft-=scroll1.offsetWidth;
}
else{
 scroll.scrollLeft++;
}
}
var myvar=setInterval(Marquee,30);
scroll.onmouseout=function (){myvar=setInterval(Marquee,30);}
scroll.onmouseover=function(){clearInterval(myvar);}
</script>
                
    </head>
<body>
<div class="video_exist play_yinfu" id="audio_btn" style="display: block;">
<div id="yinfu" class="rotate"></div>
<audio preload="auto" autoplay id="media" src="<?php echo ($vote["music"]); ?>" loop></audio>
</div>

<?php if(!empty($zpinfo['startpicurl'])): ?><img src="<?php echo ($zpinfo['startpicurl']); ?>"  alt="shareImg" width="0px" height="0px"><?php endif; ?>


<header>
    <div class="m_head clearfix">
    	<?php if(!empty($ggduotu)): ?><div class="slider">
		<ul>
        <?php if(is_array($ggpic)): $i = 0; $__LIST__ = $ggpic;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$li): $mod = ($i % 2 );++$i;?><!-- ggt为图片分组 -->
	    					<li><a href="#"><img src="<?php echo ($li["ggurl"]); ?>"/></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
				  	</ul>
		</div>
       <?php else: ?>
        	<img src="<?php echo ($ggpic[0]['ggurl']); ?>" title="<?php echo ($vote["title"]); ?>"><?php endif; ?>


        
            </div>
</header>

<section class="content" id="get_info" data-rid="503" data-sort="" data-kw="" data-page="">
    <div class="detial_box">
        <span class="closed close_detial_box" data-refer="1">&nbsp;</span>
        <p class="num clearfix">
            <span class="fl" id="baby_info" itid_id="<?php echo ($zpinfo['id']); ?>" data-rule_id="503" data-vote_num="<?php echo ($vote['id']); ?>"><?php if($zpinfo["status"] == 0): ?>审核中<?php elseif($zpinfo["status"] == 2): ?>已锁定<?php else: endif; ?>&nbsp;<?php echo ($zpinfo['id']); ?>号&nbsp;<?php echo ($zpinfo['item']); ?></span>
            <span class="fr">排名：<?php echo ($mingci); ?>&nbsp;&nbsp;&nbsp;&nbsp; 票数：<?php echo ($zpinfo['vcount']); ?></span>
        </p>
        <div class="blank10"></div>
        <p>作品简介：<?php echo ($zpinfo['intro']); ?></p>
        <div class="blank10"></div>
        				<?php if(!empty($zpinfo["startpicurl"])): ?><img src="<?php echo ($zpinfo['startpicurl']); ?>" alt=""><?php endif; ?>
					   <?php if(!empty($zpinfo["startpicurl2"])): ?><img src="<?php echo ($zpinfo['startpicurl2']); ?>" alt=""><?php endif; ?>
					   <?php if(!empty($zpinfo["startpicurl3"])): ?><img src="<?php echo ($zpinfo['startpicurl3']); ?>" alt=""><?php endif; ?>
					   <?php if(!empty($zpinfo["startpicurl4"])): ?><img src="<?php echo ($zpinfo['startpicurl4']); ?>" alt=""><?php endif; ?>
					   <?php if(!empty($zpinfo["startpicurl5"])): ?><img src="<?php echo ($zpinfo['startpicurl5']); ?>" alt=""><?php endif; ?>
        				
                    </div>
    <div class="blank10"></div>
	 <div id="mcover" class="guide-close" onClick="$(this).hide()"  >
              <img src="<?php echo STATICS;?>/guide.png" />
     </div>
    <div class="abtn_box">
        <?php if(($zpinfo["status"]) == "1"): ?><a href="" class="a_btn toupiao vote" id="vote" data-itid="<?php echo ($zpinfo['id']); ?>">我要投票</a><?php endif; ?>
		<a href="javascript:void(0)" onclick="$('#mcover').show()" class="a_btn" >帮TA拉票</a>
        <?php if(empty($ishavezp)): ?><a href="<?php echo U('Vote/signup',array('token'=>$token,'id'=>$id));?>" class="a_btn canjia">我也来参加</a><?php endif; ?> 
        <a href="<?php echo U('Vote/index',array('token'=>$token,'id'=>$id));?>" class="a_btn look">点击查看更多</a>
    </div>
</section>
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
 
   
<?php if(!empty($user["duoshuo"])): ?><div class="text">   
<!-- 多说评论框 start -->
	<div class="ds-thread" style="padding:0 5px;" data-thread-key="<?php echo ($zpinfo['id']); ?>" data-title="<?php echo ($zpinfo['id']); ?>号<?php echo ($zpinfo['item']); ?>" data-url="<?php echo C('site_url');?>/index.php?g=Wap&m=Vote&a=detail&token=<?php echo ($token); ?>&id=<?php echo ($id); ?>&zid=<?php echo ($zpinfo['id']); ?> "></div>
<!-- 多说评论框 end -->
<!-- 多说公共JS代码 start (一个网页只需插入一次) -->
<script type="text/javascript">
var duoshuoQuery = {short_name:"<?php echo ($user['duoshuourl']); ?>"};
	(function() {
		var ds = document.createElement('script');
		ds.type = 'text/javascript';ds.async = true;
		ds.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') + '//static.duoshuo.com/embed.js';
		ds.charset = 'UTF-8';
		(document.getElementsByTagName('head')[0] 
		 || document.getElementsByTagName('body')[0]).appendChild(ds);
	})();
	</script>
<!-- 多说公共JS代码 end -->
</div><?php endif; ?>
<div style=" height:25px; width:100%; display:block;"></div>
</section>
<div class="bottom_khdxz" style="display:none">
            <a href="" class="footer-logo deyi-logo"><br></a>
        <a href="" class="footer-logo wft-logo"><br></a>
        <span class="bottom_khdxz_close"><i>&nbsp;</i></span>
    </div>
<script type="text/javascript">
    $(function(){
        $(".close_detial_box").on('click',function(){
                window.location.href = "<?php echo U('Vote/index',array('token'=>$token,'id'=>$id));?>";
        });
    });
</script>
<section>
     <div class="pop" id="guanzhu" style="display:none" >
        <div class="mengceng"></div>
        <div class="pop_up">
                        <p class="tit_p"><?php echo ($user["ydgzbt"]); ?></p> <!--  引导关注标题 -->
            <p class="tit_txt"><?php echo ($vote["ydgzts"]); ?></p> <!--  微信引导关注提示语 -->
            <a href="<?php echo ($vote["wxgzurl"]); ?>" class="gz_btn"><?php echo ($user["ydgzan"]); ?></a> <!-- 引导用户关注按钮名称 -->
                    </div>   <!-- 投票引导关注链接 -->
    </div>
    <div class="pop" id="voted" style="display:none;">
        <div class="mengceng"></div>
        <div class="pop_up">
            <span class="closed close_pop_up" id="toupiaook">&nbsp;</span>
            <p class="tit_p" id="dia_title">投票成功!</p>
            <p class="tit_txt" id="content">恭喜您为您支持的作品投上了一票！</p>                   <!-- 投票奖励积分说明 -->
              <?php if($user['tpjl']==1 && $user['tpjlnum'] > 0): ?><p class="tit_txt" id="content">恭喜您获得<?php echo ($user['tpjlnum']); ?>点积分</p><?php endif; ?>
            <?php if($user['tpjl']==1 && $user['tpjlnum'] > 0 && $user['gldzpid'] != null): ?><a href="<?php echo U('Wap/Lottery/index',array('token'=>$token,'id'=>$user['gldzpid']));?>" class="gz_btn">快去花积分，抽大奖吧！</a><?php endif; ?>  <!-- 奖励积分消费活动链接  奖励积分消费活动说明 -->
            <p class="tit_txt" id="subcontent"></p>
        </div>
    </div>
    
<div class="pop" id="voting2" style="display:none;">
        <div class="mengceng"></div>
        <div class="pop_up">
         
            <p class="tit_txt" >投票数据分析中，请等待......</p>
        </div>
    </div>

    
    <div class="pop" id="voting" style="display:none;">
        <div class="mengceng"></div>
        <div class="pop_up">
            <span class="closed close_pop_up" id="toupiaook2">&nbsp;</span>
            <p class="tit_p" id="voting_title"></p>
            <p class="tit_txt" id="voting_content"></p>
        </div>
    </div>
<?php if(($user["yzm"]) == "1"): ?><div class="pop" id="validata" style="display:none">
        <div class="mengceng" onclick="document.getElementById('validata').style.display='none';"></div>
        <div class="pop_up" style="width:310px;">
            <script src="http://api.geetest.com/get.php?gt=<?php echo ($user['yzmid']); ?>&width=280" type="text/javascript"></script>
        </div>
    </div><?php endif; ?>
    <div class="share_overmask" style="display: none;">
        <div class="share_arrow"></div>
        <div class="share_words"></div>
    </div>
</section>

<link rel="stylesheet" type="text/css" href="<?php echo STATICS;?>/vote/index2/daohang.css">

<div class="bot_main">
  <ul>
   <li class="ico_1"><span class="ico"><img src="<?php echo STATICS;?>/vote//index2/i1.png" /></span><span class="txt">首页</span></li>
    <li class="ico_2"><span class="ico"><img src="<?php echo STATICS;?>/vote//index2/i3.png" /></span><span class="txt">排名</span></li>
    <li class="ico_3"><span class="ico"><img src="<?php echo STATICS;?>/vote//index2/i11.png" /></span><span class="txt"><?php if(!empty($ishavezp)): ?>我的<?php else: ?>报名<?php endif; ?></span></li>
     <?php if($user['tpjl']==1 && $user['tpjlnum'] > 0 && $user['gldzpid'] != 0): ?><li class="ico_4"><span class="ico"><img src="<?php echo STATICS;?>/vote/index2/i4.png" /></span><span class="txt">免费抽奖</span></li>
   <?php else: ?>
	<li class="ico_4"><span class="ico"><img src="<?php echo STATICS;?>/vote/index2/i4.png" /></span><span class="txt"><?php echo ($user["dbdhm"]); ?></span></li><?php endif; ?>
  </ul>
</div>


<script type="text/javascript">
    $(function(){
        $("#toupiaook").on('click',function(){
                window.location.href = "<?php echo U('Vote/detail',array('token'=>$token,'id'=>$id,'zid'=>$zpinfo['id']));?>";
        });
		$("#toupiaook2").on('click',function(){
                window.location.href = "<?php echo U('Vote/detail',array('token'=>$token,'id'=>$id,'zid'=>$zpinfo['id']));?>";
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
  	<?php if($vote['start_time'] < time() && $vote['over_time'] > time()): ?>location.href = "<?php echo U('Vote/signup',array('token'=>$token,'id'=>$id));?>";
  	<?php else: ?>
  		<?php if($vote['start_time'] > time()): ?>$('#voting_title').html("<?php echo date('Y-m-d H:i:s',$vote['start_time']); ?>后才能报名");
						$('#voting_content').html('');
                        $('#voting').show();
  		<?php else: ?>
						$('#voting_title').html('报名已结束！');
						$('#voting_content').html('');
                        $('#voting').show();<?php endif; endif; endif; ?>
});
<?php if($user['tpjl']==1 && $user['tpjlnum'] > 0 && $user['gldzpid'] != 0): ?>$('.ico_4').on('click', function(){
 
 location.href = "<?php echo U('Wap/Lottery/index',array('token'=>$token,'id'=>$user['gldzpid']));?>";
 
});
<?php else: ?>
$('.ico_4').on('click', function(){
 
	location.href = "<?php echo ($user['dbdhurl']); ?>";  //底部导航链接 
	
});<?php endif; ?>

</script>
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
            title: "我是<?php echo ($zpinfo['item']); ?> 编号:<?php echo ($zpinfo['id']); ?>,正在参加<?php echo ($vote['title']); ?>,快来帮我投票吧!", // 分享标题
            link: "<?php echo C('site_url'); echo U('Vote/detail',array('token'=>$token,'id'=>$id,'zid'=>$zpinfo['id']));?>", // 分享链接
            imgUrl: "<?php echo ($zpinfo['startpicurl']); ?>", // 分享图标
            success: function () {
                // 用户确认分享后执行的回调函数
            },
            cancel: function () {
                // 用户取消分享后执行的回调函数
            }
        });

        //分享给朋友
        wx.onMenuShareAppMessage({
            title: "我是<?php echo ($zpinfo['item']); ?> 编号:<?php echo ($zpinfo['id']); ?>,正在参加<?php echo ($vote['title']); ?>,快来帮我投票吧!", // 分享标题
            desc: "<?php echo ($vote['fxms']); ?>", // 分享描述
            link: "<?php echo C('site_url'); echo U('Vote/detail',array('token'=>$token,'id'=>$id,'zid'=>$zpinfo['id']));?>", // 分享链接
             imgUrl: "<?php echo ($zpinfo['startpicurl']); ?>", // 分享图标
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
<?php if(($user["yzm"]) == "1"): ?>function gt_custom_ajax(result, selector, message) {
  if (result) { 
		$('#validata').hide(); 
		$('#voting2').show();
            $.ajax({
                type: "POST",
                url: "<?php echo U('Vote/ticket');?>",
                cache: false,
                data: {
                    zid:itid,
					vid:'<?php echo ($id); ?>',
					token:'<?php echo ($token); ?>',
					'__hash__':$('input[name="__hash__"]').val()
                },
                success: function(data) {
                      if (data == 102) {//未关注
                          $('#voting2').hide();
						$('#guanzhu').show();
                    } else if (data == 108) {//投票成功
                          $('#voting2').hide();
						$('#voted').show();
                    } else if (data == 106) {//此用户今日已无法投票
						  $('#voting2').hide();
						$('#voting_title').html('无法投票');
						$('#voting_content').html('<?php if(($user["tpxzmos"]) == "1"): ?>您今日的票数已投完，请明日再投！<?php else: ?> 您本次活动的票数已投完，感谢您的参与！<?php endif; ?>');
                        $('#voting').show();
                    } else if (data == 105) {//此IP下今日已无法投票
						  $('#voting2').hide();
						$('#voting_title').html('无法投票');
						$('#voting_content').html('此IP今日票数已投完，请明日再投！');
                        $('#voting').show();
                    } else if (data == 103) {//投票还未开始
						  $('#voting2').hide();
						$('#voting_title').html('投票还未开始');
						$('#voting_content').html('请<?php echo (date('Y-m-d H:i:s',$vote["statdate"])); ?>后再来！');
                        $('#voting').show();
                    } else if (data == 104) {//投票已经结束
						  $('#voting2').hide();
						$('#voting_title').html('投票已经结束');
						$('#voting_content').html('');
                        $('#voting').show();
                    } else if (data == 107) {//投票已经结束
						  $('#voting2').hide();
						$('#voting_title').html('投票失败');
						$('#voting_content').html('此作品无法投票，可能出于审核中或已被屏蔽！');
                        $('#voting').show();
                    } else if (data == 110) {//ip不在限制区域中
						  $('#voting2').hide();
						$('#voting_title').html('投票失败');
						$('#voting_content').html("仅允许 <?php echo ($user['area']); ?> 区域的用户投票！");  //不在允许投票区域的提示
                        $('#voting').show();
                    }else if (data == 109) {//投票已经结束
						  $('#voting2').hide();
						$('#voting_title').html('投票失败');
						$('#voting_content').html('<?php if(($user["tpxzmos"]) == "1"): ?>您已经投过啦，每天可投一次,明天再来吧!<?php else: ?> 您已经投过了，同一用户只能投票一次!<?php endif; ?>');  //限制期内已给他投过提示
                        $('#voting').show();
                    }else if (data == 111) {//投票已经结束
						  $('#voting2').hide();
						$('#voting_title').html('投票失败');
						$('#voting_content').html('您不能投票给自己!');  //限制期内已给他投过提示
                        $('#voting').show();
                    }else if (data == 120) {//报名期间达到投票限制数
						  $('#voting2').hide();
						$('#voting_title').html('投票失败');
						$('#voting_content').html('报名期内优先投票最多<?php echo ($vote["btcdxz"]); ?>票！正式投票为<?php echo date("Y-m-d H:i",$vote[statdate]); ?>开始，请到时再继续投票 感谢您的参与！');
                        $('#voting').show();
                    }else if (data == 888) {//编号投票
						  $('#voting2').hide();
						$('#voting_title').html('进入公众号，回复“TP' + itid + '”给我投票哦！');
						$('#voting_content').html('<a href="<?php echo ($vote['wxgzurl']); ?>" class="gz_btn">进入我们的公众号</a>');
                        $('#voting').show();
                    }
                }
            });
	}else{  
		if(message == "Fail") {
		}
		if(message == "Abuse" || message == "Forbidden") {
		}
  	}
  	//$('.gt_refresh_button')[0].click(); 
}
var itid;
    $(function(){
        $('.vote').on('tap', function(e){
            e.preventDefault();
            var self = $(e.target).closest('.vote');
			itid = self.data('itid'); 
			$('#validata').show();
        });

        var container = $('#pageCon ul');

        container.imagesLoaded(function(){
            container.masonry({
                itemSelector: '.picCon'
            });
        });
    });
<?php else: ?>
    $(function(){
        $('.vote').on('tap', function(e){
            e.preventDefault();
            var self = $(e.target).closest('.vote');
			$('#voting2').show();
            $.ajax({
                type: "POST",
                url: "<?php echo U('Vote/ticket');?>",
                cache: false,
                data: {
                    zid:self.data('itid'),
					vid:'<?php echo ($id); ?>',
					token:'<?php echo ($token); ?>',
					'__hash__':$('input[name="__hash__"]').val()
					
                },
                success: function(data) {
                  if (data == 102) {//未关注
                         $('#voting2').hide();
						$('#guanzhu').show();
                    } else if (data == 108) {//投票成功
                          $('#voting2').hide();
						$('#voted').show();
                    } else if (data == 106) {//此用户今日已无法投票
						  $('#voting2').hide();
						$('#voting_title').html('无法投票');
						$('#voting_content').html('<?php if(($user["tpxzmos"]) == "1"): ?>您今日的票数已投完，请明日再投！<?php else: ?> 您本次活动的票数已投完，感谢您的参与！<?php endif; ?>');
                        $('#voting').show();
                    } else if (data == 105) {//此IP下今日已无法投票
						  $('#voting2').hide();
						$('#voting_title').html('无法投票');
						$('#voting_content').html('此IP今日票数已投完，请明日再投！');
                        $('#voting').show();
                    } else if (data == 103) {//投票还未开始
						  $('#voting2').hide();
						$('#voting_title').html('投票还未开始');
						$('#voting_content').html('请<?php echo (date('Y-m-d H:i:s',$vote["statdate"])); ?>后再来！');
                        $('#voting').show();
                    } else if (data == 104) {//投票已经结束
						  $('#voting2').hide();
						$('#voting_title').html('投票已经结束');
						$('#voting_content').html('');
                        $('#voting').show();
                    } else if (data == 107) {//投票已经结束
						  $('#voting2').hide();
						$('#voting_title').html('投票失败');
						$('#voting_content').html('此作品无法投票，可能出于审核中或已被屏蔽！');
                        $('#voting').show();
                    } else if (data == 110) {//ip不在限制区域中
						  $('#voting2').hide();
						$('#voting_title').html('投票失败');
						$('#voting_content').html("仅允许 <?php echo ($user['area']); ?> 区域的用户投票！");  //不在允许投票区域的提示
                        $('#voting').show();
                    }else if (data == 109) {//投票已经结束
						  $('#voting2').hide();
						$('#voting_title').html('投票失败');
						$('#voting_content').html('<?php if(($user["tpxzmos"]) == "1"): ?>您已经投过啦，每天可投一次,明天再来吧!<?php else: ?> 您已经投过了，同一用户只能投票一次!<?php endif; ?>');  //限制期内已给他投过提示
                        $('#voting').show();
                    }else if (data == 111) {//投票已经结束
						  $('#voting2').hide();
						$('#voting_title').html('投票失败');
						$('#voting_content').html('您不能投票给自己!');  //限制期内已给他投过提示
                        $('#voting').show();
                    }else if (data == 120) {//报名期间达到投票限制数
						  $('#voting2').hide();
						$('#voting_title').html('投票失败');
						$('#voting_content').html('报名期内优先投票最多<?php echo ($vote["btcdxz"]); ?>票！正式投票为<?php echo date("Y-m-d H:i",$vote[statdate]); ?>开始，请到时再继续投票 感谢您的参与！');
                        $('#voting').show();
                    }else if (data == 888) {//编号投票
						  $('#voting2').hide();
						$('#voting_title').html('进入公众号，回复“TP' +  self.data('itid') + '”给我投票哦！');
						$('#voting_content').html('<a href="<?php echo ($vote['wxgzurl']); ?>" class="gz_btn">进入我们的公众号</a>');
                        $('#voting').show();
                    }
                }
            });
        });

        var container = $('#pageCon ul');

        container.imagesLoaded(function(){
            container.masonry({
                itemSelector: '.picCon'
            });
        });
    });<?php endif; ?>

</script>
<?php if(!empty($ggduotu)): ?><script type="text/javascript" src="<?php echo STATICS;?>/vote/slider/yxMobileSlider.js"></script>
<script type="text/javascript">
	$(".slider").yxMobileSlider({during:5000,height:<?php echo ($user['hdgd']); ?>});
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
<?php	echo html_entity_decode(htmlspecialchars_decode($vote['cnzz'])); ?></div></body>
</html>