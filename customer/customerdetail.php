<link href="../resource/css/default.css" rel="stylesheet" type="text/css" />

<table width="580" border="0" align="center" cellpadding="2" cellspacing="1" class="TableBorder">
  <tr>
    <td  class="HeaderW"><table width="100%" border="0" cellspacing="0" cellpadding="0"  class="HeaderW">
		<tr>
          <td>Customer detail </td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td height="300" valign="top" bgcolor="#FFFFFF" class="Normal"><table width="100%" border="0" cellpadding="2" cellspacing="0" class="Normal">
        <tr>
          <td width="100">Name</td>
          <td><?=$data_customer->Rs("cus_name");?></td>
        </tr>
        <tr>
          <td>Nickname</td>
          <td><?=$data_customer->Rs("cus_nick");?></td>
        </tr>
        <tr>
          <td>Province</td>
          <td><?=$data_customer->Rs("prv_name");?></td>
        </tr>
        <tr>
          <td>Country</td>
          <td><?=$data_customer->Rs("cnt_name");?></td>
        </tr>
        <tr>
          <td>Telephone No.</td>
          <td><?=$data_customer->Rs("cus_tel");?></td>
        </tr>
        <tr>
          <td>e-mail address</td>
          <td><?=$data_customer->Rs("cus_email");?></td>
        </tr>
        <tr>
          <td colspan="2"><hr /></td>
        </tr>
        <tr>
          <td valign="top">Address</td>
          <td><?=$data_customer->Rs("cus_address");?></td>
        </tr>
        <tr>
          <td valign="top">Ship address</td>
          <td><?=$data_customer->Rs("cus_shipaddress");?></td>
        </tr>
        <tr>
          <td valign="top">Bill address</td>
          <td><?=$data_customer->Rs("cus_billaddress");?></td>
        </tr>
    </table>      </td>
  </tr>
  <tr>
  
    <td class="FooterTD"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td></td>
		<!--form action="../order/orderadd_c.php" method="post" name="addorderform" >
		<input type="hidden" name="STEP" value="0" />
		<input type="hidden" name="STEPNEXT" value="1" />		
		<input type="hidden" name="METHOD" value="NEXT" />
		<input type="hidden" name="customer" value="<?=$data_customer->Rs("customerid");?>" /-->
		
        <td align="right">
		<button class="BTok" onclick="CustomerChangeTab('edit')">
		<img src="../resource/images/silkicons/building_edit.png" border="0"> Edit</button>		</td>
		<!--/form-->
      </tr>
    </table>      </td>
  </tr>
</table>

