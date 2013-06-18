<? include_once("../core/default.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=WEBSITE_HEADER  ?></title>
<link href="../resource/css/default.css" rel="stylesheet" type="text/css" />
</head>


<body>
<table border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="3"><? include "header.php"?></td>
  </tr>
  <tr>
    <td valign="top"><? include "menu.php"?></td>
    <td colspan="2" align="center"><table border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="10" height="10" background="../resource/images/eorder/panel/pn1.gif"></td>
          <td height="10" background="../resource/images/eorder/panel/pn2.gif"></td>
          <td width="10" height="10" background="../resource/images/eorder/panel/pn3.gif"></td>
        </tr>
        <tr>
          <td width="10" background="../resource/images/eorder/panel/pn4.gif"></td>
          <td align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="10" height="25" align="center" class="TBHead"><img src="../resource/images/eorder/panel/hd1.gif" width="10" height="25" /></td>
                <td align="center" background="../resource/images/eorder/panel/hd2.gif" bgcolor="#000066" class="WhiteText">New order</td>
                <td width="11" height="25" align="center" class="TBHead"><img src="../resource/images/eorder/panel/hd3.gif" alt="" width="11" height="25" /></td>
              </tr>
            </table>
              <table width="400" border="0" cellspacing="1" cellpadding="4">
<form action="../eorder/eorder.php" method="post" target="_blank">
                <tr>
                  <td>Doctor</td>
                  <td><?  buildComboBoxList('doctor',
		"doctor where doc_cus_id = ".$_COOKIE['customerid']." 
		order by doc_name",'doctorid',array('doc_name'),$doctor,"") ?> To add doctor <a href="#">[Click]</a></td>
                </tr>
                <tr>
                  <td>Patient</td>
                  <td><input type="text" name="patientname"/></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td align="right"><input type="submit" name="button" id="button" value="New" /></td>
                </tr></form>
            </table>              </td>
          <td width="10" background="../resource/images/eorder/panel/pn6.gif"></td>
        </tr>
        <tr>
          <td width="10" height="11" background="../resource/images/eorder/panel/pn7.gif"></td>
          <td height="11" background="../resource/images/eorder/panel/pn8.gif"></td>
          <td width="10" height="11" background="../resource/images/eorder/panel/pn9.gif"></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
