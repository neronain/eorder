<? include_once "header.php" ?>
<? include_once "../core/default.php" ?>
<? $menu='dashboard' ?><br />
<? include_once "mainmenu.php"?>
<? /**/ include_once "ordersummary.php" ?>
<? include_once("../cfrontend/dashboard_c.php"); ?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left" valign="top">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
                    <td width="50" rowspan="3" align="center" valign="top">&nbsp;</td>
                    <td align="left" valign="top">
                    <div style="width:100%"  id="DivTestOrderList">
					<? $tbframeheader = "News"?>
                            <? include "tbframeh.php"?>
                               
                            
                          <div align="left" >
<? // ------------------------------------------------------------------------------------------------------------ ?>




<?
	for($i=0;$i<count($news);$i++) {
?>

			<div class="post" id="post<?=$news[$i]["id"]?>">
					<!-- Date Block -->
					<div id="dateblock">
						<?=$news[$i]["month"]?>
                        <div id="day"><?=$news[$i]["day"]?></div>
					</div>

				<div id="postheader">
                        <h1><?=$news[$i]["title"]?></h1>
                    <div id="postdetails"> <?=T_POSTNEW;?>	</div>
				</div>
				<div id="postcontent">
						<?=$news[$i]["data"]?>
				</div>
			</div>
<?
	}
?>



<? // ------------------------------------------------------------------------------------------------------------ ?>

</div>
                          <? include "tbframef.php"?>
                    </div>                </td>
            <td width="350" rowspan="3" align="center" valign="top">
                      
            
            <? include "tbframe2h.php"?>
                    <span style="font-weight: bold">-- <?=T_QLAUNCH;?> --</span><br /><br />
                    <a href="../eorder/eorder_edit.php?act=add&customerid=<?=$customer_id?>"><img src="images/icons/addorder.png" width="180" height="36" border="0" /></a><br />
                    <hr />
                    <table cellpadding="2" cellspacing="0" border="0">
                    <tr>
                    <td>
                     &nbsp;&nbsp;<img src="images/icons/extendorder.png" width="105" height="36" border="0" />                    </td>
                     <td width="10"></td>
                     <td width="1" bgcolor="#999999"></td>
                     <td width="10" align="right">&nbsp;</td>
                     <td align="right">
                     <? if($language=='thai'){ ?>
                     เพิ่มใบสั่งงานจากรหัสเดิม<br />
                     <? }else{ ?>
                     Continue with exist code<br />
                     <? } ?>
                     
                     
                    CODE:<input name="extendordercode" id="extendordercode" type="text" style="width:80px" /></td>
                    <td valign="bottom"><img onclick="gotoExtendOrder()" style="cursor:pointer;padding:0px" src="images/icons/extendgo.png"  width="22" height="22" /></td>
                    </tr></table>
                    
                   		 <? include "tbframe2f.php"?>
                          <? include "advertise.php"?>


            </td>
                  </tr>
          <tr>
            <td height="10" align="center" valign="top">
            </td>
          </tr>
          <tr>
        <td align="center" valign="top"><a name="archorresult"></a>
        <!-- div id="DivTestOrderList"></div -->
		<? // ---------------------------------------------------------- ?>        
        <? //$tbframeheader = "Update Order"?>
		<? //include "tbframeh.php"?>
        <!-- br />
			<div id="DivTestOrderList" style="height:170px;overflow:auto" ></div><? //Div for ajax ?>
			<br /-->
        <? //include "tbframef.php"?>            
		<? // ---------------------------------------------------------- ?>        </td>
        </tr>
    </table></td>
  </tr>
</table>

<? include "footer.php" ?>
<script>
function gotoExtendOrder(){
	var exCode = getValue('extendordercode');
	//window.location="#archorresult";//"../eorder/eorder_extendlist.php?exordercode="+exCode;
	showHTML('DivTestOrderList',"../eorder/eorder_extendlist.php?exordercode="+exCode);
}
</script>