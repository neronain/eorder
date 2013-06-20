<? include_once("../core/default.php"); ?>
<?
	$sectionid = $_GET['secid'];


	$data_section = new CSql();
 	$err =	$data_section->Connect();
	$query = "select * from section
			where sectionID = '$sectionid' 
			order by sec_type,sec_room
			";
	$data_section->Query($query);

	$data_staff = new CSql();
	
?>


<html>
<title><?=WEBSITE_HEADER  ?></title>
<link href="../resource/css/default.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<body>
<div id="PrintLayer" style="position:absolute;left:642px;top:14px;width:45px;height:36px;z-index:1;margin:0;padding:0"
onClick="style.visibility = 'hidden';window.print();style.visibility = 'visible'"
><table width="100%" height="100%" cellpadding="0" cellspacing="1" bgcolor="#000000">
  <tr><td align="center" bgcolor="#FFFFCC"><img src="../resource/images/silkicons/printer.gif"></td>
  </tr></table>
</div>
<?
//while(!$data_section->EOF ){
	//$sectionid = $data_section->Rs("sectionid");
	$query = "
		select CONCAT(stf_prefix,stf_name) as stf_names,staffid,sectionid,sec_room,staffid,stf_code 
		from staff,section
		 	where stf_sec_id = sectionid and stf_enable = TRUE
			and sectionid = $sectionid
			order by stf_name
			";
	$data_staff->Query($query);


?>
<table width="100%" cellspacing="2" cellpadding="0">
  <tr>
        <td height="25" valign="middle"> 
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td ><font size="+1">Section 
			  <?= $data_section->Rs("sec_type"); ?> :
			  <?= $data_section->Rs("sec_room"); ?></font></td>
              <td  align="right"> </td>
            </tr>
    </table></td>
  </tr>
	  
	  
      <tr>
        <td valign="top" bgcolor="#FFFFFF">
		<table width="100%"  border="0" cellpadding="0" cellspacing="0" >
		<tr><td colspan="6"><hr></td></tr>
			<tr  height="20">
			    <td width="100" height="25" >Barcode</td>
			    <td width="80" height="25">Code-Name</td>
			    <td width="100"  height="25">Barcode</td>
			    <td width="80" height=25>Code-Name</td>
			    
	      </tr>
		  <tr><td colspan="6"><hr></td></tr>
		  <tr  valign="top" >
			<? 
			$count=0;
			
			while(!$data_staff->EOF ){ ?>
			  
				<td><font face="IDAutomationHC39M">*<?= $data_staff->Rs("stf_code"); ?>*</font></td>
				<td><?= $data_staff->Rs("stf_code"); ?><br>
				<?= $data_staff->Rs("stf_names"); ?></td>
			<?  if($count%2==1){?>
			</tr>
			<tr valign="top" ><td colspan="4" height="20"></td></tr>
			<tr valign="top" >
			<? 	}
			$count++;
			 $data_staff->MoveNext();} ?>
			</tr>
        </table></td>
  </tr>
</table>
<?
//$data_section->MoveNext();	
//}
?>
</body></html>


