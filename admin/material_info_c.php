<? include_once("../core/default.php"); ?>

<?
	//var_dump($_GET);
	$productid = $_GET["productid"];
	
	$pdc_data = new Csql();
	$pdc_data->Connect();
	
	if(isset($productid) && $productid != 0) {
		$pdc_data->Query("select * from product where productid = $productid  limit 1");
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

<? include("../admin/material_info.php"); ?>