<? if($_SESSION["usertype"]=='AD' || $_SESSION["usertype"]=='MN'){ 

	$data = new Csql();
	$data->Connect();
	$data->Query("select * from workperformance where workperf_sec_id = ".$sectionid."  order by workperf_type,workperf_sec_id,workperf_mat_short,workperf_mat_full,workperf_method");
	if(!$data->EOF) {
		$i = 0;
		$num = $data->Count();
		while(!$data->EOF) {
			$workperfData
			[$data->Rs("workperf_type")]
			[$data->Rs("workperf_sec_id")]
			[$data->Rs("workperf_mat_short")]
			[$data->Rs("workperf_mat_full")]
			[$data->Rs("workperf_method")] = array($data->Rs("workperf_factor"),$data->Rs("workperf_time"));
			$data->MoveNext();
		}
	}	
	
	
	?>    
    </tr>
  <tr>
    <td bgcolor="#FFFFFF">
    <table width="100%" border="0" cellpadding="2" cellspacing="1" class="TableBorder">
      <tr>
        <td class="HeaderW">
		          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td class="HeaderW"><img src="../resource/images/silkicons/package.gif"> Performance Config </td>
              <td class="Normal" align="right"></td>
            </tr>
          </table>
		 </td>
      </tr>
	  <form action="../admin/workperf_process.php" method="post">
	  <input type="hidden" name="redirect" value="<?=urldecode($_SERVER['REQUEST_URI'])?>"/>
      
	  <tr>
	  <td bgcolor="#FFFFFF" align="center" class="Normal">
	  <? include_once("../admin/workperf_manager_table.php"); ?>
	  </td>
	  </tr>
	  <tr>
        <td align="center" bgcolor="#FFFFFF" class="searchTD">
          <input name="METHOD" type="submit" class="BTsearch" id="METHOD" value="Save">
	     </td>
      </tr>
	  </form>
	  </table>
	  
      
      
    
    
<? } ?>  