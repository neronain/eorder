<? /* */ include_once("../admin/header.php"); ?>
<? /* */ include_once "../resource/divbackground.php" ?>

<div id="DivStatus"></div>
<table width="100%" border="0" cellpadding="2" cellspacing="1" class="TableBorder">
      <tr>
        <td colspan="2" class="HeaderW"> 
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td class="HeaderW" align="left"><img src="../resource/images/silkicons/group.gif">Product list</td>
              <td class="Normal" align="right">Found material in <?=$totalpage?> page(s)</td>
            </tr>
          </table></td>
      </tr>
	  <form name="FormSearch" action="../admin/material_manager_c.php" method="get">
      <input type="hidden" name="productid" id="productid" value="<?=$productid?>" />
      <tr>
        <td align="left" bgcolor="#FFFFFF" class="searchTD">&nbsp; </td>
        <td align="right" bgcolor="#FFFFFF" class="searchTD"><input type="text" name="keyword" style="width:150px" value="<?=$keyword?>" />&nbsp;<input type="submit" class="BTsearch"value="Search"></td>
      </tr>
	  </form>
      <tr>
        <td colspan="2" align="center" bgcolor="#FFFFFF">
       
<table cellspacing="0" cellpadding="0"><tr><td width="50"><?
	if($totalpage>1){
		if($page!=1){
			echo "<a href=\"../admin/material_manager_c.php".$querystring."page=1\"><img src=\"../resource/images/silkicons/resultset_first.gif\" width=\"16\" height=\"16\" border=0></a></a>";	 }
	?></td><td width="50"><?
		if($page>1){
			echo "<a href=\"../admin/material_manager_c.php".$querystring."page=".($page-1)."\"><img src=\"../resource/images/silkicons/resultset_previous.gif\" width=\"16\" height=\"16\" border=0></a>";	 }
	?></td><td align="center" width="300"><?
		for($p=max(1,$page-3);$p<=$page+3 && $p<=$totalpage;$p++){ 
			if($p==$page){
				echo "&nbsp;&nbsp;&nbsp;<strong>$p</strong>&nbsp;&nbsp;&nbsp;";
			}else{
				echo "&nbsp;&nbsp;<a href=\"../admin/material_manager_c.php".$querystring."page=$p\">$p</a>&nbsp;&nbsp;";		
			}
		} 
	?></td><td width="50" align="right"><? 
		if($page<$totalpage){
			echo "<a href=\"../admin/material_manager_c.php".$querystring."page=".($page+1)."\"><img src=\"../resource/images/silkicons/resultset_next.gif\" width=\"16\" height=\"16\" border=0></a>";	 }
	?></td><td width="50" align="right"><? 
		if($page!=$totalpage){
			echo "<a href=\"../admin/material_manager_c.php".$querystring."page=$totalpage\"><img src=\"../resource/images/silkicons/resultset_last.gif\" width=\"16\" height=\"16\" border=0></a>";	 }
	}
	?></td></tr></table>		</td>
      </tr>
      <tr>
        <td colspan="2" bgcolor="#FFFFFF">





		<table width="100%"  border="0" cellpadding="2" cellspacing="2">
<tr align="center">
			    <td width="100" class="HeaderTable" >Code</td>	    
	      <td class="HeaderTable" >Name</td>
                <td width="60" class="HeaderTable" >THB1</td>
          <td width="60" class="HeaderTable" >EUR1</td>
                <td width="60" class="HeaderTable" >EUR2</td>
                <td width="60" class="HeaderTable" >EUR3</td>
                <td width="60" class="HeaderTable" >EUR4</td>
          </tr>
<? while(!$pdc_data->EOF) { 
		$productid = $pdc_data->Rs("productid");
?>
			  <tr class="tdRowOnOut" valign="top" onmouseover="this.className='tdRowOnOver'" onmouseout="this.className=''">
				<td onclick="OpenDivShowMaterData(<?=($productid != "") ? $productid : 0 ?>);"><div id="DivStatus<?=$pdc_data->Rs("productid ")?>"><?= $pdc_data->Rs("pdc_code"); ?></div></td>
				<td onclick="OpenDivShowMaterData(<?=($productid != "") ? $productid : 0 ?>);">&nbsp;<?= $pdc_data->Rs("pdc_descT1") ?></td>
				<td align="right" onclick="OpenDivShowMaterData(<?=($productid != "") ? $productid : 0 ?>);">&nbsp;<?= $pdc_data->Rs("pdc_price_THB1") ?></td>
				<td align="right" onclick="OpenDivShowMaterData(<?=($productid != "") ? $productid : 0 ?>);">&nbsp;<?= $pdc_data->Rs("pdc_price_EUR1") ?></td>
				<td align="right" onclick="OpenDivShowMaterData(<?=($productid != "") ? $productid : 0 ?>);">&nbsp;<?= $pdc_data->Rs("pdc_price_EUR2") ?></td>
				<td align="right" onclick="OpenDivShowMaterData(<?=($productid != "") ? $productid : 0 ?>);">&nbsp;<?= $pdc_data->Rs("pdc_price_EUR3") ?></td>
				<td align="right" onclick="OpenDivShowMaterData(<?=($productid != "") ? $productid : 0 ?>);">&nbsp;<?= $pdc_data->Rs("pdc_price_EUR4") ?></td>
          </tr>	
<? $pdc_data->MoveNext();	} ?>
            </table>



        </td>
      </tr>
      <tr>
        <td colspan="2" align="center" bgcolor="#FFFFFF">
<table cellspacing="0" cellpadding="0"><tr><td width="50"><?
	if($totalpage>1){
		if($page!=1){
			echo "<a href=\"../admin/material_manager_c.php".$querystring."page=1\"><img src=\"../resource/images/silkicons/resultset_first.gif\" width=\"16\" height=\"16\" border=0></a></a>";	 }
	?></td><td width="50"><?
		if($page>1){
			echo "<a href=\"../admin/material_manager_c.php".$querystring."page=".($page-1)."\"><img src=\"../resource/images/silkicons/resultset_previous.gif\" width=\"16\" height=\"16\" border=0></a>";	 }
	?></td><td align="center" width="300"><?
		for($p=max(1,$page-3);$p<=$page+3 && $p<=$totalpage;$p++){ 
			if($p==$page){
				echo "&nbsp;&nbsp;&nbsp;<strong>$p</strong>&nbsp;&nbsp;&nbsp;";
			}else{
				echo "&nbsp;&nbsp;<a href=\"../admin/material_manager_c.php".$querystring."page=$p\">$p</a>&nbsp;&nbsp;";		
			}
		} 
	?></td><td width="50" align="right"><? 
		if($page<$totalpage){
			echo "<a href=\"../admin/material_manager_c.php".$querystring."page=".($page+1)."\"><img src=\"../resource/images/silkicons/resultset_next.gif\" width=\"16\" height=\"16\" border=0></a>";	 }
	?></td><td width="50" align="right"><? 
		if($page!=$totalpage){
			echo "<a href=\"../admin/material_manager_c.php".$querystring."page=$totalpage\"><img src=\"../resource/images/silkicons/resultset_last.gif\" width=\"16\" height=\"16\" border=0></a>";	 }
	}
	?></td></tr></table>		</td>
      </tr>
      <!--tr>
        <td colspan="2" class="FooterTD" align="right"><button onclick="OpenDivAddMaterData(-1);"><img src="../resource/images/silkicons/user_add.gif" alt="Add User" /> Add New Product</button></td>
      </tr-->
    </table>


<div id="DivShowMaterData" style="position:absolute;left:0px;top:500px;width:618px;height:350px;z-index:1;">
  <? $tbframeheader = "Product Information"?>
  <? $tbframehclose = "CloseDivShowMaterData()";?>
  <? include "../cfrontend/tbframeh.php"?>
  <div id="DivProductInfo" style="overflow:auto;width:600px;height:350px"></div>
  <? include "../cfrontend/tbframef.php"?>
</div>

<script>
function OpenDivEditMaterData(productid)
{ 
	activeBG();
	showHideLayers('DivShowMaterData','','show');
	makeCenterScreen('DivShowMaterData');
	showHTML('DivProductInfo','../admin/material_edit_c.php?act=edit&productid='+productid);
}

function OpenDivShowMaterData(productid)
{
	activeBG();
	showHideLayers('DivShowMaterData','','show');
	makeCenterScreen('DivShowMaterData');
	showHTML('DivProductInfo','../admin/material_info_c.php?productid='+productid);
}
function CloseDivEditMaterData()
{
	hideBG();
	showHideLayers('DivShowMaterData','','hide');
}

function CloseDivShowMaterData()
{
	hideBG();
	showHideLayers('DivShowMaterData','','hide');
}
showHideLayers('DivShowMaterData','','hide');
hideLoading();
</script>

<? include_once("../admin/footer.php"); ?>