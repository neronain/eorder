<?php include_once("../core/default.php"); ?>
<?php include_once "../eorder/eorder_fix_config.php" ?>
<?php include_once "../eorder/eorder_remove_config.php" ?>

<?
	$data = new Csql();
	$data->Connect();
	$teeth = new Teeth();
	//$eorder_id = $_GET["eorderid"];
	GetVar($eorder_id,"eorderid");
	$data->Query("select * from eorder_fix where eorder_fixid=$eorder_id limit 1");
	if(!$data->EOF) {
		$teeth->BuildFixTeethFromText($data->Rs("ordf_typeofworkt"));
	} 
	$fix_price = calculateMaterialPriceEach($teeth->ExportFixTeethMaterialCostArray(),"fix");
	$data->Query("select * from eorder_remove where eorder_removeid=$eorder_id limit 1");
	if(!$data->EOF) {
		$teeth->BuildRemoveTeethFromText($data->Rs("ordr_typeofworkt"));
	}
	$remove_price = calculateMaterialPriceEach($teeth->ExportRemoveTeethMaterialCostArray(),"remove");
	//var_dump($teeth->ExportFixTeethMaterialCostArray());
	$total_quantity = 0;
	$total_price = 0;
?>

<? include("../eorder/eorder_invoice.php"); ?>