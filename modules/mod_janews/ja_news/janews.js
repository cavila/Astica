/*------------------------------------------------------------------------
# JA Larix  for Joomla 1.5 - Version 1.4 - Licence Owner JA130602
# ------------------------------------------------------------------------
# Copyright (C) 2004-2008 J.O.O.M Solutions Co., Ltd. All Rights Reserved.
# @license - Copyrighted Commercial Software
# Author: J.O.O.M Solutions Co., Ltd
# Websites:  http://www.joomlart.com -  http://www.joomlancers.com
# This file may not be redistributed in whole or significant part.
-------------------------------------------------------------------------*/
jahl.splitter = "5bd713552b1db9d703aa2e2963cc3733";

var xmlhttp;
if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
	try {
		xmlhttp = new XMLHttpRequest();
	} catch (e) {
		xmlhttp=false;
	}
}
jahl.showNews = function(news, total) {
	var url = 'modules/mod_janews/ja_news/headlineloader.php?news=' + news + '&total=' + total;
	if (window.MooTools)
	{
			if(!jahl.cachearray[news]){
				new Ajax(url,{method:'get',onComplete:jahl.handleHeadlineResponseMoo}).request(); 
			}else{
				jahl.handleHeadlineResponseMoo(null);
			}
	} else {
		if (xmlhttp.readyState != 0 && xmlhttp.readyState != 4) return;
		xmlhttp.open('get', url, true);
		xmlhttp.onreadystatechange = jahl.handleHeadlineResponse;
		xmlhttp.send(null);
	}
	document.getElementById("loading-indicator").style.display = "block";
	jahl.current = news;
	clearTimeout(jahl.timer);
}

jahl.handleHeadlineResponse = function() {
	if(xmlhttp.readyState == 4){
		if (xmlhttp.status == 200){
			jahl.text = xmlhttp.responseText;
			jahl.fadeOut();
		}
	}
}

jahl.handleHeadlineResponseMoo = function (request) {
			if (request)
			{
				jahl.cachearray[jahl.current] = request;
			}else{
				request = jahl.cachearray[jahl.current];
			}
			jahl.text = request;
			jahl.fadeOut();
}

jahl.div2show = "jahl-newsitem";

if (window.ActiveXObject) window.ie = window[window.XMLHttpRequest ? 'ie7' : 'ie6'] = true;
else if (document.childNodes && !document.all && !navigator.taintEnabled) window.khtml = true;
else if (document.getBoxObjectFor != null) window.gecko = true;

function jahlInit() {
	jahl.cachearray = new Array();
	jahl.ani = new jahl.effect(document.getElementById(jahl.div2show), {duration: 300, opacity: true});
	if (jahl.autoroll) jahl.timer = setTimeout(jahl.autoRoll, jahl.delaytime*1000);
}

jahl.addEvent = function(obj, evType, fn){
	if (obj.addEventListener) {
		obj.addEventListener(evType, fn, false);
		return true;
	} else if (obj.attachEvent) {
		var r = obj.attachEvent("on"+evType, fn);
		return r;
	} else {
		return false;
	}
}

jahl.addEvent( window, 'load', jahlInit );

jahl.fadeOut = function() {
	jahl.ani.custom(jahl.ani.p.scrollHeight,0);
	jahl.fadeIn();
}

jahl.fadeIn = function() {
	if (jahl.ani.timer) {
		setTimeout(jahl.fadeIn, 20);
		return;
	}
	update = [];
	update = jahl.text.split(jahl.splitter);

	document.getElementById(jahl.div2show).innerHTML = update[0];
	jahl.ani.custom(0,jahl.ani.p.scrollHeight);
	document.getElementById("loading-indicator").style.display = "none";
	document.getElementById("jahl-indicator").innerHTML = "" + jahl.current + "/" + jahl.total;
	document.getElementById("jahl-next").title = "Next: " + update[1];
	document.getElementById("jahl-prev").title = "Previous: " + update[2];
	if (jahl.autoroll) jahl.timer = setTimeout(jahl.autoRoll, jahl.delaytime*1000);
}

jahl.switchRoll = function() {
	switcher = document.getElementById("jahl-switcher");
	if (jahl.autoroll) {
		switcher.src = "modules/mod_janews/ja_news/play.png";
		switcher.alt = "Play";
		switcher.title = "Play";
		jahl.autoroll = false;
		clearTimeout(jahl.timer);
	} else {
		switcher.src ="modules/mod_janews/ja_news/pause.png";
		switcher.alt = "Pause";
		switcher.title = "Pause";
		jahl.autoroll = true;
		jahl.timer = setTimeout(jahl.autoRoll, jahl.delaytime*1000);
	}

	jahl.setcookie("JAHL-AUTOROLL", jahl.autoroll ? 1 : 0, 365, "/");
}

jahl.autoRoll = function() {
	if (jahl.current == jahl.total) next = 1;
	else next = jahl.current+1;

	jahl.showNews(next, jahl.total);
}

jahl.setcookie = function(name,value,expires,path,domain,secure) {
	var date = new Date();
	if (expires) {
		date.setTime(date.getTime() + expires*24*60*60*1000)
		expires = date;
	}
	var cookieString = name + "=" +escape(value) +
		( (expires) ? ";expires=" + expires.toGMTString() : "") +
		( (path) ? ";path=" + path : "") +
		( (domain) ? ";domain=" + domain : "") +
		( (secure) ? ";secure" : "");
	document.cookie = cookieString;
}

Function.prototype.jahlbind = function(object) {
	var __method = this;
	return function() {
		return __method.apply(object, arguments);
	}
}

jahl.effect = new Object();
jahl.effect = function(p, options) {
	this.p = p;
	this.options = options;
	this.timer = null;
	this.p.style.overflow = "hidden";
	this.p.setOpacity = function(opacity){
		if (opacity == 0){
			if(this.style.visibility != "hidden") this.style.visibility = "hidden";
		} else {
			if(this.style.visibility != "visible") this.style.visibility = "visible";
		}
		if (window.ie) {
			this.style.filter = "alpha(opacity=" + opacity*100 + ")";
			this.style.zoom = 1;
		}
		this.style.opacity = opacity;
	};

	this.step = function() {
		var time = (new Date).getTime();
		if (time > this.options.duration + this.startTime) {
			this.hnow = this.to;
			if (this.options.opacity) {
				if (this.from > this.to) this.onow = 0;
				else this.onow = 1;
			}
			clearInterval(this.timer);
			this.timer = null;
		} else {
			var Tpos = (time - this.startTime) / (this.options.duration);
			this.hnow = Tpos*(this.to-this.from) + this.from;
			if (this.options.opacity) {
				if (this.from > this.to) this.onow = 1 - Tpos;
				else this.onow = Tpos;
			}
		}
		this.change();
	};

	this.custom = function(from, to) {
		if (this.timer != null) return;
		this.from = from;
		this.to = to;
		this.startTime = (new Date).getTime();
		this.timer = setInterval(this.step.jahlbind(this), 13);
	};

	this.change = function() {
		this.p.setOpacity(this.onow);
	};

};
