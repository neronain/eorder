<div style="width:400px" align="right">
<? include "../cfrontend/tbframe2h.php"?>
<table width="100%" border="0" cellspacing="1" align="center">
<input type="hidden" name="sid" id="sid" value="<?=$staff_id?>" />
  <tr>
    <td colspan="2" align="center"><strong>Staff Information</strong></td>
  </tr>
  <tr>
    <td width="100">Staff Name</td>
    <td>
      <label>
      <select name="prefix" id="prefix" style="width:50px">
      	<option value="นาย" <?=($staff_prefix == "นาย") ? " selected" : " "?>>นาย</option>
        <option value="นาง"<?=($staff_prefix == "นาง") ? " selected" : " "?>>นาง</option>
        <option value="นางสาว"<?=($staff_prefix == "นางสาว") ? " selected" : " "?>>นางสาว</option>
        <option value="Mr."<?=($staff_prefix == "Mr.") ? " selected" : " "?>>Mr.</option>
        <option value="Mrs."<?=($staff_prefix == "Mrs.") ? " selected" : " "?>>Mrs.</option>
        <option value="Miss"<?=($staff_prefix == "Miss") ? " selected" : " "?>>Miss</option>
      </select>
      </label>
      <input name="stfname" type="text" id="stfname" value="<?=$staff_name?>" style="width:200px" /></td>
  </tr>
  <tr>
    <td width="100">Staff Code</td>
    <td><input name="code" type="text" id="code" value="<?=$staff_code?>" style="width:50px" /></td>
  </tr>
  <tr>
    <td width="100">ID Card No.</td>
    <td><input name="idcard" type="text" id="idcard" value="<?=$staff_idcard?>" style="width:250px" /></td>
  </tr>
  <tr>
    <td width="100">Section</td>
    <td><select name="section" id="section"  style="overflow:hidden;width:250px">
      <?							
                                $data = new CSql();
								$data->Connect();
								
								$data->Query("SELECT * FROM section order by sec_type");		
								
								while(!$data->EOF){
		
								$sid 		= $data->Rs("sectionID");
								$sname="";
								switch($data->Rs("sec_type")) {
									case "F": $sname = "[ Fix ] "; break;
									case "R": $sname = "[ Remove ] "; break;
									case "O": $sname = "[ Ortho ] "; break;
									case "M": $sname = "[ Misc ] "; break;
								}
								$sname	 	.= $data->Rs("sec_room");
									
								if($section_id == $sid)
								echo "<option selected=\"selected\" value=\"".$sid."\">".$sname."</option>";
								else
								echo "<option value=\"".$sid."\">".$sname."</option>";	
			
								$data->MoveNext();
									}
								?>
    </select></td>
    </tr>
    <tr>
        <td width="100">Branch</td>
        <td><select name="branch" id="branch"  style="overflow:hidden;width:250px">
                <?
                $data = new CSql();
                $data->Connect();

                $data->Query("SELECT * FROM branch order by branchid");

                while(!$data->EOF){

                    $bid 		= $data->Rs("branchid");
                    $branch_name = $data->Rs("branch_name");

                    if($branch_id == $bid)
                        echo "<option selected=\"selected\" value=\"".$bid."\">".$branch_name."</option>";
                    else
                        echo "<option value=\"".$bid."\">".$branch_name."</option>";

                    $data->MoveNext();
                }
                ?>
            </select></td>
    </tr>
  <tr>
    <td width="100">Enable</td>
    <td><label>
      <input type="checkbox" name="enable" id="enable" <?=($enable)? " checked" : ""?> onchange="setValue('stfenable',this.checked+0)"/>
      <input type="hidden" name="stfenable" id="stfenable" value="<?=$enable?>" />
    Enable</label></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><label>
    </label></td>
  </tr>
</table>
<? include "../cfrontend/tbframe2f.php"?>
</div>