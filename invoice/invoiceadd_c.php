<? include_once("../core/default.php"); ?>
<?
// $define 
	$data = new CSql();
	$data->Connect();

/*
	$step_inputcus=0;
	$step_inputfix=1;
	$step_selectdoctor=2;
	$step_adddoctor=3;
	$step_inputpatian=4;
	*/
// IN
	//$vowels = array("a", "e", "i", "o", "u", "A", "E", "I", "O", "U");
	//$onlyconsonants = str_replace($vowels, "", "Hello World of PHP");

	$method 		= $_POST["METHOD"];
	$step 			= $_POST["STEP"];
	$step_back 	= $_POST["STEPBACK"];
	$step_next 	= $_POST["STEPNEXT"];
	$step_addition= $_POST["STEPADD"];
	$customer 		= $_POST["customer"]; 
	$eorder 		= $_POST["eorder"]; 
	$m5m_no 		= $_POST["m5m_no"]; 
	
	$invoice_no 		= $_POST["invoice_no"]; 
	$service_in 		= $_POST["service_in"]; 
	$service_out 		= $_POST["service_out"]; 
	
	if($method=='BACK'){
		$step-=2;
	}
	
	if($step=='')$step=1;
	
	if($step==2){
		
		
	}else if($step==3){
		if(is_array($eorder)){
			$no = $data->ExecuteScalar("select max(MID(m5m_no,3,LENGTH(m5m_no)-2)+0) from eorder_m5m,eorder 
			where LEFT(m5m_no,6)='$invoice_no' ");
			
		
			$data->Execute("insert into invoice(inv_cus_id,inv_date,inv_no) values($customer,CURDATE(),'{$invoice_no}')");
			$invoiceid = $data->GetMaxID('invoice');
			$m5m = new CSql();
			$m5m->Connect();
			
			foreach($eorder as $eorderid){
				$m5m->Query("select * from eorder_m5m where eorder_m5mid = {$eorderid} limit 1");
				
				if(substr($m5m->Rs('m5m_no'),0,6)==$invoice_no){
					$data->Execute("update eorder_m5m set m5m_inv_id = $invoiceid where eorder_m5mid =  $eorderid");
				}else{
					$no++;
					

					$mih = new Msql();
					$mih->Connect();						
					
					$m5m_date = date('d',DateMysqlToPHP($m5m->Rs("m5m_date")));
					$m5m_month = date('m',DateMysqlToPHP($m5m->Rs("m5m_date"))); 
					$m5m_year = date('Y',DateMysqlToPHP($m5m->Rs("m5m_date")));	
					
					//$mih->Set("MIHvnos","'{IN{$no}}'");
					//$mih->Set("MIHvatNO","'{IN{$no}}'");					
					
					$mih->Execute("
						update MIH set 
						MIHvnos = 'IN{$no}', MIHvatNO = 'IN{$no}'
						
						where MIHday = $m5m_date and 
						MIHmonth = $m5m_month and  
						MIHyear = $m5m_year and 
						MIHtype = 'IS' and 
						MIHvnos = '{$m5m->Rs('m5m_taxno')}' and 
						MIHcus = '{$m5m->Rs('m5m_cum_code')}' ");
					
					$data->Execute("update eorder_m5m set m5m_inv_id = $invoiceid , m5m_no = 'IN{$no}' ,
						m5m_taxno = 'IN{$no}' 
						where eorder_m5mid =  $eorderid");
						
				}
			}
			$sum = $data->ExecuteScalar("select sum(m5d_qty*m5d_price) from eorder_m5m,eorder_m5d where m5m_inv_id =  $invoiceid and eorder_m5mid = eorder_m5did ")+0;
			//$sum += $service_in;
			//$sum += $service_out;

			$data->Execute("update invoice set inv_net = $sum where invoiceid =  $invoiceid");
			
			
			
			
			
			
			
			?>
			<script>open('../invoice/invoicedetail_c.php?invoiceid=<?=$invoiceid?>', 'popUpWin'+new Date().getTime(), 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=1,resizable=yes,copyhistory=yes,width=800,height=600,left=100, top=100,screenX=100,screenY=100');
            location = '../invoice/invoiceadd_c.php';
            
            </script>
            
            
			<? 
			exit();
		}
			$step = 1;
	}
	
	include("../invoice/invoiceadd.php");
	
	//$cusvars = $data_order->PassValue("customer","customerid=$customer",array("cus_nick","cus_name"));
	//echo($cusvars["cus_nick"]);
	//echo($cusvars["cus_name"]);

	
	
	
	/*
	echo($customer);
	echo($cusnick);
	echo($cusname);
	echo($cntnick);
	echo($fixcode);
	// */
	//echo "E$cntnick$cusnick$fixcode$fixcodearg";
?>