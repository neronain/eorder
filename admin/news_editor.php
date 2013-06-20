<? include_once("../admin/header.php"); ?>
<script>
function refreshVisibleData(){
	obj = findObj("islimit");
	var isnolimit = obj.checked;
	
	if(isnolimit){
		showHideLayers('DivNewsDate','','show');
	}else{
		showHideLayers('DivNewsDate','','hide');
	}	
}
</script>	
<form method="post" action="../admin/news_process.php">
<input name="act" type="hidden" value="<?= $action ?>">
<input name="nid" type="hidden" value="<?= $news_id ?>">
<table style="width:500px" border="0" cellpadding="2" cellspacing="1" bgcolor="#999999">
  <tr>
    <td colspan="2" align="left" bgcolor="#CCCCCC"><strong>ข่าวสารบริการ</strong></td>
  </tr>
  <tr>
    <td width="100" align="center" bgcolor="#FFFFFF"><strong>ชื่อบทความ</strong></td>
    <td bgcolor="#FFFFFF"><input name="title" id="title" type="text" style = "width:60%" value="<?=$news_title ?>" /></td>
  </tr>
  <tr>
    <td align="center" valign="top" bgcolor="#FFFFFF"><strong>เนื้อหา</strong></td>
<!-- tinyMCE -->
<script language="javascript" type="text/javascript" src="../resource/javascript/tiny_mce/tiny_mce.js"></script>
<script language="javascript" type="text/javascript">
	tinyMCE.init({
		mode : "exact",
		elements : "data",
		theme : "advanced",
		plugins :	"safari,spellchecker,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,pagebreak,imagemanager,filemanager",
		//theme_advanced_buttons1_add_before : "save,newdocument,separator",
		theme_advanced_buttons1_add_before : "newdocument,separator",
		theme_advanced_buttons1_add : "fontselect,fontsizeselect",
		theme_advanced_buttons2_add : "separator,insertdate,inserttime,preview,separator,forecolor,backcolor",
		theme_advanced_buttons2_add_before: "cut,copy,paste,pastetext,pasteword,separator,search,replace,separator",
		theme_advanced_buttons3_add_before : "tablecontrols,separator",
		theme_advanced_buttons3_add : "iespell,media,separator,print",//separator,fullscreen",
		//theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,spellchecker,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,blockquote,pagebreak,|,insertfile,insertimage",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_path_location : "bottom",
		content_css : "/example_data/example_full.css",
	    plugin_insertdate_dateFormat : "%Y-%m-%d",
	    plugin_insertdate_timeFormat : "%H:%M:%S",
		extended_valid_elements : "hr[class|width|size|noshade],font[face|size|color|style],span[class|align|style],p[lang]",
		external_link_list_url : "example_data/example_link_list.js",
		external_image_list_url : "example_data/example_image_list.js",
		flash_external_list_url : "example_data/example_flash_list.js",
		template_external_list_url : "example_data/example_template_list.js",
		file_browser_callback : "mcFileManager.filebrowserCallBack",
		theme_advanced_resize_horizontal : false,
		theme_advanced_resizing : true,
		apply_source_formatting : true,
		spellchecker_languages : "+English=en,Danish=da,Dutch=nl,Finnish=fi,French=fr,German=de,Italian=it,Polish=pl,Portuguese=pt,Spanish=es,Swedish=sv"
	});

</script>
<!-- /tinyMCE -->
      <td ><textarea id="data" name="data" rows="15" cols="80" style="width: 100%" ><?=$news_data?></textarea></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#FFFFFF"><strong>วันสิ้นสุด</strong></td>
    <td align="left" bgcolor="#FFFFFF">
    	<input name="islimit" type="checkbox" id="islimit"  value="false" <?=$islimit ?" checked":" " ?> onclick="refreshVisibleData();" />	<div id="DivNewsDate"><? buildDateSelector('newsdate',$newsdate_day,$newsdate_month,$newsdate_year) ?></div>
</td>            
	
  </tr>
  <tr>
    <td colspan="2" align="center" bgcolor="#E5E5E5"><input type="submit" value="ตกลง" />
      &nbsp;
      <input type="reset" value="ยกเลิก" /></td>
  </tr>
</table>
</form>
<script>
	refreshVisibleData();
</script>
<? include_once("../admin/footer.php"); ?>