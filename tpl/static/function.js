/**
 * 后台公共JS函数库
 *
 */

function confirmurl(url,message) {
	window.top.art.dialog.confirm(message, function(){
    	redirect(url);
	}, function(){
	    return true;
	});
	//if(confirm(message)) redirect(url);
}

function redirect(url) {
	location.href = url;
}

/**
 * 全选checkbox,注意：标识checkbox id固定为为check_box
 * @param string name 列表check名称,如 uid[]
 */
function selectall(name) {
	if ($("#check_box").attr("checked")=='checked') {
		$("input[name='"+name+"']").each(function() {
  			$(this).attr("checked","checked");
			
		});
	} else {
		$("input[name='"+name+"']").each(function() {
  			$(this).removeAttr("checked");
		});
	}
}
function openwinx(url,name,w,h) {
	if(!w) w=screen.width-4;
	if(!h) h=screen.height-95;
    window.open(url,name,"top=100,left=400,width=" + w + ",height=" + h + ",toolbar=no,menubar=no,scrollbars=yes,resizable=yes,location=no,status=no");
}

//表单提交时弹出确认消息
function submit_confirm(id,msg,w,h){
	if(!w) w=250;
	if(!h) h=100;
	  window.top.art.dialog({
      content:msg,
      lock:true,
      width:w,
      height:h,
      ok:function(){
        $("#"+id).submit();
        return true;
      },
      cancel: true
    });
}