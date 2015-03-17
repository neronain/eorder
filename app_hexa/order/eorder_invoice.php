<table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#999999">
<tr>
<td height="20" align="center" bgcolor="#CCCCCC">List</td>
<td width="50" align="center" bgcolor="#CCCCCC">Each</td>
<td width="40" height="20" align="center" bgcolor="#CCCCCC">Unit</td>
<td width="50" height="20" align="center" bgcolor="#CCCCCC">Total</td>
</tr>
<?
foreach($fix_price as $key => $value) {
	if($key > 0 && $key != 0) {
		$total_quantity += $fix_price[$key]["quantity"];
		$total_price += $fix_price[$key]["total"];
?>
<tr>
    <td bgcolor="#FFFFFF"><?=$fix_price[$key]["name"]?></td>
    <td align="right" bgcolor="#FFFFFF"><?=$fix_price[$key]["price"]?></td>
    <td align="right" bgcolor="#FFFFFF"><?=$fix_price[$key]["quantity"]?></td>
    <td align="right" bgcolor="#FFFFFF"><?=$fix_price[$key]["total"]?></td>
</tr>
<?
	}
}

foreach($remove_price as $key => $value) {
	if($key > 0 && $key != 0) {
		$total_quantity += $remove_price[$key]["quantity"];
		$total_price += $remove_price[$key]["total"];
?>
<tr>
    <td bgcolor="#FFFFFF"><?=$remove_price[$key]["name"]?></td>
    <td align="right" bgcolor="#FFFFFF"><?=$remove_price[$key]["price"]?></td>
    <td align="right" bgcolor="#FFFFFF"><?=$remove_price[$key]["quantity"]?></td>
    <td align="right" bgcolor="#FFFFFF"><?=$remove_price[$key]["total"]?></td>
</tr>
<?
	}
}
?>
<tr>
<td align="right" bgcolor="#CCCCCC" colspan="2"><span style="color:#FF0000"><strong>* * This cost may change without notice * *</strong></span> Estimate total</td>
<td align="right" bgcolor="#FFFFFF"><?=$total_quantity?></td>
<td align="right" bgcolor="#FFFFFF"><?=$total_price?></td>
</tr>
</table>