// JavaScript Document
var ie5=document.all&&document.getElementById
var ns6=document.getElementById&&!document.all
function getMouseLoc(e){
  if(!document.all) { //NS
    mLoc.x = e.pageX;
    mLoc.y = e.pageY;
  }else{               //IE
    mLoc.x = event.x + document.body.scrollLeft;
    mLoc.y = event.y + document.body.scrollTop;
  }
  return true;
}
if(!document.all){document.captureEvents(Event.MOUSEMOVE); document.onMouseMove = getMouseLoc; }// * 

function SetFixOrder(selected){
	if(selected){
		SetOpenLayerFix('FixSelectType');		
	}else{
		SetOpenLayerFix('NONE');
	}
}
function SetRemoveOrder(selected){
	if(selected){
		SetOpenLayerRemove('MainRemove');		
	}else{
		SetOpenLayerRemove('NONE');
	}
}
function InitLayer(){
	SetOpenLayerFix('NONE');
	SetOpenLayerRemove('NONE');
	RefreshFixMethodTB();
}


function SetOpenLayerFix(openlayer){
	var FixSelectType 			= document.getElementById('FixSelectType');
	var MainFix 					= document.getElementById('MainFix');
	
	
	FixSelectType.style.display		= (openlayer=='MainFix' || openlayer=='FixSelectType' ?'inline':'none');
	MainFix.style.display					= (openlayer=='MainFix'?'inline':'none');
	//SetScrollbarEnable(true);
}

function SetOpenLayerRemove(openlayer){
	var MainRemove 					= document.getElementById('MainRemove');
	MainRemove.style.display					= (openlayer=='MainRemove'?'inline':'none');
}

function SetScrollbarEnable(val){
	if(ie5){
		document.body.scroll=(val?"yes":"no");
	}else{
		document.body.style.overflow=(val?"visible":"hidden");
	}
}
function makeMaximum(wind){
	  var myWidth = 0, myHeight = 0;
	  if( typeof( window.innerWidth ) == 'number' ) {
		//Non-IE
		myWidth = window.innerWidth;
		myHeight = window.innerHeight;
	  } else if( document.documentElement && ( document.documentElement.clientWidth || document.documentElement.clientHeight ) ) {
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
		//alert(obj.width.substring(0,obj.width.length-2));
		
		obj.width= myWidth+ "px";
		var offsetTop = myHeight;
		obj.height = ns6? window.pageYOffset*1+offsetTop+"px" : iecompattest().scrollTop*1+offsetTop+"px";
	}
}
function makeCenterScreen(wind){
	  var myWidth = 0, myHeight = 0;
	  if( typeof( window.innerWidth ) == 'number' ) {
		//Non-IE
		myWidth = window.innerWidth;
		myHeight = window.innerHeight;
	  } else if( document.documentElement && ( document.documentElement.clientWidth || document.documentElement.clientHeight ) ) {
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
		//alert(obj.width.substring(0,obj.width.length-2));
		
		obj.left= (myWidth-obj.width.substring(0,obj.width.length-2))/2+ "px";
		var offsetTop = (myHeight-obj.height.substring(0,obj.height.length-2))/2;
		obj.top = ns6? window.pageYOffset*1+offsetTop+"px" : iecompattest().scrollTop*1+offsetTop+"px";
	}
//	 alertSize() ;
}
function showHideLayers()

{ 
// Example: showHideLayers(Layer1,'','show',Layer2,'','hide');

  var i, visStr, obj, args = showHideLayers.arguments;

  for (i=0; i<(args.length-2); i+=3)

  {

    if ((obj = findObj(args[i])) != null)

    {

      visStr = args[i+2];

      if (obj.style)

      {

        obj = obj.style;

        if(visStr == 'show') visStr = 'visible';

        else if(visStr == 'hide') visStr = 'hidden';

      }

      obj.visibility = visStr;

    }

  }

}

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

function iecompattest(){
	return (!window.opera && document.compatMode && document.compatMode!="BackCompat")? document.documentElement : document.body
}
function activeBG(){
	makeMaximum('backgroundLayer');
	//showHideLayers("stupid_ie_select1",'','hide');
	showHideLayers('backgroundLayer','','show');
}
function hideBG(){
	//showHideLayers("stupid_ie_select1",'','show');
	showHideLayers('backgroundLayer','','hide');
}