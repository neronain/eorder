<? include_once("../core/default.php"); ?>
<?
/* IN 
	$data_customer >> customer list
	
*/
?>


<html>
<title><?=WEBSITE_HEADER  ?></title>
<link href="../resource/css/default.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<body>
<script src="../resource/javascript/ajax.js"></script>
<script src="../resource/javascript/default.js"></script>
<? /* */ include_once "../resource/divbackground.php" ?>
<table width="100%" height="100%" cellspacing="0" cellpadding="0">
<tr><td height="50"><?  $currentMenu="customerlist";include_once("../customer/customermenu.php"); ?></td></tr>
<tr><td align="center" valign="top">
<table width="90%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="20"></td>
    <td><table width="100%" border="0" cellpadding="2" cellspacing="1" class="TableBorder">
      <tr>
        <td class="HeaderW"> 
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td class="HeaderW"><img src="../resource/images/silkicons/building.gif" border="0" /> Customer list</td>
              <td class="Normal" align="right">Found <?=$totalrow?> in <?=$totalpage?> pages</td>
            </tr>
          </table></td>
      </tr>
	  <form action="../customer/customerlist_c.php" method="get">
      <tr>
        <td align="right" bgcolor="#FFFFFF" class="searchTD">Search 
          <input type="text" name="keyword" style="width:80" value="<?=$keyword?>">
          <input name="METHOD" type="submit" class="BTsearch" id="METHOD" value="GO!">
		  <input name="Stupid_IE_Bug" type="text" style="width:0;visibility:hidden" value="" size="1" >
		  </td>
      </tr>
	  </form>
      <tr>
        <td align="center" bgcolor="#FFFFFF">
					<?



		
			$querystring  = "?";
			foreach($_GET as $variable => $value){
				if($variable=="page")continue;
				//if($variable=="METHOD")continue;
				$querystring  .= "$variable=$value&";
			}
			?>
					<table cellspacing="0" cellpadding="0"><tr><td width="50"><?
					if($totalpage>1){
			 if($page!=1){
			echo "<a href=\"../customer/customerlist_c.php".$querystring."page=1\"><img src=\"../resource/images/silkicons/resultset_first.gif\" width=\"16\" height=\"16\" border=0></a></a>";	 }
			?></td><td width="50"><?
			if($page>1){
			echo "<a href=\"../customer/customerlist_c.php".$querystring."page=".($page-1)."\"><img src=\"../resource/images/silkicons/resultset_previous.gif\" width=\"16\" height=\"16\" border=0></a>";	 }
			?></td><td align="center" width="300"><?
			for($p=max(1,$page-3);$p<=$page+3 && $p<=$totalpage;$p++){ 
					if($p==$page){
						echo "&nbsp;&nbsp;&nbsp;<strong>$p</strong>&nbsp;&nbsp;&nbsp;";
					}else{
						echo "&nbsp;&nbsp;<a href=\"../customer/customerlist_c.php".$querystring."page=$p\">$p</a>&nbsp;&nbsp;";		
					}
			} ?>
			</td><td width="50" align="right">
			<? if($page<$totalpage){
			echo "<a href=\"../customer/customerlist_c.php".$querystring."page=".($page+1)."\"><img src=\"../resource/images/silkicons/resultset_next.gif\" width=\"16\" height=\"16\" border=0></a>";	 }?>
			</td><td width="50" align="right">
			<? if($page!=$totalpage){
			echo "<a href=\"../customer/customerlist_c.php".$querystring."page=$totalpage\"><img src=\"../resource/images/silkicons/resultset_last.gif\" width=\"16\" height=\"16\" border=0></a>";	 }}?>
			</td></tr></table>
		
		</td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF">
		<table width="100%"  border="0" cellpadding="2" cellspacing="2">
			<tr>
			    <td class="HeaderTable" width="80">Nick</td>
			    <td class="HeaderTable">Name</td>
			    
			    <td class="HeaderTable" width="100">Province</td>
			    <td class="HeaderTable" width="100">Country</td>
		      </tr>
			<? while(!$data_customer->EOF){ ?>

			  <tr class="tdRowOnOut" valign="top" onMouseOver="this.className='tdRowOnOver'" onMouseOut="this.className='tdRowOnOut'" onClick="OpenDivShowCustomer('<?= $data_customer->Rs("customerid"); ?>')"  >
				<td> 
                
				
				<?= $data_customer->Rs("cus_nick"); ?></td>
				<td>
				
				<?= $data_customer->Rs("cus_name"); ?></td>
				<td><?= $data_customer->Rs("prv_name"); ?></td>
				<td><?= $data_customer->Rs("cnt_name"); ?></td>
			  </tr>
			
			<? $data_customer->MoveNext();	} ?>
        </table></td>
      </tr>
      <tr>
        <td align="center" bgcolor="#FFFFFF">
		
		<table cellspacing="0" cellpadding="0"><tr><td width="50"><?
		if($totalpage>1){
			 if($page!=1){
			echo "<a href=\"../customer/customerlist_c.php".$querystring."page=1\"><img src=\"../resource/images/silkicons/resultset_first.gif\" width=\"16\" height=\"16\" border=0></a>";	 }
			?></td><td width="50"><?
			if($page>1){
			echo "<a href=\"../customer/customerlist_c.php".$querystring."page=".($page-1)."\"><img src=\"../resource/images/silkicons/resultset_previous.gif\" width=\"16\" height=\"16\" border=0></a>";	 }
			?></td><td align="center" width="300"><?
			for($p=max(1,$page-3);$p<=$page+3 && $p<=$totalpage;$p++){ 
					if($p==$page){
						echo "&nbsp;&nbsp;&nbsp;<strong>$p</strong>&nbsp;&nbsp;&nbsp;";
					}else{
						echo "&nbsp;&nbsp;<a href=\"../customer/customerlist_c.php".$querystring."page=$p\">$p</a>&nbsp;&nbsp;";		
					}
			} ?>
			</td><td width="50" align="right">
			<? if($page<$totalpage){
			echo "<a href=\"../customer/customerlist_c.php".$querystring."page=".($page+1)."\"><img src=\"../resource/images/silkicons/resultset_next.gif\" width=\"16\" height=\"16\" border=0></a>";	 }?>
			</td><td width="50" align="right">
			<? if($page!=$totalpage){
			echo "<a href=\"../customer/customerlist_c.php".$querystring."page=$totalpage\"><img src=\"../resource/images/silkicons/resultset_last.gif\" width=\"16\" height=\"16\" border=0></a>";	 }}?>
			</td></tr></table>
		</td>
      </tr>
      <tr>
        <td class="FooterTD">&nbsp;</td>
      </tr>
    </table>
    <br>
    
   <strong> Country List</strong><hr>
<!------------------------------------------------------------------------------------->
<? 
	if(count($country)>0) {
		foreach($country as $key => $value) {
?>
			<a href="../customer/customerlist_c.php?cnt_id=<?=$country[$key]["id"]?>">[<?=$country[$key]["name"]?>]</a>&nbsp;
<? 
		}
	} else { 
		echo " ";
	} 
?>
<hr>
<br>
<? 
	if(count($province)>1) {
?>
   <strong> Province List</strong><hr>
<!------------------------------------------------------------------------------------->
<? 
		foreach($province as $key => $value) {
?>
			<a href="../customer/customerlist_c.php?prv_id=<?=$province[$key]["id"]?>&cnt_id=<?=$cnt_id?>">[<?=$province[$key]["name"]?>]</a>&nbsp;
<? 
		}
		echo "<hr>";
	} else { 
		echo " ";
	} 
?>
<br>

</td>
    <td width="20">&nbsp;</td>
  </tr>
  
</table>
</td></tr></table>

<div id="DivShowCustomer" style="position:absolute; left:0px; top:2000px; width:618px; height:500px; z-index:1;">
<? $tbframeheader = "Customer Info"?>
<? $tbframehclose = "CloseDivShowCustomer()";?>
<? include "../cfrontend/tbframeh.php"?>
<div id="DivAjaxOrderCustomer" style="overflow:auto;width:600px;height:450px" align="left"><br>
</div>


<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><table border="0" cellpadding="3" cellspacing="1" bgcolor="#999999">
      <tr>
        <td class="tdButtonOnOutS" onMouseOver="this.className='tdButtonOnOverS'" onMouseOut="this.className='tdButtonOnOutS'"
        onclick="CustomerChangeTab('detail')">
        <img src="../resource/images/silkicons/building.gif" /> Customer detail</td>
        <td class="tdButtonOnOutS" onMouseOver="this.className='tdButtonOnOverS'" onMouseOut="this.className='tdButtonOnOutS'"
        onclick="CustomerChangeTab('doctor')">
        <img src="../resource/images/silkicons/user.gif" /> Doctor</td>
        <td class="tdButtonOnOutS" onMouseOver="this.className='tdButtonOnOverS'" onMouseOut="this.className='tdButtonOnOutS'"
        onclick="CustomerChangeTab('order')">
        <img src="../resource/images/silkicons/package.gif" /> Processing order </td>
        <td class="tdButtonOnOutS" onMouseOver="this.className='tdButtonOnOverS'" onMouseOut="this.className='tdButtonOnOutS'"
    	onclick="CustomerChangeTab('payment')">
   		<img src="../resource/images/silkicons/money.gif" width="16" height="16" /> Pending payment</td>
      </tr>
    </table></td>
    <td align="right"><table border="0" cellpadding="3" cellspacing="1" bgcolor="#999999">
      <tr>

        

        <!--td class="tdButtonOnOutS" onMouseOver="this.className='tdButtonOnOverS'" onMouseOut="this.className='tdButtonOnOutS'"
        onclick="EditCustomer()">
        <img src="../resource/images/silkicons/pencil.gif" /> Edit </td-->
        
        <td class="tdButtonOnOutS" onMouseOver="this.className='tdButtonOnOverS'" onMouseOut="this.className='tdButtonOnOutS'"
        onclick="CustomerChangeTab('addorder')">
        <img src="../resource/images/silkicons/package_add.gif" /> AddOrder </td>
      </tr>
    </table></td>
    <td width="50" align="right">&nbsp;</td>
  </tr>
</table>

<? include "../cfrontend/tbframef.php"?>
</div>


</body></html>

<script>
var CustomerCurrentTab ='overview'; 
function CustomerChangeTab(name)
{
	switch(name){
		case 'detail':
			CustomerCurrentTab = name;
			showHTML('DivAjaxOrderCustomer','../customer/customerdetail_c.php?customerid='+lastCustomerID);	
			break;
		case 'edit':
			CustomerCurrentTab = name;
			showHTML('DivAjaxOrderCustomer','../customer/customeredit_frame.php?customerid='+lastCustomerID);	
			break;
		case 'update':
			CustomerCurrentTab = name;
			var str = "&cus_name="+getValue('cus_name')+"&cus_nick="+getValue('cus_nick')+"&cus_tel="+getValue('cus_tel')+"&cus_email="+getValue('cus_email')+"&province="+getValue('province')+"&country="+getValue('country')+"&address="+getValue('address')+"&shipaddress="+getValue('shipaddress')+"&billaddress="+getValue('billaddress');
			showPost('DivAjaxOrderCustomer','../customer/customeredit_c.php','METHOD=UPDATE&customerid='+lastCustomerID+str);
			break;
			
		case 'adddoctor':
			CustomerCurrentTab = name;
			showHTML('DivAjaxOrderCustomer','../customer/customerdoctoradd.php?customerid='+lastCustomerID);	
			break;
		case 'updatedoctor':
			break;
		case 'doctor':
			CustomerCurrentTab = name;
			showHTML('DivAjaxOrderCustomer','../customer/customerdoctor_c.php?customerid='+lastCustomerID);	
			break;
		case 'order':
			CustomerCurrentTab = name;
			location='../order/orderlist_c.php?column=ord_cus_id&status=3&keyword='+lastCustomerID+'&METHOD=GO%21';
			break;
			
		case 'payment':
			CustomerCurrentTab = name;
			location='../order/orderlist_c.php?column=ord_cus_id&status=56&keyword='+lastCustomerID+'&METHOD=GO%21';
			break;
		case 'addorder':
			CustomerCurrentTab = name;
			location='../eorder/eorder_edit.php?act=add&customerid='+lastCustomerID;
			break;
	}
	
}

function editCustomerDoctorList(docid,docname){
	//CustomerCurrentTab = doctor;
	//alert(docname);
	showHTML('DivAjaxOrderCustomer','../customer/customerdoctoredit_c.php?cusid='+lastCustomerID+'&docid='+docid+'&docname='+encodeTH(docname));	
}

function addCustomerDoctorList(docname){
	//CustomerCurrentTab = doctor;
	//alert(docname);
	showHTML('DivAjaxOrderCustomer','../customer/customerdoctoradd_c.php?cusid='+lastCustomerID+'&docname='+encodeTH(docname));	
}

function delCustomerDoctorList(docid){
	//CustomerCurrentTab = doctor;
	//alert(docname);
	showHTML('DivAjaxOrderCustomer','../customer/customerdocterdel_c.php?cusid='+lastCustomerID+'&docid='+docid);	
}


var lastCustomerID;
function OpenDivShowCustomer(id)
{
	lastCustomerID = id;
	activeBG();
	showHideLayers('DivShowCustomer','','show');
	makeCenterScreen('DivShowCustomer');
	showHTML('DivAjaxOrderCustomer','../customer/customerdetail_c.php?customerid='+id);
	//showHTML('DivAjaxOrderCustomer_MENU','../customer/customerdetail_menu.php?eorderid='+id);
}
/*
function EditCustomer(){
	showHTML('DivAjaxOrderCustomer','../customer/customeredit_c.php?customerid='+lastCustomerID);
}//*/

function CloseDivShowCustomer()
{
	hideBG();
	showHideLayers('DivShowCustomer','','hide');
}
showHideLayers('DivShowCustomer','','hide');
hideLoading();
</script>
<? 
include_once '../core/inc_pngfix.php';
echo replacePngTags(ob_get_clean()); ?>