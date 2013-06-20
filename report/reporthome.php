<? include_once("../core/default.php"); ?>
<html>
<title><?=WEBSITE_HEADER  ?></title>
<link href="../resource/css/default.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="../resource/javascript/ajax.js"></script>
<script src="../resource/javascript/default.js"></script>
<body style="background-color:#FFFFFF">



<table width="100%" height="100%" cellspacing="0" cellpadding="0">
<tr><td height="50"><?  $currentMenu="home";include_once("../report/reportmenu.php"); ?></td></tr>
<tr>
  <td align="center" valign="top" ><br>
  <table border="0" cellpadding="0" cellspacing="1" bgcolor="#999999">
  <tr>
    <td width="100" height="100" bgcolor="#CCCCCC">&nbsp;</td>
    <td width="100" height="100" bgcolor="#CCCCCC">&nbsp;</td>
    <td width="100" height="100" bgcolor="#CCCCCC">&nbsp;</td>
  </tr>
  <tr>
    <td width="100" height="100" bgcolor="#CCCCCC">&nbsp;</td>
    <td width="100" height="100" bgcolor="#CCCCCC">&nbsp;</td>
    <td width="100" height="100" bgcolor="#CCCCCC">&nbsp;</td>
  </tr>
  <tr>
    <td width="100" height="100" bgcolor="#CCCCCC">&nbsp;</td>
    <td width="100" height="100" bgcolor="#CCCCCC">&nbsp;</td>
    <td width="100" height="100" bgcolor="#CCCCCC">&nbsp;</td>
  </tr>
</table>



</td></tr></table>
<? 
include_once '../core/inc_pngfix.php';
echo replacePngTags(ob_get_clean()); ?>