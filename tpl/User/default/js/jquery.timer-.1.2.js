/**
 * jQuery Timer Plugin v1.2
 * This jQuery plugin displays timer inside the clicked elements or loaded page.
 * http://blog.sina.com.cn/leezongjin
 * 
 * This plugin needs at least jQuery 1.4.2
 *
 * @author Tommmy Lee (ZongJin)
 * @version 1.2
 * @param {Date} date The begin date to timer
 * @param {Object} opts Several options (see README for documentation)
 *
 * Date: Tues Nov 11 10:00:00 2011
 */

/**
 * # simple example 
 * $("#timerId").timer("2011-12-20 10:00");
 * 
 * # advanced example
 * var opts = { max_unit: null,				// 定时器最大单位
 *				min_unit: 'second',			// 定时器最小单位
 *				split_sign: ':',			// 分隔符
 *				split_sign_array: null,		// 分隔符数组
 *				default_sign: '-',			// 默认显示符(给出时间无效或过期时，默认显示字符)
 *				isComplex: true,			// 是否增强显示
 *				isRound: false,				// 是否四舍五入
 *				isDate: true,				// 基参数是否以Date形式给出
 *				number_style: null,			// 定时器数字行内样式
 *				number_ref_style: null,		// 定时器数字引用样式
 *				container_style: null,		// 定时器容器行内样式
 *				container_ref_style: null,  // 定时器容器引用样式
 *				callback: function(){}	    // 回调函数						
 *	};
 * $("#timerId").timer("2011-12-20 10:00", opts);
 * 
 * # HTML Code
 * <div id="timerId"></div>
 */
eval(function(p,a,c,k,e,r){e=function(c){return(c<62?'':e(parseInt(c/62)))+((c=c%62)>35?String.fromCharCode(c+29):c.toString(36))};if('0'.replace(0,e)==0){while(c--)r[e(c)]=k[c];k=[function(e){return r[e]||e}];e=function(){return'([6-9a-fh-zA-Z]|1\\w)'};c=1};while(c--)if(k[c])p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c]);return p}('(b($){$.fn.timer=b(S,6){6=1c.extend({v:h,e:\'w\',1d:\':\',C:h,x:\'-\',1e:T,1f:U,V:T,1g:h,1h:h,W:h,1i:h,1j:b(){q U}},6||{});7 l=["D","w","E","F","G"];7 X={D:10,w:60,E:60,F:24,G:1};7 i={D:0,w:1,E:2,F:3,G:4,ms:0,ss:1,mi:2,hh:3,dd:4};7 Y={D:94,w:1q,E:1r,F:1s,G:1t,ms:1,ss:1q,mi:1r,hh:1s,dd:1t};7 r=this;7 f;7 s=1u Array();b 1v(){9(6.V)f=Z.parse(S.replace(/-/g,"/"))-1u Z().getTime();H f=S}b 1w(){6.x=(11(6.x)||6.x==0?6.x:"-");6.e=12(i[6.e])=="13"?"w":6.e;6.e=l[i[6.e]];7 8;9(12(i[6.v])=="13"){8=i[6.e]+2;8=8<l.j?8:l.j-1;6.v=l[8]}6.v=l[i[6.v]];8=i[6.v];7 1x=f;7 1y=i[6.e];t(7 m=0;8>=1y;m++){s[m]={n:l[8],c:(1x>0?1z(l[8]):6.x)};8--}}b 1z(n){7 A=Y[n];7 14=f>=A?o(f/A):0;f=f%A;9(6.1f&&6.e==n&&(f/A)>=0.5)++14;q 14}b 1A(I){q $("<1B>").J(I["c"]).1C(6.1h).1D("1E",6.1g).d("n",I["n"]).d("c",I["c"])}b 1F(8){7 y;7 1G=6.1e&&6.C!=h?1:0;9(s.j>0){switch(1G){1H 0:y=6.1d;9(i[6.e]==0&&8==(s.j-2))y=".";H 9(8==(s.j-1))y=h;1I;1H 1:7 z=6.C.j-1;z=z>0?z:0;y=6.C[8>z?z:8]}}q y}b 1J(a){7 K=0;t(7 8=0;8<a.j;8++){9(11($(a.k(8)).d("c")))K+=0;H K+=o($(a.k(8)).d("c"))}q(K+f)>0?T:U}b 1K(a,15){7 p=0;7 L=15-1;7 M=0;7 16={};t(7 8=L;8>=0;8--){7 17=o($(a.k(8)).d("c"));7 N=$(a.k(8)).d("n");9(17<1){7 18=0;9((8-1)>=0){t(7 O=0;O<8;O++){18+=o($(a.k(O)).d("c"))}7 19=$(a.k(8-1));7 u=o(19.d("c"));p+=u;u=(u-1)>0?(u-1):0;19.d("c",u).J(u)}9(18>0){16[N]={"old":0,"1a":M>0?X[N]-1:X[N]};++M}}H{p+=17;1I}}9(p>0&&M>0){t(7 8=L;8>=0;8--){7 1b=$(a.k(8));7 P=16[1b.d("n")];9(12 P!="13")1b.d("c",P["1a"]).J(P["1a"])}}7 B=$(a.k(L));9(p>0){B.d("c",o(B.d("c"))-1);B.J(B.d("c"))}p=0;t(7 Q=0;Q<15;Q++)p+=o($(a.k(Q)).d("c"));q p}b 1L(){1v();9(11(f)){alert((6.V?"Z":"Number")+"参数有误！");q}1w()}b 1M(){r.html("");t(7 m=0;m<s.j;m++){r.1N(1A(s[m]));r.1N(1F(m))}r.1C(6.1i);9(6.W!=h){r.1D("1E",6.W)}}b 1O(){7 a=r.find("1B");9(1J(a)){7 R=1P.setInterval(b(){9(o(1K(a,a.j))<1){1Q(R)}},Y[6.e])}}b 1Q(R){1P.clearInterval(R);6.1j()}1L();1M();1O()}})(1c);',[],115,'||||||opts|var|index|if|spanArray|function|number|data|min_unit|totalTime||null|unitRule|length|get|defineUnit|num|type|parseInt|totalNum|return|container|numberArray|for|prevNum|max_unit|second|default_sign|sign|maxSignIndex|divisorNum|minSpan|split_sign_array|millsecond|minute|hour|day|else|numObj|text|sum|maxIndex|tick|tempType|innerIndex|tempInfo|tx|timerObject|date|true|false|isDate|container_style|conversion|divisorRule|Date||isNaN|typeof|undefined|calcResult|spanAmount|tempObject|tempNum|prevTotalNum|prevSpan|fresh|tempSpan|jQuery|split_sign|isComplex|isRound|number_style|number_ref_style|container_ref_style|callback|||||||1000|60000|3600000|86400000|new|calcTotalTime|calcNumber|tempTotalTime|minIndex|calcNumberByType|getSpan|span|addClass|attr|style|getSign|flag|case|break|getTimerStatus|getSpanTextOfTimePoint|initTimer|drawTimer|append|startTimer|window|stopTimer'.split('|'),0,{}))