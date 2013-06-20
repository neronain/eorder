<?
	include_once("../core/default.php");
	$customer_id = $_GET["cid"];
	$agent_id = $_GET["did"];
	//$data = new Csql();
	//$data->Connect();
	//$data->Query("select * from customer where customerid=$customer_id limit 1");
	//if(!$data->EOF) {
	//	$clinic_code = $data->Rs("cus_nick");
	//	$clinic_name = $data->Rs("cus_name");
	//}
?>
<table border="0" cellpadding="2" cellspacing="1" bgcolor="#999999">
  <tr>
    <td colspan="2" align="center" bgcolor="#CCCCCC"><strong>Agent Add</strong></td>
  </tr>
  <tr>
    <td width="100" align="center" bgcolor="#FFFFFF"><strong>Agent name</strong></td>
    <td bgcolor="#FFFFFF"><input id="agnname" type="text" /></td>
  </tr>
  <tr>
    <td colspan="2" align="right" bgcolor="#E5E5E5"><input type="button" value="Add" onClick="showHTML('DivComboAgent','../eorder/agent_process.php?act=eorder&cid=<?=$customer_id?>&name='+encodeTH(getValue('agnname'))+'&did=<?=$agent_id?>');" />
      &nbsp;
      <input type="reset" value="Cancel" onclick="showHTML('DivComboAgent','../eorder/agent_process.php?cid=<?=$customer_id?>&act=cancel&did=<?=$agent_id?>');"/></td>
  </tr>
</table>