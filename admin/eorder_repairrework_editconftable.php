<? include_once("../core/default.php"); 

GetVar($act, 'act');
GetVar($defectcode, 'defectcode');
GetVar($max, 'max');

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
$enum_all = $value_list;
$value_list = array_diff($value_list, array('NONE','OTHER'));
natsort($value_list);

for($i=1;$i<$max+1;$i++){
    $padI = str_pad($i,2,'0',STR_PAD_LEFT);
    if(!in_array('DFF'.$padI,$enum_all)){
        $enum_all[] = 'DFF'.$padI;
    }
    if(!in_array('DFR'.$padI,$enum_all)){
        $enum_all[] = 'DFR'.$padI;
    }
    if(!in_array('DFO'.$padI,$enum_all)){
        $enum_all[] = 'DFO'.$padI;
    }
}

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
<? if(count($value_list) < count($enum_all)-2){ ?>
    กรุณารัน Query เพื่อเปลี่ยนแปลงฐานข้อมูลให้รองรับ
    <textarea style="width:80%;height:400px;border:dashed #C00 2px;">
    ALTER TABLE eorder_repairrework CHANGE eorder_repairrework_defectcode eorder_repairrework_defectcode
    ENUM('<?=implode("','",$enum_all)?>') CHARACTER SET utf8
    COLLATE utf8_general_ci NOT NULL;
    </textarea>
<? } ?>
<form action="eorder_repairrework_editconftable.php" method="get">
    เพิ่มช่องโค้ดเป็น ฝ่ายละ <input type="text" name="max" style="width:60px" value="<?=Math.floor(count($value_list)/3)+100?>"/><input type="submit" />
</form>

<form action="eorder_repairrework_editconftable.php" method="post">
<input type="hidden" name="act" value="save"/>

<? 
$count=0;
$lastsec = '';
foreach($value_list as $code){ 
	if($lastsec!=substr($code,0,3) ){
		$lastsec=substr($code,0,3);

		?> <?=str_repeat('<input style="width:250px;border:none"/>',3-$count%3)?> <br/><br/>
        <? $count = 0;?>
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
