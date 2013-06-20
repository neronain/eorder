<? include("../core/default.php"); ?>

<?
function validateEmail($email)
{
	return eregi('^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.([a-zA-Z]{2,4})$',$email);
}
	//var_dump($_GET);
	//$DEBUGSQL = true;
	$action = $_GET["act"];
	$productid = $_GET["productid"];
	
	// User Information
	//$pdc_type = $_GET["pdc_type"];

	$pdc_price_THB1 = $_GET["THB1"]+0;
	$pdc_price_EUR1 = $_GET["EUR1"]+0;
	$pdc_price_EUR2 = $_GET["EUR2"]+0;
	$pdc_price_EUR3 = $_GET["EUR3"]+0;
	$pdc_price_EUR4 = $_GET["EUR4"]+0;

	
	$data = new Csql();
	$data->Connect();
	
	switch($action) {
		case "edit":
			if($productid > 0) {
				$data->Query("select * from product where productid = $productid limit 1");
				$data->TableName = "product";
				$data->Set("pdc_price_THB1","'$pdc_price_THB1'");
				$data->Set("pdc_price_EUR1","'$pdc_price_EUR1'");
				$data->Set("pdc_price_EUR2","'$pdc_price_EUR2'");
				$data->Set("pdc_price_EUR3","'$pdc_price_EUR3'");
				$data->Set("pdc_price_EUR4","'$pdc_price_EUR4'");
				$data->Update();
			}
			
			$pdc_code = $data->Rs("pdc_code");
			$pdc_descT1 = $data->Rs("pdc_descT1");
			$pdc_descE1 = $data->Rs("pdc_descE1");
			$pdc_descE2 = $data->Rs("pdc_descE2");
			$pdc_descE3 = $data->Rs("pdc_descE3");

			$pdc_price_THB1 = $data->Rs("pdc_price_THB1");
			$pdc_price_EUR1 = $data->Rs("pdc_price_EUR1");
			$pdc_price_EUR2 = $data->Rs("pdc_price_EUR2");
			$pdc_price_EUR3 = $data->Rs("pdc_price_EUR3");
			$pdc_price_EUR4 = $data->Rs("pdc_price_EUR4");
			
			include("../admin/material_info.php"); 
			//redirect("../admin/material_manager_c.php?productid=$productid",0);
			break;
		case "del":
			if($productid != 0) {
				$data->Execute("delete from product where productid = $productid");
			}
			redirect("../admin/material_manager_c.php?",0);
			echo "";
			break;
		default:
			echo "unknow $act";
			redirect("../admin/material_manager_c.php",0);
			break;
	}
?>