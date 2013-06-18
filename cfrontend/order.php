<? include "header.php" ?>
<? $menu='order' ?><br />
<? include "mainmenu.php"?>
<? $tbframehclose2 = "OnCloseShowSummary()";?>
<? /**/ include "ordersummary.php" ?>
<? /**/ include "payment_div.php" ?>
<? /* */ include_once "../resource/divbackground.php" ?>

<?

	
	
	
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left" valign="top">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
                    <td width="50" rowspan="3" align="center" valign="top">&nbsp;</td>
                    <td align="left" valign="top">
                    <div style="width:600px">
					<? $tbframeheader = "Order flow"?>
                            <? include "tbframeh.php"?>
                          <div id="DivOrderOverview" align="left" style="height:250px"></div>
                          <? include "tbframef.php"?>
                    </div>                </td>
            <td width="220" rowspan="3" align="center" valign="top"><? include "tbframe2h.php"?>
                    <span style="font-weight: bold"><?=T_QLAUNCH;?></span><br /><br />
                    <a href="../eorder/eorder_edit.php?act=add&customerid=<?=$customer_id?>"><img src="images/icons/addorder.png" width="180" height="36" border="0" onmouseover="dToolTip('ADDORDER')" /></a>
                    <hr noshade="noshade" />
                    <table cellpadding="2" cellspacing="0" border="0">
                      <tr>
                        <td>&nbsp;&nbsp;<img src="images/icons/extendorder.png" width="105" height="36" border="0" /> </td>
                        <td width="10"></td>
                        </tr><tr>
                        <td align="right">Continue with exist code<br />
                          CODE:
        <input name="extendordercode" id="extendordercode" type="text" style="width:80px" /></td>
                        <td valign="bottom"><img onclick="gotoExtendOrder()" style="cursor:pointer;padding:0px" src="images/icons/extendgo.png"  width="22" height="22" /></td>
                      </tr>
                    </table>
                    <br />
                    
                    
                   		 <? include "tbframe2f.php"?>   
                         <?  include "../cfrontend/order_tooltip.php" ?></td>
              </tr>
          <tr>
            <td height="10" align="center" valign="top"></td>
          </tr>
          <tr>
        <td align="center" valign="top" height="800">
		<? // ---------------------------------------------------------- ?>        
        <? $tbframeheader = "Order list"?>
		<? include "tbframeh.php"?><a name="archorresult"></a><br />
                <div id="DivTestOrderList">
                <?
					GetVar($status,"status");
					if($status == NULL) {
						$status = 0;
					}
				?>
                <? if(isset($eorderid)) {?>
					<script>OpenDivShowSummary(<?=$eorderid?>);</script>
                <? }//else{ ?>
					<? $customer_id = $cusid; ?>
                    <? $page = 1; ?>
                    <? $limit = 20; ?>
                    <? include "../cfrontend/queryorderlist_c.php" ?>
                <? //} ?>
                
                
                </div><? //Div for ajax ?>
			<br />
        <? include "tbframef.php"?>            
		<? // ---------------------------------------------------------- ?>        </td>
        </tr>
    </table></td>
  </tr>
</table>
<script>
var lastStatus;
function gotoStatus(status){
	lastStatus = status;
	if(status == 5){
		showHTML('DivTestOrderList','querypaymentlist_c.php?customerid=<?=$cusid?>&status='+status+'&limit=25');	
		
	}else{
		showHTML('DivTestOrderList','queryorderlist_c.php?customerid=<?=$cusid?>&status='+status+'&limit=25');
	}
}
function gotoPage(id,stat,lim,page)
{
showHTML('DivTestOrderList',"../cfrontend/queryorderlist_c.php?customerid="+id+"&status="+stat+"&limit="+lim+"&page="+page);
return false;
}
function refreshOverview()
{
    showHTML('DivOrderOverview',"../cfrontend/order_overview.php?customerid=<?=$cusid?>");
}
refreshOverview();

function OnCloseShowSummary()
{
	if(lastStatus==5)
	{
		OpenDivShowPaymentInfo('',0)	
	}
}

function gotoExtendOrder(){
	var exCode = getValue('extendordercode');
	window.location="#archorresult";//"../eorder/eorder_extendlist.php?exordercode="+exCode;
	showHTML('DivTestOrderList',"../eorder/eorder_extendlist.php?exordercode="+exCode);
}
</script>
<? include "footer.php" ?>
