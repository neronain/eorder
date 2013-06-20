<? include_once("../core/default.php"); 

include_once("../eorder/eorder_repairrework_conftable.php");
?>


<html>
<title><?=WEBSITE_HEADER  ?></title>
<link href="../resource/css/default.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<body style="background-color:#FFFFFF">
<? /* */include_once("../cfrontend/ordersummary.php"); ?>
<? /* */ include_once "../resource/divbackground.php" ?>
<center> 
  <strong><span class="Normal"><font size="+2">Order repair list<br>
Date :
  <?=($cdate+0)?> <?=passThaiMonth($cmonth)?> <?=passThaiYear($cyear)?> - 
  <?=($edate+0)?> <?=passThaiMonth($emonth)?> <?=passThaiYear($eyear)?>
</font> </span></strong></center>
		<table  border="0" align="center" cellpadding="2" cellspacing="1" bgcolor="#000000" id="exporttb">
<tr>

<td rowspan="2" class="HeaderTable">&nbsp;</td>

    <td rowspan="2" align="center" valign="middle" class="HeaderTable" style="font-size:12px;font-weight:normal">Problem<br />
    ปัญหาที่พบ</td>
    <td rowspan="2" align="center" valign="middle" class="HeaderTable" style="font-size:12px;font-weight:normal">Cause of defect<br />
    สาเหตุของปัญหา</td>
    
    <td rowspan="2" align="center" valign="middle" class="HeaderTable" style="font-size:12px;font-weight:normal">Order</td>
<td rowspan="2" align="center" valign="middle" class="HeaderTable" style="font-size:12px;font-weight:normal">Work</td>
<td rowspan="2" align="center" valign="middle" class="HeaderTable" style="font-size:12px;font-weight:normal">Date</td>

          <td height="20" colspan="2" align="center" valign="middle" class="HeaderTable" style="font-size:12px;font-weight:normal">แก้ไขโดย</td>
          <td rowspan="2" align="center" valign="middle" class="HeaderTable" style="font-size:12px;font-weight:normal">Detect by<br />
    ผู้ตรวจพบ</td>
    <td rowspan="2" align="center" valign="middle" class="HeaderTable" style="font-size:12px;font-weight:normal">Supervisor<br />
    ผู้อนุมัติ</td>
        </tr>
        <tr height="20">
          <td height="20" align="center" valign="middle" class="HeaderTable" style="font-size:12px;font-weight:normal">ซ่อม</td>
          <td align="center" valign="middle" class="HeaderTable" style="font-size:12px;font-weight:normal">ทำใหม่</td>
</tr>

<? 

$countarray = array();
$isprintarray = array();
while(!$data_order->EOF){ 
	$countarray[$data_order->Rs("eorder_repairrework_defectcode")]++;
	$data_order->MoveNext();	 
}

$index=1;
$data_order->MoveFirst();
while(!$data_order->EOF){ 

?>
			  <tr valign="top" bgcolor="#FFFFFF" class="Normal" >
<? if(!$isprintarray[$data_order->Rs("eorder_repairrework_defectcode")]){
	$isprintarray[$data_order->Rs("eorder_repairrework_defectcode")] = true;


	$defectcode = $data_order->Rs("eorder_repairrework_defectcode");
    if($glo_defectcode_table[$defectcode]!=NULL){
  		$defectcode_text = $defectcode.":".$glo_defectcode_table[$defectcode];
  	}else{
  		$defectcode_text = "";
  	}
  ?>	
  
  
				<td align="right" rowspan="<?=$countarray[$data_order->Rs("eorder_repairrework_defectcode")]?>"><? // $index++ ?><?=$defectcode?>
<? } ?>                
                 
               	</td>               
               	<td nowrap><?=$defectcode_text?><?= $data_order->Rs('eorder_repairrework_problem'); ?></td>
				<td nowrap><?= $data_order->Rs("eorder_repairrework_remark"); ?> </td>
<td  class="tdRowOnOut"  rowspan="<?=$countarray[$data_order->Rs("eorderid")]?>" onClick="OpenDivShowSummary(<?= $data_order->Rs("eorderid")?>)" onMouseOver="this.className='tdRowOnOver'" onMouseOut="this.className='tdRowOnOut'">
				<span style="color: #0000FF"><?= $data_order->Rs("ord_code"); ?></span></a></td>	
		<td nowrap rowspan="<?=$countarray[$data_order->Rs("eorderid")]?>">
				<?=$data_order->Rs("ord_typeofwork");?>	               	
               	</td>
               	 
				<td nowrap><?= $data_order->Rs('eorder_repairrework_date'); ?></td>
				
				<td align="center" nowrap><?= $data_order->Rs('eorder_repairrework_repair')==1?"&#8226;":""; ?></td>
				<td align="center" nowrap><?= $data_order->Rs('eorder_repairrework_rework')==1?"&#8226;":"";  ?></td>
				<td nowrap><?= $data_order->Rs("eorder_repairrework_detectby"); ?> </td>
				<td nowrap><?= $data_order->Rs("eorder_repairrework_supervisor"); ?> </td>
				

		    </tr>
			<? $data_order->MoveNext();	} ?> 
        </table>
</body></html>
<script>hideLoading()</script>
<? 
include_once '../core/inc_pngfix.php';
//echo replacePngTags(ob_get_clean()); ?>