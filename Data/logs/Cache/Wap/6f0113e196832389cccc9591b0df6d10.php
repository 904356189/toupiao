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
        <div class="search">
    <form action="<?php echo U('Vote/search');?>" id="search_form" method="post" accept-charset="utf-8">
    <input type="hidden" name="id" value="<?php echo ($id); ?>" />
	<input type="hidden" name="token" value="<?php echo ($token); ?>" />
        <div class="search_con">
            <div class="btn"><input type="submit" name="seachid" id="searchBtn" value="搜索"></div>
            <div class="text_box"><input type="search" id="searchText" value="" name="keyword" placeholder="请输入选手姓名或编号" autocomplete="off"></div>
        </div>
    </form>
</div>    </div>
</header>

<section class="content" id="get_info" data-rid="503" data-sort="" data-kw="" data-page="">
    <div class="text_a clearfix" id="sort">
        <a href="<?php echo U('Vote/index',array('token'=>$token,'id'=>$id));?>" >最新参赛</a>
        <a href="<?php echo U('Vote/rank',array('token'=>$token,'id'=>$id));?>" class="active">投票排行</a>
    </div>
    <div class="blank20"></div>
    <div id="pageCon" class="match_page masonry" style="padding-bottom: 50px">
        <ul class="list_box masonry clearfix" style="position: relative;">
        			<?php if(is_array($zuopins)): $i = 0; $__LIST__ = $zuopins;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$li): $mod = ($i % 2 );++$i;?><li class="picCon">
                        <div>
                            <i class="number"><?php echo ($li["id"]); ?>号</i>
                            <a href="<?php echo U('Vote/detail',array('token'=>$token,'id'=>$id,'zid'=>$li['id']));?>" class="img">
                            
                                <img src="<?php echo ($li["startpicurl"]); ?>" alt="">
                                                  
                            </a>
                            <div class="clearfix">
                                <p>
                                   <?php echo ($li["item"]); ?><br/>
                                   <?php echo ($li["vcount"]); ?>票
                                </p>
                                <a href="" class="vote" data-itid="<?php echo ($li["id"]); ?>" data-vote_num="<?php echo ($li["id"]); ?>" data-rule_id="<?php echo ($li["id"]); ?>">投票</a>
                            </div>
                        </div>
                    </li><?php endforeach; endif; else: echo "" ;endif; ?>
                                </ul>

    </div>

    <div class="pagination pagination-centered"> <ul><?php echo ($page_string); ?></ul></div>
</section>
<img class="bg" src="<?php echo STATICS;?>/vote/index<?php echo ($vote['moban']); ?>/mw_005.jpg" />

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
    <div class="pop" id="guanzhu"  style="display:none" >
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
    $(function(){
        $("#toupiaook").on('click',function(){
                window.location.href = "<?php echo U('Vote/rank',array('token'=>$token,'id'=>$id,'page'=>$page));?>";
        });
		 $("#toupiaook2").on('click',function(){
                window.location.href = "<?php echo U('Vote/rank',array('token'=>$token,'id'=>$id,'page'=>$page));?>";
        });
    });
$(function($){
	$("#search_form").submit(function(){
		var keyword = $("#searchText").val();
		if(keyword.length == 0){alert('请输入选手姓名或编号');return false;}
	});
});
    $(function(){
        $("#toupiaook").on('click',function(){
                window.location.href = "<?php echo U('Vote/index',array('token'=>$token,'id'=>$id));?>";
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
                    }else if (data == 111) {//投票已经结束
						  $('#voting2').hide();
						$('#voting_title').html('投票失败');
						$('#voting_content').html('您不能投票给自己!');  //限制期内已给他投过提示
                        $('#voting').show();
                    }else if (data == 109) {//投票已经结束
						 $('#voting2').hide();
						$('#voting_title').html('投票失败');
						$('#voting_content').html('<?php if(($user["tpxzmos"]) == "1"): ?>您已经投过啦，每天可投一次,明天再来吧!<?php else: ?> 您已经投过了，同一用户只能投票一次!<?php endif; ?>');  //限制期内已给他投过提示
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