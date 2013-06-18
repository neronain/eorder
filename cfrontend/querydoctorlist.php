<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="../resource/javascript/ajax.js"></script> 
<script src="../resource/javascript/default.js"></script>
<link href="../cfrontend/default.css" rel="stylesheet" type="text/css" />

<table cellpadding="0" cellspacing="0" height="100%" width="100%"><tr><td valign="top">
                            <table width="100%" border="0" cellpadding="2" cellspacing="1">

                              <? while(!$doctor_data->EOF){ ?>
                              <tr>
                                <td class="tdRowOnOut" onMouseOver="this.className='tdRowOnOver'" onMouseOut="this.className='tdRowOnOut'" onClick="OpenDivShowDoctorInfo(<?=$doctor_data->Rs("doctorId");?>)"  style="padding-left:10px;padding-right:10px"><?=$doctor_data->Rs("doc_name");?></td>
                              </tr>
                              <? $doctor_data->MoveNext(); 
							  } ?>
                            </table>
                        </td></tr>
                        <? if($totalpage>1){ ?>
                              
                                <tr><td height="50" align="center" valign="bottom">
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
                                onclick="gotoDoctorPage(<?=$customer_id?>,'1')"
                                onmouseover="this.className='tdButtonOnOver'" onMouseOut="this.className='tdButtonOnOut'">
                                <img src="../resource/images/silkicons/resultset_first.gif" width="16" height="16" /></td>            
                            <? } ?>
							<? if($page != $startpage){	?>
                                <td width="16" align="center" class="tdButtonOnOut"
                                onclick="gotoDoctorPage(<?=$customer_id?>,<?=$page-1?>)" 
                                onmouseover="this.className='tdButtonOnOver'" onMouseOut="this.className='tdButtonOnOut'">
                                <img src="../resource/images/silkicons/resultset_previous.gif" width="16" height="16" /></td>                               
                            <? } ?>
                            
                            	<? for($i=$startpage;$i<=$endpage;$i++){
									if(($i)!=$page){
										?><td width="16" align="center" class="tdButtonOnOut" onClick="gotoDoctorPage(<?=$customer_id?>,<?=$i?>)" onMouseOver="this.className='tdButtonOnOver'" onMouseOut="this.className='tdButtonOnOut'">
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
                                onclick="gotoDoctorPage(<?=$customer_id?>,<?=$page+1?>)" 
                                onmouseover="this.className='tdButtonOnOver'" onMouseOut="this.className='tdButtonOnOut'">
                                <img src="../resource/images/silkicons/resultset_next.gif" width="16" height="16" /></td>    
                            <? }
							   if($endpage != $totalpage){ ?>
                                <td width="16" align="center" class="tdButtonOnOut"
                                onclick="gotoDoctorPage(<?=$customer_id?>,<?=$totalpage?>)" 
                                onmouseover="this.className='tdButtonOnOver'" onMouseOut="this.className='tdButtonOnOut'">
                                <img src="../resource/images/silkicons/resultset_last.gif" width="16" height="16" /></td>                              
                            <? } ?>
                          </tr>
                          </table>
                          
                          </td></tr>
                         
                           <? } ?> </table>
                          
                   
<script>
function gotoDoctorPage(cusid,page)
{
	//document.location = "../cfrontend/doctor.php?cusid="+cusid+"&page="+page+"&limit=<?=$limit?>";
	//return false;
	showHTML('DivDoctorList',"../cfrontend/querydoctorlist_c.php?cusid="+cusid+"&page="+page+"&limit=<?=$limit?>");
	//return false;
}

</script>