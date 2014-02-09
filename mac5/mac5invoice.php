<?
	include_once("../core/default.php");
	
	GetVar($eorder_id,"eorderid");
	$eorderid = $eorder_id;
	
	$data_order = new CSql();
	$data_order->Connect();	
	

	GetVar($code,"code");
	if($code!=""){
		$data_order->Query("select * from eorder 
		where ( ord_code like '{$code}%' or ord_no like '$code' )  ");
		if($data_order->RecordCount==1){
			$eorder_id = $data_order->Rs('eorderid');
			$eorderid = $eorder_id;
		}
		
	}else if($eorderid>0){
		$data_order->Query("select * from eorder
		where eorderid = $eorderid");
	}
	
	

	
	/*-------------- optimize -------------------*/
	$data_tmp = new Csql();
	$data_tmp->Connect();
	
	$cache = array();
	$data_orderAr = array();
	
	while(!$data_order->EOF){
		$rowAr = $data_order->CurrentRowArray();
	
		$key = $rowAr['ord_cus_id'];
		if($cache['customer'][$key]==NULL){
			$tmpRow = $data_tmp->ExecuteARecord("select cus_name from customer where customerid = {$key} limit 0,1");
			$cache['customer'][$key] = $tmpRow;
		}
		$rowAr['cus_name'] = $cache['customer'][$key]["cus_name"];
	
		$key = $rowAr['ord_doc_id'];
		if($cache['doctor'][$key]==NULL){
			$tmpRow = $data_tmp->ExecuteARecord("select doc_name from doctor where doctorid = {$key} limit 0,1");
			$cache['doctor'][$key] = $tmpRow;
		}
		$rowAr['doc_name'] = $cache['doctor'][$key]["doc_name"];
	
		$key = $rowAr['ord_agn_id'];
		if($cache['agent'][$key]==NULL){
			$tmpRow = $data_tmp->ExecuteARecord("select agn_name from agent where agentid = {$key} limit 0,1");
			$cache['agent'][$key] = $tmpRow;
		}
		$rowAr['agn_name'] = $cache['agent'][$key]["agn_name"];		
	
	
		$data_orderAr[] = $rowAr;
		$data_order->MoveNext();
	
	}
	/*-------------- optimize -------------------*/	
	
	
	
	
	
	/*if(!$eorder->EOF){
		$eorder_id = $eorder->Rs('eorderid');
		$eorderid = $eorder_id;	
		$ord_agn_id = $eorder->Rs("ord_agn_id");
		$ord_cus_id = $eorder->Rs("ord_cus_id");
		$ord_doc_id = $eorder->Rs("ord_doc_id");
	
	
		$agent = new Csql();
		$agent->Connect();
		$agent->Query("select * from agent where agentid=$ord_agn_id limit 1");
		if($agent->EOF) {exit("Invalid agent $ord_agn_id");}
		
		$customer = new Csql();
		$customer->Connect();
		$customer->Query("select * from customer where customerid=$ord_cus_id limit 1");
		if($customer->EOF) {exit("Invalid customer $ord_cus_id");}		
		
		$doctor = new Csql();
		$doctor->Connect();
		$doctor->Query("select * from doctor where doctorid=$ord_doc_id limit 1");
		if($doctor->EOF) {exit("Invalid doctor $ord_agn_id");}
		
	}*/
	
?>
<html>
<title><?=WEBSITE_HEADER  ?></title>
<link href="../resource/css/default.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="../resource/javascript/ajax.js"></script>
<script src="../resource/javascript/default.js"></script>
<script src="../resource/javascript/mac5.js"></script>
<body style="background-color:#FFFFFF">
<form>
          <input type="text" name="code" id="txtcode" style="width:200;" value="">
          <input name="METHOD" type="submit" class="BTsearch" id="METHOD" value="GO!">
          <select name="mac5_db">
          <option value="M5CM-RE-01">Mac5 เชียงใหม่</option>
          </select>
		   <input name="Stupid_IE_Bug" type="text" style="width:0;visibility:hidden" value="" size="1" >	
</form>
<span style="font-size:14px;font-weight:bold">
<? if(count($data_orderAr)>1){ ?>
	<? foreach($data_orderAr as $dt_order){ ?>
    	<a href="mac5invoice.php?eorderid=<?=$dt_order['eorderid']?>&mac5_db=<?=$AppConfodbc_dbname?>">
		<?=$dt_order['ord_code']?> | 
        <?=$dt_order['cus_name']?> | 
        <?=$dt_order['doc_name']?> | 
        <?=$dt_order['ord_patientname']?> | 
        <?=$dt_order['ord_typeofwork']?>
        </a><br>
    <? } ?>
<? } ?>
</span>
<? 
if($eorderid>0){
	 $dt_order = $data_orderAr[0];
?>
<span style="font-size:18px;font-weight:bold">
		<?=$dt_order['ord_code']?> | 
        <?=$dt_order['cus_name']?> | 
        <?=$dt_order['doc_name']?> | 
        <?=$dt_order['ord_patientname']?> <br>
        <?=$dt_order['ord_typeofwork']?>
</span>
<?
	include ('../eorder/eorder_mac5.php');
	 ?>
	<script>
	MAC5_Init();
	</script>
	 <?
}else{?>
<?
}
?>


<script>
<? if($code!='' && $eorderid){ ?>
	setFocus('MAC5_DCode_1');	
<? }else{ ?>
	setFocus('txtcode');
<? } ?>
</script>


<script>
function MAC5_OnSend(){
	location = "../mac5/mac5invoice.php?eorderid=<?=$eorderid?>";
}
function OrderSummaryChangeTab(name){
	location = "../mac5/mac5invoice.php?eorderid=<?=$eorderid?>";
}
</script>
</body>
</html>
