<? include_once("../admin/header.php"); ?>
<? /* */
include_once "../resource/divbackground.php" ?>
    <div id="DivStatus"></div>
    <table width="100%" border="0" cellpadding="2" cellspacing="1" class="TableBorder">
        <tr>
            <td colspan="2" class="HeaderW">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td class="HeaderW"><img src="../resource/images/silkicons/group.gif"><?= $group_name ?> list
                        </td>
                        <td class="Normal" align="right">Found <?= $totalrow ?> <?= $group_name ?> in <?= $totalpage ?>
                            pages
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="2" align="center" bgcolor="#FFFFFF">
                <table cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="50"><?
                            if ($totalpage > 1){
                            if ($page != 1) {
                                echo "<a href=\"../admin/branch_manager_c.php" . $querystring . "page=1\"><img src=\"../resource/images/silkicons/resultset_first.gif\" width=\"16\" height=\"16\" border=0></a></a>";
                            }
                            ?></td>
                        <td width="50"><?
                            if ($page > 1) {
                                echo "<a href=\"../admin/branch_manager_c.php" . $querystring . "page=" . ($page - 1) . "\"><img src=\"../resource/images/silkicons/resultset_previous.gif\" width=\"16\" height=\"16\" border=0></a>";
                            }
                            ?></td>
                        <td align="center" width="300"><?
                            for ($p = max(1, $page - 3); $p <= $page + 3 && $p <= $totalpage; $p++) {
                                if ($p == $page) {
                                    echo "&nbsp;&nbsp;&nbsp;<strong>$p</strong>&nbsp;&nbsp;&nbsp;";
                                } else {
                                    echo "&nbsp;&nbsp;<a href=\"../admin/branch_manager_c.php" . $querystring . "page=$p\">$p</a>&nbsp;&nbsp;";
                                }
                            }
                            ?></td>
                        <td width="50" align="right"><?
                            if ($page < $totalpage) {
                                echo "<a href=\"../admin/branch_manager_c.php" . $querystring . "page=" . ($page + 1) . "\"><img src=\"../resource/images/silkicons/resultset_next.gif\" width=\"16\" height=\"16\" border=0></a>";
                            }
                            ?></td>
                        <td width="50" align="right"><?
                            if ($page != $totalpage) {
                                echo "<a href=\"../admin/branch_manager_c.php" . $querystring . "page=$totalpage\"><img src=\"../resource/images/silkicons/resultset_last.gif\" width=\"16\" height=\"16\" border=0></a>";
                            }
                            }
                            ?></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="2" bgcolor="#FFFFFF">
                <!------------------------------------------ Manager Table ------------------------------------------>
                <table width="100%" border="0" cellpadding="2" cellspacing="2">
                    <tr align="center">
                        <td class="HeaderTable" width="100">ID</td>
                        <td class="HeaderTable">Name</td>
                        <td class="HeaderTable" width="60">Operation</td>
                    </tr>
                    <? while (!$branch_data->EOF) {
                        $branch_id = $branch_data->Rs("branchid");
                        ?>
                        <tr class="tdRowOnOut" valign="top" onmouseover="this.className='tdRowOnOver'"
                            onmouseout="this.className=''">
                            <td onclick="OpenDivEditBranchData(<?= $branch_id ?>);">
                                &nbsp;<?= $branch_data->Rs("branchid") ?></td>
                            <td onclick="OpenDivEditBranchData(<?= $branch_id ?>);">
                                &nbsp;<?= $branch_data->Rs("branch_name") ?></td>
                            <td align="center">
                                <table border="0" cellpadding="1" cellspacing="1" bgcolor="#999999">
                                    <tr>
                                        <td width="30" align="center" class="tdButtonOnOutS"
                                            onmouseover="this.className='tdButtonOnOverS'"
                                            onmouseout="this.className='tdButtonOnOutS'"
                                            onclick="OpenDivEditBranchData(<?= $branch_id ?>);">Edit
                                        </td>
                                        <td width="30" align="center" class="tdButtonOnOutS"
                                            onmouseover="this.className='tdButtonOnOverS'"
                                            onmouseout="this.className='tdButtonOnOutS'"
                                            onclick="if(confirm('Are you sure u want to delete this branch?')) {location='../admin/branch_edit_c.php?act=del&id=<?= $branch_data->Rs("branchid"); ?>'}">
                                            Delete
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <? $branch_data->MoveNext();
                    } ?>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="2" class="FooterTD" align="right">
                <button onclick="OpenDivEditBranchData(-1);"> Add New <?= $group_name ?></button>
            </td>
        </tr>
    </table>

    <div id="DivEditBranchData" style="position:absolute;left:0px;top:500px;width:518px;height:200px;z-index:1;">
        <? $tbframeheader = "Edit Branch Data" ?>
        <? $tbframehclose = "CloseDivEditBranchData()"; ?>
        <? include "../cfrontend/tbframeh.php" ?>
        <div id="DivBranchData" style="overflow:auto;width:500px;height:150px"></div>
        <? include "../cfrontend/tbframef.php" ?>
    </div>



    <script>
        function OpenDivEditBranchData(id) {
            activeBG();
            showHideLayers('DivEditBranchData', '', 'show');
            makeCenterScreen('DivEditBranchData');
            showHTML('DivBranchData', '../admin/branch_edit_c.php?act=edit&id=' + id);
        }
        function CloseDivEditBranchData() {
            hideBG();
            showHideLayers('DivEditBranchData', '', 'hide');
        }


        showHideLayers('DivEditBranchData', '', 'hide');
        hideLoading();
    </script>

<? include_once("../admin/footer.php"); ?>