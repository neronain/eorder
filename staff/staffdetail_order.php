<?  include_once("../cfrontend/ordersummary.php"); ?>
<? /* */ include_once "../resource/divbackground.php" ?>
<link href="../resource/css/default.css" rel="stylesheet" type="text/css" />

<table width="100%" border="0" cellpadding="2" cellspacing="1" class="TableBorder" >
      <tr>
        <td class="HeaderW">
		          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td class="HeaderW"><img src="../resource/images/silkicons/package.gif"> Lookbook list</td>
              <td class="Normal" align="right">

			  </td>
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
		   <input type="hidden" name="tab" value="orderlist">
		     </td>
      </tr>
	  </form>

	  
	  <? if($orderperday!=-1){?>

      <tr>
        <td align="center" bgcolor="#FFFFFF">
					<?



		
			$querystring  = "?";
			foreach($_GET as $variable => $value){
				if($variable=="page")continue;
				if($variable=="Stupid_IE_Bug")continue;
				
				if(is_array($value)){
					foreach($value as $v){
						$querystring  .= $variable."[]=$v&";
					}
				}else{
					$querystring  .= "$variable=$value&";
				}
			}
			?>
					<table cellspacing="0" cellpadding="0"><tr><td width="50"><?
					if($totalpage>1){
			 if($page!=1){
			echo "<a href=\"../staff/staffdetail_c.php".$querystring."page=1\"><img src=\"../resource/images/silkicons/resultset_first.gif\" width=\"16\" height=\"16\" border=0></a></a>";	 }
			?></td><td width="50"><?
			if($page>1){
			echo "<a href=\"../staff/staffdetail_c.php".$querystring."page=".($page-1)."\"><img src=\"../resource/images/silkicons/resultset_previous.gif\" width=\"16\" height=\"16\" border=0></a>";	 }
			?></td><td align="center" width="300"><?
			for($p=max(1,$page-3);$p<=$page+3 && $p<=$totalpage;$p++){ 
					if($p==$page){
						echo "&nbsp;&nbsp;&nbsp;<strong>$p</strong>&nbsp;&nbsp;&nbsp;";
					}else{
						echo "&nbsp;&nbsp;<a href=\"../staff/staffdetail_c.php".$querystring."page=$p\">$p</a>&nbsp;&nbsp;";		
					}
			} ?>
			</td><td width="50" align="right">
			<? if($page<$totalpage){
			echo "<a href=\"../staff/staffdetail_c.php".$querystring."page=".($page+1)."\"><img src=\"../resource/images/silkicons/resultset_next.gif\" width=\"16\" height=\"16\" border=0></a>";	 }?>
			</td><td width="50" align="right">
			<? if($page!=$totalpage){
			echo "<a href=\"../staff/staffdetail_c.php".$querystring."page=$totalpage\"><img src=\"../resource/images/silkicons/resultset_last.gif\" width=\"16\" height=\"16\" border=0></a>";	 }}?>
			</td></tr></table>
		
		</td>
      </tr>	  
      <tr>
        <td bgcolor="#FFFFFF">
		<table width="100%"  border="0" cellpadding="2" cellspacing="2">
			<tr>
			    <td class="HeaderTable" width="150">Order code</td>
			    <td class="HeaderTable" width="100">Date</td>

			    <td class="HeaderTable">Type of work</td>
			    <td class="HeaderTable">Unit</td>
			    <td class="HeaderTable">Count</td>
		      </tr>
		      
			
			<? while(!$data_order->EOF){ 
				/*$eorderid = $data_order->Rs("eorderid");
				$staffid = $staffid;
				$sqlcount = "select count(*) as unit,sum(workperf_factor) as countunit from logcount,workperformance where
					 logcount_ord_id = $eorderid	 and
					 logcount_stf_id = $staffid		 and

					
					 workperf_type = logcount_type and
					 workperf_method = logcount_method and
					 workperf_mat_short = logcount_mat_short and
					 workperf_mat_full = logcount_mat_full and
					 workperf_sec_id = logcount_sec_id
					 
					 group by DATE(logcount_date)
				 ";
				$data_logcount->Query("$sqlcount");*/
				//$unit = 'n/a';
				//if(!$data_logcount->EOF){
					$unit = $data_order->Rs('unit');
					$countunit = $data_order->Rs('countunit');
				//}
				
				?>

			  <tr class="Normal" valign="top" >
				<td  class="tdRowOnOut" onMouseOver="this.className='tdRowOnOver'" onMouseOut="this.className='tdRowOnOut'" onClick="OpenDivShowSummary(<?= $data_order->Rs("eorderid")?>)">
				<span style="color: #0000FF"><?= $data_order->Rs("ord_code"); ?></span></td>
				<td><?= date("d/m H:i",strtotime($data_order->Rs("logcount_date"))) ?></td>

				<td><?= $data_order->Rs("ord_typeofwork"); ?>	</td>
				<td align="center"><?=$unit?></td>
				<td align="center"><?=$countunit>0?number_format($countunit,2):"<strong>n/a</strong>"?></td>
			  </tr>
			
			<? $data_order->MoveNext();	} ?>
        </table></td>
      </tr>
      <tr>
        <td class="FooterTD" align="right">
		<span class="Normal">
		[Average/day <?=$orderperday ?>] Found <?=$totalrow?> in <?=$totalpage?> pages </span>
		</td>
      </tr>
	  <? }?>
    </table>
    <script>hideLoading()</script>