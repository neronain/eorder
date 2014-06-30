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
                                echo "<a href=\"../admin/section_manager_c.php" . $querystring . "page=1\"><img src=\"../resource/images/silkicons/resultset_first.gif\" width=\"16\" height=\"16\" border=0></a></a>";
                            }
                            ?></td>
                        <td width="50"><?
                            if ($page > 1) {
                                echo "<a href=\"../admin/section_manager_c.php" . $querystring . "page=" . ($page - 1) . "\"><img src=\"../resource/images/silkicons/resultset_previous.gif\" width=\"16\" height=\"16\" border=0></a>";
                            }
                            ?></td>
                        <td align="center" width="300"><?
                            for ($p = max(1, $page - 3); $p <= $page + 3 && $p <= $totalpage; $p++) {
                                if ($p == $page) {
                                    echo "&nbsp;&nbsp;&nbsp;<strong>$p</strong>&nbsp;&nbsp;&nbsp;";
                                } else {
                                    echo "&nbsp;&nbsp;<a href=\"../admin/section_manager_c.php" . $querystring . "page=$p\">$p</a>&nbsp;&nbsp;";
                                }
                            }
                            ?></td>
                        <td width="50" align="right"><?
                            if ($page < $totalpage) {
                                echo "<a href=\"../admin/section_manager_c.php" . $querystring . "page=" . ($page + 1) . "\"><img src=\"../resource/images/silkicons/resultset_next.gif\" width=\"16\" height=\"16\" border=0></a>";
                            }
                            ?></td>
                        <td width="50" align="right"><?
                            if ($page != $totalpage) {
                                echo "<a href=\"../admin/section_manager_c.php" . $querystring . "page=$totalpage\"><img src=\"../resource/images/silkicons/resultset_last.gif\" width=\"16\" height=\"16\" border=0></a>";
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
                    <? while (!$section_data->EOF) {
                        $section_id = $section_data->Rs("sectionid");
                        ?>
                        <tr class="tdRowOnOut" valign="top" onmouseover="this.className='tdRowOnOver'"
                            onmouseout="this.className=''">
                            <td onclick="OpenDivEditSectionData(<?= $section_id ?>);">
                                &nbsp;<?= $section_data->Rs("sectionid") ?></td>
                            <td onclick="OpenDivEditSectionData(<?= $section_id ?>);">
                                &nbsp;<?= $section_data->Rs("sec_type") ?>:<?= $section_data->Rs("sec_room") ?></td>
                            <td align="center">
                                <table border="0" cellpadding="1" cellspacing="1" bgcolor="#999999">
                                    <tr>
                                        <td width="30" align="center" class="tdButtonOnOutS"
                                            onmouseover="this.className='tdButtonOnOverS'"
                                            onmouseout="this.className='tdButtonOnOutS'"
                                            onclick="OpenDivEditSectionData(<?= $section_id ?>);">Edit
                                        </td>
                                        <td width="30" align="center" class="tdButtonOnOutS"
                                            onmouseover="this.className='tdButtonOnOverS'"
                                            onmouseout="this.className='tdButtonOnOutS'"
                                            onclick="if(confirm('Are you sure u want to delete this section?')) {location='../admin/section_edit_c.php?act=del&id=<?= $section_data->Rs("sectionid"); ?>'}">
                                            Delete
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <? $section_data->MoveNext();
                    } ?>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="2" class="FooterTD" align="right">
                <button onclick="OpenDivEditSectionData(-1);"> Add New <?= $group_name ?></button>
            </td>
        </tr>
    </table>

    <div id="DivEditSectionData" style="position:absolute;left:0px;top:500px;width:518px;height:250px;z-index:1;">
        <? $tbframeheader = "Edit Section Data" ?>
        <? $tbframehclose = "CloseDivEditSectionData()"; ?>
        <? include "../cfrontend/tbframeh.php" ?>
        <div id="DivSectionData" style="overflow:auto;width:500px;height:200px"></div>
        <? include "../cfrontend/tbframef.php" ?>
    </div>



    <script>
        function OpenDivEditSectionData(id) {
            activeBG();
            showHideLayers('DivEditSectionData', '', 'show');
            makeCenterScreen('DivEditSectionData');
            showHTML('DivSectionData', '../admin/section_edit_c.php?act=edit&id=' + id);
        }
        function CloseDivEditSectionData() {
            hideBG();
            showHideLayers('DivEditSectionData', '', 'hide');
        }


        showHideLayers('DivEditSectionData', '', 'hide');
        hideLoading();
    </script>

<? include_once("../admin/footer.php"); ?>