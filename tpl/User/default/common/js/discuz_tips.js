var clearTips;
DiscuzCloudNameSpace = new Object();
DiscuzCloudNameSpace.register = function(fullName) {
	try {
		var nsArray = fullName.split(".");
		var strNS = "";
		var strEval = "";
		for (var i = 0; i < nsArray.length; i++) {
			if (strNS.length > 0) strNS += ".";
			strNS += nsArray[i];
			strEval += " if (typeof(" + strNS + ") =='undefined') " + strNS + " = new Object(); "
		};
		if (strEval != "") eval(strEval)
	} catch(e) {
		alert(e.message)
	}
};
DiscuzCloudNameSpace.register('DiscuzCloud');
DiscuzCloud.JSONP = (function() {
	var counter = 0,
	head, query, key, window = this;
	function load(url) {
		script = document.createElement('script'),
		done = false;
		script.src = url;
		script.charset = 'UTF-8';
		script.async = true;
		script.onload = script.onreadystatechange = function() {
			if (!done && (!this.readyState || this.readyState === "loaded" || this.readyState === "complete")) {
				done = true;
				script.onload = script.onreadystatechange = null;
				if (script && script.parentNode) {
					script.parentNode.removeChild(script)
				}
			}
		};
		if (!head) {
			head = document.getElementsByTagName('head')[0]
		};
		head.appendChild(script)
	};
	function jsonp(url, params, callback) {
		if (url.indexOf('?') > -1) {
			query = '&'
		} else {
			query = '?'
		};
		params = params || {};
		for (key in params) {
			if (params.hasOwnProperty(key)) {
				query += encodeURIComponent(key) + "=" + encodeURIComponent(params[key]) + "&"
			}
		};
		var jsonp = 'discuzTipsCallback';
		window[jsonp] = function(data) {
			callback(data);
			try {
				delete window[jsonp]
			} catch(e) {}
			window[jsonp] = null
		};
		load(url + query + "callback=" + jsonp);
		return jsonp
	};
	return {
		get: jsonp
	}
} ());
DiscuzCloud.htmlspecialchars = function(string, quote_style, charset, double_encode) {
	var optTemp = 0,
	i = 0,
	noquotes = false;
	if (typeof quote_style === 'undefined' || quote_style === null) {
		quote_style = 2
	};
	string = string.toString();
	if (double_encode !== false) {
		string = string.replace(/&/g, '&amp;')
	};
	string = string.replace(/</g, '&lt;').replace(/>/g, '&gt;');
	var OPTS = {
		'ENT_NOQUOTES': 0,
		'ENT_HTML_QUOTE_SINGLE': 1,
		'ENT_HTML_QUOTE_DOUBLE': 2,
		'ENT_COMPAT': 2,
		'ENT_QUOTES': 3,
		'ENT_IGNORE': 4
	};
	if (quote_style === 0) {
		noquotes = true
	};
	if (typeof quote_style !== 'number') {
		quote_style = [].concat(quote_style);
		for (i = 0; i < quote_style.length; i++) {
			if (OPTS[quote_style[i]] === 0) {
				noquotes = true
			} else if (OPTS[quote_style[i]]) {
				optTemp = optTemp | OPTS[quote_style[i]]
			}
		};
		quote_style = optTemp
	};
	if (quote_style & OPTS.ENT_HTML_QUOTE_SINGLE) {
		string = string.replace(/'/g, '&#039;')
	};
	if (!noquotes) {
		string = string.replace(/"/g, '&quot;')
	};
	return string
};
DiscuzCloud.setCookie = function(name, value, sec) {
	if (typeof(sec) == 'undefined') {
		sec = 86400000;
	} else {
		sec = sec * 1000
	};
	var expires = new Date();
	expires.setTime(expires.getTime() + sec);
	document.cookie = name + '=' + escape(value) + '; expires=' + expires.toGMTString()
};
DiscuzCloud.getCookie = function(name) {
	var cookie_start = document.cookie.indexOf(name);
	var cookie_end = document.cookie.indexOf(';', cookie_start);
	return cookie_start == -1 ? '': unescape(document.cookie.substring(cookie_start + name.length + 1, (cookie_end > cookie_start ? cookie_end: document.cookie.length)))
};
DiscuzCloud.$ = function(id) {
	return document.getElementById(id)
};
DiscuzCloud.Tips = function(sId, version, release, api, founder, fix, sUrl, sCharset, ts, sig, adminId, groupId, uid, openId) {
	this.sId = sId;
	this.sUrl = sUrl;
	this.version = version;
	this.release = release;
	this.api = api;
	this.founder = founder;
	this.fix = fix;
	this.clientWidth = document.documentElement.clientWidth;
	this.clientHeight = document.documentElement.clientHeight;
	this.discuzTips = DiscuzCloud.$('discuz_tips');
	newDate = new Date();
	this.url = 'http://cp.discuz.qq.com/tips/get?rand=' + newDate.getDate() + newDate.getHours();
	this.secret = '';
	this.tipsId = '';
	this.cacheKey = '';
	this.sendTime = '';
	this.sCharset = sCharset;
	if (typeof(document.characterSet) == 'undefined') {
		this.browserCharset = document.charset
	} else {
		this.browserCharset = document.characterSet
	};
	if (discuzTipsCVersion == '2') {
		this.adminId = adminId;
		this.groupId = groupId;
		this.uid = uid;
		this.openId = openId
	};
	this.ts = ts;
	this.sig = sig
};
DiscuzCloud.Tips.prototype.show = function() {
	if (discuzTipsCVersion == '2' && this.uid == 0) {
		return false
	};
	if (discuzTipsCVersion == '2' && this.adminId == 0) {
		now = new Date();
		ctrlTime = DiscuzCloud.getCookie('tjpctrl');
		if (now.getTime() < ctrlTime) {
			return false
		}
	};
	if (this.checkManyou()) {
		return false
	};
	var callback = function(data) {
		tipsCtrlTime = new Date();
		DiscuzCloud.setCookie('tjpctrl', tipsCtrlTime.getTime() + 1800000, 1800);
		if (typeof(data.errorCode) != 'undefined' && data.errorCode != 0) {
			return false
		};
		if (typeof(data.css) != 'undefined' && data.css) {
			tips.css(data.css)
		};
		if (typeof(data.secret) != 'undefined' && data.secret) {
			tips.secret = data.secret
		};
		if (typeof(data.tipsId) != 'undefined' && data.tipsId) {
			tips.tipsId = data.tipsId
		};
		if (typeof(data.tscKey) != 'undefined' && data.tscKey) {
			tips.tscKey = data.tscKey
		};
		if (typeof(data.html) != 'undefined') {
			tips.discuzTips.innerHTML = tips.analysis(data.html)
		};
		if (typeof(data.beforeJS) != 'undefined' && data.beforeJS) {
			eval(data.beforeJS)
		};
		if (typeof(data.afterJS) != 'undefined' && data.afterJS) {
			eval(data.afterJS)
		};
		if (typeof(data.sendTime) != 'undefined' && data.sendTime) {
			tips.sendTime = data.sendTime
		};
		if (typeof(data.viewPermission) != 'undefined' && data.viewPermission) {
			tips.viewPermission = data.viewPermission
		};
		tips.open();
		if (typeof(data.keepTime) != 'undefined' && data.keepTime > 0) {
			clearTips = setTimeout(function() {
				tips.close(data.tipsId, data.tscKey, data.viewPermission, true)
			},
			data.keepTime * 1000)
		}
	};
	var cookie = DiscuzCloud.getCookie('dctips');
	if (discuzTipsCVersion == '2') {
		var params = {
			's_id': this.sId,
			'product_version': this.version,
			'product_release': this.release,
			'fix_bug': this.fix,
			'is_founder': this.founder,
			's_url': this.sUrl,
			'last_send_time': cookie,
			'ts': this.ts,
			'sig': this.sig,
			'admin_id': this.adminId,
			'group_id': this.groupId,
			'open_id': this.openId,
			'uid': this.uid
		}
	} else {
		var params = {
			's_id': this.sId,
			'product_version': this.version,
			'product_release': this.release,
			'fix_bug': this.fix,
			'is_founder': this.founder,
			's_url': this.sUrl,
			'last_send_time': cookie,
			'ts': this.ts,
			'sig': this.sig
		}
	};
	DiscuzCloud.JSONP.get(this.url, params, callback)
};
DiscuzCloud.Tips.prototype.css = function(url) {
	try {
		document.createStyleSheet(url)
	} catch(e) {
		var cssLink = document.createElement('link');
		cssLink.rel = 'stylesheet';
		cssLink.type = 'text/css';
		cssLink.href = url;
		var head = document.getElementsByTagName('head')[0];
		head.appendChild(cssLink)
	}
};
DiscuzCloud.Tips.prototype.checkManyou = function() {
	if (DiscuzCloud.$('my_notify_wrap')) {
		return true
	};
	return false
};
DiscuzCloud.Tips.prototype.markAsRead = function(taskId, cacheKey, viewPermission) {
	var newDate = new Date();
	var time = Math.floor(newDate.getTime() / 1000);
	var sig = this.encode(taskId, this.secret);
	DiscuzCloud.setCookie('dctips', this.sendTime, 86400 * 30);
	var url = 'http://cp.discuz.qq.com/tips/mark?rand=' + Math.random();
	var callback = function() {};
	var params = {
		'id': taskId,
		'key': cacheKey,
		'is_founder': this.founder,
		'view_permission': viewPermission,
		'sig': sig
	};
	DiscuzCloud.JSONP.get(url, params, callback)
};
DiscuzCloud.Tips.prototype.encode = function(id, key) {
	var num = id % 8;
	if (num == 0) {
		num = 8
	};
	return key.substr(num) + key.substr(0, num)
};
DiscuzCloud.Tips.prototype.open = function() {
	this.discuzTips.style.display = '';
};
DiscuzCloud.Tips.prototype.close = function(taskId, cacheKey, viewPermission, passive) {
	clearTimeout(clearTips);
	this.discuzTips.style.display = 'none';
	if (typeof(taskId) == 'undefined') {
		taskId = 0
	};
	this.markAsRead(taskId, cacheKey, viewPermission);
	if (typeof(passive) != 'undefined' && passive == true) {
		this.stats('passiveClose', taskId, cacheKey)
	} else {
		this.stats('close', taskId, cacheKey)
	}
};
DiscuzCloud.Tips.prototype.stats = function(action, taskId, cacheKey) {
	var statsUrl = 'http://cp.discuz.qq.com/tips/stats?rand=' + Math.random();
	var sig = this.encode(taskId, this.secret);
	var params = {
		'action': action,
		'tt_id': taskId,
		'sig': sig,
		'cache_key': cacheKey
	};
	var callback = function() {};
	DiscuzCloud.JSONP.get(statsUrl, params, callback)
};
DiscuzCloud.Tips.prototype.analysis = function(html) {
	tipsId = parseInt(this.tipsId);
	sId = parseInt(this.sId);
	sUrl = DiscuzCloud.htmlspecialchars(this.sUrl);
	sVersion = DiscuzCloud.htmlspecialchars(this.version);
	sCharset = DiscuzCloud.htmlspecialchars(this.sCharset);
	tempUrl = this.sUrl.split('//');
	tempUrl = tempUrl[1].split('/');
	sDomain = DiscuzCloud.htmlspecialchars(tempUrl[0]);
	tempUrl = tempUrl[0].split('.');
	tempUrl.shift();
	sMasterDomain = DiscuzCloud.htmlspecialchars(tempUrl.join('.'));
	html = html.replace(/#TipsID#/, tipsId);
	html = html.replace(/#SId#/, sId);
	html = html.replace(/#SiteUrl#/, sUrl);
	html = html.replace(/#SiteVersion#/, sVersion);
	html = html.replace(/#SiteCharset#/, sCharset);
	html = html.replace(/#SiteDomain#/, sDomain);
	html = html.replace(/#SiteMasterDomain#/, sMasterDomain);
	return html
};
if (typeof(tipsinfo) != 'undefined') {
	var tipsArr = tipsinfo.split("|");
	var discuzSId = tipsArr[0];
	var discuzVersion = tipsArr[1];
	var discuzApi = tipsArr[2];
	var discuzIsFounder = tipsArr[3];
	var discuzAdminId = tipsArr[4];
	var discuzOpenId = tipsArr[5];
	var discuzUid = tipsArr[6];
	var discuzGroupId = tipsArr[7];
	var ts = tipsArr[8];
	var sig = tipsArr[9];
	var discuzTipsCVersion = tipsArr[10];
	var discuzRelease = '';
	var discuzFixbug = ''
};
window.onload = function(e) {
	if (typeof(discuzTipsCVersion) == 'undefined') {
		discuzTipsCVersion = '0'
	};
	if (discuzTipsCVersion == '2') {
		tips = new DiscuzCloud.Tips(discuzSId, discuzVersion, discuzRelease, discuzApi, discuzIsFounder, discuzFixbug, SITEURL, charset, ts, sig, discuzAdminId, discuzGroupId, discuzUid, discuzOpenId)
	} else {
		tips = new DiscuzCloud.Tips(discuzSId, discuzVersion, discuzRelease, discuzApi, discuzIsFounder, discuzFixbug, SITEURL, charset, ts, sig)
	};
	tips.show()
}