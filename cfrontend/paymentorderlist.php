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
while(!$eorder_data->EOF){
	$currentStat = $eorder_data->Rs("ord_status");
	//if($prevStat!=$currentStat){
	    ?>
            <tr class="tdRowOnOut" onMouseOver="this.className='tdRowOnOver'" onMouseOut="this.className='tdRowOnOut'" >
				<td onClick="OpenDivShowSummary(<?=$eorder_data->Rs("eorderID")?>)"  >
				<?=$eorder_data->Rs("ord_code");?></td>
				<td  style="padding-left:5px;padding-right:5px" onclick="OpenDivShowSummary(<?=$eorder_data->Rs("eorderID")?>)">&nbsp;
				    <?=$eorder_data->Rs("doc_name");?></td>
				<td onClick="OpenDivShowSummary(<?=$eorder_data->Rs("eorderID")?>)"  style="padding-left:5px;padding-right:5px">
				<?=$eorder_data->Rs("ord_patientname");?></td>
				<td align="center"  style="padding-left:2px;padding-right:2px" onClick="OpenDivShowSummary(<?=$eorder_data->Rs("eorderID")?>)">
				<?=$eorder_data->Rs("ord_gotdate");?></td>
              <td style="padding-left:2px;padding-right:2px" align="right"><?=$eorder_data->Rs("ord_totalcost");?></td>
			</tr><?
				//$firstEntry = 0;
				//$prevStat = $eorder_data->Rs("ord_status");
				$eorder_data->MoveNext();
}
?>
</table>

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
            onclick="gotoPaymentPage(<?=$customer_id?>,<?=$status?>,<?=$limit?>,'1','<?=$releasedate?>')" 
            onmouseover="this.className='tdButtonOnOver'" onmouseout="this.className='tdButtonOnOut'">
            <img src="../resource/images/silkicons/resultset_first.gif" width="16" height="16" /></td>        
            
        <? } ?>
        <? if($page != $startpage){	?>
            <td width="16" align="center" class="tdButtonOnOut"
            onclick="gotoPaymentPage(<?=$customer_id?>,<?=$status?>,<?=$limit?>,<?=$page-1?>,'<?=$releasedate?>')" 
            onmouseover="this.className='tdButtonOnOver'" onmouseout="this.className='tdButtonOnOut'">
            <img src="../resource/images/silkicons/resultset_previous.gif" width="16" height="16" /></td>
            
        <? } ?>
        
        <? for($i=$startpage;$i<=$endpage;$i++){
            if(($i)!=$page){
                ?><td width="16" align="center" class="tdButtonOnOut" onclick="gotoPaymentPage(<?=$customer_id?>,<?=$status?>,<?=$limit?>,<?=$i?>,'<?=$releasedate?>')" onmouseover="this.className='tdButtonOnOver'" onmouseout="this.className='tdButtonOnOut'">
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
            onclick="gotoPaymentPage(<?=$customer_id?>,<?=$status?>,<?=$limit?>,<?=$page+1?>,'<?=$releasedate?>')" 
            onmouseover="this.className='tdButtonOnOver'" onmouseout="this.className='tdButtonOnOut'">
            <img src="../resource/images/silkicons/resultset_next.gif" width="16" height="16" /></td>    
        <? }   
        
        
        
         if($endpage != $totalpage){ ?>
            <td width="16" align="center" class="tdButtonOnOut"
            onclick="gotoPaymentPage(<?=$customer_id?>,<?=$status?>,<?=$limit?>,<?=$totalpage?>,'<?=$releasedate?>')" 
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
function DeleteOrder(id,code,currentid,currentstatus,currentlimit,currentpage){
	if(confirm('Are you sure to delete\n order code : '+code)){
		//Loading();
	showHTML('DivTestOrderList','../eorder/eorder_delete_c.php?eorderid='+id+'&currentid='+currentid+'&page='+currentpage+'&status='+currentstatus+'&limit='+currentlimit);
	//refreshOverview();	//location='../eorder/eorder_delete_c.php?eorderid='+id+'&currentid='+currentid+'&page='+currentpage+'&status='+currentstatus+'&limit='+currentlimit+'&totalpage='+currenttotalpage;
	}
	return false;
}

</script>