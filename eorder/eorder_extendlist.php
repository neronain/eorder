<? include_once("../core/default.php"); ?>
<? //include "../cfrontend/header.php" ?>
<? //$menu='extend order';echo "<br />"?>
<? /**/ // include "../cfrontend/mainmenu.php"?>
<?

	getVar($eorder_code,"exordercode");
	getSession($customer_id,"customerid");
	//echo($eorder_id);
	getVar($backpage,"backpage");
	if($backpage == "dashboard")
		$backpage = "../cfrontend/dashboard_c.php";
	else if($backpage == "order")
		$backpage = "../cfrontend/order.php";
	else
		$backpage = "../cfrontend/order.php";
		
	$order_data = new CSql();
	$order_data->Connect();
	
	$sql = "";
//	if(strlen($eorder_code)==8){
		//echo("case1");
		$sql = "	select eorderid,ord_code,ord_typeofwork,ord_doc_id,ord_patientname,DATE_FORMAT( ord_releasedate, '%d-%m-%Y' )  as rDate,doc_name
					from eorder,doctor 
					where doctorId = ord_doc_id and ord_cus_id = $customer_id
					and 
					ord_code like '%$eorder_code%'  
					
					
					order by ord_code ";
	/*}else{
		//echo("case2");
		$sql = "	select eorderid,ord_code,ord_doc_id,ord_patientname,DATE_FORMAT( ord_releasedate, '%d-%m-%Y' )  as rDate,doc_name
					from eorder,doctor 
					where doctorId = ord_doc_id
					and (ord_code like '%$eorder_code%')";
	}*/
	$order_data->Query($sql);
	$i=0;
	$orderextend = array();
	while(!$order_data->EOF){
	
		$code = $order_data->Rs("ord_code");
		$code = substr($code,0,14);
		
		if($oldcode != $code){
			$i=0;
			$oldcode = $code;
		}
		
		$orderextend[$code][$i]["eorderid"] 		=  $order_data->Rs("eorderid");
		$orderextend[$code][$i]["ord_code"] 		=  $order_data->Rs("ord_code");
		$orderextend[$code][$i]["ord_patientname"] 	=  $order_data->Rs("ord_patientname");
		$orderextend[$code][$i]["doc_name"] 		=  $order_data->Rs("doc_name");
		$orderextend[$code][$i]["rDate"] 			=  $order_data->Rs("rDate");
		$orderextend[$code][$i]["ord_typeofwork"] 	=  $order_data->Rs("ord_typeofwork");
		$orderextend_MAXID[$code]  					=  $order_data->Rs("eorderid");
		/*
		$orderIdArray[$i] = $order_data->Rs("eorderid");
		$orderCodeArray[$i] = $order_data->Rs("ord_code");
		$orderPatientNameArray[$i] = $order_data->Rs("ord_patientname");
		$orderDocNameArray[$i] = $order_data->Rs("doc_name");
		$orderReleaseDateArray[$i] = $order_data->Rs("rDate");
		$orderTypeOfWork[$i] = $order_data->Rs("ord_typeofwork");*/
		$i++;
		$order_data->MoveNext();
	}
	
?>
<? /*<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left" valign="top">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
                    <td width="50"  align="center" valign="top">&nbsp;</td>
                    <td align="left" valign="top">
                    <div style="width:100%"> //*/ ?>
					<? $tbframeheader = "Select order to extend "?>
                            <? include "../cfrontend/tbframeh.php"?>
                            <br />

                             <?
							
							 foreach($orderextend as $code => $data){ ?>
							 
                  <table width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#000000">
                                <tr align="center" bgcolor="#FFFFaa">
                               	 <td bgcolor="#B7E986"><span style="font-weight: bold">Detail</span></td>
                                 <td width="180" bgcolor="#B7E986"><span style="font-weight: bold">Picture</span></td>
                              </tr>
                          </table>
                              <table width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#000000">
								<tr><td colspan="2" bgcolor="#FFFFFF" class="tdRowOnOut" 
                                onMouseOver="this.className='tdRowOnOver'" onMouseOut="this.className='tdRowOnOut'" 
                                onClick="window.location='../eorder/eorder_extend.php?orderid=<?=$orderextend_MAXID[$code] ?>'">
                                <table cellpadding="2" cellspacing="0" width="100%">
							<? for($i=0;$i<count($data);$i++){
							 	$row = $data[$i];
							 ?>

								<? if($i>0){ ?>
                                 <tr>
                                 <td colspan="2"><hr /></td></tr> <? }?>

							 	<tr align="center" >
                               	 <td align="left" valign="top" >
                               	<span style="font-weight: bold">Order Code</span> : <?=$row["ord_code"]?><br /><br />
								<span style="font-weight: bold">Doctor Name</span>	: <?=$row["doc_name"]?><br /><br />
								<span style="font-weight: bold">Patient Name</span> : <?=$row["ord_patientname"]?><br /><br />
							    <span style="font-weight: bold">Release Date</span> : <?=$row["rDate"]?><br /><br />
							    <span style="font-weight: bold">Type of work</span> : <?=$row["ord_typeofwork"]?><br /><br />                                  </td>
                                 <td width="180" height="140" ><img src="../file/eorderrelease/<?=$row["ord_code"]?>.png" width="160" height="120" border="1" style="background:#CCCCCC" /></td>
                                 
                                 
                              </tr>
							 <? } ?> 
                             </table></td></tr>
                             </table>   
                             
							 <? } ?>    
                             
                             
                             
                             <? if(count($orderextend)==0){ ?>
                             Not found any order
                             <? } ?>
                             <br />

                            <!-- div align="left"><a href="<?=$backpage?>">Back</a> </div -->
                            <? include "../cfrontend/tbframef.php"?>
                            
<? /*                            
                    </div>                </td>
            </tr>
    </table></td>
  </tr>
</table>




//*/
?>



<? //include "../cfrontend/footer.php" ?>
<? 
include_once '../core/inc_pngfix.php';
echo replacePngTags(ob_get_clean()); ?>