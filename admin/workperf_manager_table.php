<? if($workperfData!=NULL){ ?>
    <table align="center" border="0">
  <tr align="center" >
    <td bgcolor="#AAAAFF"><strong>Type</strong></td>
    <td bgcolor="#AAAAFF"><strong>Section</strong></td>
    <td bgcolor="#AAAAFF"><strong>Material Short</strong></td>
    <td bgcolor="#AAAAFF"><strong>Material Full</strong></td>
    <td bgcolor="#AAAAFF"><strong>Method</strong></td>
    <td bgcolor="#AAAAFF"><strong>Factor</strong></td>
    <td bgcolor="#AAAAFF"><strong>Time(min)</strong></td>
  </tr>
<?

/*-------------- optimize -------------------*/
	$data_tmp = new Csql();
	$data_tmp->Connect();
	
	$cache = array();
	

	
	

	$i = 0;
	
	foreach($workperfData as $type => $data1){
		foreach($data1 as $sec_id => $data2){
			
			$key = $sec_id;
			if($cache['section'][$key]==NULL){
				$tmpRow = $data_tmp->ExecuteARecord("select sec_room from section where sectionid = {$key} limit 0,1");
				$cache['section'][$key] = $tmpRow;
			}
			$sec_name = $cache['section'][$key]["sec_room"];
			
			
			
			foreach($data2 as $mats=> $data3){
				foreach($data3 as $matf=> $data4){
					foreach($data4 as $method=> $data5){
						
					$factor = $data5[0];
					$time = $data5[1];
					$bg = $factor==0?'#FFEEEE':'#EEEEFF';

					
					
					
?>

  <tr align="center">
    <td bgcolor='<?=$bg?>' align='left'><?=$type?></td>
    <td bgcolor='<?=$bg?>' align='left'><?=$sec_name?></td>
    <td bgcolor='<?=$bg?>' align='left'><?=$mats?></td>
    <td bgcolor='<?=$bg?>' align='left'><?=$matf?></td>
    <td bgcolor='<?=$bg?>' align='left'><?=$method?></td>
    <td bgcolor='<?=$bg?>' align='center'><input type="text" style="text-align:right;width:80px" name="data[<?=stringToHex($type)?>][<?=($sec_id)?>][<?=stringToHex($mats)?>][<?=stringToHex($matf)?>][<?=stringToHex($method)?>]" value="<?=$factor?>"/></td>
    <td bgcolor='<?=$bg?>' align='right'><?=$workperfRecord[$type][$sec_id][$mats][$matf][$method]?><input type="text" style="text-align:right;width:80px" name="time[<?=stringToHex($type)?>][<?=($sec_id)?>][<?=stringToHex($mats)?>][<?=stringToHex($matf)?>][<?=stringToHex($method)?>]" value="<?=$time?>"/></td>
    
    </td>
    
  </tr>
<?
					}
				}
			}
		}
	}
?>
</table>

<? } ?>