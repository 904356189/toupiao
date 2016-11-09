/*cate_select 多级菜单动态加载*/
;(function($){
    //联动菜单
    $.fn.cate_select = function(options) {
        var settings = {
            field: 'J_cate_id',
            top_option: '请选择'
        };
        if(options) {
            $.extend(settings, options);
        }

        var self = $(this),
            pid = self.attr('data-pid'),
            uri = self.attr('data-uri'),
            selected = self.attr('data-selected'),
            selected_arr = [];
        if(selected != undefined && selected != '0'){
        	if(selected.indexOf('|')){
        		selected_arr = selected.split('|');
        	}else{
        		selected_arr = [selected];
        	}
        }
        self.nextAll('.J_cate_select').remove();
        $('<option value="">--'+settings.top_option+'--</option>').appendTo(self);
        $.getJSON(uri, {pid:pid}, function(result){
            if(result.status == '1'){
                for(var i=0; i<result.data.length; i++){
                $('<option value="'+result.data[i].id+'">'+result.data[i].name+'</option>').appendTo(self);
                }
            }
            if(selected_arr.length > 0){
            	//IE6 BUG
            	setTimeout(function(){
            		self.find('option[value="'+selected_arr[0]+'"]').attr("selected", true);
	        		self.trigger('change');
            	}, 1);
            }
        });

        var j = 1;
        $('.J_cate_select').die('change').live('change', function(){
            var _this = $(this),
            _pid = _this.val();
            _this.nextAll('.J_cate_select').remove();
            if(_pid != ''){
                $.getJSON(uri, {pid:_pid}, function(result){
                    if(result.status == '1'){
                        var _childs = $('<select class="J_cate_select px" data-pid="'+_pid+'"><option value="">--'+settings.top_option+'--</option></select>')
                        for(var i=0; i<result.data.length; i++){
                            $('<option value="'+result.data[i].id+'">'+result.data[i].name+'</option>').appendTo(_childs);
                        }
                        _childs.insertAfter(_this);
                        if(selected_arr[j] != undefined){
                        	//IE6 BUG
                        	//setTimeout(function(){
			            		_childs.find('option[value="'+selected_arr[j]+'"]').attr("selected", true);
				        		_childs.trigger('change');
			            	//}, 1);
			            }
                        j++;
                    }
                });
                $('#'+settings.field).val(_pid);
            }else{
            	$('#'+settings.field).val(_this.attr('data-pid'));
            }
        });
    }
})(jQuery);