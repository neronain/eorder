<? include_once("../core/default.php"); ?>
<?
if($_GET['act']=='rand'){
	
	$cdate 		= $_GET["fromdate_day"];
	$cmonth 	= $_GET["fromdate_month"];
	$cyear 		= $_GET["fromdate_year"];
	
	$edate 		= $_GET["enddate_day"];
	$emonth 	= $_GET["enddate_month"];
	$eyear 		= $_GET["enddate_year"];
	
	while(strlen($cdate)<2 && strlen($cdate)>0){
		$cdate = "0".$cdate;
	}
	while(strlen($cmonth)<2 && strlen($cmonth)>0){
		$cmonth = "0".$cmonth;
	}
	while(strlen($edate)<2 && strlen($edate)>0){
		$edate = "0".$edate;
	}
	while(strlen($emonth)<2 && strlen($emonth)>0){
		$emonth = "0".$emonth;
	}
	
	
	$data_eorder_m5m = new Csql();
	$err =	$data_eorder_m5m->Connect();
	$initQuery = "
			from eorder_m5m
			where  
			m5m_date between  '$cyear-$cmonth-$cdate'  and  '$eyear-$emonth-$edate'
			
			 ";
	//DATEDIFF(CURDATE(),DATE(ordt_releasedate))>-5  and
	$cquery = "select count(*) $initQuery ";
	
	$query = "select * $initQuery order by RAND() limit 1 ";
	//$data_eorder_m5m->Query($query);
	
	$record = $data_eorder_m5m->ExecuteARecord($query);
	
	$recordCount = $data_eorder_m5m->ExecuteScalar($cquery);
	
	if($record!=NULL){
		$data_eorder = new Csql();
		$err =	$data_eorder->Connect();
		$query = "
					select * from eorder
					where  
					eorderid =  '".$record['eorder_m5mid']."' limit 1 
					 ";
		$eorder = $data_eorder->ExecuteARecord($query);
		
		$data_tmp = new Csql();
		
		$rowAr = $eorder;
		$key = $rowAr['ord_cus_id'];
		if($cache['customer'][$key]==NULL){
			$tmpRow = $data_tmp->ExecuteARecord("select customerid,cus_name,cus_prv_id,cus_cnt_id from customer where customerid = {$key} limit 0,1");
			$cache['customer'][$key] = $tmpRow;
		}
		
		$rowAr['customerid'] = $cache['customer'][$key]["customerid"];
		$rowAr['cus_name'] = $cache['customer'][$key]["cus_name"];
		$rowAr['cus_prv_id'] = $cache['customer'][$key]["cus_prv_id"];
		$rowAr['cus_cnt_id'] = $cache['customer'][$key]["cus_cnt_id"];
		
		$key = $rowAr['ord_doc_id'];
		if($cache['doctor'][$key]==NULL){
			$tmpRow = $data_tmp->ExecuteARecord("select doc_name from doctor where doctorid = {$key} limit 0,1");
			$cache['doctor'][$key] = $tmpRow;
		}
		$rowAr['doc_name'] = $cache['doctor'][$key]["doc_name"];
		
		$key = $rowAr['cus_prv_id'];
		if($cache['province'][$key]==NULL){
			$tmpRow = $data_tmp->ExecuteARecord("select prv_name from province where provinceid = {$key} limit 0,1");
			$cache['province'][$key] = $tmpRow;
		}
		$rowAr['prv_name'] = $cache['province'][$key]["prv_name"];
			
		
	}
		
	
}
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
<tr><td height="50"><?  $currentMenu="random";include_once("../report/reportmenu.php"); ?></td></tr>
<tr><td align="center" valign="top">
<table border="0" cellspacing="0" cellpadding="4">


<form name="FormRandomInvoice" action="random.php" method="get">
<input type="hidden" name="searchtype" value="invoice">
<input type="hidden" name="act" value="rand">
<tr>
<td colspan="2" align="center">สุ่มหมายเลข Invoice</td>
</tr>
<tr><td colspan="2">
<hr></td>
</tr>
  <tr>
    <td class="Normal">ตั้งแต่วันที่</td>
    <td align="left" class="Normal"><? 
	$today = getdate();
	
	if($cyear>0){
		$orddate_day=$cdate;
		$orddate_month=$cmonth; 
		$orddate_year=$cyear;
	}else{
		$orddate_day=1;
		$orddate_month=$today['mon'];
		$orddate_year=$today['year'];
	}
	buildDateSelector('fromdate',$orddate_day,$orddate_month,$orddate_year)
	
	?></td>
    </tr>
  <tr>
    <td align="left" class="Normal">ถึงวันที่</td>
    <td align="left" class="Normal"><? 
	$today = getdate();
	if($eyear>0){
		$orddate_day=$edate;
		$orddate_month=$emonth;
		$orddate_year=$eyear;
	}else{
		$orddate_day=$today['mday'];
		$orddate_month=$today['mon']; 
		$orddate_year=$today['year'];
	}
	buildDateSelector('enddate',$orddate_day,$orddate_month,$orddate_year)
	
	?></td>
    </tr>
  <tr>
    <td class="Normal">&nbsp;</td>
    <td align="right" class="Normal"><input type="button" class="BTok" value="SUBMIT" onClick="FormRandomInvoice.submit(); return false;" ></td>
  </tr>
  </form>
<tr><td colspan="2">
<hr></td>

</tr>
</table>
<table border="0" cellspacing="0" cellpadding="4">

<tr><td colspan="2">

<? if($record!=NULL){ 

	//var_dump($eorder);
	?>
สุ่มจากข้อมูลทั้งหมด: <?=$recordCount?> หมายเลข<br/><br/>
<strong>ผู้โชคดี</strong><br/>
หมายเลข Invoice: <?=$record['m5m_no'] ?><br/>
ลงวันที่: <?=date('d/m/Y',strtotime($record['m5m_date'])) ?><br/>
รหัสลูกค้า: <?=$record['m5m_cum_code'] ?><br/>
ลูกค้า: <?=$rowAr['cus_name']?><br/>
หมอ: <?=$rowAr['doc_name']?><br/>
จังหวัด: <?=$rowAr['prv_name']?><br/>


<? }elseif($_GET['act']=='rand'){ ?>
ไม่พบข้อมูลสำหรับค้นหา กรุณาเปลี่ยนวันที่
<? } ?>



</td>




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