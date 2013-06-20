<? include_once("../core/default.php"); ?>
<?
// IN
	$method 		= $_POST["METHOD"];
	$cusname 		= $_POST["cusname"];
	$cusnick	 		= $_POST["cusnick"];
	$country 		= $_POST["country"];
	$province 		= $_POST["province"];

// Intilize
	$method 	= isset($method)?$method:'NEW';
	$islistprovince =  isset($province); 
// Start code
//	$customerid;


	$data_customer = new CSql();
	$data_customer->Connect();
	
	$msg = "";
	
	if($method=="ADD"){
		$condition = true;
		if(!isset($cusname) || strlen($cusname)==0){
			$condition = false;
			//$islistprovince = false;
			$msg = "กรุณาใส่ชื่อลูกค้า";
		}
		
		if($condition && (!isset($cusnick) || strlen($cusnick)!=4)){
			$condition = false;
			//$islistprovince = false;
			$msg = "กรุณาใส่ชื่อย่อลูกค้า 4 ตัว";
		}
		if($condition && (!isset($province))){
			$condition = false;
			$islistprovince = true;
			$msg = "กรุณาเลือกจังหวัด";
		}
			

		if($condition){
			$data_customer->Query("select * from customer
					where cus_name='$cusname' or cus_nick='$cusnick'");
				if($data_customer->Count()==0){
					$data_customer->Addnew();
					$data_customer->TableName = "customer";
					$data_customer->Set("cus_name","'$cusname'");
					$data_customer->Set("cus_nick","'$cusnick'");
					$data_customer->Set("cus_cnt_id","$country");
					$data_customer->Set("cus_prv_id","$province");
					$data_customer->Update();
					$msg = "เพิ่มลูกค้า $cusname เรียบร้อยแล้ว";

					$cusname ="";
					$cusnick ="";
					$islistprovince = false;

				}else{
					$msg = "ชื่อ หรือ ชื่อย่อ ซ้ำ";
				}
			
		}
		//echo "add";
	}else if($method=="LIST"){
		$islistprovince = true;
	}

	include("../customer/customeradd.php");

?>