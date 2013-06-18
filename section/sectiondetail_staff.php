<link href="../resource/css/default.css" rel="stylesheet" type="text/css" />

<table width="100%" border="0" cellpadding="2" cellspacing="1" class="TableBorder">
      <tr>
        <td class="HeaderW">
		          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td class="HeaderW"><img src="../resource/images/silkicons/package.gif"> Lookbook statistic </td>
              <td class="Normal" align="right"></td>
            </tr>
          </table>
		 </td>
      </tr>
	  <form action="../section/sectiondetail_c.php" method="get">
      <tr>
        <td align="center" bgcolor="#FFFFFF" class="searchTD">
		Interval From 		   <? buildDateSelector('logstart',$logstart_day,$logstart_month,$logstart_year)?>
		<? /*
          <input type="checkbox" name="filter[]" value="cus_name" 
		  <?=isset($filter) && array_search('cus_name',$filter)>-1?"checked":""?>>Customer  
          <input type="checkbox" name="filter[]" value="doc_name" 
		  <?=isset($filter) && array_search('doc_name',$filter)>-1?"checked":""?>>Doctor
          <input type="checkbox" name="filter[]" value="ord_patientname" 
		  <?=isset($filter) && array_search('ord_patientname',$filter)>-1?"checked":""?>>Patient's name */
		  ?>
		 
          To           <? buildDateSelector('logend',$logend_day,$logend_month,$logend_year)?>
          <input name="METHOD" type="submit" class="BTsearch" id="METHOD" value="GO!">
		   <input type="hidden" name="sectionid" value="<?=$sectionid?>">
		   <input type="hidden" name="tab" value="orderstaff">
		     </td>
      </tr>
	  </form>
	  	<? if($method=="GO!"){?>
      <tr>
        <td align="center" bgcolor="#FFFFFF">
		  <br />
		  <table border="0" cellspacing="0" cellpadding="0" class="Normal">
            <tr>
              <td colspan="3" class="HeaderTable">สถิติการทำงาน</td>
            </tr>
            <tr>
              <td width="50">&nbsp;</td>
              <td width="150">รวมทั้งหมด</td>
              <td width="100" align="right"><?=$sumall+0?> ชิ้น</td>
            </tr>
            <tr>
              <td width="50">&nbsp;</td>
              <td width="150">เฉลี่ยต่อคนต่อวัน</td>
              <td width="100" align="right"><?=$orderperday+0?> ชิ้น</td>
            </tr>
            <tr>
              <td width="50">&nbsp;</td>
              <td width="150">สูงสุด</td>
              <td width="100" align="right"><?=$maxperday+0?> ชิ้น</td>
            </tr>
            <tr>
              <td width="50">&nbsp;</td>
              <td width="150">&nbsp;</td>
              <td width="100">&nbsp;</td>
            </tr>

          </table>		
	    <br /></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF" align="left" class="Normal">
		กราฟแสดงจำนวนงานของแต่ละคน
		<br /><br />
		<table border="0" cellspacing="0" cellpadding="1" class="Normal">
<tr><td></td><td></td>
  	 <td>Total</td>
  	  <td>&nbsp;</td>
     </tr>
     
     
	<? 
	$stf_code="";
	$score = 0;
	$data_tmp = new Csql();
	$cache = array();
	while(!$data_perday->EOF){

		$key = $data_perday->Rs("logcount_stf_id");	;
		if($cache['staff'][$key]==NULL){
			$tmpRow = $data_tmp->ExecuteARecord("select * from staff where staffid = {$key} limit 0,1");
			$cache['staff'][$key] = $tmpRow;
		}
		$cache['staff'][$key]["staffid"];
		
		
		
		
		
		$score = 0;
 		?>
         <tr>
         <td width=200>
         <a href="../staff/staffdetail_c.php?staffid=<?= $cache['staff'][$key]["staffid"]; ?>" target="_blank">
                    <?=$cache['staff'][$key]["stf_prefix"];?><?=$cache['staff'][$key]["stf_name"];?></a>
         </td>
         
			 <td align="right" width=50><?=number_format($data_perday->Rs("eachday"),2) ?></td>
					<td align="left">
					<table  border="0" cellspacing="2" cellpadding="2">
					<tr><td  bgcolor="#CC3300"
					<? //=$data_perday->Rs("sumall")+0==$maxperday?"#FF0000":"#CC3300" ?>
					width="<?=$data_perday->Rs("eachday")/2 ?>" height=12></td></tr></table>
			</td>
			<td>
			<a target="_blank" href="../staff/staffdetail_c.php?logstart_day=<?=$logstart_day?>&logstart_month=<?=$logstart_month?>&logstart_year=<?=$logstart_year?>&logend_day=<?=$logend_day?>&logend_month=<?=$logend_month?>&logend_year=<?=$logend_year?>&METHOD=GO!&staffid=<?=$data_perday->Rs("logcount_stf_id")?>&tab=orderlist&page=1&only_na=1">
			<?=$na_record[$data_perday->Rs("logcount_stf_id")]>0?"<strong> + ".$na_record[$data_perday->Rs("logcount_stf_id")]."?</strong>":'&nbsp;'?>
			</a>
			</td>
			
			
			</tr>
			
			<? 
			//$score += $data_perday->Rs("eachday");
			$data_perday->MoveNext(); ?>
            <? }?>
			

	
	 		

</table>

		
		
		</td>
      </tr>	  
      <tr>
        <td class="FooterTD">&nbsp;</td>
      </tr>
	  <? } ?>
    </table>
    
    
    
    
    
<? 
/*
if($_GET["METHOD"]=="GO!" && ($_SESSION["usertype"]=='AD' || $_SESSION["usertype"]=='MN')){

	$data = new Csql();
	$data->Connect();
$sql = "    
SELECT 
date(logcount_date) as workdate,
sum(workperf_time)/count(distinct logcount_stf_id)/60 as workhr


FROM `logcount`,workperformance WHERE `logcount_sec_id` = $sectionid and
logcount_date between DATE('$logstart_year-$logstart_month-$logstart_day') and  DATE('$logend_year-$logend_month-$logend_day') and
workperf_type = logcount_type and
workperf_method = logcount_method and
workperf_mat_short = logcount_mat_short and
workperf_mat_full = logcount_mat_full and
workperf_sec_id = logcount_sec_id
group by date(logcount_date)    ";

$data->Query($sql);

$perday = 7;
$sumerror = 0;
if(!$data->EOF) {
	while(!$data->EOF) {
		$workhr = $data->Rs("workhr");
		$workperfResult[$data->Rs("workdate")] = $workhr;
		$sumerror += $workhr-$perday;
		$data->MoveNext();
	}
}













$sql = "
SELECT logcount_type,logcount_sec_id,logcount_method,logcount_mat_short,logcount_mat_full,count(*) as workrecord
FROM `logcount` WHERE `logcount_sec_id` = $sectionid and
logcount_date between DATE('$logstart_year-$logstart_month-$logstart_day') and  DATE('$logend_year-$logend_month-$logend_day') 
group by logcount_type,logcount_method,logcount_mat_short,logcount_mat_full    ";


$data->Query($sql);

if(!$data->EOF) {
	while(!$data->EOF) {
		$workperfRecord
			[$data->Rs("logcount_type")]
			[$data->Rs("logcount_sec_id")]
			[$data->Rs("logcount_mat_short")]
			[$data->Rs("logcount_mat_full")]
			[$data->Rs("logcount_method")] = $data->Rs("workrecord");
			$data->MoveNext(); 
	}
}


if($workperfResult!=NULL){
	
    ?>
    <table width="100%" border="0" cellpadding="2" cellspacing="1" class="TableBorder">
      <tr>
        <td class="HeaderW">
		          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td class="HeaderW"><img src="../resource/images/silkicons/package.gif"> Lookbook statistic </td>
              <td class="Normal" align="right"></td>
            </tr>
          </table>
		 </td>
      </tr>
      <tr>
       <td align="center" bgcolor="#FFFFFF">
		  <br />
		  <table border="0" cellspacing="0" cellpadding="0" class="Normal">
            <tr>
              <td width="200">วันเดือนปี</td>
              <td width="100">เวลารวม</td>
              <td width="100" align="right">ค่าผิดพลาด</td>
            </tr>
            <? foreach($workperfResult as $date => $workhr){
            	?>
            <tr>
              <td width=""><?=$date?></td>
              <td width=""><?=number_format($workhr,2)?></td>
              <td width="" align="right"><?=number_format($workhr-$perday,3)?></td>
            </tr>
            <?
            
            
            $sql = "
            SELECT
            logcount_stf_id,
            sum(workperf_time)/count(distinct logcount_stf_id)/60 as workhr
            
            
            FROM `logcount`,workperformance WHERE `logcount_sec_id` = $sectionid and
            date(logcount_date)='$date' and
            workperf_type = logcount_type and
            workperf_method = logcount_method and
            workperf_mat_short = logcount_mat_short and
            workperf_mat_full = logcount_mat_full and
            workperf_sec_id = logcount_sec_id
            group by logcount_stf_id    ";
            
            $data->Query($sql);
            
            if(!$data->EOF) {
            	while(!$data->EOF) {
            		$workhr = $data->Rs("workhr");
            		$workperfResult[$data->Rs("logcount_stf_id")] = $workhr;
            		
            		
            		?>
            		<tr>
              <td width="">- STF - <?=$data->Rs("logcount_stf_id")?></td>
              <td width=""><?=number_format($workhr,2)?></td>
              <td width="" align="right"><?=number_format($workhr-$perday,3)?></td>
            </tr>
            		
            		<?
            		$sumerror += $workhr-$perday;
            		$data->MoveNext();
            	}
            }
            
            
            
            
            ?>
            
            <? } ?>
            <tr>
              <td width="">&nbsp;</td>
              <td width="">ค่าผิดพลาดรวม</td>
              <td width="" align="right"><?=number_format($sumerror,3)?></td>
            </tr>

          </table>		
	    <br />
	    </td>
      </tr>
      
      <tr>
        <td class="FooterTD">&nbsp;</td>
      </tr>
    </table>
    
    <? }} ?>*/