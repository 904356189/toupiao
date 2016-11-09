(function() {
	"use strict";
	var y = function() {
		var n = /\-([a-z])/g,
		t = function(n, t) {
			return t.toUpperCase()
		};
		return function(i) {
			return i.replace(n, t)
		}
	} (),
	e = function(n, t) {
		var i, u, e, f, r, o;
		if (window.getComputedStyle ? i = window.getComputedStyle(n, null).getPropertyValue(t) : (u = y(t), i = n.currentStyle ? n.currentStyle[u] : n.style[u]), t === "cursor" && (!i || i === "auto")) for (e = n.tagName.toLowerCase(), f = ["a"], r = 0, o = f.length; r < o; r++) if (e === f[r]) return "pointer";
		return i
	},
	o = function(t) {
		if (n.prototype._singleton) {
			t || (t = window.event);
			var i;
			this !== window ? i = this: t.target ? i = t.target: t.srcElement && (i = t.srcElement),
			n.prototype._singleton.setCurrent(i)
		}
	},
	p = function(n, t, i) {
		n.addEventListener ? n.addEventListener(t, i, !1) : n.attachEvent && n.attachEvent("on" + t, i)
	},
	w = function(n, t, i) {
		n.removeEventListener ? n.removeEventListener(t, i, !1) : n.detachEvent && n.detachEvent("on" + t, i)
	},
	s = function(n, t) {
		var r, f, u, i, e;
		if (n.addClass) return n.addClass(t),
		n;
		if (t && typeof t == "string" && (r = (t || "").split(/\s+/), n.nodeType === 1)) if (n.className) {
			for (f = " " + n.className + " ", u = n.className, i = 0, e = r.length; i < e; i++) f.indexOf(" " + r[i] + " ") < 0 && (u += " " + r[i]);
			n.className = u.replace(/^\s+|\s+$/g, "")
		} else n.className = t;
		return n
	},
	u = function(n, t) {
		var u, i, r, f;
		if (n.removeClass) return n.removeClass(t),
		n;
		if ((t && typeof t == "string" || t === undefined) && (u = (t || "").split(/\s+/), n.nodeType === 1 && n.className)) if (t) {
			for (i = (" " + n.className + " ").replace(/[\n\t]/g, " "), r = 0, f = u.length; r < f; r++) i = i.replace(" " + u[r] + " ", " ");
			n.className = i.replace(/^\s+|\s+$/g, "")
		} else n.className = "";
		return n
	},
	b = function() {
		var n, t, i, r = 1;
		return typeof document.body.getBoundingClientRect == "function" && (n = document.body.getBoundingClientRect(), t = n.right - n.left, i = document.body.offsetWidth, r = Math.round(t / i * 100) / 100),
		r
	},
	k = function(n) {
		var i = {
			left: 0,
			top: 0,
			width: 0,
			height: 0,
			zIndex: 999999999
		},
		r = e(n, "z-index"),
		t,
		u,
		f,
		o,
		s,
		h;
		return r && r !== "auto" && (i.zIndex = parseInt(r, 10)),
		n.getBoundingClientRect && (t = n.getBoundingClientRect(), "pageXOffset" in window && "pageYOffset" in window ? (u = window.pageXOffset, f = window.pageYOffset) : (o = b(), u = Math.round(document.documentElement.scrollLeft / o), f = Math.round(document.documentElement.scrollTop / o)), s = document.documentElement.clientLeft || 0, h = document.documentElement.clientTop || 0, i.left = t.left + u - s, i.top = t.top + f - h, i.width = "width" in t ? t.width: t.right - t.left, i.height = "height" in t ? t.height: t.bottom - t.top),
		i
	},
	h = function(n, t) {
		var i = !(t && t.useNoCache === !1);
		return i ? (n.indexOf("?") === -1 ? "?": "&") + "nocache=" + (new Date).getTime() : ""
	},
	d = function(n) {
		var i = [],
		t = [];
		return n.trustedOrigins && (typeof n.trustedOrigins == "string" ? t = t.push(n.trustedOrigins) : typeof n.trustedOrigins == "object" && "length" in n.trustedOrigins && (t = t.concat(n.trustedOrigins))),
		n.trustedDomains && (typeof n.trustedDomains == "string" ? t = t.push(n.trustedDomains) : typeof n.trustedDomains == "object" && "length" in n.trustedDomains && (t = t.concat(n.trustedDomains))),
		t.length && i.push("trustedOrigins=" + encodeURIComponent(t.join(","))),
		typeof n.amdModuleId == "string" && n.amdModuleId && i.push("amdModuleId=" + encodeURIComponent(n.amdModuleId)),
		typeof n.cjsModuleId == "string" && n.cjsModuleId && i.push("cjsModuleId=" + encodeURIComponent(n.cjsModuleId)),
		i.join("&")
	},
	c = function(n, t) {
		if (t.indexOf) return t.indexOf(n);
		for (var i = 0,
		r = t.length; i < r; i++) if (t[i] === n) return i;
		return - 1
	},
	l = function(n) {
		if (typeof n == "string") throw new TypeError("ZeroClipboard doesn't accept query strings.");
		return n.length ? n: [n]
	},
	g = function(n, t, i, r, u) {
		u ? window.setTimeout(function() {
			n.call(t, i, r)
		},
		0) : n.call(t, i, r)
	},
	n = function(t, i) {
		var u, f;
		if (t && (n.prototype._singleton || this).glue(t), n.prototype._singleton) return n.prototype._singleton;
		n.prototype._singleton = this,
		this.options = {};
		for (u in r) this.options[u] = r[u];
		for (f in i) this.options[f] = i[f];
		this.handlers = {},
		n.detectFlashSupport() && nt()
	},
	t,
	i = [],
	f,
	r;
	n.prototype.setCurrent = function(n) {
		var i, r;
		t = n,
		this.reposition(),
		i = n.getAttribute("title"),
		i && this.setTitle(i),
		r = this.options.forceHandCursor === !0 || e(n, "cursor") === "pointer",
		f.call(this, r)
	},
	n.prototype.setText = function(n) {
		n && n !== "" && (this.options.text = n, this.ready() && this.flashBridge.setText(n))
	},
	n.prototype.setTitle = function(n) {
		n && n !== "" && this.htmlBridge.setAttribute("title", n)
	},
	n.prototype.setSize = function(n, t) {
		this.ready() && this.flashBridge.setSize(n, t)
	},
	n.prototype.setHandCursor = function(n) {
		n = typeof n == "boolean" ? n: !!n,
		f.call(this, n),
		this.options.forceHandCursor = n
	},
	f = function(n) {
		this.ready() && this.flashBridge.setHandCursor(n)
	},
	n.version = "1.2.0-beta.4",
	r = {
		moviePath: "ZeroClipboard.swf",
		trustedOrigins: null,
		text: null,
		hoverClass: "zeroclipboard-is-hover",
		activeClass: "zeroclipboard-is-active",
		allowScriptAccess: "sameDomain",
		useNoCache: !0,
		forceHandCursor: !1
	},
	n.setDefaults = function(n) {
		for (var t in n) r[t] = n[t]
	},
	n.destroy = function() {
		n.prototype._singleton.unglue(i);
		var t = n.prototype._singleton.htmlBridge;
		t.parentNode.removeChild(t),
		delete n.prototype._singleton
	},
	n.detectFlashSupport = function() {
		var n = !1;
		if (typeof ActiveXObject == "function") try {
			new ActiveXObject("ShockwaveFlash.ShockwaveFlash") && (n = !0)
		} catch(t) {}
		return ! n && navigator.mimeTypes["application/x-shockwave-flash"] && (n = !0),
		n
	};
	var a = null,
	v = null,
	nt = function() {
		var i = n.prototype._singleton,
		t = document.getElementById("global-zeroclipboard-html-bridge"),
		r,
		u,
		f,
		e;
		if (!t) {
			r = {};
			for (u in i.options) r[u] = i.options[u];
			r.amdModuleId = a,
			r.cjsModuleId = v,
			f = d(r),
			e = '      <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" id="global-zeroclipboard-flash-bridge" width="100%" height="100%">         <param name="movie" value="' + i.options.moviePath + h(i.options.moviePath, i.options) + '"/>         <param name="allowScriptAccess" value="' + i.options.allowScriptAccess + '"/>         <param name="scale" value="exactfit"/>         <param name="loop" value="false"/>         <param name="menu" value="false"/>         <param name="quality" value="best" />         <param name="bgcolor" value="#ffffff"/>         <param name="wmode" value="transparent"/>         <param name="flashvars" value="' + f + '"/>         <embed src="' + i.options.moviePath + h(i.options.moviePath, i.options) + '"           loop="false" menu="false"           quality="best" bgcolor="#ffffff"           width="100%" height="100%"           name="global-zeroclipboard-flash-bridge"           allowScriptAccess="always"           allowFullScreen="false"           type="application/x-shockwave-flash"           wmode="transparent"           pluginspage="http://www.macromedia.com/go/getflashplayer"           flashvars="' + f + '"           scale="exactfit">         <\/embed>       <\/object>',
			t = document.createElement("div"),
			t.id = "global-zeroclipboard-html-bridge",
			t.setAttribute("class", "global-zeroclipboard-container"),
			t.setAttribute("data-clipboard-ready", !1),
			t.style.position = "absolute",
			t.style.left = "-9999px",
			t.style.top = "-9999px",
			t.style.width = "15px",
			t.style.height = "15px",
			t.style.zIndex = "9999",
			t.innerHTML = e,
			document.body.appendChild(t)
		}
		i.htmlBridge = t,
		i.flashBridge = document["global-zeroclipboard-flash-bridge"] || t.children[0].lastElementChild
	};
	n.prototype.resetBridge = function() {
		this.htmlBridge.style.left = "-9999px",
		this.htmlBridge.style.top = "-9999px",
		this.htmlBridge.removeAttribute("title"),
		this.htmlBridge.removeAttribute("data-clipboard-text"),
		u(t, this.options.activeClass),
		t = null,
		this.options.text = null
	},
	n.prototype.ready = function() {
		var n = this.htmlBridge.getAttribute("data-clipboard-ready");
		return n === "true" || n === !0
	},
	n.prototype.reposition = function() {
		if (!t) return ! 1;
		var n = k(t);
		this.htmlBridge.style.top = n.top + "px",
		this.htmlBridge.style.left = n.left + "px",
		this.htmlBridge.style.width = n.width + "px",
		this.htmlBridge.style.height = n.height + "px",
		this.htmlBridge.style.zIndex = n.zIndex + 1,
		this.setSize(n.width, n.height)
	},
	n.dispatch = function(t, i) {
		n.prototype._singleton.receiveEvent(t, i)
	},
	n.prototype.on = function(t, i) {
		for (var u = t.toString().split(/\s/g), r = 0; r < u.length; r++) t = u[r].toLowerCase().replace(/^on/, ""),
		this.handlers[t] || (this.handlers[t] = i);
		this.handlers.noflash && !n.detectFlashSupport() && this.receiveEvent("onNoFlash", null)
	},
	n.prototype.addEventListener = n.prototype.on,
	n.prototype.off = function(n, t) {
		for (var u = n.toString().split(/\s/g), r, i = 0; i < u.length; i++) {
			n = u[i].toLowerCase().replace(/^on/, "");
			for (r in this.handlers) r === n && this.handlers[r] === t && delete this.handlers[r]
		}
	},
	n.prototype.removeEventListener = n.prototype.off,
	n.prototype.receiveEvent = function(n, i) {
		var r, o, h, e, c, l, f;
		n = n.toString().toLowerCase().replace(/^on/, ""),
		r = t,
		o = !0;
		switch (n) {
		case "load":
			if (i && parseFloat(i.flashVersion.replace(",", ".").replace(/[^0-9\.]/gi, "")) < 10) {
				this.receiveEvent("onWrongFlash", {
					flashVersion: i.flashVersion
				});
				return
			}
			this.htmlBridge.setAttribute("data-clipboard-ready", !0);
			break;
		case "mouseover":
			s(r, this.options.hoverClass);
			break;
		case "mouseout":
			u(r, this.options.hoverClass),
			this.resetBridge();
			break;
		case "mousedown":
			s(r, this.options.activeClass);
			break;
		case "mouseup":
			u(r, this.options.activeClass);
			break;
		case "datarequested":
			h = r.getAttribute("data-clipboard-target"),
			e = h ? document.getElementById(h) : null,
			e ? (c = e.value || e.textContent || e.innerText, c && this.setText(c)) : (l = r.getAttribute("data-clipboard-text"), l && this.setText(l)),
			o = !1;
			break;
		case "complete":
			this.options.text = null,
			this.options.button = r
		}
		this.handlers[n] && (f = this.handlers[n], typeof f == "string" && typeof window[f] == "function" && (f = window[f]), typeof f == "function" && g(f, r, this, i, o))
	},
	n.prototype.glue = function(n) {
		n = l(n);
		for (var t = 0; t < n.length; t++) c(n[t], i) == -1 && (i.push(n[t]), p(n[t], "mouseover", o))
	},
	n.prototype.unglue = function(n) {
		var t, r;
		for (n = l(n), t = 0; t < n.length; t++) w(n[t], "mouseover", o),
		r = c(n[t], i),
		r != -1 && i.splice(r, 1)
	},
	typeof define == "function" && define.amd ? define(["require", "exports", "module"],
	function(t, i, r) {
		return a = r && r.id || null,
		n
	}) : typeof module != "undefined" && module ? (v = module.id || null, module.exports = n) : window.ZeroClipboard = n
})();