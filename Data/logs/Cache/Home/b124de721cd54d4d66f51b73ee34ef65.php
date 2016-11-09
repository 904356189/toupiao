<?php if (!defined('THINK_PATH')) exit();?>
<link href="<?php echo STATICS;?>/simpleboot/themes/flat/theme.min.css" rel="stylesheet">
<div class="main">

<style type="text/css">
.normalTitle {
    border-bottom: 1px solid #D7DDE6;
    border-radius: 10px 10px 0 0;
    padding: 20px;
    text-shadow: 0 1px 1px #FFFFFF;
}
.normalTitle h2, .panelTitle h2, .processTitle h2 {
    font-size: 20px;
    font-weight: bold;
}
.content {
 margin: 0 auto;
    text-align: left;
    width: 707px;
    margin-top: 1px;
}
.article, .intro, .download, .document, .developer {
margin:40px 0px;

background:#f5f6f7;
box-shadow:0px 1px 3px #ccc;
}
.section {
padding:0 0 20px 0;
margin:0 0 20px 0;
border-bottom:1px solid #eee;
overflow: hidden;
}
.lastSection {
border:none;
margin-bottom:0px;
}
.normalTitle {
border-bottom:1px solid #d7dde6;
border-radius:10px 10px 0 0;
padding:20px 40px;
text-shadow:0 1px 1px #fff;
}
.normalContent {
background:#fff;/*border-radius:0 0 10px 10px;*/
padding:40px;
}
.normalTitle h2, .panelTitle h2, .processTitle h2 {
font-size:20px;
font-weight:bold;
}
.green{ color:#090}
.red{ color: #F00}
.collapsible {
    background: none repeat scroll 0 0 #FFFFFF;
    padding: 20px;
}
.CollapsiblePanel {
    margin-bottom: 10px;
    width: 870px;
}
.CollapsiblePanelTab {
    background: url(style/images/img/arrow_unclick.png) no-repeat scroll 820px 20px #FFFFFF;
    border: 1px solid #DEDEDE;
    border-radius: 3px 3px 3px 3px;
    color: #626B8A;
    cursor: pointer;
    font-size: 18px;
    padding: 20px 40px 20px 20px;
    text-shadow: 0 1px 0 white;
}
.CollapsiblePanelTab.hover {
    background: url(style/images/img/arrow_unclick.png) no-repeat scroll 820px 20px #D7DDE6;
border: 1px solid #C1C9D4;
}
.CollapsiblePanelTab.clicked {
    background: url(style/images/img/arrow_click.png) no-repeat scroll 820px 20px #D7DDE6;
border: 1px solid #C1C9D4;
}
.CollapsiblePanelContent {
    display: none;
    overflow: hidden;
}
.CollapsiblePanelContent .normalContent {
    padding: 20px 20px 0;
}
.right{float:right;}
</style>

<div class="content" style="width:100%;">

<div class="document" style="margin-top:0px;">
            <div class="normalTitle"><h2>如何为微信公众号配置接口？</h2><a href="<?php echo U('User/Vote/index');?>" class="right btn btn-primary btn_submit  J_ajax_submit_btn" style="margin-top:-27px">返回</a>
                </div><div class="collapsible">
<div class="section lastSection">
<p>请务必认真阅读以下步骤的内容，才能更有效的完成配置工作<br/>
  <?php if($_GET['token'] != ''): ?>你的接口URL是：<font color="red">http://<?php echo ($myurl); ?>/index.php/api/<?php echo $_GET['token']; ?></font><br>若失败请用如下URL：<font color="red">http://<?php echo ($myurl); ?>/index.php?g=Home&m=Weixin&a=index&token=<?php echo $_GET['token']; ?></font><br>您的token是：<font color="red"><?php echo $_GET['token']; ?></font><?php endif; ?></p>
</div>
                <div id="CollapsiblePanel3" class="CollapsiblePanel">
                        <div class="CollapsiblePanelTab clicked">微投票到微信公众平台设置接口。<span></span></div>
                        <div style="" class="">
                            <div class="articleContent catalogHome normalContent">
                                <div class="section lastSection">
                                   <div class="section lastSection">
                                    <p>1、登录 <a href="http://mp.weixin.qq.com/">微信公众平台</a>（<a href="http://mp.weixin.qq.com/">http://mp.weixin.qq.com/</a>），进行身份认证，填写信息，提交身份证。</p>
                                    <p>审核后，开发者中心 → 进入开发模式</p><br>
                                    <p><img src="<?php echo STATICS;?>/help/help001.jpg" width="790px"></p><br>
									<p>2、点击"成为开发者"按钮</p>
									<p><img src="<?php echo STATICS;?>/help/help002.jpg" width="790px"></p><br>
									<p>3、填写接口配置信息</p>
									<?php if($_GET['token'] == ''): ?><p>比如你<?php echo C('site_name');?>平台上的地址是http://<?php echo ($myurl); ?>/index.php/api/demo</p>
									<p>那么URL就是http://<?php echo ($myurl); ?>/INDEX.PHP/api/demo</p>
									<?php else: ?>
									<p>你的URL是 <font color="red">http://<?php echo ($myurl); ?>/index.php/api/<?php echo $_GET['token']; ?></font></p><?php endif; ?>
									<p>Token填写 <font color="red"><?php echo $_GET['token']; ?></font></p>
									<p><img src="<?php echo STATICS;?>/help/help003.jpg" width="790px"></p><br>
									<p>4、确认开启</p>
									<p>5、在手机上用微信给你的公众号输入你设置的"关键词"，测试你的接口是否配置正常！</p><br>									
                                </div>
                              
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
    </div>
    </div>
<!--结束-->
</div>