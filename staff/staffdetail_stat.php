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
	  <form action="../staff/staffdetail_c.php" method="get">
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
		   <input type="hidden" name="staffid" value="<?=$staffid?>">
		   <input type="hidden" name="tab" value="orderstat">
		     </td>
      </tr>
	  </form>
	  	<? if($orderperday!=-1){?>
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
              <td width="150">เฉลี่ยต่อวัน</td>
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
        <td bgcolor="#FFFFFF" align="center" class="Normal">
		<?= $isgroupday?"กราฟแสดงจำนวนงานแต่ละวัน":"กราฟแสดงจำนวนงานแต่ละเดือน"?>
		<table border="0" cellspacing="0" cellpadding="0" class="Normal">

  <tr>
  <? $i=0 ?>
  <? $m=0 ?>
	<? while(!$data_perday->EOF){ ?>
	<? 
		if($i==0) {
			$i=$data_perday->Rs($isgroupday?"log_dated":"log_datem");
			$m=$data_perday->Rs($isgroupday?"log_datem":"log_datey");
		}else if($i!=$data_perday->Rs($isgroupday?"log_dated":"log_datem") && 
			$m==$data_perday->Rs($isgroupday?"log_datem":"log_datey")){
				$i=$data_perday->Rs($isgroupday?"log_dated":"log_datem");
			?>
			<td width=2 valign="bottom" align="center">
			<table class="Small"  border="0" cellspacing="0" cellpadding="0">
			<tr><td  bgcolor="#0066CC" width=1 height="15"></td>	</tr>
			</table>
			</td>
			<?
		}else if($data_perday->Rs($isgroupday?"log_dated":"log_datem")!=1 && 
			$m!=$data_perday->Rs($isgroupday?"log_datem":"log_datey")){
				$i=$data_perday->Rs($isgroupday?"log_dated":"log_datem");
				//$m=$data_perday->Rs($isgroupday?"log_datem":"log_datey");
			?>
			<td width=2 valign="bottom" align="center">
			<table class="Small"  border="0" cellspacing="0" cellpadding="0">
			<tr><td  bgcolor="#0066CC" width=1 height="15"></td>	</tr>
			</table>
			</td>
			<?
		}
		
			$i++;
			if($m!=$data_perday->Rs($isgroupday?"log_datem":"log_datey")){
				$m=$data_perday->Rs($isgroupday?"log_datem":"log_datey");
			}
		?>
			<td width=15 height="200" valign="bottom" align="center">
			<table class="Small"  width=15  border="0" cellspacing="0" cellpadding="0">
			<tr>
			<td  bgcolor="<?=$data_perday->Rs("eachday")+0==$maxperday?"#FF0000":"#CC3300" ?>" width=100% 
			height="<?=$data_perday->Rs("eachday")*($isgroupday?5:0.5) ?>"></td>	</tr>
			<tr><td align="center" height="15"><?=$data_perday->Rs($isgroupday?"log_dated":"log_datem")+0 ?></td></tr>
			</table>
			</td>
		<?
			
		
		$data_perday->MoveNext();	
	} 
	?>
	 
  </tr>

</table>

		
		
		</td>
      </tr>	  
      
      
	<tr>
        <td bgcolor="#FFFFFF" align="center" class="Normal">
		กราฟแสดงจำนวนงานแต่ละผลิตภัณฑ์
		<table width=""  border="0" cellpadding="2" cellspacing="2">
			<tr>
			    <td class="HeaderTable">Type of work</td>
			    
			    <td class="HeaderTable" width="100" align="center">Raw count</td>
			    <td class="HeaderTable" width="100" align="center">Calculated</td>
		      </tr>
		      
			
			<? while(!$data_pertype->EOF){ 
			
				$workperf_method = $data_pertype->Rs('workperf_method');
				$workperf_mat_full = $data_pertype->Rs('workperf_mat_full');
				$eachtype_raw = $data_pertype->Rs('eachtype_raw');
				$eachtype_cal = $data_pertype->Rs('eachtype_cal');

				?>

			  <tr class="Normal" valign="top" >
				
				<td style="padding-left:20px"><?=$workperf_mat_full?> (<?=$workperf_method?>)</td>

				<td align="right"><?=$eachtype_raw?></td>
				<td align="right"><?=$eachtype_cal?></td>
				
			  </tr>
			
			<? $data_pertype->MoveNext();	} ?>
        </table>

		
		
		</td>
      </tr>	        
      
      
      
      <tr>
        <td class="FooterTD">&nbsp;</td>
      </tr>
	  <? } ?>
    </table>
    
<? 

$sectionid = $data_staff->Rs("stf_sec_id");
include_once("../admin/workperf_manager_express.php"); 

?>

