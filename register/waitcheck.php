<? include_once("../core/funccom.php");?>
<?
	if(isset($_POST["ag"])){
		if($_POST["ag"]=="agree"){
			include("../register/regis1_c.php");
			exit();
		}else{
			gotourl("../");
			exit();
		}
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Hexa ceram e-order</title>
<link href="../resource/css/default.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0"><form method="post">
  <tr>
    <td height="600" align="center">
    
<table border="0" cellpadding="0" cellspacing="1" bgcolor="#000000">
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
            <td align="left" bgcolor="#50962F"><font color="#FFFFFF"><strong><?=T_STEP;?> 2 <?=T_UREGISTER;?></strong></font></td>
          </tr>
          <tr bgcolor="#BEFAC7">
            <td align="left" bgcolor="#50962F"><font color="#FFFFFF"><strong><?=T_STEP;?> 3 <?=T_INFOMATION;?></strong></font></td>
          </tr>
          <tr bgcolor="#BEFAC7">
            <td align="left" bgcolor="#93A9B4"><font color="#FFFFFF"><strong><?=T_STEP;?> 4 <?=T_FINISH;?></strong></font></td>
          </tr>
        </table></td>
        <td width="30" height="320" bgcolor="#FFFFFF">&nbsp;</td>
        <td height="400" align="left" valign="top" bgcolor="#FFFFFF"><p><br />
            <font size="+3"><strong><?=T_FINISH;?></strong></font><br />
            <br />          
          <?=T_MSG003;?>
          <p align="center">            <a href="../index.php">[<?=T_DONE;?>]</a></p></td>
      </tr>
    </table></td>
  </tr>
</table>
</td>
  </tr></form>
</table>

</body>
</html>
