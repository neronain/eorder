<? include_once("../core/default.php"); ?>
<?
/* IN 
	$data_logbook >> order list
	
*/
?>


<html>
<title><?=WEBSITE_HEADER  ?></title>
<link href="../resource/css/default.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<body>
<table width="100%" height="100%" cellspacing="0" cellpadding="0">
<tr><td height="50"><?  $currentMenu="logwait";include_once("../logbook/logbookmenu.php"); ?></td></tr>
<tr><td align="center" valign="top">
<table width="90%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="20"></td>
    <td><table width="100%" border="0" cellpadding="2" cellspacing="1" class="TableBorder">
      <tr>
        <td class="HeaderW"><img src="../resource/images/silkicons/book_wait.gif"> Waiting list </td>
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
					<table cellspacing="0" cellpadding="0"><tr><td width="50">
					<?
				if($totalpage>1){
			 if($page!=1){
			echo "<a href=\"../logbook/logwait_c.php".$querystring."page=1\"><img src=\"../resource/images/silkicons/resultset_first.gif\" width=\"16\" height=\"16\" border=0></a></a>";	 }
			?></td><td width="50"><?
			if($page>1){
			echo "<a href=\"../logbook/logwait_c.php".$querystring."page=".($page-1)."\"><img src=\"../resource/images/silkicons/resultset_previous.gif\" width=\"16\" height=\"16\" border=0></a>";	 }
			?></td><td align="center" width="300"><?
			for($p=max(1,$page-3);$p<=$page+3 && $p<=$totalpage;$p++){ 
					if($p==$page){
						echo "&nbsp;&nbsp;&nbsp;<strong>$p</strong>&nbsp;&nbsp;&nbsp;";
					}else{
						echo "&nbsp;&nbsp;<a href=\"../logbook/logwait_c.php".$querystring."page=$p\">$p</a>&nbsp;&nbsp;";		
					}
			} ?>
			</td><td width="50" align="right">
			<? if($page<$totalpage){
			echo "<a href=\"../logbook/logwait_c.php".$querystring."page=".($page+1)."\"><img src=\"../resource/images/silkicons/resultset_next.gif\" width=\"16\" height=\"16\" border=0></a>";	 }?>
			</td><td width="50" align="right">
			<? if($page!=$totalpage){
			echo "<a href=\"../logbook/logwait_c.php".$querystring."page=$totalpage\"><img src=\"../resource/images/silkicons/resultset_last.gif\" width=\"16\" height=\"16\" border=0></a>";	 }
			}
			?>
			</td></tr></table>
		
		</td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF">
		<table width="100%"  border="0" cellpadding="2" cellspacing="2">
			<tr>
			    <td class="HeaderTable">Waiting</td>
			    <td class="HeaderTable">Last active</td>
			    <td class="HeaderTable">Order code</td>
			    <td class="HeaderTable">Last section</td>
			    <td class="HeaderTable">Last staff</td>

		      </tr>
			<? while(!$data_logbook->EOF){ ?>
			  <tr class="Normal" valign="top" >
			  <td><?= $data_logbook->Rs("log_datediff"); ?></td>
			  <td><?= $data_logbook->Rs("log_datef"); ?></td>
				<td>
				<a href="../order/orderdetail_c.php?eorderid=<?= $data_logbook->Rs("eorderid"); ?>"  target="_blank">
				<?= $data_logbook->Rs("ord_code"); ?></a></td>
				<td><?= $data_logbook->Rs("sec_room"); ?></td>
				<td><?= $data_logbook->Rs("stf_name"); ?></td>


			  </tr>
			<? $data_logbook->MoveNext();	} ?>
        </table></td>
      </tr>
      <tr>
        <td align="center" bgcolor="#FFFFFF">
		
		<table cellspacing="0" cellpadding="0"><tr><td width="50"><?
			if($totalpage>1){
			 if($page!=1){
			echo "<a href=\"../logbook/logwait_c.php".$querystring."page=1\"><img src=\"../resource/images/silkicons/resultset_first.gif\" width=\"16\" height=\"16\" border=0></a>";	 }
			?></td><td width="50"><?
			if($page>1){
			echo "<a href=\"../logbook/logwait_c.php".$querystring."page=".($page-1)."\"><img src=\"../resource/images/silkicons/resultset_previous.gif\" width=\"16\" height=\"16\" border=0></a>";	 }
			?></td><td align="center" width="300"><?
			for($p=max(1,$page-3);$p<=$page+3 && $p<=$totalpage;$p++){ 
					if($p==$page){
						echo "&nbsp;&nbsp;&nbsp;<strong>$p</strong>&nbsp;&nbsp;&nbsp;";
					}else{
						echo "&nbsp;&nbsp;<a href=\"../logbook/logwait_c.php".$querystring."page=$p\">$p</a>&nbsp;&nbsp;";		
					}
			} ?>
			</td><td width="50" align="right">
			<? if($page<$totalpage){
			echo "<a href=\"../logbook/logwait_c.php".$querystring."page=".($page+1)."\"><img src=\"../resource/images/silkicons/resultset_next.gif\" width=\"16\" height=\"16\" border=0></a>";	 }?>
			</td><td width="50" align="right">
			<? if($page!=$totalpage){
			echo "<a href=\"../logbook/logwait_c.php".$querystring."page=$totalpage\"><img src=\"../resource/images/silkicons/resultset_last.gif\" width=\"16\" height=\"16\" border=0></a>";	 }}?>
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
