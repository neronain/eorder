<? include_once("../core/default.php"); ?>
<?
/* IN 
	$data_order >> order list
	
*/
	$order_status = array("Draft","Sending","Arrived","Processing","Delivery","Wait payment","Confirm paid","Archieve");
	if(count($data_orderAr)>0) {
		$dt_order = $data_orderAr[0]; 
		$status_name = $order_status[$dt_order["ord_status"]];
		if(count($data_orderAr)==1){
			$firstID = $dt_order["eorderid"];
		}
	}else{
		$status_name = $order_status[$status];
	}

?>

<html>
<title><?=WEBSITE_HEADER  ?></title>
<link href="../resource/css/default.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="../resource/javascript/ajax.js"></script>
<script src="../resource/javascript/default.js"></script>
<script src="../resource/javascript/mac5.1406813651.js"></script>
<body style="background-color:#FFFFFF">
<!--div id="backgroundLayer" style="position:absolute;left:0;top:0;width:100%;height:2000;visibility:hidden;background-image:url(../resource/images/eorder/bglayer.gif);z-index:0;"></div-->
<!--div id="DivShowOrder" style="position:absolute;white-space:nowrap;left:0;top:0;width:580px;height:250px;border:1px solid black;background-color:white;visibility:hidden;"
></div-->

<? /**/ include "../cfrontend/ordersummary.php" ?>
<? /* */ include_once "../resource/divbackground.php" ?>
<script src="../resource/javascript/default.js"></script>
<div id = "div_eorder_tooltip" align="right" style="position:absolute; white-space:nowrap; right:10px; top:10px; z-index:1; margin:0;
overflow:visible;width:300px;height:50px">
<table  width="100%"  border="0" bgcolor="#000000" cellpadding="2" cellspacing="1">
  <tr>
    <td background="../cfrontend/images/bgblockalpha_5.png"  id = "TableToolTip" >&nbsp;</td>
  </tr>
</table>
</div>
<script>

//writeit('TableToolTip',strTooltip[0]);
function dToolTip(msg){
	//findObj('div_eorder_tooltip').style.width = strTooltip[index*2+0]+"px";
	writeit('TableToolTip',msg);
	makeConnerScreen('div_eorder_tooltip');
	showHideLayers('div_eorder_tooltip','','show');
}

function hToolTip(){
	showHideLayers('div_eorder_tooltip','','hide');
}

showHideLayers('div_eorder_tooltip','','hide');

</script>

<table width="100%" height="100%" cellspacing="0" cellpadding="0">
<tr><td height="50"><?  $currentMenu="orderlist";include_once("../order/ordermenu.php"); ?></td></tr>
<tr><td align="center" valign="top" >
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="20"></td>
    <td><table width="100%" border="0" cellpadding="2" cellspacing="1" class="TableBorder">
      <tr>
        <td class="HeaderW">
		          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td class="HeaderW"><img src="../resource/images/silkicons/package.gif"> <?=$status_name?>  Order list</td>
              <td class="Normal" align="right">Found <?=$totalrow?> in <?=$totalpage?> pages</td>
            </tr>
          </table>
		 </td>
      </tr>
	  <form action="orderlist_c.php" method="get">
      <tr>
        <td align="right" bgcolor="#FFFFFF" class="searchTD">Search  for 
        <label><input type="radio" value="ord_code" name="column" <?=$column=='ord_code'||$column==''?"checked":""?>>Code</label>
        <label><input type="radio" value="cus_name" name="column" <?=$column=='cus_name'?"checked":""?>>Customer</label>
        <label><input type="radio" value="doc_name" name="column" <?=$column=='doc_name'?"checked":""?>>Doctor</label>
        <label><input type="radio" value="ord_patientname" name="column" <?=$column=='ord_patientname'?"checked":"" ?>>Patient name</label>
        
		<!--select name="column">
		<option value="ord_code" <?=$column=='ord_code'?"selected":"" ?>>Order code </option>
		<option value="cus_name" <?=$column=='cus_name'?"selected":"" ?>>Customer name</option>
		<option value="doc_name" <?=$column=='doc_name'?"selected":"" ?>>Doctor name</option>
		<option value="ord_patientname" <?=$column=='ord_patientname'?"selected":"" ?>>Patient name</option>
		
        
        
		</select-->
		<? /*
          <input type="checkbox" name="filter[]" value="cus_name" 
		  <?=isset($filter) && array_search('cus_name',$filter)>-1?"checked":""?>>Customer  
          <input type="checkbox" name="filter[]" value="doc_name" 
		  <?=isset($filter) && array_search('doc_name',$filter)>-1?"checked":""?>>Doctor
          <input type="checkbox" name="filter[]" value="ord_patientname" 
		  <?=isset($filter) && array_search('ord_patientname',$filter)>-1?"checked":""?>>Patient's name */
		  ?>
		 <input type="hidden" name="status" value="<?=$status?>">
          <input type="text" name="keyword" style="width:120;" value="<?=$firstID>0?"":$keyword?>">
          <input name="METHOD" type="submit" class="BTsearch" id="METHOD" value="GO!">
		   <input name="Stupid_IE_Bug" type="text" style="width:0;visibility:hidden" value="" size="1" >		  </td>
      </tr>
	  </form>
      <tr>
        <td align="center" bgcolor="#FFFFFF">
					<?



		
			$querystring  = "?";
			foreach($_GET as $variable => $value){
				if($variable=="page")continue;
				if($variable=="Stupid_IE_Bug")continue;
				
				if(is_array($value)){
					foreach($value as $v){
						$querystring  .= $variable."[]=$v&";
					}
				}else{
					$querystring  .= "$variable=$value&";
				}
			}
			?>
					<table cellspacing="0" cellpadding="0"><tr><td width="50"><?
					if($totalpage>1){
			 if($page!=1){
			echo "<a href=\"../order/orderlist_c.php".$querystring."page=1\"><img src=\"../resource/images/silkicons/resultset_first.gif\" width=\"16\" height=\"16\" border=0></a></a>";	 }
			?></td><td width="50"><?
			if($page>1){
			echo "<a href=\"../order/orderlist_c.php".$querystring."page=".($page-1)."\"><img src=\"../resource/images/silkicons/resultset_previous.gif\" width=\"16\" height=\"16\" border=0></a>";	 }
			?></td><td align="center" width="300"><?
			for($p=max(1,$page-3);$p<=$page+3 && $p<=$totalpage;$p++){ 
					if($p==$page){
						echo "&nbsp;&nbsp;&nbsp;<strong>$p</strong>&nbsp;&nbsp;&nbsp;";
					}else{
						echo "&nbsp;&nbsp;<a href=\"../order/orderlist_c.php".$querystring."page=$p\">$p</a>&nbsp;&nbsp;";		
					}
			} ?>
			</td><td width="50" align="right">
			<? if($page<$totalpage){
			echo "<a href=\"../order/orderlist_c.php".$querystring."page=".($page+1)."\"><img src=\"../resource/images/silkicons/resultset_next.gif\" width=\"16\" height=\"16\" border=0></a>";	 }?>
			</td><td width="50" align="right">
			<? if($page!=$totalpage){
			echo "<a href=\"../order/orderlist_c.php".$querystring."page=$totalpage\"><img src=\"../resource/images/silkicons/resultset_last.gif\" width=\"16\" height=\"16\" border=0></a>";	 }}?>
			</td></tr></table>
		
		</td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF">
	<?
	$i=0;
    foreach($data_orderAr as $dt_order){
        $currentStat = $dt_order["ord_status"];
		$shortcode = substr($dt_order["ord_code"],6,8);
		if($shortcode+0>0){
			if($shortcode+0>1000000)
				$shortcode-=1000000;
		}//else{
		while($shortcode[0]=="0" && strlen($shortcode)>5) $shortcode = substr($shortcode,1);
//		}
		
		
            if($currentStat==0){
                if($prevStat!=$currentStat){
     ?>
		<table width="100%"  border="0" cellpadding="1" cellspacing="1">
			<tr align="center">
			    <td class="HeaderTable" width="80">Code</td>
			    <td width="80" class="HeaderTable">Date</td>
			    <td width="150" class="HeaderTable">Customer</td>
			    <td width="100" class="HeaderTable">Doctor</td>
			    <td width="100" class="HeaderTable">Patient</td>
			    <td class="HeaderTable">Type of work</td>
			    <td class="HeaderTable">Arrived</td>
		      </tr>
				<?
                    $firstEntry = 1;
                 }
                 if($prevStat==$currentStat || $firstEntry){
                 ?>

			  <tr class="tdRowOnOut" onMouseOver="this.className='tdRowOnOver'" onMouseOut="this.className='tdRowOnOut'" valign="top" 
              onClick="OpenDivShowSummary(<?= $dt_order["eorderid"]; ?>)">
				<td align="center"  >
                <? /* onClick="showHTML('DivShowOrder','../order/orderdetail_c.php?eorderid=<?= $dt_order["eorderid"]; ?>');activeBG();showHideLayers('DivShowOrder','','show');makeCenterScreen('DivShowOrder');"> */?>
				<?= $shortcode ?></td>
				<td width="80" ><div style="width:80px;height:20px;overflow:hidden"><?= $dt_order["ord_datel"]; ?></div></td>
				<td width="150"><div style="width:150px;height:20px;overflow:hidden"><?= $dt_order["cus_name"]; ?></div></td>
				<td width="100"  ><div style="width:100px;height:20px;overflow:hidden"><?= $dt_order["doc_name"]; ?></div></td>
				<td width="100"  ><div style="width:100px;height:20px;overflow:hidden"><?= $dt_order["ord_patientname"]; ?></div></td>
				<td align="left" ><?=$dt_order["ord_typeofwork"];?></td>
				<td width="60" align="center" ><table border="0" cellpadding="1" cellspacing="1" bgcolor="#999999">
                  <tr>
                    <td width="30" align="center" class="tdButtonOnOutS" onMouseOver="this.className='tdButtonOnOverS'" onMouseOut="this.className='tdButtonOnOutS'"
					onclick="javascript:location='../order/order_process.php?act=rec&eorderid=<?=$dt_order["eorderid"]?>';"><img src="../resource/images/silkicons/package_go.png" alt="Receive and Process"/></td>
                  </tr>
                </table></td>
			  </tr>
		 <?
				$firstEntry = 0;
				$prevStat = $dt_order["ord_status"];
				$i++;
				if($i==count($data_orderAr) || $prevStat!=$dt_order["ord_status"]){
					?></table>
		<?
				}
			}
		}else if($currentStat==1){
			if($prevStat!=$currentStat){
		?>
        <table width="100%"  border="0" cellpadding="1" cellspacing="1">
			<tr align="center">
			    <td class="HeaderTable" width="80">Code</td>
			    <td width="80" class="HeaderTable">Date</td>
			    <td class="HeaderTable">Customer</td>
			    <td width="100" class="HeaderTable">Doctor</td>
			    <td width="100" class="HeaderTable">Patient</td>
			    <td class="HeaderTable">Type of work</td>
			    <td class="HeaderTable">Arrived</td>
		      </tr>
		<?
			 	$firstEntry = 1;
             }
			 if($prevStat==$currentStat || $firstEntry){
	    ?>

			  <tr class="tdRowOnOut" onMouseOver="this.className='tdRowOnOver'" onMouseOut="this.className='tdRowOnOut'" valign="top" 
               onClick="OpenDivShowSummary(<?= $dt_order["eorderid"]; ?>)">
				<td align="center" ><? /* onClick="showHTML('DivShowOrder','../order/orderdetail_c.php?eorderid=<?= $dt_order["eorderid"]; ?>');activeBG();showHideLayers('DivShowOrder','','show');makeCenterScreen('DivShowOrder');"> */?>
                  <?= $shortcode ?></td>
				<td ><?= $dt_order["ord_datel"]; ?></td>
				<td width="150"><div style="width:150px;height:20px;overflow:hidden"><?= $dt_order["cus_name"]; ?></div></td>
				<td ><div style="width:100px;height:20px;overflow:hidden"><?= $dt_order["doc_name"]; ?></div></td>
				<td ><div style="width:100px;height:20px;overflow:hidden"><?= $dt_order["ord_patientname"]; ?></div></td>
				<td align="left"><?=$dt_order["ord_typeofwork"]?></td>
				<td width="60" align="center"><table border="0" cellpadding="1" cellspacing="1" bgcolor="#999999">
                  <tr>
                    <td width="30" align="center" class="tdButtonOnOutS" onMouseOver="this.className='tdButtonOnOverS'" onMouseOut="this.className='tdButtonOnOutS'" onClick="javascript:location='../order/order_process.php?act=rec&eorderid=<?=$dt_order["eorderid"]?>';">
                    <img src="../resource/images/silkicons/package_go.png" alt="Receive and Process"/></td>
                  </tr>
                </table></td>
			  </tr>
		<?
				$firstEntry = 0;
				$prevStat = $dt_order["ord_status"];
				$i++;
				if($i==count($data_orderAr) || $prevStat!=$dt_order["ord_status"]){
					?></table>
        <?
				}
			}
		}else if($currentStat==2){
			if($prevStat!=$currentStat){
		?>
        <table width="100%"  border="0" cellpadding="1" cellspacing="1">
			<tr align="center">
			    <td class="HeaderTable" width="150">Order code</td>
			    <td width="80" class="HeaderTable">Arrived</td>
			    <td width="150" class="HeaderTable">Customer</td>
			    <td width="100" class="HeaderTable">Doctor</td>
			    <td width="100" class="HeaderTable">Patient</td>
			    <td class="HeaderTable">Type of work</td>
			    <td class="HeaderTable">Reject</td>
		      </tr>
			<?
                    $firstEntry = 1;
                 }
                 if($prevStat==$currentStat || $firstEntry){
            ?>

			  <tr class="tdRowOnOut" onMouseOver="this.className='tdRowOnOver'" onMouseOut="this.className='tdRowOnOut'" valign="top" 
               onClick="OpenDivShowSummary(<?= $dt_order["eorderid"]; ?>)">
				<td>
                <? /* onClick="showHTML('DivShowOrder','../order/orderdetail_c.php?eorderid=<?= $dt_order["eorderid"]; ?>');activeBG();showHideLayers('DivShowOrder','','show');makeCenterScreen('DivShowOrder');"> */?>
				<?= $dt_order["ord_code"]; ?></td>
				<td width="80"><div style="width:80px;height:20px;overflow:hidden"><?= $dt_order["ord_datel"]; ?></div></td>
				<td width="150"><div style="width:150px;height:20px;overflow:hidden"><?= $dt_order["cus_name"]; ?></div></td>
				<td width="100"><div style="width:100px;height:20px;overflow:hidden"><?= $dt_order["doc_name"]; ?></div></td>
				<td width="100"><div style="width:100px;height:20px;overflow:hidden"><?= $dt_order["ord_patientname"]; ?></div></td>
				<td align="left"><?=$dt_order["ord_typeofwork"]?></td>
				<td width="60" align="center"><table border="0" cellpadding="1" cellspacing="1" bgcolor="#999999">
                  <tr>
                    <td width="30" align="center" class="tdButtonOnOutS" onMouseOver="this.className='tdButtonOnOverS'" onMouseOut="this.className='tdButtonOnOutS'"
					onclick="javascript:location='../order/order_process.php?act=rej&eorderid=<?=$dt_order["eorderid"]?>';"><img src="../resource/images/silkicons/package_delete.png" alt="Reject"/></td>
                  </tr>
                </table></td>
			  </tr>
		<?
				$firstEntry = 0;
				$prevStat = $dt_order["ord_status"];
				$i++;
				if($i==count($data_orderAr) || $prevStat!=$dt_order["ord_status"]){
					?></table>
        <?
				}
			}
		}else if($currentStat==3){
			if($prevStat!=$currentStat){
		?>
        
        <table width="100%"  border="0" cellpadding="1" cellspacing="1">
			<tr align="center">
			    <td class="HeaderTable" width="150">Order code</td>
			    <td width="80" class="HeaderTable">Release</td>
			    <td width="150" class="HeaderTable">Customer</td>
			    <td width="100" class="HeaderTable">Doctor</td>
			    <td width="100" class="HeaderTable">Patient</td>
			    <td class="HeaderTable">Type of work</td>
			    <!--td class="HeaderTable">Processing</td-->
		      </tr>
			<?
                    $firstEntry = 1;
                 }
                 if($prevStat==$currentStat || $firstEntry){
            ?>


			  <tr class="tdRowOnOut" onMouseOver="this.className='tdRowOnOver'" onMouseOut="this.className='tdRowOnOut'" valign="top" 
               onClick="OpenDivShowSummary(<?= $dt_order["eorderid"]; ?>)">
				<td>
                <? /* onClick="showHTML('DivShowOrder','../order/orderdetail_c.php?eorderid=<?= $dt_order["eorderid"]; ?>');activeBG();showHideLayers('DivShowOrder','','show');makeCenterScreen('DivShowOrder');"> */?>
				<?= $dt_order["ord_code"]; ?></td>
				<td width="80"><div style="width:80px;height:50px;overflow:hidden"><?= $dt_order["ord_releasedatel"]; ?></div></td>
				<td width="150"><div style="width:150px;height:50px;overflow:hidden"><?= $dt_order["cus_name"]; ?></div></td>
				<td width="100"><div style="width:100px;height:50px;overflow:hidden"><?= $dt_order["doc_name"]; ?></div></td>
				<td width="100"><div style="width:100px;height:50px;overflow:hidden">
				  <?= $dt_order["ord_patientname"]; ?>
				  </div></td>
				<td align="left" style="padding:4px 1px;"><?= $dt_order["ord_typeofwork"]; ?><!--/td--><br/>
			 <? 
				$pdata = new CSql();
				$pdata->Connect();
				$order_id = $dt_order["eorderid"]; 
				//$DEBUGSQL = true;
				$pdata->Query("SELECT DATE_FORMAT(logt_date,'%d/%m/%y %h:%i') as logt_dateex,
				logt_sec_id,logt_stf_id,logt_type FROM logbooktoday 
				WHERE logt_ord_id = $order_id order by logt_date");
				
				?>
                <!--td-->
                <?
                	while(!$pdata->EOF){
                		
                		$key = $pdata->Rs('logt_stf_id');
                		if($cache['staff'][$key]==NULL){
                			$tmpRow = $data_tmp->ExecuteARecord("select stf_name,stf_code from staff where staffid = {$key} limit 0,1");
                			$cache['staff'][$key] = $tmpRow;
                		}
                		$rowAr['stf_name'] = $cache['staff'][$key]["stf_name"];
                		$rowAr['stf_code'] = $cache['staff'][$key]["stf_code"];
                		
                		
                		$key = $pdata->Rs('logt_sec_id');
                		if($cache['section'][$key]==NULL){
                			$tmpRow = $data_tmp->ExecuteARecord("select sec_room from section where sectionid = {$key} limit 0,1");
                			$cache['section'][$key] = $tmpRow;
                		}
                		$rowAr['sec_room'] = $cache['section'][$key]["sec_room"];
                		
                		
                		
						if($pdata->Rs("logt_type") == "IN"){?>
                        <? //=$pdata->Rs("logt_sec_id")?>
                        <img src="../resource/images/eorder/process/s<?=$pdata->Rs("logt_sec_id")?>.gif" alt="<?=$rowAr['sec_room']?>"  onMouseOver="dToolTip('Section: <?=$rowAr['sec_room']?><br>Staff: [<?=$rowAr['stf_code']?>] <?=$rowAr["stf_name"]?><br>Date: <?=$pdata->Rs("logt_dateex")?>')" onMouseOut="hToolTip()"/>
						<? }else if($pdata->Rs("logt_type" == "OUT")){?>
                        <img src="../resource/images/eorder/process/next.gif" hspace="0"  />
					  <? }
						$pdata->MoveNext();
					}
				?>                </td>
			  </tr>
		<?
				$firstEntry = 0;
				$prevStat = $dt_order["ord_status"];
				$i++;
				if($i==count($data_orderAr) || $prevStat!=$dt_order["ord_status"]){
					?></table>
        <?
				}
			}
		}else if($currentStat==4){
			if($prevStat!=$currentStat){
		?>
        
        <table width="100%"  border="0" cellpadding="1" cellspacing="1">
			<tr align="center">
			    <td class="HeaderTable" width="150">Order code</td>
			    <td width="80" class="HeaderTable">Release</td>
			    <td class="HeaderTable">Customer</td>
			    <td class="HeaderTable">Doctor</td>
			    <td class="HeaderTable">Patient</td>
			    <td class="HeaderTable">Type of work</td>
                <td class="HeaderTable">Deliverier</td>
		      </tr>
			<?
                    $firstEntry = 1;
                 }
                 if($prevStat==$currentStat || $firstEntry){
            ?>
			<? 
				$pdata = new CSql();
				$pdata->Connect();
				$order_id = $dt_order["eorderid"]; 
				//$DEBUGSQL = true;
				
				$maxlogt_data = $pdata->ExecuteScalar("select max(logt_date) as maxlogt_date from logbooktoday");
				
				$qry = "
				select *,DATE_FORMAT(logt_date,'%d/%m/%y %h:%i') as logt_dateex,
				logt_type,logt_date,logt_stf_id 
				FROM logbooktoday 
				WHERE logt_sec_id = 30 and logt_ord_id = 
				$order_id order by logt_date desc limit 1 
				";
				//echo $qry;
				$pdata->Query($qry);
				?>

			  <tr class="tdRowOnOut" onMouseOver="this.className='tdRowOnOver'" onMouseOut="this.className='tdRowOnOut'" valign="top" 
               onClick="OpenDivShowSummary(<?= $dt_order["eorderid"]; ?>)">
				<td>
                <? /* onClick="showHTML('DivShowOrder','../order/orderdetail_c.php?eorderid=<?= $dt_order["eorderid"]; ?>');activeBG();showHideLayers('DivShowOrder','','show');makeCenterScreen('DivShowOrder');"> */?>
				<?= $dt_order["ord_code"]; ?></td>
				<td width="80"><div style="width:80px;height:20px;overflow:hidden"><?= $dt_order["ord_releasedatel"]; ?></div></td>
				<td width="150"><div style="width:150px;height:20px;overflow:hidden"><?= $dt_order["cus_name"]; ?></div></td>
				<td width="100" ><div style="width:100px;height:20px;overflow:hidden"><?= $dt_order["doc_name"]; ?></div></td>
				<td width="100" ><div style="width:100px;height:20px;overflow:hidden"><?= $dt_order["ord_patientname"]; ?></div></td>
				 <td align="left"><?= $dt_order["ord_typeofwork"]; ?></td>
                 
 				<? if(!$pdata->EOF){ ?>
 					<?
 					$logt_stf_id = $pdata->Rs("logt_stf_id");
 					
 					if($cacheStaff[$logt_stf_id]==NULL){
 						$pdata->ExecuteScalar("select stf_name from staff where staffid = $logt_stf_id");
 						$cacheStaff[$logt_stf_id]['stf_name'] = $pdata->Rs("stf_name");
 					} 
 					?>
                	<td align="left"><?= $cacheStaff[$logt_stf_id]['stf_name']?></td>
				<? }?>                 
                 

			  </tr>
		<?
				$firstEntry = 0;
				$prevStat = $dt_order["ord_status"];
				$i++;
				if($i==count($data_orderAr) || $prevStat!=$dt_order["ord_status"]){
					?></table><?
				}
			}
		}else if($currentStat==5){
			if($prevStat!=$currentStat){
		?>
        
        <table width="100%"  border="0" cellpadding="1" cellspacing="1">
			<tr align="center">
			    <td class="HeaderTable" width="150">Order code</td>
			    <td width="80" class="HeaderTable">Got date</td>
			    <td class="HeaderTable">Customer</td>
			    <td class="HeaderTable">Doctor</td>
			    <td class="HeaderTable">Patient</td>
                 <td class="HeaderTable">Type of work</td>
			    </tr>
			<?
                    $firstEntry = 1;
                 }
                 if($prevStat==$currentStat || $firstEntry){
            ?>


			  <tr class="tdRowOnOut" onMouseOver="this.className='tdRowOnOver'" onMouseOut="this.className='tdRowOnOut'" valign="top" 
               onClick="OpenDivShowSummary(<?= $dt_order["eorderid"]; ?>)">
				<td>
                <? /* onClick="showHTML('DivShowOrder','../order/orderdetail_c.php?eorderid=<?= $dt_order["eorderid"]; ?>');activeBG();showHideLayers('DivShowOrder','','show');makeCenterScreen('DivShowOrder');"> */?>
				<?= $dt_order["ord_code"]; ?></td>
				<td width="80"><div style="width:80px;height:20px;overflow:hidden"><?= $dt_order["ord_datel"]; ?></div></td>
				<td width="150"><div style="width:150px;height:20px;overflow:hidden"><?= $dt_order["cus_name"]; ?></div></td>
				<td width="100"><div style="width:100px;height:20px;overflow:hidden"><?= $dt_order["doc_name"]; ?></div></td>
				<td width="100"><div style="width:100px;height:20px;overflow:hidden"><?= $dt_order["ord_patientname"]; ?></div></td>
                    <td align="left"><?= $dt_order["ord_typeofwork"]; ?></td>
                  </tr>
                
		<?
				$firstEntry = 0;
				$prevStat = $dt_order["ord_status"];
				$i++;
				if($i==count($data_orderAr) || $prevStat!=$dt_order["ord_status"]){
					?></table>
        <?
				}
			}		
		}else if($currentStat==6){
			if($prevStat!=$currentStat){
		?>
        
        <table width="100%"  border="0" cellpadding="1" cellspacing="1">
			<tr align="center">
			    <td class="HeaderTable" width="150">Order code</td>
			    <td width="80" class="HeaderTable">Paid date</td>
			    <td class="HeaderTable">Customer</td>
			    <td class="HeaderTable">Doctor</td>
			    <td class="HeaderTable">Patient</td>
			    <td class="HeaderTable">Type of work</td>
			    <td class="HeaderTable">Paid</td>
		      </tr>
			<?
                    $firstEntry = 1;
                 }
                 if($prevStat==$currentStat || $firstEntry){
            ?>


			  <tr class="tdRowOnOut" onMouseOver="this.className='tdRowOnOver'" onMouseOut="this.className='tdRowOnOut'" valign="top" 
               onClick="OpenDivShowSummary(<?= $dt_order["eorderid"]; ?>)">
				<td>
                <? /* onClick="showHTML('DivShowOrder','../order/orderdetail_c.php?eorderid=<?= $dt_order["eorderid"]; ?>');activeBG();showHideLayers('DivShowOrder','','show');makeCenterScreen('DivShowOrder');"> */?>
				<?= $dt_order["ord_code"]; ?></td>
				<td><?= $dt_order["ord_datel"]; ?></td>
				<td width="150"><div style="width:150px;height:20px;overflow:hidden"><?= $dt_order["cus_name"]; ?></div></td>
				<td width="100"><div style="width:100px;height:20px;overflow:hidden"><?= $dt_order["doc_name"]; ?></div></td>
				<td width="100"><div style="width:100px;height:20px;overflow:hidden"><?= $dt_order["ord_patientname"]; ?></div></td>
				<td align="left" ><?=$dt_order["ord_typeofwork"]?></td>
				<td width="60" align="center" ><table border="0" cellpadding="1" cellspacing="1" bgcolor="#999999">
                  <tr>
                    <td width="30" align="center" class="tdButtonOnOutS" onMouseOver="this.className='tdButtonOnOverS'" onMouseOut="this.className='tdButtonOnOutS'"
					onclick="javascript:location='../order/order_process.php?act=rec&eorderid=<?=$dt_order["eorderid"]?>';"><img src="../resource/images/silkicons/money.png" alt="Have paid already"/></td>
                  </tr>
                </table></td>                
			  </tr>
		<?
				$firstEntry = 0;
				$prevStat = $dt_order["ord_status"];
				$i++;
				if($i==count($data_orderAr) || $prevStat!=$dt_order["ord_status"]){
					?></table>
        <?
				}
			}
		}else if($currentStat==7){
			if($prevStat!=$currentStat){
		?>
        
        <table width="100%"  border="0" cellpadding="1" cellspacing="1">
			<tr align="center">
			    <td class="HeaderTable" width="150">Order code</td>
			    <td width="80" class="HeaderTable">Date</td>
			    <td class="HeaderTable">Customer</td>
			    <td class="HeaderTable">Doctor</td>
			    <td class="HeaderTable">Patient</td>
			    <td class="HeaderTable">Type of work</td>
		      </tr>
			<?
                    $firstEntry = 1;
                 }
                 if($prevStat==$currentStat || $firstEntry){
            ?>


			  <tr class="tdRowOnOut" onMouseOver="this.className='tdRowOnOver'" onMouseOut="this.className='tdRowOnOut'" valign="top" 
               onClick="OpenDivShowSummary(<?= $dt_order["eorderid"]; ?>)">
				<td>
                <? /* onClick="showHTML('DivShowOrder','../order/orderdetail_c.php?eorderid=<?= $dt_order["eorderid"]; ?>');activeBG();showHideLayers('DivShowOrder','','show');makeCenterScreen('DivShowOrder');"> */?>
				<?= $dt_order["ord_code"]; ?></td>
				<td width="80"><div style="width:80px;height:20px;overflow:hidden"><?= $dt_order["ord_datel"]; ?></div></td>
				<td width="150"><div style="width:150px;height:20px;overflow:hidden"><?= $dt_order["cus_name"]; ?></div></td>
				<td width="100"><div style="width:100px;height:20px;overflow:hidden"><?= $dt_order["doc_name"]; ?></div></td>
				<td width="100"><div style="width:100px;height:20px;overflow:hidden"><?= $dt_order["ord_patientname"]; ?></div></td>
				<td align="left"><?= $dt_order["ord_typeofwork"]; ?></td>
			  </tr>
		<?
				$firstEntry = 0;
				$prevStat = $dt_order["ord_status"];
				$i++;
				if($i==count($data_orderAr) || $prevStat!=$dt_order["ord_status"]){
					?></table><?
				}
				
			}
		}
	}
		?>
        </td>
      </tr>
      <tr>
        <td align="center" bgcolor="#FFFFFF">
		
		<table cellspacing="0" cellpadding="0"><tr><td width="50"><?
		if($totalpage>1){
			 if($page!=1){
			echo "<a href=\"../order/orderlist_c.php".$querystring."page=1\"><img src=\"../resource/images/silkicons/resultset_first.gif\" width=\"16\" height=\"16\" border=0></a>";	 }
			?></td><td width="50"><?
			if($page>1){
			echo "<a href=\"../order/orderlist_c.php".$querystring."page=".($page-1)."\"><img src=\"../resource/images/silkicons/resultset_previous.gif\" width=\"16\" height=\"16\" border=0></a>";	 }
			?></td><td align="center" width="300"><?
			for($p=max(1,$page-3);$p<=$page+3 && $p<=$totalpage;$p++){ 
					if($p==$page){
						echo "&nbsp;&nbsp;&nbsp;<strong>$p</strong>&nbsp;&nbsp;&nbsp;";
					}else{
						echo "&nbsp;&nbsp;<a href=\"../order/orderlist_c.php".$querystring."page=$p\">$p</a>&nbsp;&nbsp;";		
					}
			} ?>
			</td><td width="50" align="right">
			<? if($page<$totalpage){
			echo "<a href=\"../order/orderlist_c.php".$querystring."page=".($page+1)."\"><img src=\"../resource/images/silkicons/resultset_next.gif\" width=\"16\" height=\"16\" border=0></a>";	 }?>
			</td><td width="50" align="right">
			<? if($page!=$totalpage){
			echo "<a href=\"../order/orderlist_c.php".$querystring."page=$totalpage\"><img src=\"../resource/images/silkicons/resultset_last.gif\" width=\"16\" height=\"16\" border=0></a>";	 }}?>
			</td></tr></table>
		</td>
      </tr>
      <tr>
        <td class="FooterTD">&nbsp;</td>
      </tr>
    </table></td>
    <td width="20">&nbsp;</td>
  </tr>
  
</table>
</td></tr></table>
</body></html>

<script>
hideLoading();
<? if($firstID>0){ ?>
OpenDivShowSummary(<?=$firstID?>);
<? } ?>
</script>

<? 
include_once '../core/inc_pngfix.php';
echo replacePngTags(ob_get_clean()); ?>