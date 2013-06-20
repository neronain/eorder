<? include_once("../core/default.php"); ?>
<html>
<title><?=WEBSITE_HEADER  ?></title>
<link href="../resource/css/default.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="../resource/javascript/ajax.js"></script>
<script src="../resource/javascript/default.js"></script>
<body style="background-color:#FFFFFF">

<script>
var popUpWin=0;
function popUpWindow(URLStr, left, top, width, height){
  if(popUpWin){   if(!popUpWin.closed) popUpWin.close(); }
  popUpWin = open(URLStr, 'popUpWin', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width='+width+',height='+height+',left='+left+', top='+top+',screenX='+left+',screenY='+top+'');
}
</script>

<table width="100%" height="100%" cellspacing="0" cellpadding="0">
<tr><td height="50"><?  $currentMenu="home";?><? include_once("../order/ordermenu.php"); ?></td></tr>
<tr>
  <td align="center" valign="top" ><br>
     <form action="orderlist_c.php" method="get">
Search  for 
		<select name="column">
		<option value="ord_code" <?=$column=='ord_code'?"selected":"" ?>>Order code </option>
		<option value="cus_name" <?=$column=='cus_name'?"selected":"" ?>>Customer name</option>
		<option value="doc_name" <?=$column=='doc_name'?"selected":"" ?>>Doctor name</option>
		<option value="ord_patientname" <?=$column=='ord_patientname'?"selected":"" ?>>Patient name</option>
		
        
        
		</select>
		<? /*
          <input type="checkbox" name="filter[]" value="cus_name" 
		  <?=isset($filter) && array_search('cus_name',$filter)>-1?"checked":""?>>Customer  
          <input type="checkbox" name="filter[]" value="doc_name" 
		  <?=isset($filter) && array_search('doc_name',$filter)>-1?"checked":""?>>Doctor
          <input type="checkbox" name="filter[]" value="ord_patientname" 
		  <?=isset($filter) && array_search('ord_patientname',$filter)>-1?"checked":""?>>Patient's name */
		  ?>
		 <input type="hidden" name="status" value="0">
          <input type="text" name="keyword" style="width:120;" value="<?=$firstID>0?"":$keyword?>">
          <input name="METHOD" type="submit" class="BTsearch" id="METHOD" value="GO!">
		   <input name="Stupid_IE_Bug" type="text" style="width:0;visibility:hidden" value="" size="1" >		

	  </form>
    
    
    <table width="600" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td valign="top"><table border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td align="center"><table width="200" border="0" cellpadding="0" cellspacing="1" bgcolor="#999999">
                <tr>
                  <td height="30" align="center" class="tdButtonOnOut" 
            onmouseover="this.className='tdButtonOnOver'" 
            onmouseout="this.className='tdButtonOnOut'"
			onclick="javascript:location='../order/orderadd_c.php';"><a href="../order/orderadd_c.php"><img src="../resource/images/silkicons/package_add.gif" border="0" /></a> Add order</td>
                </tr>
            </table></td>
          </tr>
          <tr>
            <td height="20" align="center"><img src="../resource/images/silkicons/arrow_down.gif" width="16" height="16" /></td>
          </tr>
          <tr>
            <td align="center"><table width="200" border="0" cellpadding="0" cellspacing="1" bgcolor="#999999">
                <tr>
                  <td height="30" align="center" class="tdButtonOnOut" 
            onmouseover="this.className='tdButtonOnOver'" 
            onmouseout="this.className='tdButtonOnOut'"
			onclick="javascript:location='../order/orderlist_c.php?status=0';"><a href="../order/orderadd_c.php"><img src="../resource/images/silkicons/script.gif" border="0" /></a> Draft</td>
                </tr>
            </table></td>
          </tr>
          <tr>
            <td height="25" align="center"><img src="../resource/images/silkicons/arrow_down.gif" width="16" height="16" /></td>
          </tr>
          <tr>
            <td align="center"><table width="200" border="0" cellpadding="0" cellspacing="1" bgcolor="#999999">
                <tr>
                  <td height="30" align="center" class="tdButtonOnOut" 
            onmouseover="this.className='tdButtonOnOver'" 
            onmouseout="this.className='tdButtonOnOut'"
			onclick="javascript:location='../order/orderlist_c.php?status=1';"><a href="../order/orderadd_c.php"><img src="../resource/images/silkicons/lorry_go.gif" border="0" /></a> Sending</td>
                </tr>
            </table></td>
          </tr>
          <tr>
            <td height="25" align="center"><img src="../resource/images/silkicons/arrow_down.gif" width="16" height="16" /></td>
          </tr>
          <tr>
            <td align="center"><table width="200" border="0" cellpadding="0" cellspacing="1" bgcolor="#999999">
                <tr>
                  <td height="30" align="center" class="tdButtonOnOut" 
            onmouseover="this.className='tdButtonOnOver'" 
            onmouseout="this.className='tdButtonOnOut'"
			onclick="javascript:location='../order/orderlist_c.php?status=2';"><a href="../order/orderadd_c.php"><img src="../resource/images/silkicons/box.gif" border="0" /></a> Arrived</td>
                </tr>
            </table></td>
          </tr>
          <tr>
            <td height="25" align="center"><img src="../resource/images/silkicons/arrow_down.gif" width="16" height="16" /></td>
          </tr>

        </table></td>
        <td valign="bottom"><br />
            <br />
            <table border="0" align="center" cellpadding="0" cellspacing="0">

          <tr>
            <td height="25" align="center"><img src="../resource/images/silkicons/arrow_down.gif" width="16" height="16" /></td>
          </tr>
          <tr>
            <td align="center"><table width="200" border="0" cellpadding="0" cellspacing="1" bgcolor="#999999">
                <tr>
                  <td height="30" align="center" class="tdButtonOnOut" 
            onmouseover="this.className='tdButtonOnOver'" 
            onmouseout="this.className='tdButtonOnOut'"
			onclick="javascript:location='../order/orderlist_c.php?status=3';"><a href="../order/orderadd_c.php"><img src="../resource/images/silkicons/cog.gif" border="0" /></a> Processing</td>
                </tr>
            </table></td>
          </tr>
          <tr>
            <td height="25" align="center"><img src="../resource/images/silkicons/arrow_down.gif" width="16" height="16" /></td>
          </tr>
          <tr>
            <td align="center"><table width="200" border="0" cellpadding="0" cellspacing="1" bgcolor="#999999">
                <tr>
                  <td height="30" align="center" class="tdButtonOnOut" 
            onmouseover="this.className='tdButtonOnOver'" 
            onmouseout="this.className='tdButtonOnOut'"
			onclick="javascript:location='../order/orderlist_c.php?status=4';"><a href="../order/orderadd_c.php"><img src="../resource/images/silkicons/lorry_gor.gif" border="0" /></a> Released</td>
                </tr>
            </table></td>
          </tr>
          <tr>
            <td height="25" align="center"><img src="../resource/images/silkicons/arrow_down.gif" width="16" height="16" /></td>
          </tr>
          <tr>
            <td align="center"><table width="200" border="0" cellpadding="0" cellspacing="1" bgcolor="#999999">
                <tr>
                  <td height="30" align="center" class="tdButtonOnOut" 
            onmouseover="this.className='tdButtonOnOver'" 
            onmouseout="this.className='tdButtonOnOut'"
			onclick="javascript:location='../order/orderlist_c.php?status=5';"><a href="../order/orderadd_c.php"><img src="../resource/images/silkicons/money.gif" border="0" /></a> Wait payment</td>
                </tr>
            </table></td>
          </tr>
          <tr>
            <td height="25" align="center"><img src="../resource/images/silkicons/arrow_down.gif" width="16" height="16" /></td>
          </tr>
          <tr>
            <td align="center"><table width="200" border="0" cellpadding="0" cellspacing="1" bgcolor="#999999">
                <tr>
                  <td height="30" align="center" class="tdButtonOnOut" 
            onmouseover="this.className='tdButtonOnOver'" 
            onmouseout="this.className='tdButtonOnOut'"
			onclick="javascript:location='../order/orderlist_c.php?status=6';"><a href="../order/orderadd_c.php"><img src="../resource/images/silkicons/flag_green.gif" border="0" /></a> Wait confirm</td>
                </tr>
            </table></td>
          </tr>
          <tr>
            <td height="25" align="center"><img src="../resource/images/silkicons/arrow_down.gif" width="16" height="16" /></td>
          </tr>
          <tr>
            <td align="center"><table width="200" border="0" cellpadding="0" cellspacing="1" bgcolor="#999999">
                <tr>
                  <td height="30" align="center" class="tdButtonOnOut" 
            onmouseover="this.className='tdButtonOnOver'" 
            onmouseout="this.className='tdButtonOnOut'"
			onclick="javascript:location='../order/orderlist_c.php?status=7';"><a href="../order/orderadd_c.php"><img src="../resource/images/silkicons/compress.gif" border="0" /></a> Archieve</td>
                </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
    </table>
    <br />
    <br />
     <a href="#" onclick="popUpWindow('../mac5/mac5invoice.php', 100, 100, 1024, 768)">
	  ส่งข้อมูลเข้า MAC5</a>  
      
      
    </td>
</tr></table>
<? 
include_once '../core/inc_pngfix.php';
echo replacePngTags(ob_get_clean()); ?>