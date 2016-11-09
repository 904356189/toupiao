var _appVersion = 1;
var _ua = navigator.userAgent,
_touchSupport = ("createTouch" in document),
_hashSupport = !!("onhashchange" in window),
_clkEvtType = _touchSupport ? "touchstart": "click",
_movestartEvt = _touchSupport ? "touchstart": "mousedown",
_moveEvt = _touchSupport ? "touchmove": "mousemove",
_moveendEvt = _touchSupport ? "touchend": "mouseup",
_isIOS = (_ua.match(/iPhone|iPad|iPod/i) ? true: false),
_isMeizu = /M030|M031|M032|MEIZU/.test(navigator.userAgent),
_isOldIOS = /OS\s[1-4]_[0-4]/.test(_ua),
_isAndroid = (/Android\s/.test(_ua) || _isMeizu),
_isOldAndroid22 = /Android\s[1-2]\.[0-2]/.test(_ua),
_isOldAndroid23 = /Android\s[1-2]\.[0-3]/.test(_ua),
_vendor = (/webkit/i).test(navigator.appVersion) ? "webkit": (/firefox/i).test(navigator.userAgent) ? "Moz": "opera" in window ? "O": (/MSIE/i).test(navigator.userAgent) ? "ms": "",
_has3d = "WebKitCSSMatrix" in window && "m11" in new WebKitCSSMatrix(),
_trnOpen = "translate" + (_has3d ? "3d(": "("),
_trnClose = _has3d ? ",0)": ")",
_needHistory = (_isIOS && !!(window.history && window.history.pushState)),
_appCache = window.applicationCache,
_q = function(a) {
	return document.querySelector(a)
},
_qAll = function(a) {
	return document.querySelectorAll(a)
};
function _checkOffline() {
	var a = !!_appCache;
	if (!a) {
		return
	}
	_appCache.addEventListener("progress",
	function(c) {
		try {
			_appCache.swapCache()
		} catch(b) {}
	});
	_appCache.addEventListener("updateready",
	function(c) {
		if (_appCache.status == _appCache.UPDATEREADY) {
			try {
				_appCache.swapCache()
			} catch(b) {}
			location.href = location.origin + location.pathname + "?rnd=" + Math.random() + location.hash
		}
	},
	false)
}
_checkOffline();
function _removeClass(d, c) {
	var b = new RegExp("(^|\\s)+(" + c + ")(\\s|$)+", "g");
	try {
		d.className = d.className.replace(b, "$1$3")
	} catch(a) {}
	b = null
}
function _addClass(b, a) {
	_removeClass(b, a);
	b.className = b.className + " " + a
}
function _forEach(a, b) {
	Array.prototype.forEach.call(a, b)
}
function _show() {
	var d = 0,
	b = arguments.length,
	e;
	for (; d < b; d++) {
		e = arguments[d];
		if (e.nodeType != undefined && e.nodeType == 1) {
			e.style.display = ""
		} else {
			if (e.hasOwnProperty("length")) {
				try {
					var a = [];
					_forEach(e,
					function(i, g, j) {
						a.push(i)
					});
					_show.apply(null, a)
				} catch(c) {}
			}
		}
	}
}
function _hide() {
	var d = 0,
	b = arguments.length,
	e;
	for (; d < b; d++) {
		e = arguments[d];
		if (e && e.nodeType != undefined && e.nodeType == 1) {
			e.style.display = "none"
		} else {
			if (e && e.hasOwnProperty("length")) {
				try {
					var a = [];
					_forEach(e,
					function(i, g, j) {
						a.push(i)
					});
					_hide.apply(null, a)
				} catch(c) {}
			}
		}
	}
}
function _isImageOk(a) {
	if (!a.complete) {
		return false
	}
	if (typeof a.naturalWidth != "undefined" && a.naturalWidth == 0) {
		return false
	}
	return true
}
function _registImgLoad(a, b) {
	if (_isImageOk(a)) {
		b.call(null)
	} else {
		a.addEventListener("load", b);
		a.src = a.src
	}
}
function _alterImgSize(d, j) {
	try {
		var k = j.width,
		e = j.height,
		c = d.width,
		l = d.height,
		b = 1,
		a = function(p, o, m, n) {
			if (o <= 1) {
				return
			}
			p.style.width = i(m) + "px";
			p.style.height = i(n) + "px"
		},
		i = function(m) {
			return Math.round(m)
		};
		b = c / k;
		a(d, b, c / b, l / b);
		b = l / e;
		a(d, b, c / b, l / b)
	} catch(g) {}
}
var MCache = (function() {
	var a = {};
	return {
		set: function(b, c) {
			a[b] = c
		},
		get: function(b) {
			return a[b]
		},
		clear: function() {
			a = {}
		},
		remove: function(b) {
			delete a[b]
		}
	}
} ());
var MStorage = (function() {
	var g = window.sessionStorage,
	i = window.localStorage,
	d = function(j) {
		if (j in g) {
			return JSON.parse(g[j])
		} else {
			if (j in i) {
				return JSON.parse(i[j])
			} else {
				return null
			}
		}
	},
	a = function(l, j) {
		j = JSON.stringify(j);
		g[l] = j;
		i[l] = j
	},
	c = function(j) {
		g.removeItem(j);
		i.removeItem(j)
	},
	e = function() {
		g.clear();
		i.clear()
	},
	b = function(m) {
		var l, j, k = 0;
		for (; k < i.length; k++) {
			l = i.key(k);
			j = i.getItem(l);
			if (j.ts < ((new Date()) - m)) {
				i.removeItem(l)
			}
		}
	};
	return {
		get: d,
		set: a,
		remove: c,
		clear: e,
		checkExpires: b
	}
} ());
var MData = (function() {
	function c(d) {
		return d.replace(/([A-Z])/g, "-$1").toLowerCase()
	}
	function b(g, e, d) {
		g.setAttribute("data-" + c(e), d)
	}
	function a(g, e) {
		var d = g.getAttribute("data-" + c(e));
		return d || undefined
	}
	return function(i, e, d) {
		if (arguments.length > 2) {
			try {
				i.dataset[e] = d
			} catch(g) {
				b(i, e, d)
			}
		} else {
			try {
				return i.dataset[e]
			} catch(g) {
				return a(i, e)
			}
		}
	}
} ());
var MBrowser = (function() {
	var b = navigator.userAgent.toLowerCase();
	var a = {
		version: (b.match(/.+(?:rv|it|ra|ie)[\/: ]([\d.]+)/) || [0, "0"])[1],
		safari: /webkit/i.test(b) && !this.chrome,
		opera: /opera/i.test(b),
		firefox: /firefox/i.test(b),
		ie: /msie/i.test(b) && !/opera/.test(b),
		mozilla: /mozilla/i.test(b) && !/(compatible|webkit)/.test(b) && !this.chrome,
		chrome: /chrome/i.test(b) && /webkit/i.test(b) && /mozilla/i.test(b)
	};
	return a
} ());
var MURLHash = (function() {
	function c(j, l) {
		var g = encodeURIComponent,
		e, i = [];
		var m = l ? l: "&";
		for (e in j) {
			i.push(g(e) + "=" + g(j[e]))
		}
		return i.join(m)
	}
	function a(e, g) {
		var d = e.indexOf(g);
		return d == -1 ? [e, ""] : [e.substring(0, d), e.substring(d + 1)]
	}
	var b = function(d, n, k) {
		var l = d || window.location.href;
		var t = k || "&";
		var r = a(l, n || "#");
		var m = r[0];
		var q = r[1];
		this.map = {};
		this.sign = t;
		if (q) {
			var j = q.split(t);
			for (var g = 0; g < j.length; g++) {
				var p = j[g];
				var e = a(p, "=");
				this.map[e[0]] = e[1]
			}
		}
		this.size = function() {
			return this.keys().length
		};
		this.keys = function() {
			var o = [];
			for (var i in this.map) {
				if (i != "_hashfoo_") {
					o.push(i)
				}
			}
			return o
		};
		this.values = function() {
			var o = [];
			for (var i in this.map) {
				if (i != "_hashfoo_") {
					o.push(this.map[i])
				}
			}
			return o
		};
		this.put("_hashfoo_", Math.random())
	};
	b.prototype.get = function(d) {
		return this.map[d] || null
	};
	b.prototype.put = function(d, e) {
		this.map[d] = e
	};
	b.prototype.set = b.prototype.put;
	b.prototype.putAll = function(d) {
		if (typeof(d) == "object") {
			for (var e in d) {
				this.map[e] = d[e]
			}
		}
	};
	b.prototype.remove = function(e) {
		if (this.map[e]) {
			var d = {};
			for (var g in this.map) {
				if (g != e) {
					d[g] = this.map[g]
				}
			}
			this.map = d
		}
	};
	b.prototype.toString = function() {
		var e = {};
		for (var d in this.map) {
			if (d != "_hashfoo_") {
				e[d] = this.map[d]
			}
		}
		return c(e, "&")
	};
	b.prototype.clone = function() {
		return new b("foo#" + this.toString(), this.sign)
	};
	return b
} ());
function _upShowConfirm(b, j, l, g, e, d, k) {
	var a = document.createDocumentFragment(),
	i = document.createElement("div"),
	c = document.createElement("div");
	c.className = "modal";
	c.id = "modal_" + b;
	a.appendChild(c);
	i.className = "popup";
	i.id = b;
	i.innerHTML = '<div class="pinner"><a href="javascript:void(0)" class="pclose">┿</a><p class="title">' + j + '</p><p class="cont">' + l + '</p><a href="javascript:void(0)" class="cancel">' + (d || "取消") + '</a><a href="javascript:void(0)" class="ok">' + (g || "确定") + "</a></div>";
	a.appendChild(i);
	document.body.appendChild(a);
	if (_isOldAndroid22 || _isOldAndroid23 || _isOldIOS || _isMeizu) {
		c.style.position = "absolute";
		i.style.position = "absolute"
	}
	_q("#" + b + " .pclose").addEventListener("click", _upCloseConfirm);
	if (e) {
		_q("#" + b + " .ok").addEventListener("click", e)
	} else {
		_q("#" + b + " .ok").addEventListener("click", _upCloseConfirm)
	}
	if (k) {
		_q("#" + b + " .cancel").addEventListener("click", k)
	} else {
		_q("#" + b + " .cancel").addEventListener("click", _upCloseConfirm)
	}
}
function _upCloseConfirm(a) {
	var d, c;
	if (typeof a == "string") {
		d = "modal_" + a
	} else {
		d = a.target.parentNode.parentNode.id
	}
	try {
		document.body.removeChild(_q("#" + d));
		document.body.removeChild(_q("#modal_" + d))
	} catch(b) {}
}
function _fixFootBtnForOldIOS(d) {
	var g = _q(".footFix"),
	c = window.innerHeight,
	b = window.scrollY,
	a;
	if (g) {
		try {
			a = g.clientHeight;
			g.style.position = "absolute";
			g.style.top = b + c - a + "px"
		} catch(e) {}
	}
}
function _flipCard(b) {
	if (b.target.tagName && b.target.tagName.toLowerCase() == "a" && b.target.className == "autotel") {
		return
	}
	var a = _q(".card"),
	c = MData(a, "side");
	if (!c) {
		c = 1
	}
	if (c == 1) {
		_addClass(a, "flip")
	} else {
		_removeClass(a, "flip")
	}
	c *= -1;
	MData(a, "side", c)
}
var console = window.console || {
	log: function() {}
};
function _html5FixForOldEnv() {
	var a = "abbr,article,aside,audio,canvas,datalist,details,dialog,eventsource,figure,figcaption,footer,header,hgroup,mark,menu,meter,nav,output,progress,section,small,time,video";
	a.split(",").forEach(function(d, c, b) {
		document.createElement(d)
	});
	_writeCSS(a + "{display:block;}")
}
function _writeCSS(b) {
	var c = document.createElement("style");
	c.innerHTML = b;
	try {
		_q("head").appendChild(c)
	} catch(a) {}
}
_html5FixForOldEnv();
var WAPP = (function(k) {
	var o = null,
	i = [],
	e = false,
	q,
	d,
	n,
	b,
	a = {},
	r = "",
	s = {
		ajax: function(C, B, y) {
			if (e) {
				return
			}
			if (y == undefined) {
				y = true
			}
			var u = C.url,
			t = C.method,
			w = C.params,
			D = C.callback,
			x, A = [];
			if (k.ActiveXObject) {
				x = new ActiveXObject("Microsoft.XMLHTTP")
			} else {
				if (k.XMLHttpRequest) {
					x = new XMLHttpRequest()
				} else {
					return false
				}
			}
			x.onreadystatechange = function() {
				if (x.readyState == 4) {
					if (x.status == 200 || x.status == 0) {
						e = false;
						var E = JSON.parse(x.responseText);
						if (!E) {
							throw "[ajax] result error"
						}
						if (E.result.hasOwnProperty("appVersion") && E.result.appVersion * 1 !== _appVersion) {
							console.log("force reload, waiting for update");
							k.setTimeout(function() {
								try {
									_appCache.swapCache()
								} catch(G) {}
								location.href = location.origin + location.pathname + "?rnd=" + Math.random() + location.hash
							},
							6180);
							return
						}
						if (D) {
							D.call(C, E)
						}
						if (y) {
							if (E.hasOwnProperty("code")) {
								E.issuccess = (E.code * 1 == 0)
							}
							if (E.hasOwnProperty("result")) {
								for (var F in E.result) {
									E[F] = E.result[F]
								}
								E.result = null;
								if (E.hasOwnProperty("cardType")) {
									E.cardType = E.cardType * 1
								}
								if (E.hasOwnProperty("ismember")) {
									E.ismember = E.ismember * 1
								}
								if (!E.hasOwnProperty("alertWhenError")) {
									E.alertWhenError = 1
								}
								E.alertWhenError = E.alertWhenError * 1
							}
						}
						if (B) {
							B.call(null, E)
						}
						if (o.callback_loadingOff) {
							o.callback_loadingOff.call(null)
						}
					}
				}
			};
			if (!t) {
				t = "post"
			}
			t = t.toLowerCase();
			if (w) {
				for (var v in w) {
					A.push(v + "=" + w[v])
				}
			}
			A.push("majaxr=" + Math.random());
			A = A.join("&");
			if (!A.length) {
				A = null
			}
			if (t == "get" && A != null) {
				if (u.indexOf("?") > -1) {
					u += "&"
				} else {
					u += "?"
				}
				u += A;
				A = null
			}
			console.log("[ajax]: ", w, u, A);
			try {
				x.open(t, u, true);
				if (t == "post") {
					x.setRequestHeader("content-type", "application/x-www-form-urlencoded")
				}
				x.send(A);
				e = true;
				if (o.callback_loadingOn) {
					o.callback_loadingOn.call(null)
				}
			} catch(z) {
				throw "ajax fail";
				e = false;
				if (o.callback_loadingOff) {
					o.callback_loadingOff.call(null)
				}
			}
			return true
		},
		parseTmpl: function(A, x) {
			var z = A,
			C, D, y, w, v, B;
			C = new RegExp("{\\$\\$\\$([^$]+)\\$\\$\\$}", "g");
			v = z.match(C);
			if (v != null) {
				for (y = 0; y < v.length; y++) {
					B = v[y].replace(/^\{\${3}/, "").replace(/\${3}\}$/, "");
					if (p.hasOwnProperty(B)) {
						z = z.replace(v[y], p[B])
					} else {
						z = z.replace(v[y], "")
					}
				}
			}
			C = /\{\#{3}[^\#]+\#{3}\}/g;
			v = z.match(C);
			if (v != null) {
				for (y = 0; y < v.length; y++) {
					B = v[y].replace(/^\{\#{3}/, "").replace(/\#{3}\}$/, "");
					if (B.indexOf(".") > -1) {
						var u = B.split(".");
						D = x[u[0]];
						if (D !== undefined) {
							for (w = 1; w < u.length; w++) {
								if (D && D.hasOwnProperty(u[w])) {
									D = D[u[w]]
								} else {
									D = v[y]
								}
							}
						}
					} else {
						if (x.hasOwnProperty(B) && typeof x[B] === "string" && !x[B].length) {
							D = ""
						} else {
							D = x[B] || v[y]
						}
					}
					z = z.replace(v[y], D)
				}
			}
			return z
		},
		clearStage: function() {
			d.id = "";
			d.className = "";
			n.innerHTML = "";
			s.fixBtnHook(false);
			s.cardFlipHook(false);
			_forEach(i,
			function(v, u, t) {
				v.obj.removeEventListener(v.type, v.func)
			});
			i = [];
			if (o.callback_loadingOff) {
				o.callback_loadingOff.call(null)
			}
		},
		addToStage: function(t) {
			d.id = "";
			d.className = "";
			n.innerHTML = t;
			s.fixBtnHook(true);
			s.cardFlipHook(true)
		},
		listenEvt: function(v, t, u) {
			v.addEventListener(t, u);
			i.push({
				obj: v,
				type: t,
				func: u
			})
		},
		fixBtnHook: function(t) {
			if (_q("#footBtn") || _q(".footFix")) {
				if (t == undefined) {
					t = true
				}
				if (_isOldIOS || _isOldAndroid22 || _isMeizu) {
					if (_isOldAndroid22 || _isMeizu) {
						if (t) {
							q = k.setInterval(_fixFootBtnForOldIOS, 500)
						} else {
							k.clearInterval(q)
						}
					} else {
						if (t) {
							q = k.setTimeout(_fixFootBtnForOldIOS, 200);
							k.addEventListener("scroll", _fixFootBtnForOldIOS);
							k.addEventListener("resize", _fixFootBtnForOldIOS);
							k.addEventListener("touchmove", _fixFootBtnForOldIOS);
							k.addEventListener("touchend", _fixFootBtnForOldIOS)
						} else {
							k.clearTimeout(q);
							k.removeEventListener("scroll", _fixFootBtnForOldIOS);
							k.removeEventListener("resize", _fixFootBtnForOldIOS);
							k.removeEventListener("touchmove", _fixFootBtnForOldIOS);
							k.removeEventListener("touchend", _fixFootBtnForOldIOS)
						}
					}
				}
			}
		},
		cardFlipHook: function(u) {
			var t = _q(".card");
			if (!t) {
				return
			}
			if (u == undefined) {
				u = true
			}
			if (u) {
				if (_isOldAndroid23) {
					_addClass(t, "old")
				}
				t.addEventListener(_clkEvtType, _flipCard)
			} else {
				t.removeEventListener(_clkEvtType, _flipCard)
			}
		},
		drawCardReturnTag: function() {
			var v = _q("#card_ctn .backtag canvas"),
			t = v.getContext("2d"),
			u = MData(v, "bgcolor");
			v.width = 54;
			v.height = 30;
			t.lineJoin = "miter";
			t.lineCap = "butt";
			t.fillStyle = u;
			t.moveTo(2, 0);
			t.lineTo(54, 0);
			t.lineTo(54, 15);
			t.lineTo(27, 24);
			t.lineTo(2, 15);
			t.lineTo(2, 2);
			t.lineTo(0, 2);
			t.lineTo(2, 0);
			t.closePath();
			t.fill()
		},
		pageChg: function() {
			if (o.onPageChange) {
				o.onPageChange.call(null, r)
			}
			_q("body").scrollTop = 0
		},
		setCurrPage: function(t) {
			r = t;
			console.log("setCurrPage", t)
		},
		updateHash: function(w) {
			var v = new MURLHash("foo#"),
			u,
			t;
			for (t in w) {
				v.put(t, w[t])
			}
			u = v.toString();
			location.hash = u;
			console.log("updateHash", u)
		},
		directJumpInIOSWeixin: function(y) {
			var x = location.href.replace(/#.*$/, "").replace(/\??ioswx\=[\d|\.]+/, ""),
			v = "&",
			t = [];
			if (x.indexOf("?") == -1) {
				v = "?"
			}
			for (var w in y) {
				t.push(w + "=" + y[w])
			}
			x = x + v + "ioswx=" + Math.random() + "#" + t.join("&");
			x = x.replace(/\?+/, "?").replace(/\&+/, "&").replace(/\#+/, "#");
			location.href = x;
			console.log("directJumpInIOSWeixin", x)
		},
		bindHashListener: function() {
			if (!_hashSupport) {
				k.addEventListener("hashchange", j.hashchgEvt)
			} else {
				if (!k.hasOwnProperty("_oldurlflag")) {
					k._oldurlflag = location.href
				}
				k.setInterval(function() {
					var t = location.href;
					if (t == k._oldurlflag) {
						return
					}
					console.log("fake hash", t);
					j.hashchgEvt.call(null, {
						newURL: t,
						oldURL: k._oldurlflag
					});
					k._oldurlflag = t
				},
				500)
			}
		},
		unbindHashListener: function() {
			k.removeEventListener("hashchange", j.hashchgEvt)
		},
		parseRoundUL: function() {
			var t = _qAll("ul.round");
			if (!t.length) {
				return
			}
			_forEach(t,
			function(x, v, u) {
				var w = x.getElementsByTagName("li");
				_forEach(w,
				function(y, A, z) {
					if (w.length == 1) {
						_addClass(y, "only")
					} else {
						if (A == 0) {
							_addClass(y, "first")
						} else {
							if (A == w.length - 1) {
								_addClass(y, "last")
							}
						}
					}
				})
			})
		},
		confirmTel: function() {
			var u = _qAll(".autotel");
			if (!u.length) {
				return
			}
			function t(w) {
				w.preventDefault();
				var v = w.currentTarget;
				if (k.confirm("是否拨打 " + MData(v, "telnum").replace("tel:", "") + " ?")) {
					location.href = MData(v, "telnum")
				}
			}
			_forEach(u,
			function(x, w, v) {
				MData(x, "telnum", x.href);
				x.href = "javascript:void(0)";
				s.listenEvt(x, "click", t)
			})
		}
	},
	j = {
		hashchgEvt: function(v) {
			var w = new MURLHash(v.newURL),
			u = new MURLHash(v.oldURL),
			t = w.get("act") * 1,
			x = u.get("act") * 1;
			console.log("hashchange", "from " + x + " to " + t);
			l.RouteCommand()
		},
		commonAjaxClick: function(w) {
			var x = w.currentTarget,
			t = {
				act: MData(x, "ajaxAct")
			},
			v,
			u;
			if (MData(x, "ajaxParams")) {
				v = MData(x, "ajaxParams");
				v = JSON.parse(v);
				for (u in v) {
					t[u] = v[u]
				}
			}
			if (_isIOS) {
				s.directJumpInIOSWeixin(t)
			} else {
				s.updateHash(t)
			}
		}
	},
	c = {
		ReqObject: function(u, x, v, w, t) {
			this.url = u;
			this.method = x;
			this.params = v;
			this.callback = w;
			this.set = function(z, y) {
				if (!t || (t && !this.params.hasOwnProperty(z))) {
					this.params[z] = y
				}
			}
		}
	},
	p = {
		flipcardTmpl: ' <div class="card"><div class="front"><figure class="fg" style="background-image:url({###cardfrontimg###});"> <img src="{###cardlogoimg###}" /><img data-src="{###barcodeimg###}" style="display:none;" /><figcaption class="fc"> <span class="cname" style="color:{###cardcolor0###};">{###cardname###}</span> <span class="t" style="color:{###cardcolor1###};text-shadow:{###cardshadow1###} 0 -1px;">{###shopname###}</span><span class="n" style="display:none;color:{###cardcolor2###};text-shadow:{###cardshadow2###} 0 -1px;">{###shopnum###}</span> </figcaption> </figure> </div> <div class="back"> <figure class="fg" style="background-image:url({###cardbackimg###});"><div class="backtag"><canvas data-bgcolor="{###cardreturnbg###}"></canvas><p style="color:{###cardreturnclr###}">{###cardreturntxt###}</p></div><div class="info"> <p class="addr">{###shopaddr###}</p> <p class="tel"><a class="autotel" href="tel:{###shoptel###}">{###shoptel###}</a></p> </div> <p class="keywords">{###keywords###}</p> </figure></div></div>',
		memberCardTmpl: ['<section id="card_ctn"><div class="bk1"></div><div class="cont">', "{$$$flipcardTmpl$$$}", "</div></section>", '<div id="guest" style="display:none;"> <small><em>{###powerNotice###}</em></small> <ul class="round"> </ul><div class="footFix" id="footBtn"> <a href="javascript:void(0)">{###getcardBtn###}</a> </div> </div>  <div id="vip" style="display:none;"> <small><em>{###powerNotice###}</em></small> <ul class="round"> </ul> </div>'].join(""),
		shopCardTmpl: ['<section class="cc_shop" id="card_ctn"><div class="bk1"></div><div class="cont">', "{$$$flipcardTmpl$$$}", '<div class="vs1" style="display:none;"> <span class="c">{###cardcount###}</span><h1>{###desc1###}</h1> </div>  <div class="vs2" style="display:none;"> <h1>{###desc2###}</h1></div>', "</div></section>", '<div class="vs1" style="display:none;"> <ul id="shop_icons"> </ul>  <div class="footFix" id="footBtn"> ', '<a href="javascript:void(0)">{###getcardBtn###}</a> </div> </div>  <div class="vs2" id="shop_lst" style="display:none;"> </div>  <footer style="height:20px;"></footer>'].join(""),
		shopLstTmpl: '<h1>{###title###}</h1> <div class="lst"> <ul> </ul> </div>',
		powerIsOverTmpl: '<h1 id="poNotice">{###powerIsOver.notice###}</h1><a id="poBtn" href="{###powerIsOver.link###}"><span>{###powerIsOver.label###}</span></a>',
		powerTmpl: ['<header class="use_hd"> <div class="hinn box"> <div class="inner"> <img src="{###circlelogo###}" /> <h1>{###detail###}</h1>', ' <time datetime="{###datetime###}">{###datelabel###}{###datetime###}</time> </div> <a class="detail" style="display:none;" href="javascript:void(0)">{###detaillabel###}</a> </div>', '</header>  <aside class="use_note asd1 inner"></aside>  <aside class="use_note asd2 inner"> <b>{###phonelabel###}</b> <ul> <li><a class="autotel" href="tel:{###phonenum###}">{###phonenum###}</a></li> </ul> </aside>', '  <footer style="height:70px;"></footer> <div class="footFix" id="footBtn" style="display:none;"> <a href="javascript:void(0)">{###btnlabel###}</a> </div>', '<div class="footFix" id="pwr_footFrm" style="display:none;"> <div class="inner"> <input type="text" placeholder="{###reverseIptNote###}" /> <input type="submit" value="{###reverseBtnTxt###}" /> </div> </div>', '<div class="pw_xflip" id="use_code" style="display:none;"> <div class="back"><div class="ucodediv"><div class="cinn">', '<div class="vs1 cinner" style="display:none;"> <p>{###verifyNotice###}</p> <div class="cframe"><div class="cfl"></div> <div class="cfm">{###verifyTitle###}{###verifyCode###}</div><div class="cfr"></div></div></div>', '<div class="vs2 cinner" style="display:none;"> <p>{###revVerifyNotice###}</p> <div class="cframe"> <div class="cfl"></div> <div class="cfm">{###revVerifyTitle###}</div> <div class="cfr"></div></div></div>', "</div></div></div></div>", '<img id="pview" width="104" style="display:none;position:absolute;left:39px;" />'].join(""),
		errorTmpl: '<article class="inner"> <span class="t2"></span> <p class="t2">{###message###}</p> <a href="javascript:void(0)" class="err_sub">重新加载</a> </article>'
	},
	l = {
		RouteCommand: function(w) {
			b = w || (new MURLHash);
			var t = b.get("act"),
			v = null,
			u = 0;
			console.log("RouteCommand", b.get("act"));
			if (!t) {
				console.log("采用默认动作 act=PAGE_MEMBERCARD_1");
				t = WAPP.PAGE_MEMBERCARD_1
			}
			t = t + "";
			if (t.indexOf("PAGE_") > -1) {
				t = WAPP[t]
			} else {
				t = t * 1
			}
			switch (t) {
			case WAPP.PAGE_MEMBERCARD_1:
			case WAPP.PAGE_MEMBERCARD_2:
			case WAPP.PAGE_SHOPCARD_1:
			case WAPP.PAGE_SHOPCARD_2:
			default:
				v = o.ajax_getCard;
				u = 0;
				break;
			case WAPP.PAGE_POWER_1:
				v = o.ajax_getPower;
				u = 1;
				break
			}
			_forEach(b.keys(),
			function(z, y, x) {
				v.set(z, b.get(z))
			});
			s.ajax(v,
			function(x) {
				if (x.issuccess == 1) {
					if (u == 0) {
						l.PreCardCommand(x)
					}
					if (u == 1) {
						l.PowerDetailCommand(x)
					}
				} else {
					l.ErrorCommand(x)
				}
			})
		},
		PreCardCommand: function(t) {
			if (t.hasOwnProperty("isCrmShop") && t.isCrmShop) {
				return
			}
			if (t.hasOwnProperty("redirectUrl") && t.redirectUrl) {
				return k.location.href = t.redirectUrl
			}
			if (t.hasOwnProperty("cardType")) {
				MCache.set("carddata", t)
			}
			if (t.cardType == 0) {
				l.CardCommand(t)
			} else {
				if (t.cardType == 1) {
					l.CardCommand(t)
				}
			}
		},
		CheckPowerIsOverCommand: function(v, t) {
			if (!v.hasOwnProperty("powerIsOver")) {
				console.log("特权未结束");
				return false
			}
			console.log("特权已结束");
			var w = document.createElement("div");
			var u = p.powerIsOverTmpl;
			u = s.parseTmpl(u, v);
			w.innerHTML = u;
			n.appendChild(w);
			_hide.apply(null, t);
			_show(_q("#card_ctn .front .fc .n"));
			return true
		},
		CardCommand: function(U) {
			s.clearStage();
			var t = (U.cardType * 1 == 1),
			G = "";
			console.log(t ? "商家版": "普通版");
			G = t ? p.shopCardTmpl: p.memberCardTmpl;
			G = s.parseTmpl(G, U);
			s.addToStage(G);
			var S = _q("#card_ctn"),
			E = _qAll(".vs1"),
			C = _qAll(".vs2"),
			W = _q("#card_ctn .vs1 h1"),
			V = _q("#card_ctn .vs2 h1"),
			N = _q("#shop_icons"),
			z = _q("#shop_lst"),
			x = _q("#guest"),
			v = _q("#vip"),
			J = _q("#guest ul"),
			I = _q("#vip ul"),
			D = _q("#footBtn"),
			H = _q("#card_ctn .front .fc .n"),
			L = _q("#card_ctn .fg"),
			y = _q("#card_ctn .fg img:nth-child(2)");
			if (U.hasOwnProperty("cardreturnbg")) {
				s.drawCardReturnTag()
			}
			if (U.hasOwnProperty("isbarcode") && U.isbarcode * 1 == 1) {
				y.src = MData(y, "src");
				if (y) {
					_show(y)
				}
				_addClass(L, "barcode")
			} else {
				_removeClass(L, "barcode");
				if (y) {
					_hide(y)
				}
			}
			var F = t ? [_q("#" + n.id + ">.vs1"), _q("#" + n.id + ">.vs2"), _q("#" + n.id + ">footer")] : [x, v];
			if (l.CheckPowerIsOverCommand(U, F)) {
				F = null;
				return
			}
			if (!U.hasOwnProperty("desc2") && V) {
				_hide(V)
			}
			if (!t) {
				function B(X) {
					switch (X) {
					case 1:
						s.setCurrPage(WAPP.PAGE_MEMBERCARD_2);
						console.log("to WAPP.PAGE_MEMBERCARD_2", WAPP.PAGE_MEMBERCARD_2);
						_hide(x);
						_show(v, H);
						break;
					case 0:
					default:
						s.setCurrPage(WAPP.PAGE_MEMBERCARD_1);
						console.log("to WAPP.PAGE_MEMBERCARD_1", WAPP.PAGE_MEMBERCARD_1);
						_show(x);
						_hide(v, H);
						break
					}
					s.pageChg()
				}
				_forEach(U.list,
				function(aa, Y, X) {
					var Z = document.createElement("li");
					Z.innerHTML = "<b>" + aa.name + "</b>";
					J.appendChild(Z)
				});
				_forEach(U.list,
				function(ab, Y, X) {
					var Z = document.createElement("li"),
					aa = "<a";
					if (!ab.hasOwnProperty("link")) {
						MData(Z, "ajaxParams", JSON.stringify(ab.ajaxParams));
						MData(Z, "ajaxAct", WAPP.PAGE_POWER_1);
						s.listenEvt(Z, "click", j.commonAjaxClick)
					} else {
						aa += ' href="' + ab.link + '" data-link="1"'
					}
					aa += ">";
					aa += "<b>" + ab.name + "</b>";
					if (ab.hasOwnProperty("tag") && ab.tag) {
						aa += '<span class="tag t' + ab.tag + '"><img alt="' + ab.tagText + '" src="' + ab.tagImg + '" width="' + ab.tagImgWidth + '" /></span>'
					}
					aa += "</a>";
					Z.innerHTML = aa;
					I.appendChild(Z)
				});
				s.parseRoundUL();
				if (U.ismember == 0) {
					a.memberPageHandler = function(X) {
						if (X.issuccess) {
							H.innerHTML = X.shopnum;
							B(1)
						} else {
							alert(X.message)
						}
					};
					function R() {
						o.callback_becomeMember.call(null, U.becomeMemberCallbackParams)
					}
					s.listenEvt(D, "click", R)
				}
				k.setTimeout(function() {
					B(U.ismember)
				},
				0)
			} else {
				function T(X) {
					switch (X) {
					case 1:
						s.setCurrPage(WAPP.PAGE_SHOPCARD_2);
						console.log("to WAPP.PAGE_SHOPCARD_2");
						_hide(E);
						_show(C, H);
						M();
						S.className = "cc_shop2";
						break;
					case 0:
					default:
						s.setCurrPage(WAPP.PAGE_SHOPCARD_1);
						console.log("to WAPP.PAGE_SHOPCARD_1");
						_show(E);
						_hide(C, H);
						S.className = "cc_shop";
						break
					}
					s.pageChg()
				}
				if (U.hasOwnProperty("special_update")) {
					var A = "";
					_forEach(U.special_update,
					function(X) {
						if (X.hasOwnProperty("title")) {
							A += '<h1 class="updateTitle" style="background-image: url(&quot;' + X.title["bgURL"] + "&quot;); background-position: " + X.title["bgPosi"] + "; -webkit-background-size: " + X.title["bgSize"] + "; background-size: " + X.title["bgSize"] + '; background-repeat: no-repeat;">' + X.title["label"] + "</h1>"
						}
						A += '<ul class="round updateLst">';
						_forEach(X.list,
						function(Y) {
							if (!Y.hasOwnProperty("link")) {
								A += "<li>" + Y.name + "</li>"
							} else {
								A += '<li><a href="' + Y.link + '" target="_self">' + Y.name + "</a></li>"
							}
						});
						A += "</ul>"
					});
					z.insertAdjacentHTML("afterBegin", A)
				}
				if ("special_barcode" in U) {
					var w = U.special_barcode,
					Q = ['<div class="updateBarcode" style="background-image: url(&quot;' + w.bgURL + "&quot;);", "-webkit-background-size: ", w.bgSize, "; background-size: ", w.bgSize, ';">', '<img src="', w.img, '" />', "</div>"].join("");
					z.insertAdjacentHTML("afterBegin", Q)
				}
				if (U.hasOwnProperty("collection")) {
					function O(X) {
						var Y = U.collection[X],
						Z = document.createElement("li");
						Z.style.backgroundImage = "url(" + Y.bgURL + ")";
						Z.style.backgroundPosition = Y.bgPosi1;
						Z.style.webkitBackgroundSize = Y.bgSize1;
						Z.style.backgroundSize = Y.bgSize1;
						Z.style.backgroundRepeat = "no-repeat";
						Z.innerHTML = "<em>" + Y.list.length + "</em>" + Y["short"];
						N.appendChild(Z)
					}
					function u(ai) {
						var ae = U.collection[ai],
						ab = document.createElement("article"),
						ag = ae.list.length,
						Z = p.shopLstTmpl,
						ak = U.hasOwnProperty("showlistfull") && (U.showlistfull * 1 == 1);
						Z = s.parseTmpl(Z, ae);
						ab.className = "shoptype";
						ab.id = "type" + ai;
						ab.innerHTML = Z;
						z.appendChild(ab);
						var af = _q("#" + ab.id + " ul"),
						ac = _q("#" + ab.id + " .lst"),
						aj = _q("#" + ab.id + " h1");
						af.id = "lstname" + ai;
						aj.style.backgroundImage = "url(" + ae.bgURL + ")";
						aj.style.backgroundPosition = ae.bgPosi2;
						aj.style.webkitBackgroundSize = ae.bgSize2;
						aj.style.backgroundSize = ae.bgSize2;
						aj.style.backgroundRepeat = "no-repeat";
						for (var ad = 0; ad < ag; ad++) {
							var ah = document.createElement("li"),
							al = ae.list[ad],
							aa = "<a";
							if (!al.hasOwnProperty("link")) {
								MData(ah, "ajaxParams", JSON.stringify(al.ajaxParams));
								MData(ah, "ajaxAct", WAPP.PAGE_POWER_1);
								s.listenEvt(ah, "click", j.commonAjaxClick)
							} else {
								aa += ' href="' + al.link + '" data-link="1"'
							}
							aa += ">";
							aa += "<em>" + al.name + "</em>";
							if (al.hasOwnProperty("tag") && al.tag) {
								aa += '<span class="tag t' + al.tag + '"><img alt="' + al.tagText + '" src="' + al.tagImg + '" width="' + al.tagImgWidth + '" /></span>'
							}
							aa += "</a>";
							ah.innerHTML = aa;
							if (ad > 1) {
								ah.className = "r";
								if (!ak) {
									_hide(ah)
								}
							}
							af.appendChild(ah)
						}
						if (ag > 2) {
							var Y = document.createElement("a");
							Y.className = "turn on";
							Y.innerHTML = U.expandNotice.replace("_length_", ag);
							MData(Y, "scrollFlag", "lstname" + ai);
							ac.appendChild(Y);
							var X = document.createElement("a");
							X.className = "turn off";
							X.innerHTML = U.shrinkNotice;
							MData(X, "scrollFlag", "lstname" + ai);
							ac.appendChild(X);
							if (!ak) {
								_hide(X)
							} else {
								_hide(Y)
							}
						}
					}
					for (var P = 1; P <= U.collection.length; P++) {
						if (P <= U.collectionTopNum * 1) {
							O(P - 1)
						}
						u(P - 1)
					}
				}
				if (U.hasOwnProperty("descAjaxParams")) {
					function K(X) {
						X.innerHTML = '<a href="javascript:void(0)">' + X.innerHTML + "</a>";
						MData(X, "ajaxParams", JSON.stringify(U.descAjaxParams));
						MData(X, "ajaxAct", WAPP.PAGE_POWER_1);
						s.listenEvt(X, "click", j.commonAjaxClick)
					}
					K(W);
					K(V)
				}
				if (U.ismember == 0) {
					a.shopPageHandler = function(X) {
						if (X.issuccess) {
							H.innerHTML = X.shopnum;
							T(1)
						} else {
							alert(X.message)
						}
					};
					function R() {
						o.callback_becomeMember.call(null, U.becomeMemberCallbackParams)
					}
					s.listenEvt(D, "click", R)
				}
				function M() {
					_forEach(_qAll("article"),
					function(ag, ae, ac) {
						var aa = _q("#" + ag.id + " .turn.on"),
						af = _q("#" + ag.id + " .turn.off"),
						Y = _qAll("#" + ag.id + " li.r"),
						Z = function(ai) {
							var ah = MData(ai.currentTarget, "scrollFlag");
							_q("body").scrollTop = -(d.getClientRects()[0].top - _q("#" + ah).getClientRects()[0].top)
						},
						ab = function(ah) {
							Array.prototype.forEach.call(Y,
							function(ak, aj, ai) {
								ak.style.display = ah ? "": "none"
							})
						},
						X = function(ah) {
							ah.preventDefault();
							_hide(aa);
							_show(af);
							ab(true);
							Z(ah)
						},
						ad = function(ah) {
							ah.preventDefault();
							_show(aa);
							_hide(af);
							ab(false);
							Z(ah)
						};
						if (aa && !MData(aa, "clkbinded")) {
							s.listenEvt(aa, "click", X);
							MData(aa, "clkbinded", 1)
						}
						if (af && !MData(af, "clkbinded")) {
							s.listenEvt(af, "click", ad);
							MData(af, "clkbinded", 1)
						}
					})
				}
				k.setTimeout(function() {
					T(U.ismember)
				},
				0)
			}
			s.confirmTel()
		},
		PowerDetailCommand: function(A) {
			s.setCurrPage(WAPP.PAGE_POWER_1);
			s.clearStage();
			var v = p.powerTmpl;
			v = s.parseTmpl(v, A);
			s.addToStage(v);
			d.id = "powerPage";
			var x = _q("#footBtn");
			btn = _q("#footBtn a"),
			subdiv = _q("#pwr_footFrm"),
			chk = _q("#pwr_footFrm input[type=text]"),
			sub = _q("#pwr_footFrm input[type=submit]"),
			dtl = _q(".use_hd a.detail"),
			notice = _q(".asd1"),
			tel = _q(".asd2"),
			code = _q("#use_code"),
			cv1 = _q("#use_code .vs1"),
			cv2 = _q("#use_code .vs2"),
			h = _q(".use_hd"),
			f = _q("footer"),
			hdet = _q(".use_hd a.detail"),
			hinr = _q(".use_hd h1"),
			pv = _q("#pview");
			if (A.hasOwnProperty("notice")) {
				var w = document.createElement("b"),
				y = document.createElement("ul");
				notice.appendChild(w);
				notice.appendChild(y);
				w.innerHTML = A.notice["title"];
				_forEach(A.notice["list"],
				function(E, C, B) {
					var D = document.createElement("li");
					y.appendChild(D);
					D.innerHTML = E
				})
			}
			document.body.style.height = "500px";
			setTimeout(function() {
				document.body.style.height = "auto"
			},
			100);
			if (_isOldAndroid23) {
				_addClass(code, "old")
			}
			if (A.isReverse * 1) {
				_show(subdiv, cv2);
				_addClass(code, "rev");
				function z() {
					var C = o.ajax_reversePower;
					if (A.hasOwnProperty("ajaxParams")) {
						for (var B in A.ajaxParams) {
							C.set(B, A.ajaxParams[B])
						}
					}
					C.set("checkcode", chk.value);
					s.ajax(C,
					function(D) {
						if (D.issuccess == 1) {
							l.PowerUseCommand(D)
						} else {
							l.ErrorCommand(D)
						}
					})
				}
				s.listenEvt(sub, "click", z)
			} else {
				_show(x, cv1);
				function u(B) {
					_upCloseConfirm(B);
					var D = o.ajax_usePower;
					if (A.hasOwnProperty("ajaxParams")) {
						for (var C in A.ajaxParams) {
							D.set(C, A.ajaxParams[C])
						}
					}
					s.ajax(D,
					function(E) {
						if (E.issuccess == 1) {
							l.PowerUseCommand(E)
						} else {
							l.ErrorCommand(E)
						}
					})
				}
				function t(B) {
					if (_q("#modal_popup1")) {
						return
					}
					if (A.hasOwnProperty("confirm")) {
						_upShowConfirm("popup1", "提示", A.confirm, "使用", u, "取消", null)
					} else {
						u("popup1")
					}
				}
				s.listenEvt(btn, "click", t)
			}
			s.pageChg()
		},
		PowerUseCommand: function(w) {
			var u = _q("#footBtn");
			btn = _q("#footBtn a"),
			subdiv = _q("#pwr_footFrm"),
			sub = _q("#pwr_footFrm input[type=submit]"),
			dtl = _q(".use_hd a.detail"),
			notice = _q(".asd1"),
			tel = _q(".asd2"),
			code = _q("#use_code"),
			h = _q(".use_hd"),
			f = _q("footer"),
			hdet = _q(".use_hd a.detail"),
			hinr = _q(".use_hd h1"),
			pv = _q("#pview");
			pv.src = o.imgpath + "power_view.png";
			function x() {
				pv.style.top = "auto";
				pv.style.bottom = -d.scrollTop + "px"
			}
			function v() {
				s.setCurrPage(WAPP.PAGE_POWER_2);
				_hide(u, subdiv, notice, tel, f);
				_show(code, hdet, pv);
				_addClass(d, "s1");
				_addClass(h, "s1");
				setTimeout(function() {
					_addClass(code, "flip")
				},
				100);
				s.listenEvt(k, "scroll", x);
				s.pageChg()
			}
			code.innerHTML = s.parseTmpl(code.innerHTML, w);
			v();
			k.addEventListener("touchmove", x);
			k.addEventListener("touchend", x);
			if (hinr.clientHeight <= 60) {
				_hide(dtl)
			} else {
				hinr.style.height = "60px";
				if (!MData(dtl, "clkbinded")) {
					function t(y) {
						hinr.style.height = "auto";
						_hide(dtl);
						x()
					}
					s.listenEvt(dtl, "click", t);
					MData(dtl, "clkbinded", 1)
				}
			}
		},
		ErrorCommand: function(w) {
			if (w.alertWhenError) {
				alert(w.message);
				return
			}
			s.clearStage();
			var u = p.errorTmpl;
			u = s.parseTmpl(u, w);
			s.addToStage(u);
			d.id = "errPage";
			var v = _q(".err_sub");
			function t() {
				location.reload()
			}
			s.listenEvt(v, "click", t)
		}
	},
	m = function() {
		n = document.createElement("div");
		n.id = "mappContainer";
		d = _q("body");
		d.appendChild(n);
		b = new MURLHash();
		if (!b.toString().length) {
			location.hash = "act=1"
		}
		s.bindHashListener();
		l.RouteCommand()
	},
	g = {
		startup: m,
		modals: c,
		views: p,
		controllers: l
	};
	return {
		facade: g,
		utils: {
			ajax: s.ajax
		},
		config: function(t) {
			o = t
		},
		getConfigItem: function(t) {
			return o[t]
		},
		getCurrPage: function() {
			return r
		},
		getHandler: function(t) {
			return a[t]
		}
	}
} (window, undefined));
WAPP.PAGE_MEMBERCARD_1 = 1;
WAPP.PAGE_MEMBERCARD_2 = 2;
WAPP.PAGE_SHOPCARD_1 = 3;
WAPP.PAGE_SHOPCARD_2 = 4;
WAPP.PAGE_POWER_1 = 5;
WAPP.PAGE_POWER_2 = 6;
function _report(a, c) {
	var b = [a, c, qrcode, sid, user_wxid];
	ajax("/wsh/report?p=" + b.join(),
	function(d) {})
}
function ajax(url, func) {
	var request = false;
	request = new XMLHttpRequest();
	request.open("GET", url, true);
	request.onreadystatechange = function() {
		if (request.readyState == 4 && request.status == 200) {
			var response = eval("(" + request.responseText + ")");
			func(response)
		}
	};
	request.send(null)
}
function shareFriend() {
	WeixinJSBridge.invoke("sendAppMessage", {
		appid: window.shareData.appid,
		img_url: window.shareData.imgUrl,
		img_width: "640",
		img_height: "640",
		link: window.shareData.sendFriendLink,
		desc: window.shareData.tContent,
		title: window.shareData.tTitle
	},
	function(a) {
		_report("send_msg", a.err_msg)
	})
}
function shareTimeline() {
	WeixinJSBridge.invoke("shareTimeline", {
		img_url: window.shareData.imgUrl,
		img_width: "640",
		img_height: "640",
		link: window.shareData.timeLineLink,
		desc: window.shareData.tContent,
		title: window.shareData.tTitle
	},
	function(a) {
		_report("timeline", a.err_msg)
	})
}
function shareWeibo() {
	WeixinJSBridge.invoke("shareWeibo", {
		content: window.shareData.wContent,
		url: "http://meishi.qq.com/weixin",
	},
	function(a) {
		_report("weibo", a.err_msg)
	})
};