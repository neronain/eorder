<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="../resource/javascript/eorder/html_teeth_image.js"></script>
<script src="../resource/javascript/eorder/func_main.js"></script>
<script src="../resource/javascript/jquery-1.9.1.min.js"></script>
<title>Untitled Document</title>
</head>

<body>
<div id="preview"></div><br />
<div id="previeweach"></div>
<div id="previewtext"></div>
<hr />
<script>
	var 	text ="";
	for(var i=0;i<const_teeth_imageid.length;i++){
			if((const_teeth_imageid[i] % 10)==1){
				text += "<br>";
			}
			text += const_teeth_imageid[i]+""
			//text += const_teeth_imagefile[i] +" ";
			text += ' <img src ="../resource/images/eorder/teeth/teeth_imagefile/'+const_teeth_imagefile[i]+'.gif" OnClick="OnClickImg('+const_teeth_imageid[i]+')" >';
			//text += "|&nbsp;";
	}
	document.write(text);
var arImageID = new Array();
function OnClickImg(id){
	arImageID[arImageID.length] = id;
	writeit('preview',html_teeth_image_lowlevel(arImageID));
	var text=""
	for(var i=0;i<arImageID.length;i++){
		text += ' <img src ="../resource/images/eorder/teeth/teeth_imagefile/'+getteeth_imagefile(arImageID[i])+'.gif" OnClick="RemoveID('+arImageID[i]+')" >';	}
	writeit('previeweach',text);
	var text=""
	for(var i=0;i<arImageID.length;i++){
		text += ''+ arImageID[i] +',';
	}
	writeit('previewtext',text);
}
function RemoveID(id){
	var arImageID2 = new Array();
	var j=0;
	for(var i=0;i<arImageID.length;i++){
		if(arImageID[i]!=id){
			arImageID2[j] = arImageID[i];
			j++;
		}
	}
	arImageID = arImageID2;
	
	writeit('preview',html_teeth_image_lowlevel(arImageID));
	var text=""
	for(var i=0;i<arImageID.length;i++){
		text += ' <img src ="../resource/images/eorder/teeth/teeth_imagefile/'+getteeth_imagefile(arImageID[i])+'.gif" OnClick="RemoveID('+arImageID[i]+')" >';	}
	writeit('previeweach',text);
	var text=""
	for(var i=0;i<arImageID.length;i++){
		text += ''+ arImageID[i] +',';
	}
	writeit('previewtext',text);
}

</script>
</body>


</html>
