<?	include_once("../core/csql.php"); ?>
<?  	include_once("../core/config.php");?>
<?  	include_once("../core/funchtml.php");?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Hexa ceram e-order</title>
<link href="../resource/css/default.css" rel="stylesheet" type="text/css" />
<script src="../resource/javascript/jquery-1.9.1.min.js"></script>
</head>

<body>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<form action="regis2_c.php" method="post">
    <tr>
      <td height="600" align="center"><table border="0" cellpadding="0" cellspacing="1" bgcolor="#000000">
        <tr>
          <td><table width="640" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="70" colspan="3" align="left" background="../resource/images/default/header.gif" bgcolor="#FFFFFF">&nbsp;</td>
            </tr>
            <tr>
              <td width="170" valign="top" bgcolor="#FFFFFF"><table width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#000066">
                <tr bgcolor="#BEFAC7">
                  <td align="left" bgcolor="#50962F"><font color="#FFFFFF"><strong><?=T_STEP;?> 1 <?=T_AGREEMENT;?></strong></font></td>
                </tr>
                <tr>
                  <td align="left" bgcolor="#50962F"><font color="#FFFFFF"><strong><?=T_STEP;?> 2 <?=T_UREGISTER;?></strong></font></td>
                </tr>
                <tr bgcolor="#BEFAC7">
                  <td align="left" bgcolor="#93A9B4"><font color="#FFFFFF"><strong><?=T_STEP;?> 3 <?=T_INFOMATION;?></strong></font></td>
                </tr>
                <tr bgcolor="#BEFAC7">
                  <td align="left" bgcolor="#50962F"><font color="#FFFFFF"><strong><?=T_STEP;?> 4 <?=T_FINISH;?></strong></font></td>
                </tr>
              </table></td>
              <td width="30" bgcolor="#FFFFFF">&nbsp;</td>
              <td align="left" valign="top" bgcolor="#FFFFFF"><br />
                      <strong><font size="+3"><?=T_INFOMATION;?></font></strong><br />
                      <table width="100%" border="0" cellpadding="2" cellspacing="1" class="Normal">
                        <input type="hidden" name="usrusername" value="<?=$usrusername?>" />
                        <input type="hidden" name="password" value="<?=$password?>" />
                        <input type="hidden" name="country" value="<?=$country?>" />
                        <tr>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td><?=T_HCName;?></td>
                          <td><input type="text" name="cusname" />
                              <font color="#FF0000">*</font></td>
                        </tr>

                        <tr>
                          <td valign="top"><?=T_DOCTOR;?></td>
                          <td><input name="docname" type="text" id="docname" />
                              <font color="#FF0000">*</font><br /></td>
                        </tr>

                        <tr>
                          <td valign="top"><?=T_ADDRESS;?></td>
                          <td><input name="address1" type="text" id="address1" size="40" />
                              <font color="#FF0000">*</font> </td>
                        </tr>
                        <tr>
                          <td><?=T_ROAD;?></td>
                          <td><input name="address2" type="text" id="address2" size="10" /></td>
                        </tr>
                        <tr>
                          <td><?=T_SOI;?></td>
                          <td><input name="address3" type="text" id="address3" size="10" /></td>
                        </tr>
                        <tr>
                          <td><?=T_MOO;?></td>
                          <td><input name="address4" type="text" id="address4" size="5" /></td>
                        </tr>
                        <tr>
                          <td><?=T_SUBDISTRICT;?></td>
                          <td><input name="address5" type="text" id="address5" size="12" /></td>
                        </tr>
                        <tr>
                          <td><?=T_DISTRICT;?></td>
                          <td><input name="address6" type="text" id="address6" size="12" />
                              <font color="#FF0000">*</font></td>
                        </tr>
                        <tr>
                          <td><?=T_PROVINCE;?></td>
                          <td><?  buildComboBoxList('provinceid',"province,country where prv_cnt_id = countryid and cnt_name='Thai' order by provinceid",'provinceid',array('prv_name'),$province,"") ?>
                              <font color="#FF0000">*</font></td>
                        </tr>
                        <tr>
                          <td><?=T_TEL;?></td>
                          <td><input name="tel" type="text" id="tel" size="30" />
                              <font color="#FF0000">*</font></td>
                        </tr>
                        <tr>
                          <td valign="top"><?=T_EMAIL;?></td>
                          <td><input name="email" type="text" id="email" size="30" />
                              <font color="#FF0000">*</font></td>
                        </tr>
                        <tr>
                          <td valign="top"><?=T_REMARK;?></td>
                          <td><textarea name="remark" rows="2" id="remark"></textarea></td>
                        </tr>
                        <tr>
                          <td valign="top">&nbsp;</td>
                          <td align="right"><input type="submit" name="button2" id="button2" value="<?=T_NEXT;?>" /></td>
                        </tr>
                      </table></td>
            </tr>
          </table></td>
        </tr>
      </table></td>
    </tr>
  </form>
</table>
</body>
</html>
