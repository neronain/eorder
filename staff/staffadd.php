<? include_once("../core/default.php"); ?>


<? 	//echo("Step $step<br>");?>
<html>
<title><?=WEBSITE_HEADER  ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../resource/css/default.css" rel="stylesheet" type="text/css" />
<body>
<table width="100%" height="100%" cellspacing="0" cellpadding="0">
<tr><td height="50"><? $currentMenu="addstaff";include_once("../staff/staffmenu.php"); ?></td></tr>
<tr><td align="center" valign="top">
<table width="500" border="0" cellpadding="2" cellspacing="1" class="TableBorder">
  <tr>
    <td align="center" class="HeaderW"><img src="../resource/images/silkicons/group_add.gif"> Add staff </td>
  </tr>

<form action="../staff/staffadd_c.php" method="post" name="addstaffform">
  <tr>
    <td height="200" valign="top" bgcolor="#FFFFFF" class="Normal">
<strong>--- Input name &amp; nick  ---</strong><br />
<table border="0" cellpadding="2" cellspacing="1" class="Normal">
  <tr>
    <td>Name</td>
    <td><select name="stfgender" id="stfgender">
      <option value="นาย" <? if($stfgender == "นาย"){echo("selected");} ?>>นาย</option>
      <option value="นาง" <? if($stfgender == "นาง"){echo("selected");} ?>>นาง</option>
      <option value="นางสาว" <? if($stfgender == "นางสาว"){echo("selected");} ?>>นางสาว</option>
      <option value="Mr." <? if($stfgender == "Mr."){echo("selected");} ?>>Mr.</option>
      <option value="Mrs" <? if($stfgender == "Mrs"){echo("selected");} ?>>Mrs</option>
      <option value="Miss" <? if($stfgender == "Miss"){echo("selected");} ?>>Miss</option>
    </select>
    <input type="text" name="stfname" value="<?=$stfname?>"></td>
  </tr>
  <tr>
    <td width="100">ID-Card</td>
    <td><input type="text" name="stfidcard" value="<?=$stfidcard?>"></td>
  </tr>
  <tr>
    <td>Section</td>
    <td><?  buildComboBoxList('stfsec','section order by sec_type,sec_room','sectionid',array('sec_type','sec_room'),$stfsec,"") ?></td>
  </tr>
</table>
	</td>
  </tr>
  <tr><td class="FooterTD"><table width="100%" border="0" cellspacing="0" cellpadding="2">
      <tr><td><strong><?=$msg?></strong></td><td align="right">
	  	  		<button onClick="addstaffform.submit();" class="BTok">
		<img src="../resource/images/silkicons/disk.gif"> Add</button>
	  <input name="METHOD" type="hidden" value="ADD" />
	  </td></tr></table></td>
  </tr>
</form>
</table>
</td></tr>
</table></body></html>

<? 
include_once '../core/inc_pngfix.php';
echo replacePngTags(ob_get_clean()); ?>