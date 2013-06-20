<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="../resource/javascript/ajax.js"></script> 
<script src="../resource/javascript/default.js"></script>
<link href="../cfrontend/default.css" rel="stylesheet" type="text/css" />
<table cellpadding="0" cellspacing="0" height="100%" width="100%"><tr><td valign="top">
                            <table width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#999999">
                              <tr>
                                <td align="center" bgcolor="#CCCCCC"><strong>Month                                </strong></td>
                                <td align="center" bgcolor="#CCCCCC"><strong>Total Order</strong></td>
                                <td align="center" bgcolor="#CCCCCC"><strong>Total Cost</strong></td>
                              </tr>
                    <?	while(!$payment_data->EOF){
									?>
                    		  
							  <tr class="tdRowOnOut"  style="padding-left:10px;padding-right:10px" onClick="OpenDivShowPaymentInfo(<?=$customer_id?>,'<?=$payment_data->Rs("releasemonth");?>')" onMouseOver="this.className='tdRowOnOver'" onMouseOut="this.className='tdRowOnOut'">
                                <td align="center">
								<?=substr($payment_data->Rs("releasemonth"),5,2);?>/<?=substr($payment_data->Rs("releasemonth"),0,4);?></td>
                                <td align="center">
								<?=$payment_data->Rs("countorder");?></td>
                                <td align="center">
								<?=$payment_data->Rs("totalcost");?></td>
                              
                              </tr>
                              <? $payment_data->MoveNext();?>
                    <? 	}   ?>        
                            </table>
</td></tr>                        
                        <? if($totalpage>1){ ?>
                        <tr><td align="center" valign="bottom">

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
                          <table border="0" cellpadding="3" cellspacing="1" bgcolor="#999999" style="margin:5px">
                          <tr>
                          	<? if($startpage != 1){	?>
                                
                                <td width="16" align="center" class="tdButtonOnOut"
                                onclick="gotoPaymentPage(<?=$customer_id?>,'1')"
                                onmouseover="this.className='tdButtonOnOver'" onMouseOut="this.className='tdButtonOnOut'">
                                <img src="../resource/images/silkicons/resultset_first.gif" width="16" height="16" /></td>            
                            <? } ?>
							<? if($page != $startpage){	?>
                                <td width="16" align="center" class="tdButtonOnOut"
                                onclick="gotoPaymentPage(<?=$customer_id?>,<?=$page-1?>)" 
                                onmouseover="this.className='tdButtonOnOver'" onMouseOut="this.className='tdButtonOnOut'">
                                <img src="../resource/images/silkicons/resultset_previous.gif" width="16" height="16" /></td>                               
                            <? } ?>
                            
                            	<? for($i=$startpage;$i<=$endpage;$i++){
									if(($i)!=$page){
										?><td width="16" align="center" class="tdButtonOnOut" onClick="gotoPatientPage(<?=$customer_id?>,<?=$i?>)" onMouseOver="this.className='tdButtonOnOver'" onMouseOut="this.className='tdButtonOnOut'">
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
                                onclick="gotoPaymentPage(<?=$customer_id?>,<?=$page+1?>)" 
                                onmouseover="this.className='tdButtonOnOver'" onMouseOut="this.className='tdButtonOnOut'">
                                <img src="../resource/images/silkicons/resultset_next.gif" width="16" height="16" /></td>    
                            <? }
							   if($endpage != $totalpage){ ?>
                                <td width="16" align="center" class="tdButtonOnOut"
                                onclick="gotoPaymentPage(<?=$customer_id?>,<?=$totalpage?>)" 
                                onmouseover="this.className='tdButtonOnOver'" onMouseOut="this.className='tdButtonOnOut'">
                                <img src="../resource/images/silkicons/resultset_last.gif" width="16" height="16" /></td>                              
                            <? } ?>
                          </tr>
                          </table>
                          </td></tr> <? } ?></table>
                   
<script>
function gotoPaymentPage(cusid,page)
{
	//document.location = "../cfrontend/doctor.php?cusid="+cusid+"&page="+page+"&limit=<?=$limit?>";
	//return false;
	showHTML('DivPatientList',"../cfrontend/querypaymentlist_c.php?cusid="+cusid+"&page="+page+"&limit=<?=$limit?>");
	//return false;
}

</script>
