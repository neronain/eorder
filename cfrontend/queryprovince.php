<? 
$SKIPPERMISSION = true;
include_once("../core/default.php"); ?>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
}
-->
</style>
<label>
<select name="Pvince" id="Pvince">
<?	
	if(!isset($prv_id))$prv_id = $_GET['prvid'];
	
	$province_data = new CSql();
	$province_data->Connect();
							
	$sqlp = "SELECT * FROM province WHERE prv_cnt_id=$prv_id ORDER by prv_name ASC";							
	$province_data->Query($sqlp);		
								
	while(!$province_data->EOF){
		
	$pid 		= $province_data->Rs("provinceid");
	$pname	 	= $province_data->Rs("prv_name");
	$pnick 		= $province_data->Rs("prv_cnt_id");	
							
	echo "<option value=\"".$pid."\">".$pname."</option>";	
			
	$province_data->MoveNext();
		}
	?>
</select>
</label>

