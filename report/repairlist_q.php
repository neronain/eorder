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
<tr><td height="50"><?  $currentMenu="repairorder";include_once("../report/reportmenu.php"); ?></td></tr>
<tr><td align="center" valign="top">
<table border="0" cellspacing="0" cellpadding="4">


<form name="FormOrderRepairList" action="repairlist_c.php" method="get" target="popUpWin">
<input type="hidden" name="searchtype" value="date">
  <tr>
    <td class="Normal">ตั้งแต่วันที่</td>
    <td align="left" class="Normal" colspan="2"><? 
	$today = getdate();
	
	$orddate_day=1;//$today['mday'];
	$orddate_month=$today['mon']; 
	$orddate_year=$today['year'];
	buildDateSelector('fromdate',$orddate_day,$orddate_month,$orddate_year)
	
	?></td>
    </tr>
  <tr>
    <td align="left" class="Normal">ถึงวันที่</td>
    <td align="left" class="Normal" colspan="2"><? 
	$today = getdate();
	
	$orddate_day=$today['mday'];
	$orddate_month=$today['mon']; 
	$orddate_year=$today['year'];
	buildDateSelector('enddate',$orddate_day,$orddate_month,$orddate_year)
	
	?></td>
    </tr>

<tr>
    <td align="right" class="Normal">
      <input type="checkbox" name="selectTypeChkBox" id="selectTypeChkBox" value ="1" onClick="findObj('divSelectType').style.display=(this.checked?'inline':'none')">
    </td>
    <td align="left" class="Normal"><label for="selectTypeChkBox">Select type     </label> </td>
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
    <td align="right" class="Normal">
      <input name="CountryChkBox" type="checkbox" id="CountryChkBox" value="1" onClick="findObj('divShowCountry').style.display=(this.checked?'inline':'none')">
    </label></td>
    <td align="left" class="Normal"><label for="CountryChkBox">Country</label></td>
    <td><div id="divShowCountry" style="display:none"><?  buildComboBoxList('country','country','countryid',array('cnt_name'),$country,"") ?></div></td>
    <td>&nbsp;</td>
  </tr>
   <tr>
    <td class="Normal">&nbsp;</td>
    <td align="center" class="Normal" colspan="2">
	<label><input type="radio" name="output_type" value="graph" checked="checked"/>Graph</label> &nbsp;
	<label><input type="radio" name="output_type" value="list" />List</label>

	</td>
  </tr>
  <tr>
    <td class="Normal">&nbsp;</td>
    <td align="center" class="Normal" colspan="2"><input type="button" class="BTok" value="SUBMIT" onClick=" popUpWindow('', 100, 100, 800, 600);FormOrderRepairList.submit()" ></td>
  </tr>
  </form>
<tr><td colspan="3">
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