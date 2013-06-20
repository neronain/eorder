<? include_once("../core/default.php"); ?>
<?

if(!isset($customer_id))$customer_id = $_GET['customerid'];
if(!isset($customer_id))$customer_id = $_POST['customerid'];
	
//$customer_id = 585;

$data = new CSql();
$data->Connect();

$query  = "select ord_status,count(eorderid) as countorder FROM eorder,doctor WHERE ord_cus_id = '$customer_id' 
	and ord_doc_id = doctorid
	group by ord_status 
	order by ord_status ";

$data->Query($query);

while(!$data->EOF){ 
	$label='';
	
	switch($data->Rs("ord_status"))
	{
		case 0:$label="Draft";break;
		case 1:$label="Sending";break;
		case 2:$label="Arrived";break;
		case 3:$label="Processing";break;
		case 4:$label="Delivery";break;
		case 5:$label="Got it";break;
		case 6:$label="Paid";break;
		case 7:$label="Archieve";break;
	}
	
	$orderoverall[$label]=($data->Rs("countorder")+0);
	$data->MoveNext();   
}
?>
<link href="default.css" rel="stylesheet" type="text/css" />




<br>
<table border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>&nbsp;</td>
    <td height="24">&nbsp;</td>
    <td height="24">&nbsp;</td>
    <td height="24">&nbsp;</td>
    <td height="24">&nbsp;</td>
    <td height="24">&nbsp;</td>
    <td>&nbsp;</td>
    <td height="24">&nbsp;</td>
    <td width="24" height="24">&nbsp;</td>
    <td width="24" height="24">&nbsp;</td>
    <td height="24">&nbsp;</td>
    <td height="24">&nbsp;</td>
    <td height="24">&nbsp;</td>
    <td height="24">&nbsp;</td>
    <td height="24">&nbsp;</td>
    <td height="24">&nbsp;</td>
    <td height="24">&nbsp;</td>
    <td height="24">&nbsp;</td>
    <td height="24">&nbsp;</td>
  </tr>
  <tr>
    <td width="24">&nbsp;</td>
    <td width="24" height="24">&nbsp;</td>
    <td width="24" height="24">&nbsp;</td>
    <td colspan="2" rowspan="2" class="ClickAble" onClick="gotoStatus(0)"><img src="images/icons/draft.gif" width="48" height="48"
    onmouseover="dToolTip('LISTORDER_DRAFT')" /></td>
    <td width="24" height="24">&nbsp;</td>
    <td width="24">&nbsp;</td>
    <td width="24" height="24">&nbsp;</td>
    <td colspan="2" rowspan="2" class="ClickAble" onClick="gotoStatus(1)"><img src="images/icons/carr.gif" width="48" height="48"
    onmouseover="dToolTip('LISTORDER_SENDING')"  /></td>
    <td width="24" height="24">&nbsp;</td>
    <td width="24" height="24">&nbsp;</td>
    <td width="24" height="24">&nbsp;</td>
    <td colspan="2" rowspan="2" class="ClickAble" onClick="gotoStatus(2)"><img src="images/icons/hexa.gif" width="48" height="48"
    onmouseover="dToolTip('LISTORDER_ARRIVE')"  /></td>
    <td width="24" height="24">&nbsp;</td>
    <td width="24" height="24">&nbsp;</td>
    <td width="24" height="24">&nbsp;</td>
    <td width="24" height="24">&nbsp;</td>
  </tr>
  <tr>
    <td width="24">&nbsp;</td>
    <td width="24" height="24">&nbsp;</td>
    <td width="24" height="24">&nbsp;</td>
    <td width="24" height="24">&nbsp;</td>
    <td width="24">&nbsp;</td>
    <td width="24" height="24">&nbsp;</td>
    <td width="24" height="24">&nbsp;</td>
    <td width="24" height="24">&nbsp;</td>
    <td width="24" height="24">&nbsp;</td>
    <td width="24" height="24">&nbsp;</td>
    <td width="24" height="24">&nbsp;</td>
    <td width="24" height="24">&nbsp;</td>
    <td width="24" height="24">&nbsp;</td>
  </tr>
  <tr>
    <td width="24">&nbsp;</td>
    <td width="24" height="24">&nbsp;</td>
    <td height="24" colspan="4" align="center" class="ClickAble" onClick="gotoStatus(0)"><strong><?=T_DRAFT;?>[
      <?=$orderoverall["Draft"]+0?>
    ]</strong></td>
    <td height="24" align="center"><img src="../resource/images/silkicons/arrow_right.gif" width="16" height="16" /></td>
    <td height="24" colspan="4" align="center" onClick="gotoStatus(1)"><strong class="ClickAble"><?=T_SEND;?>[
      <?=$orderoverall["Sending"]+0?>
]</strong></td>
    <td height="24"><img src="../resource/images/silkicons/arrow_right.gif" width="16" height="16" /></td>
    <td height="24" colspan="5" align="center" onClick="gotoStatus(2)"><strong class="ClickAble"><?=T_HEXA;?>[
      <?=$orderoverall["Arrived"]+0?>
    ]</strong></td>
    <td width="24" height="24">&nbsp;</td>
    <td width="24" height="24">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td height="24">&nbsp;</td>
    <td height="24">&nbsp;</td>
    <td height="24">&nbsp;</td>
    <td height="24">&nbsp;</td>
    <td height="24">&nbsp;</td>
    <td>&nbsp;</td>
    <td height="24">&nbsp;</td>
    <td height="24">&nbsp;</td>
    <td height="24">&nbsp;</td>
    <td height="24">&nbsp;</td>
    <td height="24">&nbsp;</td>
    <td height="24">&nbsp;</td>
    <td height="24">&nbsp;</td>
    <td height="24"><img src="../resource/images/silkicons/arrow_down.gif" width="16" height="16" /></td>
    <td height="24">&nbsp;</td>
    <td height="24">&nbsp;</td>
    <td height="24">&nbsp;</td>
    <td height="24">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td height="24">&nbsp;</td>
    <td colspan="2" rowspan="2" class="ClickAble" onClick="gotoStatus(5)"><img src="images/icons/doctor_payment.gif" width="48" height="48"
    onmouseover="dToolTip('LISTORDER_WAITPAY')"  /></td>
    <td>&nbsp;</td>
    <td height="24">&nbsp;</td>
    <td>&nbsp;</td>
    <td height="24">&nbsp;</td>
    <td colspan="2" rowspan="2" class="ClickAble" onClick="gotoStatus(4)"><img src="images/icons/carl.gif" width="48" height="48"
    onmouseover="dToolTip('LISTORDER_SENDBACK')"  /></td>
    <td height="24">&nbsp;</td>
    <td height="24">&nbsp;</td>
    <td height="24">&nbsp;</td>
    <td colspan="2" rowspan="2" class="ClickAble" onClick="gotoStatus(3)"><img src="images/icons/process.gif" width="48" height="48"
    onmouseover="dToolTip('LISTORDER_PROCESS')"  />
    </td>
    <td height="24">&nbsp;</td>
    <td height="24">&nbsp;</td>
    <td height="24">&nbsp;</td>
    <td height="24">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td height="24">&nbsp;</td>
    <td>&nbsp;</td>
    <td height="24">&nbsp;</td>
    <td>&nbsp;</td>
    <td height="24">&nbsp;</td>
    <td height="24">&nbsp;</td>
    <td height="24">&nbsp;</td>
    <td height="24">&nbsp;</td>
    <td height="24">&nbsp;</td>
    <td height="24">&nbsp;</td>
    <td height="24">&nbsp;</td>
    <td height="24">&nbsp;</td>
  </tr>
  <tr>
    <td height="24" align="center">&nbsp;</td>
    <td height="24" colspan="4" align="center" onClick="gotoStatus(5)"><strong class="ClickAble"><?=T_ACCOUNT;?>[ <?=$orderoverall["Got it"]+0?> ]</strong></td>
    <td height="24"><img src="../resource/images/silkicons/arrow_left.gif" width="16" height="16" /></td>
    <td colspan="6" align="center" onClick="gotoStatus(4)"><strong class="ClickAble"><?=T_SENDBACK;?>[
      <?=$orderoverall["Delivery"]+0?>
    ]</strong></td>
    <td width="24" height="24"><img src="../resource/images/silkicons/arrow_left.gif" width="16" height="16" /></td>
    <td height="24" colspan="5" align="center" onClick="gotoStatus(3)"><strong class="ClickAble"><?=T_PROCESS;?>[
      <?=$orderoverall["Processing"]+0?>
    ]</strong></td>
    <td width="24" height="24">&nbsp;</td>
  </tr>
  <tr>
    <td width="24">&nbsp;</td>
    <td width="24" height="24">&nbsp;</td>
    <td width="24" height="24">&nbsp;</td>
    <td width="24" height="24">&nbsp;</td>
    <td width="24" height="24">&nbsp;</td>
    <td width="24" height="24">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="24" height="24">&nbsp;</td>
    <td width="24" height="24">&nbsp;</td>
    <td width="24" height="24">&nbsp;</td>
    <td width="24" height="24">&nbsp;</td>
    <td width="24" height="24">&nbsp;</td>
    <td width="24" height="24">&nbsp;</td>
    <td width="24" height="24">&nbsp;</td>
  </tr>
</table>
<br>
