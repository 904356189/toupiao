// JavaScript Document
var btnValue = "";
var diffSecond = $.cookie("diffSecond");
var checkDiffSecondIndex = 0;
var btnObj = "";
var mobileObj = "";
$(function(){
	btnObj = $("#sendBtn");
	mobileObj = $("#tel");
	if(diffSecond>0){
		btnValue = btnObj.val();
		btnObj.attr("disabled","disabled");
		checkDiffSecondIndex = window.setInterval("checkDiffSecond()",1000);
	}
});
function isMobile(mobile){
	var re= /^(1(([35][0-9])|(47)|[8][0126789]))\d{8}$/;
	return re.test(mobile);
}
function sendVerifyCode(type){
	var mobile = mobileObj.val();
	if(isMobile(mobile)){
		btnValue = btnObj.val();
		btnObj.attr("disabled","disabled");
		var url = "/index.php?g=Wap&m=Userinfo&a=sendVerifyCode&token="+getParameterValue("token")+"&wecha_id="+getParameterValue("wecha_id")+"&cardid="+getParameterValue("cardid")+"&mobile="+mobile+"&rand="+Math.random();
//alert(url);		
		$.get(url,{},function(data){
			if(data.indexOf("成功")>-1){
				diffSecond = 60;
				checkDiffSecondIndex = window.setInterval("checkDiffSecond()",1000);
			}else{
				alert(data);
				resetBtn();
			}
		});
	}else{
		alert("请输入正确的手机号");
		mobileObj.select();
	}
}
function resetBtn(){
	btnObj.val(btnValue);
	btnObj.removeAttr("disabled");
}
function checkDiffSecond(){
	if(diffSecond>0){
		btnObj.val(diffSecond+"秒后可重新发送");
		diffSecond--;
		$.cookie("diffSecond",diffSecond);
	}else{
		window.clearInterval(checkDiffSecondIndex);
		resetBtn();
	}
}
function getParameterValue(name){
	var href = location.href;
	var hrefs = href.split("&");
	for(var i=0;i<hrefs.length;i++){
		var parameter = hrefs[i];
		var parameters = parameter.split("=");
		if(parameters[0]==name){
			return parameters[1];
		}
	}
}