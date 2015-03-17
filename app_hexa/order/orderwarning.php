<? include_once("../core/default.php"); ?>
<?

	$data_eorder = new Csql();
	$err =	$data_eorder->Connect();
	$query = "
		select eorderwarningid,ordt_code from eordertoday,eorderwarning
		where  
		eordertodayid = eorderwarningid
	";
	
	$data_eorder->Query($query);
	
?>
<html>
<title><?=WEBSITE_HEADER  ?></title>
<link href="../resource/css/default.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<body>
<table>
<? while(!$data_eorder->EOF){ ?>
<tr>
<td>
				<a href="../order/orderdetail_c.php?eorderid=<?= $data_eorder->Rs("eorderwarningid"); ?>" target="_blank">
				<?= $data_eorder->Rs("ordt_code"); ?></a></td>
</tr>

<? $data_eorder->MoveNext();	} ?>
</table>
</body>
</html>