<? include_once("../core/default.php"); ?>

<?
/* IN 
	$data_logbook >> order list
	$data_logbookAr
	
*/
?>


<html>
<title><?=WEBSITE_HEADER  ?></title>
<link href="../resource/css/default.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<body bgcolor="#FFFFFF">
<? include_once("../cfrontend/ordersummary.php"); ?>
<? /* */ include_once "../resource/divbackground.php" ?>

<table width="100%" height="100%" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
<tr><td height="50"><?  $currentMenu="loglist";include_once("../logbook/logbookmenu.php"); ?></td></tr>
<tr><td align="center" valign="top">
<table width="90%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="20"></td>
    <td><table width="100%" border="0" cellpadding="2" cellspacing="1" class="TableBorder">
      <tr>
        <td class="HeaderW">
				          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td class="HeaderW"><img src="../resource/images/silkicons/book.gif"> Logbook list </td>
              <td class="Normal" align="right">Found <?=$totalrow?> in <?=$totalpage?> pages</td>
            </tr>
          </table>
		</td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF">&nbsp;</td>
      </tr>
      <tr>
        <td align="center" bgcolor="#FFFFFF">
					<?



		
			$querystring  = "?";
			foreach($_GET as $variable => $value){
				if($variable=="page")continue;
				$querystring  .= "$variable=$value&";
			}
			?>
					<table cellspacing="0" cellpadding="0"><tr><td width="50"><?
					if($totalpage>1){
			 if($page!=1){
			echo "<a href=\"../logbook/loglist_c.php".$querystring."page=1\"><img src=\"../resource/images/silkicons/resultset_first.gif\" width=\"16\" height=\"16\" border=0></a></a>";	 }
			?></td><td width="50"><?
			if($page>1){
			echo "<a href=\"../logbook/loglist_c.php".$querystring."page=".($page-1)."\"><img src=\"../resource/images/silkicons/resultset_previous.gif\" width=\"16\" height=\"16\" border=0></a>";	 }
			?></td><td align="center" width="300"><?
			for($p=max(1,$page-3);$p<=$page+3 && $p<=$totalpage;$p++){ 
					if($p==$page){
						echo "&nbsp;&nbsp;&nbsp;<strong>$p</strong>&nbsp;&nbsp;&nbsp;";
					}else{
						echo "&nbsp;&nbsp;<a href=\"../logbook/loglist_c.php".$querystring."page=$p\">$p</a>&nbsp;&nbsp;";		
					}
			} ?>
			</td><td width="50" align="right">
			<? if($page<$totalpage){
			echo "<a href=\"../logbook/loglist_c.php".$querystring."page=".($page+1)."\"><img src=\"../resource/images/silkicons/resultset_next.gif\" width=\"16\" height=\"16\" border=0></a>";	 }?>
			</td><td width="50" align="right">
			<? if($page!=$totalpage){
			echo "<a href=\"../logbook/loglist_c.php".$querystring."page=$totalpage\"><img src=\"../resource/images/silkicons/resultset_last.gif\" width=\"16\" height=\"16\" border=0></a>";	 }}?>
			</td></tr></table>
		
		</td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF">
		<table width="100%"  border="0" cellpadding="2" cellspacing="2">
			<tr>
			    <td class="HeaderTable">Date</td>
			    <td class="HeaderTable">Order code</td>
			    <td class="HeaderTable">Section</td>
			    <td class="HeaderTable">Staff</td>
			    <td class="HeaderTable">Type</td>
			    <td class="HeaderTable">&nbsp;</td>
		      </tr>
			<? foreach($data_logbookAr as $dt_logbook){ ?>
<form action="../logbook/loglist_c.php" method="post"
		name="formdel<?= $dt_logbook["logbookid"]; ?>">
		<input type="hidden" name="logbookid" value="<?= $dt_logbook["logbookid"]; ?>">
		<input type="hidden" name="METHOD"  value="DELETE" >
			  <tr class="Normal" valign="top" >
			  <td><?= $dt_logbook["log_datef"]; ?></td>
				<td class="tdRowOnOut" onMouseOver="this.className='tdRowOnOver'" onMouseOut="this.className='tdRowOnOut'" onClick="OpenDivShowSummary(<?= $dt_logbook["eorderid"]?>)">
				  <span style="color: #0000FF">
				  <?= $dt_logbook["ord_code"]; ?>
				  </span></td>
				<td><?= $dt_logbook["sec_room"]; ?></td>
				<td><?= $dt_logbook["stf_name"]; ?></td>
				<td><?= $dt_logbook["log_type"]; ?></td>
				<td>
<a href="javascript:if(confirm('Confirm delete\n log code <?= $dt_logbook["ord_code"]; ?> '))formdel<?= $dt_logbook["logbookid"]; ?>.submit();">
<img src="../resource/images/silkicons/cross.gif"  border="0"></a>

				
				</td>
			  </tr>
			  
			</form>
			<? } ?>
        </table></td>
      </tr>
      <tr>
        <td align="center" bgcolor="#FFFFFF">
		
		<table cellspacing="0" cellpadding="0"><tr><td width="50"><?
		if($totalpage>1){
			 if($page!=1){
			echo "<a href=\"../logbook/loglist_c.php".$querystring."page=1\"><img src=\"../resource/images/silkicons/resultset_first.gif\" width=\"16\" height=\"16\" border=0></a>";	 }
			?></td><td width="50"><?
			if($page>1){
			echo "<a href=\"../logbook/loglist_c.php".$querystring."page=".($page-1)."\"><img src=\"../resource/images/silkicons/resultset_previous.gif\" width=\"16\" height=\"16\" border=0></a>";	 }
			?></td><td align="center" width="300"><?
			for($p=max(1,$page-3);$p<=$page+3 && $p<=$totalpage;$p++){ 
					if($p==$page){
						echo "&nbsp;&nbsp;&nbsp;<strong>$p</strong>&nbsp;&nbsp;&nbsp;";
					}else{
						echo "&nbsp;&nbsp;<a href=\"../logbook/loglist_c.php".$querystring."page=$p\">$p</a>&nbsp;&nbsp;";		
					}
			} ?>
			</td><td width="50" align="right">
			<? if($page<$totalpage){
			echo "<a href=\"../logbook/loglist_c.php".$querystring."page=".($page+1)."\"><img src=\"../resource/images/silkicons/resultset_next.gif\" width=\"16\" height=\"16\" border=0></a>";	 }?>
			</td><td width="50" align="right">
			<? if($page!=$totalpage){
			echo "<a href=\"../logbook/loglist_c.php".$querystring."page=$totalpage\"><img src=\"../resource/images/silkicons/resultset_last.gif\" width=\"16\" height=\"16\" border=0></a>";	 }}?>
			</td></tr></table>
		</td>
      </tr>
      <tr>
        <td class="FooterTD">&nbsp;</td>
      </tr>
    </table></td>
    <td width="20">&nbsp;</td>
  </tr>
  
</table>
</td></tr></table>
</body></html>
    <script>hideLoading()</script>
<? 
include_once '../core/inc_pngfix.php';
echo replacePngTags(ob_get_clean()); ?>