<? include("../core/default.php"); 

	$act=$_POST["act"];
	
	$datausd = new Csql();
	$datausd->Connect();	
	$datausd->Query("SELECT * FROM conf where con_key='EXUSD'");
	if($act=="save"){
		$datausd->TableName = "conf";
		$datausd->Set("con_value","'{$_POST['USD']}'");
		$datausd->Update();
	}

	$dataeur = new Csql();
	$dataeur->Connect();	
	$dataeur->Query("select * from conf where con_key='EXEUR'");
	if($act=="save"){
		$dataeur->TableName = "conf";
		$dataeur->Set("con_value","'{$_POST['EUR']}'");
		$dataeur->Update();
	}



?>
<? include_once("../admin/header.php"); ?>
<form  method="post" action="../admin/exchange_manager_c.php">
<input type="hidden" name="act" value="save" />
<table width="500" border="0" cellspacing="1" cellpadding="3">
  <tr>
    <td colspan="4" class="HeaderW">อัตราแลกเปลี่ยน</td>
    </tr>
  <tr>
    <td align="center" class="Big">USD</td>
    <td align="right">1 USD = </td>
    <td width="100"><label>
      <input type="text" name="USD" class="numberfiled" style="width:100px" value="<?=$datausd->Rs('con_value')?>" />
      </label></td>
    <td>บาท</td>
  </tr>
  <tr>
    <td align="center" class="Big">EUR</td>
    <td align="right">1 EUR = </td>
    <td width="100"><input type="text" name="EUR" class="numberfiled" style="width:100px"  value="<?=$dataeur->Rs('con_value')?>"  /></td>
    <td>บาท</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="4" align="center">      <input type="submit" value="Save" />    </td>
    </tr>
</table>
</form>
<? include_once("../admin/footer.php"); ?>