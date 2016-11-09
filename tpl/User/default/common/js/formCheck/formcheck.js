/*
Jquery 表单验证插件 
janchie 2010.1
1.02版
*/

(function($){
$.fn.extend({
	valid:function(){
		if( ! $(this).is("form") ) return;
		
		//获取参数
		var items = $.isArray(arguments[0]) ? arguments[0] : [],
		isBindSubmit = typeof arguments[1] ==="boolean" ? arguments[1] :true,
		isAlert = typeof arguments[2] ==="boolean" ? arguments[2] :false,

		//验证规则
		rule = {
			// 正则规则
			"eng" : /^[A-Za-z]+$/,
			"chn" :/^[\u0391-\uFFE5]+$/,
			"mail" : /\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/,
			"url" : /^http[s]?:\/\/[A-Za-z0-9]+\.[A-Za-z0-9]+[\/=\?%\-&_~`@[\]\':+!]*([^<>\"\"])*$/,
			"currency" : /^\d+(\.\d+)?$/,
			"number" : /^\d+$/,
			"int" : /^[0-9]{1,30}$/,
			"double" : /^[-\+]?\d+(\.\d+)?$/,
			"username" : /^[a-zA-Z]{1}([a-zA-Z0-9]|[._]){4,19}$/,
			"password" : /^(\w){6,20}$/,
			"safe" : />|<|,|\[|\]|\{|\}|\?|\/|\+|=|\||\'|\\|\"|:|;|\~|\!|\@|\#|\*|\$|\%|\^|\&|\(|\)|`/i,
			"dbc" : /[ａ-ｚＡ-Ｚ０-９！＠＃￥％＾＆＊（）＿＋｛｝［］｜：＂＇；．，／？＜＞｀～　]/,
			"qq" : /[1-9][0-9]{4,}/,
			"date" : /^((((1[6-9]|[2-9]\d)\d{2})-(0?[13578]|1[02])-(0?[1-9]|[12]\d|3[01]))|(((1[6-9]|[2-9]\d)\d{2})-(0?[13456789]|1[012])-(0?[1-9]|[12]\d|30))|(((1[6-9]|[2-9]\d)\d{2})-0?2-(0?[1-9]|1\d|2[0-8]))|(((1[6-9]|[2-9]\d)(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00))-0?2-29-))$/,
			"year" : /^(19|20)[0-9]{2}$/,
			"month" : /^(0?[1-9]|1[0-2])$/,
			"day" : /^((0?[1-9])|((1|2)[0-9])|30|31)$/,
			"hour" : /^((0?[1-9])|((1|2)[0-3]))$/,
			"minute" : /^((0?[1-9])|((1|5)[0-9]))$/,
			"second" : /^((0?[1-9])|((1|5)[0-9]))$/,
			"mobile" : /^1\d{10}$/,
			"phone" : /^[+]{0,1}(\d){1,3}[ ]?([-]?((\d)|[ ]){1,12})+$/,
			"zipcode" : /^[1-9]\d{5}$/,
			"bodycard" : /^((1[1-5])|(2[1-3])|(3[1-7])|(4[1-6])|(5[0-4])|(6[1-5])|71|(8[12])|91)\d{4}((19\d{2}(0[13-9]|1[012])(0[1-9]|[12]\d|30))|(19\d{2}(0[13578]|1[02])31)|(19\d{2}02(0[1-9]|1\d|2[0-8]))|(19([13579][26]|[2468][048]|0[48])0229))\d{3}(\d|X|x)?$/,
			"ip" : /^(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])$/,		
			"file": /^[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/,
			"image" : /.+\.(jpg|gif|png|bmp)$/i,
			"word" : /.+\.(doc|rtf|pdf)$/i,

			// 函数规则
			"eq": function(arg1,arg2){ return arg1==arg2 ? true:false;},
			"gt": function(arg1,arg2){ return arg1>arg2 ? true:false;},
			"gte": function(arg1,arg2){ return arg1>=arg2 ? true:false;},
			"lt": function(arg1,arg2){ return arg1<arg2 ? true:false;},
			"lte": function(arg1,arg2){ return arg1<=arg2 ? true:false;}
			
		},

		//简单验证提示信息后缀
		msgSuffix = {
			"eng" : "只能输入英文" ,
			"chn" : "只能输入汉字",
			"mail" : "格式不正确",
			"url" : "格式不正确",
			"currency" : "数字格式有误",
			"number" : "只能为数字",
			"int" : "只能为整数",
			"double" : "只能为带小数的数字",
			"username" :"只能为数字和英文及下划线和.的组合，开头为字母，4-20个字符",
			"password" : "只能为数字和英文及下划线的组合，6-20个字符",
			"safe" : "不能有特殊字符",
			"dbc" : "不能有全角字符",
			"qq" : "格式不正确",
			"date" : "格式不正确",
			"year" : "不正确",
			"month" :"不正确",
			"day" : "不正确",
			"hour" : "不正确",
			"minute" :"不正确",
			"second" :"不正确",
			"mobile" : "格式不正确",
			"phone" : "格式不正确",
			"zipcode" : "格式不正确",
			"bodycard" : "格式不正确",
			"ip" : "IP不正确",
			"file": "类型不正确",
			"image" : "类型不正确",
			"word" : "类型不正确",
			"eq": "不等于",
			"gt": "不大于",
			"gte": "不大于或等于",
			"lt": "不小于",
			"lte": "不小于或等于"
		},

		msg = "", formObj = $(this) , checkRet = true, isAll,
		tipname = function(namestr){ return "tip_" + namestr.replace(/([a-zA-Z0-9])/g,"-$1"); },		
		
		//规则类型匹配检测
		typeTest = function(){
			var result = true,args = arguments;
			if(rule.hasOwnProperty(args[0])){
				var t = rule[args[0]], v = args[1];
				result = args.length>2 ? t.apply(arguments,[].slice.call(args,1)):($.isFunction(t) ? t(v) :t.test(v));
			}
			return result;
		},
		
		//错误信息提示  ****** 自定义修改 ******
		showError = function(fieldObj,filedName,warnInfo){
			checkRet = false;
			fieldObj.css("background","#FFDFDD");

			var tipObj = $("#"+tipname(filedName));
			if(tipObj.length>0){tipObj.remove();}
			var tipPosition = fieldObj.next().length>0 ? fieldObj.nextAll().eq(this.length-1):fieldObj.eq(1-1);
			tipPosition.after("<span style='color:#F06' id='"+tipname(filedName)+"'> "+warnInfo+" </span>");
			if(isAlert && isAll) msg += "\n" + warnInfo;
			//if(isAlert && !isAll) alert(warnInfo);
		},

		//正确信息提示  ****** 自定义修改 ******
		showRight = function(fieldObj,filedName){
			checkRet = true;
			fieldObj.css("background","#CCFFCC");

			var tipObj = $("#"+tipname(filedName));
			if(tipObj.length>0) tipObj.remove();
			var tipPosition = fieldObj.next().length>0 ? fieldObj.nextAll().eq(this.length-1):fieldObj.eq(1-1);
			tipPosition.after("<span style='color:#0C0' id='"+tipname(filedName)+"'> 正确 </span>");
		},

		//匹配对比值的提示名
		findTo = function(objName){
			var find;
			$.each(items, function(){
				if(this.name == objName && this.simple){
					find = this.simple;	return false;
				}
			});
			if(!find) find = $("[name='"+objName+"']")[0].name;
			return find;
		},
		
		//单元素验证
		fieldCheck = function(item){
			var i = item, field = $("[name='"+i.name+"']",formObj[0]);
			if(!field[0]) return;

			var warnMsg,fv = $.trim(field.val()),isRq = typeof i.require ==="boolean" ? i.require : true;

			if( isRq && ((field.is(":radio")|| field.is(":checkbox")) && !field.is(":checked"))){
				warnMsg =  i.message|| i.simple + "没有选择";
				showError(field ,i.name, warnMsg);

			}else if (isRq && fv == "" ){				
				warnMsg =  i.message|| i.simple + ( field.is("select") ? "没有选择" :"不能为空" );
				showError(field ,i.name, warnMsg);

			}else if(fv != ""){
				if(i.min || i.max){
					var len = fv.length, min = i.min || 0, max = i.max;
					warnMsg =  i.message || (max? i.simple + "长度范围应在"+min+"~"+max+"之间":i.simple + "长度应大于"+min);

					if( (max && (len>max || len<min)) || (!max && len<min) ){
						showError(field ,i.name, warnMsg);	return;
					}
				}
				if(i.type){
					var matchVal = i.to ? $.trim($("[name='"+i.to+"']").val()) :i.value;
					var matchRet = matchVal ? typeTest(i.type,fv,matchVal) :typeTest(i.type,fv);

					warnMsg = i.message|| i.simple + msgSuffix[i.type];
					if(matchVal && i.simple) warnMsg += (i.to ? findTo(i.to) +"的值" :i.value);

					if(!matchRet) showError(field ,i.name, warnMsg);
					else showRight(field,i.name);

				}else{
					showRight(field,i.name);
				}

			}else if (isRq){
				showRight(field,i.name);
			}
		
		},

		//元素组验证
		validate = function(){
			$.each(items, function(){isAll=true; fieldCheck(this);});
			
			if(isAlert && msg != ""){
				alert(msg);	msg = "";
			}
			return checkRet;
		};

		//单元素事件绑定
		$.each(items, function(){			
			var field = $("[name='"+this.name+"']",formObj[0]);
			if(field.is(":hidden")) return;

			var obj = this,toCheck = function(){ isAll=false; fieldCheck(obj);};
			if(field.is(":file") || field.is("select")){
				field.change(toCheck);
			}else{
				field.blur(toCheck);
			}
		});		
		
		
		//提交事件绑定
		if(isBindSubmit) {
			$(this).submit(validate);
		}else{
			return validate();
		}
		
	}

});

})(jQuery);
