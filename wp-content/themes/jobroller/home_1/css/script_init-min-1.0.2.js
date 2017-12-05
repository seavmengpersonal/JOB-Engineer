"use strict";(function(){function b(c){return c<10?("0"+c):c}Date.prototype.months=["January","February","March","April","May","June","July","August","September","October","November","December"];Date.prototype.monthKH=["មករា","គុម្ភៈ","មិនា","មេសា","ឧសភា","មិថុនា","កក្កដា","សីហា","កញ្ញា","តុលា","វិច្ឆិការ","ធ្នូ"];Date.prototype.shortMonths=["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];Date.prototype.shortDate=function(g,e){var e=e||false;g=g||(LANG||"en");var c=g=="en"?this.shortMonths:this.monthKH;var f=a(this,e);var d=f.date+"-"+c[f.month]+"-"+f.year;if(g=="kh"){d=f.date+" "+c[f.month]+" "+f.year;d=d.khmerDigit()}return d};Date.prototype.chronoWord={now:"Just now",sec:"second",min:"minute",hour:"hour",day:"day",month:"month",year:"year"};Date.prototype.chronoWordKH={now:"អម្បាញ់មិញ",sec:"វិនាទី",min:"នាទី",hour:"ម៉ោង",day:"ថ្ងៃ",month:"ខែ",year:"ឆ្នាំ"};Date.prototype.chrono=function(e){var e=e||"en";var h=new Date();var i=60*1000;var k=i*60;var j=k*24;var f=j*30;var d=j*365;var c=e=="en"?this.chronoWord:this.chronoWordKH;var l=h-this;var g="";var m="";if(l<i){return c.now}else{if(l<k){g=Math.round(l/i);m=c.min}else{if(l<j){g=Math.round(l/k);m=c.hour}else{if(l<f){g=Math.round(l/j);m=c.day}else{if(l<d){g=Math.round(l/f);m=c.month}else{g=Math.round(l/d);m=c.year}}}}}if(e=="en"){m=g>1?m.pluralize():m}else{if(e=="kh"){g=(g+"").khmerDigit();return g+""+m}}return g+" "+m};var a=function(f,e){e=e||false;var g,c,h;if(e){g=f.getUTCDate();c=f.getUTCMonth();h=f.getUTCFullYear()}else{g=f.getDate();c=f.getMonth();h=f.getFullYear()}return{date:g,month:c,year:h}}})();"use strict";var Locale=Locale||{};(function(){Locale.get=function(b){return Localized[b.toLowerCase()]||b};var a=a||"en";Locale.lang=a})();"use stric";(function(){String.prototype.cleanText=i;String.prototype.cleanURL=o;String.prototype.deparam=d;String.prototype.formatPhone=u;String.prototype.htmlDecode=s;String.prototype.khmerDigit=j;String.prototype.lead=x;String.prototype.padRight=n;String.prototype.parseDate=h;String.prototype.parseJSON=function(){return JSON.parse(this)};String.prototype.pluralize=a;String.prototype.queryString=b;String.prototype.stripTags=z;String.prototype.tail=function(A){return this+A};String.prototype.toCurrency=q;String.prototype.toCamelCase=m;String.prototype.toUnderscoreCase=r;var g=function(B){var C="";for(var A in B){C+="&"+A+"="+B[A]}C=C.substr(1);return decodeURI(C)};function b(E){E=(E||"").trim();if(E.length<3){return this}var C=this.split("?");if(C.length==1){return C[0]+"?"+E}var D=C[1].deparam();var B=E.deparam();for(var A in B){D[A]=B[A]}return C[0]+"?"+g(D)}function l(C){var B="";var A="";switch(C){case"[":B="[";A="]";break;case"]":B="[ ";A=" ]";break;case"(":B="(";A=")";break;case")":B="( ";A=" )";break;case"{":B="{";A="}";break;case"}":B="{ ";A=" }";break;case"<":B="<";A=">";break;case">":B="< ";A=" >";break;default:B=C;A=C}return B+this+A}function u(D){D=D||"855";var C=this.substr(1,2);var B=this.substr(3,3);var A=this.substr(6);return"+("+D+"-"+C+") "+B+" "+A}function n(D){var A=arguments.length==1?2:arguments[1];var C="";for(var B=0;B<A;B++){C+=D}return this+C}function q(F,C){var D=F||"";var B=C||2;var A=this.split(".");var E=A.length==1?0:A[1];return D+" "+A[0]+"."+E.toString().padRight("0",10).substr(0,B)}function x(B,A){A=A||1;B=B||"0";return B.toString().repeat(A-this.length)+this}function o(A,B){A=A||40;B=B||"view_detail";var C=/[^a-zA-Z0-9]/gi;var D=this.stripTags().replace(C,"_").replace(/_{1,}/gi,"_").toLowerCase();D=D.substr(0,A);D=D.replace(/(^_)|(_$)/g,"");return D==""?B:D}function z(){return this.replace(/(<([^>]+)>)/ig,"")}var p={"(quiz)$":"$1zes","^(ox)$":"$1en","([m|l])ouse$":"$1ice","(matr|vert|ind)ix|ex$":"$1ices","(x|ch|ss|sh)$":"$1es","([^aeiouy]|qu)y$":"$1ies","(hive)$":"$1s","(?:([^f])fe|([lr])f)$":"$1$2ves","(shea|lea|loa|thie)f$":"$1ves","sis$":"ses","([ti])um$":"$1a","(tomat|potat|ech|her|vet)o$":"$1oes","(bu)s$":"$1ses","(alias)$":"$1es","(octop)us$":"$1i","(ax|test)is$":"$1es","(us)$":"$1es","([^s]+)$":"$1s"};var k={"(quiz)zes$":"$1","(matr)ices$":"$1ix","(vert|ind)ices$":"$1ex","^(ox)en$":"$1","(alias)es$":"$1","(octop|vir)i$":"$1us","(cris|ax|test)es$":"$1is","(shoe)s$":"$1","(o)es$":"$1","(bus)es$":"$1","([m|l])ice$":"$1ouse","(x|ch|ss|sh)es$":"$1","(m)ovies$":"$1ovie","(s)eries$":"$1eries","([^aeiouy]|qu)ies$":"$1y","([lr])ves$":"$1f","(tive)s$":"$1","(hive)s$":"$1","(li|wi|kni)ves$":"$1fe","(shea|loa|lea|thie)ves$":"$1f","(^analy)ses$":"$1sis","((a)naly|(b)a|(d)iagno|(p)arenthe|(p)rogno|(s)ynop|(t)he)ses$":"$1$2sis","([ti])a$":"$1um","(n)ews$":"$1ews","(h|bl)ouses$":"$1ouse","(corpse)s$":"$1","(us)es$":"$1","s$":""};var v={move:"moves",foot:"feet",goose:"geese",sex:"sexes",child:"children",man:"men",tooth:"teeth",person:"people"};var f=["sheep","fish","deer","series","species","money","rice","information","equipment"];function a(){if(f.indexOf(this.toLowerCase())>=0){return this}for(var D in v){var C=new RegExp(D+"$","i");var A=v[D];if(C.test(this)){return this.replace(C,A)}}for(var B in p){var C=new RegExp(B,"i");if(C.test(this)){return this.replace(C,p[B])}}return this}function y(B){var A=[];for(var C in B){A.push(C)}return new RegExp("("+A.join("|")+")","g")}var t={"0":"០","1":"១","2":"២","3":"៣","4":"៤","5":"៥","6":"៦","7":"៧","8":"៨","9":"៩"};var c=y(t);function j(){return this.replace(c,function(B,A){return t[A]})}function y(B){var A=[];for(var C in B){A.push(C)}return new RegExp("("+A.join("|")+")","g")}var e={"&amp;":"&","&gt;":">","&lt;":"<","&quot;":'"',"&#39;":"'"};var w=y(e);function s(){return this.replace(w,function(B,A){return e[A]})}function m(){return this.replace(/\_[a-z]/g,function(B,A){return B.toUpperCase().substr(1)})}function r(){return this.replace(/[A-Z]+[a-z]*/g,function(B,A){return"_"+B.toLowerCase()})}function d(){var B=this.split("&");var A={};B.forEach(function(D){var C=D.split("=");if(C[1]!=""){A[C[0]]=decodeURIComponent(C[1])}});return A}function i(){var A=[/\&\w{2,};/g,/[\❤\☻\☻\®\¶\©\«\»]/g,/([\=|\+|\*|\!|\@|\/|\.|\#|\~|\$|\,|\^|\_|\;])\1+/g,/(\[\s*\])/g];var B=this.trim();A.forEach(function(C){B=B.replace(C,"")});return B}function h(){if(this==null){return false}var D=this.split(" ");var B=D[1];D=D[0].split("-");var A=new Date();if(parseInt(D[0])<(A.getFullYear()-2)){return false}else{var C=D[1]+"/"+D[2]+"/"+D[0]+" "+B;return new Date(C)}}})();"use strict";var History={};(function(){var b="";var a={};History={init:function(c){var d=this;var c=c||{};b=c.baseURL||window.location.href;window.addEventListener("popstate",function(e){d.update(e.state)})},pushState:function(d){var c=d.url||window.location.href;c=c.replace(b,"");c=b+c;var e={title:d.title||document.title,url:c,index:history.length};a[e.index]=d.handler;document.title=d.title;history.pushState(e,e.title,e.url)},update:function(c){if(c==null){return}if(String(a[c.index])!="undefined"){Math.random();document.title=c.title;a[c.index]()}},replaceState:function(c){c=c||{};c.title=c.title||document.title;c.url=c.url||window.location.href;a[0]=c.handler;history.replaceState({title:c.title,index:0},c.title,c.url)}}})();