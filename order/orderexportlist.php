<? include_once("../core/default.php"); ?>
<? include_once("../order/inc_getstring.php"); ?>


<html>
<title><?=WEBSITE_HEADER  ?></title>
<link href="../resource/css/default.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--  

<?=$query?>

 -->
<body style="background-color:#FFFFFF">
<? /* */include_once("../cfrontend/ordersummary.php"); ?>
<? /* */ include_once "../resource/divbackground.php" ?>
<script>
function markAllRows( container_id,val ) {
    var rows = document.getElementById(container_id).getElementsByTagName('tr');
    var checkbox;
    for ( var i = 0; i < rows.length; i++ ) {
        checkbox = rows[i].getElementsByTagName( 'input' )[0];
        if ( checkbox && checkbox.type == 'checkbox' ) {
            if ( checkbox.disabled == false ) {
                checkbox.checked = val;
            }
        }
    }
    return true;
}
</script>

<div id="PrintLayer" style="position:absolute;left:20px;top:5px;width:45px;height:36px;z-index:1;margin:0;padding:0"
onClick="style.visibility = 'hidden';window.print();style.visibility = 'visible'">
<table width="100%" height="100%" cellpadding="0" cellspacing="1" bgcolor="#000000">
  <tr><td align="center" bgcolor="#FFFFCC"><img src="../resource/images/silkicons/printer.gif"></td>
  </tr></table>
</div>
<center> 
  <strong><span class="Normal"><font size="+2">Order export list<br>
Date :
  <?=($cdate+0)?> <?=passThaiMonth($cmonth)?> <?=passThaiYear($cyear)?>
</font> </span></strong></center>
		<table width="100%"  border="0" cellpadding="2" cellspacing="1" bgcolor="#000000" id="exporttb">
<tr>
			    <td class="HeaderTable">&nbsp;</td>
			    <td class="HeaderTable" style="font-size:12px;font-weight:normal">Out</td>
			    <td class="HeaderTable" style="font-size:12px;font-weight:normal">Doctor</td>
			    <td class="HeaderTable" style="font-size:12px;font-weight:normal">Customer</td>
			    <td class="HeaderTable" style="font-size:12px;font-weight:normal">Patient</td>
			    <td class="HeaderTable" style="font-size:12px;font-weight:normal">Order code</td>
			    <td class="HeaderTable" style="font-size:12px;font-weight:normal">Work</td>
			    <td class="HeaderTable" style="font-size:12px;font-weight:normal">งานเข้า</td>
			    <td class="HeaderTable" style="font-size:12px;font-weight:normal">หมอนัด</td>
			    <td class="HeaderTable" style="font-size:12px;font-weight:normal">จังหวัด</td>
			    <td class="HeaderTable" style="font-size:12px;font-weight:normal">หมายเหตุ</td>
	            <td class="popHeader" style="font-size:12px;font-weight:normal">Section</td>
    <td class="popHeader" style="font-size:12px;font-weight:normal">Staff</td>
    <td class="popHeader" style="font-size:12px;font-weight:normal">IN</td>
    <td class="popHeader" style="font-size:12px;font-weight:normal">OUT</td>
</tr>
          <form action="orderexportlist_save.php" method="post">
          <!--form action="test.php" method="post"-->
          <input type="hidden" name="METHOD" value="<?=$method?>">
          <input type="hidden" name="filter" value="<?=$filter?>">
          <input type="hidden" name="searchtype" value="<?=$searchtype?>">
          <input type="hidden" name="type" value="<?=$type?>">
          <input type="hidden" name="country" value="<?=$country?>">
          <input type="hidden" name="keyword" value="<?=$keyword?>">
          <input type="hidden" name="exdate_day" value="<?=$exdate_day?>">
          <input type="hidden" name="exdate_month" value="<?=$exdate_month?>">
          <input type="hidden" name="exdate_year" value="<?=$exdate_year?>">
          <input type="hidden" name="endate_day" value="<?=$endate_day?>">
          <input type="hidden" name="endate_month" value="<?=$endate_month?>">
          <input type="hidden" name="endate_year" value="<?=$endate_year?>">

			<? $index=1;foreach($data_orderAr as $dt_order){ ?>
			<?
				$eorderid = $dt_order["eorderid"];
				if($eorderid== $oldid){
					
					continue;
				}
			
				$oldid = $eorderid;
			
			?>

			  <tr valign="top" bgcolor="<?= $dt_order["ordt_isdone"]?"#FFCCCC":"#FFFFFF" ?>" class="Normal" >
				<td align="right"><?= $index++ ?></td>
				<td 
                
                ><input name="eorderid[]" type="checkbox" value="<?= $dt_order["eorderid"]; ?>" 
                 <?= $dt_order["ordt_isdone"]?"checked":"" ?>
                ></td>
				<td><?= $dt_order["doc_name"]; ?> </td>
				<td>
				<a href="../customer/customerdetail_c.php?customerid=<?= $dt_order["customerid"]; ?>"
				 target="_blank"><font color=#000000>
				<?= reduceName($dt_order["cus_name"]); ?></font>				</a>				</td>
				<td><?= $dt_order["ord_patientname"]; ?> </td>
				<td  class="tdRowOnOut" onClick="OpenDivShowSummary(<?= $dt_order["eorderid"]?>)" onMouseOver="this.className='tdRowOnOver'" onMouseOut="this.className='tdRowOnOut'">
				<span style="color: #0000FF"><?= $dt_order["ord_code"]; ?></span></a></td>
				<td>&nbsp;
				<? 
					/*if($type=="F"){
						echo $dt_order["ordf_typeofworkt"];
					}else if($type=="R"){
						echo $dt_order["ordr_typeofworkt"]; 
					}else if($type=="M"){*/
						//echo $dt_order["ordf_typeofworkt"]."&nbsp;".$dt_order["ordr_typeofworkt"]."&nbsp;".$dt_order["ordo_typeofworkt"];
					echo $dt_order["ordt_typeofwork"];
					
					//}
				 ?>			</td>
				<td><?= $dt_order["ord_datel"]; ?> </td>
				<td>
				<?
				if($dt_order["docdateYear"]>0){
						 echo $dt_order["docdate"]; 
				}else{
						echo "-";
				}
				
				?>				</td>
				
				
				<td><?= $dt_order["prv_name"]; ?> </td>
				<td><? if($dt_order["eorder_fixid"]>0){?>
				
						<?=getAlloyName($dt_order["ordf_alloy"])?>
					
					<? } ?>	</td>
<td class="tdButtonOnOutS" style="color:#000000;<?= $dt_order['current_status'][0]["sec_room"]=="Delivery"?"background-color:#FFCC66":""?>" ><?= $dt_order['current_status'][0]["sec_room"]; ?></td>
				<td class="tdButtonOnOutS" style="color: #000000"><a href="../staff/staffdetail_c.php?staffid=<?= $dt_order['current_status'][0]["staffid"]; ?>" target="_blank">
                <?= $dt_order['current_status'][0]["stf_code"]; ?></a>&nbsp;</td>		        

				<? 
				
				$logtype = $dt_order['current_status'][0]["logt_type"];
				$logdate = $dt_order['current_status'][0]["logt_datef"];
				$diff 	 = $dt_order['current_status'][0]["logt_dated"];
				
				if($logtype == 'OUT' ){
					$diff2 = $dt_order['current_status'][1]["logt_dated"];
					echo "<td class=\"tdButtonOnOutS\">".$dt_order['current_status'][1]["logt_datef"] ."&nbsp;".($diff2>0?"[$diff2]":"")."</td>";
					
					echo "<td class=\"tdButtonOnOutS\">".$logdate ."&nbsp;".($diff>0?"[$diff]":"")."</td>";
				}else{
				?>
                
				<td class="tdButtonOnOutS" style="color: #000000"><?= $dt_order['current_status'][0]["logt_datef"]; ?>&nbsp;<?=($diff>0?"[$diff]":"")?></td>
				<td class="tdButtonOnOutS" style="color: #000000">&nbsp;</td>
                <? }?>
		    </tr>
			<? 	} ?>

			  <tr valign="top" bgcolor="#FFFFFF" class="Normal" >
			    <td colspan="3" align="left"><input type="submit" value="Save"></td>
			    <td colspan="12" align="left">
                <a href="#" onClick="javescript:markAllRows('exporttb',true);return false;">select all</a>/
                <a href="#" onClick="javescript:markAllRows('exporttb',false);return false;">unselect all</a>                </td>
		    </tr> 
            </form>           
        </table>
</body></html>
    <script>hideLoading()</script>
<? 
include_once '../core/inc_pngfix.php';
echo replacePngTags(ob_get_clean()); ?>