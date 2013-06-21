
<html>
<head>
<title><?=WEBSITE_HEADER  ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../resource/css/default.css" rel="stylesheet" type="text/css" />
<script src="../resource/javascript/jquery-1.9.1.min.js"></script>
</head>

<body>

<table width="100%" height="100%" cellspacing="0" cellpadding="0">
<tr><td height="10"></td></tr>
<tr><td align="center" valign="top">
<table width="780" border="0" align="center" cellpadding="2" cellspacing="1" class="TableBorder">
  <tr>
    <td  class="HeaderW"><table width="100%" border="0" cellspacing="0" cellpadding="0"  class="HeaderW">
        <form action="../section/sectionedit_c.php" method="post" name="sectionedit">
		<input type="hidden" name="sectionid" value="<?=$data_section->Rs("sectionid");?>" />
		<tr>
          <td>section detail </td>
		  
          <td align="right"><!--
		  <a href="javascript:sectionedit.submit()"  alt="Edit information">
		  <img src="../resource/images/silkicons/vcard_edit.gif" width="16" height="16" border="0">		  </a>		-->
		  </td>
        </tr> </form>
      </table></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF" class="Normal"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="Normal">
        <tr>
          <td width="200">section name </td>
          <td colspan="2"><?= $data_section->Rs("sec_room") ?></td>
        </tr>
        <tr>
          <td valign="top">staff</td>
          
		  <? $i=-1; ?>
		  <? while(!$data_staff->EOF){ ?>
		  <td>
		  <a href="../staff/staffdetail_c.php?staffid=<?= $data_staff->Rs("staffid"); ?>"
				target="_blank">
				<?=$data_staff->Rs("stf_code");?> 
				<?=$data_staff->Rs("stf_prefix");?><?=$data_staff->Rs("stf_name");?></a>
				<?="</td>" ?>
<? $i++;	
if($i%2==1){ ?>
<?='</tr><tr><td valign="top"></td>' ?>
<? } ?>
				
		  <? $data_staff->MoveNext();	}?>
		  </td>
        </tr>
      </table>      </td>
  </tr>
  <tr>
  
    <td class="FooterTD"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td class="Normal" >
		<a href="<?=$PHP_SELF?>?tab=orderstat&sectionid=<?=$sectionid?>">[ Lookbook stat ]</a>
		<a href="<?=$PHP_SELF?>?tab=orderstaff&sectionid=<?=$sectionid?>">[ Lookbook each staff ]</a>
		
		</td>
        <td align="right">&nbsp;</td>
      </tr>
    </table>      </td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">
	<? if($tab=="orderstat"){ ?>
		<? include("sectiondetail_stat.php"); ?>
	<? }else if($tab=="orderstaff"){ ?>
		<? include("sectiondetail_staff.php"); ?>
	<? }?>	
	
	<? 


include_once("../admin/workperf_manager_express.php"); 

?>
	</td>
  </tr>
</table></td></tr></table>
</body>
</html>

