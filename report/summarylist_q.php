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
<tr><td height="50"><?  $currentMenu="summaryorder";include_once("../report/reportmenu.php"); ?></td></tr>
<tr><td align="center" valign="top">
<table border="0" cellspacing="0" cellpadding="4">


<form name="FormOrderExportList" action="summarylist_c.php" method="get" target="popUpWin">
<input type="hidden" name="searchtype" value="date">
  <tr>
    <td class="Normal">ค้นหาจาก</td>
    <td class="Normal"><label>
      <input type="radio" name="order" value="arrive" checked>
	   วันที่เข้า</label>
        <label>
        <input type="radio" name="order" value="release">
          วันที่ส่ง</label>
        <!--label>
        <input type="radio" name="order" value="delivery">
          วันที่ส่ง</label--></td>
  </tr>
  <tr>
    <td class="Normal">ตั้งแต่วันที่</td>
    <td align="left" class="Normal"><? 
	$today = getdate();
	
	$orddate_day=1;//$today['mday'];
	$orddate_month=$today['mon']; 
	$orddate_year=$today['year'];
	buildDateSelector('exdate',$orddate_day,$orddate_month,$orddate_year)
	
	?></td>
    </tr>
  <tr>
    <td align="left" class="Normal">ถึงวันที่</td>
    <td align="left" class="Normal"><? 
	$today = getdate();
	
	$orddate_day=$today['mday'];
	$orddate_month=$today['mon']; 
	$orddate_year=$today['year'];
	buildDateSelector('endate',$orddate_day,$orddate_month,$orddate_year)
	
	?></td>
    </tr>
  <tr>
    <td align="left" class="Normal"><label>
      <input type="checkbox" name="selectTypeChkBox" id="selectTypeChkBox" value ="1" onClick="findObj('divSelectType').style.display=(this.checked?'inline':'none')">
      Select type    </label></td>
    <td align="left" class="Normal">
      <div id = divSelectType style="display:none">
        <select name="type">
          <option value="F">Fix Only</option>
          <option value="R">Remove Only</option>
          <option value="O">Ortho Only</option>
          <option value="M">Mix</option>
          </select>
      </div></td>
    </tr>
    <tr>
        <td align="left" class="Normal"><label>
                <input name="BranchChkBox" type="checkbox" id="BranchChkBox" value="1" onClick="findObj('divShowBranch').style.display=(this.checked?'inline':'none')">
                Branch </label></td>

        <td><div id="divShowBranch" style="display:none"><?  buildComboBoxList('branch','branch','branchid',array('branch_name'),$userbrnid,"") ?></div></td>
        <td>&nbsp;</td>
    </tr>
    <tr>
  <tr>
    <td align="left" class="Normal"><label>
      <input name="CountryChkBox" type="checkbox" id="CountryChkBox" value="1" onClick="findObj('divShowCountry').style.display=(this.checked?'inline':'none')">
      Country    </label></td>
    <td align="left" class="Normal"><div id="divShowCountry" style="display:none"><?  buildComboBoxList('country','country','countryid',array('cnt_name'),$country,"") ?>
    </div></td>
    </tr>
  <tr>
  <td class="Normal">Output</td>
  <td class="Normal"><label>
    <input type="radio" name="output" value="web" checked>
    Web</label>
    <label>
    <input type="radio" name="output" value="excel">
    Excel</label></td>
  </tr>
  <tr>
    <td class="Normal">&nbsp;</td>
    <td align="right" class="Normal"><input type="button" class="BTok" value="SUBMIT" onClick=" popUpWindow('', 100, 100, 800, 600);FormOrderExportList.submit()" ></td>
  </tr>
  </form>
<tr><td colspan="2">
<hr></td>
</tr>
<form action="orderexportlist_c.php" method="get" target="_blank" name="formsearchtype">
<input type="hidden" name="searchtype" value="typeofwork">
<input type="hidden" name="type" value="M">
<input type="hidden" name="enableC" value="CountryChkBox">
  </form>
</table>

<br>
<br>
<font color="#FF0000">ใช้ output แบบ excel ดีกว่านะครับเอาไปทำรายงานง่ายกว่า<br>
ผมลองใช้ดูแล้วไม่มีปัญหา<br>
<br>
วันนี้ถ้าใช้ไม่ได้ รีบโทรหาผมนะครับ<br>
0867083309<br>
ความหมายรายละเอียดงาน </font><br>
<table border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>F:  Fix<br>
R:  Remove<br>
O:  Remove<br>
{T} Try-in<br>
{C} Contour<br>
{F} Finish<br>
{R} Repair<br>
{M} Rework/Remake/Remake & Finish<br>
{S} Setup<br>
{B} BiteBlock<br>

</td>
  </tr>
</table>
<br>
<br></td>
</tr></table>
</body></html>
<? 
include_once '../core/inc_pngfix.php';
echo replacePngTags(ob_get_clean()); ?>