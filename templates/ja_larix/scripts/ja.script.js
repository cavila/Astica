/*------------------------------------------------------------------------
# JA Larix  for Joomla 1.5 - Version 1.4 - Licence Owner JA130602
# ------------------------------------------------------------------------
# Copyright (C) 2004-2008 J.O.O.M Solutions Co., Ltd. All Rights Reserved.
# @license - Copyrighted Commercial Software
# Author: J.O.O.M Solutions Co., Ltd
# Websites:  http://www.joomlart.com -  http://www.joomlancers.com
# This file may not be redistributed in whole or significant part.
-------------------------------------------------------------------------*/
/* Hack remove value inpu of Vm */
window.addEvent('domready', function(){
	var vm_inputs = getElementsByClass ("addtocart_button", null, "INPUT");	
	var vm_inputs1 = getElementsByClass ("addtocart_button_module", null, "INPUT");	
	if ((!vm_inputs || !vm_inputs.length) && (!vm_inputs1 || !vm_inputs1.length)) return;
	for (var i=0; i<vm_inputs.length; i++)
	{
		var vm_input = vm_inputs[i];
		vm_input.value = "";
	}
	
	if (!vm_inputs1 || !vm_inputs1.length) return;
	for (var i=0; i<vm_inputs1.length; i++)
	{
		var vm_input1 = vm_inputs1[i];
		vm_input1.value = "";
	}
									 
});

function switchFontSize (ckname,val){
	var bd = $E('BODY');
	switch (val) {
		case 'inc':
			if (CurrentFontSize+1 < 7) {
				bd.removeClass('fs'+CurrentFontSize);
				CurrentFontSize++;
				bd.addClass('fs'+CurrentFontSize);
			}		
		break;
		case 'dec':
			if (CurrentFontSize-1 > 0) {
				bd.removeClass('fs'+CurrentFontSize);
				CurrentFontSize--;
				bd.addClass('fs'+CurrentFontSize);
			}		
		break;
		default:
			bd.removeClass('fs'+CurrentFontSize);
			CurrentFontSize = val;
			bd.addClass('fs'+CurrentFontSize);		
	}
	Cookie.set(ckname, CurrentFontSize,{duration:365});
}

function switchTool (ckname, val) {
	createCookie(ckname, val, 365);
	window.location.reload();
}

function createCookie(name,value,days) {
  if (days) {
    var date = new Date();
    date.setTime(date.getTime()+(days*24*60*60*1000));
    var expires = "; expires="+date.toGMTString();
  }
  else expires = "";
  document.cookie = name+"="+value+expires+"; path=/";
}

String.prototype.trim = function() { return this.replace(/^\s+|\s+$/g, ""); };

function changeToolHilite(oldtool, newtool) {
	if (oldtool != newtool) {
		if (oldtool) {
			oldtool.src = oldtool.src.replace(/-hilite/,'');
		}
		newtool.src = newtool.src.replace(/.gif$/,'-hilite.gif');
	}
}

//addEvent - attach a function to an event
function jaAddEvent(obj, evType, fn){ 
 if (obj.addEventListener){ 
   obj.addEventListener(evType, fn, false); 
   return true; 
 } else if (obj.attachEvent){ 
   var r = obj.attachEvent("on"+evType, fn); 
   return r; 
 } else { 
   return false; 
 } 
}

function equalHeight (elems){
	if (!elems) return;
	var maxh = 0;
	for (var i=0; i<elems.length; i++)
	{
		if (elems[i] && elems[i].scrollHeight > maxh) maxh = elems[i].scrollHeight;
	}

	for (i=0; i<elems.length; i++){
		if (elems[i]) elems[i].parentNode.style.height = maxh + "px";
	}
}

function adjustVMCatList (className, cols){
	var vmCatList = getDivElemsByClass (document, className);
	k = 0;
	var items = new Array();
	var vmCatProduct = null;
	var objsep = null;
	var divwidth = Math.floor(998/cols)/10 + "%";
	var p;
	for (var i=0; i<vmCatList.length; i++)
	{
		vmCatProduct = vmCatList[i];
		p = vmCatProduct.parentNode;
		p.style.width = divwidth;
		p.style.margin = "0";
		items[k] = vmCatProduct;
		k++;
		if (i==0)
		{
			objsep = document.createElement("SPAN");
			objsep.className = "ja-separator ja-firstsep";
			p.parentNode.insertBefore(objsep, p);
		}
		if (k<cols && i < vmCatList.length - 1)
		{
			vmCatProduct.className += " ja-rightseparator";
		}else{
			objsep = document.createElement("SPAN");
			objsep.className = "ja-separator";
			p.parentNode.insertBefore(objsep, p.nextSibling.nextSibling);
			if (items.length > 1)
			{
				equalHeight (items);
			}
			items = new Array();
			k = 0;
		}
	}
}

function getElem (id) {
	var obj = document.getElementById (id);
	if (!obj) return null;
	var divs = obj.getElementsByTagName ('div');
	if (divs && divs.length >= 1) return divs[divs.length - 1];
	return null;
}

function getFirstDiv (id) {
	var obj = document.getElementById (id);
	if (!obj) return null;
	var divs = obj.getElementsByTagName ('div');
	if (divs && divs.length >= 1) return divs[0];
	return obj;
}

function getElementsByClass(searchClass,node,tag) {
	var classElements = new Array();
	var j = 0;
	if ( node == null )
		node = document;
	if ( tag == null )
		tag = '*';
	var els = node.getElementsByTagName(tag);
	var elsLen = els.length;
	var pattern = new RegExp('(^|\\s)'+searchClass+'(\\s|$)');
	for (var i = 0; i < elsLen; i++) {
		if ( pattern.test(els[i].className) ) {
			classElements[j] = els[i];
			j++;
		}
	}
	//alert(searchClass + j);
	return classElements;
}

function getDivElemsByClass (parent, className) {
	var objs = parent.getElementsByTagName ('div');
	var elems = new Array();
	var j = 0;
	for (var i=0; i<objs.length; i++)
	{
		if (instr(objs[i].className, className) )
		{
			elems[j++] = objs[i];
		}
	}
	return elems;
}

function instr(str, item){
	var arr = str.split(" ");
	for (var i = 0; i < arr.length; i++){
		if (arr[i] == item) return true;
	}
	return false;
}

function equalHeightInit (){
	var ja_spl = document.getElementById('ja-botsl');
	if (!ja_spl) return;
	var jablocks = getElementsByClass ("moduletable", ja_spl, "DIV");
	equalHeight (jablocks);
}

jaAddEvent (window, 'load', equalHeightInit);

function fixIE() {
	var objs = getElementsByClass ("createdate", null, "TD");
	if (objs) {
		for (var i=0; i<objs.length; i++){
			objs[i].innerHTML = "<span>" + objs[i].innerHTML + "</span>";
		}
	}
}
jaAddEvent (window, 'load', fixIE);
