<? include_once("../core/default.php"); ?>
<? include_once("../order/inc_getstring.php"); ?>


<html>
<title><?=WEBSITE_HEADER  ?></title>
<link href="../resource/css/default.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

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
  <strong><span class="Normal"><font size="+2">Order delivery list<br>
Date :
  <?=($cdate+0)?> <?=passThaiMonth($cmonth)?> <?=passThaiYear($cyear)?>
</font> </span></strong></center>
		<table width="100%"  border="0" cellpadding="2" cellspacing="1" bgcolor="#000000" id="deliverytb">
<tr>
			    <td class="HeaderTable">&nbsp;</td>
			    <td class="HeaderTable" style="font-size:12px;font-weight:normal">Order No.</td>
			    <td class="HeaderTable" style="font-size:12px;font-weight:normal">Agent</td>
			    <td class="HeaderTable" style="font-size:12px;font-weight:normal">Dentist</td>
			    <td class="HeaderTable" style="font-size:12px;font-weight:normal">Patient</td>
			    <td class="HeaderTable" style="font-size:12px;font-weight:normal">Work</td>
    <td class="popHeader" style="font-size:12px;font-weight:normal">Section</td>
    <td class="popHeader" style="font-size:12px;font-weight:normal">Staff</td>
    <td class="popHeader" style="font-size:12px;font-weight:normal">IN</td>
    <td class="popHeader" style="font-size:12px;font-weight:normal">OUT</td>
</tr>
          <form action="orderdeliverylist_save.php" method="post">
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

			<? $index=1;while(!$data_order->EOF){ ?>
			<?
				$eorderid = $data_order->Rs("eorderid");
				if($eorderid== $oldid){
					$data_order->MoveNext();
					continue;
				}
			
				$oldid = $eorderid;
			
			?>

			  <tr valign="top" bgcolor="<?= $data_order->Rs("ordt_isdone")?"#FFCCCC":"#FFFFFF" ?>" class="Normal" >
				<td align="right"><?= $index++ ?></td>
				<td><?= $data_order->Rs("ord_no"); ?></td>
				<td><?= $data_order->Rs("agn_name"); ?> </td>
				<td><?= $data_order->Rs("doc_name"); ?></td>
				<td><?= $data_order->Rs("ord_patientname"); ?> </td>
				<td>&nbsp;
				<? 
					/*if($type=="F"){
						echo $data_order->Rs("ordf_typeofworkt");
					}else if($type=="R"){
						echo $data_order->Rs("ordr_typeofworkt"); 
					}else if($type=="M"){*/
						//echo $data_order->Rs("ordf_typeofworkt")."&nbsp;".$data_order->Rs("ordr_typeofworkt")."&nbsp;".$data_order->Rs("ordo_typeofworkt");
					echo $data_order->Rs("ordt_typeofwork");
					
					//}
				 ?>			</td>
				<td class="tdButtonOnOutS" style="color:#000000;<?= $data_order->Rs("sec_room")=="Delivery"?"background-color:#FFCC66":""?>" ><?= $data_order->Rs("sec_room"); ?></td>
				<td class="tdButtonOnOutS" style="color: #000000"><a href="../staff/staffdetail_c.php?staffid=<?= $data_order->Rs("staffid"); ?>" target="_blank">
                <?= $data_order->Rs("stf_code"); ?></a>&nbsp;</td>		        

				<? 
				$logtype = $data_order->Rs("logt_type");
				$logdate = $data_order->Rs("logt_datef");
				$diff 		 = $data_order->Rs("logt_dated");
				
				if($logtype == 'OUT' ){
					$data_order->MoveNext();
					$diff2 = $data_order->Rs("logt_dated");
					echo "<td class=\"tdButtonOnOutS\">".$data_order->Rs("logt_datef") ."&nbsp;".($diff2>0?"[$diff2]":"")."</td>";
					
					echo "<td class=\"tdButtonOnOutS\">".$logdate ."&nbsp;".($diff>0?"[$diff]":"")."</td>";
				}else{
				?>
                
				<td class="tdButtonOnOutS" style="color: #000000"><?= $data_order->Rs("logt_datef"); ?>&nbsp;<?=($diff>0?"[$diff]":"")?></td>
				<td class="tdButtonOnOutS" style="color: #000000">&nbsp;</td>
                <? }?>
		    </tr>
			<? $data_order->MoveNext();	} ?>

			  <tr valign="top" bgcolor="#FFFFFF" class="Normal" >
			    <td colspan="3" align="left"><input type="submit" value="Save"></td>
			    <td align="left">&nbsp;</td>
		        <td align="left">&nbsp;</td>
		        <td align="left">&nbsp;</td>
		        <td align="left">&nbsp;</td>
		        <td align="left">&nbsp;</td>
		        <td align="left">&nbsp;</td>
		        <td align="left">&nbsp;</td>
		    </tr> 
            </form>           
        </table>
</body></html>
    <script>hideLoading()</script>
<? 
include_once '../core/inc_pngfix.php';
echo replacePngTags(ob_get_clean()); ?>