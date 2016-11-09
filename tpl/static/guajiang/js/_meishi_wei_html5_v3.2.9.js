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
	_appCache.addEventListener("updateready",
	function(b) {
		if (_appCache.status == _appCache.UPDATEREADY) {
			_appCache.swapCache();
			location.reload()
		}
	},
	false)
}
_checkOffline();
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
function _removeClass(c, b) {
	var a = new RegExp("(^|\\s)+(" + b + ")(\\s|$)+", "g");
	c.className = c.className.replace(a, "$1$3");
	a = null
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
					function(g, f, h) {
						a.push(g)
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
			if (e.hasOwnProperty("length")) {
				try {
					var a = [];
					_forEach(e,
					function(g, f, h) {
						a.push(g)
					});
					_hide.apply(null, a)
				} catch(c) {}
			}
		}
	}
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
	var f = window.sessionStorage,
	g = window.localStorage,
	d = function(h) {
		if (h in f) {
			return JSON.parse(f[h])
		} else {
			if (h in g) {
				return JSON.parse(g[h])
			} else {
				return null
			}
		}
	},
	a = function(i, h) {
		h = JSON.stringify(h);
		f[i] = h;
		g[i] = h
	},
	c = function(h) {
		f.removeItem(h);
		g.removeItem(h)
	},
	e = function() {
		f.clear();
		g.clear()
	},
	b = function(l) {
		var k, h, j = 0;
		for (; j < g.length; j++) {
			k = g.key(j);
			h = g.getItem(k);
			if (h.ts < ((new Date()) - l)) {
				g.removeItem(k)
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
	function b(f, e, d) {
		f.setAttribute("data-" + c(e), d)
	}
	function a(f, e) {
		var d = f.getAttribute("data-" + c(e));
		return d || undefined
	}
	return function(g, e, d) {
		if (arguments.length > 2) {
			try {
				g.dataset[e] = d
			} catch(f) {
				b(g, e, d)
			}
		} else {
			try {
				return g.dataset[e]
			} catch(f) {
				return a(g, e)
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
function _fixFootBtnForOldIOS(d) {
	var f = document.getElementById("footBtn") || _q(".footFix"),
	c = window.innerHeight,
	b = window.scrollY,
	a;
	if (f) {
		try {
			a = f.clientHeight;
			f.style.position = "absolute";
			f.style.top = b + c - a + "px"
		} catch(e) {}
	}
}
var console = window.console || {
	log: function() {}
};
function _mempageState(a) {
	var b = ["guest", "vip"];
	b.forEach(function(f, e, d) {
		document.getElementById(f).style.display = "none"
	});
	document.getElementById(b[a]).style.display = "";
	var c = _q(".card .front .fc .n");
	switch (a) {
	case 0:
		c.style.display = "none";
		break;
	case 1:
		c.style.display = "";
		break;
	default:
		break
	}
}
function _drawCardReturnTag() {
	var b = _q("#card_ctn .backtag canvas"),
	a = b.getContext("2d");
	b.width = 54;
	b.height = 22;
	a.fillStyle = b.dataset.bgcolor;
	a.moveTo(2, 0);
	a.lineTo(54, 0);
	a.lineTo(54, 15);
	a.lineTo(27, 22);
	a.lineTo(2, 15);
	a.lineTo(2, 2);
	a.lineTo(0, 2);
	a.lineTo(2, 0);
	a.closePath();
	a.fill()
}
function _shoppageState(a) {
	var b = document.getElementById("card_ctn"),
	d = _qAll(".vs1"),
	c = _qAll(".vs2");
	switch (a) {
	case 1:
		_forEach(d,
		function(g, f, e) {
			g.style.display = "none"
		});
		_forEach(c,
		function(g, f, e) {
			g.style.display = ""
		});
		_parseTurnLinks();
		b.className = "cc_shop2";
		break;
	case 0:
	default:
		_forEach(d,
		function(g, f, e) {
			g.style.display = ""
		});
		_forEach(c,
		function(g, f, e) {
			g.style.display = "none"
		});
		b.className = "cc_shop";
		break
	}
}
function _usepageState(i) {
	var h = _q("#footBtn"),
	g = _q("#pwr_footFrm"),
	f = _q(".asd1"),
	k = _q(".asd2"),
	l = _q("#use_code"),
	d = _q("#pview"),
	j = _q(".use_hd"),
	a = _q("footer"),
	b = _q(".use_hd a.detail"),
	c = _q(".use_hd h1"),
	e = document.body;
	switch (i) {
	case 1:
		if (h) {
			h.style.display = "none"
		}
		if (g) {
			g.style.display = "none"
		}
		f.style.display = "none";
		k.style.display = "none";
		a.style.display = "none";
		l.style.display = "";
		d.style.display = "";
		d.style.top = "auto";
		d.style.bottom = 0;
		b.style.display = "";
		c.style.height = "60px";
		_addClass(e, "s1");
		_addClass(j, "s1");
		setTimeout(function() {
			_addClass(l, "flip")
		},
		100);
		break;
	default:
	case 0:
		if (h) {
			h.style.display = ""
		}
		if (g) {
			g.style.display = ""
		}
		f.style.display = "";
		k.style.display = "";
		a.style.display = "";
		l.style.display = "none";
		d.style.display = "none";
		b.style.display = "none";
		c.style.height = "auto";
		_removeClass(e, "s1");
		_removeClass(j, "s1");
		_removeClass(l, "flip");
		break
	}
}
function _upShowConfirm(b, h, j, f, e, d, i) {
	var a = document.createDocumentFragment(),
	g = document.createElement("div"),
	c = document.createElement("div");
	c.className = "modal";
	c.id = "modal_" + b;
	a.appendChild(c);
	g.className = "popup";
	g.id = b;
	g.innerHTML = '<div class="pinner"><a href="javascript:void(0)" class="pclose">┿</a><p class="title">' + h + '</p><p class="cont">' + j + '</p><a href="javascript:void(0)" class="cancel">' + (d || "取消") + '</a><a href="javascript:void(0)" class="ok">' + (f || "确定") + "</a></div>";
	a.appendChild(g);
	document.body.appendChild(a);
	_q("#" + b + " .pclose").addEventListener(_clkEvtType, _upCloseConfirm);
	if (e) {
		_q("#" + b + " .ok").addEventListener(_clkEvtType, e)
	} else {
		_q("#" + b + " .ok").addEventListener(_clkEvtType, _upCloseConfirm)
	}
	if (i) {
		_q("#" + b + " .cancel").addEventListener(_clkEvtType, i)
	} else {
		_q("#" + b + " .cancel").addEventListener(_clkEvtType, _upCloseConfirm)
	}
}
function _upCloseConfirm(a) {
	var b = a.target.parentNode.parentNode.id;
	document.body.removeChild(document.getElementById(b));
	document.body.removeChild(document.getElementById("modal_" + b))
}
var Tween = {
	Linear: function(e, a, g, f) {
		return g * e / f + a
	},
	speed: 60,
	run: function(m, r, n, l, j, q, p) {
		var a = m.split("."),
		h = Tween,
		o,
		e = 0,
		g = a.length,
		k = arguments.callee;
		for (; e < g; e++) {
			h = h[a[e]]
		}
		o = h.call(null, r, n, l, j);
		q.call(null, o);
		if (r < j) {
			r++;
			setTimeout(function() {
				k(m, r, n, l, j, q, p)
			},
			this.speed)
		} else {
			if (p) {
				setTimeout(function() {
					p.call(null, o)
				},
				this.speed)
			}
		}
	}
};
function _parseSlider1() {
	var c = _qAll(".touchSlider");
	if (!c.length) {
		return
	}
	function b(e) {
		var g = document.createElement("canvas"),
		d = g.getContext("2d"),
		f = 4;
		g.width = f * 2;
		g.height = f * 2;
		d.fillStyle = e;
		d.beginPath();
		d.arc(f, f, f, Math.PI * 2, 0, true);
		d.closePath();
		d.fill();
		MData(g, "color", e);
		return g
	}
	function a() {
		return (new Date).getTime()
	}
	_forEach(c,
	function(t, v, d) {
		var A = t.querySelectorAll(".sld_page"),
		z = A.length,
		D = t.querySelector(".sld_bar"),
		h = t.querySelector(".sld_dots"),
		E = 0,
		r = D.parentNode.clientWidth,
		x = null,
		f = 5000,
		n = [],
		u = MData(t, "autoPlay") * 1,
		F = {
			time: 0,
			left: 0,
			top: 0,
			x: 0,
			y: 0,
			lx: 0,
			ly: 0
		},
		m = {
			left: 0
		},
		j = null,
		g = true,
		H = false;
		if (z < 2) {
			return
		}
		function J(K) {
			var i = K.changedTouches[0],
			L = K.currentTarget,
			w = L.parentNode.getClientRects()[0];
			return {
				x: i.pageX - w.left,
				y: i.pageY - w.top,
				px: i.pageX,
				py: i.pageY,
				cx: i.clientX,
				cy: i.clientY,
				sx: i.screenX,
				sy: i.screenY
			}
		}
		function o(w) {
			var i = MData(t, "dragCallback"),
			K = null;
			if (i && window.hasOwnProperty(i) && typeof window[i] === "function") {
				K = window[i];
				K.call(null, t, A[w], w)
			}
		}
		function q() {
			if (!u) {
				return
			}
			if (x !== null) {
				return
			}
			x = setInterval(function() {
				var w = D,
				i = E + 1;
				if (i >= z) {
					i = 0
				}
				if (g) {
					k(i, true)
				} else {
					e(w, i)
				}
				G(i);
				o(i)
			},
			f)
		}
		function l() {
			if (!u) {
				return
			}
			clearInterval(x);
			x = null
		}
		function G(i) {
			E = i;
			_forEach(n,
			function(K, w, L) {
				K.style.opacity = 0.4
			});
			if (n[i]) {
				n[i].style.opacity = 1
			}
		}
		function e(L, w) {
			var K = L.style.marginLeft.replace("px", "") * 1,
			i = 0,
			O = K,
			N = -w * r - K,
			M = 6.18 * 4;
			Tween.run("Linear", i, O, N, M,
			function(P) {
				var R = -w * r,
				Q = 2 * Tween.speed;
				if ((R == 0 && Math.abs(P) < Q) || (Math.abs(P % R) <= Q)) {
					P = R;
					P = parseInt(P) + "px";
					L.style.marginLeft = P;
					setTimeout(function() {
						D.style.marginLeft = P
					},
					2 * Tween.speed)
				} else {
					P = P + "px";
					L.style.marginLeft = P
				}
			},
			function(R) {
				var Q = L.style.marginLeft.replace("px", "") * 1,
				P = Math.round( - Q / r);
				if (P < 0) {
					P = 0
				}
				if (P >= z - 1) {
					P = z - 1
				}
				L.style.marginLeft = -P * r + "px"
			})
		}
		function k(K, i) {
			var L = i ? -K * r: K,
			w = i ? 6.18 * 4 * 0.01 : 0;
			D.style[_vendor + "TransitionDuration"] = w + "s";
			D.style[_vendor + "Transform"] = _trnOpen + L + "px,0" + _trnClose
		}
		function y(w) {
			if (!_touchSupport) {
				w.preventDefault()
			}
			var K = J(w),
			i = {
				x: g ? m.left * 1 : D.style.marginLeft.replace("px", "") * 1,
				y: D.getClientRects()[0].top
			};
			l();
			H = false;
			F = {
				time: a(),
				left: i.x,
				top: i.y,
				x: parseInt(i.x - K.x),
				y: parseInt(i.y - K.y),
				lx: w.changedTouches[0].clientX,
				ly: w.changedTouches[0].clientY,
				point: K
			};
			D.addEventListener("touchmove", C);
			D.addEventListener("touchend", I);
			D.addEventListener("touchcancel", I)
		}
		function C(O) {
			if (!_touchSupport) {
				O.preventDefault()
			}
			var N = J(O),
			P = O.currentTarget,
			M = F.x + N.x;
			var L, K, w = O.touches[0].pageX - F.point.px,
			i = O.touches[0].pageY - F.point.py;
			if (H === "y") {
				return
			} else {
				if (H === "x") {
					O.preventDefault()
				} else {
					L = Math.abs(w);
					K = Math.abs(i);
					if (L < 4) {
						return
					}
					if (K > L * 0.58) {
						H = "y";
						return
					} else {
						O.preventDefault();
						H = "x"
					}
				}
			}
			if (g) {
				k(M)
			} else {
				P.style.marginLeft = parseInt(M) + "px"
			}
			if (MData(P, "touching") === undefined || MData(P, "touching") * 1 != 1) {
				MData(P, "touching", 1)
			}
		}
		function I(L) {
			if (!_touchSupport) {
				L.preventDefault()
			}
			D.removeEventListener("touchmove", C);
			D.removeEventListener("touchend", I);
			D.removeEventListener("touchcancel", I);
			var M = L.currentTarget;
			MData(M, "touching", 0);
			if (g) {
				m.left = /\((\-?[\.\d]+)px/.exec(M.style[_vendor + "Transform"])[1]
			}
			var O = E,
			P = {
				x: g ? m.left * 1 : M.style.marginLeft.replace("px", "") * 1,
				y: M.getClientRects()[0].top
			},
			i = P.x,
			K = a() - F.time,
			Q = P.x - F.left,
			N = Math.abs(Q) < 5,
			w = K > 300;
			if (!w) {
				if (!N) {
					if (Q < 0) {
						O++
					} else {
						O--
					}
				}
			} else {
				O = Math.round( - i / r)
			}
			if (O < 0) {
				O = 0
			}
			if (O >= z - 1) {
				O = z - 1
			}
			if (g) {
				k(O, true)
			} else {
				e(M, O)
			}
			m.left = /\((\-?[\.\d]+)px/.exec(M.style[_vendor + "Transform"])[1];
			if (O != E) {
				o(O)
			}
			G(O);
			q()
		}
		var p = !!MData(h, "relativeLayout");
		if (p) {
			h.style.width = 13 * z + "px";
			h.style.marginLeft = 0.5 * (r - 13 * z) + "px"
		} else {
			h.style.marginLeft = 0.5 * (r - 13 * (z - 1)) + "px"
		}
		for (var B = 0; B < z; B++) {
			A[B].style.width = r + "px";
			if (MData(t, "minHeight")) {
				A[B].style.minHeight = MData(t, "minHeight") + "px"
			}
			var s = b(MData(t, "dotColor"));
			n[B] = s;
			if (h) {
				if (!p) {
					s.style.left = 13 * B + "px"
				}
				h.appendChild(s)
			} else {
				s.style.top = "0";
				s.style.left = (13 * B + 0.5 * (r - 13 * (z - 1))) + "px";
				D.parentNode.insertAdjacentElement("afterBegin", s)
			}
		}
		D.style.width = (z * r) + "px";
		D.addEventListener("touchstart", y);
		G(E);
		q()
	})
}
window.addEventListener("DOMContentLoaded",
function() {
	if (_q("#footBtn") || _q(".footFix")) {
		if (_isOldIOS || _isOldAndroid22 || _isMeizu) {
			if (_isOldAndroid22 || _isMeizu) {
				window._hook1TO = window.setInterval(_fixFootBtnForOldIOS, 500)
			} else {
				window._hook1TO = window.setTimeout(_fixFootBtnForOldIOS, 200);
				window.addEventListener("scroll", _fixFootBtnForOldIOS);
				window.addEventListener("resize", _fixFootBtnForOldIOS);
				window.addEventListener("touchmove", _fixFootBtnForOldIOS);
				window.addEventListener("touchend", _fixFootBtnForOldIOS)
			}
		}
	}
	var a = _q(".card");
	if (a) {
		if (_isOldAndroid23) {
			_addClass(a, "old")
		}
		var b = 1;
		a.addEventListener(_clkEvtType,
		function() {
			if (b == 1) {
				_addClass(a, "flip")
			} else {
				_removeClass(a, "flip")
			}
			b *= -1
		})
	}
	_parseSlider1()
});