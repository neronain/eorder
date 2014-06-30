<? include_once("../core/default.php"); ?>

<?
if ($usertype != 'AD') exit("Permission deny");

//var_dump($_GET);
//$DEBUGSQL = true;
$action = $_GET["act"];
$branch_id = isset($_POST["id"])?$_POST["id"]:$_GET["id"];

$branch_data = new Csql();
$branch_data->Connect();

if (isset($branch_id) && $branch_id > 0) {
    $branch_data->Query("select * from branch where branchid = $branch_id limit 1");
    if ($action!='save' && !$branch_data->EOF) {
        $branch_name = $branch_data->Rs("branch_name");
    }
}

if($action=='save'){
    $branch_name = $_POST["branch_name"];

    if($branch_id==-1){
        $branch_data->AddNew();
    }else{
        $branch_data->Set("branchid","'{$branch_id}'");
    }
    $branch_data->TableName = "branch";
    $branch_data->Set("branch_name","'{$branch_name}'");
    $branch_data->Update();
    Redirect('branch_manager_c.php',0);
    exit();
}
if($action=='del'){
    $branch_data->Execute("delete from branch where branchid = $branch_id limit 1");
    Redirect('branch_manager_c.php',0);
    exit();
}
?>
<br/>
<form name="formBranchEdit" id="formBranchEdit" method="post" action="../admin/branch_edit_c.php?act=save">
    <input type="hidden" name="act" id="act" value="save"/>
    <table width="100%" height="100%" border="0" align="center">
        <tr>
            <td valign="top">

            </td>
        </tr>
        <tr>
            <td colspan="2">
                <? include "../cfrontend/tbframe2h.php"?>
                <table width="100%" border="0" cellspacing="1" align="center">
                    <input type="hidden" name="id" value="<?=$branch_id?>" />
                    <tr>
                        <td colspan="2" align="center"><strong>Branch Information</strong></td>
                    </tr>
                    <tr>
                        <td >Name</td>
                        <td align="right">
                            <input name="branch_name" type="text" style="width:300px" value="<?=$branch_name?>">    </td>
                    </tr>
                </table>
                <? include "../cfrontend/tbframe2f.php"?>
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
                                        onclick="formBranchEdit.submit();" onmouseover="this.className='tdButtonOnOver'"
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
                                        onclick="CloseDivEditBranchData();" onmouseover="this.className='tdButtonOnOver'"
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