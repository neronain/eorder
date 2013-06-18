<? include_once("../core/default.php"); ?>
<?
	include_once("../eorder/eorder_repairrework_conftable.php");
	
?>


<html>
<head>
<title><?=WEBSITE_HEADER  ?></title>
<link href="../resource/css/default.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
td{
	font-size:16px;
}
</style>
</head>
<body>
<div id="PrintLayer" style="position:absolute;left:642px;top:14px;width:45px;height:36px;z-index:1;margin:0;padding:0"
onClick="style.visibility = 'hidden';window.print();style.visibility = 'visible'"
><table width="100%" height="100%" cellpadding="0" cellspacing="1" bgcolor="#000000">
  <tr><td align="center" bgcolor="#FFFFCC"><img src="../resource/images/silkicons/printer.gif"></td>
  </tr></table>
</div>
<?

foreach ($glo_defectcode_table as $code =>$text){
	break;
}

?>
<table width="100%" cellspacing="2" cellpadding="0">
  <tr>
        <td height="25" valign="middle"> 
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td ><font size="+1">Section <?=substr($code,2,1)?></font></td>
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
$lastsec = '';
$gb_count = 0; 
foreach ($glo_defectcode_table as $code =>$text){
	if($lastsec!=substr($code,0,3) ){
		$lastsec=substr($code,0,3);
		$count=0;
		
		if($gb_count!=0){
	?>

	</tr>
        </table></td>
     
  	</tr>
</table>
<table width="100%" cellspacing="2" cellpadding="0">
  <tr>
        <td height="25" valign="middle"> 
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td ><font size="+1">Section <?=substr($code,2,1)?></font></td>
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
		}
			} ?>
			
			<? 
			
			
			 ?>
			  
				<td><font face="IDAutomationHC39M">*<?= $code; ?>*</font></td>
				<td><?= $code; ?><br>
				<?= $text; ?></td>
			<?  if($count%2==1){?>
			</tr>
			<tr valign="top" ><td colspan="4" height="20"></td></tr>
			<tr valign="top" >
			<? 	}
			$count++;
			$gb_count++;
			 ?>
			
<? } ?>

	</tr>
        </table></td>
     
  	</tr>
</table>
</body></html>


