<? include_once("../core/default.php"); ?>
<?
	$data_eorder = new Csql();
	$err =	$data_eorder->Connect();
	$query = "
		select DATE(ordt_arrivedate) as indate,ordt_priority as priority,count(*) as countrow from eordertoday
		where  
		
		ordt_isship=FALSE
		group by DATE(ordt_arrivedate),ordt_priority order by DATE(ordt_arrivedate),ordt_priority
		 ";
	
	$data_eorder->Query($query);


	$data_eorder2 = new Csql();
	$err =	$data_eorder2->Connect();
	$query = "
		select DATE(ordt_releasedate) as redate,ordt_priority as priority,count(*) as countrow from eordertoday
		where  
		
		ordt_isship=FALSE
		group by DATE(ordt_releasedate),ordt_priority order by DATE(ordt_releasedate),ordt_priority
		 ";
	
	$data_eorder2->Query($query);


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
<tr><td height="50"><?  $currentMenu="processorder";include_once("../report/reportmenu.php"); ?></td></tr>
<tr><td align="center" valign="top">
<table border="0" cellspacing="0" cellpadding="4">


<form name="FormOrderProcessList" action="orderprocesslist_c.php" method="get" target="popUpWin">
<input type="hidden" name="searchtype" value="date">
  <tr>
    <td width="80" class="Normal">By date</td>
    <td align="left" class="Normal">
    
	Select Date	</td>
    <td><? 
	$today = getdate();
	
	$orddate_day=$today['mday'];
	$orddate_month=$today['mon']; 
	$orddate_year=$today['year'];
	buildDateSelector('indate',$orddate_day,$orddate_month,$orddate_year)
	
	?></td>
    <td width="70"><input type="button" class="BTok" value="SUBMIT" onClick=" popUpWindow('', 100, 100, 800, 600);FormOrderProcessList.submit();"></td>
  </tr>
  <tr>
    <td align="right" class="Normal"><input type="checkbox" name="iscatagory" onClick="findObj('DivCatagory').style.display=(this.checked?'inline':'none');"  value="1"/></td>
    <td align="left" class="Normal">Select category</td>
    <td class="Normal">
    <div id = "DivCatagory" style="display:none;">
      <select name="ordpriority" id="ordpriority">
        <option value="A">A</option>
        <option value="B">B</option>
        <option value="C" selected>C</option>
        <option value="D">D</option>
        <option value="X">X</option>
      </select> </div>   </td>
    <td>&nbsp;</td>
  </tr>
  <!--tr>
    <td align="right" class="Normal"><input type="checkbox" name="issort" onClick="findObj('DivSort').style.display=(this.checked?'inline':'none')"  value="1"/></td>
    <td align="left" class="Normal">Sort</td>
    <td class="Normal">
    <div id = "DivSort" style="display:none;">
    	<select name="sort">
      <option value="cus" selected>Customer</option>
      <option value="sec">Section</option>
        </select></div></td>
    <td>&nbsp;</td>
  </tr-->
  <tr>
    <td align="right" class="Normal"><input type="checkbox" name="iscountry" onClick="findObj('DivCountry').style.display=(this.checked?'inline':'none')"  value="1"/></td>
    <td align="left" class="Normal">Country </td>
    <td class="Normal">
    <div id="DivCountry" style="display:none;">
	<?  buildComboBoxList('country','country','countryid',array('cnt_name'),$country,"") ?></div></td>
    <td>&nbsp;</td>
  </tr>
  <!--tr>
    <td class="Normal">&nbsp;</td>
    <td align="left" class="Normal">Country</td>
    <td><? // buildComboBoxList('country','country','countryid',array('cnt_name'),$country,"") ?></td>
    <td>&nbsp;</td>
  </tr-->
  </form>
<tr><td colspan="4">
<hr></td>
</tr>
</table>
<table width="700">
  <tr>
    <td align="center" valign="top">
Processing Order (Entry date)
  <table border="0" cellpadding="3" cellspacing="1" bgcolor="#000000" class="Normal">
  <tr>
    <td align="center" bgcolor="#FFFFFF">Entry date</td>
    <td width="30" align="center" bgcolor="#FFFFFF">A</td>
    <td width="30" align="center" bgcolor="#FFFFFF">B</td>
    <td width="30" align="center" bgcolor="#FFFFFF">C</td>
    <td width="30" align="center" bgcolor="#FFFFFF">D</td>
    <td width="30" align="center" bgcolor="#FFFFFF">X</td>
<?  $col=5;while(!$data_eorder->EOF){ 
	$cdate 		= substr($data_eorder->Rs("indate"),8,2);
	$cmonth 	= substr($data_eorder->Rs("indate"),5,2);
	$cyear 		= substr($data_eorder->Rs("indate"),0,4)+543;
	if($olddate != $data_eorder->Rs("indate")){ 
		$olddate = $data_eorder->Rs("indate");
		for($i=0;$i<5-$col;$i++){
			echo '<td align="right" bgcolor="#FFFFFF"></td>';
		}
		$col = 0;
	?>
	</tr><tr>
    <td align="center" bgcolor="#FFFFFF">
   
	<?= "$cdate/$cmonth/$cyear"?></td>	
<?	}
	$pr = $data_eorder->Rs("priority");
	$pad = 0;
	switch($pr){
		case 'A':$pad = 0;break;
		case 'B':$pad = 1;break;
		case 'C':$pad = 2;break;
		case 'D':$pad = 3;break;
		case 'X':$pad = 4;break;
	}
	if($col<$pad){
		for(;$col<$pad;$col++){
			echo '<td align="right" bgcolor="#FFFFFF"></td>';
		}
	}else{
		//$col++;
	}
?>
	
    <td align="right" bgcolor="#FFFFFF">
	 <a href="#" onClick="popUpWindow('../order/orderprocesslist_c.php?indate_day=<?=$cdate?>&indate_month=<?=$cmonth?>&indate_year=<?=$cyear-543?>&ordpriority=<?=$pr?>', 100, 100, 800, 600);">
	<?= $data_eorder->Rs("countrow")?>
	</a>
	</td>

<?  
  $col++;
  $data_eorder->MoveNext();	} 
  //echo $pad;
	for($col;$col<5;$col++){
		echo '<td align="right" bgcolor="#FFFFFF"></td>';
	}  
  
  ?>
  
  </tr>
</table>

</td>
  <td align="center" valign="top">

Processing Order (Release date)
  <table border="0" cellpadding="3" cellspacing="1" bgcolor="#000000" class="Normal">
  <tr>
    <td align="center" bgcolor="#FFFFFF">Release date</td>
    <td width="30" align="center" bgcolor="#FFFFFF">A</td>
    <td width="30" align="center" bgcolor="#FFFFFF">B</td>
    <td width="30" align="center" bgcolor="#FFFFFF">C</td>
    <td width="30" align="center" bgcolor="#FFFFFF">D</td>
    <td width="30" align="center" bgcolor="#FFFFFF">X</td>
<?  $col=5;while(!$data_eorder2->EOF){ 
	$cdate 		= substr($data_eorder2->Rs("redate"),8,2);
	$cmonth 	= substr($data_eorder2->Rs("redate"),5,2);
	$cyear 		= substr($data_eorder2->Rs("redate"),0,4)+543;
	if($olddate != $data_eorder2->Rs("redate")){ 
		$olddate = $data_eorder2->Rs("redate");
		for($i=0;$i<5-$col;$i++){
			echo '<td align="right" bgcolor="#FFFFFF"></td>';
		}
		$col = 0;
	?>
	</tr><tr>
    <td align="center" bgcolor="#FFFFFF">
   
	<?= "$cdate/$cmonth/$cyear"?></td>	
<?	}
	$pr = $data_eorder2->Rs("priority");
	$pad = 0;
	switch($pr){
		case 'A':$pad = 0;break;
		case 'B':$pad = 1;break;
		case 'C':$pad = 2;break;
		case 'D':$pad = 3;break;
		case 'X':$pad = 4;break;
	}
	if($col<$pad){
		for(;$col<$pad;$col++){
			echo '<td align="right" bgcolor="#FFFFFF"></td>';
		}
	}else{
		//$col++;
	}
?>
	
    <td align="right" bgcolor="#FFFFFF"><? //=$col.' :'.$pad?>
	 <!--a href="orderprocesslist_c.php?redate_day=<?=$cdate?>&redate_month=<?=$cmonth?>&redate_year=<?=$cyear-543?>&ordpriority=<?=$pr?>" target="_blank"-->
	<?= $data_eorder2->Rs("countrow")?>
    <!--/a-->
    </td>

<?  
  $col++;
  $data_eorder2->MoveNext();	} 
  //echo $pad;
	for($col;$col<5;$col++){
		echo '<td align="right" bgcolor="#FFFFFF"></td>';
	}  
  
  ?>
  
  </tr>
</table>


</td>
  </tr></table>
<br>
<br></td>
</tr></table>
</body></html>
<? 
include_once '../core/inc_pngfix.php';
echo replacePngTags(ob_get_clean()); ?>