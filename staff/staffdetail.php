
<html>
<head>
<title><?=WEBSITE_HEADER  ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../resource/css/default.css" rel="stylesheet" type="text/css" />
</head>

<body>

<table width="100%" height="100%" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
<tr><td height="10"></td></tr>
<tr><td align="center" valign="top">
<table width="780" border="0" align="center" cellpadding="2" cellspacing="1" class="TableBorder">
  <tr>
    <td  class="HeaderW"><table width="100%" border="0" cellspacing="0" cellpadding="0"  class="HeaderW">
        <form action="../staff/staffedit_c.php" method="post" name="staffedit">
		<input type="hidden" name="staffid" value="<?=$data_staff->Rs("staffid");?>" />
        <input type="hidden" name="stfgender" value="<?=$data_staff->Rs("stf_prefix");?>" />
		<tr>
          <td>Staff detail </td>
		  
          <td align="right">
		  <a href="javascript:staffedit.submit()"  alt="Edit information">
		  <img src="../resource/images/silkicons/vcard_edit.gif" width="16" height="16" border="0">		  </a>		  </td>
        </tr> </form>
      </table></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF" class="Normal"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="Normal">
        <tr>
          <td>staff code </td>
          <td><?= $data_staff->Rs("stf_code") ?></td>
        </tr>
        <tr>
          <td>name</td>
          <td><?=$data_staff->Rs("stf_prefix").$data_staff->Rs("stf_name");?></td>
        </tr>
        <tr>
          <td>ID-Card</td>
          <td><?=$data_staff->Rs("stf_idcard");?></td>
        </tr>
        <tr>
          <td>section</td>
          <td>
		  				<a href="../section/sectiondetail_c.php?sectionid=<?= $data_staff->Rs("stf_sec_id"); ?>"
				target="_blank">
				 <?=$data_staff->Rs("sec_room");?></a>
		 </td>
        </tr>
      </table>      </td>
  </tr>
  <tr>
  
    <td class="FooterTD"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td class="Normal" >
		<a href="<?=$PHP_SELF?>?tab=orderstat&staffid=<?=$staffid?>">[ Lookbook stat ]</a>
		<a href="<?=$PHP_SELF?>?tab=orderlist&staffid=<?=$staffid?>">[ Lookbook list ]</a>
		
		</td>
        <td align="right">&nbsp;</td>
      </tr>
    </table>      </td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">
	<? if($tab=="orderstat"){ ?>
		<? include("staffdetail_stat.php"); ?>
	<? }else if($tab=="orderlist"){ ?>
		<? include("staffdetail_order.php"); ?>
	<? }?>	</td>
  </tr>
</table></td></tr></table>
</body>
</html>

