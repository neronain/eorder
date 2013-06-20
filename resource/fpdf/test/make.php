<?
//define('FPDF_FONTPATH','/hexaceram/resource/fpdf/font/');

/*
require('../font/makefont/makefont.php');
//MakeFont('tahoma.ttf','tahoma.afm','iso-8859-11'); 
//MakeFont('IDAutomationHC39M_Free.ttf','IDAutomationHC39M_Free.afm'); 
MakeFont('angsa.ttf','angsa.afm','cp874'); 
//MakeFont('IDAutomationHC39M_Free.ttf','IDAutomationHC39M_Free.afm'); 
//*/
///*

require('../fpdf.php');

$pdf=new FPDF('P','mm','A5');
$pdf->Open();
$pdf->AddPage();
$pdf->AddFont('tahoma','','tahoma.php');
$pdf->SetFont('tahoma','',16);
$pdf->Cell(0,50,"ทดสอบการทำงาน\n");




$pdf->AddFont('IDAutomationHC39M_Free','','IDAutomationHC39M_Free.php');
$pdf->SetFont('IDAutomationHC39M_Free','',16);
$pdf->Cell(0,50,"1234359842");



$pdf->Output();
// */

?>

