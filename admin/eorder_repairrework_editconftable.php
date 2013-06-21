<? include_once("../core/default.php"); 

GetVar($act, 'act');
GetVar($defectcode, 'defectcode');


if($act=='save'){
	$conf = var_export($defectcode,true);
	$conf = "<?\n\$glo_defectcode_table = ".$conf."\n\n?>";
	file_put_contents("../textdb/eorder_repairrework_conftable.php", $conf);	
}

include_once("../textdb/eorder_repairrework_conftable.php"); 


$data = new Csql();
$data->Connect();
$data->Query("SHOW FIELDS FROM eorder_repairrework WHERE Field =  'eorder_repairrework_defectcode'");
if(!$data->EOF){
	$enumval = $data->Rs('Type');
}

if($enumval==NULL)exit('eorder_repairrework_defectcode not alter in database');
$enumval = str_replace("'",'',$enumval);
preg_match('/\((.+)\)/i',$enumval,$match);
$value_list = explode(',',$match[1]);
$value_list = array_diff($value_list, array('NONE','OTHER'));
?>

<? include_once("../admin/header.php"); ?>


<? /*<form action="eorder_repairrework_editconftable.php">
<input type="hidden" name="act" value="save"/>
<table>
<? foreach($value_list as $code){ ?>
<tr><td><?=$code?></td><td><input type="text" name="defectcode[<?=$code?>]" value="<?=$glo_defectcode_table[$code]?>" style="width:200px;"/></td></tr>
<? } ?>
</table>
<input type="submit">
</form>*/?>


<form action="eorder_repairrework_editconftable.php" method="post">
<input type="hidden" name="act" value="save"/>

<? 
$count=0;
$lastsec = '';
foreach($value_list as $code){ 
	if($lastsec!=substr($code,0,3) ){
		$lastsec=substr($code,0,3)
		?><br/><br/>
	<?}?>
<?=$code?><input type="text" name="defectcode[<?=$code?>]" value="<?=$glo_defectcode_table[$code]?>" style="width:200px;"/> 
<? 
if($count%3==2){
	?><br/><?
}
$count++;

} ?><br/>
<input type="submit">
</form>



<? include_once("../admin/footer.php"); ?>
