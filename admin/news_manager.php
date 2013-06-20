<? include_once("../admin/header.php"); ?>
<? // -------------------------------- News Manager Table --------------------------------------?>
    <table width="100%" border="0">
  <tr align="center" >
    <td bgcolor="#AAAAFF" width="30"><strong>ID</strong></td>
    <td bgcolor="#AAAAFF"><strong>Title</strong></td>
    <td bgcolor="#AAAAFF"><strong>Written Date</strong></td>
    <td bgcolor="#AAAAFF"><strong>End date</strong></td>
    <td bgcolor="#AAAAFF" width="50"><strong>Edit</strong></td>
    <td bgcolor="#AAAAFF" width="50"><strong>Delete</strong></td>
  </tr>
<?
	$i = 0;
	while($i < $num) {
?>
  <tr align="center">
    <td bgcolor='#EEEEFF' align='center'><?=$i+1?></td>
    <td bgcolor='#EEEEFF' align="justify"><?=$news_title[$i]?></td>
    <td bgcolor='#EEEEFF'><?=$news_date[$i]?></td>
    <td bgcolor='#EEEEFF'><?=$news_enddate[$i]?></td>
    <td bgcolor='#EEEEFF' align='center'><a href='../admin/news_editor_c.php?act=edit&nid=<?=$news_id[$i]?>'><img src='../resource/images/silkicons/pencil.png' border='0' /></a></td>
    <td bgcolor='#EEEEFF' align='center'><a href='../admin/news_manager_c.php'><img src='../resource/images/silkicons/cross.png' onclick="if(confirm('ท่านต้องการลบข่าวสารบริการนี้หรือไม่ ?')){location='../admin/news_process.php?act=del&nid=<?=$news_id[$i]?>';}else{return false;}" style="cursor:pointer" border='0' /></a></td>
  </tr>
<?
		$i++;
	}
?>
</table>
    <? // ----------------------------------------------------------------------?>
<? include_once("../admin/footer.php"); ?>