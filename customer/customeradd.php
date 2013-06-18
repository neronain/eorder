<? include_once("../core/default.php"); ?>

<html>
<title><?=WEBSITE_HEADER  ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../resource/css/default.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="../resource/javascript/default.js"></script> 
<body>

<table width="100%" height="100%" cellspacing="0" cellpadding="0">
<tr><td height="50"><? $currentMenu="addcustomer";include_once("../customer/customermenu.php"); ?></td></tr>
<tr><td align="center" valign="top">
<table width="500" border="0" cellpadding="2" cellspacing="1" class="TableBorder">
  <tr>
    <td align="center" class="HeaderW"><img src="../resource/images/silkicons/building_add.gif" border="0" /> Add customer </td>
  </tr>

<form action="../customer/customeradd_c.php" method="post" name="addcustomerform">
  <tr>
    <td height="200" valign="top" bgcolor="#FFFFFF" class="Normal">
<strong>--- Input name &amp; nick  ---</strong><br />
<table border="0" cellpadding="2" cellspacing="1" class="Normal">
  <tr> 
    <td width="100">Name</td>
    <td><input type="text" name="cusname" value="<?=$cusname?>"></td>
  </tr>
  <tr>
  <td>Nick</td>
  <td><input type="text" name="cusnick" value="<?=$cusnick?>" maxlength="4" ></td></tr>
  <tr>
    <td>Country</td>
    <td><?  buildComboBoxList('country','country','countryid',array('cnt_name'),$country,"") ?>
	  		<button onClick="METHOD.value='LIST';addcustomerform.submit();" class="BTok">
				List Province</button>
	</td>
  </tr>

<? if($islistprovince){ ?>
  <tr>
    <td>Province</td>
    <td><?  buildComboBoxList('province',"province where prv_cnt_id = $country order by provinceid",'provinceid',array('prv_name'),$province,"") ?>
	</td>
  </tr>

<? }?>


</table>
	</td>
  </tr>
  <tr><td class="FooterTD"><table width="100%" border="0" cellspacing="0" cellpadding="2">
      <tr><td>&nbsp; <?=$msg?></td><td align="right">
	  		<button onClick="addcustomerform.submit();" class="BTok">
		<img src="../resource/images/silkicons/disk.gif"> Add</button>
	  <input name="METHOD" id="METHOD" type="hidden" value="ADD" />
	  
	  </td></tr></table></td>
  </tr>
</form>
</table>
</td></tr>
</table></body></html>
<? 
include_once '../core/inc_pngfix.php';
echo replacePngTags(ob_get_clean()); ?>