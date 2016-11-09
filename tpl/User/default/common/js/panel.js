/* 
 * 驾车路线搜索插件 
 * @param map 地图对象
 * @param obj 显示DOM对象	
 */
var DrivingPanel = function(map, obj){
	this.obj = obj;
	this.map = map;
	this.markers = [];
	
	/* 驾车代码模板 */
	this._tpl = "<div class='drive-title'>驾车方案(总里程{$distance}公里 共{$time}分钟)</div><ul class='drive-list'>{loop}<li>{$line}</li>{/loop}</ul>";
};
DrivingPanel.prototype = {
	init : function(route){
		this.tpl = this._tpl;
		this.clear();
		this.route = route.detail.routes;
		this.driveTimeRoute();
		this.drivePath();
		this.drawDriveRoute();
		this.routeEvent();
	},
	/* 拼接驾车时间和路程长短 */
	driveTimeRoute : function(){
		var distance = new RegExp('{\\$distance}', 'g');
		var time = new RegExp('{\\$time}', 'g');
		this.tpl = this.tpl.replace(distance, Math.round(this.route[0].distance/100)/10);
		this.tpl = this.tpl.replace(time, this.route[0].duration);
	},
	/* 拼接路线 */
	drivePath : function(){
		var lineRegexp = new RegExp("^.*{loop}(<li>.*?</li>){/loop}.*$", "g");
		var lineCont = new RegExp("{\\$line}", "g");
		var line = this.tpl.replace(lineRegexp, "$1");
		var lineHtml = [];
		var steps = this.route[0].steps;
		for(var i = 0; i < steps.length; i++){
			/*相关路名添加高亮*/
			var roadname = new RegExp(steps[i].roadname, "g");
			lineHtml.push(line.replace(lineCont, (i+1) +". "+ steps[i].instructions.replace(roadname, "<span>"+ steps[i].roadname +"</span>")));
		}

		this.tpl = this.tpl.replace(/{loop}<li>.*?<\/li>{\/loop}/g, lineHtml.join(""));
	},
	/* 画驾车行驶路线 */
	drawDriveRoute : function(){
		this.polylineRoute = new soso.maps.Polyline({
			strokeColor : new soso.maps.Color(56, 147, 249, 0.8),
	        strokeWeight : 6,
	        editable : false,
	        map : this.map,
	        zIndex : 99
		});
		var bounds = new soso.maps.LatLngBounds();
		for(var i = 0; i < this.route[0].path.length; i++){
			bounds.extend(this.route[0].path[i]);
		}
		this.polylineRoute.setPath(this.route[0].path);
		this.map.fitBounds(bounds);
		//添加起点marker
		this.markers["start"] = new soso.maps.Marker({
			map : this.map,
			icon : new soso.maps.MarkerImage(
            	"http://api.map.soso.com/v2/0/8a/theme/default/imgs/traffic_marker.png", 
            	new soso.maps.Size(32, 32), 
            	new soso.maps.Point(0, 0)
        	),
			position : this.route[0].path[0]
		});
		//添加终点marker
		this.markers["end"] = new soso.maps.Marker({
			map : this.map,
			icon : new soso.maps.MarkerImage(
            	"http://api.map.soso.com/v2/0/8a/theme/default/imgs/traffic_marker.png", 
            	new soso.maps.Size(32, 32), 
            	new soso.maps.Point(32, 0)
        	),
			position : this.route[0].path[this.route[0].path.length-1]
		});              
	},
	/* 路线添加事件 */
	routeEvent : function(){
		this.obj.innerHTML = this.tpl;
		var _this = this;
		var listObj = this.obj.getElementsByTagName("li");
		this.polyline = new soso.maps.Polyline({
			strokeColor : '#f00',
	        strokeWeight : 6,
	        editable : false,
	        map : this.map,
	        zIndex : 100
		});
		for(var i = 0; i < listObj.length; i++){
			(function(k){
				soso.maps.event.addListener(listObj[k], "click", function(){
					var path = [];
					var isStart = 0;
					var bounds = new soso.maps.LatLngBounds();
					for(var j = 0; j < _this.route[0].path.length; j++){
						if(_this.route[0].path[j] == _this.route[0].steps[k].start_location && isStart == 0){
							path.push(_this.route[0].path[j]);
							bounds.extend(_this.route[0].path[j]);
							isStart = 1;
						}else if(_this.route[0].path[j] == _this.route[0].steps[k].end_location && isStart == 1){
							path.push(_this.route[0].path[j]);
							bounds.extend(_this.route[0].path[j]);
							break;
						}else if(isStart == 1){
							path.push(_this.route[0].path[j]);
							bounds.extend(_this.route[0].path[j]);
						}
					}
					var liObj = this.parentNode.childNodes;
					for(var m = 0; m < liObj.length; m++){
						liObj[m].style.background = "";
					}
					this.style.background = "rgb(225, 236, 242)";
					_this.polyline.setPath(path);
					_this.map.fitBounds(bounds);
				});
			})(i);
		}
	},
	/* 设置模板 
	 * @param tpl 模板代码
	 */
	setTpl : function(tpl){
		this._tpl = tpl;
	},
	/* 清除地图数据 */
	clear : function(){
		this.polyline != null && this.polyline.setMap(null);
		this.polyline = null;
		this.polylineRoute != null && this.polylineRoute.setMap(null);
		this.polylineRoute = null;
		var tmp = "";
		for(tmp in this.markers){
			if(this.markers[tmp] != null){
				this.markers[tmp].setMap(null);
				this.markers[tmp] = null;
			}
		}
	}
};
DrivingPanel.prototype.constructor = DrivingPanel;

/*
 * 公交路线插件
 * @param map 地图对象
 * @param obj 显示DOM对象
 */
var TransferPanel = function(map, obj){
	this.obj = obj;
	this.map = map;
	this.markers = [];
	this.polylines = [];
	
	/* 模板 */
	this._tpl = "<div class='drive-title'>公交乘坐方案(共{$num}组):</div><ul class='drive-list'>{loop}<li><p class='bus-title'><b>{$index}</b>约{$distance}公里,换乘{$times}次,步行约{$walk}米,共{$time}分钟</p><p>{$detail}</p></li>{/loop}</ul>";
};
TransferPanel.prototype = {
	init : function(route){
		this.tpl = this._tpl;
		this.clear();
		this.route = route.detail.plans;
		this.busNum();
		this.busPath();
		this.busEvent();
		this.drawBusRoute(0);
	},
	/* 路线titile模板 */
	busNum : function(){
		var num = new RegExp("{\\$num}", "g");
		this.tpl = this.tpl.replace(num, this.route.length);
	},
	/* 拼接路线模板 */
	busPath : function(){
		var lineRegexp = new RegExp("^.*{loop}(<li>.*?</li>){/loop}.*$", "g");
		var lineDetail = new RegExp("{\\$detail}", "g");
		var line = this.tpl.replace(lineRegexp, "$1");
		var lineHtml = [];
		for(var i = 0; i < this.route.length; i++){
			var _line = line;
			_line = _line.replace(/{\$index}/g, i+1 +". ");
			_line = _line.replace(/{\$distance}/g, Math.round(this.route[0].distance/100)/10);
			_line = _line.replace(/{\$times}/g, this.route[i].lines.length);
			/* 步行距离 */
			var walksDistance = 0;
			for(var j = 0, walks = this.route[i].walks; j < walks.length; j++){
				walksDistance += walks[j].distance;
			}
			_line = _line.replace(/{\$walk}/g, walksDistance);
			_line = _line.replace(/{\$time}/g, this.route[i].duration);
			/* 拼接详情 */
			var detail = "";
			for(var j = 0, actions = this.route[i].actions; j < actions.length; j++){
				var data = actions[j].data;
				if(data.name != null){
					var busReg = new RegExp(data.name, "g");
					var busReg1 = new RegExp(data.to, "g");
					actions[j].instructions = actions[j].instructions.replace(busReg, "<span>"+ data.name +"</span>").replace(busReg1, "<span>"+ data.to +"</span>");
				}else{
					var steps = data.steps[0];
					if(data.end_address == "") data.end_address = "{}";
					var walk = new RegExp(data.end_address, "g");
					var walk1 = new RegExp(steps.turning.text, "g");
					actions[j].instructions =  actions[j].instructions.replace(walk, "<span>"+ data.end_address +"</span>").replace(walk1, "<span>"+ steps.turning.text +"</span>");
				}
				detail += actions[j].instructions +"，";
			}
			lineHtml.push(_line.replace(lineDetail, detail.replace(/，$/, "。")));
		}

		this.tpl = this.tpl.replace(/{loop}<li>.*?<\/li>{\/loop}/g, lineHtml.join(""));
	},
	/* 
	 * 画路线 
	 * @param i 需要画线的路径
	 */
	drawBusRoute : function(i){
		this.clear();
		this.map.fitBounds(this.route[i].bounds);
		for(var j = 0, actions = this.route[i]['actions']; j < actions.length; j++){
			if(j != 0 && actions[j]['type'] == "BUS"){
				this.markers['BUSstart'+ j] = new soso.maps.Marker({
					map : this.map,
					icon : new soso.maps.MarkerImage(
		            	"http://api.map.soso.com/v2/0/8a/theme/default/imgs/traffic_marker.png", 
		            	new soso.maps.Size(32, 32), 
		            	new soso.maps.Point(60, 0),
		            	new soso.maps.Point(5, 32)
		        	),
					position : actions[j].data.path[0]
				});
			}
			if(j != actions.length-1 && actions[j]['type'] == "BUS"){
				this.markers['BUSend'+ j] = new soso.maps.Marker({
					map : this.map,
					icon : new soso.maps.MarkerImage(
		            	"http://api.map.soso.com/v2/0/8a/theme/default/imgs/traffic_marker.png", 
		            	new soso.maps.Size(32, 32), 
		            	new soso.maps.Point(60, 0),
		            	new soso.maps.Point(5, 32)
		        	),
					position : actions[j].data.path[actions[j].data.path.length-1]
				});
			}
			if(actions[j]['type'] == "BUS"){
				this.polylines['BUS'+ j] = new soso.maps.Polyline({
					strokeColor : new soso.maps.Color(56, 147, 249, 0.8),
			        strokeWeight : 6,
			        editable : false,
			        map : this.map,
			        path : actions[j].data.path,
			        zIndex : 99
				});
			}else if(actions[j]['type'] == "WALK"){
				this.polylines['BUS'+ j] = new soso.maps.Polyline({
					strokeColor : new soso.maps.Color(56, 147, 249, 0.8),
			        strokeWeight : 6,
			        strokeDashStyle : 'dash',
			        editable : false,
			        map : this.map,
			        path : actions[j].data.path,
			        zIndex : 99
				});
			}
		}
		//添加起点marker
		this.markers["start"] = new soso.maps.Marker({
			map : this.map,
			icon : new soso.maps.MarkerImage(
            	"http://api.map.soso.com/v2/0/8a/theme/default/imgs/traffic_marker.png", 
            	new soso.maps.Size(32, 32), 
            	new soso.maps.Point(0, 0)
        	),
			position : this.route[i].actions[0].data.path[0]
		});
		//添加终点marker
		this.markers["end"] = new soso.maps.Marker({
			map : this.map,
			icon : new soso.maps.MarkerImage(
            	"http://api.map.soso.com/v2/0/8a/theme/default/imgs/traffic_marker.png", 
            	new soso.maps.Size(32, 32), 
            	new soso.maps.Point(32, 0)
        	),
			position : this.route[i].actions[this.route[i].actions.length-1].data.path[this.route[i].actions[this.route[i].actions.length-1].data.path.length-1]
		});       
	},
	/* 路线添加事件 */
	busEvent : function(){
		this.obj.innerHTML = this.tpl;
		var _this = this;
		var listObj = this.obj.getElementsByTagName("li");
		for(var i = 0; i < listObj.length; i++){
			(function(k){
				soso.maps.event.addListener(listObj[k], "click", function(){
					var liObj = this.parentNode.childNodes;
					for(var m = 0; m < liObj.length; m++){
						liObj[m].style.background = "";
					}
					this.style.background = "rgb(225, 236, 242)";
					_this.drawBusRoute(k);
				});
			})(i);
		}
	},
	/* 设置模板
	 * @param tpl 模板代码
	 */
	setTpl : function(tpl){
		this._tpl = tpl;
	},
	/* 清除地图数据 */
	clear : function(){
		var tmp = "";
		for(tmp in this.markers){
			if(this.markers[tmp] != null){
				this.markers[tmp].setMap(null);
				this.markers[tmp] = null;
			}
		}
		for(tmp in this.polylines){
			if(this.polylines[tmp] != null){
				this.polylines[tmp].setMap(null);
				this.polylines[tmp] = null;
			}
		}
	}
};
TransferPanel.prototype.constructor = TransferPanel;

/*
 * 搜索面板
 * @param map 地图对象
 * @param obj 显示DOM对象
 */
var SearchPanel = function(map, obj){
	this.obj = obj;
	this.map = map;
	this.markers = [];
	this.infowin = new soso.maps.InfoWindow({
		map : this.map,
	});
	
	/* 模板 */
	this._tpl = "<div class='drive-title'>搜索结果(共{$num}条):</div><ul class='drive-list'>{loop}<li><div class='soso-sea-index'>{$index}</div><div class='soso-sea-title'><div class='soso-sea-t'>{$name}</div><p>{$addr}</p><p>{$phone}</p></div></div></li>{/loop}</ul><div class='soso-page' id='J_soso_seapage'>{pageloop}{/pageloop}</div>";
};
SearchPanel.prototype = {
	init : function(route){
		this.tpl = this._tpl;
		this.clear();
		this.route = route.detail;
		this.num();
		this.addHtml();
		this.addMarker();
		this.page();
		this.addEvent();
	},
	/* 数据总数 */
	num : function(){
		this.tpl = this.tpl.replace(/{\$num}/, this.route.totalNum);
	},
	/* 添加模板 */
	addHtml : function(){
		var lineRegexp = new RegExp("^.*{loop}(<li>.*?</li>){/loop}.*$", "g");
		var line = this.tpl.replace(lineRegexp, "$1");
		var lineHtml = [];

		for(var i = 0; i < this.route.pois.length; i++){
			var poi = this.route.pois[i];
			var _line = line;

			_line = _line.replace(/{\$index}/, i+1 +" .");
			_line = _line.replace(/{\$name}/, poi.name);
			_line = _line.replace(/{\$addr}/, poi.address);
			_line = _line.replace(/{\$phone}/, typeof poi.phone == "undefined" ? "暂无" : poi.phone);

			lineHtml.push(_line);
		}
		this.tpl = this.tpl.replace(/{loop}<li>.*?<\/li>{\/loop}/, lineHtml.join(""));
	},
	/* 分页 */
	page : function(){
		//setPageIndex(this.route.pageIndex);
		var pageNum = Math.ceil(this.route.totalNum/10);
		var currentPage = this.route.pageIndex;
		var html = [];

		if(currentPage < 2 && pageNum > 2){
			for(var i = 0; i < 3; i++){
				i == currentPage ? html.push("<span class='cur'>"+ (i+1) +"</span>") : html.push('<span page="'+ i +'">'+ (i+1) +'</span>');
			}
			html.push(' ... <span page="'+ (pageNum-1) +'">'+ pageNum +'</span>');
		}else if(currentPage < 2 && pageNum < 2){
			for(var i = 0; i < pageNum; i++){
				i == currentPage ? html.push("<span class='cur'>"+ (i+1) +"</span>") : html.push('<span page="'+ i +'">'+ (i+1) +'</span>');
			}
		}else if(currentPage >= 2 && currentPage < pageNum-2){
			html.push('<span page="0">1</span> ... ');
			for(var i = currentPage-1; i < currentPage+2; i++){
				i == currentPage ? html.push("<span class='cur'>"+ (i+1) +"</span>") : html.push('<span page="'+ i +'">'+ (i+1) +'</span>');
			}
			html.push(' ... <span page="'+ (pageNum-1) +'">'+ pageNum +'</span>');
		}else if(currentPage >= 2 && currentPage >= pageNum-2){
			html.push('<span page="0">1</span> ... ');
			for(var i = pageNum - 3; i < pageNum; i++){
				i == currentPage ? html.push("<span class='cur'>"+ (i+1) +"</span>") : html.push('<span page="'+ i +'">'+ (i+1) +'</span>');
			}
		}

		this.tpl = this.tpl.replace(/{pageloop}{\/pageloop}/, html.join(""));
		//this.addPageEvent();
	},
	/* 
	 * 分页添加事件 
	 * @param s 搜索对象
	 * @param key 搜索关键字
	 * @param latlng 搜索中心经纬度
	 * @param radius 搜索半径
	 */
	addPageEvent : function(s, key, latlng, radius){
		var pageObj = document.getElementById("J_soso_seapage").getElementsByTagName("span");
		for(var i = 0; i < pageObj.length; i++){
			soso.maps.event.addListener(pageObj[i], "click", function(){
				if(this.getAttribute("page")){
					s.setPageIndex(parseInt(this.getAttribute("page")));
					s.searchNearBy(key, latlng, radius);
				}
			});
		}
	},
	/* 添加marker */
	addMarker : function(){
		this.infowin.close();
		var pois = this.route.pois;
		var _this = this;
		var bounds = new soso.maps.LatLngBounds();
		for(var i = 0; i < pois.length; i++){
			this.markers[i] = new soso.maps.Marker({
				map : this.map,
				icon : new soso.maps.MarkerImage(
	            	"http://api.map.soso.com/v2/0/8b/theme/default/imgs/marker1/num_icons.png", 
	            	new soso.maps.Size(23, 35),
	            	new soso.maps.Point(0, 35*i)
	        	),
				position : pois[i].latLng
			});
			bounds.extend(pois[i].latLng);
			(function(k){
				soso.maps.event.addListener(_this.markers[k], "click", function(){
					var phone;
					typeof pois[k].phone == "undefined" ? phone = "暂无" : phone = pois[k].phone;
					var content = '<div style="margin: -1px; padding: 1px;"><div style="font-style:normal;font-variant:normal;font-weight:normal;font-size:14px;color:#333333;line-height:20px;font-family:Tahoma 宋体 Arial;border:0 none;width:200px"><div><span style="color:#0059B3">'+ pois[k].name +'</span><span style="margin-left:10px;"><a target="_blank" style="font-size: 12px;color:#0059B3" href="http://map.soso.com/poi/?sm='+ pois[k].id +'">详情</a></span></div><div style="margin-top:5px;color:#666666;font-size: 12px;"><div><span>地址:</span><span>'+ pois[k].address +'</span></div><div><span>电话:</span><span>'+ phone +'</span></div></div></div><div></div></div>';
					_this.infowin.setPosition(pois[k].latLng);
					_this.infowin.setContent(content);
					_this.infowin.open();
					for(var j = 0; j < _this.markers.length; j++){
						 _this.markers[j].setZIndex(10);
						 _this.markers[j].setIcon(new soso.maps.MarkerImage("http://api.map.soso.com/v2/0/8b/theme/default/imgs/marker1/num_icons.png", new soso.maps.Size(23, 35), new soso.maps.Point(0, 35*j)));
					}
					this.setZIndex(20);
					this.setIcon(new soso.maps.MarkerImage("http://api.map.soso.com/v2/0/8b/theme/default/imgs/marker1/num_icons.png", new soso.maps.Size(23, 35), new soso.maps.Point(27, 35*k)));
				});
			})(i);
		}
		this.map.fitBounds(bounds);
	},
	addEvent : function(){
		this.obj.innerHTML = this.tpl;
		var _this = this;
		var listObj = this.obj.getElementsByTagName("li");
		var pois = this.route.pois;
		for(var i = 0; i < listObj.length; i++){
			(function(k){
				soso.maps.event.addListener(listObj[k], "click", function(){
					var liObj = this.parentNode.childNodes;
					for(var m = 0; m < liObj.length; m++){
						liObj[m].style.background = "";
					}
					this.style.background = "rgb(225, 236, 242)";
					var phone;
					typeof pois[k].phone == "undefined" ? phone = "暂无" : phone = pois[k].phone;
					var content = '<div style="margin: -1px; padding: 1px;"><div style="font-style:normal;font-variant:normal;font-weight:normal;font-size:14px;color:#333333;line-height:20px;font-family:Tahoma 宋体 Arial;border:0 none;width:200px"><div><span style="color:#0059B3">'+ pois[k].name +'</span><span style="margin-left:10px;"><a target="_blank" style="font-size: 12px;color:#0059B3" href="http://map.soso.com/poi/?sm='+ pois[k].id +'">详情</a></span></div><div style="margin-top:5px;color:#666666;font-size: 12px;"><div><span>地址:</span><span>'+ pois[k].address +'</span></div><div><span>电话:</span><span>'+ phone +'</span></div></div></div><div></div></div>';
					_this.infowin.setPosition(pois[k].latLng);
					_this.infowin.setContent(content);
					_this.infowin.open();
					for(var j = 0; j < _this.markers.length; j++){
						 _this.markers[j].setZIndex(10);
						 _this.markers[j].setIcon(new soso.maps.MarkerImage("http://api.map.soso.com/v2/0/8b/theme/default/imgs/marker1/num_icons.png", new soso.maps.Size(23, 35), new soso.maps.Point(0, 35*j)));
					}
					_this.markers[k].setZIndex(20);
					_this.markers[k].setIcon(new soso.maps.MarkerImage("http://api.map.soso.com/v2/0/8b/theme/default/imgs/marker1/num_icons.png", new soso.maps.Size(23, 35), new soso.maps.Point(27, 35*k)));
				});
			})(i);
		}
	},
	/* 设置模板
	 * @param tpl 模板代码
	 */
	setTpl : function(tpl){
		this._tpl = tpl;
	},
	/* 清除地图数据 */
	clear : function(){
		var tmp = "";
		while(tmp = this.markers.pop()){
			tmp.setMap(null);
			tmp = null;
		}
	}
};
SearchPanel.prototype.constructor = SearchPanel;