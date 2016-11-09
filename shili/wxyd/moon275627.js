!function(){
var e=function(){
!function(){
var e={},o={},t={};
e.COMBO_UNLOAD=0,e.COMBO_LOADING=1,e.COMBO_LOADED=2;
var n=function(e,t,n){
if(!o[e]){
o[e]=n;
for(var r=3;r--;)try{
moon.setItem(moon.prefix+e,n.toString()),moon.setItem(moon.prefix+e+"_ver",moon_map[e]);
break;
}catch(a){
moon.clear();
}
}
},r=function(e){
if(!e||!o[e])return null;
var n=o[e];
return"function"!=typeof n||t[e]||(n=o[e]=n(r),t[e]=!0),n;
};
e.combo_status=e.COMBO_UNLOAD,e.run=function(){
var o=e.run.info,t=o&&o[0],n=o&&o[1];
if(t&&e.combo_status==e.COMBO_LOADED){
var a=r(t);
n&&n(a);
}
},e.use=function(o,t){
e.run.info=[o,t],e.run();
},window.define=n,window.seajs=e;
}(),function(e){
function o(e,o,n){
if("object"==typeof e){
var r=Object.prototype.toString.call(e).replace(/^\[object (.+)\]$/,"$1");
if(n=n||e,"Array"==r){
for(var a=0,i=e.length;i>a;++a)if(o.call(n,e[a],a,e)===!1)return;
}else{
if("Object"!==r&&t!=e)throw"unsupport type";
if(t==e){
for(var a=e.length-1;a>=0;a--){
var c=t.key(a),s=t.getItem(c);
if(o.call(n,s,c,e)===!1)return;
}
return;
}
for(var a in e)if(e.hasOwnProperty(a)&&o.call(n,e[a],a,e)===!1)return;
}
}
}
var t=e.localStorage,n=document.head||document.getElementsByTagName("head")[0],r={
prefix:"__MOON__",
loaded:[],
unload:[],
hit_num:0,
mod_num:0,
init:function(){
r.loaded=[],r.unload=[];
var n,a,i;
if(-1!=location.search.indexOf("no_moon=1")&&r.clear(),t){
var c=1*t.getItem(r.prefix+"clean_time"),s=+new Date;
if(s-c>=1296e6){
r.clear();
try{
!!t&&t.setItem(r.prefix+"clean_time",+new Date);
}catch(u){}
}
}
o(moon_map,function(o,c){
if(a=r.prefix+c,i=!!o&&o.replace(/^http(s)?:\/\/res.wx.qq.com/,""),n=!!t&&t.getItem(a),
version=!!t&&(t.getItem(a+"_ver")||"").replace(/^http(s)?:\/\/res.wx.qq.com/,""),
r.mod_num++,n&&i==version)try{
var s="//# sourceURL="+c+"\n//@ sourceURL="+c;
e.eval.call(e,'define("'+c+'",[],'+n+")"+s),r.hit_num++;
}catch(u){
r.unload.push(i.replace(/^http(s)?:\/\/res.wx.qq.com/,""));
}else r.unload.push(i.replace(/^http(s)?:\/\/res.wx.qq.com/,""));
}),r.load(r.genUrl());
},
genUrl:function(){
var e=r.unload;
if(!e||e.length<=0)return[];
for(var o,t,n="",a=[],i={},c=-1!=location.search.indexOf("no_moon=2"),s=0,u=e.length;u>s;++s)/^\/(.*?)\//.test(e[s]),
RegExp.$1&&(t=RegExp.$1,n=i[t],n?(o=n+","+e[s],o.length>1024||c?(a.push(n),n=location.protocol+"//res.wx.qq.com"+e[s],
i[t]=n):(n=o,i[t]=n)):(n=location.protocol+"//res.wx.qq.com"+e[s],i[t]=n));
for(var l in i)i.hasOwnProperty(l)&&a.push(i[l]);
return a;
},
load:function(e){
if(!e||e.length<=0)return seajs.combo_status=seajs.COMBO_LOADED,void seajs.run();
seajs.combo_status=seajs.COMBO_LOADING;
var t=0;
o(e,function(o){
var r=document.createElement("script");
r.src=o,r.type="text/javascript",r.async=!0,"undefined"!=typeof moon_crossorigin&&moon_crossorigin&&r.setAttribute("crossorigin",!0),
r.onload=r.onreadystatechange=function(){
!r||r.readyState&&!/loaded|complete/.test(r.readyState)||(t++,r.onload=r.onreadystatechange=null,
t==e.length&&(seajs.combo_status=seajs.COMBO_LOADED,seajs.run()));
},n.appendChild(r);
});
},
setItem:function(e,o){
!!t&&t.setItem(e,o);
},
clear:function(){
t&&o(t,function(e,o){
~o.indexOf(r.prefix)&&t.removeItem(o);
});
}
};
window.moon=r;
}(window),window.moon.init();
};
e(),moon.setItem(moon.prefix+"biz_wap/moon.js",e.toString());
}();