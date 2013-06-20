<? include_once("../core/default.php"); ?>

<?
	//var_dump($_GET);
	//$DEBUGSQL = true;
	$user_type = $_COOKIE["usertype"];
	$productid = $_GET["productid"];
	
	$pdc_data = new Csql();
	$pdc_data->Connect();
	
	if(isset($productid) && $productid != 0 && $productid != -1 ) {
		$pdc_data->Query("select * from product where productid = $productid limit 1");
		if(!$pdc_data->EOF) {
			$pdc_code = $pdc_data->Rs("pdc_code");
			$pdc_descT1 = $pdc_data->Rs("pdc_descT1");
			$pdc_descE1 = $pdc_data->Rs("pdc_descE1");
			$pdc_descE2 = $pdc_data->Rs("pdc_descE2");
			$pdc_descE3 = $pdc_data->Rs("pdc_descE3");

			$pdc_price_THB1 = $pdc_data->Rs("pdc_price_THB1");
			$pdc_price_EUR1 = $pdc_data->Rs("pdc_price_EUR1");
			$pdc_price_EUR2 = $pdc_data->Rs("pdc_price_EUR2");
			$pdc_price_EUR3 = $pdc_data->Rs("pdc_price_EUR3");
			$pdc_price_EUR4 = $pdc_data->Rs("pdc_price_EUR4");

		}
	}
	
?>
<br />
<!--form method="get" action="../admin/material_process.php">
<input type="hidden" name="productid" id="productid" value="<?=$productid?>" />
<input type="hidden" name="act" id="productid" value="<?=$_GET["act"]?>" /-->
<table align="center">
    <tr><td valign="top">
<? 
	if(isset($productid) && $productid != 0) {
		include("../admin/material_edit.php"); 	
	}
?>
    </td>
    <td valign="top">
    </td></tr>
    <tr><td colspan="2" align="center">
      <input type="submit" value="Save" 
      onclick="showHTML('DivProductInfo','../admin/material_process?act=edit&productid=<?=$productid?>&THB1='+getValue('pdc_price_THB1')+'&EUR1='+getValue('pdc_price_EUR1')+'&EUR2='+getValue('pdc_price_EUR2')+'&EUR3='+getValue('pdc_price_EUR3')+'&EUR4='+getValue('pdc_price_EUR4')+'')">
      &nbsp;&nbsp;&nbsp;<input type="reset" value="Close" onclick="CloseDivEditMaterData();">
    </td></tr>
</table>
</form>