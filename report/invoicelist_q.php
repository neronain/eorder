<? include_once("../core/default.php"); ?>
<?

/*
	$data_eorder = new Csql();
	$err =	$data_eorder->Connect();
	$query = "
		select DATE(ordt_releasedate) as releasedate,count(*) as countrow from eordertoday
		where  
		
		ordt_isship=FALSE
		group by DATE(ordt_releasedate) order by releasedate
		 ";
	//DATEDIFF(CURDATE(),DATE(ordt_releasedate))>-5  and 
	
	$data_eorder->Query($query);
	
	//$expireOrder = $data_eorder->Rs("countrow")+0;
	
//where DATE(log_date)  =  CURDATE()

/* IN 
	$data_order >> order list
	
*/
?>


<html>
<title><?=WEBSITE_HEADER  ?></title>
<link href="../resource/css/default.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="../resource/javascript/default.js"></script>
<script>
var popUpWin = 0;
function popUpWindow(URLStr, left, top, width, height)
{

  if(popUpWin)

  {

    if(!popUpWin.closed) popUpWin.close();

  }
  popUpWin =  open(URLStr, 'popUpWin', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=1,resizable=yes,copyhistory=yes,width='+width+',height='+height+',left='+left+', top='+top+',screenX='+left+',screenY='+top+'');

}
</script>
<body>

<table width="100%" height="100%" cellspacing="0" cellpadding="0">
<tr><td height="50"><?  $currentMenu="invoiceorder";include_once("../report/reportmenu.php"); ?></td></tr>
<tr><td align="center" valign="top">
<table border="0" cellspacing="0" cellpadding="4">


<form name="FormOrderInvoiceList" action="invoicelist_c.php" method="get" target="popUpWin">
<input type="hidden" name="searchtype" value="date">
  <tr>
    <td class="Normal">ตั้งแต่วันที่</td>
    <td align="left" class="Normal"><? 
	$today = getdate();
	
	$orddate_day=1;//$today['mday'];
	$orddate_month=$today['mon']; 
	$orddate_year=$today['year'];
	buildDateSelector('fromdate',$orddate_day,$orddate_month,$orddate_year)
	
	?></td>
    </tr>
  <tr>
    <td align="left" class="Normal">ถึงวันที่</td>
    <td align="left" class="Normal"><? 
	$today = getdate();
	
	$orddate_day=$today['mday'];
	$orddate_month=$today['mon']; 
	$orddate_year=$today['year'];
	buildDateSelector('enddate',$orddate_day,$orddate_month,$orddate_year)
	
	?></td>
    </tr>
  <tr>
    <td class="Normal">&nbsp;</td>
    <td align="right" class="Normal"><input type="button" class="BTok" value="SUBMIT" onClick=" popUpWindow('', 100, 100, 800, 600);FormOrderInvoiceList.submit()" ></td>
  </tr>
  </form>
<tr><td colspan="2">
<hr></td>
</tr>
</table>

<br>
<br>
<br>
<br></td>
</tr></table>
</body></html>
<? 
include_once '../core/inc_pngfix.php';
echo replacePngTags(ob_get_clean()); ?>