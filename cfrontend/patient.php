<? include "header.php" ?>
<? $menu='patient' ?><br />
<? include "mainmenu.php"?>
<? $tbframehclose2 = "OpenDivShowPatientInfo(-1,'')";?>
<? $OpenDivShowSummaryAlterMethod="CloseDivShowPatientInfo()" ?>
<? /**/ include "ordersummary.php" ?>
<? /**/ include "patient_order_div.php" ?>
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
                    <div style="width:600px">
					<? $tbframeheader = "Patient list"?>
                            <? include "tbframeh.php"?>
                          <div id="DivPatientList" align="left" style="height:450px">
                            <? if(isset($customer_id)) {?>
                                <? $limit = 20; ?>
                                <? $page = 1; ?>
                                <? /* */include "../cfrontend/querypatientlist_c.php" ?>
                            <? } ?>
                            
                          </div>
                          <? include "tbframef.php"?>
                    </div>                </td>
            <td width="300" align="center" valign="top">
                       <?  include "../cfrontend/order_tooltip.php" ?>
            
                        </td>
                  </tr>
    </table></td>
  </tr>
</table>

<? include "footer.php" ?>
