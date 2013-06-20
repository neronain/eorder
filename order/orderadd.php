<? include_once("../core/default.php"); ?>
<html>
<title><?=WEBSITE_HEADER  ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../resource/css/default.css" rel="stylesheet" type="text/css" />
<script src="../resource/javascript/default.js"></script>
<body>

<table width="100%" height="100%" cellspacing="0" cellpadding="0">
<tr><td height="50"><? $currentMenu="addorder";include_once("../order/ordermenu.php"); ?></td></tr>
<tr>
  <td align="center" valign="top"><br>
    <br>
    <table width="600" border="0" cellpadding="2" cellspacing="1" class="TableBorder">
  <tr>
    <td align="center" class="HeaderW">
	<img src="../resource/images/silkicons/package_add.gif" border="0" /> 	Add order </td>
  </tr>
    
    
    
    
  <form action="../eorder/eorder_edit.php" method="post" name="addorderform" >
  <tr>
    <td height="200" valign="top" bgcolor="#FFFFFF" class="Normal">
<strong>--- Select customer ---</strong><br />
Customer <?  buildComboBoxList('customerid','customer where cus_enable=TRUE order by cus_nick','customerid',array('cus_nick','cus_name'),$customer,"") ?><br />
      <input type="hidden" name="act" value="add" />
      </td>
  </tr>
  <tr><td class="FooterTD"><table width="100%" border="0" cellspacing="0" cellpadding="2">
      <tr><td>&nbsp;</td><td align="right"><input name="METHOD" type="submit" class="BTnextback" value="NEXT" /></td></tr></table></td>
  </tr>
</form>
</table>
</td></tr>
</table>

</body></html>
<? 
include_once '../core/inc_pngfix.php';
echo replacePngTags(ob_get_clean()); ?>