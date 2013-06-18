
var xmlHttp0;
var xmlHttp1;
var xmlHttp2;
var xmlHttp3;
var xmlHttp4;
var xmlHttp5;
var xmlHttp6;
var xmlHttp7;
var xmlHttp8;
var xmlHttp9;
var xmlHttp10;
var xmlHttp11;
var xmlHttp12;
var xmlHttp13;
var xmlHttp14;
var xmlHttp15;
var xmlHttp16;
var g_divname0;
var g_divname1;
var g_divname2;
var g_divname3;
var g_divname4;
var g_divname5;
var g_divname6;
var g_divname7;
var g_divname8;
var g_divname9;
var g_divname10;
var g_divname11;
var g_divname12;
var g_divname13;
var g_divname14;
var g_divname15;
var g_divname16;
var ajCallback0;
var ajCallback1;
var ajCallback2;
var ajCallback3;
var ajCallback4;
var ajCallback5;
var ajCallback6;
var ajCallback7;
var ajCallback8;
var ajCallback9;
var ajCallback10;
var ajCallback11;
var ajCallback12;
var ajCallback13;
var ajCallback14;
var ajCallback15;
var ajCallback16;

var ajaxIndex = 0;

function showHTML(divname,url,cb)
{ 
	tmpdiv = findObj(divname);
	if(tmpdiv==null){
		alert('Not found '+divname);
		return;
	}
	document.getElementById(divname).innerHTML = "<img src=\"../resource/images/loader.gif\" width=16 height=16 />";

	
	switch(ajaxIndex%17){
		case 0 : g_divname0 = divname;xmlHttp0=GetXmlHttpObject();xmlHttp=xmlHttp0;
			xmlHttp0.onreadystatechange=stateChangedHTML0;ajCallback0=cb;break; 
		case 1 : g_divname1 = divname;xmlHttp1=GetXmlHttpObject();xmlHttp=xmlHttp1;
			xmlHttp1.onreadystatechange=stateChangedHTML1;ajCallback1=cb;break; 
		case 2 : g_divname2 = divname;xmlHttp2=GetXmlHttpObject();xmlHttp=xmlHttp2;
			xmlHttp2.onreadystatechange=stateChangedHTML2;ajCallback2=cb;break; 
		case 3 : g_divname3 = divname;xmlHttp3=GetXmlHttpObject();xmlHttp=xmlHttp3;
			xmlHttp3.onreadystatechange=stateChangedHTML3;ajCallback3=cb;break; 
		case 4 : g_divname4 = divname;xmlHttp4=GetXmlHttpObject();xmlHttp=xmlHttp4;
			xmlHttp4.onreadystatechange=stateChangedHTML4;ajCallback4=cb;break; 
		case 5 : g_divname5 = divname;xmlHttp5=GetXmlHttpObject();xmlHttp=xmlHttp5;
			xmlHttp5.onreadystatechange=stateChangedHTML5;ajCallback5=cb;break; 
		case 6 : g_divname6 = divname;xmlHttp6=GetXmlHttpObject();xmlHttp=xmlHttp6;
			xmlHttp6.onreadystatechange=stateChangedHTML6;ajCallback6=cb;break; 
		case 7 : g_divname7 = divname;xmlHttp7=GetXmlHttpObject();xmlHttp=xmlHttp7;
			xmlHttp7.onreadystatechange=stateChangedHTML7;ajCallback7=cb;break; 
		case 8 : g_divname8 = divname;xmlHttp8=GetXmlHttpObject();xmlHttp=xmlHttp8;
			xmlHttp8.onreadystatechange=stateChangedHTML8;ajCallback8=cb;break; 
		case 9 : g_divname9 = divname;xmlHttp9=GetXmlHttpObject();xmlHttp=xmlHttp9;
			xmlHttp9.onreadystatechange=stateChangedHTML9;ajCallback9=cb;break; 
		case 10 : g_divname10 = divname;xmlHttp10=GetXmlHttpObject();xmlHttp=xmlHttp10;
			xmlHttp10.onreadystatechange=stateChangedHTML10;ajCallback10=cb;break; 
		case 11 : g_divname11 = divname;xmlHttp11=GetXmlHttpObject();xmlHttp=xmlHttp11;
			xmlHttp11.onreadystatechange=stateChangedHTML11;ajCallback11=cb;break; 
		case 12 : g_divname12 = divname;xmlHttp12=GetXmlHttpObject();xmlHttp=xmlHttp12;
			xmlHttp12.onreadystatechange=stateChangedHTML12;ajCallback12=cb;break; 
		case 13 : g_divname13 = divname;xmlHttp13=GetXmlHttpObject();xmlHttp=xmlHttp13;
			xmlHttp13.onreadystatechange=stateChangedHTML13;ajCallback13=cb;break; 
		case 14 : g_divname14 = divname;xmlHttp14=GetXmlHttpObject();xmlHttp=xmlHttp14;
			xmlHttp14.onreadystatechange=stateChangedHTML14;ajCallback14=cb;break; 
		case 15 : g_divname15 = divname;xmlHttp15=GetXmlHttpObject();xmlHttp=xmlHttp15;
			xmlHttp15.onreadystatechange=stateChangedHTML15;ajCallback15=cb;break; 
		case 16 : g_divname16 = divname;xmlHttp16=GetXmlHttpObject();xmlHttp=xmlHttp16;
			xmlHttp16.onreadystatechange=stateChangedHTML16;ajCallback16=cb;break; 
	}
	//g_divname = divname;

	//xmlHttp=GetXmlHttpObject()
	if (xmlHttp==null)
	{
		alert ("Browser does not support HTTP Request")
		return
	}
	//var url="./test3.php"
	//url=url+"?ap="+str
	
	var mytime = "";
	mytime +="&ms="+new Date().getTime();
	
	//xmlHttp.onreadystatechange=stateChangedHTML 
	xmlHttp.open("GET",url+mytime,true)
	xmlHttp.send(null)
	ajaxIndex++;
}

function stateChangedHTML0() { if (xmlHttp0.readyState==4 || xmlHttp0.readyState=="complete"){ 
		document.getElementById(g_divname0).innerHTML=xmlHttp0.responseText;if(ajCallback0)ajCallback0(); 	} }
function stateChangedHTML1() { if (xmlHttp1.readyState==4 || xmlHttp1.readyState=="complete"){ 
		document.getElementById(g_divname1).innerHTML=xmlHttp1.responseText;if(ajCallback1)ajCallback1(); 	} }
function stateChangedHTML2() { if (xmlHttp2.readyState==4 || xmlHttp2.readyState=="complete"){ 
		document.getElementById(g_divname2).innerHTML=xmlHttp2.responseText;if(ajCallback2)ajCallback2(); 	} }
function stateChangedHTML3() { if (xmlHttp3.readyState==4 || xmlHttp3.readyState=="complete"){ 
		document.getElementById(g_divname3).innerHTML=xmlHttp3.responseText;if(ajCallback3)ajCallback3(); 	} }
function stateChangedHTML4() { if (xmlHttp4.readyState==4 || xmlHttp4.readyState=="complete"){ 
		document.getElementById(g_divname4).innerHTML=xmlHttp4.responseText;if(ajCallback4)ajCallback4(); 	} }
function stateChangedHTML5() { if (xmlHttp5.readyState==4 || xmlHttp5.readyState=="complete"){ 
		document.getElementById(g_divname5).innerHTML=xmlHttp5.responseText;if(ajCallback5)ajCallback5(); 	} }
function stateChangedHTML6() { if (xmlHttp6.readyState==4 || xmlHttp6.readyState=="complete"){ 
		document.getElementById(g_divname6).innerHTML=xmlHttp6.responseText;if(ajCallback6)ajCallback6(); 	} }
function stateChangedHTML7() { if (xmlHttp7.readyState==4 || xmlHttp7.readyState=="complete"){ 
		document.getElementById(g_divname7).innerHTML=xmlHttp7.responseText;if(ajCallback7)ajCallback7(); 	} }
function stateChangedHTML8() { if (xmlHttp8.readyState==4 || xmlHttp8.readyState=="complete"){ 
		document.getElementById(g_divname8).innerHTML=xmlHttp8.responseText;if(ajCallback8)ajCallback8(); 	} }
function stateChangedHTML9() { if (xmlHttp9.readyState==4 || xmlHttp9.readyState=="complete"){ 
		document.getElementById(g_divname9).innerHTML=xmlHttp9.responseText;if(ajCallback9)ajCallback9(); 	} }
function stateChangedHTML10() { if (xmlHttp10.readyState==4 || xmlHttp10.readyState=="complete"){ 
		document.getElementById(g_divname10).innerHTML=xmlHttp10.responseText;if(ajCallback10)ajCallback10(); 	} }
function stateChangedHTML11() { if (xmlHttp11.readyState==4 || xmlHttp11.readyState=="complete"){ 
		document.getElementById(g_divname11).innerHTML=xmlHttp11.responseText;if(ajCallback11)ajCallback11(); 	} }
function stateChangedHTML12() { if (xmlHttp12.readyState==4 || xmlHttp12.readyState=="complete"){ 
		document.getElementById(g_divname12).innerHTML=xmlHttp12.responseText;if(ajCallback12)ajCallback12(); 	} }
function stateChangedHTML13() { if (xmlHttp13.readyState==4 || xmlHttp13.readyState=="complete"){ 
		document.getElementById(g_divname13).innerHTML=xmlHttp13.responseText;if(ajCallback13)ajCallback13(); 	} }
function stateChangedHTML14() { if (xmlHttp14.readyState==4 || xmlHttp14.readyState=="complete"){ 
		document.getElementById(g_divname14).innerHTML=xmlHttp14.responseText;if(ajCallback14)ajCallback14(); 	} }
function stateChangedHTML15() { if (xmlHttp15.readyState==4 || xmlHttp15.readyState=="complete"){ 
		document.getElementById(g_divname15).innerHTML=xmlHttp15.responseText;if(ajCallback15)ajCallback15(); 	} }
function stateChangedHTML16() { if (xmlHttp16.readyState==4 || xmlHttp16.readyState=="complete"){ 
		document.getElementById(g_divname16).innerHTML=xmlHttp16.responseText;if(ajCallback16)ajCallback16(); 	} }
	
function cancelAjax()
{
	request.transport.abort();
}
function GetXmlHttpObject()
{
	var xmlHttp=null;
	try	{
		xmlHttp=new XMLHttpRequest();
	}catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
		}catch (e){
			xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
	}
	return xmlHttp;
}

//-------------------------------------------------------------------------------------------------------------
/*
var xmlHttp2;
var g_divname2;
function showHTML2(divname,url)
{ 
	g_divname2 = divname;
	document.getElementById(divname).innerHTML = "<img src=\"../resource/images/loader.gif\" width=16 height=16 />... Loading ...";
	xmlHttp2=GetXmlHttpObject()
	if (xmlHttp2==null)
	{
		alert ("Browser does not support HTTP Request")
		return
	}
	//var url="./test3.php"
	//url=url+"?ap="+str
	xmlHttp2.onreadystatechange=stateChangedHTML2 
	xmlHttp2.open("GET",url,true)
	xmlHttp2.send(null)
}

function stateChangedHTML2() 
{ 
	if (xmlHttp2.readyState==4 || xmlHttp2.readyState=="complete")
	{ 
		document.getElementById(g_divname2).innerHTML=xmlHttp2.responseText 
	} 
}
	
//-------------------------------------------------------------------------------------------------------------
//-------------------------------------------------------------------------------------------------------------
var xmlHttp3;
var g_divname3;
function showHTML3(divname,url)
{ 
	g_divname3 = divname;
	document.getElementById(divname).innerHTML = "<img src=\"../resource/images/loader.gif\" width=16 height=16 />... Loading ...";
	xmlHttp3=GetXmlHttpObject()
	if (xmlHttp3==null)
	{
		alert ("Browser does not support HTTP Request")
		return
	}
	//var url="./test3.php"
	//url=url+"?ap="+str
	xmlHttp3.onreadystatechange=stateChangedHTML3 
	xmlHttp3.open("GET",url,true)
	xmlHttp3.send(null)
}

function stateChangedHTML3() 
{ 
	if (xmlHttp3.readyState==4 || xmlHttp3.readyState=="complete")
	{ 
		document.getElementById(g_divname3).innerHTML=xmlHttp3.responseText 
	} 
}
	
//------------------------------------------------------------------------------------------------------------- */






//var poststr = "mytextarea1=" + encodeTH( document.getElementById("mytextarea1").value ) +
//"&mytextarea2=" + encodeTH( document.getElementById("mytextarea2").value );

var g_postdivname;
var http_request = false;
function showPost(divname,url, parameters) {
  http_request = false;
  g_postdivname = divname;
  document.getElementById(g_postdivname).innerHTML = "... Loading ...";
  if (window.XMLHttpRequest) { // Mozilla, Safari,...
	 http_request = new XMLHttpRequest();
	 if (http_request.overrideMimeType) {
		// set type accordingly to anticipated content type
		//http_request.overrideMimeType('text/xml');
		http_request.overrideMimeType('text/html');
	 }
  } else if (window.ActiveXObject) { // IE
	 try {
		http_request = new ActiveXObject("Msxml2.XMLHTTP");
	 } catch (e) {
		try {
		   http_request = new ActiveXObject("Microsoft.XMLHTTP");
		} catch (e) {}
	 }
  }
  if (!http_request) {
	 alert('Cannot create XMLHTTP instance');
	 return false;
  }
  
  http_request.onreadystatechange = alertContents;
  http_request.open('POST', url, true);
  http_request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  http_request.setRequestHeader("Content-length", parameters.length);
  http_request.setRequestHeader("Connection", "close");
  http_request.send(parameters);
}

function alertContents() {
  if (http_request.readyState == 4) {
	 if (http_request.status == 200) {
		//alert(http_request.responseText);
		result = http_request.responseText;
		document.getElementById(g_postdivname).innerHTML = result;            
	 } else {
		alert('There was a problem with the request.');
	 }
  }
}
   

