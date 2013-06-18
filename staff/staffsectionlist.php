<? include_once("../core/default.php"); ?>
<?
/* IN 
	$data_staff >> staff list
	
*/
?>


<html>
<title><?=WEBSITE_HEADER  ?></title>
<link href="../resource/css/default.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script>
function popUpWindow(URLStr, left, top, width, height)
{
  open(URLStr, 'popUpWin'+new Date().getTime(), 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=1,resizable=yes,copyhistory=yes,width='+width+',height='+height+',left='+left+', top='+top+',screenX='+left+',screenY='+top+'');

}
</script>
<body>
<table width="100%" height="100%" cellspacing="0" cellpadding="0">
<tr><td height="50"><?  $currentMenu="staffsectionlist";include_once("../staff/staffmenu.php"); ?></td></tr>
<tr><td align="center" valign="top">
<table width="90%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="20"><br>      <br></td>
    <td>
    <table width="100%" border="0" cellpadding="2" cellspacing="1" class="TableBorder">
      <tr>
        <td class="HeaderW"> 
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td class="HeaderW"><img src="../resource/images/silkicons/group.gif"> Staff print (please select section)</td>
              <td class="Normal" align="right">&nbsp;</td>
            </tr>
          </table></td>
      </tr>
      <tr>
        <td align="center" bgcolor="#FFFFFF">
		  <table width="100%"  border="0" cellpadding="2" cellspacing="2">
		    <tr>
		      <td width="40" align="center" class="HeaderTable">Type</td>
			      <td class="HeaderTable">Section room</td>
			    </tr>
		    <? 
			$i=1;
			while(!$data_staff->EOF){ ?>
		    
		    <tr valign="top" class="tdRowOnOut"
                onClick="popUpWindow('../staff/staffprint.php?secid=<?=$data_staff->Rs("sectionID")?>',100,100,800,600)" onMouseOver="this.className='tdRowOnOver'" onMouseOut="this.className='tdRowOnOut'">
		      <td align="center"><?=$data_staff->Rs("sec_type")?></td>
				  <td><?= $data_staff->Rs("sec_room"); ?></td>
				  </tr>
		    <? 
			$i++;
			$data_staff->MoveNext();	} ?>
		    </table></td>
      </tr>
      
      <tr>
        <td class="FooterTD">&nbsp;</td>
      </tr>
    </table>
    </td>
    <td width="20">&nbsp;</td>
  </tr>
  
</table>
</td></tr></table>
</body></html>
