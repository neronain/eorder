<?
	include_once("../core/default.php");
	$customer_id = $_GET["cid"];
	$doctor_id = $_GET["did"];
	$data = new Csql();
	$data->Connect();
	$data->Query("select * from customer where customerid=$customer_id limit 1");
	if(!$data->EOF) {
		$clinic_code = $data->Rs("cus_nick");
		$clinic_name = $data->Rs("cus_name");
	}
	$docdata = new  Csql();
	$docdata->Connect();
	$docdata->Query("select * from doctor where doctorid=$doctor_id limit 1");
	if(!$docdata->EOF) {
		$doctor_name = $docdata->Rs("doc_name");
	}
?>
<table border="0" cellpadding="2" cellspacing="1" bgcolor="#999999">
  <tr>
    <td colspan="2" align="center" bgcolor="#CCCCCC"><strong>Doctor Edit</strong></td>
  </tr>
  <tr>
    <td width="100" align="center" bgcolor="#FFFFFF"><strong>Doctor name</strong></td>
    <td bgcolor="#FFFFFF"><input id="docname" type="text" value="<?=$doctor_name?>" /></td>
  </tr>
  <tr>
    <td align="center" valign="top" bgcolor="#FFFFFF"><strong>Clinic Code</strong></td>
    <td valign="top" bgcolor="#FFFFFF">&nbsp;<?=$clinic_code?></td>
  </tr>
  <tr>
    <td align="center" valign="top" bgcolor="#FFFFFF"><strong>Clinic name</strong></td>
    <td valign="top" bgcolor="#FFFFFF">&nbsp;<?=$clinic_name?></td>
  </tr>
  <tr>
    <td colspan="2" align="right" bgcolor="#E5E5E5"><input type="button" value="Save" onClick="showHTML('DivComboDoctor','../eorder/doctor_process.php?act=eorder&cid=<?=$customer_id?>&name='+encodeTH(getValue('docname'))+'&did=<?=$doctor_id?>');" />
      &nbsp;
      <input type="reset" value="Cancel" onclick="showHTML('DivComboDoctor','../eorder/doctor_process.php?cid=<?=$customer_id?>&act=cancel&did=<?=$doctor_id?>');"/></td>
  </tr>
</table>