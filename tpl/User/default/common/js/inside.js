var G = {
    ui: {},
    logic: {},
    util: {},
    domain: {
        t: 'iMicms.com',
	t: '',
        k: ''
    },
    set: {
        KindEditor_seting: {
            themeType: "simple",
            resizeType: 1,
            syncType: "",
            allowPreviewEmoticons: false,
            items: [
'source', 'undo', 'redo', 'plainpaste', 'plainpaste', 'wordpaste', 'clearhtml', 'quickformat', 'selectall', 'fullscreen', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline', 'hr',
'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
'insertunorderedlist', '|', 'emoticons', 'image', 'link', 'unlink', 'preview'],
            allowFileManager: true,
            height: "300px",
            width: 700,
            minWidth:610,
            afterCreate: function () {
                this.sync();
            },
            afterBlur: function () {
                this.sync();
            }
        },
        up_img_url: "/plus/upimg.php"
    }
};
(function (n) { var f = { buttons: { button1: { text: "OK", danger: !1, onclick: function () { n.fallr("hide") } } }, icon: "check", content: "操作成功", position: "top", closeKey: !0, closeOverlay: !1, useOverlay: !0, autoclose: !1, easingDuration: 300, easingIn: "swing", easingOut: "swing", height: "auto", width: "360px", zIndex: 100, bound: window, afterHide: function () { }, afterShow: function () { } }, t, e, i = n(window), u = { hide: function (f, o, s) { if (u.isActive()) { n("#fallr-wrapper").stop(!0, !0); var h = n("#fallr-wrapper"), a = h.css("position"), c = a === "fixed", l = 0; switch (t.position) { case "bottom": case "center": l = (c ? i.height() : h.offset().top + h.outerHeight()) + 10; break; default: l = (c ? -1 * h.outerHeight() : h.offset().top - h.outerHeight()) - 10 } h.animate({ top: l, opacity: c ? 1 : 0 }, t.easingDuration || t.duration, t.easingOut, function () { n.browser.msie ? n("#fallr-overlay").css("display", "none") : n("#fallr-overlay").fadeOut("fast"), h.remove(), clearTimeout(e), o = typeof o == "function" ? o : t.afterHide, o.call(s) }), n(document).unbind("keydown", r.enterKeyHandler).unbind("keydown", r.closeKeyHandler).unbind("keydown", r.tabKeyHandler) } }, resize: function (t, i, f) { var e = n("#fallr-wrapper"), o = parseInt(t.width, 10), s = parseInt(t.height, 10), h = Math.abs(e.outerWidth() - o), c = Math.abs(e.outerHeight() - s); u.isActive() && (h > 5 || c > 5) && (e.animate({ width: o }, function () { n(this).animate({ height: s }, function () { r.fixPos() }) }), n("#fallr").animate({ width: o - 94 }, function () { n(this).animate({ height: s - 116 }, function () { typeof i == "function" && i.call(f) }) })) }, show: function (o, s, h) { var a; if (u.isActive()) n("body", "html").animate({ scrollTop: n("#fallr").offset().top }, function () { n.fallr("shake") }), n.error("Can't create new message with content: \"" + o.content + '", past message with content "' + t.content + '" is still active'); else { t = n.extend({}, f, o), n('<div id="fallr-wrapper"><\/div>').appendTo("body"), t.bound = n(t.bound).length > 0 ? t.bound : window; var c = n("#fallr-wrapper"), v = n("#fallr-overlay"), l = t.bound === window; c.css({ width: t.width, height: t.height, position: "absolute", top: "-9999px", left: "-9999px" }).html('<div id="fallr-icon"><\/div><div id="fallr"><\/div><div id="fallr-buttons"><\/div>').find("#fallr-icon").addClass("icon-msg-" + t.icon).end().find("#fallr").html(t.content).css({ height: t.height == "auto" ? "auto" : c.height() - 116, width: c.width() - 94 }).end().find("#fallr-buttons").html(function () { var i = "", n; for (n in t.buttons) t.buttons.hasOwnProperty(n) && (i = i + '<a href="#" class="fallr-button ' + (t.buttons[n].danger ? "fallr-button-danger" : "") + '" id="fallr-button-' + n + '">' + t.buttons[n].text + "<\/a>"); return i }()).find(".fallr-button").bind("click", function () { var i = n(this).attr("id").substring(13), r; return typeof t.buttons[i].onclick == "function" && t.buttons[i].onclick != !1 ? (r = n("#fallr"), t.buttons[i].onclick.apply(r)) : u.hide(), !1 }), a = function () { c.show(); var y = l ? (i.width() - c.outerWidth()) / 2 + i.scrollLeft() : (n(t.bound).width() - c.outerWidth()) / 2 + n(t.bound).offset().left, r, f, a = i.height() > c.height() && i.width() > c.width() && l ? "fixed" : "absolute", o = a === "fixed"; switch (t.position) { case "bottom": r = l ? o ? i.height() : i.scrollTop() + i.height() : n(t.bound).offset().top + n(t.bound).outerHeight(), f = r - c.outerHeight(); break; case "center": r = l ? o ? -1 * c.outerHeight() : v.offset().top - c.outerHeight() : n(t.bound).offset().top + n(t.bound).height() / 2 - c.outerHeight(), f = r + c.outerHeight() + ((l ? i.height() : c.outerHeight() / 2) - c.outerHeight()) / 2; break; default: f = l ? o ? 0 : i.scrollTop() : n(t.bound).offset().top, r = f - c.outerHeight() } c.css({ left: y, position: a, top: r, "z-index": t.zIndex + 1 }).animate({ top: f }, t.easingDuration, t.easingIn, function () { s = typeof s == "function" ? s : t.afterShow, s.call(h), t.autoclose && (e = setTimeout(u.hide, t.autoclose)) }) }, t.useOverlay ? n.browser.msie && n.browser.version < 9 ? (v.css({ display: "block", "z-index": t.zIndex }), a()) : v.css({ "z-index": t.zIndex }).fadeIn(a) : a(), n(document).bind("keydown", r.enterKeyHandler).bind("keydown", r.closeKeyHandler).bind("keydown", r.tabKeyHandler), n("#fallr-buttons").children().eq(-1).bind("focus", function () { n(this).bind("keydown", r.tabKeyHandler) }), c.find(":input").bind("keydown", function (t) { r.unbindKeyHandler(), t.keyCode === 13 && n(".fallr-button").eq(0).trigger("click") }) } }, set: function (n, i, r) { for (var u in n) f.hasOwnProperty(u) && (f[u] = n[u], t && t[u] && (t[u] = n[u])); typeof i == "function" && i.call(r) }, isActive: function () { return !!(n("#fallr-wrapper").length > 0) }, blink: function () { n("#fallr-wrapper").fadeOut(100, function () { n(this).fadeIn(100) }) }, shake: function () { n("#fallr-wrapper").stop(!0, !0).animate({ left: "+=20px" }, 50, function () { n(this).animate({ left: "-=40px" }, 50, function () { n(this).animate({ left: "+=30px" }, 50, function () { n(this).animate({ left: "-=20px" }, 50, function () { n(this).animate({ left: "+=10px" }, 50) }) }) }) }) } }, r = { fixPos: function () { var r = n("#fallr-wrapper"), e = r.css("position"), f, u; if (i.width() > r.outerWidth() && i.height() > r.outerHeight()) { f = (i.width() - r.outerWidth()) / 2, u = i.height() - r.outerHeight(); switch (t.position) { case "center": u = u / 2; break; case "bottom": break; default: u = 0 } e == "fixed" ? r.animate({ left: f }, function () { n(this).animate({ top: u }) }) : r.css({ position: "fixed", left: f, top: u }) } else f = (i.width() - r.outerWidth()) / 2 + i.scrollLeft(), u = i.scrollTop(), e != "fixed" ? r.animate({ left: f }, function () { n(this).animate({ top: u }) }) : r.css({ position: "absolute", top: u, left: f > 0 ? f : 0 }) }, enterKeyHandler: function (t) { t.keyCode === 13 && (n("#fallr-buttons").children().eq(0).focus(), r.unbindKeyHandler()) }, tabKeyHandler: function (t) { t.keyCode === 9 && (n("#fallr-wrapper").find(":input, .fallr-button").eq(0).focus(), r.unbindKeyHandler(), t.preventDefault()) }, closeKeyHandler: function (n) { n.keyCode === 27 && t.closeKey && u.hide() }, unbindKeyHandler: function () { n(document).unbind("keydown", r.enterKeyHandler).unbind("keydown", r.tabKeyHandler) } }; n(document).ready(function () { n("body").append('<div id="fallr-overlay"><\/div>'), n("#fallr-overlay").bind("click", function () { t.closeOverlay ? u.hide() : u.blink() }) }), n(window).resize(function () { u.isActive() && t.bound === window && r.fixPos() }), n.fallr = function (t, i, r) { var f = window; typeof t == "object" && (i = t, t = "show"), u[t] ? (typeof i == "function" && (r = i, i = null), u[t](i, r, f)) : n.error('Method "' + t + '" does not exist in $.fallr') } })(jQuery)
$.extend($, {
    strlen: function (str) {
        if (typeof str != 'string') return 0;
        return str.replace(/[^\x00-\xff]/gi, 'xx').length;
    },
    includePath: '',
    include: function (file) {
        var files = typeof file == "string" ? [file] : file;
        for (var i = 0; i < files.length; i++) {
            var name = files[i].replace(/^\s|\s$/g, "");
            var att = name.split('.');
            var ext = att[att.length - 1].toLowerCase();
            var isCSS = ext == "css";
            var tag = isCSS ? "link" : "script";
            var attr = isCSS ? " type='text/css' rel='stylesheet' " : " language='javascript' type='text/javascript' ";
            var link = (isCSS ? "href" : "src") + "='" + $.includePath + name + "'";
            if ($(tag + "[" + link + "]").length == 0) document.write("<" + tag + attr + link + "></" + tag + ">");
        }
    }
});
jQuery.fn.extend({
    autoscroll: function () {
        var _self = $(this);
        $('html,body').animate(
         { scrollTop: _self.offset().top },
         800
       );
    }
});
 
if (!String.prototype.format) {
    String.prototype.format = function () {
        var args = arguments;
        return this.replace(/{(\d+)}/g, function (match, number) {
            return typeof args[number] != 'undefined'
              ? args[number]
              : match
            ;
        });
    };
}
G.ui.tips = {
    err: function (t, u) {
        this._set(t, u, {
            useOverlay: true, position: "center", icon: "info", autoclose: null, closeOverlay: true, buttons: {
                button1: {
                    text: '确定', danger: false, onclick: function () {
                        $.fallr('hide');
                    }
                }
            }
        }), afterHide = function () {
            if (u) {
                window.location = u;
            }
        }
    },
    info: function (t, u) {
        this._set(t, u, {
            useOverlay: true, position: "center", icon: "info", autoclose: null, closeOverlay: true, buttons: u ? {
                button1: {
                    text: '确定', onclick: function () {
                        window.location = u;
                    }
                }
            } : {
                button1: {
                    text: '确定', danger: false, onclick: function () {
                        $.fallr('hide');
                    }
                }
            }
        })
    },
    suc: function (t, u) {
        this._set(t, u, { useOverlay: true, position: null, autoclose: 1000, icon: "check", closeOverlay: true, buttons: null })
    },
    _set: function (str, url, opt) {
        opt = $.extend({
            useOverlay: true,
            position: null,
            icon: null,
            autoclose: null,
            closeOverlay: true,
            buttons: {},
            afterHide: function () { }
        }, opt || {});

        if (url) {
            opt.afterHide = function () {
                window.location = url;
            }
        } else {
            opt.afterHide = function () { };
        }
        $.fallr('show', {
            content: str,
            autoclose: opt.autoclose,
            useOverlay: opt.useOverlay,
            position: opt.position,
            icon: opt.icon,
            closeOverlay: opt.closeOverlay,
            buttons: opt.buttons,
            afterHide: opt.afterHide
        });
    },
    confirm: function (t, u) {
        $.fallr('show', {
            buttons: {
                button1: {
                    text: '确定', danger: true, onclick: function () {
                        window.location = u;
                    }
                },
                button2: {
                    text: '取消'
                }
            },
            content: '<p>' + t + '</p>',
            icon: 'trash'
        });
    },
    confirm_flag: function (t,f) {
        $.fallr('show', {
            buttons: {
                button1: {
                    text: '确定', danger: true, onclick: f
                },
                button2: {
                    text: '取消'
                }
            },
            content: '<p>' + t + '</p>',
            icon: 'trash'
        });
    },
    iframe: function (t, u, w, h) {
        if (w) w = 500;
        if (h) h = 300;
        $.fallr('show', {
            content: '<h2>' + t + '</h2>'
                          + '<iframe width="' + w + '" height="' + h + '" src="' + u + '" frameborder="0" allowfullscreen></iframe>',
            width: w + 130, // 100 = padding width
            icon: null,
            closeOverlay: true,
            position: 'center',
            buttons: {
                button1: { text: '关闭' }
            }
        });
    },
    html: function (t, u) {
        var b = {};
        if (u) {
            b = {
                button1: {
                    text: '确定', onclick: function () {
                        $.fallr('hide');
                    }
                }

            }
        }
        $.fallr('show', {
            content: '' + t + '',
            position: 'center',
            buttons: b,
            width: 500,
            //closeOverlay: true,
            afterHide: function () {
                if (u) {
                    window.location = u;
                }
            }
        });
    },
    up: function (t,v) {
        var c = $.cookie("up_tips"); 
        if (!c||c!=v) {
            var b = {
                button1: {
                    text: '知道了', onclick: function () {
                        $.cookie("up_tips", v, { expires: 365, path: "/" })
                        $.fallr('hide');
                    }
                } 
            }
            $.fallr('show', {
                content: '' + t + '',
                position: 'center',
                buttons: b,
                icon: 'up',
                width: '60%',
                height:'60%'
            });
        }
    }
};

G.logic.form = {
    tip: function (data) {
        if (data.errno == 0) {
            if (data.tip) {
                G.ui.tips.html(data.tip, data.url);
            }
            else {
                G.ui.tips.suc(data.error, data.url)
            }
        } else {
            G.ui.tips.err(data.error, data.url)
        }
    },
    validate: function () {
        var $from = $("form.form-validate");
        if ($from.length > 0) {
            $from.each(
              function () {
                  $(this).validate({
                      errorElement: "span",
                      errorClass: "help-block error",
                      errorPlacement: function (e, t) {
                          var p = t.parents(".controls");
                          if (p.length > 0) {
                              p.append(e);
                          }
                          else {
                              t.addClass("error")
                          }
                      },
                      highlight: function (e) {
                          $(e).closest(".control-group").removeClass("error success").addClass("error")
                      },
                      success: function (e) {
                          e.addClass("valid").closest(".control-group").removeClass("error success");
                          //.addClass("success") 加上绿色
                      },
                      submitHandler: function (form) {

                          var _sb = true;
                          if (typeof KindEditor !== "undefined" && KindEditor.instances) {
                              $.each(KindEditor.instances, function () {
                                  this.sync();
                                  var $element = $(this.srcElement[0]);
                                  var r = $element.attr("data-rule-required"), m = $element.attr("data-msg-required"), e = $element.attr("data-rule-rangelength"), em = $element.attr("data-msg-rangelength");
                                  var v = $.trim($element.val()).replace(/(&nbsp;)|\s|\u00a0/g, '');
                                  if (r) {
                                      if (v.length == 0) {
                                          var msg = m;
                                          G.ui.tips.info(msg ? msg : "内容不能为空")
                                          _sb = false; return false;

                                      }
                                  };
                                  if (e) {
                                      e = eval(e);
                                      var min = e[0];
                                      var max = e[1];
                                      var vv = $element.val();
                                      if (vv.length <= min || vv.length >= max) {
                                          G.ui.tips.info(em ? em : "内容不能小于{0}且大于{1}".format(min, max));
                                          _sb = false; return false;
                                      }

                                  }
                              });
                          }
                          if (_sb) {
                              var btn = $("#bsubmit")
                              btn.button('loading')
                              $(form).ajaxSubmit({
                                  dataType: 'json',
                                  success: function (d) {
                                      btn.button('reset');
                                      G.logic.form.tip(d);
                                  },
                                  error: function (d) {
                                      btn.button('reset');
                                      G.ui.tips.info(d.responseText);

                                  }
                              });

                          }

                      }
                  })
              });
        }
    },
    wizard: function () {
        $(".form-wizard").length > 0 && $(".form-wizard").formwizard({
            validationEnabled: true,
            formPluginEnabled: !0,
            focusFirstInput: !0,
            disableUIStyles: false,
            validationOptions: {
                errorElement: "span",
                errorClass: "help-block error",
                errorPlacement: function (e, t) {
                    t.parents(".controls").append(e)
                },
                highlight: function (e) {
                    $(e).closest(".control-group").removeClass("error success").addClass("error")
                },
                success: function (e) {
                    e.addClass("valid").closest(".control-group").removeClass("error success");
                }
            },
            formOptions: {
                dataType: 'json',
                success: function (d) {
                    G.logic.form.tip(d);

                },
                beforeSubmit: function (d) {
                    var f = true;
                    if (typeof KindEditor !== "undefined" && KindEditor.instances) {
                        $.each(KindEditor.instances, function () {
                            this.sync();
                            var $element = $(this.srcElement[0]);
                            var r = $element.attr("data-rule-required"), m = $element.attr("data-msg-required"), e = $element.attr("data-rule-range"), em = $element.attr("data-msg-range");
                            var v = $.trim($element.val()).replace(/(&nbsp;)|\s|\u00a0/g, '');
                            if (r) {
                                if (v.length == 0) {
                                    G.ui.tips.info(m ? m : "内容不能为空");
                                    f = false;
                                    return false;
                                }
                            }
                            if (e) {
                                e = eval(e);
                                var min = e[0];
                                var max = e[1];
                                var vv = $element.val();
                                if (vv.length <= min || vv.length >= max) {
                                    G.ui.tips.info(em ? em : "内容不能小于{0}且大于{1}".format(min, max));
                                    f = false; return false;
                                }
                            }
                        });

                    }
                    return f;
                },
                error: function (d) {
                    G.ui.tips.info(d.responseText);
                }
            }
        });
    },
    init: function () {
        this.validate();
        this.wizard();
    }
}
G.logic.page = {
    skn: function () {
        var tm = $.cookie('data-theme');
        if (tm) $("body").addClass(tm).attr("data-theme", tm);
    },
    table: function () {
        var $datatabletool = $("div.datatabletool");
        if ($datatabletool) {
            $datatabletool.hide();
        }
        //#region 全选
        var $allCheck = $("#listTable input.check_all"); // 全选复选框
        var $listTableTr = $("#listTable tr:gt(0)");
        var $idsCheck = $("#listTable input[name='check']"); // ID复选框
        $allCheck.click(function () {
            var $this = $(this);
            if ($this.attr("checked")) {
                $idsCheck.attr("checked", true);
                $datatabletool.show();
                $listTableTr.addClass("checked");
            } else {
                $idsCheck.attr("checked", false);
                $datatabletool.hide();
                $listTableTr.removeClass("checked");
            }

        });
        // 无复选框被选中时,删除按钮不可用
        $idsCheck.click(function () {
            var $this = $(this);
            if ($this.attr("checked")) {
                $this.parent().parent().addClass("checked");
                $datatabletool.show();
            } else {
                $this.parent().parent().removeClass("checked");
            }
            var $idsChecked = $("#listTable input[name='check']:checked");
            if ($idsChecked.size() > 0) {
                $datatabletool.show();
            } else {
                $datatabletool.hide();
            }
        });
        //#endregion
    },
    common: function () {
        $(".chosen-select").length > 0 && $(".chosen-select").each(function () {
            var e = $(this),
                t = e.attr("data-nosearch") === "true" ? !0 : !1,
                n = {};
            t && (n.disable_search_threshold = 9999999);
            e.chosen(n)
        });
        $(".daterangepick").length > 0 && $(".daterangepick").daterangepicker({ timePicker: true, format: 'YYYY/MM/DD HH:mm' });
        $(".datepick").length > 0 && $(".datepick").datepicker();
        $(".gototop").click(function (e) {
            e.preventDefault();
            $("html, body").animate({
                scrollTop: 0
            }, 600)
        });
         var $talbecheckbox = $("table.ajax-checkbox");
         if ($talbecheckbox.length > 0) {
             $("table.ajax-checkbox input[type='checkbox']").click(function () {
                 var $this = $(this)
                 var f = $this.attr("checked"), l = $talbecheckbox.attr("ajax-length"), id = $this.attr("data-id");
                 var url = $talbecheckbox.attr("ajax-url");
                 if (f) {
                     var ck_num = $("table.ajax-checkbox input[type='checkbox']:checked").length;
                     if (l && l != 0) {
                         var tmp = "最多勾选{0}个";
                         if (ck_num > l) { G.ui.tips.info(tmp.format(l)); return false; }
                     }
                     $.post(url, { "id": id, "ck": 1 }, function () {
                         G.ui.tips.suc("已保存")
                     })


                 } else {
                     $.post(url, { "id": id, "ck": 0 }, function () {
                         G.ui.tips.suc("已保存")
                     });
                 }   })
         };
         $("div.location_box").length > 0 && $("div.location_box").empty().append(G.util.location.locSelection($("div.location_box").attr("data-district"))); 
         $("a.anchor").length > 0 && $("a.anchor").click(function (e) { var rid = $(this).attr("href"); $(rid).autoscroll(); e.preventDefault(); });
         $("a.audio").length > 0 && $("a.audio").mb_miniPlayer({
             skin: "blue",
             inLine: true,
             showRew: false 
             
         });
    },
    init: function () {
        this.skn();
        if ($("table.dataTable").length > 0) this.table();
        if ($("table.draggable").length > 0) $("table.draggable tbody").sortable({
            cursor: "move",
            opacity: 0.5
        });
        this.common();
    }
}
G.util.location={

    _loc: false,
    getLocInfo: function (district) {
        if (!G.util.area) return false;

        var self = G.util.location;
        if (self._loc === false) {
            self._loc = {};
            $.each(G.util.area, function (pid, pinfo) {
                $.each(pinfo.l, function (cid, cinfo) {
                    $.each(cinfo.l, function (did, dname) {
                        // [名称,省份ID,省份名称,城市ID,城市名称]
                        self._loc[did] = [
                            dname,
                            pid,
                            pinfo.n,
                            cid,
                            cinfo.n
                        ];
                    });
                });
            });
        }

        var loc = self._loc[district];
        if (!loc) return false;

        return {
            name: loc[0],
            provinceId: loc[1],
            provinceName: loc[2],
            cityId: loc[3],
            cityName: loc[4]
        };
    },

    locSelection: function (district) {
        var htm = ['<select name="province" data-rule-required="true"><option value="" >请选择</option>'];
        $.each(G.util.area, function (pid, pinfo) {
            htm.push('<option value="' + pid + '">' + pinfo.n + '</option>');
        });
        htm.push('</select> <select name="city" data-rule-required="true"><option value="" >请选择</option></select> <select name="district" data-rule-required="true"><option value="" >请选择</option></select>');

        var j = $(htm.join(''));

        var p = j.filter('select:eq(0)');
        var c = j.filter('select:eq(1)');
        var d = j.filter('select:eq(2)');

        p.change((function (_, __, ___) {
            return function () {
                var pid = _.val();

                var cHtm = ['<option value="">请选择</option>'];
                if (G.util.area[pid]) {
                    $.each(G.util.area[pid].l, function (cid, cinfo) {
                        cHtm.push('<option value="' + cid + '">' + cinfo.n + '</option>');
                    });
                }

                __.empty().html(cHtm.join(''));
                __.hide()[0].style.display = '';

                __.change();
            };
        })(p, c, d));

        c.change((function (_, __, ___) {
            return function () {
                var pid = _.val();
                var cid = __.val();

                var dHtm = ['<option value="">请选择</option>'];
                if (G.util.area[pid] && G.util.area[pid].l[cid]) {
                    var r = $.extend({}, G.util.area[pid].l[cid].l);
                    var l = [];
                    $.each(r, function (k, v) {
                        l.push({
                            id: k,
                            name: v
                        });
                    });

                    l.sort(function (a, b) {
                        return a.name.toString().localeCompare(b.name.toString());
                    });

                    $.each(l, function (kk, dInfo) {
                        dHtm.push('<option value="' + dInfo.id + '">' + dInfo.name + '</option>');
                    });
                    l = null;
                }
                ___.empty().html(dHtm.join(''));
                ___.hide()[0].style.display = '';
            };
        })(p, c, d));

        j.setLocation = function (dist) {
            var p = $(this).filter('select:eq(0)'),
                c = $(this).filter('select:eq(1)'),
                d = $(this).filter('select:eq(2)');
            var ddInfo = G.util.location.getLocInfo(dist);
            if (ddInfo !== false) {
                p.val(ddInfo.provinceId).change();
                setTimeout(function () {
                    c.val(ddInfo.cityId).change();
                    setTimeout(function () {
                        d.val(dist);
                    }, 1);
                }, 1);
            } else {
                p.val(0);
                p.change();
            }
        };
        j.getLocId = function () {
            return $(this).filter('select:eq(2)').val();
        };

        j.setLocation(district);
        return j;
    },

    getLocName: function (district) {
        var self = G.util.location;
        var dInfo = self.getLocInfo(district);
        if (dInfo === false) return '';

        return dInfo.provinceName + dInfo.cityName + dInfo.name;
    }
}
G.logic.uploadify = {
    op: null,
    live: function () {
        $("textarea.bewrite").live("focus ", function () { $(this).parents("span").addClass("on") });
        $("textarea.bewrite").live("blur ", function () { $(this).parents("span").removeClass("on") });
        $("a.item_close").live("click ", function (e) {
            var _self = G.logic.uploadify;
            $.fallr('show', {
                buttons: {
                    button1: {
                        text: '确定', danger: true, onclick: function () {
                            var el = $(e.target).closest('li.imgbox');
                            console.log(el.data('url'));
                            $.post(_self.op.del_url, {
                                "id": el.data('postId'),
                                "url": el.data('url')
                            });
                            if ((_self.op.count - $("li.imgbox").length) >= 0) {
                                var button = $("#file_upload-button");
                                button.removeClass("disabled").attr("style", "")
                                button.html('<i class="icon-plus-sign"></i> 继续上传');
                            }
                            el.remove();
                            $.fallr('hide');

                        }
                    },
                    button2: {
                        text: '取消'
                    }
                },
                content: '<p>你确定要删除这张图片吗？</p>',
                icon: 'trash'
            });
        });
        $('.ipost-list').sortable({
            opacity: 0.8

        });
    },
    add: function (data) {
        var _tmp = ' <li class="imgbox" data-post-id="{0}" data-url="{3}">'
           + '<a class="item_close" href="javascript:void(0)" title="删除"></a> '
           + ' <input type="hidden" value="{0}" name="phout_list[]" />'
           + ' <input type="hidden" value="{3}" name="phout_url[{0}]" />'
           + ' <span class="item_box"><img src="{1}" /></span>'
           + ' <span class="item_input">'
           + ' <textarea name="imagestexts[{0}][]" class="bewrite" cols="3" rows="4" style="resize: none" data-rule-maxlength="150" placeholder="图片描述...">{2}</textarea>'
           + '<i class="shadow hc"></i></span></li>';
        $('#fileList').append(_tmp.format(data.id, data.thm_url, data.title,data.url));
        if ($.browser.msie && eval(parseInt($.browser.version)) < 10) {
            $("textarea[placeholder]").watermark();
        };
    },
    set: function () {
        var _self = this;
        var c = _self.op.count - $("li.imgbox").length;
        _self.op.el.uploadify({
            'swf': _self.op.swf,
            'uploader': _self.op.url,
            'cancelImage': 'uploadify-cancel.png',
            'buttonClass': 'btn pl_add btn-primary',
            'removeTimeout': 0,
            'fileSizeLimit': '2MB',
            'buttonText': '<i class="icon-plus-sign"></i> 添加图片',
            'formData': _self.op.data,
            'buttonCursor': 'pointer',
            'fileTypeDesc': '图片格式',
            'fileTypeExts': '*.jpg;*.bmp;*.png; *.jpeg',
            'queueSizeLimit': 100,
            'uploadLimit': c <= 0 ? 1 : c,
            'onUploadError': function (file, errorCode, errorMsg, errorString, queue) { alert(file.name + "上传失败 请联系系统管理员!") },
            'onUploadStart': function (file) {
                $('#file_upload-button').html('<i class="icon-plus-sign"></i> 继续上传');
            },
            'onInit': function (instance) {
                if ((_self.op.count - $("li.imgbox").length) <= 0) {
                    var button = $("#file_upload-button");
                    button.addClass("disabled").attr("style", "z-index: 999;")
                    button.html('上传已达限制...');
                }
            },
            'onUploadSuccess': function (file, data, response) {
                var json = $.parseJSON(data);
                if (json.result !== 'SUCCESS') {
                    G.ui.tips.info(json.message || data);
                    return;
                }
                _self.add(json.image);
            }
        });
    },
    init: function (op) {
        this.op = op;
        this.set();
        this.live();
    }
};
$(function () {
    G.logic.page.init();
    G.logic.form.init();
    // var json = { "errno": 0, "error": "\u6210\u529f\uff01", "url": "\/wechat\/menu\/aid\/2", "tip": "ffffasdfasdf" };
    //G.ui.tips.iframe("百度", "http://www.baidu.com", 999, 500) 
    //G.logic.form.tip(json)
  
})
/*作者: wang_.long@qq.com  */
