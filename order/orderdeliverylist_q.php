<? include_once("../core/default.php"); ?>
<?


	$data_eorder = new Csql();
	$err =	$data_eorder->Connect();
	$query = "
		select DATE(ordt_deliverydate) as deliverydate,count(*) as countrow from eordertoday
		where  
		
		ordt_isship=FALSE
		group by DATE(ordt_deliverydate) order by deliverydate
		 ";
	//DATEDIFF(CURDATE(),DATE(ordt_deliverydate))>-5  and 
	
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
<tr><td height="50"><?  $currentMenu="deliveryorder";include_once("../report/reportmenu.php"); ?></td></tr>
<tr><td align="center" valign="top">
<table border="0" cellspacing="0" cellpadding="4">


<form name="FormOrderDeliveryList" action="orderdeliverylist_c.php" method="get" target="popUpWin">
<input type="hidden" name="searchtype" value="date">
  <tr>
    <td width="80" class="Normal">ตามวันที่</td>
    <td align="left" class="Normal">
    
	Select Date	</td>
    <td><? 
	$today = getdate();
	
	$orddate_day=$today['mday'];
	$orddate_month=$today['mon']; 
	$orddate_year=$today['year'];
	buildDateSelector('exdate',$orddate_day,$orddate_month,$orddate_year)
	
	?></td>
    <td width="70"><input type="button" class="BTok" value="SUBMIT" onClick=" popUpWindow('', 100, 100, 800, 600);FormOrderDeliveryList.submit()" ></td>
  </tr>
  <tr>
    <td align="right" class="Normal"><label>
      <input type="checkbox" name="selectTypeChkBox" id="selectTypeChkBox" value ="1" onClick="findObj('divSelectType').style.display=(this.checked?'inline':'none')">
    </label></td>
    <td align="left" class="Normal">Select type      </td>
    <td class="Normal">
    <div id = divSelectType style="display:none">
      <select name="type">
        <option value="F">Fix Only</option>
        <option value="R">Remove Only</option>
        <option value="O">Ortho Only</option>
        <option value="M">Mix</option>
      </select></div>    </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right" class="Normal"><label>
      <input name="CountryChkBox" type="checkbox" id="CountryChkBox" value="1" onClick="findObj('divShowCountry').style.display=(this.checked?'inline':'none')">
    </label></td>
    <td align="left" class="Normal">Country</td>
    <td><div id="divShowCountry" style="display:none"><?  buildComboBoxList('country','country','countryid',array('cnt_name'),$country,"") ?></div></td>
    <td>&nbsp;</td>
  </tr>
  </form>
<tr><td colspan="4">
<hr></td>
</tr>
<form action="orderdeliverylist_c.php" method="get" target="_blank" name="formsearchtype">
<input type="hidden" name="searchtype" value="typeofwork">
<input type="hidden" name="type" value="M">
<input type="hidden" name="enableC" value="CountryChkBox">
  </form>
</table>

<br>
Order ที่ยังไม่ส่ง
<table border="0" cellpadding="3" cellspacing="1" bgcolor="#000000" class="Normal">
  <tr>
    <td align="center" bgcolor="#FFFFFF">วันที่</td>
    <td align="center" bgcolor="#FFFFFF">จำนวน</td>
    <td align="center" bgcolor="#FFFFFF">วันที่</td>
    <td align="center" bgcolor="#FFFFFF">จำนวน</td>
    <td align="center" bgcolor="#FFFFFF">วันที่</td>
    <td align="center" bgcolor="#FFFFFF">จำนวน</td>
    <td align="center" bgcolor="#FFFFFF">วันที่</td>
    <td align="center" bgcolor="#FFFFFF">จำนวน</td>
    <td align="center" bgcolor="#FFFFFF">วันที่</td>
    <td align="center" bgcolor="#FFFFFF">จำนวน</td>
  </tr><tr>
<?  $i=0;$column=5;while(!$data_eorder->EOF){ 
	$cdate 		= substr($data_eorder->Rs("deliverydate"),8,2);
	$cmonth 	= substr($data_eorder->Rs("deliverydate"),5,2);
	$cyear 		= substr($data_eorder->Rs("deliverydate"),0,4)+543;

?>
  
    <td align="center" bgcolor="#FFFFFF">
    <a href="#" onClick="popUpWindow('../order/orderdeliverylist_expire.php?edate=<?= $data_eorder->Rs("deliverydate")?>', 100, 100, 800, 600);">
	<?= "$cdate/$cmonth/$cyear"?></a></td>
    
    <? 
		$today = getdate(); 
		$hl = ($cdate - $today["mday"]==0 && $cmonth - $today["mon"]==0 && $cyear - $today["year"]-543==0);
	
	
	?>
    
    <td align="right" bgcolor="<?=$hl?"#FFCCCC":"#FFFFFF"?>"><?= $data_eorder->Rs("countrow")?></td>
    
    
    
    <? if($i++%$column==($column-1)){?>
  </tr><tr>
	<?  }?>
  <? $data_eorder->MoveNext();	} ?>
  <? //if($i%3!=0){?>
  <td colspan="<?=($column-$i%$column)*2?>" bgcolor="#FFFFFF"></td>
  <? // }else{ ?>
  </tr>
</table>
<br></td>
</tr></table>
</body></html>
<? 
include_once '../core/inc_pngfix.php';
echo replacePngTags(ob_get_clean()); ?>