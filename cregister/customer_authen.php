<?

$SKIPPERMISSION = true;
include_once("../core/default.php");

$customerid = $cid;
if(!isset($customerid))$customerid = isset($_GET["cid"]) ? $_GET["cid"] : 0;
if(!isset($act ))$act = isset($_GET["act"]) ? $_GET["act"] : "";
$query = isset($_GET["qq"]) ? $_GET["qq"] : "";
$query = trim($query);

$data = new Csql();
$data->Connect();
$data->Query("select cus_usr_id,cus_name from customer where customerid=$customerid limit 1");
$have_acc = false;
if(!$data->EOF) {
	$have_acc = ($data->Rs("cus_usr_id") != 0) ;
	$cus_name =  $data->Rs("cus_name");
}

if($have_acc) {
?>

	<p align="center"><font color="#FF0000">
    <strong><?=T_EXISTACCOUNT;?></strong>
    <br /> <?= T_CONTACT;?>
    <br />  <?=T_EMAILADDR;?>: pppstudio@gmail.com
    <br /> 
    <?=T_TELNO;?>
    : (+66) 08-6728-3309 (pitipong) </font>
    <br />
    <a href='../cregister/customer_register.php'><?=T_BTMAINPAGE;?></a></p>
<?
} else {
	$data->Query("select * from doctor where doc_cus_id=$customerid");
	$i = 0;
	//echo "data count=".$data->Count()."<br>";
	//echo "act=".$act."<br>";
	if($data->Count() <= 0) {
?>
<script>
	showHTML('DivShowCustomer',' ');
</script>
	<p align="center"><font color="#FF0000">
    <strong><?=T_NODOCTOR;?></strong>
    <br /> <?=T_CONTACT;?>
    <br /> <?=T_EMAILADDR;?>: pppstudio@gmail.com
    <br /> 
    <?=T_TELNO;?>
    : (+66) 08-6728-3309 (pitipong) </font>
    <br />
    <a href='../cregister/customer_register.php'><?=T_BTMAINPAGE;?></a></p>
<?
	} else {
		while(!$data->EOF) {
			$doct_name.= $data->Rs("doc_name")." ";
			$data->MoveNext();
		}
		if($act == "input") {
?>
<div style="width:400px" align="center">
<? include "../cfrontend/tbframe2h.php"?>
<table  border="0" cellspacing="0" cellpadding="3">
  <tr>
    <td><div align="center"><strong>---- <?=$cus_name?> ----</strong></div><br />

	<strong>&nbsp;<?=T_INPUTDRNAME;?></strong></td>
  </tr>
  <tr>
    <td>&nbsp;
        <input name="qq" id="qq" type="text" size="40" maxlength="200" />&nbsp;<input type="submit" value="OK" onClick="showHTML('DivShowCustomer','../cregister/customer_authen.php?act=verify&cid=<?=$customerid?>&qq='+encodeTH(getValue('qq')))" />
        <!-- <? //=$doct_name?>" -->
        <br /></td>
  </tr>
</table>

<? include "../cfrontend/tbframe2f.php"?>
</div>
<?
		} else if($act == "verify") {
			//echo "query=".$query."<br>";
			$unuse_word = array("ทพ.ญ.","นทพ.","ทพ.","ทญ.","นาย","นางสาว","นาง","รอ.","Dr.","Mrs.","Mr.","Miss");
			for($i=0;$i<count($unuse_word);$i++) {
				$query = str_replace($unuse_word[$i],"",$query);
			}		
			$lastname_index =  strpos($query," ");
			if($lastname_index > -1)
				$query = 	substr($query,0,$lastname_index);
			//echo "query=".$query."<br>";
			$data->Query("select doc_name from doctor where doc_cus_id=$customerid");
			$i = 0;
			if(!$data->EOF) {
				$authen = false;
				while(!$data->EOF) {
					$doctor_name= $data->Rs("doc_name");
					//echo "doctor_name=".$doctor_name."<br>";
					for($i=0;$i<count($unuse_word);$i++) {
						$doctor_name = str_replace($unuse_word[$i],"",$doctor_name);
					}
					//echo "doctor_name=".$doctor_name."<br>";
					$doctor_name = trim($doctor_name);
					$lastname_index =  strpos($doctor_name," ");
					//echo "lastname_index=".$lastname_index."<br>";
					if($lastname_index > -1) {
						$doctor_name = substr($doctor_name,0,$lastname_index);
					}
					//echo "doctor_name=".$doctor_name."<br>";
					//echo "compare [$query] to [$doctor_name]<br>";
					if(strcasecmp($query,$doctor_name) == 0) {
						$authen = true;
						break;
					}
					$data->MoveNext();
				}
			} else {
				$authen = false;
			}
			
			//echo "authen = ".$authen."<br>";
			if($authen) {
				include("../cregister/customer_old.php");
				exit();
			} else {
				$type="AUTHENFAIL";
				include("../cregister/display_status.php");

			}
		}
	}
}
?>
