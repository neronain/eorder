<html>
<head>
<title><?=WEBSITE_HEADER  ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../resource/css/default.css" rel="stylesheet" type="text/css" />
<script src="../resource/javascript/jquery-1.9.1.min.js"></script>
</head>
<body>
  <form action="../staff/staffedit_c.php" method="post">
<table width="100%" height="100%" cellspacing="0" cellpadding="0">
<tr><td height="50"></td></tr>
<tr><td align="center" valign="top">
<table width="600" border="0" align="center" cellpadding="2" cellspacing="1" class="TableBorder">
  <tr>
    <td class="HeaderW">Staff edit </td>
  </tr>

	<input type="hidden" name="staffid" value="<?=$staffid?>" />
  <tr>
    <td bgcolor="#FFFFFF" class="Normal"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="Normal">
        <tr>
          <td>staff code </td>
          <td><?=$stfcode?></td>
        </tr>
        <tr>
          <td>name
            <label></label>
            <labelsdsfasdfasd></td>
          <td><select name="stfgender" id="stfgender">
            <option value="นาย" <? if($stfgender == "นาย"){echo("selected");} ?>>นาย</option>
            <option value="นาง" <? if($stfgender == "นาง"){echo("selected");} ?>>นาง</option>
            <option value="นางสาว" <? if($stfgender == "นางสาว"){echo("selected");} ?>>นางสาว</option>
            <option value="Mr." <? if($stfgender == "Mr."){echo("selected");} ?>>Mr.</option>
            <option value="Mrs" <? if($stfgender == "Mrs"){echo("selected");} ?>>Mrs</option>
            <option value="Miss" <? if($stfgender == "Miss"){echo("selected");} ?>>Miss</option>
          </select>
<input type="text" name="stfname" value="<?=$stfname?>" /></td>
        </tr>
        <tr>
          <td>ID-Card</td>
          <td><input type="text" name="stfidcard" value="<?=$stfidcard?>" /></td>
        </tr>
        <tr>
          <td>section</td>
          <td><?  buildComboBoxList('stfsec','section order by sec_type,sec_room','sectionid',array('sec_type','sec_room'),$stfsec,"") ?></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table>
</td></tr>
  
    <td class="FooterTD"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td>
		<a href="../staff/staffdetail_c.php?staffid=<?= $staffid ?>">
				Back</a>
		</td>
		
        <td align="right">
		<input name="METHOD" type="submit" class="BTupdate" value="UPDATE" />
		
		</td>
		
      </tr>
    </table>
      </td>
  </tr>
 
</table>
</td></tr>
</table>
 </form>
</body>
</html>

