<?
	include_once("../core/default.php");
	include("../eorder/eorder_fix_config.php");
	include("../eorder/eorder_remove_config.php");

$data = new Csql();
$data->Connect();
$str = "ADAA-BDAA,CDAA,DFAA,EFAA,FAAA,GAAA,HFAA,IAAA,JAAA,KAAA,LHAA,MAAA,NAAA,OAAA,PAAA,aAAA,bAAA,cAAA,dAAA,eAAA,fAAA,gAAA,hAAA,iAAA,jAAA,kAAA,lAAA,mAAA,nAAA,oAAA,pAAA";
$str2 = "ADAA-BDAA,EFAA-FFAA,LHAA";
$teeth = new Teeth();
$teeth->BuildFixTeethFromText($str);
$teeth2 = new Teeth();
$teeth2->BuildFixTeethFromText($str2);
echo $teeth2->BuildFixTeethText();
echo "<br>";
$teeth2->ShowBridge();
echo "<br>";
$teeth2->ShowMember(true,false);
?>