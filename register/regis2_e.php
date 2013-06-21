<?	include_once("../core/csql.php"); ?>
<?  	include_once("../core/config.php");?>
<?  	include_once("../core/funchtml.php");?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=WEBSITE_HEADER  ?></title>
<link href="../resource/css/default.css" rel="stylesheet" type="text/css" />
<script src="../resource/javascript/jquery-1.9.1.min.js"></script>
</head>

<body>
<?=T_MSG002;?>
<? if(false){?>
<table border="0" cellpadding="2" cellspacing="1" class="Normal">
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><?=T_HCName;?></td>
    <td><input type="text" name="cusname" /></td>
  </tr>
  <tr>
    <td valign="top"><?=T_ADDRESS;?></td>
    <td><textarea name="cusnick" rows="2"></textarea></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>

  <tr>
    <td><?=T_STATEPROVINCE;?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><?=T_COUNTRY;?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><?=T_TEL;?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><?=T_EMAIL;?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><?=T_REMARK;?></td>
    <td><textarea name="cusname2" rows="2"></textarea></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="right">
    <input type="submit" name="button" id="button" value="<?=T_NEXT;?>" />    </td>
  </tr>
  <? }?>
</table>
</body>
</html>
