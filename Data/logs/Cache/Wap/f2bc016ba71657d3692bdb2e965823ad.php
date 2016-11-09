<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html><html lang="en" style="font-size: 40px;"><head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="UTF-8">
    <title>新年红包</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <meta http-equiv="x-dns-prefetch-control" content="on">
    <script async src="<?php echo STATICS;?>/analytics.js"></script><script>
        (function () {
            var b = document.documentElement, a = function () {
                var a = b.getBoundingClientRect().width;
                b.style.fontSize = .0625 * (640 <= a ? 640 : a) + "px"
            }, c = null;
            window.addEventListener("resize", function () {
                clearTimeout(c);
                c = setTimeout(a, 300)
            });
            a()
        })();
    </script>
    <link rel="stylesheet" href="<?php echo STATICS;?>/style.s.min.css">
    <style type="text/css">
        .alertbox {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            z-index: 501;
            background-color: rgba(0, 0, 0, 0.9);
        }

        b.em {
            color: #ff3544;
        }

        .recode_wrapper .record_list .desc {
            width: 9.3rem;
        }

        .recode_wrapper .record_list .result {
            width: 2rem;
        }

        .alertbox .box p {
            font-size: 0.5rem;
        }

        .recode_wrapper .record_list .result {
            width: 2.5rem;
        }

        .alertbox .sharebox:before {
            top: 7rem;
        }

        .alertbox.fixed {
            background-color: rgba(0, 0, 0, 0.8);
        }

        .hide_page {
            display: none;
        }

        .footer .btn_gz {
            margin-top: 1.2rem;
        }

        .btn_rule:after {
            bottom: .25rem;
        }

    </style>
	<style type="text/css">
		@-webkit-keyframes loading {
			0% {
				-webkit-transform: rotate(0deg);
			}
			100% {
				-webkit-transform: rotate(360deg);
			}
		}

		@-moz-keyframes loading {
			0% {
				-moz-transform: rotate(0deg);
			}
			100% {
				-moz-transform: rotate(360deg);
			}
		}

		@-o-keyframes loading {
			0% {
				-o-transform: rotate(0deg);
			}
			100% {
				-o-transform: rotate(360deg);
			}
		}

		@-ms-keyframes loading {
			0% {
				-ms-transform: rotate(0deg);
			}
			100% {
				-ms-transform: rotate(360deg);
			}
		}

		@keyframes loading {
			0% {
				transform: rotate(0deg);
			}
			100% {
				transform: rotate(360deg);
			}
		}

		.mp_loading {
			position: absolute;
			width: 100%;
			height: 100%;
			overflow: hidden;
			background-color: black;
			left: 0;
			top: 0;
			-webkit-transform-style: preserve-3d;
			z-index: 1;
		}

		.mp_loading_clip {
			position: absolute;
			left: 50%;
			top: 50%;
			width: 60px;
			height: 60px;
			margin: -30px 0 0 -30px;
			overflow: hidden;
			-webkit-animation: loading 1.2s linear infinite;
			-moz-animation: loading 1.2s linear infinite;
			-o-animation: loading 1.2s linear infinite;
			-ms-animation: loading 1.2s linear infinite;
			animation: loading 1.2s linear infinite;
		}

		.mp_loading_bar {
			position: absolute;
			left: 0;
			top: 0;
			width: 54px;
			height: 54px;
			border-radius: 50px;
			overflow: hidden;
			clip: rect(0px, 36px, 70px, 0);
			background: rgba(0, 0, 0, 0);
			border: 3px solid #fff367;
			-webkit-mask: -webkit-gradient(linear, 0 0, 0 100%, from(rgba(255, 255, 255, 1)), to(rgba(255, 255, 255, 0)));
		}

		.mp_loading_txt {
			width: 100px;
			height: 30px;
			line-height: 30px;
			position: absolute;
			left: 50%;
			top: 50%;
			margin-left: -50px;
			margin-top: -15px;
			text-align: center;
			color: #fff;
		}

		.btn {
			margin: 2%;
			width: 46%;
			border-radius: 8px;
			float: left;
		}

		.btn.disable {
			background-color: #999;
		}
	</style>
	<script type="text/javascript">
		function loadedPercent(num) {
			if (parseInt(document.getElementById("J_precent").innerHTML) < num) {
				document.getElementById("J_precent").innerHTML = num + "%";
			}
			if (num == 100) {
				document.getElementById("J_loading").style.display = "none";
			}
		}
	</script>
</head>
<body>
	<div id="wrap">
		<div class="wg_view" id="late_panel">
			<div class="wrapper">
				<header class="hb_header play">
					<div class="lianleft"></div>
					<div class="lianright"></div>
					<div class="light1"></div>
					<div class="light2"></div>
					<div class="paoma"></div>
					<div class="scenery facuo play">
						<div class="p"></div>
					</div>
				</header>
				<div class="hb_content show">
					<div class="hb_desc">
                    <?php if($hb_user_id): ?>您当前票数为：<span style="font-size: 2em;"><?php echo ($hb_vcount); ?></span><br>拉票尚未结束，萌宝仍需努力！
                    <?php else: ?>
                    您还没有报名<br>请先报名后再来领取礼品<?php endif; ?>
					</div>
					<div class="bottom_wrapper">
						<?php if($hb_vcount < 30): ?><a class="btn btn-get disable" href="#" type="1">微信小红包</a><?php else: ?><a class="btn btn-get" href="#" type="1">微信小红包</a><?php endif; ?>
						<?php if($hb_vcount < 100): ?><a class="btn btn-get disable" href="#" type="2">新年福袋（100%中）</a><?php else: ?><a class="btn btn-get" href="#" type="2">新年福袋（100%中）</a><?php endif; ?>
						<?php if($hb_vcount < 300): ?><a class="btn btn-get disable" href="#" type="3">萌宝奖状一份</a><?php else: ?><a class="btn btn-get" href="#" type="2">新年福袋（100%中）</a><?php endif; ?>
						<?php if($hb_vcount < 1000): ?><a class="btn btn-get disable" href="#" type="4">888元新年红包</a><?php else: ?><a class="btn btn-get" href="#" type="2">新年福袋（100%中）</a><?php endif; ?>
					</div>
				</div>
			</div>
			<div class="page_tabs">
				<div class="inner">
					<a href="<?php echo U('Vote/signup',array('token'=>$token,'id'=>$id));?>" class="tabs" style="width:100%">回到活动</a>
				</div>
			</div>
		</div>
	</div>
	<div class="alertbox" id="dialog">
		<div class="cbox" style="margin-top: 4rem;">
			<h3>
				<em id="title">很遗憾！</em>
			</h3>
			<p id="message">你还没有报名，请先报名再来领取礼品哦！</p>
			<div class="c_btn_groups" style="margin-top: 1rem;">
				<a href="javascript:closeDialog();" class="c_btn btn1" id="close" style="float: none; margin: 0 auto;width: 7.5rem;">确定</a>
			</div>
		</div>
	</div>
	<div id="J_loading" class="mp_loading zoom" style="display: none;">
		<div class="mp_loading_clip">
			<div class="mp_loading_bar"></div>
		</div>
		<div id="J_precent" class="mp_loading_txt">100%</div>
	</div>
	<div id="t_loading" class="zoom" style="position: fixed; left: 0px; top: 0px; right: 0px; bottom: 0px; z-index: 9; display: none; background-color: transparent;">
		<div style="position: fixed; width: 100px; height: 100px; border-top-left-radius: 2px; border-top-right-radius: 2px; border-bottom-right-radius: 2px; border-bottom-left-radius: 2px; color: rgba(255, 255, 255, 0.8); margin: -50px 0px 0px -50px; left: 50%; top: 50%; background-color: rgba(0, 0, 0, 0.498039);">
			<div style="position: absolute; width: 46px; height: 46px; left: 50%; top: 50%; margin: -35px 0px 0px -23px; -webkit-animation: loading 1.2s linear infinite;">
				<div style="width: 40px; height: 40px; border: 3px solid rgba(255, 255, 255, 0.8); border-top-left-radius: 23px; border-top-right-radius: 23px; border-bottom-right-radius: 23px; border-bottom-left-radius: 23px; clip: rect(0px 23px 46px 0px); position: absolute; left: 0px; top: 0px; -webkit-transform-origin: 50% 50%; -webkit-background-origin: border-box; -webkit-background-clip: border-box; -webkit-mask: -webkit-gradient(linear, 0 0, 0 100%, from(rgb(255, 255, 255)), to(rgba(255, 255, 255, 0)));"></div>
			</div>
			<p style="margin: 0px 0px 0px -40px; padding: 0px; text-align: center; width: 80px; position: absolute; bottom: 10px; left: 50%; line-height: 18px; white-space: nowrap;">
				加载中</p>
		</div>
	</div>
	<script type="text/javascript" src="<?php echo STATICS;?>/main.js"></script>
	<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
	<script type="text/javascript">
		var userId = '<?php echo ($hb_user_id); ?>';
		
		$(document).ready(function() {
			if (userId == '') {
				showDialog('很遗憾！', "你还没有报名，请先报名再来领取礼品哦！", '确定', 'javascript:closeDialog();');
			}
		});
		
		$(".btn-get").click(function() {
			if(userId==''){
				showDialog('很遗憾！', "你还没有报名，请先报名再来领取礼品哦！", '确定', 'javascript:closeDialog();');
				return;
			}
			var $this = $(this);
			var type = $this.attr("type");
			if ($this.hasClass("disable")) {
				if (!type) {
					return;
				}
				var prize = $this.text();
				var limit = 0;
				if (type == 1) {
					limit = 30;
				} else if (type == 2) {
					limit = 100;
				} else if (type == 3) {
					limit = 300;
				} else if (type == 4) {
					limit = 1000;
					showDialog('新年红包（限量100个）！', "您需要满1000票才可以兑换，请继续努力！", '确定', 'javascript:closeDialog();');
					return;
				} else {
					return;
				}
				showDialog('很遗憾！', "您还没有达到要求哦！满" + limit + "票就可以领取【" + prize + "】啦，请继续努力！", '确定', 'javascript:closeDialog();');
				return;
			}
			if (type == 1) {
				showDialog('恭喜您！', "我们将会在活动结束后审核有效票数，届时将会人工发送小红包。", '好的', 'javascript:closeDialog();');
				return;
			}else if (type == 2) {
				showDialog('恭喜您！', "我们将会在活动结束后审核有效票数，届时将会人工发送福袋。", '好的', 'javascript:closeDialog();');
				return;
			}else if (type == 3) {
				showDialog('恭喜您！', "我们将会在活动结束后审核有效票数，届时将会人工发送奖状。", '好的', 'javascript:closeDialog();');
				return;
			} else if (type == 4) {
				showDialog('恭喜您！', "我们将会在活动结束后审核有效票数，届时将会人工发送红包。", '好的', 'javascript:closeDialog();');
				return;
			}
			
			$("#t_loading").show();
			$.post("<?php echo U('Vote/boll',array('token'=>$token,'id'=>$id));?>", {type: type}, function(data) {
				$("#t_loading").hide();
				if (data.status == 'error') {
					showDialog('很遗憾！', data.message, '确定', 'javascript:closeDialog();');
				} else if (data.status == 'prize1') {
					showDialog('恭喜您！', data.message, '确定', 'javascript:getPrize1();');
				} else if (data.status == 'prize3') {
					showDialog('恭喜您！', data.message, '确定', 'javascript:closeDialog();');
				} else if (data.status == 'prize4') {
					showDialog('恭喜您！', data.message, '确定', 'javascript:closeDialog();');
				} else if (data.status == 'success') {
					showDialog('恭喜您！', data.message, '好的', 'javascript:getPrize1();');
				} else {
					showDialog('很遗憾！', data.message, '确定', 'javascript:closeDialog();');
				}
			},"json");
		});
		
		function showDialog(title, message, buttonText, redirectUrl) {
			$dialog = $("#dialog");
			$dialog.find("#title").text(title);
			$dialog.find("#message").text(message);
			$dialog.find("#close").text(buttonText);
			$dialog.find("#close").attr("href", redirectUrl);
			$dialog.show();
		}

		function getPrize1() {
			return;
		}
		
		function closeDialog() {
			$("#dialog").hide();
		}
		
		/*window.shareData = {
			"appId" : "<br />
<b>Notice</b>:  Undefined variable: signPackage in <b>D:\web\nbm3\public_html\hb\index.php</b> on line <b>377</b><br />
",
			"timestamp" : <br />
<b>Notice</b>:  Undefined variable: signPackage in <b>D:\web\nbm3\public_html\hb\index.php</b> on line <b>378</b><br />
,
			"nonceStr" : "<br />
<b>Notice</b>:  Undefined variable: signPackage in <b>D:\web\nbm3\public_html\hb\index.php</b> on line <b>379</b><br />
",
			"signature" : "<br />
<b>Notice</b>:  Undefined variable: signPackage in <b>D:\web\nbm3\public_html\hb\index.php</b> on line <b>380</b><br />
"
		};

		wx.config({
			debug: false, 
			appId: window.shareData.appId,
			timestamp: window.shareData.timestamp, 
			nonceStr: window.shareData.nonceStr,
			 signature: window.shareData.signature,
			 jsApiList: [
			 'hideOptionMenu',
			 'hideMenuItems',
			 'hideAllNonBaseMenuItem'
			 ]
			 });

			 wx.ready(function(){
			 wx.hideOptionMenu();
			 /!*
			 wx.hideMenuItems({
			 menuList: [
			 'menuItem:exposeArticle',
					'menuItem:setFont',
					'menuItem:dayMode',
					'menuItem:nightMode',
					'menuItem:profile',
					'menuItem:addContact',
					'menuItem:share:appMessage',
					'menuItem:share:timeline',
					'menuItem:share:qq',
					'menuItem:share:weiboApp',
					'menuItem:favorite',
					'menuItem:share:facebook',
					'menuItem:share:QZone',
					'menuItem:jsDebug',
					'menuItem:editTag',
					'menuItem:delete',
					'menuItem:copyUrl',
					'menuItem:originPage',
					'menuItem:readMode',
					'menuItem:openWithQQBrowser',
					'menuItem:openWithSafari',
					'menuItem:share:email',
					'menuItem:share:brand'
				]
			});
			*!/
		});
		
		wx.error(function(res){
		
		});
		
		$(document).ready(function(){ 
			function stopScrolling( touchEvent ) { 
				touchEvent.preventDefault(); 
			}
			//document.addEventListener( 'touchstart' , stopScrolling , false ); 
			document.addEventListener( 'touchmove' , stopScrolling , false ); 
		}); */
	</script>
	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
				(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','<?php echo STATICS;?>/analytics.js','ga');

		ga('create', 'UA-69603144-5', 'auto');
		ga('send', 'pageview');

	</script>

</body><iframe id="__WeixinJSBridgeIframe_SetResult" style="display: none;"></iframe><iframe id="__WeixinJSBridgeIframe" style="display: none;"></iframe></html>