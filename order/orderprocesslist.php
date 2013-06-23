<? include_once("../core/default.php"); ?>


<html>
<head>
<title><?=WEBSITE_HEADER  ?></title>
<link href="../resource/css/default.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="../resource/javascript/jquery-1.9.1.min.js"></script>
</head>
<body style="background-color:#FFFFFF">
<? /* */ include_once("../cfrontend/ordersummary.php"); ?>
<? /* */ include_once "../resource/divbackground.php" ?>

<center class="logout"> 
  <strong><span class="Normal" style="color: #000000"><font size="+2">Order process list on 
  <?=date("d/m/y H:i") ?>
  <br>
Entry Date :
  <?=($cdate+0)?> 
  <?=passThaiMonth($cmonth)?> 
  <?=passThaiYear($cyear)?>
   Class 
   <?=$ordpriority ?>
  
  </font> </span></strong>
</center>
		<table width="100%"  border="0" cellpadding="2" cellspacing="1" bgcolor="#000000" id="exporttb">
	  <tr>
	    <td class="HeaderTable logout">&nbsp;</td>
		      <td class="HeaderTable logout" style="font-size:12px;font-weight:normal"><span class="HeaderTable" style="font-size:12px;font-weight:normal">Order code</span></td>
		      <td class="HeaderTable" style="font-size:12px;font-weight:normal">Work</td>
	    <td class="HeaderTable logout" style="font-size:12px;font-weight:normal"><span class="HeaderTable" style="font-size:12px;font-weight:normal">Section</span></td>
			    <td class="HeaderTable logout" style="font-size:12px;font-weight:normal"><span class="HeaderTable" style="font-size:12px;font-weight:normal">Staff</span></td>
		      <td class="HeaderTable" style="font-size:12px;font-weight:normal">IN</td>
	    <td class="HeaderTable" style="font-size:12px;font-weight:normal">OUT</td>
	      </tr>

			<? $index=1;foreach($data_orderAr as $dt_order){ ?>
			<?
				$eorderid = $dt_order["eorderid"];
				if($eorderid== $oldid){
					continue;
				}
			
				$oldid = $eorderid;
			
			?>
			  <tr valign="top" bgcolor="#FFFFFF" class="Normal" >
				<td align="right" class="logout"><span style="color: #000000">
			    <?= $index++ ?>
				</span></td>
				<td  class="tdRowOnOut logout" onClick="OpenDivShowSummary(<?= $dt_order["eorderid"]?>)" onMouseOver="this.className='tdRowOnOver'" onMouseOut="this.className='tdRowOnOut'">
                <span style="color: #0000FF"><?= $dt_order["ord_code"]; ?></span></td>
				<td class="logout" style="color: #000000">&nbsp;<?= $dt_order["ordt_typeofwork"] ?></td>
				<td class="logout" style="color: #000000"><?= $dt_order['current_status'][0]["sec_room"]; ?>&nbsp;</td>
				<td class="logout" style="color: #000000"><a href="../staff/staffdetail_c.php?staffid=<?= $dt_order['current_status'][0]["staffid"]; ?>" target="_blank">
                <?= $dt_order['current_status'][0]["stf_code"]; ?></a>&nbsp;</td>
                <? 
				$logtype = $dt_order['current_status'][0]["logt_type"];
				$logdate = $dt_order['current_status'][0]["logt_datef"];
				$diff 		 = $dt_order['current_status'][0]["logt_dated"];
				
				if($logtype == 'OUT' ){
					$diff2 = $dt_order['current_status'][1]["logt_dated"];
					echo "<td>".$dt_order['current_status'][1]["logt_datef"] ."&nbsp;".($diff2>0?"[$diff2]":"")."</td>";
					
					echo "<td>".$logdate ."&nbsp;".($diff>0?"[$diff]":"")."</td>";
				}else{
				?>
                
				<td class="logout" style="color: #000000"><?= $dt_order['current_status'][0]["logt_datef"]; ?>&nbsp;<?=($diff>0?"[$diff]":"")?></td>
				<td class="logout" style="color: #000000">&nbsp;</td>
                <? }?>
		  </tr>
			<? } ?> 
</table>
</body></html>
    <script>hideLoading()</script>
<? 
include_once '../core/inc_pngfix.php';
echo replacePngTags(ob_get_clean()); ?>