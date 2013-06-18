// JavaScript Document
// this function requires the following snippets:

// JavaScript/readable_MM_functions/findObj

// JavaScript/readable_MM_functions/showHideLayers

// JavaScript/events/getMouseLoc



var ie5=document.all&&document.getElementById
var ns6=document.getElementById&&!document.all

function writeit(id,text)
{
	if (document.getElementById)
	{
		x = document.getElementById(id);
		x.innerHTML = '';
		x.innerHTML = text;
	}
	else if (document.all)
	{
		x = document.all[id];
		x.innerHTML = text;
	}
	else if (document.layers)
	{
		x = document.layers[id];
		//text2 = '<P CLASS="testclass">' + text + '</P>';
		x.document.open();
		x.document.write(text);
		x.document.close();
	}
}



function moveLayerToMouseLoc(theLayer, offsetH, offsetV)

{

  var obj;

	if (document.getElementById)
	{
		 document.onMouseMove = getMouseLoc;
		x = document.getElementById(theLayer);
		x.style.left = mLoc.x +offsetH;
		x.style.top = mLoc.y +offsetV;
	}
	else if (document.all)
	{
      getMouseLoc();
      obj = document.all[theLayer].style;
      obj.pixelLeft = mLoc.x +offsetH;
      obj.pixelTop  = mLoc.y +offsetV;
	}
	else if (document.layers)
	{
      document.onMouseMove = getMouseLoc;
      obj = document.layers[theLayer];
      obj.left = mLoc.x +offsetH;
      obj.top  = mLoc.y +offsetV;
	}

/*
  if ((findObj(theLayer))!=null)

  {

    if (document.layers)  //NS

    {

      document.onMouseMove = getMouseLoc;

      obj = document.layers[theLayer];

      obj.left = mLoc.x +offsetH;

      obj.top  = mLoc.y +offsetV;

		//sprite=document.layers[theLayer].document;
		// add father layers if needed! document.layers[''+father+'']...
		//sprite.open();
		//sprite.write(content);
		//sprite.close();
//      document.all['textfield'].value=detailtext;
//	  document.all['PopUP'].innerHTML

    }

    else if (document.all)//IE

    {

      getMouseLoc();

      obj = document.all[theLayer].style;

      obj.pixelLeft = mLoc.x +offsetH;

      obj.pixelTop  = mLoc.y +offsetV;
      
//      document.all['textfield'].value=detailtext;
	  //document.all[theLayer].innerHTML = detailtext;

    }else	if (document.getElementById)	{
		
		 document.onMouseMove = getMouseLoc;
		//mLoc.x = event.pageX;
		//mLoc.y = event.pageY;

		x = document.getElementById(theLayer);
		
		//x.clientLeft = mLoc.x +offsetH;
		//x.clientTop = mLoc.y +offsetV;
		x.style.left = mLoc.x +offsetH;
		x.style.top = mLoc.y +offsetV;
		//alert(event.pageX);
		//alert(mLoc.x+' '+offsetH);
		//alert(mLoc.y+' '+offsetV);
		//x.innerHTML = '';
		//x.innerHTML = text;
		//x.style.visibility ='visible';
	}
    //showHideLayers(theLayer,'','show');

  }*/

}

// get mouse location

function Point(x,y) {  this.x = x; this.y = y; }

mLoc = new Point(-500,-500);


function getMouseLoc(e)
{

  if(!document.all)  //NS

  {

    mLoc.x = e.pageX;
    mLoc.y = e.pageY;
	//alert('');
  }
  else               //IE

  {
//alert('');
    mLoc.x = event.x + document.body.scrollLeft;

    mLoc.y = event.y + document.body.scrollTop;

  }
  

  return true;

}

//NS init:

if(!document.all){document.captureEvents(Event.MOUSEMOVE); document.onMouseMove = getMouseLoc; }// * Dependencies * 
//if(document.layers){ document.captureEvents(Event.MOUSEMOVE); document.onMouseMove = getMouseLoc; }// * Dependencies * 
//if(document.getElementById){ document.captureEvents(Event.MOUSEMOVE); document.onMouseMove = getMouseLoc; }// * Dependencies * 

// this function requires the following snippets:

// JavaScript/readable_MM_functions/findObj

//

// Accepts a variable number of arguments, in triplets as follows:

// arg 1: simple name of a layer object, such as "Layer1"

// arg 2: ignored (for backward compatibility)

// arg 3: 'hide' or 'show'

// repeat...

//

// Example: showHideLayers(Layer1,'','show',Layer2,'','hide');

function showHideLayers()

{ 

  var i, visStr, obj, args = showHideLayers.arguments;

  for (var i=0; i<(args.length-2); i+=3)

  {

    if ((obj = findObj(args[i])) != null)

    {

      visStr = args[i+2];

      if (obj.style)

      {

        obj = obj.style;

//        if(visStr == 'show') visStr = 'visible';

//        else if(visStr == 'hide') visStr = 'hidden';
        if(visStr == 'show') visStr = 'inline';

        else if(visStr == 'hide') visStr = 'none';

      }

      //obj.visibility = visStr;
      obj.display = visStr;

    }

  }

}

function iecompattest(){
	return (!window.opera && document.compatMode && document.compatMode!="BackCompat")? document.documentElement : document.body
}
var centerWind;
var oldTop;
function makeCenterScreen(wind){
	if(!wind){
		nowtop = ns6? window.pageYOffset : iecompattest().scrollTop;
		if(oldTop==nowtop)return;
		oldTop=nowtop;
		wind = centerWind;
	}
		if(!wind)return;
	  var myWidth = 0, myHeight = 0;
	  if( typeof( window.innerWidth ) == 'number' ) {
		//Non-IE
		myWidth = window.innerWidth;
		myHeight = window.innerHeight;
	  } 
	  else if( document.documentElement && ( document.documentElement.clientWidth || document.documentElement.clientHeight ) ) 		
	  {
		//IE 6+ in 'standards compliant mode'
		myWidth = document.documentElement.clientWidth;
		myHeight = document.documentElement.clientHeight;
	  } else if( document.body && ( document.body.clientWidth || document.body.clientHeight ) ) {
		//IE 4 compatible
		myWidth = document.body.clientWidth;
		myHeight = document.body.clientHeight;
	  }

	var  obj;
	if ((obj = findObj(wind)) != null){
		centerWind = wind;
		if (obj.style){
			obj = obj.style;
		}
		//alert(obj.width.substring(0,obj.width.length-2));
		
		obj.left= (myWidth-obj.width.substring(0,obj.width.length-2))/2+ "px";
		var offsetTop = (myHeight-obj.height.substring(0,obj.height.length-2))/2;
		//alert(obj.height);
		obj.top = ns6? window.pageYOffset*1+offsetTop+"px" : iecompattest().scrollTop*1+offsetTop+"px";
		
		//obj.top = offsetTop+"px";//ns6? window.pageYOffset*1+offsetTop+"px" : iecompattest().scrollTop*1+offsetTop+"px";
		//obj.position = 'fixed'; 
	}
	//findObj('backgroundLayer').style.top=ns6? window.pageYOffset+"px" : iecompattest().scrollTop+"px";
//	 alertSize() ;
}
function makeConnerScreen(wind){
	  var myWidth = 0, myHeight = 0;
	  if( typeof( window.innerWidth ) == 'number' ) {
		//Non-IE
		myWidth = window.innerWidth;
		myHeight = window.innerHeight;
	  } 
	  else if( document.documentElement && ( document.documentElement.clientWidth || document.documentElement.clientHeight ) ) 		
	  {
		//IE 6+ in 'standards compliant mode'
		myWidth = document.documentElement.clientWidth;
		myHeight = document.documentElement.clientHeight;
	  } else if( document.body && ( document.body.clientWidth || document.body.clientHeight ) ) {
		//IE 4 compatible
		myWidth = document.body.clientWidth;
		myHeight = document.body.clientHeight;
	  }

	var  obj;
	if ((obj = findObj(wind)) != null){
		centerWind = wind;
		if (obj.style){
			obj = obj.style;
		}
		//alert(obj.width.substring(0,obj.width.length-2));
		
		obj.left= (myWidth-obj.width.substring(0,obj.width.length-2)-20)+ "px";
		var offsetTop = 5;//(myHeight-obj.height.substring(0,obj.height.length-2))/2;
		//alert(obj.height);
		obj.top = ns6? window.pageYOffset*1+offsetTop+"px" : iecompattest().scrollTop*1+offsetTop+"px";
		
		//obj.top = offsetTop+"px";//ns6? window.pageYOffset*1+offsetTop+"px" : iecompattest().scrollTop*1+offsetTop+"px";
		//obj.position = 'fixed'; 
	}
	//findObj('backgroundLayer').style.top=ns6? window.pageYOffset+"px" : iecompattest().scrollTop+"px";
//	 alertSize() ;
}


function makeScale(wind,w,h,ow,oh){
  ow = typeof(ow) != 'undefined' ? ow : 0;
  oh = typeof(oh) != 'undefined' ? oh : 0;
	
	  if( typeof( window.innerWidth ) == 'number' ) {
		//Non-IE
		myWidth = window.innerWidth;
		myHeight = window.innerHeight;
	  } 
	  else if( document.documentElement && ( document.documentElement.clientWidth || document.documentElement.clientHeight ) ) 		
	  {
		//IE 6+ in 'standards compliant mode'
		myWidth = document.documentElement.clientWidth;
		myHeight = document.documentElement.clientHeight;
	  } else if( document.body && ( document.body.clientWidth || document.body.clientHeight ) ) {
		//IE 4 compatible
		myWidth = document.body.clientWidth;
		myHeight = document.body.clientHeight;
	  }
	var  obj;
	if ((obj = findObj(wind)) != null){
		if (obj.style){
			obj = obj.style;
		}
		
		obj.width= (parseInt(myWidth*w/100)+ow)+ "px";
		obj.height = (parseInt(myHeight*h/100)+oh)+ "px";
		
		//obj.top = offsetTop+"px";//ns6? window.pageYOffset*1+offsetTop+"px" : iecompattest().scrollTop*1+offsetTop+"px";
		//obj.position = 'fixed'; 
	}

	  
}

function setBG(comp,color){
	var  obj;
	if ((obj = findObj(comp)) != null){
		if (obj.style){
			obj = obj.style;
		}
		obj.background=color;
	}else{
		alert("Not found object name "+comp)
	}
}

function alertSize() {

  window.alert( 'Width = ' + myWidth );
  window.alert( 'Height = ' + myHeight );
}


function moveXY(wind,x,y){
	var  obj;
	if ((obj = findObj(wind)) != null){
		if (obj.style){
			obj = obj.style;
		}
		//alert(obj.width.substring(0,obj.width.length-2));
		
		obj.left = x+ "px";
		obj.top = y+"px";
	}
}
// Example: obj = findObj("image1");

function findObj(theObj, theDoc)

{
//alert(theObj+''+theDoc);
  var p, i, foundObj;

  

  if(!theDoc) theDoc = document;

  if( (p = theObj.indexOf("?")) > 0 && parent.frames.length)

  {

    theDoc = parent.frames[theObj.substring(p+1)].document;

    theObj = theObj.substring(0,p);

  }

  if(!(foundObj = theDoc[theObj]) && theDoc.all) foundObj = theDoc.all[theObj];

  for (i=0; !foundObj && i < theDoc.forms.length; i++) 

    foundObj = theDoc.forms[i][theObj];

  for(i=0; !foundObj && theDoc.layers && i < theDoc.layers.length; i++) 

    foundObj = findObj(theObj,theDoc.layers[i].document);

  if(!foundObj && document.getElementById) foundObj = document.getElementById(theObj);

  
//alert(foundObj);
  return foundObj;

}
function setFocus(objname){
	var  obj;
	if ((obj = findObj(objname)) != null){
		obj.focus();
	}
	
}
function popTooltip(head,text,w,h){
	writeit('PopUPTooltipHead',head); 
	writeit('PopUPTooltipText',text); 
	moveLayerToMouseLoc('PopUPTooltip',+40,+20);
	showHideLayers('PopUPTooltip','','show');
}
function closeTooltip(){
	showHideLayers('PopUPTooltip','','hide');
}


function activeBG(){
	  if( typeof( window.innerWidth ) == 'number' ) {
		//Non-IE
		myWidth = window.innerWidth;
		myHeight = window.innerHeight;
	  } 
	  else if( document.documentElement && ( document.documentElement.clientWidth || document.documentElement.clientHeight ) ) 		
	  {
		//IE 6+ in 'standards compliant mode'
		myWidth = document.documentElement.clientWidth;
		myHeight = document.documentElement.clientHeight;
	  } else if( document.body && ( document.body.clientWidth || document.body.clientHeight ) ) {
		//IE 4 compatible
		myWidth = document.body.clientWidth;
		myHeight = document.body.clientHeight;
	  }
	var  obj;
	if ((obj = findObj('backgroundLayer')) != null){
		if (obj.style){
			obj = obj.style;
		}
		//alert(obj.width.substring(0,obj.width.length-2));
		
		//obj.left= (myWidth-obj.width.substring(0,obj.width.length-2))/2+ "px";
		//obj.position = 'fixed'; 
		var offsetTop = 0;//(myHeight-obj.height.substring(0,obj.width.length-2))/2;
		obj.top = ns6? window.pageYOffset*1+offsetTop+"px" : iecompattest().scrollTop*1+offsetTop+"px";
		obj.height=myHeight+'px';	  
		//obj.top = "0px";
		obj.left = "0px";
		//obj.top = "0px";	
	}

	//document.body.style.overflow="hidden";
	showHideLayers("stupid_ie_select1",'','hide');
	//makeCenterScreen('backgroundLayer');
	showHideLayers('backgroundLayer','','show');
	//window.scrollbars.visible = false;
}
function hideBG(){
	
	//document.body.style.overflow="auto";
	
	showHideLayers("stupid_ie_select1",'','show');
	showHideLayers('backgroundLayer','','hide');
}
function setValue(objname,val){
	var  obj;
	if ((obj = findObj(objname)) != null){
		obj.value = val;
	}
	
}
function getValue(objname){
	var  obj;
	if ((obj = findObj(objname)) != null){
		return obj.value;
	}
	return null;
}
function Loading(){
	  if( typeof( window.innerWidth ) == 'number' ) {
		//Non-IE
		myWidth = window.innerWidth;
		myHeight = window.innerHeight;
	  } 
	  else if( document.documentElement && ( document.documentElement.clientWidth || document.documentElement.clientHeight ) ) 		
	  {
		//IE 6+ in 'standards compliant mode'
		myWidth = document.documentElement.clientWidth;
		myHeight = document.documentElement.clientHeight;
	  } else if( document.body && ( document.body.clientWidth || document.body.clientHeight ) ) {
		//IE 4 compatible
		myWidth = document.body.clientWidth;
		myHeight = document.body.clientHeight;
	  }
	var  obj;
	if ((obj = findObj('loadingLayer')) != null){
		if (obj.style){
			obj = obj.style;
		}
		//alert(obj.width.substring(0,obj.width.length-2));
		
		//obj.left= (myWidth-obj.width.substring(0,obj.width.length-2))/2+ "px";
		var offsetTop = 0;//(myHeight-obj.height.substring(0,obj.width.length-2))/2;
		obj.top = ns6? window.pageYOffset*1+offsetTop+"px" : iecompattest().scrollTop*1+offsetTop+"px";
		obj.height=myHeight+'px';	  
		obj.left = "0px";
		//obj.position = 'fixed'; 
		//obj.top = "0px";	
	}

	//document.body.style.overflow="hidden";
	//showHideLayers("stupid_ie_select1",'','hide');
	//makeCenterScreen('backgroundLayer');
	showHideLayers('loadingLayer','','show');
	//window.scrollbars.visible = false;	
}

function hideLoading(){
	//showHideLayers("stupid_ie_select1",'','show');
	showHideLayers('loadingLayer','','hide');
}

/*
function scroller() {
  makeCenterScreen();
//  setTimeout("scroller()", 100);
}*/
/*
window.onscroll = function()
{
	if( window.XMLHttpRequest ) { // IE 6 doesn't implement position fixed nicely...
		if (document.documentElement.scrollTop > 318) {
			$('side_bar').style.position = 'fixed'; 
			$('side_bar').style.top = '0';
		} else {
			$('side_bar').style.position = 'absolute'; 
			$('side_bar').style.top = 'auto';
		}
	}
}
*/

function encodeTH(val){
	val = escape(encodeURI(val));
	
	val = val.replace(/%25/g,'%');
	
	return val;
}

