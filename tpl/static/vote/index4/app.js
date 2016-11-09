$(function($){
	$('.bottom_khdxz_close').click(function(){
		$(this).parents('.bottom_khdxz').hide();
	});

	$(".toupiao").on('click',function(e){
		if(false){//已关注
			$(".toupiao_pop").show();
		} else {
			$(".guanzhu_pop").show();
		}
		e.preventDefault();
	});
	
	$(".fenxiang").on('click', function(e){
		$(".share_overmask").show().on('click', function(){
			$(this).hide();
		});
		e.preventDefault();
	});
	
	$(".close_pop_up").on('click',function(){
		$(this).parents(".pop").hide();
	});
	
	$("#do_apply").on('click', function(){
		var name = $("#name").val();
		var pname = $("#parent_name").val();
		var tel = $("#phone").val();
		var age = $("#age").val();
		var gender = $("input[name='gender']:checked").val();
		var talent = $("input[name='talent']:checked").val();
		var content = $("#message").val();
		var cnamereg = /^[\u0391-\uFFE5]+$/;

		if(name.length == 0){alert('请输入萌宝姓名');return false;}
		//if(!cnamereg.test(name)){alert('萌娃姓名必须是中文');return false;}
		if(gender == ''|| gender == null || gender == undefined || gender == 'undefined'){alert('请选择萌宝性别！');return false;}

		var agereg = /^\d{1,2}$/;
		if (age.length == 0) {alert("请输入萌宝年龄！"); return false;}
		if(talent == ''|| talent == null || talent == undefined || talent == 'undefined'){alert('请选择萌宝是否有才艺！');return false;}
		if(pname.length == 0){alert('请输入家长姓名');return false;}
		if(!cnamereg.test(pname)){alert('家长姓名必须是中文');return false;}

		var telreg = /^1[3|4|5|7|8][0-9]\d{8}$|^\d{8}$/;
		if (tel.length == 0) {alert("请输入家长联系号码！"); return false;}
		if (!telreg.test(tel)){alert("请输入正确的联系号码！(8位座机号或者11位手机号)");return false;}


		var length = $("#imglist").find("li").length;
		if(length == ''|| length == null  || length == undefined || length == 'undefined' || length < 2 ){alert('请上传2张以上图片');return false;}
		if(content== '' || content == null || content == undefined || content == 'undefined' ){alert('请输入新年寄语!');return false;}
        $("#do_apply").attr('disabled', '');
        $("form").submit();

	});
});
