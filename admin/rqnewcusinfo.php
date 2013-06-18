<? include_once("../core/default.php"); ?>
<? 
	$pre_customerid = $_GET["pre_customerid"];
	$data_customer = new Csql();
	$data_customer->Connect();
	$data_customer->Query("select * from pre_customer where pre_customerid=$pre_customerid");


    $pre_customerid 		= $data_customer->Rs("pre_customerid"); 
	$pcus_usr_username 	= $data_customer->Rs("pcus_usr_username"); 
	$pcus_usr_password 	= $data_customer->Rs("pcus_usr_password"); 
    $pcus_name 				= $data_customer->Rs("pcus_name"); 
	$pcus_docname 			= $data_customer->Rs("pcus_docname"); 
	$pcus_address 			= $data_customer->Rs("pcus_address"); 
	$pcus_cnt_id 				= $data_customer->Rs("pcus_cnt_id"); 
	$pcus_prv_id 				= $data_customer->Rs("pcus_prv_id"); 
	$pcus_prv_name 		= $data_customer->Rs("pcus_prv_name"); 
	$pcus_tel 					= $data_customer->Rs("pcus_tel"); 
	$pcus_email				= $data_customer->Rs("pcus_email"); 
	$pcus_remark 			= $data_customer->Rs("pcus_remark"); 
	
	
	$data_customer->Connect();
	$data_customer->Query("
	select left(cus_nick,1) as prefix,(right(cus_nick,3)) as suffix 
	from customer  order by cus_nick ");
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=WEBSITE_HEADER  ?></title>
<link href="../resource/css/default.css" rel="stylesheet" type="text/css" />
</head>

<body >
<table border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="3"><? include "header.php"?></td>
  </tr>
  <tr>
    <td valign="top"><? include "menu.php"?></td>
    <td colspan="2">



<table border="0" cellspacing="0" cellpadding="3">
<form method="post" action="rqnewcusaccept.php">
<input type="hidden" name="pre_customerid" value="<?=$pre_customerid?>" />
  <tr>
    <td>Username </td>
    <td><?=$pcus_usr_username?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Customer name</td>
    <td><?=$pcus_name?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td valign="top">Customer nick</td>
    <td valign="top"><input name="pcus_nick" type="text" size="10" maxlength="4" /></td>
    <td valign="top" class="Small"> <strong>Choose one</strong>      <? 	$prefix = '';
			$count = 0;
			$index = 0;			
	 while(!$data_customer->EOF){ 
			if($prefix!=$data_customer->Rs("prefix")){
				if($index<999 && $prefix !=''){
					
					echo $prefix;
					if($i<10)echo '0';
					if($i<100)echo '0';
					echo ($index+1)." ";	
					for($i=$index;$i<1000 && $count<3;$i++,$count++){
						echo $prefix;
						if($i<10)echo '0';
						if($i<100)echo '0';
						echo $i." ";
						
					}
						
				}
				//if($prefix !='')
				echo "<br>";	
				$prefix=$data_customer->Rs("prefix");
				$count=0;
				$index = 0;
				
			}
			
			$tmp = 0+$data_customer->Rs("suffix");
			if($tmp>$index){
				for($i=$index+1;$i<$tmp;$i++){
					if($count<3){
						echo $prefix;
						if($i<10)echo '0';
						if($i<100)echo '0';
						echo $i." ";
					}
					$count++;
				}
				$index = $tmp;
			}
			
		    //$data_customer->Rs("suffix")
		 	//$data_customer->Rs("prefix")
	 		$data_customer->MoveNext();	
      }
		if($index<999 && $prefix !=''){
			echo $prefix;
			if($i<10)echo '0';
			if($i<100)echo '0';
			echo ($index+1)."<br>";			
		}	  
	  
	   ?>    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" value="Accept" /></td>
    <td>&nbsp;</td>
  </tr></form>
</table>


    </td>
  </tr>
</table>
</body>
</html>
