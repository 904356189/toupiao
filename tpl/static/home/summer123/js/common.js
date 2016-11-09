// JavaScript Document
/*消息滚动*/
$(function(){
	var len=$("#msg li").length*708;
	var left=0;
	$("#msg ul").width(len);
	var int=setInterval(msgmove,3000);
	function msgmove(){
		if(left>-(len-708)){
			left=left-708;
		}else{
			left=0;
		}
		$("#msg ul").animate({left:left},500);
	}
	$("#msg .op .right").click(function(){
		clearInterval(int);
		msgmove();
	})
	
	$("#msg .op .left").click(function(){
		clearInterval(int);
		if(left<0){
			left=left+708;
			$("#msg ul").animate({left:left},500);
		}
	})
	$("#msg li a").hover(function(){
		clearInterval(int);
	},function(){
		int=setInterval(msgmove,3000);
	})
	$("#msg .op a").hover(function(){
		clearInterval(int);
	},function(){
		int=setInterval(msgmove,3000);
	})
	
})
/*案例展示*/
$(function(){
	$('.slider-box').mySlider({  //参数可选,以下为默认参数
			speed: 300,
			direction: 'left', //  运动方向 可选 left,top
			prevClass: 'slider_next',
			nextClass: 'slider_prev',
			wrapperClass: 'wrap_slider',
			moveClass: 'slide_move'
	});
});
/*功能*/
$(function(){
	$("#func .btn_more").toggle(function(){
		if($(".hidden").css("display")=="none"){
			$(".hidden").show();
			$("#func .btn_more a").html("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;收&nbsp;&nbsp;起");
		}else{
			alert("没有更多功能!");
		}
	},function(){
		if($(".hidden").css("display")=="block"){
			$(".hidden").hide();
			$("#func .btn_more a").html("查看更多功能");
		}else{
			alert("没有更多功能!");
		}
	})
})

$(function(){
//	var len_ul=$(".tc_detail .detailList li").length*1440;
//	$(".tc_detail .detailList").width(len_ul);
//	var len_li=1440;
//	var left=0;
	$("#func .list li").click(function(){
		var index=$("#func .list li").index(this);
		//alert(index);
		$('.tc_detail').show();
		//$("#page"+(index+1)).show();
		//$("#magazine div.pagea").eq(index).show().siblings().hide();
		//left=left-(index*len_li);
		//anfade();
		
/*		$('#magazine').turn({
							display: 'single',
							acceleration: true,
							gradients: !$.isTouch,
							elevation:50,
							page:index+1,
							when: {
								turned: function(e, page) {
									alert(page);
								}
							}
	    });*/
		//$("#magazine").turn({page: index+1, acceleration: true, gradients: true,display: 'single'});
		if (!$("#magazine").turn("is")) {	//如果是第一次加载，初始化；否则设置页码即可
			$("#magazine").turn({page: index+1, acceleration: true, gradients: true,display: 'single',duration:600,elevation:20});
			
		}else{
			$("#magazine").turn("page", index+1);		//设置页码
			}
	})
	$(".tc_detail .slider_next").click(function(){
		$('#magazine').turn('next');
	})
	$(".tc_detail .slider_prev").click(function(){
		$('#magazine').turn('previous');
	})

	//关闭
	$('.tc_detail .close').click(function(){
		//$(".page").parents("div.turn-page").remove();
		//$(".page").removeClass("turn-page");
		$(".tc_detail").hide();
		//$("#magazine").turn("removePage", 1); 
		//$("#magazine").turn("disable", true);
		
		//$("#magazine").turn("_removeMv");
		//left=0;
	})
});
$(window).bind('keydown', function(e){
	
	if (e.keyCode==37)
		$('#magazine').turn('previous');
	else if (e.keyCode==39)
		$('#magazine').turn('next');
		
});


/*右侧悬浮*/
$(function(){

})

/*轮播*/
$(function(){
    $('#obo_slider').runbanner({
		className: 'oneByOne1', 	             
		easeType: 'random',  //动画参数
		/*
		"rollIn", "fadeIn", "fadeInUp", "fadeInDown", "fadeInLeft", "fadeInRight", "fadeInRight", "bounceIn", "bounceInDown", "bounceInUp", "bounceInLeft",        "bounceInRight", "rotateIn", "rotateInDownLeft", "rotateInDownRight", "rotateInUpLeft", "rotateInUpRight" (18种动画类型可调用)
		*/
		slideShow: true  //为false时不会自动播放
	});  
})
/*案例页*/
$(function(){
	
	$(".case_type li").hover(function(){
		//alert($(".case_type li").length);
		var index=$(this).attr("date");
		//alert(index);
		$(this).addClass("hover").siblings().removeClass("hover");
		$(".case_submenu ul").eq(index).show().siblings().hide();
	})
	
	$(".case_submenu li").hover(function(){
		$(this).addClass("hover");
	},function(){
		$(this).removeClass("hover");
	})
	$(".case_submenu li").click(function(){
		var index=$(".case_submenu li").index(this);
		$(".case_submenu li").removeClass("active");
		$(this).addClass("active");
		$(".company_intro li").hide();
		$(".company_intro li").eq(index).show();
	})
})
/*登陆*/
$(function(){
	$(".btn_reg a").hover(function(){
		$(".btn_reg").hide();
		$(".btn_reg_hover").show();
		
	})
	//$(".btn_reg_hover").hover(function(){
//		//$(".btn_reg_hover").show();
//		//$(".btn_reg").hide();
//	},function(){
//		$(".btn_reg_hover").hide();
//		$(".btn_reg").show();
//	})
	
	
	
	
})
/*注册*/
$(function(){
	$("[df]").each(function() {
        $(this).css({"color":"#b0b0b0"});
		$(this).val($(this).attr("df"));
		$(this).on('focus',function(){
			$(this).val("");
		}); 
		$(this).on("blur",function(){
			if($(this).val()==""){
				$(this).val($(this).attr("df"));
			}
		})
    });
})