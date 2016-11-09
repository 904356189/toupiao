function JumpleftFrame(url,id){
	showhover(id);
	document.getElementById("left").src=url;
}
function JumpToMain(url){
	document.getElementById("main").src=url;
}
var $ = jQuery;
var thespeed = 5;
var navIE = document.all && navigator.userAgent.indexOf("Firefox")==-1;
var myspeed=0;
$(function(){
		//左侧菜单开关
		LeftMenuToggle();

});
function showhover(id){
	$('.curr').removeClass('curr');
	$('#link'+id).addClass('curr');
}	
function LeftMenuToggle(){//左侧菜单开关
		$("#togglemenu").click(function(){
			if($("body").attr("class")=="showmenu"){
				$("body").attr("class","hidemenu");
				$(this).html("显示菜单");
			}else{
				$("body").attr("class","showmenu");
				$(this).html("隐藏菜单");
			}
		});
	}