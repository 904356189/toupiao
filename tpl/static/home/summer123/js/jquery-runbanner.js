	 /*
      * jquery-runbanner
      * Copyright (c) 2013  Nicky Yan   个人网：站http://www.chinacoder.cn  QQ：525690001
      * Date: 2013-06-02
      * 使用jquery-runbanner可以很方便的实现响应式通栏banner,支持各种移动web
	 */
(function(c) {
	var a = ["rollIn", "fadeIn", "fadeInUp", "fadeInDown", "fadeInLeft", "fadeInRight", "fadeInRight", "bounceIn", "bounceInDown", "bounceInUp", "bounceInLeft", "bounceInRight", "rotateIn", "rotateInDownLeft", "rotateInDownRight", "rotateInUpLeft", "rotateInUpRight"];
	var b = a.length;
	c.fn.runbanner = function(h) {
		var A = {
			className: "oneByOne",
			sliderClassName: "oneByOne_item",
			easeType: "fadeInLeft",
			width: 960,
			height: 420,
			delay: 300,
			tolerance: 0.25,
			enableDrag: true,
			showArrow: true,
			showButton: true,
			slideShow: false,
			slideShowDelay: 3000
		};
		if (h) {
			c.extend(A, h)
		}
		var o;
		var v;
		var C = -1;
		var z = A.width;
		var f = A.height;
		var r = 0;
		var l = false;
		var D = false;
		var t = [];
		var x;
		var e = [];
		var n = 0;
		var w = 0,
		m, u, q;
		v = this;
		v.wrap('<div class="' + A.className + '"/>');
		o = v.parent();
		o.css("overflow", "hidden");
		v.find("." + A.sliderClassName).each(function(i) {
			c(this).hide();
			n++;
			c(this).css("left", z * i);
			e[i] = c(this)
		});
		v.bind("touchstart",
		function(i) {
			i.preventDefault();
			var E = i.originalEvent.touches[0] || i.originalEvent.changedTouches[0];
			if (!l) {
				l = true;
				this.mouseX = E.pageX
			}
			if (u) {
				u.fadeIn()
			}
			if (q) {
				q.fadeIn()
			}
			return false
		});
		v.bind("touchmove",
		function(i) {
			i.preventDefault();
			var E = i.originalEvent.touches[0] || i.originalEvent.changedTouches[0];
			if (l) {
				r = E.pageX - this.mouseX;
				v.css("left", -C * z + r);
				if (A.slideShow) {
					g()
				}
			}
			return false
		});
		v.bind("touchend",
		function(E) {
			var i = C;
			E.preventDefault();
			var H = E.originalEvent.touches[0] || E.originalEvent.changedTouches[0];
			l = false;
			if (!r) {
				return false
			}
			var F = parseInt(A.width);
			var G = F / 2;
			if ( - r > G - F * A.tolerance) {
				i++;
				i = i >= n ? n - 1 : i;
				s(i)
			} else {
				if (r > G - F * A.tolerance) {
					i--;
					i = i < 0 ? 0 : i;
					s(i)
				} else {
					s(i);
					if (A.slideShow) {
						d()
					}
				}
			}
			r = 0;
			if (u) {
				u.delay(400).fadeOut()
			}
			if (q) {
				q.delay(400).fadeOut()
			}
			return false
		});
		if (A.enableDrag) {
			v.mousedown(function(i) {
				if (!l) {
					l = true;
					this.mouseX = i.pageX
				}
				return false
			});
			v.mousemove(function(i) {
				if (l) {
					r = i.pageX - this.mouseX;
					v.css("left", -C * z + r);
					if (A.slideShow) {
						g()
					}
				}
				return false
			});
			v.mouseup(function(E) {
				l = false;
				var i = C;
				if (!r) {
					return false
				}
				var F = parseInt(A.width);
				var G = F / 2;
				if ( - r > G - F * A.tolerance) {
					i++;
					i = i >= n ? n - 1 : i;
					s(i)
				} else {
					if (r > G - F * A.tolerance) {
						i--;
						i = i < 0 ? 0 : i;
						s(i)
					} else {
						s(i);
						if (A.slideShow) {
							d()
						}
					}
				}
				r = 0;
				return false
			});
			v.mouseleave(function(i) {
				c(this).mouseup()
			})
		}
		o.mouseover(function(i) {
			if (u) {
				u.fadeIn()
			}
			if (q) {
				q.fadeIn()
			}
		});
		o.mouseleave(function(i) {
			if (u) {
				u.fadeOut()
			}
			if (q) {
				q.fadeOut()
			}
		});
		if (A.showButton) {
			m = c('<div class="buttonArea"><div class="buttonCon"></div></div>');
			o.append(m);
			u = m.find(".buttonCon");
			for (var y = 0; y < n; y++) {
				u.append('<a class="theButton" rel="' + y + '">' + (y + 1) + "</a>").css("cursor", "pointer")
			}
			c(".buttonCon a:eq(" + C + ")", m).addClass("active");
			c(".buttonCon a", m).bind("click",
			function(E) {
				if (c(this).hasClass("active")) {
					return false
				}
				var i = c(this).attr("rel");
				s(i)
			})
		}
		if (A.showArrow) {
			q = c('<div class="arrowButton"><div class="prevArrow"></div><div class="nextArrow"></div></div>');

			o.append(q);
			var k = c(".nextArrow", q).bind("click",
			function(i) {
				p()
			});
			var j = c(".prevArrow", q).bind("click",
			function(i) {
				B()
			})
		}
		if (u) {
			u.hide()
		}
		if (q) {
			q.hide()
		}
		s(0);
		if (A.slideShow) {
			slideShowInt = setInterval(function() {
				p()
			},
			A.slideShowDelay);
			v.data("interval", slideShowInt)
		}
		function s(i) {
			if (A.slideShow) {
				g()
			}
			v.stop(true, true).animate({
				left: -i * z
			},
			A.delay,
			function() {
				if (i != C) {
					w = C;
					if (e[w]) {
						if (! (c.browser.msie || c.browser.opera)) {
							e[w].fadeOut()
						}
						c(".buttonArea a:eq(" + w + ")", o).removeClass("active")
					}
					c(".buttonArea a:eq(" + i + ")", o).addClass("active");
					if (A.easeType.toLowerCase() != "random") {
						e[i].show().children().each(function(F) {
							if (c(this).hasClass(A.easeType)) {
								c(this).removeClass(A.easeType);
								c(this).hide()
							}
							var E = F;
							c(this).show().addClass("animate" + E + " " + A.easeType)
						})
					} else {
						x = a[Math.floor(Math.random() * b)];
						t[i] = x;
						if (e[w]) {
							e[w].children().each(function(E) {
								if (c(this).hasClass(t[w])) {
									c(this).removeClass(t[w]);
									c(this).hide()
								}
							})
						}
						e[i].show().children().each(function(F) {
							var E = F;
							c(this).show().addClass("animate" + E + " " + x)
						})
					}
					v.delay(e[i].children().length * 200).queue(function() {
						if (A.slideShow) {
							d()
						}
					});
					if (q) {
						q.css("cursor", "pointer")
					}
					C = i
				}
			})
		}
		function g() {
			clearInterval(v.data("interval"))
		}
		function d() {
			clearInterval(v.data("interval"));
			slideShowInt = setInterval(function() {
				p()
			},
			A.slideShowDelay);
			v.data("interval", slideShowInt)
		}
		function p() {
			var i = C;
			i++;
			i = i >= n ? 0 : i;
			s(i)
		}
		function B() {
			var i = C;
			i--;
			i = i < 0 ? n - 1 : i;
			s(i)
		}
		return this
	}
})(jQuery);