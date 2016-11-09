BizQQWPA.define("util.domain",function(){var d={},e=document.domain;try{d.url=location.href}catch(f){d.url=""}d.topDomain=function(){var b=/\.(?:(?:edu|gov|com|org|net)\.cn|co\.nz)$/,c=/^[12]?\d?\d\.[12]?\d?\d\.[12]?\d?\d\.[12]?\d?\d$/,a=b.test(e)?-3:c.test(e)?0:-2;return e.split(".").slice(a).join(".")}();d.domain=function(){var b=/(?::[\/]{2}|:[\\]{3})([a-zA-Z0-9_\.]+)/;try{var c=b.exec(d.url);return c?c[1]||e:e}catch(a){return e}}();return d});BizQQWPA.define("wpa.wpaMgr","globalSettings,lang.each,util.proxy,util.titleFlash,util.report,util.serialize,util.domain,wpa.WPA",function(r){var q=r("globalSettings"),l=r("each"),n=r("proxy"),t=r("titleFlash"),o=r("report"),k=r("serialize"),p=r("domain"),s=r("WPA");var m=function(d){var a="http://prom.b.qq.com/wpadisplay/r.gif?",c=["wty","type","nameAccount","kfuin","ws","aty","a","title","wording","wording2"],b={version:q.version};l(c,function(){b[this]=typeof d[this]==="undefined"?"":d[this]});o(a+k(b))};return{newWPA:function(a){var b=a.nameAccount;if(!b){return}m(a);return new s(a)},invite:function(d,b){var a=this,e=function(){t.on("\u3010\u60A8\u6709\u65B0\u4FE1\u606F\u3011");d.insert=function(g){var h=document.getElementsByTagName("body")[0];h.insertBefore(g,h.firstChild)};a.newWPA(d)};if(!b){e();return}try{var c=n({params:d},s.prototype.launchChat);window[b]&&window[b](c,d.msg)}catch(f){e()}}}});BizQQWPA.define("wpa.visitor","util.log,util.speedReport,util.getJSONP,util.domain,util.pubSub,wpa.filter,wpa.ta,wpa.invite,wpa.wpaMgr,wpa.ta,wpa.kfuin",function(s){var m=s("invite"),r=s("domain"),v=s("filter"),t=s("getJSONP"),o=s("pubSub"),q=s("log"),u=s("speedReport"),p=s("ta"),w=s("kfuin");var n=1;var x="http://visitor.crm2.qq.com/cgi/visitorcgi/ajax/wpa_first_heart_beat.php";return function(f){var c=f.nameAccount;if(!c||c==="undefined"){return}if(m.isLoaded(c)||!v.TA){return}var e,a,b=function(g,h){if(!g||!h){return}if(h.block===n){return}if(v.CRM){h.di=f.di;h.kfuin=f.kfuin;q(c+" try launch slave");m.load(c,g,h)}};o.one("TA.loaded",function(g){e=g;b(e,a)});o.one("Invite.first",function(g){a=g;b(e,a)});p(c,r.topDomain,function(g){o.pub("TA.loaded",g)});var d={nameAccount:c,dm:r.topDomain,title:document.title,url:location.href.split("://")[1].split("?")[0]};t(x,d,function(g){o.pub("Invite.first",g)});f.kfuin&&w.set(c,f.kfuin)}});BizQQWPA.define("wpa.kfuin","util.getJSONP",function(f){var g=f("getJSONP");var h="http://wpl.b.qq.com/cgi/conv.php";var e={};return{get:function(b,a){a=a||function(){};if(!b||e[b]){a(e[b]);return}var c={num:b};g(h,c,function(d){if(!d||d.r!==0){a();return}var j=e[b]=d.data.kfuin;a(j)})},set:function(a,b){e[a]=b}}});BizQQWPA.define("util.proxy",function(){return function(c,d){return function(){return d.apply(c,arguments)}}});BizQQWPA.define("util.titleFlash","util.taskMgr",function(l){var k=120;var h=l("taskMgr");var j=document,i=j.title,g=h.newTask(function(){var a=j.title;j.title=a.substr(1,a.length)+a.substr(0,1)},k);return titleFlash={on:function(a){j.title=a+(""+j.title);g.run()},off:function(){g.pause();j.title=i}}});BizQQWPA.define("util.cookie",function(){var b=document;return{set:function(l,j,k,h,a){if(a){a=new Date(+new Date()+a)}var i=l+"="+escape(j)+((a)?"; expires="+a.toGMTString():"")+((h)?"; path="+h:"")+((k)?"; domain="+k:"");if(i.length<4096){b.cookie=i}},get:function(d){var a=b.cookie.match(new RegExp("(^| )"+d+"=([^;]*)(;|$)"));if(a!=null){return unescape(a[2])}return null},del:function(a,f,e){if(this.get(a)){b.cookie=a+"="+((e)?"; path="+e:"")+((f)?"; domain="+f:"")+";expires=Thu, 01-Jan-1970 00:00:01 GMT"}},find:function(a){return b.cookie.match(a).split(",")}}});/**
 * Created with JetBrains WebStorm.
 * User: amoschen
 * Date: 13-1-7
 * Time: 下午8:05
 * To change this template use File | Settings | File Templates.
 */
BizQQWPA.define('wpa.WPA', 'globalSettings,lang.browser,lang.typeEnhance,util.proxy,util.pad,util.Bits,util.getScript,util.getJSONP,util.domain,util.events,util.onLoad,util.offset,util.report,util.log,util.speedReport,wpa.SelectPanel,util.onIframeLoaded,util.GUID,wpa.getQQVersion,wpa.ViewHelper,wpa.views,wpa.ta,wpa.kfuin,wpa.sid', function(require){
    var globalSettings = require('globalSettings'),
        proxy = require('proxy'),
        typeEnhance = require('typeEnhance'),
        pad = require('pad'),
        Bits = require('Bits'),
        getScript = require('getScript'),
        getJSONP = require('getJSONP'),
        domain = require('domain'),
        events = require('events'),
        onLoad = require('onLoad'),
        browser = require('browser'),
        offset = require('offset'),
        report = require('report'),
        log = require('log'),
        speedReport = require('speedReport'),
        GUID = require('GUID'),
        SelectPanel = require('SelectPanel'),
        onIframeLoaded = require('onIframeLoaded'),
        getQQVersion = require('getQQVersion'),
        ViewHelper = require('ViewHelper'),
        views = require('views'),
        ta = require('ta'),
        kfuinCache = require('kfuin'),
        sidCache = require('sid');

    var global = window;

    //wpa params
    var WPA_TYPE_TA_INVITE_ONLY = '0', //no wpa will be created, TA & invite logic only
        WPA_TYPE_NORMAL = '1', //normal wpa, with TA & invite logic
        WPA_TYPE_LINK = '2', //for forumn & weibo, a link
        WPA_TYPE_CUSTOM = '3', //customized wpa
        SESSION_VERSION_TA = '4', //session version for wpa with TA, seperated from user customed wpa
        WPA_STYLE_TYPE_INVITE = '20', //invite wpa's style type
        APPOINTED_TYPE_AUTO = '0', //appointed type of automatic diversion
        APPOINTED_TYPE_KFEXT = '1', //appointed type of appointed kfext
        APPOINTED_TYPE_GROUP = '2', //appointed type of appointed group
        WPA_FLOAT_TYPE_FIXED = '0', //wpa style: float style fixed
        WPA_FLOAT_TYPE_SCROLL = '1', //wpa style: float style scroll
        WPA_FLOAT_POSITION_X_LEFT = '0', //wpa style: x-coordinate position, left
        WPA_FLOAT_POSITION_X_CENTER = '1', //wpa style: x-coordinate position, center
        WPA_FLOAT_POSITION_X_RIGHT = '2', //wpa style: x-coordinate position, right
        WPA_FLOAT_POSITION_Y_TOP = '0', //wpa style: y-coordinate position, top
        WPA_FLOAT_POSITION_Y_CENTER = '1', //wpa style: y-coordinate position, center
        WPA_FLOAT_POSITION_Y_BOTTOM = '2', //wpa style: y-coordinate position, bottom
        IS_INVITE_WPA_FALSE = '0', //param that seperate wpa conversations, false means normal wpa conversation
        IS_INVITE_WPA_TRUE = '1', //param that seperate wpa conversations, invite wpa conversation
		CHAT_TYPE_AIO = 1, // assign to launch qq chat
		CHAT_TYPE_ANONYMOUS = 2; //assign to launch anonymous chat

    var SPEED_REPORT_DISPLAY = 0.1;

    var WPA = function(params){
        this.params = params;
        this.insert = params.insert;
        this.wty = params.wty;

        var self = this,
            nameAccount = this.nameAccount = params.nameAccount,
            kfuin = this.kfuin = params.kfuin;

        //render wpa view
        switch (this.wty){
            case WPA_TYPE_NORMAL:
                this.render();
                break;
            case WPA_TYPE_CUSTOM:
                this.custom();
        }

        //preload kfuin & sid
        !this.kfuin && kfuinCache.get(nameAccount, function(data){
            data && (self.kfuin = data);
        });

        !this.sid && sidCache.get(nameAccount, function(data){
            data && (self.sid = data);
        });

		// report page source
        report('http://prom.b.qq.com/se/r.gif?ref=' + encodeURIComponent(document.referrer));
    };

    WPA.prototype = {
        render: function(){
            var params = this.params;

            //业务分发器，动态加载当前样式所需的业务js
            var width, height,
                type = parseInt(params['type']),
                typeStr,
                isFloat = false;

            //wpa style switch
            switch(type){
                // btn styles
                case 1: typeStr = 'a01'; width = 92; height = 22; break;
                case 2: typeStr = 'a02'; width = 77; height = 22; break;

                // float styles
                case 10: typeStr = 'b01'; width = 93; height = 151; isFloat = true; break;
                case 11: typeStr = 'b02'; width = 327; height = 172; isFloat = true; break;
                case 12: typeStr = 'b03'; width = 121; height = 277; isFloat = true; break;

                // invite styles
                case 20: typeStr = 'i01'; width = 327; height = 172; isFloat = true; break;

                // self-define styles
                case 30: typeStr = 'd01'; width = params['txw']; height = params['txh']; isFloat = true; break;
            }

            this.type = typeStr;
            this.width = width;
            this.height = height;
            this.createWPA();

            if( (type > 9 && type < 14) || type === 20 || type === 30 ){
                this.initFloatWPA();
            }
        },

        // create WPA node
        createWPA: function(){
            // speed report: start time stamp of view page
            var speedRpt = speedReport('7818', '21', '1');

            var wpa = this,
                type = this.type,
                width = this.width,
                height = this.height,
                view = views[type];

            // ie will reject operations when parent's domain is set
            var iframe;
            try{
                iframe = document.createElement('<iframe scrolling="no" frameborder="0" width="' + width + '" height="' + height + '" allowtransparency="true" src="about:blank"></iframe>');
            } catch(e) {
                iframe = document.createElement('iframe');
                iframe.width = width;
                iframe.height = height;
                iframe.setAttribute('scrolling', 'no');
                iframe.setAttribute('frameborder', 0);
                iframe.setAttribute('allowtransparency', true);
                iframe.setAttribute('src', 'about:blank');
            }

            this.node = iframe;
            this.insert(iframe);

            if(browser.msie){
                // when domain is set in parent page and blank iframe is not ready, access to it's content is denied in ie
                try{
                    var accessTest = iframe.contentWindow.document;
                } catch(e){
                    // Test result shows that access is denied
                    // So reset iframe's document.domain to be the same as parent page
                    iframe.src = 'javascript:void((function(){document.open();document.domain=\''+ document.domain + '\';document.close()})())';
                }
            }

            var loaded = function(){
                var iWin = iframe.contentWindow,
                    iDoc = iframe.contentDocument || iWin.document;

                iDoc.open();
                iDoc.write([
                    '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">',
                    '<html xmlns="http://www.w3.org/1999/xhtml">',
                    '<head>',
                        '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />',
                        browser.msie && iframe.src !== 'about:blank' ? '<script>document.domain=\'' + document.domain + '\';</script>' : '',
                    '</head>',
                    '<body>',
                        view.templ,
                    '</body>',
                    '</html>'
                ].join(''));
                iDoc.close();

                // add helper for views' initiation
                var helper = new ViewHelper(iDoc, wpa);

                view.init(iDoc, helper);

                //record time & report
                var point = 1;
                speedRpt.addPoint(point).send(SPEED_REPORT_DISPLAY);
            };

            onIframeLoaded(iframe, loaded);
        },

        /**
         * 浮动WPA的iframe加载器，判断目标页面加载成功后再show出来
         */
        initFloatWPA: function(){
            //创建浮动层
            var doc = window.document,
                params = this.params,
                type = parseInt(params['type']),
                node = this.node,
                width = this.width,
                height = this.height;

            node.style.cssText = [
                'display:none;',
                'position:absolute;',
                type === 20 ? 'z-index:2147483647!important;' : 'z-index:2147483646!important;'
            ].join(' ');

            //判断页面是否加载完毕
            onLoad(initIframeLoad);

            /**
             * 对B01、B02、B03、B04 node进行处理
             */
            function initIframeLoad(){
                var isty = node.style,
                    isIE = browser.msie,
                    ver = parseInt(browser.version, 10),
                    isQuirk = doc.compatMode === 'BackCompat';

                //非IE6统一使用position:fixed
                isty.position = parseInt(params['fsty'], 10) == 0 ? 'fixed' : 'absolute';

                //获取浮动的位置
                if(parseInt(params['fposX']) == 0){
                    isty.left = 8 + 'px';
                    isty.right = 'auto';
                    isty.marginLeft = 0;
                }else if(parseInt(params['fposX']) == 1){
                    isty.left = '50%';
                    isty.right = 'auto';
                    isty.marginLeft = '-'+parseInt(width/2) + 'px';
                }else{
                    isty.left = 'auto';
                    isty.right = 8 + 'px';
                    isty.marginLeft = 0;
                }
                if(parseInt(params['fposY']) == 0){
                    isty.top = 8 + 'px';
                    isty.bottom = 'auto';
                    isty.marginTop = 0;
                }else if(parseInt(params['fposY']) == 1){
                    isty.top = '50%';
                    isty.bottom = 'auto';
                    isty.marginTop = '-'+parseInt(height/2) + 'px';
                }else{
                    isty.top = 'auto';
                    isty.bottom = 8 + 'px';
                    isty.marginTop = 0;
                }

                //对IE6进行特殊处理position:absolute，用setInterval实现滚动跟随
                if((isIE & ver < 7) || isQuirk){
                    isty.position = 'absolute';
                    if(parseInt(params['fsty']) == 0){
                        //reset
                        isty.marginTop = 0;
                        var itop;

                        if(parseInt(params['fposY']) == 0){
                            itop = 8;
                        }else if(parseInt(params['fposY']) == 1){
                            itop = (offset.getClientHeight(doc) - height)/2;
                        }else{
                            itop = offset.getClientHeight(doc) - height - 8;
                        }

                        setInterval(function(){
                            isty.top = offset.getScrollTop(doc) + itop + 'px';
                        }, 128);
                    }
                }

                isty.display = 'block';
            }
        },

        custom: function(){
            events.addEvent(this.params.node, 'click', proxy(this, this.launchChat));
        },

        remove: function(){
            var node = this.node;
            node.parentNode.removeChild(node);
        },

        // Chat part
        /**
         * Launch a chat
         * @param {function} callback Callback when chat is launched
         */
        launchChat: function(callback){
            // Mobile
            if(browser.isIOS || browser.isAndroid){
                this.launchMobileChat();
                return;
            }
			
			var wpa = this,
				sptReport = speedReport('7818', '21', '2'),
				chatType = this.params.chatType;
				
			if(chatType == CHAT_TYPE_ANONYMOUS){
				wpa.launchAnonymousChat(callback);
				return;
			}
			
			if(chatType == CHAT_TYPE_AIO){
				wpa.launchAIOChat(callback);
				return;
			}

            getQQVersion(function(version){
                sptReport.addPoint(7).send();

                // since QQ browser plugin is not reliable
                // always try to launch AIO chat
                wpa.launchAIOChat(callback);

                if(version){
                    return;
                }

                // show selections for user when no version detected ( not sure QQ exists or not)
                new SelectPanel({
                    //QQ已安装，点击会话
                    onAIOChat: function(){
                        wpa.launchAIOChat(callback);
                    },

                    //未安装，发起网页会话
                    onAnonyChat: function(){
                        wpa.launchAnonymousChat(callback);
                    }
                });
            });
        },

        launchMobileChat: function(){
            var nameAccount = this.params.nameAccount;

            // only kfuin are acceptable for scheme
            // use kfuin cache
            kfuinCache.get(nameAccount, function(kfuin){
                // for wechat
                // page outside qq.com should be redirect to proxy page at qq.com
                if(navigator.userAgent.indexOf('MicroMessenger') > -1 && domain.domain.indexOf('qq.com') === -1){
                    location.href = 'http://wpd.b.qq.com/page/info.php?nameAccount=' + nameAccount;
                    return;
                }

                // mobile QQ has problem in resolving complex source url
                // use domain temporarily
                var crmSchema = 'mqqwpa://im/chat?chat_type=crm&uin=' + kfuin + '&version=1&src_type=web&web_src=http://' + domain.domain,
                    schema = 'mqqwpa://im/chat?chat_type=wpa&uin=' + kfuin + '&version=1&src_type=web&web_src=http://' + domain.domain,
                    start = +new Date(),
                    launch = function(schema, fail){
                        var div = document.createElement('div');

                        div.style.visibility = 'hidden';
                        div.style.width = 0;
                        div.style.height = 0;


                        div.innerHTML = '<iframe id="schema" src="' + schema + '" scrolling="no" width="0" height="0"></iframe>';

                        document.body.appendChild(div);

                        setTimeout(function(){
                            var gap = +new Date() - start;

                            // gap above 1000ms seen as manual return
                            if(gap < 1000){
                                fail && fail();
                            }

                            // clean up div
                            document.body.removeChild(div);
                        }, 800);
                    };

                launch(crmSchema, function(){
                    launch(schema, function(){
                        // automaticlly return when no mobile QQ installed

                        // window.open is not allowed in some android browser
                        // window.open('http://wpd.b.qq.com/page/info.php?nameAccount=' + nameAccount, '_blank');

                        location.href = 'http://wpd.b.qq.com/page/info.php?nameAccount=' + nameAccount;
                    });
                });
            });
        },

        // Launch PC QQ chat
        launchAIOChat: function(){
            var iframe = document.createElement('iframe'),
                body = document.getElementsByTagName('body')[0];
            iframe.style.display = 'none';
            body.insertBefore(iframe, body.firstChild);

            return function(callback){
                var params = this.params,
                    kfuin = this.kfuin,
                    opts = {
                        na: params.nameAccount,
                        kfuin: kfuin,
                        aty: params.aty,
                        a: params.a,
                        sid: this.sid,
                        uid: ta.uid,
                        url: domain.url,
                        title: document.title,
                        dm: domain.topDomain,
                        clkSrc: params.clkSrc || '',
                        ext: params.ext || ''
                    },
                    guid = GUID();

                var sptReport = speedReport('7818', '21', '2');

                getJSONP('http://wpd.b.qq.com/cgi/get_sign.php', opts, function(rs){
                    if(!rs || rs.r !== 0 || !rs.data){
                        return;
                    }

                    iframe.src = rs.data.sign;

                    var isLoaded = false,
                        loaded = function(){
                            // make sure no double run
                            if(isLoaded){
                                return;
                            }

                            isLoaded = true;

                            var clickId = rs.data.clkID;

                            // report log
                            sptReport.addPoint(5).send();
                            report('http://promreport.crm2.qq.com/wpaclick/r.gif?ty=1&kfuin=' + kfuin + '&version=' + globalSettings.version + '&browser=' + encodeURIComponent(navigator.userAgent) + '&bfrom=1&appointType=' + params.aty + '&appoint=' + params.a + '&clkID=' + clickId + '&guid=' + guid);

                            //inform TA
                            global.taClick && global.taClick(clickId, 'clickid');

                            // delay callback because schema causes time
                            // in case of calling back too early, delay callback for a while
                            typeEnhance.isFunction(callback) && setTimeout(function(){
                                callback(params);
                            }, 1000);
                        };

                    onIframeLoaded(iframe, loaded);

                    // fallback solution
                    // in some cases like security setting higher than low-middle in ie, readyState will remain interactive and never be loaded
                    // for this case, interactive ready state is already good to fire callback, so use setTimeout checking instead of iframe loaded
                    if(browser.msie){
                        var fallback = function(){
                            setTimeout(function(){
                                if(isLoaded){
                                    return;
                                }

                                /interactive/.test(iframe.readyState) ? loaded() : fallback();
                            }, 500);
                        };

                        fallback();
                    }
                });

                report('http://promreport.crm2.qq.com/wpaclickorg/r.gif?kfuin=' + kfuin + '&version=' + globalSettings.version + '&browser=' + encodeURIComponent(navigator.userAgent) + '&bfrom=1&appointType=' + params.aty + '&appoint=' + params.a + '&guid=' + guid);
            }
        }(),

        // Launch anonymous chat
        launchAnonymousChat: function (callback){
            var params = this.params,
                // record load time of anonymous page
                sptReport = speedReport('7818', '21', '2'),
                url = 'http://wpd.b.qq.com/page/webchat.html?nameAccount=' + this.nameAccount,
                opener = window.open(url, '_blank', 'height=516, width=598,toolbar=no,scrollbars=no,menubar=no,status=no,location=no');

            typeEnhance.isFunction(callback) && callback(params);

            // report log
            report('http://promreport.crm2.qq.com/wpaclick/r.gif?ty=2&kfuin=' + this.kfuin + '&version=' + globalSettings.version + '&browser=' + encodeURIComponent(navigator.userAgent) + '&bfrom=1&appointType=' + params.aty + '&appoint=' + params.a);

            opener.onload = function(){
                sptReport.addPoint(6).send();
            };
        }
    };

    return WPA;
});BizQQWPA.define("util.getJSONP","util.getScript,util.serialize",function(e){var f=e("getScript"),h=e("serialize");var g=0;return function(c,d,a){var b="JSONP_CALLBACK_"+ ++g+"_"+Math.round(Math.random()*100),j;d.cb=b;c+=c.indexOf("?")===-1?"?":"&";c+=h(d);j=f(c);window[b]=function(i){a(i);setTimeout(function(){window[b]=null;j.parentNode.removeChild(j)},1)}}});BizQQWPA.define("wpa.filter","util.domain",function(i){var f="",g="qq.com,pengyou.com,qzoneapp.com,nipic.com,docin.com,51zxw.net,2155.com,xd.com,yto.net.cn,c-c.com,27.cn,05wan.com,alivv.cn,gogo.com,doctorjob.com.cn,emoney.cn,m4.cn,chinaktv.net,yk988.com,bangkaow.com,wsxsp.com,55tools.com,youxi518.com",j="b.qq.com,sales.b.qq.com,guilin.house.qq.com,ta.qq.com,hn.qq.com,nantong.house.qq.com";var h=i("domain");return{TA:function(){var c=h.topDomain,d=/^[12]?\d?\d\.[12]?\d?\d\.[12]?\d?\d\.[12]?\d?\d$/,a=/^localhost$/,b=/^wpa\.b\.qq\.com/;return f.indexOf(c)===-1&&!d.test(c)&&!a.test(c)&&!b.test(h.domain)}(),CRM:function(){try{var d=new RegExp("(^|,)"+h.domain);if(d.test(j)){return true}var e=h.topDomain,a=new RegExp("(^|,)"+e),l=/^[12]?\d?\d\.[12]?\d?\d\.[12]?\d?\d\.[12]?\d?\d$/,c=/^localhost$/;return !a.test(g)&&!l.test(e)&&!c.test(e)}catch(b){}}()}});BizQQWPA.define("wpa.ta","util.getScript,util.serialize,util.cookie",function(m){var i="http://tajs.qq.com/crmqq.php",p="pgv_pvi";var j=m("getScript"),k=m("serialize"),l=m("cookie");var n=false;var o=function(a,b,f){var c=false;if(o.uid){f(o.uid);c=true}if(!n){var d={uid:a,dm:b},e=i+"?"+k(d,"=","&");j(e,function(){n=true;if(c){return}o.uid=l.get(p);if(o.uid){f(o.uid)}else{setTimeout(arguments.callee,30)}})}};o.uid=l.get(p)||"";return o});BizQQWPA.define("wpa.invite","util.log,util.getJSONP,util.proxy,util.domain,util.blockStorage,util.taskMgr,wpa.wpaMgr",function(a0){var aP=2000,an=1000,aI=2000,a3=2000,aJ=5000,ac=15000,ar=3600000,ae=1000;var aU="is",aq="ik",a4="msg",ay="mh",av="mid",aL="slid";var aK="0",ad="1",aE="2",aj="0",aB="-1",aC="|";var aQ="http://visitor.crm2.qq.com/cgi/visitorcgi/ajax/wpa_heart_beat.php",ah="http://visitor.crm2.qq.com/cgi/visitorcgi/ajax/auto_invite.php";var aO=0,az="0",ag="1",aS="2",a2=1;var af="0",aG="1",aV="2",aW="4",aD="20",au="0",aT="1",aY="2",aF="4",aA="5";var at="0",ap="1",aw="1",ax="0",aM="1";var aX=a0("log"),aH=a0("getJSONP"),ai=a0("proxy"),aR=a0("domain"),aZ=a0("blockStorage"),a1=a0("taskMgr"),ak=a0("wpaMgr");var al=function(a,b,c){this.nameAccount=a;this.uid=b;this.config=c;this.genID();this.storage=aZ(a);this.monitors={master:a1.newTask(ai(this,this.masterMonitor),aP).run(),invite:a1.newTask(ai(this,this.inviteMonitor),an).run()};this.heartBeat=a1.newTask(ai(this,this.heartBeatProcess),a3).run();this.setActive();window.onfocus=ai(this,this.setActive);aX("slave "+this.id+" launched!")};al.prototype={genID:function(){this.id="slid_"+ +new Date()%1000+"_"+Math.round(Math.random()*100)},masterMonitor:function(){if(aN[this.nameAccount]){return}aX("monitoring mater state");var b=this.storage.get(ay)||0,a=+new Date()-parseInt(b);aX("gap of master is "+a);if(a>3*aI){this.recoverMaster()}},recoverMaster:function(){aN[this.nameAccount]=new am(this.nameAccount,this.uid,this.config);aX("recover master by slave "+this.id)},inviteMonitor:function(){if(this.isInvited()){this.kill()}else{if(this.isInviting()){if(this.isActive()){this.invite()}}}aX("slave "+this.id+" monitoring invite state")},kill:function(){this.monitors.invite.drop();this.heartBeat.drop();var a=this.storage,b=[this.id];for(var c=0,d;d=b[c++];){a.del(d)}aX("slave "+this.id+" killed")},invite:function(){var b=this.storage.get(aq);var a={wty:aG,nameAccount:this.nameAccount,kfuin:this.config.kfuin,type:aD,aty:b?(b===aj?aF:aA):aF,a:b||"",iv:aM,fsty:at,fposX:aw,fposY:ap,sv:aW,uid:this.uid,dm:aR.topDomain,msg:this.storage.get(a4)};ak.invite(a,this.config.di);this.storage.set(aU,aE);aX("invited by slave "+this.id)},heartBeatProcess:function(){var a=this.storage,b=a.get(aL);if(!b){a.set(aL,this.id+"|")}else{if(b.indexOf(this.id+"|")===-1){a.set(aL,this.id+"|"+b)}}a.set(this.id,+new Date())},setActive:function(){var a=this.storage,b=a.get(aL)||"",c=this.id+aC;if(b.indexOf(this.id)>-1){b=b.replace(c,"")}b+=c;a.set(aL,b)},isActive:function(){var a=this.storage.get(aL);if(!a){return false}return a.substr(0,a.length-1).split(aC).pop()===this.id},isInvited:function(){return this.storage.get(aU)===aE},isInviting:function(){return this.storage.get(aU)===ad}};var aN={};var am=function(a,b,c){this.nameAccount=a;this.uid=b;this.config=c;this.storage=aZ(a);this.genID();this.sleep=false;this.heartBeatURl=c.hbDomain||aQ;this.storage.set(av,this.id);this.heartBeatProcess();this.heartBeat=a1.newTask(ai(this,this.heartBeatProcess),aI).run();this.initWithConfig();aX("master launched!")};am.prototype={genID:function(){this.id=+new Date()%1000+"_"+Math.round(Math.random()*100)},setInviteState:function(b,c,a){if(b===ad){this.storage.set(aq,c);this.storage.set(a4,a)}this.storage.set(aU,b)},isInvited:function(){var a=this.storage.get(aU)===aE;if(a){this.recycle();this.isInvited=function(){return true}}return a},initWithConfig:function(){var a=this.config;if(a.r!==aO){this.storage.set(ay,aB);return}if(a.isAuto===a2){this.storage.set(a4,a.autoMsg);this.autoInviteTimer=setTimeout(ai(this,function(){this.autoInvite()}),a.autoTime*1000)}this.monitors={slave:a1.newTask(ai(this,this.slaveMonitor),a3).run(),server:a1.newTask(ai(this,this.serverMonitor),aJ).run(),sleep:a1.newTask(ai(this,this.sleepMonitor),ar).run()};aX("master inited with config")},autoInvite:function(){if(this.isInvited()){return}var a={nameAccount:this.nameAccount,uid:this.uid};var b=this.monitors.server;b.pause();aH(ah,a,ai(this,function(c){if(c.r!==aO){b.run();return}if(!this.isInvited()){this.setInviteState(ad,aj,this.storage.get(a4));a1.once(function(){b.run()},5000).run()}}))},ajustServerMonitorGap:function(a){this.monitors.server.setGap(Math.min(Math.max(aJ,a),ac))},serverMonitor:function(){var a=this.storage.get(aU);if(this.sleep){return}var b={nameAccount:this.nameAccount,uid:this.uid};if(a===ad){b.inviteState=ag}if(a===aE){b.inviteState=aS}aH(this.heartBeatURl,b,ai(this,function(c){if(c.r!==aO){return}if(c.gap){this.ajustServerMonitorGap(c.gap*1000)}if(c.inviteState===az){return}if(c.inviteState===ag){this.setInviteState(ad,c.kfext,c.inviteMsg);return}if(c.inviteState===aS){this.setInviteState(aE)}}))},slaveMonitor:function(){if(this.isInvited()){this.monitors.slave.drop()}var h=this.storage,g=h.get(aL);if(!g){return}g=g.split(aC);var b="",c=+new Date(),d,f,a;for(var e=0;f=g[e++];){aX("monitoring slave "+f+" state");d=h.get(f)||0;a=c-parseInt(d);aX("gap of slave "+f+" is "+a);if(a>3*a3){h.del(f);aX("clear slave "+f+" in storage")}else{b+=f+aC}}h.set(aL,b)},sleepMonitor:function(){var b=this.storage.get(aL)||"",a=b.substr(0,b.length-1).split(aC).pop();if(this.sleep){if(this.activeSlave!==a){this.activeSlave=a;this.sleep=false;this.monitors.sleep.setGap(ar)}}else{if(this.activeSlave===a){this.sleep=true;this.monitors.sleep.setGap(ae)}else{this.activeSlave=a}}},kill:function(){aN[this.nameAccount]=undefined;if(this.monitors){this.monitors.server.drop();this.monitors.slave.drop();this.heartBeat.drop();clearTimeout(this.autoInviteTimer)}aX("master killed")},recycle:function(){var a=this.storage,b=[aq,a4];for(var c=0,d;d=b[c++];){a.del(d)}aX("storage recycled")},heartBeatProcess:function(){var a=this.storage;if(a.get(av)!==this.id){this.kill();return false}this.storage.set(ay,+new Date())}};var ao={};return{load:function(a,b,d){if(this.isLoaded(a)){aX(a+" slave already running");return}var c=new al(a,b,d);ao[a]?ao[a].push(c):ao[a]=[c]},isLoaded:function(a){return typeof ao[a]!=="undefined"}}});BizQQWPA.define("util.taskMgr","util.proxy",function(i){var k="run",l="pause",n="drop",o=50;var p=i("proxy");var j=function(){this.circle=[];this.pos=0;setInterval(p(this,this.loop),16)};j.prototype={newTask:function(b,a){var c=new m(b,a);this.circle.push(c);return c},once:function(b,a){return this.newTask(function(){b.apply(this);this.drop()},a)},loop:function(){var f=this.circle,a=this.pos,c=f.length,b=+new Date(),d=o,e=f[a];while(c>0&&+new Date()-b<d){if(e.isRunning()){e.execute()}else{if(e.isDropped()){f.splice(a,1);a--}}a=(a+1)%f.length;e=f[a];c--}this.pos=a}};var m=function(b,a){this.fn=b;this.gap=a;this.status=l;this.lastExecTime=+new Date()};m.prototype={run:function(){this.status=k;return this},pause:function(){this.status=l;return this},drop:function(){this.status=n;return this},execute:function(){if(+new Date()-this.lastExecTime<this.gap){return false}this.fn();this.lastExecTime=+new Date();return true},getGap:function(){return this.gap},setGap:function(a){this.gap=a;return this},isRunning:function(){return this.status===k},isPaused:function(){return this.status===l},isDropped:function(){return this.status===n}};return new j()});BizQQWPA.define("lang.browser",function(){var g=navigator.userAgent.toLowerCase();var h={};var e=/(chrome)[ \/]([\w.]+)/.exec(g)||/(webkit)[ \/]([\w.]+)/.exec(g)||/(opera)(?:.*version|)[ \/]([\w.]+)/.exec(g)||/(msie) ([\w.]+)/.exec(g)||g.indexOf("compatible")<0&&/(mozilla)(?:.*? rv:([\w.]+)|)/.exec(g)||[];var f={browser:e[1]||"",version:e[2]||"0"};if(f.browser){h[f.browser]=true;h.version=f.version}if(h.chrome){h.webkit=true}else{if(h.webkit){h.safari=true}}h.isMobile=g.match(/(nokia|iphone|android|motorola|^mot\-|softbank|foma|docomo|kddi|up\.browser|up\.link|htc|dopod|blazer|netfront|helio|hosin|huawei|novarra|CoolPad|webos|techfaith|palmsource|blackberry|alcatel|amoi|ktouch|nexian|samsung|^sam\-|s[cg]h|^lge|ericsson|philips|sagem|wellcom|bunjalloo|maui|symbian|smartphone|midp|wap|phone|windows ce|iemobile|^spice|^bird|^zte\-|longcos|pantech|gionee|^sie\-|portalmmm|jig\s browser|hiptop|^ucweb|^benq|haier|^lct|opera\s*mobi|opera\*mini|320x320|240x320|176x220)/i);h.isWindow=/windows|win32/.test(g);h.isMac=/Mac/.test(g);h.isIOS=/(?:iphone|ipad|ipod)/i.test(g);h.isAndroid=/android/i.test(g);return h});BizQQWPA.define("util.pad",function(){return function(i,k,g,j){var l=g-i.length,h;if(j===false){for(h=0;h<l;h++){i+=k}}else{for(h=0;h<l;h++){i=k+i}}return i}});BizQQWPA.define("util.Bits","util.proxy,util.pad",function(e){var d=e("proxy"),f=e("pad");return function(){var a=function(c,i,j){return c.replace(new RegExp("(^[\\d]{"+i+"})\\d"),"$1#"+j).replace("#","")};var b=function(c){this.bits=c};b.prototype={pad:function(){var c=Array.prototype.slice.call(arguments);this.bits=f.apply(this,[this.bits].concat(c));return this},padLeft:function(){return d(this,this.pad)},padRight:function(){var c=Array.prototype.slice.call(arguments).push(false);return this.pad.apply(this,c)},getChar:function(c){return this.bits.charAt(c)},setChar:function(h,c){this.bits=a(this.bits,h,c);return this},reverse:function(){var c=this.bits,i=c.length;for(var j=0;j<i;j++){this.setChar(j,parseInt(c[j],2)^1)}return this}};return b}()});BizQQWPA.define("util.events",function(){var b={};b.addEvent=window.addEventListener?function(e,a,f){e.addEventListener(a,f);return e}:function(e,a,f){e.attachEvent("on"+a,f);return e};b.removeEvent=window.removeEventListener?function(e,a,f){e.removeEventListener(a,f);return e}:function(e,a,f){e.detachEvent("on"+a,f);return e};return b});BizQQWPA.define("util.onLoad","util.events",function(d){var c=d("events");return onLoad=function(a,b){b=b||window;if(/loaded|complete|undefined/.test(b.document.readyState)){a()}else{c.addEvent(b,"load",a)}return b}});BizQQWPA.define("util.offset",function(){var g=document,h=g.compatMode=="CSS1Compat",e=g.documentElement,f=g.body;return{getScrollTop:function(){return Math.max(e.scrollTop,f.scrollTop)},getClientWidth:function(){return h?e.clientWidth:f.clientWidth},getClientHeight:function(){return h?e.clientHeight:f.clientHeight}}});BizQQWPA.define("util.Panel","lang.browser,util.Style,util.className,util.events,util.offset,util.css,util.proxy",function(t){var l=t("Style"),p=t("className"),k=t("events"),s=t("offset"),r=t("browser"),q=t("css"),o=t("proxy");var n={container:document.getElementsByTagName("body")[0],template:['<div class="WPA3-CONFIRM">','<h3 class="WPA3-CONFIRM-TITLE"><%=title%></h3>','<div class="WPA3-CONFIRM-CONTENT"><%=content%></div>','<div class="WPA3-CONFIRM-PANEL"><%=buttons%></div>','<div class="WPA3-CONFIRM-CLOSE"></div>',"</div>"].join(""),buttonTemplate:['<a href="javascript:;" class="WPA3-CONFIRM-BUTTON"><span class="WPA3-CONFIRM-BUTTON-PADDING WPA3-CONFIRM-BUTTON-LEFT"></span><span class="WPA3-CONFIRM-BUTTON-TEXT"><%=text%></span><span class="WPA3-CONFIRM-BUTTON-PADDING WPA3-CONFIRM-BUTTON-RIGHT"></span></a>'].join(""),cssText:[".WPA3-CONFIRM { z-index:2147483647; width:285px; height:141px; margin:0; background:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAR0AAACNCAMAAAC9pV6+AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyBpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMC1jMDYwIDYxLjEzNDc3NywgMjAxMC8wMi8xMi0xNzozMjowMCAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNSBXaW5kb3dzIiB4bXBNTTpJbnN0YW5jZUlEPSJ4bXAuaWlkOjU5QUIyQzVCNUIwQTExRTJCM0FFRDNCMTc1RTI3Nzg4IiB4bXBNTTpEb2N1bWVudElEPSJ4bXAuZGlkOjU5QUIyQzVDNUIwQTExRTJCM0FFRDNCMTc1RTI3Nzg4Ij4gPHhtcE1NOkRlcml2ZWRGcm9tIHN0UmVmOmluc3RhbmNlSUQ9InhtcC5paWQ6NTlBQjJDNTk1QjBBMTFFMkIzQUVEM0IxNzVFMjc3ODgiIHN0UmVmOmRvY3VtZW50SUQ9InhtcC5kaWQ6NTlBQjJDNUE1QjBBMTFFMkIzQUVEM0IxNzVFMjc3ODgiLz4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz6QoyAtAAADAFBMVEW5xdCkvtNjJhzf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) no-repeat;}",".WPA3-CONFIRM { *background-image:url(http://combo.b.qq.com/crm/wpa/release/3.3/wpa/views/panel.png);}",'.WPA3-CONFIRM * { position:static; z-index:auto; top:auto; left:auto; right:auto; bottom:auto; width:auto; height:auto; max-height:auto; max-width:auto; min-height:0; min-width:0; margin:0; padding:0; border:0; clear:none; clip:auto; background:transparent; color:#333; cursor:auto; direction:ltr; filter:; float:none; font:normal normal normal 12px "Helvetica Neue", Arial, sans-serif; line-height:16px; letter-spacing:normal; list-style:none; marks:none; overflow:visible; page:auto; quotes:none; -o-set-link-source:none; size:auto; text-align:left; text-decoration:none; text-indent:0; text-overflow:clip; text-shadow:none; text-transform:none; vertical-align:baseline; visibility:visible; white-space:normal; word-spacing:normal; word-wrap:normal; -webkit-box-shadow:none; -moz-box-shadow:none; -ms-box-shadow:none; -o-box-shadow:none; box-shadow:none; -webkit-border-radius:0; -moz-border-radius:0; -ms-border-radius:0; -o-border-radius:0; border-radius:0; -webkit-opacity:1; -moz-opacity:1; -ms-opacity:1; -o-opacity:1; opacity:1; -webkit-outline:0; -moz-outline:0; -ms-outline:0; -o-outline:0; outline:0; -webkit-text-size-adjust:none;}',".WPA3-CONFIRM * { font-family:Microsoft YaHei,Simsun;}",".WPA3-CONFIRM .WPA3-CONFIRM-TITLE { height:40px; margin:0; padding:0; line-height:40px; color:#2b6089; font-weight:normal; font-size:14px; text-indent:80px;}",".WPA3-CONFIRM .WPA3-CONFIRM-CONTENT { height:55px; margin:0; line-height:55px; color:#353535; font-size:14px; text-indent:29px;}",".WPA3-CONFIRM .WPA3-CONFIRM-PANEL { height:30px; margin:0; padding-right:16px; text-align:right;}",".WPA3-CONFIRM .WPA3-CONFIRM-BUTTON { position:relative; display:inline-block!important; display:inline; zoom:1; width:99px; height:30px; margin-left:10px; line-height:30px; color:#000; text-decoration:none; font-size:12px; text-align:center;}",".WPA3-CONFIRM .WPA3-CONFIRM-BUTTON-FOCUS { width:78px;}",".WPA3-CONFIRM .WPA3-CONFIRM-BUTTON .WPA3-CONFIRM-BUTTON-TEXT { line-height:30px; text-align:center; cursor:pointer;}",".WPA3-CONFIRM-CLOSE { position:absolute; top:7px; right:7px; width:10px; height:10px; cursor:pointer;}"].join(""),buttons:[{isFocus:true,text:"\u786E\u8BA4",events:{click:function(){this.remove()}}},{text:"\u53D6\u6D88",events:{click:function(){this.remove()}}}],modal:true};l.add("_WPA_CONFIRM_STYLE",n.cssText);var m=function(a){this.opts=a;this.render()};m.prototype={render:function(){var b=this,a=this.opts,c=this.container=a.container||document.getElementsByTagName("body")[0];var d=a.template||n.template,e="WPA_BUTTONS_PLACE"+(+new Date()%100)+Math.floor(Math.random()*100);d=d.replace(/<%=title%>/g,a.title||"").replace(/<%=content%>/g,a.content||"").replace(/<%=buttons%>/g,'<div id="'+e+'"></div>');var f=document.createElement("div"),g;f.innerHTML=d;this.$el=g=f.firstChild;k.addEvent(g.lastChild,"click",function(){b.remove();a.onClose&&a.onClose()});(function(){try{c.appendChild(g)}catch(h){setTimeout(arguments.callee,1);return}if(a.modal||n.modal){b.renderModal()}b.renderButtons(e);b.setCenter()})()},renderButtons:function(f){var c=document.getElementById(f),y=c.parentNode;y.removeChild(c);var h=this.opts.buttons||n.buttons,e=this.opts.buttonTemplate||n.buttonTemplate,i=document.createElement("div"),a,g,j;for(var b=0,d=h.length;b<d;b++){g=h[b];i.innerHTML=e.replace("<%=text%>",g.text);a=i.firstChild;g.isFocus&&p.addClass(a,"WPA3-CONFIRM-BUTTON-FOCUS");if(g.events){j=g.events;for(var x in j){if(j.hasOwnProperty(x)){k.addEvent(a,x,o(this,j[x]))}}}y.appendChild(a)}},renderModal:function(){var a=this.container,g=q(a,"width"),b=q(a,"height"),d=q(a,"overflow");var c=document.createElement("div"),f={position:"fixed",top:0,left:0,zIndex:2147483647,width:s.getClientWidth()+"px",height:s.getClientHeight()+"px",backgroundColor:"black",opacity:0.3,filter:"alpha(opacity=30)"};var e=document.compatMode==="BackCompat";if((r.msie&&parseInt(r.version,10)<7)||e){f.position="absolute";setInterval(o(c,function(){this.style.top=s.getScrollTop()+"px"}),128)}q(c,f);a.insertBefore(c,this.$el);this.modal=c;k.addEvent(window,"resize",o(c,function(){q(this,{width:s.getClientWidth()+"px",height:s.getClientHeight()+"px"})}))},show:function(){this.css("display","block");this.modal&&q(this.modal,"display","block");return this},hide:function(){this.css("display","none");this.modal&&q(this.modal,"display","none");return this},remove:function(){this.$el.parentNode.removeChild(this.$el);this.modal&&this.modal.parentNode.removeChild(this.modal);return this},css:function(){var a=[this.$el].concat(Array.prototype.slice.call(arguments));return q.apply(this,a)},setCenter:function(){this.css({position:"absolute",top:"50%",left:"50%"});var c={position:"fixed",marginLeft:"-"+this.outerWidth()/2+"px",marginTop:"-"+this.outerHeight()/2+"px"};var b=document.compatMode==="BackCompat";if((r.msie&&parseInt(r.version,10)<7)||b){c.position="absolute";c.marginTop=0;var a=c.top=(s.getClientHeight()-this.outerHeight())/2;setInterval(o(this.$el,function(){this.style.top=s.getScrollTop()+a+"px"}),128)}this.css(c)},outerWidth:function(){return this.$el.offsetWidth},outerHeight:function(){return this.$el.offsetHeight}};return m});