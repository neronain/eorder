<? include_once("../core/default.php"); 
 include_once("../order/inc_shade.php"); 
 include_once("../order/inc_getstring.php"); 

	
	$eorderid = $_GET["eorderid"];




	$data_eorder = new Csql();
	$err =	$data_eorder->Connect();
	$query = "select ord_code,cus_name,doc_name,ord_patientnameord_detail,
		DATE_FORMAT(ord_date,'%e') as ord_dated,
		DATE_FORMAT(ord_date,'%m') as ord_datem,
		DATE_FORMAT(ord_date,'%Y') as ord_datey,

		DATE_FORMAT(ord_releasedate,'%e') as ord_releasedated,
		DATE_FORMAT(ord_releasedate,'%m') as ord_releasedatem,
		DATE_FORMAT(ord_releasedate,'%Y') as ord_releasedatey,

		DATE_FORMAT(ord_docdate,'%e') as ord_docdated,
		DATE_FORMAT(ord_docdate,'%m') as ord_docdatem,
		DATE_FORMAT(ord_docdate,'%Y') as ord_docdatey,

		
		
		eorder_fixid,ordf_method,ordf_typeofworkt,ordf_shade,ordf_alloy,
		ordf_embrasure,ordf_pontic,ordf_optiont,ordf_observation,

		eorder_removeid,ordr_method,ordr_typeofworkt,ordr_shade,ordr_observation

		from 
		(select * from eorder,customer,doctor 
		where ord_cus_id = customerid and ord_doc_id = doctorid and eorderid=$eorderid)as main
		left join
		(select * from eorder_fix where eorder_fixid=$eorderid)as efix on eorderid = eorder_fixid
		left join
		(select * from eorder_remove where eorder_removeid=$eorderid)as eremove on eorderid = eorder_removeid
		left join
		(select * from eorder_ortho where eorder_orthoid=$eorderid)as eortho on eorderid = eorder_orthoid
		
		
		
		 limit 0,1";
	$data_eorder->Query($query);
	
	$ordtypeF			= $data_eorder->Rs("eorder_fixid")+0>0;
	$ordtypeR			= $data_eorder->Rs("eorder_removeid")+0>0;
	
	$ordfmethod			= $data_eorder->Rs("ordf_method");
	$ordftypeofworkt	= $data_eorder->Rs("ordf_typeofworkt");
	$ordfshade				= $data_eorder->Rs("ordf_shade");
	$ordfalloy				= $data_eorder->Rs("ordf_alloy");
	$ordfembrasure		= $data_eorder->Rs("ordf_embrasure");
	$ordfpontic				= $data_eorder->Rs("ordf_pontic");
	$ordfoptiont			= $data_eorder->Rs("ordf_optiont");
	$ordfobservation		= $data_eorder->Rs("ordf_observation");

	$ordrmethod			= $data_eorder->Rs("ordr_method");
	$ordrtypeofworkt	= $data_eorder->Rs("ordr_typeofworkt");
	$ordrshade				= $data_eorder->Rs("ordr_shade");
	$ordrobservation		= $data_eorder->Rs("ordr_observation");




require('../resource/fpdf/fpdf.php');

$pdf=new FPDF('P','mm','A5');
$pdf->Open();
$pdf->AddPage();
$pdf->AddFont('tahoma','','tahoma.php');
$pdf->SetFont('tahoma','',16);
//$pdf->Cell(0,50,"ทดสอบการทำงาน\n");

	$pdf->Write(10,"Order-code  ".$data_eorder->Rs("ord_code"));
	$pdf->Write(10,"Custome  r{$data_eorder->Rs('cus_name')}");
	$pdf->Write(10,"Doctor  {$data_eorder->Rs('doc_name')}");
	$pdf->Write(10,"Patient  {$data_eorder->Rs('ord_patientname')}");
	$pdf->Write(10,"Entry date  {$data_eorder->Rs('ord_dated')} {$data_eorder->Rs('ord_datem')} {$data_eorder->Rs('ord_datey')}");
	$pdf->Write(10,"Ship date  {$data_eorder->Rs('ord_releasedated')}".
				passThaiMonth($data_eorder->Rs('ord_releasedatem')).
				passThaiYear($data_eorder->Rs("ord_releasedatey")));




$pdf->AddFont('IDAutomationHC39M_Free','','IDAutomationHC39M_Free.php');
$pdf->SetFont('IDAutomationHC39M_Free','',16);
$pdf->Cell(0,50,"1234359842");



$pdf->Output();



/*
	include ('../resource/pdfengine/class.ezpdf.php');
	$pdf =& new Cezpdf('A5');
	$pdf->ezSetMargins(5,5,15,15);
	
	//$pdf->ezSetY(100);
	//$pdf->selectFont('../resource/pdfengine/fonts/IDAutomationHC39M_Free.afm');
	//$pdf->ezText('*'.$data_eorder->Rs("ord_code").'*',14);
//	$pdf->ezText('Hello World!',50);
	
	//$pdf->SetFont('LilyUPC','',16);
	
	$pdf->selectFont('../resource/pdfengine/fonts/tahoma.afm');
//	$pdf->selectFont('../resource/pdfengine/fonts/Helvetica.afm');

	$pdf->ezText("Order-code  ".$data_eorder->Rs("ord_code"),10);
	$pdf->ezText("Custome  r{$data_eorder->Rs('cus_name')}",10);
	$pdf->ezText("Doctor  {$data_eorder->Rs('doc_name')}",10);
	$pdf->ezText("Patient  {$data_eorder->Rs('ord_patientname')}",10);
	$pdf->ezText("Entry date  {$data_eorder->Rs('ord_dated')} {$data_eorder->Rs('ord_datem')} {$data_eorder->Rs('ord_datey')}",10);
	$pdf->ezText("Ship date  {$data_eorder->Rs('ord_releasedated')}".
				passThaiMonth($data_eorder->Rs('ord_releasedatem')).
				passThaiYear($data_eorder->Rs("ord_releasedatey")),10);
	
	/*
*$data_eorder->Rs("ord_code");*
Order-code $data_eorder->Rs("ord_code");
Customer$data_eorder->Rs("cus_name");
Doctor$data_eorder->Rs("doc_name");
Patient$data_eorder->Rs("ord_patientname");
Entry date $data_eorder->Rs("ord_dated");
passThaiMonth($data_eorder->Rs("ord_datem")); 
passThaiYear($data_eorder->Rs("ord_datey"));

Ship date
$data_eorder->Rs("ord_releasedated");
passThaiMonth($data_eorder->Rs("ord_releasedatem"));
passThaiYear($data_eorder->Rs("ord_releasedatey"));

 if($ordtypeF){
--- Fix order ---
Method $ordfmethod
Type of work $ordftypeofworkt
Shade  getShadeName($ordfshade)
Alloy  getAlloyName($ordfalloy)
Embrasure  $ordfembrasure
Type of pontic ../resource/images/eorder/fix/fix_pontic<?=$ordfpontic-1
Option $ordfoptiont
Observation $ordfobservation

 }
 if($ordtypeR){
--- Remove order ---

Method $ordrmethod
Type of work $ordrtypeofworkt
 Shade  getShadeName($ordrshade)
 Observation  $ordrobservation
 </table>
  <? }?>

HEXA CERAM CO.LTD


	
	
	$pdf->ezSetY(50);
	$pdf->ezText('HEXA CERAM CO.LTD',8,array('justification'=>'left'));
	$pdf->ezText('213 Moo 5 Sanpraned ',8,array('justification'=>'left'));
	$pdf->ezText('Sansai Chiangmai 50210 Thailand',8,array('justification'=>'left'));
	$pdf->ezText('Tel (66) 53 380 801 - 2 Tel & Fax (66) 53 380 471',8,array('justification'=>'left'));
	$pdf->ezSetY(50);
	

	$pdf->selectFont('../resource/pdfengine/fonts/IDAutomationHC39M_Free.afm');
	$pdf->ezText('*'.$data_eorder->Rs("ord_code").'*',8,array('justification'=>'right'));
	
	$pdf->ezStream(); */
?>