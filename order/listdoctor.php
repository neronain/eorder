<? include_once("../core/default.php"); ?>
<? 
// IN
//	$query


	$data_doctor  = new Csql();
	$data_doctor->Connect();
	$data_doctor->Query($query);

?>
<? while(!$data_doctor->EOF){ ?>





<? $data_doctor->MoveNext();	} ?>