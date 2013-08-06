<? include_once("../core/default.php"); 
require_once "../resource/phpexcel/class.writeexcel_workbook.inc.php";
require_once "../resource/phpexcel/class.writeexcel_worksheet.inc.php";


$token = md5(uniqid(rand(), true));
$fname= "../file/tmp/$token.xls";
$workbook =& new writeexcel_workbook($fname);

$worksheet =& $workbook->addworksheet("Sheet1");
$worksheet->set_margin_right(0.50);
$worksheet->set_margin_bottom(1.10);

## Set Format  ##
$xlsCellDescB =& $workbook->addformat();
$xlsCellDescB->set_font('Tahoma');
$xlsCellDescB->set_size(14);
$xlsCellDescB->set_color('black');
$xlsCellDescB->set_bold(1);
$xlsCellDescB->set_align('left');
$xlsCellDescB->set_text_v_align(1);


$xlscelldesc_header =& $workbook->addformat();
$xlscelldesc_header->set_font('Tahoma');
$xlscelldesc_header->set_size(12);
$xlscelldesc_header->set_color('black');
$xlscelldesc_header->set_bold(1);
$xlscelldesc_header->set_align('left');
$xlscelldesc_header->set_text_v_align(1);

$xlsCellDesc =& $workbook->addformat();
$xlsCellDesc->set_font('Tahoma');
$xlsCellDesc->set_size(11);
$xlsCellDesc->set_color('black');
$xlsCellDesc->set_bold(0);
$xlsCellDesc->set_align('left');
$xlsCellDesc->set_text_v_align(1);
## End of Set Format ##

## Set Column Width & Height  กำหนดความกว้างของ Cell
$worksheet->set_column('A:B', 2);
$worksheet->set_column('B:C', 20);
$worksheet->set_column('C:D', 20);
$worksheet->set_column('D:E', 20);
$worksheet->set_column('E:F', 40);
$worksheet->set_column('F:G', 20);
$worksheet->set_column('G:H', 30);
$worksheet->set_column('H:I', 20); 
$worksheet->set_column('I:J', 50); 
$worksheet->set_column('J:K',  15); 
$worksheet->set_column('K:L',  40); 
$celldesc_h = 16.50;

## Writing Data  เพิ่มข้อมูลลงใน Cell
/*$worksheet->write(A1,utf8_to_tis620("ข้อมูลนี้เป็นของปี พศ. $year"), $xlscelldesc_header);
$worksheet->write(A2,utf8_to_tis620("รายละเอียดเบื้องต้นของโรงงาน"), $xlscelldesc_header);
$worksheet->write(A4,utf8_to_tis620("ข้อมูลเบื้องต้น"), $xlscelldesc_header);
*/
# กำหนดความสูงของ Cell
/* $worksheet->set_row(1, $celldesc_h);
$worksheet->set_row(2, $celldesc_h);
$worksheet->set_row(3, $celldesc_h);
$worksheet->set_row(4, $celldesc_h);
$worksheet->set_row(5, $celldesc_h); */
	$col=1;
	$worksheet->write(0,$col++,utf8_to_tis620("วัน/เดือน/ปี(เข้า)"), $xlscelldesc_header);
	$worksheet->write(0,$col++,utf8_to_tis620("วัน/เดือน/ปี(นัด)"), $xlscelldesc_header);
	$worksheet->write(0,$col++,utf8_to_tis620("วัน/เดือน/ปี(ออก)"), $xlscelldesc_header);
	$worksheet->write(0,$col++,utf8_to_tis620("ลูกค้า"), $xlscelldesc_header);
	$worksheet->write(0,$col++,utf8_to_tis620("หมอ"), $xlscelldesc_header);
	$worksheet->write(0,$col++,utf8_to_tis620("คนไข้"), $xlscelldesc_header);
	$worksheet->write(0,$col++,utf8_to_tis620("รหัสงาน"), $xlscelldesc_header);
	$worksheet->write(0,$col++,utf8_to_tis620("รายละเอียด"), $xlscelldesc_header);
	$worksheet->write(0,$col++,utf8_to_tis620("ประเทศ"), $xlscelldesc_header);
	$worksheet->write(0,$col++,utf8_to_tis620("ส่งด้วย"), $xlscelldesc_header);
	$worksheet->write(0,$col++,utf8_to_tis620("หมายเหตุ"), $xlscelldesc_header);


$row=1;
foreach($data_orderAr as $dt_order){

	$col=1;
	$worksheet->write($row,$col++,utf8_to_tis620($dt_order["endatel"]), $xlsCellDesc);
	$worksheet->write($row,$col++,utf8_to_tis620(str_replace("00/00","-",str_replace("00:00","",$dt_order["docdate"]))), $xlsCellDesc);
	$worksheet->write($row,$col++,utf8_to_tis620(str_replace("00:00","",$dt_order["deliverydate"])), $xlsCellDesc);
	$worksheet->write($row,$col++,utf8_to_tis620(reduceName($dt_order["cus_name"])), $xlsCellDesc);
	$worksheet->write($row,$col++,utf8_to_tis620($dt_order["doc_name"]), $xlsCellDesc);
	$worksheet->write($row,$col++,utf8_to_tis620($dt_order["ord_patientname"]), $xlsCellDesc);
	$worksheet->write($row,$col++,utf8_to_tis620($dt_order["ord_code"]), $xlsCellDesc);
	$worksheet->write($row,$col++,utf8_to_tis620($dt_order["ord_typeofwork"]), $xlsCellDesc);
	$worksheet->write($row,$col++,utf8_to_tis620($dt_order["cnt_name"]), $xlsCellDesc);
	$worksheet->write($row,$col++,utf8_to_tis620($dt_order["ord_shipmethod"]), $xlsCellDesc);
	
 	if($dt_order["eorder_fixid"]>0){
		$worksheet->write($row,$col++,utf8_to_tis620(getAlloyName($dt_order["ordf_alloy"])), $xlsCellDesc);
	}else{
		$worksheet->write($row,$col++,"", $xlsCellDesc);
	}

	
	$row++;
	
}
$workbook->close();


header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
header("Content-Type: application/download");
header("Content-Disposition: attachment; filename=".basename("Summary_report_$cyear-$cmonth-$cdate_to_$eyear-$emonth-$edate.xls").";");
header("Content-Transfer-Encoding: binary ");
header("Content-Length: ".filesize($fname));
readfile($fname);
unlink($fname);
exit(); //*/
?>