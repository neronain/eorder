<? include_once("../core/default.php"); ?>
<? include_once("../admin/header.php"); ?>
    <p>
ไฟล์ config ของ <br/>
    Fix => <?=realpath (__DIR__."/../eorder/eorder_fix_config.php")?><br/>
    Remove => <?=realpath (__DIR__."/../eorder/eorder_remove_config.php")?><br/>
    Ortho => <?=realpath (__DIR__."/../eorder/eorder_ortho_config.php")?><br/>
    </p>
<p>
แก้ไขแล้วให้ รัน query แก้ไขฐานข้อมูลด้านล่างนี้อีกที<br/>
<? include_once('../eorder/eorder_fix_config.php'); ?>
<? include_once('../eorder/eorder_remove_config.php'); ?>
<? include_once('../eorder/eorder_ortho_config.php'); ?>
</p>


<?
global $fixmaterial_name;
global $fixmaterial_shortname;
global $fixmaterial_option_sname;


global $ortho_work_conf;
$data = new Csql();
$data->Connect();

function extractField($table,$column){
    global $data;
    $retData = NULL;
    $data->Query("SHOW FIELDS FROM $table WHERE Field =  '$column'");
    if(!$data->EOF){
        $enumval = $data->Rs('Type');
        if($enumval==NULL)exit("$column not exists in $table");
        $enumval = str_replace("'",'',$enumval);
        preg_match('/\((.+)\)/i',$enumval,$match);
        $value_list = explode(',',$match[1]);
        $retData = $value_list;
    }
    return $retData;
}





$logcount_mat_short = extractField('logcount','logcount_mat_short');
$logcount_mat_full = extractField('logcount','logcount_mat_full');

$workperf_mat_short = extractField('workperformance','workperf_mat_short');
$workperf_mat_full = extractField('workperformance','workperf_mat_full');

$ordo_work = extractField('eorder_ortho','ordo_work');
$ordo_workupper = extractField('eorder_ortho','ordo_workupper');
$ordo_worklower = extractField('eorder_ortho','ordo_worklower');


$fieldAlter = array();
$fieldCheckerShort = array(
    'logcount_mat_short' => $logcount_mat_short,
    'logcount_mat_full' => $logcount_mat_full,
    'workperf_mat_short' => $workperf_mat_short,
    'workperf_mat_full' => $workperf_mat_full,
);
$fieldCheckerFull = array(
    'logcount_mat_full' => $logcount_mat_full,
    'workperf_mat_full' => $workperf_mat_full,
);


for($i=0;$i<count($fixmaterial_shortname);$i++){
    $fullname = $fixmaterial_shortname[$i];
    $option_sname = $fixmaterial_option_sname[$i];
    if($fullname=='')continue;

    foreach($fieldCheckerShort as $field_key => $field_ar){
        //echo "Check $fullname in $field_key";
        if(!in_array($fullname,$field_ar)){
            echo "Missing $fullname  in $field_key<br/>";
            $fieldCheckerShort[$field_key][] = $fullname;
            $fieldAlter[$field_key] = true;
        }
    }

    for($j=0;$j<count($option_sname);$j++){
        if($option_sname[$j]=='')continue;
        $checkname = $fullname.$option_sname[$j];

        foreach($fieldCheckerFull as $field_key => $field_ar){
            if(!in_array($checkname,$field_ar)){
                echo "Missing $checkname  in $field_key<br/>";
                $fieldCheckerFull[$field_key][] = $checkname;
                $fieldAlter[$field_key] = true;
            }
        }
    }
}

global $remove_config_main;
global $remove_config_option;

foreach($remove_config_main as $key => $fullname){

    $option_sname = $remove_config_option[$key];

    if($fullname=='')continue;

    foreach($fieldCheckerShort as $field_key => $field_ar){
        //echo "Check $fullname in $field_key";
        if(!in_array($fullname,$field_ar)){
            echo "Missing $fullname  in $field_key<br/>";
            $fieldCheckerShort[$field_key][] = $fullname;
            $fieldAlter[$field_key] = true;
        }
    }

    if($option_sname)foreach($option_sname as $key2 => $value2){
        if($value2=='')continue;
        $checkname = $fullname.$value2;

        foreach($fieldCheckerFull as $field_key => $field_ar){
            if(!in_array($checkname,$field_ar)){
                echo "Missing $checkname  in $field_key<br/>";
                $fieldCheckerFull[$field_key][] = $checkname;
                $fieldAlter[$field_key] = true;
            }
        }


    }
}




foreach($ortho_work_conf as $fullname => $tmp){
    if($fullname=='' || $fullname=='-')continue;

    foreach($fieldCheckerShort as $field_key => $field_ar){
        //echo "Check $fullname in $field_key";
        if(!in_array($fullname,$field_ar)){
            echo "Missing $fullname  in $field_key<br/>";
            $fieldCheckerShort[$field_key][] = $fullname;
            $fieldAlter[$field_key] = true;
        }
    }

    if(!in_array($fullname,$ordo_work)){
        echo "Missing $fullname  in ordo_work<br/>";
        $ordo_work[] = $fullname;
        $fieldAlter['ordo_work'] = true;
    }
}


foreach($ortho_workupper_conf as $fullname => $tmp){
    if($fullname=='' || $fullname=='-')continue;

    foreach($fieldCheckerShort as $field_key => $field_ar){
        //echo "Check $fullname in $field_key";
        if(!in_array($fullname,$field_ar)){
            echo "Missing $fullname  in $field_key<br/>";
            $fieldCheckerShort[$field_key][] = $fullname;
            $fieldAlter[$field_key] = true;
        }
    }

    if(!in_array($fullname,$ordo_workupper)){
        echo "Missing $fullname  in ordo_workupper<br/>";
        $ordo_workupper[] = $fullname;
        $fieldAlter['ordo_workupper'] = true;
    }
}



foreach($ortho_worklower_conf as $fullname => $tmp){
    if($fullname=='' || $fullname=='-')continue;

    foreach($fieldCheckerShort as $field_key => $field_ar){
        //echo "Check $fullname in $field_key";
        if(!in_array($fullname,$field_ar)){
            echo "Missing $fullname  in $field_key<br/>";
            $fieldCheckerShort[$field_key][] = $fullname;
            $fieldAlter[$field_key] = true;
        }
    }

    if(!in_array($fullname,$ordo_worklower)){
        echo "Missing $fullname  in ordo_worklower<br/>";
        $ordo_worklower[] = $fullname;
        $fieldAlter['ordo_worklower'] = true;
    }
}
?>


    <textarea style="width:80%;height:400px;border:dashed #C00 2px;">
<?
foreach($fieldAlter as $column => $tmp){
    switch($column){
        case 'ordo_work':
            $table = "eorder_ortho";
            $enum =  $ordo_work;
            break;
        case 'ordo_workupper':
            $table = "eorder_ortho";
            $enum =  $ordo_workupper;
            break;
        case 'ordo_worklower':
            $table = "eorder_ortho";
            $enum =  $ordo_worklower;
            break;
        case 'logcount_mat_short':
        case 'logcount_mat_full':
            $table = "logcount";
            $enum =  array_merge($fieldCheckerShort[$column],$fieldCheckerFull[$column]);
            break;
        case 'workperf_mat_short':
        case 'workperf_mat_full':
            $table = "workperformance";
            $enum =  array_merge($fieldCheckerShort[$column],$fieldCheckerFull[$column]);
            break;
        default:exit('Error '.$column.' not implement');
    }
    ?>
        ALTER TABLE <?=$table?> CHANGE <?=$column?> <?=$column?>
        ENUM('<?=implode("', '",$enum)?>') CHARACTER SET utf8
        COLLATE utf8_general_ci NOT NULL;

    <?
    }
?></textarea>


<? include_once("../admin/footer.php"); ?>