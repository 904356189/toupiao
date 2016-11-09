/*
Powered by ly200.com		http://www.ly200.com
广州联雅网络科技有限公司		020-83226791
*/

var account_obj={
	login_init:function(){
		if(window!=top){
			top.location.href=window.location.href;
		}
		
		$('form').submit(function(){return false;});
		$('input:submit').click(function(){
			var flag=false;
			$('#UserName, #Password').each(function(){
				if($(this).val()==''){
					$(this).focus();
					flag=true;
					return false;
				}
			});
			if(flag){return;}
			
			$('.login_msg').html('');
			$(this).attr('disabled', true);
			
			$.post('?', $('form').serialize(), function(data){
				$('input:submit').attr('disabled', false);
				if(data.status==1){
					window.top.location='./';
				}else if(data.status==2){
					$('.login_msg').show().html('登录失败，错误的用户名或密码！');
				}else if(data.status==3){
					$('.login_msg').show().html('您的帐号已被锁定，无法登录！');
				}else if(data.status==4){
					$('.login_msg').show().html('您的帐号已经到期，无法登录！');
				};
			}, 'json');
		});
		
		$('form input').each(function(){
			$(this).focus(function(){
				$(this).siblings('label').css({display:'none'});
			});
			$(this).blur(function(){
				if($(this).val()==''){
					$(this).siblings('label').css({display:'block'});
				}
			});
		});
	},
	
	index_init:function(){
		$('a[group]').click(function(){
			var group=$(this).attr('group');
			if(group=='#'){
				parent.$('#main .menu dt').removeClass('cur');
				parent.$('#main .menu dd').hide();
			}else{
				parent.$('#main .menu dt').removeClass('cur');
				parent.$('#main .menu dt[group='+group+']').addClass('cur').next().filter('dd').show();
			}
			parent.$('#main .menu div').removeClass('cur');
			if($(this).attr('url')){
				parent.$('#main .menu a[href="'+$(this).attr('url')+'"]').parent().addClass('cur');
			}else{
				parent.$('#main .menu a[href="'+$(this).attr('href')+'"]').parent().addClass('cur');
			}
			parent.main_obj.page_scroll_init();
		});
	},
	
	profile_init:function(){
		$('#profile_form').submit(function(){return false;});
		$('#profile_form input:submit').click(function(){
			if(global_obj.check_form($('*[notnull]'))){return false;};
			
			if($('#NewPassword').val()!=$('#ConfirmPassword').val()){
				$('.profile_msg').css({display:'block'}).html('新密码与确认密码不匹配，请重新输入！');
				return false;
			}
			
			$('.profile_msg').css({display:'none'}).html('');
			$(this).attr('disabled', true);
			
			$.post('?', $('#profile_form').serialize(), function(data){
				$('#profile_form input:submit').attr('disabled', false);
				$('#OldPassword, #NewPassword, #ConfirmPassword').val('');
				
				if(data.status==1){
					$('.profile_msg').css({display:'block'}).html('密码修改成功，请牢记新密码！');
				}else if(data.status==2){
					$('.profile_msg').css({display:'block'}).html('修改密码失败，旧密码错误！');
				}
			}, 'json');
		});
	}
}