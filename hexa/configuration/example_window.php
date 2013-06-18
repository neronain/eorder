<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?=WEBSITE_HEADER?></title>
<link href="../cfrontend/default.css" rel="stylesheet" type="text/css" />
<script src="../resource/javascript/ajax.js"></script>
<script src="../resource/javascript/default.js"></script>
<style>
a#yaprak {
    width: 64px;
    height: 64px;
    background-image: url(yaprak_bw_color.png);
    display: block;
    text-decoration: none;
}

a#yaprak:hover {
    background-position: 64px 0;
}
</style>
</head>
<body>
<? /* */ include_once "../resource/divbackground.php" ?>



<table width="100" class="tdButtonOnOut" onmouseover="this.className='tdButtonOnOver'" onmouseout="this.className='tdButtonOnOut'" onclick="OpenDivShowAjaxExample();">
<tr>
<td align="center">Example</td>
</tr>
</table>
<br />
<br />
<br />

<a href="#" id="yaprak">&nbsp;</a>


<div id="DivShowAjaxExample" style="position:absolute;left:0px;top:500px;width:618px;height:500px;z-index:1;">
  <? $tbframeheader = "This is example"?>
  <? $tbframehclose = "CloseDivShowAjaxExample()";?>
  <? include "../cfrontend/tbframeh.php"?>
  <div id="DivAjaxExample" style="overflow:auto;width:600px;height:450px" align="left"></div>
  <? include "../cfrontend/tbframef.php"?>
</div>
<script>
function OpenDivShowAjaxExample()
{
	activeBG();
	showHideLayers('DivShowAjaxExample','','show');
	makeCenterScreen('DivShowAjaxExample');
	showHTML('DivAjaxExample','../configuration/test.php?var1=1&var2=2&var3=3&vara[1]=abc&vara[2]=def&vara[3]=ghi');
}
function CloseDivShowAjaxExample()
{
	hideBG();
	showHideLayers('DivShowAjaxExample','','hide');
}
showHideLayers('DivShowAjaxExample','','hide');
hideLoading();
</script>
</body>
</html>
