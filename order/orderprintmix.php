<? include_once("../core/default.php"); ?>
<? include_once("../order/inc_shade.php"); ?>
<? include_once("../order/inc_getstring.php"); ?>
<?
	
	GetVar($eorder_id,"eorderid");




	$data_eorder = new Csql();
	$err =	$data_eorder->Connect();
	$query = "select ord_code,cus_name,doc_name,ord_patientname,ord_detail,ord_priority,
		DATE_FORMAT(ord_date,'%e') as ord_dated,
		DATE_FORMAT(ord_date,'%m') as ord_datem,
		DATE_FORMAT(ord_date,'%Y') as ord_datey,
		DATE_FORMAT(ord_date,'%k') as ord_datehh,
		DATE_FORMAT(ord_date,'%i') as ord_datemm,
		
		DATE_FORMAT(ord_releasedate,'%e') as ord_releasedated,
		DATE_FORMAT(ord_releasedate,'%m') as ord_releasedatem,
		DATE_FORMAT(ord_releasedate,'%Y') as ord_releasedatey,
		DATE_FORMAT(ord_releasedate,'%k') as ord_releasedateh,
		DATE_FORMAT(ord_releasedate,'%i') as ord_releasedatemn,

		DATE_FORMAT(ord_docdate,'%e') as ord_docdated,
		DATE_FORMAT(ord_docdate,'%m') as ord_docdatem,
		DATE_FORMAT(ord_docdate,'%Y') as ord_docdatey,
		DATE_FORMAT(ord_docdate,'%k') as ord_docdateh,
		DATE_FORMAT(ord_docdate,'%i') as ord_docdatemn,		
		
		eorder_fixid,ordf_method,ordf_boxcolor,ordf_typeofworkt,ordf_shade,ordf_alloy,
		ordf_embrasure,ordf_pontic,ordf_ponticmm,ordf_optiont,ordf_observation,ordf_optmoreinfo,ordf_optremark,

		eorder_removeid,ordr_method,ordr_typeofworkt,ordr_shade,ordr_observation,
		eorder_orthoid,ordo_method,ordo_typeofworkt,ordo_shade,ordo_observation

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
	$ordtypeO			= $data_eorder->Rs("eorder_orthoid")+0>0;
	
	$ordfmethod			= $data_eorder->Rs("ordf_method");
	$ordfboxcolor			= $data_eorder->Rs("ordf_boxcolor");
	$ordftypeofworkt	= $data_eorder->Rs("ordf_typeofworkt");
	$ordfshade				= $data_eorder->Rs("ordf_shade");
	$ordfalloy				= $data_eorder->Rs("ordf_alloy");
	$ordfembrasure		= $data_eorder->Rs("ordf_embrasure");
	$ordfpontic				= $data_eorder->Rs("ordf_pontic");
	$ordfponticmm		= $data_eorder->Rs("ordf_ponticmm");
	$ordfoptiont			= $data_eorder->Rs("ordf_optiont");
	$ordfobservation		= $data_eorder->Rs("ordf_observation");
	$ordfoptmoreinfo	= explode(",",$data_eorder->Rs("ordf_optmoreinfo"));
	$ordfoptremark		= explode(",",$data_eorder->Rs("ordf_optremark"));
		
	$ordrmethod			= $data_eorder->Rs("ordr_method");
	$ordrtypeofworkt	= $data_eorder->Rs("ordr_typeofworkt");
	$ordrshade				= $data_eorder->Rs("ordr_shade");
	$ordrobservation		= $data_eorder->Rs("ordr_observation");
	
	$ordomethod			= $data_eorder->Rs("ordo_method");
	$ordotypeofworkt	= $data_eorder->Rs("ordo_typeofworkt");
	$ordoshade				= $data_eorder->Rs("ordo_shade");
	$ordoobservation		= $data_eorder->Rs("ordo_observation");	
	
	if($ordfoptmoreinfo[0]=='')unset($ordfoptmoreinfo[0]);
	if($ordfoptremark[0]=='')unset($ordfoptremark[0]);
?>

<html>
<head>
<title>Order <?=$data_eorder->Rs("ord_code");?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../resource/css/default.css" rel="stylesheet" type="text/css" />
<script src="../resource/javascript/jquery-1.9.1.min.js"></script>
</head>
<style>
.print{
	font-size:16px;
}
.SBig {
	font-size:42px;
	font-weight: bold;
}
.HI {
	font-size:16px;
	font-style: italic;
}
</style>

<body>





<table width="100%" height="760" cellpadding="10" cellspacing="0" bgcolor="#FFFFFF" class="print">

<tr>
  <td width="50%" align="center" valign="top" bgcolor="#FFFFFF"><table width="350" border="0" cellpadding="2" cellspacing="0" class="print">
    <tr>
      <td colspan="2" align="right"><strong class="Normal">MIX - MIX - MIX - MIX - MIX</strong></td>
    </tr>
    <tr>
      <td colspan="2"><font face="IDAutomationHC39M" style="font-size:14px">*<?=$data_eorder->Rs("ord_code");?>* </font>&nbsp;&nbsp;<span class="SBig"><?=$data_eorder->Rs("ord_priority");?></span></td>
    </tr>
    <tr>
      <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="70"><strong>Code </strong></td>
            <td><strong>
              <?=$data_eorder->Rs("ord_code");?>
            </strong></td>
          </tr>
          <tr>
            <td width="70" class="HI">Cus</td>
            <td><?=$data_eorder->Rs("cus_name");?></td>
          </tr>
          <tr>
            <td width="70" class="HI">Doc</td>
            <td><?=$data_eorder->Rs("doc_name");?></td>
          </tr>
          <tr>
            <td width="70" class="HI">Pat</td>
            <td><?=$data_eorder->Rs("ord_patientname");?></td>
          </tr>
          <tr>
            <td width="70" class="HI">Entry</td>
            <td><?=$data_eorder->Rs("ord_dated");?>
                <?=passThaiMonth($data_eorder->Rs("ord_datem"));?>
                <?=passThaiYear($data_eorder->Rs("ord_datey"));?>
                <?=$data_eorder->Rs("ord_datehh");?>
              :
              <?=$data_eorder->Rs("ord_datemm");?></td>
          </tr>
          <tr>
            <td width="70" class="HI">Ship</td>
            <td><?=$data_eorder->Rs("ord_releasedated");?>
                <?=passThaiMonth($data_eorder->Rs("ord_releasedatem"));?>
                <?=passThaiYear($data_eorder->Rs("ord_releasedatey"));?>
                <?=$data_eorder->Rs("ord_releasedateh");?>
              :
              <?=$data_eorder->Rs("ord_releasedatemn");?></td>
          </tr>
      </table></td>
    </tr>
    <tr>
      <td colspan="2"><hr></td>
    </tr>
    <tr>
      <td colspan="2"><? if($ordtypeF){?>
          <strong class="Big">--- Fix order ---</strong>
          <!--div style="width:400;overflow:1;border:0"-->
          <table border="0" cellpadding="2" cellspacing="0" class="print">
            <tr>
              <td class="HI"> Method</td>
              <td><?=$ordfmethod?></td>
            </tr>
            <tr>
              <td class="HI"> Box</td>
              <td><?=$ordfboxcolor?></td>
            </tr>
            <tr>
              <td valign="top" class="HI"> Tp of wk</td>
              <td>
              <!--pre-->
			  <? //=$ordftypeofworkt?>	
    		<!--/pre-->		    
                        </td>
            </tr>
            
            <? if(count($ordfoptremark)+0>0 || count($ordfoptmoreinfo)+0>0){ ?>
            <tr><td colspan="2">
            
            <? if(count($ordfoptremark)+0>0){ ?>
            
         <?php/*<table border="0" bordercolor="#000000" cellspacing="0" cellpadding="2"
width="100%">
           <tr>
             <td align="left" valign="top"><strong>Remake</strong><br>
                 <?=in_array('ChangeShade', $ordfoptremark)?"-Pink Porcelain<br>":""?>
                 <?=in_array('ShortMargin', $ordfoptremark)?"-Short margin<br>":""?>
                 <?=in_array('AddContactPoint', $ordfoptremark)?"-Add contact point<br>":""?>
                 <?=in_array('RepairCeramic', $ordfoptremark)?"-Repair ceramic<br>":""?>
                 <?=in_array('CeramicCracked', $ordfoptremark)?"-Ceramic cracked<br>":""?>
                 <?=in_array('CanNotInsert', $ordfoptremark)?"-Can not insert<br>":""?>
                 <?=in_array('ChangeDesign', $ordfoptremark)?"-Change design<br>":""?>
                 <?=in_array('WrongBite', $ordfoptremark)?"-Wrong bite":""?>
                 <?=in_array('WrongBite2', $ordfoptremark)?"-Wrong bite2":""?>

				 </td>
           </tr>
         </table>*/?>
         <? } ?>
         <? if(count($ordfoptmoreinfo)+0>0){ ?>
         <table border="1" bordercolor="#000000" cellspacing="0" cellpadding="2" 
width="100%">
           <tr>
             <td align="left" valign="top"><strong>More Info</strong><br>
                 <?=in_array('MarginGoDeep', $ordfoptmoreinfo)?"-Margin ลงลึกใต้เหงือก<br>":""?>
                 <?=in_array('UnderOcclusion05mm', $ordfoptmoreinfo)?"-Under occlusion 0.5mm<br>":""?>
                 <?=in_array('UnderOcclusion10mm', $ordfoptmoreinfo)?"-Under occlusion 1.0mm<br>":""?>
                 <?=in_array('UnderOcclusion20mm', $ordfoptmoreinfo)?"-Under occlusion 2.0mm<br>":""?>
                 <?=in_array('NoMetalMargin', $ordfoptmoreinfo)?"-No metal margin<br>":""?>
                 <?=in_array('SmallMetalMargin', $ordfoptmoreinfo)?"-Small metal margin<br>":""?>
                 <?=in_array('Metal margin 1 mm Lingual', $ordfoptmoreinfo)?"-Metal margin 1 mm Lingual<br>":""?>
                 <?=in_array('Metal margin 0.5 mm Lingual', $ordfoptmoreinfo)?"-Metal margin 0.5 mm Lingual<br>":""?>
                 <?=in_array('SmallMetalMarginAround', $ordfoptmoreinfo)?"-Small metal margin around<br>":""?>
                 <?=in_array('HairLineMetalMargin', $ordfoptmoreinfo)?"-Hair line metal margin<br>":""?>
                 <?=in_array('Hair line metal margin Lingual', $ordfoptmoreinfo)?"-Hair line metal margin Lingual<br>":""?>
                 <?=in_array('HairLineMetalMarginAround', $ordfoptmoreinfo)?"-Hair line metal margin around<br>":""?>
                 <?=in_array('LetSpaceBetweenTeeth', $ordfoptmoreinfo)?"-Let space between teeth<br>":""?>
                 <?=in_array('No approximal contact', $ordfoptmoreinfo)?"-No approximal contact<br>":""?>
                 <?=in_array('SmallTeeth', $ordfoptmoreinfo)?"-Small teeth<br>":""?>
                 <?=in_array('RestPrepareForRPDTP', $ordfoptmoreinfo)?"-Rest , Prepare for RPD/TP<br>":""?>
                 <?=in_array('AdeptWithRPDTP', $ordfoptmoreinfo)?"-ทำงาน FIX ให้เข้ากับ RPD<br>":""?>
                 <?=in_array('Adapt with RPD/TP', $ordfoptmoreinfo)?"-Adapt with RPD/TP<br>":""?>
                 <?=in_array('NoSpaceMakePF', $ordfoptmoreinfo)?"-ถ้าไม่มีพื้นที่ให้ทำเป็น PF ได้<br>":""?>
                 <?=in_array('NotHaveAnagonist', $ordfoptmoreinfo)?"-Not have anagonist<br>":""?>
                 <?=in_array('No anagonist', $ordfoptmoreinfo)?"-No antagonist<br>":""?>
                 <?=in_array('PorcelainMargin', $ordfoptmoreinfo)?"-Porcelain Margin<br>":""?>
                 <?=in_array('PorcelainMarginAround', $ordfoptmoreinfo)?"-Porcelain Margin around<br>":""?>
                 <?=in_array('PonticBuccalPalatalSmaller', $ordfoptmoreinfo)?"-Pontic buccal , palatal smaller<br>":""?>      
                 <?=in_array('Crown endosed for shade/anatomy', $ordfoptmoreinfo)?"-Crown endosed for shade/anatomy<br>":""?>
                 <?=in_array('Bridge enclosed for shade/anatomy', $ordfoptmoreinfo)?"-Bridge enclosed for shade/anatomy<br>":""?>
                 <?=in_array('New Dentist', $ordfoptmoreinfo)?"-New Dentist<br>":""?>
                 <?=in_array('Lingual Mistal & Distal margin', $ordfoptmoreinfo)?"-Lingual Mistal & Distal margin<br>":""?>
                 <?=in_array('Pindex', $ordfoptmoreinfo)?"-Pindex<br>":""?>
                 <?=in_array('เจาะรู / Drilling Hold', $ordfoptmoreinfo)?"-เจาะรู / Drilling Hold<br>":""?>
                 <?=in_array('ChangeShade', $ordfoptmoreinfo)?"-Pink Porcelain<br>":""?>
				 <?=in_array('ChangeShade', $ordfoptremark)?"-Pink Porcelain<br>":""?>
                 <?=in_array('ShortMargin', $ordfoptremark)?"-Short margin<br>":""?>
                 <?=in_array('AddContactPoint', $ordfoptremark)?"-Add contact point<br>":""?>
                 <?=in_array('RepairCeramic', $ordfoptremark)?"-Repair ceramic<br>":""?>
                 <?=in_array('CeramicCracked', $ordfoptremark)?"-Ceramic cracked<br>":""?>
                 <?=in_array('CanNotInsert', $ordfoptremark)?"-Can not insert<br>":""?>
                 <?=in_array('ChangeDesign', $ordfoptremark)?"-Change design<br>":""?>
                 <?=in_array('WrongBite', $ordfoptremark)?"-Wrong bite":""?>
                 <?=in_array('WrongBite2', $ordfoptremark)?"-Wrong bite2":""?>
                      </td>
           </tr>
         </table>
         <? } ?>
         </td></tr>
           <? } ?>
            
            
            

            <tr>
              <td class="HI"> Shade </td>
              <td><?=getShadeName($ordfshade)?></td>
            </tr>
            <tr>
              <td class="HI"> Alloy </td>
              <td><?=getAlloyName($ordfalloy)?></td>
            </tr>
            <tr>
              <td class="HI"> Embras.. </td>
              <td><?=$ordfembrasure?></td>
            </tr>
            <tr>
              <td class="HI"> Pontic </td>
              <td><img src="../resource/images/eorder/fix/fix_pontic<?=$ordfpontic-1?>.gif" width="32" height="32"> <?=strlen($ordfponticmm)>0?$ordfponticmm." mm":""?></td>
            </tr>
            <tr>
              <td valign="top" class="HI"> Option</td>
              <td><!--pre-->
			  <?=$ordfoptiont?>
    <!--/pre--></td>
            </tr>
            <tr>
              <td valign="top" class="HI"> Observ..</td>
              <td><!--pre--><?=$ordfobservation?>
    <!--/pre--></td>
            </tr>
          </table><!--/div-->
        <? }?>    </td>
    </tr>
    <tr>
      <td colspan="2"></td>
    </tr>
  </table></td>
  <td width="50%" align="right" valign="top" bgcolor="#FFFFFF">
    <table width="350" border="0" cellpadding="2" cellspacing="0" class="print">
  <tr>
    <td colspan="2" align="left"><strong class="Normal">MIX - MIX - MIX - MIX - MIX</strong></td>
  </tr>
  <tr>
    <td colspan="2"><font face="IDAutomationHC39M" style="font-size:14px">*<?=$data_eorder->Rs("ord_code");?>*</font>&nbsp;&nbsp;<span class="SBig"><?=$data_eorder->Rs("ord_priority");?></span></td>
    </tr>
  <tr>
    <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="70"><strong>Code </strong></td>
        <td><strong>
          <?=$data_eorder->Rs("ord_code");?>
        </strong></td>
      </tr>
      <tr>
        <td width="70" class="HI">Cus</td>
        <td><?=$data_eorder->Rs("cus_name");?></td>
      </tr>
      <tr>
        <td width="70" class="HI">Doc</td>
        <td><?=$data_eorder->Rs("doc_name");?></td>
      </tr>
      <tr>
        <td width="70" class="HI">Pat</td>
        <td><?=$data_eorder->Rs("ord_patientname");?></td>
      </tr>
      <tr>
        <td width="70" class="HI">Entry</td>
        <td><?=$data_eorder->Rs("ord_dated");?>
          <?=passThaiMonth($data_eorder->Rs("ord_datem"));?>
          <?=passThaiYear($data_eorder->Rs("ord_datey"));?>
          <?=$data_eorder->Rs("ord_datehh");?>
          :
          <?=$data_eorder->Rs("ord_datemm");?></td>
      </tr>
      <tr>
        <td width="70" class="HI">Ship</td>
        <td><?=$data_eorder->Rs("ord_releasedated");?>
          <?=passThaiMonth($data_eorder->Rs("ord_releasedatem"));?>
          <?=passThaiYear($data_eorder->Rs("ord_releasedatey"));?>
          <?=$data_eorder->Rs("ord_releasedateh");?>
          :
          <?=$data_eorder->Rs("ord_releasedatemn");?></td>
      </tr>
    </table></td>
    </tr>
  
  <tr>
    <td colspan="2"><hr></td>
    </tr>
  <tr>
    <td colspan="2">

	<? if($ordtypeR){?>
	<? include("../order/orderprint_remove.php"); ?>
  <? }?>
  </td>
    </tr>
  <tr>
    <td colspan="2"></td>
  </tr>
</table></td>
</tr>
     <tr>
       <td valign="bottom"  bgcolor="#FFFFFF" align="center">[ ]Bite [ ]IMP [ ]2ndModel [ ]_______</td>
       <td valign="bottom"  bgcolor="#FFFFFF" align="left">&nbsp;</td>
     </tr>
  <tr>
    <td valign="bottom"  bgcolor="#FFFFFF" align="center"><table border="0" cellpadding="3" cellspacing="0" class="print">
      <tr>
        <td class="popNormal">Model</td>
        <td class="Normal">: ___________ __/__ __:__</td>
      </tr>
      <tr>
        <td class="popNormal">Wax</td>
        <td class="Normal">: ___________ __/__ __:__</td>
      </tr>
      <tr>
        <td class="popNormal">Metal</td>
        <td class="Normal">: ___________ __/__ __:__</td>
      </tr>
      <tr>
        <td class="popNormal">Ceramic</td>
        <td class="Normal">: ___________ __/__ __:__</td>
      </tr>
      <tr>
        <td class="popNormal">Q.C.</td>
        <td class="Normal">: ___________ __/__ __:__</td>
      </tr>
    </table></td>
    <td valign="bottom"  bgcolor="#FFFFFF" align="left">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" align="center" valign="bottom"  bgcolor="#FFFFFF" class="Small"><strong class="Normal">MIX - MIX - MIX - MIX - MIX - MIX - MIX - MIX - MIX- MIX - MIX - MIX - MIX- MIX - MIX<br>
    MIX - MIX - MIX - MIX - MIX - MIX - MIX - MIX - MIX- MIX - MIX - MIX - MIX- MIX - MIX<br>
    MIX - MIX - MIX - MIX - MIX - MIX - MIX - MIX - MIX- MIX - MIX - MIX - MIX- MIX - MIX</strong></td>
  </tr>
  <tr>
    <td align="center" valign="bottom"  bgcolor="#FFFFFF" class="Small">HEXA CERAM CO.LTD<br>
213 Moo 5 Sanpraned <br>
Sansai Chiangmai 50210 Thailand<br>
Tel (66) 53 380 801 - 2 Tel & Fax (66) 53 380 471 </td>
    <td align="center" valign="bottom"  bgcolor="#FFFFFF" class="Small">HEXA CERAM CO.LTD<br>
213 Moo 5 Sanpraned <br>
Sansai Chiangmai 50210 Thailand<br>
Tel (66) 53 380 801 - 2 Tel & Fax (66) 53 380 471	</td>
  </tr>
</table>
</body>
</html>

