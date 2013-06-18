<!--
Default javascript
//Function javascript พื้นฐาน เอาไว้ใช้นะครับ
function writeit(objID,text);
function makeCenterScreen(objID);
function showHideLayers();// Example: showHideLayers(Layer1,'','show',Layer2,'','hide');
function setBG(objID,color);
function findObj(objID);
function setFocus(objID);
function activeBG();
function hideBG();
function setValue(objID,val);
-->
<script src="../resource/javascript/default.js"></script>
<link href="../cfrontend/default.css" rel="stylesheet" type="text/css" />
<table cellpadding="0" cellspacing="0">
  <tr><td width="20"></td><td width="930">
<? $tbframeheader = "Special order detail"?>
<? $tbframehscript='<a href="#TOP">Goto top</a>' ?>
<? include "../cfrontend/tbframeh.php"?>
<br />
<table border="0" cellpadding="2" cellspacing="1">
<tr>
<td>
 <table border="0" cellspacing="0" cellpadding="0">

  <tr>
    <td colspan="2"><? include "../cfrontend/tbframe2h.php" ?>
      <span style="font-weight: bold">Description<br />
      </span> <br />
      <textarea name="special_description" id="special_description" style="width:550px;height:150px"><?=$special_description?></textarea><? include "../cfrontend/tbframe2f.php" ?></td>
  </tr>
</table></td>
    <td align="center" valign="top">&nbsp;</td>
</tr>
<tr>
  <td valign="top" >&nbsp;</td>
  <td align="right" valign="top"><a href="#TOP">Goto top</a></td>
</tr>
</table>
<? include "../cfrontend/tbframef.php"?>
</td></tr></table>
