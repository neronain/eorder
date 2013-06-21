<? include_once("../core/default.php"); ?>
<? 

	$data_customer = new Csql();
	$data_customer->Connect();
	$data_customer->Query("select * from pre_customer");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=WEBSITE_HEADER  ?></title>
<link href="../resource/css/default.css" rel="stylesheet" type="text/css" />
<script src="../resource/javascript/jquery-1.9.1.min.js"></script>
</head>

<body >
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="3"><? include "header.php"?></td>
  </tr>
  <tr>
    <td valign="top"><? include "menu.php"?></td>
    <td colspan="2">
	

<table width="600" border="0" cellpadding="2" cellspacing="1">
  <tr>
    <td width="40" class="HeaderTable">ID</td>
    <td class="HeaderTable">Info</td>
    <td width="100" class="HeaderTable">&nbsp;</td>
  </tr>



<? while(!$data_customer->EOF){ ?>
  <tr>
    <td align="right" valign="top"><?= $data_customer->Rs("pre_customerid"); ?></td>
    <td>
			Username : <?= $data_customer->Rs("pcus_usr_username"); ?><br />
			Clinic name : <?= $data_customer->Rs("pcus_name"); ?><br />
			Doctor name : <?= $data_customer->Rs("pcus_docname"); ?><br />
            email : <?= $data_customer->Rs("pcus_email"); ?><br />
            remark : <?= $data_customer->Rs("pcus_remark"); ?>
</td>
    <td align="right" valign="top"><a href="rqnewcusinfo.php?pre_customerid=<?= $data_customer->Rs("pre_customerid"); ?>" >
    [verify]</a></td>
  </tr>
	
	
    	
    


<? $data_customer->MoveNext();	} ?>

    </table>
    
    </td>
  </tr>
</table>
</body>
</html>
