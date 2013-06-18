<?
	include_once("../core/default.php");
	$customer_id = $_GET["cid"];
	$agent_name = $_GET["name"];
	$action = $_GET["act"];
	$agent_id = $_GET["did"];
	
	if($agent_name != "") {
		$data = new Csql();
		$data->Connect();
		//$data->Query("select cus_nick from customer where customerid=$customer_id limit 1");
		//if(!$data->EOF) {
		//	$clinic_code = $data->Rs("cus_nick");
		//}
		$data->AddNew();
		$data->TableName = "agent";
		//$data->Set("clinicCode","'$clinic_code'");
		$data->Set("agn_name","'$agent_name'");
		//$data->Set("agn_cus_id","'$customer_id'");
		$data->Update();
		$agent_id = $data->GetMaxID("agent");
	}
	if($action == "agent"){
		include("../cfrontend/queryagentlist_c.php");
	}elseif($action == "eorder"){
		buildComboBoxList('eorder_agentid','agent  order by agn_name','agentId',array('agn_name'),$agent_id,"") ;
?>
&nbsp;<input type="button" id="add_agent" value="Add Agent" onclick="showHTML('DivComboAgent','../eorder/agent_add.php?cid=<?=$customer_id?>&did='+getValue('eorder_agentid'));">
<?	} elseif($action == "cancel") {
		buildComboBoxList('eorder_agentid','agent  order by agn_name','agentId',array('agn_name'),$agent_id,"") ;
?>
&nbsp;<input type="button" id="add_agent" value="Add Agent" onclick="showHTML('DivComboAgent','../eorder/agent_add.php?cid=<?=$customer_id?>&did='+getValue('eorder_agentid'));">
<?
	}
?>