<? include_once("../core/default.php"); ?>
<?
/* IN 
	$data_invoice >> invoice list
	
*/
?>


<html>
<title><?=WEBSITE_HEADER  ?></title>
<link href="../resource/css/default.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script>
//var popUpWin=0;

function popUpWindow(URLStr, left, top, width, height)
{
/*
  if(popUpWin)

  {

    if(!popUpWin.closed) popUpWin.close();

  }

  popUpWin = */
  open(URLStr, 'popUpWin'+new Date().getTime(), 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=1,resizable=yes,copyhistory=yes,width='+width+',height='+height+',left='+left+', top='+top+',screenX='+left+',screenY='+top+'');

}
</script>

<body>
<table width="100%" height="100%" cellspacing="0" cellpadding="0">
<tr><td height="50"><?  $currentMenu="invoicelist";include_once("../invoice/invoicemenu.php"); ?></td></tr>
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
              <td class="HeaderW"><img src="../resource/images/silkicons/group.gif"> Invoice list</td>
              <td class="Normal" align="right">Found <?=$totalrow?> in <?=$totalpage?> pages</td>
            </tr>
          </table></td>
      </tr>
	  <form action="../invoice/invoicelist_c.php" method="get">
      <tr>
        <td align="right" bgcolor="#FFFFFF" class="searchTD">Search 
          <input type="text" name="keyword" style="width:80" value="<?=$keyword?>">
          <input name="METHOD" type="submit" class="BTsearch" id="METHOD" value="GO!">
		  <input name="Stupid_IE_Bug" type="text" style="width:0;visibility:hidden" value="" size="1" >
		  </td>
      </tr>
	  </form>
      <tr>
        <td align="center" bgcolor="#FFFFFF">
					<?



		
			$querystring  = "?";
			foreach($_GET as $variable => $value){
				if($variable=="page")continue;
				//if($variable=="METHOD")continue;
				$querystring  .= "$variable=$value&";
			}
			?>
					<table cellspacing="0" cellpadding="0"><tr><td width="50"><?
					if($totalpage>1){
			 if($page!=1){
			echo "<a href=\"../invoice/invoicelist_c.php".$querystring."page=1\"><img src=\"../resource/images/silkicons/resultset_first.gif\" width=\"16\" height=\"16\" border=0></a></a>";	 }
			?></td><td width="50"><?
			if($page>1){
			echo "<a href=\"../invoice/invoicelist_c.php".$querystring."page=".($page-1)."\"><img src=\"../resource/images/silkicons/resultset_previous.gif\" width=\"16\" height=\"16\" border=0></a>";	 }
			?></td><td align="center" width="300"><?
			for($p=max(1,$page-3);$p<=$page+3 && $p<=$totalpage;$p++){ 
					if($p==$page){
						echo "&nbsp;&nbsp;&nbsp;<strong>$p</strong>&nbsp;&nbsp;&nbsp;";
					}else{
						echo "&nbsp;&nbsp;<a href=\"../invoice/invoicelist_c.php".$querystring."page=$p\">$p</a>&nbsp;&nbsp;";		
					}
			} ?>
			</td><td width="50" align="right">
			<? if($page<$totalpage){
			echo "<a href=\"../invoice/invoicelist_c.php".$querystring."page=".($page+1)."\"><img src=\"../resource/images/silkicons/resultset_next.gif\" width=\"16\" height=\"16\" border=0></a>";	 }?>
			</td><td width="50" align="right">
			<? if($page!=$totalpage){
			echo "<a href=\"../invoice/invoicelist_c.php".$querystring."page=$totalpage\"><img src=\"../resource/images/silkicons/resultset_last.gif\" width=\"16\" height=\"16\" border=0></a>";	 }}?>
			</td></tr></table>
		
		</td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF">
		<table width="100%"  border="0" cellpadding="2" cellspacing="2">
			<tr>
			    <td width="150" align="center" class="HeaderTable">No.</td>
			    <td class="HeaderTable">Customer</td>
			    
			    <td width="200" class="HeaderTable" >Date</td>
			    <td width="100" align="center" class="HeaderTable" >Net</td>
		      </tr>
			<? while(!$data_invoice->EOF){ ?>

			  <tr  valign="top" class="tdRowOnOut"
                onClick="popUpWindow('../invoice/invoicedetail_c.php?invoiceid=<?= $data_invoice->Rs("invoiceid"); ?>', 100, 100, 800, 600)" onMouseOver="this.className='tdRowOnOver'" onMouseOut="this.className='tdRowOnOut'">
				<td align="center">
				<?= $data_invoice->Rs("inv_no"); ?></td>
				<td>
				<?= $data_invoice->Rs("cus_name"); ?></td>
				<td><?= $data_invoice->Rs("inv_date"); ?></td>
				<td align="right">
				<?= $data_invoice->Rs("inv_net"); ?></td>
			  </tr>
			
			<? $data_invoice->MoveNext();	} ?>
        </table></td>
      </tr>
      <tr>
        <td align="center" bgcolor="#FFFFFF">
		
		<table cellspacing="0" cellpadding="0"><tr><td width="50"><?
		if($totalpage>1){
			 if($page!=1){
			echo "<a href=\"../invoice/invoicelist_c.php".$querystring."page=1\"><img src=\"../resource/images/silkicons/resultset_first.gif\" width=\"16\" height=\"16\" border=0></a>";	 }
			?></td><td width="50"><?
			if($page>1){
			echo "<a href=\"../invoice/invoicelist_c.php".$querystring."page=".($page-1)."\"><img src=\"../resource/images/silkicons/resultset_previous.gif\" width=\"16\" height=\"16\" border=0></a>";	 }
			?></td><td align="center" width="300"><?
			for($p=max(1,$page-3);$p<=$page+3 && $p<=$totalpage;$p++){ 
					if($p==$page){
						echo "&nbsp;&nbsp;&nbsp;<strong>$p</strong>&nbsp;&nbsp;&nbsp;";
					}else{
						echo "&nbsp;&nbsp;<a href=\"../invoice/invoicelist_c.php".$querystring."page=$p\">$p</a>&nbsp;&nbsp;";		
					}
			} ?>
			</td><td width="50" align="right">
			<? if($page<$totalpage){
			echo "<a href=\"../invoice/invoicelist_c.php".$querystring."page=".($page+1)."\"><img src=\"../resource/images/silkicons/resultset_next.gif\" width=\"16\" height=\"16\" border=0></a>";	 }?>
			</td><td width="50" align="right">
			<? if($page!=$totalpage){
			echo "<a href=\"../invoice/invoicelist_c.php".$querystring."page=$totalpage\"><img src=\"../resource/images/silkicons/resultset_last.gif\" width=\"16\" height=\"16\" border=0></a>";	 }}?>
			</td></tr></table>
		</td>
      </tr>
      <tr>
        <td class="FooterTD">&nbsp;</td>
      </tr>
    </table>
    <br>
    </td>
    <td width="20">&nbsp;</td>
  </tr>
  
</table>
</td></tr></table>
</body></html>
<? 
include_once '../core/inc_pngfix.php';
echo replacePngTags(ob_get_clean()); ?>