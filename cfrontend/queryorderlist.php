<? if($lg=="th") include("../configuration/text_thai.php"); else include("../configuration/text_english.php"); ?>
<? include_once("../core/default.php"); ?>
<? if(!isset($status))$status=0;?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="../resource/javascript/ajax.js"></script> 
<script src="../resource/javascript/default.js"></script>
<link href="../cfrontend/default.css" rel="stylesheet" type="text/css" />
<table cellpadding="0" cellspacing="0" height="100%" width="100%"><tr><td valign="top">
<? if($eorder_data->EOF){?>
<?=T_NFORDER;?>
<? } ?>
<? 
while(!$eorder_data->EOF){
	$currentStat = $eorder_data->Rs("ord_status");
	//if($prevStat!=$currentStat){
		if($currentStat==0){
			if($prevStat!=$currentStat){
				?>
           <table border="0" cellpadding="2" cellspacing="1" bgcolor="#999999" width="100%">
              <tr>
                <td width="120" align="center" bgcolor="#CCCCCC" ><strong><?=T_ORDERCODE;?></strong></td>
                <td width="100" align="center" bgcolor="#CCCCCC" ><strong><?=T_DOCTOR;?></strong></td>
                <td width="100" align="center" bgcolor="#CCCCCC" ><strong><?=T_PATIENT;?></strong></td>
                <td align="center" bgcolor="#CCCCCC" ><strong><?=T_TYPEOFWORK;?></strong></td>
                <td width="80" align="center" bgcolor="#CCCCCC" >&nbsp;</td>
             </tr>
             <?
			 	$firstEntry = 1;
             }
			 if($prevStat==$currentStat || $firstEntry){
			 ?>
             
     			<tr class="tdRowOnOut" onMouseOver="this.className='tdRowOnOver'" onMouseOut="this.className='tdRowOnOut'" >
				<td onClick="OpenDivShowSummary(<?=$eorder_data->Rs("eorderID")?>)"  >
				&nbsp;<?=$eorder_data->Rs("ord_code");?></td>
				<td onClick="OpenDivShowSummary(<?=$eorder_data->Rs("eorderID")?>)"  style="padding-left:5px;padding-right:5px">&nbsp;<?=$eorder_data->Rs("doc_name");?></td>
				<td onClick="OpenDivShowSummary(<?=$eorder_data->Rs("eorderID")?>)"  style="padding-left:5px;padding-right:5px">
				<?=$eorder_data->Rs("ord_patientname");?></td>
				<td onClick="OpenDivShowSummary(<?=$eorder_data->Rs("eorderID")?>)"  style="padding-left:2px;padding-right:2px">
				<?=$eorder_data->Rs("ord_typeofwork");?></td>
				<td width="60" align="center"><table border="0" cellpadding="1" cellspacing="1" bgcolor="#999999">
				  <tr>
					<td align="center" class="tdButtonOnOutS" 
                    onmouseover="this.className='tdButtonOnOverS';dToolTip('PREVIEW')" onmouseout="this.className='tdButtonOnOutS'" 
                    onClick="OpenDivShowSummary(<?=$eorder_data->Rs("eorderID")?>)">
					<img src="../resource/images/silkicons/zoom.gif" width="16" height="16" alt="Preview"/></td>
					<td align="center" class="tdButtonOnOutS" 
                    onmouseover="this.className='tdButtonOnOverS';dToolTip('EDITORDER')" onmouseout="this.className='tdButtonOnOutS'"
                    onclick="Loading();javascript:location='../eorder/eorder_edit.php?eorderid=<?=$eorder_data->Rs("eorderID")?>';">
                    <img src="../resource/images/silkicons/pencil.gif" alt="Edit"/></td>
					<td align="center" class="tdButtonOnOutS" 
                    onmouseover="this.className='tdButtonOnOverS';dToolTip('SENDSUBMIT')" onmouseout="this.className='tdButtonOnOutS'"
					onclick="javascript:location='../eorder/submit_order.php?eorderid=<?=$eorder_data->Rs("eorderID")?>';">
                    <img src="../resource/images/silkicons/package_go.gif" alt="Submit"/></td>
				    <td align="center" class="tdButtonOnOutS" 
                    onmouseover="this.className='tdButtonOnOverS';dToolTip('DELETEORDER')" onmouseout="this.className='tdButtonOnOutS'"
					onclick="DeleteOrder(<?=$eorder_data->Rs("eorderID")?>,'<?=$eorder_data->Rs("ord_code")?>',<?=$id?>,<?=$status?>,<?=$limit?>,<?=$page?>);"
					><img src="../resource/images/silkicons/package_delete.gif" alt="Delete"/></td>
				  </tr>
				</table></td>
			  </tr>
                <?
				$firstEntry = 0;
				$prevStat = $eorder_data->Rs("ord_status");
				$eorder_data->MoveNext();
				if($eorder_data->EOF || $prevStat!=$eorder_data->Rs("ord_status")){
					?></table>
<?
				}
			}
		}else if($currentStat==1){
			if($prevStat!=$currentStat){
		?>
        	<table border="0" cellpadding="2" cellspacing="1" bgcolor="#999999" width="100%">
			<tr>
                <td width="120" align="center" bgcolor="#CCCCCC" ><strong><?=T_ORDERCODE;?></strong></td>
                <td width="100" align="center" bgcolor="#CCCCCC" ><strong>
                  <?=T_DOCTOR;?>
                </strong></td>
                <td width="100" align="center" bgcolor="#CCCCCC" ><strong><?=T_PATIENT;?></strong></td>
              <td align="center" bgcolor="#CCCCCC" ><strong><?=T_TYPEOFWORK;?></strong></td>
                <td width="80" align="center" bgcolor="#CCCCCC" ><strong><?=T_SMITDATE;?></strong></td>
              </tr>
        <?
			 	$firstEntry = 1;
             }
			 if($prevStat==$currentStat || $firstEntry){
	    ?>
			
            <tr class="tdRowOnOut" onMouseOver="this.className='tdRowOnOver'" onMouseOut="this.className='tdRowOnOut'" >
				<td onClick="OpenDivShowSummary(<?=$eorder_data->Rs("eorderID")?>)"  >
				<?=$eorder_data->Rs("ord_code");?></td>
				<td  style="padding-left:5px;padding-right:5px" onclick="OpenDivShowSummary(<?=$eorder_data->Rs("eorderID")?>)">&nbsp;
				    <?=$eorder_data->Rs("doc_name");?></td>
				<td onClick="OpenDivShowSummary(<?=$eorder_data->Rs("eorderID")?>)"  style="padding-left:5px;padding-right:5px">
				<?=$eorder_data->Rs("ord_patientname");?></td>
				<td onClick="OpenDivShowSummary(<?=$eorder_data->Rs("eorderID")?>)"  style="padding-left:2px;padding-right:2px">&nbsp;
				<?=$eorder_data->Rs("ord_typeofwork");?></td>
                <td align="center"  style="padding-left:2px;padding-right:2px" onClick="OpenDivShowSummary(<?=$eorder_data->Rs("eorderID")?>)">
                <?=$eorder_data->Rs("ord_senddate");?></td>
              </tr>
            <?
				$firstEntry = 0;
				$prevStat = $eorder_data->Rs("ord_status");
				$eorder_data->MoveNext();
				if($eorder_data->EOF || $prevStat!=$eorder_data->Rs("ord_status")){
					?></table>
<?
				}
			}
		}else if($currentStat==2){
			if($prevStat!=$currentStat){	?>
			<table border="0" cellpadding="2" cellspacing="1" bgcolor="#999999" width="100%">
              <tr>
                <td width="120" align="center" bgcolor="#CCCCCC" ><strong><?=T_ORDERCODE;?></strong></td>
                <td width="100" align="center" bgcolor="#CCCCCC" ><strong>
                  <?=T_DOCTOR;?>
                </strong></td>
                <td width="100" align="center" bgcolor="#CCCCCC" ><strong><?=T_PATIENT;?></strong></td>
                <td align="center" bgcolor="#CCCCCC" ><strong><?=T_TYPEOFWORK;?></strong></td>
                <td width="80" align="60" bgcolor="#CCCCCC" > <strong>&nbsp;&nbsp;<?=T_ARRVDATE;?></strong></td>
              </tr>
        <?
			 	$firstEntry = 1;
             }
			 if($prevStat==$currentStat || $firstEntry){
	    ?>
			  <tr class="tdRowOnOut" onMouseOver="this.className='tdRowOnOver'" onMouseOut="this.className='tdRowOnOut'" >
                <td onClick="OpenDivShowSummary(<?=$eorder_data->Rs("eorderID")?>)"  >
                <?=$eorder_data->Rs("ord_code");?></td>
                <td  style="padding-left:5px;padding-right:5px" onclick="OpenDivShowSummary(<?=$eorder_data->Rs("eorderID")?>)">&nbsp;
                    <?=$eorder_data->Rs("doc_name");?></td>
                <td onClick="OpenDivShowSummary(<?=$eorder_data->Rs("eorderID")?>)"  style="padding-left:5px;padding-right:5px">
                <?=$eorder_data->Rs("ord_patientname");?></td>
                <td  style="padding-left:2px;padding-right:2px" onClick="OpenDivShowSummary(<?=$eorder_data->Rs("eorderID")?>)">&nbsp; <?=$eorder_data->Rs("ord_typeofwork");?></td>
                <td align="center"  style="padding-left:2px;padding-right:2px" onClick="OpenDivShowSummary(<?=$eorder_data->Rs("eorderID")?>)">&nbsp;
                <?=$eorder_data->Rs("ord_arrivedate");?></td>
                
                <? 
				$pdata = new CSql();
				$pdata->Connect();
				$order_id = $eorder_data->Rs("eorderID"); 
				//$DEBUGSQL = true;
				$pdata->Query("SELECT logt_sec_id,sec_room,logt_type FROM logbooktoday,section 
				WHERE logt_sec_id = sectionid and logt_ord_id = $order_id order by logt_date");
				
				?>
              </tr><?
				$firstEntry = 0;
				$prevStat = $eorder_data->Rs("ord_status");
				$eorder_data->MoveNext();
				if($eorder_data->EOF || $prevStat!=$eorder_data->Rs("ord_status")){
					?></table>
<?
				}
			}
		}else if($currentStat==3){
			if($prevStat!=$currentStat){	?>
			<table border="0" cellpadding="2" cellspacing="1" bgcolor="#999999" width="100%">
              <tr>
                <td width="120" align="center" bgcolor="#CCCCCC" ><strong><?=T_ORDERCODE;?></strong></td>
                <td width="100" align="center" bgcolor="#CCCCCC" ><strong>
                  <?=T_DOCTOR;?>
                </strong></td>
                <td width="100" align="center" bgcolor="#CCCCCC" ><strong><?=T_PATIENT;?></strong></td>
                <td align="center" bgcolor="#CCCCCC" ><strong><?=T_PROCESS;?></strong></td>
              </tr>
        <?
			 	$firstEntry = 1;
             }
			 if($prevStat==$currentStat || $firstEntry){
	    ?>
			  <tr class="tdRowOnOut" onMouseOver="this.className='tdRowOnOver'" onMouseOut="this.className='tdRowOnOut'" >
                <td onClick="OpenDivShowSummary(<?=$eorder_data->Rs("eorderID")?>)"  >
                <?=$eorder_data->Rs("ord_code");?></td>
                <td  style="padding-left:5px;padding-right:5px" onclick="OpenDivShowSummary(<?=$eorder_data->Rs("eorderID")?>)">&nbsp;
                    <?=$eorder_data->Rs("doc_name");?></td>
                <td onClick="OpenDivShowSummary(<?=$eorder_data->Rs("eorderID")?>)"  style="padding-left:5px;padding-right:5px">
                <?=$eorder_data->Rs("ord_patientname");?></td>
                <? 
				$pdata = new CSql();
				$pdata->Connect();
				$order_id = $eorder_data->Rs("eorderID"); 
				//$DEBUGSQL = true;
				$pdata->Query("SELECT logt_sec_id,sec_room,logt_type FROM logbooktoday,section 
				WHERE logt_sec_id = sectionid and logt_ord_id = $order_id order by logt_date");
				
				?>
                <td onClick="OpenDivShowSummary(<?=$eorder_data->Rs("eorderID")?>)" style="padding-left:2px;padding-right:2px">
                <?
                	while(!$pdata->EOF){
						if($pdata->Rs("logt_type") == "IN"){?>
                        <? //=$pdata->Rs("logt_sec_id")?>
                        <img src="../resource/images/eorder/process/s<?=$pdata->Rs("logt_sec_id")?>.gif" alt="<?=$pdata->Rs("sec_room")?>" />
						<? }else if($pdata->Rs("logt_type" == "OUT")){?>
                        <img src="../resource/images/eorder/process/next.gif" hspace="0"  />
						<? }
						$pdata->MoveNext();
					}
				?>                </td>
              </tr><?
				$firstEntry = 0;
				$prevStat = $eorder_data->Rs("ord_status");
				$eorder_data->MoveNext();
				if($eorder_data->EOF || $prevStat!=$eorder_data->Rs("ord_status")){
					?></table>
<?
				}
			}			
		}else if($currentStat==4){
        	if($prevStat!=$currentStat){	?>
        	<table border="0" cellpadding="2" cellspacing="1" bgcolor="#999999" width="100%">
			<tr>
                <td width="120" align="center" bgcolor="#CCCCCC" ><strong><?=T_ORDERCODE;?></strong></td>
                <td width="100" align="center" bgcolor="#CCCCCC" ><strong>
                  <?=T_DOCTOR;?>
                </strong></td>
                <td width="100" align="center" bgcolor="#CCCCCC" ><strong><?=T_PATIENT;?></strong></td>
              <td align="center" bgcolor="#CCCCCC" ><strong><?=T_SENTDATE;?></strong></td>
                <td width="60" align="center" bgcolor="#CCCCCC" ><strong>&nbsp;</strong></td>
            </tr>
        <?
			 	$firstEntry = 1;
             }
			 if($prevStat==$currentStat || $firstEntry){
	    ?>
            <tr class="tdRowOnOut" onMouseOver="this.className='tdRowOnOver'" onMouseOut="this.className='tdRowOnOut'" >
				<td onClick="OpenDivShowSummary(<?=$eorder_data->Rs("eorderID")?>)"  >
				<?=$eorder_data->Rs("ord_code");?></td>
				<td  style="padding-left:5px;padding-right:5px" onclick="OpenDivShowSummary(<?=$eorder_data->Rs("eorderID")?>)">&nbsp;
				    <?=$eorder_data->Rs("doc_name");?></td>
				<td onClick="OpenDivShowSummary(<?=$eorder_data->Rs("eorderID")?>)"  style="padding-left:5px;padding-right:5px">
				<?=$eorder_data->Rs("ord_patientname");?></td>
				<td onClick="OpenDivShowSummary(<?=$eorder_data->Rs("eorderID")?>)"  style="padding-left:2px;padding-right:2px">
				<?=$eorder_data->Rs("ord_senddate");?></td>
                <td style="padding-left:2px;padding-right:2px"><table border="0" cellpadding="1" cellspacing="1" bgcolor="#999999">
                  <tr>
                    <td align="center" class="tdButtonOnOutS" 
                    onmouseover="this.className='tdButtonOnOverS';dToolTip('GOT_ORDER');" onmouseout="this.className='tdButtonOnOutS'"
					onclick="GotOrder(<?=$eorder_data->Rs("eorderID")?>,'<?=$eorder_data->Rs("ord_code")?>',<?=$id?>,<?=$status?>,<?=$limit?>,<?=$page?>);"><img src="../resource/images/silkicons/package_link.png" alt="Got"/></td>
                  </tr>
                </table></td>
			</tr><?
				$firstEntry = 0;
				$prevStat = $eorder_data->Rs("ord_status");
				$eorder_data->MoveNext();
				if($eorder_data->EOF || $prevStat!=$eorder_data->Rs("ord_status")){
					?></table>
<?
				}
			}
		}else if($currentStat==5){
			if($prevStat!=$currentStat){	?>
			<table border="0" cellpadding="2" cellspacing="1" bgcolor="#999999" width="100%">
			<tr>
                <td width="120" align="center" bgcolor="#CCCCCC" ><strong><?=T_ORDERCODE;?></strong></td>
                <td width="100" align="center" bgcolor="#CCCCCC" ><strong>
                  <?=T_DOCTOR;?>
                </strong></td>
                <td width="100" align="center" bgcolor="#CCCCCC" ><strong><?=T_PATIENT;?></strong></td>
              <td align="center" bgcolor="#CCCCCC" ><strong><?=T_ARRVDATE;?></strong></td>
                <td width="60" align="center" bgcolor="#CCCCCC" ><strong><?=T_PRICE;?></strong></td>
            </tr>
        <?
			 	$firstEntry = 1;
             }
			 if($prevStat==$currentStat || $firstEntry){
	    ?>
            <tr class="tdRowOnOut" onMouseOver="this.className='tdRowOnOver'" onMouseOut="this.className='tdRowOnOut'" >
				<td onClick="OpenDivShowSummary(<?=$eorder_data->Rs("eorderID")?>)"  >
				<?=$eorder_data->Rs("ord_code");?></td>
				<td  style="padding-left:5px;padding-right:5px" onclick="OpenDivShowSummary(<?=$eorder_data->Rs("eorderID")?>)">&nbsp;
				    <?=$eorder_data->Rs("doc_name");?></td>
				<td onClick="OpenDivShowSummary(<?=$eorder_data->Rs("eorderID")?>)"  style="padding-left:5px;padding-right:5px">
				<?=$eorder_data->Rs("ord_patientname");?></td>
				<td onClick="OpenDivShowSummary(<?=$eorder_data->Rs("eorderID")?>)"  style="padding-left:2px;padding-right:2px">
				<?=$eorder_data->Rs("ord_gotdate");?></td>
                <td style="padding-left:2px;padding-right:2px">&nbsp;</td>
			</tr><?
				$firstEntry = 0;
				$prevStat = $eorder_data->Rs("ord_status");
				$eorder_data->MoveNext();
				if($eorder_data->EOF || $prevStat!=$eorder_data->Rs("ord_status")){
					?></table>
<?
				}
			}
		}else if($currentStat==6){
			if($prevStat!=$currentStat){	?>
			<table border="0" cellpadding="2" cellspacing="1" bgcolor="#999999" width="100%">
			<tr>
                <td width="120" align="center" bgcolor="#CCCCCC" ><strong><?=T_ORDERCODE;?></strong></td>
                <td width="100" align="center" bgcolor="#CCCCCC" ><strong>
                  <?=T_DOCTOR;?>
                </strong></td>
                <td width="100" align="center" bgcolor="#CCCCCC" ><strong><?=T_PATIENT;?></strong></td>
              <td align="center" bgcolor="#CCCCCC" ><strong><?=T_ARRVDATE;?></strong></td>
                <td width="60" align="center" bgcolor="#CCCCCC" ><strong><?=T_COST;?></strong></td>
                <td align="center" bgcolor="#CCCCCC" ><strong><?=T_STATUS;?></strong></td>
            </tr>
        <?
			 	$firstEntry = 1;
             }
			 if($prevStat==$currentStat || $firstEntry){
	    ?>
            <tr class="tdRowOnOut" onMouseOver="this.className='tdRowOnOver'" onMouseOut="this.className='tdRowOnOut'" >
				<td onClick="OpenDivShowSummary(<?=$eorder_data->Rs("eorderID")?>)"  >
				<?=$eorder_data->Rs("ord_code");?></td>
				<td  style="padding-left:5px;padding-right:5px" onclick="OpenDivShowSummary(<?=$eorder_data->Rs("eorderID")?>)">&nbsp;
				    <?=$eorder_data->Rs("doc_name");?></td>
				<td onClick="OpenDivShowSummary(<?=$eorder_data->Rs("eorderID")?>)"  style="padding-left:5px;padding-right:5px">
				<?=$eorder_data->Rs("ord_patientname");?></td>
				<td onClick="OpenDivShowSummary(<?=$eorder_data->Rs("eorderID")?>)"  style="padding-left:2px;padding-right:2px">
				<?=$eorder_data->Rs("ord_arrivedate");?></td>
                <td align="right"  style="padding-left:2px;padding-right:2px" onClick="OpenDivShowSummary(<?=$eorder_data->Rs("eorderID")?>)">
				<?=$eorder_data->Rs("ord_totalcost");?></td>
              <td style="padding-left:2px;padding-right:2px">&nbsp;</td>
			</tr><?
				$firstEntry = 0;
				$prevStat = $eorder_data->Rs("ord_status");
				$eorder_data->MoveNext();
				if($eorder_data->EOF || $prevStat!=$eorder_data->Rs("ord_status")){
					?></table>
<?
				}
			}
		}else if($currentStat==7){
			if($prevStat!=$currentStat){	?>
			<table border="0" cellpadding="2" cellspacing="1" bgcolor="#999999" width="100%">
		  <tr>
                <td width="120" align="center" bgcolor="#CCCCCC" ><strong><?=T_ORDERCODE;?></strong></td>
                <td width="100" align="center" bgcolor="#CCCCCC" ><strong>
                  <?=T_DOCTOR;?>
                </strong></td>
                <td width="100" align="center" bgcolor="#CCCCCC" ><strong><?=T_PATIENT;?></strong></td>
            <td align="center" bgcolor="#CCCCCC" ><strong><?=T_STARTDATE;?></strong></td>
                <td width="60" align="center" bgcolor="#CCCCCC" ><strong><?=T_ENDDATE;?></strong></td>
                <td width="60" align="center" bgcolor="#CCCCCC" ><strong><?=T_EXPIRE;?></strong></td>
                <td align="center" bgcolor="#CCCCCC" ><strong><?=T_WARANTY;?></strong></td>
            </tr>
        <?
			 	$firstEntry = 1;
             }
			 if($prevStat==$currentStat || $firstEntry){
	    ?>
            <tr class="tdRowOnOut" onMouseOver="this.className='tdRowOnOver'" onMouseOut="this.className='tdRowOnOut'" >
				<td onClick="OpenDivShowSummary(<?=$eorder_data->Rs("eorderID")?>)"  >
				<?=$eorder_data->Rs("ord_code");?></td>
				<td  style="padding-left:5px;padding-right:5px" onclick="OpenDivShowSummary(<?=$eorder_data->Rs("eorderID")?>)">&nbsp;
				    <?=$eorder_data->Rs("doc_name");?></td>
				<td onClick="OpenDivShowSummary(<?=$eorder_data->Rs("eorderID")?>)"  style="padding-left:5px;padding-right:5px">
				<?=$eorder_data->Rs("ord_patientname");?></td>
				<td width="60" align="center"  style="padding-left:2px;padding-right:2px" onClick="OpenDivShowSummary(<?=$eorder_data->Rs("eorderID")?>)">&nbsp;</td>
                <td align="center"  style="padding-left:2px;padding-right:2px" onClick="OpenDivShowSummary(<?=$eorder_data->Rs("eorderID")?>)">&nbsp;</td>
              <td align="center"  style="padding-left:2px;padding-right:2px" onClick="OpenDivShowSummary(<?=$eorder_data->Rs("eorderID")?>)">&nbsp;</td>
              <td style="padding-left:2px;padding-right:2px">&nbsp;</td>
			</tr><?
				$firstEntry = 0;
				$prevStat = $eorder_data->Rs("ord_status");
				$eorder_data->MoveNext();
				if($eorder_data->EOF || $prevStat!=$eorder_data->Rs("ord_status")){
					?></table>
	  <?
				}
			}
		}
}
?>


<? /* if(0){ ?>
    <table border="0" cellpadding="2" cellspacing="1" bgcolor="#999999" width="100%">
      <tr>
        <td width="120" align="center" bgcolor="#CCCCCC" ><strong>Order Code</strong></td>
        <td width="180" align="center" bgcolor="#CCCCCC" ><strong>Patient</strong></td>
        <td align="center" bgcolor="#CCCCCC" ><strong>Note</strong></td>
        <td width="60" align="center" bgcolor="#CCCCCC" >&nbsp;</td>
      </tr>
      <? while(!$eorder_data->EOF){ ?>
      <tr class="tdRowOnOut" onMouseOver="this.className='tdRowOnOver'" onMouseOut="this.className='tdRowOnOut'" >
        <td onClick="OpenDivShowSummary(<?=$eorder_data->Rs("eorderID")?>)"  >
        &nbsp;<?=$eorder_data->Rs("ord_code");?></td>
        <td onClick="OpenDivShowSummary(<?=$eorder_data->Rs("eorderID")?>)"  style="padding-left:5px;padding-right:5px">
        <?=$eorder_data->Rs("ord_patientname");?></td>
        <td onClick="OpenDivShowSummary(<?=$eorder_data->Rs("eorderID")?>)"  style="padding-left:2px;padding-right:2px">
        <?=$eorder_data->Rs("ord_docnote");?></td>
        <td width="60" align="center"><table border="0" cellpadding="1" cellspacing="1" bgcolor="#999999">
          <tr>
            <td width="30" align="center" class="tdButtonOnOutS" onmouseover="this.className='tdButtonOnOverS'" onmouseout="this.className='tdButtonOnOutS'" onClick="OpenDivShowSummary(<?=$eorder_data->Rs("eorderID")?>)">
            <img src="../resource/images/silkicons/zoom.gif" width="16" height="16" alt="Preview"/></td>
            <td width="30" align="center" class="tdButtonOnOutS" onmouseover="this.className='tdButtonOnOverS'" onmouseout="this.className='tdButtonOnOutS'"><img src="../resource/images/silkicons/pencil.gif" alt="Edit"/></td>
            <td width="30" align="center" class="tdButtonOnOutS" onmouseover="this.className='tdButtonOnOverS'" onmouseout="this.className='tdButtonOnOutS'"
            onclick="javascript:location='../eorder/submit_order.php?eorderid=<?=$eorder_data->Rs("eorderID")?>';"
            
            ><img src="../resource/images/silkicons/package_go.gif" alt="Submit"/></td>
          </tr>
        </table></td>
      </tr>   
      <? $eorder_data->MoveNext(); } ?>
      </table>
    <? }*/ ?>
		
    </td></tr>
    <? if($limit <10){ ?>
    <tr><td valign="bottom">
    <div align="right"> <span style="color:#0000FF;cursor:pointer" onclick="location='../cfrontend/order.php?cusid=<?=$customer_id?>&status=<?=$status?>'">
    <?=T_MORE?></span></div> </td></tr>
    <? }else if($totalpage>1){ ?>
    <tr><td height="40" valign="bottom">
    
    <div align="center" style="margin:2px">
    <table border="0" cellpadding="3" cellspacing="1" bgcolor="#999999">
          <tr>
    
    <?
    
        
        
        $startpage = $page-5;
        if($startpage < 1){
            $startpage = 1;
        }
        $endpage = $page+5;
        if($endpage>$totalpage){
            $endpage = $totalpage;
        }
        ?>
        
        <? if($startpage != 1){	?>
            
            <td width="16" align="center" class="tdButtonOnOut"
            onclick="gotoPage(<?=$id?>,<?=$status?>,<?=$limit?>,'1')" 
            onmouseover="this.className='tdButtonOnOver'" onmouseout="this.className='tdButtonOnOut'">
            <img src="../resource/images/silkicons/resultset_first.gif" width="16" height="16" /></td>        
            
        <? } ?>
        <? if($page != $startpage){	?>
            <td width="16" align="center" class="tdButtonOnOut"
            onclick="gotoPage(<?=$id?>,<?=$status?>,<?=$limit?>,<?=$page-1?>)" 
            onmouseover="this.className='tdButtonOnOver'" onmouseout="this.className='tdButtonOnOut'">
            <img src="../resource/images/silkicons/resultset_previous.gif" width="16" height="16" /></td>
            
        <? } ?>
        
        <? for($i=$startpage;$i<=$endpage;$i++){
            if(($i)!=$page){
                ?><td width="16" align="center" class="tdButtonOnOut" onclick="gotoPage(<?=$id?>,<?=$status?>,<?=$limit?>,<?=$i?>)" onmouseover="this.className='tdButtonOnOver'" onmouseout="this.className='tdButtonOnOut'">
            <?=$i?></td><?
            }else{
            ?>
            <td width="16" align="center" bgcolor="#DFECFF" style="font-weight:bold">
            <?=$i?></td>
            <?
            }
        } ?>
        <? if($page != $endpage){ ?>
            <td width="16" align="center" class="tdButtonOnOut"
            onclick="gotoPage(<?=$id?>,<?=$status?>,<?=$limit?>,<?=$page+1?>)" 
            onmouseover="this.className='tdButtonOnOver'" onmouseout="this.className='tdButtonOnOut'">
            <img src="../resource/images/silkicons/resultset_next.gif" width="16" height="16" /></td>    
        <? }   
        
        
        
         if($endpage != $totalpage){ ?>
            <td width="16" align="center" class="tdButtonOnOut"
            onclick="gotoPage(<?=$id?>,<?=$status?>,<?=$limit?>,<?=$totalpage?>)" 
            onmouseover="this.className='tdButtonOnOver'" onmouseout="this.className='tdButtonOnOut'">
            <img src="../resource/images/silkicons/resultset_last.gif" width="16" height="16" /></td>
            
        <? } ?>
     </tr>
     </table>
    </div>
	</td></tr>
	<? }?>
    </table>

<script>
function GotOrder(id,code,currentid,currentstatus,currentlimit,currentpage) {
	if(confirm('Did you get this order code: '+ code)){
		//Loading();
	showHTML('DivTestOrderList','../eorder/got_order.php?eorderid='+id+'&currentid='+currentid+'&page='+currentpage+'&status='+currentstatus+'&limit='+currentlimit);
	//refreshOverview();	//location='../eorder/eorder_delete_c.php?eorderid='+id+'&currentid='+currentid+'&page='+currentpage+'&status='+currentstatus+'&limit='+currentlimit+'&totalpage='+currenttotalpage;
	}
	return false;
}
function DeleteOrder(id,code,currentid,currentstatus,currentlimit,currentpage){
	if(confirm('Are you sure to delete\n order code : '+code)){
		//Loading();
	showHTML('DivTestOrderList','../eorder/eorder_delete_c.php?eorderid='+id+'&currentid='+currentid+'&page='+currentpage+'&status='+currentstatus+'&limit='+currentlimit);
	//refreshOverview();	//location='../eorder/eorder_delete_c.php?eorderid='+id+'&currentid='+currentid+'&page='+currentpage+'&status='+currentstatus+'&limit='+currentlimit+'&totalpage='+currenttotalpage;
	}
	return false;
}

</script>