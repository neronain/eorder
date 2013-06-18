<?
	include_once("../core/default.php");
	$customer_id = $_GET["cid"];
	$doctor_name = $_GET["name"];
	$action = $_GET["act"];
	$doctor_id = $_GET["did"];
	
	if($doctor_name != "") {
	
		$data = new Csql();
		$data->Connect();
		//$data->Query("select cus_nick from customer where customerid=$customer_id limit 1");
		//if(!$data->EOF) {
		//	$clinic_code = $data->Rs("cus_nick");
		//}

		if($doctor_id < 0){
			$data->AddNew();
			$data->TableName = "doctor";
			//$data->Set("clinicCode","'$clinic_code'");
			$data->Set("doc_name","'$doctor_name'");
			$data->Set("doc_cus_id","'$customer_id'");
			$data->Update();
			$doctor_id = $data->GetMaxID("doctor");			
		}else{
			$data->Query("select * from doctor where doctorid=$doctor_id limit 1");
			$data->TableName = "doctor";
			//$data->Set("clinicCode","'$clinic_code'");
			$data->Set("doc_name","'$doctor_name'");
			$data->Set("doc_cus_id","'$customer_id'");
			$data->Update();

		}

	}
	if($action == "doctor"){
		include("../cfrontend/querydoctorlist_c.php");
	}elseif($action == "eorder"){
		buildComboBoxList('eorder_doctid','doctor where doc_cus_id='.$customer_id.' order by doc_name','doctorId',array('doc_name'),$doctor_id,"") ;
?>
&nbsp;<input  type="button" id="add_doctor" value="Add Doctor" onclick="showHTML('DivComboDoctor','../eorder/doctor_add.php?cid=<?=$customer_id?>&did='+getValue('eorder_doctid'));">
       <input type="button" id="edit_doctor" value="Edit Doctor" 
        onclick="showHTML('DivComboDoctor','../eorder/doctor_edit.php?cid=<?=$customer_id?>&did='+getValue('eorder_doctid'));">

<?	} elseif($action == "cancel") {
		buildComboBoxList('eorder_doctid','doctor where doc_cus_id='.$customer_id.' order by doc_name','doctorId',array('doc_name'),$doctor_id,"") ;
?>
&nbsp;<input  type="button" id="add_doctor" value="Add Doctor" onclick="showHTML('DivComboDoctor','../eorder/doctor_add.php?cid=<?=$customer_id?>&did='+getValue('eorder_doctid'));">
       <input type="button" id="edit_doctor" value="Edit Doctor" 
        onclick="showHTML('DivComboDoctor','../eorder/doctor_edit.php?cid=<?=$customer_id?>&did='+getValue('eorder_doctid'));">

<?
	}
?>