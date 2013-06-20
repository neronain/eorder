<? include "header.php" ?>
<? $menu='doctor' ?><br />
<? include "mainmenu.php"?>
<? $tbframehclose2 = "OpenDivShowDoctorInfo(-1)";?>
<? $OpenDivShowSummaryAlterMethod="CloseDivShowDoctorInfo()" ?>
<? /**/ include "ordersummary.php" ?>
<? /**/ include "doctor_order_div.php" ?>
<? $customer_id = $_GET['customerid'];
   $page = $_GET['page'];
?>


<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left" valign="top">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
                    <td width="50"  align="center" valign="top">&nbsp;</td>
                    <td align="left" valign="top">
                    	<div style="width:600px;">
					<? $tbframeheader = "Doctors list"?>
                            <? include "tbframeh.php"?>
                          <div align="left" id="DivDoctorList" style="height:450px">
                            <? if(isset($customer_id)) {?>
                                <? $limit = 20; ?>
                                <? $page = 1; ?>
                                <? /* */include "../cfrontend/querydoctorlist_c.php" ?>
                            <? } ?>
                
                          </div>
                    
                          <? include "tbframef.php"?>
                    </div>   
                    </td>
            		<td width="300" align="center" valign="top"><div style="width:260px;" align="left">
            <? include "../cfrontend/tbframe2h.php"?>
                    <span style="font-weight: bold"><?=T_QLAUNCH?></span><br />
					<script src="../resource/javascript/ajax.js"></script>
                    <table><tr>
                      <td><?=T_ADDDOCTOR?><br />                        
                        <?=T_FILLNAME?><br/>
                    <input id="name" name="name" type="text" value="" style="width:180px;height:20px"/></td>
                    <td><br />
<img src="images/icons/add.png" width="36" height="36" style="cursor:pointer" onclick="showHTML('DivDoctorList','../eorder/doctor_process.php?act=doctor&cid=<?=$customer_id?>&name='+encodeTH(getValue('name')));setValue('name','');" /></td></tr></table>

                    <? include "../cfrontend/tbframe2f.php"?>	
                     <?  include "../cfrontend/order_tooltip.php" ?>
                    </div>  
            		</td>
                  </tr>
    </table></td>
  </tr>
</table>



<? include "footer.php" ?>
