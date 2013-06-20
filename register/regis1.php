<?	include_once("../core/csql.php"); ?>
<?  	include_once("../core/config.php");?>
<?  	include_once("../core/funchtml.php");?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Hexa ceram e-order</title>
<link href="../resource/css/default.css" rel="stylesheet" type="text/css" />
</head>

<body>
<script>


</script>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
 <form action="regis1_c.php" method="post">
  <tr>
    <td height="600" align="center"><table border="0" cellpadding="0" cellspacing="1" bgcolor="#000000">
      <tr>
        <td><table width="640" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="70" colspan="3" background="../resource/images/default/header.gif" bgcolor="#FFFFFF">&nbsp;</td>
          </tr>
          <tr>
            <td width="170" height="320" valign="top" bgcolor="#FFFFFF"><table width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#000066">
              <tr bgcolor="#BEFAC7">
                <td align="left" bgcolor="#50962F"><font color="#FFFFFF"><strong><?=T_STEP;?> 1 <?=T_AGREEMENT;?></strong></font></td>
              </tr>
              <tr>
                <td align="left" bgcolor="#93A9B4"><font color="#FFFFFF"><strong><?=T_STEP;?> 2 <?=T_UREGISTER;?></strong></font></td>
              </tr>
              <tr bgcolor="#BEFAC7">
                <td align="left" bgcolor="#50962F"><font color="#FFFFFF"><strong><?=T_STEP;?> 3 <?=T_INFOMATION;?></strong></font></td>
              </tr>
              <tr bgcolor="#BEFAC7">
                <td align="left" bgcolor="#50962F"><font color="#FFFFFF"><strong><?=T_STEP;?> 4 <?=T_FINISH;?></strong></font></td>
              </tr>
            </table></td>
            <td width="30" height="320" bgcolor="#FFFFFF">&nbsp;</td>
            <td height="350" align="left" valign="top" bgcolor="#FFFFFF"><br />
                    <strong><font size="+3"><?=T_UREGISTER;?></font></strong><br />
                  <br />
              <table width="100%" border="0" cellpadding="4" cellspacing="1" class="Normal">
              <? if(strlen($errortext)>0){ ?>
              <tr>
                <td colspan="2"><font color="#FF0000">
                  <?=$errortext?>
                </font></td>
              </tr>
              <? } ?>
             
                <tr>
                  <td><?=T_USERNAME;?></td>
                  <td><input name="usrusername" type="text" value="<?=$usrusername?>" />
                      <font color="#FF0000">*</font></td>
                </tr>
                <tr>
                  <td><?=T_PASSWORD;?></td>
                  <td><input type="password" name="password"/>
                      <font color="#FF0000">*</font></td>
                </tr>
                <tr>
                  <td><?=T_PASSWORD;?> <?=T_AGAIN;?></td>
                  <td><input type="password" name="password2"/>
                      <font color="#FF0000">*</font></td>
                </tr>
                <tr>
                  <td><?=T_COUNTRY;?></td>
                  <td><?  buildComboBoxList('country','country','countryid',array('cnt_name'),$country,"") ?>
                      <font color="#FF0000">*</font></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td align="right">&nbsp;</td>
                </tr>
            </table></td>
          </tr>
          <tr>
            <td height="80" valign="top" bgcolor="#FFFFFF">&nbsp;</td>
            <td height="80" bgcolor="#FFFFFF">&nbsp;</td>
            <td height="50" align="center" valign="middle" bgcolor="#FFFFFF"><input type="submit" name="button" id="button" value="<?=T_NEXT;?>" /></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>    </form>
</table>
</body>
</html>
