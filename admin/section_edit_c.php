<? include_once("../core/default.php"); ?>

<?
if ($usertype != 'AD') exit("Permission deny");

//var_dump($_GET);
//$DEBUGSQL = true;
$action = $_GET["act"];
$section_id = isset($_POST["id"]) ? $_POST["id"] : $_GET["id"];

$section_data = new Csql();
$section_data->Connect();

if (isset($section_id) && $section_id > 0) {
    $section_data->Query("select * from section where sectionid = $section_id limit 1");
    if ($action != 'save' && !$section_data->EOF) {
        $sec_room = $section_data->Rs("sec_room");
        $sec_type = $section_data->Rs("sec_type");
    }
}

if ($action == 'save') {
    $sec_type = $_POST["sec_type"];
    $sec_room = $_POST["sec_room"];

    if ($section_id == -1) {
        $section_data->AddNew();
    } else {
        $section_data->Set("sectionid", "'{$section_id}'");
    }
    $section_data->TableName = "section";
    $section_data->Set("sec_type", "'{$sec_type}'");
    $section_data->Set("sec_room", "'{$sec_room}'");
    $section_data->Update();
    Redirect('section_manager_c.php', 0);
    exit();
}
if ($action == 'del') {
    $section_data->Execute("delete from section where sectionid = $section_id limit 1");
    Redirect('section_manager_c.php', 0);
    exit();
}
?>
<br/>
<form name="formSectionEdit" id="formSectionEdit" method="post" action="../admin/section_edit_c.php?act=save">
    <input type="hidden" name="act" id="act" value="save"/>
    <table width="100%" height="100%" border="0" align="center">
        <tr>
            <td valign="top">

            </td>
        </tr>
        <tr>
            <td colspan="2">
                <? include "../cfrontend/tbframe2h.php" ?>
                <table width="100%" border="0" cellspacing="1" align="center">
                    <input type="hidden" name="id" value="<?= $section_id ?>"/>
                    <tr>
                        <td colspan="2" align="center"><strong>Section Information</strong></td>
                    </tr>
                    <tr>
                        <td>Type</td>
                        <td align="right">
                            <label><input type="radio" name="sec_type"
                                          value="F" <?= $sec_type == 'F' ? 'checked="checked"' : '' ?> />Fix</label>
                            <label><input type="radio" name="sec_type"
                                          value="R" <?= $sec_type == 'R' ? 'checked="checked"' : '' ?> />Remove</label>
                            <label><input type="radio" name="sec_type"
                                          value="O" <?= $sec_type == 'O' ? 'checked="checked"' : '' ?> />Ortho</label>
                            <label><input type="radio" name="sec_type"
                                          value="M" <?= $sec_type == 'M' ? 'checked="checked"' : '' ?> />Manager</label>

                        </td>
                    </tr>
                    <tr>
                        <td>Name</td>
                        <td align="right">
                            <input name="sec_room" type="text" style="width:300px" value="<?= $sec_room ?>"></td>
                    </tr>
                </table>
                <? include "../cfrontend/tbframe2f.php" ?>
            </td>
        </tr>

        <tr>
            <td colspan="2" valign="bottom">

                <table width="100%" border="0" align="center" cellpadding="2" cellspacing="1">
                    <tr>
                        <td>&nbsp;</td>
                        <td width="2">&nbsp;</td>
                        <td width="50">
                            <table border="0" cellpadding="2" cellspacing="1" bgcolor="#000000">
                                <tr>
                                    <td width="50" align="center" bgcolor="#FFFFFF" class="tdButtonOnOut"
                                        onclick="formSectionEdit.submit();"
                                        onmouseover="this.className='tdButtonOnOver'"
                                        onmouseout="this.className='tdButtonOnOut'">Save
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td width="2">&nbsp;</td>
                        <td width="50">
                            <table border="0" cellpadding="2" cellspacing="1" bgcolor="#000000">
                                <tr>
                                    <td width="50" align="center" bgcolor="#FFFFFF" class="tdButtonOnOut"
                                        onclick="CloseDivEditSectionData();"
                                        onmouseover="this.className='tdButtonOnOver'"
                                        onmouseout="this.className='tdButtonOnOut'">Close
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td width="25">&nbsp;</td>
                    </tr>
                </table>

            </td>
        </tr>
    </table>

</form>