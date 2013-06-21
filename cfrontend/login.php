<? ob_start();  ?>
<? include_once("../core/languageselect.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link href="../cfrontend/default.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.loginstyle {
	font-size: 14px;
	font-weight: bold;
}
.style1 {font-size: 18px}
.Urgent {
	color: #FF0000;
	font-weight: bold;
}

-->
</style>
<script src="../resource/javascript/jquery-1.9.1.min.js"></script>
</head>
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="37" background="../cfrontend/images/header.png"><img src="../cfrontend/images/header.gif" width="474" height="35" />`</td>
    <td background="../cfrontend/images/header.png"><a href="../cfrontend/login.php?lang=english"><img src="../resource/images/flag/b.gif" width="16" height="11" border="0" /><font color="#FFFFFF"> English </font></a> <a href="../cfrontend/login.php?lang=thai"><img src="../resource/images/flag/t.gif" width="16" height="11" border="0"/><font color="#FFFFFF"> ภาษาไทย</font></a></td>
  </tr>
  <tr>
    <td height="600" colspan="2" align="center" background="../cfrontend/images/body.png" style="background-repeat:repeat-x">      <br />
      <br />
      <br />
            <br />
      <table border="0" cellpadding="0" cellspacing="0"  >
     <form name="FormLogin" method="post" action="../core/login_c.php">
      <tr>
        <td width="270" height="177" align="left" valign="top">
 
        
        <table width="100%" height="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#F8DC58">
          <tr>
            <td background="../cfrontend/images/bgblockalpha_5.png"><span class="style1" style="font-weight: bold"><?=T_LOGIN;?></span><br />
              <br />
              <table width="200" border="0" align="center" cellpadding="2" cellspacing="1">
                <tr>
                  <td height="30"><span class="loginstyle"><?=T_USERNAME;?></span></td>
                  <td height="30"><input type="text" name="username" id="username" style="width:80px"  /></td>
                </tr>
                <tr>
                  <td height="30" class="loginstyle"><?=T_PASSWORD;?></td>
                  <td height="30"><input type="password" name="password" id="password" style="width:80px" /></td>
                </tr>
                <tr>
                  <td height="30"><?=T_LANGUAGE;?><br />
                   <label> <input name="language" type="radio"  value="english" <?=$language=='english'?'checked':''?> />
                    <img src="../resource/images/flag/b.gif" width="16" height="11" />  </label>
                    <label><input type="radio" name="language"  value="thai" <?=$language=='thai'?'checked':''?>/>
                    <img src="../resource/images/flag/t.gif" width="16" height="11" /></label>
                     <input type="submit" style="display:none" /></td>
                  <td height="30" align="right">
                  <table border="0" cellpadding="3" cellspacing="1" bgcolor="#999999" style="margin:5px">
                      <tr>
                        <td class="tdButtonOnOut" onmouseover="this.className='tdButtonOnOver'" onmouseout="this.className='tdButtonOnOut'"
        onclick="FormLogin.submit()"><?=T_LOGIN;?> <img src="../resource/images/silkicons/key_go.gif" /> </td>
                      </tr>
                  </table></td>
                </tr>
              </table></td>
          </tr>
        </table>        </td>
        <td height="177" >
        <table border="0" cellspacing="0" cellpadding="0" >
          <tr>
            <td width="13" height="8"><img src="../cfrontend/images/bgblockalpha_3a.png" width="13" height="8" /></td>
          </tr>
          <tr>
            <td width="13" height="169" style="background-image: url('../cfrontend/images/bgblockalpha_6.png');"><img src="images/spacer.gif" width="1" height="1" /></td>
          </tr>
        </table>        </td>
      </tr>
      <tr>
        <td width="270" ><table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="8"><img src="../cfrontend/images/bgblockalpha_7.png" width="8" height="16" /></td>
            <td style="background-image: url('../cfrontend/images/bgblockalpha_8.png');">&nbsp;</td>
          </tr>
        </table></td>
        <td><img src="../cfrontend/images/bgblockalpha_9.png" width="13" height="16" /></td>
      </tr>
     </form>
    </table>
    <br />
      
  <table border="0" cellpadding="0" cellspacing="0"  >
      <tr>
        <td width="150" align="left" valign="top">
 
        
        <table width="100%" height="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#F8DC58">
          <tr>
            <td height="40" align="center" background="../cfrontend/images/bgblockalpha_5.png"><a href="../cregister/customer_register.php?act=search"><strong><?=T_REGISNEW;?></strong></a><br />
              </td>
          </tr>
        </table>        </td>
        <td >
        <table border="0" cellspacing="0" cellpadding="0" >
          <tr>
            <td width="13" height="8"><img src="../cfrontend/images/bgblockalpha_3a.png" width="13" height="8" /></td>
          </tr>
          <tr>
            <td width="13" height="34" style="background-image: url('../cfrontend/images/bgblockalpha_6.png');"><img src="images/spacer.gif" width="1" height="1" /></td>
          </tr>
        </table>        </td>
      </tr>
    <tr>
      <td width="150" ><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="8"><img src="../cfrontend/images/bgblockalpha_7.png" width="8" height="16" /></td>
              <td style="background-image: url('../cfrontend/images/bgblockalpha_8.png');">&nbsp;</td>
            </tr>
        </table></td>
        <td><img src="../cfrontend/images/bgblockalpha_9.png" width="13" height="16" /></td>
        </tr>
    </table>
    

    
    </td>
  </tr>
</table>
</body></html>

<? 
include_once '../core/inc_pngfix.php';
echo replacePngTags(ob_get_clean()); ?>
