<? include_once("../core/default.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=WEBSITE_HEADER  ?></title>
<link href="../resource/css/default.css" rel="stylesheet" type="text/css" />
<script src="../resource/javascript/jquery-1.9.1.min.js"></script>
</head>

<body >
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="3"><? include "header.php"?></td>
  </tr>
  <tr>
    <td valign="top"><? include "menu.php"?></td>
    <td colspan="2">
		<table width="600" border="0" cellpadding="2" cellspacing="1">
		  <tr>
			<td width="40" class="HeaderTable">ID</td>
			<td width="100" class="HeaderTable">User Name</td>
			<td width="120" class="HeaderTable">Name</td>
			<td width="100" class="HeaderTable">Group</td>
			<td width="120" class="HeaderTable">E-Mail</td>
			<td width="120" class="HeaderTable">Status</td>
		  </tr>

<?
	$sort = $_GET["sort"];
	$method = $_GET["METHOD"];
	$keyword = $_GET["keyword"];
	$page = $_GET["page"]; if(!isset($page))$page = 1;


	$eachpage = $_GET["eachpage"]; if(!isset($eachpage))$eachpage = 15;	

	$where = "";
	if($method=="GO!"){
		$where = " and (cus_name like '%$keyword%' or cus_nick ='$keyword')";
	}
	
	$data_userdental = new CSql();
 	$err =	$data_userdental->Connect();
	$iquery = "select * ";
	$cquery = "select count(*) as countrow ";
	$query = "from userdental where usr_ugp_id = '".$gr."'";
	$cquery.=$query;
	$query = $iquery.$query;
	$data_userdental->Query("$cquery");
	$totalrow = $data_userdental->Rs("countrow");
	$data_userdental->Query("$query  limit ".(($page-1)*$eachpage).",$eachpage");//Query("select * from ");
	//echo $query;	
		
	
	//$page = 10;	
	$totalpage = ceil($totalrow/$eachpage);
	 while(!$data_userdental->EOF){
		 echo "<tr>";
		 echo "<td width='40' >".$data_userdental->Rs("userdentalid")."</td>";
		 echo "<td width='100' >". $data_userdental->Rs("usr_username")."</td>";
		 echo "<td width='120' >". $data_userdental->Rs("usr_fname")." ".$data_userdental->Rs("usr_sname")."</td>";
		 echo "<td width='100' >". $data_userdental->Rs("usr_ugp_id")."</td>";
		 echo "<td width='120' >". $data_userdental->Rs("usr_email")."</td>";
		 echo "<td width='120' >". $data_userdental->Rs("usr_status")."</td>";
		 echo "</tr>";
	 		$data_userdental->MoveNext();	
      }	
	//echo "[".$data_userdental->GetMaxID("userdental")."]";
?>
<tr><td>&nbsp;</td><td align='center'>
<form method="POST" action="userupdate.php" name="FormUserUpdate">
<input type="submit" name="submit"  value="   Add new user   " />
</form></td></tr>
    </table>
    
    </td>
  </tr>
</table>
</body>
</html>
